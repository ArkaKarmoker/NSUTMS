<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
$user_role = $is_logged_in ? $_SESSION['role'] : '';

$dashboard_link = "login.php";
if ($is_logged_in) {
    if ($user_role == 'student') {
        $dashboard_link = "student/dashboard.php";
    } else if ($user_role == 'driver') {
        $dashboard_link = "driver/dashboard.php";
    } else if ($user_role == 'admin') {
        $dashboard_link = "admin/dashboard.php";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSUTMS - North South University Transportation Management System</title>

    <meta name="description"
        content="Official Transportation Management System for North South University (NSUTMS). Real-time tracking, digital ticketing, and smart scheduling.">
    <meta name="theme-color" content="#003057">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-navy: #003057;
            --ns-blue: #004d99;
            --accent-blue: #007bff;
            --premium-gold: #c5a059;
            --light-bg: #f8fafc;
            --glass-bg: rgba(255, 255, 255, 0.9);
            --transition-smooth: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.04);
            --shadow-premium: 0 20px 60px rgba(0, 48, 87, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
            overflow-x: hidden;
            background-color: var(--light-bg);
            color: #334155;
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        h4,
        .navbar-brand {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.02em;
        }

        /* --- MODERN SCROLLBAR --- */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* --- NAVIGATION --- */
        .navbar {
            padding: 20px 0;
            transition: var(--transition-smooth);
            background: transparent;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar.scrolled {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            padding: 12px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-brand img {
            height: 48px;
            margin-right: 14px;
            transition: var(--transition-smooth);
        }

        .navbar-brand span {
            font-weight: 800;
            font-size: 1.6rem;
            color: white;
            text-transform: uppercase;
        }

        .navbar.scrolled .navbar-brand span {
            color: var(--primary-navy);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.95) !important;
            font-weight: 600;
            margin: 0 18px;
            font-size: 0.95rem;
            transition: var(--transition-smooth);
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--accent-blue);
            transition: var(--transition-smooth);
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 25px;
        }

        .navbar.scrolled .nav-link {
            color: var(--primary-navy) !important;
        }

        .auth-buttons .btn {
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-right: 15px;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .btn-signup {
            background-color: white;
            color: var(--ns-blue);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-signup:hover {
            background: var(--light-bg);
            transform: translateY(-3px);
            box-shadow: var(--shadow-premium);
        }

        .navbar.scrolled .btn-login {
            color: var(--ns-blue);
            border-color: var(--ns-blue);
        }

        .navbar.scrolled .btn-signup {
            background-color: var(--ns-blue);
            color: white;
        }

        /* --- HERO SECTION --- */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0, 48, 87, 0.75), rgba(0, 48, 87, 0.5)), url('assets/img/nsu-hero.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
        }

        .hero-content {
            max-width: 100%;
            animation: revealUp 1.2s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .hero h1 {
            font-size: 4.2rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 25px;
            text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.03em;
            max-width: 850px;
        }

        .hero p {
            font-size: 1.35rem;
            opacity: 0.9;
            margin-bottom: 45px;
            max-width: 650px;
            font-weight: 400;
        }

        .hero-btns .btn {
            padding: 18px 45px;
            font-size: 1rem;
            border-radius: 15px;
            font-weight: 700;
            transition: var(--transition-smooth);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* --- REVEAL ANIMATION --- */
        @keyframes revealUp {
            from {
                opacity: 0;
                transform: translateY(50px);
                filter: blur(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        /* --- SECTION BASE --- */
        section {
            padding: 120px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-header h2 {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary-navy);
            margin-bottom: 20px;
            letter-spacing: -0.02em;
        }

        .section-header p {
            font-size: 1.1rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
        }

        /* --- FEATURES SECTION --- */
        .feature-card {
            padding: 50px 40px;
            border-radius: 24px;
            background: white;
            box-shadow: var(--shadow-soft);
            transition: var(--transition-smooth);
            height: 100%;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--accent-blue);
            opacity: 0;
            transition: var(--transition-smooth);
        }

        .feature-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-premium);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            width: 90px;
            height: 90px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.4rem;
            margin: 0 auto 30px;
            transition: var(--transition-smooth);
        }

        .icon-tracking {
            color: var(--ns-blue);
            background: rgba(0, 77, 153, 0.1);
        }

        .feature-card:hover .icon-tracking {
            background: var(--ns-blue);
            color: white;
            transform: rotateY(180deg);
        }

        .icon-ticketing {
            color: #10b981;
            background: rgba(16, 185, 129, 0.1);
        }

        .feature-card:hover .icon-ticketing {
            background: #10b981;
            color: white;
            transform: rotateY(180deg);
        }

        .icon-secure {
            color: #f59e0b;
            background: rgba(245, 158, 11, 0.1);
        }

        .feature-card:hover .icon-secure {
            background: #f59e0b;
            color: white;
            transform: rotateY(180deg);
        }

        /* --- FLEET SECTION --- */
        .fleet-section {
            background: white;
        }

        .fleet-img-container {
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-premium);
            position: relative;
        }

        .fleet-img-container img {
            transition: var(--transition-smooth);
        }

        .fleet-img-container:hover img {
            transform: scale(1.05);
        }

        /* --- ABOUT SECTION --- */
        .about-section {
            background: #f8fafc;
        }

        .about-img-container {
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-premium);
        }

        /* --- STATS SECTION --- */
        .counters {
            background: linear-gradient(135deg, var(--primary-navy), var(--ns-blue));
            padding: 100px 0;
            color: white;
            border-radius: 40px;
            margin: 0 20px;
            position: relative;
            z-index: 10;
        }

        .counter-item h3 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            font-family: 'Outfit';
        }

        .counter-item p {
            font-size: 1.1rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* --- FOOTER --- */
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 100px 0 40px;
            margin-top: -50px;
            position: relative;
        }

        .footer-logo span {
            color: white;
            font-weight: 800;
            font-size: 1.8rem;
        }

        .footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 25px;
            font-size: 1.2rem;
        }

        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .footer-link:hover {
            color: white;
            padding-left: 5px;
        }

        .footer-contact i {
            color: var(--accent-blue);
            width: 25px;
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease-out;
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 991px) {
            .hero h1 {
                font-size: 3rem;
            }

            .counters {
                border-radius: 0;
                margin: 0;
            }
        }

        /* ============================================
            =========
            SCHEDULE & ROUTES — REDESIGNED
            ===================================================== */

        .schedule-section {
            background: linear-gradient(160deg, #eef4fb 0%, #f0f4f8 60%, #e8f0f9 100%);
            position: relative;
            overflow: hidden;
        }

        .schedule-section::before {
            content: '';
            position: absolute;
            top: -120px;
            right: -120px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 77, 153, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        .schedule-section::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(197, 160, 89, 0.07) 0%, transparent 70%);
            pointer-events: none;
        }

        /* --- Schedule Card (left panel) --- */
        .schedule-card {
            background: linear-gradient(145deg, var(--primary-navy) 0%, #00407a 55%, var(--ns-blue) 100%);
            border-radius: 28px;
            padding: 40px;
            color: white;
            height: 100%;
            box-shadow: 0 30px 70px rgba(0, 48, 87, 0.28);
            position: relative;
            overflow: hidden;
        }

        .schedule-card::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            pointer-events: none;
        }

        .schedule-card::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
            pointer-events: none;
        }

        .schedule-card-title {
            color: var(--premium-gold);
            font-weight: 800;
            font-family: 'Outfit';
            font-size: 1.2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            padding-bottom: 18px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .schedule-block {
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            padding-bottom: 26px;
            margin-bottom: 26px;
        }

        .schedule-block:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .schedule-block-heading {
            font-size: 0.92rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .schedule-block-heading .icon-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .icon-pill.arrival {
            background: rgba(16, 185, 129, 0.2);
        }

        .icon-pill.departure {
            background: rgba(245, 158, 11, 0.2);
        }

        .time-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 10px;
        }

        .time-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 3px 14px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.82rem;
            white-space: nowrap;
            min-width: 82px;
            flex-shrink: 0;
        }

        .time-badge.arrival-badge {
            background: rgba(0, 123, 255, 0.18);
            color: #7dbfff;
        }

        .time-badge.departure-badge {
            background: rgba(197, 160, 89, 0.22);
            color: var(--premium-gold);
        }

        .time-note {
            opacity: 0.78;
            font-size: 0.85rem;
            line-height: 1.5;
            padding-top: 2px;
        }

        /* Ticket badge */
        .ticket-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 12px;
            padding: 10px 16px;
            margin-top: 20px;
            font-size: 0.88rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
        }

        .ticket-badge span.price {
            background: var(--premium-gold);
            color: var(--primary-navy);
            border-radius: 8px;
            padding: 2px 10px;
            font-weight: 800;
            font-size: 0.9rem;
        }

        /* --- Routes Panel (right) --- */
        .routes-panel-title {
            color: var(--primary-navy);
            font-family: 'Outfit';
            font-size: 1.25rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
        }

        /* Route card */
        .route-card {
            background: white;
            border-radius: 18px;
            border: 1px solid rgba(0, 48, 87, 0.07);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 10px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .route-card:hover {
            box-shadow: 0 8px 35px rgba(0, 48, 87, 0.1);
            transform: translateY(-2px);
        }

        .route-card.open {
            border-color: rgba(0, 77, 153, 0.2);
            box-shadow: 0 8px 35px rgba(0, 48, 87, 0.1);
            transform: translateY(-2px);
        }

        /* Route header (clickable) */
        .route-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 20px;
            cursor: pointer;
            user-select: none;
            transition: background 0.25s ease;
        }

        .route-card.open .route-header {
            background: linear-gradient(90deg, rgba(0, 77, 153, 0.05) 0%, rgba(255, 255, 255, 0) 100%);
        }

        .route-pin {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(239, 68, 68, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.25s ease;
        }

        .route-card.open .route-pin {
            background: rgba(239, 68, 68, 0.18);
        }

        .route-pin i {
            color: #ef4444;
            font-size: 0.9rem;
        }

        .route-name {
            flex: 1;
            font-weight: 700;
            font-size: 0.97rem;
            color: var(--primary-navy);
            font-family: 'Outfit';
            letter-spacing: 0.2px;
        }

        .route-stops-badge {
            background: rgba(0, 48, 87, 0.07);
            color: var(--primary-navy);
            font-weight: 700;
            font-size: 0.72rem;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }

        /* The + / × toggle button */
        .route-toggle-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid rgba(0, 77, 153, 0.2);
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: var(--ns-blue);
            font-size: 1.15rem;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .route-toggle-btn .btn-icon {
            display: inline-block;
            font-style: normal;
            font-weight: 300;
            line-height: 1;
            transition: transform 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .route-card.open .route-toggle-btn {
            background: var(--ns-blue);
            border-color: var(--ns-blue);
            color: white;
        }

        .route-card.open .route-toggle-btn .btn-icon {
            transform: rotate(45deg);
        }

        /* Stop list (collapsible body) */
        .route-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.45s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.35s ease;
            opacity: 0;
        }

        .route-card.open .route-body {
            max-height: 500px;
            opacity: 1;
        }

        .route-body-inner {
            padding: 6px 20px 20px 20px;
            border-top: 1px solid rgba(0, 48, 87, 0.06);
        }

        /* ============================================
            STOP LIST — TIMELINE STYLE (updated)
            ============================================ */

        .stop-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .stop-list li {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 9px 0;
            font-size: 0.9rem;
            color: #475569;
            transition: color 0.2s ease;
            position: relative;
        }

        .stop-list li:hover {
            color: var(--primary-navy);
        }

        /* Vertical connector line between each stop */
        .stop-list li:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 9px;
            /* center of the 20px wide stop-dot */
            top: 50%;
            width: 2px;
            height: 100%;
            background: #dde6f0;
            z-index: 0;
        }

        /* Base stop dot — hollow blue circle (applied to all middle stops) */
        .stop-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
            background: white;
            border: 2.5px solid #3b82f6;
            box-sizing: border-box;
            transition: transform 0.2s ease;
        }

        .stop-list li:hover .stop-dot {
            transform: scale(1.2);
        }

        /* First stop — filled solid blue dot */
        .stop-list li:first-child .stop-dot {
            background: #3b82f6;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.18);
        }

        /* Last stop — filled solid red dot */
        .stop-list li:last-child .stop-dot {
            background: #ef4444;
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
        }

        /* Stop label text */
        .stop-label {
            font-size: 0.88rem;
            font-weight: 500;
            color: #374151;
            line-height: 1.4;
            transition: color 0.2s ease;
        }

        .stop-list li:hover .stop-label {
            color: var(--primary-navy);
        }

        /* Contact support banner */
        .contact-support-banner {
            display: flex;
            align-items: center;
            gap: 14px;
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(0, 48, 87, 0.07);
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
            padding: 14px 18px;
            margin-top: 14px;
        }

        .contact-support-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 12px;
            background: rgba(0, 123, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-support-icon i {
            color: var(--accent-blue);
            font-size: 1.1rem;
        }

        .contact-support-label {
            font-weight: 700;
            color: var(--primary-navy);
            font-size: 0.82rem;
            margin-bottom: 2px;
        }

        .contact-support-email {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.88rem;
            transition: color 0.2s;
        }

        .contact-support-email:hover {
            color: var(--ns-blue);
        }

        @media (max-width: 768px) {
            .schedule-card {
                padding: 28px 22px;
            }

            .routes-panel-title {
                font-size: 1.1rem;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="https://upload.wikimedia.org/wikipedia/en/e/e0/North_South_University_Monogram.svg"
                    alt="NSU Logo">
                <span>NSUTMS</span>
            </a>
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fleet">Our Fleet</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">University</a></li>
                </ul>
                <div class="auth-buttons ms-auto" id="authButtons">
                    <?php if ($is_logged_in): ?>
                        <a href="<?php echo htmlspecialchars($dashboard_link); ?>" class="btn btn-primary shadow-sm">
                            <i class="fas fa-th-large me-2"></i> Dashboard
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-login">Login</a>
                        <a href="signup.php" class="btn btn-primary btn-signup">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-1">North South University Transportation Management System</h1>
                <p class="lead">Simplifying transportation at North South University with real-time tracking, easy
                    booking, and a dedicated, reliable fleet.</p>
                <div class="hero-btns pt-3 text-end" id="heroCta">
                    <?php if ($is_logged_in): ?>
                        <a href="<?php echo htmlspecialchars($dashboard_link); ?>"
                            class="btn btn-light btn-lg px-5">Continue to Dashboard</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary btn-lg me-3 px-5">Portal Login</a>
                        <a href="signup.php" class="btn btn-outline-light btn-lg px-5">Student Signup</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="container">
            <div class="section-header scroll-reveal">
                <h2>Intelligent Features</h2>
                <p>Designed to meet the high standards of Bangladesh's premier private university.</p>
            </div>
            <div class="row g-5">
                <div class="col-md-4 scroll-reveal">
                    <div class="feature-card">
                        <div class="feature-icon icon-tracking"><i class="fas fa-map-location-dot"></i></div>
                        <h4>Live GPS Tracking</h4>
                        <p>Real-time location updates for all active shuttles. Plan your departure perfectly and never
                            wait at the bus stop again.</p>
                    </div>
                </div>
                <div class="col-md-4 scroll-reveal">
                    <div class="feature-card">
                        <div class="feature-icon icon-ticketing"><i class="fas fa-ticket"></i></div>
                        <h4>Instant Ticketing</h4>
                        <p>Purchase tickets via digital payment methods. Fast, secure, and completely paperless
                            ticketing for student convenience.</p>
                    </div>
                </div>
                <div class="col-md-4 scroll-reveal">
                    <div class="feature-card">
                        <div class="feature-icon icon-secure"><i class="fas fa-id-card-clip"></i></div>
                        <h4>Secure Access</h4>
                        <p>QR-based entry system ensuring only verified NSU students and staff can access the elite
                            transportation service.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fleet-section" id="fleet">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 scroll-reveal">
                    <div class="fleet-img-container">
                        <img src="assets/img/nsu-bus-fuso.jpg" class="img-fluid" alt="NSU Shuttle Fleet">
                    </div>
                </div>
                <div class="col-lg-6 scroll-reveal">
                    <h5 class="text-primary fw-bold text-uppercase mb-3">Our Transport Fleet</h5>
                    <h2 class="display-5 fw-bold mb-4">Exceptional Comfort. Guaranteed Safety.</h2>
                    <p class="mb-4">Our fleet consists of high-quality Mitsubishi Fuso shuttles, maintained to the
                        highest standards. We prioritize student comfort and vehicle safety above all else.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-center"><i
                                class="fas fa-check-circle text-success me-3 fs-5"></i> Fully Air Conditioned Coaches
                        </li>
                        <li class="mb-3 d-flex align-items-center"><i
                                class="fas fa-check-circle text-success me-3 fs-5"></i> GPS Monitored Movement</li>
                        <li class="mb-3 d-flex align-items-center"><i
                                class="fas fa-check-circle text-success me-3 fs-5"></i> Regular Maintenance & Safety
                            Checks</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="schedule-section" id="schedule">
        <div class="container">
            <div class="section-header scroll-reveal">
                <h2>Schedule & Routes</h2>
                <p>Comprehensive bus timings and complete route mapping for your daily commute.</p>
            </div>

            <div class="row mb-5 scroll-reveal">
                <div class="col-12 text-center">
                    <div class="ticket-badge mx-auto shadow-sm"
                        style="display: inline-flex; background: var(--primary-navy); padding: 15px 35px; border-radius: 20px; color: white; font-size: 1.1rem; border: none; transform: scale(1.1);">
                        <i class="fas fa-ticket me-3" style="color: var(--premium-gold); font-size: 1.3rem;"></i>
                        <span style="letter-spacing: 0.5px;">One-way ticket</span> &nbsp;&nbsp;
                        <span class="price px-3 py-1"
                            style="background: var(--premium-gold); color: var(--primary-navy); border-radius: 10px; font-weight: 800; font-size: 1.1rem;">Tk.
                            100</span>
                    </div>
                </div>
            </div>

            <div class="row g-5 align-items-start">

                <div class="col-lg-5 scroll-reveal">
                    <div class="schedule-card">
                        <div class="schedule-card-title">
                            <i class="fas fa-clock"></i> Bus Service Schedule
                        </div>

                        <div class="schedule-block">
                            <div class="schedule-block-heading">
                                <span class="icon-pill arrival">
                                    <i class="fas fa-arrow-right-to-bracket text-success" style="font-size:0.8rem;"></i>
                                </span>
                                Arrival at NSU
                            </div>
                            <div class="time-row">
                                <span class="time-badge arrival-badge">7:40 am</span>
                                <span class="time-note">All routes</span>
                            </div>
                            <div class="time-row">
                                <span class="time-badge arrival-badge">2:20 pm</span>
                                <span class="time-note">All routes</span>
                            </div>
                            <div class="time-row">
                                <span class="time-badge arrival-badge">5:45 pm</span>
                                <span class="time-note">Uttara, Mirpur, Mohammadpur &amp; Dhanmondi only</span>
                            </div>
                            <div class="time-row">
                                <span class="time-badge arrival-badge">6:45 pm</span>
                                <span class="time-note">Azimpur &amp; Khilgaon only</span>
                            </div>
                        </div>

                        <div class="schedule-block">
                            <div class="schedule-block-heading">
                                <span class="icon-pill departure">
                                    <i class="fas fa-arrow-right-from-bracket text-warning"
                                        style="font-size:0.8rem;"></i>
                                </span>
                                Departure from NSU
                            </div>
                            <div class="time-row">
                                <span class="time-badge departure-badge">10:00 am</span>
                                <span class="time-note">All routes</span>
                            </div>
                            <div class="time-row">
                                <span class="time-badge departure-badge">2:40 pm</span>
                                <span class="time-note">All routes</span>
                            </div>
                            <div class="time-row">
                                <span class="time-badge departure-badge">6:30 pm</span>
                                <span class="time-note">Uttara, Mirpur, Mohammadpur &amp; Dhanmondi only</span>
                            </div>
                            <div class="time-row">
                                <span class="time-badge departure-badge">10:20 pm</span>
                                <span class="time-note">Mirpur &amp; Mohammadpur only</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 scroll-reveal">
                    <div class="routes-panel-title">
                        <i class="fas fa-route text-primary"></i> Routes &amp; Stoppages
                    </div>

                    <div class="route-card" id="route-uttara">
                        <div class="route-header" onclick="toggleRoute('route-uttara')">
                            <div class="route-pin"><i class="fas fa-map-marker-alt"></i></div>
                            <span class="route-name">NSU — UTTARA — NSU</span>
                            <span class="route-stops-badge">5 stops</span>
                            <button class="route-toggle-btn" aria-label="Toggle stoppages" tabindex="-1">
                                <i class="btn-icon">+</i>
                            </button>
                        </div>
                        <div class="route-body">
                            <div class="route-body-inner">
                                <ul class="stop-list">
                                    <li><span class="stop-dot"></span><span class="stop-label">Abdullahpur (Polwel
                                            Market)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">House Building (Janata
                                            Bank)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Azampur (Uttara East
                                            Thana)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Jashimuddin (Foot Over
                                            Bridge RAB-1)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Airport (Traffic Police
                                            Box)</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="route-card" id="route-mirpur">
                        <div class="route-header" onclick="toggleRoute('route-mirpur')">
                            <div class="route-pin"><i class="fas fa-map-marker-alt"></i></div>
                            <span class="route-name">NSU — MIRPUR — NSU</span>
                            <span class="route-stops-badge">7 stops</span>
                            <button class="route-toggle-btn" aria-label="Toggle stoppages" tabindex="-1">
                                <i class="btn-icon">+</i>
                            </button>
                        </div>
                        <div class="route-body">
                            <div class="route-body-inner">
                                <ul class="stop-list">
                                    <li><span class="stop-dot"></span><span class="stop-label">Bangla College (Foot Over
                                            Bridge)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Mirpur-1 (New
                                            Market)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Mirpur-2 (National Bangla
                                            High School)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Mirpur-10 (Metro Rail
                                            Station)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Mirpur-11 (Metro Rail
                                            Station)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Mirpur-12 (CNG Station /
                                            Mirpur Ceramic)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">ECB Square (Jatri
                                            Chhawni)</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="route-card" id="route-mohammadpur">
                        <div class="route-header" onclick="toggleRoute('route-mohammadpur')">
                            <div class="route-pin"><i class="fas fa-map-marker-alt"></i></div>
                            <span class="route-name">NSU — MOHAMMADPUR — NSU</span>
                            <span class="route-stops-badge">6 stops</span>
                            <button class="route-toggle-btn" aria-label="Toggle stoppages" tabindex="-1">
                                <i class="btn-icon">+</i>
                            </button>
                        </div>
                        <div class="route-body">
                            <div class="route-body-inner">
                                <ul class="stop-list">
                                    <li><span class="stop-dot"></span><span class="stop-label">Mohammadpur (Japan Garden
                                            City)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Opposite of Suchana
                                            Community Center (Probal Housing)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Syamoli Bus Stand (Hotel
                                            Mohammadia)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Agargoan Metro Rail
                                            Station</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">BAF Shaheen
                                            College</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Banani Rail
                                            Station</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="route-card" id="route-dhanmondi">
                        <div class="route-header" onclick="toggleRoute('route-dhanmondi')">
                            <div class="route-pin"><i class="fas fa-map-marker-alt"></i></div>
                            <span class="route-name">NSU — DHANMONDI — NSU</span>
                            <span class="route-stops-badge">4 stops</span>
                            <button class="route-toggle-btn" aria-label="Toggle stoppages" tabindex="-1">
                                <i class="btn-icon">+</i>
                            </button>
                        </div>
                        <div class="route-body">
                            <div class="route-body-inner">
                                <ul class="stop-list">
                                    <li><span class="stop-dot"></span><span class="stop-label">Jigatola Bus Stand (Japan
                                            Bangladesh Hospital)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Dhanmondi-27 (Rapa
                                            Plaza)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Khamarbari Mor</span>
                                    </li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Mohakhali Fly Over
                                            (Banani End)</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="route-card" id="route-azimpur">
                        <div class="route-header" onclick="toggleRoute('route-azimpur')">
                            <div class="route-pin"><i class="fas fa-map-marker-alt"></i></div>
                            <span class="route-name">NSU — AZIMPUR — NSU</span>
                            <span class="route-stops-badge">5 stops</span>
                            <button class="route-toggle-btn" aria-label="Toggle stoppages" tabindex="-1">
                                <i class="btn-icon">+</i>
                            </button>
                        </div>
                        <div class="route-body">
                            <div class="route-body-inner">
                                <ul class="stop-list">
                                    <li><span class="stop-dot"></span><span class="stop-label">Azimpur (Matri Sadan
                                            Hospital)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Katabon Bus Stand</span>
                                    </li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Bangla Motor Pharmacy
                                            Council Office</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Mogbazar (NCC
                                            Bank)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Gulshan Niketon Gate-1
                                            (Jatri Chhawni)</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="route-card" id="route-khilgaon">
                        <div class="route-header" onclick="toggleRoute('route-khilgaon')">
                            <div class="route-pin"><i class="fas fa-map-marker-alt"></i></div>
                            <span class="route-name">NSU — KHILGAON — NSU</span>
                            <span class="route-stops-badge">6 stops</span>
                            <button class="route-toggle-btn" aria-label="Toggle stoppages" tabindex="-1">
                                <i class="btn-icon">+</i>
                            </button>
                        </div>
                        <div class="route-body">
                            <div class="route-body-inner">
                                <ul class="stop-list">
                                    <li><span class="stop-dot"></span><span class="stop-label">Notre Dame College</span>
                                    </li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Rajarbag Bus Stand</span>
                                    </li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Khilgaon Bagicha Jame
                                            Masjid</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Malibagh Rail Gate (Ibne
                                            Sina Hospital)</span></li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Malibag Abul Hotel</span>
                                    </li>
                                    <li><span class="stop-dot"></span><span class="stop-label">Rampura Bridge (Opposite
                                            of BTV)</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="contact-support-banner">
                        <div class="contact-support-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div>
                            <div class="contact-support-label">For any queries</div>
                            <a href="mailto:transport.support@northsouth.edu" class="contact-support-email">
                                transport.support@northsouth.edu
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="counters scroll-reveal">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4 counter-item">
                    <h3 id="#">5000+</h3>
                    <p>Community Members</p>
                </div>
                <div class="col-md-4 counter-item">
                    <h3 id="#">12+</h3>
                    <p>Active Shuttles</p>
                </div>
                <div class="col-md-4 counter-item">
                    <h3 id="#">65+</h3>
                    <p>Routes Served</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section" id="about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-lg-2 scroll-reveal">
                    <div class="about-img-container">
                        <img src="assets/img/nsu-academic-building.jpg" class="img-fluid" alt="NSU Campus">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1 scroll-reveal">
                    <h5 class="text-primary fw-bold text-uppercase mb-3">Center of Excellence in Higher Education</h5>
                    <h2 class="display-5 fw-bold mb-4">First Private University In Bangladesh</h2>
                    <p class="lead mb-4">North South University (NSU) is one of the leading private universities in
                        Bangladesh. It was established in 1992 and is known for quality higher education and developing
                        skilled graduates.</p>
                    <p>NSU has a modern campus located in Bashundhara and serves more than 22,000 students. The
                        university provides a well-organized transportation system to ensure safe and reliable travel
                        for students, faculty, and staff.</p>
                    <div class="mt-5 p-4 bg-white shadow-sm border border-light d-flex align-items-center"
                        style="border-radius: 20px;">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px; min-width: 60px; font-size: 1.5rem; margin-right: 20px;">
                            <i class="fas fa-location-dot"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="font-size: 1.1rem;">Campus Location</h6>
                            <p class="mb-0 text-muted">Bashundhara, Dhaka-1229, Bangladesh</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo mb-4">
                        <span>NSUTMS</span>
                    </div>
                    <p class="pe-xl-5">North South University's smart transportation management system. It provides
                        safe, efficient, and reliable transport for the NSU community, improving campus mobility since
                        2025.
                    </p>
                </div>
                <div class="col-lg-4">
                    <h5 class="footer-contact">Contact Center</h5>
                    <ul class="list-unstyled footer-contact">
                        <li class="mb-3 d-flex"><i class="fas fa-map-marker-alt mt-1"></i>
                            <div>Bashundhara, Dhaka, 1229</div>
                        </li>
                        <li class="mb-3 d-flex"><i class="fas fa-envelope mt-1"></i>
                            <div>transport.support@northsouth.edu</div>
                        </li>
                        <li class="mb-3 d-flex"><i class="fas fa-phone mt-1"></i>
                            <div>+880-2-55668200</div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Institutional Resource</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="login.php" class="footer-link">Portal Login</a></li>
                        <li class="mb-2"><a href="signup.php" class="footer-link">Member Registration</a></li>
                        <li class="mb-2"><a href="https://www.northsouth.edu" target="_blank" class="footer-link">NSU
                                Official Site</a></li>
                    </ul>
                </div>
            </div>
            <hr class="mt-5 mb-4 border-secondary opacity-25">
            <div class="row align-items-center">
                <div class="col-md-12 text-center small">
                    NSUTMS © <span id="year">2026</span> All right reserved | Developed By Team_04
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            // Navbar Scroll Effect
            $(window).scroll(function () {
                if ($(window).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });

            // Reveal on Scroll
            function reveal() {
                var reveals = document.querySelectorAll(".scroll-reveal");
                for (var i = 0; i < reveals.length; i++) {
                    var windowHeight = window.innerHeight;
                    var elementTop = reveals[i].getBoundingClientRect().top;
                    var elementVisible = 150;
                    if (elementTop < windowHeight - elementVisible) {
                        reveals[i].classList.add("visible");
                    }
                }
            }
            window.addEventListener("scroll", reveal);
            reveal(); // Initial check

            // Set Year
            $('#year').text(new Date().getFullYear());
        });

        // Toggle route expand/collapse
        function toggleRoute(id) {
            var card = document.getElementById(id);
            if (!card) return;
            var isOpen = card.classList.contains('open');

            // Close all open cards
            document.querySelectorAll('.route-card.open').forEach(function (el) {
                el.classList.remove('open');
            });

            // If it wasn't open, open it
            if (!isOpen) {
                card.classList.add('open');
            }
        }
    </script>
</body>

</html>