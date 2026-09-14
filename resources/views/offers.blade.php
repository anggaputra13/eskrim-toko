<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penawaran | Scoops &amp; delicios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="menu-page offers-page">
    <header class="main-navbar">
        <div class="navbar-container">
            <a href="{{ route('menu') }}" class="nav-brand">Scoops &amp; delicios</a>
            <nav class="nav-links">
                <a href="{{ route('menu') }}" class="nav-link">Menu</a>
                <a href="{{ route('offers') }}" class="nav-link active">Penawaran</a>
                <a href="{{ route('pesanan.saya') }}" class="nav-link">Pesanan Saya</a>
                <a href="{{ route('contact') }}" class="nav-link">Hubungi Kami</a>
            </nav>
            <div class="nav-actions">
                <a href="{{ route('order') }}" class="icon-btn cart-icon-btn" aria-label="Lihat pesanan">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                </a>
                
                <div class="user-menu-wrap">
                    @auth
                        <div style="display: flex; gap: 10px; align-items: center;">
                            @if(in_array(auth()->user()->role, ['admin', 'kasir']))
                                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('cashier.dashboard') }}" style="color: var(--c-navy); font-size: 0.9rem; font-weight: 700; text-decoration: none;">Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="logout-link">Keluar</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="icon-btn profile-icon-btn" aria-label="Login">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="5"></circle>
                                <path d="M20 21a8 8 0 0 0-16 0"></path>
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="offers-main-content">
        <section class="offers-intro">
            <span class="offers-eyebrow">PROMO ES KRIM</span>
            <h1>Lebih banyak rasa,<br>lebih banyak bahagia</h1>
            <p>Nikmati rasa favorit keluarga dalam ukuran besar. Cocok untuk pesta, kumpul keluarga, atau stok camilan di rumah.</p>
        </section>

        <section class="offer-flavor-strip" aria-label="Pilihan rasa ">
            <div>
                <span class="offers-eyebrow">PILIHAN RASA</span>
                <h2>Semua rasa favorit ada di sini</h2>
            </div>
            <div class="offer-flavor-list">
                @foreach ($products as $product)
                    <span>{{ $product->name }}</span>
                @endforeach
            </div>
        </section>

        <section class="offer-grid" aria-label="Daftar penawaran">
            <article class="offer-card offer-card-massal">
                <div class="offer-copy">
                    <span class="offer-tag">PALING POPULER</span>
                    <h2>Bonus Massal</h2>
                    <p>Pembuka pesta yang sempurna. Pesan 5 wadah besar atau lebih dan buka dunia keajaiban. Sempurna untuk perayaan kantor, pertemuan keluarga, atau sekadar bersiap-siap untuk akhir pekan.</p>
                    <ul class="offer-benefits">
                        <li><span class="benefit-icon">%</span><span>Diskon <strong>10%</strong> untuk seluruh pesanan Anda</span></li>
                        <li><span class="benefit-icon">✦</span><span>Toping gourmet gratis pilihan Anda</span></li>
                        <li><span class="benefit-icon">▣</span><span>Pengiriman ekspres prioritas termasuk di dalamnya</span></li>
                    </ul>
                    <div class="offer-actions">
                        <a class="offer-button offer-button-dark" href="{{ route('order') }}">Pesan Sekarang</a>
                        <a class="offer-button offer-button-green" href="{{ route('menu') }}">Cari di Toko</a>
                    </div>
                </div>
                <img class="offer-image offer-image-massal" src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?auto=format&fit=crop&w=520&q=85" alt="Pilihan gelato dalam wadah kecil" loading="lazy">
            </article>

            <article class="offer-card offer-card-seasonal">
                <div class="offer-copy">
                    <span class="offer-tag offer-tag-green">MUSIMAN</span>
                    <h2>Beli 2 Gratis 1</h2>
                    <p>Tradisi musim panas kami kembali. Campur dan padukan es krim musiman favorit Anda, dan es krim ketiga gratis.</p>
                    <div class="flavor-panel">
                        <span>RASA YANG TERSEDIA</span>
                        <div class="flavor-swatches"><i class="flavor-pink"></i><i class="flavor-green"></i><i class="flavor-cream"></i><i class="flavor-brown"></i></div>
                    </div>
                    <a class="offer-wide-button" href="{{ route('menu') }}">Klaim Penawaran Ini</a>
                    <small>*Hanya berlaku untuk pembelian di toko. Syarat dan ketentuan berlaku.</small>
                </div>
                <img class="offer-image offer-image-seasonal" src="https://images.unsplash.com/photo-1563805042-7684c019e1cb?auto=format&fit=crop&w=420&q=85" alt="Es krim dengan topping buah" loading="lazy">
            </article>
        </section>

        <section class="club-banner" id="contact">
            <div>
                <h2>Ingin lebih banyak hadiah?</h2>
                <p>Gabungkan dengan Smile Club untuk mendapatkan poin di setiap sajian es krim, membuka rasa rahasia, dan dapatkan undangan ulang tahun gratis.</p>
            </div>
            <a href="{{ route('menu') }}" class="club-button">✦ Dapatkan Aplikasinya</a>
        </section>
    </main>
</body>
</html>
