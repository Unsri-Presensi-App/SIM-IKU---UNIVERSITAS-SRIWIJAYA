<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Halaman Tidak Ditemukan · Universitas Sriwijaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --navy:      #1B3A6B;
            --navy-dark: #0F2245;
            --navy-mid:  #243F72;
            --amber:     #F59E0B;
            --slate-50:  #F8FAFC;
            --slate-100: #F1F5F9;
            --slate-200: #E2E8F0;
            --slate-300: #CBD5E1;
            --slate-400: #94A3B8;
            --slate-500: #64748B;
            --slate-600: #475569;
            --slate-800: #1E293B;
            --white:     #FFFFFF;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background: var(--slate-50);
            color: var(--slate-800);
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Background ── */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .bg-grid {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0.025;
        }

        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
        }

        .blob-a {
            width: 700px; height: 700px;
            background: var(--navy);
            top: -250px; right: -180px;
            opacity: 0.045;
            animation: blobDrift 22s ease-in-out infinite;
        }

        .blob-b {
            width: 450px; height: 450px;
            background: var(--amber);
            bottom: -120px; left: -80px;
            opacity: 0.035;
            animation: blobDrift 28s ease-in-out infinite reverse;
        }

        @keyframes blobDrift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            40%       { transform: translate(20px, -30px) scale(1.03); }
            70%       { transform: translate(-15px, 20px) scale(0.97); }
        }

        /* ── Layout ── */
        .page {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
            position: relative;
            z-index: 1;
        }

        .split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 960px;
            width: 100%;
        }

        /* ── Illustration pane ── */
        .illus-pane {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .illus-wrap {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        /* Pulse rings behind glass */
        .ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid var(--navy);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation: ringPulse 3.2s ease-out infinite;
            pointer-events: none;
        }

        .ring-1 { width: 200px; height: 200px; opacity: 0.07; animation-delay: 0s; }
        .ring-2 { width: 260px; height: 260px; opacity: 0.045; animation-delay: 0.8s; }
        .ring-3 { width: 320px; height: 320px; opacity: 0.025; animation-delay: 1.6s; }

        @keyframes ringPulse {
            0%   { transform: translate(-50%, -50%) scale(0.85); opacity: 0.12; }
            100% { transform: translate(-50%, -50%) scale(1.15); opacity: 0; }
        }

        /* SVG animations */
        .glass-group {
            animation: glassRock 6s ease-in-out infinite;
            transform-origin: center;
        }

        @keyframes glassRock {
            0%, 100% { transform: rotate(-2deg) translateY(0); }
            50%       { transform: rotate(2deg) translateY(-6px); }
        }

        .float-doc-1 { animation: floatA 5s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }
        .float-doc-2 { animation: floatB 6.5s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }
        .float-doc-3 { animation: floatC 4.8s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }

        @keyframes floatA {
            0%, 100% { transform: translateY(0) rotate(15deg); }
            50%       { transform: translateY(-10px) rotate(12deg); }
        }

        @keyframes floatB {
            0%, 100% { transform: translateY(0) rotate(-12deg); }
            50%       { transform: translateY(-14px) rotate(-9deg); }
        }

        @keyframes floatC {
            0%, 100% { transform: translateY(0) rotate(8deg); }
            50%       { transform: translateY(-8px) rotate(11deg); }
        }

        .sparkle-a { animation: sparklePop 2.4s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }
        .sparkle-b { animation: sparklePop 3.1s ease-in-out infinite 0.7s; transform-box: fill-box; transform-origin: center; }

        @keyframes sparklePop {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50%       { opacity: 1; transform: scale(1.3); }
        }

        .qmark { animation: qPulse 3s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }

        @keyframes qPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.75; transform: scale(0.92); }
        }

        /* ── Content pane ── */
        .content-pane {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        /* Error badge */
        .error-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #FEF3C7;
            border: 1px solid #FDE68A;
            border-radius: 20px;
            padding: 5px 14px 5px 8px;
            margin-bottom: 1.25rem;
            width: fit-content;
            animation: fadeUp 0.5s 0.1s both;
        }

        .badge-code {
            background: var(--amber);
            color: var(--white);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 11px;
            letter-spacing: 0.05em;
            padding: 2px 8px;
            border-radius: 12px;
        }

        .badge-label {
            font-size: 12px;
            font-weight: 600;
            color: #92400E;
            letter-spacing: 0.03em;
        }

        .content-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 2.1rem;
            color: var(--navy-dark);
            line-height: 1.2;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
            animation: fadeUp 0.5s 0.2s both;
        }

        .content-desc {
            font-size: 0.9375rem;
            color: var(--slate-500);
            line-height: 1.75;
            margin-bottom: 0.5rem;
            animation: fadeUp 0.5s 0.3s both;
        }

        /* Suggestions */
        .suggestions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 1.25rem 0 2rem;
            animation: fadeUp 0.5s 0.4s both;
        }

        .suggestion-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--slate-400);
            margin-bottom: 2px;
        }

        .suggestion-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: var(--white);
            border: 1px solid var(--slate-200);
            border-radius: 10px;
            font-size: 0.875rem;
            color: var(--slate-600);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .suggestion-item:hover {
            border-color: var(--navy);
            color: var(--navy);
            background: #EEF2FA;
            transform: translateX(3px);
        }

        .suggestion-item svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            color: var(--slate-400);
            transition: color 0.2s;
        }

        .suggestion-item:hover svg { color: var(--navy); }

        .suggestion-arrow {
            margin-left: auto;
            width: 14px !important;
        }

        /* Divider */
        .divider {
            height: 1px;
            background: var(--slate-100);
            margin-bottom: 1.5rem;
            animation: fadeUp 0.5s 0.45s both;
        }

        /* Actions */
        .actions {
            display: flex;
            gap: 10px;
            animation: fadeUp 0.5s 0.5s both;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.65rem 1.25rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }

        .btn svg { width: 15px; height: 15px; flex-shrink: 0; }

        .btn-primary {
            background: var(--navy);
            color: var(--white);
            box-shadow: 0 1px 3px rgba(27,58,107,0.25), 0 4px 14px rgba(27,58,107,0.18);
        }

        .btn-primary:hover {
            background: var(--navy-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(27,58,107,0.3), 0 10px 28px rgba(27,58,107,0.2);
        }

        .btn-primary:active { transform: translateY(0); }

        .btn-secondary {
            background: var(--white);
            color: var(--slate-800);
            border: 1px solid var(--slate-200);
        }

        .btn-secondary:hover {
            border-color: var(--slate-300);
            background: var(--slate-50);
            transform: translateY(-1px);
        }

        /* ── Logo ── */
        .logo-bar {
            position: absolute;
            top: 1.25rem;
            left: 1.5rem;
            z-index: 5;
        }

        .logo-bar img {
            height: 52px;
            object-fit: contain;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.08));
            transition: transform 0.3s;
        }

        .logo-bar img:hover { transform: scale(1.04); }

        .logo-text-fallback {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 15px;
            color: var(--navy);
            letter-spacing: 0.02em;
        }

        /* ── Footer ── */
        .footer {
            text-align: center;
            padding: 1rem;
            position: relative;
            z-index: 1;
        }

        .footer p { font-size: 12px; color: var(--slate-400); }
        .footer span { font-weight: 500; color: var(--slate-500); }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Responsive ── */
        @media (max-width: 700px) {
            .split {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .illus-wrap {
                max-width: 280px;
                margin: 0 auto;
            }

            .ring-1 { width: 150px; height: 150px; }
            .ring-2 { width: 195px; height: 195px; }
            .ring-3 { width: 240px; height: 240px; }

            .content-heading { font-size: 1.6rem; }
            .page { padding: 1.5rem 1.25rem 2rem; }
            .logo-bar { top: 0.75rem; left: 1rem; }
            .logo-bar img { height: 40px; }
            .actions { flex-direction: column; }
            .btn { justify-content: center; }
            .suggestions { gap: 8px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; }
        }
    </style>
</head>
<body>

    <!-- Ambient background -->
    <div class="bg-layer" aria-hidden="true">
        <div class="bg-blob blob-a"></div>
        <div class="bg-blob blob-b"></div>
        <svg class="bg-grid" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="g" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#1B3A6B" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#g)"/>
        </svg>
    </div>

    <!-- Logo -->
    <div class="logo-bar">
        <img
            src="https://fkm.unsri.ac.id/assets/kcfinder/upload/files/logo-unsri.png"
            alt="Logo Universitas Sriwijaya"
            onerror="this.style.display='none';this.nextElementSibling.style.display='block';"
        >
        <span class="logo-text-fallback" style="display:none;">UNSRI</span>
    </div>

    <!-- Main -->
    <main class="page" role="main">
        <div class="split">

            <!-- ── Illustration ── -->
            <div class="illus-pane" aria-hidden="true">
                <div class="illus-wrap">
                    <!-- Pulse rings -->
                    <div class="ring ring-1"></div>
                    <div class="ring ring-2"></div>
                    <div class="ring ring-3"></div>

                    <svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
                        <defs>
                            <!-- Clip path for magnifying glass lens -->
                            <clipPath id="lensClip">
                                <circle cx="175" cy="162" r="86"/>
                            </clipPath>
                            <!-- Subtle gradient for lens interior -->
                            <radialGradient id="lensGrad" cx="40%" cy="35%" r="65%">
                                <stop offset="0%" stop-color="#EEF2FA"/>
                                <stop offset="100%" stop-color="#DDE6F5"/>
                            </radialGradient>
                            <!-- Gradient for handle -->
                            <linearGradient id="handleGrad" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0%" stop-color="#1B3A6B"/>
                                <stop offset="100%" stop-color="#0F2245"/>
                            </linearGradient>
                            <!-- Glass rim gradient -->
                            <linearGradient id="rimGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#2A5298"/>
                                <stop offset="100%" stop-color="#1B3A6B"/>
                            </linearGradient>
                            <filter id="docShadow" x="-20%" y="-20%" width="140%" height="140%">
                                <feDropShadow dx="0" dy="3" stdDeviation="4" flood-color="#1B3A6B" flood-opacity="0.10"/>
                            </filter>
                            <filter id="glassShadow" x="-15%" y="-15%" width="130%" height="130%">
                                <feDropShadow dx="2" dy="8" stdDeviation="12" flood-color="#0F2245" flood-opacity="0.18"/>
                            </filter>
                        </defs>

                        <!-- ── Floating document 1 (top-right) ── -->
                        <g class="float-doc-1" transform="translate(290, 40) rotate(15)">
                            <filter id="s1"><feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#1B3A6B" flood-opacity="0.1"/></filter>
                            <g filter="url(#s1)">
                                <rect width="50" height="62" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
                                <!-- Corner fold -->
                                <path d="M38,0 L50,12 L38,12 Z" fill="#EEF2FA"/>
                                <line x1="38" y1="0" x2="38" y2="12" stroke="#CBD5E1" stroke-width="1"/>
                                <line x1="38" y1="12" x2="50" y2="12" stroke="#CBD5E1" stroke-width="1"/>
                            </g>
                            <!-- Text lines -->
                            <rect x="8" y="20" width="30" height="4" rx="2" fill="#CBD5E1"/>
                            <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#E2E8F0"/>
                            <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#E2E8F0"/>
                            <rect x="8" y="48" width="19" height="3.5" rx="1.8" fill="#EEF2F9"/>
                        </g>

                        <!-- ── Floating document 2 (left side) ── -->
                        <g class="float-doc-2" transform="translate(18, 105) rotate(-12)">
                            <filter id="s2"><feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#1B3A6B" flood-opacity="0.1"/></filter>
                            <g filter="url(#s2)">
                                <rect width="44" height="54" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
                                <path d="M33,0 L44,11 L33,11 Z" fill="#EEF2FA"/>
                                <line x1="33" y1="0" x2="33" y2="11" stroke="#CBD5E1" stroke-width="1"/>
                                <line x1="33" y1="11" x2="44" y2="11" stroke="#CBD5E1" stroke-width="1"/>
                            </g>
                            <rect x="7" y="18" width="26" height="4" rx="2" fill="#CBD5E1"/>
                            <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#E2E8F0"/>
                            <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#E2E8F0"/>
                            <rect x="7" y="43" width="16" height="3.5" rx="1.8" fill="#EEF2F9"/>
                        </g>

                        <!-- ── Floating document 3 (bottom-right) ── -->
                        <g class="float-doc-3" transform="translate(302, 270) rotate(8)">
                            <filter id="s3"><feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#1B3A6B" flood-opacity="0.1"/></filter>
                            <g filter="url(#s3)">
                                <rect width="42" height="52" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
                                <path d="M31,0 L42,11 L31,11 Z" fill="#EEF2FA"/>
                                <line x1="31" y1="0" x2="31" y2="11" stroke="#CBD5E1" stroke-width="1"/>
                                <line x1="31" y1="11" x2="42" y2="11" stroke="#CBD5E1" stroke-width="1"/>
                            </g>
                            <rect x="7" y="18" width="22" height="4" rx="2" fill="#CBD5E1"/>
                            <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#E2E8F0"/>
                            <rect x="7" y="35" width="21" height="3.5" rx="1.8" fill="#E2E8F0"/>
                        </g>

                        <!-- ── Magnifying glass group ── -->
                        <g class="glass-group" filter="url(#glassShadow)">

                            <!-- Lens fill -->
                            <circle cx="175" cy="162" r="86" fill="url(#lensGrad)"/>

                            <!-- Content inside lens -->
                            <g clip-path="url(#lensClip)">
                                <!-- Document inside glass -->
                                <rect x="128" y="104" width="94" height="116" rx="7" fill="white" stroke="#E2E8F0" stroke-width="1.5"/>
                                <!-- Document top color bar (navy accent) -->
                                <rect x="128" y="104" width="94" height="8" rx="7" fill="#1B3A6B"/>
                                <rect x="128" y="108" width="94" height="4" fill="#1B3A6B"/>
                                <!-- Doc text lines -->
                                <rect x="140" y="124" width="40" height="5" rx="2.5" fill="#CBD5E1"/>
                                <rect x="140" y="136" width="66" height="4" rx="2" fill="#E2E8F0"/>
                                <rect x="140" y="146" width="54" height="4" rx="2" fill="#E2E8F0"/>
                                <rect x="140" y="156" width="60" height="4" rx="2" fill="#EEF2F9"/>
                                <!-- Dashed separator -->
                                <line x1="140" y1="168" x2="210" y2="168" stroke="#E2E8F0" stroke-width="1" stroke-dasharray="4 3"/>
                                <!-- Big question mark -->
                                <text class="qmark" x="175" y="208"
                                    text-anchor="middle"
                                    font-family="'Plus Jakarta Sans', sans-serif"
                                    font-size="42"
                                    font-weight="800"
                                    fill="#F59E0B">?</text>
                            </g>

                            <!-- Lens rim -->
                            <circle cx="175" cy="162" r="86" fill="none" stroke="url(#rimGrad)" stroke-width="7"/>
                            <!-- Rim highlight -->
                            <circle cx="175" cy="162" r="86" fill="none" stroke="white" stroke-width="2"
                                stroke-dasharray="36 600" stroke-dashoffset="-18" opacity="0.4"/>

                        </g><!-- /glass-group -->

                        <!-- Handle -->
                        <g>
                            <line x1="246" y1="233" x2="302" y2="289" stroke="url(#handleGrad)" stroke-width="18" stroke-linecap="round"/>
                            <!-- Handle highlight -->
                            <line x1="248" y1="237" x2="298" y2="287" stroke="white" stroke-width="3" stroke-linecap="round" opacity="0.18"/>
                        </g>

                        <!-- ── Sparkle decorations ── -->
                        <!-- Amber cross sparkle top-left of glass -->
                        <g class="sparkle-a" transform="translate(76, 76)">
                            <line x1="0" y1="-9" x2="0" y2="9" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="-9" y1="0" x2="9" y2="0" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
                            <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
                        </g>

                        <!-- Small sparkle bottom-left -->
                        <g class="sparkle-b" transform="translate(52, 290)">
                            <line x1="0" y1="-6" x2="0" y2="6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                            <line x1="-6" y1="0" x2="6" y2="0" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        </g>

                        <!-- Tiny dot accents -->
                        <circle cx="330" cy="90" r="4.5" fill="#F59E0B" opacity="0.55"/>
                        <circle cx="338" cy="180" r="3" fill="#1B3A6B" opacity="0.2"/>
                        <circle cx="30" cy="65" r="3.5" fill="#1B3A6B" opacity="0.18"/>
                        <circle cx="44" cy="240" r="5" fill="#F59E0B" opacity="0.35"/>
                        <circle cx="350" cy="310" r="3" fill="#94A3B8" opacity="0.4"/>
                        <!-- Dashed orbit arc (decorative) -->
                        <circle cx="175" cy="162" r="120" fill="none" stroke="#1B3A6B"
                            stroke-width="1" stroke-dasharray="6 14" opacity="0.07"/>

                    </svg>
                </div>
            </div>

            <!-- ── Content ── -->
            <div class="content-pane">

                <!-- Badge -->
                <div class="error-badge" aria-label="Error 404">
                    <span class="badge-code">404</span>
                    <span class="badge-label">Halaman Tidak Ditemukan</span>
                </div>

                <h1 class="content-heading">
                    Maaf, halaman<br>yang Anda cari<br>tidak tersedia.
                </h1>

                <p class="content-desc">
                    URL yang Anda tuju tidak terdaftar dalam sistem, sudah dipindahkan, atau mungkin telah dihapus. Periksa kembali alamat yang dimasukkan.
                </p>

                <!-- Quick navigation suggestions -->
                <div class="suggestions">
                    <p class="suggestion-label">Mungkin yang Anda cari:</p>
                    <a href="{{ url('/') }}" class="suggestion-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Beranda Sistem
                        <svg class="suggestion-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </a>
                    <a href="{{ url('/login') }}" class="suggestion-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                        Halaman Login
                        <svg class="suggestion-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </a>
                </div>

                <div class="divider"></div>

                <div class="actions">
                    <a href="{{ url('/') }}" class="btn btn-primary" aria-label="Kembali ke halaman beranda">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    <a href="mailto:ict@unsri.ac.id" class="btn btn-secondary" aria-label="Hubungi TIK Universitas Sriwijaya">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                        Hubungi TIK UNSRI
                    </a>
                </div>

            </div><!-- /content-pane -->
        </div><!-- /split -->
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>© <span id="year"></span> <span>Universitas Sriwijaya</span> · Semua hak dilindungi</p>
    </footer>

    <script>
        /* Year fallback */
        (function() {
            var el = document.getElementById('year');
            if (!el) return;
            var blade = '{{ date("Y") }}';
            el.textContent = /^\d{4}$/.test(blade) ? blade : new Date().getFullYear();
        })();
    </script>

</body>
</html>