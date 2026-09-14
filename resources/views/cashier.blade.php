<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir POS | Scoops &amp; delicios</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-page cashier-dashboard">
    <div class="cashier-shell">
        <!-- Cashier Sidebar -->
        <aside class="cashier-sidebar">
            <div class="cashier-brand">
                <div class="dashboard-brand-mark">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 14 4-4"/>
                        <path d="M3.34 19a10 10 0 1 1 17.32 0"/>
                        <path d="M12 2v2"/>
                    </svg>
                </div>
                <div>
                    <strong>Scoops &amp; delicios</strong>
                    <small>Terminal Kasir POS</small>
                </div>
            </div>

            <nav class="cashier-nav-list">
                <button class="cashier-nav-btn active" onclick="switchCashierTab('pos', this)">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="8" cy="21" r="1"/>
                        <circle cx="19" cy="21" r="1"/>
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                    </svg>
                    <span>Keranjang POS</span>
                </button>
                
                <button class="cashier-nav-btn" onclick="switchCashierTab('orders', this)">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" x2="8" y1="13" y2="13"/>
                        <line x1="16" x2="8" y1="17" y2="17"/>
                    </svg>
                    <span>Pesanan Terakhir</span>
                    <span class="cashier-nav-badge" id="cashierPendingBadge" style="margin-left:auto; background:#EC4899; color:#fff; font-size:0.75rem; font-weight:700; padding:2px 8px; border-radius:99px; {{ ($stats['pending_orders'] ?? 0) > 0 ? '' : 'display:none;' }}">{{ $stats['pending_orders'] ?? 0 }}</span>
                </button>

                <button class="cashier-nav-btn" onclick="switchCashierTab('stock', this)">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m7.5 4.27 9 5.15"/>
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                        <path d="m3.3 7 8.7 5 8.7-5"/>
                        <path d="M12 12v9.5"/>
                    </svg>
                    <span>Cek Stok Gelato</span>
                </button>

                <button class="cashier-nav-btn" onclick="switchCashierTab('settings', this)">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.38a2 2 0 0 0-.73-2.73l-.15-.1a2 2 0 0 1-1-1.72v-.51a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <span>Pengaturan POS</span>
                </button>
            </nav>

            <a class="sidebar-primary-action" href="{{ route('admin.dashboard') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                </svg>
                <span>Dashboard Admin</span>
            </a>

            <form class="sidebar-logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" x2="9" y1="12" y2="12"/>
                    </svg>
                    <span>Keluar / Logout</span>
                </button>
            </form>
        </aside>

        <!-- Main Cashier Content Area -->
        <main class="cashier-content">
            <!-- Topbar Header -->
            <header class="cashier-header">
                <div>
                    <h1>Terminal Kasir Scoops &amp; delicios</h1>
                    <p>Operator: <strong>{{ auth()->user()->nama_lengkap }}</strong></p>
                </div>

                <div class="header-search-wrap">
                    <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="search" id="cashierSearchInput" placeholder="Cari rasa gelato / menu..." oninput="filterCashierMenu(this.value)">
                </div>

                <div class="cashier-status-pill">
                    <span class="status-dot"></span>
                    <span>Printer Ready (USB)</span>
                </div>
            </header>

            <!-- TAB 1: KERANJANG POS WORKSPACE -->
            <div id="tab-pos" class="cashier-tab-content active">
                <div class="cashier-workspace">
                    <section class="product-area">
                        <!-- Category Filter Tabs -->
                        <div class="product-tabs">
                            <button class="tab-btn active" onclick="filterProductCategory('all', this)">Semua Rasa</button>
                            <button class="tab-btn" onclick="filterProductCategory('buah', this)">Buah Segar</button>
                            <button class="tab-btn" onclick="filterProductCategory('cokelat', this)">Cokelat &amp; Kacang</button>
                            <button class="tab-btn" onclick="filterProductCategory('favorit', this)">Favorit Keluarga</button>
                        </div>

                        <!-- Product Cards Grid -->
                        <div class="product-grid" id="cashierProductGrid">
                            @foreach ($products as $product)
                            <article class="product-tile" data-id="{{ $product->id }}" data-category="{{ $product->category }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-image="{{ $product->image_url }}" onclick="addPosItem(Number(this.dataset.id), this.dataset.name, Number(this.dataset.price), this.dataset.image)">
                                <div class="tile-img-wrap">
                                    <img src="{{ $product->image_url ?: 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?auto=format&fit=crop&w=600&q=80' }}" alt="Es krim ember {{ $product->name }}">
                                    <span class="tile-stock-badge">Ember 8 L | Stok: {{ $product->stock }}</span>
                                </div>
                                <h2>{{ $product->name }}</h2>
                                <p>Es krim emberan creamy</p>
                                <div class="tile-bottom">
                                    <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                                    <button type="button" class="add-tile-btn">+</button>
                                </div>
                            </article>
                            @endforeach

                            @if (false)
                            <article class="product-tile" data-category="seasonal" data-name="Strawberry Dream" data-price="20000" onclick="addPosItem('Strawberry Dream', 20000, 'https://images.unsplash.com/photo-1567206563064-6f60f4078b57?auto=format&fit=crop&w=600&q=80')">
                                <div class="tile-img-wrap">
                                    <img src="https://images.unsplash.com/photo-1567206563064-6f60f4078b57?auto=format&fit=crop&w=600&q=80" alt="Strawberry Dream">
                                    <span class="tile-stock-badge">Stok: 24</span>
                                </div>
                                <h2>Strawberry Dream</h2>
                                <p>Stroberi Segar &amp; Krim Lembut</p>
                                <div class="tile-bottom">
                                    <strong>Rp 20.000</strong>
                                    <button type="button" class="add-tile-btn">＋</button>
                                </div>
                            </article>

                            <article class="product-tile" data-category="dairy-free" data-name="Minty Fresh" data-price="28000" onclick="addPosItem('Minty Fresh', 28000, 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?auto=format&fit=crop&w=600&q=80')">
                                <div class="tile-img-wrap">
                                    <img src="https://images.unsplash.com/photo-1570197788417-0e82375c9371?auto=format&fit=crop&w=600&q=80" alt="Minty Fresh">
                                    <span class="tile-stock-badge">Stok: 18</span>
                                </div>
                                <h2>Minty Fresh</h2>
                                <p>Peppermint &amp; Cokelat Hitam</p>
                                <div class="tile-bottom">
                                    <strong>Rp 28.000</strong>
                                    <button type="button" class="add-tile-btn">＋</button>
                                </div>
                            </article>

                            <article class="product-tile" data-category="classic" data-name="Deep Cocoa" data-price="22000" onclick="addPosItem('Deep Cocoa', 22000, 'https://images.unsplash.com/photo-1579954115545-aad51622d0b0?auto=format&fit=crop&w=600&q=80')">
                                <div class="tile-img-wrap">
                                    <img src="https://images.unsplash.com/photo-1579954115545-aad51622d0b0?auto=format&fit=crop&w=600&q=80" alt="Deep Cocoa">
                                    <span class="tile-stock-badge">Stok: 20</span>
                                </div>
                                <h2>Deep Cocoa</h2>
                                <p>Cokelat Belgia 70% Asli</p>
                                <div class="tile-bottom">
                                    <strong>Rp 22.000</strong>
                                    <button type="button" class="add-tile-btn">＋</button>
                                </div>
                            </article>

                            <article class="product-tile" data-category="dairy-free" data-name="Mango Sunshine" data-price="24000" onclick="addPosItem('Mango Sunshine', 24000, 'https://images.unsplash.com/photo-1505394033641-40c6ad1178d7?auto=format&fit=crop&w=600&q=80')">
                                <div class="tile-img-wrap">
                                    <img src="https://images.unsplash.com/photo-1505394033641-40c6ad1178d7?auto=format&fit=crop&w=600&q=80" alt="Mango Sunshine">
                                    <span class="tile-stock-badge">Stok: 15</span>
                                </div>
                                <h2>Mango Sunshine</h2>
                                <p>Sorbet Mangga Harum Manis</p>
                                <div class="tile-bottom">
                                    <strong>Rp 24.000</strong>
                                    <button type="button" class="add-tile-btn">＋</button>
                                </div>
                            </article>

                            <article class="product-tile" data-category="classic" data-name="Pistachio Velvet" data-price="30000" onclick="addPosItem('Pistachio Velvet', 30000, 'https://images.unsplash.com/photo-1580915411954-282cb1b0d780?auto=format&fit=crop&w=600&q=80')">
                                <div class="tile-img-wrap">
                                    <img src="https://images.unsplash.com/photo-1580915411954-282cb1b0d780?auto=format&fit=crop&w=600&q=80" alt="Pistachio Velvet">
                                    <span class="tile-stock-badge">Stok: 12</span>
                                </div>
                                <h2>Pistachio Velvet</h2>
                                <p>Pistacio Sisilia Panggang</p>
                                <div class="tile-bottom">
                                    <strong>Rp 30.000</strong>
                                    <button type="button" class="add-tile-btn">＋</button>
                                </div>
                            </article>

                            <article class="product-tile" data-category="classic" data-name="Vanilla Bean Bliss" data-price="22000" onclick="addPosItem('Vanilla Bean Bliss', 22000, 'https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?auto=format&fit=crop&w=600&q=80')">
                                <div class="tile-img-wrap">
                                    <img src="https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?auto=format&fit=crop&w=600&q=80" alt="Vanilla Bean Bliss">
                                    <span class="tile-stock-badge">Stok: 16</span>
                                </div>
                                <h2>Vanilla Bean Bliss</h2>
                                <p>Polong Vanila Madagaskar</p>
                                <div class="tile-bottom">
                                    <strong>Rp 22.000</strong>
                                    <button type="button" class="add-tile-btn">＋</button>
                                </div>
                            </article>
                            @endif
                        </div>
                    </section>

                    <!-- Interactive Order Drawer -->
                    <aside class="current-order">
                        <header class="order-header">
                            <div>
                                <h2>Keranjang Pesanan</h2>
                                <p>Order #POS-9482</p>
                            </div>
                            <span class="order-type-badge">Dine In</span>
                        </header>

                        <div class="pos-cart-items-wrap" id="posCartList">
                            <!-- Items inserted dynamically -->
                        </div>

                        <div class="order-total">
                            <div class="total-summary-lines">
                                <p><span>Subtotal</span><strong id="posSubtotalText">Rp 0</strong></p>
                                <p><span>Pajak Resto (10%)</span><strong id="posTaxText">Rp 0</strong></p>
                            </div>
                            <h3>Total Transaksi <strong id="posTotalText">Rp 0</strong></h3>
                            
                            <button class="pay-button" onclick="openPaymentModal()">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <rect x="2" y="5" width="20" height="14" rx="2"/>
                                    <line x1="2" y1="10" x2="22" y2="10"/>
                                </svg>
                                <span>PROSES PEMBAYARAN</span>
                            </button>

                            <div class="cart-bottom-actions">
                                <button type="button" class="btn-hold" onclick="alert('Pesanan disimpan ke antrean bill sementara!')">Simpan Bill</button>
                                <button type="button" class="btn-cancel" onclick="clearPosCart()">Kosongkan</button>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

            <!-- TAB 2: PESANAN TERAKHIR (TRANSAKSI HISTORY) WORKSPACE -->
            <div id="tab-orders" class="cashier-tab-content">
                <div class="tab-panel-container">
                    <div class="panel-top-flex">
                        <div>
                            <h2>Pesanan Terakhir &amp; Riwayat Pelanggan</h2>
                            <p>Pesanan online dari pelanggan yang masuk. Data diperbarui otomatis secara real-time.</p>
                        </div>
                        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                            <button type="button" class="dashboard-button secondary" onclick="refreshCashierOrders()" id="btnRefreshOrders" style="padding: 7px 14px; font-size: 0.85rem; border-radius: 8px;">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                                    <path d="M3 3v5h5"/>
                                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/>
                                    <path d="M16 21h5v-5"/>
                                </svg>
                                <span>Segarkan Pesanan</span>
                            </button>
                            <div class="history-filter-pills">
                                <button class="filter-btn active" onclick="filterOrderHistory('all', this)">Semua (<span id="filterCountAll">{{ count($orders) }}</span>)</button>
                                <button class="filter-btn" onclick="filterOrderHistory('pending', this)">Menunggu (<span id="filterCountPending">{{ $orders->whereIn('status_pesanan', ['pending', 'menunggu'])->count() }}</span>)</button>
                                <button class="filter-btn" onclick="filterOrderHistory('processing', this)">Diproses (<span id="filterCountProcessing">{{ $orders->whereIn('status_pesanan', ['diproses', 'processing'])->count() }}</span>)</button>
                                <button class="filter-btn" onclick="filterOrderHistory('done', this)">Selesai (<span id="filterCountDone">{{ $orders->whereIn('status_pesanan', ['selesai', 'completed', 'done'])->count() }}</span>)</button>
                            </div>
                        </div>
                    </div>

                    <div class="history-table-wrap">
                        <table class="cashier-history-table">
                            <thead>
                                <tr>
                                    <th>NO. PESANAN</th>
                                    <th>WAKTU</th>
                                    <th>PELANGGAN</th>
                                    <th>ALAMAT PENGIRIMAN</th>
                                    <th>MENU PESANAN</th>
                                    <th>METODE</th>
                                    <th>TOTAL</th>
                                    <th>STATUS</th>
                                    <th style="text-align:center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="cashierOrdersTableBody">
                                @forelse ($orders as $order)
                                @php
                                    $statusPesanan = strtolower($order->status_pesanan ?? 'pending');
                                    $dataStatus = match(true) {
                                        in_array($statusPesanan, ['selesai', 'completed', 'done']) => 'done',
                                        in_array($statusPesanan, ['diproses', 'processing']) => 'processing',
                                        default => 'pending',
                                    };
                                    $badgeClass = match($dataStatus) {
                                        'done' => 'badge-success',
                                        'processing' => 'badge-info',
                                        default => 'badge-warning',
                                    };
                                    $statusLabel = match($statusPesanan) {
                                        'selesai', 'completed', 'done' => 'Selesai',
                                        'pending', 'menunggu' => 'Menunggu',
                                        'diproses', 'processing' => 'Diproses',
                                        'dikirim' => 'Dikirim',
                                        'dibatalkan', 'cancelled' => 'Dibatalkan',
                                        default => ucfirst($statusPesanan),
                                    };
                                    $metode = match(strtolower($order->metode_pembayaran ?? '')) {
                                        'qris' => 'QRIS',
                                        'e-wallet', 'e_wallet' => 'E-Wallet',
                                        'cash' => 'Tunai',
                                        default => ucfirst($order->metode_pembayaran ?? '-'),
                                    };
                                    $payTag = match(strtolower($order->metode_pembayaran ?? '')) {
                                        'qris' => 'qris',
                                        'e-wallet', 'e_wallet' => 'qris',
                                        default => 'cash',
                                    };
                                @endphp
                                <tr data-status="{{ $dataStatus }}" id="order-row-{{ $order->id }}">
                                    <td><strong class="receipt-no">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($order->tanggal_pesanan)->format('H:i') }} WIB</td>
                                    <td>
                                        <strong>{{ $order->nama_lengkap ?? '-' }}</strong>
                                        @if(!empty($order->no_telepon))
                                            <div style="font-size:0.75rem; color:#64748b;">
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->no_telepon) }}" target="_blank" style="color:#059669; text-decoration:none;">📱 {{ $order->no_telepon }}</a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span title="{{ $order->alamat_pengiriman ?? '-' }}" style="font-size:0.82rem; color:#475569; display:inline-block; max-width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                            📍 {{ $order->alamat_pengiriman ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-size:0.84rem; color:#1e293b; font-weight:500;">
                                            {{ Str::limit($order->produk_list ?? 'Pesanan Es Krim', 45) }}
                                        </span>
                                    </td>
                                    <td><span class="pay-tag {{ $payTag }}">{{ $metode }}</span></td>
                                    <td><strong class="price-text">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
                                    <td><span class="status-badge {{ $badgeClass }}" id="badge-status-{{ $order->id }}">{{ $statusLabel }}</span></td>
                                    <td>
                                        <div class="btn-action-group" style="display:flex; gap:6px; justify-content:center; align-items:center;">
                                            <button class="btn-mini-action detail" type="button"
                                                onclick='openCashierOrderDetail(@json($order))'>Rincian</button>
                                            
                                            @if(in_array($statusPesanan, ['pending', 'menunggu']))
                                                <button class="btn-mini-action" style="background:#0284c7; color:#fff;" type="button"
                                                    onclick="quickUpdateStatus({{ $order->id }}, 'diproses')">Proses</button>
                                            @elseif(in_array($statusPesanan, ['diproses', 'processing']))
                                                <button class="btn-mini-action" style="background:#f59e0b; color:#fff;" type="button"
                                                    onclick="quickUpdateStatus({{ $order->id }}, 'dikirim')">Kirim</button>
                                            @elseif($statusPesanan === 'dikirim')
                                                <button class="btn-mini-action" style="background:#059669; color:#fff;" type="button"
                                                    onclick="quickUpdateStatus({{ $order->id }}, 'selesai')">Selesai</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr id="emptyOrdersRow">
                                    <td colspan="9" style="text-align:center; padding: 40px; color: #9ca3af;">
                                        <div style="font-size: 2rem; margin-bottom: 8px;">🍦</div>
                                        <strong>Belum ada pesanan masuk</strong>
                                        <p style="margin-top: 4px; font-size: 0.85rem;">Pesanan yang dibuat pelanggan akan otomatis muncul di sini.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TAB 3: CEK STOK GELATO WORKSPACE -->
            <div id="tab-stock" class="cashier-tab-content">
                <div class="tab-panel-container">
                    <div class="panel-top-flex">
                        <div>
                            <h2>Cek Ketersediaan Stok Gelato</h2>
                            <p>Pantau jumlah sisa scoop dan jar gelato di etalase toko secara realtime.</p>
                        </div>
                        <button class="dashboard-button primary" onclick="alert('Permintaan restock berhasil dikirimkan ke Tim Dapur Gelato!')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                            <span>Kirim Permintaan Restock</span>
                        </button>
                    </div>

                    <div class="stock-stats-grid">
                        <div class="stock-stat-card border-green">
                            <span>Semua Varian Tersedia</span>
                            <strong>{{ $products->count() }} Varian</strong>
                            <small>Total jenis rasa di sistem</small>
                        </div>
                        <div class="stock-stat-card border-amber">
                            <span>Stok Terendah</span>
                            <strong>{{ $products->sortBy('stock')->first()->name ?? '-' }}</strong>
                            <small>Sisa {{ $products->sortBy('stock')->first()->stock ?? 0 }} scoops</small>
                        </div>
                        <div class="stock-stat-card border-green">
                            <span>Total Stok Siap Jual</span>
                            <strong>{{ $products->sum('stock') }} Scoops</strong>
                            <small>Kondisi etalase optimal</small>
                        </div>
                    </div>

                    <div class="stock-grid-wrap">
                        @foreach ($products as $product)
                        @php
                            $isLowStock = $product->stock <= 15;
                            $statusBadge = $isLowStock ? 'badge-warning' : 'badge-success';
                            $statusText = $isLowStock ? 'Hampir Habis' : 'Aman';
                            $percentage = min(100, max(0, ($product->stock / 30) * 100));
                            $barColor = $isLowStock ? 'amber' : 'green';
                        @endphp
                        <div class="stock-item-card">
                            <div class="stock-item-header">
                                <h3>{{ $product->name }}</h3>
                                <span class="{{ $statusBadge }} status-badge">{{ $statusText }}</span>
                            </div>
                            <p class="stock-item-desc">{{ Str::limit($product->description, 50, '...') }}</p>
                            <div class="stock-bar-wrap">
                                <div class="stock-bar-fill {{ $barColor }}" style="width: {{ $percentage }}%;"></div>
                            </div>
                            <div class="stock-meta">
                                <span>Sisa: <strong>{{ $product->stock }} Scoops</strong></span>
                                <span>Kapasitas: 30</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- TAB 4: PENGATURAN KASIR WORKSPACE -->
            <div id="tab-settings" class="cashier-tab-content">
                <div class="tab-panel-container">
                    <div class="panel-top-flex">
                        <div>
                            <h2>Pengaturan Terminal POS &amp; Informasi Kasir</h2>
                            <p>Konfigurasi printer struk, profil kasir bertugas, dan pelaporan penjualan.</p>
                        </div>
                    </div>

                    <div class="settings-two-col">
                        <!-- Left Settings Box -->
                        <div class="dashboard-panel settings-box">
                            <h3>👨‍🍳 Profil Kasir &amp; Ringkasan Penjualan</h3>
                            
                            <div class="shift-info-rows">
                                <div class="info-row" style="align-items: center;">
                                    <span>Nama Kasir Bertugas</span>
                                    <div style="display: flex; gap: 8px; align-items: center;">
                                        <strong id="displayCashierName">{{ auth()->user()->nama_lengkap }}</strong>
                                        <a href="#" onclick="updateCashierName(); return false;" style="font-size: 0.75rem; color: #0284c7; text-decoration: none; padding: 2px 6px; background: #e0f2fe; border-radius: 4px;">Ubah</a>
                                    </div>
                                </div>
                                <div class="info-row">
                                    <span>Pesanan Diproses Hari Ini</span>
                                    <strong>{{ $stats['today_orders'] ?? 0 }} Transaksi</strong>
                                </div>
                                <div class="info-row">
                                    <span>Total Penjualan Hari Ini</span>
                                    <strong class="highlight-green">Rp {{ number_format($stats['today_revenue_raw'] ?? 0, 0, ',', '.') }}</strong>
                                </div>
                                <div class="info-row">
                                    <span>Pesanan Menunggu</span>
                                    <strong style="color: #f59e0b;">{{ $stats['pending_orders'] ?? 0 }} Pesanan</strong>
                                </div>
                            </div>

                            <div class="shift-actions-wrap">
                                <button class="dashboard-button primary full-width" onclick="alert('Mencetak Laporan Penjualan Harian...')">
                                    🖨 Cetak Laporan Penjualan
                                </button>
                            </div>
                        </div>

                        <!-- Right Settings Box -->
                        <div class="dashboard-panel settings-box">
                            <h3>🖨 Konfigurasi Perangkat Terminal</h3>

                            <form class="terminal-settings-form" onsubmit="event.preventDefault(); alert('Pengaturan terminal kasir berhasil disimpan!');">
                                <label class="setting-field">
                                    <span>Printer Struk Thermal</span>
                                    <select>
                                        <option selected>Epson TM-T82 Thermal (USB 2.0)</option>
                                        <option>Bixolon SRP-330II (Bluetooth)</option>
                                        <option>Generic 80mm Printer</option>
                                    </select>
                                </label>

                                <label class="setting-field">
                                    <span>Cetak Struk Otomatis Pembayaran</span>
                                    <select>
                                        <option selected>Ya, Cetak Otomatis (1 Lembar)</option>
                                        <option>Ya, Cetak 2 Lembar (Kasir &amp; Pelanggan)</option>
                                        <option>Tidak, Konfirmasi Sebelum Cetak</option>
                                    </select>
                                </label>

                                <label class="setting-field">
                                    <span>Metode Pembayaran Non-Tunai (QRIS)</span>
                                    <select>
                                        <option selected>Aktif (GoPay, OVO, ShopeePay, Dana)</option>
                                        <option>Non-aktifkan Sementara</option>
                                    </select>
                                </label>

                                <button type="submit" class="dashboard-button secondary">Simpan Pengaturan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- PAYMENT MODAL -->
    <div class="modal-backdrop" id="paymentModalBackdrop" onclick="closePaymentModal(event)">
        <div class="payment-modal-box" onclick="event.stopPropagation()">
            <header class="modal-header">
                <h3>Proses Pembayaran Kasir</h3>
                <button class="modal-close-btn" onclick="closePaymentModal()">&times;</button>
            </header>
            
            <div class="modal-body">
                <div class="modal-total-display">
                    <span>Total Pembayaran:</span>
                    <h2 id="modalTotalPayText">Rp 118.800</h2>
                </div>

                <div class="payment-method-selector">
                    <label class="pay-option active" onclick="selectPayMethod(this, 'cash')">
                        <input type="radio" name="pay_method" checked>
                        <span>💵 Tunai</span>
                    </label>
                    <label class="pay-option" onclick="selectPayMethod(this, 'qris')">
                        <input type="radio" name="pay_method">
                        <span>📱 QRIS Scan</span>
                    </label>
                </div>

                <div class="qris-payment-panel" id="qrisPaymentPanel" hidden>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&amp;data=SCOOPS%20%26%20DELICIOS%20QRIS%20PAYMENT" alt="Kode QRIS Scoops &amp; delicios">
                    <strong>Scan kode QRIS untuk membayar</strong>
                    <span>Pastikan pembayaran berhasil sebelum menyelesaikan transaksi.</span>
                </div>

                <div class="cash-calc-group" id="cashCalcGroup">
                    <label>
                        <span>Uang Diterima dari Pelanggan:</span>
                        <input type="number" id="cashInput" placeholder="Contoh: 150000" oninput="calculateChange()">
                    </label>
                    
                    <div class="quick-cash-pills">
                        <button type="button" onclick="setCashAmount(120000)">Rp 120.000</button>
                        <button type="button" onclick="setCashAmount(150000)">Rp 150.000</button>
                        <button type="button" onclick="setCashAmount(200000)">Rp 200.000</button>
                    </div>

                    <div class="change-result-box">
                        <span>Kembalian:</span>
                        <strong id="changeText">Rp 0</strong>
                    </div>
                </div>
            </div>

            <footer class="modal-footer">
                <button class="secondary-btn" onclick="closePaymentModal()">Batal</button>
                <button class="dashboard-button primary" onclick="submitPayment()">Selesaikan &amp; Cetak Struk</button>
            </footer>
        </div>
    </div>

    <!-- PRINT RECEIPT MODAL -->
    <div class="modal-backdrop" id="receiptModalBackdrop" onclick="closeReceiptModal(event)">
        <div class="receipt-modal-box" onclick="event.stopPropagation()">
            <div class="thermal-receipt">
                <div class="receipt-brand">
                    <h2>SCOOPS &amp; DELICIOS</h2>
                    <p>Jl. Artisan Gelato No. 88, Jakarta</p>
                    <p>Telp: (021) 555-8888</p>
                </div>
                <div class="receipt-divider">--------------------------------</div>
                <div class="receipt-info-row">
                    <span id="recNo">Struk: #POS-9481</span>
                    <span id="recDate">31/08/2026 14:28</span>
                </div>
                <div class="receipt-info-row">
                    <span>Kasir: Budi S.</span>
                    <span id="recCustomer">Jane Doe</span>
                </div>
                <div class="receipt-divider">--------------------------------</div>
                <div class="receipt-items-list" id="recItems">
                    <div class="rec-item"><span>Strawberry Dream (x2)</span><span>Rp 40.000</span></div>
                    <div class="rec-item"><span>Minty Fresh (x1)</span><span>Rp 28.000</span></div>
                </div>
                <div class="receipt-divider">--------------------------------</div>
                <div class="rec-total-row"><span>Subtotal:</span><span id="recSubtotal">Rp 68.000</span></div>
                <div class="rec-total-row"><span>Pajak (10%):</span><span id="recTax">Rp 6.800</span></div>
                <div class="rec-total-row bold"><span>TOTAL:</span><span id="recTotal">Rp 74.800</span></div>
                <div class="rec-total-row"><span>Metode Bayar:</span><span id="recMethod">Tunai</span></div>
                <div class="receipt-divider">--------------------------------</div>
                <p class="receipt-footer-msg">Terima Kasih atas Kunjungan Anda!<br>Semoga Harimu Manis &amp; Cerah 🍨</p>
            </div>
            <div class="receipt-modal-actions">
                <button class="secondary-btn" onclick="closeReceiptModal()">Tutup</button>
                <button class="dashboard-button primary" onclick="alert('Mencetak struk ke printer thermal...')">🖨 Cetak Sekarang</button>
            </div>
        </div>
    </div>

    <!-- CASHIER ORDER DETAIL MODAL -->
    <div class="modal-backdrop" id="cashierOrderDetailModal" onclick="closeCashierOrderDetail(event)">
        <div class="payment-modal-box" style="max-width: 580px; width: 95%; max-height: 90vh; overflow-y: auto;" onclick="event.stopPropagation()">
            <header class="modal-header">
                <div>
                    <h3 id="cModalOrderTitle">Detail Pesanan #ORD-0000</h3>
                    <p style="margin: 4px 0 0; font-size: 0.8rem; color: #64748b;" id="cModalOrderMeta">-</p>
                </div>
                <button class="modal-close-btn" type="button" onclick="closeCashierOrderDetail()">&times;</button>
            </header>
            <div class="modal-body" style="padding: 20px;">
                <!-- Customer info card -->
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                        <div>
                            <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; font-weight: 700;">Pelanggan</span>
                            <h4 style="margin: 2px 0 0; font-size: 1rem; color: #0F172A;" id="cModalCustomerName">-</h4>
                        </div>
                        <span class="status-badge" id="cModalStatusBadge">Menunggu</span>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr; gap: 6px; font-size: 0.85rem; color: #334155;">
                        <div id="cModalPhoneRow">📱 <a href="#" id="cModalPhoneLink" target="_blank" style="color: #059669; font-weight: 600; text-decoration: none;">-</a></div>
                        <div id="cModalAddressRow">📍 <span id="cModalAddress">-</span></div>
                        <div>💳 Metode Bayar: <strong id="cModalPaymentMethod">Cash</strong></div>
                    </div>
                </div>

                <!-- Products table -->
                <h4 style="font-size: 0.9rem; margin: 0 0 10px; color: #334155;">Daftar Es Krim Dipesan:</h4>
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
                        <tbody id="cModalItemsTableBody">
                            <!-- Populated dynamically -->
                        </tbody>
                        <tfoot style="background: #F8FAFC; border-top: 1px solid #E2E8F0; font-weight: 700;">
                            <tr>
                                <td colspan="3" style="padding: 10px 12px; text-align: right;">Total Transaksi:</td>
                                <td style="padding: 10px 12px; text-align: right; color: #E11D48;" id="cModalGrandTotal">Rp 0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Status Action Buttons -->
                <div style="margin-top: 16px; padding: 14px; background: #FFF1F2; border: 1px solid #FFE4E6; border-radius: 12px;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: #9F1239; text-transform: uppercase; margin-bottom: 8px;">Ubah Status Pesanan Ini:</label>
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <button type="button" class="dashboard-button" style="background: #F59E0B; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromModal('pending')">⏳ Menunggu</button>
                        <button type="button" class="dashboard-button" style="background: #0284C7; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromModal('diproses')">⚡ Diproses</button>
                        <button type="button" class="dashboard-button" style="background: #8B5CF6; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromModal('dikirim')">🛵 Diantar</button>
                        <button type="button" class="dashboard-button" style="background: #059669; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromModal('selesai')">✅ Selesai</button>
                        <button type="button" class="dashboard-button" style="background: #EF4444; color: #fff; padding: 6px 14px; font-size: 0.8rem; border-radius: 6px; cursor: pointer; border: none;" onclick="updateOrderStatusFromModal('dibatalkan')">❌ Batalkan</button>
                    </div>
                </div>
            </div>

            <footer class="modal-footer" style="display: flex; justify-content: space-between;">
                <button class="secondary-btn" type="button" onclick="closeCashierOrderDetail()">Tutup</button>
                <button class="dashboard-button primary" type="button" onclick="printCurrentOrderReceipt()">🖨 Cetak Struk Pesanan</button>
            </footer>
        </div>
    </div>

    <!-- POS JavaScript Logic -->
    <script>
        let posCart = [];

        document.addEventListener('DOMContentLoaded', function() {
            renderPosCart();
        });

        function switchCashierTab(tabName, navBtn) {
            document.querySelectorAll('.cashier-nav-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.cashier-tab-content').forEach(tab => tab.classList.remove('active'));

            if (navBtn) navBtn.classList.add('active');
            const targetTab = document.getElementById('tab-' + tabName);
            if (targetTab) targetTab.classList.add('active');
        }

        function addPosItem(id, name, price, img) {
            const existing = posCart.find(item => item.id === id);
            if (existing) {
                existing.qty += 1;
            } else {
                posCart.push({ id: id, name: name, price: price, qty: 1, img: img });
            }
            renderPosCart();
        }

        function renderPosCart() {
            const cartWrap = document.getElementById('posCartList');
            let subtotal = 0;

            if (posCart.length === 0) {
                cartWrap.innerHTML = '<p class="empty-pos-msg">Keranjang kosong. Klik produk di sebelah kiri untuk menambahkan pesanan.</p>';
            } else {
                cartWrap.innerHTML = posCart.map((item, index) => {
                    const itemTotal = item.price * item.qty;
                    subtotal += itemTotal;
                    return `
                        <div class="pos-cart-item">
                            <img src="${item.img}" alt="${item.name}">
                            <div class="pos-item-detail">
                                <strong>${item.name}</strong>
                                <small>Rp ${item.price.toLocaleString('id-ID')}</small>
                            </div>
                            <div class="pos-item-qty-controls">
                                <button type="button" onclick="updateItemQty(${index}, -1)">-</button>
                                <span>${item.qty}</span>
                                <button type="button" onclick="updateItemQty(${index}, 1)">+</button>
                            </div>
                            <div class="pos-item-price-right">
                                <strong>Rp ${itemTotal.toLocaleString('id-ID')}</strong>
                                <button class="btn-del-item" onclick="removePosItem(${index})">&times;</button>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            const tax = Math.round(subtotal * 0.1);
            const total = subtotal + tax;

            document.getElementById('posSubtotalText').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('posTaxText').innerText = 'Rp ' + tax.toLocaleString('id-ID');
            document.getElementById('posTotalText').innerText = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('modalTotalPayText').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        function updateItemQty(index, delta) {
            if (posCart[index]) {
                posCart[index].qty += delta;
                if (posCart[index].qty <= 0) {
                    posCart.splice(index, 1);
                }
            }
            renderPosCart();
        }

        function removePosItem(index) {
            posCart.splice(index, 1);
            renderPosCart();
        }

        function clearPosCart() {
            posCart = [];
            renderPosCart();
        }

        function filterProductCategory(category, btnEl) {
            document.querySelectorAll('.product-tabs .tab-btn').forEach(b => b.classList.remove('active'));
            btnEl.classList.add('active');

            const tiles = document.querySelectorAll('.product-tile');
            tiles.forEach(tile => {
                if (category === 'all' || tile.dataset.category === category) {
                    tile.style.display = 'flex';
                } else {
                    tile.style.display = 'none';
                }
            });
        }

        function filterCashierMenu(query) {
            const q = query.toLowerCase().trim();
            const tiles = document.querySelectorAll('.product-tile');
            tiles.forEach(tile => {
                const name = tile.dataset.name.toLowerCase();
                if (!q || name.includes(q)) {
                    tile.style.display = 'flex';
                } else {
                    tile.style.display = 'none';
                }
            });
        }

        function filterOrderHistory(status, btnEl) {
            document.querySelectorAll('.history-filter-pills .filter-btn').forEach(b => b.classList.remove('active'));
            btnEl.classList.add('active');

            const rows = document.querySelectorAll('.cashier-history-table tbody tr');
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Payment Modal Handlers
        function openPaymentModal() {
            if (posCart.length === 0) {
                alert('Keranjang pesanan masih kosong!');
                return;
            }
            document.getElementById('paymentModalBackdrop').classList.add('show');
        }

        function closePaymentModal(e) {
            document.getElementById('paymentModalBackdrop').classList.remove('show');
        }

        function selectPayMethod(element, method) {
            document.querySelectorAll('.pay-option').forEach(el => el.classList.remove('active'));
            element.classList.add('active');
            
            const cashGroup = document.getElementById('cashCalcGroup');
            const qrisPanel = document.getElementById('qrisPaymentPanel');
            if (method === 'cash') {
                cashGroup.style.display = 'block';
                qrisPanel.hidden = true;
            } else {
                cashGroup.style.display = 'none';
                qrisPanel.hidden = false;
            }
        }

        function setCashAmount(amt) {
            document.getElementById('cashInput').value = amt;
            calculateChange();
        }

        function calculateChange() {
            const subtotal = posCart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            const total = subtotal + Math.round(subtotal * 0.1);
            const cash = parseFloat(document.getElementById('cashInput').value) || 0;
            const change = Math.max(0, cash - total);

            document.getElementById('changeText').innerText = 'Rp ' + change.toLocaleString('id-ID');
        }

        function updateCashierName() {
            const newName = prompt('Masukkan nama kasir baru:');
            if (newName && newName.trim() !== '') {
                fetch('{{ route("profile.update-name") }}', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ nama_lengkap: newName.trim() })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('displayCashierName').innerText = data.name;
                        // Juga perbarui nama operator di header
                        document.querySelector('.cashier-header p strong').innerText = data.name;
                    } else {
                        alert('Gagal memperbarui nama.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Terjadi kesalahan jaringan saat memperbarui nama.');
                });
            }
        }

        function submitPayment() {
            const subtotal = posCart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            const total = subtotal + Math.round(subtotal * 0.1);
            const selectedMethod = document.querySelector('input[name="pay_method"]:checked')?.parentElement?.innerText.trim() || 'Tunai';
            const paymentMethodParam = selectedMethod.includes('QRIS') ? 'qris' : 'cash';
            const receiptMethod = selectedMethod.includes('QRIS') ? 'QRIS' : 'Tunai';

            const itemsPayload = posCart.map(item => ({
                product_id: item.id,
                qty: item.qty
            }));

            fetch('{{ route("pos.orders.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    payment_method: paymentMethodParam,
                    items: itemsPayload
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closePaymentModal();
                    printReceiptModal('POS-' + String(data.order_id).padStart(4, '0'), 'Pelanggan POS', total, receiptMethod);
                    clearPosCart();
                    setTimeout(() => window.location.reload(), 3000); // Reload to update stock UI
                } else {
                    alert('Gagal memproses pesanan: ' + (data.message || 'Terjadi kesalahan. Pastikan stok mencukupi.'));
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan jaringan.');
            });
        }

        function printReceiptModal(no, cust, total, method) {
            document.getElementById('recNo').innerText = 'Struk: #' + no;
            document.getElementById('recCustomer').innerText = cust;
            document.getElementById('recTotal').innerText = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('recMethod').innerText = method;

            document.getElementById('receiptModalBackdrop').classList.add('show');
        }

        function closeReceiptModal(e) {
            document.getElementById('receiptModalBackdrop').classList.remove('show');
        }

        // --- ONLINE ORDER HANDLING IN CASHIER ---
        let currentViewingOrder = null;

        function openCashierOrderDetail(order) {
            currentViewingOrder = order;
            document.getElementById('cModalOrderTitle').innerText = 'Detail Pesanan #ORD-' + String(order.id).padStart(4, '0');
            document.getElementById('cModalOrderMeta').innerText = 'Waktu: ' + (order.tanggal_pesanan || '-') + ' WIB';
            document.getElementById('cModalCustomerName').innerText = order.nama_lengkap || 'Pelanggan';

            const phoneLink = document.getElementById('cModalPhoneLink');
            if (order.no_telepon) {
                const cleanPhone = String(order.no_telepon).replace(/[^0-9]/g, '');
                phoneLink.innerText = order.no_telepon;
                phoneLink.href = 'https://wa.me/' + cleanPhone;
                phoneLink.parentElement.style.display = 'block';
            } else {
                phoneLink.parentElement.style.display = 'none';
            }

            document.getElementById('cModalAddress').innerText = order.alamat_pengiriman || '-';
            document.getElementById('cModalPaymentMethod').innerText = (order.metode_pembayaran || 'Cash').toUpperCase();
            
            const badge = document.getElementById('cModalStatusBadge');
            const status = (order.status_pesanan || 'pending').toLowerCase();
            badge.className = 'status-badge ' + (status === 'selesai' || status === 'completed' ? 'badge-success' : (status === 'processing' ? 'badge-info' : (status === 'cancelled' ? 'badge-danger' : 'badge-warning')));
            badge.innerText = status === 'selesai' || status === 'completed' ? 'Selesai' : (status === 'processing' ? 'Diproses' : (status === 'cancelled' ? 'Dibatalkan' : 'Menunggu'));

            // Render Items
            const itemsTbody = document.getElementById('cModalItemsTableBody');
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

            document.getElementById('cModalGrandTotal').innerText = 'Rp ' + Number(order.total_harga).toLocaleString('id-ID');
            document.getElementById('cashierOrderDetailModal').classList.add('show');
        }

        function closeCashierOrderDetail() {
            document.getElementById('cashierOrderDetailModal').classList.remove('show');
        }

        async function quickUpdateStatus(orderId, newStatus) {
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
                    refreshCashierOrders();
                } else {
                    alert(data.message || 'Gagal mengubah status pesanan.');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan jaringan.');
            }
        }

        async function updateOrderStatusFromModal(newStatus) {
            if (!currentViewingOrder) return;
            await quickUpdateStatus(currentViewingOrder.id, newStatus);
            closeCashierOrderDetail();
        }

        function printCurrentOrderReceipt() {
            if (!currentViewingOrder) return;
            const order = currentViewingOrder;
            document.getElementById('recNo').innerText = 'Struk: #ORD-' + String(order.id).padStart(4, '0');
            document.getElementById('recCustomer').innerText = order.nama_lengkap || 'Pelanggan';
            document.getElementById('recTotal').innerText = 'Rp ' + Number(order.total_harga).toLocaleString('id-ID');
            document.getElementById('recMethod').innerText = (order.metode_pembayaran || 'Tunai').toUpperCase();

            const recItems = document.getElementById('recItems');
            if (order.items && order.items.length > 0) {
                recItems.innerHTML = order.items.map(item => `
                    <div class="rec-item"><span>${item.product_name || 'Es Krim'} (x${item.jumlah})</span><span>Rp ${(Number(item.harga_satuan) * Number(item.jumlah)).toLocaleString('id-ID')}</span></div>
                `).join('');
            } else {
                recItems.innerHTML = `<div class="rec-item"><span>${order.produk_list || 'Es Krim'}</span><span>Rp ${Number(order.total_harga).toLocaleString('id-ID')}</span></div>`;
            }

            closeCashierOrderDetail();
            document.getElementById('receiptModalBackdrop').classList.add('show');
        }

        async function refreshCashierOrders() {
            const btn = document.getElementById('btnRefreshOrders');
            if (btn) btn.style.opacity = '0.5';

            try {
                const response = await fetch('/orders/latest', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) return;
                const data = await response.json();
                renderCashierOrdersTable(data.orders);

                // Update badge & counts
                const pendingBadge = document.getElementById('cashierPendingBadge');
                if (pendingBadge) {
                    pendingBadge.innerText = data.pending_count || 0;
                    pendingBadge.style.display = data.pending_count > 0 ? 'inline-block' : 'none';
                }
                const filterPending = document.getElementById('filterCountPending');
                if (filterPending) filterPending.innerText = data.pending_count || 0;
                const filterAll = document.getElementById('filterCountAll');
                if (filterAll) filterAll.innerText = data.total || 0;

                const processingCount = data.orders.filter(o => (o.status_pesanan || '').toLowerCase() === 'processing').length;
                const doneCount = data.orders.filter(o => ['selesai', 'completed', 'done'].includes((o.status_pesanan || '').toLowerCase())).length;

                const filterProcessing = document.getElementById('filterCountProcessing');
                if (filterProcessing) filterProcessing.innerText = processingCount;
                const filterDone = document.getElementById('filterCountDone');
                if (filterDone) filterDone.innerText = doneCount;

            } catch (err) {
                console.error('Error refreshing cashier orders:', err);
            } finally {
                if (btn) btn.style.opacity = '1';
            }
        }

        function renderCashierOrdersTable(orders) {
            const tbody = document.getElementById('cashierOrdersTableBody');
            if (!tbody) return;

            if (!orders || orders.length === 0) {
                tbody.innerHTML = `
                    <tr id="emptyOrdersRow">
                        <td colspan="9" style="text-align:center; padding: 40px; color: #9ca3af;">
                            <div style="font-size: 2rem; margin-bottom: 8px;">🍦</div>
                            <strong>Belum ada pesanan masuk</strong>
                            <p style="margin-top: 4px; font-size: 0.85rem;">Pesanan yang dibuat pelanggan akan otomatis muncul di sini.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = orders.map(order => {
                const status = (order.status_pesanan || 'pending').toLowerCase();
                const isDone = ['selesai', 'completed', 'done'].includes(status);
                const isProcessing = ['diproses', 'processing'].includes(status);
                const dataStatus = isDone ? 'done' : (isProcessing ? 'processing' : 'pending');
                const badgeClass = isDone ? 'badge-success' : (isProcessing ? 'badge-info' : (status === 'cancelled' || status === 'dibatalkan' ? 'badge-danger' : 'badge-warning'));
                const statusLabel = isDone ? 'Selesai' : (isProcessing ? 'Diproses' : (status === 'cancelled' || status === 'dibatalkan' ? 'Dibatalkan' : 'Menunggu'));
                const metode = (order.metode_pembayaran || '-').toUpperCase();
                const payTag = (order.metode_pembayaran || 'cash').toLowerCase() === 'qris' ? 'qris' : 'cash';
                const orderJson = JSON.stringify(order).replace(/'/g, "&#39;");

                let quickBtn = '';
                if (status === 'pending' || status === 'menunggu') {
                    quickBtn = `<button class="btn-mini-action" style="background:#0284c7; color:#fff;" type="button" onclick="quickUpdateStatus(${order.id}, 'diproses')">Proses</button>`;
                } else if (isProcessing) {
                    quickBtn = `<button class="btn-mini-action" style="background:#f59e0b; color:#fff;" type="button" onclick="quickUpdateStatus(${order.id}, 'dikirim')">Kirim</button>`;
                } else if (status === 'dikirim') {
                    quickBtn = `<button class="btn-mini-action" style="background:#059669; color:#fff;" type="button" onclick="quickUpdateStatus(${order.id}, 'selesai')">Selesai</button>`;
                }

                const timeStr = order.tanggal_pesanan ? order.tanggal_pesanan.substring(11, 16) : '-';
                const phoneHtml = order.no_telepon ? `<div style="font-size:0.75rem; color:#64748b;"><a href="https://wa.me/${String(order.no_telepon).replace(/[^0-9]/g, '')}" target="_blank" style="color:#059669; text-decoration:none;">📱 ${order.no_telepon}</a></div>` : '';

                return `
                    <tr data-status="${dataStatus}" id="order-row-${order.id}">
                        <td><strong class="receipt-no">#ORD-${String(order.id).padStart(4, '0')}</strong></td>
                        <td>${timeStr} WIB</td>
                        <td>
                            <strong>${order.nama_lengkap || '-'}</strong>
                            ${phoneHtml}
                        </td>
                        <td>
                            <span title="${order.alamat_pengiriman || '-'}" style="font-size:0.82rem; color:#475569; display:inline-block; max-width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                📍 ${order.alamat_pengiriman || '-'}
                            </span>
                        </td>
                        <td>
                            <span style="font-size:0.84rem; color:#1e293b; font-weight:500;">
                                ${order.produk_list || 'Pesanan Es Krim'}
                            </span>
                        </td>
                        <td><span class="pay-tag ${payTag}">${metode}</span></td>
                        <td><strong class="price-text">Rp ${Number(order.total_harga).toLocaleString('id-ID')}</strong></td>
                        <td><span class="status-badge ${badgeClass}" id="badge-status-${order.id}">${statusLabel}</span></td>
                        <td>
                            <div class="btn-action-group" style="display:flex; gap:6px; justify-content:center; align-items:center;">
                                <button class="btn-mini-action detail" type="button" onclick='openCashierOrderDetail(${orderJson})'>Rincian</button>
                                ${quickBtn}
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Live Auto-Refresh polling every 12 seconds
        setInterval(refreshCashierOrders, 12000);
    </script>
</body>
</html>
