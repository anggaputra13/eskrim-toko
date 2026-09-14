<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar | {{ config('app.name', 'Scoops & delicios') }}</title>
    <meta name="description" content="Buat akun baru di Scoops & delicios dan nikmati berbagai menu es krim lezat kami.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .register-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fce4ec 0%, #f8bbd9 30%, #e8d5f0 60%, #d1c4e9 100%);
            font-family: 'Manrope', sans-serif;
            padding: 20px;
        }

        .register-card-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 960px;
            width: 100%;
            min-height: 680px;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(180, 60, 120, 0.18), 0 4px 24px rgba(0,0,0,0.08);
        }

        .register-brand-panel {
            background: linear-gradient(160deg, #f9527a 0%, #d63b8f 50%, #a855f7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 36px;
            position: relative;
            overflow: hidden;
        }

        .register-brand-panel::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 280px; height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .register-brand-panel::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .reg-brand-card {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .reg-brand-card h1 {
            font-family: 'Manrope', sans-serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.15;
            margin: 20px 0 12px;
            text-shadow: 0 2px 12px rgba(0,0,0,0.15);
        }

        .reg-brand-card p {
            color: rgba(255,255,255,0.88);
            font-size: 0.95rem;
            line-height: 1.6;
            max-width: 220px;
            margin: 0 auto;
        }

        .reg-icecream-wrap {
            position: relative;
            width: 160px;
            height: 190px;
            margin: 0 auto;
        }

        .reg-glow-aura {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 130px; height: 130px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,200,220,0.4) 0%, transparent 70%);
            animation: pulseGlowR 3s ease-in-out infinite;
        }

        @keyframes pulseGlowR {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.6; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
        }

        .reg-icecream-svg {
            width: 100%;
            height: 100%;
            animation: floatIceR 4s ease-in-out infinite;
            filter: drop-shadow(0 8px 20px rgba(0,0,0,0.18));
        }

        @keyframes floatIceR {
            0%, 100% { transform: translateY(0px) rotate(-2deg); }
            50% { transform: translateY(-12px) rotate(2deg); }
        }

        .reg-sparkle-star { animation: twinkleR 2s ease-in-out infinite; }
        .reg-s-right { animation-delay: 1s; }
        .reg-drip-drop { animation: dripR 3s ease-in-out infinite; }

        @keyframes twinkleR {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.7); }
        }
        @keyframes dripR {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(5px); }
        }

        .reg-sparkles {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            pointer-events: none;
        }

        .reg-sparkle {
            position: absolute;
            font-size: 1.2rem;
            color: rgba(255,255,255,0.6);
            animation: sparkleFloatR 3s ease-in-out infinite;
        }
        .reg-sparkle-1 { top: 15%; left: 10%; animation-delay: 0s; }
        .reg-sparkle-2 { top: 30%; right: 8%; animation-delay: 1s; }
        .reg-sparkle-3 { bottom: 20%; left: 15%; animation-delay: 2s; }

        @keyframes sparkleFloatR {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.6; }
            50% { transform: translateY(-8px) rotate(180deg); opacity: 1; }
        }

        .reg-brand-shape {
            position: absolute;
            width: 44px; height: 44px;
            border-radius: 12px;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(6px);
        }

        .reg-brand-shape svg { width: 22px; height: 22px; color: rgba(255,255,255,0.8); }
        .reg-star-shape { top: 28px; left: 28px; animation: floatShapeR 5s ease-in-out infinite; }
        .reg-heart-shape { bottom: 28px; right: 28px; animation: floatShapeR 5s ease-in-out infinite 2.5s; }

        @keyframes floatShapeR {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .register-form-panel {
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 44px;
            overflow-y: auto;
        }

        .register-content {
            width: 100%;
            max-width: 380px;
        }

        .register-header {
            margin-bottom: 24px;
        }

        .register-header h2 {
            font-family: 'Manrope', sans-serif;
            font-size: 1.9rem;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0 0 6px;
        }

        .register-header p {
            color: #6b7280;
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .register-form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .reg-form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .reg-form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #374151;
            letter-spacing: 0.02em;
        }

        .reg-input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .reg-input-icon {
            position: absolute;
            left: 13px;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .reg-input-icon svg {
            width: 16px;
            height: 16px;
            stroke: #9ca3af;
        }

        .reg-input-container input {
            width: 100%;
            padding: 10px 14px 10px 38px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.88rem;
            color: #1f2937;
            background: #f9fafb;
            transition: all 0.25s ease;
            box-sizing: border-box;
        }

        .reg-input-container input:focus {
            outline: none;
            border-color: #e879b0;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(232, 121, 176, 0.12);
        }

        .reg-input-container input::placeholder { color: #c4c9d4; }

        .reg-password-toggle {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
        }

        .reg-password-toggle svg {
            width: 16px;
            height: 16px;
            stroke: #9ca3af;
            transition: stroke 0.2s;
        }

        .reg-password-toggle:hover svg { stroke: #e879b0; }

        .reg-form-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 10px 14px;
            color: #dc2626;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .reg-form-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 10px 14px;
            color: #16a34a;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .reg-submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px 20px;
            background: linear-gradient(135deg, #f9527a, #d63b8f);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            letter-spacing: 0.02em;
            margin-top: 4px;
            box-shadow: 0 4px 14px rgba(214, 59, 143, 0.35);
        }

        .reg-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(214, 59, 143, 0.45);
        }

        .reg-submit-btn:active { transform: translateY(0); }

        .reg-btn-arrow {
            width: 18px;
            height: 18px;
            transition: transform 0.2s;
        }

        .reg-submit-btn:hover .reg-btn-arrow { transform: translateX(4px); }

        .reg-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 14px 0 10px;
        }

        .reg-divider::before, .reg-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .reg-divider span {
            color: #9ca3af;
            font-size: 0.78rem;
            white-space: nowrap;
        }

        .reg-login-prompt {
            text-align: center;
            color: #6b7280;
            font-size: 0.85rem;
            margin: 0;
        }

        .reg-login-link {
            color: #e879b0;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }

        .reg-login-link:hover { color: #d63b8f; text-decoration: underline; }

        .reg-footer {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 16px;
        }

        .reg-footer a {
            color: #9ca3af;
            font-size: 0.75rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .reg-footer a:hover { color: #e879b0; }

        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 4px;
        }

        .strength-segment {
            height: 3px;
            flex: 1;
            border-radius: 99px;
            background: #e5e7eb;
            transition: background 0.3s;
        }

        .strength-label {
            font-size: 0.72rem;
            font-weight: 600;
            margin-top: 2px;
        }

        @media (max-width: 768px) {
            .register-card-container {
                grid-template-columns: 1fr;
                min-height: auto;
            }
            .register-brand-panel {
                padding: 36px 24px;
                min-height: 200px;
            }
            .reg-brand-card h1 { font-size: 2rem; }
            .reg-icecream-wrap { width: 100px; height: 120px; }
            .register-form-panel { padding: 32px 24px; }
        }
    </style>
</head>
<body class="register-page">
    <main class="register-card-container">
        <!-- Left Decorative Panel -->
        <section class="register-brand-panel" aria-label="Scoops & delicios Brand">
            <div class="reg-brand-shape reg-star-shape" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
            </div>

            <div class="reg-sparkles" aria-hidden="true">
                <span class="reg-sparkle reg-sparkle-1">✦</span>
                <span class="reg-sparkle reg-sparkle-2">✧</span>
                <span class="reg-sparkle reg-sparkle-3">✦</span>
            </div>

            <div class="reg-brand-card">
                <div class="reg-icecream-wrap" aria-hidden="true">
                    <div class="reg-glow-aura"></div>
                    <svg class="reg-icecream-svg" viewBox="0 0 140 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="regBerry" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#FF758F"/>
                                <stop offset="100%" stop-color="#C71585"/>
                            </linearGradient>
                            <linearGradient id="regPistachio" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#A7F3D0"/>
                                <stop offset="100%" stop-color="#10B981"/>
                            </linearGradient>
                            <linearGradient id="regVanilla" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#FFFBEB"/>
                                <stop offset="100%" stop-color="#FCD34D"/>
                            </linearGradient>
                            <linearGradient id="regCone" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#F59E0B"/>
                                <stop offset="100%" stop-color="#B45309"/>
                            </linearGradient>
                        </defs>
                        <path class="reg-sparkle-star" d="M 20 40 L 23 47 L 30 50 L 23 53 L 20 60 L 17 53 L 10 50 L 17 47 Z" fill="#F472B6"/>
                        <path class="reg-sparkle-star reg-s-right" d="M 115 30 L 117 35 L 122 37 L 117 39 L 115 44 L 113 39 L 108 37 L 113 35 Z" fill="#FBBF24"/>
                        <polygon points="70,175 35,95 105,95" fill="url(#regCone)" stroke="#78350F" stroke-width="2.5"/>
                        <line x1="44" y1="115" x2="88" y2="140" stroke="#78350F" stroke-width="1.5" stroke-opacity="0.6"/>
                        <line x1="52" y1="135" x2="78" y2="150" stroke="#78350F" stroke-width="1.5" stroke-opacity="0.6"/>
                        <line x1="96" y1="115" x2="52" y2="140" stroke="#78350F" stroke-width="1.5" stroke-opacity="0.6"/>
                        <line x1="88" y1="135" x2="62" y2="150" stroke="#78350F" stroke-width="1.5" stroke-opacity="0.6"/>
                        <circle cx="70" cy="90" r="32" fill="url(#regVanilla)"/>
                        <circle cx="50" cy="65" r="28" fill="url(#regPistachio)"/>
                        <circle cx="78" cy="55" r="30" fill="url(#regBerry)"/>
                        <path class="reg-drip-drop" d="M 68 85 C 68 95, 62 105, 62 110 C 62 114, 66 116, 70 114 C 74 112, 74 95, 74 85 Z" fill="#FF758F"/>
                        <circle cx="82" cy="22" r="10" fill="#DC2626"/>
                        <path d="M 82 12 Q 95 0, 102 4" fill="none" stroke="#78350F" stroke-width="2.5" stroke-linecap="round"/>
                        <ellipse cx="79" cy="19" rx="3" ry="1.5" fill="#FFA8A8" transform="rotate(-30 79 19)"/>
                    </svg>
                </div>

                <h1>Bergabung<br>Bersama Kami</h1>
                <p>Daftarkan dirimu dan mulai nikmati setiap scoop penuh senyuman! 🍦</p>
            </div>

            <div class="reg-brand-shape reg-heart-shape" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.78-8.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </div>
        </section>

        <!-- Right Form Panel -->
        <section class="register-form-panel">
            <div class="register-content">
                <header class="register-header">
                    <h2>Buat Akun Baru</h2>
                    <p>Isi data di bawah untuk mulai menikmati es krim terbaik kami.</p>
                </header>

                <form class="register-form" id="registerForm" method="POST" action="{{ route('register.submit') }}">
                    @csrf

                    @if ($errors->any())
                        <div class="reg-form-error" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="reg-form-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Nama Lengkap -->
                    <div class="reg-form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <div class="reg-input-container">
                            <span class="reg-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </span>
                            <input
                                id="nama_lengkap"
                                name="nama_lengkap"
                                type="text"
                                autocomplete="name"
                                placeholder="Nama lengkap Anda"
                                value="{{ old('nama_lengkap') }}"
                                required
                            >
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="reg-form-group">
                        <label for="reg_email">Email</label>
                        <div class="reg-input-container">
                            <span class="reg-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="3"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                            </span>
                            <input
                                id="reg_email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                placeholder="scoop@delicios.com"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>
                    </div>

                    <!-- No. Telepon -->
                    <div class="reg-form-group">
                        <label for="no_telepon">No. Telepon <span style="color:#9ca3af;font-weight:400;">(opsional)</span></label>
                        <div class="reg-input-container">
                            <span class="reg-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.62 3.38 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.56a16 16 0 0 0 6.53 6.53l1.62-1.62a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </span>
                            <input
                                id="no_telepon"
                                name="no_telepon"
                                type="tel"
                                autocomplete="tel"
                                placeholder="08xxxxxxxxxx"
                                value="{{ old('no_telepon') }}"
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="reg-form-group">
                        <label for="reg_password">Kata Sandi</label>
                        <div class="reg-input-container">
                            <span class="reg-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                            <input
                                id="reg_password"
                                name="password"
                                type="password"
                                autocomplete="new-password"
                                placeholder="Min. 8 karakter"
                                required
                                oninput="checkPasswordStrength(this.value)"
                            >
                            <button type="button" class="reg-password-toggle" id="toggleRegPasswordBtn" aria-label="Tampilkan atau sembunyikan kata sandi" onclick="toggleRegPassword('reg_password', 'toggleRegPasswordBtn')">
                                <svg class="reg-eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="reg-eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="strength-bar" id="strengthBar" style="display:none;">
                            <div class="strength-segment" id="reg-seg1"></div>
                            <div class="strength-segment" id="reg-seg2"></div>
                            <div class="strength-segment" id="reg-seg3"></div>
                            <div class="strength-segment" id="reg-seg4"></div>
                        </div>
                        <span class="strength-label" id="strengthLabel" style="display:none; color:#9ca3af;"></span>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="reg-form-group">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <div class="reg-input-container">
                            <span class="reg-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </span>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                placeholder="Ulangi kata sandi"
                                required
                            >
                            <button type="button" class="reg-password-toggle" id="toggleConfirmBtn" aria-label="Tampilkan atau sembunyikan konfirmasi kata sandi" onclick="toggleRegPassword('password_confirmation', 'toggleConfirmBtn')">
                                <svg class="reg-eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="reg-eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="reg-submit-btn" id="registerSubmitBtn">
                        <span>Buat Akun</span>
                        <svg class="reg-btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

                <div class="reg-divider">
                    <span>sudah punya akun?</span>
                </div>

                <p class="reg-login-prompt">
                    <a href="{{ route('login') }}" class="reg-login-link">Masuk Sekarang →</a>
                </p>

                <footer class="reg-footer">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Ketentuan Layanan</a>
                    <a href="{{ route('contact') }}">Hubungi Bantuan</a>
                </footer>
            </div>
        </section>
    </main>

    <script>
        function toggleRegPassword(inputId, btnId) {
            const input = document.getElementById(inputId);
            const btn = document.getElementById(btnId);
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            const openIcons = btn.querySelectorAll('.reg-eye-open');
            const closedIcons = btn.querySelectorAll('.reg-eye-closed');
            openIcons.forEach(i => i.style.display = isPassword ? 'none' : 'block');
            closedIcons.forEach(i => i.style.display = isPassword ? 'block' : 'none');
        }

        function checkPasswordStrength(password) {
            const bar = document.getElementById('strengthBar');
            const label = document.getElementById('strengthLabel');
            const segs = [
                document.getElementById('reg-seg1'),
                document.getElementById('reg-seg2'),
                document.getElementById('reg-seg3'),
                document.getElementById('reg-seg4'),
            ];

            if (!password.length) {
                bar.style.display = 'none';
                label.style.display = 'none';
                return;
            }

            bar.style.display = 'flex';
            label.style.display = 'block';

            let score = 0;
            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
            const labels = ['Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];

            segs.forEach((seg, i) => {
                seg.style.background = i < score ? colors[score - 1] : '#e5e7eb';
            });

            label.textContent = score > 0 ? labels[score - 1] : 'Terlalu Pendek';
            label.style.color = score > 0 ? colors[score - 1] : '#9ca3af';
        }
    </script>
</body>
</html>
