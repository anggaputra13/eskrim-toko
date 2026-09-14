<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk | Scoops &amp; delicios</title>
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
                <a class="dashboard-nav-link" href="{{ route('admin.dashboard') }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="7" height="9" x="3" y="3" rx="1"/>
                        <rect width="7" height="5" x="14" y="3" rx="1"/>
                        <rect width="7" height="9" x="14" y="12" rx="1"/>
                        <rect width="7" height="5" x="3" y="16" rx="1"/>
                    </svg>
                    <span>Dasbor</span>
                </a>
                <a class="dashboard-nav-link active" href="{{ route('admin.dashboard') }}#inventory">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7.5 4.27 9 5.15"/>
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                        <path d="m3.3 7 8.7 5 8.7-5"/>
                        <path d="M12 12v9.5"/>
                    </svg>
                    <span>Inventaris Produk</span>
                </a>
            </nav>

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
            <header class="dashboard-topbar">
                <div>
                    <h1>Tambah Produk Baru</h1>
                    <p>Isi form di bawah untuk menambahkan rasa baru ke daftar menu gelato.</p>
                </div>
            </header>

            <section class="dashboard-panel form-panel">
                <form method="POST" action="{{ route('products.store') }}" class="product-form" enctype="multipart/form-data">
                    @csrf

                    <div class="form-grid">
                        <label>
                            <span>Nama Produk</span>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Pistachio Delight" required>
                        </label>

                        <label>
                            <span>Kategori</span>
                            <select name="category" required>
                                <option value="">Pilih kategori</option>
                                <option value="buah" {{ old('category') == 'buah' ? 'selected' : '' }}>Buah Segar</option>
                                <option value="cokelat" {{ old('category') == 'cokelat' ? 'selected' : '' }}>Cokelat &amp; Kacang</option>
                                <option value="favorit" {{ old('category') == 'favorit' ? 'selected' : '' }}>Favorit Keluarga</option>
                            </select>
                        </label>

                        <label>
                            <span>Stok</span>
                            <input type="number" name="stock" min="0" value="{{ old('stock', 0) }}" required>
                        </label>

                        <label>
                            <span>Harga (Rp)</span>
                            <input type="number" name="price" min="0" value="{{ old('price', 0) }}" required>
                        </label>
                    </div>

                    <label>
                        <span>Deskripsi</span>
                        <textarea name="description" rows="3" placeholder="Jelaskan cita rasa dan keunikan menu ini...">{{ old('description') }}</textarea>
                    </label>

                    <label>
                        <span>URL Gambar</span>
                        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://images.unsplash.com/...">
                    </label>

                    <label>
                        <span>Upload Gambar dari Perangkat</span>
                        <input type="file" name="image_file" accept="image/jpeg,image/png,image/webp">
                        <small class="form-help-text">Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                    </label>

                    <label>
                        <span>Status Ketersediaan</span>
                        <select name="status">
                            <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>Available (Tersedia)</option>
                            <option value="low_stock" {{ old('status') == 'low_stock' ? 'selected' : '' }}>Low Stock (Stok Rendah)</option>
                            <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock (Habis)</option>
                        </select>
                    </label>

                    <div class="form-actions">
                        <a href="{{ route('admin.dashboard') }}" class="secondary-btn">Batal</a>
                        <button type="submit" class="dashboard-button primary">Simpan Produk</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
