<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'SIM IKU') – Universitas Sriwijaya</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    /* ═══════════════════════════════════════════════
       TOKENS
    ═══════════════════════════════════════════════ */
    :root {
      --sb-w:       260px;
      --sb-w-col:   68px;
      --topbar-h:   64px;

      --sb-bg-1:    #05172e;
      --sb-bg-2:    #091f45;
      --sb-bg-3:    #03101f;

      --sb-text:    #c8d8f0;
      --sb-muted:   #7a96bc;
      --sb-line:    rgba(255,255,255,.07);
      --sb-hover:   rgba(255,255,255,.07);
      --sb-active:  #4f46e5;
      --sb-active2: rgba(79,70,229,.18);

      --bg:         #f7f8fc;
      --surface:    #ffffff;
      --border:     #eaecf0;
      --border-md:  #d0d5dd;
      --text:       #101828;
      --sub:        #344054;
      --muted:      #667085;
      --faint:      #98a2b3;

      --indigo:     #4f46e5;
      --indigo-lt:  #eef2ff;
      --indigo-dk:  #3730a3;

      --green:      #12b76a;
      --green-lt:   #ecfdf3;

      --r-sm: 6px;
      --r-md: 10px;
      --r-lg: 14px;

      --sh-sm: 0 1px 3px rgba(16,24,40,.06), 0 1px 2px rgba(16,24,40,.04);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body { height: 100%; }

    body {
      font-family: 'Inter', system-ui, sans-serif;
      background: var(--bg);
      color: var(--text);
      overflow: hidden;
    }

    /* ═══════════════════════════════════════════════
       APP SHELL
    ═══════════════════════════════════════════════ */
    .app-shell {
      display: flex;
      height: 100vh;
    }

    /* ═══════════════════════════════════════════════
       SIDEBAR
    ═══════════════════════════════════════════════ */
    .sidebar {
      width: var(--sb-w);
      min-width: var(--sb-w);
      background: linear-gradient(180deg, var(--sb-bg-1) 0%, var(--sb-bg-2) 50%, var(--sb-bg-3) 100%);
      display: flex;
      flex-direction: column;
      height: 100vh;
      overflow: hidden;
      position: relative;
      transition: width .28s cubic-bezier(.4,0,.2,1), min-width .28s cubic-bezier(.4,0,.2,1);
      flex-shrink: 0;
      z-index: 100;
    }

    .sidebar.collapsed {
      width: var(--sb-w-col);
      min-width: var(--sb-w-col);
    }

    /* ── Brand ── */
    .sb-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 20px 18px 18px;
      border-bottom: 1px solid var(--sb-line);
      flex-shrink: 0;
      overflow: hidden;
      min-height: 72px;
    }

    .sb-logo {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: #fff;
      padding: 3px;
      box-shadow: 0 6px 16px rgba(0,0,0,.3);
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .sb-logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
    }

    .sb-brand-text { overflow: hidden; transition: opacity .2s, width .2s; white-space: nowrap; }
    .sb-brand-text h1 { font-size: 16px; font-weight: 800; color: #fff; letter-spacing: -.02em; line-height: 1.1; }
    .sb-brand-text p  { font-size: 11px; color: var(--sb-muted); margin-top: 2px; }

    .sidebar.collapsed .sb-brand-text { opacity: 0; width: 0; pointer-events: none; }

    /* ── Toggle button ── */
    .sb-toggle {
      position: absolute;
      top: 20px;
      right: -13px;
      width: 26px;
      height: 26px;
      border-radius: 50%;
      background: var(--surface);
      border: 1.5px solid var(--border);
      box-shadow: var(--sh-sm);
      display: grid;
      place-items: center;
      cursor: pointer;
      z-index: 10;
      transition: background .15s, transform .28s;
      color: var(--muted);
    }
    .sb-toggle:hover { background: var(--indigo-lt); color: var(--indigo); border-color: #c7d2fe; }
    .sidebar.collapsed .sb-toggle { transform: rotate(180deg); }

    .sb-toggle svg { display: block; }

    /* ── Nav scroll area ── */
    .sb-nav {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 12px 10px 20px;
      scrollbar-width: thin;
      scrollbar-color: rgba(255,255,255,.08) transparent;
    }
    .sb-nav::-webkit-scrollbar { width: 4px; }
    .sb-nav::-webkit-scrollbar-track { background: transparent; }
    .sb-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 99px; }

    /* ── Section label ── */
    .sb-section-label {
      font-size: 9.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .1em;
      color: var(--sb-muted);
      padding: 16px 10px 6px;
      white-space: nowrap;
      overflow: hidden;
      transition: opacity .2s;
    }
    .sidebar.collapsed .sb-section-label { opacity: 0; }

    /* ── Nav item ── */
    .sb-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 10px;
      border-radius: var(--r-md);
      color: var(--sb-text);
      font-size: 13.5px;
      font-weight: 500;
      cursor: pointer;
      text-decoration: none;
      transition: background .15s, color .15s;
      white-space: nowrap;
      overflow: hidden;
      position: relative;
    }
    .sb-item:hover { background: var(--sb-hover); color: #fff; }
    .sb-item.active {
      background: var(--sb-active);
      color: #fff;
      font-weight: 600;
      box-shadow: 0 4px 16px rgba(79,70,229,.35);
    }
    .sb-item.active .sb-item-icon { color: #fff; }

    /* Icon */
    .sb-item-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
      color: var(--sb-muted);
      transition: color .15s, background .15s;
    }
    .sb-item:hover .sb-item-icon { color: #fff; }
    .sb-item.active .sb-item-icon { color: #fff; }

    /* Label */
    .sb-item-label {
      flex: 1;
      overflow: hidden;
      text-overflow: ellipsis;
      transition: opacity .2s;
      line-height: 1.3;
    }
    .sidebar.collapsed .sb-item-label { opacity: 0; width: 0; }

    /* Badge */
    .sb-badge {
      font-size: 9px;
      font-weight: 800;
      background: var(--green);
      color: #fff;
      border-radius: 99px;
      padding: 2px 6px;
      flex-shrink: 0;
      transition: opacity .2s;
    }
    .sidebar.collapsed .sb-badge { opacity: 0; }

    /* ── Nav group (accordion) ── */
    .sb-group { }

    .sb-group-head {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 10px;
      border-radius: var(--r-md);
      color: var(--sb-text);
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: background .15s, color .15s;
      white-space: nowrap;
      overflow: hidden;
      user-select: none;
    }
    .sb-group-head:hover { background: var(--sb-hover); color: #fff; }
    .sb-group-head.open  { background: rgba(79,70,229,.12); color: #fff; }

    .sb-group-head .sb-item-icon { color: var(--sb-muted); }
    .sb-group-head:hover .sb-item-icon,
    .sb-group-head.open  .sb-item-icon { color: #a5b4fc; }

    .sb-arrow {
      margin-left: auto;
      flex-shrink: 0;
      color: var(--sb-muted);
      transition: transform .22s, opacity .2s;
    }
    .sb-group-head.open .sb-arrow { transform: rotate(180deg); color: #a5b4fc; }
    .sidebar.collapsed .sb-arrow { opacity: 0; }

    /* Children */
    .sb-children {
      margin: 2px 0 4px 14px;
      padding-left: 14px;
      border-left: 1px solid rgba(255,255,255,.07);
      overflow: hidden;
      transition: max-height .25s cubic-bezier(.4,0,.2,1), opacity .2s;
    }
    .sb-children.closed { max-height: 0 !important; opacity: 0; }

    .sb-child {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 10px;
      border-radius: var(--r-sm);
      color: #94afd4;
      font-size: 12.5px;
      font-weight: 500;
      cursor: pointer;
      text-decoration: none;
      transition: background .15s, color .15s;
      white-space: nowrap;
      overflow: hidden;
    }
    .sb-child:hover { background: var(--sb-hover); color: #fff; }
    .sb-child.active {
      background: var(--sb-active2);
      color: #a5b4fc;
      font-weight: 600;
    }
    .sb-child-dot {
      width: 5px; height: 5px; border-radius: 50%;
      background: currentColor; flex-shrink: 0; opacity: .6;
    }
    .sb-child.active .sb-child-dot { opacity: 1; background: #a5b4fc; }

    .sb-child-label { overflow: hidden; text-overflow: ellipsis; transition: opacity .2s; }
    .sidebar.collapsed .sb-child-label { opacity: 0; }

    /* ── Collapsed tooltip ── */
    .sidebar.collapsed .sb-item { justify-content: center; }
    .sidebar.collapsed .sb-group-head { justify-content: center; }
    .sidebar.collapsed .sb-group-head .sb-item-label { opacity: 0; width: 0; }

    /* ── Bottom user area ── */
    .sb-bottom {
      padding: 12px 10px;
      border-top: 1px solid var(--sb-line);
      flex-shrink: 0;
    }
    .sb-user {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 10px;
      border-radius: var(--r-md);
      cursor: pointer;
      transition: background .15s;
      overflow: hidden;
    }
    .sb-user:hover { background: var(--sb-hover); }
    .sb-avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, #818cf8, #4f46e5);
      display: grid;
      place-items: center;
      color: #fff;
      font-size: 13px;
      font-weight: 700;
      flex-shrink: 0;
    }
    .sb-user-info { overflow: hidden; transition: opacity .2s; }
    .sb-user-name { font-size: 13px; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .sb-user-role { font-size: 11px; color: var(--sb-muted); white-space: nowrap; }
    .sidebar.collapsed .sb-user-info { opacity: 0; width: 0; }

    /* ── Tombol logout sidebar ── */
    .sb-logout {
      display: flex;
      align-items: center;
      gap: 10px;
      width: 100%;
      margin-top: 6px;
      padding: 9px 10px;
      border: none;
      border-radius: var(--r-md);
      background: transparent;
      color: var(--sb-muted);
      font-family: inherit;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: background .15s, color .15s;
      overflow: hidden;
      white-space: nowrap;
    }
    .sb-logout:hover { background: rgba(239,68,68,.12); color: #fca5a5; }
    .sb-logout svg { flex-shrink: 0; }
    .sb-logout .sb-logout-label { transition: opacity .2s, width .2s; }
    .sidebar.collapsed .sb-logout { justify-content: center; }
    .sidebar.collapsed .sb-logout .sb-logout-label { opacity: 0; width: 0; }

    /* ═══════════════════════════════════════════════
       MAIN AREA
    ═══════════════════════════════════════════════ */
    .main-area {
      flex: 1;
      min-width: 0;
      display: flex;
      flex-direction: column;
      height: 100vh;
      overflow: hidden;
    }

    /* ── Topbar ── */
    .topbar {
      height: var(--topbar-h);
      background: rgba(255,255,255,.92);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      flex-shrink: 0;
      z-index: 50;
      gap: 16px;
    }

    .crumb {
      display: flex;
      align-items: center;
      gap: 7px;
      font-size: 13px;
      color: var(--muted);
      min-width: 0;
    }
    .crumb svg { flex-shrink: 0; color: var(--faint); }
    .crumb-sep { color: var(--border-md); }
    .crumb-parent { color: var(--muted); font-weight: 500; white-space: nowrap; }
    .crumb-current { color: var(--text); font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    .topbar-right { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

    .tb-icon-btn {
      width: 36px; height: 36px; border-radius: 9px; border: 1px solid var(--border);
      background: var(--surface); display: grid; place-items: center; cursor: pointer;
      color: var(--muted); transition: all .15s; position: relative;
    }
    .tb-icon-btn:hover { background: var(--bg); border-color: var(--border-md); color: var(--text); }

    .notif-dot {
      position: absolute; top: 7px; right: 7px;
      width: 7px; height: 7px; border-radius: 50%;
      background: #f04438; border: 1.5px solid #fff;
    }

    .tb-avatar {
      width: 34px; height: 34px; border-radius: 50%;
      background: linear-gradient(135deg, #818cf8, #4f46e5);
      border: 2px solid #fff;
      box-shadow: 0 2px 8px rgba(79,70,229,.25);
      display: grid; place-items: center;
      color: #fff; font-size: 13px; font-weight: 700;
      cursor: pointer; flex-shrink: 0;
    }

    /* ── Content scroll ── */
    .content-wrap {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      scrollbar-width: thin;
      scrollbar-color: var(--border) transparent;
    }
    .content-wrap::-webkit-scrollbar { width: 5px; }
    .content-wrap::-webkit-scrollbar-track { background: transparent; }
    .content-wrap::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }

    .content { padding: 28px 28px 56px; }

    /* ═══════════════════════════════════════════════
       RESPONSIVE
    ═══════════════════════════════════════════════ */
    @media (max-width: 900px) {
      .sidebar {
        position: fixed;
        left: 0; top: 0;
        transform: translateX(-100%);
        transition: transform .28s cubic-bezier(.4,0,.2,1), width .28s;
        box-shadow: 8px 0 32px rgba(0,0,0,.18);
      }
      .sidebar.mobile-open {
        transform: translateX(0);
      }
      .sidebar.collapsed { width: var(--sb-w); min-width: var(--sb-w); transform: translateX(-100%); }
      .sb-toggle { display: none; }
      .mobile-overlay {
        display: none;
        position: fixed; inset: 0;
        background: rgba(5,23,46,.45);
        z-index: 99;
      }
      .mobile-overlay.active { display: block; }
    }

    @media (min-width: 901px) {
      .sb-mobile-toggle { display: none !important; }
      .mobile-overlay   { display: none !important; }
    }
  </style>

  @stack('styles')
</head>
<body>

<div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileSidebar()"></div>

<div class="app-shell">

  {{-- ═══════════════════ SIDEBAR ═══════════════════ --}}
  <aside class="sidebar" id="sidebar">

    {{-- Toggle (desktop) --}}
    <button class="sb-toggle" id="sbToggle" aria-label="Toggle sidebar">
      <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
    </button>

    {{-- Brand --}}
    <div class="sb-brand">
      <div class="sb-logo">
        <img src="{{ asset('images/logo-unsri.png') }}" alt="Logo Universitas Sriwijaya">
      </div>
      <div class="sb-brand-text">
        <h1>SIM IKU</h1>
        <p>Universitas Sriwijaya</p>
      </div>
    </div>

    {{-- Nav --}}
    <nav class="sb-nav">

      {{-- Top items --}}
      <a href="{{ url('/dashboard') }}"
         class="sb-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <span class="sb-item-icon">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
          </svg>
        </span>
        <span class="sb-item-label">Dashboard</span>
      </a>

      <a href="#" class="sb-item">
        <span class="sb-item-icon">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
          </svg>
        </span>
        <span class="sb-item-label">Perjanjian Kinerja</span>
      </a>

      <a href="#" class="sb-item">
        <span class="sb-item-icon">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
            <polyline points="16 7 22 7 22 13"/>
          </svg>
        </span>
        <span class="sb-item-label">Capaian IKU</span>
      </a>

      {{-- Section: Input Data IKU --}}
      <div class="sb-section-label">Input Data IKU</div>

      {{-- Grup: Talenta --}}
      <div class="sb-group">
        <div class="sb-group-head open" data-group="talenta">
          <span class="sb-item-icon">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </span>
          <span class="sb-item-label">Talenta</span>
          <svg class="sb-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </div>
        <div class="sb-children" id="group-talenta">
          <a href="{{ route('iku.satu') }}"
             class="sb-child {{ request()->routeIs('iku.satu') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 1 – AEE PT</span>
            <span class="sb-badge">Auto</span>
          </a>
          <a href="{{ route('iku.dua') }}"
             class="sb-child {{ request()->routeIs('iku.dua') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 2 – Lulusan</span>
          </a>
          <a href="{{ route('iku.tiga') }}"
             class="sb-child {{ request()->routeIs('iku.tiga') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 3 – Kegiatan / Prestasi</span>
          </a>
          <a href="{{ route('iku.empat') }}"
             class="sb-child {{ request()->routeIs('iku.empat') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 4 – Rekognisi Dosen</span>
          </a>
        </div>
      </div>

      {{-- Grup: Inovasi --}}
      <div class="sb-group">
        <div class="sb-group-head" data-group="inovasi">
          <span class="sb-item-icon">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="3"/>
              <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/>
            </svg>
          </span>
          <span class="sb-item-label">Inovasi</span>
          <svg class="sb-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </div>
        <div class="sb-children closed" id="group-inovasi">
          <a href="{{ route('iku.lima') }}"
             class="sb-child {{ request()->routeIs('iku.lima') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 5 – Kerja Sama / Hilirisasi</span>
          </a>
          <a href="{{ route('iku.enam') }}"
             class="sb-child {{ request()->routeIs('iku.enam') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 6 – Publikasi Scopus / WoS</span>
          </a>
        </div>
      </div>

      {{-- Grup: Kontribusi Masyarakat --}}
      <div class="sb-group">
        <div class="sb-group-head" data-group="kontribusi">
          <span class="sb-item-icon">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
              <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </span>
          <span class="sb-item-label">Kontribusi Masyarakat</span>
          <svg class="sb-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </div>
        <div class="sb-children closed" id="group-kontribusi">
          <a href="{{ route('iku.tujuh') }}"
             class="sb-child {{ request()->routeIs('iku.tujuh') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 7 – SDGs</span>
          </a>
          <a href="{{ route('iku.delapan') }}"
             class="sb-child {{ request()->routeIs('iku.delapan') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 8 – Penyusunan Kebijakan</span>
          </a>
        </div>
      </div>

      {{-- Grup: Tata Kelola --}}
      <div class="sb-group">
        <div class="sb-group-head" data-group="tatakelola">
          <span class="sb-item-icon">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
          </span>
          <span class="sb-item-label">Tata Kelola Berintegritas</span>
          <svg class="sb-arrow" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </div>
        <div class="sb-children closed" id="group-tatakelola">
          <a href="{{ route('iku.sembilan') }}"
             class="sb-child {{ request()->routeIs('iku.sembilan') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 9 – Pendapatan Non-UKT</span>
          </a>
          <a href="{{ route('iku.sepuluh') }}"
             class="sb-child {{ request()->routeIs('iku.sepuluh') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 10 – Zona Integritas</span>
          </a>
          <a href="{{ route('iku.sebelas') }}"
             class="sb-child {{ request()->routeIs('iku.sebelas') ? 'active' : '' }}">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 11a – Opini Keuangan</span>
          </a>
          <a href="#" class="sb-child">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 11b – SAKIP</span>
          </a>
          <a href="#" class="sb-child">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 11c – Integritas Akademik</span>
          </a>
          <a href="#" class="sb-child">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 11d – Anti Kekerasan / Korupsi</span>
          </a>
          <a href="#" class="sb-child">
            <span class="sb-child-dot"></span>
            <span class="sb-child-label">IKU 12 – Kesejahteraan Dosen</span>
          </a>
        </div>
      </div>

      {{-- Section: Lainnya --}}
      <div class="sb-section-label">Lainnya</div>

      <a href="#" class="sb-item">
        <span class="sb-item-icon">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/>
            <polyline points="13 2 13 9 20 9"/>
          </svg>
        </span>
        <span class="sb-item-label">Eviden</span>
      </a>

      <a href="#" class="sb-item">
        <span class="sb-item-icon">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </span>
        <span class="sb-item-label">Validasi Direktorat</span>
      </a>

      <a href="#" class="sb-item">
        <span class="sb-item-icon">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
        </span>
        <span class="sb-item-label">Monitoring Triwulan</span>
      </a>

      <a href="#" class="sb-item">
        <span class="sb-item-icon">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="3"/>
            <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
          </svg>
        </span>
        <span class="sb-item-label">Pengaturan</span>
      </a>

    </nav>

    {{-- Bottom user --}}
    <div class="sb-bottom">
      @php
        $namaUser = auth()->user()->name ?? 'Admin UNSRI';
        $inisial  = strtoupper(mb_substr($namaUser, 0, 1));
      @endphp
      <div class="sb-user">
        <div class="sb-avatar">{{ $inisial }}</div>
        <div class="sb-user-info">
          <div class="sb-user-name">{{ $namaUser }}</div>
          <div class="sb-user-role">Administrator</div>
        </div>
      </div>

      {{-- Logout (POST + CSRF) --}}
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="sb-logout">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
          </svg>
          <span class="sb-logout-label">Keluar</span>
        </button>
      </form>
    </div>

  </aside>

  {{-- ═══════════════════ MAIN ═══════════════════════ --}}
  <div class="main-area">

    {{-- Topbar --}}
    <header class="topbar">
      <div style="display:flex; align-items:center; gap:12px; min-width:0;">
        {{-- Mobile hamburger --}}
        <button class="tb-icon-btn sb-mobile-toggle" onclick="openMobileSidebar()" aria-label="Menu">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
          </svg>
        </button>

        {{-- Breadcrumb --}}
        <div class="crumb">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
          </svg>
          <span class="crumb-parent">@yield('crumb_parent', 'Home')</span>
          <span class="crumb-sep">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
          </span>
          <span class="crumb-current">@yield('crumb_title', '–')</span>
        </div>
      </div>

      <div class="topbar-right">
        {{-- Notification --}}
        <button class="tb-icon-btn" aria-label="Notifikasi">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
          </svg>
          <span class="notif-dot"></span>
        </button>

        {{-- Help --}}
        <button class="tb-icon-btn" aria-label="Bantuan">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
        </button>

        {{-- Divider --}}
        <div style="width:1px; height:22px; background:var(--border); flex-shrink:0;"></div>

        {{-- Avatar --}}
        <div class="tb-avatar" title="{{ auth()->user()->name ?? 'Admin UNSRI' }}">{{ strtoupper(mb_substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
      </div>
    </header>

    {{-- Scrollable content --}}
    <div class="content-wrap">
      <div class="content">
        @yield('content')
      </div>
    </div>

  </div>
</div>

<script>
  /* ── Desktop sidebar toggle ── */
  const sidebar  = document.getElementById('sidebar');
  const sbToggle = document.getElementById('sbToggle');

  // Restore state
  if (localStorage.getItem('sb-collapsed') === '1') {
    sidebar.classList.add('collapsed');
  }

  sbToggle.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    localStorage.setItem('sb-collapsed', sidebar.classList.contains('collapsed') ? '1' : '0');
  });

  /* ── Mobile sidebar ── */
  function openMobileSidebar() {
    sidebar.classList.add('mobile-open');
    document.getElementById('mobileOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
  }
  function closeMobileSidebar() {
    sidebar.classList.remove('mobile-open');
    document.getElementById('mobileOverlay').classList.remove('active');
    document.body.style.overflow = '';
  }

  /* ── Accordion nav groups ── */
  document.querySelectorAll('.sb-group-head[data-group]').forEach(head => {
    const key      = head.dataset.group;
    const children = document.getElementById('group-' + key);

    // Measure natural height for smooth animation
    function openGroup() {
      head.classList.add('open');
      children.classList.remove('closed');
      children.style.maxHeight = children.scrollHeight + 'px';
      children.style.opacity   = '1';
    }
    function closeGroup() {
      head.classList.remove('open');
      children.style.maxHeight = '0';
      children.style.opacity   = '0';
      setTimeout(() => children.classList.add('closed'), 250);
    }

    // Init: if open by default, set height
    if (head.classList.contains('open')) {
      children.style.maxHeight = children.scrollHeight + 'px';
      children.style.opacity   = '1';
    }

    head.addEventListener('click', () => {
      if (head.classList.contains('open')) {
        closeGroup();
      } else {
        openGroup();
      }
    });
  });

  /* ── Sidebar collapsed: disable accordions ── */
  sbToggle.addEventListener('click', () => {
    if (sidebar.classList.contains('collapsed')) {
      // When collapsing, open all groups so content is visible on hover
      document.querySelectorAll('.sb-group-head[data-group]').forEach(head => {
        const key      = head.dataset.group;
        const children = document.getElementById('group-' + key);
        children.style.maxHeight = children.scrollHeight + 'px';
      });
    }
  });
</script>

@stack('scripts')

</body>
</html>