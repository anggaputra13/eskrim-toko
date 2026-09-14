<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $feature === 'inventory' ? 'Inventaris Produk' : ucfirst($feature) }} | Scoops &amp; delicios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-page admin-dashboard feature-page">
    <div class="dashboard-shell">
        <aside class="dashboard-sidebar">
            <div class="dashboard-brand">
                <div class="dashboard-brand-mark">S</div>
                <div><strong>Scoops &amp; delicios</strong><small>Admin Panel</small></div>
            </div>
            <nav class="dashboard-nav">
                <a class="dashboard-nav-link" href="{{ route('admin.dashboard') }}"><span>Dasbor</span></a>
                <a class="dashboard-nav-link {{ $feature === 'inventory' ? 'active' : '' }}" href="{{ route('admin.feature', 'inventory') }}"><span>Inventaris Produk</span></a>
                <a class="dashboard-nav-link {{ $feature === 'orders' ? 'active' : '' }}" href="{{ route('admin.feature', 'orders') }}">
                    <span>Pesanan</span>
                    @if(($stats['pending_orders'] ?? 0) > 0)
                        <span style="margin-left:auto; background:#F43F5E; color:#fff; font-size:0.75rem; font-weight:700; padding:2px 8px; border-radius:99px;">{{ $stats['pending_orders'] }}</span>
                    @endif
                </a>
                <a class="dashboard-nav-link {{ $feature === 'customers' ? 'active' : '' }}" href="{{ route('admin.feature', 'customers') }}"><span>Pelanggan</span></a>
                <a class="dashboard-nav-link {{ $feature === 'reports' ? 'active' : '' }}" href="{{ route('admin.feature', 'reports') }}"><span>Laporan</span></a>
                <a class="dashboard-nav-link {{ $feature === 'settings' ? 'active' : '' }}" href="{{ route('admin.feature', 'settings') }}"><span>Pengaturan</span></a>
                <a class="dashboard-nav-link" href="{{ route('cashier.dashboard') }}"><span>Terminal Kasir POS</span></a>
            </nav>
            <a class="sidebar-primary-action" href="{{ route('products.create') }}"><span>+ Tambah Produk Baru</span></a>
            <form class="sidebar-logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><span>Keluar Account</span></button>
            </form>
        </aside>

        <main class="dashboard-content">
            @php
                $titles = [
                    'inventory' => ['Inventaris Produk', 'Kelola stok dan daftar rasa es krim emberan.'],
                    'orders' => ['Pesanan', 'Pantau seluruh pesanan pelanggan dalam satu tempat.'],
                    'customers' => ['Pelanggan', 'Lihat pelanggan dan aktivitas pembelian mereka.'],
                    'reports' => ['Laporan', 'Ringkasan performa penjualan toko Scoops & delicios.'],
                    'settings' => ['Pengaturan', 'Atur preferensi toko dan akun admin.'],
                ];
                [$title, $description] = $titles[$feature];
            @endphp
            <header class="dashboard-topbar">
                <div class="topbar-title-wrap">
                    <h1>{{ $title }}</h1>
                    <p>{{ $description }}</p>
                </div>
                @if ($feature === 'inventory')
                    <a class="dashboard-button primary" href="{{ route('products.create') }}">+ Tambah Produk</a>
                @endif
            </header>

            @if ($feature === 'inventory')
                <section class="dashboard-panel inventory-panel">
                    <div class="panel-header-flex"><div><h2>Daftar Es Krim Emberan</h2><p class="panel-subtext">{{ $products->count() }} produk terdaftar</p></div></div>
                    <div class="inventory-table-wrap"><table class="inventory-table"><thead><tr><th>Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead><tbody>
                        @forelse ($products as $product)
                            <tr><td><strong>{{ $product->name }}</strong></td><td>{{ ucfirst($product->category) }}</td><td>Rp {{ number_format($product->price, 0, ',', '.') }}</td><td>{{ $product->stock }} ember</td><td><a href="{{ route('products.edit', $product) }}">Edit</a></td></tr>
                        @empty
                            <tr><td colspan="5">Belum ada produk.</td></tr>
                        @endforelse
                    </tbody></table></div>
                </section>
            @elseif ($feature === 'orders')
                <section class="metric-grid feature-metrics">
                    <article class="metric-card metric-pink"><span class="metric-label">Pesanan Hari Ini</span><strong class="metric-value">{{ $stats['today_orders'] }}</strong><div class="metric-badge badge-positive">{{ $stats['today_orders'] > 0 ? 'Hari ini' : 'Total: ' . $stats['total_orders'] }}</div></article>
                    <article class="metric-card metric-emerald"><span class="metric-label">Total Omzet</span><strong class="metric-value">Rp {{ number_format($stats['today_revenue'], 0, ',', '.') }}</strong><div class="metric-badge badge-positive">Penjualan</div></article>
                    <article class="metric-card metric-amber"><span class="metric-label">Menunggu Diproses</span><strong class="metric-value">{{ $stats['pending_orders'] }}</strong><div class="metric-badge badge-warning">Perlu ditangani</div></article>
                </section>
                <section class="dashboard-panel feature-table-panel">
                    <header class="panel-header-flex">
                        <div>
                            <h2>Daftar Seluruh Pesanan Pelanggan</h2>
                            <p class="panel-subtext">Pantau dan kelola status setiap pesanan yang masuk dari pelanggan</p>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="dashboard-button secondary">Kembali ke Dasbor</a>
                    </header>
                    <div class="recent-table-wrap">
                        <table class="recent-orders-table">
                            <thead>
                                <tr>
                                    <th>ID PESANAN</th>
                                    <th>PELANGGAN</th>
                                    <th>ALAMAT PENGIRIMAN</th>
                                    <th>PRODUK</th>
                                    <th>METODE</th>
                                    <th>TOTAL</th>
                                    <th>STATUS</th>
                                    <th>WAKTU</th>
                                    <th style="text-align:center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="adminFeatureOrdersTbody">
                                @forelse ($orders as $order)
                                @php
                                    $statusPesanan = strtolower($order->status_pesanan ?? 'pending');
                                    $badgeClass = match($statusPesanan) {
                                        'selesai', 'completed', 'done' => 'badge-success',
                                        'processing' => 'badge-info',
                                        'cancelled' => 'badge-danger',
                                        default => 'badge-warning',
                                    };
                                    $statusLabel = match($statusPesanan) {
                                        'selesai', 'completed', 'done' => 'Selesai',
                                        'pending' => 'Menunggu',
                                        'processing' => 'Diproses',
                                        'cancelled' => 'Dibatalkan',
                                        default => ucfirst($statusPesanan),
                                    };
                                @endphp
                                <tr>
                                    <td><span class="order-id">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                                    <td>
                                        <strong>{{ $order->nama_lengkap ?? '-' }}</strong>
                                        @if(!empty($order->no_telepon))
                                            <div style="font-size:0.75rem; color:#059669;">
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->no_telepon) }}" target="_blank" style="color:#059669; text-decoration:none;">📱 {{ $order->no_telepon }}</a>
                                            </div>
                                        @endif
                                        @if(!empty($order->email))
                                            <small class="table-subtext" style="display:block; color:#9ca3af;">{{ $order->email }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span title="{{ $order->alamat_pengiriman ?? '-' }}" style="font-size:0.82rem; color:#475569; display:inline-block; max-width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                            📍 {{ $order->alamat_pengiriman ?? '-' }}
                                        </span>
                                    </td>
                                    <td><span style="font-size:0.85rem; font-weight:500;">{{ Str::limit($order->produk_list ?? '-', 40) }}</span></td>
                                    <td><span style="font-size:0.82rem; color:#6b7280; text-transform:uppercase; font-weight:600;">{{ $order->metode_pembayaran ?? '-' }}</span></td>
                                    <td><strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
                                    <td><span class="status-badge {{ $badgeClass }}">{{ $statusLabel }}</span></td>
                                    <td style="font-size:0.82rem; color:#6b7280;">{{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('d/m H:i') }}</td>
                                    <td style="text-align:center;">
                                        <div style="display:flex; gap:6px; justify-content:center; align-items:center;">
                                            @if($statusPesanan === 'pending' || $statusPesanan === 'menunggu')
                                                <form method="POST" action="{{ route('orders.update-status', $order->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="processing">
                                                    <button type="submit" style="background:#0284c7; color:#fff; border:none; border-radius:6px; padding:5px 8px; font-size:0.75rem; cursor:pointer;">Proses</button>
                                                </form>
                                            @elseif($statusPesanan === 'processing')
                                                <form method="POST" action="{{ route('orders.update-status', $order->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="dikirim">
                                                    <button type="submit" style="background:#f59e0b; color:#fff; border:none; border-radius:6px; padding:5px 8px; font-size:0.75rem; cursor:pointer;">Kirim</button>
                                                </form>
                                            @elseif($statusPesanan === 'dikirim')
                                                <form method="POST" action="{{ route('orders.update-status', $order->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="selesai">
                                                    <button type="submit" style="background:#059669; color:#fff; border:none; border-radius:6px; padding:5px 8px; font-size:0.75rem; cursor:pointer;">Selesai</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" style="text-align:center; padding: 40px; color:#9ca3af;">
                                        <div style="font-size:2rem; margin-bottom:8px;">🍦</div>
                                        <strong>Belum ada pesanan masuk</strong>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            @elseif ($feature === 'customers')
                <section class="metric-grid feature-metrics">
                    <article class="metric-card metric-pink"><span class="metric-label">Total Pelanggan</span><strong class="metric-value">{{ $stats['customers_count'] }}</strong><div class="metric-badge badge-positive">Terdaftar</div></article>
                    <article class="metric-card metric-emerald"><span class="metric-label">Pelanggan Aktif</span><strong class="metric-value">{{ $stats['customers_count'] }}</strong><div class="metric-badge badge-positive">Bulan ini</div></article>
                    <article class="metric-card metric-amber"><span class="metric-label">Pesanan Aktif</span><strong class="metric-value">{{ $stats['total_orders'] }}</strong><div class="metric-badge badge-warning">Transaksi</div></article>
                </section>
                <section class="dashboard-panel feature-table-panel">
                    <header class="panel-header-flex">
                        <div><h2>Daftar Pelanggan</h2><p class="panel-subtext">Basis data pelanggan Scoops & delicios</p></div>
                        <button class="dashboard-button primary" type="button">+ Tambah Pelanggan</button>
                    </header>
                    <div class="recent-table-wrap">
                        <table class="recent-orders-table">
                            <thead><tr><th>NAMA PELANGGAN</th><th>EMAIL / KONTAK</th><th>TOTAL PESANAN</th><th>STATUS</th></tr></thead>
                            <tbody>
                                <tr><td><strong>Ahmad Ridho</strong></td><td>ahmad.ridho@email.com<br>081234567890</td><td>15 Pesanan</td><td><span class="status-badge badge-success">Aktif</span></td></tr>
                                <tr><td><strong>Siti Aminah</strong></td><td>siti.aminah@email.com<br>089876543210</td><td>8 Pesanan</td><td><span class="status-badge badge-success">Aktif</span></td></tr>
                                <tr><td><strong>Budi Santoso</strong></td><td>budi.s@email.com<br>081122334455</td><td>2 Pesanan</td><td><span class="status-badge badge-warning">Jarang</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            @elseif ($feature === 'reports')
                <section class="metric-grid feature-metrics">
                    <article class="metric-card metric-pink"><span class="metric-label">Pendapatan Bulan Ini</span><strong class="metric-value">Rp 15.420.000</strong><div class="metric-badge badge-positive">+8.5% dari bulan lalu</div></article>
                    <article class="metric-card metric-emerald"><span class="metric-label">Total Ember Terjual</span><strong class="metric-value">342</strong><div class="metric-badge badge-positive">+12% dari bulan lalu</div></article>
                    <article class="metric-card metric-amber"><span class="metric-label">Rata-rata Penjualan/Hari</span><strong class="metric-value">Rp 514.000</strong><div class="metric-badge badge-positive">Sesuai target</div></article>
                </section>
                <section class="dashboard-panel feature-table-panel">
                    <header class="panel-header-flex">
                        <div><h2>Laporan Penjualan Terlaris</h2><p class="panel-subtext">Produk es krim emberan paling diminati</p></div>
                        <button class="dashboard-button outline" type="button" style="border: 1px solid #ccc; padding: 8px 16px; border-radius: 6px; cursor: pointer; background: white;">Unduh Laporan (PDF)</button>
                    </header>
                    <div class="recent-table-wrap">
                        <table class="recent-orders-table">
                            <thead><tr><th>PERINGKAT</th><th>NAMA PRODUK</th><th>KATEGORI</th><th>TERJUAL</th><th>PENDAPATAN</th></tr></thead>
                            <tbody>
                                <tr><td>#1</td><td><strong>Vanilla Bean Extra</strong></td><td>Klasik</td><td>120 ember</td><td>Rp 6.000.000</td></tr>
                                <tr><td>#2</td><td><strong>Dark Choco Fudge</strong></td><td>Premium</td><td>95 ember</td><td>Rp 5.700.000</td></tr>
                                <tr><td>#3</td><td><strong>Strawberry Dream</strong></td><td>Klasik</td><td>84 ember</td><td>Rp 4.200.000</td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            @elseif ($feature === 'settings')
                <section class="dashboard-panel form-panel">
                    <header class="panel-header-flex">
                        <div><h2>Pengaturan Toko</h2><p class="panel-subtext">Ubah profil dan konfigurasi toko Scoops & delicios</p></div>
                    </header>
                    <form class="settings-form" style="padding: 24px;">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Nama Toko</label>
                            <input type="text" value="Scoops & delicios" style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-family: inherit;">
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Alamat Toko</label>
                            <textarea style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-family: inherit; resize: vertical;" rows="3">Jl. Es Krim Manis No. 123, Jakarta</textarea>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Kontak (Email / Telepon)</label>
                            <input type="text" value="halo@scoopsanddelicios.com / 021-9876543" style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-family: inherit;">
                        </div>
                        <div style="margin-bottom: 24px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Pajak Penjualan (%)</label>
                            <input type="number" value="11" style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-family: inherit;">
                        </div>
                        <button type="button" class="dashboard-button primary" style="padding: 10px 24px;">Simpan Pengaturan</button>
                    </form>
                </section>
            @endif
        </main>
    </div>
</body>
</html>
