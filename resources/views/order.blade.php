<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pesan Sekarang | Scoops &amp; delicios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ===== STYLES FOR CHECKOUT, PAYMENT & ORDER PROCESSING ===== */
        :root {
            --brand-maroon: #733e46;
            --brand-maroon-dark: #542930;
            --brand-pink: #ffb3c7;
            --brand-pink-soft: #fff0f4;
            --brand-cream: #fffdf5;
            --brand-cream-border: #f0e6e2;
            --qris-red: #d32f2f;
            --color-success: #10b981;
            --color-warning: #f59e0b;
        }

        /* Toast notification */
        .toast-notify {
            position: fixed;
            top: 24px;
            right: 24px;
            background: #1e293b;
            color: #fff;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.25);
            z-index: 9999;
            transform: translateY(-50px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }
        .toast-notify.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Customer Modal Overlay */
        .cust-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(43, 24, 28, 0.65);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            overflow-y: auto;
        }
        .cust-modal-backdrop.active {
            opacity: 1;
            visibility: visible;
        }

        /* Modal Dialog Box */
        .cust-modal-box {
            background: #ffffff;
            width: min(100%, 540px);
            max-height: 90vh;
            border-radius: 28px;
            box-shadow: 0 25px 60px -15px rgba(115, 62, 70, 0.35);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transform: scale(0.92) translateY(20px);
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 1px solid rgba(255, 230, 235, 0.8);
        }
        .cust-modal-backdrop.active .cust-modal-box {
            transform: scale(1) translateY(0);
        }

        .cust-modal-header {
            padding: 22px 28px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f8eaed;
            background: linear-gradient(to bottom, #fffbfb, #ffffff);
        }
        .cust-modal-header-text h3 {
            font-family: 'Manrope', sans-serif;
            font-size: 22px;
            color: var(--brand-maroon);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cust-modal-header-text p {
            font-size: 13px;
            color: #78666a;
            margin: 4px 0 0;
        }
        .cust-modal-close {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid #ebd9de;
            background: #fff5f7;
            color: var(--brand-maroon);
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .cust-modal-close:hover {
            background: #ffe3eb;
            transform: rotate(90deg);
        }

        .cust-modal-body {
            padding: 24px 28px;
            overflow-y: auto;
        }

        /* Bill Summary Banner inside Modal */
        .modal-bill-summary {
            background: linear-gradient(135deg, #fff7f9 0%, #fff0f4 100%);
            border: 1.5px dashed #f5c2cf;
            border-radius: 18px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }
        .modal-bill-summary .summary-label {
            font-size: 13px;
            color: #8a646c;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .modal-bill-summary .summary-total {
            font-family: 'Manrope', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--brand-maroon);
        }

        /* Payment Tabs Selector */
        .pay-tab-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 22px;
        }
        .pay-tab-card {
            border: 2px solid #ecdde1;
            background: #ffffff;
            border-radius: 16px;
            padding: 14px 16px;
            cursor: pointer;
            text-align: left;
            transition: all 0.25s ease;
            position: relative;
        }
        .pay-tab-card:hover {
            border-color: #f7b2c4;
            background: #fffafb;
        }
        .pay-tab-card.active {
            border-color: var(--brand-maroon);
            background: #fff2f5;
            box-shadow: 0 4px 16px rgba(115, 62, 70, 0.12);
        }
        .pay-tab-card .tab-badge {
            position: absolute;
            top: -10px;
            right: 12px;
            background: #10b981;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .pay-tab-card.active .tab-badge {
            background: var(--brand-maroon);
        }
        .pay-tab-card .tab-icon {
            font-size: 22px;
            margin-bottom: 6px;
            display: inline-block;
        }
        .pay-tab-card .tab-name {
            font-weight: 700;
            font-size: 15px;
            color: #3b2227;
            display: block;
        }
        .pay-tab-card .tab-desc {
            font-size: 11.5px;
            color: #8c7177;
            margin-top: 2px;
            display: block;
        }

        /* QRIS Standee / Card UI */
        .qris-standee-card {
            background: #ffffff;
            border: 2px solid #e8d5da;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }
        .qris-national-header {
            background: linear-gradient(135deg, #cc1c24 0%, #b3141c 100%);
            color: #ffffff;
            width: 100%;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .qris-national-header .qris-logo-text {
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 20px;
            letter-spacing: 1px;
            line-height: 1;
        }
        .qris-national-header .qris-subtitle {
            font-size: 9.5px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            opacity: 0.92;
        }
        .qris-merchant-info {
            padding: 12px 16px 6px;
            width: 100%;
        }
        .qris-merchant-info h4 {
            font-size: 16px;
            font-weight: 700;
            color: #29181b;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .qris-merchant-info span {
            font-size: 11px;
            color: #7e696d;
            font-family: monospace;
        }

        /* Dynamic QR Code Frame */
        .qris-qr-container {
            position: relative;
            background: #ffffff;
            padding: 14px;
            margin: 10px 0;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
            border: 1px solid #f0dfe3;
            display: inline-block;
        }
        .qris-qr-frame {
            width: 200px;
            height: 200px;
            display: block;
        }
        .qris-scan-line {
            position: absolute;
            left: 14px;
            right: 14px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #ff4071, #ff80a0, transparent);
            box-shadow: 0 0 12px #ff4071;
            border-radius: 3px;
            top: 20px;
            animation: qrisScan 2.4s ease-in-out infinite alternate;
            pointer-events: none;
        }
        @keyframes qrisScan {
            0% { top: 20px; opacity: 0.4; }
            50% { opacity: 1; }
            100% { top: 195px; opacity: 0.4; }
        }

        .qris-timer-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            color: #79575e;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .qris-timer-row .timer-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f59e0b;
            animation: pulseDot 1.4s infinite;
        }
        @keyframes pulseDot {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.4); opacity: 0.5; }
        }
        .qris-timer-val {
            font-family: monospace;
            font-weight: 700;
            color: #d97706;
            background: #fef3c7;
            padding: 2px 8px;
            border-radius: 6px;
        }

        /* Copy Nominal Box */
        .qris-copy-nominal-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fdf2f4;
            border: 1px solid #f7c9d4;
            border-radius: 12px;
            padding: 8px 14px;
            margin: 0 16px 14px;
            width: calc(100% - 32px);
        }
        .qris-copy-nominal-box .nominal-text {
            font-family: 'Manrope', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--brand-maroon);
        }
        .btn-copy-nominal {
            background: #ffffff;
            border: 1px solid #ebbec7;
            border-radius: 8px;
            padding: 4px 10px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--brand-maroon);
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-copy-nominal:hover {
            background: var(--brand-maroon);
            color: #fff;
        }

        /* Supported Payment Logos */
        .qris-supported-wallets {
            padding: 10px 16px 14px;
            width: 100%;
            border-top: 1px solid #f3e5e8;
            background: #faf6f7;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 8px;
        }
        .wallet-pill {
            background: #fff;
            border: 1px solid #e7d6da;
            border-radius: 6px;
            padding: 3px 8px;
            font-size: 10px;
            font-weight: 700;
            color: #61494e;
            letter-spacing: 0.3px;
        }

        /* QRIS Steps Guide */
        .qris-steps-list {
            text-align: left;
            background: #fffcfd;
            border: 1px solid #f0e3e6;
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 20px;
            list-style: none;
            counter-reset: qris-step;
        }
        .qris-steps-list li {
            font-size: 12.5px;
            color: #634b51;
            margin-bottom: 8px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .qris-steps-list li:last-child {
            margin-bottom: 0;
        }
        .qris-steps-list li::before {
            counter-increment: qris-step;
            content: counter(qris-step);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #ffe3eb;
            color: var(--brand-maroon);
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* CASH UI Card */
        .cash-instruction-card {
            background: #ffffff;
            border: 2px solid #ecdbe0;
            border-radius: 20px;
            padding: 24px 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .cash-icon-wrap {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #e8f5e9;
            color: #2e7d32;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 36px;
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.15);
        }
        .cash-instruction-card h4 {
            font-family: 'Manrope', sans-serif;
            font-size: 20px;
            color: #2e7d32;
            margin: 0 0 6px;
        }
        .cash-instruction-card p {
            font-size: 13.5px;
            color: #5c6b60;
            line-height: 1.5;
            margin: 0 0 16px;
        }
        .cash-amount-badge {
            background: #f1f8e9;
            border: 1.5px dashed #a5d6a7;
            border-radius: 12px;
            padding: 12px 18px;
            display: inline-block;
            margin-bottom: 14px;
        }
        .cash-amount-badge span {
            display: block;
            font-size: 12px;
            color: #388e3c;
            font-weight: 600;
        }
        .cash-amount-badge strong {
            font-family: 'Manrope', sans-serif;
            font-size: 24px;
            color: #1b5e20;
        }
        .cash-tips-box {
            background: #fdfbf7;
            border: 1px solid #faeccd;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12px;
            color: #856404;
            display: flex;
            align-items: center;
            gap: 8px;
            text-align: left;
        }

        /* Modal Footer Action Buttons */
        .modal-action-btn-main {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--brand-maroon) 0%, #8c3b4d 100%);
            color: #ffffff;
            border: none;
            border-radius: 16px;
            font-family: 'Manrope', sans-serif;
            font-size: 17px;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            box-shadow: 0 8px 22px rgba(115, 62, 70, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.25s;
        }
        .modal-action-btn-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(115, 62, 70, 0.4);
            filter: brightness(1.06);
        }
        .modal-action-btn-main:active {
            transform: translateY(0);
        }
        .modal-action-btn-main:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
        }

        /* ========================================================= */
        /* ===== ORDER PROCESSING LIVE TRACKER MODAL (ATTRACTIVE) ===== */
        /* ========================================================= */
        .processing-modal-box {
            background: #ffffff;
            width: min(100%, 640px);
            max-height: 94vh;
            border-radius: 32px;
            box-shadow: 0 30px 80px -10px rgba(78, 32, 40, 0.45);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(255, 215, 225, 0.8);
            transform: scale(0.92) translateY(20px);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .cust-modal-backdrop.active .processing-modal-box {
            transform: scale(1) translateY(0);
        }

        /* Processing Hero Animation Header */
        .process-hero-header {
            position: relative;
            background: linear-gradient(135deg, #733e46 0%, #542730 60%, #3e1b23 100%);
            color: #ffffff;
            padding: 36px 30px 28px;
            text-align: center;
            overflow: hidden;
        }
        /* Floating ice cream animation */
        .process-icecream-stage {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .process-ring {
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px dashed rgba(255, 179, 199, 0.4);
            animation: rotateRings 12s linear infinite;
        }
        .process-ring-2 {
            position: absolute;
            inset: -18px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.15);
            animation: pulseRings 3s ease-in-out infinite alternate;
        }
        @keyframes rotateRings {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes pulseRings {
            0% { transform: scale(0.92); opacity: 0.3; }
            100% { transform: scale(1.08); opacity: 0.8; }
        }
        .process-icecream-icon {
            font-size: 58px;
            animation: floatCone 2.5s ease-in-out infinite alternate;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.35));
            display: inline-block;
        }
        @keyframes floatCone {
            0% { transform: translateY(0) rotate(-3deg); }
            100% { transform: translateY(-10px) rotate(4deg); }
        }

        .process-hero-header h2 {
            font-family: 'Manrope', sans-serif;
            font-size: 26px;
            margin: 0 0 6px;
            color: #ffffff;
            letter-spacing: 0.5px;
        }
        .process-hero-header p {
            font-size: 13.5px;
            color: #ffd6df;
            margin: 0 0 16px;
            line-height: 1.4;
            max-width: 440px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Order No Badge */
        .process-order-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(8px);
            padding: 7px 18px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .process-order-badge span.label {
            font-size: 12px;
            color: #fce7ec;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .process-order-badge strong.code {
            font-family: 'Manrope', sans-serif;
            font-size: 18px;
            color: #ffebf0;
            letter-spacing: 1px;
        }
        .btn-copy-code {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-copy-code:hover {
            background: #fff;
            color: var(--brand-maroon);
        }

        /* Process Tracker Body */
        .process-tracker-body {
            padding: 26px 28px;
            overflow-y: auto;
            background: #fffbfc;
        }

        /* LIVE STATUS STEPPER */
        .order-stepper-wrap {
            background: #ffffff;
            border-radius: 20px;
            padding: 22px 18px;
            border: 1px solid #f5e4e8;
            box-shadow: 0 6px 20px rgba(115, 62, 70, 0.05);
            margin-bottom: 24px;
        }
        .stepper-header-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f8eaed;
        }
        .stepper-header-title h4 {
            font-family: 'Manrope', sans-serif;
            font-size: 17px;
            color: var(--brand-maroon);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .live-status-pill {
            background: #fef3c7;
            color: #b45309;
            font-size: 11.5px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .live-status-pill.success {
            background: #d1fae5;
            color: #065f46;
        }
        .live-status-pill .pulse-indicator {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
            animation: pulseDot 1.2s infinite;
        }

        .stepper-steps-flow {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            position: relative;
        }
        /* Connecting Line */
        .stepper-steps-flow::before {
            content: '';
            position: absolute;
            top: 22px;
            left: 36px;
            right: 36px;
            height: 3px;
            background: #ecdfe2;
            z-index: 1;
        }
        .stepper-progress-fill {
            position: absolute;
            top: 22px;
            left: 36px;
            height: 3px;
            background: linear-gradient(90deg, #10b981, #ff80a0);
            z-index: 2;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            width: 35%;
        }

        .step-item {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 80px;
        }
        .step-icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #ffffff;
            border: 3px solid #ecdfe2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #8c7379;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .step-item.completed .step-icon-circle {
            background: #10b981;
            border-color: #10b981;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);
        }
        .step-item.active .step-icon-circle {
            background: #fff;
            border-color: #ff4071;
            color: #ff4071;
            box-shadow: 0 0 0 6px rgba(255, 64, 113, 0.18);
            animation: pulseActiveStep 2s infinite;
        }
        @keyframes pulseActiveStep {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }
        .step-label {
            margin-top: 10px;
            font-size: 11.5px;
            font-weight: 700;
            color: #8c7379;
            line-height: 1.2;
        }
        .step-item.active .step-label {
            color: var(--brand-maroon);
        }
        .step-item.completed .step-label {
            color: #10b981;
        }
        .step-sub {
            font-size: 9.5px;
            color: #9e888e;
            margin-top: 3px;
        }

        /* Order Details Card inside Processing */
        .process-details-card {
            background: #ffffff;
            border: 1px solid #f5e4e8;
            border-radius: 20px;
            padding: 18px 20px;
            margin-bottom: 24px;
        }
        .process-details-card h5 {
            font-family: 'Manrope', sans-serif;
            font-size: 16px;
            color: var(--brand-maroon);
            margin: 0 0 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .process-items-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-bottom: 14px;
            border-bottom: 1px dashed #f0dfe3;
        }
        .proc-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
        }
        .proc-item-name {
            font-weight: 600;
            color: #3b2227;
        }
        .proc-item-qty {
            font-size: 11px;
            background: #fff0f4;
            color: var(--brand-maroon);
            padding: 2px 6px;
            border-radius: 6px;
            font-weight: 700;
            margin-left: 6px;
        }
        .proc-item-price {
            font-weight: 700;
            color: #542730;
        }

        .proc-meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            padding-top: 14px;
        }
        .proc-meta-item span {
            display: block;
            font-size: 11px;
            color: #8c7379;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        .proc-meta-item strong {
            font-size: 13px;
            color: #3b2227;
            margin-top: 2px;
            display: block;
        }
        .proc-meta-item p {
            font-size: 12px;
            color: #573f44;
            margin: 2px 0 0;
            line-height: 1.3;
        }

        /* Action Buttons Grid in Processing */
        .process-actions-grid {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .btn-whatsapp-chat {
            width: 100%;
            padding: 14px;
            background: #25d366;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            font-family: 'Manrope', sans-serif;
            font-size: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(37, 211, 102, 0.25);
            transition: all 0.2s;
        }
        .btn-whatsapp-chat:hover {
            background: #20ba59;
            transform: translateY(-2px);
        }
        .process-sub-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .btn-sub-action {
            padding: 12px;
            background: #ffffff;
            border: 1.5px solid #ecdde1;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 700;
            color: var(--brand-maroon);
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-sub-action:hover {
            border-color: var(--brand-maroon);
            background: #fff8f9;
        }
        .btn-sub-action.primary {
            background: var(--brand-maroon);
            color: #ffffff;
            border-color: var(--brand-maroon);
        }
        .btn-sub-action.primary:hover {
            background: var(--brand-maroon-dark);
        }

        /* Printable Receipt Hide by default */
        @media print {
            body * { visibility: hidden !important; }
            #printableReceipt, #printableReceipt * { visibility: visible !important; }
            #printableReceipt { position: fixed; left: 0; top: 0; width: 100%; }
        }
    </style>
</head>
<body class="menu-page order-page">
    <header class="main-navbar">
        <div class="navbar-container">
            <a href="{{ route('menu') }}" class="nav-brand">Scoops &amp; delicios</a>
            <nav class="nav-links">
                <a href="{{ route('menu') }}" class="nav-link">Menu</a>
                <a href="{{ route('offers') }}" class="nav-link">Penawaran</a>
                <a href="{{ route('pesanan.saya') }}" class="nav-link">Pesanan Saya</a>
                <a href="{{ route('contact') }}" class="nav-link">Hubungi Kami</a>
            </nav>
            <div class="nav-actions">
                <a href="{{ route('menu') }}" class="icon-btn cart-icon-btn" aria-label="Kembali ke menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-link">Keluar</button>
                </form>
            </div>
        </div>
    </header>

    <main class="order-main-content">
        <div class="order-page-header">
            <h1 class="order-title">Pesan Sekarang</h1>
            <p class="order-subtitle">Periksa kembali pilihan makanan lezat Anda sebelum melakukan pembayaran.</p>
        </div>

        <div class="order-layout">
            <div class="order-items-card">
                <div class="order-items-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <h2>Hitung Total Harga</h2>
                </div>
                <div class="order-items-list" id="orderItemsList"></div>
            </div>

            <div class="order-bill-card">
                <h3 class="bill-title">Total Tagihan</h3>
                <div class="bill-rows">
                    <div class="bill-row"><span>Subtotal</span><span id="billSubtotal">Rp 0</span></div>
                    <div class="bill-row bill-row-bonus"><span>Bulk Bonus (10%)</span><span class="bonus-value" id="billBonus">-Rp 0</span></div>
                    <div class="bill-row"><span>Delivery Fee</span><span>Rp 10.000</span></div>
                </div>
                <div class="bill-grand-total"><span>Grand Total</span><strong id="billGrandTotal">Rp 0</strong></div>
                
                <div class="payment-section">
                    <p class="payment-label">METODE PEMBAYARAN TERSEDIA</p>
                    <div class="payment-methods">
                        <button class="payment-method-btn active" type="button" data-method="qris" onclick="selectPayment(this)">QRIS</button>
                        <button class="payment-method-btn" type="button" data-method="cash" onclick="selectPayment(this)">CASH</button>
                    </div>
                </div>

                <div class="online-customer-form">
                    <h3>Data Pengiriman</h3>
                    <label>Nama Lengkap<input type="text" id="customerName" value="{{ auth()->user()->nama_lengkap ?? '' }}" placeholder="Nama penerima" required></label>
                    <label>Nomor Telepon<input type="tel" id="customerPhone" value="{{ auth()->user()->no_telepon ?? '' }}" placeholder="08xxxxxxxxxx" required></label>
                    <label>Alamat Lengkap<textarea id="customerAddress" rows="3" placeholder="Alamat pengiriman lengkap" required>{{ auth()->user()->alamat_lengkap ?? '' }}</textarea></label>
                </div>
                <button class="place-order-btn" type="button" onclick="openPaymentModal()"><span>Pesan Sekarang</span><span aria-hidden="true">&#8594;</span></button>
            </div>
        </div>

        <div class="bonus-banner" id="bonusBanner" style="display: none;">
            <div class="bonus-banner-left"><div class="bonus-icon-wrap">&#10024;</div><div><strong>Pembelian Besar?</strong><p>You've unlocked our Party Pack rewards!</p></div></div>
            <div class="bonus-banner-right">&#10003; <span><strong>Bonus Applied:</strong> 10% Discount + Free Topping</span></div>
        </div>
    </main>

    <!-- TOAST NOTIFICATION -->
    <div class="toast-notify" id="toastNotify">
        <span id="toastMsg">Pemberitahuan</span>
    </div>

    <!-- ======================================================= -->
    <!-- MODAL 1: PILIH METODE PEMBAYARAN (QRIS & CASH) -->
    <!-- ======================================================= -->
    <div class="cust-modal-backdrop" id="paymentModal">
        <div class="cust-modal-box">
            <div class="cust-modal-header">
                <div class="cust-modal-header-text">
                    <h3>🍦 Selesaikan Pembayaran</h3>
                    <p>Pilih kemudahan metode pembayaran pesanan Anda</p>
                </div>
                <button type="button" class="cust-modal-close" onclick="closePaymentModal()" aria-label="Tutup">&times;</button>
            </div>

            <div class="cust-modal-body">
                <!-- Bill total banner -->
                <div class="modal-bill-summary">
                    <div>
                        <div class="summary-label">Total yang Harus Dibayar</div>
                        <small style="color: #79575e;">Sudah termasuk ongkir & diskon</small>
                    </div>
                    <div class="summary-total" id="modalBillTotal">Rp 0</div>
                </div>

                <!-- Payment Method Toggle -->
                <div class="pay-tab-selector">
                    <div class="pay-tab-card active" id="tabQris" onclick="switchPaymentTab('qris')">
                        <span class="tab-badge">Instan</span>
                        <span class="tab-icon">📱</span>
                        <span class="tab-name">QRIS</span>
                        <span class="tab-desc">Semua E-Wallet &amp; Mobile Banking</span>
                    </div>
                    <div class="pay-tab-card" id="tabCash" onclick="switchPaymentTab('cash')">
                        <span class="tab-badge">COD</span>
                        <span class="tab-icon">💵</span>
                        <span class="tab-name">Tunai / Cash</span>
                        <span class="tab-desc">Bayar di Tempat saat Es Krim Tiba</span>
                    </div>
                </div>

                <!-- TAB CONTENT: QRIS -->
                <div id="qrisContent">
                    <div class="qris-standee-card">
                        <!-- National Header -->
                        <div class="qris-national-header">
                            <div class="qris-logo-text">QRIS</div>
                            <div class="qris-subtitle">Pembayaran Digital Nasional</div>
                        </div>

                        <!-- Merchant info -->
                        <div class="qris-merchant-info">
                            <h4>SCOOPS &amp; DELICIOS</h4>
                            <span>NMID: ID1020260910088</span>
                        </div>

                        <!-- Crisp Authentic SVG QR Code -->
                        <div class="qris-qr-container">
                            <div class="qris-scan-line"></div>
                            <svg class="qris-qr-frame" viewBox="0 0 240 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="240" height="240" fill="#ffffff" />
                                
                                <!-- Corner Position Marker 1: Top-Left -->
                                <rect x="15" y="15" width="54" height="54" rx="10" fill="#221115" />
                                <rect x="23" y="23" width="38" height="38" rx="6" fill="#ffffff" />
                                <rect x="31" y="31" width="22" height="22" rx="4" fill="#733e46" />

                                <!-- Corner Position Marker 2: Top-Right -->
                                <rect x="171" y="15" width="54" height="54" rx="10" fill="#221115" />
                                <rect x="179" y="23" width="38" height="38" rx="6" fill="#ffffff" />
                                <rect x="187" y="31" width="22" height="22" rx="4" fill="#733e46" />

                                <!-- Corner Position Marker 3: Bottom-Left -->
                                <rect x="15" y="171" width="54" height="54" rx="10" fill="#221115" />
                                <rect x="23" y="179" width="38" height="38" rx="6" fill="#ffffff" />
                                <rect x="31" y="187" width="22" height="22" rx="4" fill="#733e46" />

                                <!-- Timing Patterns -->
                                <g fill="#3b2025">
                                    <rect x="76" y="35" width="7" height="7" />
                                    <rect x="90" y="35" width="7" height="7" />
                                    <rect x="104" y="35" width="7" height="7" />
                                    <rect x="118" y="35" width="7" height="7" />
                                    <rect x="132" y="35" width="7" height="7" />
                                    <rect x="146" y="35" width="7" height="7" />
                                    <rect x="160" y="35" width="7" height="7" />

                                    <rect x="35" y="76" width="7" height="7" />
                                    <rect x="35" y="90" width="7" height="7" />
                                    <rect x="35" y="104" width="7" height="7" />
                                    <rect x="35" y="118" width="7" height="7" />
                                    <rect x="35" y="132" width="7" height="7" />
                                    <rect x="35" y="146" width="7" height="7" />
                                    <rect x="35" y="160" width="7" height="7" />
                                </g>

                                <!-- QR Matrix modules pattern -->
                                <g fill="#2e191d">
                                    <rect x="78" y="55" width="8" height="8" rx="1" />
                                    <rect x="92" y="55" width="8" height="8" rx="1" />
                                    <rect x="114" y="55" width="8" height="8" rx="1" />
                                    <rect x="142" y="55" width="8" height="8" rx="1" />
                                    <rect x="78" y="72" width="8" height="8" rx="1" />
                                    <rect x="100" y="72" width="8" height="8" rx="1" />
                                    <rect x="122" y="72" width="8" height="8" rx="1" />
                                    <rect x="156" y="72" width="8" height="8" rx="1" />
                                    <rect x="180" y="78" width="8" height="8" rx="1" />
                                    <rect x="198" y="78" width="8" height="8" rx="1" />
                                    <rect x="214" y="92" width="8" height="8" rx="1" />
                                    
                                    <rect x="55" y="85" width="8" height="8" rx="1" />
                                    <rect x="15" y="100" width="8" height="8" rx="1" />
                                    <rect x="32" y="114" width="8" height="8" rx="1" />
                                    <rect x="50" y="130" width="8" height="8" rx="1" />
                                    <rect x="18" y="145" width="8" height="8" rx="1" />

                                    <rect x="160" y="110" width="8" height="8" rx="1" />
                                    <rect x="178" y="125" width="8" height="8" rx="1" />
                                    <rect x="196" y="140" width="8" height="8" rx="1" />
                                    <rect x="170" y="155" width="8" height="8" rx="1" />
                                    <rect x="212" y="155" width="8" height="8" rx="1" />

                                    <rect x="85" y="170" width="8" height="8" rx="1" />
                                    <rect x="105" y="170" width="8" height="8" rx="1" />
                                    <rect x="125" y="185" width="8" height="8" rx="1" />
                                    <rect x="145" y="170" width="8" height="8" rx="1" />
                                    <rect x="165" y="185" width="8" height="8" rx="1" />
                                    <rect x="185" y="170" width="8" height="8" rx="1" />
                                    <rect x="205" y="185" width="8" height="8" rx="1" />
                                    <rect x="85" y="210" width="8" height="8" rx="1" />
                                    <rect x="110" y="210" width="8" height="8" rx="1" />
                                    <rect x="135" y="200" width="8" height="8" rx="1" />
                                    <rect x="155" y="210" width="8" height="8" rx="1" />
                                    <rect x="180" y="210" width="8" height="8" rx="1" />
                                    <rect x="205" y="205" width="8" height="8" rx="1" />
                                </g>

                                <!-- Central Badge Emblem (Ice Cream Cone) -->
                                <circle cx="120" cy="120" r="28" fill="#ffffff" stroke="#ffb3c7" stroke-width="4" />
                                <circle cx="120" cy="120" r="22" fill="#fff0f4" />
                                <!-- Mini ice cream SVG in center -->
                                <path d="M120 102 C113 102 108 107 108 113 C108 116 110 118 112 120 L120 133 L128 120 C130 118 132 116 132 113 C132 107 127 102 120 102 Z" fill="#733e46" />
                                <circle cx="120" cy="108" r="4" fill="#ff4071" />
                            </svg>
                        </div>

                        <!-- Real-time Timer -->
                        <div class="qris-timer-row">
                            <span class="timer-dot"></span>
                            <span>Sisa waktu pembayaran:</span>
                            <span class="qris-timer-val" id="qrisCountdown">14:59</span>
                        </div>

                        <!-- Copy Nominal Box -->
                        <div class="qris-copy-nominal-box">
                            <div>
                                <small style="display:block; font-size:10px; color:#8c7177; text-align:left;">NOMINAL PERSIS</small>
                                <div class="nominal-text" id="qrisCopyAmount">Rp 0</div>
                            </div>
                            <button type="button" class="btn-copy-nominal" id="btnCopyNominal" onclick="copyNominalAmount()">Salin</button>
                        </div>

                        <!-- Supported Payment Networks -->
                        <div class="qris-supported-wallets">
                            <span class="wallet-pill">BCA</span>
                            <span class="wallet-pill">MANDIRI</span>
                            <span class="wallet-pill">BRI</span>
                            <span class="wallet-pill">BNI</span>
                            <span class="wallet-pill">GOPAY</span>
                            <span class="wallet-pill">OVO</span>
                            <span class="wallet-pill">SHOPEEPAY</span>
                            <span class="wallet-pill">DANA</span>
                        </div>
                    </div>

                    <!-- Steps -->
                    <ol class="qris-steps-list">
                        <li>Buka aplikasi m-Banking atau E-Wallet pilihan Anda (BCA, GoPay, OVO, ShopeePay, dll).</li>
                        <li>Pilih menu <strong>Scan / Bayar QRIS</strong> dan arahkan kamera ke kode QR di atas.</li>
                        <li>Pastikan nama merchant tertera <strong>SCOOPS &amp; DELICIOS</strong>.</li>
                        <li>Selesaikan pembayaran, lalu klik tombol <strong>"Saya Sudah Bayar"</strong> berikut.</li>
                    </ol>

                    <button class="modal-action-btn-main" id="btnConfirmQris" type="button" onclick="confirmPaymentAndOrder('qris')">
                        <span>✓ Saya Sudah Bayar Sekarang</span>
                    </button>
                </div>

                <!-- TAB CONTENT: CASH -->
                <div id="cashContent" style="display: none;">
                    <div class="cash-instruction-card">
                        <div class="cash-icon-wrap">💵</div>
                        <h4>Bayar Tunai di Tempat (COD)</h4>
                        <p>Bayar langsung ke kurir saat es krim tiba di lokasi Anda, atau bayar di kasir outlet saat pesanan diambil.</p>
                        
                        <div class="cash-amount-badge">
                            <span>SIAPKAN UANG TUNAI SEBESAR</span>
                            <strong id="cashExactAmount">Rp 0</strong>
                        </div>

                        <div class="cash-tips-box">
                            <span>💡</span>
                            <span>Disarankan menyiapkan <strong>uang pas</strong> untuk mempercepat serah terima pesanan Anda.</span>
                        </div>
                    </div>

                    <button class="modal-action-btn-main" id="btnConfirmCash" type="button" onclick="confirmPaymentAndOrder('cash')">
                        <span>✓ Konfirmasi Pesanan Tunai</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================= -->
    <!-- MODAL 2: PESANAN SEDANG DIPROSES (LIVE TRACKER INTERAKTIF) -->
    <!-- ======================================================= -->
    <div class="cust-modal-backdrop" id="processingModal">
        <div class="processing-modal-box">
            <!-- Hero with floating ice cream animation -->
            <div class="process-hero-header">
                <div class="process-icecream-stage">
                    <div class="process-ring"></div>
                    <div class="process-ring-2"></div>
                    <span class="process-icecream-icon">🍨</span>
                </div>
                <h2>Pesanan Sedang Diproses!</h2>
                <p>Hore! Pesanan es krim favorit Anda telah diterima dan diteruskan ke Terminal Kasir &amp; Dapur.</p>

                <div class="process-order-badge">
                    <span class="label">No. Pesanan:</span>
                    <strong class="code" id="trackerOrderNo">#ORD-0000</strong>
                    <button type="button" class="btn-copy-code" id="btnCopyOrderNo" onclick="copyOrderNumber()">Salin</button>
                </div>
            </div>

            <!-- Tracker Body -->
            <div class="process-tracker-body">
                <!-- Live Stepper Tracker -->
                <div class="order-stepper-wrap">
                    <div class="stepper-header-title">
                        <h4>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            Status Pesanan Terkini
                        </h4>
                        <div class="live-status-pill" id="trackerStatusPill">
                            <span class="pulse-indicator"></span>
                            <span id="trackerStatusText">Sedang Diproses</span>
                        </div>
                    </div>

                    <div class="stepper-steps-flow">
                        <div class="stepper-progress-fill" id="stepperProgressBar" style="width: 33%;"></div>
                        
                        <!-- Step 1 -->
                        <div class="step-item completed" id="step1">
                            <div class="step-icon-circle">✓</div>
                            <div class="step-label">Diterima</div>
                            <div class="step-sub">Sistem kasir</div>
                        </div>

                        <!-- Step 2 -->
                        <div class="step-item active" id="step2">
                            <div class="step-icon-circle">🍨</div>
                            <div class="step-label">Disiapkan</div>
                            <div class="step-sub">Dapur es krim</div>
                        </div>

                        <!-- Step 3 -->
                        <div class="step-item" id="step3">
                            <div class="step-icon-circle">🛵</div>
                            <div class="step-label">Diantar</div>
                            <div class="step-sub">Menuju Anda</div>
                        </div>

                        <!-- Step 4 -->
                        <div class="step-item" id="step4">
                            <div class="step-icon-circle">✨</div>
                            <div class="step-label">Selesai</div>
                            <div class="step-sub">Selamat menikmati</div>
                        </div>
                    </div>
                </div>

                <!-- Order Details Card -->
                <div class="process-details-card">
                    <h5>
                        <span>Rincian Pesanan</span>
                        <span style="font-size:12px; font-weight:600; color:#10b981;" id="trackerPaymentBadge">QRIS Terverifikasi</span>
                    </h5>

                    <!-- Items breakdown -->
                    <div class="process-items-list" id="trackerItemsList">
                        <!-- Populated via JS -->
                    </div>

                    <!-- Meta information -->
                    <div class="proc-meta-grid">
                        <div class="proc-meta-item">
                            <span>Estimasi Tiba:</span>
                            <strong style="color:var(--brand-maroon);">⏱️ 10 - 20 Menit</strong>
                        </div>
                        <div class="proc-meta-item">
                            <span>Total Pembayaran:</span>
                            <strong id="trackerGrandTotal">Rp 0</strong>
                        </div>
                        <div class="proc-meta-item" style="grid-column: span 2;">
                            <span>Tujuan Pengiriman:</span>
                            <p id="trackerAddressText">-</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="process-actions-grid">
                    <a href="#" class="btn-whatsapp-chat" id="btnWhatsappLink" target="_blank" rel="noopener">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12 0 2.159.57 4.184 1.564 5.938l-1.564 5.718 5.86-1.536c1.696.924 3.639 1.458 5.704 1.458 6.627 0 12-5.373 12-12 0-6.627-5.373-12-12-12z"/></svg>
                        <span>Tanya Kasir via WhatsApp</span>
                    </a>
                    
                    <div class="process-sub-actions">
                        <button type="button" class="btn-sub-action" onclick="printReceipt()">
                            🖨️ Cetak Struk
                        </button>
                        <a href="{{ route('menu') }}" class="btn-sub-action">
                            🍦 Pesan Menu Lain
                        </a>
                        <a href="{{ route('pesanan.saya') }}" class="btn-sub-action primary" style="grid-column: span 2; padding: 13px; font-size: 14px;">
                            📦 Pantau Pengiriman di "Pesanan Saya"
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Printable Thermal Receipt Structure -->
    <div id="printableReceipt" style="display:none;">
        <div style="font-family: monospace; font-size: 12px; width: 280px; margin: 0 auto; padding: 20px; line-height: 1.4;">
            <div style="text-align: center; margin-bottom: 12px;">
                <h3 style="margin: 0; font-size: 16px;">SCOOPS &amp; DELICIOS</h3>
                <p style="margin: 2px 0; font-size: 10px;">Es Krim Lezat Keluarga</p>
                <p style="margin: 2px 0; font-size: 9px;">Jakarta, Indonesia | Telp: (555) 123-4567</p>
            </div>
            <div style="border-top: 1px dashed #000; border-bottom: 1px dashed #000; padding: 6px 0; margin-bottom: 10px; font-size: 10px;">
                <div>No. Pesanan : <span id="recOrderNo">#ORD-0000</span></div>
                <div>Tanggal     : <span id="recDate">-</span></div>
                <div>Pelanggan   : <span id="recCustName">-</span></div>
                <div>Metode Bayar: <span id="recPayment">-</span></div>
            </div>
            <div id="recItemsList" style="margin-bottom: 10px; font-size: 10px;"></div>
            <div style="border-top: 1px dashed #000; padding-top: 6px; font-size: 11px;">
                <div style="display: flex; justify-content: space-between;"><span>Subtotal:</span><span id="recSubtotal">Rp 0</span></div>
                <div style="display: flex; justify-content: space-between;"><span>Ongkir:</span><span>Rp 10.000</span></div>
                <div style="display: flex; justify-content: space-between; font-weight: bold; margin-top: 4px;"><span>GRAND TOTAL:</span><span id="recGrandTotal">Rp 0</span></div>
            </div>
            <div style="text-align: center; margin-top: 14px; font-size: 9px;">
                <p>Terima kasih atas pesanan Anda!<br>Semoga hari Anda semanis es krim kami.</p>
            </div>
        </div>
    </div>

    <script>
        const menuUrl = "{{ route('menu') }}";
        const fallbackImage = 'https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?auto=format&fit=crop&w=120&q=80';
        const storedCart = JSON.parse(sessionStorage.getItem('eskrim_cart') || '[]');
        const cart = storedCart.filter(item => Number.isInteger(Number(item.product_id)) && Number(item.product_id) > 0);
        const formatRupiah = value => 'Rp ' + Number(value).toLocaleString('id-ID');

        let selectedPaymentMethod = 'qris';
        let countdownInterval = null;
        let pollingInterval = null;
        let currentOrderId = null;
        let calculatedGrandTotal = 0;

        if (cart.length !== storedCart.length) {
            sessionStorage.setItem('eskrim_cart', JSON.stringify(cart));
        }

        function showToast(message, isSuccess = true) {
            const toast = document.getElementById('toastNotify');
            const msg = document.getElementById('toastMsg');
            msg.textContent = message;
            toast.style.background = isSuccess ? '#1e293b' : '#991b1b';
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3200);
        }

        function calculateTotals() {
            const subtotal = cart.reduce((total, item) => total + item.price * item.qty, 0);
            const quantity = cart.reduce((total, item) => total + item.qty, 0);
            const bonus = quantity >= 3 ? Math.round(subtotal * 0.1) : 0;
            const grandTotal = cart.length ? (subtotal - bonus + 10000) : 0;
            return { subtotal, quantity, bonus, grandTotal };
        }

        function renderOrder() {
            const list = document.getElementById('orderItemsList');
            const totals = calculateTotals();
            calculatedGrandTotal = totals.grandTotal;

            list.innerHTML = cart.length ? cart.map((item, index) => `
                <div class="order-item-row">
                    <div class="order-item-left">
                        <img class="order-item-img" src="${item.image || fallbackImage}" alt="${item.name}">
                        <div class="order-item-info">
                            <span class="order-item-name">${item.name}</span>
                            <span class="order-item-detail">Satu Scoop Reguler</span>
                            <div class="order-item-qty-wrap">
                                <button class="order-qty-btn" type="button" onclick="changeQty(${index}, -1)">-</button>
                                <span class="order-qty-val">${item.qty}</span>
                                <button class="order-qty-btn" type="button" onclick="changeQty(${index}, 1)">+</button>
                            </div>
                        </div>
                    </div>
                    <span class="order-item-price">${formatRupiah(item.price * item.qty)}</span>
                </div>`).join('') : `<p class="empty-cart-msg">Belum ada menu yang dipilih. <a href="${menuUrl}">Kembali ke menu</a></p>`;

            document.getElementById('billSubtotal').textContent = formatRupiah(totals.subtotal);
            document.getElementById('billBonus').textContent = '-' + formatRupiah(totals.bonus);
            document.getElementById('billGrandTotal').textContent = formatRupiah(totals.grandTotal);
            document.getElementById('bonusBanner').style.display = totals.bonus ? 'flex' : 'none';
        }

        function changeQty(index, amount) {
            cart[index].qty += amount;
            if (cart[index].qty < 1) cart.splice(index, 1);
            sessionStorage.setItem('eskrim_cart', JSON.stringify(cart));
            renderOrder();
        }

        function selectPayment(button) {
            document.querySelectorAll('.payment-method-btn').forEach(item => item.classList.remove('active'));
            button.classList.add('active');
            selectedPaymentMethod = button.dataset.method || 'qris';
        }

        function openPaymentModal() {
            if (!cart.length) {
                showToast('Keranjang belanja Anda masih kosong.', false);
                return;
            }

            const name = document.getElementById('customerName').value.trim();
            const phone = document.getElementById('customerPhone').value.trim();
            const address = document.getElementById('customerAddress').value.trim();

            if (!name) {
                showToast('Mohon isi nama lengkap Anda.', false);
                document.getElementById('customerName').focus();
                return;
            }
            if (!phone) {
                showToast('Mohon isi nomor telepon penerima.', false);
                document.getElementById('customerPhone').focus();
                return;
            }
            if (!address) {
                showToast('Mohon isi alamat lengkap pengiriman.', false);
                document.getElementById('customerAddress').focus();
                return;
            }

            const totals = calculateTotals();
            calculatedGrandTotal = totals.grandTotal;

            document.getElementById('modalBillTotal').textContent = formatRupiah(totals.grandTotal);
            document.getElementById('qrisCopyAmount').textContent = formatRupiah(totals.grandTotal);
            document.getElementById('cashExactAmount').textContent = formatRupiah(totals.grandTotal);

            switchPaymentTab(selectedPaymentMethod);
            startQrisCountdown();

            document.getElementById('paymentModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.remove('active');
            document.body.style.overflow = '';
            if (countdownInterval) clearInterval(countdownInterval);
        }

        function switchPaymentTab(method) {
            selectedPaymentMethod = method;
            const tabQris = document.getElementById('tabQris');
            const tabCash = document.getElementById('tabCash');
            const qrisContent = document.getElementById('qrisContent');
            const cashContent = document.getElementById('cashContent');

            if (method === 'qris') {
                tabQris.classList.add('active');
                tabCash.classList.remove('active');
                qrisContent.style.display = 'block';
                cashContent.style.display = 'none';
            } else {
                tabCash.classList.add('active');
                tabQris.classList.remove('active');
                cashContent.style.display = 'block';
                qrisContent.style.display = 'none';
            }
        }

        function startQrisCountdown() {
            if (countdownInterval) clearInterval(countdownInterval);
            let durationSeconds = 15 * 60;
            const timerDisplay = document.getElementById('qrisCountdown');

            countdownInterval = setInterval(() => {
                const minutes = Math.floor(durationSeconds / 60);
                const seconds = durationSeconds % 60;
                timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                
                if (--durationSeconds < 0) {
                    clearInterval(countdownInterval);
                    timerDisplay.textContent = 'Kedaluwarsa';
                }
            }, 1000);
        }

        function copyNominalAmount() {
            const btn = document.getElementById('btnCopyNominal');
            navigator.clipboard.writeText(calculatedGrandTotal.toString()).then(() => {
                btn.textContent = '✓ Disalin!';
                btn.style.background = '#10b981';
                btn.style.color = '#fff';
                setTimeout(() => {
                    btn.textContent = 'Salin';
                    btn.style.background = '';
                    btn.style.color = '';
                }, 2000);
            }).catch(() => {
                showToast('Nominal: ' + formatRupiah(calculatedGrandTotal));
            });
        }

        function copyOrderNumber() {
            const codeEl = document.getElementById('trackerOrderNo');
            const btn = document.getElementById('btnCopyOrderNo');
            navigator.clipboard.writeText(codeEl.textContent).then(() => {
                btn.textContent = '✓ Tersalin';
                setTimeout(() => { btn.textContent = 'Salin'; }, 2000);
            });
        }

        function confirmPaymentAndOrder(method) {
            const name = document.getElementById('customerName').value.trim();
            const phone = document.getElementById('customerPhone').value.trim();
            const address = document.getElementById('customerAddress').value.trim();

            const confirmBtn = method === 'qris' ? document.getElementById('btnConfirmQris') : document.getElementById('btnConfirmCash');
            const originalText = confirmBtn.innerHTML;
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = '<span>⏳ Memproses pesanan...</span>';

            fetch("{{ route('orders.store') }}", {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    name,
                    phone,
                    address,
                    payment_method: method,
                    items: cart.map(item => ({ product_id: item.product_id, qty: item.qty })),
                }),
            }).then(async response => {
                const responseText = await response.text();
                let result;

                try {
                    result = JSON.parse(responseText);
                } catch {
                    throw new Error('Sesi atau server tidak valid. Silakan refresh halaman lalu coba lagi.');
                }

                if (!response.ok) {
                    const validationMessage = result.errors ? Object.values(result.errors).flat()[0] : null;
                    throw new Error(validationMessage || result.message || 'Pesanan gagal dibuat.');
                }

                // Close payment modal
                closePaymentModal();

                // Save order snapshot for receipt & display before clearing cart
                const orderSnapshot = {
                    orderId: result.order_id,
                    orderNo: '#ORD-' + String(result.order_id).padStart(4, '0'),
                    customerName: name,
                    customerPhone: phone,
                    customerAddress: address,
                    paymentMethod: method,
                    items: [...cart],
                    totals: calculateTotals(),
                    date: new Date().toLocaleString('id-ID'),
                };

                // Clear cart in session storage
                sessionStorage.removeItem('eskrim_cart');

                // Launch the Attractive Order Processing Tracker Modal
                showProcessingModal(orderSnapshot);

            }).catch(error => {
                showToast(error.message, false);
                confirmBtn.disabled = false;
                confirmBtn.innerHTML = originalText;
            });
        }

        function showProcessingModal(orderData) {
            currentOrderId = orderData.orderId;

            document.getElementById('trackerOrderNo').textContent = orderData.orderNo;
            document.getElementById('trackerAddressText').textContent = `${orderData.customerName} (${orderData.customerPhone}) - ${orderData.customerAddress}`;
            document.getElementById('trackerGrandTotal').textContent = formatRupiah(orderData.totals.grandTotal);

            const paymentBadge = document.getElementById('trackerPaymentBadge');
            if (orderData.paymentMethod === 'qris') {
                paymentBadge.textContent = '📱 QRIS (Verifikasi Kasir)';
                paymentBadge.style.color = '#0284c7';
            } else {
                paymentBadge.textContent = '💵 Tunai saat Tiba';
                paymentBadge.style.color = '#16a34a';
            }

            // Render items in modal
            const itemsListEl = document.getElementById('trackerItemsList');
            itemsListEl.innerHTML = orderData.items.map(item => `
                <div class="proc-item-row">
                    <div>
                        <span class="proc-item-name">${item.name}</span>
                        <span class="proc-item-qty">${item.qty}x</span>
                    </div>
                    <span class="proc-item-price">${formatRupiah(item.price * item.qty)}</span>
                </div>
            `).join('');

            // Setup WhatsApp link
            const waMessage = encodeURIComponent(
                `Halo Scoops & Delicios! Saya ingin menanyakan pesanan saya:\n` +
                `No. Pesanan: ${orderData.orderNo}\n` +
                `Nama: ${orderData.customerName}\n` +
                `Metode Bayar: ${orderData.paymentMethod.toUpperCase()}\n` +
                `Total: ${formatRupiah(orderData.totals.grandTotal)}\n\n` +
                `Mohon informasinya mengenai status pemrosesan pesanan saya. Terima kasih! 🍦`
            );
            document.getElementById('btnWhatsappLink').href = `https://wa.me/6281234567890?text=${waMessage}`;

            // Setup printable receipt elements
            document.getElementById('recOrderNo').textContent = orderData.orderNo;
            document.getElementById('recDate').textContent = orderData.date;
            document.getElementById('recCustName').textContent = orderData.customerName;
            document.getElementById('recPayment').textContent = orderData.paymentMethod.toUpperCase();
            document.getElementById('recSubtotal').textContent = formatRupiah(orderData.totals.subtotal);
            document.getElementById('recGrandTotal').textContent = formatRupiah(orderData.totals.grandTotal);
            document.getElementById('recItemsList').innerHTML = orderData.items.map(item => `
                <div style="display:flex; justify-content:space-between; margin-bottom:2px;">
                    <span>${item.qty}x ${item.name}</span>
                    <span>${formatRupiah(item.price * item.qty)}</span>
                </div>
            `).join('');

            // Display processing modal
            document.getElementById('processingModal').classList.add('active');
            document.body.style.overflow = 'hidden';

            // Start polling order status from server
            pollOrderStatus(orderData.orderId);
        }

        function updateStepperStatus(status) {
            const statusPill = document.getElementById('trackerStatusPill');
            const statusText = document.getElementById('trackerStatusText');
            const progressBar = document.getElementById('stepperProgressBar');

            const s1 = document.getElementById('step1');
            const s2 = document.getElementById('step2');
            const s3 = document.getElementById('step3');
            const s4 = document.getElementById('step4');

            const normalized = (status || 'pending').toLowerCase();

            if (normalized === 'pending' || normalized === 'menunggu') {
                statusText.textContent = 'Pesanan Diterima';
                statusPill.className = 'live-status-pill';
                progressBar.style.width = '33%';
                s1.className = 'step-item completed';
                s2.className = 'step-item active';
                s3.className = 'step-item';
                s4.className = 'step-item';
            } else if (normalized === 'diproses' || normalized === 'processing') {
                statusText.textContent = 'Sedang Disiapkan 🍨';
                statusPill.className = 'live-status-pill';
                progressBar.style.width = '55%';
                s1.className = 'step-item completed';
                s2.className = 'step-item completed';
                s3.className = 'step-item active';
                s4.className = 'step-item';
            } else if (normalized === 'dikirim' || normalized === 'shipped') {
                statusText.textContent = 'Sedang Diantar 🛵';
                statusPill.className = 'live-status-pill';
                progressBar.style.width = '78%';
                s1.className = 'step-item completed';
                s2.className = 'step-item completed';
                s3.className = 'step-item completed';
                s4.className = 'step-item active';
            } else if (normalized === 'selesai' || normalized === 'completed') {
                statusText.textContent = 'Pesanan Selesai ✨';
                statusPill.className = 'live-status-pill success';
                progressBar.style.width = '100%';
                s1.className = 'step-item completed';
                s2.className = 'step-item completed';
                s3.className = 'step-item completed';
                s4.className = 'step-item completed';
            }
        }

        function pollOrderStatus(orderId) {
            if (pollingInterval) clearInterval(pollingInterval);

            // Fetch immediately once
            fetch(`/orders/${orderId}/status`, {
                headers: { 'Accept': 'application/json' }
            }).then(r => r.json()).then(data => {
                if (data.success && data.order) {
                    updateStepperStatus(data.order.status);
                }
            }).catch(() => {});

            // Polling interval every 4 seconds
            pollingInterval = setInterval(() => {
                fetch(`/orders/${orderId}/status`, {
                    headers: { 'Accept': 'application/json' }
                }).then(r => r.json()).then(data => {
                    if (data.success && data.order) {
                        updateStepperStatus(data.order.status);
                        if (data.order.status === 'selesai') {
                            clearInterval(pollingInterval);
                        }
                    }
                }).catch(() => {});
            }, 4000);
        }

        function printReceipt() {
            const printContent = document.getElementById('printableReceipt').innerHTML;
            const printWindow = window.open('', '', 'width=400,height=600');
            printWindow.document.write(`
                <html>
                <head>
                    <title>Struk Pesanan - Scoops &amp; delicios</title>
                    <style>
                        body { margin: 0; padding: 10px; font-family: monospace; }
                    </style>
                </head>
                <body>
                    ${printContent}
                    <script>
                        window.onload = function() {
                            window.print();
                            setTimeout(() => { window.close(); }, 500);
                        };
                    <\/script>
                </body>
                </html>
            `);
            printWindow.document.close();
        }

        renderOrder();
    </script>
</body>
</html>
