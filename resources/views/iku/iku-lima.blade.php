@extends('layouts.app')

@section('title', 'IKU 5 – Luaran Kerjasama · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 5 – Luaran Kerjasama Industri/Lembaga')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root{--bg:#f7f8fc;--surface:#ffffff;--border:#eaecf0;--border-md:#d0d5dd;--text:#101828;--sub:#344054;--muted:#667085;--faint:#98a2b3;--indigo:#4f46e5;--indigo-lt:#eef2ff;--indigo-dk:#3730a3;--green:#12b76a;--green-lt:#ecfdf3;--green-dk:#027a48;--amber:#f79009;--amber-lt:#fffaeb;--amber-dk:#b54708;--red:#f04438;--red-lt:#fef3f2;--red-dk:#b42318;--purple:#7c3aed;--purple-lt:#f5f3ff;--navy:#082b57;--gold:#f59e0b;--teal:#0d9488;--teal-lt:#f0fdfa;--r-sm:8px;--r-md:12px;--r-lg:16px;--r-xl:20px;--sh-sm:0 1px 3px rgba(16,24,40,.06),0 1px 2px rgba(16,24,40,.04);--sh-md:0 4px 8px -2px rgba(16,24,40,.06),0 2px 4px -2px rgba(16,24,40,.04);}
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
  body{font-family:'Inter',system-ui,sans-serif;background:var(--bg);color:var(--text);}
  .ph{display:flex;justify-content:space-between;align-items:flex-start;gap:20px;flex-wrap:wrap;margin-bottom:24px;}
  .ph-left{display:flex;flex-direction:column;gap:3px;}
  .ph-eyebrow{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--indigo);}
  .ph-title{font-size:22px;font-weight:800;letter-spacing:-.025em;color:var(--text);line-height:1.25;}
  .ph-sub{font-size:13px;color:var(--muted);max-width:680px;line-height:1.55;margin-top:2px;}
  .badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;}
  .badge.wajib{background:var(--indigo-lt);color:var(--indigo-dk);}
  .badge.inovasi{background:#d1fae5;color:#065f46;}
  .notice{background:var(--red-lt);border:1px solid #fecaca;border-radius:var(--r-md);padding:12px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;}
  .notice-icon{color:var(--red);flex-shrink:0;margin-top:1px;}
  .notice-body{flex:1;}
  .notice-title{font-size:13px;font-weight:700;color:var(--red-dk);}
  .notice-desc{font-size:12px;color:var(--red-dk);margin-top:2px;line-height:1.5;}
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
  .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:var(--r-md);border:1px solid var(--border-md);background:var(--surface);color:var(--sub);font-size:13px;font-weight:600;font-family:inherit;cursor:pointer;text-decoration:none;transition:all .15s;}
  .btn:hover{background:var(--bg);}
  .btn.btn-sm{padding:6px 12px;font-size:12px;}
  .tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
  table{width:100%;border-collapse:collapse;font-size:13px;}
  thead th{background:var(--navy);color:#fff;padding:10px 14px;text-align:left;font-size:11px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;white-space:nowrap;}
  tbody tr{border-bottom:1px solid var(--border);}
  tbody tr:last-child{border-bottom:none;}
  tbody tr:hover{background:#f9fafb;}
  tbody td{padding:12px 14px;color:var(--sub);vertical-align:middle;}
  tbody tr.total-row{background:#f0f4fa;font-weight:700;}
  tbody tr.total-row td{color:var(--navy);}
  .prog{min-width:80px;}
  .prog-bar{height:6px;background:#e4e7ec;border-radius:999px;overflow:hidden;margin-top:4px;}
  .prog-fill{height:100%;border-radius:999px;}
  .prog-lbl{font-size:11px;font-weight:700;}
  .st{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:999px;font-size:11px;font-weight:600;}
  .st-green{background:var(--green-lt);color:var(--green-dk);}
  .st-amber{background:var(--amber-lt);color:var(--amber-dk);}
  .st-red{background:var(--red-lt);color:var(--red-dk);}
  .st-dot{width:5px;height:5px;border-radius:50%;background:currentColor;}
  /* Big metric */
  .big-metric{text-align:center;padding:32px 20px;background:linear-gradient(135deg,var(--navy) 0%,#1a4a8a 100%);color:#fff;border-radius:var(--r-lg);margin-bottom:16px;}
  .big-metric-label{font-size:12px;font-weight:600;opacity:.7;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;}
  .big-metric-val{font-size:56px;font-weight:900;letter-spacing:-.04em;line-height:1;}
  .big-metric-target{font-size:18px;color:var(--gold);font-weight:700;margin-top:8px;}
  .big-metric-sub{font-size:12px;opacity:.6;margin-top:6px;}
  .progress-ring{width:120px;height:120px;margin:20px auto;}
  /* Luaran types */
  .luaran-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:16px 20px;}
  .luaran-item{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);padding:14px;text-align:center;}
  .luaran-icon{width:36px;height:36px;border-radius:var(--r-sm);background:var(--indigo-lt);color:var(--indigo);display:flex;align-items:center;justify-content:center;margin:0 auto 8px;}
  .luaran-type{font-size:12px;font-weight:700;color:var(--text);margin-bottom:3px;}
  .luaran-desc{font-size:10px;color:var(--muted);line-height:1.5;}
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
  @media(max-width:900px){.sum-grid{grid-template-columns:repeat(2,1fr);}.luaran-grid{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:768px){.ph-title{font-size:18px;}.sum-grid{gap:8px;}.sc{padding:12px;}.sc-val{font-size:20px;}table{min-width:520px;font-size:12px;}thead th{font-size:10px;padding:8px;}tbody td{padding:10px;}.big-metric-val{font-size:38px;}}
  @media(max-width:580px){.sum-grid{grid-template-columns:repeat(2,1fr);}.luaran-grid{grid-template-columns:1fr;}.side{display:flex;flex-direction:column;gap:12px;}}
</style>
@endpush

@section('content')

<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Dimensi Inovasi</div>
    <div class="ph-title">
      IKU 5 – Luaran Kerjasama PT dengan Start-Up / Industri / Lembaga
      <span class="badge wajib" style="vertical-align:middle;margin-left:6px;font-size:11px;">IKU Wajib</span>
      <span class="badge inovasi" style="vertical-align:middle;margin-left:4px;font-size:11px;">Inovasi</span>
    </div>
    <div class="ph-sub">
      Persentase luaran hasil kerjasama antara PT dengan startup, industri, atau lembaga mitra dari total kerjasama yang telah ditandatangani. PJ: WR3. Unit: DIH, DPP, DKIA, Dekan/WD3.
    </div>
  </div>
</section>

{{-- Notice Kritis --}}
<div class="notice">
  <div class="notice-icon"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
  <div class="notice-body">
    <div class="notice-title">⚠ Status Kritis — Gap Target Sangat Besar</div>
    <div class="notice-desc">Baseline 2025 hanya <strong>{{ number_format($baseline, 2, ',', '.') }}%</strong> vs Target 2026 <strong>{{ number_format($target, 2, ',', '.') }}%</strong>. Kenaikan yang diperlukan = <strong>+{{ number_format($target - $baseline, 2, ',', '.') }} pp</strong>. IKU ini memerlukan perhatian dan intervensi segera dari Rektorat.</div>
  </div>
  <div style="font-size:11px;color:var(--red-dk);font-weight:700;background:var(--red-lt);padding:4px 10px;border-radius:999px;white-space:nowrap;align-self:center;">STATUS KRITIS</div>
</div>

<div class="sum-grid">
  <div class="sc">
    <div>
      <div class="sc-lbl">Baseline 2025</div>
      <div class="sc-val">{{ number_format($baseline ?? 0.58, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
    </div>
    <div class="sc-ic ic-red"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Target 2026</div>
      <div class="sc-val">{{ number_format($target ?? 5.00, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
    </div>
    <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Gap ke Target</div>
      <div class="sc-val" style="color:var(--red);">+{{ number_format($target - $baseline, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">pp</span></div>
    </div>
    <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg></div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Target Luaran</div>
      <div class="sc-val" style="color:var(--navy);">{{ $target_luaran }}</div>
    </div>
    <div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div>
  </div>
</div>

<div class="lay">
  <div>

    {{-- Big metric --}}
    {{-- $prog dari controller --}}
    <div class="big-metric">
      <div class="big-metric-label">Progres Baseline → Target 2026</div>
      <div class="big-metric-val">{{ $prog }}%</div>
      <div class="big-metric-target">Target: {{ number_format($target, 2, ',', '.') }}% ({{ $target_luaran }} luaran kerjasama)</div>
      <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;">
        <div style="width:{{ $prog }}%;height:100%;background:var(--gold);border-radius:999px;"></div>
      </div>
      <div class="big-metric-sub">Posisi saat ini: {{ number_format($baseline, 2, ',', '.') }}% dari total kerjasama aktif PT</div>
    </div>

    {{-- Tabel --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
          <div><div class="ch-title">Rekap Target & Realisasi IKU 5</div><div class="ch-sub">Kerjasama aktif · Luaran dihasilkan · Target 2026</div></div>
        </div>
        <a href="#" class="btn btn-sm">Export</a>
      </div>
      <div class="cp">
        <div class="tbl-wrap">
          <table>
            <thead>
              <tr>
                <th>Metrik</th>
                <th>Baseline 2025</th>
                <th>Target 2026</th>
                <th>Kenaikan Diperlukan</th>
                <th>Progres</th>
                <th>Realisasi*</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>% Luaran Kerjasama</strong><div style="font-size:11px;color:var(--muted);">terhadap total kerjasama PT</div></td>
                <td>{{ number_format($baseline, 2, ',', '.') }}%</td>
                <td><strong style="color:var(--navy);">{{ number_format($target, 2, ',', '.') }}%</strong></td>
                <td style="color:var(--red-dk);">+{{ number_format($target - $baseline, 2, ',', '.') }} pp</td>
                <td class="prog">
                  <div class="prog-lbl" style="color:var(--red);">{{ $prog }}%</div>
                  <div class="prog-bar"><div class="prog-fill" style="width:{{ $prog }}%;background:var(--red);"></div></div>
                </td>
                <td style="color:var(--muted);">–</td>
                <td><span class="st st-red"><span class="st-dot"></span>Kritis</span></td>
              </tr>
              <tr>
                <td><strong>Jumlah Luaran (estimasi)</strong><div style="font-size:11px;color:var(--muted);">judul/karya, bukan jumlah dosen</div></td>
                <td>~{{ round($baseline * 17) }} luaran</td>
                <td><strong style="color:var(--navy);">{{ $target_luaran }} luaran</strong></td>
                <td style="color:var(--red-dk);">+{{ $target_luaran - round($baseline * 17) }} luaran</td>
                <td class="prog">
                  <div class="prog-lbl" style="color:var(--red);">{{ round($baseline / ($target_luaran / 87) / 5 * 100, 1) }}%</div>
                  <div class="prog-bar"><div class="prog-fill" style="width:{{ min(round($baseline * 17 / $target_luaran * 100, 1), 100) }}%;background:var(--red);"></div></div>
                </td>
                <td style="color:var(--muted);">–</td>
                <td><span class="st st-red"><span class="st-dot"></span>Kritis</span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div style="font-size:11px;color:var(--muted);margin-top:10px;">*Realisasi aktual dari sistem SRIKANDI/DKIA — akan diperbarui saat API aktif.</div>
      </div>
    </div>

    {{-- Jenis Luaran --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon" style="background:var(--teal-lt);color:var(--teal);"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/></svg></div>
          <div><div class="ch-title">Jenis Luaran yang Diperhitungkan</div><div class="ch-sub">Kepmen 358/M/KEP/2026 – Kriteria IKU 5</div></div>
        </div>
      </div>
      <div class="luaran-grid">
        <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div><div class="luaran-type">Jurnal / Buku Kolaborasi</div><div class="luaran-desc">Karya tulis ilmiah dengan mitra sebagai co-author/penyandang dana</div></div>
        <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div class="luaran-type">Paten / HKI Kolaborasi</div><div class="luaran-desc">Paten atau HKI yang dihasilkan bersama industri/lembaga mitra</div></div>
        <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div><div class="luaran-type">Teknologi / Prototype</div><div class="luaran-desc">Produk inovasi / prototype yang dikembangkan bersama mitra</div></div>
        <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div><div class="luaran-type">Layanan / Jasa Konsultasi</div><div class="luaran-desc">Layanan profesional / konsultasi teknis yang dikontrakkan</div></div>
        <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/></svg></div><div class="luaran-type">Pelatihan / Capacity Building</div><div class="luaran-desc">Program pelatihan SDM mitra yang dilaksanakan PT</div></div>
        <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div><div class="luaran-type">Riset Bersama Industri</div><div class="luaran-desc">Penelitian terapan yang dibiayai & dilaksanakan bersama mitra industri</div></div>
      </div>
    </div>

  </div>

  {{-- Sidebar --}}
  <div class="side">
    <div class="side-card">
      <div class="side-head"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><div class="side-head-title">TARGET PK REKTOR 2026</div></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val" style="color:var(--red);">{{ number_format($baseline, 2, ',', '.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ number_format($target, 2, ',', '.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Kenaikan</span><span class="tgt-val" style="color:var(--red-dk);">+{{ number_format($target - $baseline, 2, ',', '.') }} pp</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Est. Luaran</span><span class="tgt-val" style="color:var(--navy);">{{ $target_luaran }} judul/karya</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Satuan</span><span class="tgt-val">% Kerjasama</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR3 / DIH</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg><div class="side-head-title">FORMULA</div></div>
      <div class="side-body">
        <div class="formula">
          <strong>Formula (Kepmen 358/2026):</strong><br>
          <code style="font-size:11px;">Σ Luaran kerjasama PT & startup/industri/lembaga ÷ Total Kerjasama PT × 100%</code><br><br>
          <strong>Keterangan:</strong><br>
          <span style="font-size:11px;color:var(--muted);">Dihitung per judul/karya, BUKAN per jumlah dosen. Luaran harus sudah dimanfaatkan/diterapkan mitra dan dibuktikan dengan dokumen resmi.</span>
        </div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#7c2d12;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg><div class="side-head-title">INTERVENSI PRIORITAS</div></div>
      <div class="side-body">
        <div style="font-size:12px;color:var(--sub);line-height:1.7;">
          <p style="color:var(--red-dk);font-weight:700;">⚠ Status Kritis — Prioritas Utama</p>
          <p style="margin-top:8px;">• Inventarisasi MoU yang belum menghasilkan luaran</p>
          <p style="margin-top:6px;">• Matching fund riset dengan BUMN/Swasta nasional</p>
          <p style="margin-top:6px;">• Buat SOP klaim luaran kerjasama yg mudah</p>
          <p style="margin-top:6px;">• Laporan rutin bulanan ke WR3 & Rektorat</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection