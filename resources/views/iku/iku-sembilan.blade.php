@extends('layouts.app')
@section('title', 'IKU 9 – Pendapatan Non UKT · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 9 – Pendapatan Non Pendidikan/UKT')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root{--bg:#f7f8fc;--surface:#fff;--border:#eaecf0;--border-md:#d0d5dd;--text:#101828;--sub:#344054;--muted:#667085;--faint:#98a2b3;--indigo:#4f46e5;--indigo-lt:#eef2ff;--indigo-dk:#3730a3;--green:#12b76a;--green-lt:#ecfdf3;--green-dk:#027a48;--amber:#f79009;--amber-lt:#fffaeb;--amber-dk:#b54708;--red:#f04438;--red-lt:#fef3f2;--red-dk:#b42318;--purple:#7c3aed;--purple-lt:#f5f3ff;--navy:#082b57;--gold:#f59e0b;--r-sm:8px;--r-md:12px;--r-lg:16px;--r-xl:20px;--sh-sm:0 1px 3px rgba(16,24,40,.06),0 1px 2px rgba(16,24,40,.04);}
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
  .sum-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;}
  .sc{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);padding:16px;display:flex;align-items:flex-start;justify-content:space-between;gap:12px;}
  .sc-lbl{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px;}
  .sc-val{font-size:26px;font-weight:800;letter-spacing:-.03em;color:var(--text);line-height:1;}
  .sc-ic{width:36px;height:36px;border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
  .ic-red{background:var(--red-lt);color:var(--red);}
  .ic-green{background:var(--green-lt);color:var(--green-dk);}
  .ic-amber{background:var(--amber-lt);color:var(--amber);}
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
  .tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
  table{width:100%;border-collapse:collapse;font-size:13px;}
  thead th{background:var(--navy);color:#fff;padding:10px 14px;text-align:left;font-size:11px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;white-space:nowrap;}
  tbody tr{border-bottom:1px solid var(--border);}
  tbody tr:last-child{border-bottom:none;}
  tbody tr:hover{background:#f9fafb;}
  tbody td{padding:12px 14px;color:var(--sub);vertical-align:middle;}
  .prog-bar{height:6px;background:#e4e7ec;border-radius:999px;overflow:hidden;margin-top:4px;}
  .prog-fill{height:100%;border-radius:999px;}
  .prog-lbl{font-size:11px;font-weight:700;}
  .st{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:999px;font-size:11px;font-weight:600;}
  .st-green{background:var(--green-lt);color:var(--green-dk);}
  .st-amber{background:var(--amber-lt);color:var(--amber-dk);}
  .st-red{background:var(--red-lt);color:var(--red-dk);}
  .st-dot{width:5px;height:5px;border-radius:50%;background:currentColor;}
  .big-metric{text-align:center;padding:28px 20px;background:linear-gradient(135deg,var(--navy) 0%,#1a4a8a 100%);color:#fff;border-radius:var(--r-lg);margin-bottom:16px;}
  .big-metric-label{font-size:12px;font-weight:600;opacity:.7;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;}
  .big-metric-val{font-size:56px;font-weight:900;letter-spacing:-.04em;line-height:1;}
  .big-metric-target{font-size:18px;color:var(--gold);font-weight:700;margin-top:8px;}
  .alokasi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:16px 20px;}
  .alokasi-item{text-align:center;padding:14px;background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);}
  .alokasi-lbl{font-size:10px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;}
  .alokasi-baseline{font-size:22px;font-weight:800;color:var(--text);}
  .alokasi-target{font-size:13px;color:var(--green-dk);font-weight:700;margin-top:3px;}
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
  @media(max-width:900px){.sum-grid{grid-template-columns:repeat(2,1fr);}.alokasi-grid{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:768px){.ph-title{font-size:18px;}.sum-grid{gap:8px;}.sc{padding:12px;}.sc-val{font-size:20px;}table{min-width:600px;font-size:12px;}thead th{font-size:10px;padding:8px;}tbody td{padding:10px;}.big-metric-val{font-size:38px;}}
  @media(max-width:580px){.sum-grid{grid-template-columns:repeat(2,1fr);}.alokasi-grid{grid-template-columns:1fr;}.side{display:flex;flex-direction:column;gap:12px;}}
</style>
@endpush
@section('content')
<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Dimensi Tata Kelola</div>
    <div class="ph-title">
      IKU 9 – Persentase Pendapatan Non Pendidikan/UKT terhadap Total Pendapatan
      <span class="badge wajib" style="vertical-align:middle;margin-left:6px;font-size:11px;">IKU Wajib</span>
      <span class="badge tata" style="vertical-align:middle;margin-left:4px;font-size:11px;">Tata Kelola</span>
    </div>
    <div class="ph-sub">Persentase pendapatan non-pendidikan (riset, kerja sama, hibah, usaha) terhadap total pendapatan PT. PJ: WR2, WR3, WR4. Unit: Dir Keu, Dir PP, BPU, LPPM, Dekan/WD2/WD3.</div>
  </div>
</section>
<div class="notice">
  <div style="color:var(--amber);flex-shrink:0;"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/></svg></div>
  <div><div style="font-size:13px;font-weight:700;color:var(--amber-dk);">Data Progres Sementara (Baseline → Target)</div><div style="font-size:12px;color:var(--amber-dk);margin-top:2px;line-height:1.5;">Angka yang ditampilkan adalah posisi Baseline 2025 terhadap Target 2026. Data realisasi dari Laporan Keuangan UNSRI yang diaudit akan diintegrasikan secara berkala.</div></div>
  <div style="font-size:11px;color:var(--amber-dk);font-weight:600;white-space:nowrap;align-self:center;">Mode sementara</div>
</div>
<div class="sum-grid">
  <div class="sc"><div><div class="sc-lbl">Non-UKT Baseline</div><div class="sc-val">{{ number_format($baseline ?? 13.3, 1, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div><div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div></div>
  <div class="sc"><div><div class="sc-lbl">Non-UKT Target</div><div class="sc-val">{{ number_format($target ?? 15.0, 1, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div><div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div></div>
  <div class="sc"><div><div class="sc-lbl">Dana Abadi Target</div><div class="sc-val">4<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div><div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div></div>
  <div class="sc"><div><div class="sc-lbl">Alokasi Riset Target</div><div class="sc-val">11,5<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div><div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v11m0 0h10m-10 0H3m6 0v5m0 0h4m-4 0H7"/></svg></div></div>
</div>
<div class="lay">
  <div>
    {{-- $prog dari controller --}}
    <div class="big-metric">
      <div class="big-metric-label">Progres Pendapatan Non-UKT Baseline → Target</div>
      <div class="big-metric-val">{{ $prog }}%</div>
      <div class="big-metric-target">Baseline: {{ number_format($baseline,1,',','.') }}% | Target: {{ number_format($target,1,',','.') }}%</div>
      <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;"><div style="width:{{ $prog }}%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
      <div style="font-size:12px;opacity:.6;margin-top:8px;">Gap tersisa: +1,7 pp — relatif terjangkau, perlu konsistensi</div>
    </div>
    <div class="card">
      <div class="ch"><div class="ch-left"><div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div><div><div class="ch-title">Rincian Sub-Indikator IKU 9</div><div class="ch-sub">Komponen pendapatan & alokasi — Baseline 2025 → Target 2026</div></div></div><a href="#" style="display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:8px;border:1px solid #d0d5dd;background:#fff;color:#344054;font-size:12px;font-weight:600;text-decoration:none;">Export</a></div>
      <div class="cp">
        <div class="tbl-wrap">
          <table>
            <thead><tr><th>Sub-Indikator</th><th>Baseline 2025</th><th>Target 2026</th><th>Progres</th><th>Status</th></tr></thead>
            <tbody>
              {{-- $sub_rows dari controller (TODO: integrasikan data laporan keuangan) --}}
              @foreach($sub_rows as $r)
              @php
                $color=$r['status']==='green'?'var(--green)':($r['status']==='amber'?'var(--amber)':'var(--red)');
                $stCls=$r['status']==='green'?'st-green':($r['status']==='amber'?'st-amber':'st-red');
                $stLbl=$r['status']==='green'?'Mendekati':($r['status']==='amber'?'Mendekati':'Kritis');
                $progW=min($r['prog'],100);
              @endphp
              <tr>
                <td><strong>{{ $r['label'] }}</strong></td>
                <td>{{ $r['baseline'] }}</td>
                <td><strong style="color:var(--navy);">{{ $r['target'] }}</strong></td>
                <td style="min-width:80px;">
                  <div class="prog-lbl" style="color:{{ $color }};">{{ $r['prog'] }}%</div>
                  <div class="prog-bar"><div class="prog-fill" style="width:{{ $progW }}%;background:{{ $color }};"></div></div>
                </td>
                <td><span class="st {{ $stCls }}"><span class="st-dot"></span>{{ $stLbl }}</span></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="ch"><div class="ch-left"><div class="ch-icon" style="background:var(--green-lt);color:var(--green-dk);"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div><div class="ch-title">Alokasi Dana Masyarakat — Target 2026</div><div class="ch-sub">Total alokasi peningkatan dari pendapatan dana masyarakat (target 21,5%)</div></div></div></div>
      <div class="alokasi-grid">
        @foreach($alokasi as $al)
        <div class="alokasi-item"><div class="alokasi-lbl">{{ $al['label'] }}</div><div class="alokasi-baseline">{{ $al['baseline'] }}</div><div class="alokasi-target">↑ Target: {{ $al['target'] }}</div></div>
        @endforeach<div class="alokasi-baseline">2%</div><div class="alokasi-target">↑ Target: 5%</div></div>
      </div>
    </div>
  </div>
  <div class="side">
    <div class="side-card"><div class="side-head"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><div class="side-head-title">TARGET PK REKTOR 2026</div></div><div class="side-body"><div class="tgt-row"><span class="tgt-lbl">Non-UKT Baseline</span><span class="tgt-val" style="color:var(--amber-dk);">13,3%</span></div><div class="tgt-row"><span class="tgt-lbl">Non-UKT Target</span><span class="tgt-val" style="color:var(--green-dk);">15%</span></div><div class="tgt-row"><span class="tgt-lbl">Dana Abadi Target</span><span class="tgt-val">4% aset</span></div><div class="tgt-row"><span class="tgt-lbl">Alokasi Total Target</span><span class="tgt-val">21,5%</span></div><div class="tgt-row" style="border:none;"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR2, WR3, WR4</span></div></div></div>
    <div class="side-card"><div class="side-head" style="background:#1e40af;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg><div class="side-head-title">FORMULA</div></div><div class="side-body"><div class="formula"><strong>Formula Utama:</strong><br><code style="font-size:11px;">Pendapatan Non-UKT ÷ Total Pendapatan PT × 100%</code><br><br><strong>Sumber pendapatan non-UKT:</strong><br>Hibah, riset, kerjasama, usaha PT, sewa aset, jasa layanan, APBN (non-SPP), dana abadi, dan pendapatan lain-lain.</div></div></div>
    <div class="side-card"><div class="side-head" style="background:#065f46;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg><div class="side-head-title">STRATEGI PENINGKATAN</div></div><div class="side-body"><div style="font-size:12px;color:var(--sub);line-height:1.7;"><p>• Optimasi usaha BPU (kantin, parkir, aula)</p><p style="margin-top:6px;">• Tingkatkan riset berbasis hibah Kemendikbud/industri</p><p style="margin-top:6px;">• Pengembangan dana abadi (endowment fund)</p><p style="margin-top:6px;">• Sewa aset bangunan & lahan secara produktif</p><p style="margin-top:6px;">• Spin-off hasil riset ke produk komersil</p></div></div></div>
  </div>
</div>
@endsection