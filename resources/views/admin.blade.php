<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel | Scoops &amp; delicios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-page admin-dashboard">
    <div class="dashboard-shell">
        <aside class="dashboard-sidebar">
            <div class="dashboard-brand">
                <div class="dashboard-brand-mark">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 14 4-4"/>
                        <path d="M3.34 19a10 10 0 1 1 17.32 0"/>
                        <path d="M12 2v2"/>
                    </svg>
                </div>
                <div>
                    <strong>Scoops &amp; delicios</strong>
                    <small>Admin Panel</small>
                </div>
            </div>

            <nav class="dashboard-nav">
                <a class="dashboard-nav-link active" href="#dashboard-home" data-admin-view="dashboard-home">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="7" height="9" x="3" y="3" rx="1"/>
                        <rect width="7" height="5" x="14" y="3" rx="1"/>
                        <rect width="7" height="9" x="14" y="12" rx="1"/>
                        <rect width="7" height="5" x="3" y="16" rx="1"/>
                    </svg>
                    <span>Dasbor</span>
                </a>
                <a class="dashboard-nav-link" href="#inventory" data-admin-view="inventory">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7.5 4.27 9 5.15"/>
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                        <path d="m3.3 7 8.7 5 8.7-5"/>
                        <path d="M12 12v9.5"/>
                    </svg>
                    <span>Inventaris Produk</span>
                </a>
                <a class="dashboard-nav-link" href="#orders" data-admin-view="orders">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="8" cy="21" r="1"/>
                        <circle cx="19" cy="21" r="1"/>
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                    </svg>
                    <span>Pesanan</span>
                    <span class="admin-badge-count" id="adminSidebarBadge" style="margin-left:auto; background:#F43F5E; color:#fff; font-size:0.75rem; font-weight:700; padding:2px 8px; border-radius:99px; {{ ($stats['pending_orders'] ?? 0) > 0 ? '' : 'display:none;' }}">{{ $stats['pending_orders'] ?? 0 }}</span>
                </a>
                <a class="dashboard-nav-link" href="#customers" data-admin-view="customers">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <span>Pelanggan</span>
                </a>
                <a class="dashboard-nav-link" href="#reports" data-admin-view="reports">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" x2="12" y1="20" y2="10"/>
                        <line x1="18" x2="18" y1="20" y2="4"/>
                        <line x1="6" x2="6" y1="20" y2="16"/>
                    </svg>
                    <span>Laporan</span>
                </a>
                <a class="dashboard-nav-link" href="#settings" data-admin-view="settings">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.38a2 2 0 0 0-.73-2.73l-.15-.1a2 2 0 0 1-1-1.72v-.51a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <span>Pengaturan</span>
                </a>
            </nav>

            <a class="sidebar-primary-action" href="{{ route('cashier.dashboard') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="8" cy="21" r="1"/>
                    <circle cx="19" cy="21" r="1"/>
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                </svg>
                <span>Terminal Kasir POS</span>
            </a>

            <form class="sidebar-logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" x2="9" y1="12" y2="12"/>
                    </svg>
                    <span>Keluar Account</span>
                </button>
            </form>
        </aside>

        <main class="dashboard-content">
            <header class="dashboard-topbar admin-dashboard-view" id="dashboard-home">
                <div class="topbar-title-wrap">
                    <h1>Ringkasan Operasional</h1>
                    <p>Berikut adalah data aktivitas dan performa toko Scoops &amp; delicios hari ini.</p>
                </div>
                <div class="dashboard-top-actions">
                    <button class="dashboard-button primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" x2="8" y1="13" y2="13"/>
                            <line x1="16" x2="8" y1="17" y2="17"/>
                            <line x1="10" x2="8" y1="9" y2="9"/>
                        </svg>
                        <span>Buat Laporan</span>
                    </button>
                    <button class="dashboard-button secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                            <path d="M3 3v5h5"/>
                            <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/>
                            <path d="M16 21h5v-5"/>
                        </svg>
                        <span>Perbarui Stok</span>
                    </button>
                </div>
            </header>

            <section class="metric-grid admin-dashboard-view">
                <article class="metric-card metric-pink">
                    <div class="metric-header">
                        <span class="metric-label">Pendapatan Hari Ini</span>
                        <div class="metric-icon-wrap icon-pink">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" x2="12" y1="2" y2="22"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </div>
                    </div>
                    <strong class="metric-value">Rp {{ number_format($stats['today_revenue'], 0, ',', '.') }}</strong>
                    <div class="metric-badge badge-positive">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                            <polyline points="17 6 23 6 23 12"/>
                        </svg>
                        <span>{{ $stats['today_orders'] > 0 ? $stats['today_orders'] . ' transaksi hari ini' : 'Total akumulasi omzet' }}</span>
                    </div>
                </article>

                <article class="metric-card metric-emerald">
                    <div class="metric-header">
                        <span class="metric-label">Total Pesanan</span>
                        <div class="metric-icon-wrap icon-emerald">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="8" cy="21" r="1"/>
                                <circle cx="19" cy="21" r="1"/>
                                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                            </svg>
                        </div>
                    </div>
                    <strong class="metric-value">{{ $stats['total_orders'] }}</strong>
                    <div class="metric-badge {{ $stats['pending_orders'] > 0 ? 'badge-warning' : 'badge-positive' }}">
                        <span>{{ $stats['pending_orders'] }} pesanan menunggu</span>
                    </div>
                </article>

                <article class="metric-card metric-amber">
                    <div class="metric-header">
                        <span class="metric-label">Produk Stok Rendah</span>
                        <div class="metric-icon-wrap icon-amber">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                                <line x1="12" x2="12" y1="9" y2="13"/>
                                <line x1="12" x2="12.01" y1="17" y2="17"/>
                            </svg>
                        </div>
                    </div>
                    <strong class="metric-value">{{ $stats['low_stock_count'] }} <em class="metric-unit">item</em></strong>
                    <div class="metric-badge {{ $stats['low_stock_count'] > 0 ? 'badge-warning' : 'badge-positive' }}">
                        <span>{{ $stats['low_stock_count'] > 0 ? '⚠ Perlu restock' : '✓ Stok aman' }}</span>
                    </div>
                </article>

                <article class="metric-card metric-blue">
                    <div class="metric-header">
                        <span class="metric-label">Total Pelanggan</span>
                        <div class="metric-icon-wrap icon-blue">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <line x1="19" x2="19" y1="8" y2="14"/>
                                <line x1="22" x2="16" y1="11" y2="11"/>
                            </svg>
                        </div>
                    </div>
                    <strong class="metric-value">{{ $stats['customers_count'] }}</strong>
                    <div class="metric-badge badge-info">
                        <span>Akun pelanggan terdaftar</span>
                    </div>
                </article>
            </section>

            <section class="dashboard-middle-grid admin-dashboard-view">
                <article class="dashboard-panel sales-panel">
                    <header class="panel-header-flex">
                        <div>
                            <h2>Tren Penjualan Mingguan</h2>
                            <p class="panel-subtext">Statistik grafik estimasi transaksi 7 hari terakhir</p>
                        </div>
                        <div class="chart-toggle-group">
                            <button class="chart-pill active">Minggu Ini</button>
                            <button class="chart-pill">Bulan Ini</button>
                        </div>
                    </header>
                    
                    <div class="sales-chart-wrapper">
                        <svg class="sales-chart-svg" viewBox="0 0 600 180" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#882D4B" stop-opacity="0.25"/>
                                    <stop offset="100%" stop-color="#882D4B" stop-opacity="0.0"/>
                                </linearGradient>
                            </defs>
                            <!-- Grid lines -->
                            <line x1="0" y1="30" x2="600" y2="30" stroke="#F1F5F9" stroke-dasharray="4 4" stroke-width="1"/>
                            <line x1="0" y1="75" x2="600" y2="75" stroke="#F1F5F9" stroke-dasharray="4 4" stroke-width="1"/>
                            <line x1="0" y1="120" x2="600" y2="120" stroke="#F1F5F9" stroke-dasharray="4 4" stroke-width="1"/>
                            <line x1="0" y1="160" x2="600" y2="160" stroke="#E2E8F0" stroke-width="1"/>
                            
                            <!-- Area fill -->
                            <polygon points="30,140 115,110 200,125 285,70 370,85 455,35 540,55 540,160 30,160" fill="url(#chartGradient)" />
                            
                            <!-- Line path -->
                            <path d="M 30 140 Q 72.5 125, 115 110 T 200 125 T 285 70 T 370 85 T 455 35 T 540 55" 
                                  fill="none" stroke="#882D4B" stroke-width="3.5" stroke-linecap="round"/>
                            
                            <!-- Data dots -->
                            <circle cx="30" cy="140" r="4" fill="#FFFFFF" stroke="#882D4B" stroke-width="3"/>
                            <circle cx="115" cy="110" r="4" fill="#FFFFFF" stroke="#882D4B" stroke-width="3"/>
                            <circle cx="200" cy="125" r="4" fill="#FFFFFF" stroke="#882D4B" stroke-width="3"/>
                            <circle cx="285" cy="70" r="4" fill="#FFFFFF" stroke="#882D4B" stroke-width="3"/>
                            <circle cx="370" cy="85" r="4" fill="#FFFFFF" stroke="#882D4B" stroke-width="3"/>
                            <circle cx="455" cy="35" r="6" fill="#882D4B" stroke="#FFFFFF" stroke-width="2"/>
                            <circle cx="540" cy="55" r="4" fill="#FFFFFF" stroke="#882D4B" stroke-width="3"/>
                        </svg>

                        <!-- Chart Tooltip overlay -->
                        <div class="chart-tooltip" style="left: 72%; top: 12%;">
                            <strong>Sabtu</strong>
                            <span>Rp 1.850.000</span>
                        </div>

                        <!-- Days Labels -->
                        <div class="chart-day-labels">
                            <span>Sen</span>
                            <span>Sel</span>
                            <span>Rab</span>
                            <span>Kam</span>
                            <span>Jum</span>
                            <span class="active-day">Sab</span>
                            <span>Min</span>
                        </div>
                    </div>
                </article>

                <article class="dashboard-panel quick-panel">
                    <h2>Aksi Cepat</h2>
                    <p class="panel-subtext">Pintasan navigasi &amp; fitur utama</p>
                    
                    <div class="quick-actions-list">
                        <a href="{{ route('products.create') }}" class="quick-link primary">
                            <div class="quick-link-left">
                                <div class="quick-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                </div>
                                <span>Tambah Produk Baru</span>
                            </div>
                            <svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>

                        <a href="#reports" class="quick-link emerald">
                            <div class="quick-link-left">
                                <div class="quick-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                </div>
                                <span>Buat Laporan Penjualan</span>
                            </div>
                            <svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>

                        <a href="#inventory" class="quick-link amber">
                            <div class="quick-link-left">
                                <div class="quick-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                    </svg>
                                </div>
                                <span>Perbarui Stok Gelato</span>
                            </div>
                            <svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                    </div>
                </article>
            </section>

            <section class="dashboard-panel inventory-panel admin-dashboard-view" id="inventory">
                <header class="panel-header-row">
                    <div>
                        <h2>Kelola Produk Gelato</h2>
                        <p class="panel-subtext">Manajemen inventaris, varian rasa, harga, dan ketersediaan stok toko.</p>
                    </div>
                    <a href="{{ route('products.create') }}" class="dashboard-button primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        <span>Tambah Produk</span>
                    </a>
                </header>

                <div class="inventory-table-wrap">
                    <table class="inventory-table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="product-name-cell">
                                        @if($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-thumb">
                                        @else
                                            <div class="product-thumb-placeholder">🍨</div>
                                        @endif
                                        <div>
                                            <strong>{{ $product->name }}</strong>
                                            @if($product->description)
                                                <small class="product-desc-truncate">{{ Str::limit($product->description, 40) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td><span class="category-tag">{{ ucfirst(str_replace('-', ' ', $product->category)) }}</span></td>
                                    <td><strong class="stock-num {{ $product->stock <= 5 ? 'low-stock' : '' }}">{{ $product->stock }} item</strong></td>
                                    <td class="price-cell">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="status-badge {{ $product->status === 'available' ? 'badge-success' : ($product->status === 'low_stock' ? 'badge-warning' : 'badge-danger') }}">
                                            @if($product->status === 'available')
                                                Tersedia
                                            @elseif($product->status === 'low_stock')
                                                Stok Rendah
                                            @else
                                                Habis
                                            @endif
                                        </span>
                                    </td>
                                    <td class="table-actions">
                                        <a href="{{ route('products.edit', $product) }}" class="action-btn edit" title="Edit Produk">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9"/>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                            </svg>
                                            <span>Edit</span>
                                        </a>
                                        <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Hapus produk {{ $product->name }}?')" class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Hapus Produk">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"/>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty-products-cell">
                                        <div class="empty-state-box">
                                            <div class="empty-state-icon">🍦</div>
                                            <h3>Belum ada produk gelato</h3>
                                            <p>Daftar inventaris masih kosong. Klik tombol di bawah untuk membuat menu gelato baru.</p>
                                            <a href="{{ route('products.create') }}" class="dashboard-button primary inline-btn">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                    <line x1="12" y1="5" x2="12" y2="19"/>
                                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                                </svg>
                                                <span>Tambah Produk Pertama</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="dashboard-panel recent-panel admin-dashboard-view" id="orders">
                <header class="panel-header-flex">
                    <div>
                        <h2>Pesanan Masuk dari Pelanggan</h2>
                        <p class="panel-subtext">Semua transaksi pesanan es krim online yang masuk ke toko</p>
                    </div>
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <button type="button" class="dashboard-button secondary" onclick="refreshAdminOrders()" id="btnRefreshAdminOrders" style="padding: 7px 14px; font-size: 0.85rem; border-radius: 8px;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                                <path d="M3 3v5h5"/>
                                <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/>
                                <path d="M16 21h5v-5"/>
                            </svg>
                            <span>Segarkan Pesanan</span>
                        </button>
                        <span style="color: #6b7280; font-size: 0.85rem;" id="adminTotalOrdersText">Total: {{ count($orders) }} pesanan</span>
                    </div>
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
                                <th>STATUS</th>
                                <th>TOTAL</th>
                                <th>WAKTU</th>
                                <th style="text-align: center;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="adminOrdersTableBody">
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
                                $initials = collect(explode(' ', $order->nama_lengkap ?? 'U'))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
                                $avatarColors = ['', 'avatar-purple', 'avatar-amber', 'avatar-emerald'];
                                $avatarClass = $avatarColors[$order->id % 4];
                            @endphp
                            <tr id="admin-order-row-{{ $order->id }}">
                                <td><span class="order-id">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                                <td>
                                    <div class="customer-cell">
                                        <div class="avatar-circle {{ $avatarClass }}">{{ $initials }}</div>
                                        <div>
                                            <strong>{{ $order->nama_lengkap ?? '-' }}</strong>
                                            @if(!empty($order->no_telepon))
                                                <small style="display:block; color:#059669; font-size:0.75rem;">
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->no_telepon) }}" target="_blank" style="color:#059669; text-decoration:none;">📱 {{ $order->no_telepon }}</a>
                                                </small>
                                            @endif
                                            @if(!empty($order->email))
                                                <small style="display:block; color:#9ca3af; font-size:0.72rem;">{{ $order->email }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span title="{{ $order->alamat_pengiriman ?? '-' }}" style="font-size:0.82rem; color:#475569; display:inline-block; max-width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                        📍 {{ $order->alamat_pengiriman ?? '-' }}
                                    </span>
                                </td>
                                <td><span class="product-item-name" style="font-weight: 500;">{{ Str::limit($order->produk_list ?? '-', 40) }}</span></td>
                                <td><span style="font-size:0.82rem; color:#6b7280; text-transform:uppercase; font-weight:600;">{{ $order->metode_pembayaran ?? '-' }}</span></td>
                                <td><span class="status-badge {{ $badgeClass }}" id="admin-status-badge-{{ $order->id }}">{{ $statusLabel }}</span></td>
                                <td><strong class="order-amount">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
                                <td style="font-size:0.82rem; color:#6b7280;">{{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('d/m H:i') }}</td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 6px; justify-content: center; align-items: center;">
                                        <button class="action-btn edit" type="button" style="padding: 5px 10px; font-size: 0.78rem;" onclick='openAdminOrderDetail(@json($order))'>
                                            <span>Detail</span>
                                        </button>
                                        @if($statusPesanan === 'pending' || $statusPesanan === 'menunggu')
                                            <button type="button" style="background:#0284c7; color:#fff; border:none; border-radius:6px; padding:5px 8px; font-size:0.75rem; cursor:pointer;" onclick="updateAdminOrderStatus({{ $order->id }}, 'diproses')">Proses</button>
                                        @elseif($statusPesanan === 'processing' || $statusPesanan === 'diproses')
                                            <button type="button" style="background:#f59e0b; color:#fff; border:none; border-radius:6px; padding:5px 8px; font-size:0.75rem; cursor:pointer;" onclick="updateAdminOrderStatus({{ $order->id }}, 'dikirim')">Kirim</button>
                                        @elseif($statusPesanan === 'dikirim')
                                            <button type="button" style="background:#059669; color:#fff; border:none; border-radius:6px; padding:5px 8px; font-size:0.75rem; cursor:pointer;" onclick="updateAdminOrderStatus({{ $order->id }}, 'selesai')">Selesai</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr id="adminEmptyOrdersRow">
                                <td colspan="9" style="text-align:center; padding: 40px; color: #9ca3af;">
                                    <div style="font-size: 2rem; margin-bottom: 8px;">🍦</div>
                                    <strong>Belum ada pesanan masuk</strong>
                                    <p style="margin-top: 4px; font-size: 0.85rem;">Pesanan dari pelanggan akan muncul di sini secara otomatis.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="dashboard-panel admin-dashboard-view admin-feature-preview" id="customers">
                <header class="panel-header-flex"><div><h2>Ringkasan Pelanggan</h2><p class="panel-subtext">Pelanggan aktif dan pertumbuhan terbaru</p></div><button class="dashboard-button secondary" type="button">Unduh Data</button></header>
                <div class="feature-summary-grid"><div><span>Total Pelanggan</span><strong>{{ $stats['customers_count'] }}</strong><small class="feature-trend positive">Aktif terdaftar</small></div><div><span>Pelanggan Aktif</span><strong>{{ $stats['customers_count'] }}</strong><small class="feature-trend positive">Bulan ini</small></div><div><span>Pembelian Berulang</span><strong>72%</strong><small class="feature-trend">Pelanggan loyal</small></div></div>
            </section>

            <section class="dashboard-panel admin-dashboard-view admin-feature-preview" id="reports">
                <header class="panel-header-flex"><div><h2>Laporan Penjualan</h2><p class="panel-subtext">Ringkasan performa toko Scoops &amp; delicios</p></div></header>
                <div class="feature-summary-grid"><div><span>Total Omzet</span><strong>Rp {{ number_format($stats['today_revenue'], 0, ',', '.') }}</strong><small class="feature-trend positive">Akumulasi penjualan</small></div><div><span>Total Transaksi</span><strong>{{ $stats['total_orders'] }}</strong><small class="feature-trend positive">Pesanan masuk</small></div><div><span>Pesanan Menunggu</span><strong>{{ $stats['pending_orders'] }}</strong><small class="feature-trend">Perlu diproses</small></div></div>
            </section>

            <section class="dashboard-panel admin-dashboard-view admin-feature-preview" id="settings">
                <header class="panel-header-flex"><div><h2>Pengaturan Toko</h2><p class="panel-subtext">Preferensi operasional Scoops &amp; delicios</p></div><button class="dashboard-button primary" type="button">Simpan Perubahan</button></header>
                <div class="settings-card-grid"><div class="settings-card"><span class="settings-card-icon">T</span><strong>Informasi Toko</strong><p>Scoops &amp; delicios</p><small>Jl. Rasa Manis No. 12</small><button type="button">Edit informasi</button></div><div class="settings-card"><span class="settings-card-icon green">N</span><strong>Notifikasi Pesanan</strong><p>Terima pemberitahuan pesanan baru</p><label class="toggle-control"><input type="checkbox" checked><span></span>Aktif</label></div><div class="settings-card"><span class="settings-card-icon blue">P</span><strong>Pembayaran</strong><p>QRIS, Tunai, E-Wallet</p><button type="button">Kelola metode</button></div></div>
            </section>
        </main>
    </div>

    <!-- ADMIN ORDER DETAIL MODAL -->
    <div class="modal-backdrop" id="adminOrderDetailModal" onclick="closeAdminOrderDetail(event)">
        <div class="payment-modal-box" style="max-width: 600px; width: 95%; max-height: 90vh; overflow-y: auto;" onclick="event.stopPropagation()">
            <header class="modal-header">
                <div>
                    <h3 id="aModalOrderTitle">Detail Pesanan #ORD-0000</h3>
                    <p style="margin: 4px 0 0; font-size: 0.8rem; color: #64748b;" id="aModalOrderMeta">-</p>
                </div>
                <button class="modal-close-btn" type="button" onclick="closeAdminOrderDetail()">&times;</button>
            </header>
            <div class="modal-body" style="padding: 20px;">
                <!-- Customer info card -->
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                        <div>
                            <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; font-weight: 700;">Pelanggan</span>
                            <h4 style="margin: 2px 0 0; font-size: 1rem; color: #0F172A;" id="aModalCustomerName">-</h4>
                        </div>
                        <span class="status-badge" id="aModalStatusBadge">Menunggu</span>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr; gap: 6px; font-size: 0.85rem; color: #334155;">
                        <div id="aModalPhoneRow">📱 Telepon / WhatsApp: <a href="#" id="aModalPhoneLink" target="_blank" style="color: #059669; font-weight: 600; text-decoration: none;">-</a></div>
                        <div id="aModalAddressRow">📍 Alamat Pengiriman: <strong id="aModalAddress">-</strong></div>
                        <div>💳 Metode Pembayaran: <strong id="aModalPaymentMethod">Cash</strong></div>
                    </div>
                </div>

                <!-- Products table -->
                <h4 style="font-size: 0.9rem; margin: 0 0 10px; color: #334155;">Rincian Es Krim yang Dipesan:</h4>
                <div style="border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; margin-bottom: 16px;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                        <thead style="background: #F1F5F9; color: #475569;">
                            <tr>
                                <th style="padding: 10px 12px; text-align: left;">Item</th>
                                <th style="padding: 10px 12px; text-align: center;">Qty</th>
                                <th style="padding: 10px 12px; text-align: right;">Harga</th>
                                <th style="padding: 10px 12px; text-align: right;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="aModalItemsTableBody">
                            <!-- Populated dynamically -->
                        </tbody>
                        <tfoot style="background: #F8FAFC; border-top: 1px solid #E2E8F0; font-weight: 700;">
                            <tr>
                                <td colspan="3" style="padding: 10px 12px; text-align: right;">Total Pesanan:</td>
                                <td style="padding: 10px 12px; text-align: right; color: #E11D48;" id="aModalGrandTotal">Rp 0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Status Action Buttons -->
                <div style="padding: 14px; background: #FFF1F2; border: 1px solid #FFE4E6; border-radius: 12px;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9F1239; text-transform: uppercase; margin-bottom: 8px;">Ubah Status Pesanan Ini:</label>
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <button type="button" class="dashboard-button" style="background: #F59E0B; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromAdminModal('pending')">⏳ Menunggu</button>
                        <button type="button" class="dashboard-button" style="background: #0284C7; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromAdminModal('diproses')">⚡ Diproses</button>
                        <button type="button" class="dashboard-button" style="background: #8B5CF6; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromAdminModal('dikirim')">🛵 Diantar</button>
                        <button type="button" class="dashboard-button" style="background: #059669; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromAdminModal('selesai')">✅ Selesai</button>
                        <button type="button" class="dashboard-button" style="background: #EF4444; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromAdminModal('dibatalkan')">❌ Batalkan</button>
                    </div>
                </div>
            </div>

            <footer class="modal-footer">
                <button class="secondary-btn" type="button" onclick="closeAdminOrderDetail()">Tutup</button>
            </footer>
        </div>
    </div>

    <script>
        let currentAdminViewingOrder = null;

        document.addEventListener('DOMContentLoaded', function() {
            const dashboardNavLinks = document.querySelectorAll('.dashboard-nav-link');
            const views = document.querySelectorAll('.admin-dashboard-view');
            
            // By default on initial load: show dashboard overview (which includes recent orders!)
            views.forEach(view => {
                view.hidden = ['inventory', 'customers', 'reports', 'settings'].includes(view.id);
            });

            dashboardNavLinks.forEach(link => link.addEventListener('click', function(e) {
                const viewId = this.dataset.adminView;
                if (!viewId) {
                    return;
                }

                e.preventDefault();
                if (viewId === 'dashboard-home') {
                    views.forEach(view => { 
                        view.hidden = !['dashboard-home', 'orders'].includes(view.id) && view.id !== ''; 
                    });
                } else if (viewId === 'orders') {
                    views.forEach(view => { 
                        view.hidden = view.id !== 'orders'; 
                    });
                } else {
                    views.forEach(view => { 
                        view.hidden = view.id !== viewId; 
                    });
                }
                dashboardNavLinks.forEach(item => item.classList.toggle('active', item === this));
            }));

            // Live polling every 12 seconds
            setInterval(refreshAdminOrders, 12000);
        });

        function openAdminOrderDetail(order) {
            currentAdminViewingOrder = order;
            document.getElementById('aModalOrderTitle').innerText = 'Detail Pesanan #ORD-' + String(order.id).padStart(4, '0');
            document.getElementById('aModalOrderMeta').innerText = 'Waktu Pesanan: ' + (order.tanggal_pesanan || '-') + ' WIB';
            document.getElementById('aModalCustomerName').innerText = order.nama_lengkap || 'Pelanggan';

            const phoneLink = document.getElementById('aModalPhoneLink');
            if (order.no_telepon) {
                const cleanPhone = String(order.no_telepon).replace(/[^0-9]/g, '');
                phoneLink.innerText = order.no_telepon;
                phoneLink.href = 'https://wa.me/' + cleanPhone;
                phoneLink.parentElement.style.display = 'block';
            } else {
                phoneLink.parentElement.style.display = 'none';
            }

            document.getElementById('aModalAddress').innerText = order.alamat_pengiriman || '-';
            document.getElementById('aModalPaymentMethod').innerText = (order.metode_pembayaran || 'Cash').toUpperCase();

            const badge = document.getElementById('aModalStatusBadge');
            const status = (order.status_pesanan || 'pending').toLowerCase();
            badge.className = 'status-badge ' + (status === 'selesai' || status === 'completed' ? 'badge-success' : (status === 'processing' ? 'badge-info' : (status === 'cancelled' ? 'badge-danger' : 'badge-warning')));
            badge.innerText = status === 'selesai' || status === 'completed' ? 'Selesai' : (status === 'processing' ? 'Diproses' : (status === 'cancelled' ? 'Dibatalkan' : 'Menunggu'));

            // Render Items
            const itemsTbody = document.getElementById('aModalItemsTableBody');
            if (order.items && order.items.length > 0) {
                itemsTbody.innerHTML = order.items.map(item => `
                    <tr style="border-bottom: 1px solid #F1F5F9;">
                        <td style="padding: 8px 12px;"><strong>${item.product_name || 'Es Krim'}</strong></td>
                        <td style="padding: 8px 12px; text-align: center;">${item.jumlah}</td>
                        <td style="padding: 8px 12px; text-align: right;">Rp ${Number(item.harga_satuan).toLocaleString('id-ID')}</td>
                        <td style="padding: 8px 12px; text-align: right;">Rp ${(Number(item.harga_satuan) * Number(item.jumlah)).toLocaleString('id-ID')}</td>
                    </tr>
                `).join('');
            } else {
                itemsTbody.innerHTML = `
                    <tr>
                        <td colspan="4" style="padding: 10px 12px; color: #64748b;">${order.produk_list || 'Menu Es Krim'}</td>
                    </tr>
                `;
            }

            document.getElementById('aModalGrandTotal').innerText = 'Rp ' + Number(order.total_harga).toLocaleString('id-ID');
            document.getElementById('adminOrderDetailModal').classList.add('show');
        }

        function closeAdminOrderDetail(e) {
            document.getElementById('adminOrderDetailModal').classList.remove('show');
        }

        async function updateAdminOrderStatus(orderId, newStatus) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            try {
                const response = await fetch(`/orders/${orderId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ status: newStatus })
                });
                const data = await response.json();
                if (response.ok && data.success) {
                    refreshAdminOrders();
                } else {
                    alert(data.message || 'Gagal mengubah status pesanan.');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan jaringan.');
            }
        }

        async function updateOrderStatusFromAdminModal(newStatus) {
            if (!currentAdminViewingOrder) return;
            await updateAdminOrderStatus(currentAdminViewingOrder.id, newStatus);
            closeAdminOrderDetail();
        }

        async function refreshAdminOrders() {
            const btn = document.getElementById('btnRefreshAdminOrders');
            if (btn) btn.style.opacity = '0.5';

            try {
                const response = await fetch('/orders/latest', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) return;
                const data = await response.json();
                renderAdminOrdersTable(data.orders);

                // Update badge & totals
                const badge = document.getElementById('adminSidebarBadge');
                if (badge) {
                    badge.innerText = data.pending_count || 0;
                    badge.style.display = data.pending_count > 0 ? 'inline-block' : 'none';
                }
                const totalText = document.getElementById('adminTotalOrdersText');
                if (totalText) totalText.innerText = 'Total: ' + (data.total || 0) + ' pesanan';

            } catch (err) {
                console.error('Error refreshing admin orders:', err);
            } finally {
                if (btn) btn.style.opacity = '1';
            }
        }

        function renderAdminOrdersTable(orders) {
            const tbody = document.getElementById('adminOrdersTableBody');
            if (!tbody) return;

            if (!orders || orders.length === 0) {
                tbody.innerHTML = `
                    <tr id="adminEmptyOrdersRow">
                        <td colspan="9" style="text-align:center; padding: 40px; color: #9ca3af;">
                            <div style="font-size: 2rem; margin-bottom: 8px;">🍦</div>
                            <strong>Belum ada pesanan masuk</strong>
                            <p style="margin-top: 4px; font-size: 0.85rem;">Pesanan dari pelanggan akan muncul di sini secara otomatis.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            const avatarColors = ['', 'avatar-purple', 'avatar-amber', 'avatar-emerald'];

            tbody.innerHTML = orders.map(order => {
                const status = (order.status_pesanan || 'pending').toLowerCase();
                const isDone = ['selesai', 'completed', 'done'].includes(status);
                const isProcessing = ['processing', 'diproses'].includes(status);
                const isCancelled = ['cancelled', 'dibatalkan'].includes(status);
                const badgeClass = isDone ? 'badge-success' : (isProcessing ? 'badge-info' : (isCancelled ? 'badge-danger' : 'badge-warning'));
                const statusLabel = isDone ? 'Selesai' : (isProcessing ? 'Diproses' : (isCancelled ? 'Dibatalkan' : 'Menunggu'));
                const initials = (order.nama_lengkap || 'U').split(' ').map(w => w[0]?.toUpperCase()).slice(0, 2).join('');
                const avatarClass = avatarColors[order.id % 4];
                const orderJson = JSON.stringify(order).replace(/'/g, "&#39;");

                let quickBtn = '';
                if (status === 'pending' || status === 'menunggu') {
                    quickBtn = `<button type="button" style="background:#0284c7; color:#fff; border:none; border-radius:6px; padding:5px 8px; font-size:0.75rem; cursor:pointer;" onclick="updateAdminOrderStatus(${order.id}, 'diproses')">Proses</button>`;
                } else if (isProcessing) {
                    quickBtn = `<button type="button" style="background:#f59e0b; color:#fff; border:none; border-radius:6px; padding:5px 8px; font-size:0.75rem; cursor:pointer;" onclick="updateAdminOrderStatus(${order.id}, 'dikirim')">Kirim</button>`;
                } else if (status === 'dikirim') {
                    quickBtn = `<button type="button" style="background:#059669; color:#fff; border:none; border-radius:6px; padding:5px 8px; font-size:0.75rem; cursor:pointer;" onclick="updateAdminOrderStatus(${order.id}, 'selesai')">Selesai</button>`;
                }

                const timeStr = order.tanggal_pesanan ? order.tanggal_pesanan.substring(5, 16).replace('-', '/') : '-';
                const phoneHtml = order.no_telepon ? `<small style="display:block; color:#059669; font-size:0.75rem;"><a href="https://wa.me/${String(order.no_telepon).replace(/[^0-9]/g, '')}" target="_blank" style="color:#059669; text-decoration:none;">📱 ${order.no_telepon}</a></small>` : '';
                const emailHtml = order.email ? `<small style="display:block; color:#9ca3af; font-size:0.72rem;">${order.email}</small>` : '';

                return `
                    <tr id="admin-order-row-${order.id}">
                        <td><span class="order-id">#ORD-${String(order.id).padStart(4, '0')}</span></td>
                        <td>
                            <div class="customer-cell">
                                <div class="avatar-circle ${avatarClass}">${initials}</div>
                                <div>
                                    <strong>${order.nama_lengkap || '-'}</strong>
                                    ${phoneHtml}
                                    ${emailHtml}
                                </div>
                            </div>
                        </td>
                        <td>
                            <span title="${order.alamat_pengiriman || '-'}" style="font-size:0.82rem; color:#475569; display:inline-block; max-width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                📍 ${order.alamat_pengiriman || '-'}
                            </span>
                        </td>
                        <td><span class="product-item-name" style="font-weight: 500;">${order.produk_list || '-'}</span></td>
                        <td><span style="font-size:0.82rem; color:#6b7280; text-transform:uppercase; font-weight:600;">${order.metode_pembayaran || '-'}</span></td>
                        <td><span class="status-badge ${badgeClass}" id="admin-status-badge-${order.id}">${statusLabel}</span></td>
                        <td><strong class="order-amount">Rp ${Number(order.total_harga).toLocaleString('id-ID')}</strong></td>
                        <td style="font-size:0.82rem; color:#6b7280;">${timeStr}</td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 6px; justify-content: center; align-items: center;">
                                <button class="action-btn edit" type="button" style="padding: 5px 10px; font-size: 0.78rem;" onclick='openAdminOrderDetail(${orderJson})'>
                                    <span>Detail</span>
                                </button>
                                ${quickBtn}
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }
    </script>
</body>
</html>
