<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect()->route('menu');
});

Route::get('/login', [PageController::class, 'login'])->name('login');

Route::post('/login', function (Request $request) {
    $key = Str::lower($request->input('email', '')) . '|' . $request->ip();

    if (RateLimiter::tooManyAttempts($key, 5)) {
        $seconds = RateLimiter::availableIn($key);

        return back()->withErrors([
            'email' => "Terlalu banyak percobaan. Silakan tunggu {$seconds} detik.",
        ])->onlyInput('email');
    }

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
        'g-recaptcha-response' => ['required'],
    ], [
        'g-recaptcha-response.required' => 'Silakan centang kotak "I\'m not a robot" terlebih dahulu.',
    ]);

    $secretKey = env('RECAPTCHA_SECRET_KEY');
    if ($secretKey) {
        $response = Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $credentials['g-recaptcha-response'],
            'remoteip' => $request->ip(),
        ]);

        if (! $response->json('success')) {
            RateLimiter::hit($key, 300);
            return back()->withErrors([
                'email' => 'Sistem mendeteksi aktivitas mencurigakan (CAPTCHA Gagal). Silakan coba lagi.',
            ])->onlyInput('email');
        }
    }

    unset($credentials['g-recaptcha-response']);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        RateLimiter::clear($key);
        $request->session()->regenerate();

        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'kasir' => redirect()->route('cashier.dashboard'),
            default => redirect()->route('menu'),
        };
    }

    RateLimiter::hit($key, 300);

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
})->name('login.submit');

Route::get('/register', function () {
    if (Auth::check()) {
        return redirect()->route('menu');
    }
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'nama_lengkap'          => ['required', 'string', 'max:100'],
        'email'                 => ['required', 'email', 'max:100', 'unique:users,email'],
        'no_telepon'            => ['nullable', 'string', 'max:20'],
        'password'              => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'nama_lengkap.required'  => 'Nama lengkap wajib diisi.',
        'email.required'         => 'Email wajib diisi.',
        'email.email'            => 'Format email tidak valid.',
        'email.unique'           => 'Email ini sudah terdaftar. Silakan gunakan email lain atau masuk.',
        'password.required'      => 'Kata sandi wajib diisi.',
        'password.min'           => 'Kata sandi minimal 8 karakter.',
        'password.confirmed'     => 'Konfirmasi kata sandi tidak cocok.',
    ]);

    $user = App\Models\User::create([
        'nama_lengkap' => $data['nama_lengkap'],
        'email'        => $data['email'],
        'no_telepon'   => $data['no_telepon'] ?? null,
        'password'     => $data['password'],
        'role'         => 'customer',
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->route('menu');
})->name('register.submit');

Route::get('/menu', [PageController::class, 'menu'])->name('menu');

Route::get('/admin', [PageController::class, 'adminDashboard'])->middleware('auth')->name('admin.dashboard');
Route::get('/admin/{feature}', [PageController::class, 'adminFeature'])->middleware('auth')->name('admin.feature');
Route::get('/products/create', [ProductController::class, 'create'])->middleware('auth')->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->middleware('auth')->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware('auth')->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->middleware('auth')->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('auth')->name('products.destroy');

Route::get('/cashier', [PageController::class, 'cashierDashboard'])->middleware('auth')->name('cashier.dashboard');

Route::get('/offers', [PageController::class, 'offers'])->name('offers');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'email', 'max:255'],
        'topic' => ['required', 'string', 'max:80'],
        'message' => ['required', 'string', 'max:2000'],
    ]);

    return back()->with('contact_success', 'Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.');
})->middleware('auth')->name('contact.submit');

Route::get('/order', [PageController::class, 'order'])->name('order');
Route::get('/pesanan-saya', [PageController::class, 'myOrders'])->middleware('auth')->name('pesanan.saya');
Route::get('/api/pesanan-saya', [PageController::class, 'myOrdersData'])->middleware('auth')->name('pesanan.saya.data');

Route::post('/orders', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'phone' => ['required', 'string', 'max:20'],
        'address' => ['required', 'string', 'max:1000'],
        'payment_method' => ['required', 'in:cash,qris,e-wallet'],
        'items' => ['required', 'array', 'min:1'],
        'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
        'items.*.qty' => ['required', 'integer', 'min:1'],
    ]);

    $order = DB::transaction(function () use ($data, $request) {
        $subtotal = 0;
        $items = [];

        foreach ($data['items'] as $item) {
            $product = DB::table('products')->where('id', $item['product_id'])->lockForUpdate()->first();

            abort_unless($product && $product->status !== 'out_of_stock' && $product->stock >= $item['qty'], 422, 'Stok produk tidak mencukupi.');

            $subtotal += $product->price * $item['qty'];
            $items[] = [$product, $item['qty']];
        }

        $bonus = count($data['items']) >= 3 ? round($subtotal * 0.1) : 0;
        $total = $subtotal - $bonus + 10000;

        $userId = null;
        if (Auth::check()) {
            $userId = Auth::id();
            DB::table('users')->where('id', $userId)->update([
                'nama_lengkap' => $data['name'],
                'no_telepon' => $data['phone'],
                'alamat_lengkap' => $data['address'],
            ]);
        } else {
            $user = DB::table('users')->where('no_telepon', $data['phone'])->first();
            if ($user) {
                $userId = $user->id;
                DB::table('users')->where('id', $userId)->update([
                    'nama_lengkap' => $data['name'],
                    'alamat_lengkap' => $data['address'],
                ]);
            } else {
                $userId = DB::table('users')->insertGetId([
                    'nama_lengkap' => $data['name'],
                    'no_telepon' => $data['phone'],
                    'alamat_lengkap' => $data['address'],
                    'email' => 'guest_' . time() . rand(100, 999) . '@eskrim.local',
                    'password' => bcrypt(Str::random(16)),
                    'role' => 'customer',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $userId,
            'total_harga' => $total,
            'status_pesanan' => 'pending',
            'metode_pembayaran' => $data['payment_method'],
            'alamat_pengiriman' => $data['address'],
            'tanggal_pesanan' => now(),
        ]);

        foreach ($items as [$product, $quantity]) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $product->id,
                'jumlah' => $quantity,
                'harga_satuan' => $product->price,
            ]);

            DB::table('products')->where('id', $product->id)->decrement('stock', $quantity);
        }

        return $orderId;
    });

    return response()->json([
        'message' => 'Pesanan berhasil dibuat.',
        'order_id' => $order,
    ]);
})->name('orders.store');

Route::post('/pos/orders', function (Request $request) {
    abort_unless(in_array(Auth::user()->role, ['admin', 'kasir']), 403);

    $data = $request->validate([
        'payment_method' => ['required', 'string'],
        'items' => ['required', 'array', 'min:1'],
        'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
        'items.*.qty' => ['required', 'integer', 'min:1'],
    ]);

    $orderId = DB::transaction(function () use ($data, $request) {
        $subtotal = 0;
        $items = [];

        foreach ($data['items'] as $item) {
            $product = DB::table('products')->where('id', $item['product_id'])->lockForUpdate()->first();
            abort_unless($product && $product->stock >= $item['qty'], 422, 'Stok produk tidak mencukupi.');

            $subtotal += $product->price * $item['qty'];
            $items[] = [$product, $item['qty']];
        }

        $tax = round($subtotal * 0.1);
        $total = $subtotal + $tax;

        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $request->user()->id,
            'total_harga' => $total,
            'status_pesanan' => 'selesai',
            'metode_pembayaran' => strtolower($data['payment_method']) === 'qris' ? 'qris' : 'cash',
            'alamat_pengiriman' => 'Pembelian Offline (POS)',
            'tanggal_pesanan' => now(),
        ]);

        foreach ($items as [$product, $quantity]) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $product->id,
                'jumlah' => $quantity,
                'harga_satuan' => $product->price,
            ]);

            DB::table('products')->where('id', $product->id)->decrement('stock', $quantity);
        }

        return $orderId;
    });

    return response()->json([
        'success' => true,
        'message' => 'Pesanan POS berhasil diproses.',
        'order_id' => $orderId,
    ]);
})->middleware('auth')->name('pos.orders.store');

Route::patch('/orders/{id}/status', function (Request $request, $id) {
    abort_unless(in_array(Auth::user()->role, ['admin', 'kasir']), 403);

    $validated = $request->validate([
        'status' => ['required', 'string'],
    ]);

    $newStatus = match (strtolower($validated['status'])) {
        'processing', 'diproses' => 'diproses',
        'completed', 'selesai', 'done' => 'selesai',
        'cancelled', 'batal', 'dibatalkan' => 'dibatalkan',
        'dikirim', 'shipped' => 'dikirim',
        default => 'pending',
    };

    DB::table('orders')->where('id', $id)->update([
        'status_pesanan' => $newStatus,
    ]);

    if ($request->expectsJson() || $request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Status pesanan #' . $id . ' berhasil diperbarui menjadi ' . ucfirst($newStatus) . '.',
            'status' => $newStatus,
        ]);
    }

    return back()->with('status_updated', 'Status pesanan #' . $id . ' berhasil diperbarui.');
})->middleware('auth')->name('orders.update-status');

Route::get('/orders/{id}/status', function (Request $request, $id) {
    $order = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->where('orders.id', $id)
        ->select(
            'orders.id',
            'orders.user_id',
            'orders.tanggal_pesanan',
            'orders.total_harga',
            'orders.status_pesanan',
            'orders.metode_pembayaran',
            'orders.alamat_pengiriman',
            'users.nama_lengkap',
            'users.no_telepon'
        )
        ->first();

    abort_unless($order, 404, 'Pesanan tidak ditemukan.');

    if (!in_array(Auth::user()->role, ['admin', 'kasir']) && $order->user_id !== Auth::id()) {
        abort(403, 'Akses tidak diizinkan.');
    }

    $items = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->where('order_items.order_id', $order->id)
        ->select(
            'order_items.jumlah',
            'order_items.harga_satuan',
            'products.name as product_name',
            'products.image_url'
        )
        ->get();

    return response()->json([
        'success' => true,
        'order' => [
            'id' => $order->id,
            'order_no' => '#ORD-' . str_pad($order->id, 4, '0', STR_PAD_LEFT),
            'status' => $order->status_pesanan,
            'payment_method' => $order->metode_pembayaran,
            'total_harga' => (float) $order->total_harga,
            'tanggal' => $order->tanggal_pesanan,
            'alamat' => $order->alamat_pengiriman,
            'customer_name' => $order->nama_lengkap,
            'customer_phone' => $order->no_telepon,
            'items' => $items,
        ],
    ]);
})->middleware('auth')->name('orders.get-status');

Route::get('/orders/latest', function (Request $request) {
    abort_unless(in_array(Auth::user()->role, ['admin', 'kasir']), 403);

    $orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
        ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'orders.id',
            'orders.tanggal_pesanan',
            'orders.total_harga',
            'orders.status_pesanan',
            'orders.metode_pembayaran',
            'orders.alamat_pengiriman',
            'users.nama_lengkap',
            'users.no_telepon',
            'users.email',
            DB::raw("GROUP_CONCAT(CONCAT(order_items.jumlah, 'x ', COALESCE(products.name, 'Produk')) ORDER BY products.name SEPARATOR ', ') as produk_list"),
            DB::raw('COALESCE(SUM(order_items.jumlah), 0) as total_item')
        )
        ->groupBy(
            'orders.id',
            'orders.tanggal_pesanan',
            'orders.total_harga',
            'orders.status_pesanan',
            'orders.metode_pembayaran',
            'orders.alamat_pengiriman',
            'users.nama_lengkap',
            'users.no_telepon',
            'users.email'
        )
        ->orderByDesc('orders.id')
        ->limit(50)
        ->get();

    $orderIds = $orders->pluck('id')->all();
    $itemsByOrder = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->whereIn('order_items.order_id', $orderIds)
        ->select(
            'order_items.id',
            'order_items.order_id',
            'order_items.product_id',
            'order_items.jumlah',
            'order_items.harga_satuan',
            'products.name as product_name'
        )
        ->get()
        ->groupBy('order_id');

    foreach ($orders as $order) {
        $order->items = $itemsByOrder->get($order->id, collect());
    }

    $pendingCount = DB::table('orders')->whereIn('status_pesanan', ['pending', 'menunggu'])->count();
    $todayRevenue = DB::table('orders')->whereDate('tanggal_pesanan', now()->today())->sum('total_harga');

    return response()->json([
        'orders' => $orders,
        'total' => $orders->count(),
        'pending_count' => $pendingCount,
        'today_revenue' => $todayRevenue,
    ]);
})->middleware('auth')->name('orders.latest');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::patch('/profile/name', function (Request $request) {
    $data = $request->validate([
        'nama_lengkap' => ['required', 'string', 'max:100']
    ]);

    DB::table('users')->where('id', $request->user()->id)->update([
        'nama_lengkap' => $data['nama_lengkap']
    ]);

    return response()->json(['success' => true, 'name' => $data['nama_lengkap']]);
})->middleware('auth')->name('profile.update-name');
