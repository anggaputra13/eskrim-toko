<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hubungi Kami | Scoops &amp; delicios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="menu-page contact-page">
    <header class="main-navbar">
        <div class="navbar-container">
            <a href="{{ route('menu') }}" class="nav-brand">Scoops &amp; delicios</a>
            <nav class="nav-links">
                <a href="{{ route('menu') }}" class="nav-link">Menu</a>
                <a href="{{ route('offers') }}" class="nav-link">Penawaran</a>
                <a href="{{ route('pesanan.saya') }}" class="nav-link">Pesanan Saya</a>
                <a href="{{ route('contact') }}" class="nav-link active">Hubungi Kami</a>
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

    <main class="contact-main-content">
        <section class="contact-intro">
            <span class="contact-eyebrow">Kami siap membantu</span>
            <h1>Hai, ada yang bisa<br>kami bantu?</h1>
            <p>Baik Anda memiliki pertanyaan tentang pilihan rasa kami, membutuhkan bantuan dengan pesanan dalam jumlah besar,<br class="contact-desktop-break"> atau hanya ingin berbagi pengalaman menikmati es krim terbaru Anda, kami siap mendengarkan.</p>
        </section>

        <section class="contact-layout">
            <form class="contact-form" method="POST" action="{{ route('contact.submit') }}">
                @csrf
                <h2>Kirim pesan kepada kami</h2>
                <div class="contact-form-grid">
                    <div class="contact-field"><label for="contact-name">Nama</label><input id="contact-name" name="name" type="text" placeholder="Nama Anda" value="{{ old('name') }}" required></div>
                    <div class="contact-field"><label for="contact-email">Email</label><input id="contact-email" name="email" type="email" placeholder="nama@email.com" value="{{ old('email') }}" required></div>
                </div>
                <div class="contact-field"><label for="contact-topic">Tentang</label><select id="contact-topic" name="topic" required><option value="">Pilih topik</option><option>Pesanan</option><option>Penawaran</option><option>Kerja sama</option><option>Saran dan masukan</option></select></div>
                <div class="contact-field"><label for="contact-message">Pesan</label><textarea id="contact-message" name="message" placeholder="Tulis pesan Anda di sini..." required>{{ old('message') }}</textarea></div>
                @if (session('contact_success'))<p class="contact-success">{{ session('contact_success') }}</p>@endif
                <button class="contact-submit" type="submit">Kirim Pesan <span aria-hidden="true">→</span></button>
            </form>

            <aside class="contact-info-card">
                <h2>Hubungi Kami</h2>
                <div class="contact-info-row"><span class="contact-info-icon pink">⌖</span><div><strong>Lokasi</strong><p>Jalan Bahagia No. 12<br>Jakarta, Indonesia</p></div></div>
                <div class="contact-info-row"><span class="contact-info-icon green">⌕</span><div><strong>Telepon</strong><p>(555) 123-4567</p></div></div>
                <div class="contact-info-row"><span class="contact-info-icon cream">✉</span><div><strong>Email</strong><p>sapaan@scoops.id</p></div></div>
            </aside>
        </section>
    </main>
</body>
</html>
