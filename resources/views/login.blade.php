<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | {{ config('app.name', 'Scoops & delicios') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="login-page">
    <main class="login-card-container">
        <!-- Left Decorative Panel with Animated Ice Cream -->
        <section class="login-brand-panel" aria-label="Scoops & delicios">
            <!-- Top Left Floating Star -->
            <div class="brand-shape star-shape" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
            </div>

            <!-- Floating Sparkles Container -->
            <div class="sparkles-container" aria-hidden="true">
                <span class="sparkle sparkle-1">✦</span>
                <span class="sparkle sparkle-2">✧</span>
                <span class="sparkle sparkle-3">✦</span>
            </div>

            <!-- Center Brand Card with Animated Ice Cream SVG -->
            <div class="brand-card">
                <!-- Animated Gelato Scoop Hero Illustration -->
                <div class="icecream-animated-wrap" aria-hidden="true">
                    <div class="glow-aura"></div>
                    <svg class="icecream-svg" viewBox="0 0 140 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="berryGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#FF758F"/>
                                <stop offset="100%" stop-color="#C71585"/>
                            </linearGradient>
                            <linearGradient id="pistachioGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#A7F3D0"/>
                                <stop offset="100%" stop-color="#10B981"/>
                            </linearGradient>
                            <linearGradient id="vanillaGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#FFFBEB"/>
                                <stop offset="100%" stop-color="#FCD34D"/>
                            </linearGradient>
                            <linearGradient id="coneGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#F59E0B"/>
                                <stop offset="100%" stop-color="#B45309"/>
                            </linearGradient>
                        </defs>

                        <!-- Sparkle stars floating -->
                        <path class="sparkle-star s-left" d="M 20 40 L 23 47 L 30 50 L 23 53 L 20 60 L 17 53 L 10 50 L 17 47 Z" fill="#F472B6"/>
                        <path class="sparkle-star s-right" d="M 115 30 L 117 35 L 122 37 L 117 39 L 115 44 L 113 39 L 108 37 L 113 35 Z" fill="#FBBF24"/>

                        <!-- Ice Cream Cone Waffle -->
                        <polygon points="70,175 35,95 105,95" fill="url(#coneGradient)" stroke="#78350F" stroke-width="2.5"/>
                        <!-- Cone Waffle Lines -->
                        <line x1="44" y1="115" x2="88" y2="140" stroke="#78350F" stroke-width="1.5" stroke-opacity="0.6"/>
                        <line x1="52" y1="135" x2="78" y2="150" stroke="#78350F" stroke-width="1.5" stroke-opacity="0.6"/>
                        <line x1="96" y1="115" x2="52" y2="140" stroke="#78350F" stroke-width="1.5" stroke-opacity="0.6"/>
                        <line x1="88" y1="135" x2="62" y2="150" stroke="#78350F" stroke-width="1.5" stroke-opacity="0.6"/>

                        <!-- Bottom Scoop (Vanilla / Mango) -->
                        <circle cx="70" cy="90" r="32" fill="url(#vanillaGradient)"/>
                        
                        <!-- Middle Scoop (Pistachio Mint) -->
                        <circle cx="50" cy="65" r="28" fill="url(#pistachioGradient)"/>

                        <!-- Top Scoop (Berry Pink) -->
                        <circle cx="78" cy="55" r="30" fill="url(#berryGradient)"/>

                        <!-- Dripping Gelato Cream Drop -->
                        <path class="drip-drop" d="M 68 85 C 68 95, 62 105, 62 110 C 62 114, 66 116, 70 114 C 74 112, 74 95, 74 85 Z" fill="#FF758F"/>

                        <!-- Cherry on Top -->
                        <circle cx="82" cy="22" r="10" fill="#DC2626"/>
                        <path d="M 82 12 Q 95 0, 102 4" fill="none" stroke="#78350F" stroke-width="2.5" stroke-linecap="round"/>
                        <ellipse cx="79" cy="19" rx="3" ry="1.5" fill="#FFA8A8" transform="rotate(-30 79 19)"/>
                    </svg>
                </div>

                <h1>Scoops &amp;<br>delicios</h1>
                <p>Every scoop tells a story of joy. Log in to continue your delicious journey.</p>
            </div>

            <!-- Bottom Right Floating Heart -->
            <div class="brand-shape heart-shape" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.78-8.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </div>
        </section>

        <!-- Right Form Panel -->
        <section class="login-form-panel">
            <div class="login-content">
                <header class="login-header">
                    <h2>Selamat Datang</h2>
                    <p>Masukkan data Anda untuk melanjutkan perjalanan manis bersama kami.</p>
                </header>

                <form class="login-form" method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    @if ($errors->any())
                        <div class="form-error" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="email">Nama Pengguna atau Email</label>
                        <div class="input-container">
                            <span class="input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="3"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                            </span>
                            <input id="email" name="email" type="email" autocomplete="email" placeholder="scoop@delicios.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <div class="input-container">
                            <span class="input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                            <input id="password" name="password" type="password" autocomplete="current-password" placeholder="••••••••" required>
                            <button type="button" class="password-toggle" id="togglePasswordBtn" aria-label="Tampilkan atau sembunyikan kata sandi" onclick="togglePasswordVisibility()">
                                <svg class="eye-icon eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="eye-icon eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group" style="display: flex; justify-content: center; margin-bottom: 20px;">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    </div>

                    <div class="login-meta">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <span class="custom-checkbox"></span>
                            <span class="label-text">Ingat Saya</span>
                        </label>
                        <a href="#" class="forgot-link">Lupa Kata Sandi?</a>
                    </div>

                    <button type="submit" class="submit-btn">
                        <span>Login</span>
                        <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

                <p class="signup-prompt">
                    Belum memiliki akun? <a href="{{ route('register') }}" class="signup-link">Daftar</a>
                </p>

                <footer class="login-footer">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Ketentuan Layanan</a>
                    <a href="{{ route('contact') }}">Hubungi Bantuan</a>
                </footer>
            </div>
        </section>
    </main>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.querySelector('.eye-open');
            const eyeClosed = document.querySelector('.eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }
    </script>
</body>
</html>
