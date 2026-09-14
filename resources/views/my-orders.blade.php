<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pesanan Saya | Scoops &amp; delicios</title>

    <!-- Google Fonts matching store theme -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand-maroon: #733e46;
            --brand-maroon-dark: #542930;
            --brand-maroon-light: #8e4854;
            --brand-pink: #ffb3c7;
            --brand-pink-soft: #fff0f4;
            --brand-pink-subtle: #fdf2f4;
            --brand-cream: #fffdf7;
            --brand-cream-border: #f2e5e8;
            --color-success: #10b981;
            --color-success-bg: #ecfdf5;
            --color-warning: #f59e0b;
            --color-warning-bg: #fffbeb;
            --color-info: #0284c7;
            --color-info-bg: #f0f9ff;
            --text-dark: #2c181c;
            --text-muted: #7d656b;
        }

        * {
            box-sizing: border-box;
        }

        body.my-orders-page {
            margin: 0;
            font-family: 'Manrope', sans-serif;
            background-color: #fdfaf8;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== NAVBAR ===== */
        .main-navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(242, 229, 232, 0.9);
            box-shadow: 0 4px 20px rgba(115, 62, 70, 0.05);
        }
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-brand {
            font-family: 'Manrope', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--brand-maroon);
            text-decoration: none;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }
        .nav-link {
            text-decoration: none;
            color: #645156;
            font-weight: 600;
            font-size: 15px;
            position: relative;
            padding: 6px 0;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--brand-maroon);
        }
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--brand-maroon);
            border-radius: 99px;
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .icon-btn {
            background: #fff;
            border: 1.5px solid var(--brand-cream-border);
            border-radius: 12px;
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--brand-maroon);
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .icon-btn:hover {
            border-color: var(--brand-pink);
            background: var(--brand-pink-soft);
            transform: translateY(-2px);
        }
        .icon-btn svg {
            width: 20px;
            height: 20px;
        }

        /* User Menu Dropdown */
        .user-menu-wrap {
            position: relative;
        }
        .user-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 240px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 16px 36px rgba(115, 62, 70, 0.15);
            border: 1px solid var(--brand-cream-border);
            padding: 12px;
            display: none;
            z-index: 120;
        }
        .user-dropdown.show {
            display: block;
            animation: dropFade 0.2s ease;
        }
        @keyframes dropFade {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .user-info {
            padding: 8px 10px 12px;
            border-bottom: 1px solid #f8eaed;
        }
        .user-info strong {
            display: block;
            font-size: 14px;
            color: var(--brand-maroon-dark);
        }
        .user-info small {
            color: var(--text-muted);
            font-size: 12px;
        }
        .user-menu-links {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-top: 8px;
        }
        .user-menu-links a, .user-menu-links button {
            padding: 9px 12px;
            font-size: 13px;
            font-weight: 600;
            color: #554045;
            text-decoration: none;
            border-radius: 10px;
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            cursor: pointer;
            transition: background 0.15s;
        }
        .user-menu-links a:hover, .user-menu-links button:hover {
            background: var(--brand-pink-soft);
            color: var(--brand-maroon);
        }
        .user-menu-links .logout-link {
            color: #dc2626;
        }
        .user-menu-links .logout-link:hover {
            background: #fef2f2;
            color: #b91c1c;
        }

        /* ===== MAIN CONTENT ===== */
        .orders-main-content {
            flex: 1;
            max-width: 1080px;
            width: 100%;
            margin: 0 auto;
            padding: 36px 20px 60px;
        }

        /* Hero Header */
        .orders-hero {
            background: linear-gradient(135deg, #733e46 0%, #542730 65%, #3d1b22 100%);
            border-radius: 28px;
            padding: 36px 36px 32px;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(115, 62, 70, 0.2);
        }
        .orders-hero::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(255, 179, 199, 0.25) 0%, rgba(255, 179, 199, 0) 70%);
            border-radius: 50%;
        }
        .orders-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 6px 14px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 14px;
            backdrop-filter: blur(4px);
        }
        .pulse-dot {
            width: 8px;
            height: 8px;
            background: #34d399;
            border-radius: 50%;
            animation: pulseGlow 1.8s infinite;
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0.7); }
            70% { box-shadow: 0 0 0 8px rgba(52, 211, 153, 0); }
            100% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0); }
        }
        .orders-hero h1 {
            font-family: 'Manrope', sans-serif;
            font-size: 32px;
            font-weight: 700;
            margin: 0 0 8px;
            letter-spacing: -0.5px;
        }
        .orders-hero p {
            font-size: 15px;
            color: #ffd6df;
            margin: 0;
            max-width: 600px;
            line-height: 1.5;
        }

        /* Tab Filter Navigation */
        .orders-tabs-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .orders-tabs {
            display: flex;
            gap: 8px;
            background: #f3e9ec;
            padding: 6px;
            border-radius: 16px;
        }
        .order-tab-btn {
            background: transparent;
            border: none;
            padding: 10px 18px;
            border-radius: 12px;
            font-family: 'Manrope', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: #6b555b;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .order-tab-btn:hover {
            color: var(--brand-maroon);
        }
        .order-tab-btn.active {
            background: #fff;
            color: var(--brand-maroon);
            box-shadow: 0 4px 12px rgba(115, 62, 70, 0.1);
        }
        .tab-badge {
            background: #eee3e6;
            color: var(--brand-maroon);
            font-size: 11px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 99px;
        }
        .order-tab-btn.active .tab-badge {
            background: var(--brand-pink-soft);
            color: var(--brand-maroon);
        }

        .refresh-sync-btn {
            background: #fff;
            border: 1.5px solid var(--brand-cream-border);
            padding: 10px 16px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 700;
            color: var(--brand-maroon);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .refresh-sync-btn:hover {
            background: var(--brand-pink-soft);
            border-color: var(--brand-pink);
        }
        .refresh-sync-btn svg.spin {
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* ===== ORDERS LIST CONTAINER ===== */
        .orders-feed {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        /* ORDER CARD */
        .order-card {
            background: #ffffff;
            border: 1.5px solid var(--brand-cream-border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(115, 62, 70, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .order-card:hover {
            box-shadow: 0 14px 32px rgba(115, 62, 70, 0.09);
        }

        /* Card Header */
        .card-header-bar {
            padding: 18px 24px;
            background: #fffbfb;
            border-bottom: 1px solid #f6eaed;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .card-header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .order-number {
            font-family: 'Manrope', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--brand-maroon);
            letter-spacing: 0.3px;
        }
        .order-date-text {
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .payment-pill {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        .payment-pill.qris {
            background: #e0f2fe;
            color: #0369a1;
        }
        .payment-pill.cash {
            background: #fef3c7;
            color: #b45309;
        }

        /* Status Badges */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 99px;
            font-size: 13px;
            font-weight: 700;
        }
        .status-pill.status-pending {
            background: #fffbeb;
            color: #b45309;
            border: 1px solid #fde68a;
        }
        .status-pill.status-processing {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }
        .status-pill.status-delivery {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }
        .status-pill.status-completed {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #86efac;
        }
        .status-pill.status-cancelled {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        /* ===== LIVE DELIVERY PROGRESS STEPPER ===== */
        .delivery-tracker-box {
            padding: 24px 28px 20px;
            background: linear-gradient(to bottom, #fffdfd, #ffffff);
            border-bottom: 1px solid #f7ecef;
        }
        .tracker-headline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }
        .tracker-title {
            font-size: 14px;
            font-weight: 700;
            color: #4b363b;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .tracker-state-desc {
            font-size: 13px;
            font-weight: 600;
            color: var(--brand-maroon);
        }

        /* Stepper UI */
        .stepper-progress-container {
            position: relative;
            margin: 10px 0 20px;
        }
        .stepper-track-bg {
            position: absolute;
            top: 18px;
            left: 36px;
            right: 36px;
            height: 5px;
            background: #f0dfe3;
            border-radius: 99px;
            z-index: 1;
        }
        .stepper-track-fill {
            position: absolute;
            top: 18px;
            left: 36px;
            height: 5px;
            background: linear-gradient(to right, var(--brand-maroon), #10b981);
            border-radius: 99px;
            z-index: 2;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stepper-steps {
            position: relative;
            z-index: 3;
            display: flex;
            justify-content: space-between;
        }
        .step-node {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 110px;
        }
        .step-bubble {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #e3d2d6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #9e888e;
            transition: all 0.3s;
            margin-bottom: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.04);
        }
        .step-node.completed .step-bubble {
            background: var(--brand-maroon);
            border-color: var(--brand-maroon);
            color: #fff;
        }
        .step-node.active .step-bubble {
            background: #fff;
            border-color: var(--brand-maroon);
            color: var(--brand-maroon);
            box-shadow: 0 0 0 5px rgba(115, 62, 70, 0.15);
            animation: pulseActiveStep 2s infinite;
        }
        @keyframes pulseActiveStep {
            0% { transform: scale(1); }
            50% { transform: scale(1.08); }
            100% { transform: scale(1); }
        }
        .step-node.completed.is-delivered .step-bubble,
        .step-node.active.is-delivered .step-bubble {
            background: #10b981;
            border-color: #10b981;
            color: #fff;
        }
        .step-label {
            font-size: 12px;
            font-weight: 700;
            color: #7b656b;
            line-height: 1.25;
        }
        .step-node.completed .step-label,
        .step-node.active .step-label {
            color: var(--text-dark);
        }
        .step-subtext {
            font-size: 10px;
            color: #a49196;
            margin-top: 3px;
        }

        /* Delivery Notice Alert in Card */
        .delivery-notice-banner {
            border-radius: 14px;
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 13px;
            margin-top: 14px;
        }
        .notice-processing {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            color: #0369a1;
        }
        .notice-completed {
            background: #ecfdf5;
            border: 1.5px solid #a7f3d0;
            color: #065f46;
        }
        .notice-pending {
            background: #fffbeb;
            border: 1px solid #fde68a;
            color: #92400e;
        }

        /* ===== CARD BODY (DETAILS & ITEMS) ===== */
        .card-body-content {
            padding: 22px 28px;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 24px;
        }
        @media (max-width: 820px) {
            .card-body-content {
                grid-template-columns: 1fr;
                padding: 20px;
            }
        }

        /* Items Section */
        .order-items-column h4,
        .order-meta-column h4 {
            font-size: 14px;
            font-weight: 800;
            color: var(--brand-maroon-dark);
            margin: 0 0 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .order-product-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .product-mini-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 12px;
            border-bottom: 1px dashed #f0dfe3;
        }
        .product-mini-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .product-info-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .product-mini-img {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            object-fit: cover;
            background: #f6e8ec;
            border: 1px solid #edd5dc;
        }
        .product-title-text {
            font-weight: 700;
            font-size: 14px;
            color: #2b181c;
        }
        .product-qty-tag {
            font-size: 12px;
            color: var(--brand-maroon);
            font-weight: 600;
        }
        .product-total-price {
            font-weight: 800;
            font-size: 14px;
            color: #44222a;
        }

        /* Meta / Delivery Details Column */
        .order-meta-column {
            background: #fffdfd;
            border: 1px solid #f6e6ea;
            border-radius: 18px;
            padding: 16px 18px;
        }
        .delivery-address-card {
            margin-bottom: 16px;
        }
        .delivery-address-card .label-muted {
            font-size: 11px;
            font-weight: 700;
            color: #9c8289;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .delivery-address-card .recipient-name {
            font-size: 14px;
            font-weight: 700;
            color: #2c181c;
        }
        .delivery-address-card .recipient-phone {
            font-size: 13px;
            color: #059669;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .delivery-address-card .address-text {
            font-size: 13px;
            color: #5c474d;
            line-height: 1.4;
            margin: 0;
        }

        /* Price Breakdown Rows */
        .price-breakdown {
            border-top: 1px dashed #f0dfe3;
            padding-top: 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .breakdown-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #6d585d;
        }
        .breakdown-row.total-row {
            font-size: 15px;
            font-weight: 800;
            color: var(--brand-maroon-dark);
            margin-top: 4px;
            padding-top: 6px;
            border-top: 1px solid #f2e2e6;
        }

        /* Card Footer Actions */
        .card-footer-actions {
            padding: 14px 28px 18px;
            background: #fff;
            border-top: 1px solid #f8eaed;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-left-info {
            font-size: 12px;
            color: #997e85;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .footer-buttons-group {
            display: flex;
            gap: 10px;
        }
        .btn-card-action {
            padding: 9px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
            border: none;
        }
        .btn-wa-store {
            background: #25d366;
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.25);
        }
        .btn-wa-store:hover {
            background: #20ba59;
            transform: translateY(-2px);
        }
        .btn-order-receipt {
            background: #fff;
            border: 1.5px solid var(--brand-cream-border);
            color: var(--brand-maroon);
        }
        .btn-order-receipt:hover {
            background: var(--brand-pink-soft);
            border-color: var(--brand-pink);
        }

        /* ===== EMPTY STATE ===== */
        .empty-orders-state {
            background: #fff;
            border: 2px dashed #eedde2;
            border-radius: 28px;
            padding: 60px 24px;
            text-align: center;
            max-width: 540px;
            margin: 40px auto;
        }
        .empty-icon-circle {
            width: 90px;
            height: 90px;
            background: var(--brand-pink-soft);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin: 0 auto 20px;
        }
        .empty-orders-state h3 {
            font-family: 'Manrope', sans-serif;
            font-size: 24px;
            color: var(--brand-maroon);
            margin: 0 0 10px;
        }
        .empty-orders-state p {
            font-size: 14px;
            color: var(--text-muted);
            margin: 0 0 24px;
            line-height: 1.5;
        }
        .btn-browse-menu {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--brand-maroon);
            color: #fff;
            padding: 14px 28px;
            border-radius: 14px;
            text-decoration: none;
            font-family: 'Manrope', sans-serif;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(115, 62, 70, 0.25);
            transition: all 0.2s;
        }
        .btn-browse-menu:hover {
            background: var(--brand-maroon-dark);
            transform: translateY(-2px);
        }

        /* Toast Popup */
        .toast-notify {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #1e293b;
            color: #fff;
            padding: 14px 22px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 16px 36px rgba(0,0,0,0.25);
            z-index: 9999;
            transform: translateY(60px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .toast-notify.show {
            transform: translateY(0);
            opacity: 1;
        }

        @media (max-width: 640px) {
            .stepper-steps {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
                padding-left: 20px;
            }
            .stepper-track-bg, .stepper-track-fill {
                display: none;
            }
            .step-node {
                flex-direction: row;
                gap: 14px;
                width: auto;
                text-align: left;
            }
            .step-bubble {
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body class="my-orders-page">

    <!-- Sticky Navbar -->
    <header class="main-navbar">
        <div class="navbar-container">
            <a href="{{ route('menu') }}" class="nav-brand">
                <span>🍦</span> Scoops &amp; delicios
            </a>
            
            <nav class="nav-links">
                <a href="{{ route('menu') }}" class="nav-link">Menu</a>
                <a href="{{ route('offers') }}" class="nav-link">Penawaran</a>
                <a href="{{ route('pesanan.saya') }}" class="nav-link active">Pesanan Saya</a>
                <a href="{{ route('contact') }}" class="nav-link">Hubungi Kami</a>
            </nav>

            <div class="nav-actions">
                <a href="{{ route('order') }}" class="icon-btn" aria-label="Keranjang & Checkout">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </a>

                <div class="user-menu-wrap">
                    <button class="icon-btn" id="userMenuBtn" onclick="toggleUserDropdown()" aria-label="Profil Saya">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="5"></circle>
                            <path d="M20 21a8 8 0 0 0-16 0"></path>
                        </svg>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <div class="user-info">
                            <strong>{{ auth()->user()->nama_lengkap ?? auth()->user()->name ?? 'Pelanggan Setia' }}</strong>
                            <small>{{ auth()->user()->email }}</small>
                        </div>
                        <div class="user-menu-links">
                            <a href="{{ route('pesanan.saya') }}">📦 Pesanan Saya</a>
                            <a href="{{ route('menu') }}">🍨 Katalog Menu</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-link">Keluar (Logout)</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="orders-main-content">
        <!-- Hero Header -->
        <section class="orders-hero">
            <div class="orders-hero-badge">
                <span class="pulse-dot"></span>
                <span>PELACAKAN DELIVERY REAL-TIME</span>
            </div>
            <h1>Pesanan &amp; Pengiriman Saya</h1>
            <p>Pantau es krim favorit Anda secara langsung. Saat pesanan diselesaikan di dapur toko, kurir kami otomatis segera mengantarkannya langsung ke tempat Anda.</p>
        </section>

        <!-- Tabs and Sync Bar -->
        <div class="orders-tabs-wrapper">
            <div class="orders-tabs">
                <span class="order-tab-btn active">
                    Pesanan yang Sedang Berjalan <span class="tab-badge" id="badgeActiveCount">{{ count($orders) }}</span>
                </span>
            </div>

            <button class="refresh-sync-btn" onclick="manualRefreshOrders()" id="btnSyncRefresh" title="Cek status terbaru dari toko">
                <svg id="syncIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                    <path d="M3 3v5h5"/>
                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/>
                    <path d="M16 21h5v-5"/>
                </svg>
                <span>Perbarui Status</span>
            </button>
        </div>

        <!-- Orders Container -->
        <div class="orders-feed" id="ordersFeed">
            @forelse ($orders as $order)
                @php
                    $status = strtolower($order->status_pesanan ?? 'pending');
                    $isSelesai = in_array($status, ['selesai', 'completed', 'done']);
                    $isDiproses = in_array($status, ['processing', 'diproses']);
                    $isDikirim = in_array($status, ['dikirim', 'shipped']);
                    $isBatal = in_array($status, ['batal', 'cancelled', 'dibatalkan']);
                    
                    // Hanya pesanan yang masih berjalan dikirim oleh controller.
                    $filterCategory = 'active';

                    // Stepper percentage
                    if ($isSelesai) {
                        $stepPercent = '100%';
                    } elseif ($isDikirim) {
                        $stepPercent = '78%';
                    } elseif ($isDiproses) {
                        $stepPercent = '50%';
                    } else {
                        $stepPercent = '20%';
                    }

                    // Format tanggal
                    $orderDate = \Carbon\Carbon::parse($order->tanggal_pesanan)->isoFormat('D MMMM Y, HH:mm');
                @endphp

                <article class="order-card" data-category="{{ $filterCategory }}" data-order-id="{{ $order->id }}" id="order-card-{{ $order->id }}">
                    <!-- Card Header -->
                    <div class="card-header-bar">
                        <div class="card-header-left">
                            <span class="order-number">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                            <span class="order-date-text">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                {{ $orderDate }}
                            </span>
                            <span class="payment-pill {{ strtolower($order->metode_pembayaran) === 'qris' ? 'qris' : 'cash' }}">
                                {{ strtoupper($order->metode_pembayaran) }}
                            </span>
                        </div>
                        <div class="card-header-right">
                            @if($isSelesai)
                                <span class="status-pill status-completed">
                                    <span>✨</span> Pesanan Selesai (Diantar)
                                </span>
                            @elseif($isDikirim)
                                <span class="status-pill status-delivery">
                                    <span>🛵</span> Sedang Diantarkan
                                </span>
                            @elseif($isDiproses)
                                <span class="status-pill status-processing">
                                    <span>🍨</span> Sedang Disiapkan Toko
                                </span>
                            @elseif($isBatal)
                                <span class="status-pill status-cancelled">
                                    <span>✕</span> Dibatalkan
                                </span>
                            @else
                                <span class="status-pill status-pending">
                                    <span>⏳</span> Menunggu Konfirmasi
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Live Delivery Stepper -->
                    <div class="delivery-tracker-box">
                        <div class="tracker-headline">
                            <div class="tracker-title">
                                <span>🛵 Status Pelacakan Pengiriman</span>
                            </div>
                            <div class="tracker-state-desc" id="status-desc-{{ $order->id }}">
                                @if($isSelesai)
                                    <span>✓ Selesai disiapkan &amp; Kurir menuju tempat Anda</span>
                                @elseif($isDikirim)
                                    <span>🛵 Dalam perjalanan diantar kurir ke alamat Anda</span>
                                @elseif($isDiproses)
                                    <span>🍨 Dapur toko sedang meracik es krim pilihan Anda</span>
                                @elseif($isBatal)
                                    <span>✕ Pesanan ini telah dibatalkan</span>
                                @else
                                    <span>⏳ Menunggu antrean dapur toko es krim</span>
                                @endif
                            </div>
                        </div>

                        <!-- 4 Step Delivery Stepper -->
                        <div class="stepper-progress-container">
                            <div class="stepper-track-bg"></div>
                            <div class="stepper-track-fill" id="track-fill-{{ $order->id }}" style="width: {{ $stepPercent }};"></div>
                            <div class="stepper-steps">
                                <!-- Step 1: Pesanan Dibuat -->
                                <div class="step-node completed" id="step1-{{ $order->id }}">
                                    <div class="step-bubble">📝</div>
                                    <span class="step-label">Pesanan Diterima</span>
                                    <span class="step-subtext">Masuk antrean</span>
                                </div>

                                <!-- Step 2: Sedang Diproses Toko -->
                                <div class="step-node {{ ($isDiproses || $isDikirim || $isSelesai) ? 'completed' : 'active' }}" id="step2-{{ $order->id }}">
                                    <div class="step-bubble">🍨</div>
                                    <span class="step-label">Diproses Toko</span>
                                    <span class="step-subtext">Persiapan es krim</span>
                                </div>

                                <!-- Step 3: Pesanan Selesai Disiapkan Admin -->
                                <div class="step-node {{ ($isDikirim || $isSelesai) ? 'completed' : ($isDiproses ? 'active' : '') }}" id="step3-{{ $order->id }}">
                                    <div class="step-bubble">✅</div>
                                    <span class="step-label">Selesai Disiapkan</span>
                                    <span class="step-subtext">Konfirmasi admin</span>
                                </div>

                                <!-- Step 4: Diantar ke Tempat -->
                                <div class="step-node {{ $isSelesai ? 'completed is-delivered' : ($isDikirim ? 'active is-delivered' : '') }}" id="step4-{{ $order->id }}">
                                    <div class="step-bubble">🛵</div>
                                    <span class="step-label">Diantar ke Tempat</span>
                                    <span class="step-subtext">Tiba di lokasi</span>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Notice Alert Banner -->
                        <div id="notice-banner-{{ $order->id }}">
                            @if($isSelesai || $isDikirim)
                                <div class="delivery-notice-banner notice-completed">
                                    <div style="font-size: 20px;">🛵</div>
                                    <div>
                                        <strong>Pesanan telah selesai disiapkan oleh Admin!</strong>
                                        <p style="margin: 2px 0 0; line-height: 1.4;">
                                            Es krim emberan dingin Anda kini siap / sedang dalam perjalanan diantarkan langsung ke alamat tujuan. Siapkan penerima di tempat!
                                        </p>
                                    </div>
                                </div>
                            @elseif($isDiproses)
                                <div class="delivery-notice-banner notice-processing">
                                    <div style="font-size: 20px;">🍨</div>
                                    <div>
                                        <strong>Sedang Diproses oleh Dapur Toko</strong>
                                        <p style="margin: 2px 0 0; line-height: 1.4;">
                                            Admin dan tim dapur sedang menyiapkan es krim dengan kemasan pendingin agar tetap segar dan beku saat tiba.
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="delivery-notice-banner notice-pending">
                                    <div style="font-size: 20px;">⏳</div>
                                    <div>
                                        <strong>Pesanan Baru Diterima</strong>
                                        <p style="margin: 2px 0 0; line-height: 1.4;">
                                            Pesanan Anda telah dicatat. Kami akan segera memulai peracikan begitu giliran antrean tiba.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body-content">
                        <!-- Items Column -->
                        <div class="order-items-column">
                            <h4>Rincian Produk ({{ count($order->items ?? []) }} Varian)</h4>
                            <div class="order-product-list">
                                @forelse ($order->items ?? [] as $item)
                                    <div class="product-mini-item">
                                        <div class="product-info-left">
                                            <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?auto=format&fit=crop&w=120&q=80' }}" alt="{{ $item->product_name }}" class="product-mini-img">
                                            <div>
                                                <div class="product-title-text">{{ $item->product_name }}</div>
                                                <div class="product-qty-tag">{{ $item->jumlah }} ember &times; Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</div>
                                            </div>
                                        </div>
                                        <div class="product-total-price">
                                            Rp {{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @empty
                                    <div style="color: #997e85; font-size: 13px;">Item produk es krim</div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Delivery Meta Column -->
                        <div class="order-meta-column">
                            <div class="delivery-address-card">
                                <h4>Tujuan Pengiriman</h4>
                                <div class="label-muted">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    Penerima
                                </div>
                                <div class="recipient-name">{{ auth()->user()->nama_lengkap ?? auth()->user()->name ?? 'Pelanggan' }}</div>
                                <div class="recipient-phone">📱 {{ auth()->user()->no_telepon ?? '-' }}</div>

                                <div class="label-muted" style="margin-top: 10px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    Alamat Tempat
                                </div>
                                <p class="address-text">{{ $order->alamat_pengiriman }}</p>
                            </div>

                            <!-- Total Summary -->
                            <div class="price-breakdown">
                                <div class="breakdown-row">
                                    <span>Ongkir Delivery</span>
                                    <span>Rp 10.000</span>
                                </div>
                                <div class="breakdown-row">
                                    <span>Metode Bayar</span>
                                    <strong style="text-transform: uppercase;">{{ $order->metode_pembayaran }}</strong>
                                </div>
                                <div class="breakdown-row total-row">
                                    <span>Total Tagihan</span>
                                    <span style="color: var(--brand-maroon);">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer Actions -->
                    <div class="card-footer-actions">
                        <div class="footer-left-info">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                            <span>Status diperbarui otomatis langsung dari admin toko</span>
                        </div>
                        <div class="footer-buttons-group">
                            @php
                                $waText = rawurlencode(
                                    "Halo Admin Scoops & Delicios! Saya ingin menanyakan status pesanan delivery saya:\n" .
                                    "No. Pesanan: #ORD-" . str_pad($order->id, 4, '0', STR_PAD_LEFT) . "\n" .
                                    "Nama: " . (auth()->user()->nama_lengkap ?? 'Pelanggan') . "\n" .
                                    "Alamat: " . $order->alamat_pengiriman . "\n" .
                                    "Total: Rp " . number_format($order->total_harga, 0, ',', '.') . "\n\n" .
                                    "Mohon informasi perkiraan waktu pengirimannya ya. Terima kasih! 🍦"
                                );
                            @endphp
                            <a href="https://wa.me/6281234567890?text={{ $waText }}" target="_blank" class="btn-card-action btn-wa-store">
                                <span>📱</span> Tanya Kurir / Toko
                            </a>
                            <button type="button" class="btn-card-action btn-order-receipt" onclick="printOrderSlip({{ $order->id }})">
                                <span>🖨️</span> Cetak Nota
                            </button>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-orders-state" id="emptyState">
                    <div class="empty-icon-circle">🍨</div>
                    <h3>Belum Ada Pesanan Aktif</h3>
                    <p>Anda belum memesan es krim. Pilih varian es krim lezat favorit keluarga Anda dan pesan dengan pengiriman delivery langsung ke rumah!</p>
                    <a href="{{ route('menu') }}" class="btn-browse-menu">
                        <span>Pilih Menu Es Krim</span>
                        <span>&#8594;</span>
                    </a>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Toast Notification -->
    <div class="toast-notify" id="toastNotify">
        <span id="toastMsg">Status pesanan diperbarui</span>
    </div>

    <!-- Hidden Printable Slip Container -->
    <div id="printSlipContainer" style="display: none;"></div>

    <script>
        // Real-time tracking data & state
        let currentTab = 'all';
        let previousStatuses = {};

        // Populate initial statuses
        document.querySelectorAll('.order-card').forEach(card => {
            const orderId = card.getAttribute('data-order-id');
            const statusPill = card.querySelector('.status-pill');
            if (orderId && statusPill) {
                previousStatuses[orderId] = statusPill.textContent.trim().toLowerCase();
            }
        });

        function updateTabCounts() {
            const cards = document.querySelectorAll('.order-card');
            let activeCount = 0;

            cards.forEach(c => {
                const cat = c.getAttribute('data-category');
                if (cat === 'active') activeCount++;
            });

            const elActive = document.getElementById('badgeActiveCount');

            if (elActive) elActive.textContent = activeCount;
        }
        updateTabCounts();

        function filterOrders(category, btn) {
            currentTab = category;
            document.querySelectorAll('.order-tab-btn').forEach(b => b.classList.remove('active'));
            if (btn) btn.classList.add('active');

            const cards = document.querySelectorAll('.order-card');
            cards.forEach(card => {
                const cat = card.getAttribute('data-category');
                if (category === 'all') {
                    card.style.display = 'block';
                } else if (category === 'active' && cat === 'active') {
                    card.style.display = 'block';
                } else if (category === 'completed' && cat === 'completed') {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function toggleUserDropdown() {
            const dd = document.getElementById('userDropdown');
            dd.classList.toggle('show');
        }
        window.addEventListener('click', function(e) {
            const btn = document.getElementById('userMenuBtn');
            const dd = document.getElementById('userDropdown');
            if (btn && dd && !btn.contains(e.target) && !dd.contains(e.target)) {
                dd.classList.remove('show');
            }
        });

        function showToast(msg) {
            const t = document.getElementById('toastNotify');
            const m = document.getElementById('toastMsg');
            m.innerHTML = msg;
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 4000);
        }

        // Auto Polling real-time updates from admin
        async function fetchLatestOrders(isManual = false) {
            const syncIcon = document.getElementById('syncIcon');
            if (isManual && syncIcon) syncIcon.classList.add('spin');

            try {
                const response = await fetch("{{ route('pesanan.saya.data') }}", {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) return;

                const data = await response.json();
                if (!data.success || !data.orders) return;

                const activeOrderIds = new Set(data.orders.map(order => String(order.id)));

                document.querySelectorAll('.order-card').forEach(card => {
                    if (!activeOrderIds.has(card.dataset.orderId)) {
                        card.remove();
                    }
                });

                data.orders.forEach(order => {
                    const card = document.getElementById(`order-card-${order.id}`);
                    if (!card) return;

                    const rawStatus = (order.status_pesanan || 'pending').toLowerCase();
                    const prevStatus = previousStatuses[order.id];

                    const isSelesai = ['selesai', 'completed', 'done'].includes(rawStatus);
                    const isDikirim = ['dikirim', 'shipped'].includes(rawStatus);
                    const isDiproses = ['processing', 'diproses'].includes(rawStatus);
                    const isBatal = ['batal', 'cancelled', 'dibatalkan'].includes(rawStatus);

                    const newCategory = 'active';
                    card.setAttribute('data-category', newCategory);

                    // Update Stepper
                    const trackFill = document.getElementById(`track-fill-${order.id}`);
                    const s1 = document.getElementById(`step1-${order.id}`);
                    const s2 = document.getElementById(`step2-${order.id}`);
                    const s3 = document.getElementById(`step3-${order.id}`);
                    const s4 = document.getElementById(`step4-${order.id}`);
                    const descEl = document.getElementById(`status-desc-${order.id}`);
                    const bannerEl = document.getElementById(`notice-banner-${order.id}`);
                    const headerRight = card.querySelector('.card-header-right');

                    if (isSelesai) {
                        if (trackFill) trackFill.style.width = '100%';
                        if (s2) s2.className = 'step-node completed';
                        if (s3) s3.className = 'step-node completed';
                        if (s4) s4.className = 'step-node completed is-delivered';
                        if (descEl) descEl.innerHTML = '<span>✓ Selesai disiapkan & Kurir menuju tempat Anda</span>';
                        if (headerRight) {
                            headerRight.innerHTML = '<span class="status-pill status-completed"><span>✨</span> Pesanan Selesai (Diantar)</span>';
                        }
                        if (bannerEl) {
                            bannerEl.innerHTML = `
                                <div class="delivery-notice-banner notice-completed">
                                    <div style="font-size: 20px;">🛵</div>
                                    <div>
                                        <strong>Pesanan telah selesai disiapkan oleh Admin!</strong>
                                        <p style="margin: 2px 0 0; line-height: 1.4;">
                                            Es krim pesanan Anda sudah selesai diracik dan siap / sedang dalam perjalanan diantarkan langsung ke tempat Anda!
                                        </p>
                                    </div>
                                </div>
                            `;
                        }

                        // Trigger celebratory toast if status just transitioned
                        if (prevStatus && !prevStatus.includes('selesai')) {
                            showToast(`🎉 <strong>Pesanan #ORD-${String(order.id).padStart(4, '0')}</strong> telah diselesaikan oleh admin & sedang diantarkan ke tempat Anda! 🛵`);
                        }

                    } else if (isDikirim) {
                        if (trackFill) trackFill.style.width = '78%';
                        if (s2) s2.className = 'step-node completed';
                        if (s3) s3.className = 'step-node completed';
                        if (s4) s4.className = 'step-node active is-delivered';
                        if (descEl) descEl.innerHTML = '<span>🛵 Dalam perjalanan diantar kurir ke alamat Anda</span>';
                        if (headerRight) {
                            headerRight.innerHTML = '<span class="status-pill status-delivery"><span>🛵</span> Sedang Diantarkan</span>';
                        }
                    } else if (isDiproses) {
                        if (trackFill) trackFill.style.width = '50%';
                        if (s2) s2.className = 'step-node completed';
                        if (s3) s3.className = 'step-node active';
                        if (s4) s4.className = 'step-node';
                        if (descEl) descEl.innerHTML = '<span>🍨 Dapur toko sedang meracik es krim pilihan Anda</span>';
                        if (headerRight) {
                            headerRight.innerHTML = '<span class="status-pill status-processing"><span>🍨</span> Sedang Disiapkan Toko</span>';
                        }
                    } else {
                        if (trackFill) trackFill.style.width = '20%';
                        if (s2) s2.className = 'step-node active';
                        if (s3) s3.className = 'step-node';
                        if (s4) s4.className = 'step-node';
                        if (descEl) descEl.innerHTML = '<span>⏳ Menunggu antrean dapur toko es krim</span>';
                        if (headerRight) {
                            headerRight.innerHTML = '<span class="status-pill status-pending"><span>⏳</span> Menunggu Konfirmasi</span>';
                        }
                    }

                    previousStatuses[order.id] = rawStatus;
                });

                updateTabCounts();
                filterOrders(currentTab);

                if (isManual) {
                    showToast('✓ Status pesanan berhasil diperbarui.');
                }
            } catch (err) {
                console.error('Error fetching live order updates:', err);
            } finally {
                if (isManual && syncIcon) {
                    setTimeout(() => syncIcon.classList.remove('spin'), 500);
                }
            }
        }

        function manualRefreshOrders() {
            fetchLatestOrders(true);
        }

        // Start live polling every 4 seconds
        setInterval(() => {
            fetchLatestOrders(false);
        }, 4000);

        function printOrderSlip(orderId) {
            const card = document.getElementById(`order-card-${orderId}`);
            if (!card) return;

            const printWindow = window.open('', '', 'width=450,height=650');
            const orderNum = card.querySelector('.order-number').textContent;
            const orderDate = card.querySelector('.order-date-text').textContent;
            const items = card.querySelector('.order-product-list').innerHTML;
            const address = card.querySelector('.address-text').textContent;
            const recipient = card.querySelector('.recipient-name').textContent;
            const phone = card.querySelector('.recipient-phone').textContent;
            const total = card.querySelector('.total-row span:last-child').textContent;
            const status = card.querySelector('.status-pill').textContent;

            printWindow.document.write(`
                <html>
                <head>
                    <title>Nota Pengiriman - ${orderNum}</title>
                    <style>
                        body { font-family: monospace; padding: 20px; line-height: 1.4; color: #111; }
                        .center { text-align: center; }
                        .line { border-top: 1px dashed #444; margin: 12px 0; }
                        .row { display: flex; justify-content: space-between; margin-bottom: 4px; }
                        h2, h3 { margin: 4px 0; }
                    </style>
                </head>
                <body>
                    <div class="center">
                        <h2>SCOOPS & DELICIOS</h2>
                        <p>Pesanan Delivery Es Krim Bulk<br>WA: 0812-3456-7890</p>
                    </div>
                    <div class="line"></div>
                    <div class="row"><span>Nomor:</span><strong>${orderNum}</strong></div>
                    <div class="row"><span>Waktu:</span><span>${orderDate}</span></div>
                    <div class="row"><span>Status:</span><span>${status}</span></div>
                    <div class="line"></div>
                    <div><strong>Alamat Pengantaran:</strong></div>
                    <div>${recipient} (${phone})</div>
                    <div>${address}</div>
                    <div class="line"></div>
                    <div><strong>Rincian Pesanan:</strong></div>
                    <div style="margin-top:8px;">${items}</div>
                    <div class="line"></div>
                    <div class="row" style="font-size:16px;"><span>Total:</span><strong>${total}</strong></div>
                    <div class="line"></div>
                    <div class="center" style="font-size:12px; margin-top:20px;">
                        *** Terima kasih telah memesan! ***<br>
                        Es krim siap dinikmati bersama keluarga tercinta.
                    </div>
                    <script>
                        window.onload = function() { window.print(); window.close(); };
                    <\/script>
                </body>
                </html>
            `);
            printWindow.document.close();
        }
    </script>
</body>
</html>
