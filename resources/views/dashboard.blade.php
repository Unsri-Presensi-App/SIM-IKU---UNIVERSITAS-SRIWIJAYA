@extends('layouts.app')

@section('title', 'Dashboard Eksekutif SIM IKU')
@section('crumb_parent', 'Home')
@section('crumb_title',  'Dashboard')

@push('styles')
<style>
  :root {
    --navy:#082b57; --blue:#1769e0; --bg:#f5f7fb; --card:#fff;
    --line:#e5e7eb; --text:#0f172a; --muted:#64748b; --green:#16a34a; --green-bg:#eaf8ef;
    --orange:#f59e0b; --orange-bg:#fff7e6; --red:#dc2626; --red-bg:#fee2e2;
    --shadow:0 1px 3px rgba(15,23,42,.06), 0 4px 16px rgba(15,23,42,.04); --radius:14px;
  }

  /* ── Page header ── */
  .page-head { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px; }
  .page-head h2 { font-size:24px; font-weight:700; margin:0 0 4px; letter-spacing:-.02em; color:var(--navy); }
  .page-head p { margin:0; color:var(--muted); font-size:14px; }
  .page-head-meta { display:flex; align-items:center; gap:8px; }
  .sync-dot { width:7px; height:7px; border-radius:50%; background:var(--green); display:inline-block; }

  /* ── Badges ── */
  .badge { display:inline-flex; align-items:center; gap:5px; border-radius:6px; padding:4px 10px; font-size:11px; font-weight:700; letter-spacing:.02em; text-transform:uppercase; }
  .badge.good  { background:var(--green-bg);  color:#166534; }
  .badge.warn  { background:var(--orange-bg); color:#92400e; }
  .badge.red   { background:var(--red-bg);    color:#991b1b; }
  .badge.blue  { background:#eaf2ff;           color:#1e40af; }
  .badge-dot { width:5px; height:5px; border-radius:50%; background:currentColor; }

  /* ── Grids ── */
  .grid-4     { display:grid; grid-template-columns:repeat(4, minmax(0, 1fr)); gap:18px; margin-bottom:20px; }
  .grid-3     { display:grid; grid-template-columns:repeat(3, minmax(0, 1fr)); gap:18px; margin-bottom:20px; }
  .grid-65-35 { display:grid; grid-template-columns:1.8fr 1fr; gap:18px; margin-bottom:20px; }

  /* ── Cards ── */
  .card { background:var(--card); border:1px solid var(--line); border-radius:var(--radius); box-shadow:var(--shadow); padding:20px; display:flex; flex-direction:column; }
  .card-title { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
  .card-title h3 { font-size:15px; font-weight:600; margin:0; color:var(--navy); letter-spacing:-.01em; }
  .card-title-icon { display:flex; align-items:center; gap:8px; }
  .card-title-icon svg { color:var(--muted); flex-shrink:0; }

  /* ── Metric cards ── */
  .metric-card { display:flex; justify-content:space-between; align-items:flex-start; }
  .metric-label { font-size:11px; color:var(--muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em; }
  .metric-value { font-size:28px; font-weight:800; letter-spacing:-.04em; margin-top:10px; color:var(--navy); line-height:1; }
  .metric-value-sm { font-size:13px; font-weight:600; margin-top:12px; color:var(--navy); line-height:1.6; }
  .metric-icon { width:44px; height:44px; border-radius:10px; display:grid; place-items:center; flex-shrink:0; }
  .mi-blue   { background:#eef3ff; color:#1769e0; }
  .mi-green  { background:var(--green-bg);  color:var(--green); }
  .mi-orange { background:var(--orange-bg); color:var(--orange); }
  .mi-purple { background:#f3e8ff; color:#7c3aed; }

  /* ── Dimension cards ── */
  .dim-eyebrow { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:var(--muted); margin-bottom:4px; }
  .dim-title   { font-size:14px; font-weight:600; color:var(--navy); margin:0 0 14px; }
  .dim-value   { font-size:26px; font-weight:800; letter-spacing:-.04em; color:var(--navy); line-height:1; margin-bottom:14px; }

  /* ── Progress bar ── */
  .prog-bar { height:5px; background:var(--line); border-radius:99px; overflow:hidden; }
  .prog-fill { height:100%; border-radius:99px; }

  /* ── Divider ── */
  .divider { height:1px; background:var(--line); margin:16px 0; }

  /* ── Table ── */
  table { width:100%; border-collapse:collapse; font-size:13px; }
  thead th { padding:10px 12px; border-bottom:1px solid var(--line); text-align:left; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:var(--muted); background:transparent; }
  tbody td { padding:13px 12px; border-bottom:1px solid #f1f5f9; text-align:left; color:var(--text); }
  tbody tr:last-child td { border-bottom:none; }
  tbody tr:hover td { background:#f8fafc; }

  /* ── Buttons ── */
  .btn-sm { padding:7px 14px; border-radius:8px; border:1px solid var(--line); background:#fff; color:var(--text); font-size:12px; font-weight:600; cursor:pointer; transition:all .18s; letter-spacing:.01em; }
  .btn-sm:hover { background:#f8fafc; border-color:#94a3b8; color:var(--navy); }
  .btn-primary { background:var(--blue); color:#fff; border-color:var(--blue); }
  .btn-primary:hover { background:#1558c4; border-color:#1558c4; color:#fff; }

  /* ── Timeline ── */
  .timeline { display:flex; flex-direction:column; gap:0; }
  .tl-item { display:flex; gap:14px; padding-bottom:18px; position:relative; }
  .tl-item:last-child { padding-bottom:0; }
  .tl-left { display:flex; flex-direction:column; align-items:center; flex-shrink:0; }
  .tl-circle { width:28px; height:28px; border-radius:50%; background:#eef3ff; border:1px solid #c7d9f8; display:grid; place-items:center; flex-shrink:0; }
  .tl-circle svg { color:var(--blue); }
  .tl-line { flex:1; width:1px; background:var(--line); margin-top:4px; }
  .tl-item:last-child .tl-line { display:none; }
  .tl-content { padding-top:4px; }
  .tl-time { font-size:11px; color:var(--muted); font-weight:600; margin-bottom:3px; }
  .tl-desc { font-size:13px; color:var(--text); line-height:1.5; }

  /* ── Empty state ── */
  .empty-state { padding:36px 24px; text-align:center; background:#f8fafc; border-radius:10px; border:1px dashed #cbd5e1; }
  .empty-icon { width:44px; height:44px; border-radius:50%; background:var(--green-bg); display:flex; align-items:center; justify-content:center; margin:0 auto 12px; }
  .empty-icon svg { color:var(--green); }
  .empty-title { font-size:15px; font-weight:700; color:#166534; margin:0 0 4px; }
  .empty-desc { font-size:13px; color:#4b7a5c; margin:0; }

  /* ── Modals ── */
  .modal-overlay { display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background:rgba(15,23,42,.45); backdrop-filter:blur(6px); align-items:center; justify-content:center; opacity:0; transition:opacity .25s; }
  .modal-overlay.active { display:flex; opacity:1; }
  .modal-box { background:#fff; width:90%; max-width:900px; border-radius:18px; padding:28px; box-shadow:0 24px 48px -12px rgba(0,0,0,.2); max-height:85vh; overflow-y:auto; transform:translateY(16px); transition:transform .25s; position:relative; }
  .modal-overlay.active .modal-box { transform:translateY(0); }
  .modal-close { position:absolute; top:20px; right:20px; width:32px; height:32px; border-radius:8px; border:1px solid var(--line); background:#fff; color:var(--muted); cursor:pointer; display:grid; place-items:center; transition:all .15s; }
  .modal-close:hover { background:#fee2e2; border-color:#fca5a5; color:var(--red); }
  .modal-header { margin-bottom:20px; padding-bottom:16px; border-bottom:1px solid var(--line); }
  .modal-header h3 { margin:0 0 4px; font-size:19px; font-weight:700; color:var(--navy); }
  .modal-header p { margin:0; font-size:13px; color:var(--muted); }

  /* ── Alert banner in modal ── */
  .alert-critical { background:var(--red-bg); padding:14px 16px; border-radius:10px; margin-bottom:18px; border-left:3px solid var(--red); }
  .alert-critical h4 { margin:0 0 4px; font-size:14px; font-weight:700; color:var(--red); }
  .alert-critical p  { margin:0; font-size:13px; color:#991b1b; }

  /* ── Chart year selector ── */
  .select-year { padding:8px 14px; border-radius:8px; border:1px solid var(--line); background:#fff; color:var(--text); font-size:13px; font-weight:600; cursor:pointer; outline:none; transition:border-color .15s; }
  .select-year:hover { border-color:#94a3b8; }
  .select-year:focus { border-color:var(--blue); }

  /* ── Inline SVG helpers ── */
  .icon { display:inline-flex; align-items:center; justify-content:center; flex-shrink:0; }

  @media(max-width:1200px) {
    .grid-4, .grid-3 { grid-template-columns:repeat(2, 1fr); }
    .grid-65-35 { grid-template-columns:1fr; }
  }
  @media(max-width:640px) {
    .grid-4, .grid-3 { grid-template-columns:1fr; }
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<section class="page-head">
  <div>
    <h2>Dashboard Kinerja Utama</h2>
    <p>Pantauan eksekutif realisasi Indikator Kinerja Utama (IKU) Tahun Berjalan.</p>
  </div>
  <div class="page-head-meta">
    <span class="sync-dot"></span>
    <span style="font-size:12px; color:var(--muted); font-weight:600;">Sinkron</span>
    <form method="GET" id="formDashboard" style="margin-left:8px;">
      <select name="tahun" class="select-year" onchange="document.getElementById('formDashboard').submit();">
        <option value="2026" {{ $selectedTahun == '2026' ? 'selected' : '' }}>Tahun 2026</option>
        <option value="2025" {{ $selectedTahun == '2025' ? 'selected' : '' }}>Tahun 2025</option>
      </select>
    </form>
  </div>
</section>

{{-- ── 1. KARTU RINGKASAN ── --}}
<div class="grid-4">

  {{-- Rata-Rata Capaian --}}
  <div class="card metric-card">
    <div>
      <div class="metric-label">Rata-Rata Capaian IKU</div>
      <div class="metric-value">{{ number_format($rata_rata_pt, 1, ',', '.') }}%</div>
    </div>
    <div class="metric-icon mi-blue">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>
      </svg>
    </div>
  </div>

  {{-- Status Indikator --}}
  <div class="card metric-card">
    <div>
      <div class="metric-label">Status Indikator</div>
      <div class="metric-value-sm">
        <span style="color:var(--green); font-weight:700;">{{ $aman }}</span><span style="color:var(--muted); font-weight:400;"> Aman &nbsp;</span>
        <span style="color:var(--orange); font-weight:700;">{{ $mendekati }}</span><span style="color:var(--muted); font-weight:400;"> Mendekati &nbsp;</span>
        <span style="color:var(--red); font-weight:700;">{{ $kritis }}</span><span style="color:var(--muted); font-weight:400;"> Kritis</span>
      </div>
    </div>
    <div class="metric-icon mi-green">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
      </svg>
    </div>
  </div>

  {{-- Menunggu Validasi --}}
  <div class="card metric-card">
    <div>
      <div class="metric-label">Menunggu Validasi</div>
      <div class="metric-value">0 <span style="font-size:14px; font-weight:600; color:var(--muted);">Dokumen</span></div>
    </div>
    <div class="metric-icon mi-orange">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="11" x2="12" y2="17"/><line x1="9" y1="14" x2="15" y2="14"/>
      </svg>
    </div>
  </div>

  {{-- Status Data Lake --}}
  <div class="card metric-card">
    <div>
      <div class="metric-label">Status Data Lake</div>
      <div class="metric-value-sm" style="margin-top:14px; display:flex; align-items:center; gap:7px;">
        <span class="sync-dot"></span>
        <span style="font-weight:700; color:var(--navy);">Aktif &amp; Sinkron</span>
      </div>
    </div>
    <div class="metric-icon mi-purple">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
        <ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
      </svg>
    </div>
  </div>

</div>

{{-- ── 2. TIGA DIMENSI IKU ── --}}
<div class="grid-3">

  <div class="card">
    <div class="dim-eyebrow">Dimensi 1</div>
    <div class="dim-title">Kualitas Lulusan</div>
    <div class="dim-value">{{ number_format($dimensi['lulusan'], 1, ',', '.') }}%</div>
    <div class="prog-bar"><div class="prog-fill" style="width:{{ min($dimensi['lulusan'], 100) }}%; background:var(--blue);"></div></div>
  </div>

  <div class="card">
    <div class="dim-eyebrow">Dimensi 2</div>
    <div class="dim-title">Kualitas Dosen</div>
    <div class="dim-value">{{ number_format($dimensi['dosen'], 1, ',', '.') }}%</div>
    <div class="prog-bar"><div class="prog-fill" style="width:{{ min($dimensi['dosen'], 100) }}%; background:var(--orange);"></div></div>
  </div>

  <div class="card">
    <div class="dim-eyebrow">Dimensi 3</div>
    <div class="dim-title">Kurikulum &amp; Tata Kelola</div>
    <div class="dim-value">{{ number_format($dimensi['kurikulum'], 1, ',', '.') }}%</div>
    <div class="prog-bar"><div class="prog-fill" style="width:{{ min($dimensi['kurikulum'], 100) }}%; background:var(--green);"></div></div>
  </div>

</div>

{{-- ── 3. GRAFIK ── --}}
<div class="grid-65-35">

  <div class="card">
    <div class="card-title">
      <div class="card-title-icon">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/>
        </svg>
        <h3>Capaian vs Target 12 IKU ({{ $selectedTahun }})</h3>
      </div>
    </div>
    <div style="height:300px; width:100%;">
      <canvas id="barChart"></canvas>
    </div>
  </div>

  <div class="card">
    <div class="card-title">
      <div class="card-title-icon">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"/><path d="M12 2a10 10 0 0 1 10 10H12z"/>
        </svg>
        <h3>Distribusi Status IKU</h3>
      </div>
    </div>
    <div style="height:220px; width:100%; display:flex; justify-content:center; align-items:center;">
      <canvas id="donutChart"></canvas>
    </div>
    <div class="divider"></div>
    <div style="display:flex; justify-content:center; gap:20px; font-size:12px; font-weight:600;">
      <div style="display:flex; align-items:center; gap:5px;">
        <span style="width:8px; height:8px; border-radius:2px; background:var(--green); display:inline-block;"></span>
        <span style="color:var(--muted);">Tercapai</span>
      </div>
      <div style="display:flex; align-items:center; gap:5px;">
        <span style="width:8px; height:8px; border-radius:2px; background:var(--orange); display:inline-block;"></span>
        <span style="color:var(--muted);">Mendekati</span>
      </div>
      <div style="display:flex; align-items:center; gap:5px;">
        <span style="width:8px; height:8px; border-radius:2px; background:var(--red); display:inline-block;"></span>
        <span style="color:var(--muted);">Kritis</span>
      </div>
    </div>
  </div>

</div>

{{-- ── 4. PRIORITAS & TIMELINE ── --}}
<div class="grid-65-35">

  {{-- Tabel Kritis --}}
  <div class="card">
    <div class="card-title">
      <div class="card-title-icon">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
          <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
        </svg>
        <h3>Prioritas Penanganan</h3>
      </div>
      <button type="button" class="btn-sm" onclick="openModal('modalAllData')">
        Lihat Semua 12 Data
      </button>
    </div>

    @if(count($tabelKritis) > 0)
    <div style="overflow-x:auto;">
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
            <td>
              <span style="font-family:monospace; font-size:12px; background:#f1f5f9; padding:3px 7px; border-radius:5px; font-weight:700; color:var(--navy);">{{ $row->kode }}</span>
            </td>
            <td style="color:var(--text);">{{ $row->nama }}</td>
            <td>
              <div style="display:flex; align-items:center; gap:8px;">
                <span style="font-weight:700; color:var(--red); font-size:14px;">{{ number_format($row->capaian_persen, 2, ',', '.') }}%</span>
                <span class="badge red"><span class="badge-dot"></span>Kritis</span>
              </div>
            </td>
            <td style="width:80px;">
              <button type="button" class="btn-sm" onclick="openModalPeriksa('{{ $row->kode }}', '{{ $row->nama }}', '{{ $row->capaian_persen }}')">Periksa</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <div class="empty-state">
      <div class="empty-icon">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
      </div>
      <p class="empty-title">Tidak Ada Indikator Kritis</p>
      <p class="empty-desc">Seluruh Indikator Kinerja Utama berada di atas ambang batas aman.</p>
    </div>
    @endif
  </div>

  {{-- Timeline --}}
  <div style="display:flex; flex-direction:column; gap:18px;">
    <div class="card" style="flex:1;">
      <div class="card-title">
        <div class="card-title-icon">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
          <h3>Riwayat Sistem</h3>
        </div>
      </div>
      <div class="timeline">

        <div class="tl-item">
          <div class="tl-left">
            <div class="tl-circle">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.37"/>
              </svg>
            </div>
            <div class="tl-line"></div>
          </div>
          <div class="tl-content">
            <div class="tl-time">Hari ini, {{ now()->format('H:i') }}</div>
            <div class="tl-desc">Menyinkronkan data API (Tahun {{ $selectedTahun }}).</div>
          </div>
        </div>

        <div class="tl-item">
          <div class="tl-left">
            <div class="tl-circle">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
              </svg>
            </div>
            <div class="tl-line"></div>
          </div>
          <div class="tl-content">
            <div class="tl-time">Kemarin, 11:00</div>
            <div class="tl-desc">Eksekusi algoritma analitik 3 Dimensi IKU.</div>
          </div>
        </div>

        <div class="tl-item">
          <div class="tl-left">
            <div class="tl-circle">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>
                <path d="M4.93 4.93a10 10 0 0 0 0 14.14"/>
              </svg>
            </div>
            <div class="tl-line"></div>
          </div>
          <div class="tl-content">
            <div class="tl-time">Kemarin, 10:30</div>
            <div class="tl-desc">Penyesuaian konfigurasi tampilan Dashboard oleh Admin.</div>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>

{{-- ── MODALS ── --}}

{{-- Modal 1: Semua Data --}}
<div class="modal-overlay" id="modalAllData">
  <div class="modal-box">
    <button class="modal-close" onclick="closeModal('modalAllData')" aria-label="Tutup">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </button>
    <div class="modal-header">
      <h3>Rekapitulasi 12 Indikator Kinerja Utama</h3>
      <p>Data keseluruhan untuk Tahun Perjanjian Kinerja {{ $selectedTahun }}</p>
    </div>
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
          <td>
            <span style="font-family:monospace; font-size:12px; background:#f1f5f9; padding:3px 7px; border-radius:5px; font-weight:700; color:var(--navy);">{{ $iku->kode }}</span>
          </td>
          <td>{{ $iku->nama }}</td>
          <td style="color:var(--muted);">{{ is_numeric($iku->target)     ? number_format($iku->target,     2, ',', '.') : $iku->target }}</td>
          <td style="font-weight:600;">{{ is_numeric($iku->realisasi) ? number_format($iku->realisasi, 2, ',', '.') : $iku->realisasi }}</td>
          <td style="font-weight:700;">{{ number_format($iku->capaian_persen, 2, ',', '.') }}%</td>
          <td>
            @if($iku->capaian_persen >= 100)
              <span class="badge good"><span class="badge-dot"></span>Tercapai</span>
            @elseif($iku->capaian_persen >= 80)
              <span class="badge warn"><span class="badge-dot"></span>Mendekati</span>
            @else
              <span class="badge red"><span class="badge-dot"></span>Kritis</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- Modal 2: Periksa IKU Kritis --}}
<div class="modal-overlay" id="modalPeriksa">
  <div class="modal-box" style="max-width:600px;">
    <button class="modal-close" onclick="closeModal('modalPeriksa')" aria-label="Tutup">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </button>
    <div class="modal-header">
      <h3>Tindak Lanjut Indikator</h3>
      <p>Analisis singkat untuk indikator kritis.</p>
    </div>

    <div class="alert-critical">
      <h4 id="periksaKode">IKU X</h4>
      <p id="periksaNama">Nama Indikator</p>
    </div>

    <p style="font-size:14px; color:var(--text); margin:0 0 12px;">
      Capaian saat ini berada di angka <strong style="color:var(--red);" id="periksaCapaian">0%</strong>.
    </p>
    <p style="font-size:13px; font-weight:600; color:var(--navy); margin:0 0 10px;">Rekomendasi Tindakan</p>
    <ul style="padding-left:18px; margin:0 0 24px; color:var(--muted); font-size:13px; line-height:1.7;">
      <li>Segera berikan notifikasi peringatan kepada Fakultas yang capaiannya masih di bawah 50%.</li>
      <li>Periksa kembali kelengkapan dokumen eviden yang belum divalidasi oleh pihak Universitas.</li>
      <li>Jika ini adalah data Datalake otomatis, pastikan API SIM Akademik sedang tidak mengalami gangguan.</li>
    </ul>

    <div style="display:flex; justify-content:flex-end; gap:10px;">
      <button class="btn-sm" onclick="closeModal('modalPeriksa')">Tutup</button>
      <button class="btn-sm btn-primary">Kirim Teguran ke Fakultas</button>
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
    if (e.target.classList.contains('modal-overlay')) {
      e.target.classList.remove('active');
      document.body.style.overflow = 'auto';
    }
  };

  document.addEventListener('DOMContentLoaded', function () {

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
            backgroundColor: '#1769e0',
            borderRadius: 5,
            borderSkipped: false,
          },
          {
            label: 'Target Dasar (%)',
            data: @json($chartTargets),
            backgroundColor: '#e5e7eb',
            borderRadius: 5,
            borderSkipped: false,
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
            align: 'end',
            labels: { usePointStyle: true, pointStyle: 'rect', boxWidth: 8, font: { size: 12 } }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: '#f1f5f9', borderDash: [3, 3] },
            ticks: { font: { size: 11 }, color: '#94a3b8' }
          },
          x: {
            grid: { display: false },
            ticks: { font: { size: 11 }, color: '#94a3b8' }
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
          backgroundColor: ['#16a34a', '#f59e0b', '#dc2626'],
          borderWidth: 0,
          hoverOffset: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '72%',
        plugins: { legend: { display: false } }
      }
    });

  });
</script>
@endpush
@endsection