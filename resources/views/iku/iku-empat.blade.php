@extends('layouts.app')

@section('title', 'IKU 4 – Rekognisi Internasional Dosen · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 4 – Rekognisi Internasional Dosen')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root{--bg:#f7f8fc;--surface:#ffffff;--border:#eaecf0;--border-md:#d0d5dd;--text:#101828;--sub:#344054;--muted:#667085;--faint:#98a2b3;--indigo:#4f46e5;--indigo-lt:#eef2ff;--indigo-dk:#3730a3;--green:#12b76a;--green-lt:#ecfdf3;--green-dk:#027a48;--amber:#f79009;--amber-lt:#fffaeb;--amber-dk:#b54708;--red:#f04438;--red-lt:#fef3f2;--red-dk:#b42318;--purple:#7c3aed;--purple-lt:#f5f3ff;--navy:#082b57;--gold:#f59e0b;--r-sm:8px;--r-md:12px;--r-lg:16px;--r-xl:20px;--sh-sm:0 1px 3px rgba(16,24,40,.06),0 1px 2px rgba(16,24,40,.04);--sh-md:0 4px 8px -2px rgba(16,24,40,.06),0 2px 4px -2px rgba(16,24,40,.04);}
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
  body{font-family:'Inter',system-ui,sans-serif;background:var(--bg);color:var(--text);}
  .ph{display:flex;justify-content:space-between;align-items:flex-start;gap:20px;flex-wrap:wrap;margin-bottom:24px;}
  .ph-left{display:flex;flex-direction:column;gap:3px;}
  .ph-eyebrow{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--indigo);}
  .ph-title{font-size:22px;font-weight:800;letter-spacing:-.025em;color:var(--text);line-height:1.25;}
  .ph-sub{font-size:13px;color:var(--muted);max-width:680px;line-height:1.55;margin-top:2px;}
  .badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;}
  .badge.pilihan{background:#fce7f3;color:#9d174d;}
  .badge.inovasi{background:#d1fae5;color:#065f46;}
  .notice{background:var(--amber-lt);border:1px solid #fde68a;border-radius:var(--r-md);padding:12px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;}
  .notice-icon{color:var(--amber);flex-shrink:0;margin-top:1px;}
  .notice-body{flex:1;}
  .notice-title{font-size:13px;font-weight:700;color:var(--amber-dk);}
  .notice-desc{font-size:12px;color:var(--amber-dk);margin-top:2px;line-height:1.5;}
  .sum-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;}
  .sc{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);padding:16px;display:flex;align-items:flex-start;justify-content:space-between;gap:12px;}
  .sc-lbl{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px;}
  .sc-val{font-size:26px;font-weight:800;letter-spacing:-.03em;color:var(--text);line-height:1;}
  .sc-ic{width:36px;height:36px;border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
  .ic-indigo{background:var(--indigo-lt);color:var(--indigo);}
  .ic-green{background:var(--green-lt);color:var(--green-dk);}
  .ic-amber{background:var(--amber-lt);color:var(--amber);}
  .ic-red{background:var(--red-lt);color:var(--red);}
  .ic-navy{background:#e8f0fb;color:var(--navy);}
  .ic-purple{background:var(--purple-lt);color:var(--purple);}
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
  /* Dual metric panel */
  .dual-panel{display:grid;grid-template-columns:1fr 1fr;gap:16px;padding:16px 20px;}
  .metric-box{border:1px solid var(--border);border-radius:var(--r-lg);padding:20px;text-align:center;position:relative;overflow:hidden;}
  .metric-box::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;}
  .metric-box.rekognisi::before{background:var(--indigo);}
  .metric-box.s3::before{background:var(--purple);}
  .metric-label{font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:12px;}
  .metric-baseline{font-size:32px;font-weight:800;color:var(--text);letter-spacing:-.04em;line-height:1;}
  .metric-target{font-size:14px;color:var(--green-dk);font-weight:600;margin-top:6px;}
  .metric-desc{font-size:11px;color:var(--muted);margin-top:4px;}
  .side-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;}
  .side-head{background:var(--navy);padding:12px 16px;display:flex;align-items:center;gap:8px;}
  .side-head-title{font-size:12px;font-weight:700;color:#fff;letter-spacing:.03em;}
  .side-body{padding:14px 16px;}
  .tgt-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);font-size:13px;}
  .tgt-row:last-child{border-bottom:none;}
  .tgt-lbl{color:var(--muted);font-weight:500;}
  .tgt-val{font-weight:700;color:var(--text);}
  .formula{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-sm);padding:12px 14px;font-size:12px;color:var(--sub);line-height:1.6;margin-top:10px;}
  .view-note{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);background:#f8f9fd;border-radius:var(--r-sm);padding:8px 12px;margin-bottom:12px;}
  /* Kriteria grid */
  .criteria-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:12px;}
  .crit-item{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-sm);padding:10px 12px;font-size:11px;color:var(--sub);line-height:1.5;}
  .crit-item strong{color:var(--navy);display:block;margin-bottom:3px;}
  @media(max-width:1100px){.lay{grid-template-columns:1fr;}.side{position:static;}}
  @media(min-width:581px) and (max-width:1100px){.side{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;}}
  @media(max-width:900px){.sum-grid{grid-template-columns:repeat(2,1fr);}.dual-panel{grid-template-columns:1fr;}}
  @media(max-width:768px){.ph-title{font-size:18px;}.sum-grid{gap:8px;}.sc{padding:12px;}.sc-val{font-size:20px;}table{min-width:560px;font-size:12px;}thead th{font-size:10px;padding:8px 10px;}tbody td{padding:10px;}.criteria-grid{grid-template-columns:1fr;}}
  @media(max-width:580px){.sum-grid{grid-template-columns:repeat(2,1fr);}.side{display:flex;flex-direction:column;gap:12px;}}
</style>
@endpush

@section('content')

<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Dimensi Inovasi</div>
    <div class="ph-title">
      IKU 4 – Dosen Mendapat Rekognisi Internasional & Berpendidikan S3
      <span class="badge pilihan" style="vertical-align:middle;margin-left:6px;font-size:11px;">IKU Pilihan</span>
      <span class="badge inovasi" style="vertical-align:middle;margin-left:4px;font-size:11px;">Inovasi</span>
    </div>
    <div class="ph-sub">
      Persentase dosen yang mendapatkan rekognisi internasional (karya ilmiah, paten, keynote, dsb.) DAN persentase dosen berpendidikan S3. PJ: WR2. Unit: Dir SDM, LPPM, Dekan/WD2/WD3.
    </div>
  </div>
</section>

<div class="notice">
  <div class="notice-icon"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
  <div class="notice-body">
    <div class="notice-title">Data Progres Sementara (Baseline → Target)</div>
    <div class="notice-desc">Angka yang ditampilkan adalah posisi <strong>Baseline 2025</strong> terhadap Target 2026. Realisasi aktual berasal dari API SISTER/SIMDOSEN yang sedang dikembangkan.</div>
  </div>
  <div style="font-size:11px;color:var(--amber-dk);font-weight:600;">Mode sementara</div>
</div>

{{-- Summary --}}
<div class="sum-grid">
  <div class="sc">
    <div>
      <div class="sc-lbl">Rekognisi – Baseline</div>
      <div class="sc-val">{{ number_format($baseline_rekognisi ?? 37.33, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
    </div>
    <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg></div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Rekognisi – Target</div>
      <div class="sc-val">{{ number_format($target_rekognisi ?? 44.60, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
    </div>
    <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Dosen S3 – Baseline</div>
      <div class="sc-val">{{ number_format($baseline_s3 ?? 29.75, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
    </div>
    <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Dosen S3 – Target</div>
      <div class="sc-val">{{ number_format($target_s3 ?? 39.60, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
    </div>
    <div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/></svg></div>
  </div>
</div>

<div class="lay">
  <div>

    {{-- Dual Metric Panel --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg></div>
          <div><div class="ch-title">Ringkasan Dua Sub-Indikator IKU 4</div><div class="ch-sub">Rekognisi Internasional Dosen · Dosen Berpendidikan S3</div></div>
        </div>
      </div>
      <div class="dual-panel">
        <div class="metric-box rekognisi">
          <div class="metric-label">Rekognisi Internasional</div>
          <div class="metric-baseline">37,33%</div>
          <div class="metric-target">↑ Target 2026: 44,60%</div>
          <div class="metric-desc">±784 dosen dari total dosen aktif</div>
          @php $prog1=round(37.33/44.60*100,1); @endphp
          <div style="margin-top:12px;height:8px;background:#e4e7ec;border-radius:999px;overflow:hidden;">
            <div style="width:{{ $prog1 }}%;height:100%;background:var(--indigo);border-radius:999px;"></div>
          </div>
          <div style="font-size:11px;color:var(--indigo-dk);font-weight:700;margin-top:4px;">Progres: {{ $prog1 }}%</div>
        </div>
        <div class="metric-box s3">
          <div class="metric-label">Dosen Berpendidikan S3</div>
          <div class="metric-baseline">29,75%</div>
          <div class="metric-target">↑ Target 2026: 39,60%</div>
          <div class="metric-desc">±689 dosen dari total dosen aktif</div>
          @php $prog2=round(29.75/39.60*100,1); @endphp
          <div style="margin-top:12px;height:8px;background:#e4e7ec;border-radius:999px;overflow:hidden;">
            <div style="width:{{ $prog2 }}%;height:100%;background:var(--purple);border-radius:999px;"></div>
          </div>
          <div style="font-size:11px;color:var(--purple);font-weight:700;margin-top:4px;">Progres: {{ $prog2 }}%</div>
        </div>
      </div>
    </div>

    {{-- Tabel Target & Progres --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
          <div><div class="ch-title">Detail Target IKU 4</div><div class="ch-sub">Rekognisi & S3 · Kontrak Kinerja Rektor 2026</div></div>
        </div>
        <a href="#" class="btn btn-sm">Export</a>
      </div>
      <div class="cp">
        <div class="tbl-wrap">
          <table>
            <thead>
              <tr>
                <th>Sub-Indikator</th>
                <th>Baseline 2025</th>
                <th>Target 2026</th>
                <th>Kenaikan</th>
                <th>Progres Baseline→Target</th>
                <th>Realisasi*</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Rekognisi Internasional</strong><div style="font-size:11px;color:var(--muted);">% dosen dari total dosen PT</div></td>
                <td>37,33%</td>
                <td><strong style="color:var(--navy);">44,60%</strong></td>
                <td style="color:var(--amber-dk);">+7,27 pp</td>
                <td class="prog">
                  <div class="prog-lbl" style="color:var(--indigo);">{{ $prog1 }}%</div>
                  <div class="prog-bar"><div class="prog-fill" style="width:{{ $prog1 }}%;background:var(--indigo);"></div></div>
                </td>
                <td style="color:var(--muted);">–</td>
                <td><span class="st st-amber"><span class="st-dot"></span>Mendekati</span></td>
              </tr>
              <tr>
                <td><strong>Dosen Berpendidikan S3</strong><div style="font-size:11px;color:var(--muted);">% dosen dari total dosen PT</div></td>
                <td>29,75%</td>
                <td><strong style="color:var(--navy);">39,60%</strong></td>
                <td style="color:var(--amber-dk);">+9,85 pp</td>
                <td class="prog">
                  <div class="prog-lbl" style="color:var(--purple);">{{ $prog2 }}%</div>
                  <div class="prog-bar"><div class="prog-fill" style="width:{{ $prog2 }}%;background:var(--purple);"></div></div>
                </td>
                <td style="color:var(--muted);">–</td>
                <td><span class="st st-red"><span class="st-dot"></span>Kritis</span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div style="font-size:11px;color:var(--muted);margin-top:10px;">*Realisasi aktual dari SISTER/SIMDOSEN — akan diperbarui saat API aktif.</div>
      </div>
    </div>

    {{-- Kriteria Rekognisi --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon" style="background:var(--green-lt);color:var(--green-dk);"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
          <div><div class="ch-title">Kriteria Rekognisi Internasional</div><div class="ch-sub">Kepmen 358/M/KEP/2026 – Pasal IKU 4</div></div>
        </div>
      </div>
      <div class="cp">
        <div class="criteria-grid">
          <div class="crit-item"><strong>Jurnal Internasional Bereputasi</strong>Karya ilmiah terindeks Scopus/WoS sebagai penulis</div>
          <div class="crit-item"><strong>Keynote/Invited Speaker</strong>Pembicara undangan di konferensi internasional bereputasi</div>
          <div class="crit-item"><strong>Paten / HKI Internasional</strong>Paten yang terdaftar di lembaga paten internasional</div>
          <div class="crit-item"><strong>Visiting Researcher</strong>Peneliti tamu di PT/lembaga luar negeri bereputasi</div>
          <div class="crit-item"><strong>Editor / Reviewer Jurnal Int'l</strong>Menjabat editor atau reviewer jurnal internasional bereputasi</div>
          <div class="crit-item"><strong>Penghargaan Internasional</strong>Award dari lembaga/asosiasi akademik internasional</div>
        </div>
      </div>
    </div>

  </div>

  {{-- Sidebar --}}
  <div class="side">
    <div class="side-card">
      <div class="side-head"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><div class="side-head-title">TARGET PK REKTOR 2026</div></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Rekognisi – Baseline</span><span class="tgt-val" style="color:var(--muted);">37,33%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Rekognisi – Target</span><span class="tgt-val" style="color:var(--green-dk);">44,60%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Est. Jumlah Dosen</span><span class="tgt-val" style="color:var(--navy);">784 dosen</span></div>
        <div class="tgt-row"><span class="tgt-lbl">S3 – Baseline</span><span class="tgt-val" style="color:var(--muted);">29,75%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">S3 – Target</span><span class="tgt-val" style="color:var(--green-dk);">39,60%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Est. Dosen S3</span><span class="tgt-val" style="color:var(--navy);">689 dosen</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR2 / Dir SDM</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg><div class="side-head-title">FORMULA</div></div>
      <div class="side-body">
        <div class="formula">
          <strong>Rekognisi:</strong><br>
          <code style="font-size:11px;">Σ Dosen NUPTK rekognisi int'l ÷ Total Dosen PT × 100%</code><br><br>
          <strong>S3:</strong><br>
          <code style="font-size:11px;">Σ Dosen S3 aktif ÷ Total Dosen PT × 100%</code><br><br>
          <span style="color:var(--muted);">*Satu dosen dapat memenuhi lebih dari 1 kriteria (tidak double-counted)</span>
        </div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#065f46;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg><div class="side-head-title">RENCANA PROGRAM</div></div>
      <div class="side-body">
        <div style="font-size:12px;color:var(--sub);line-height:1.7;">
          <p>• Coaching Clinic penulisan jurnal Q1/Top Tier</p>
          <p style="margin-top:6px;">• Beasiswa studi S3 dalam & luar negeri</p>
          <p style="margin-top:6px;">• Insentif dosen rekognisi internasional</p>
          <p style="margin-top:6px;">• Kolaborasi riset PT top 100 THE/QS</p>
          <p style="margin-top:6px;">• Percepatan akreditasi jurnal UNSRI ke Scopus</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection