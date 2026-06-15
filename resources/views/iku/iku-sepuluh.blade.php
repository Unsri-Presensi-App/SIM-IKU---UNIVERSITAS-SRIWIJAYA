{{-- ============================================================
     IKU 10 | resources/views/iku/iku-sepuluh.blade.php
     Usulan Satuan Kerja Menuju Zona Integritas WBK/WBBM
     Baseline 2025: 0 unit | Target 2026: 2 unit kerja
     ============================================================ --}}
@extends('layouts.app')
@section('title', 'IKU 10 – Zona Integritas WBK/WBBM · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 10 – Zona Integritas WBK/WBBM')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root{--bg:#f7f8fc;--surface:#fff;--border:#eaecf0;--border-md:#d0d5dd;--text:#101828;--sub:#344054;--muted:#667085;--faint:#98a2b3;--indigo:#4f46e5;--indigo-lt:#eef2ff;--indigo-dk:#3730a3;--green:#12b76a;--green-lt:#ecfdf3;--green-dk:#027a48;--amber:#f79009;--amber-lt:#fffaeb;--amber-dk:#b54708;--red:#f04438;--red-lt:#fef3f2;--red-dk:#b42318;--purple:#7c3aed;--purple-lt:#f5f3ff;--navy:#082b57;--gold:#f59e0b;--teal:#0d9488;--teal-lt:#f0fdfa;--r-sm:8px;--r-md:12px;--r-lg:16px;--r-xl:20px;--sh-sm:0 1px 3px rgba(16,24,40,.06),0 1px 2px rgba(16,24,40,.04);--sh-md:0 4px 8px -2px rgba(16,24,40,.06),0 2px 4px -2px rgba(16,24,40,.04);}
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
  body{font-family:'Inter',system-ui,sans-serif;background:var(--bg);color:var(--text);}
  .ph{display:flex;justify-content:space-between;align-items:flex-start;gap:20px;flex-wrap:wrap;margin-bottom:24px;}
  .ph-left{display:flex;flex-direction:column;gap:3px;}
  .ph-eyebrow{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--indigo);}
  .ph-title{font-size:22px;font-weight:800;letter-spacing:-.025em;color:var(--text);line-height:1.25;}
  .ph-sub{font-size:13px;color:var(--muted);max-width:680px;line-height:1.55;margin-top:2px;}
  .badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;}
  .badge.wajib{background:var(--indigo-lt);color:var(--indigo-dk);}
  .badge.tata{background:#fce7f3;color:#9d174d;}
  .notice{background:var(--amber-lt);border:1px solid #fde68a;border-radius:var(--r-md);padding:12px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;}
  .notice-title{font-size:13px;font-weight:700;color:var(--amber-dk);}
  .notice-desc{font-size:12px;color:var(--amber-dk);margin-top:2px;line-height:1.5;}
  .sum-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;}
  .sc{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);padding:16px;display:flex;align-items:flex-start;justify-content:space-between;gap:12px;}
  .sc-lbl{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px;}
  .sc-val{font-size:26px;font-weight:800;letter-spacing:-.03em;color:var(--text);line-height:1;}
  .sc-ic{width:36px;height:36px;border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
  .ic-red{background:var(--red-lt);color:var(--red);}
  .ic-green{background:var(--green-lt);color:var(--green-dk);}
  .ic-amber{background:var(--amber-lt);color:var(--amber);}
  .ic-navy{background:#e8f0fb;color:var(--navy);}
  .ic-teal{background:var(--teal-lt);color:var(--teal);}
  .lay{display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;}
  .side{position:sticky;top:20px;display:flex;flex-direction:column;gap:14px;}
  .card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;margin-bottom:16px;}
  .card:last-child{margin-bottom:0;}
  .ch{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:16px 20px;border-bottom:1px solid var(--border);}
  .ch-left{display:flex;align-items:center;gap:10px;}
  .ch-icon{width:30px;height:30px;border-radius:var(--r-sm);background:var(--indigo-lt);display:flex;align-items:center;justify-content:center;color:var(--indigo);flex-shrink:0;}
  .ch-title{font-size:14px;font-weight:700;color:var(--text);}
  .ch-sub{font-size:11px;color:var(--muted);margin-top:1px;}
  .cp{padding:16px 20px;}
  .big-metric{text-align:center;padding:32px 20px;background:linear-gradient(135deg,var(--navy) 0%,#1a4a8a 100%);color:#fff;border-radius:var(--r-lg);margin-bottom:16px;}
  .big-metric-label{font-size:12px;font-weight:600;opacity:.7;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;}
  .big-metric-val{font-size:56px;font-weight:900;letter-spacing:-.04em;line-height:1;}
  .big-metric-target{font-size:18px;color:var(--gold);font-weight:700;margin-top:8px;}
  /* ZI Stages */
  .zi-stages{display:flex;flex-direction:column;gap:0;padding:16px 20px;}
  .zi-stage{display:flex;gap:14px;align-items:flex-start;position:relative;padding-bottom:20px;}
  .zi-stage:last-child{padding-bottom:0;}
  .zi-stage::before{content:'';position:absolute;left:17px;top:36px;bottom:0;width:2px;background:var(--border);}
  .zi-stage:last-child::before{display:none;}
  .zi-dot{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:800;flex-shrink:0;border:2px solid var(--border);}
  .zi-dot.done{background:var(--green-lt);color:var(--green-dk);border-color:var(--green);}
  .zi-dot.active{background:var(--amber-lt);color:var(--amber-dk);border-color:var(--amber);}
  .zi-dot.pending{background:#f8f9fd;color:var(--muted);border-color:var(--border);}
  .zi-body{flex:1;}
  .zi-title{font-size:13px;font-weight:700;color:var(--text);margin-bottom:3px;}
  .zi-desc{font-size:12px;color:var(--muted);line-height:1.5;}
  .zi-tag{display:inline-flex;padding:2px 8px;border-radius:999px;font-size:10px;font-weight:700;margin-top:4px;}
  .zi-tag.done{background:var(--green-lt);color:var(--green-dk);}
  .zi-tag.active{background:var(--amber-lt);color:var(--amber-dk);}
  .zi-tag.pending{background:#f1f5f9;color:var(--muted);}
  /* Unit Table */
  .tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
  table{width:100%;border-collapse:collapse;min-width:480px;}
  thead th{background:var(--navy);color:#fff;font-size:11px;font-weight:700;padding:10px 14px;text-align:left;letter-spacing:.04em;}
  tbody tr{border-bottom:1px solid var(--border);}
  tbody tr:last-child{border-bottom:none;}
  tbody tr:nth-child(even){background:#fafafa;}
  tbody td{padding:10px 14px;font-size:13px;color:var(--sub);}
  td strong{color:var(--text);font-weight:600;}
  .st{display:inline-flex;padding:2px 8px;border-radius:999px;font-size:10px;font-weight:700;}
  .st-green{background:var(--green-lt);color:var(--green-dk);}
  .st-amber{background:var(--amber-lt);color:var(--amber-dk);}
  .st-red{background:var(--red-lt);color:var(--red-dk);}
  .st-blue{background:var(--indigo-lt);color:var(--indigo-dk);}
  /* 6 area change */
  .area-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:16px 20px;}
  .area-item{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);padding:12px;text-align:center;}
  .area-num{width:32px;height:32px;border-radius:50%;background:var(--navy);color:#fff;font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center;margin:0 auto 8px;}
  .area-name{font-size:11px;font-weight:700;color:var(--text);line-height:1.4;}
  .area-sub{font-size:10px;color:var(--muted);margin-top:3px;line-height:1.4;}
  .side-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;}
  .side-head{background:var(--navy);padding:12px 16px;display:flex;align-items:center;gap:8px;}
  .side-head-title{font-size:12px;font-weight:700;color:#fff;letter-spacing:.03em;}
  .side-body{padding:14px 16px;}
  .tgt-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);font-size:13px;}
  .tgt-row:last-child{border-bottom:none;}
  .tgt-lbl{color:var(--muted);font-weight:500;}
  .tgt-val{font-weight:700;color:var(--text);}
  .formula{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-sm);padding:12px 14px;font-size:12px;color:var(--sub);line-height:1.6;margin-top:10px;}
  @media(max-width:1100px){.lay{grid-template-columns:1fr;}.side{position:static;}}
  @media(min-width:581px) and (max-width:1100px){.side{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;}}
  @media(max-width:900px){.sum-grid{grid-template-columns:repeat(2,1fr);}.area-grid{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:768px){.ph-title{font-size:18px;}.sum-grid{gap:8px;}.sc{padding:12px;}.sc-val{font-size:20px;}.big-metric-val{font-size:38px;}.big-metric{padding:20px 16px;}}
  @media(max-width:580px){.sum-grid{grid-template-columns:repeat(2,1fr);}.area-grid{grid-template-columns:repeat(2,1fr);}.side{display:flex;flex-direction:column;gap:12px;}}
  @media(max-width:400px){.sum-grid{grid-template-columns:1fr;}.area-grid{grid-template-columns:1fr;}}
</style>
@endpush
@section('content')
<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Dimensi Tata Kelola</div>
    <div class="ph-title">
      IKU 10 – Usulan Satuan Kerja Menuju WBK/WBBM
      <span class="badge wajib" style="vertical-align:middle;margin-left:6px;">IKU Wajib</span>
      <span class="badge tata" style="vertical-align:middle;margin-left:4px;">Tata Kelola</span>
    </div>
    <div class="ph-sub">Jumlah satuan kerja (unit kerja) yang diusulkan menuju Zona Integritas – Wilayah Bebas dari Korupsi (WBK) dan Wilayah Birokrasi Bersih dan Melayani (WBBM). PJ: Sekretaris Universitas & WR2.</div>
  </div>
</section>

<div class="notice">
  <div style="color:var(--amber);flex-shrink:0;"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
  <div><div class="notice-title">Data Progres Sementara</div><div class="notice-desc">Baseline 2025 = <strong>0 unit kerja</strong>. UNSRI belum memiliki unit kerja berpredikat WBK/WBBM. Target 2026: minimal <strong>2 unit kerja</strong> diusulkan. Proses pembangunan ZI dimulai tahun 2026.</div></div>
  <div style="font-size:11px;color:var(--amber-dk);font-weight:600;white-space:nowrap;align-self:center;">Mode sementara</div>
</div>

@php
  $baseline = $baseline ?? 0;
  $target = $target ?? 2;
  $realisasi = $realisasi ?? 0;
  $prog = $target > 0 ? round($realisasi / $target * 100, 1) : 0;
@endphp

<div class="sum-grid">
  <div class="sc">
    <div>
      <div class="sc-lbl">Baseline 2025</div>
      <div class="sc-val">{{ $baseline }}<span style="font-size:14px;font-weight:600;color:var(--muted);"> unit</span></div>
      <div style="font-size:11px;color:var(--red);margin-top:4px;">Belum ada WBK/WBBM</div>
    </div>
    <div class="sc-ic ic-red">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
    </div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Target 2026</div>
      <div class="sc-val">{{ $target }}<span style="font-size:14px;font-weight:600;color:var(--muted);"> unit</span></div>
      <div style="font-size:11px;color:var(--green-dk);margin-top:4px;">WBK / WBBM</div>
    </div>
    <div class="sc-ic ic-green">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
    </div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Realisasi 2026</div>
      <div class="sc-val" style="color:var(--amber);">{{ $realisasi }}<span style="font-size:14px;font-weight:600;color:var(--muted);"> unit</span></div>
      <div style="font-size:11px;color:var(--amber-dk);margin-top:4px;">Dalam proses pembangunan</div>
    </div>
    <div class="sc-ic ic-amber">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
    </div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Progres Pencapaian</div>
      <div class="sc-val" style="color:{{ $prog >= 100 ? 'var(--green-dk)' : ($prog >= 50 ? 'var(--amber)' : 'var(--red)') }};">{{ $prog }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      <div style="font-size:11px;color:var(--muted);margin-top:4px;">dari target</div>
    </div>
    <div class="sc-ic ic-teal">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
    </div>
  </div>
</div>

<div class="lay">
  <div>
    <div class="big-metric">
      <div class="big-metric-label">Target Pembangunan ZI 2026</div>
      <div class="big-metric-val">{{ $target }} Unit</div>
      <div class="big-metric-target">Menuju WBK / WBBM</div>
      <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;">
        <div style="width:{{ min($prog,100) }}%;height:100%;background:var(--gold);border-radius:999px;transition:width .4s;"></div>
      </div>
      <div style="font-size:12px;opacity:.6;margin-top:8px;">{{ $realisasi }} unit diusulkan dari {{ $target }} unit target · {{ $prog }}%</div>
    </div>

    {{-- Tahapan Pembangunan ZI --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon" style="background:var(--teal-lt);color:var(--teal);">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
          </div>
          <div><div class="ch-title">Tahapan Pembangunan Zona Integritas</div><div class="ch-sub">Proses menuju predikat WBK dan WBBM dari KemenPANRB</div></div>
        </div>
      </div>
      <div class="zi-stages">
        <div class="zi-stage">
          <div class="zi-dot done">1</div>
          <div class="zi-body">
            <div class="zi-title">Pencanangan / Deklarasi ZI</div>
            <div class="zi-desc">Komitmen pimpinan universitas untuk membangun Zona Integritas. Penandatanganan pakta integritas seluruh civitas akademika.</div>
            <span class="zi-tag done">✓ Selesai</span>
          </div>
        </div>
        <div class="zi-stage">
          <div class="zi-dot active">2</div>
          <div class="zi-body">
            <div class="zi-title">Pembangunan ZI di Unit Kerja Terpilih</div>
            <div class="zi-desc">Implementasi 6 area perubahan di unit kerja terpilih (Fakultas/Unit). Pembentukan Tim Pokja ZI di setiap unit. Pemenuhan LKE (Lembar Kerja Evaluasi).</div>
            <span class="zi-tag active">⚡ Sedang Berjalan</span>
          </div>
        </div>
        <div class="zi-stage">
          <div class="zi-dot pending">3</div>
          <div class="zi-body">
            <div class="zi-title">Penilaian Internal (Tim Penilai Internal / TPI)</div>
            <div class="zi-desc">Evaluasi internal oleh tim yang ditetapkan Rektor. Penilaian LKE minimum 75 untuk WBK dan 85 untuk WBBM.</div>
            <span class="zi-tag pending">Menunggu</span>
          </div>
        </div>
        <div class="zi-stage">
          <div class="zi-dot pending">4</div>
          <div class="zi-body">
            <div class="zi-title">Usulan ke KemenPANRB / Kemenristekdikti</div>
            <div class="zi-desc">Pengajuan unit kerja calon WBK/WBBM beserta dokumen LKE dan bukti dukung kepada KemenPANRB melalui Kemendikbudristek.</div>
            <span class="zi-tag pending">Menunggu</span>
          </div>
        </div>
        <div class="zi-stage">
          <div class="zi-dot pending">5</div>
          <div class="zi-body">
            <div class="zi-title">Penilaian Eksternal & Penetapan Predikat</div>
            <div class="zi-desc">Penilaian oleh Tim Penilai Nasional (TPN) dari KemenPANRB. Penetapan predikat WBK (skor ≥75) atau WBBM (skor ≥85).</div>
            <span class="zi-tag pending">Target: Desember 2026</span>
          </div>
        </div>
      </div>
    </div>

    {{-- 6 Area Perubahan --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon" style="background:#fce7f3;color:#9d174d;">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <div><div class="ch-title">6 Area Perubahan Zona Integritas</div><div class="ch-sub">Komponen wajib pembangunan ZI menuju WBK/WBBM (PermenPANRB No. 52/2014)</div></div>
        </div>
      </div>
      <div class="area-grid">
        <div class="area-item">
          <div class="area-num">I</div>
          <div class="area-name">Manajemen Perubahan</div>
          <div class="area-sub">Tim kerja, budaya integritas, agen perubahan</div>
        </div>
        <div class="area-item">
          <div class="area-num">II</div>
          <div class="area-name">Penataan Tatalaksana</div>
          <div class="area-sub">SOP, e-Office, keterbukaan informasi</div>
        </div>
        <div class="area-item">
          <div class="area-num">III</div>
          <div class="area-name">Penataan Sistem Manajemen SDM</div>
          <div class="area-sub">Pola mutasi, pengembangan pegawai, kinerja individu</div>
        </div>
        <div class="area-item">
          <div class="area-num">IV</div>
          <div class="area-name">Penguatan Akuntabilitas</div>
          <div class="area-sub">Keterlibatan pimpinan, pengelolaan akuntabilitas</div>
        </div>
        <div class="area-item">
          <div class="area-num">V</div>
          <div class="area-name">Penguatan Pengawasan</div>
          <div class="area-sub">Pengendalian gratifikasi, LHKPN, WBS, benturan kepentingan</div>
        </div>
        <div class="area-item">
          <div class="area-num">VI</div>
          <div class="area-name">Peningkatan Kualitas Pelayanan Publik</div>
          <div class="area-sub">Standar pelayanan, budaya pelayanan prima, kepuasan pengguna</div>
        </div>
      </div>
    </div>

    {{-- Unit Kerja Kandidat --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon" style="background:#e8f0fb;color:var(--navy);">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
          </div>
          <div><div class="ch-title">Unit Kerja Kandidat ZI 2026</div><div class="ch-sub">Satuan kerja yang diusulkan sebagai calon WBK/WBBM tahun 2026</div></div>
        </div>
      </div>
      <div class="tbl-wrap">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Unit Kerja</th>
              <th>PJ</th>
              <th>Predikat Dicapai</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @php
              $units = [
                ['no'=>1,'unit'=>'Unit Kerja Terpilih 1 (TBD)','pj'=>'Dekan / WD2','predikat'=>'WBK','status'=>'amber','status_label'=>'Dalam Penentuan'],
                ['no'=>2,'unit'=>'Unit Kerja Terpilih 2 (TBD)','pj'=>'Dekan / WD2','predikat'=>'WBK','status'=>'amber','status_label'=>'Dalam Penentuan'],
              ];
            @endphp
            @foreach($units as $u)
            <tr>
              <td>{{ $u['no'] }}</td>
              <td><strong>{{ $u['unit'] }}</strong></td>
              <td>{{ $u['pj'] }}</td>
              <td><span class="st st-blue">{{ $u['predikat'] }}</span></td>
              <td><span class="st st-{{ $u['status'] }}">{{ $u['status_label'] }}</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="cp" style="padding-top:12px;">
        <div style="font-size:11px;color:var(--muted);"><strong>Catatan:</strong> Unit kerja kandidat akan ditetapkan oleh Rektor melalui SK. Kriteria pemilihan: kesiapan SDM, komitmen pimpinan unit, rekam jejak layanan, dan dukungan dokumen LKE.</div>
      </div>
    </div>
  </div>

  <div class="side">
    <div class="side-card">
      <div class="side-head">
        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <div class="side-head-title">TARGET PK REKTOR 2026</div>
      </div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val" style="color:var(--red);">{{ $baseline }} unit</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ $target }} unit</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Realisasi Saat Ini</span><span class="tgt-val" style="color:var(--amber);">{{ $realisasi }} unit</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Skor WBK Min.</span><span class="tgt-val">75 poin</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Skor WBBM Min.</span><span class="tgt-val">85 poin</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ Utama</span><span class="tgt-val">Sek. Univ.</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">PJ Teknis</span><span class="tgt-val">WR2 / Ketua ZI</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#065f46;">
        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/></svg>
        <div class="side-head-title">PREDIKAT WBK / WBBM</div>
      </div>
      <div class="side-body">
        <div class="tgt-row">
          <span class="tgt-lbl">WBK</span>
          <span style="font-size:12px;font-weight:700;color:var(--navy);">Wilayah Bebas Korupsi</span>
        </div>
        <div class="tgt-row" style="border:none;">
          <span class="tgt-lbl">WBBM</span>
          <span style="font-size:12px;font-weight:700;color:var(--navy);">WBK + Birokrasi Bersih Melayani</span>
        </div>
        <div class="formula">
          <strong>Dasar Hukum:</strong><br>
          PermenPANRB No. 52 Tahun 2014 tentang Pedoman Pembangunan Zona Integritas<br><br>
          <strong>Penilai:</strong><br>
          Tim Penilai Internal (TPI) → Tim Penilai Nasional (TPN) KemenPANRB
        </div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;">
        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>
        <div class="side-head-title">TIMELINE 2026</div>
      </div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Jan–Mar</span><span class="tgt-val" style="font-size:12px;">Penentuan unit kerja</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Apr–Aug</span><span class="tgt-val" style="font-size:12px;">Pembangunan ZI & LKE</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Sep–Oct</span><span class="tgt-val" style="font-size:12px;">Penilaian TPI internal</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Nov</span><span class="tgt-val" style="font-size:12px;">Usulan ke KemenPANRB</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">Des</span><span class="tgt-val" style="font-size:12px;">Penetapan predikat</span></div>
      </div>
    </div>
  </div>
</div>
@endsection