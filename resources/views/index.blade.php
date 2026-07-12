<!DOCTYPE html>
<html lang="sw" data-lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abel & Anlin — The Wedding Celebration</title>
    
    <!-- Open Graph / Meta Optimization -->
    <meta name="description" content="Ungana nasi katika kusherehekea muungano wa Abel & Anlin. Angalia ratiba, mtindo wa mavazi, eneo, na thibitisha mahudhurio mtandaoni.">
    <meta property="og:title" content="Abel & Anlin Wedding Invitation">
    <meta property="og:description" content="Celebrate our forever with us. Exclusive interactive digital invitation.">
    <meta property="og:image" content="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=80">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Playfair+Display:ital,wght@1,400;1,500&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Custom QR Generator & Feather Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>

    <style>
        /* --- DESIGN SYSTEM & CSS VARIABLE TOKENS --- */
        :root {
            --bg-ivory: #FDFBF7;
            --bg-dark-mode: #121210;
            --primary-gold: #D4AF37;
            --dark-gold: #AA8417;
            --light-gold: #F3E5AB;
            --soft-beige: #F4EFE6;
            --sage-green: #8A9A86;
            --dusty-rose: #DCAEAC;
            
            /* Light Mode Default Layouts */
            --text-main: #2C2A29;
            --text-muted: #6B6661;
            --surface-glass: rgba(253, 251, 247, 0.75);
            --border-glass: rgba(212, 175, 55, 0.25);
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
            --border-glass: rgba(212, 175, 55, 0.35);
            --shadow-premium: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        /* --- BASE RESET & STRUCTURE --- */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; font-size: 16px; }
        body {
            background-color: var(--bg-ivory);
            color: var(--text-main);
            font-family: var(--font-body);
            font-size: 1.35rem;
            line-height: 1.65;
            overflow-x: hidden;
            transition: background-color 0.5s ease, color 0.5s ease;
        }
        
        h1, h2, h3, h4 { font-family: var(--font-display); font-weight: 400; letter-spacing: 3px; }
        p { font-weight: 400; }
        a { text-decoration: none; color: inherit; transition: var(--transition-fast); }

        /* SCROLL BAR OPTIMIZATION */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-ivory); }
        ::-webkit-scrollbar-thumb { background: var(--primary-gold); border-radius: 10px; }

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
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.6s; z-index: -1;
        }
        .gold-button:hover::before { left: 100%; }
        .gold-button:hover {
            color: #fff !important;
            background: var(--primary-gold);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
            transform: translateY(-2px);
        }

        /* --- SCROLL ANIMATIONS ENGINE --- */
        .reveal { opacity: 0; transform: translateY(50px); filter: blur(5px); transition: var(--transition-smooth); }
        .reveal.active { opacity: 1; transform: translateY(0); filter: blur(0); }

        /* --- IMMERSIVE PARTICLES SYSTEM --- */
        .ambient-universe { position: fixed; width: 100vw; height: 100vh; pointer-events: none; z-index: 1; top: 0; left: 0; }
        .petal {
            position: absolute; display: block; background: linear-gradient(var(--dusty-rose), #fff); opacity: 0.25;
            border-radius: 150% 0 150% 150%; animation: floatPetal 18s infinite linear;
        }
        .gold-dust {
            position: absolute; width: 3px; height: 3px; background: var(--primary-gold);
            border-radius: 50%; opacity: 0.5; animation: floatDust 14s infinite linear;
        }
        @keyframes floatPetal {
            0% { transform: translateY(-10vh) translateX(0) rotate(0deg); opacity: 0; }
            10% { opacity: 0.5; }
            90% { opacity: 0.5; }
            100% { transform: translateY(105vh) translateX(120px) rotate(450deg); opacity: 0; }
        }
        @keyframes floatDust {
            0% { transform: translateY(105vh) translateX(0) scale(0.6); opacity: 0; }
            50% { opacity: 0.7; }
            100% { transform: translateY(-10vh) translateX(80px) scale(1.3); opacity: 0; }
        }

        /* --- APPLE CINEMATIC INTRO MODULE --- */
        #luxury-loader {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: var(--bg-ivory); z-index: 9999; display: flex;
            flex-direction: column; justify-content: center; align-items: center;
            transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .monogram-loader {
            font-family: var(--font-display); font-size: 3.5rem; color: var(--primary-gold);
            letter-spacing: 6px; position: relative; animation: initialPulse 3s ease forwards;
        }
        .skeleton-bar {
            width: 140px; height: 1px; background: var(--border-glass); margin-top: 25px;
            position: relative; overflow: hidden;
        }
        .skeleton-progress {
            position: absolute; left: 0; top: 0; height: 100%; width: 0;
            background: var(--primary-gold); animation: fillProgress 2.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes fillProgress { 0% { width: 0; } 100% { width: 100%; } }
        @keyframes initialPulse { 0% { opacity: 0; filter: blur(5px); } 50% { opacity: 1; filter: blur(0); } 100% { opacity: 0.8; } }

        /* --- 3D INTERACTIVE ENVELOPE THEATRE --- */
        #envelope-wrapper {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, var(--soft-beige), var(--bg-ivory));
            z-index: 999; display: none; justify-content: center; align-items: center;
            perspective: 1400px; opacity: 1; transition: opacity 0.8s ease;
        }
        .envelope-3d {
            position: relative; width: 520px; height: 360px; background: #eadecd;
            box-shadow: 0 30px 70px rgba(0,0,0,0.12); transform-style: preserve-3d;
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1); cursor: pointer;
            border-radius: 4px;
        }
        .envelope-flap {
            position: absolute; top: 0; left: 0; width: 0; height: 0;
            border-left: 260px solid transparent; border-right: 260px solid transparent;
            border-top: 190px solid #d4c3ad; transform-origin: top;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s; z-index: 3;
        }
        .wax-seal-wrapper {
            position: absolute; top: 165px; left: 230px; width: 60px; height: 60px;
            background: radial-gradient(#b02525, #8a1717); border-radius: 50%; z-index: 4;
            box-shadow: 0 6px 15px rgba(0,0,0,0.3), inset 0 2px 4px rgba(255,255,255,0.2);
            display: flex; justify-content: center; align-items: center; color: #f2c7c7;
            font-family: var(--font-display); font-size: 0.9rem; font-weight: bold;
            letter-spacing: 1px; transition: var(--transition-smooth);
        }
        .envelope-3d:hover .wax-seal-wrapper { transform: scale(1.05) rotate(10deg); }
        .envelope-3d.open .envelope-flap { transform: rotateX(180deg); z-index: 1; }
        .envelope-3d.open .wax-seal-wrapper { transform: scale(0) rotate(-45deg); opacity: 0; }
        
        .invitation-inner-card {
            position: absolute; top: 15px; left: 20px; width: 480px; height: 330px;
            background: var(--bg-ivory); border: 1px solid var(--primary-gold);
            padding: 40px 20px; text-align: center; z-index: 2;
            box-shadow: inset 0 0 40px rgba(212,175,55,0.05);
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.8s;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
        }
        .envelope-3d.open .invitation-inner-card { transform: translateY(-220px) translateZ(50px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }

        /* --- WIDGET ARCHITECTURE (UTILITY SYSTEM) --- */
        #scroll-progress-indicator {
            position: fixed; top: 0; left: 0; height: 3px; background: linear-gradient(90deg, var(--dusty-rose), var(--primary-gold));
            width: 0%; z-index: 1000; transition: width 0.1s ease-out;
        }
        .system-utilities-tray {
            position: fixed; top: 30px; right: 30px; z-index: 950; display: flex; gap: 12px;
        }
        .utility-btn {
            width: 45px; height: 45px; border-radius: 50%; display: flex; justify-content: center; align-items: center;
            cursor: pointer; transition: var(--transition-fast); box-shadow: var(--shadow-premium);
            color: var(--text-main); border: 1px solid var(--border-glass); background: var(--surface-glass);
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
        }
        .utility-btn:hover { transform: scale(1.1); color: var(--primary-gold); border-color: var(--primary-gold); }
        .rotating { animation: spinContinuous 6s linear infinite; }
        @keyframes spinContinuous { 100% { transform: rotate(360deg); } }

        /* --- FLOATING NAVIGATION CONTROLLER --- */
        #dock-navigation {
            position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(120px);
            z-index: 900; padding: 8px 24px; display: flex; gap: 15px; border-radius: 30px;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        #dock-navigation.visible { transform: translateX(-50%) translateY(0); }
        .dock-link {
            font-family: var(--font-display); font-size: 0.72rem; font-weight: 500; text-transform: uppercase;
            letter-spacing: 1.5px; padding: 8px 16px; border-radius: 20px; transition: var(--transition-fast); opacity: 0.65;
        }
        .dock-link:hover, .dock-link.active { opacity: 1; background: rgba(212,175,55,0.12); color: var(--primary-gold); }

        /* --- CINEMATIC HERO DESIGN --- */
        #hero-viewport {
            height: 100vh; position: relative; display: flex; justify-content: center;
            align-items: center; text-align: center; overflow: hidden;
        }
        .hero-parallax-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(rgba(18,18,16,0.35), rgba(18,18,16,0.5)), 
                        url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            transform: scale(1.08); transition: transform 0.1s ease-out; z-index: -1;
        }
        .hero-content-house { color: #fff; text-shadow: 0 2px 15px rgba(0,0,0,0.25); z-index: 2; padding: 0 20px; }
        .hero-content-house h3 { font-size: 0.95rem; text-transform: uppercase; letter-spacing: 5px; margin-bottom: 25px; color: var(--light-gold); }
        .hero-content-house h1 { font-family: var(--font-accent); font-style: italic; font-weight: 400; font-size: 5.5rem; margin: 15px 0; letter-spacing: 1px; }
        .hero-content-house .ampersand-divider { font-family: var(--font-body); font-style: italic; font-size: 2.2rem; display: block; color: var(--primary-gold); margin: -10px 0; }
        .hero-content-house .date-string { font-family: var(--font-display); font-size: 1.35rem; letter-spacing: 4px; margin: 25px 0; }
        .hero-content-house .poetic-quote { font-size: 1.2rem; font-style: italic; opacity: 0.9; max-width: 500px; margin: 0 auto; font-family: var(--font-body); }

        /* --- SECTIONS CENTRAL DESIGN --- */
        section { padding: 140px 24px; max-width: 1200px; margin: 0 auto; position: relative; z-index: 2; }
        .section-header-block { text-align: center; margin-bottom: 75px; }
        .section-header-block h2 { font-size: 2.4rem; color: var(--text-main); display: inline-block; position: relative; padding-bottom: 20px; }
        .section-header-block h2::after { content: ''; position: absolute; bottom: 0; left: 35%; width: 30%; height: 1px; background: var(--primary-gold); }
        .section-header-block p { font-family: var(--font-accent); font-style: italic; font-size: 1.25rem; color: var(--sage-green); margin-top: 10px; }

        /* --- GUEST PERSONALIZATION MODULE --- */
        #personalized-guest-center { text-align: center; margin-bottom: -40px; }
        .guest-welcome-card { max-width: 750px; margin: 0 auto; padding: 40px; text-align: center; border-radius: 4px; }
        .guest-title-salutation { font-family: var(--font-accent); font-style: italic; font-size: 2rem; color: var(--primary-gold); margin-bottom: 10px; }

        /* --- LOVE STORY TIMELINE ENGINE --- */
        .story-timeline-backbone { position: relative; max-width: 900px; margin: 0 auto; padding: 40px 0; }
        .story-timeline-backbone::before { content: ''; position: absolute; left: 50%; top: 0; bottom: 0; width: 1px; background: linear-gradient(to bottom, transparent, var(--primary-gold) 15%, var(--primary-gold) 85%, transparent); transform: translateX(-50%); }
        .story-event-card-wrapper { width: 50%; margin-bottom: 80px; position: relative; padding: 0 50px; }
        .story-event-card-wrapper:nth-child(odd) { float: left; text-align: right; clear: both; }
        .story-event-card-wrapper:nth-child(even) { float: right; text-align: left; clear: both; }
        .story-event-card-wrapper::after {
            content: ''; position: absolute; top: 25px; width: 14px; height: 14px;
            background: var(--bg-ivory); border: 2px solid var(--primary-gold); border-radius: 50%; z-index: 5; transition: 0.3s;
        }
        .story-event-card-wrapper:hover::after { background: var(--primary-gold); scale: 1.3; }
        .story-event-card-wrapper:nth-child(odd)::after { right: -7px; }
        .story-event-card-wrapper:nth-child(even)::after { left: -7px; }
        
        .story-inner-card { padding: 35px; border-radius: 8px; }
        .story-inner-card img { width: 100%; height: 220px; object-fit: cover; border-radius: 4px; margin-bottom: 20px; box-shadow: var(--shadow-premium); }
        .story-inner-card .meta-date { font-family: var(--font-display); font-size: 0.85rem; color: var(--primary-gold); font-weight: 600; margin-bottom: 8px; display: block; }
        .story-inner-card h3 { font-size: 1.45rem; margin-bottom: 12px; }
        .story-inner-card p { font-size: 1.15rem; color: var(--text-muted); }
        .story-timeline-backbone::after { content: ''; display: table; clear: both; }

        /* --- PINTEREST STYLE GALLERY SYSTEM --- */
        .gallery-masonry-grid {
            columns: 3 320px; column-gap: 25px; width: 100%;
        }
        .gallery-photo-frame {
            break-inside: avoid; display: inline-block; width: 100%; margin-bottom: 25px;
            position: relative; overflow: hidden; cursor: pointer; border-radius: 8px;
        }
        .gallery-photo-frame img { width: 100%; height: auto; object-fit: cover; transition: var(--transition-smooth); display: block; }
        .gallery-photo-frame:hover img { transform: scale(1.04); filter: brightness(0.9); }
        .gallery-card-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to top, rgba(18,18,16,0.5), transparent 60%);
            opacity: 0; transition: var(--transition-fast); display: flex; align-items: flex-end; padding: 25px;
        }
        .gallery-photo-frame:hover .gallery-card-overlay { opacity: 1; }
        .gallery-card-overlay span { color: #fff; font-family: var(--font-display); font-size: 0.8rem; letter-spacing: 1.5px; text-transform: uppercase; }

        /* Lightbox Layout Context */
        #lightbox-overlay-engine {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(18,18,16,0.95);
            z-index: 2000; display: none; justify-content: center; align-items: center; opacity: 0; transition: opacity 0.4s ease;
        }
        #lightbox-overlay-engine.active { opacity: 1; }
        #lightbox-overlay-engine img { max-width: 90%; max-height: 85%; object-fit: contain; border: 1px solid var(--primary-gold); box-shadow: 0 0 50px rgba(0,0,0,0.5); }
        .lightbox-close-trigger { position: absolute; top: 35px; right: 35px; color: #fff; cursor: pointer; background: transparent; border: 0; }

        /* --- LUXURY COUNTDOWN DESIGN SYSTEM --- */
        #countdown-anchor { background: var(--soft-beige); width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; }
        .countdown-flex-container { display: flex; justify-content: center; gap: 40px; flex-wrap: wrap; margin-top: 50px; }
        .countdown-metric-card {
            width: 130px; height: 130px; border-radius: 50%; display: flex; flex-direction: column;
            justify-content: center; align-items: center; position: relative;
        }
        .countdown-metric-card data { font-family: var(--font-display); font-size: 2.6rem; color: var(--text-main); font-weight: 500; line-height: 1; }
        .countdown-metric-card label { font-family: var(--font-sans); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; margin-top: 8px; color: var(--text-muted); }

        /* --- THE WEDDING SCHEDULE PLATFORM --- */
        .schedule-linear-track { max-width: 750px; margin: 0 auto; position: relative; }
        .schedule-timeline-unit { display: flex; margin-bottom: 50px; position: relative; }
        .schedule-time-meta { width: 140px; font-family: var(--font-display); font-size: 1.15rem; color: var(--primary-gold); font-weight: 500; padding-top: 5px; }
        .schedule-event-details-box { flex: 1; padding-left: 40px; border-left: 2px solid var(--border-glass); padding-bottom: 20px; }
        .schedule-event-details-box h3 { font-size: 1.4rem; margin-bottom: 8px; font-family: var(--font-display); }
        .schedule-event-details-box p { font-size: 1.2rem; color: var(--text-muted); }

        /* --- VENUES PRESENTATION SCHEME --- */
        .venue-dual-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 45px; }
        .venue-editorial-card { padding: 45px; text-align: center; display: flex; flex-direction: column; justify-content: space-between; }
        .venue-editorial-card h3 { font-size: 1.75rem; margin-bottom: 15px; color: var(--primary-gold); }
        .venue-editorial-card p { font-size: 1.2rem; color: var(--text-muted); margin-bottom: 25px; }
        .interactive-iframe-holder { width: 100%; height: 280px; border-radius: 6px; overflow: hidden; border: 1px solid var(--border-glass); margin-bottom: 30px; }
        .interactive-iframe-holder iframe { width: 100%; height: 100%; border: 0; filter: grayscale(0.2) contrast(0.9); }
        .venue-button-group { display: flex; justify-content: center; gap: 15px; }

        /* --- DRESS CODE MANUAL --- */
        #dress-code-center { background: var(--soft-beige); width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; }
        .dress-editorial-container { display: flex; justify-content: center; gap: 50px; flex-wrap: wrap; margin-top: 50px; }
        .dress-profile-card { padding: 40px; width: 360px; text-align: center; }
        .dress-profile-card h3 { font-size: 1.5rem; margin-bottom: 25px; position: relative; letter-spacing: 2px; }
        .dress-profile-card p { font-size: 1.2rem; color: var(--text-muted); margin-bottom: 25px; }
        .color-palette-row { display: flex; justify-content: center; gap: 20px; }
        .color-swatch-circle { width: 45px; height: 45px; border-radius: 50%; border: 1px solid rgba(0,0,0,0.08); box-shadow: var(--shadow-premium); position: relative; cursor: pointer; }
        .color-swatch-circle::after {
            content: attr(data-swatch-name); position: absolute; bottom: -30px; left: 50%; transform: translateX(-50%);
            font-family: var(--font-sans); font-size: 0.65rem; text-transform: uppercase; white-space: nowrap; opacity: 0; transition: var(--transition-fast);
        }
        .color-swatch-circle:hover::after { opacity: 0.8; }

        /* --- GIFT REGISTRY STATIONS --- */
        .registry-central-card { max-width: 850px; margin: 0 auto; padding: 50px; text-align: center; }
        .registry-flex-channels { display: flex; justify-content: center; gap: 30px; margin-top: 40px; flex-wrap: wrap; }
        .registry-channel-unit { padding: 30px; flex: 1; min-width: 240px; border: 1px dashed var(--primary-gold); border-radius: 4px; display: flex; flex-direction: column; align-items: center; justify-content: space-between; }
        .registry-channel-unit h4 { font-size: 1.15rem; color: var(--primary-gold); margin-bottom: 12px; }
        .registry-channel-unit code { font-family: var(--font-sans); font-size: 1rem; background: var(--soft-beige); padding: 4px 10px; border-radius: 4px; margin-bottom: 20px; display: inline-block; word-break: break-all; }

        /* --- DYNAMIC RSVP FORM ARCHITECTURE --- */
        #rsvp-portal {
            background: linear-gradient(var(--surface-glass), var(--surface-glass)), 
                        url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            background-attachment: fixed;
        }
        .rsvp-form-enclosure { max-width: 800px; margin: 0 auto; padding: 60px; position: relative; overflow: hidden; border-radius: 8px; }
        .rsvp-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 35px; }
        .rsvp-form-group { display: flex; flex-direction: column; text-align: left; }
        .rsvp-form-group.span-full { grid-column: span 2; }
        .rsvp-form-group label { font-family: var(--font-display); font-size: 0.8rem; text-transform: uppercase; margin-bottom: 10px; letter-spacing: 1px; color: var(--text-main); }
        .rsvp-form-group input, .rsvp-form-group select, .rsvp-form-group textarea {
            padding: 14px; background: rgba(255, 255, 255, 0.7); border: 1px solid var(--border-glass);
            font-family: var(--font-sans); font-size: 0.95rem; color: var(--text-main); outline: none; border-radius: 4px; transition: var(--transition-fast);
        }
        [data-theme="dark"] .rsvp-form-group input, [data-theme="dark"] .rsvp-form-group select, [data-theme="dark"] .rsvp-form-group textarea { background: rgba(20, 20, 18, 0.7); }
        .rsvp-form-group input:focus, .rsvp-form-group select:focus, .rsvp-form-group textarea:focus { border-color: var(--primary-gold); background: #fff; }
        [data-theme="dark"] .rsvp-form-group input:focus, [data-theme="dark"] .rsvp-form-group select:focus, [data-theme="dark"] .rsvp-form-group textarea:focus { background: #1a1a18; }
        
        /* Post Submission Output Engines */
        .rsvp-post-submit-curtain {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: var(--bg-ivory); display: none; flex-direction: column;
            justify-content: center; align-items: center; z-index: 10; text-align: center; padding: 40px;
        }
        .rsvp-post-submit-curtain h3 { font-family: var(--font-accent); font-style: italic; font-size: 3rem; color: var(--primary-gold); margin-bottom: 15px; }
        .qr-output-zone { margin: 30px 0; padding: 15px; background: #fff; border: 1px solid var(--primary-gold); display: inline-block; border-radius: 4px; }
        
        .confetti-piece { position: absolute; width: 8px; height: 8px; opacity: 0.85; animation: confettiFall 3.5s linear forwards; }
        @keyframes confettiFall {
            0% { transform: translateY(-50px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(800px) rotate(720deg); opacity: 0; }
        }

        /* --- PRESTIGE EDITORIAL FOOTER --- */
        footer { background: #121210; color: #FDFBF7; text-align: center; padding: 80px 24px; position: relative; z-index: 2; }
        footer h2 { font-family: var(--font-accent); font-style: italic; font-size: 3.2rem; color: var(--light-gold); margin-bottom: 15px; letter-spacing: 1px; }
        footer p { font-size: 0.85rem; letter-spacing: 3px; text-transform: uppercase; opacity: 0.5; font-family: var(--font-display); }

        /* --- FULL STACK RESPONSIVE ADAPTABILITY MATRIX --- */
        @media(max-width: 968px) {
            .venue-dual-grid { grid-template-columns: 1fr; }
            .story-timeline-backbone::before { left: 30px; }
            .story-event-card-wrapper { width: 100%; float: none !important; text-align: left !important; padding-left: 65px; padding-right: 0; }
            .story-event-card-wrapper::after { left: 23px !important; }
            .rsvp-form-grid { grid-template-columns: 1fr; }
            .rsvp-form-group.span-full { grid-column: span 1; }
        }
        @media(max-width: 600px) {
            html { font-size: 14px; }
            .hero-content-house h1 { font-size: 3.8rem; }
            .envelope-3d { width: 90vw; height: 62vw; }
            .envelope-flap { border-left-width: 45vw; border-right-width: 45vw; border-top-width: 32vw; }
            .wax-seal-wrapper { left: 40vw; top: 26vw; width: 50px; height: 50px; font-size: 0.75rem; }
            .invitation-inner-card { width: 82vw; height: 54vw; padding: 15px; top: 10px; left: 15px; }
            #dock-navigation { width: 92%; justify-content: space-around; padding: 6px 10px; }
            .dock-link { padding: 6px 10px; font-size: 0.65rem; letter-spacing: 1px; }
            .system-utilities-tray { top: 15px; right: 15px; }
            .utility-btn { width: 38px; height: 38px; }
            .venue-button-group { flex-direction: column; }
        }

        
    </style>
</head>
<body>

    <!-- Ambient Environment Matrix -->
    <div class="ambient-universe" id="ambient-particle-space"></div>

    <!-- Hidden Core Audio Frame -->
    <audio id="core-audio-element" loop preload="auto">
        <source src="music.mp3" type="audio/mpeg">
    </audio>

    <!-- Scroll Progress Indicator -->
    <div id="scroll-progress-indicator"></div>

    <!-- System Utilities Control Tray -->
    <div class="system-utilities-tray">
        <button class="utility-btn" id="language-toggle" title="Switch Language / Badili Lugha">
            <span style="font-family: var(--font-sans); font-size: 0.75rem; font-weight: 600;">SW</span>
        </button>
        <button class="utility-btn" id="theme-toggle" title="Toggle Appearance Profile">
            <i data-feather="moon"></i>
        </button>
        <button class="utility-btn" id="audio-state-control" title="Toggle Soundscape Ambient">
            <i data-feather="music"></i>
        </button>
    </div>

    <!-- Apple-Inspired Entry Loader Sequence -->
    <div id="luxury-loader">
        <div class="monogram-loader">A &bull; A</div>
        <div class="skeleton-bar"><div class="skeleton-progress"></div></div>
    </div>

    <!-- Cinematic 3D Envelope Container Module -->
    <div id="envelope-wrapper">
        <div class="envelope-3d" id="interactive-envelope-node">
            <div class="envelope-flap"></div>
            <div class="wax-seal-wrapper">A&A</div>
            <div class="invitation-inner-card">
                <h4 style="font-family: var(--font-display); color: var(--primary-gold); letter-spacing: 3px; font-size: 0.8rem;">THE CELEBRATION INVITATION</h4>
                <h2 style="font-family: var(--font-accent); font-style: italic; font-size: 2.6rem; margin: 20px 0 10px 0; font-weight: 400;">Abel & Anlin</h2>
                <p style="font-size: 1.1rem; font-style: italic; opacity: 0.7; margin-bottom: 20px;" data-en="Click Seal to Open Experience" data-sw="Bonyeza Nta Kufungua Mwaliko">Bonyeza Nta Kufungua Mwaliko</p>
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
                <h3 data-en="The Celestial Wedding Invitation" data-sw="Mwaliko Rasmi Wa Harusi">Mwaliko Rasmi Wa Harusi</h3>
                <h1>Abel & Anlin</h1>
                <span class="ampersand-divider">💍</span>
                <p class="date-string">05 &bull; SEPTEMBER &bull; 2026</p>
                <p class="poetic-quote">"Two souls with but a single thought, two hearts that beat as one."</p>
            </div>
        </header>

        <!-- Contextual Welcome Node -->
        <section id="personalized-guest-center" class="reveal">
            <div class="guest-welcome-card glass-card">
                <div class="guest-title-salutation" id="dynamic-salutation-node" data-en="Dear Esteemed Guest," data-sw="Kwa Ndugu Mpendwa Mwalikwa,">Kwa Ndugu Mpendwa Mwalikwa,</div>
                <p id="dynamic-welcome-statement" data-en="We are truly honored to invite you to celebrate our special day." data-sw="Tuna heshima kubwa kukualika kujumuika nasi kwenye siku yetu hii maalum.">Tuna heshima kubwa kukualika kujumuika nasi kwenye siku yetu hii maalum.</p>
                
                <!-- Weather Widget Integration -->
                <div id="live-weather-card" style="margin-top: 25px; font-family: var(--font-sans); font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px; opacity: 0.75; border: 1px solid var(--border-glass); padding: 6px 16px; border-radius: 20px;">
                    <i data-feather="sun" style="width: 14px; height: 14px; color: var(--primary-gold);"></i>
                    <span id="weather-text-anchor" data-en="Arusha Destination" data-sw="Hali ya Hewa Arusha">Hali ya Hewa Arusha</span>
                </div>
            </div>
        </section>

        <!-- Section: Love Story Timeline Section -->
        <section id="story-viewport">
            <div class="section-header-block reveal">
                <h2 data-en="Our Chapter Story" data-sw="Historia ya Upendo Wetu">Historia ya Upendo Wetu</h2>
                <p data-en="How it all perfectly aligned" data-sw="Jinsi kila kitu kilivyojipanga kwa uzuri">Jinsi kila kitu kilivyojipanga kwa uzuri</p>
            </div>
            
            <div class="story-timeline-backbone">
                <div class="story-event-card-wrapper reveal">
                    <div class="story-inner-card glass-card">
                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=600&q=80" alt="Meeting Instance">
                        <!-- <span class="meta-date">NOVEMBER 14, 2023</span> -->
                        <h3 data-en="The Serendipitous Hello" data-sw="Kukutana kwa Bahati">Kukutana kwa Bahati</h3>
                        <p data-en="A simple unexpected meeting that altered the trajectory of our separate timelines forever." data-sw="Mkutano rahisi usiotarajiwa ambao ulibadilisha mwelekeo wa maisha yetu milele."></p>
                    </div>
                </div>

                <div class="story-event-card-wrapper reveal">
                    <div class="story-inner-card glass-card">
                        <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&fit=crop&w=600&q=80" alt="First Date">
                        <!-- <span class="meta-date">JANUARY 08, 2024</span> -->
                        <h3 data-en="The First Coffee Chapter" data-sw="Ahadi ya Kwanza">The Proposal</h3>
                        <p data-en="Hours melted like seconds under soft laughter, revealing matching patterns of soul and destiny." data-sw="Masaa yalipita kama sekunde chini ya kicheko laini, ikionyesha maelekeo sawa ya roho na hatima zetu."></p>
                    </div>
                </div>

                <div class="story-event-card-wrapper reveal">
                    <div class="story-inner-card glass-card">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&w=600&q=80" alt="The Proposal">
                        <span class="meta-date">SEPTEMBER 09, 2026</span>
                        <h3 data-en="The Sovereign Infinity Yes" data-sw="Mkataba wa Milele">Mkataba wa Milele</h3>
                        <p data-en="Beneath an expansive canopy of light projections, a lifelong query received its infinite answer." data-sw="Chini ya dari kubwa ya makadirio ya mwanga, swali la maisha litapata jibu lake la milele."></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Editorial Photo Gallery System -->
        <section id="gallery-viewport" style="display: none;">
            <div class="section-header-block reveal">
                <h2 data-en="Visual Gallery Elements" data-sw="Nyumba ya Picha Lookbook">Nyumba ya Picha Lookbook</h2>
                <p data-en="Moments frozen in perpetual romance" data-sw="Nyakati zilizogandishwa katika mahaba ya daima">Nyakati zilizogandishwa katika mahaba ya daima</p>
            </div>

            <div class="gallery-masonry-grid">
                <div class="gallery-photo-frame glass-card reveal">
                    <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=600&q=80" alt="Look 1">
                    <div class="gallery-card-overlay"><span data-en="Editorial Look I" data-sw="Mtazamo wa Kwanza I">Mtazamo wa Kwanza I</span></div>
                </div>
                <div class="gallery-photo-frame glass-card reveal">
                    <img src="https://images.unsplash.com/photo-1519225495810-7512c696505a?auto=format&fit=crop&w=600&q=80" alt="Look 2">
                    <div class="gallery-card-overlay"><span data-en="Editorial Look II" data-sw="Mtazamo wa Pili II">Mtazamo wa Pili II</span></div>
                </div>
                <div class="gallery-photo-frame glass-card reveal">
                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=600&q=80" alt="Look 3">
                    <div class="gallery-card-overlay"><span data-en="Editorial Look III" data-sw="Mtazamo wa Tatu III">Mtazamo wa Tatu III</span></div>
                </div>
            </div>
        </section>

        <!-- Native Lightbox Output Structure Engine -->
        <div id="lightbox-overlay-engine">
            <button class="lightbox-close-trigger"><i data-feather="x" style="width: 32px; height: 32px;"></i></button>
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
                <p data-en="The formal unfolding of our celebration day" data-sw="Ufunguzi rasmi wa siku yetu ya sherehe">Ufunguzi rasmi wa siku yetu ya sherehe</p>
            </div>

            <div class="schedule-linear-track">
                <div class="schedule-timeline-unit reveal">
                    <div class="schedule-time-meta">09:30 AM</div>
                    <div class="schedule-event-details-box">
                        <h3 data-en="The Arrivals & Pre-lude" data-sw="Kuwasili & Maandalizi">Kuwasili & Maandalizi</h3>
                        <p data-en="Seating procedures and ambient orchestration within the cathedral foyer grounds." data-sw="Taratibu za kuketi na mipangilio ya mazingira ndani ya uwanja wa kanisa kuu."></p>
                    </div>
                </div>

                <div class="schedule-timeline-unit reveal">
                    <div class="schedule-time-meta">10:00 AM</div>
                    <div class="schedule-event-details-box">
                        <h3 data-en="Holy Matrimony Nuptials" data-sw="Ibada Takatifu ya Ndoa">Ibada Takatifu ya Ndoa</h3>
                        <p data-en="The absolute exchange of vows, standard custom protocols, and union sealing." data-sw="Kubadilishana kwa viapo kabisa, itifaki za kawaida, na kufunga muungano wetu."></p>
                    </div>
                </div>

                <div class="schedule-timeline-unit reveal">
                    <div class="schedule-time-meta">05:00 PM</div>
                    <div class="schedule-event-details-box">
                        <h3 data-en="The Reception Gala Banquet" data-sw="Sherehe Kuu ya Harusi">Sherehe Kuu ya Harusi</h3>
                        <p data-en="Grand ballroom protocol access doors unlock for dining, speeches, and evening dance." data-sw="Milango ya ukumbi mkuu inafunguliwa kwa chakula cha jioni, hotuba, na densi ya usiku."></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Editorial Venues Matrix Blueprint -->
        <section id="venue-viewport">
            <div class="section-header-block reveal">
                <h2 data-en="The Coordinates" data-sw="Maeneo ya Sherehe">Maeneo ya Sherehe</h2>
                <p data-en="Spaces hosting our sacred moments" data-sw="Nafasi zitakazohifadhi nyakati zetu takatifu">Nafasi zitakazohifadhi nyakati zetu takatifu</p>
            </div>

            <div class="venue-dual-grid">
                <div class="venue-editorial-card glass-card reveal">
                    <div>
                        <h3 data-en="Sacred Covenant Site" data-sw="Eneo la Ibada">Eneo la Ibada</h3>
                        <p>K.K.K.T USHARIKA WA ARUSHA MJINI CATHEDRAL
                                        <i>MJINI KATI, Goliondoi Rd, Arusha 23102</i></p>
                        <div class="interactive-iframe-holder">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.911766115915!2d36.6933442!3d-3.3717429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18371d183e4cade1%3A0x811721e8f5db64af!2sK.K.K.T%20USHARIKA%20WA%20ARUSHA%20MJINI%20CATHEDRAL!5e0!3m2!1ssw!2stz!4v1783772705253!5m2!1ssw!2stz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                    </div>
                    <div class="venue-button-group">
                        <a href="https://maps.app.goo.gl/rKnwwL1xqUVNHXe99" target="_blank" class="gold-button"><i data-feather="navigation" style="width:14px;"></i> Navigation</a>
                        <button class="gold-button copy-address-btn" data-address="https://maps.app.goo.gl/rKnwwL1xqUVNHXe99L"><i data-feather="copy" style="width:14px;"></i> <span data-en="Copy" data-sw="Nakili">Nakili</span></button>
                    </div>
                </div>

                <div class="venue-editorial-card glass-card reveal">
                    <div>
                        <h3 data-en="The Reception Gala Grounds" data-sw="Ukumbi wa Sherehe">Ukumbi wa Sherehe</h3>
                        <p>Holy Family Gardens Njiro</p>
                        <div class="interactive-iframe-holder">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.7223264149034!2d36.70283247312996!3d-3.4176853416666444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18371ba562623bb5%3A0xe8da3f63915760b2!2sHoly%20Family%20Gardens%20Njiro!5e0!3m2!1ssw!2stz!4v1783791360608!5m2!1ssw!2stz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                    </div>
                    <div class="venue-button-group">
                        <a href="https://maps.app.goo.gl/UsUkEuGXxQg3tWRt6" target="_blank" class="gold-button"><i data-feather="navigation" style="width:14px;"></i> Navigation</a>
                        <button class="gold-button copy-address-btn" data-address="https://maps.app.goo.gl/UsUkEuGXxQg3tWRt6"><i data-feather="copy" style="width:14px;"></i> <span data-en="Copy" data-sw="Nakili">Nakili</span></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Luxury Dress Code Specifications Guide -->
        <section id="dress-code-center" class="reveal" style="display: none;">
            <div class="section-header-block">
                <h2 data-en="Attire Protocols" data-sw="Itifaki ya Mavazi">Itifaki ya Mavazi</h2>
                <p data-en="Visual standard for a cohesive aesthetic layout" data-sw="Kiwango cha kuona kwa mpangilio mzuri wa pamoja">Kiwango cha kuona kwa mpangilio mzuri wa pamoja</p>
            </div>

            <div class="dress-editorial-container">
                <div class="dress-profile-card glass-card">
                    <h3 data-en="Ladies Palette" data-sw="Mavazi ya Kina Dada">Mavazi ya Kina Dada</h3>
                    <p data-en="Floor-length luxury gala attire, fluid textiles, or sophisticated luxury tailored sets." data-sw="Mavazi ya sherehe ya urefu wa sakafu, vitambaa vya mtiririko, au seti za kisasa zilizoshonwa kifahari."></p>
                    <div class="color-palette-row">
                        <div class="color-swatch-circle" style="background: #F4EFE6;" data-swatch-name="Beige"></div>
                        <div class="color-swatch-circle" style="background: #EADECD;" data-swatch-name="Champagne"></div>
                        <div class="color-swatch-circle" style="background: #DCAEAC;" data-swatch-name="Rose"></div>
                    </div>
                </div>

                <div class="dress-profile-card glass-card">
                    <h3 data-en="Gentlemen Profile" data-sw="Mavazi ya Kina Kaka">Mavazi ya Kina Kaka</h3>
                    <p data-en="Sharp luxury tailored black suits, elegant traditional wear, or clean premium tuxedos." data-sw="Suti nyeusi zilizoshonwa vizuri za kisasa, mavazi ya kitamaduni ya kifahari, au tuxedo safi za malipo."></p>
                    <div class="color-palette-row">
                        <div class="color-swatch-circle" style="background: #2C2A29;" data-swatch-name="Black Onyx"></div>
                        <div class="color-swatch-circle" style="background: #8A9A86;" data-swatch-name="Sage Green"></div>
                        <div class="color-swatch-circle" style="background: #D4AF37;" data-swatch-name="Gold Accent"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Gift Registry Intermediary Platform -->
        <section id="gift-registry-station" style="display: none;">
            <div class="section-header-block reveal">
                <h2 data-en="Love Registry" data-sw="Mfuko wa Baraka">Mfuko wa Baraka</h2>
                <p data-en="Support options for our foundational home assets" data-sw="Chaguzi za usaidizi kwa mali zetu za msingi za nyumbani">Chaguzi za usaidizi kwa mali zetu za msingi za nyumbani</p>
            </div>

            <div class="registry-central-card glass-card reveal">
                <p style="font-style: italic; max-width: 600px; margin: 0 auto 30px auto;" data-en="Your physical presence tops our scale of appreciation. If you feel led to grace our start with token financial support, pathways are embedded below." data-sw="Kuwepo kwako ni zawadi kubwa kwetu. Ukitamani kutubariki kwa namna ya kifedha, njia zimewekwa hapa chini."></p>
                <div class="registry-flex-channels">
                    <div class="registry-channel-unit">
                        <h4 data-en="Mobile Payments" data-sw="Malipo ya Simu">Malipo ya Simu</h4>
                        <code>M-Pesa Lipa: 5443322</code>
                        <button class="gold-button copy-registry-btn" data-copyval="5443322" data-en="Copy Key" data-sw="Nakili">Nakili</button>
                    </div>
                    <div class="registry-channel-unit">
                        <h4 data-en="Banking Pipeline" data-sw="Akaunti ya Benki">Akaunti ya Benki</h4>
                        <code>CRDB Bank: 0152899304400</code>
                        <button class="gold-button copy-registry-btn" data-copyval="0152899304400" data-en="Copy Account" data-sw="Nakili">Nakili</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Core Dynamic Family Acknowledgements -->
        <section id="family-lineage-node" >
            <div class="section-header-block reveal">
                <h2 data-en="With Boundless Joy" data-sw="Kwa Furaha Isiyo na Kifani">Kwa Furaha Isiyo na Kifani</h2>
            </div>
            <div style="display: flex; justify-content: center; gap: 80px; flex-wrap: wrap; text-align: center;" class="reveal">
                <div>
                    <h4 style="font-family: var(--font-display); color: var(--sage-green); font-size: 0.9rem; margin-bottom: 10px;" data-en="PARENTS OF THE GROOM" data-sw="WAZAZI WA BWANA HARUSI">WAZAZI WA BWANA HARUSI</h4>
                    <p style="font-size: 1.5rem; font-family: var(--font-accent); font-style: italic;">Mr. &amp; Mrs. Haggai Kinyau</p>
                </div>
                <div style="font-family: var(--font-accent); font-style: italic; font-size: 2rem; color: var(--primary-gold); align-self: center;">&amp;</div>
                <div>
                    <h4 style="font-family: var(--font-display); color: var(--sage-green); font-size: 0.9rem; margin-bottom: 10px;" data-en="PARENTS OF THE BRIDE" data-sw="WAZAZI WA BIBI HARUSI">WAZAZI WA BIBI HARUSI</h4>
                    <p style="font-size: 1.5rem; font-family: var(--font-accent); font-style: italic;">Mr. &amp; Mrs. </p>
                </div>
            </div>
        </section>

        <!-- Section: Automated RSVP Submission Interface Engine -->
        <section id="rsvp-viewport">
            <div class="section-header-block reveal">
                <h2 data-en="Attendance Confirmation" data-sw="Thibitisha Kuhudhuria">Thibitisha Kuhudhuria</h2>
                <p data-en="Lock your designation seat inside our system registry" data-sw="Weka nafasi yako ya kiti ndani ya mfumo wetu rasmi">Weka nafasi yako ya kiti ndani ya mfumo wetu rasmi</p>
            </div>

            <div class="rsvp-form-enclosure glass-card reveal" id="rsvp-interface-container-node">
                <!-- Built in Success Curtain Node -->
                <div class="rsvp-post-submit-curtain" id="rsvp-success-curtain-layer">
                    <h3 data-en="Confirmation Secured" data-sw="Imethibitishwa Kikamilifu">Imethibitishwa Kikamilifu</h3>
                    <p data-en="Your data values have populated our database. Save your entry QR key token below." data-sw="Taarifa zako zimehifadhiwa kwenye kanzidata yetu. Hifadhi alama yako ya QR hapa chini."></p>
                    
                    <div class="qr-output-zone" id="generated-qrcode-target"></div>
                    
                    <div style="margin-top: 20px; display: flex; flex-direction: column; gap: 15px; align-items: center;">
                        <button class="gold-button" id="whatsapp-share-trigger-btn"><i data-feather="message-circle"></i> <span data-en="Transmit to Couple via WhatsApp" data-sw="Tuma kwa Wanandoa WhatsApp">Tuma kwa Wanandoa WhatsApp</span></button>
                        <button class="gold-button" id="calendar-reminder-btn"><i data-feather="calendar"></i> <span data-en="Add to Google Calendar" data-sw="Weka Kwenye Kalenda">Weka Kwenye Kalenda</span></button>
                    </div>
                </div>

                <!-- Form Framework Target Element -->
                <form id="rsvp-interactive-form-element" onsubmit="processRSVPSubmitPipeline(event)">
                    <div class="rsvp-form-grid">
                        <div class="rsvp-form-group">
                            <label for="input-field-name" data-en="Full Signature Name" data-sw="Majina Kamili">Majina Kamili</label>
                            <input type="text" id="input-field-name" required placeholder="e.g. Raphael Siphael" value='{{$token->guest_name}}' readonly>
                        </div>
                        <div class="rsvp-form-group">
                            <label for="select-field-status" data-en="Attendance Status" data-sw="Hali ya Kuhudhuria">Hali ya Kuhudhuria</label>
                            <select id="select-field-status" required>
                                <option value="" disabled selected data-en="Select alignment profile" data-sw="Chagua wasifu">Chagua wasifu</option>
                                <option value="Attending" data-en="Joyfully Accepting" data-sw="Naitikia kwa Furaha">Naitikia kwa Furaha</option>
                                <option value="Declining" data-en="Regretfully Declining" data-sw="Nasikitika Sitoweza">Nasikitika Sitoweza</option>
                            </select>
                        </div>
                        <div class="rsvp-form-group">
                            <label for="select-field-adults" data-en="Adult Seats Requested" data-sw="Idadi ya Watu Wazima">Idadi ya Watu Wazima</label>
                            <input type="number" required value="1" min="1" id="select-field-adults">
        
                        </div>
                        <div class="rsvp-form-group">
                            <label for="select-field-children" data-en="Children Under 10 Seats" data-sw="Idadi ya Watoto">Idadi ya Watoto</label>
                            <input type="number" required value="0" min="0" id="select-field-children">
                            <!-- <select id="select-field-children">
                                <option value="0">Hakuna</option>
                                <option value="1">Mtoto 1</option>
                                <option value="2">Watoto 2</option>
                            </select> -->
                        </div>
                        <div class="rsvp-form-group" style="display: none;">
                            <label for="select-field-meal" data-en="Dietary Profile Selection" data-sw="Upendeleo wa Chakula">Upendeleo wa Chakula</label>
                            <select id="select-field-meal">
                                <option value="Standard Imperial" data-en="Standard Imperial Gourmet" data-sw="Chakula cha Kawaida">Chakula cha Kawaida</option>
                                <option value="Halal Certified" data-en="Halal Custom Package" data-sw="Chakula cha Halal">Chakula cha Halal</option>
                                <option value="Vegan Botanical" data-en="Vegan / Plant Based Luxury" data-sw="Chakula cha Mboga Mboga">Chakula cha Mboga Mboga</option>
                            </select>
                        </div>
                        <div class="rsvp-form-group" style="display: none;">
                            <label for="input-field-phone" data-en="Primary Mobile Number" data-sw="Namba ya Simu">Namba ya Simu</label>
                            <input type="tel" id="input-field-phone" placeholder="e.g. +255 700 000 000">
                        </div>
                        <div class="rsvp-form-group span-full" style="display: none;">
                            <label for="input-field-email" data-en="Digital Mail Destination" data-sw="Barua Pepe (Email)">Barua Pepe (Email)</label>
                            <input type="email" id="input-field-email"  placeholder="signature@domain.com">
                        </div>
                        <div class="rsvp-form-group span-full">
                            <label for="textarea-field-message" data-en="Warm Blessings & Notes" data-sw="Ujumbe au Baraka Zako">Ujumbe au Baraka Zako</label>
                            <textarea id="textarea-field-message" rows="4" placeholder="Andika baraka au ujumbe wako hapa..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="gold-button" style="width: 100%;" id="rsvp-submit-btn-copy" data-en="Lock Response Registry" data-sw="Thibitisha Nafasi Yako">Thibitisha Nafasi Yako</button>
                </form>
            </div>
        </section>

    </main>

    <!-- Global Timeless Luxury Footer Architecture -->
    <footer>
        <h2>Abel &amp; Anlin</h2>
        <p data-en="05 &bull; SEPTEMBER &bull; 2026 — FOREVER ALIGNED" data-sw="05 &bull; SEPTEMBA &bull; 2026 — UPENDO WA MILELE">05 &bull; SEPTEMBA &bull; 2026 — UPENDO WA MILELE</p>
    </footer>

    <!-- --- CORE SYSTEM ARCHITECTURE CODE ENGINE --- -->
    <script>
        // --- DATA DICTIONARY SYSTEM LAYER ---
        const languageDictionarySystem = {
            en: {
                mmet: "A simple unexpected meeting that altered the trajectory of our separate timelines forever.",
                mdate: "Hours melted like seconds under soft laughter, revealing matching patterns of soul and destiny.",
                mprop: "Beneath an expansive canopy of light projections, a lifelong query received its infinite answer.",
                flad: "Floor-length luxury gala attire, fluid textiles, or sophisticated luxury tailored sets.",
                fgen: "Sharp luxury tailored black suits, elegant traditional wear, or clean premium tuxedos.",
                freg: "Your physical presence tops our scale of appreciation. If you feel led to grace our start with token financial support, pathways are embedded below.",
                fsucc: "Your data values have populated our database. Save your entry QR key token below."
            },
            sw: {
                mmet: "Mkutano rahisi usiotarajiwa ambao ulibadilisha mwelekeo wa maisha yetu tofauti milele.",
                mdate: "Masaa yalipita kama sekunde chini ya kicheko laini, ikionyesha mifumo inayolingana ya roho na hatima.",
                mprop: "Chini ya dari kubwa ya makadirio ya mwanga, swali la maisha yote lilipata jibu lake lisilo na kikomo.",
                flad: "Mavazi ya kifahari ya urefu wa sakafu, nguo zinazotiririka, au seti za kisasa zilizoshonwa vizuri.",
                fgen: "Suti nyeusi za kisasa zilizoshonwa vizuri, mavazi ya kifahari ya kitamaduni, au tuxedo safi za malipo.",
                freg: "Kuwepo kwako kimwili ndio kiwango chetu cha juu cha shukrani. Ukiongozwa kutubariki kwa msaada vya kifedha, njia zimewekwa hapa chini.",
                fsucc: "Taarifa zako zimehifadhiwa kwenye mfumo wetu. Hifadhi alama yako ya usalama ya QR hapa chini."
            }
        };

        let activeSystemLanguage = "sw";
        let capturedGlobalGuestIdentity = "Mgeni";

        // --- LIFE-CYCLE BOOT MANAGER ---
        document.addEventListener("DOMContentLoaded", () => {
            feather.replace();
            initializeAmbientSpace();
            interceptUrlGuestParameter();
            executeDynamicScrollObservers();
            initiateTargetCountdownEngine("2026-09-05T10:00:00");
            setupEventInteractions();
            triggerLanguageLoadSetup();

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
            for(let i=0; i<12; i++) {
                let petal = document.createElement("span");
                petal.className = "petal";
                petal.style.left = Math.random() * 100 + "vw";
                petal.style.width = petal.style.height = (Math.random() * 14 + 8) + "px";
                petal.style.animationDelay = Math.random() * 7 + "s";
                petal.style.animationDuration = Math.random() * 12 + 12 + "s";
                backgroundSpace.appendChild(petal);
            }
            // Build Shimmering Gold Dust
            for(let j=0; j<18; j++) {
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

            if(rawParamName) {
                capturedGlobalGuestIdentity = decodeURIComponent(rawParamName);
                salutationNode.setAttribute("data-en", `Dear ${capturedGlobalGuestIdentity},`);
                salutationNode.setAttribute("data-sw", `Kwa Ndugu Mpendwa ${capturedGlobalGuestIdentity},`);
                salutationNode.innerText = activeSystemLanguage === "en" ? `Dear ${capturedGlobalGuestIdentity},` : `Kwa Ndugu Mpendwa ${capturedGlobalGuestIdentity},`;
                if(formNameInput) formNameInput.value = capturedGlobalGuestIdentity;
            }
        }

        // --- 3D INTERACTIVE ENVELOPE CONTROLLER ---
        const envelopeModuleNode = document.getElementById("interactive-envelope-node");
        const globalAudioFrame = document.getElementById("core-audio-element");
        const audioTrayBtn = document.getElementById("audio-state-control");
        let systemAudioPlaying = false;

        envelopeModuleNode.addEventListener("click", () => {
            if(!envelopeModuleNode.classList.contains("open")) {
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
            if(systemAudioPlaying) {
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
            const currentProfileTheme = document.documentElement.getAttribute("data-theme");
            if(currentProfileTheme === "dark") {
                document.documentElement.removeAttribute("data-theme");
                themeToggleBtn.innerHTML = `<i data-feather="moon"></i>`;
            } else {
                document.documentElement.setAttribute("data-theme", "dark");
                themeToggleBtn.innerHTML = `<i data-feather="sun"></i>`;
            }
            feather.replace();
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
                if(chosenTranslationString) {
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
            
            document.querySelector("#gift-registry-station p").innerText = languageDictionarySystem[activeSystemLanguage]["freg"];
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
                    if(ent.isIntersecting) ent.target.classList.add("active");
                });
            }, { threshold: 0.12 });

            targetRevealNodes.forEach(node => observerInstance.observe(node));

            window.addEventListener("scroll", () => {
                const currentWinScrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const docHeightSpread = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const trackedPercentage = (currentWinScrollTop / docHeightSpread) * 100;
                barProgress.style.width = trackedPercentage + "%";

                // Parallax background processing calculations
                document.getElementById("hero-bg-parallax-node").style.transform = `translateY(${currentWinScrollTop * 0.35}px) scale(1.08)`;

                // Active Tab Class Switch Tracking Pipeline
                let workingSectionActiveId = "hero-viewport";
                structuralSections.forEach(sect => {
                    if (currentWinScrollTop >= (sect.offsetTop - 280)) {
                        workingSectionActiveId = sect.getAttribute("id");
                    }
                });
                navAnchors.forEach(link => {
                    link.classList.remove("active");
                    if(link.getAttribute("href") === `#${workingSectionActiveId}`) link.classList.add("active");
                });
            });
        }

        // --- LUXURY COUNTDOWN ENGINE ---
        function initiateTargetCountdownEngine(targetIsoString) {
            const destinationTime = new Date(targetIsoString).getTime();

            const taskTickerInterval = setInterval(() => {
                const localNowTime = new Date().getTime();
                const deltaGapDistance = destinationTime - localNowTime;

                if(deltaGapDistance < 0) {
                    clearInterval(taskTickerInterval);
                    document.getElementById("countdown-anchor").innerHTML = `<h3 style='font-family: var(--font-accent); font-style: italic; font-size: 2.5rem; color: var(--primary-gold); width: 100%; text-align: center;'>Leo ni Siku ya Furaha ❤️</h3>`;
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
        let payloadBackupObject = null;

        function processRSVPSubmitPipeline(event) {
            event.preventDefault();
            const btnSubmit = document.getElementById("rsvp-submit-btn-copy");
            btnSubmit.innerText = activeSystemLanguage === "en" ? "TRANSMITTING..." : "INATUMA...";
            btnSubmit.disabled = true;

            // Compile Form Values
            payloadBackupObject = {
                guestName: document.getElementById("input-field-name").value,
                attendance: document.getElementById("select-field-status").value,
                adults: document.getElementById("select-field-adults").value,
                children: document.getElementById("select-field-children").value,
                meal: document.getElementById("select-field-meal").value,
                phone: document.getElementById("input-field-phone").value,
                email: document.getElementById("input-field-email").value,
                message: document.getElementById("textarea-field-message").value,
                uuidString: "INV-" + Math.floor(100000 + Math.random() * 900000)
            };

            // Direct Formless POST Pipeline to Google Apps Script Web App Endpoint URL Template
            const targetGoogleScriptWebAppUrl = "https://script.google.com/macros/s/AKfycby-YOUR-APPSCRIPT-ID-HERE/exec"; 

            fetch(targetGoogleScriptWebAppUrl, {
                method: "POST",
                mode: "no-cors",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(payloadBackupObject)
            }).then(() => {
                finalizeSuccessfulRSVPUiState();
            }).catch(err => {
                console.error("Sheets runtime logging down. Activating offline execution state protocol safely.", err);
                finalizeSuccessfulRSVPUiState();
            });
        }

        function finalizeSuccessfulRSVPUiState() {
            const successOverlay = document.getElementById("rsvp-success-curtain-layer");
            successOverlay.style.display = "flex";
            
            // Generate QR Target Token Value
            const qrcodeZone = document.getElementById("generated-qrcode-target");
            qrcodeZone.innerHTML = "";
            new QRCode(qrcodeZone, {
                text: `ID:${payloadBackupObject.uuidString}|NAME:${payloadBackupObject.guestName}|STATUS:${payloadBackupObject.attendance}`,
                width: 130,
                height: 130,
                colorDark : "#2C2A29",
                colorLight : "#ffffff"
            });

            // Fire Luxury Confetti Streamers
            fireLuxuryConfettiExplosion(document.getElementById("rsvp-interface-container-node"));

            // Initialize Dynamic API Target Handles
            document.getElementById("whatsapp-share-trigger-btn").onclick = () => {
                const waTextFormatted = encodeURIComponent(`Habari!\nNime thibitisha mahudhurio yangu.\n\n*Jina:* ${payloadBackupObject.guestName}\n*Hali:* ${payloadBackupObject.attendance === 'Attending' ? 'Nafika kwa Furaha' : 'Sitoweza kufika'}\n*Viti (Watu Wazima/Watoto):* ${payloadBackupObject.adults}/${payloadBackupObject.children}\n*Kadi ID:* ${payloadBackupObject.uuidString}\n\nTukutane siku ya sherehe!`);
                window.open(`https://api.whatsapp.com/send?phone=255684848851&text=${waTextFormatted}`, "_blank");
            };

            document.getElementById("calendar-reminder-btn").onclick = () => {
                window.open("https://calendar.google.com/calendar/render?action=TEMPLATE&text=Abel+%26+Anlin+Wedding+Celebration&dates=20260905T100000Z/20260905T220000Z&details=Join+us+in+celebration+of+forever+alignment.&location=St.+Joseph&#39;s+Cathedral,+Dar+es+Salaam", "_blank");
            };
        }

        function fireLuxuryConfettiExplosion(parentWrapper) {
            const customHexColors = ["#D4AF37", "#8A9A86", "#DCAEAC", "#AA8417", "#6B6661"];
            for(let k=0; k<75; k++) {
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
    </script>
</body>
</html>