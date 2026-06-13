@extends('layouts.app')

@section('title', 'IKU 3 – Mahasiswa Berkegiatan · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 3 – Mahasiswa Berkegiatan di Luar Prodi')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root {
    --bg:#f7f8fc;--surface:#ffffff;--border:#eaecf0;--border-md:#d0d5dd;
    --text:#101828;--sub:#344054;--muted:#667085;--faint:#98a2b3;
    --indigo:#4f46e5;--indigo-lt:#eef2ff;--indigo-dk:#3730a3;
    --green:#12b76a;--green-lt:#ecfdf3;--green-dk:#027a48;
    --amber:#f79009;--amber-lt:#fffaeb;--amber-dk:#b54708;
    --red:#f04438;--red-lt:#fef3f2;--red-dk:#b42318;
    --purple:#7c3aed;--purple-lt:#f5f3ff;
    --navy:#082b57;--gold:#f59e0b;
    --r-sm:8px;--r-md:12px;--r-lg:16px;--r-xl:20px;
    --sh-sm:0 1px 3px rgba(16,24,40,.06),0 1px 2px rgba(16,24,40,.04);
    --sh-md:0 4px 8px -2px rgba(16,24,40,.06),0 2px 4px -2px rgba(16,24,40,.04);
  }
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
  body{font-family:'Inter',system-ui,sans-serif;background:var(--bg);color:var(--text);}

  /* Page Header */
  .ph{display:flex;justify-content:space-between;align-items:flex-start;gap:20px;flex-wrap:wrap;margin-bottom:24px;}
  .ph-left{display:flex;flex-direction:column;gap:3px;}
  .ph-eyebrow{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--indigo);}
  .ph-title{font-size:22px;font-weight:800;letter-spacing:-.025em;color:var(--text);line-height:1.25;}
  .ph-sub{font-size:13px;color:var(--muted);max-width:680px;line-height:1.55;margin-top:2px;}

  /* Control Bar */
  .ctrl-bar{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-xl);box-shadow:var(--sh-sm);padding:14px 20px;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:24px;}
  .ctrl-left{display:flex;align-items:center;gap:12px;flex-wrap:wrap;}
  .ctrl-right{display:flex;align-items:center;gap:10px;}

  /* Badge */
  .badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;}
  .badge.wajib{background:var(--indigo-lt);color:var(--indigo-dk);}
  .badge.talenta{background:#fef3c7;color:#92400e;}
  .badge-dot{width:6px;height:6px;border-radius:50%;background:currentColor;}

  /* Buttons */
  .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:var(--r-md);border:1px solid var(--border-md);background:var(--surface);color:var(--sub);font-size:13px;font-weight:600;font-family:inherit;cursor:pointer;text-decoration:none;transition:all .15s;}
  .btn:hover{background:var(--bg);border-color:var(--border-md);}
  .btn.btn-primary{background:var(--navy);border-color:var(--navy);color:#fff;}
  .btn.btn-primary:hover{background:#0a3568;}
  .btn.btn-sm{padding:6px 12px;font-size:12px;}

  /* Notice */
  .notice{background:var(--amber-lt);border:1px solid #fde68a;border-radius:var(--r-md);padding:12px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;}
  .notice-icon{color:var(--amber);flex-shrink:0;margin-top:1px;}
  .notice-body{flex:1;}
  .notice-title{font-size:13px;font-weight:700;color:var(--amber-dk);}
  .notice-desc{font-size:12px;color:var(--amber-dk);margin-top:2px;line-height:1.5;}
  .notice-meta{font-size:11px;color:var(--amber-dk);margin-top:6px;font-weight:600;}

  /* Layout */
  .lay{display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;}
  .side{position:sticky;top:20px;display:flex;flex-direction:column;gap:14px;}

  /* Card */
  .card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;margin-bottom:16px;}
  .card:last-child{margin-bottom:0;}
  .ch{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:16px 20px;border-bottom:1px solid var(--border);}
  .ch-left{display:flex;align-items:center;gap:10px;}
  .ch-icon{width:30px;height:30px;border-radius:var(--r-sm);background:var(--indigo-lt);display:flex;align-items:center;justify-content:center;color:var(--indigo);flex-shrink:0;}
  .ch-title{font-size:14px;font-weight:700;color:var(--text);}
  .ch-sub{font-size:11px;color:var(--muted);margin-top:1px;}
  .cp{padding:16px 20px;}

  /* Summary Cards */
  .sum-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;}
  .sc{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);padding:16px;display:flex;align-items:flex-start;justify-content:space-between;gap:12px;}
  .sc-lbl{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px;}
  .sc-val{font-size:26px;font-weight:800;letter-spacing:-.03em;color:var(--text);line-height:1;}
  .sc-ic{width:36px;height:36px;border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
  .ic-indigo{background:var(--indigo-lt);color:var(--indigo);}
  .ic-green{background:var(--green-lt);color:var(--green-dk);}
  .ic-amber{background:var(--amber-lt);color:var(--amber);}
  .ic-red{background:var(--red-lt);color:var(--red);}
  .ic-purple{background:var(--purple-lt);color:var(--purple);}
  .ic-navy{background:#e8f0fb;color:var(--navy);}

  /* Table */
  .tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
  table{width:100%;border-collapse:collapse;font-size:13px;}
  thead th{background:var(--navy);color:#fff;padding:10px 14px;text-align:left;font-size:11px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;white-space:nowrap;}
  thead th:first-child{border-radius:var(--r-sm) 0 0 0;}
  thead th:last-child{border-radius:0 var(--r-sm) 0 0;}
  tbody tr{border-bottom:1px solid var(--border);}
  tbody tr:last-child{border-bottom:none;}
  tbody tr:hover{background:#f9fafb;}
  tbody td{padding:12px 14px;color:var(--sub);vertical-align:middle;}
  tbody tr.total-row{background:#f0f4fa;font-weight:700;}
  tbody tr.total-row td{color:var(--navy);font-size:13px;}

  /* Progress bar */
  .prog{min-width:80px;}
  .prog-bar{height:6px;background:#e4e7ec;border-radius:999px;overflow:hidden;margin-top:4px;}
  .prog-fill{height:100%;border-radius:999px;transition:width .3s;}
  .prog-lbl{font-size:11px;font-weight:700;}

  /* Status badge */
  .st{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:999px;font-size:11px;font-weight:600;}
  .st-green{background:var(--green-lt);color:var(--green-dk);}
  .st-amber{background:var(--amber-lt);color:var(--amber-dk);}
  .st-red{background:var(--red-lt);color:var(--red-dk);}
  .st-dot{width:5px;height:5px;border-radius:50%;background:currentColor;}

  /* Faculty grid */
  .fac-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:12px;padding:16px 20px;}
  .fac-card{border:1px solid var(--border);border-radius:var(--r-md);padding:14px;text-align:center;transition:box-shadow .15s;}
  .fac-card:hover{box-shadow:var(--sh-md);}
  .fac-badge{display:inline-block;background:var(--navy);color:#fff;font-size:10px;font-weight:700;padding:2px 8px;border-radius:999px;letter-spacing:.04em;margin-bottom:8px;}
  .fac-val{font-size:20px;font-weight:800;letter-spacing:-.03em;color:var(--text);margin-bottom:4px;}
  .fac-lbl{font-size:10px;color:var(--muted);font-weight:500;}
  .fac-progress{height:4px;background:#e4e7ec;border-radius:999px;margin-top:8px;overflow:hidden;}
  .fac-pfill{height:100%;background:var(--gold);border-radius:999px;}

  /* Sidebar */
  .side-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;}
  .side-head{background:var(--navy);padding:12px 16px;display:flex;align-items:center;gap:8px;}
  .side-head-title{font-size:12px;font-weight:700;color:#fff;letter-spacing:.03em;}
  .side-body{padding:14px 16px;}
  .tgt-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);font-size:13px;}
  .tgt-row:last-child{border-bottom:none;}
  .tgt-lbl{color:var(--muted);font-weight:500;}
  .tgt-val{font-weight:700;color:var(--text);}
  .formula{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-sm);padding:12px 14px;font-size:12px;color:var(--sub);line-height:1.6;margin-top:10px;}
  .formula strong{color:var(--navy);}

  /* View note */
  .view-note{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);background:#f8f9fd;border-radius:var(--r-sm);padding:8px 12px;margin-bottom:12px;}

  /* Mobile */
  @media(max-width:1100px){
    .lay{grid-template-columns:1fr;}
    .side{position:static;}
  }
  @media(min-width:581px) and (max-width:1100px){
    .side{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;}
    .side .side-card{margin-bottom:0 !important;}
  }
  @media(max-width:900px){
    .sum-grid{grid-template-columns:repeat(2,1fr);}
    .fac-grid{grid-template-columns:repeat(3,1fr);}
  }
  @media(max-width:768px){
    .ph{margin-bottom:16px;}
    .ph-title{font-size:18px;}
    .ph-sub{font-size:12px;}
    .ctrl-bar{padding:12px 14px;}
    .sum-grid{gap:8px;}
    .sc{padding:12px;}
    .sc-val{font-size:20px;}
    .fac-grid{grid-template-columns:repeat(2,1fr);padding:12px;}
    table{min-width:580px;font-size:12px;}
    thead th{font-size:10px;padding:8px 10px;}
    tbody td{padding:10px;font-size:12px;}
  }
  @media(max-width:580px){
    .sum-grid{grid-template-columns:repeat(2,1fr);}
    .fac-grid{grid-template-columns:repeat(2,1fr);}
    .side{display:flex;flex-direction:column;gap:12px;}
  }
  @media(max-width:400px){
    .sum-grid{grid-template-columns:1fr;}
    .fac-grid{grid-template-columns:1fr;}
  }
</style>
@endpush

@section('content')

<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Dimensi Talenta</div>
    <div class="ph-title">
      IKU 3 – Mahasiswa S1/D3/D4 Berkegiatan/Meraih Prestasi di Luar Prodi
      <span class="badge wajib" style="vertical-align:middle;margin-left:6px;font-size:11px;">IKU Wajib</span>
      <span class="badge talenta" style="vertical-align:middle;margin-left:4px;font-size:11px;">Talenta</span>
    </div>
    <div class="ph-sub">
      Persentase mahasiswa Program Sarjana (S1) dan Diploma (D3/D4) yang berkegiatan atau meraih prestasi di luar program studi, diakui secara resmi oleh universitas (SKS diakui). PJ: WR1.
    </div>
  </div>
</section>

{{-- Notice API --}}
<div class="notice">
  <div class="notice-icon">
    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
  </div>
  <div class="notice-body">
    <div class="notice-title">Data Progres Sementara (Baseline → Target)</div>
    <div class="notice-desc">Angka yang ditampilkan adalah posisi <strong>Baseline 2025</strong> terhadap Target 2026. Data realisasi aktual berasal dari API Sistem Kemahasiswaan (SIAK) yang sedang dikembangkan. Begitu API aktif, nilai ini otomatis diperbarui.</div>
  </div>
  <div class="notice-meta">Mode data sementara</div>
</div>

{{-- Summary Cards --}}
<div class="sum-grid">
  <div class="sc">
    <div>
      <div class="sc-lbl">Baseline 2025</div>
      <div class="sc-val">{{ number_format($baseline, 1, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
    </div>
    <div class="sc-ic ic-indigo">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg>
    </div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Target 2026</div>
      <div class="sc-val">{{ number_format($target, 0, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
    </div>
    <div class="sc-ic ic-green">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
    </div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Kenaikan Target</div>
      <div class="sc-val">+{{ number_format($target - $baseline, 1, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">pp</span></div>
    </div>
    <div class="sc-ic ic-amber">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
    </div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Total Target Mhs</div>
      <div class="sc-val">12.145</div>
    </div>
    <div class="sc-ic ic-navy">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
  </div>
</div>

<div class="lay">
  <div>

    {{-- Tabel Target Per Fakultas --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
          </div>
          <div>
            <div class="ch-title">Target Mahasiswa Berkegiatan per Fakultas</div>
            <div class="ch-sub">35% dari Mahasiswa Aktif S1/D3 · Target 2026</div>
          </div>
        </div>
        <a href="#" class="btn btn-sm">
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Export
        </a>
      </div>
      <div class="cp">
        <div class="view-note">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          Target ditetapkan sebesar 35% dari total mahasiswa aktif S1 dan D3 per fakultas (sesuai dokumen PDF Baseline).
        </div>
        <div class="tbl-wrap">
          <table>
            <thead>
              <tr>
                <th>Fakultas</th>
                <th>Mhs Aktif S1</th>
                <th>Mhs Aktif D3</th>
                <th>Total S1/D3</th>
                <th>Target 2026 (35%)</th>
                <th>Realisasi*</th>
                <th>Progres</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @php
              $rows = [
                ['fak'=>'FE',      's1'=>2718,'d3'=>733, 'target'=>1208],
                ['fak'=>'FH',      's1'=>2158,'d3'=>0,   'target'=>755],
                ['fak'=>'FT',      's1'=>3912,'d3'=>0,   'target'=>1369],
                ['fak'=>'FK',      's1'=>2171,'d3'=>0,   'target'=>760],
                ['fak'=>'FP',      's1'=>4691,'d3'=>0,   'target'=>1642],
                ['fak'=>'FKIP',    's1'=>5932,'d3'=>0,   'target'=>2076],
                ['fak'=>'FISIP',   's1'=>4531,'d3'=>0,   'target'=>1586],
                ['fak'=>'FMIPA',   's1'=>2724,'d3'=>0,   'target'=>953],
                ['fak'=>'FASILKOM','s1'=>2332,'d3'=>833, 'target'=>1108],
                ['fak'=>'FKM',     's1'=>1965,'d3'=>0,   'target'=>688],
              ];
              $totalS1=0;$totalD3=0;$totalTarget=0;
              foreach($rows as $r){$totalS1+=$r['s1'];$totalD3+=$r['d3'];$totalTarget+=$r['target'];}
              @endphp
              @foreach($rows as $row)
              @php
                $total=$row['s1']+$row['d3'];
                $pct=$total>0?round($row['target']/$total*100,1):0;
                // TODO(API): ganti $real dgn data realisasi dari SIAK
                $real='–';
                $statusClass='st-amber';$statusLabel='Pending API';
              @endphp
              <tr>
                <td><strong>{{ $row['fak'] }}</strong></td>
                <td>{{ number_format($row['s1']) }}</td>
                <td>{{ $row['d3']>0?number_format($row['d3']):'–' }}</td>
                <td><strong>{{ number_format($total) }}</strong></td>
                <td><strong style="color:var(--navy);">{{ number_format($row['target']) }}</strong><span style="font-size:10px;color:var(--muted);margin-left:4px;">({{ $pct }}%)</span></td>
                <td style="color:var(--muted);">{{ $real }}</td>
                <td class="prog">
                  <div class="prog-lbl" style="color:var(--amber-dk);">Menunggu</div>
                  <div class="prog-bar"><div class="prog-fill" style="width:0%;background:var(--amber);"></div></div>
                </td>
                <td><span class="st {{ $statusClass }}"><span class="st-dot"></span>{{ $statusLabel }}</span></td>
              </tr>
              @endforeach
              <tr class="total-row">
                <td>TOTAL</td>
                <td>{{ number_format($totalS1) }}</td>
                <td>{{ number_format($totalD3) }}</td>
                <td>{{ number_format($totalS1+$totalD3) }}</td>
                <td>{{ number_format($totalTarget) }}</td>
                <td>–</td>
                <td>–</td>
                <td><span class="st st-amber"><span class="st-dot"></span>Menunggu API</span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div style="font-size:11px;color:var(--muted);margin-top:10px;">*Realisasi akan diisi otomatis setelah API Kemahasiswaan aktif.</div>
      </div>
    </div>

    {{-- Grid per Fakultas --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
          </div>
          <div>
            <div class="ch-title">Distribusi Target per Fakultas</div>
            <div class="ch-sub">Target mahasiswa berkegiatan di luar prodi (jumlah orang)</div>
          </div>
        </div>
      </div>
      <div class="fac-grid">
        @foreach($rows as $row)
        @php $pctTotal=round($row['target']/$totalTarget*100,1); @endphp
        <div class="fac-card">
          <div class="fac-badge">{{ $row['fak'] }}</div>
          <div class="fac-val">{{ number_format($row['target']) }}</div>
          <div class="fac-lbl">mahasiswa target</div>
          <div class="fac-progress"><div class="fac-pfill" style="width:{{ $pctTotal*3 }}%;max-width:100%;"></div></div>
          <div style="font-size:10px;color:var(--muted);margin-top:4px;">{{ $pctTotal }}% dari total</div>
        </div>
        @endforeach
      </div>
    </div>

  </div>

  {{-- Sidebar --}}
  <div class="side">
    <div class="side-card">
      <div class="side-head">
        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <div class="side-head-title">TARGET PK REKTOR 2026</div>
      </div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val" style="color:var(--muted);">14,9%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">35%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Kenaikan</span><span class="tgt-val" style="color:var(--amber-dk);">+20,1 pp</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Total Target</span><span class="tgt-val" style="color:var(--navy);">12.145 Mhs</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Satuan</span><span class="tgt-val">% Mahasiswa</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR1</span></div>
      </div>
    </div>

    <div class="side-card">
      <div class="side-head" style="background:#1e40af;">
        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <div class="side-head-title">FORMULA & KRITERIA</div>
      </div>
      <div class="side-body">
        <div class="formula">
          <strong>Formula (Kepmen 358/2026):</strong><br>
          <code style="font-size:11px;">Σ Mhs berkegiatan di luar prodi (terbobot) ÷ Total Mhs S1/D3 × 100%</code>
          <br><br>
          <strong>Kegiatan yang diakui:</strong>
          <ul style="margin-top:6px;padding-left:14px;font-size:11px;line-height:1.8;">
            <li>Magang / Praktik Kerja</li>
            <li>Pertukaran Mahasiswa</li>
            <li>KKN Tematik</li>
            <li>Proyek Kemanusiaan</li>
            <li>Wirausaha</li>
            <li>Prestasi (Internasional/Nasional/Prov)</li>
            <li>Penelitian / Inovasi</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="side-card">
      <div class="side-head" style="background:#065f46;">
        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        <div class="side-head-title">RENCANA PROGRAM</div>
      </div>
      <div class="side-body">
        <div style="font-size:12px;color:var(--sub);line-height:1.7;">
          <p>• Perbanyak MoU dengan industri & lembaga untuk magang terstruktur</p>
          <p style="margin-top:6px;">• Integrasi MBKM ke kurikulum minimal 20 SKS</p>
          <p style="margin-top:6px;">• Pendampingan kompetisi mahasiswa di tingkat nasional & internasional</p>
          <p style="margin-top:6px;">• Pembentukan Tim Inkubator Kewirausahaan Mahasiswa</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection