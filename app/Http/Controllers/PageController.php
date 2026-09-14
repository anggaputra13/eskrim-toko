<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('menu');
        }

        return view('login');
    }

    public function menu()
    {
        $products = Product::query();

        if (Schema::hasColumn('products', 'status')) {
            $products->where('status', '!=', 'out_of_stock')->where('stock', '>', 0)->orderBy('name');
        } else {
            $products->where('stok', '>', 0)->orderBy('nama_produk');
        }

        return view('menu', ['products' => $products->get()]);
    }

    public function adminDashboard()
    {
        abort_unless(in_array(Auth::user()->role, ['admin', 'kasir']), 403);

        $orders = $this->getDetailedOrders(50);
        $stats = $this->getOrderStats();

        return view('admin', [
            'products' => Product::orderBy('created_at', 'desc')->get(),
            'orders'   => $orders,
            'stats'    => $stats,
        ]);
    }

    public function adminFeature(string $feature)
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        abort_unless(in_array($feature, ['inventory', 'orders', 'customers', 'reports', 'settings']), 404);

        $orders = $this->getDetailedOrders(100);
        $stats = $this->getOrderStats();

        return view('admin-feature', [
            'feature'  => $feature,
            'products' => Product::orderBy('created_at', 'desc')->get(),
            'orders'   => $orders,
            'stats'    => $stats,
        ]);
    }

    public function cashierDashboard()
    {
        abort_unless(in_array(Auth::user()->role, ['admin', 'kasir']), 403);

        $products = Product::query();

        if (Schema::hasColumn('products', 'status')) {
            $products->where('status', '!=', 'out_of_stock')->where('stock', '>', 0)->orderBy('name');
        } else {
            $products->where('stok', '>', 0)->orderBy('nama_produk');
        }

        $orders = $this->getDetailedOrders(50);
        $stats = $this->getOrderStats();

        return view('cashier', [
            'products' => $products->get(),
            'orders'   => $orders,
            'stats'    => $stats,
        ]);
    }

    private function getDetailedOrders(int $limit = 50)
    {
        $orders = \Illuminate\Support\Facades\DB::table('orders')
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
                \Illuminate\Support\Facades\DB::raw("GROUP_CONCAT(CONCAT(order_items.jumlah, 'x ', COALESCE(products.name, 'Produk')) ORDER BY products.name SEPARATOR ', ') as produk_list"),
                \Illuminate\Support\Facades\DB::raw('COALESCE(SUM(order_items.jumlah), 0) as total_item')
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
            ->limit($limit)
            ->get();

        $orderIds = $orders->pluck('id')->all();
        if (!empty($orderIds)) {
            $itemsByOrder = \Illuminate\Support\Facades\DB::table('order_items')
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
        }

        return $orders;
    }

    private function getOrderStats(): array
    {
        $todayRevenue = \Illuminate\Support\Facades\DB::table('orders')->whereDate('tanggal_pesanan', now()->today())->sum('total_harga');
        $allTimeRevenue = \Illuminate\Support\Facades\DB::table('orders')->sum('total_harga');
        $todayOrders = \Illuminate\Support\Facades\DB::table('orders')->whereDate('tanggal_pesanan', now()->today())->count();
        $totalOrders = \Illuminate\Support\Facades\DB::table('orders')->count();
        $pendingOrders = \Illuminate\Support\Facades\DB::table('orders')->whereIn('status_pesanan', ['pending', 'menunggu'])->count();
        $customersCount = \Illuminate\Support\Facades\DB::table('users')->where('role', 'customer')->count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();

        return [
            'today_revenue'    => $todayRevenue > 0 ? $todayRevenue : $allTimeRevenue,
            'today_revenue_raw'=> $todayRevenue,
            'all_time_revenue' => $allTimeRevenue,
            'today_orders'     => $todayOrders,
            'total_orders'     => $totalOrders,
            'pending_orders'   => $pendingOrders,
            'customers_count'  => $customersCount,
            'low_stock_count'  => $lowStockCount,
        ];
    }

    public function offers()
    {
        return view('offers', ['products' => Product::query()->get()]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function order()
    {
        return view('order');
    }

    public function myOrders(Request $request)
    {
        $orders = $this->getUserOrders(Auth::id());

        return view('my-orders', [
            'orders' => $orders,
        ]);
    }

    public function myOrdersData(Request $request)
    {
        $orders = $this->getUserOrders(Auth::id());

        return response()->json([
            'success' => true,
            'orders' => $orders,
        ]);
    }

    private function getUserOrders(int $userId)
    {
        $orders = DB::table('orders')
            ->where('user_id', $userId)
            ->whereIn('status_pesanan', ['pending', 'menunggu', 'processing', 'diproses', 'dikirim', 'shipped'])
            ->orderByDesc('id')
            ->get();

        $orderIds = $orders->pluck('id')->all();
        if (!empty($orderIds)) {
            $itemsByOrder = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->whereIn('order_items.order_id', $orderIds)
                ->select(
                    'order_items.id',
                    'order_items.order_id',
                    'order_items.product_id',
                    'order_items.jumlah',
                    'order_items.harga_satuan',
                    'products.name as product_name',
                    'products.image_url'
                )
                ->get()
                ->groupBy('order_id');

            foreach ($orders as $order) {
                $order->items = $itemsByOrder->get($order->id, collect());
            }
        }

        return $orders;
    }
}
