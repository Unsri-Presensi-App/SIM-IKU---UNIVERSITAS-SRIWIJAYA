<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masuk – SIM IKU Universitas Sriwijaya</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --navy-1:   #05172e;
      --navy-2:   #091f45;
      --navy-3:   #03101f;
      --navy-4:   #0d2d5e;
      --gold:     #f5b301;
      --gold-dk:  #d49a00;
      --gold-lt:  #fde68a;
      --indigo:   #4f46e5;
      --indigo-dk:#3730a3;
      --text:     #101828;
      --sub:      #344054;
      --muted:    #667085;
      --border:   #d0d5dd;
      --surface:  #ffffff;
      --danger:   #d92d20;
      --danger-bg:#fef3f2;
      --danger-br:#fecdca;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }

    body {
      font-family: 'Inter', system-ui, sans-serif;
      background-color: var(--navy-1);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      align-items: stretch;
      overflow: hidden;
    }

    /* ── Left panel ── */
    .panel-left {
      flex: 1;
      display: none;
      flex-direction: column;
      justify-content: space-between;
      padding: 48px 52px;
      background-color: var(--navy-2);
      position: relative;
      overflow: hidden;
    }

    @media (min-width: 900px) { .panel-left { display: flex; } }

    /* Subtle radial glow on left panel */
    .panel-left::before {
      content: '';
      position: absolute;
      width: 480px;
      height: 480px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(245,179,1,.13) 0%, transparent 70%);
      top: -100px;
      right: -100px;
      pointer-events: none;
    }
    .panel-left::after {
      content: '';
      position: absolute;
      width: 360px;
      height: 360px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(79,70,229,.12) 0%, transparent 70%);
      bottom: -80px;
      left: -60px;
      pointer-events: none;
    }

    .panel-brand {
      display: flex;
      align-items: center;
      gap: 14px;
      position: relative;
      z-index: 1;
    }
    .panel-brand img {
      width: 44px;
      height: 44px;
      object-fit: contain;
      filter: brightness(0) invert(1);
      opacity: .9;
    }
    .panel-brand-text {
      display: flex;
      flex-direction: column;
    }
    .panel-brand-text span:first-child {
      font-size: 15px;
      font-weight: 700;
      color: #ffffff;
      letter-spacing: -.01em;
    }
    .panel-brand-text span:last-child {
      font-size: 11.5px;
      color: rgba(255,255,255,.45);
      letter-spacing: .01em;
    }

    /* Illustration area */
    .panel-illustration {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      z-index: 1;
    }

    .panel-copy {
      position: relative;
      z-index: 1;
    }
    .panel-copy h2 {
      font-size: 26px;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: -.025em;
      line-height: 1.25;
      margin-bottom: 10px;
    }
    .panel-copy p {
      font-size: 13.5px;
      color: rgba(255,255,255,.45);
      line-height: 1.6;
      max-width: 320px;
    }

    /* Gold accent line */
    .panel-copy::before {
      content: '';
      display: block;
      width: 32px;
      height: 3px;
      background: var(--gold);
      border-radius: 2px;
      margin-bottom: 14px;
    }

    /* ── Right panel (login form) ── */
    .panel-right {
      width: 100%;
      max-width: 460px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 48px 44px;
      background-color: var(--surface);
      position: relative;
      overflow-y: auto;
    }

    @media (min-width: 900px) { .panel-right { min-height: 100vh; } }
    @media (max-width: 900px)  { .panel-right { max-width: 100%; margin: auto; } }
    @media (max-width: 540px)  { .panel-right { padding: 36px 24px; } }

    /* Top accent strip */
    .panel-right::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--indigo) 0%, var(--gold) 100%);
    }

    /* ── Form header ── */
    .form-header {
      margin-bottom: 36px;
    }
    .form-header .logo-row {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 28px;
    }
    .form-header .logo-row img {
      width: 52px;
      height: 52px;
      object-fit: contain;
    }
    .form-header .logo-row .logo-text span:first-child {
      display: block;
      font-size: 18px;
      font-weight: 800;
      color: var(--navy-2);
      letter-spacing: -.02em;
    }
    .form-header .logo-row .logo-text span:last-child {
      display: block;
      font-size: 11px;
      color: var(--muted);
      margin-top: 1px;
      letter-spacing: .01em;
    }

    .form-header h1 {
      font-size: 22px;
      font-weight: 800;
      color: var(--navy-2);
      letter-spacing: -.025em;
      margin-bottom: 6px;
    }
    .form-header p {
      font-size: 13.5px;
      color: var(--muted);
      line-height: 1.5;
    }

    /* Divider */
    .divider {
      height: 1px;
      background: var(--border);
      margin-bottom: 28px;
      opacity: .6;
    }

    /* ── Alert ── */
    .alert-error {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      background: var(--danger-bg);
      border: 1px solid var(--danger-br);
      color: var(--danger);
      font-size: 13px;
      font-weight: 500;
      padding: 11px 14px;
      border-radius: 10px;
      margin-bottom: 22px;
      line-height: 1.45;
    }
    .alert-error svg {
      flex-shrink: 0;
      margin-top: 1px;
    }

    /* ── Form fields ── */
    .form-group { margin-bottom: 18px; }
    .form-group label {
      display: block;
      font-size: 12.5px;
      font-weight: 600;
      color: var(--sub);
      margin-bottom: 7px;
      letter-spacing: .01em;
    }

    .input-wrap {
      position: relative;
    }
    .input-wrap svg {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      pointer-events: none;
    }
    .input-wrap input {
      width: 100%;
      height: 46px;
      padding: 0 14px 0 42px;
      font-size: 14.5px;
      font-family: inherit;
      color: var(--text);
      background: #fff;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      transition: border-color .15s, box-shadow .15s;
    }
    .input-wrap input::placeholder { color: #b0b7c3; }
    .input-wrap input:focus {
      outline: none;
      border-color: var(--indigo);
      box-shadow: 0 0 0 4px rgba(79,70,229,.10);
    }

/* Password toggle */
.input-wrap .toggle-pw {
  position: absolute;
  right: 13px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  color: var(--muted);
  padding: 4px; /* Area ekstra untuk mempermudah klik */
  display: flex;
  align-items: center;
  justify-content: center;
  line-height: 0;
  
  /* Tambahan: Beri ukuran tetap pada tombol */
  width: 32px;  /* Silakan sesuaikan angkanya */
  height: 32px; /* Silakan sesuaikan angkanya */
  transition: color .15s;
}

.input-wrap .toggle-pw svg {
  /* Tambahan: Paksa SVG menyesuaikan kotak tombol */
  width: 20px;  /* Ukuran aktual ikon mata */
  height: 20px;
  display: block;
  margin: 0;
  
  /* KUNCI UTAMA: Biarkan klik tembus langsung ke <button> */
  pointer-events: none; 
}

    /* ── Row: remember + forgot ── */
    .form-row-meta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
    }
    .form-remember {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--sub);
      cursor: pointer;
      user-select: none;
    }
    .form-remember input {
      width: 16px;
      height: 16px;
      accent-color: var(--indigo);
      cursor: pointer;
    }

    /* ── Submit button ── */
    .btn-login {
      width: 100%;
      height: 48px;
      font-size: 14.5px;
      font-weight: 700;
      font-family: inherit;
      color: #fff;
      background: var(--navy-2);
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background .15s, transform .08s, box-shadow .15s;
      box-shadow: 0 4px 14px rgba(9,31,69,.25);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      letter-spacing: .01em;
      position: relative;
      overflow: hidden;
    }
    /* Gold shimmer on hover */
    .btn-login::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, transparent 0%, rgba(245,179,1,.12) 50%, transparent 100%);
      transform: translateX(-100%);
      transition: transform .4s ease;
    }
    .btn-login:hover {
      background: var(--navy-4);
      box-shadow: 0 6px 18px rgba(9,31,69,.35);
    }
    .btn-login:hover::after { transform: translateX(100%); }
    .btn-login:active { transform: translateY(1px); }

    /* ── Divider with text ── */
    .or-divider {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 20px 0;
      font-size: 12px;
      color: var(--border);
    }
    .or-divider::before,
    .or-divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }
    .or-divider span { white-space: nowrap; color: var(--muted); }

    /* ── Footer ── */
    .login-foot {
      margin-top: 28px;
      padding-top: 20px;
      border-top: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .login-foot p {
      font-size: 11.5px;
      color: var(--muted);
      line-height: 1.5;
    }
    .foot-badge {
      font-size: 10px;
      font-weight: 600;
      letter-spacing: .05em;
      color: var(--gold-dk);
      background: #fefce8;
      border: 1px solid #fde68a;
      padding: 3px 8px;
      border-radius: 20px;
      white-space: nowrap;
    }

    /* ── Decorative SVG illustration on left panel ── */
    .ilu-wrap {
      width: 100%;
      max-width: 340px;
    }
  </style>
</head>
<body>

  {{-- ════════════════ LEFT PANEL ════════════════ --}}
  <div class="panel-left">

    {{-- Brand top --}}
    <div class="panel-brand">
      <img src="https://fkm.unsri.ac.id/assets/kcfinder/upload/files/logo-unsri.png" alt="Logo UNSRI">
      <div class="panel-brand-text">
        <span>Universitas Sriwijaya</span>
        <span>PALEMBANG · INDONESIA</span>
      </div>
    </div>

    {{-- Illustration --}}
    <div class="panel-illustration">
      <div class="ilu-wrap">
        <svg viewBox="0 0 340 280" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
          <defs>
            <style>
              .ilu-float-a{animation:iluA 5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
              .ilu-float-b{animation:iluB 6s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
              .ilu-float-c{animation:iluC 4.5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
              .ilu-bar{animation:iluBar 3s ease-in-out infinite}
              .ilu-bar2{animation:iluBar 3s ease-in-out infinite .6s}
              .ilu-bar3{animation:iluBar 3s ease-in-out infinite 1.2s}
              .ilu-dot{animation:iluDot 2s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
              .ilu-ring{animation:iluRing 3s ease-out infinite}
              @keyframes iluA{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
              @keyframes iluB{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}
              @keyframes iluC{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
              @keyframes iluBar{0%,100%{opacity:.4}50%{opacity:1}}
              @keyframes iluDot{0%,100%{transform:scale(1)}50%{transform:scale(1.4)}}
              @keyframes iluRing{0%{r:18;opacity:.5}100%{r:38;opacity:0}}
            </style>
          </defs>

          {{-- Dashboard card (main) --}}
          <g class="ilu-float-b">
            <rect x="60" y="60" width="220" height="155" rx="14" fill="rgba(255,255,255,.07)" stroke="rgba(255,255,255,.14)" stroke-width="1"/>
            {{-- Header bar --}}
            <rect x="60" y="60" width="220" height="36" rx="14" fill="rgba(255,255,255,.09)"/>
            <rect x="60" y="82" width="220" height="14" fill="rgba(255,255,255,.09)"/>
            {{-- 3 dots --}}
            <circle cx="82"  cy="78" r="4" fill="rgba(255,255,255,.25)"/>
            <circle cx="96"  cy="78" r="4" fill="rgba(255,255,255,.25)"/>
            <circle cx="110" cy="78" r="4" fill="rgba(255,255,255,.25)"/>
            {{-- Title line --}}
            <rect x="128" y="74" width="72" height="7" rx="3.5" fill="rgba(255,255,255,.18)"/>
            {{-- Metric cards inside --}}
            <rect x="76" y="107" width="56" height="40" rx="8" fill="rgba(245,179,1,.15)" stroke="rgba(245,179,1,.25)" stroke-width=".8"/>
            <rect x="142" y="107" width="56" height="40" rx="8" fill="rgba(79,70,229,.2)" stroke="rgba(79,70,229,.3)" stroke-width=".8"/>
            <rect x="208" y="107" width="56" height="40" rx="8" fill="rgba(34,197,94,.15)" stroke="rgba(34,197,94,.25)" stroke-width=".8"/>
            {{-- Numbers in metric cards --}}
            <rect x="84" y="116" width="28" height="8" rx="4" fill="rgba(245,179,1,.6)"/>
            <rect x="84" y="128" width="20" height="5" rx="2.5" fill="rgba(255,255,255,.2)"/>
            <rect x="150" y="116" width="28" height="8" rx="4" fill="rgba(255,255,255,.4)"/>
            <rect x="150" y="128" width="22" height="5" rx="2.5" fill="rgba(255,255,255,.2)"/>
            <rect x="216" y="116" width="28" height="8" rx="4" fill="rgba(34,197,94,.55)"/>
            <rect x="216" y="128" width="18" height="5" rx="2.5" fill="rgba(255,255,255,.2)"/>
            {{-- Chart bars --}}
            <rect x="80"  y="185" width="12" height="20" rx="3" fill="rgba(245,179,1,.5)"   class="ilu-bar"/>
            <rect x="98"  y="178" width="12" height="27" rx="3" fill="rgba(245,179,1,.7)"   class="ilu-bar2"/>
            <rect x="116" y="170" width="12" height="35" rx="3" fill="rgba(245,179,1,.9)"   class="ilu-bar3"/>
            <rect x="134" y="181" width="12" height="24" rx="3" fill="rgba(255,255,255,.35)" class="ilu-bar"/>
            <rect x="152" y="175" width="12" height="30" rx="3" fill="rgba(255,255,255,.25)" class="ilu-bar2"/>
            <rect x="170" y="168" width="12" height="37" rx="3" fill="rgba(79,70,229,.55)"   class="ilu-bar3"/>
            <rect x="188" y="173" width="12" height="32" rx="3" fill="rgba(79,70,229,.4)"    class="ilu-bar"/>
            <rect x="206" y="180" width="12" height="25" rx="3" fill="rgba(34,197,94,.4)"    class="ilu-bar2"/>
            <rect x="224" y="176" width="12" height="29" rx="3" fill="rgba(34,197,94,.6)"    class="ilu-bar3"/>
          </g>

          {{-- Floating mini chart card top-right --}}
          <g class="ilu-float-a" transform="translate(228,28)">
            <rect width="86" height="54" rx="10" fill="rgba(255,255,255,.08)" stroke="rgba(255,255,255,.15)" stroke-width=".8"/>
            <rect x="10" y="12" width="38" height="7" rx="3.5" fill="rgba(245,179,1,.5)"/>
            <rect x="10" y="24" width="28" height="5" rx="2.5" fill="rgba(255,255,255,.2)"/>
            <polyline points="10,44 22,36 34,40 46,30 58,34 70,24" fill="none" stroke="rgba(245,179,1,.7)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </g>

          {{-- Floating user badge bottom-left --}}
          <g class="ilu-float-c" transform="translate(22,190)">
            <rect width="90" height="48" rx="10" fill="rgba(255,255,255,.08)" stroke="rgba(255,255,255,.15)" stroke-width=".8"/>
            <circle cx="22" cy="24" r="11" fill="rgba(79,70,229,.45)"/>
            <rect x="38" y="14" width="38" height="6" rx="3" fill="rgba(255,255,255,.3)"/>
            <rect x="38" y="26" width="28" height="5" rx="2.5" fill="rgba(255,255,255,.15)"/>
            <circle cx="22" cy="24" r="18" fill="none" stroke="rgba(79,70,229,.4)" stroke-width="1" class="ilu-ring"/>
          </g>

          {{-- Floating notification dot --}}
          <g class="ilu-float-a">
            <circle cx="298" cy="156" r="5" fill="rgba(245,179,1,.8)" class="ilu-dot"/>
          </g>
          <circle cx="28" cy="68" r="3.5" fill="rgba(255,255,255,.12)"/>
          <circle cx="320" cy="220" r="4"   fill="rgba(79,70,229,.3)"/>
          <circle cx="42"  cy="248" r="2.5" fill="rgba(245,179,1,.25)"/>
        </svg>
      </div>
    </div>

    {{-- Copy bottom --}}
    <div class="panel-copy">
      <h2>Pantau kinerja<br>universitas secara<br>real-time.</h2>
      <p>Platform terpusat untuk memonitor dan melaporkan Indikator Kinerja Utama (IKU) Universitas Sriwijaya.</p>
    </div>

  </div>{{-- /panel-left --}}

  {{-- ════════════════ RIGHT PANEL ════════════════ --}}
  <div class="panel-right">

    <div class="form-header">
      <div class="logo-row">
        <img src="https://fkm.unsri.ac.id/assets/kcfinder/upload/files/logo-unsri.png" alt="Logo UNSRI">
        <div class="logo-text">
          <span>SIM IKU</span>
          <span>Universitas Sriwijaya</span>
        </div>
      </div>
      <h1>Selamat datang</h1>
      <p>Masuk untuk mengakses dasbor kinerja universitas.</p>
    </div>

    <div class="divider"></div>

    {{-- Error alert --}}
    @if ($errors->any())
      <div class="alert-error" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.attempt') }}">
      @csrf

      {{-- Email --}}
      <div class="form-group">
        <label for="email">Alamat Email</label>
        <div class="input-wrap">
          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 7l-10 7L2 7"/>
          </svg>
          <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="nama@unsri.ac.id"
            autocomplete="username"
            autofocus
            required
          />
        </div>
      </div>

      {{-- Password --}}
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <div class="input-wrap">
          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Kata sandi Anda"
            autocomplete="current-password"
            required
          />
          <button type="button" class="toggle-pw" onclick="togglePassword()" aria-label="Tampilkan / sembunyikan kata sandi">
            <svg id="ico-eye" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
            </svg>
          </button>
        </div>
      </div>

      {{-- Remember me --}}
      <div class="form-row-meta">
        <label class="form-remember">
          <input type="checkbox" name="remember" value="1">
          Ingat saya
        </label>
      </div>

      <button type="submit" class="btn-login">
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>
        </svg>
        Masuk ke Sistem
      </button>

    </form>

    {{-- Footer --}}
    <div class="login-foot">
      <p>&copy; {{ date('Y') }} Universitas Sriwijaya<br>Akses terbatas — hanya untuk staf berwenang.</p>
      <span class="foot-badge">SIM IKU v1</span>
    </div>

  </div>{{-- /panel-right --}}

  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      const ico   = document.getElementById('ico-eye');
      if (input.type === 'password') {
        input.type = 'text';
        ico.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
      } else {
        input.type = 'password';
        ico.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
      }
    }
  </script>

</body>
</html>