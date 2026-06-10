<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'SIM IKU') – Universitas Sriwijaya</title>
  <style>
    :root {
      --navy: #082a55;
      --navy-2: #0d3c78;
      --blue: #1168e8;
      --blue-soft: #eaf2ff;
      --green: #18a058;
      --green-soft: #e8f7ef;
      --red: #c1121f;
      --red-soft: #fdecef;
      --yellow: #f59e0b;
      --yellow-soft: #fff7e6;
      --purple: #7c3aed;
      --purple-soft: #f2ecff;
      --ink: #0f172a;
      --muted: #64748b;
      --line: #e5e7eb;
      --bg: #f6f8fb;
      --card: #ffffff;
      --shadow: 0 16px 36px rgba(15, 23, 42, 0.08);
      --radius: 18px;
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      background: var(--bg);
      color: var(--ink);
    }

    .app {
      display: grid;
      grid-template-columns: 292px 1fr;
      min-height: 100vh;
    }

    /* ── SIDEBAR ─────────────────────────────────────── */
    .sidebar {
      background: linear-gradient(180deg, #061d3f 0%, #0b3267 55%, #041936 100%);
      color: white;
      padding: 24px 18px;
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
    }

    .brand {
      display: flex;
      gap: 14px;
      align-items: center;
      padding: 4px 8px 24px;
      border-bottom: 1px solid rgba(255,255,255,.15);
      margin-bottom: 20px;
    }

    .logo {
      width: 48px; height: 48px; border-radius: 16px;
      background: radial-gradient(circle at 40% 35%, #fde047, #f59e0b 42%, #0b4aa2 44%, #0b4aa2 70%, #f8fafc 72%);
      box-shadow: 0 10px 24px rgba(0,0,0,.24);
      flex-shrink: 0;
    }

    .brand h1 { font-size: 20px; line-height: 1.05; margin: 0; letter-spacing: -.02em; }
    .brand p  { margin: 4px 0 0; font-size: 12px; color: #cbd5e1; }

    .nav-title {
      margin: 22px 10px 8px;
      color: #b7c8df;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: .08em;
    }

    .nav-item, .nav-parent {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      padding: 12px 12px;
      color: #e5edf8;
      border-radius: 12px;
      font-size: 14px;
      cursor: pointer;
      user-select: none;
      text-decoration: none;
    }

    .nav-item:hover, .nav-parent:hover { background: rgba(255,255,255,.1); }
    .nav-parent.open { background: rgba(17,104,232,.18); }
    .nav-item.active { background: var(--blue); color: white; box-shadow: 0 10px 24px rgba(17,104,232,.25); }

    .nav-children {
      margin: 4px 0 12px 18px;
      display: grid;
      gap: 3px;
      overflow: hidden;
      transition: max-height 0.25s ease;
    }
    .nav-children.collapsed { max-height: 0; margin: 0 0 0 18px; }

    .nav-children .nav-item { font-size: 13px; padding: 10px 12px; color: #dbeafe; }
    .nav-icon { width: 18px; display: inline-flex; justify-content: center; opacity: .95; }
    .nav-left { display: flex; align-items: center; gap: 10px; }
    .nav-arrow { transition: transform 0.2s; font-size: 11px; }
    .nav-parent.open .nav-arrow { transform: rotate(180deg); }

    /* ── MAIN ────────────────────────────────────────── */
    .main { min-width: 0; }

    .topbar {
      height: 78px;
      background: rgba(255,255,255,.88);
      backdrop-filter: blur(18px);
      border-bottom: 1px solid var(--line);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .crumb { display: flex; align-items: center; gap: 10px; color: var(--muted); font-size: 14px; }
    .crumb strong { color: var(--ink); }
    .top-actions { display: flex; align-items: center; gap: 14px; }

    .select, .btn {
      border: 1px solid var(--line);
      background: white;
      border-radius: 12px;
      padding: 11px 13px;
      color: var(--ink);
      min-height: 44px;
      font: inherit;
      cursor: pointer;
    }
    .select:focus, .btn:focus { outline: 2px solid var(--blue); outline-offset: 1px; }

    .avatar {
      width: 42px; height: 42px; border-radius: 999px;
      background: linear-gradient(135deg, #dbeafe, #1d4ed8);
      border: 3px solid white;
      box-shadow: 0 4px 16px rgba(0,0,0,.13);
      display: grid; place-items: center;
      color: white; font-size: 18px;
    }

    /* ── CONTENT ─────────────────────────────────────── */
    .content { padding: 28px 30px 48px; }

    .hero {
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 24px;
      margin-bottom: 22px;
      align-items: start;
    }
    .hero h2 { margin: 0 0 8px; font-size: 28px; line-height: 1.2; letter-spacing: -.03em; }
    .hero p   { color: var(--muted); margin: 0; max-width: 1050px; line-height: 1.55; }

    /* ── BADGES ──────────────────────────────────────── */
    .badge {
      display: inline-flex; align-items: center; gap: 6px;
      border-radius: 999px; padding: 6px 10px;
      font-size: 12px; font-weight: 700;
    }
    .badge.auto   { background: var(--green-soft); color: var(--green); }
    .badge.hybrid { background: var(--yellow-soft); color: #b45309; }
    .badge.manual { background: var(--blue-soft);   color: var(--blue); }
    .badge.draft  { background: var(--yellow-soft); color: #b45309; }
    .badge.valid  { background: var(--green-soft);  color: var(--green); }
    .badge.risk   { background: var(--red-soft);    color: var(--red); }

    /* ── NOTICE ──────────────────────────────────────── */
    .notice {
      border: 1px solid #bfdbfe;
      background: linear-gradient(90deg, #eff6ff, #ffffff);
      color: #1e40af;
      border-radius: var(--radius);
      padding: 15px 18px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 20px;
    }
    .notice strong { color: #1d4ed8; }
    .notice.hidden { display: none; }

    /* ── SUMMARY CARDS ───────────────────────────────── */
    .summary-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0,1fr));
      gap: 16px;
      margin-bottom: 20px;
    }

    .mini-card, .card {
      background: var(--card);
      border: 1px solid var(--line);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
    }
    .mini-card { padding: 18px; display: flex; align-items: center; justify-content: space-between; }
    .mini-card .label { color: var(--muted); font-size: 13px; }
    .mini-card .value { font-size: 26px; font-weight: 800; margin-top: 6px; letter-spacing: -.03em; }

    .icon-bubble {
      width: 54px; height: 54px; border-radius: 18px;
      display: grid; place-items: center; font-size: 24px;
    }
    .blue-bubble   { background: var(--blue-soft);   color: var(--blue); }
    .green-bubble  { background: var(--green-soft);  color: var(--green); }
    .yellow-bubble { background: var(--yellow-soft); color: var(--yellow); }
    .red-bubble    { background: var(--red-soft);    color: var(--red); }

    /* ── LAYOUT ──────────────────────────────────────── */
    .layout {
      display: grid;
      grid-template-columns: minmax(0, 1fr) 340px;
      gap: 20px;
      align-items: start;
    }

    /* ── CARD ────────────────────────────────────────── */
    .card { padding: 18px; margin-bottom: 20px; }
    .card-title {
      display: flex; align-items: center; justify-content: space-between;
      margin: 0 0 16px;
    }
    .card-title h3 { margin: 0; font-size: 17px; }
    .muted { color: var(--muted); }
    .small { font-size: 12px; }

    /* ── TABS ────────────────────────────────────────── */
    .tabs {
      display: flex; gap: 8px;
      border-bottom: 1px solid var(--line);
      margin-bottom: 18px;
      overflow-x: auto;
    }
    .tab {
      padding: 12px 14px;
      border-bottom: 3px solid transparent;
      color: var(--muted);
      font-weight: 700;
      font-size: 13px;
      white-space: nowrap;
      cursor: pointer;
    }
    .tab.active { color: var(--blue); border-color: var(--blue); }

    /* ── FORM ────────────────────────────────────────── */
    .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 14px; }
    .form-grid.three { grid-template-columns: repeat(3, minmax(0,1fr)); }
    .field label {
      display: block; font-weight: 700; font-size: 12px;
      margin-bottom: 7px; color: #334155;
    }
    .field input, .field select, .field textarea {
      width: 100%; border: 1px solid var(--line);
      background: white; border-radius: 12px;
      padding: 11px 12px; min-height: 44px;
      color: var(--ink); font: inherit;
    }
    .field textarea { min-height: 92px; resize: vertical; }

    .upload {
      border: 1.5px dashed #bfdbfe; background: #f8fbff;
      min-height: 80px; border-radius: 16px;
      display: grid; place-items: center; text-align: center;
      color: #2563eb; padding: 18px; font-size: 13px;
    }

    /* ── BUTTONS ─────────────────────────────────────── */
    .btn {
      display: inline-flex; align-items: center; justify-content: center;
      gap: 8px; font-weight: 800; font-size: 14px;
      cursor: pointer; text-decoration: none;
    }
    .btn.primary { background: var(--blue);  color: white; border-color: var(--blue); }
    .btn.red     { background: var(--red);   color: white; border-color: var(--red); }
    .btn.ghost   { background: white; color: var(--blue); }
    .btn:active  { transform: translateY(1px); }
    .actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 18px; flex-wrap: wrap; }

    /* ── TABLE ───────────────────────────────────────── */
    table { width: 100%; border-collapse: collapse; font-size: 13px; }
    th, td { padding: 13px 10px; border-bottom: 1px solid var(--line); text-align: left; vertical-align: middle; }
    th { color: #475569; font-size: 12px; background: #f8fafc; }
    tr:hover td { background: #fbfdff; }

    /* ── PROGRESS ────────────────────────────────────── */
    .progress { width: 100%; height: 9px; background: #e5e7eb; border-radius: 999px; overflow: hidden; }
    .progress span { display: block; height: 100%; background: var(--blue); border-radius: 999px; }
    .progress.green span  { background: var(--green); }
    .progress.yellow span { background: var(--yellow); }
    .progress.red span    { background: var(--red); }

    /* ── SIDEBAR CHARTS & LISTS ──────────────────────── */
    .quarter-chart {
      height: 220px; display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px; align-items: end;
      padding: 24px 12px 10px;
      border-left: 1px solid var(--line);
      border-bottom: 1px solid var(--line);
      background-image: linear-gradient(to top, rgba(226,232,240,.8) 1px, transparent 1px);
      background-size: 100% 44px;
    }
    .bar-wrap { text-align: center; font-size: 12px; color: var(--muted); }
    .bar {
      height: var(--h); min-height: 12px;
      border-radius: 10px 10px 3px 3px;
      background: linear-gradient(180deg, #60a5fa, #1168e8);
      margin: 0 auto 8px; width: 54%; position: relative;
    }
    .bar::before {
      content: attr(data-value);
      position: absolute; top: -22px;
      left: 50%; transform: translateX(-50%);
      color: var(--blue); font-weight: 800; font-size: 11px;
    }

    .side-stack { position: sticky; top: 98px; }
    .target-list { display: grid; gap: 10px; }
    .target-row {
      display: flex; justify-content: space-between;
      border-bottom: 1px solid var(--line);
      padding: 8px 0; font-size: 13px;
    }

    .timeline { display: grid; gap: 12px; }
    .time-row { display: grid; grid-template-columns: 26px 1fr auto; gap: 10px; align-items: center; font-size: 13px; }
    .dot { width: 22px; height: 22px; border-radius: 999px; display: grid; place-items: center; color: white; background: var(--green); font-size: 11px; }

    /* ── MISC ────────────────────────────────────────── */
    .split { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .readonly-table td:first-child { font-weight: 700; color: #334155; }

    /* ── RESPONSIVE ──────────────────────────────────── */
    @media (max-width: 1180px) {
      .app            { grid-template-columns: 1fr; }
      .sidebar        { position: static; height: auto; }
      .layout         { grid-template-columns: 1fr; }
      .summary-grid   { grid-template-columns: repeat(2, minmax(0,1fr)); }
      .side-stack     { position: static; }
    }
  </style>
</head>
<body>
<div class="app">

  {{-- ════════════════════ SIDEBAR ════════════════════ --}}
  <aside class="sidebar">
    <div class="brand">
      <div class="logo"></div>
      <div>
        <h1>SIM IKU</h1>
        <p>Universitas Sriwijaya</p>
      </div>
    </div>

    <a href="#" class="nav-item">
      <span class="nav-left"><span class="nav-icon">⌂</span> Dashboard</span>
    </a>
    <a href="#" class="nav-item">
      <span class="nav-left"><span class="nav-icon">◉</span> Perjanjian Kinerja</span>
    </a>
    <a href="#" class="nav-item">
      <span class="nav-left"><span class="nav-icon">▣</span> Capaian IKU</span>
    </a>

    <div class="nav-title">Input Data IKU</div>

    {{-- Grup: Talenta --}}
    <div class="nav-parent open" data-group="talenta">
      <span class="nav-left"><span class="nav-icon">✦</span> Talenta</span>
      <span class="nav-arrow">▲</span>
    </div>
    <div class="nav-children" id="group-talenta">
      <a href="{{ route('iku.satu') }}"
         class="nav-item {{ request()->routeIs('iku.satu') ? 'active' : '' }}">
        IKU 1 – AEE PT
      </a>
      <a href="#" class="nav-item">IKU 2 – Lulusan</a>
      <a href="#" class="nav-item">IKU 3 – Kegiatan/Prestasi Mahasiswa</a>
      <a href="#" class="nav-item">IKU 4 – Rekognisi Dosen</a>
    </div>

    {{-- Grup: Inovasi --}}
    <div class="nav-parent open" data-group="inovasi">
      <span class="nav-left"><span class="nav-icon">⚙</span> Inovasi</span>
      <span class="nav-arrow">▲</span>
    </div>
    <div class="nav-children" id="group-inovasi">
      <a href="#" class="nav-item">IKU 5 – Kerja Sama/Hilirisasi</a>
      <a href="#" class="nav-item">IKU 6 – Publikasi Scopus/WoS</a>
    </div>

    {{-- Grup: Kontribusi Masyarakat --}}
    <div class="nav-parent open" data-group="kontribusi">
      <span class="nav-left"><span class="nav-icon">◇</span> Kontribusi Masyarakat</span>
      <span class="nav-arrow">▲</span>
    </div>
    <div class="nav-children" id="group-kontribusi">
      <a href="#" class="nav-item">IKU 7 – SDGs</a>
      <a href="#" class="nav-item">IKU 8 – Penyusunan Kebijakan</a>
    </div>

    {{-- Grup: Tata Kelola --}}
    <div class="nav-parent open" data-group="tatakelola">
      <span class="nav-left"><span class="nav-icon">▰</span> Tata Kelola Berintegritas</span>
      <span class="nav-arrow">▲</span>
    </div>
    <div class="nav-children" id="group-tatakelola">
      <a href="#" class="nav-item">IKU 9 – Pendapatan Non-UKT</a>
      <a href="#" class="nav-item">IKU 10 – Zona Integritas</a>
      <a href="#" class="nav-item">IKU 11a – Opini Keuangan</a>
      <a href="#" class="nav-item">IKU 11b – SAKIP</a>
      <a href="#" class="nav-item">IKU 11c – Integritas Akademik</a>
      <a href="#" class="nav-item">IKU 11d – Anti Kekerasan/Narkoba/Korupsi</a>
      <a href="#" class="nav-item">IKU 12 – Kesejahteraan Dosen</a>
    </div>

    <div class="nav-title">Lainnya</div>
    <a href="#" class="nav-item"><span class="nav-left"><span class="nav-icon">▤</span> Eviden</span></a>
    <a href="#" class="nav-item"><span class="nav-left"><span class="nav-icon">✓</span> Validasi Direktorat</span></a>
    <a href="#" class="nav-item"><span class="nav-left"><span class="nav-icon">▥</span> Monitoring Triwulan</span></a>
    <a href="#" class="nav-item"><span class="nav-left"><span class="nav-icon">⚙</span> Pengaturan</span></a>
  </aside>

  {{-- ════════════════════ MAIN ════════════════════════ --}}
  <main class="main">

    {{-- Topbar --}}
    <header class="topbar">
      <div class="crumb">
        ☰ <span>@yield('crumb_parent', 'Input Data IKU')</span>
        <span>›</span>
        <strong>@yield('crumb_title', '–')</strong>
      </div>
      <div class="top-actions">
        <select class="select">
          <option>Fakultas Teknik</option>
          <option>Fakultas Ilmu Komputer</option>
          <option>Fakultas MIPA</option>
          <option>Universitas</option>
        </select>
        <select class="select">
          <option>2026</option>
          <option>2027</option>
        </select>
        <span style="font-size:20px;cursor:pointer">🔔</span>
        <div class="avatar">👤</div>
      </div>
    </header>

    {{-- Page content from child views --}}
    <div class="content">
      @yield('content')
    </div>

  </main>
</div>

<script>
  // ── Collapsible nav groups ─────────────────────────
  document.querySelectorAll('.nav-parent[data-group]').forEach(parent => {
    parent.addEventListener('click', () => {
      const id      = parent.dataset.group;
      const children = document.getElementById('group-' + id);
      const isOpen  = parent.classList.contains('open');

      if (isOpen) {
        parent.classList.remove('open');
        children.classList.add('collapsed');
      } else {
        parent.classList.add('open');
        children.classList.remove('collapsed');
      }
    });
  });
</script>
</body>
</html>