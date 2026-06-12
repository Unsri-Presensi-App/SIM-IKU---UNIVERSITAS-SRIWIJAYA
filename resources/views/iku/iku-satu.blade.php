@extends('layouts.app')

@section('title', 'IKU 1 – AEE PT · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 1 – AEE PT')

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

    --r-sm: 8px;
    --r-md: 12px;
    --r-lg: 16px;
    --r-xl: 20px;

    --sh-sm: 0 1px 3px rgba(16,24,40,.06), 0 1px 2px rgba(16,24,40,.04);
    --sh-md: 0 4px 8px -2px rgba(16,24,40,.06), 0 2px 4px -2px rgba(16,24,40,.04);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Inter', system-ui, sans-serif; background: var(--bg); color: var(--text); }

  /* ─── Page Header ─── */
  .ph { display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; flex-wrap: wrap; margin-bottom: 24px; }
  .ph-left { display: flex; flex-direction: column; gap: 3px; }
  .ph-eyebrow { font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--indigo); }
  .ph-title { font-size: 22px; font-weight: 800; letter-spacing: -.025em; color: var(--text); line-height: 1.25; }
  .ph-sub { font-size: 13px; color: var(--muted); max-width: 680px; line-height: 1.55; margin-top: 2px; }

  /* ─── Control Bar ─── */
  .ctrl-bar {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    box-shadow: var(--sh-sm);
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 24px;
  }
  .ctrl-left { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
  .ctrl-right { display: flex; align-items: center; gap: 8px; }

  /* Mode Switcher */
  .mode-sw { display: flex; background: var(--bg); border: 1px solid var(--border); border-radius: var(--r-md); padding: 3px; gap: 2px; }
  .mode-sw button {
    border: none; background: transparent; padding: 7px 16px; border-radius: 9px;
    font-size: 13px; font-weight: 600; color: var(--muted); cursor: pointer; font-family: inherit;
    transition: all .18s; white-space: nowrap;
  }
  .mode-sw button.active {
    background: var(--surface); color: var(--indigo);
    box-shadow: var(--sh-sm); font-weight: 700;
  }

  /* Divider in ctrl-bar */
  .ctrl-sep { width: 1px; height: 28px; background: var(--border); flex-shrink: 0; }

  /* Faculty Tabs */
  .fak-scroll { display: flex; align-items: center; gap: 4px; overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none; }
  .fak-scroll::-webkit-scrollbar { display: none; }
  .fak-tab {
    padding: 6px 13px; border-radius: var(--r-sm); border: 1px solid var(--border);
    background: var(--surface); color: var(--sub); font-size: 12px; font-weight: 600;
    cursor: pointer; transition: all .16s; white-space: nowrap; font-family: inherit;
  }
  .fak-tab:hover { border-color: var(--border-md); background: var(--bg); color: var(--text); }
  .fak-tab.active { background: var(--indigo-lt); border-color: #c7d2fe; color: var(--indigo); font-weight: 700; }

  /* Year Select */
  .year-sel {
    padding: 8px 32px 8px 12px; border-radius: var(--r-md); border: 1px solid var(--border-md);
    background: var(--surface); color: var(--text); font-size: 13px; font-weight: 600;
    font-family: inherit; cursor: pointer; outline: none; appearance: none; -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='%2398a2b3' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 10px center;
    transition: border-color .15s, box-shadow .15s;
  }
  .year-sel:focus { border-color: var(--indigo); box-shadow: 0 0 0 3px rgba(79,70,229,.12); }

  /* Status Pill */
  .status-pill { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: var(--surface); border: 1px solid var(--border); border-radius: 99px; font-size: 12px; font-weight: 600; color: var(--sub); }
  .pulse { width: 6px; height: 6px; border-radius: 50%; background: var(--green); box-shadow: 0 0 0 2px var(--green-lt); animation: pulse 2.4s ease infinite; flex-shrink: 0; }
  @keyframes pulse { 0%,100%{box-shadow:0 0 0 2px var(--green-lt)} 50%{box-shadow:0 0 0 4px #86efac33} }

  /* ─── Notice Banner ─── */
  .notice {
    display: flex; align-items: center; justify-content: space-between; gap: 16px;
    background: var(--indigo-lt); border: 1px solid #c7d2fe;
    border-radius: var(--r-lg); padding: 12px 18px; margin-bottom: 20px; flex-wrap: wrap;
  }
  .notice-left { display: flex; align-items: center; gap: 10px; }
  .notice-ic { width: 30px; height: 30px; border-radius: 8px; background: var(--indigo); display: grid; place-items: center; flex-shrink: 0; }
  .notice-ic svg { color: #fff; }
  .notice-text { font-size: 13px; color: #3730a3; }
  .notice-text strong { color: var(--indigo-dk); font-weight: 700; }
  .notice-meta { font-size: 12px; color: #4f46e5; font-weight: 600; white-space: nowrap; }

  /* ─── Summary Grid ─── */
  .sum-grid { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 14px; margin-bottom: 20px; }
  .sc { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); box-shadow: var(--sh-sm); padding: 20px; display: flex; justify-content: space-between; align-items: flex-start; }
  .sc-lbl { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--faint); }
  .sc-val { font-size: 26px; font-weight: 800; letter-spacing: -.04em; color: var(--text); margin-top: 10px; line-height: 1; }
  .sc-ic { width: 40px; height: 40px; border-radius: 10px; display: grid; place-items: center; flex-shrink: 0; }
  .ic-indigo { background: var(--indigo-lt); color: var(--indigo); }
  .ic-green  { background: var(--green-lt);  color: var(--green);  }
  .ic-amber  { background: var(--amber-lt);  color: var(--amber);  }
  .ic-purple { background: var(--purple-lt); color: var(--purple); }

  /* ─── Layout ─── */
  .lay { display: grid; grid-template-columns: minmax(0,1fr) 320px; gap: 16px; align-items: start; }

  /* ─── Card ─── */
  .card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); box-shadow: var(--sh-sm); padding: 22px; margin-bottom: 16px; }
  .card:last-child { margin-bottom: 0; }

  /* ─── Card Header ─── */
  .ch { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
  .ch-left { display: flex; align-items: center; gap: 8px; }
  .ch-icon { width: 28px; height: 28px; border-radius: 7px; background: var(--indigo-lt); display: grid; place-items: center; flex-shrink: 0; }
  .ch-icon svg { color: var(--indigo); }
  .ch-title { font-size: 14px; font-weight: 700; color: var(--text); letter-spacing: -.01em; }
  .ch-sub { font-size: 12px; color: var(--muted); font-weight: 400; }

  /* ─── View Note ─── */
  .view-note { background: var(--bg); border: 1px solid var(--border); border-radius: var(--r-md); padding: 10px 14px; font-size: 12px; color: var(--muted); margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
  .view-note svg { color: var(--faint); flex-shrink: 0; }

  /* ─── Table ─── */
  .tbl-wrap { overflow-x: auto; margin: 0 -22px; padding: 0 22px; }
  table { width: 100%; border-collapse: collapse; font-size: 13px; }
  thead th { padding: 8px 10px; border-bottom: 1px solid var(--border); font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--faint); text-align: left; white-space: nowrap; background: transparent; }
  thead th:first-child { padding-left: 0; }
  thead th:last-child  { padding-right: 0; }
  tbody td { padding: 13px 10px; border-bottom: 1px solid #f2f4f7; color: var(--sub); vertical-align: middle; }
  tbody td:first-child { padding-left: 0; }
  tbody td:last-child  { padding-right: 0; }
  tbody tr:last-child td { border-bottom: none; }
  tbody tr:hover td { background: var(--bg); }
  .sum-row td { background: #f8faff !important; font-weight: 700; color: var(--text); }
  .sum-row:hover td { background: #eef2ff !important; }

  /* ─── Progress ─── */
  .prog { height: 5px; background: var(--border); border-radius: 99px; overflow: hidden; min-width: 72px; }
  .prog-f { height: 100%; border-radius: 99px; transition: width .4s ease; }
  .pf-indigo { background: var(--indigo); }
  .pf-green  { background: var(--green); }
  .pf-amber  { background: var(--amber); }
  .pf-red    { background: var(--red); }

  /* ─── Badge ─── */
  .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 99px; font-size: 11px; font-weight: 700; letter-spacing: .01em; white-space: nowrap; }
  .badge-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
  .badge.good  { background: var(--green-lt); color: var(--green-dk); }
  .badge.warn  { background: var(--amber-lt); color: var(--amber-dk); }
  .badge.crit  { background: var(--red-lt);   color: var(--red-dk);   }
  .badge.info  { background: var(--indigo-lt);color: var(--indigo-dk);}
  .badge.auto  { background: var(--green-lt); color: var(--green-dk); }

  /* ─── Buttons ─── */
  .btn { padding: 8px 16px; border-radius: var(--r-md); border: 1px solid var(--border-md); background: var(--surface); color: var(--sub); font-size: 13px; font-weight: 600; cursor: pointer; transition: all .16s; font-family: inherit; line-height: 1; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; white-space: nowrap; }
  .btn:hover { background: var(--bg); border-color: var(--border-md); color: var(--text); }
  .btn-sm { padding: 6px 12px; font-size: 12px; }
  .btn-primary { background: var(--indigo); color: #fff; border-color: var(--indigo); }
  .btn-primary:hover { background: var(--indigo-dk); border-color: var(--indigo-dk); color: #fff; }

  /* ─── Sidebar Cards ─── */
  .side { position: sticky; top: 20px; display: flex; flex-direction: column; gap: 16px; }

  /* Chart bars */
  .triwulan-chart { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; align-items: end; height: 180px; padding: 24px 8px 0; border-left: 1px solid var(--border); border-bottom: 1px solid var(--border); }
  .twc-col { display: flex; flex-direction: column; align-items: center; gap: 8px; height: 100%; justify-content: flex-end; }
  .twc-bar { width: 60%; border-radius: 5px 5px 3px 3px; background: linear-gradient(180deg, #818cf8 0%, var(--indigo) 100%); position: relative; transition: height .4s ease; min-height: 8px; }
  .twc-val { position: absolute; top: -20px; left: 50%; transform: translateX(-50%); font-size: 10px; font-weight: 700; color: var(--indigo); white-space: nowrap; }
  .twc-lbl { font-size: 11px; font-weight: 600; color: var(--faint); margin-top: 8px; }

  /* Target rows */
  .tgt-row { display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid var(--border); font-size: 13px; }
  .tgt-row:last-child { border-bottom: none; }
  .tgt-lbl { color: var(--muted); font-weight: 500; }
  .tgt-val { font-weight: 700; color: var(--text); }

  /* Formula */
  .formula { background: var(--bg); border: 1px solid var(--border); border-radius: var(--r-lg); padding: 14px 16px; font-size: 13px; line-height: 1.7; color: var(--sub); }
  .formula strong { color: var(--indigo); font-style: italic; }

  /* Sync rows */
  .sync-row { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--border); }
  .sync-row:last-child { border-bottom: none; }
  .sync-dot { width: 24px; height: 24px; border-radius: 50%; background: var(--green-lt); border: 1px solid #86efac; display: grid; place-items: center; flex-shrink: 0; }
  .sync-dot svg { color: var(--green); }
  .sync-info { flex: 1; }
  .sync-date { font-size: 12px; font-weight: 600; color: var(--sub); }
  .sync-src  { font-size: 11px; color: var(--faint); margin-top: 1px; }

  /* Faculty grid */
  .fac-grid { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 12px; }
  .fac-card { padding: 14px; border: 1px solid var(--border); border-radius: var(--r-lg); background: var(--surface); }
  .fac-rank { width: 24px; height: 24px; border-radius: 6px; background: var(--indigo-lt); display: inline-flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; color: var(--indigo); margin-bottom: 8px; }
  .fac-name { font-size: 12px; font-weight: 600; color: var(--sub); margin-bottom: 6px; }
  .fac-val  { font-size: 22px; font-weight: 800; letter-spacing: -.03em; color: var(--text); margin-bottom: 8px; line-height: 1; }
  .fac-note { font-size: 11px; color: var(--muted); margin-top: 6px; }

  /* Prodi filter */
  .filter-row { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; margin-bottom: 14px; }
  .flt-sel { padding: 7px 28px 7px 10px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); color: var(--sub); font-size: 12px; font-weight: 600; font-family: inherit; cursor: pointer; appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='%2398a2b3' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 8px center; outline: none; }
  .flt-sel:focus { border-color: var(--indigo); }

  /* Hr */
  .hr { height: 1px; background: var(--border); margin: 14px 0; }

  /* Sections */
  .section { display: none; }
  .section.active { display: block; }

  /* Footer note */
  .fn { font-size: 11px; color: var(--faint); margin-top: 10px; display: flex; align-items: center; gap: 5px; }
  .fn svg { flex-shrink: 0; }

  /* Empty */
  .empty-cell { text-align: center; padding: 32px 20px !important; color: var(--muted) !important; }

  @media (max-width: 1100px) {
    .lay { grid-template-columns: 1fr; }
    .side { position: static; }
  }
  @media (max-width: 900px) {
    .sum-grid { grid-template-columns: repeat(2,1fr); }
    .fac-grid { grid-template-columns: repeat(2,1fr); }
  }
  @media (max-width: 580px) {
    .sum-grid { grid-template-columns: 1fr; }
    .fac-grid { grid-template-columns: 1fr; }
    .ctrl-bar { flex-direction: column; align-items: flex-start; }
    .card { padding: 16px; }
  }
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Talenta</div>
    <div class="ph-title">
      IKU 1 – Angka Efisiensi Edukasi (AEE)
      <span class="badge auto" style="vertical-align:middle; margin-left:6px; font-size:11px;">
        <span class="badge-dot"></span>Otomatis Datalake
      </span>
    </div>
    <div class="ph-sub">
      @if($selectedFakultas == 'Universitas Sriwijaya')
        Menampilkan AEE keseluruhan Unsri per jenjang dan rata-rata universitas. Seluruh data berasal dari API Data Lake secara otomatis.
      @else
        Menampilkan AEE {{ $selectedFakultas }} per jenjang dan realisasi capaian. Data ditarik otomatis dari API Data Lake.
      @endif
    </div>
  </div>
  <div>
    <a href="{{ route('iku.satu.export') }}" class="btn btn-sm">
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
      Export Excel
    </a>
  </div>
</section>

{{-- ── CONTROL BAR ── --}}
<form method="GET" id="filterForm" action="">
<div class="ctrl-bar">
  <div class="ctrl-left">

    {{-- Mode Switch --}}
    <div class="mode-sw">
      <button type="button" id="btnUniv" class="{{ $selectedFakultas == 'Universitas Sriwijaya' ? 'active' : '' }}">
        User Universitas
      </button>
      <button type="button" id="btnFak" class="{{ $selectedFakultas != 'Universitas Sriwijaya' ? 'active' : '' }}">
        User Fakultas
      </button>
    </div>

    <div class="ctrl-sep"></div>

    {{-- Faculty Tabs --}}
    <div class="fak-scroll">
      <select name="fakultas" id="facultySelect" style="display:none;">
        <option value="Universitas Sriwijaya" {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'selected' : '' }}>
          Universitas Sriwijaya
        </option>
        @foreach($listFakultas as $fak)
          <option value="{{ $fak }}" {{ $selectedFakultas == $fak ? 'selected' : '' }}>{{ $fak }}</option>
        @endforeach
      </select>

      {{-- Univ tab --}}
      <button type="button" class="fak-tab {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'active' : '' }}"
        onclick="setFakultas('Universitas Sriwijaya')">Universitas</button>

      {{-- Per-fakultas tabs --}}
      @foreach($listFakultas as $fak)
        @if($fak !== 'Universitas Sriwijaya')
        <button type="button" class="fak-tab {{ $selectedFakultas == $fak ? 'active' : '' }}"
          onclick="setFakultas('{{ $fak }}')">
          {{ \Illuminate\Support\Str::replace(['Fakultas ', 'FAKULTAS '], '', $fak) }}
        </button>
        @endif
      @endforeach
    </div>

  </div>

  <div class="ctrl-right">
    <div class="status-pill"><span class="pulse"></span>Sinkron</div>
    <select name="tahun" class="year-sel" onchange="document.getElementById('filterForm').submit();">
      <option value="2026" {{ $selectedTahun == '2026' ? 'selected' : '' }}>2026</option>
      <option value="2027" {{ $selectedTahun == '2027' ? 'selected' : '' }}>2027</option>
    </select>
  </div>
</div>
</form>

{{-- ── NOTICE ── --}}
<div class="notice">
  <div class="notice-left">
    <div class="notice-ic">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
    </div>
    <div class="notice-text">
      <strong>Data otomatis dari API Data Lake.</strong>
      Sistem melakukan sinkronisasi terjadwal. User hanya melihat hasil, tanggal update, dan riwayat sinkronisasi.
    </div>
  </div>
  <div class="notice-meta">Update: {{ now()->format('d M Y, H.i') }} WIB</div>
</div>

{{-- ── SECTIONS ── --}}

{{-- ─ SECTION UNIVERSITAS ─ --}}
<div id="univSection" class="section {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'active' : '' }}">

  <div class="sum-grid">
    <div class="sc">
      <div>
        <div class="sc-lbl">AEE Rata-rata Universitas</div>
        <div class="sc-val">{{ number_format($dataTabel ? collect($dataTabel)->avg('aee_realisasi') : 0, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-indigo">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Target AEE PT {{ $selectedTahun }}</div>
        <div class="sc-val">{{ number_format($targetAeePT, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-green">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Capaian terhadap Target</div>
        <div class="sc-val">{{ number_format($aee_pt, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-amber">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Jumlah Fakultas</div>
        <div class="sc-val">{{ count($listFakultas) - 1 }}</div>
      </div>
      <div class="sc-ic ic-purple">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      </div>
    </div>
  </div>

        <div class="layout">
          <div>
            <div class="card">
              <div class="card-title">
                <h3>AEE Universitas per Jenjang</h3>
                <div class="actions">
                 <a href="{{ route('iku.satu.export') }}" class="btn ghost">
                 <span>⬇</span> Export Excel
                 </a>
                </div>
              </div>
              <div class="view-note">Tabel ini menampilkan AEE agregat Universitas Sriwijaya per jenjang. Data tidak dapat diedit karena berasal dari API Data Lake.</div>
              <table>
                <thead>
                  <tr>
                    <th>Jenjang</th>
                    <th>Mhs Masuk Cohort</th>
                    <th>Lulus Tepat Waktu</th>
                    <th>AEE Realisasi</th>
                    <th>AEE Ideal (Pembagi)</th>
                    <th>Capaian AEE</th>
                    <th>Target PK Rektor</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($dataTabel as $row)
                  <tr>
                    <td><strong>{{ $row->jenjang }}</strong></td>
                    <td>{{ number_format($row->total_mahasiswa, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->lulus_tepat_waktu, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->aee_realisasi, 2, ',', '.') }}%</td>
                    <td>{{ number_format($row->aee_ideal, 2, ',', '.') }}%</td>
                    <td>
                      @php
                        $pc = $row->tingkat_pencapaian;
                        $tg = $row->target_pk;
                        $persen_progress = $tg > 0 ? ($pc / $tg) * 100 : 0;
                      @endphp
                      <div style="display:flex;align-items:center;gap:8px;">
                        <div class="progress {{ $pc >= $tg ? 'green' : ($persen_progress >= 80 ? 'orange' : 'red') }}" style="width:80px">
                          <span style="width:{{ min($persen_progress, 100) }}%"></span>
                        </div>
                        <strong>{{ number_format($pc, 2, ',', '.') }}%</strong>
                      </div>
                    </td>
                    <td><strong>{{ number_format($tg, 2, ',', '.') }}%</strong></td>
                    <td>
                      @if($pc >= $tg)
                        <span class="badge good">Tercapai</span>
                      @elseif($persen_progress >= 80)
                        <span class="badge warn">Mendekati</span>
                      @else
                        <span class="badge red">Perlu Perhatian</span>
                      @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="8" style="text-align: center; color: var(--muted); padding: 20px;">Data jenjang untuk fakultas ini belum tersedia.</td>
                  </tr>
                  @endforelse

                  @if(count($dataTabel) > 0)
                  <tr style="background:#f0f7ff;">
                    <td colspan="3"><strong>Rata-rata Keseluruhan</strong></td>
                    <td><strong>{{ number_format(collect($dataTabel)->avg('aee_realisasi'), 2, ',', '.') }}%</strong></td>
                    <td><strong>-</strong></td>
                    <td><strong>{{ number_format($aee_pt, 2, ',', '.') }}%</strong></td>
                    <td><strong>{{ number_format($targetAeePT, 2, ',', '.') }}%</strong></td>
                    <td>
                      @if($aee_pt >= $targetAeePT)
                        <span class="badge good">Tercapai</span>
                      @else
                        <span class="badge warn">Pemantauan</span>
                      @endif
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
              <div class="footer-note">Keterangan: mahasiswa pindah, DO, dan cuti lebih dari ketentuan tidak masuk perhitungan.</div>
            </div>

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:10px;">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
            </div>
            <div class="ch-title">Formula</div>
          </div>
        </div>
        <div class="formula">
          <strong>AEE PT</strong> = rata-rata tingkat pencapaian AEE dari setiap program pendidikan.<br><br>
          <strong>AEE</strong> = lulus tepat waktu ÷ total mahasiswa cohort × 100%
        </div>
      </div>

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:12px;">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.37"/></svg>
            </div>
            <div class="ch-title">Riwayat Sinkronisasi</div>
          </div>
        </div>
        <div class="sync-row">
          <div class="sync-dot">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="sync-info">
            <div class="sync-date">{{ now()->format('d M Y') }}, 02.00 WIB</div>
            <div class="sync-src">API Data Lake</div>
          </div>
          <span class="badge good"><span class="badge-dot"></span>Berhasil</span>
        </div>
        <div class="sync-row">
          <div class="sync-dot">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="sync-info">
            <div class="sync-date">{{ now()->subDay()->format('d M Y') }}, 02.00 WIB</div>
            <div class="sync-src">API Data Lake</div>
          </div>
          <span class="badge good"><span class="badge-dot"></span>Berhasil</span>
        </div>
      </div>

    </aside>
  </div>
</div>

{{-- ─ SECTION FAKULTAS ─ --}}
<div id="fakSection" class="section {{ $selectedFakultas != 'Universitas Sriwijaya' ? 'active' : '' }}">

  <div class="sum-grid">
    <div class="sc">
      <div>
        <div class="sc-lbl">AEE Rata-rata Fakultas</div>
        <div class="sc-val">{{ number_format($dataTabel ? collect($dataTabel)->avg('aee_realisasi') : 0, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-indigo">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Target AEE PT {{ $selectedTahun }}</div>
        <div class="sc-val">{{ number_format($targetAeePT, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-green">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Capaian terhadap Target</div>
        <div class="sc-val">{{ number_format($aee_pt, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-amber">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Status Sinkronisasi</div>
        <div class="sc-val" style="font-size:18px; margin-top:12px; display:flex; align-items:center; gap:7px;">
          <span class="pulse"></span>Aman
        </div>
        <div class="layout">
          <div>
            <div class="card">
              <div class="card-title"><h3>AEE {{ $selectedFakultas }} per Jenjang</h3><button type="submit" name="export" value="excel" form="filterForm" class="btn ghost">⬇ Export Excel</button></div>
              <div class="view-note">Halaman user fakultas menampilkan AEE fakultas per jenjang dan rincian AEE per prodi. Seluruh data read-only dari API Data Lake.</div>
              <table>
                <thead>
                  <tr>
                    <th>Jenjang</th>
                    <th>Mhs Masuk Cohort</th>
                    <th>Lulus Tepat Waktu</th>
                    <th>AEE Realisasi</th>
                    <th>AEE Ideal (Pembagi)</th>
                    <th>Capaian AEE</th>
                    <th>Target PK Rektor</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($dataTabel as $row)
                  <tr>
                    <td><strong>{{ $row->jenjang }}</strong></td>
                    <td>{{ number_format($row->total_mahasiswa, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->lulus_tepat_waktu, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->aee_realisasi, 2, ',', '.') }}%</td>
                    <td>{{ number_format($row->aee_ideal, 2, ',', '.') }}%</td>
                    <td>
                      @php
                        $pc = $row->tingkat_pencapaian;
                        $tg = $row->target_pk;
                        $persen_progress = $tg > 0 ? ($pc / $tg) * 100 : 0;
                      @endphp
                      <div style="display:flex;align-items:center;gap:8px;">
                        <div class="progress {{ $pc >= $tg ? 'green' : ($persen_progress >= 80 ? 'orange' : 'red') }}" style="width:80px">
                          <span style="width:{{ min($persen_progress, 100) }}%"></span>
                        </div>
                        <strong>{{ number_format($pc, 2, ',', '.') }}%</strong>
                      </div>
                    </td>
                    <td><strong>{{ number_format($tg, 2, ',', '.') }}%</strong></td>
                    <td>
                      @if($pc >= $tg)
                        <span class="badge good">Tercapai</span>
                      @elseif($persen_progress >= 80)
                        <span class="badge warn">Mendekati</span>
                      @else
                        <span class="badge red">Perlu Perhatian</span>
                      @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="8" style="text-align: center; color: var(--muted); padding: 20px;">Data jenjang untuk fakultas ini belum tersedia.</td>
                  </tr>
                  @endforelse

                  @if(count($dataTabel) > 0)
                  <tr style="background:#f0f7ff;">
                    <td colspan="3"><strong>Rata-rata Keseluruhan</strong></td>
                    <td><strong>{{ number_format(collect($dataTabel)->avg('aee_realisasi'), 2, ',', '.') }}%</strong></td>
                    <td><strong>-</strong></td>
                    <td><strong>{{ number_format($aee_pt, 2, ',', '.') }}%</strong></td>
                    <td><strong>{{ number_format($targetAeePT, 2, ',', '.') }}%</strong></td>
                    <td>
                      @if($aee_pt >= $targetAeePT)
                        <span class="badge good">Tercapai</span>
                      @else
                        <span class="badge warn">Pemantauan</span>
                      @endif
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="card" id="detailProdi">
              <div class="card-title"><h3>AEE per Program Studi</h3><button class="btn ghost">Lihat Semua Prodi</button></div>
              <div class="filter-row"><select class="select"><option>Semua Jenjang</option><option>D3</option><option>S1</option><option>S2</option><option>S3</option></select><select class="select"><option>Semua Status</option><option>Tercapai</option><option>Perhatian</option></select><div class="search">Cari nama program studi...</div></div>
              <table>
                <thead><tr><th>No</th><th>Program Studi</th><th>Jenjang</th><th>Masuk</th><th>Lulus Tepat Waktu</th><th>AEE</th><th>Capaian</th><th>Status</th></tr></thead>
                <tbody>
                  <tr><td colspan="8" style="text-align:center; color: var(--muted);">[Data rincian prodi untuk {{ $selectedFakultas }} ditarik dari SIM Akademik pada rilis berikutnya]</td></tr>
                </tbody>
              </table>
            </div>
          </div>
          <aside class="side">
            <div class="card"><div class="card-title"><h3>Capaian Fakultas per Triwulan</h3></div><div class="chart"><div class="bar-wrap"><div class="bar" style="--h:54px" data-v="10,65%"></div>TW1</div><div class="bar-wrap"><div class="bar" style="--h:96px" data-v="21,30%"></div>TW2</div><div class="bar-wrap"><div class="bar" style="--h:132px" data-v="31,95%"></div>TW3</div><div class="bar-wrap"><div class="bar" style="--h:174px" data-v="42,60%"></div>TW4</div></div></div>
            <div class="card"><div class="card-title"><h3>Prodi Perlu Perhatian</h3></div><div class="target-row"><span>Teknik Elektro</span><strong style="color:var(--red)">44,57%</strong></div><div class="target-row"><span>Teknik Kimia</span><strong style="color:#b45309">46,11%</strong></div><div class="target-row"><span>Teknik Mesin</span><strong style="color:#b45309">47,20%</strong></div></div>
            <div class="card"><div class="card-title"><h3>Catatan Sistem</h3></div><p class="muted small">Tidak ada form input pada halaman IKU 1. Jika terdapat perbedaan data, perbaikan dilakukan pada sistem sumber/Data Lake, bukan di SIM IKU.</p></div>
            <div class="card"><div class="card-title"><h3>Riwayat Sinkronisasi</h3></div><div class="sync-row"><div class="dot">✓</div><div>{{ now()->format('d M Y') }}, 02.00 WIB<br><span class="muted small">API Data Lake</span></div><span class="badge good">Berhasil</span></div><div class="sync-row"><div class="dot">✓</div><div>{{ now()->subDay()->format('d M Y') }}, 02.00 WIB<br><span class="muted small">API Data Lake</span></div><span class="badge good">Berhasil</span></div></div>
          </aside>
        </div>
      </div>

    </aside>
  </div>
</div>

@push('scripts')
<script>
  function setFakultas(val) {
    document.getElementById('facultySelect').value = val;
    document.getElementById('filterForm').submit();
  }

  document.getElementById('btnUniv').addEventListener('click', function() {
    setFakultas('Universitas Sriwijaya');
  });

  document.getElementById('btnFak').addEventListener('click', function() {
    const opts = document.querySelectorAll('#facultySelect option');
    for (const opt of opts) {
      if (opt.value !== 'Universitas Sriwijaya') {
        setFakultas(opt.value);
        break;
      }
    }
  });

  function scrollToFakultas() {
    const el = document.getElementById('detailFakultas');
    if (el) {
      el.scrollIntoView({ behavior: 'smooth', block: 'start' });
      el.style.transition = 'box-shadow 0.4s';
      el.style.boxShadow = '0 0 0 2px var(--indigo)';
      setTimeout(() => { el.style.boxShadow = ''; }, 1600);
    }
  }

  @if(session('info'))
    console.info('{{ session('info') }}');
  @endif
</script>
</body>
</html>
