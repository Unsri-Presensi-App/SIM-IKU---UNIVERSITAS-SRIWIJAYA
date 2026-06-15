<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeliharaan Sistem — Universitas Sriwijaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --navy:      #1B3A6B;
            --navy-dark: #0F2245;
            --navy-mid:  #243F72;
            --amber:     #F59E0B;
            --amber-lt:  #FEF3C7;
            --slate-50:  #F8FAFC;
            --slate-100: #F1F5F9;
            --slate-200: #E2E8F0;
            --slate-400: #94A3B8;
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

        /* ── Blueprint bg ── */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .bg-layer svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0.028;
        }

        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
        }

        .blob-1 {
            width: 600px; height: 600px;
            background: var(--navy);
            top: -200px; left: -150px;
            opacity: 0.06;
            animation: blobDrift 18s ease-in-out infinite;
        }

        .blob-2 {
            width: 400px; height: 400px;
            background: var(--amber);
            bottom: -100px; right: -80px;
            opacity: 0.04;
            animation: blobDrift 24s ease-in-out infinite reverse;
        }

        @keyframes blobDrift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(30px, -20px) scale(1.04); }
            66%       { transform: translate(-20px, 30px) scale(0.97); }
        }

        /* ── Main layout ── */
        .page {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
            position: relative;
            z-index: 1;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--slate-200);
            border-radius: 20px;
            width: 100%;
            max-width: 680px;
            overflow: hidden;
            box-shadow:
                0 1px 2px rgba(15,34,69,0.04),
                0 8px 32px rgba(15,34,69,0.08),
                0 32px 64px rgba(15,34,69,0.06);
            animation: cardEnter 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        @keyframes cardEnter {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Card header ── */
        .card-header {
            background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 60%, var(--navy-mid) 100%);
            padding: 2.5rem 2.5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 70% 20%, rgba(245,158,11,0.12) 0%, transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(255,255,255,0.04) 0%, transparent 40%);
        }

        /* Blueprint dot grid inside header */
        .card-header::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.12) 1px, transparent 1px);
            background-size: 24px 24px;
            opacity: 0.4;
        }

        .header-inner {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .logo-wrap {
            width: 64px;
            height: 64px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            animation: logoPulse 4s ease-in-out infinite;
        }

        @keyframes logoPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(245,158,11,0); }
            50%       { box-shadow: 0 0 0 8px rgba(245,158,11,0.12); }
        }

        .logo-wrap img {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }

        .logo-placeholder {
            width: 44px;
            height: 44px;
            border: 2px solid rgba(255,255,255,0.4);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.7);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .header-text {
            flex: 1;
        }

        .header-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            margin-bottom: 4px;
        }

        .header-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--white);
            line-height: 1.3;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(245,158,11,0.15);
            border: 1px solid rgba(245,158,11,0.3);
            border-radius: 20px;
            padding: 5px 12px;
            margin-top: 10px;
        }

        .badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--amber);
            animation: badgePulse 2s ease-in-out infinite;
        }

        @keyframes badgePulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.6; transform: scale(0.8); }
        }

        .badge-text {
            font-size: 11.5px;
            font-weight: 600;
            color: #FCD34D;
            letter-spacing: 0.03em;
        }

        /* ── Code display ── */
        .code-band {
            background: var(--slate-100);
            border-top: 1px solid var(--slate-200);
            border-bottom: 1px solid var(--slate-200);
            padding: 0.6rem 2.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .code-num {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--slate-400);
            letter-spacing: -1px;
            line-height: 1;
            user-select: none;
        }

        .code-sep {
            width: 1px;
            height: 18px;
            background: var(--slate-300);
            margin: 0 0.5rem;
        }

        .code-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--slate-400);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* ── Card body ── */
        .card-body {
            padding: 2rem 2.5rem 2.5rem;
        }

        /* Progress track */
        .progress-section {
            margin-bottom: 1.75rem;
        }

        .progress-track {
            height: 5px;
            background: var(--slate-100);
            border-radius: 99px;
            overflow: hidden;
            position: relative;
        }

        .progress-indeterminate {
            position: absolute;
            top: 0; bottom: 0;
            width: 45%;
            border-radius: 99px;
            background: linear-gradient(90deg, transparent, var(--navy), #3B82F6, var(--navy), transparent);
            animation: indeterminate 1.8s ease-in-out infinite;
        }

        @keyframes indeterminate {
            0%   { left: -50%; }
            100% { left: 110%; }
        }

        /* Message */
        .main-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--slate-800);
            line-height: 1.3;
            margin-bottom: 0.75rem;
            animation: fadeUp 0.6s 0.2s both;
        }

        .main-desc {
            font-size: 0.9375rem;
            color: var(--slate-600);
            line-height: 1.7;
            margin-bottom: 2rem;
            animation: fadeUp 0.6s 0.3s both;
        }

        .main-desc strong {
            color: var(--navy);
            font-weight: 600;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Info grid ── */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 2rem;
            animation: fadeUp 0.6s 0.4s both;
        }

        .info-tile {
            background: var(--slate-50);
            border: 1px solid var(--slate-200);
            border-radius: 14px;
            padding: 1rem;
            text-align: center;
            transition: border-color 0.2s, transform 0.2s;
        }

        .info-tile:hover {
            border-color: #CBD5E1;
            transform: translateY(-2px);
        }

        .tile-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .tile-icon svg {
            width: 18px;
            height: 18px;
        }

        .icon-amber { background: #FEF3C7; color: #B45309; }
        .icon-navy  { background: #EEF2FA; color: var(--navy); }
        .icon-green { background: #ECFDF5; color: #059669; }

        .tile-label {
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--slate-400);
            margin-bottom: 4px;
        }

        .tile-value {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--slate-800);
        }


        /* ── Divider ── */
        .divider {
            height: 1px;
            background: var(--slate-100);
            margin: 0 0 1.75rem;
            animation: fadeUp 0.6s 0.5s both;
        }

        /* ── Actions ── */
        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            animation: fadeUp 0.6s 0.6s both;
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
            transition: all 0.2s;
            text-decoration: none;
            border: none;
            font-family: 'Inter', sans-serif;
        }

        .btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .btn-primary {
            background: var(--navy);
            color: var(--white);
            box-shadow: 0 1px 3px rgba(27,58,107,0.25), 0 4px 12px rgba(27,58,107,0.15);
        }

        .btn-primary:hover {
            background: var(--navy-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(27,58,107,0.3), 0 8px 24px rgba(27,58,107,0.18);
        }

        .btn-primary:active { transform: translateY(0); }

        .btn-secondary {
            background: var(--white);
            color: var(--slate-800);
            border: 1px solid var(--slate-200);
        }

        .btn-secondary:hover {
            border-color: #CBD5E1;
            background: var(--slate-50);
            transform: translateY(-1px);
        }

        /* ── Toast notification ── */
        .toast {
            position: fixed;
            top: 1.25rem;
            left: 50%;
            transform: translateX(-50%) translateY(-12px);
            z-index: 100;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease, transform 0.3s ease;
            white-space: nowrap;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }

        .toast-inner {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--slate-800);
            color: var(--white);
            padding: 0.7rem 1.1rem 0.7rem 1rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }

        .toast-icon {
            width: 18px;
            height: 18px;
            color: #34D399;
            flex-shrink: 0;
        }

        .toast-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.5);
            cursor: pointer;
            padding: 0;
            margin-left: 4px;
            line-height: 1;
            display: flex;
            transition: color 0.15s;
        }

        .toast-close:hover { color: var(--white); }

        .toast-close svg {
            width: 14px;
            height: 14px;
        }

        /* ── Footer ── */
        .footer {
            text-align: center;
            padding: 1rem;
            position: relative;
            z-index: 1;
        }

        .footer p {
            font-size: 12px;
            color: var(--slate-400);
        }

        .footer span {
            font-weight: 500;
            color: var(--slate-600);
        }

        /* ── Responsive ── */
        @media (max-width: 600px) {
            .card-header { padding: 1.75rem 1.5rem 1.5rem; }
            .code-band   { padding: 0.5rem 1.5rem; }
            .card-body   { padding: 1.5rem 1.5rem 2rem; }
            .info-grid   { gap: 8px; }
            .actions     { flex-direction: column; }
            .btn         { justify-content: center; }
            .main-heading { font-size: 1.25rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; }
        }
    </style>
</head>
<body>

    <!-- Ambient background -->
    <div class="bg-layer" aria-hidden="true">
        <div class="bg-blob blob-1"></div>
        <div class="bg-blob blob-2"></div>
        <svg xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#1B3A6B" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>


    <!-- Main -->
    <main class="page" role="main">
        <div class="card">

            <!-- Header -->
            <div class="card-header">
                <div class="header-inner">
                    <div class="logo-wrap">
                        <img
                            src="https://fkm.unsri.ac.id/assets/kcfinder/upload/files/logo-unsri.png"
                            alt="Logo Universitas Sriwijaya"
                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                        >
                        <div class="logo-placeholder" style="display:none;">UNSRI</div>
                    </div>
                    <div class="header-text">
                        <p class="header-label">Universitas Sriwijaya</p>
                        <p class="header-title">Sistem Informasi Manajemen</p>
                        <div class="status-badge">
                            <span class="badge-dot"></span>
                            <span class="badge-text">Sedang dalam pemeliharaan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Code band -->
            <div class="code-band" aria-hidden="true">
                <span class="code-num">503</span>
                <span class="code-sep"></span>
                <span class="code-label">Service Unavailable</span>
            </div>

            <!-- Body -->
            <div class="card-body">

                <!-- Loading bar -->
                <div class="progress-section">
                    <div class="progress-track" role="status" aria-label="Sistem sedang dalam proses pemeliharaan">
                        <div class="progress-indeterminate"></div>
                    </div>
                </div>

                <h1 class="main-heading">Sistem sedang diperbarui</h1>

                <p class="main-desc">
                    <strong>Sistem Informasi Manajemen</strong> saat ini sedang dalam tahap pengembangan.
                    Tim teknis kami bekerja keras untuk mempersiapkannya dengan baik.
                    Mohon maaf atas ketidaknyamanan ini dan terima kasih atas kesabaran Anda.
                </p>

                <!-- Info tiles -->
                <div class="info-grid" aria-label="Informasi status sistem">
                    <div class="info-tile">
                        <div class="tile-icon icon-amber" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                            </svg>
                        </div>
                        <p class="tile-label">Status</p>
                        <p class="tile-value">Pemeliharaan</p>
                    </div>
                    <div class="info-tile">
                        <div class="tile-icon icon-green" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <p class="tile-label">Keamanan</p>
                        <p class="tile-value">Data Aman</p>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Actions -->
                <div class="actions">
                    <button class="btn btn-primary" onclick="handleNotify()" type="button" aria-label="Daftarkan notifikasi saat sistem kembali online">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                        Beritahu Saya
                    </button>
                    <a href="mailto:helpdesk@unsri.ac.id" class="btn btn-secondary" aria-label="Kirim email ke helpdesk Universitas Sriwijaya">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                        helpdesk@unsri.ac.id
                    </a>
                </div>

            </div><!-- /card-body -->
        </div><!-- /card -->
    </main>

    <!-- Toast notification -->
    <div class="toast" id="toast" role="alert" aria-live="assertive">
        <div class="toast-inner">
            <svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            <span>Kami akan memberitahu Anda saat sistem kembali online!</span>
            <button class="toast-close" onclick="closeToast()" aria-label="Tutup notifikasi">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
    </div>


    <!-- Footer -->
    <footer class="footer">
        <p>© <span id="year"></span> <span>Universitas Sriwijaya</span> · Semua hak dilindungi</p>
    </footer>

    <script>
        /* Year — JS fallback jika Blade tidak dirender */
        (function() {
            var el = document.getElementById('year');
            if (el) {
                var blade = '{{ date("Y") }}';
                el.textContent = /^\d{4}$/.test(blade) ? blade : new Date().getFullYear();
            }
        })();

        /* Toast */
        var _toastTimer = null;

        function handleNotify() {
            var toast = document.getElementById('toast');
            if (_toastTimer) clearTimeout(_toastTimer);
            toast.classList.add('show');
            _toastTimer = setTimeout(closeToast, 5000);
        }

        function closeToast() {
            document.getElementById('toast').classList.remove('show');
        }
    </script>

</body>
</html>