@extends('layouts.app')

@section('title', 'IKU 6 – Publikasi Internasional · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 6 – Publikasi Bereputasi Internasional')

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
  .badge.wajib{background:var(--indigo-lt);color:var(--indigo-dk);}
  .badge.inovasi{background:#d1fae5;color:#065f46;}
  .notice{background:var(--amber-lt);border:1px solid #fde68a;border-radius:var(--r-md);padding:12px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;}
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
  .ic-purple{background:var(--purple-lt);color:var(--purple);}
  .ic-navy{background:#e8f0fb;color:var(--navy);}
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
  .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:var(--r-md);border:1px solid var(--border-md);background:var(--surface);color:var(--sub);font-size:13px;font-weight:600;font-family:inherit;cursor:pointer;text-decoration:none;}
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
  /* Bobot badge */
  .q-badge{display:inline-block;padding:2px 8px;border-radius:999px;font-size:10px;font-weight:700;}
  .q-top{background:#fef3c7;color:#92400e;}
  .q-q1{background:var(--indigo-lt);color:var(--indigo-dk);}
  .q-q2{background:var(--green-lt);color:var(--green-dk);}
  .q-q3{background:#f0fdf4;color:#166534;}
  .q-q4{background:#f8f9fd;color:var(--muted);}
  .sub-metric{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:16px 20px;border-top:1px solid var(--border);}
  .sm-item{text-align:center;padding:14px;background:#f8f9fd;border-radius:var(--r-md);border:1px solid var(--border);}
  .sm-lbl{font-size:10px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px;}
  .sm-val-b{font-size:18px;font-weight:800;color:var(--text);}
  .sm-val-t{font-size:13px;color:var(--green-dk);font-weight:700;margin-top:2px;}
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
  @media(max-width:900px){.sum-grid{grid-template-columns:repeat(2,1fr);}.sub-metric{grid-template-columns:1fr 1fr;}}
  @media(max-width:768px){.ph-title{font-size:18px;}.sum-grid{gap:8px;}.sc{padding:12px;}.sc-val{font-size:20px;}table{min-width:600px;font-size:12px;}thead th{font-size:10px;padding:8px;}tbody td{padding:10px;}}
  @media(max-width:580px){.sum-grid{grid-template-columns:repeat(2,1fr);}.sub-metric{grid-template-columns:1fr;}.side{display:flex;flex-direction:column;gap:12px;}}
</style>
@endpush

@section('content')

<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Dimensi Inovasi</div>
    <div class="ph-title">
      IKU 6 – Publikasi Bereputasi Internasional (Scopus / Web of Science)
      <span class="badge wajib" style="vertical-align:middle;margin-left:6px;font-size:11px;">IKU Wajib PTN-BH</span>
      <span class="badge inovasi" style="vertical-align:middle;margin-left:4px;font-size:11px;">Inovasi</span>
    </div>
    <div class="ph-sub">
      Total publikasi terindeks Scopus/WoS, persentase Top Tier, persentase Q1, dan kolaborasi riset internasional. PJ: WR3. Unit: LPPM, Koord Penelitian, Subkoord Publikasi, Dekan/WD3.
    </div>
  </div>
</section>

<div class="notice">
  <div style="color:var(--amber);flex-shrink:0;margin-top:1px;"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
  <div>
    <div class="notice-title">Data Progres Sementara (Baseline → Target)</div>
    <div class="notice-desc">Angka yang ditampilkan adalah posisi <strong>Baseline 2025</strong> terhadap Target 2026. Data realisasi aktual dari Scopus/WoS akan diintegrasikan melalui API LPPM.</div>
  </div>
  <div style="font-size:11px;color:var(--amber-dk);font-weight:600;white-space:nowrap;align-self:center;">Mode sementara</div>
</div>

<div class="sum-grid">
  <div class="sc">
    <div><div class="sc-lbl">Total Publikasi – Baseline</div><div class="sc-val">590<span style="font-size:14px;font-weight:600;color:var(--muted);margin-left:2px;">artikel</span></div></div>
    <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div>
  </div>
  <div class="sc">
    <div><div class="sc-lbl">Total Publikasi – Target</div><div class="sc-val">708<span style="font-size:14px;font-weight:600;color:var(--muted);margin-left:2px;">artikel</span></div></div>
    <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
  </div>
  <div class="sc">
    <div><div class="sc-lbl">Top Tier – Target</div><div class="sc-val">8,7<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div>
    <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg></div>
  </div>
  <div class="sc">
    <div><div class="sc-lbl">Kolab Int'l – Target</div><div class="sc-val">{{ number_format($sub_indikator['kolab_target'],1,',','.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div>
    <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
  </div>
</div>

<div class="lay">
  <div>

    {{-- Sub-metrics --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg></div>
          <div><div class="ch-title">Ringkasan Sub-Indikator IKU 6</div><div class="ch-sub">Baseline 2025 → Target 2026</div></div>
        </div>
      </div>
      <div class="sub-metric">
        <div class="sm-item">
          <div class="sm-lbl">Total Publikasi</div>
          <div class="sm-val-b">{{ number_format($total_baseline, 0, ',', '.') }}</div>
          <div class="sm-val-t">↑ Target: {{ number_format($total_target, 0, ',', '.') }}</div>
          @php $p6a=round($total_baseline/$total_target*100,1); @endphp
          <div style="margin-top:8px;height:6px;background:#e4e7ec;border-radius:999px;overflow:hidden;"><div style="width:{{ $p6a }}%;height:100%;background:var(--indigo);border-radius:999px;"></div></div>
          <div style="font-size:10px;color:var(--indigo);font-weight:700;margin-top:3px;">{{ $p6a }}%</div>
        </div>
        <div class="sm-item">
          <div class="sm-lbl">% Top Tier</div>
          <div class="sm-val-b">{{ number_format($sub_indikator['top_tier_baseline'], 1, ',', '.') }}%</div>
          <div class="sm-val-t">↑ Target: {{ number_format($sub_indikator['top_tier_target'], 1, ',', '.') }}%</div>
          @php $p6b=round($sub_indikator['top_tier_baseline']/$sub_indikator['top_tier_target']*100,1); @endphp
          <div style="margin-top:8px;height:6px;background:#e4e7ec;border-radius:999px;overflow:hidden;"><div style="width:{{ $p6b }}%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
          <div style="font-size:10px;color:var(--amber-dk);font-weight:700;margin-top:3px;">{{ $p6b }}%</div>
        </div>
        <div class="sm-item">
          <div class="sm-lbl">% Q1</div>
          <div class="sm-val-b">{{ number_format($sub_indikator['q1_baseline'], 1, ',', '.') }}%</div>
          <div class="sm-val-t">↑ Target: {{ number_format($sub_indikator['q1_target'], 1, ',', '.') }}%</div>
          @php $p6c=round($sub_indikator['q1_baseline']/$sub_indikator['q1_target']*100,1); @endphp
          <div style="margin-top:8px;height:6px;background:#e4e7ec;border-radius:999px;overflow:hidden;"><div style="width:{{ $p6c }}%;height:100%;background:var(--green);border-radius:999px;"></div></div>
          <div style="font-size:10px;color:var(--green-dk);font-weight:700;margin-top:3px;">{{ $p6c }}%</div>
        </div>
        <div class="sm-item">
          <div class="sm-lbl">Kolab Int'l</div>
          <div class="sm-val-b">{{ number_format($sub_indikator['kolab_baseline'], 1, ',', '.') }}%</div>
          <div class="sm-val-t">↑ Target: {{ number_format($sub_indikator['kolab_target'], 1, ',', '.') }}%</div>
          @php $p6d=round($sub_indikator['kolab_baseline']/$sub_indikator['kolab_target']*100,1); @endphp
          <div style="margin-top:8px;height:6px;background:#e4e7ec;border-radius:999px;overflow:hidden;"><div style="width:{{ $p6d }}%;height:100%;background:var(--purple);border-radius:999px;"></div></div>
          <div style="font-size:10px;color:var(--purple);font-weight:700;margin-top:3px;">{{ $p6d }}%</div>
        </div>
      </div>
    </div>

    {{-- Tabel per Fakultas --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
          <div><div class="ch-title">Publikasi Internasional per Fakultas</div><div class="ch-sub">Baseline 2025 · Target 2026 · Scopus/WoS</div></div>
        </div>
        <a href="#" class="btn btn-sm">Export</a>
      </div>
      <div class="cp">
        <div class="tbl-wrap">
          <table>
            <thead>
              <tr>
                <th>Fakultas</th>
                <th>Total B2025</th>
                <th>Total T2026</th>
                <th>Top Tier B/T</th>
                <th>Q1 B/T</th>
                <th>Kolab Int'l T2026</th>
                <th>Progres Total</th>
              </tr>
            </thead>
            <tbody>
              {{-- Data dari controller via $rows_publikasi (mock PDF hal.27, TODO: API SINTA/Scopus) --}}
              @php $sumTB=collect($rows_publikasi)->sum('tb'); $sumTT=collect($rows_publikasi)->sum('tt'); @endphp
              @foreach($rows_publikasi as $r)
              @php
                $prog=round($r['tb']/$r['tt']*100,1);
                $color=$prog>=100?'var(--green)':($prog>=80?'var(--amber)':'var(--red)');
                $stCls=$prog>=100?'st-green':($prog>=80?'st-amber':'st-red');
              @endphp
              <tr>
                <td><strong>{{ $r['f'] }}</strong></td>
                <td>{{ $r['tb'] }}</td>
                <td><strong style="color:var(--navy);">{{ $r['tt'] }}</strong></td>
                <td><span class="q-badge q-top">{{ $r['topb'] }}</span> → <span class="q-badge q-top">{{ $r['topt'] }}</span></td>
                <td><span class="q-badge q-q1">{{ $r['q1b'] }}</span> → <span class="q-badge q-q1">{{ $r['q1t'] }}</span></td>
                <td><span style="color:var(--navy);font-weight:600;">{{ $r['kt'] }}</span> artikel</td>
                <td class="prog">
                  <div class="prog-lbl" style="color:{{ $color }};">{{ $prog }}%</div>
                  <div class="prog-bar"><div class="prog-fill" style="width:{{ min($prog,100) }}%;background:{{ $color }};"></div></div>
                </td>
              </tr>
              @endforeach
              <tr class="total-row">
                <td>TOTAL</td>
                <td>{{ $sumTB }}</td>
                <td>{{ $sumTT }}</td>
                <td colspan="3" style="color:var(--muted);font-size:12px;">Kolaborasi Internasional Target: 174 artikel</td>
                <td class="prog">
                  @php $totalProg=round($sumTB/$sumTT*100,1); @endphp
                  <div class="prog-lbl" style="color:var(--amber-dk);">{{ $totalProg }}%</div>
                  <div class="prog-bar"><div class="prog-fill" style="width:{{ $totalProg }}%;background:var(--amber);"></div></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- Bobot Kuartil --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon" style="background:#fef3c7;color:#92400e;"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/></svg></div>
          <div><div class="ch-title">Bobot Penilaian per Kuartil (Kepmen 358/2026)</div><div class="ch-sub">Berlaku untuk penghitungan nilai terbobot publikasi</div></div>
        </div>
      </div>
      <div class="cp">
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;">
          @foreach([['Top Tier','1,20','q-top','Bobot tertinggi — Nature, Science, Lancet, dsb.'],['Q1','1,00','q-q1','Kuartil 1 Scopus/WoS'],['Q2','0,75','q-q2','Kuartil 2 Scopus/WoS'],['Q3','0,50','q-q3','Kuartil 3 Scopus/WoS']] as $q)
          <div style="text-align:center;padding:14px;background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);">
            <span class="q-badge {{ $q[2] }}" style="font-size:12px;padding:4px 12px;">{{ $q[0] }}</span>
            <div style="font-size:24px;font-weight:800;color:var(--text);margin:10px 0 4px;">{{ $q[1] }}</div>
            <div style="font-size:10px;color:var(--muted);">{{ $q[3] }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

  </div>

  {{-- Sidebar --}}
  <div class="side">
    <div class="side-card">
      <div class="side-head"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><div class="side-head-title">TARGET PK REKTOR 2026</div></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Total Publikasi B2025</span><span class="tgt-val" style="color:var(--muted);">590 artikel</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Total Publikasi T2026</span><span class="tgt-val" style="color:var(--green-dk);">708 artikel</span></div>
        <div class="tgt-row"><span class="tgt-lbl">% Top Tier T2026</span><span class="tgt-val">8,7% (62 judul)</span></div>
        <div class="tgt-row"><span class="tgt-lbl">% Q1 T2026</span><span class="tgt-val">32% (226 judul)</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Kolab Int'l T2026</span><span class="tgt-val">{{ number_format($sub_indikator['kolab_target'],1,',','.') }}%</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR3 / LPPM</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg><div class="side-head-title">FORMULA</div></div>
      <div class="side-body">
        <div class="formula">
          <strong>Nilai Terbobot:</strong><br>
          <code style="font-size:10px;">Σ (Publikasi × Bobot Kuartil) ÷ Total Publikasi PT × 100%</code><br><br>
          <strong>Kolaborasi Int'l:</strong><br>
          <code style="font-size:10px;">Σ Pub. co-authored PT Luar ÷ Total Publikasi × 100%</code>
        </div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#065f46;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg><div class="side-head-title">PROGRAM PENINGKATAN</div></div>
      <div class="side-body">
        <div style="font-size:12px;color:var(--sub);line-height:1.7;">
          <p>• Coaching clinic penulisan jurnal Q1/Top Tier</p>
          <p style="margin-top:6px;">• Insentif publikasi Top Tier per dosen</p>
          <p style="margin-top:6px;">• Kolaborasi riset PT top 100 THE/QS</p>
          <p style="margin-top:6px;">• Peningkatan kualitas jurnal Unsri → Scopus</p>
          <p style="margin-top:6px;">• Matching fund riset internasional</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection