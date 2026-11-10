<!DOCTYPE html>
<html lang="en" data-lang="en" data-theme="dark">

<head>
    <script>
        // Apply saved theme immediately (before paint). First visit = dark.
        (function () {
            var t = 'dark';
            try { t = localStorage.getItem('theme') || 'dark'; } catch (e) {}
            document.documentElement.setAttribute('data-theme', t === 'light' ? 'light' : 'dark');
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$event->groom_name}} & {{$event->bride_name}} Wedding Invitation</title>

    <meta name="description" content="Ungana nasi katika kusherehekea muungano wa {{$event->groom_name}} & {{$event->bride_name}}.">

    <meta property="og:title" content="{{$event->groom_name}} & {{$event->bride_name}} Wedding Invitation">
    <meta property="og:description" content="Celebrate our forever with us. Exclusive interactive digital invitation.">
    <meta property="og:image" content="https://rsvp.myvnc.com/images/image.jpg">
    {{-- <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630"> --}}
    <meta property="og:image:type" content="website">
    <meta property="og:url" content="https://rsvp.myvnc.com/aa/JWeSQP2IAm">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Playfair+Display:ital,wght@1,400;1,500&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <!-- Custom QR Generator & Feather Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>

    <style>
        /* --- DESIGN SYSTEM & CSS VARIABLE TOKENS --- */
        :root {
            --bg-ivory: #FBF8F2;
            --bg-dark-mode: #121210;
            --primary-gold: #68734A; /* olive green accent */
            --dark-gold: #3D472A;
            --light-gold: #E8D8C2; /* champagne beige */
            --soft-beige: #F0E8DC;
            --sage-green: #68734A;
            --dusty-rose: #8A3442; /* burgundy */

            /* Light Mode Default Layouts */
            --text-main: #2C2A29;
            --text-muted: #6B6661;
            --surface-glass: rgba(253, 251, 247, 0.75);
            --border-glass: rgba(104, 115, 74, 0.28);
            --shadow-premium: 0 20px 50px rgba(44, 42, 41, 0.05);

            /* Fonts */
            --font-display: 'Cinzel', serif;
            --font-body: 'Cormorant Garamond', serif;
            --font-accent: 'Playfair Display', serif;
            --font-sans: 'Poppins', sans-serif;

            --transition-smooth: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            --transition-fast: all 0.3s ease;
        }

        /* Dark Mode Override Archetype */
        [data-theme="dark"] {
            --bg-ivory: #121210;
            --text-main: #FDFBF7;
            --text-muted: #BDB7B0;
            --soft-beige: #1A1A18;
            --surface-glass: rgba(18, 18, 16, 0.8);
            --border-glass: rgba(104, 115, 74, 0.42);
            --shadow-premium: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        /* --- BASE RESET & STRUCTURE --- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            background-color: var(--bg-ivory);
            color: var(--text-main);
            font-family: var(--font-body);
            font-size: 1.35rem;
            line-height: 1.65;
            overflow-x: hidden;
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: var(--font-display);
            font-weight: 400;
            letter-spacing: 3px;
        }

        p {
            font-weight: 400;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition-fast);
        }

        /* SCROLL BAR OPTIMIZATION */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-ivory);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gold);
            border-radius: 10px;
        }

        /* --- PREMIUM HELPER TOOLKIT & INTERACTION OVERLAYS --- */
        .glass-card {
            background: var(--surface-glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            box-shadow: var(--shadow-premium);
            transition: var(--transition-smooth);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-gold);
        }

        .gold-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: var(--font-display);
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 14px 36px;
            background: transparent;
            border: 1px solid var(--primary-gold);
            color: var(--text-main);
            cursor: pointer;
            position: relative;
            z-index: 1;
            overflow: hidden;
            border-radius: 4px;
            transition: var(--transition-smooth);
        }

        .gold-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.6s;
            z-index: -1;
        }

        .gold-button:hover::before {
            left: 100%;
        }

        .gold-button:hover {
            color: #fff !important;
            background: var(--primary-gold);
            box-shadow: 0 10px 30px rgba(104, 115, 74, 0.28);
            transform: translateY(-2px);
        }

        /* --- SCROLL ANIMATIONS ENGINE --- */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            filter: blur(5px);
            transition: var(--transition-smooth);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }

        /* --- IMMERSIVE PARTICLES SYSTEM --- */
        .ambient-universe {
            position: fixed;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 1;
            top: 0;
            left: 0;
        }

        .petal {
            position: absolute;
            display: block;
            background: linear-gradient(var(--dusty-rose), #fff);
            opacity: 0.25;
            border-radius: 150% 0 150% 150%;
            animation: floatPetal 18s infinite linear;
        }

        .gold-dust {
            position: absolute;
            width: 3px;
            height: 3px;
            background: var(--primary-gold);
            border-radius: 50%;
            opacity: 0.5;
            animation: floatDust 14s infinite linear;
        }

        @keyframes floatPetal {
            0% {
                transform: translateY(-10vh) translateX(0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.5;
            }

            90% {
                opacity: 0.5;
            }

            100% {
                transform: translateY(105vh) translateX(120px) rotate(450deg);
                opacity: 0;
            }
        }

        @keyframes floatDust {
            0% {
                transform: translateY(105vh) translateX(0) scale(0.6);
                opacity: 0;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                transform: translateY(-10vh) translateX(80px) scale(1.3);
                opacity: 0;
            }
        }

        /* --- APPLE CINEMATIC INTRO MODULE --- */
        #luxury-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--bg-ivory);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .monogram-loader {
            font-family: var(--font-display);
            font-size: 3.5rem;
            color: var(--primary-gold);
            letter-spacing: 6px;
            position: relative;
            animation: initialPulse 3s ease forwards;
        }

        .skeleton-bar {
            width: 140px;
            height: 1px;
            background: var(--border-glass);
            margin-top: 25px;
            position: relative;
            overflow: hidden;
        }

        .skeleton-progress {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: var(--primary-gold);
            animation: fillProgress 2.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fillProgress {
            0% {
                width: 0;
            }

            100% {
                width: 100%;
            }
        }

        @keyframes initialPulse {
            0% {
                opacity: 0;
                filter: blur(5px);
            }

            50% {
                opacity: 1;
                filter: blur(0);
            }

            100% {
                opacity: 0.8;
            }
        }

        /* --- 3D INTERACTIVE ENVELOPE THEATRE --- */
        #envelope-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--soft-beige), var(--bg-ivory));
            z-index: 999;
            display: none;
            justify-content: center;
            align-items: center;
            perspective: 1400px;
            opacity: 1;
            transition: opacity 0.8s ease;
        }

        .envelope-3d {
            position: relative;
            width: 520px;
            height: 360px;
            background: linear-gradient(135deg, #e8d8c2, #d6c2a8);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.12);
            transform-style: preserve-3d;
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
            border-radius: 4px;
        }

        .envelope-flap {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-left: 260px solid transparent;
            border-right: 260px solid transparent;
            border-top: 190px solid #c8b398;
            transform-origin: top;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s;
            z-index: 3;
        }

        .wax-seal-wrapper {
            position: absolute;
            top: 165px;
            left: 230px;
            width: 60px;
            height: 60px;
            background: radial-gradient(#7A2635, #51151F);
            border-radius: 50%;
            z-index: 4;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3), inset 0 2px 4px rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #F4E9DF;
            font-family: var(--font-display);
            font-size: 0.9rem;
            font-weight: bold;
            letter-spacing: 1px;
            transition: var(--transition-smooth);
        }

        .envelope-3d:hover .wax-seal-wrapper {
            transform: scale(1.05) rotate(10deg);
        }

        .envelope-3d.open .envelope-flap {
            transform: rotateX(180deg);
            z-index: 1;
        }

        .envelope-3d.open .wax-seal-wrapper {
            transform: scale(0) rotate(-45deg);
            opacity: 0;
        }

        .invitation-inner-card {
            position: absolute;
            top: 15px;
            left: 20px;
            width: 480px;
            height: 330px;
            background: var(--bg-ivory);
            border: 1px solid var(--primary-gold);
            padding: 40px 20px;
            text-align: center;
            z-index: 2;
            box-shadow: inset 0 0 40px rgba(104, 115, 74, 0.07);
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.8s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .envelope-3d.open .invitation-inner-card {
            transform: translateY(-220px) translateZ(50px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* --- WIDGET ARCHITECTURE (UTILITY SYSTEM) --- */
        #scroll-progress-indicator {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--dusty-rose), var(--primary-gold));
            width: 0%;
            z-index: 1000;
            transition: width 0.1s ease-out;
        }

        .system-utilities-tray {
            position: fixed;
            top: 30px;
            right: 30px;
            z-index: 950;
            display: flex;
            gap: 12px;
        }

        .utility-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: var(--transition-fast);
            box-shadow: var(--shadow-premium);
            color: var(--text-main);
            border: 1px solid var(--border-glass);
            background: var(--surface-glass);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .utility-btn:hover {
            transform: scale(1.1);
            color: var(--primary-gold);
            border-color: var(--primary-gold);
        }

        .rotating {
            animation: spinContinuous 6s linear infinite;
        }

        @keyframes spinContinuous {
            100% {
                transform: rotate(360deg);
            }
        }

        /* --- FLOATING NAVIGATION CONTROLLER --- */
        #dock-navigation {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(120px);
            z-index: 900;
            padding: 8px 24px;
            display: flex;
            gap: 15px;
            border-radius: 30px;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        #dock-navigation.visible {
            transform: translateX(-50%) translateY(0);
        }

        .dock-link {
            font-family: var(--font-display);
            font-size: 0.72rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 8px 16px;
            border-radius: 20px;
            transition: var(--transition-fast);
            opacity: 0.65;
        }

        .dock-link:hover,
        .dock-link.active {
            opacity: 1;
            background: rgba(104, 115, 74, 0.14);
            color: var(--primary-gold);
        }

        /* --- CINEMATIC HERO DESIGN --- */
        #hero-viewport {
            height: 100vh;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            overflow: hidden;
        }

        .hero-parallax-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(18, 18, 16, 0.35), rgba(18, 18, 16, 0.5)),
                url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            transform: scale(1.08);
            transition: transform 0.1s ease-out;
            z-index: -1;
        }

        .hero-content-house {
            color: #fff;
            text-shadow: 0 2px 15px rgba(0, 0, 0, 0.25);
            z-index: 2;
            padding: 0 20px;
        }

        .hero-content-house h3 {
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 5px;
            margin-bottom: 25px;
            color: var(--light-gold);
        }

        .hero-content-house h1 {
            font-family: var(--font-accent);
            font-style: italic;
            font-weight: 400;
            font-size: 5.5rem;
            margin: 15px 0;
            letter-spacing: 1px;
        }

        .hero-content-house .ampersand-divider {
            font-family: var(--font-body);
            font-style: italic;
            font-size: 2.2rem;
            display: block;
            color: var(--primary-gold);
            margin: -10px 0;
        }

        .hero-content-house .date-string {
            font-family: var(--font-display);
            font-size: 1.35rem;
            letter-spacing: 4px;
            margin: 25px 0;
        }

        .hero-content-house .poetic-quote {
            font-size: 1.2rem;
            font-style: italic;
            opacity: 0.9;
            max-width: 500px;
            margin: 0 auto;
            font-family: var(--font-body);
        }

        /* --- SECTIONS CENTRAL DESIGN --- */
        section {
            padding: 140px 24px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .section-header-block {
            text-align: center;
            margin-bottom: 75px;
        }

        .section-header-block h2 {
            font-size: 2.4rem;
            color: var(--text-main);
            display: inline-block;
            position: relative;
            padding-bottom: 20px;
        }

        .section-header-block h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 35%;
            width: 30%;
            height: 1px;
            background: var(--primary-gold);
        }

        .section-header-block p {
            font-family: var(--font-accent);
            font-style: italic;
            font-size: 1.25rem;
            color: var(--sage-green);
            margin-top: 10px;
        }

        /* --- GUEST PERSONALIZATION MODULE --- */
        #personalized-guest-center {
            text-align: center;
            margin-bottom: -40px;
        }

        .guest-welcome-card {
            max-width: 750px;
            margin: 0 auto;
            padding: 40px;
            text-align: center;
            border-radius: 4px;
        }

        .guest-title-salutation {
            font-family: var(--font-accent);
            font-style: italic;
            font-size: 2rem;
            color: var(--primary-gold);
            margin-bottom: 10px;
        }

        /* --- LOVE STORY TIMELINE ENGINE --- */
        .story-timeline-backbone {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 0;
        }

        .story-timeline-backbone::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 1px;
            background: linear-gradient(to bottom, transparent, var(--primary-gold) 15%, var(--primary-gold) 85%, transparent);
            transform: translateX(-50%);
        }

        .story-event-card-wrapper {
            width: 50%;
            margin-bottom: 80px;
            position: relative;
            padding: 0 50px;
        }

        .story-event-card-wrapper:nth-child(odd) {
            float: left;
            text-align: right;
            clear: both;
        }

        .story-event-card-wrapper:nth-child(even) {
            float: right;
            text-align: left;
            clear: both;
        }

        .story-event-card-wrapper::after {
            content: '';
            position: absolute;
            top: 25px;
            width: 14px;
            height: 14px;
            background: var(--bg-ivory);
            border: 2px solid var(--primary-gold);
            border-radius: 50%;
            z-index: 5;
            transition: 0.3s;
        }

        .story-event-card-wrapper:hover::after {
            background: var(--primary-gold);
            scale: 1.3;
        }

        .story-event-card-wrapper:nth-child(odd)::after {
            right: -7px;
        }

        .story-event-card-wrapper:nth-child(even)::after {
            left: -7px;
        }

        .story-inner-card {
            padding: 35px;
            border-radius: 8px;
        }

        .story-inner-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-premium);
        }

        .story-inner-card .meta-date {
            font-family: var(--font-display);
            font-size: 0.85rem;
            color: var(--primary-gold);
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .story-inner-card h3 {
            font-size: 1.45rem;
            margin-bottom: 12px;
        }

        .story-inner-card p {
            font-size: 1.15rem;
            color: var(--text-muted);
        }

        .story-timeline-backbone::after {
            content: '';
            display: table;
            clear: both;
        }

        /* --- PINTEREST STYLE GALLERY SYSTEM --- */
        .gallery-masonry-grid {
            columns: 3 320px;
            column-gap: 25px;
            width: 100%;
        }

        .gallery-photo-frame {
            break-inside: avoid;
            display: inline-block;
            width: 100%;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            border-radius: 8px;
        }

        .gallery-photo-frame img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: var(--transition-smooth);
            display: block;
        }

        .gallery-photo-frame:hover img {
            transform: scale(1.04);
            filter: brightness(0.9);
        }

        .gallery-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(18, 18, 16, 0.5), transparent 60%);
            opacity: 0;
            transition: var(--transition-fast);
            display: flex;
            align-items: flex-end;
            padding: 25px;
        }

        .gallery-photo-frame:hover .gallery-card-overlay {
            opacity: 1;
        }

        .gallery-card-overlay span {
            color: #fff;
            font-family: var(--font-display);
            font-size: 0.8rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        /* Lightbox Layout Context */
        #lightbox-overlay-engine {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(18, 18, 16, 0.95);
            z-index: 2000;
            display: none;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        #lightbox-overlay-engine.active {
            opacity: 1;
        }

        #lightbox-overlay-engine img {
            max-width: 90%;
            max-height: 85%;
            object-fit: contain;
            border: 1px solid var(--primary-gold);
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
        }

        .lightbox-close-trigger {
            position: absolute;
            top: 35px;
            right: 35px;
            color: #fff;
            cursor: pointer;
            background: transparent;
            border: 0;
        }

        /* --- LUXURY COUNTDOWN DESIGN SYSTEM --- */
        #countdown-anchor {
            background: var(--soft-beige);
            width: 100vw;
            /* position: relative; */
            /* left: 50%;
            right: 50%; */
            /* margin-left: -50vw;
            margin-right: -50vw; */
        }

        .countdown-flex-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-top: 50px;
        }

        .countdown-metric-card {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .countdown-metric-card data {
            font-family: var(--font-display);
            font-size: 2.6rem;
            color: var(--text-main);
            font-weight: 500;
            line-height: 1;
        }

        .countdown-metric-card label {
            font-family: var(--font-sans);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 8px;
            color: var(--text-muted);
        }

        /* --- THE WEDDING SCHEDULE PLATFORM --- */
        .schedule-linear-track {
            max-width: 750px;
            margin: 0 auto;
            position: relative;
        }

        .schedule-timeline-unit {
            display: flex;
            margin-bottom: 50px;
            position: relative;
        }

        .schedule-time-meta {
            width: 140px;
            font-family: var(--font-display);
            font-size: 1.15rem;
            color: var(--primary-gold);
            font-weight: 500;
            padding-top: 5px;
        }

        .schedule-event-details-box {
            flex: 1;
            padding-left: 40px;
            border-left: 2px solid var(--border-glass);
            padding-bottom: 20px;
        }

        .schedule-event-details-box h3 {
            font-size: 1.4rem;
            margin-bottom: 8px;
            font-family: var(--font-display);
        }

        .schedule-event-details-box p {
            font-size: 1.2rem;
            color: var(--text-muted);
        }

        /* --- VENUES PRESENTATION SCHEME --- */
        .venue-dual-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 45px;
        }

        .venue-editorial-card {
            padding: 45px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .venue-editorial-card h3 {
            font-size: 1.75rem;
            margin-bottom: 15px;
            color: var(--primary-gold);
        }

        .venue-editorial-card p {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-bottom: 25px;
        }

        .interactive-iframe-holder {
            width: 100%;
            height: 280px;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid var(--border-glass);
            margin-bottom: 30px;
        }

        .interactive-iframe-holder iframe {
            width: 100%;
            height: 100%;
            border: 0;
            filter: grayscale(0.2) contrast(0.9);
        }

        .venue-button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        /* --- WEDDING DRESS CODE: BURGUNDY, OLIVE, CAMEL & BLACK --- */
        #dress-code-center {
            width: 100%;
            position: relative;
            overflow: hidden;
            color: #fff;
            isolation: isolate;
            background:
                radial-gradient(circle at 12% 15%, rgba(122, 38, 53, .34), transparent 32%),
                radial-gradient(circle at 90% 80%, rgba(104, 115, 74, .28), transparent 35%),
                linear-gradient(135deg, #171915 0%, #24231e 48%, #191816 100%);
            border: 1px solid rgba(232,216,194,.24);
            box-shadow: 0 28px 80px rgba(23,25,21,.2);
        }
        #dress-code-center::before,
        #dress-code-center::after {
            content: "";
            position: absolute;
            pointer-events: none;
            z-index: -1;
            border: 1px solid rgba(232,216,194,.2);
            border-radius: 50%;
        }
        #dress-code-center::before { width: 360px; height: 360px; top: -220px; right: -100px; }
        #dress-code-center::after { width: 280px; height: 280px; bottom: -190px; left: -80px; }
        #dress-code-center .section-header-block { margin-bottom: 42px; }
        #dress-code-center .section-header-block h2 {
            color: #F6EFE6;
            font-size: clamp(2rem, 4vw, 3rem);
            letter-spacing: 4px;
        }
        #dress-code-center .section-header-block h2::after {
            background: linear-gradient(90deg, #7A2635, #E8D8C2, #68734A);
            height: 3px; width: 90px; left: calc(50% - 45px);
        }
        #dress-code-center .section-header-block p { color: #D9CBB9; }
        #dress-code-center .dress-code-intro {
            max-width: 650px;
            margin: 12px auto 0;
            font-family: var(--font-sans);
            font-size: .82rem;
            line-height: 1.9;
            color: rgba(255,255,255,.78);
        }
        .dress-palette-group {
            margin: 0 auto 30px;
            max-width: 850px;
            padding: 24px 20px 26px;
            border: 1px solid rgba(232,216,194,.16);
            border-radius: 16px;
            background: rgba(255,255,255,.035);
            backdrop-filter: blur(8px);
        }
        .dress-palette-label {
            font-family: var(--font-sans);
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-size: .72rem;
            color: #E8D8C2;
            margin-bottom: 22px;
        }
        .color-palette-row {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px 30px;
        }
        .color-swatch-item { width: 88px; text-align: center; }
        .color-swatch-circle {
            width: 62px; height: 62px; display: block;
            margin: 0 auto 10px; border-radius: 50%;
            border: 3px solid rgba(255,255,255,.82);
            box-shadow: 0 0 0 5px rgba(255,255,255,.055), 0 10px 25px rgba(0,0,0,.3);
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .color-swatch-item:hover .color-swatch-circle {
            transform: translateY(-4px) scale(1.06);
            box-shadow: 0 0 0 6px rgba(232,216,194,.12), 0 14px 30px rgba(0,0,0,.4);
        }
        .color-swatch-name {
            display: block; font-family: var(--font-sans);
            font-size: .67rem; line-height: 1.45; color: #F7F1E9;
        }
        .dress-code-note {
            max-width: 760px; margin: 0 auto; padding: 16px 22px;
            border-left: 3px solid #68734A; border-right: 3px solid #7A2635;
            background: rgba(255,255,255,.045); color: #E9E0D5;
            text-align: center; font-family: var(--font-sans);
            font-size: .76rem; line-height: 1.8;
        }
        .dress-editorial-container {
            display: grid; grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px; max-width: 1040px; margin: 38px auto 0;
        }
        .dress-look-card {
            min-width: 0; overflow: hidden; border-radius: 12px;
            background: #F7F2EA; color: #292522;
            box-shadow: 0 16px 35px rgba(0,0,0,.3);
            transition: transform .35s ease, box-shadow .35s ease;
            border: 1px solid rgba(232,216,194,.55);
        }
        .dress-look-card:hover { transform: translateY(-7px); box-shadow: 0 24px 45px rgba(0,0,0,.38); }
        .dress-look-card img { width: 100%; height: 225px; object-fit: cover; display: block; }
        .dress-look-caption { padding: 16px 10px 18px; text-align: center; min-height: 85px; }
        .dress-look-caption strong {
            display: block; font-family: var(--font-display);
            font-size: .78rem; letter-spacing: 1px; margin-bottom: 7px; color: #34372A;
        }
        .dress-look-caption span { font-family: var(--font-sans); font-size: .67rem; color: #6b625c; line-height: 1.6; }
        @media (max-width: 760px) {
            #dress-code-center { padding: 56px 16px !important; }
            .dress-palette-group { padding: 20px 12px; }
            .dress-editorial-container { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 13px; }
            .dress-look-card img { height: 205px; }
            .color-swatch-circle { width: 51px; height: 51px; }
            .color-swatch-item { width: 70px; }
        }
        @media (max-width: 380px) {
            .dress-editorial-container { grid-template-columns: 1fr 1fr; }
            .dress-look-card img { height: 155px; }
            .dress-look-caption { padding: 12px 7px 14px; }
            .dress-look-caption strong { font-size: .68rem; }
        }

        /* --- GIFT REGISTRY STATIONS --- */
        .registry-central-card {
            max-width: 850px;
            margin: 0 auto;
            padding: 50px;
            text-align: center;
        }

        .registry-flex-channels {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .registry-channel-unit {
            padding: 30px;
            flex: 1;
            min-width: 240px;
            border: 1px dashed var(--primary-gold);
            border-radius: 4px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }

        .registry-channel-unit h4 {
            font-size: 1.15rem;
            color: var(--primary-gold);
            margin-bottom: 12px;
        }

        .registry-channel-unit code {
            font-family: var(--font-sans);
            font-size: 1rem;
            background: var(--soft-beige);
            padding: 4px 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: inline-block;
            word-break: break-all;
        }

        /* --- DYNAMIC RSVP FORM ARCHITECTURE --- */
        #rsvp-portal {
            background: linear-gradient(var(--surface-glass), var(--surface-glass)),
                url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            background-attachment: fixed;
        }

        .rsvp-form-enclosure {
            max-width: 800px;
            margin: 0 auto;
            padding: 60px;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .rsvp-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 35px;
        }

        .rsvp-form-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .rsvp-form-group.span-full {
            grid-column: span 2;
        }

        .rsvp-form-group label {
            font-family: var(--font-display);
            font-size: 0.8rem;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 1px;
            color: var(--text-main);
        }

        .rsvp-form-group input,
        .rsvp-form-group select,
        .rsvp-form-group textarea {
            padding: 14px;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid var(--border-glass);
            font-family: var(--font-sans);
            font-size: 0.95rem;
            color: var(--text-main);
            outline: none;
            border-radius: 4px;
            transition: var(--transition-fast);
        }

        [data-theme="dark"] .rsvp-form-group input,
        [data-theme="dark"] .rsvp-form-group select,
        [data-theme="dark"] .rsvp-form-group textarea {
            background: rgba(20, 20, 18, 0.7);
        }

        .rsvp-form-group input:focus,
        .rsvp-form-group select:focus,
        .rsvp-form-group textarea:focus {
            border-color: var(--primary-gold);
            background: #fff;
        }

        [data-theme="dark"] .rsvp-form-group input:focus,
        [data-theme="dark"] .rsvp-form-group select:focus,
        [data-theme="dark"] .rsvp-form-group textarea:focus {
            background: #1a1a18;
        }

        /* Post Submission Output Engines */
        /* .rsvp-post-submit-curtain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--bg-ivory);
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10;
            text-align: center;
            padding: 40px;
        } */


        .rsvp-post-submit-curtain {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--bg-ivory);
    display: none;
    flex-direction: column;
    justify-content: flex-start; /* Changed from center to allow smooth scrolling */
    align-items: center;
    z-index: 10;
    text-align: center;
    padding: 30px 20px;
    overflow-y: auto; /* Added so bottom content/buttons are scrollable */
}


        .rsvp-post-submit-curtain h3 {
            font-family: var(--font-accent);
            font-style: italic;
            font-size: 3rem;
            color: var(--primary-gold);
            margin-bottom: 15px;
        }

        .qr-output-zone {
            margin: 30px 0;
            padding: 15px;
            background: #fff;
            border: 1px solid var(--primary-gold);
            display: inline-block;
            border-radius: 4px;
        }

        .confetti-piece {
            position: absolute;
            width: 8px;
            height: 8px;
            opacity: 0.85;
            animation: confettiFall 3.5s linear forwards;
        }

        @keyframes confettiFall {
            0% {
                transform: translateY(-50px) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(800px) rotate(720deg);
                opacity: 0;
            }
        }

        /* --- PRESTIGE EDITORIAL FOOTER --- */
        footer {
            background: #121210;
            color: #FDFBF7;
            text-align: center;
            padding: 80px 24px;
            position: relative;
            z-index: 2;
        }

        footer h2 {
            font-family: var(--font-accent);
            font-style: italic;
            font-size: 3.2rem;
            color: var(--light-gold);
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        footer p {
            font-size: 0.85rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            opacity: 0.5;
            font-family: var(--font-display);
        }

        /* --- FULL STACK RESPONSIVE ADAPTABILITY MATRIX --- */
        @media(max-width: 968px) {
            .venue-dual-grid {
                grid-template-columns: 1fr;
            }

            .story-timeline-backbone::before {
                left: 30px;
            }

            .story-event-card-wrapper {
                width: 100%;
                float: none !important;
                text-align: left !important;
                padding-left: 65px;
                padding-right: 0;
            }

            .story-event-card-wrapper::after {
                left: 23px !important;
            }

            .rsvp-form-grid {
                grid-template-columns: 1fr;
            }

            .rsvp-form-group.span-full {
                grid-column: span 1;
            }
        }

        @media(max-width: 600px) {
            html {
                font-size: 14px;
            }

            .hero-content-house h1 {
                font-size: 3.8rem;
            }

            .envelope-3d {
                width: 90vw;
                height: 62vw;
            }

            .envelope-flap {
                border-left-width: 45vw;
                border-right-width: 45vw;
                border-top-width: 32vw;
            }

            .wax-seal-wrapper {
                left: 40vw;
                top: 26vw;
                width: 50px;
                height: 50px;
                font-size: 0.75rem;
            }

            .invitation-inner-card {
                width: 82vw;
                height: 54vw;
                padding: 15px;
                top: 10px;
                left: 15px;
            }

            #dock-navigation {
                width: 92%;
                justify-content: space-around;
                padding: 6px 10px;
            }

            .dock-link {
                padding: 6px 10px;
                font-size: 0.65rem;
                letter-spacing: 1px;
            }

            .system-utilities-tray {
                top: 15px;
                right: 15px;
            }

            .utility-btn {
                width: 38px;
                height: 38px;
            }

            .venue-button-group {
                flex-direction: column;
            }
        }


        /* --- CINEMATIC OLIVE, BURGUNDY & CHAMPAGNE VISUAL UPGRADE --- */
        :root {
            --primary-gold: #788456;
            --dark-gold: #414b2d;
            --light-gold: #e8d8c2;
            --dusty-rose: #8a3442;
            --shadow-premium: 0 24px 70px rgba(44, 36, 29, .12);
        }

        body {
            background-image:
                radial-gradient(ellipse at 8% 12%, rgba(120,132,86,.12), transparent 32%),
                radial-gradient(ellipse at 92% 36%, rgba(138,52,66,.09), transparent 34%),
                linear-gradient(135deg, rgba(255,255,255,.22), transparent 55%);
            background-attachment: fixed;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            opacity: .3;
            background-image: radial-gradient(rgba(120,132,86,.22) .7px, transparent .7px);
            background-size: 22px 22px;
            mask-image: linear-gradient(to bottom, black, transparent 85%);
        }

        .ambient-universe { z-index: 4; overflow: hidden; }
        .petal {
            background: linear-gradient(135deg, rgba(138,52,66,.85), rgba(232,216,194,.8) 55%, rgba(120,132,86,.8));
            box-shadow: 0 0 14px rgba(232,216,194,.22);
            opacity: .32;
            filter: blur(.15px);
        }
        .gold-dust {
            background: #d8c29f;
            box-shadow: 0 0 9px rgba(232,216,194,.9), 0 0 18px rgba(120,132,86,.35);
        }

        #hero-viewport {
            min-height: 680px;
            isolation: isolate;
            background: #171813;
        }
        .hero-parallax-bg {
            inset: -3%;
            width: 106%;
            height: 106%;
            transform: scale(1.08);
            filter: saturate(.82) contrast(1.04);
            animation: heroSlowZoom 24s ease-in-out infinite alternate;
        }
        #hero-viewport::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                linear-gradient(115deg, rgba(28,35,20,.74), transparent 48%, rgba(83,25,36,.45)),
                linear-gradient(to top, rgba(12,13,10,.68), transparent 48%);
        }
        #hero-viewport::after {
            content: "";
            position: absolute;
            inset: 18px;
            border: 1px solid rgba(232,216,194,.42);
            outline: 1px solid rgba(232,216,194,.15);
            outline-offset: 7px;
            pointer-events: none;
            z-index: 1;
        }
        .hero-content-house { position: relative; z-index: 2; animation: heroTextReveal 1.35s cubic-bezier(.2,.7,.2,1) both; }
        .hero-content-house h1 {
            text-shadow: 0 8px 35px rgba(0,0,0,.45);
            background: linear-gradient(100deg, #fffaf0 8%, #e8d8c2 48%, #fff 72%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-content-house .ampersand-divider { color: #d9bca0; }

        section:not(#hero-viewport) {
            isolation: isolate;
        }
        section:not(#hero-viewport)::before {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            top: 32px;
            right: -95px;
            z-index: -1;
            border-radius: 50%;
            border: 1px solid rgba(120,132,86,.15);
            box-shadow: 0 0 0 22px rgba(120,132,86,.025), 0 0 0 48px rgba(138,52,66,.025);
            pointer-events: none;
            animation: ringDrift 18s linear infinite;
        }
        .glass-card {
            border-radius: 20px;
            border-color: rgba(120,132,86,.23);
            box-shadow: 0 18px 55px rgba(38,35,27,.08), inset 0 1px rgba(255,255,255,.45);
            backdrop-filter: blur(18px) saturate(1.12);
        }
        .glass-card:hover {
            transform: translateY(-7px) scale(1.008);
            box-shadow: 0 28px 65px rgba(38,35,27,.14);
        }
        .gold-button, button:not(.utility-btn) {
            transition: transform .28s ease, box-shadow .28s ease, filter .28s ease;
        }
        .gold-button:hover, button:not(.utility-btn):hover {
            filter: brightness(1.04);
            box-shadow: 0 9px 28px rgba(104,115,74,.22);
        }
        #scroll-progress-indicator {
            background: linear-gradient(90deg, #68734a, #e8d8c2, #8a3442);
            box-shadow: 0 0 12px rgba(120,132,86,.42);
        }
        .system-utilities-tray { backdrop-filter: blur(16px); }
        .utility-btn {
            border: 1px solid rgba(232,216,194,.42) !important;
            box-shadow: 0 8px 25px rgba(0,0,0,.13);
            transition: transform .25s ease, background .25s ease;
        }
        .utility-btn:hover { transform: translateY(-3px) rotate(-3deg); }

        @keyframes heroSlowZoom {
            from { transform: scale(1.08) translate3d(-.5%, 0, 0); }
            to { transform: scale(1.17) translate3d(.5%, -1%, 0); }
        }
        @keyframes heroTextReveal {
            from { opacity: 0; transform: translateY(26px); filter: blur(7px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }
        @keyframes ringDrift { to { transform: rotate(360deg); } }

        [data-theme="dark"] body,
        body:has([data-theme="dark"]) {
            background-image:
                radial-gradient(ellipse at 12% 8%, rgba(104,115,74,.16), transparent 35%),
                radial-gradient(ellipse at 90% 42%, rgba(138,52,66,.13), transparent 34%),
                linear-gradient(135deg, rgba(255,255,255,.015), transparent 60%);
        }
        [data-theme="dark"] .glass-card {
            background: rgba(24,25,21,.78);
            border-color: rgba(120,132,86,.32);
            box-shadow: 0 22px 60px rgba(0,0,0,.24), inset 0 1px rgba(255,255,255,.035);
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
        @media (max-width: 768px) {
            #hero-viewport { min-height: 620px; }
            #hero-viewport::after { inset: 10px; outline-offset: 4px; }
            .hero-content-house h1 { font-size: clamp(2.6rem, 11vw, 4rem); }
            section:not(#hero-viewport)::before { width: 150px; height: 150px; right: -75px; }
        }

    </style>
</head>

<body>
@php
            $date = \Carbon\Carbon::parse($event->event_date);
            $eve = $date->format('d') . ' ' . strtoupper($date->format('F')) . ' ' . $date->format('Y');
        @endphp
    <!-- Ambient Environment Matrix -->
    <div class="ambient-universe" id="ambient-particle-space"></div>

    <!-- Hidden Core Audio Frame -->
    <audio id="core-audio-element" loop preload="auto">
        <source src="/music.mp3" type="audio/mpeg">
    </audio>

    <!-- Scroll Progress Indicator -->
    <div id="scroll-progress-indicator"></div>

    <!-- System Utilities Control Tray -->
    <div class="system-utilities-tray">
        <button class="utility-btn" id="language-toggle" title="Switch Language / Badili Lugha">
            <span style="font-family: var(--font-sans); font-size: 0.75rem; font-weight: 600;">EN</span>
        </button>
        <button class="utility-btn" id="theme-toggle" title="Toggle Appearance Profile">
            <i data-feather="sun"></i>
        </button>
        <button class="utility-btn" id="audio-state-control" title="Toggle Soundscape Ambient">
            <i data-feather="music"></i>
        </button>
    </div>

    <!-- Apple-Inspired Entry Loader Sequence -->
    <div id="luxury-loader">
        <div class="monogram-loader">{{ ucfirst($event->groom_name[0]) }} &bull; {{ ucfirst($event->bride_name[0]) }}</div>
        <div class="skeleton-bar">
            <div class="skeleton-progress"></div>
        </div>
    </div>

    <!-- Cinematic 3D Envelope Container Module -->
    <div id="envelope-wrapper">
        <div class="envelope-3d" id="interactive-envelope-node">
            <div class="envelope-flap"></div>
            <div class="wax-seal-wrapper">{{ ucfirst($event->groom_name[0]) }} & {{ ucfirst($event->bride_name[0]) }}</div>
            <div class="invitation-inner-card">
                <h4
                    style="font-family: var(--font-display); color: var(--primary-gold); letter-spacing: 3px; font-size: 0.8rem;">
                    THE CELEBRATION INVITATION</h4>
                <h2
                    style="font-family: var(--font-accent); font-style: italic; font-size: 2.6rem; margin: 20px 0 10px 0; font-weight: 400;">
                    {{$event->groom_name}} & {{$event->bride_name}}</h2>
                <p style="font-size: 1.1rem; font-style: italic; opacity: 0.7; margin-bottom: 20px;"
                    data-en="Click Seal to Open Experience" data-sw="Bonyeza Nta Kufungua Mwaliko">Bonyeza Nta Kufungua
                    Mwaliko</p>
                <div style="width: 30px; height: 1px; background: var(--primary-gold);"></div>
            </div>
        </div>
    </div>

    <!-- Interactive Apple Dock Navigation Menu -->
    <nav id="dock-navigation" class="glass-card" style="display: none;">
        <a href="#hero-viewport" class="dock-link active" data-en="Home" data-sw="Mwanzo">Mwanzo</a>
        <a href="#story-viewport" class="dock-link" data-en="Story" data-sw="Historia">Historia</a>
        <a href="#gallery-viewport" class="dock-link" data-en="Gallery" data-sw="Picha">Picha</a>
        <a href="#schedule-viewport" class="dock-link" data-en="Events" data-sw="Ratiba">Ratiba</a>
        <a href="#venue-viewport" class="dock-link" data-en="Venues" data-sw="Ukumbi">Ukumbi</a>
        <a href="#rsvp-viewport" class="dock-link" data-en="RSVP" data-sw="Thibitisha">Thibitisha</a>
    </nav>

    <!-- Master Viewport Workspace -->
    <main>

        <!-- Section: Hero Viewport Framework -->
        <header id="hero-viewport">
            <div class="hero-parallax-bg" id="hero-bg-parallax-node"></div>
            <div class="hero-content-house">
                <h3 data-en="The Celestial Wedding Invitation" data-sw="Mwaliko Rasmi Wa Harusi">Mwaliko Rasmi Wa
                    Harusi</h3>
                <h1>{{$event->groom_name}} & {{$event->bride_name}}</h1>
                <span class="ampersand-divider"></span>
                <p class="date-string">{{ $eve }}</p>
                <p class="poetic-quote">"Two souls with but a single thought, two hearts that beat as one."</p>
            </div>
        </header>

        <!-- Contextual Welcome Node -->
        <section id="personalized-guest-center" class="reveal">
            <div class="guest-welcome-card glass-card">
                <div class="guest-title-salutation" id="dynamic-salutation-node" data-en="{{ $token->guest_name }}"
                    data-sw="{{ $token->guest_name }}">{{ $token->guest_name }},</div>
                <p id="dynamic-welcome-statement"
                    data-en="We are truly honored to invite you to celebrate our special day."
                    data-sw="Tuna heshima kubwa kukualika kujumuika nasi kwenye siku yetu hii maalum.">Tuna heshima
                    kubwa kukualika kujumuika nasi kwenye siku yetu hii maalum.</p>

                <!-- Weather Widget Integration -->
                <div id="live-weather-card"
                    style="margin-top: 25px; font-family: var(--font-sans); font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px; opacity: 0.75; border: 1px solid var(--border-glass); padding: 6px 16px; border-radius: 20px;">
                    <i data-feather="sun" style="width: 14px; height: 14px; color: var(--primary-gold);"></i>
                    <span id="weather-text-anchor" data-en="Arusha Destination" data-sw="Hali ya Hewa Arusha">Hali ya
                        Hewa Arusha</span>
                </div>
            </div>
        </section>

        <!-- Section: Love Story Timeline Section -->
        <section id="story-viewport">
            <div class="section-header-block reveal">
                <h2 data-en="Our Chapter Story" data-sw="Historia ya Upendo Wetu">Historia ya Upendo Wetu</h2>
                <p data-en="How it all perfectly aligned" data-sw="Jinsi kila kitu kilivyojipanga kwa uzuri">Jinsi
                    kila kitu kilivyojipanga kwa uzuri</p>
            </div>

            <div class="story-timeline-backbone">
                <div class="story-event-card-wrapper reveal">
                    <div class="story-inner-card glass-card">
                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=600&q=80"
                            alt="Meeting Instance">
                        <!-- <span class="meta-date">NOVEMBER 14, 2023</span> -->
                        <h3 data-en="The Serendipitous Hello" data-sw="Kukutana kwa Bahati">Kukutana kwa Bahati</h3>
                        <p data-en="A simple unexpected meeting that altered the trajectory of our separate timelines forever."
                            data-sw="Mkutano rahisi usiotarajiwa ambao ulibadilisha mwelekeo wa maisha yetu milele.">
                        </p>
                    </div>
                </div>

                <div class="story-event-card-wrapper reveal">
                    <div class="story-inner-card glass-card">
                        <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&fit=crop&w=600&q=80"
                            alt="First Date">
                        <!-- <span class="meta-date">JANUARY 08, 2024</span> -->
                        <h3 data-en="The First Coffee Chapter" data-sw="Ahadi ya Kwanza">The Proposal</h3>
                        <p data-en="Hours melted like seconds under soft laughter, revealing matching patterns of soul and destiny."
                            data-sw="Masaa yalipita kama sekunde chini ya kicheko laini, ikionyesha maelekeo sawa ya roho na hatima zetu.">
                        </p>
                    </div>
                </div>

                <div class="story-event-card-wrapper reveal">
                    <div class="story-inner-card glass-card">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&w=600&q=80"
                            alt="The Proposal">
                        <span class="meta-date">{{ $eve }}</span>
                        <h3 data-en="The Sovereign Infinity Yes" data-sw="Mkataba wa Milele">Mkataba wa Milele</h3>
                        <p data-en="Beneath an expansive canopy of light projections, a lifelong query received its infinite answer."
                            data-sw="Chini ya dari kubwa ya makadirio ya mwanga, swali la maisha litapata jibu lake la milele.">
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Editorial Photo Gallery System -->
        <section id="gallery-viewport" style="display: none;">
            <div class="section-header-block reveal">
                <h2 data-en="Visual Gallery Elements" data-sw="Nyumba ya Picha Lookbook">Nyumba ya Picha Lookbook</h2>
                <p data-en="Moments frozen in perpetual romance"
                    data-sw="Nyakati zilizogandishwa katika mahaba ya daima">Nyakati zilizogandishwa katika mahaba ya
                    daima</p>
            </div>

            <div class="gallery-masonry-grid">
                <div class="gallery-photo-frame glass-card reveal">
                    <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=600&q=80"
                        alt="Look 1">
                    <div class="gallery-card-overlay"><span data-en="Editorial Look I"
                            data-sw="Mtazamo wa Kwanza I">Mtazamo wa Kwanza I</span></div>
                </div>
                <div class="gallery-photo-frame glass-card reveal">
                    <img src="https://images.unsplash.com/photo-1519225495810-7512c696505a?auto=format&fit=crop&w=600&q=80"
                        alt="Look 2">
                    <div class="gallery-card-overlay"><span data-en="Editorial Look II"
                            data-sw="Mtazamo wa Pili II">Mtazamo wa Pili II</span></div>
                </div>
                <div class="gallery-photo-frame glass-card reveal">
                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=600&q=80"
                        alt="Look 3">
                    <div class="gallery-card-overlay"><span data-en="Editorial Look III"
                            data-sw="Mtazamo wa Tatu III">Mtazamo wa Tatu III</span></div>
                </div>
            </div>
        </section>

        <!-- Native Lightbox Output Structure Engine -->
        <div id="lightbox-overlay-engine">
            <button class="lightbox-close-trigger"><i data-feather="x"
                    style="width: 32px; height: 32px;"></i></button>
            <img src="" alt="View Enlarge Context">
        </div>

        <!-- Section: Countdown Engine Counter Matrix -->
        <section id="countdown-anchor" class="reveal">
            <div class="countdown-flex-container">
                <div class="countdown-metric-card glass-card">
                    <data id="timer-days">00</data>
                    <label data-en="Days" data-sw="Siku">Siku</label>
                </div>
                <div class="countdown-metric-card glass-card">
                    <data id="timer-hours">00</data>
                    <label data-en="Hours" data-sw="Masaa">Masaa</label>
                </div>
                <div class="countdown-metric-card glass-card">
                    <data id="timer-minutes">00</data>
                    <label data-en="Minutes" data-sw="Dakika">Dakika</label>
                </div>
                <div class="countdown-metric-card glass-card">
                    <data id="timer-seconds">00</data>
                    <label data-en="Seconds" data-sw="Sekunde">Sekunde</label>
                </div>
            </div>
        </section>

        <!-- Section: Structured Wedding Day Itinerary Scheduler -->
        <section id="schedule-viewport" style="display: none;">
            <div class="section-header-block reveal">
                <h2 data-en="Chronicle of Events" data-sw="Ratiba ya Siku Maalum">Ratiba ya Siku Maalum</h2>
                <p data-en="The formal unfolding of our celebration day"
                    data-sw="Ufunguzi rasmi wa siku yetu ya sherehe">Ufunguzi rasmi wa siku yetu ya sherehe</p>
            </div>

            <div class="schedule-linear-track">
                <div class="schedule-timeline-unit reveal">
                    <div class="schedule-time-meta">09:30 AM</div>
                    <div class="schedule-event-details-box">
                        <h3 data-en="The Arrivals & Pre-lude" data-sw="Kuwasili & Maandalizi">Kuwasili & Maandalizi
                        </h3>
                        <p data-en="Seating procedures and ambient orchestration within the cathedral foyer grounds."
                            data-sw="Taratibu za kuketi na mipangilio ya mazingira ndani ya uwanja wa kanisa kuu."></p>
                    </div>
                </div>

                <div class="schedule-timeline-unit reveal">
                    <div class="schedule-time-meta">10:00 AM</div>
                    <div class="schedule-event-details-box">
                        <h3 data-en="Holy Matrimony Nuptials" data-sw="Ibada Takatifu ya Ndoa">Ibada Takatifu ya Ndoa
                        </h3>
                        <p data-en="The absolute exchange of vows, standard custom protocols, and union sealing."
                            data-sw="Kubadilishana kwa viapo kabisa, itifaki za kawaida, na kufunga muungano wetu.">
                        </p>
                    </div>
                </div>

                <div class="schedule-timeline-unit reveal">
                    <div class="schedule-time-meta">05:00 PM</div>
                    <div class="schedule-event-details-box">
                        <h3 data-en="The Reception Gala Banquet" data-sw="Sherehe Kuu ya Harusi">Sherehe Kuu ya Harusi
                        </h3>
                        <p data-en="Grand ballroom protocol access doors unlock for dining, speeches, and evening dance."
                            data-sw="Milango ya ukumbi mkuu inafunguliwa kwa chakula cha jioni, hotuba, na densi ya usiku.">
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Editorial Venues Matrix Blueprint -->
        <section id="venue-viewport">
            <div class="section-header-block reveal">
                <h2 data-en="The Coordinates" data-sw="Maeneo ya Sherehe">Maeneo ya Sherehe</h2>
                <p data-en="Spaces hosting our sacred moments" data-sw="Nafasi zitakazohifadhi nyakati zetu takatifu">
                    Nafasi zitakazohifadhi nyakati zetu takatifu</p>
            </div>

            <div class="venue-dual-grid">
                <div class="venue-editorial-card glass-card reveal">
                    <div>
                        <h3 data-en="Sacred Covenant Site" data-sw="Eneo la Ibada">Eneo la Ibada</h3>
                        <p>Evangelistic Assemblies of God of Tanzania (EAGT)
                            <i>MOROMBO, Arusha</i><br>
                            <en>12:00 Noon</en>
                        </p>
                        <div class="interactive-iframe-holder">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.917910537401!2d36.654554109874354!3d-3.370242296590269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18371d6004e7125d%3A0xeeb184ecbe6d52eb!2sEAGT%20Majengo!5e0!3m2!1sen!2stz!4v1793187237116!5m2!1sen!2stz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                    </div>
                    <div class="venue-button-group">
                        <a href="https://maps.app.goo.gl/tJS4t66ZT6j8gi6o9" target="_blank" class="gold-button"><i
                                data-feather="navigation" style="width:14px;"></i> Navigation</a>
                        <button class="gold-button copy-address-btn"
                            data-address="https://maps.app.goo.gl/tJS4t66ZT6j8gi6o9"><i data-feather="copy"
                                style="width:14px;"></i> <span data-en="Copy" data-sw="Nakili">Nakili</span></button>
                    </div>
                </div>

                <div class="venue-editorial-card glass-card reveal">
                    <div>
                        <h3 data-en="The Reception Gala Grounds" data-sw="Ukumbi wa Sherehe">Ukumbi wa Sherehe</h3>
                        <p>Arusha Mall</p>
                        <p><en>6:00pm</en></p>
                        <div class="interactive-iframe-holder">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.925812846369!2d36.67756620987422!3d-3.3683113965922!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18371d40d3b1a38d%3A0x424e4211533b427c!2sArusha%20Mall!5e0!3m2!1sen!2stz!4v1793187454392!5m2!1sen!2stz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                    </div>
                    <div class="venue-button-group">
                        <a href="https://maps.app.goo.gl/xs3TKenk63wbo1Qe6" target="_blank" class="gold-button"><i
                                data-feather="navigation" style="width:14px;"></i> Navigation</a>
                        <button class="gold-button copy-address-btn"
                            data-address="https://maps.app.goo.gl/xs3TKenk63wbo1Qe6"><i data-feather="copy"
                                style="width:14px;"></i> <span data-en="Copy" data-sw="Nakili">Nakili</span></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Wedding Dress Code -->
        

        <!-- Section: Gift Registry Intermediary Platform -->
        <section id="gift-registry-station" style="display: ;">
            <div class="section-header-block reveal">
                <h2 data-en="Love Registry" data-sw="Mfuko wa Baraka">Mfuko wa Baraka</h2>
                <p data-en="Support options for our foundational home assets"
                    data-sw="Chaguzi za usaidizi kwa mali zetu za msingi za nyumbani">Chaguzi za usaidizi kwa mali zetu
                    za msingi za nyumbani</p>
            </div>

            <div class="registry-central-card glass-card reveal">
                <p style="font-style: italic; max-width: 600px; margin: 0 auto 30px auto;"
                    data-en="Your physical presence tops our scale of appreciation. If you feel led to grace our start with token financial support, pathways are embedded below."
                    data-sw="Kuwepo kwako ni zawadi kubwa kwetu. Ukitamani kutubariki kwa namna ya kifedha, njia zimewekwa hapa chini.">
                </p>
                <div class="registry-flex-channels">
                    <div class="registry-channel-unit">
                        <h4 data-en="Mobile Payments" data-sw="Malipo ya Simu">Malipo ya Simu</h4>
                        <code>Mixx By Yas: 0672979591</code><i>Hans Mfinanga</i>
                        <button class="gold-button copy-registry-btn" data-copyval="0672979591" data-en="Copy Key"
                            data-sw="Nakili">Nakili</button>
                    </div>
                    <div class="registry-channel-unit">
                        <h4 data-en="Banking Pipeline" data-sw="Akaunti ya Benki">Akaunti ya Benki</h4>
                        <code>NMB Bank: 20310048151</code><i>Hans Mfinanga</i>
                        <button class="gold-button copy-registry-btn" data-copyval="20310048151"
                            data-en="Copy Account" data-sw="Nakili">Nakili</button>
                    </div>
                    
                </div>
            </div>
        </section>
        <section id="dress-code-center" class="reveal mx-auto" style="width: 100% !important; align-items: center; border-color: var(--border-glass); border-width: 1px; border-style: solid; padding: 40px 20px; margin-top: 40px; border-radius: 8px;">
            <div class="section-header-block reveal">
                <h2 data-en="The Dress Code" data-sw="Mavazi ya Sherehe">The Dress Code</h2>
                <p class="dress-code-intro"
                    data-en="A celebration deserves its finest — kindly dress in elegant, formal attire."
                    data-sw="Sherehe hii inastahili mavazi bora — tafadhali vaa mavazi rasmi na ya kifahari.">
                    A celebration deserves its finest — kindly dress in elegant, formal attire.
                </p>
            </div>

            <div class="dress-palette-group">
                <div class="dress-palette-label" data-en="Ladies · Elegant Gowns" data-sw="Kina dada · Gauni za kifahari">Ladies · Elegant Gowns</div>
                <div class="color-palette-row">
                    <div class="color-swatch-item"><span class="color-swatch-circle" style="background:#51151F;"></span><span class="color-swatch-name">Merlot / Burgundy</span></div>
                    <div class="color-swatch-item"><span class="color-swatch-circle" style="background:#535B39;"></span><span class="color-swatch-name">Olive Green</span></div>
                </div>
            </div>

            <div class="dress-palette-group">
                <div class="dress-palette-label" data-en="Gentlemen · Formal Suits" data-sw="Kina kaka · Suti rasmi">Gentlemen · Formal Suits</div>
                <div class="color-palette-row">
                    <div class="color-swatch-item"><span class="color-swatch-circle" style="background:#B99A78;"></span><span class="color-swatch-name">Camel</span></div>
                    <div class="color-swatch-item"><span class="color-swatch-circle" style="background:#E8D8C2;"></span><span class="color-swatch-name">Beige</span></div>
                    <div class="color-swatch-item"><span class="color-swatch-circle" style="background:#535B39;"></span><span class="color-swatch-name">Olive Green</span></div>
                    <div class="color-swatch-item"><span class="color-swatch-circle" style="background:#171717;"></span><span class="color-swatch-name">Black</span></div>
                </div>
            </div>

            <div class="dress-code-note" data-en="Ladies are invited to wear elegant Merlot/Burgundy or Olive Green gowns. Gentlemen may choose Camel, Beige, Olive Green or a classic Black suit. Formal, coordinated looks are encouraged."
                data-sw="Kina dada wanakaribishwa kuvaa gauni za Merlot/Burgundy au Olive Green. Kina kaka wanaweza kuvaa suti za Camel, Beige, Olive Green au Black. Mavazi rasmi yanayopendeza yanakaribishwa.">
                Ladies are invited to wear elegant Merlot/Burgundy or Olive Green gowns. Gentlemen may choose Camel, Beige, Olive Green or a classic Black suit. Formal, coordinated looks are encouraged.
            </div>

            <div class="dress-editorial-container">
                <article class="dress-look-card">
                    <img src="https://thedesignerprecinct.com/cdn/shop/files/OLV0233-Burgundy-01.jpg?v=1790746981" alt="Elegant merlot burgundy formal gown" loading="lazy">
                    <div class="dress-look-caption"><strong>MERLOT / BURGUNDY</strong><span data-en="Ladies' formal gowns" data-sw="Mavazi rasmi ya kina dada">Ladies' formal gowns</span></div>
                </article>
                <article class="dress-look-card">
                    <img src="/female.jpeg" alt="Elegant olive green formal gown inspiration" loading="lazy">
                    <div class="dress-look-caption"><strong>OLIVE GREEN</strong><span data-en="Ladies' formal gowns" data-sw="Mavazi rasmi ya kina dada">Ladies' formal gowns</span></div>
                </article>
                <article class="dress-look-card">
                     <img src="/male1.jpeg" alt="Classic black formal men's suit" loading="lazy">
                    <div class="dress-look-caption"><strong>CAMEL / OLIVE GREEN / BLACK</strong><span data-en="Tailored suits" data-sw="Suti zilizoshonwa vizuri">Tailored suits</span></div>
                </article>
                <article class="dress-look-card">
                   
                    <img src="/male2.jpeg" alt="Camel and beige tailored men's suit" loading="lazy">
                    <div class="dress-look-caption"><strong>BEIGE / BLACK SUIT</strong><span data-en="Formal suits are welcome" data-sw="Suti rasmi zinakaribishwa">Formal suits are welcome</span></div>
                </article>
            </div>
        </section>

        <!-- Section: Core Dynamic Family Acknowledgements -->
        {{-- <section id="family-lineage-node">
            <div class="section-header-block reveal">
                <h2 data-en="With Boundless Joy" data-sw="Kwa Furaha Isiyo na Kifani">Kwa Furaha Isiyo na Kifani</h2>
            </div>
            <div style="display: flex; justify-content: center; gap: 80px; flex-wrap: wrap; text-align: center;"
                class="reveal">
                <div>
                    <h4 style="font-family: var(--font-display); color: var(--sage-green); font-size: 0.9rem; margin-bottom: 10px;"
                        data-en="PARENTS OF THE GROOM" data-sw="WAZAZI WA BWANA HARUSI">WAZAZI WA BWANA HARUSI</h4>
                    <p style="font-size: 1.5rem; font-family: var(--font-accent); font-style: italic;">Mr. &amp; Mrs.
                        Haggai Kinyau</p>
                </div>
                <div
                    style="font-family: var(--font-accent); font-style: italic; font-size: 2rem; color: var(--primary-gold); align-self: center;">
                    &amp;</div>
                <div>
                    <h4 style="font-family: var(--font-display); color: var(--sage-green); font-size: 0.9rem; margin-bottom: 10px;"
                        data-en="PARENTS OF THE BRIDE" data-sw="WAZAZI WA BIBI HARUSI">WAZAZI WA BIBI HARUSI</h4>
                    <p style="font-size: 1.5rem; font-family: var(--font-accent); font-style: italic;">Mr. &amp; Mrs.
                        Eugen Tzan</p>
                </div>
            </div>
        </section> --}}

        <!-- Section: Automated RSVP Submission Interface Engine -->
        <section id="rsvp-viewport" style="display: none;">
            <div class="section-header-block reveal">
                <h2 data-en="Attendance Confirmation" data-sw="Thibitisha Kuhudhuria">Thibitisha Kuhudhuria</h2>
                <p data-en="Lock your designation seat inside our system registry"
                    data-sw="Weka nafasi yako ya kiti ndani ya mfumo wetu rasmi">Weka nafasi yako ya kiti ndani ya
                    mfumo wetu rasmi</p>
            </div>

            <div class="rsvp-form-enclosure glass-card reveal" id="rsvp-interface-container-node">
                <!-- Built in Success Curtain Node -->
                <div class="rsvp-post-submit-curtain" id="rsvp-success-curtain-layer">

                    <!-- Shown when the guest has ACCEPTED -->
                    <div id="rsvp-status-accepted-block" style="display:none;">
                        <h3 data-en="Confirmation Secured" data-sw="Imethibitishwa Kikamilifu">Confirmation Secured
                        </h3>
                        <p data-en="Your data values have populated our database. Save your entry QR key token below."
                            data-sw="Taarifa zako zimehifadhiwa kwenye kanzidata yetu. Hifadhi alama yako ya QR hapa chini.">
                        </p>

                        <div class="qr-output-zone" id="generated-qrcode-target"></div>

                        <div
                            style="margin-top: 20px; display: flex; flex-direction: column; gap: 15px; align-items: center;">
                            <button class="gold-button" id="whatsapp-share-trigger-btn" style="display: none"><i
                                    data-feather="message-circle"></i> <span data-en="Transmit to Couple via WhatsApp"
                                    data-sw="Tuma kwa Wanandoa WhatsApp">Transmit to Couple via WhatsApp</span></button>
                            <button class="gold-button" style="display: none" id="calendar-reminder-btn"><i
                                    data-feather="calendar"></i> <span data-en="Add to Google Calendar"
                                    data-sw="Weka Kwenye Kalenda">Add to Google
                                    Calendar</span></button>
                        </div>
                    </div>

                    <!-- Shown when the guest has DECLINED -->
                    <div id="rsvp-status-declined-block" style="display:none;">
                        <h3 data-en="Response Received" data-sw="Jibu Limepokelewa">Response Received</h3>
                        <p data-en="We're sorry you won't be able to join us, but we sincerely appreciate you taking the time to let us know. Thank you, and we hope to celebrate with you another time."
                            data-sw="Tunasikitika hutaweza kuja, lakini tunashukuru sana kwa kutujulisha. Asante, na tunatumaini kukutana nawe wakati mwingine.">
                            We're sorry you won't be able to join us, but we sincerely appreciate you taking the time
                            to let us know. Thank you, and we hope to celebrate with you another time.</p>
                    </div>

                    <!-- Always available: lets the guest re-open the form and update their response -->
                    
                </div>

                <!-- Form Framework Target Element -->
                <form id="rsvp-interactive-form-element" onsubmit="processRSVPSubmitPipeline(event)">
                    <div class="rsvp-form-grid">
                        <div class="rsvp-form-group">
                            <label for="input-field-name" data-en="Full Signature Name"
                                data-sw="Majina Kamili">Majina Kamili</label>
                            <input type="text" id="input-field-name" required placeholder="e.g. Raphael Siphael"
                                value='{{ $token->guest_name }}' readonly>
                            <input type="hidden" id="input-field-app" value="{{ $app }}">
                            <input type="hidden" id="input-field-token" value="{{ $token->invitation_token }}">
                        </div>
                        <div class="rsvp-form-group">
                            <label for="select-field-status" data-en="Attendance Status"
                                data-sw="Hali ya Kuhudhuria">Hali ya Kuhudhuria</label>
                            <div class="radio-group-status"
                                style="display: flex; flex-direction: column; gap: 8px; margin: 12px 0;">
                               

                                <label
                                    style="display: flex; align-items: center; gap: 8px; font-size: 13px; cursor: pointer;">
                                    <input type="radio" name="attendance_status" id="select-field-status-accepted"
                                        value="Accepted" checked data-en="Joyfully Accepting"
                                        data-sw="Naitikia kwa Furaha">
                                    <span data-en="Joyfully Accepting" data-sw="Naitikia kwa Furaha">Naitikia kwa
                                        Furaha</span>
                                </label>

                                <label
                                    style="display: flex; align-items: center; gap: 8px; font-size: 13px; cursor: pointer;">
                                    <input type="radio" name="attendance_status" id="select-field-status-declined"
                                        value="Declined" data-en="Regretfully Declining"
                                        data-sw="Nasikitika Sitoweza">
                                    <span data-en="Regretfully Declining" data-sw="Nasikitika Sitoweza">Nasikitika
                                        Sitoweza</span>
                                </label>
                            </div>
                        </div>
                        <div class="rsvp-form-group">
                            <label for="select-field-adults" data-en="Adult Seats Requested"
                                data-sw="Idadi ya Watu Wazima">Idadi ya Watu Wazima</label>
                            <input type="number" required value="1" min="1" id="select-field-adults">

                        </div>
                        <div class="rsvp-form-group">
                            <label for="select-field-children" data-en="Children Under 10 Seats"
                                data-sw="Idadi ya Watoto">Idadi ya Watoto</label>
                            <input type="number" required value="0" min="0" id="select-field-children">
                          
                        </div>
                        <div class="rsvp-form-group" style="display: none;">
                            <label for="select-field-meal" data-en="Dietary Profile Selection"
                                data-sw="Upendeleo wa Chakula">Upendeleo wa Chakula</label>
                            <select id="select-field-meal">
                                <option value="Standard Imperial" data-en="Standard Imperial Gourmet"
                                    data-sw="Chakula cha Kawaida">Chakula cha Kawaida</option>
                                <option value="Halal Certified" data-en="Halal Custom Package"
                                    data-sw="Chakula cha Halal">Chakula cha Halal</option>
                                <option value="Vegan Botanical" data-en="Vegan / Plant Based Luxury"
                                    data-sw="Chakula cha Mboga Mboga">Chakula cha Mboga Mboga</option>
                            </select>
                        </div>
                        <div class="rsvp-form-group" style="display: none;">
                            <label for="input-field-phone" data-en="Primary Mobile Number"
                                data-sw="Namba ya Simu">Namba ya Simu</label>
                            <input type="tel" id="input-field-phone" placeholder="e.g. +255 700 000 000">
                        </div>
                        <div class="rsvp-form-group span-full" style="display: none;">
                            <label for="input-field-email" data-en="Digital Mail Destination"
                                data-sw="Barua Pepe (Email)">Barua Pepe (Email)</label>
                            <input type="email" id="input-field-email" placeholder="signature@domain.com">
                        </div>
                        <div class="rsvp-form-group span-full">
                            <label for="textarea-field-message" data-en="Warm Blessings & Notes"
                                data-sw="Ujumbe au Baraka Zako">Ujumbe au Baraka Zako</label>
                            <textarea id="textarea-field-message" rows="4" placeholder="Andika baraka au ujumbe wako hapa..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="gold-button" style="width: 100%;" id="rsvp-submit-btn-copy"
                        data-en="Lock Response Registry" data-sw="Thibitisha Nafasi Yako">Thibitisha Nafasi
                        Yako</button>
                </form>
            </div>
        </section>

    </main>

    <!-- Global Timeless Luxury Footer Architecture -->
    <footer>
        <h2>{{$event->groom_name}} &amp; {{$event->bride_name}}</h2>
        
        <p data-en="{{$eve}} — FOREVER ALIGNED"
            data-sw="{{$eve}} UPENDO WA MILELE">{{$eve}} — UPENDO WA
            MILELE</p>
    </footer>

    <!-- --- CORE SYSTEM ARCHITECTURE CODE ENGINE --- -->
    <script>

        // Sync toggle icon with the theme applied in <head>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('theme-toggle');
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            btn.innerHTML = `<i data-feather="${isDark ? 'sun' : 'moon'}"></i>`;
            feather.replace();
        });
        var data = @json($token ?? []);
        // console.log(data);


        if (data.rsvp_status == "Accepted") {

            var image_url = '/' + data.event.app_name + '/cards/' + 'guest_' + data.id + '.png';
            console.log(image_url);
            // return;

            finalizeSuccessfulRSVPUiState(image_url, "Accepted");
        } else if (data.rsvp_status == "Declined") {

            finalizeSuccessfulRSVPUiState(null, "Declined");
        }

        // --- PREFILL FORM WITH PREVIOUSLY STORED RESPONSE (fetched from database) ---
        function prefillFormFromStoredResponse() {
            if (!data.rsvp_status) return;

            if (data.rsvp_status === "Declined") {
                const declinedRadio = document.getElementById("select-field-status-declined");
                if (declinedRadio) declinedRadio.checked = true;
            } else if (data.rsvp_status === "Accepted") {
                const acceptedRadio = document.getElementById("select-field-status-accepted");
                if (acceptedRadio) acceptedRadio.checked = true;
            }

            if (data.adults !== undefined && data.adults !== null) {
                const adultsField = document.getElementById("select-field-adults");
                if (adultsField) adultsField.value = data.adults;
            }
            if (data.children !== undefined && data.children !== null) {
                const childrenField = document.getElementById("select-field-children");
                if (childrenField) childrenField.value = data.children;
            }
            if (data.meal) {
                const mealField = document.getElementById("select-field-meal");
                if (mealField) mealField.value = data.meal;
            }
            if (data.phone) {
                const phoneField = document.getElementById("input-field-phone");
                if (phoneField) phoneField.value = data.phone;
            }
            if (data.email) {
                const emailField = document.getElementById("input-field-email");
                if (emailField) emailField.value = data.email;
            }
            if (data.message) {
                const messageField = document.getElementById("textarea-field-message");
                if (messageField) messageField.value = data.message;
            }
        }
        prefillFormFromStoredResponse();

        // --- DATA DICTIONARY SYSTEM LAYER ---
        const languageDictionarySystem = {
            en: {
                mmet: "A simple unexpected meeting that altered the trajectory of our separate timelines forever.",
                mdate: "Hours melted like seconds under soft laughter, revealing matching patterns of soul and destiny.",
                mprop: "Beneath an expansive canopy of light projections, a lifelong query received its infinite answer.",
                flad: "Elegant formal gowns in Merlot/Burgundy or Olive Green.",
                fgen: "Formal suits in Camel, Beige, Olive Green, or Black.",
                freg: "Your physical presence tops our scale of appreciation. If you feel led to grace our start with token financial support, pathways are embedded below.",
                fsucc: "Your data values have populated our database. Save your entry QR key token below."
            },
            sw: {
                mmet: "Mkutano rahisi usiotarajiwa ambao ulibadilisha mwelekeo wa maisha yetu tofauti milele.",
                mdate: "Masaa yalipita kama sekunde chini ya kicheko laini, ikionyesha mifumo inayolingana ya roho na hatima.",
                mprop: "Chini ya dari kubwa ya makadirio ya mwanga, swali la maisha yote lilipata jibu lake lisilo na kikomo.",
                flad: "Mavazi rasmi ya kifahari ya rangi ya Merlot/Burgundy au kijani cha Olive.",
                fgen: "Suti rasmi za rangi ya Camel, Beige, kijani cha Olive, au nyeusi.",
                freg: "Kuwepo kwako kimwili ndio kiwango chetu cha juu cha shukrani. Ukiongozwa kutubariki kwa msaada vya kifedha, njia zimewekwa hapa chini.",
                fsucc: "Taarifa zako zimehifadhiwa kwenye mfumo wetu. Hifadhi alama yako ya usalama ya QR hapa chini."
            }
        };

        let activeSystemLanguage = "en";
        let capturedGlobalGuestIdentity = "Mgeni";

        // --- LIFE-CYCLE BOOT MANAGER ---
        document.addEventListener("DOMContentLoaded", () => {
            feather.replace();
            initializeAmbientSpace();
            interceptUrlGuestParameter();
            executeDynamicScrollObservers();
            initiateTargetCountdownEngine("2026-11-15T10:00:00");
            setupEventInteractions();
            triggerLanguageLoadSetup();
            loadExistingGuestResponse();

            // Fire Loader Termination Sequence
            setTimeout(() => {
                const preloader = document.getElementById("luxury-loader");
                preloader.style.opacity = "0";
                setTimeout(() => {
                    preloader.style.display = "none";
                    const envelopeZone = document.getElementById("envelope-wrapper");
                    envelopeZone.style.display = "flex";
                }, 1200);
            }, 2600);
        });

        // --- AMBIENT SIMULATION MODULE ---
        function initializeAmbientSpace() {
            const backgroundSpace = document.getElementById("ambient-particle-space");

            // Build Floating Petals
            for (let i = 0; i < 24; i++) {
                let petal = document.createElement("span");
                petal.className = "petal";
                petal.style.left = Math.random() * 100 + "vw";
                petal.style.width = petal.style.height = (Math.random() * 14 + 8) + "px";
                petal.style.animationDelay = Math.random() * 7 + "s";
                petal.style.animationDuration = Math.random() * 12 + 12 + "s";
                backgroundSpace.appendChild(petal);
            }
            // Build Shimmering Gold Dust
            for (let j = 0; j < 34; j++) {
                let dust = document.createElement("span");
                dust.className = "gold-dust";
                dust.style.left = Math.random() * 100 + "vw";
                dust.style.animationDelay = Math.random() * 6 + "s";
                dust.style.animationDuration = Math.random() * 10 + 9 + "s";
                backgroundSpace.appendChild(dust);
            }
        }

        // --- URL GUEST PARSER & INJECTOR ---
        function interceptUrlGuestParameter() {
            const processingParams = new URLSearchParams(window.location.search);
            const rawParamName = processingParams.get("guest");
            const salutationNode = document.getElementById("dynamic-salutation-node");
            const formNameInput = document.getElementById("input-field-name");

            if (rawParamName) {
                capturedGlobalGuestIdentity = decodeURIComponent(rawParamName);
                salutationNode.setAttribute("data-en", `Dear ${capturedGlobalGuestIdentity},`);
                salutationNode.setAttribute("data-sw", `Kwa Ndugu Mpendwa ${capturedGlobalGuestIdentity},`);
                salutationNode.innerText = activeSystemLanguage === "en" ? `Dear ${capturedGlobalGuestIdentity},` :
                    `Kwa Ndugu Mpendwa ${capturedGlobalGuestIdentity},`;
                if (formNameInput) formNameInput.value = capturedGlobalGuestIdentity;
            }
        }

        // --- 3D INTERACTIVE ENVELOPE CONTROLLER ---
        const envelopeModuleNode = document.getElementById("interactive-envelope-node");
        const globalAudioFrame = document.getElementById("core-audio-element");
        const audioTrayBtn = document.getElementById("audio-state-control");
        let systemAudioPlaying = false;

        envelopeModuleNode.addEventListener("click", () => {
            if (!envelopeModuleNode.classList.contains("open")) {
                envelopeModuleNode.classList.add("open");

                // Attempt Browser Audio Autoplay Bypass
                globalAudioFrame.play().then(() => {
                    systemAudioPlaying = true;
                    audioTrayBtn.querySelector("i").remove();
                    audioTrayBtn.innerHTML = `<i data-feather="disc" class="rotating"></i>`;
                    feather.replace();
                }).catch(() => console.log("Soundscape initial blocking bypassed via click logic protocol."));

                // Soft Dismiss Wrapper Layer completely
                setTimeout(() => {
                    const masterWrapper = document.getElementById("envelope-wrapper");
                    masterWrapper.style.opacity = "0";
                    setTimeout(() => {
                        masterWrapper.style.display = "none";
                        document.getElementById("dock-navigation").classList.add("visible");
                    }, 800);
                }, 2000);
            }
        });

        // --- AUDIO CONTROLLER MANAGEMENT MATRIX ---
        audioTrayBtn.addEventListener("click", () => {
            if (systemAudioPlaying) {
                globalAudioFrame.pause();
                audioTrayBtn.innerHTML = `<i data-feather="music"></i>`;
                systemAudioPlaying = false;
            } else {
                globalAudioFrame.play();
                audioTrayBtn.innerHTML = `<i data-feather="disc" class="rotating"></i>`;
                systemAudioPlaying = true;
            }
            feather.replace();
        });

        // --- THEME PROFILE MANAGER MATRIX ---
        const themeToggleBtn = document.getElementById("theme-toggle");
        themeToggleBtn.addEventListener("click", () => {
            const isDark = document.documentElement.getAttribute("data-theme") === "dark";
            const nextTheme = isDark ? "light" : "dark";
            document.documentElement.setAttribute("data-theme", nextTheme);
            try { localStorage.setItem("theme", nextTheme); } catch (e) {}
            themeToggleBtn.innerHTML = `<i data-feather="${nextTheme === "dark" ? "sun" : "moon"}"></i>`;
            feather.replace();
        });


        // --- CHANGE RESPONSE ENGINE (re-opens the editable form over the curtain) ---
        // --- EVENT DELEGATION FOR CHANGE RESPONSE BUTTON ---
document.addEventListener("click", function (event) {
    const changeBtn = event.target.closest("#change-response-btn");

    if (changeBtn) {
        document.getElementById("rsvp-success-curtain-layer").style.display = "none";

        const btnSubmit = document.getElementById("rsvp-submit-btn-copy");
        if (btnSubmit) {
            btnSubmit.disabled = false;
            btnSubmit.innerText = activeSystemLanguage === "en"
                ? "Lock Response Registry"
                : "Thibitisha Nafasi Yako";
        }
    }
});

        // --- LANGUAGE SWITCH OVERRIDE ENGINE ---
        const languageToggleBtn = document.getElementById("language-toggle");
        languageToggleBtn.addEventListener("click", () => {
            activeSystemLanguage = activeSystemLanguage === "en" ? "sw" : "en";
            languageToggleBtn.querySelector("span").innerText = activeSystemLanguage.toUpperCase();
            triggerLanguageLoadSetup();
        });

        function triggerLanguageLoadSetup() {
            // Loop Translate Elements matching system mapping keys
            document.querySelectorAll("[data-en]").forEach(elem => {
                const chosenTranslationString = elem.getAttribute(`data-${activeSystemLanguage}`);
                if (chosenTranslationString) {
                    if (elem.tagName === "INPUT" || elem.tagName === "TEXTAREA") {
                        elem.setAttribute("placeholder", chosenTranslationString);
                    } else {
                        elem.innerText = chosenTranslationString;
                    }
                }
            });

            // Re-update static string paragraphs manually linked from target dictionary array
            document.querySelectorAll("#story-viewport .story-event-card-wrapper").forEach((card, idx) => {
                const keys = ["mmet", "mdate", "mprop"];
                card.querySelector("p").innerText = languageDictionarySystem[activeSystemLanguage][keys[idx]];
            });

            document.querySelectorAll(".dress-profile-card").forEach((card, idx) => {
                const keys = ["flad", "fgen"];
                card.querySelector("p").innerText = languageDictionarySystem[activeSystemLanguage][keys[idx]];
            });

            document.querySelector("#gift-registry-station p").innerText = languageDictionarySystem[activeSystemLanguage][
                "freg"
            ];
            const successTextElement = document.querySelector("#rsvp-success-curtain-layer p");
            if (successTextElement) {
                successTextElement.innerText = languageDictionarySystem[activeSystemLanguage]["fsucc"];
            }
        }

        // --- PERFORMANCE OPTIMIZED ANIMATION FRAMEWORK & SCROLL ENGINE ---
        function executeDynamicScrollObservers() {
            const targetRevealNodes = document.querySelectorAll(".reveal");
            const navAnchors = document.querySelectorAll(".dock-link");
            const structuralSections = document.querySelectorAll("section, header");
            const barProgress = document.getElementById("scroll-progress-indicator");

            const observerInstance = new IntersectionObserver((entries) => {
                entries.forEach(ent => {
                    if (ent.isIntersecting) ent.target.classList.add("active");
                });
            }, {
                threshold: 0.12
            });

            targetRevealNodes.forEach(node => observerInstance.observe(node));

            window.addEventListener("scroll", () => {
                const currentWinScrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const docHeightSpread = document.documentElement.scrollHeight - document.documentElement
                    .clientHeight;
                const trackedPercentage = (currentWinScrollTop / docHeightSpread) * 100;
                barProgress.style.width = trackedPercentage + "%";

                // Parallax background processing calculations
                document.getElementById("hero-bg-parallax-node").style.transform =
                    `translateY(${currentWinScrollTop * 0.35}px) scale(1.08)`;

                // Active Tab Class Switch Tracking Pipeline
                let workingSectionActiveId = "hero-viewport";
                structuralSections.forEach(sect => {
                    if (currentWinScrollTop >= (sect.offsetTop - 280)) {
                        workingSectionActiveId = sect.getAttribute("id");
                    }
                });
                navAnchors.forEach(link => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === `#${workingSectionActiveId}`) link.classList.add(
                        "active");
                });
            });
        }

        // --- LUXURY COUNTDOWN ENGINE ---
        function initiateTargetCountdownEngine(targetIsoString) {
            const destinationTime = new Date(targetIsoString).getTime();

            const taskTickerInterval = setInterval(() => {
                const localNowTime = new Date().getTime();
                const deltaGapDistance = destinationTime - localNowTime;

                if (deltaGapDistance < 0) {
                    clearInterval(taskTickerInterval);
                    document.getElementById("countdown-anchor").innerHTML =
                        `<h3 style='font-family: var(--font-accent); font-style: italic; font-size: 2.5rem; color: var(--primary-gold); width: 100%; text-align: center;'>Leo ni Siku ya Furaha ❤️</h3>`;
                    return;
                }

                const d = Math.floor(deltaGapDistance / (1000 * 60 * 60 * 24));
                const h = Math.floor((deltaGapDistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((deltaGapDistance % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((deltaGapDistance % (1000 * 60)) / 1000);

                document.getElementById("timer-days").innerText = String(d).padStart(2, '0');
                document.getElementById("timer-hours").innerText = String(h).padStart(2, '0');
                document.getElementById("timer-minutes").innerText = String(m).padStart(2, '0');
                document.getElementById("timer-seconds").innerText = String(s).padStart(2, '0');
            }, 1000);
        }

        // --- LIGHTBOX INTERACTIVE FRAMEWORK PLUGINS ---
        const masonryFramePhotos = document.querySelectorAll(".gallery-photo-frame");
        const systemLightboxOverlay = document.getElementById("lightbox-overlay-engine");
        const lightboxImgFrame = systemLightboxOverlay.querySelector("img");

        masonryFramePhotos.forEach(photo => {
            photo.addEventListener("click", () => {
                lightboxImgFrame.src = photo.querySelector("img").src;
                systemLightboxOverlay.style.display = "flex";
                setTimeout(() => systemLightboxOverlay.classList.add("active"), 50);
            });
        });

        systemLightboxOverlay.querySelector(".lightbox-close-trigger").addEventListener("click", () => {
            systemLightboxOverlay.classList.remove("active");
            setTimeout(() => systemLightboxOverlay.style.display = "none", 400);
        });

        // --- COPY TRANSACTIONS HELPER MATRIX ---
        function setupEventInteractions() {
            document.querySelectorAll(".copy-address-btn").forEach(btn => {
                btn.addEventListener("click", () => {
                    navigator.clipboard.writeText(btn.getAttribute("data-address"));
                    btn.style.background = "var(--sage-green)";
                    setTimeout(() => btn.style.background = "transparent", 1500);
                });
            });

            document.querySelectorAll(".copy-registry-btn").forEach(btn => {
                btn.addEventListener("click", () => {
                    navigator.clipboard.writeText(btn.getAttribute("data-copyval"));
                    btn.style.background = "var(--sage-green)";
                    setTimeout(() => btn.style.background = "transparent", 1500);
                });
            });
        }

        // --- FORM TRANSACTION MANAGEMENT PIPELINE (RSVP TO SHEETS & WHATSAPP) ---
        // let payloadBackupObject = null;

        // function processRSVPSubmitPipeline(event) {
        //     event.preventDefault();
        //     const btnSubmit = document.getElementById("rsvp-submit-btn-copy");
        //     btnSubmit.innerText = activeSystemLanguage === "en" ? "TRANSMITTING..." : "INATUMA...";
        //     btnSubmit.disabled = true;

        //     // Compile Form Values
        //     payloadBackupObject = {
        //         guestName: document.getElementById("input-field-name").value,
        //         attendance: document.getElementById("select-field-status").value,
        //         adults: document.getElementById("select-field-adults").value,
        //         children: document.getElementById("select-field-children").value,
        //         meal: document.getElementById("select-field-meal").value,
        //         phone: document.getElementById("input-field-phone").value,
        //         email: document.getElementById("input-field-email").value,
        //         message: document.getElementById("textarea-field-message").value,
        //         uuidString: "INV-" + Math.floor(100000 + Math.random() * 900000)
        //     };

        //     // Direct Formless POST Pipeline to Google Apps Script Web App Endpoint URL Template
        //     const targetGoogleScriptWebAppUrl = "https://script.google.com/macros/s/AKfycby-YOUR-APPSCRIPT-ID-HERE/exec";

        //     fetch(targetGoogleScriptWebAppUrl, {
        //         method: "POST",
        //         mode: "no-cors",
        //         headers: {
        //             "Content-Type": "application/json"
        //         },
        //         body: JSON.stringify(payloadBackupObject)
        //     }).then(() => {
        //         finalizeSuccessfulRSVPUiState();
        //     }).catch(err => {
        //         console.error("Sheets runtime logging down. Activating offline execution state protocol safely.",
        //             err);
        //         finalizeSuccessfulRSVPUiState();
        //     });
        // }

        // function finalizeSuccessfulRSVPUiState() {
        //     const successOverlay = document.getElementById("rsvp-success-curtain-layer");
        //     successOverlay.style.display = "flex";

        //     // Generate QR Target Token Value
        //     const qrcodeZone = document.getElementById("generated-qrcode-target");
        //     qrcodeZone.innerHTML = "";
        //     new QRCode(qrcodeZone, {
        //         text: `ID:${payloadBackupObject.uuidString}|NAME:${payloadBackupObject.guestName}|STATUS:${payloadBackupObject.attendance}`,
        //         width: 130,
        //         height: 130,
        //         colorDark: "#2C2A29",
        //         colorLight: "#ffffff"
        //     });

        //     // Fire Luxury Confetti Streamers
        //     fireLuxuryConfettiExplosion(document.getElementById("rsvp-interface-container-node"));

        //     // Initialize Dynamic API Target Handles
        //     document.getElementById("whatsapp-share-trigger-btn").onclick = () => {
        //         const waTextFormatted = encodeURIComponent(
        //             `Habari!\nNime thibitisha mahudhurio yangu.\n\n*Jina:* ${payloadBackupObject.guestName}\n*Hali:* ${payloadBackupObject.attendance === 'Accepted' ? 'Nafika kwa Furaha' : 'Sitoweza kufika'}\n*Viti (Watu Wazima/Watoto):* ${payloadBackupObject.adults}/${payloadBackupObject.children}\n*Kadi ID:* ${payloadBackupObject.uuidString}\n\nTukutane siku ya sherehe!`
        //             );
        //         window.open(`https://api.whatsapp.com/send?phone=255684848851&text=${waTextFormatted}`, "_blank");
        //     };

        //     document.getElementById("calendar-reminder-btn").onclick = () => {
        //         window.open(
        //             "https://calendar.google.com/calendar/render?action=TEMPLATE&text={{$event->groom_name}}+%26+{{$event->bride_name}}+Wedding+Celebration&dates=20260905T100000Z/20260905T220000Z&details=Join+us+in+celebration+of+forever+alignment.&location=St.+Joseph&#39;s+Cathedral,+Dar+es+Salaam",
        //             "_blank");
        //     };
        // }

        // --- FORM TRANSACTION MANAGEMENT PIPELINE (RSVP TO LARAVEL BACKEND) ---
        let payloadBackupObject = null;

        function processRSVPSubmitPipeline(event) {


            event.preventDefault();
            const btnSubmit = document.getElementById("rsvp-submit-btn-copy");
            // const selectStatus = document.getElementById("select-field-status").value;
            const selectStatus = document.querySelector('input[name="attendance_status"]:checked').value;
            btnSubmit.innerText = activeSystemLanguage === "en" ? "TRANSMITTING..." : "INATUMA...";
            btnSubmit.disabled = true;

            // Compile Form Values
            payloadBackupObject = {
                guest_name: document.getElementById("input-field-name").value,
                guest_app: document.getElementById("input-field-app").value,
                guest_token: document.getElementById("input-field-token").value,
                attendance: selectStatus,
                adults: document.getElementById("select-field-adults").value,
                children: document.getElementById("select-field-children").value,
                meal: document.getElementById("select-field-meal").value,
                phone: document.getElementById("input-field-phone").value,
                email: document.getElementById("input-field-email").value,
                message: document.getElementById("textarea-field-message").value,
                uuidString: "INV-" + Math.floor(100000 + Math.random() * 900000)
            };

            // If the guest is declining, skip image generation and process directly
            // if (selectStatus !== "Accepted") {
            //     finalizeSuccessfulRSVPUiState(null);
            //     return;
            // }

            //  console.log(payloadBackupObject);
            //  return;




            // Replace with your true Laravel Endpoint URL Route (e.g., '/api/rsvp/confirm')
            const targetLaravelBackendUrl = "/generate";

            fetch(targetLaravelBackendUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": '{{ csrf_token() }}' // Safely embedded Laravel CSRF token security layout
                    },
                    body: JSON.stringify(payloadBackupObject)
                })
                .then(response => {
                    if (!response.ok) throw new Error("Backend image validation failure.");
                    return response.json();
                })
                .then(data => {
                    // console.log(data.generated['guest_name']);

                    // Expecting data structure payload: { success: true, base64_image: "data:image/png;base64,iVBORw..." }

                    finalizeSuccessfulRSVPUiState(
                        selectStatus === "Accepted" ? data.generated[0]['image_url'] : null,
                        selectStatus
                    );
                })
                .catch(err => {
                    console.error("Laravel processing error. Falling back safely.", err);
                    // Fallback display frame if backend crashes
                    finalizeSuccessfulRSVPUiState(null, selectStatus);
                });
        }

//         function finalizeSuccessfulRSVPUiState(base64ImageString, status) {
//             const successOverlay = document.getElementById("rsvp-success-curtain-layer");
//             successOverlay.style.display = "flex";

//             const isDeclined = status === "Declined";
//             const acceptedBlock = document.getElementById("rsvp-status-accepted-block");
//             const declinedBlock = document.getElementById("rsvp-status-declined-block");

//             acceptedBlock.style.display = isDeclined ? "none" : "block";
//             declinedBlock.style.display = isDeclined ? "block" : "none";

//             if (isDeclined) {
//                 // Words of appreciation only — no ticket/QR for a decline
//                 feather.replace();
//                 return;
//             }

//             // Generate QR Target Token Value inside web DOM element
//             const qrcodeZone = document.getElementById("generated-qrcode-target");
//             qrcodeZone.innerHTML = "";

//             if (base64ImageString) {
//     // Render the image, download button, and change response button together
//     qrcodeZone.style.background = "transparent";
//     qrcodeZone.style.border = "none";
//     qrcodeZone.innerHTML = `
//         <img src="${base64ImageString}" alt="Wedding Invitation Ticket" style="max-width: 100%; max-height: 220px; border-radius: 6px; box-shadow: var(--shadow-premium); border: 1px solid var(--primary-gold); object-fit: contain;">

//         <div style="margin-top: 20px; display: flex; gap: 12px; justify-content: center; align-items: center; flex-wrap: wrap;">
//             <a href="${base64ImageString}" download="Abel_Anlin_Wedding_Ticket.png" class="gold-button" style="text-decoration:none; display:inline-flex;">
//                 <i data-feather="download" style="width:14px; margin-right:5px;"></i>
//                 <span data-en="Download Invitation Ticket" data-sw="Pakua Kadi Yako">Download Invitation Ticket</span>
//             </a>

//             <button type="button" class="gold-button" id="change-response-btn">
//                 <i data-feather="edit-2" style="width:14px; margin-right:5px;"></i>
//                 <span data-en="Change Response" data-sw="Badilisha Jibu">Change Response</span>
//             </button>
//         </div>
//     `;

//     // Re-bind click listener for the dynamically rendered Change Response button
//     document.getElementById("change-response-btn").addEventListener("click", () => {
//         document.getElementById("rsvp-success-curtain-layer").style.display = "none";
//         const btnSubmit = document.getElementById("rsvp-submit-btn-copy");
//         if (btnSubmit) {
//             btnSubmit.disabled = false;
//             btnSubmit.innerText = activeSystemLanguage === "en" ? "Lock Response Registry" : "Thibitisha Nafasi Yako";
//         }
//     });
// } else {
//                 // Dynamic Fallback structure: standard default QRCode block build pattern
//                 // new QRCode(qrcodeZone, {
//                 //     text: `ID:${payloadBackupObject.uuidString}|NAME:${payloadBackupObject.guestName}|STATUS:${payloadBackupObject.attendance}`,
//                 //     width: 130,
//                 //     height: 130,
//                 //     colorDark: "#2C2A29",
//                 //     colorLight: "#ffffff"
//                 // });
//             }

//             // Fire Luxury Confetti Streamers
//             fireLuxuryConfettiExplosion(document.getElementById("rsvp-interface-container-node"));
//             feather.replace();

//             // Initialize Dynamic API Target Handles
//             document.getElementById("whatsapp-share-trigger-btn").onclick = () => {
//                 const waTextFormatted = encodeURIComponent(
//                     `Habari!\nNime thibitisha mahudhurio yangu.\n\n*Jina:* ${payloadBackupObject.guestName}\n*Hali:* ${payloadBackupObject.attendance === 'Accepted' ? 'Nafika kwa Furaha' : 'Sitoweza kufika'}\n*Viti (Watu Wazima/Watoto):* ${payloadBackupObject.adults}/${payloadBackupObject.children}\n*Kadi ID:* ${payloadBackupObject.uuidString}\n\nTukutane siku ya sherehe!`
//                 );
//                 window.open(`https://api.whatsapp.com/send?phone=255684848851&text=${waTextFormatted}`, "_blank");
//             };

//             document.getElementById("calendar-reminder-btn").onclick = () => {
//                 window.open(
//                     "https://calendar.google.com/calendar/render?action=TEMPLATE&text={{$event->groom_name}}+%26+{{$event->bride_name}}+Wedding+Celebration&dates=20260905T100000Z/20260905T220000Z&details=Join+us+in+celebration+of+forever+alignment.&location=St.+Joseph&#39;s+Cathedral,+Dar+es+Salaam",
//                     "_blank");
//             };
//         }


function finalizeSuccessfulRSVPUiState(base64ImageString, status) {
    console.log(base64ImageString,status);
    
    const successOverlay = document.getElementById("rsvp-success-curtain-layer");
    successOverlay.style.display = "flex";

    const isDeclined = status === "Declined";
    const acceptedBlock = document.getElementById("rsvp-status-accepted-block");
    const declinedBlock = document.getElementById("rsvp-status-declined-block");

    acceptedBlock.style.display = isDeclined ? "none" : "block";
    declinedBlock.style.display = isDeclined ? "block" : "none";

    // --- IF DECLINED ---
    if (isDeclined) {
        declinedBlock.innerHTML = `
            <h3 data-en="Response Received" data-sw="Jibu Limepokelewa">Response Received</h3>
            <p data-en="We're sorry you won't be able to join us, but we sincerely appreciate you taking the time to let us know. Thank you, and we hope to celebrate with you another time."
               data-sw="Tunasikitika hutaweza kuja, lakini tunashukuru sana kwa kutujulisha. Asante, na tunatumaini kukutana nawe wakati mwingine.">
               We're sorry you won't be able to join us, but we sincerely appreciate you taking the time to let us know. Thank you, and we hope to celebrate with you another time.
            </p>
            <div style="margin-top: 25px;">
                <button type="button" class="gold-button" id="change-response-btn">
                    <i data-feather="edit-2" style="width:14px; margin-right:5px;"></i>
                    <span data-en="Change Response" data-sw="Badilisha Jibu">Change Response</span>
                </button>
            </div>
        `;
        feather.replace();
        return;
    }

    // --- IF ACCEPTED ---
    const qrcodeZone = document.getElementById("generated-qrcode-target");
    qrcodeZone.innerHTML = "";

    if (base64ImageString) {
        qrcodeZone.style.background = "transparent";
        qrcodeZone.style.border = "none";
        qrcodeZone.innerHTML = `
            <img src="${base64ImageString}" alt="Wedding Invitation Ticket" style="max-width: 100%; max-height: 220px; border-radius: 6px; box-shadow: var(--shadow-premium); border: 1px solid var(--primary-gold); object-fit: contain;">

            <div style="margin-top: 20px; display: flex; gap: 12px; justify-content: center; align-items: center; flex-wrap: wrap;">
                <a href="${base64ImageString}" download="Abel_Anlin_Wedding_Ticket.png" class="gold-button" style="text-decoration:none; display:inline-flex;">
                    <i data-feather="download" style="width:14px; margin-right:5px;"></i>
                    <span data-en="Download Invitation Ticket" data-sw="Pakua Kadi Yako">Download Invitation Ticket</span>
                </a>

                <button type="button" class="gold-button" id="change-response-btn">
                    <i data-feather="edit-2" style="width:14px; margin-right:5px;"></i>
                    <span data-en="Change Response" data-sw="Badilisha Jibu">Change Response</span>
                </button>
            </div>
        `;
    }

    fireLuxuryConfettiExplosion(document.getElementById("rsvp-interface-container-node"));
    feather.replace();

    // Attach API Target Handles (WhatsApp, Calendar)
    document.getElementById("whatsapp-share-trigger-btn").onclick = () => {
        const waTextFormatted = encodeURIComponent(
            `Habari!\nNime thibitisha mahudhurio yangu.\n\n*Jina:* ${payloadBackupObject.guestName}\n*Hali:* ${payloadBackupObject.attendance === 'Accepted' ? 'Nafika kwa Furaha' : 'Sitoweza kufika'}\n*Viti (Watu Wazima/Watoto):* ${payloadBackupObject.adults}/${payloadBackupObject.children}\n*Kadi ID:* ${payloadBackupObject.uuidString}\n\nTukutane siku ya sherehe!`
        );
        window.open(`https://api.whatsapp.com/send?phone=255684848851&text=${waTextFormatted}`, "_blank");
    };

    document.getElementById("calendar-reminder-btn").onclick = () => {
        window.open(
            "https://calendar.google.com/calendar/render?action=TEMPLATE&text={{$event->groom_name}}+%26+{{$event->bride_name}}+Wedding+Celebration&dates=20260905T100000Z/20260905T220000Z&details=Join+us+in+celebration+of+forever+alignment.&location=St.+Joseph&#39;s+Cathedral,+Dar+es+Salaam",
            "_blank");
    };
}



        function fireLuxuryConfettiExplosion(parentWrapper) {
            const customHexColors = ["#D4AF37", "#8A9A86", "#DCAEAC", "#AA8417", "#6B6661"];
            for (let k = 0; k < 75; k++) {
                const conf = document.createElement("div");
                conf.className = "confetti-piece";
                conf.style.left = Math.random() * 100 + "%";
                conf.style.top = "-15px";
                conf.style.backgroundColor = customHexColors[Math.floor(Math.random() * customHexColors.length)];
                conf.style.transform = `rotate(${Math.random() * 360}deg)`;
                conf.style.animationDelay = (Math.random() * 0.4) + "s";
                conf.style.animationDuration = (Math.random() * 1.5 + 2) + "s";
                parentWrapper.appendChild(conf);

                setTimeout(() => conf.remove(), 3500);
            }
        }


        // Extract the unique token from the URL path (e.g. /aa/VM0at2rdbJ -> VM0at2rdbJ)
function getGuestTokenFromUrl() {
    const pathSegments = window.location.pathname.split('/').filter(Boolean);
    return pathSegments[pathSegments.length - 1]; // Gets 'VM0at2rdbJ'
}

// Fetch existing guest response on page initialization
async function loadExistingGuestResponse() {
    const token = getGuestTokenFromUrl();
    if (!token) return;

    try {
        const response = await fetch(`/api/response/${token}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        if (!response.ok) return;

        const resData = await response.json();

        // If the backend returns saved response data
        if (resData && resData.data) {
            populateFormFields(resData.data);

            console.log(resData.data);

            // If the guest has already responded, show their ticket/status screen immediately
            if (resData.data.has_responded) {
                finalizeSuccessfulRSVPUiState(
                    resData.data.ticket_base64 || null,
                    resData.data.attendance || "Accepted"
                );
            }
        }
    } catch (error) {
        console.error("Error fetching guest RSVP data:", error);
    }
}

function populateFormFields(data) {
    if (!data) return;

    // 1. Fill Text & Number Inputs
    if (data.guest_name) {
        const nameInput = document.getElementById("guest-name-input");
        if (nameInput) nameInput.value = data.guest_name;
    }

    if (data.adults !== undefined) {
        const adultsInput = document.getElementById("adults-count");
        if (adultsInput) adultsInput.value = data.adults;
    }

    if (data.children !== undefined) {
        const childrenInput = document.getElementById("children-count");
        if (childrenInput) childrenInput.value = data.children;
    }

    if (data.dietary) {
        const dietaryInput = document.getElementById("dietary-input");
        if (dietaryInput) dietaryInput.value = data.dietary;
    }

    if (data.notes) {
        const notesInput = document.getElementById("notes-input");
        if (notesInput) notesInput.value = data.notes;
    }

    // 2. Select Attendance Radio Button
    if (data.attendance) {
        const radioBtn = document.querySelector(`input[name="attendance"][value="${data.attendance}"]`);
        if (radioBtn) {
            radioBtn.checked = true;
            radioBtn.dispatchEvent(new Event("change")); // Trigger UI updates (e.g. toggling count fields)
        }
    }
}
    </script>
</body>

</html>