@extends('layouts.app')

@section('title', 'Dashboard Eksekutif SIM IKU')
@section('crumb_parent', 'Home')
@section('crumb_title',  'Dashboard')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root {
    --bg:        #f7f8fc;
    --surface:   #ffffff;
    --border:    #eaecf0;
    --border-md: #d0d5dd;
    --text:      #101828;
    --sub:       #344054;
    --muted:     #667085;
    --faint:     #98a2b3;

    --indigo:    #4f46e5;
    --indigo-lt: #eef2ff;
    --indigo-dk: #3730a3;

    --green:     #12b76a;
    --green-lt:  #ecfdf3;
    --green-dk:  #027a48;

    --amber:     #f79009;
    --amber-lt:  #fffaeb;
    --amber-dk:  #b54708;

    --red:       #f04438;
    --red-lt:    #fef3f2;
    --red-dk:    #b42318;

    --purple:    #7c3aed;
    --purple-lt: #f5f3ff;

    --r-sm:  8px;
    --r-md:  12px;
    --r-lg:  16px;
    --r-xl:  20px;

    --sh-xs: 0 1px 2px rgba(16,24,40,.04);
    --sh-sm: 0 1px 3px rgba(16,24,40,.06), 0 1px 2px rgba(16,24,40,.04);
    --sh-md: 0 4px 8px -2px rgba(16,24,40,.06), 0 2px 4px -2px rgba(16,24,40,.04);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body { font-family: 'Inter', system-ui, sans-serif; background: var(--bg); color: var(--text); }

  /* ─── Page Shell ─── */
  .dash-shell { max-width: 1480px; padding: 0; }

  /* ─── Page Header ─── */
  .ph { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; gap: 16px; flex-wrap: wrap; }
  .ph-left { display: flex; flex-direction: column; gap: 2px; }
  .ph-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--indigo); margin-bottom: 4px; }
  .ph-title { font-size: 22px; font-weight: 700; letter-spacing: -.025em; color: var(--text); line-height: 1.2; }
  .ph-sub { font-size: 13px; color: var(--muted); font-weight: 400; margin-top: 2px; }
  .ph-right { display: flex; align-items: center; gap: 10px; }

  .status-pill { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: var(--surface); border: 1px solid var(--border); border-radius: 99px; font-size: 12px; font-weight: 600; color: var(--sub); }
  .pulse { width: 6px; height: 6px; border-radius: 50%; background: var(--green); box-shadow: 0 0 0 2px var(--green-lt); animation: pulse 2.4s ease infinite; flex-shrink: 0; }
  @keyframes pulse { 0%,100%{box-shadow:0 0 0 2px var(--green-lt)} 50%{box-shadow:0 0 0 4px #86efac33} }

  .year-sel { padding: 8px 14px; border-radius: var(--r-md); border: 1px solid var(--border-md); background: var(--surface); color: var(--text); font-size: 13px; font-weight: 600; font-family: inherit; cursor: pointer; outline: none; transition: border-color .15s, box-shadow .15s; appearance: none; -webkit-appearance: none; padding-right: 32px; background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 7L11 1' stroke='%23667085' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; }
  .year-sel:hover { border-color: var(--border-md); }
  .year-sel:focus { border-color: var(--indigo); box-shadow: 0 0 0 3px rgba(79,70,229,.12); }

  /* ─── Badge ─── */
  .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 99px; font-size: 11px; font-weight: 700; letter-spacing: .02em; white-space: nowrap; }
  .badge-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
  .badge.good   { background: var(--green-lt); color: var(--green-dk); }
  .badge.warn   { background: var(--amber-lt); color: var(--amber-dk); }
  .badge.crit   { background: var(--red-lt);   color: var(--red-dk);   }
  .badge.info   { background: var(--indigo-lt);color: var(--indigo-dk);}

  /* ─── Grids ─── */
  .g4   { display: grid; grid-template-columns: repeat(4,minmax(0,1fr)); gap: 16px; margin-bottom: 20px; }
  .g3   { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 16px; margin-bottom: 20px; }
  .g65  { display: grid; grid-template-columns: 1.85fr 1fr; gap: 16px; margin-bottom: 20px; }

  /* ─── Card Base ─── */
  .card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); box-shadow: var(--sh-sm); padding: 24px; display: flex; flex-direction: column; }

  /* ─── Metric Cards ─── */
  .mc { gap: 0; }
  .mc-top { display: flex; justify-content: space-between; align-items: flex-start; }
  .mc-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--faint); }
  .mc-icon { width: 40px; height: 40px; border-radius: 10px; display: grid; place-items: center; flex-shrink: 0; }
  .ic-indigo { background: var(--indigo-lt); color: var(--indigo); }
  .ic-green  { background: var(--green-lt);  color: var(--green);  }
  .ic-amber  { background: var(--amber-lt);  color: var(--amber);  }
  .ic-purple { background: var(--purple-lt); color: var(--purple); }
  .mc-value { font-size: 30px; font-weight: 800; letter-spacing: -.045em; color: var(--text); line-height: 1; margin-top: 14px; }
  .mc-value-row { display: flex; align-items: baseline; gap: 4px; flex-wrap: wrap; margin-top: 14px; }
  .mc-num { font-size: 16px; font-weight: 800; letter-spacing: -.02em; line-height: 1.1; }
  .mc-lbl { font-size: 12px; font-weight: 500; color: var(--muted); }
  .mc-status { margin-top: 14px; display: flex; align-items: center; gap: 7px; font-size: 14px; font-weight: 700; color: var(--text); }

  /* ─── Divider ─── */
  .hr { height: 1px; background: var(--border); margin: 16px 0; }

  /* ─── Section heading inside card ─── */
  .ch { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
  .ch-left { display: flex; align-items: center; gap: 8px; }
  .ch-icon { width: 28px; height: 28px; border-radius: 7px; background: var(--indigo-lt); display: grid; place-items: center; flex-shrink: 0; }
  .ch-icon svg { color: var(--indigo); }
  .ch-title { font-size: 14px; font-weight: 700; color: var(--text); letter-spacing: -.01em; }

  /* ─── Dimension Cards ─── */
  .dim-ew { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--faint); margin-bottom: 3px; }
  .dim-t  { font-size: 13px; font-weight: 600; color: var(--sub); margin-bottom: 16px; }
  .dim-v  { font-size: 28px; font-weight: 800; letter-spacing: -.045em; color: var(--text); line-height: 1; margin-bottom: 14px; }
  .prog   { height: 4px; background: var(--border); border-radius: 99px; overflow: hidden; }
  .prog-f { height: 100%; border-radius: 99px; transition: width .5s ease; }

  /* ─── Table ─── */
  .tbl-wrap { overflow-x: auto; margin: 0 -24px; padding: 0 24px; }
  table { width: 100%; border-collapse: collapse; font-size: 13px; }
  thead th { padding: 8px 12px; border-bottom: 1px solid var(--border); font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--faint); text-align: left; white-space: nowrap; background: transparent; }
  thead th:first-child { padding-left: 0; }
  thead th:last-child  { padding-right: 0; }
  tbody td { padding: 14px 12px; border-bottom: 1px solid #f2f4f7; color: var(--sub); vertical-align: middle; }
  tbody td:first-child { padding-left: 0; }
  tbody td:last-child  { padding-right: 0; }
  tbody tr:last-child td { border-bottom: none; }
  tbody tr:hover td { background: var(--bg); }

  .code-chip { font-family: 'SF Mono', 'Cascadia Code', 'Consolas', monospace; font-size: 11px; background: var(--bg); border: 1px solid var(--border); padding: 3px 8px; border-radius: 6px; font-weight: 700; color: var(--sub); white-space: nowrap; }

  /* ─── Buttons ─── */
  .btn { padding: 8px 16px; border-radius: var(--r-md); border: 1px solid var(--border-md); background: var(--surface); color: var(--sub); font-size: 13px; font-weight: 600; cursor: pointer; transition: all .16s; font-family: inherit; line-height: 1; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap; }
  .btn:hover { background: var(--bg); border-color: var(--border-md); color: var(--text); }
  .btn-primary { background: var(--indigo); color: #fff; border-color: var(--indigo); }
  .btn-primary:hover { background: var(--indigo-dk); border-color: var(--indigo-dk); color: #fff; }
  .btn-sm { padding: 6px 12px; font-size: 12px; }
  .btn-ghost { border-color: transparent; background: transparent; }
  .btn-ghost:hover { background: var(--bg); border-color: var(--border); }

  /* ─── Empty state ─── */
  .empty { padding: 40px 24px; text-align: center; background: linear-gradient(135deg, var(--green-lt) 0%, #f0fdf4 100%); border-radius: var(--r-lg); border: 1px dashed #86efac; }
  .empty-ic { width: 44px; height: 44px; border-radius: 50%; background: var(--green-lt); border: 1px solid #86efac; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; }
  .empty-ic svg { color: var(--green); }
  .empty-t { font-size: 14px; font-weight: 700; color: var(--green-dk); margin-bottom: 4px; }
  .empty-d { font-size: 12px; color: #15803d; }

  /* ─── Timeline ─── */
  .tl { display: flex; flex-direction: column; }
  .tl-item { display: flex; gap: 12px; padding-bottom: 20px; position: relative; }
  .tl-item:last-child { padding-bottom: 0; }
  .tl-spine { display: flex; flex-direction: column; align-items: center; flex-shrink: 0; }
  .tl-dot { width: 26px; height: 26px; border-radius: 50%; background: var(--indigo-lt); border: 1.5px solid #c7d2fe; display: grid; place-items: center; flex-shrink: 0; }
  .tl-dot svg { color: var(--indigo); }
  .tl-line { flex: 1; width: 1px; background: var(--border); margin-top: 5px; }
  .tl-item:last-child .tl-line { display: none; }
  .tl-body { padding-top: 3px; }
  .tl-time { font-size: 11px; color: var(--faint); font-weight: 600; margin-bottom: 2px; letter-spacing: .01em; }
  .tl-desc { font-size: 13px; color: var(--sub); line-height: 1.55; }

  /* ─── Modals ─── */
  .mo { display: none; position: fixed; z-index: 9999; inset: 0; background: rgba(16,24,40,.5); backdrop-filter: blur(8px); align-items: center; justify-content: center; opacity: 0; transition: opacity .22s; padding: 20px; }
  .mo.active { display: flex; opacity: 1; }
  .mb { background: var(--surface); width: 100%; max-width: 940px; border-radius: var(--r-xl); padding: 0; box-shadow: 0 24px 48px -12px rgba(16,24,40,.18), 0 0 0 1px var(--border); max-height: 88vh; overflow-y: auto; transform: translateY(12px); transition: transform .22s; position: relative; }
  .mo.active .mb { transform: translateY(0); }
  .mb-narrow { max-width: 580px; }

  .mh { padding: 28px 28px 20px; border-bottom: 1px solid var(--border); position: sticky; top: 0; background: var(--surface); border-radius: var(--r-xl) var(--r-xl) 0 0; z-index: 1; display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; }
  .mh-text h3 { font-size: 18px; font-weight: 700; letter-spacing: -.02em; color: var(--text); margin-bottom: 3px; }
  .mh-text p { font-size: 13px; color: var(--muted); }
  .mc-body { padding: 24px 28px 28px; }
  .modal-close { width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--border); background: var(--surface); color: var(--muted); cursor: pointer; display: grid; place-items: center; flex-shrink: 0; transition: all .15s; }
  .modal-close:hover { background: var(--red-lt); border-color: #fda29b; color: var(--red); }

  /* ─── Alert banner ─── */
  .alert-crit { background: var(--red-lt); border-left: 3px solid var(--red); padding: 14px 16px; border-radius: var(--r-sm); margin-bottom: 20px; }
  .alert-crit h4 { font-size: 13px; font-weight: 700; color: var(--red-dk); margin-bottom: 3px; }
  .alert-crit p  { font-size: 13px; color: #b91c1c; }

  /* ─── Recomendation list ─── */
  .rec-list { padding-left: 16px; margin-bottom: 24px; }
  .rec-list li { font-size: 13px; color: var(--muted); line-height: 1.75; }

  /* ─── Highlight number ─── */
  .hl-num { font-size: 15px; font-weight: 700; color: var(--red); }

  /* ─── Responsive ─── */
  @media (max-width: 1200px) {
    .g4, .g3 { grid-template-columns: repeat(2,1fr); }
    .g65     { grid-template-columns: 1fr; }
  }
  @media (max-width: 640px) {
    .g4, .g3 { grid-template-columns: 1fr; }
    .ph { flex-direction: column; align-items: flex-start; }
    .card { padding: 18px; }
    .mh, .mc-body { padding: 20px; }
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">SIM IKU · {{ $selectedTahun }}</div>
    <div class="ph-title">Dashboard Kinerja Utama</div>
    <div class="ph-sub">Pantauan eksekutif realisasi Indikator Kinerja Utama tahun berjalan.</div>
  </div>
  <div class="ph-right">
    <div class="status-pill">
      <span class="pulse"></span>
      Sinkron
    </div>
    <form method="GET" id="formDashboard">
      <select name="tahun" class="year-sel" onchange="document.getElementById('formDashboard').submit();">
        <option value="2026" {{ $selectedTahun == '2026' ? 'selected' : '' }}>Tahun 2026</option>
        <option value="2025" {{ $selectedTahun == '2025' ? 'selected' : '' }}>Tahun 2025</option>
      </select>
    </form>
  </div>
</section>

{{-- ── 1. KARTU RINGKASAN ── --}}
<div class="g4">

  {{-- Rata-Rata Capaian --}}
  <div class="card mc">
    <div class="mc-top">
      <span class="mc-label">Rata-Rata Capaian IKU</span>
      <div class="mc-icon ic-indigo">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>
        </svg>
      </div>
    </div>
    <div class="mc-value">{{ number_format($rata_rata_pt, 1, ',', '.') }}<span style="font-size:16px; font-weight:600; color:var(--muted); letter-spacing:0;">%</span></div>
  </div>

  {{-- Status Indikator --}}
  <div class="card mc">
    <div class="mc-top">
      <span class="mc-label">Status Indikator</span>
      <div class="mc-icon ic-green">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
        </svg>
      </div>
    </div>
    <div class="mc-value-row">
      <span class="mc-num" style="color:var(--green);">{{ $aman }}</span><span class="mc-lbl">Aman</span>
      <span style="color:var(--border-md); font-size:14px; margin: 0 2px;">·</span>
      <span class="mc-num" style="color:var(--amber);">{{ $mendekati }}</span><span class="mc-lbl">Mendekati</span>
      <span style="color:var(--border-md); font-size:14px; margin: 0 2px;">·</span>
      <span class="mc-num" style="color:var(--red);">{{ $kritis }}</span><span class="mc-lbl">Kritis</span>
    </div>
  </div>

  {{-- Menunggu Validasi --}}
  <div class="card mc">
    <div class="mc-top">
      <span class="mc-label">Menunggu Validasi</span>
      <div class="mc-icon ic-amber">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="11" x2="12" y2="17"/><line x1="9" y1="14" x2="15" y2="14"/>
        </svg>
      </div>
    </div>
    <div class="mc-value">0 <span style="font-size:14px; font-weight:500; color:var(--muted); letter-spacing:0;">Dokumen</span></div>
  </div>

  {{-- Status Data Lake --}}
  <div class="card mc">
    <div class="mc-top">
      <span class="mc-label">Status Data Lake</span>
      <div class="mc-icon ic-purple">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
        </svg>
      </div>
    </div>
    <div class="mc-status">
      <span class="pulse"></span>
      Aktif &amp; Sinkron
    </div>
  </div>

</div>

{{-- ── 2. TIGA DIMENSI IKU ── --}}
<div class="g3">

  <div class="card">
    <div class="dim-ew">Dimensi 1</div>
    <div class="dim-t">Kualitas Lulusan</div>
    <div class="dim-v">{{ number_format($dimensi['lulusan'], 1, ',', '.') }}%</div>
    <div class="prog"><div class="prog-f" style="width:{{ min($dimensi['lulusan'], 100) }}%; background:var(--indigo);"></div></div>
  </div>

  <div class="card">
    <div class="dim-ew">Dimensi 2</div>
    <div class="dim-t">Kualitas Dosen</div>
    <div class="dim-v">{{ number_format($dimensi['dosen'], 1, ',', '.') }}%</div>
    <div class="prog"><div class="prog-f" style="width:{{ min($dimensi['dosen'], 100) }}%; background:var(--amber);"></div></div>
  </div>

  <div class="card">
    <div class="dim-ew">Dimensi 3</div>
    <div class="dim-t">Kurikulum &amp; Tata Kelola</div>
    <div class="dim-v">{{ number_format($dimensi['kurikulum'], 1, ',', '.') }}%</div>
    <div class="prog"><div class="prog-f" style="width:{{ min($dimensi['kurikulum'], 100) }}%; background:var(--green);"></div></div>
  </div>

</div>

{{-- ── 3. GRAFIK ── --}}
<div class="g65">

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/>
          </svg>
        </div>
        <span class="ch-title">Capaian vs Target 12 IKU <span style="color:var(--muted); font-weight:500;">({{ $selectedTahun }})</span></span>
      </div>
    </div>
    <div style="height:296px; width:100%; position:relative;">
      <canvas id="barChart"></canvas>
    </div>
  </div>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/><path d="M12 2a10 10 0 0 1 10 10H12z"/>
          </svg>
        </div>
        <span class="ch-title">Distribusi Status</span>
      </div>
    </div>
    <div style="flex:1; display:flex; align-items:center; justify-content:center; min-height:200px;">
      <canvas id="donutChart" style="max-height:210px;"></canvas>
    </div>
    <div class="hr"></div>
    <div style="display:flex; justify-content:center; gap:18px; flex-wrap:wrap;">
      <div style="display:flex; align-items:center; gap:6px; font-size:12px; font-weight:600; color:var(--muted);">
        <span style="width:8px;height:8px;border-radius:3px;background:var(--green);display:inline-block;"></span>Tercapai
      </div>
      <div style="display:flex; align-items:center; gap:6px; font-size:12px; font-weight:600; color:var(--muted);">
        <span style="width:8px;height:8px;border-radius:3px;background:var(--amber);display:inline-block;"></span>Mendekati
      </div>
      <div style="display:flex; align-items:center; gap:6px; font-size:12px; font-weight:600; color:var(--muted);">
        <span style="width:8px;height:8px;border-radius:3px;background:var(--red);display:inline-block;"></span>Kritis
      </div>
    </div>
  </div>

</div>

{{-- ── 4. PRIORITAS & TIMELINE ── --}}
<div class="g65">

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:var(--red-lt);">
          <svg width="14" height="14" fill="none" stroke="var(--red)" stroke-width="1.75" viewBox="0 0 24 24">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
            <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
        </div>
        <span class="ch-title">Prioritas Penanganan</span>
      </div>
      <button type="button" class="btn btn-sm" onclick="openModal('modalAllData')">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Lihat Semua 12 Data
      </button>
    </div>

    @if(count($tabelKritis) > 0)
    <div class="tbl-wrap">
      <table>
        <thead>
          <tr>
            <th>Kode</th>
            <th>Indikator Kinerja</th>
            <th>Capaian</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($tabelKritis as $row)
          <tr>
            <td><span class="code-chip">{{ $row->kode }}</span></td>
            <td style="color:var(--text); font-weight:500;">{{ $row->nama }}</td>
            <td>
              <div style="display:flex; align-items:center; gap:8px;">
                <span style="font-weight:700; color:var(--red); font-size:14px;">{{ number_format($row->capaian_persen, 2, ',', '.') }}%</span>
                <span class="badge crit"><span class="badge-dot"></span>Kritis</span>
              </div>
            </td>
            <td style="width:90px;">
              <button type="button" class="btn btn-sm" onclick="openModalPeriksa('{{ $row->kode }}', '{{ $row->nama }}', '{{ $row->capaian_persen }}')">Periksa</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <div class="empty">
      <div class="empty-ic">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
      </div>
      <div class="empty-t">Tidak Ada Indikator Kritis</div>
      <div class="empty-d">Seluruh Indikator Kinerja Utama berada di atas ambang batas aman.</div>
    </div>
    @endif
  </div>

  {{-- Timeline --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <span class="ch-title">Riwayat Sistem</span>
      </div>
    </div>
    <div class="tl">

      <div class="tl-item">
        <div class="tl-spine">
          <div class="tl-dot">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.37"/>
            </svg>
          </div>
          <div class="tl-line"></div>
        </div>
        <div class="tl-body">
          <div class="tl-time">Hari ini, {{ now()->format('H:i') }}</div>
          <div class="tl-desc">Menyinkronkan data API (Tahun {{ $selectedTahun }}).</div>
        </div>
      </div>

      <div class="tl-item">
        <div class="tl-spine">
          <div class="tl-dot">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
            </svg>
          </div>
          <div class="tl-line"></div>
        </div>
        <div class="tl-body">
          <div class="tl-time">Kemarin, 11:00</div>
          <div class="tl-desc">Eksekusi algoritma analitik 3 Dimensi IKU.</div>
        </div>
      </div>

      <div class="tl-item">
        <div class="tl-spine">
          <div class="tl-dot">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>
              <path d="M4.93 4.93a10 10 0 0 0 0 14.14"/>
            </svg>
          </div>
          <div class="tl-line"></div>
        </div>
        <div class="tl-body">
          <div class="tl-time">Kemarin, 10:30</div>
          <div class="tl-desc">Penyesuaian konfigurasi tampilan Dashboard oleh Admin.</div>
        </div>
      </div>

    </div>
  </div>

</div>

{{-- ── MODALS ── --}}

{{-- Modal 1: Semua Data --}}
<div class="mo" id="modalAllData">
  <div class="mb">
    <div class="mh">
      <div class="mh-text">
        <h3>Rekapitulasi 12 Indikator Kinerja Utama</h3>
        <p>Data keseluruhan · Tahun Perjanjian Kinerja {{ $selectedTahun }}</p>
      </div>
      <button class="modal-close" onclick="closeModal('modalAllData')" aria-label="Tutup">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>
    <div class="mc-body">
      <table>
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Indikator</th>
            <th>Target</th>
            <th>Realisasi</th>
            <th>Capaian</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($semuaIku as $iku)
          <tr>
            <td><span class="code-chip">{{ $iku->kode }}</span></td>
            <td style="font-weight:500;">{{ $iku->nama }}</td>
            <td style="color:var(--muted);">{{ is_numeric($iku->target)     ? number_format($iku->target,     2, ',', '.') : $iku->target }}</td>
            <td style="font-weight:600;">{{ is_numeric($iku->realisasi) ? number_format($iku->realisasi, 2, ',', '.') : $iku->realisasi }}</td>
            <td style="font-weight:700; color:var(--text);">{{ number_format($iku->capaian_persen, 2, ',', '.') }}%</td>
            <td>
              @if($iku->capaian_persen >= 100)
                <span class="badge good"><span class="badge-dot"></span>Tercapai</span>
              @elseif($iku->capaian_persen >= 80)
                <span class="badge warn"><span class="badge-dot"></span>Mendekati</span>
              @else
                <span class="badge crit"><span class="badge-dot"></span>Kritis</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- Modal 2: Periksa IKU Kritis --}}
<div class="mo" id="modalPeriksa">
  <div class="mb mb-narrow">
    <div class="mh">
      <div class="mh-text">
        <h3>Tindak Lanjut Indikator</h3>
        <p>Analisis singkat untuk indikator kritis.</p>
      </div>
      <button class="modal-close" onclick="closeModal('modalPeriksa')" aria-label="Tutup">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>
    <div class="mc-body">

      <div class="alert-crit">
        <h4 id="periksaKode">IKU X</h4>
        <p id="periksaNama">Nama Indikator</p>
      </div>

      <p style="font-size:14px; color:var(--sub); margin-bottom:16px;">
        Capaian saat ini berada di angka <strong class="hl-num" id="periksaCapaian">0%</strong>.
      </p>

      <p style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:var(--faint); margin-bottom:10px;">Rekomendasi Tindakan</p>
      <ul class="rec-list">
        <li>Segera berikan notifikasi peringatan kepada Fakultas yang capaiannya masih di bawah 50%.</li>
        <li>Periksa kembali kelengkapan dokumen eviden yang belum divalidasi oleh pihak Universitas.</li>
        <li>Jika ini adalah data Datalake otomatis, pastikan API SIM Akademik sedang tidak mengalami gangguan.</li>
      </ul>

      <div style="display:flex; justify-content:flex-end; gap:8px;">
        <button class="btn btn-sm" onclick="closeModal('modalPeriksa')">Tutup</button>
        <button class="btn btn-sm btn-primary">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 2 11 13"/><path d="M22 2 15 22 11 13 2 9l20-7z"/></svg>
          Kirim Teguran ke Fakultas
        </button>
      </div>

    </div>
  </div>
</div>

@push('scripts')
<script>
  function openModal(id) {
    document.getElementById(id).classList.add('active');
    document.body.style.overflow = 'hidden';
  }
  function closeModal(id) {
    document.getElementById(id).classList.remove('active');
    document.body.style.overflow = 'auto';
  }
  function openModalPeriksa(kode, nama, capaian) {
    document.getElementById('periksaKode').innerText = kode;
    document.getElementById('periksaNama').innerText = nama;
    document.getElementById('periksaCapaian').innerText = capaian + '%';
    openModal('modalPeriksa');
  }
  window.onclick = function(e) {
    if (e.target.classList.contains('mo')) {
      e.target.classList.remove('active');
      document.body.style.overflow = 'auto';
    }
  };

  document.addEventListener('DOMContentLoaded', function () {

    Chart.defaults.font.family = "'Inter', system-ui, sans-serif";

    /* ── Bar Chart ── */
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: @json($chartLabels),
        datasets: [
          {
            label: 'Capaian Saat Ini (%)',
            data: @json($chartCapaian),
            backgroundColor: '#4f46e5',
            borderRadius: { topLeft: 5, topRight: 5 },
            borderSkipped: false,
            barPercentage: 0.55,
          },
          {
            label: 'Target Dasar (%)',
            data: @json($chartTargets),
            backgroundColor: '#eaecf0',
            borderRadius: { topLeft: 5, topRight: 5 },
            borderSkipped: false,
            barPercentage: 0.55,
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: { mode: 'index', intersect: false },
        plugins: {
          legend: {
            position: 'top',
            align: 'end',
            labels: {
              usePointStyle: true,
              pointStyle: 'rectRounded',
              boxWidth: 7,
              boxHeight: 7,
              font: { size: 12, weight: '600' },
              color: '#667085',
              padding: 20
            }
          },
          tooltip: {
            backgroundColor: '#101828',
            titleColor: '#f9fafb',
            bodyColor: '#d0d5dd',
            padding: 12,
            cornerRadius: 8,
            titleFont: { size: 12, weight: '700' },
            bodyFont:  { size: 12, weight: '500' },
            boxPadding: 4
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: '#f2f4f7' },
            border: { display: false },
            ticks: { font: { size: 11, weight: '500' }, color: '#98a2b3', padding: 6 }
          },
          x: {
            grid: { display: false },
            border: { display: false },
            ticks: { font: { size: 11, weight: '500' }, color: '#98a2b3' }
          }
        }
      }
    });

    /* ── Donut Chart ── */
    const ctxDonut = document.getElementById('donutChart').getContext('2d');
    new Chart(ctxDonut, {
      type: 'doughnut',
      data: {
        labels: ['Tercapai (≥100%)', 'Mendekati (80–99%)', 'Kritis (<80%)'],
        datasets: [{
          data: [{{ $aman }}, {{ $mendekati }}, {{ $kritis }}],
          backgroundColor: ['#12b76a', '#f79009', '#f04438'],
          borderWidth: 0,
          hoverOffset: 8,
          borderRadius: 4,
          spacing: 3,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '74%',
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: '#101828',
            titleColor: '#f9fafb',
            bodyColor: '#d0d5dd',
            padding: 12,
            cornerRadius: 8,
            titleFont: { size: 12, weight: '700' },
            bodyFont:  { size: 12, weight: '500' },
          }
        }
      }
    });

  });
</script>
@endpush
@endsection