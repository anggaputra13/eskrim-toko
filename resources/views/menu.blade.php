<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scoops & Delicios | {{ config('app.name', 'Scoops & delicios') }}</title>

    <!-- Compact, readable type pairing for the product catalogue -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="menu-page">
    <!-- Sticky Header Navigation -->
    <header class="main-navbar">
        <div class="navbar-container">
            <a href="#" class="nav-brand">Scoops & delicios</a>
            
            <nav class="nav-links">
                <a href="#menu" class="nav-link active">Menu</a>
                <a href="{{ route('offers') }}" class="nav-link">Penawaran</a>
                <a href="{{ route('pesanan.saya') }}" class="nav-link">Pesanan Saya</a>
                <a href="{{ route('contact') }}" class="nav-link">Hubungi Kami</a>
            </nav>

            <div class="nav-actions">
                <button class="icon-btn cart-icon-btn" onclick="openCartModal()" aria-label="Keranjang Belanja">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="cart-badge" id="cartCountBadge">0</span>
                </button>

                <div class="user-menu-wrap">
                    @auth
                        <button class="icon-btn profile-icon-btn" id="userMenuBtn" onclick="toggleUserDropdown()" aria-label="User Profile">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="5"></circle>
                                <path d="M20 21a8 8 0 0 0-16 0"></path>
                            </svg>
                        </button>
                        <div class="user-dropdown" id="userDropdown">
                            <div class="user-info">
                                <strong>{{ auth()->user()->nama_lengkap ?? auth()->user()->name ?? 'Pengguna' }}</strong>
                                <small>{{ auth()->user()->email }}</small>
                            </div>
                            <div class="user-menu-links">
                                @if(in_array(auth()->user()->role, ['admin', 'kasir']))
                                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('cashier.dashboard') }}">📊 Dashboard</a>
                                @endif
                                <a href="{{ route('pesanan.saya') }}">📦 Pesanan Saya</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="logout-link">Keluar (Logout)</button>
                                </form>
                            </div>
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

    <!-- Main Content Container -->
    <main class="menu-main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <p class="eyebrow">ES KRIM LEZAT FAVORIT KELUARGA</p>
            <h1 class="hero-title">bnyak rasa, banyak momen manis.</h1>
            <p class="hero-subtitle">
                Es krim lembut dan creamy dalam ukuran untuk dinikmati ramai-ramai. Pilih rasa favoritmu, dari buah tropis sampai cokelat yang bold.
            </p>

            <!-- Category Filter Pills -->
            <div class="filter-pills">
                <button class="pill-btn active" data-category="all" onclick="filterCategory('all', this)">Semua Rasa</button>
                <button class="pill-btn" data-category="buah" onclick="filterCategory('buah', this)">Buah Segar</button>
                <button class="pill-btn" data-category="cokelat" onclick="filterCategory('cokelat', this)">Cokelat &amp; Kacang</button>
                <button class="pill-btn" data-category="favorit" onclick="filterCategory('favorit', this)">Favorit Keluarga</button>
            </div>
        </section>

        <!-- Gelato Grid Cards Section -->
        <section class="gelato-grid-container" id="gelatoGrid">
            
            @forelse ($products as $product)
            <article class="gelato-card" data-category="{{ $product->category }}">
                <div class="product-image-wrapper">
                    <img src="{{ $product->image_url ?: 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?auto=format&fit=crop&w=600&q=80' }}" alt="Es krim ember rasa {{ $product->name }}" loading="lazy">
                    <span class="category-pill">{{ ucfirst(str_replace('-', ' ', $product->category)) }}</span>
                </div>
                <div class="card-body">
                    <div class="item-kicker">ESKRIM 8 LITER</div>
                    <h2 class="item-name">{{ $product->name }}</h2>
                    <p class="item-desc">{{ $product->description ?: 'Es krim creamy dengan rasa yang kaya dan lembut untuk dinikmati bersama.' }}</p>
                    
                    <div class="option-group">
                        <label class="option-label">Ukuran porsi:</label>
                        <div class="swatch-list">
                            <button type="button" class="size-chip active" onclick="selectSwatch(this)" aria-label="Ember 8 liter">8 L</button>
                        </div>
                    </div>

                    <div class="card-footer-row">
                        <div class="price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="quantity-counter">
                            <button type="button" class="counter-btn" onclick="decreaseQty(this)">-</button>
                            <span class="qty-val">1</span>
                            <button type="button" class="counter-btn" onclick="increaseQty(this)">+</button>
                        </div>
                    </div>

                    <button type="button" class="add-cart-btn btn-pink" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" onclick="addToCart(Number(this.dataset.productId), this.dataset.productName, Number(this.dataset.productPrice), this)">
                        <svg class="cart-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <span>Keranjang</span>
                    </button>
                </div>
            </article>
            @empty
                <p class="empty-menu-msg">Belum ada es krim  yang tersedia.</p>
            @endforelse
        </section>
    </main>

    <!-- Floating Action Button: Beli -->
    <button class="floating-buy-btn" onclick="openCartModal()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <path d="M16 10a4 4 0 0 1-8 0"></path>
        </svg>
        <span>Beli</span>
        <span class="buy-badge" id="floatingBuyBadge">0</span>
    </button>

    <div class="cart-modal-backdrop" id="cartModalBackdrop" onclick="closeCartModal(event)">
        <div class="cart-drawer" onclick="event.stopPropagation()">
            <header class="drawer-header">
                <h3>Keranjang Belanja</h3>
                <button class="close-btn" onclick="closeCartModal()">&times;</button>
            </header>
            <div class="drawer-body" id="cartItemsList">
                <p class="empty-cart-msg">Keranjang Anda masih kosong. Silakan pilih es krim ember favorit Anda!</p>
            </div>
            <footer class="drawer-footer">
                <div class="total-row">
                    <span>Total Pembayaran:</span>
                    <strong id="cartTotalPrice">Rp 0</strong>
                </div>
                <button class="checkout-btn" onclick="checkoutOrder()">Bayar Sekarang</button>
            </footer>
        </div>
    </div>

    <div class="toast-notification" id="toast">
        <span id="toastMsg">Pesanan ditambahkan ke keranjang!</span>
    </div>

    <script>
        let cart = [];
        const orderUrl = "{{ route('order') }}";

        function addToCart(productId, itemName, price, btnEl) {
            const card = btnEl.closest('.gelato-card');
            const qtyVal = parseInt(card.querySelector('.qty-val').innerText) || 1;

            const existingItem = cart.find(item => item.product_id === productId);
            if (existingItem) {
                existingItem.qty += qtyVal;
            } else {
                cart.push({ product_id: productId, name: itemName, price: price, qty: qtyVal });
            }

            updateCartUI();
            showToast(`${qtyVal}x ${itemName} ditambahkan ke keranjang!`);
        }

        function updateCartUI() {
            const totalCount = cart.reduce((sum, item) => sum + item.qty, 0);
            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

            document.getElementById('cartCountBadge').innerText = totalCount;
            document.getElementById('floatingBuyBadge').innerText = totalCount;
            document.getElementById('cartTotalPrice').innerText = 'Rp ' + totalPrice.toLocaleString('id-ID');

            const listEl = document.getElementById('cartItemsList');
            if (cart.length === 0) {
                listEl.innerHTML = '<p class="empty-cart-msg">Keranjang Anda masih kosong. Silakan pilih gelato impian Anda!</p>';
            } else {
                listEl.innerHTML = cart.map((item, index) => `
                    <div class="cart-item-row">
                        <div class="cart-item-info">
                            <strong>${item.name}</strong>
                            <small>Rp ${item.price.toLocaleString('id-ID')} x ${item.qty}</small>
                        </div>
                        <div class="cart-item-actions">
                            <span class="cart-item-subtotal">Rp ${(item.price * item.qty).toLocaleString('id-ID')}</span>
                            <button class="remove-item-btn" onclick="removeItem(${index})">&times;</button>
                        </div>
                    </div>
                `).join('');
            }
        }

        function removeItem(index) {
            cart.splice(index, 1);
            updateCartUI();
        }

        function increaseQty(btn) {
            const qtySpan = btn.parentElement.querySelector('.qty-val');
            let current = parseInt(qtySpan.innerText) || 1;
            qtySpan.innerText = current + 1;
        }

        function decreaseQty(btn) {
            const qtySpan = btn.parentElement.querySelector('.qty-val');
            let current = parseInt(qtySpan.innerText) || 1;
            if (current > 1) {
                qtySpan.innerText = current - 1;
            }
        }

        function selectSwatch(swatchBtn) {
            const list = swatchBtn.closest('.swatch-list');
            list.querySelectorAll('.swatch').forEach(s => s.classList.remove('active'));
            swatchBtn.classList.add('active');
        }

        function filterCategory(category, pillBtn) {
            document.querySelectorAll('.filter-pills .pill-btn').forEach(p => p.classList.remove('active'));
            pillBtn.classList.add('active');

            const cards = document.querySelectorAll('.gelato-card');
            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function openCartModal() {
            document.getElementById('cartModalBackdrop').classList.add('show');
        }

        function closeCartModal(e) {
            document.getElementById('cartModalBackdrop').classList.remove('show');
        }

        function toggleUserDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.closest('.user-menu-wrap')) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown && dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                }
            }
        };

        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = msg;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }

        function checkoutOrder() {
            if (cart.length === 0) {
                alert('Keranjang Anda masih kosong!');
                return;
            }
            sessionStorage.setItem('eskrim_cart', JSON.stringify(cart));
            closeCartModal();
            window.location.href = orderUrl;
        }
    </script>
</body>
</html>
