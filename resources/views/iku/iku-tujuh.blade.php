{{-- ============================================================
     IKU 7 | resources/views/iku/iku-tujuh.blade.php
     Keterlibatan PT dalam SDG's
     ============================================================ --}}
@extends('layouts.app')
@section('title', 'IKU 7 – Keterlibatan SDGs · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 7 – Keterlibatan PT dalam SDGs')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root{--bg:#f7f8fc;--surface:#fff;--border:#eaecf0;--border-md:#d0d5dd;--text:#101828;--sub:#344054;--muted:#667085;--faint:#98a2b3;--indigo:#4f46e5;--indigo-lt:#eef2ff;--indigo-dk:#3730a3;--green:#12b76a;--green-lt:#ecfdf3;--green-dk:#027a48;--amber:#f79009;--amber-lt:#fffaeb;--amber-dk:#b54708;--red:#f04438;--red-lt:#fef3f2;--red-dk:#b42318;--purple:#7c3aed;--purple-lt:#f5f3ff;--navy:#082b57;--gold:#f59e0b;--r-sm:8px;--r-md:12px;--r-lg:16px;--r-xl:20px;--sh-sm:0 1px 3px rgba(16,24,40,.06),0 1px 2px rgba(16,24,40,.04);--sh-md:0 4px 8px -2px rgba(16,24,40,.06),0 2px 4px -2px rgba(16,24,40,.04);}
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
  .big-metric{text-align:center;padding:32px 20px;background:linear-gradient(135deg,var(--navy) 0%,#1a4a8a 100%);color:#fff;border-radius:var(--r-lg);margin-bottom:16px;}
  .big-metric-label{font-size:12px;font-weight:600;opacity:.7;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;}
  .big-metric-val{font-size:56px;font-weight:900;letter-spacing:-.04em;line-height:1;}
  .big-metric-target{font-size:18px;color:var(--gold);font-weight:700;margin-top:8px;}
  .sdg-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:10px;padding:16px 20px;}
  .sdg-card{border-radius:var(--r-md);padding:14px 10px;text-align:center;color:#fff;font-weight:700;}
  .sdg-num{font-size:22px;font-weight:900;line-height:1;}
  .sdg-name{font-size:9px;font-weight:600;margin-top:4px;opacity:.9;line-height:1.3;}
  .sdg-type{font-size:9px;background:rgba(255,255,255,.25);border-radius:999px;padding:2px 6px;margin-top:6px;display:inline-block;}
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
  @media(max-width:900px){.sum-grid{grid-template-columns:repeat(2,1fr);}.sdg-grid{grid-template-columns:repeat(3,1fr);}}
  @media(max-width:768px){.ph-title{font-size:18px;}.sum-grid{gap:8px;}.sc{padding:12px;}.sc-val{font-size:20px;}.big-metric-val{font-size:38px;}}
  @media(max-width:580px){.sum-grid{grid-template-columns:repeat(2,1fr);}.sdg-grid{grid-template-columns:repeat(2,1fr);}.side{display:flex;flex-direction:column;gap:12px;}}
</style>
@endpush
@section('content')
<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Dimensi Tata Kelola</div>
    <div class="ph-title">
      IKU 7 – Keterlibatan PT dalam SDGs (SDG 1, 4, 6, 13, 17)
      <span class="badge wajib" style="vertical-align:middle;margin-left:6px;font-size:11px;">IKU Wajib</span>
      <span class="badge tata" style="vertical-align:middle;margin-left:4px;font-size:11px;">Tata Kelola</span>
    </div>
    <div class="ph-sub">Persentase keterlibatan PT dalam SDG 1 (Tanpa Kemiskinan), SDG 4 (Pendidikan Berkualitas), SDG 17 (Kemitraan), serta 2 SDG unggulan UNSRI: SDG 6 (Air Bersih) & SDG 13 (Aksi Iklim). PJ: WR1.</div>
  </div>
</section>
<div class="notice">
  <div style="color:var(--amber);flex-shrink:0;"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
  <div><div class="notice-title">Data Progres Sementara</div><div class="notice-desc">Baseline 2025 = <strong>36%</strong> (THE Impact Ranking 2025 peringkat 601–800). Data realisasi 2026 menunggu publikasi resmi THE Impact Ranking.</div></div>
  <div style="font-size:11px;color:var(--amber-dk);font-weight:600;white-space:nowrap;align-self:center;">Mode sementara</div>
</div>
<div class="sum-grid">
  <div class="sc"><div><div class="sc-lbl">Baseline 2025</div><div class="sc-val">{{ $baseline ?? 36 }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div><div class="sc-ic ic-red"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg></div></div>
  <div class="sc"><div><div class="sc-lbl">Target 2026</div><div class="sc-val">{{ $target ?? 55 }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div><div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div></div>
  <div class="sc"><div><div class="sc-lbl">Gap Target</div><div class="sc-val" style="color:var(--red);">+19<span style="font-size:14px;font-weight:600;color:var(--muted);">pp</span></div></div><div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg></div></div>
  <div class="sc"><div><div class="sc-lbl">Peringkat THE Impact</div><div class="sc-val" style="font-size:16px;line-height:1.3;">601–800</div></div><div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/></svg></div></div>
</div>
<div class="lay">
  <div>
    @php $prog7=round(36/55*100,1); @endphp
    <div class="big-metric">
      <div class="big-metric-label">Progres Baseline → Target 2026</div>
      <div class="big-metric-val">{{ $prog7 }}%</div>
      <div class="big-metric-target">Target: 55% | Baseline: 36%</div>
      <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;"><div style="width:{{ $prog7 }}%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
      <div style="font-size:12px;opacity:.6;margin-top:8px;">Sumber: THE Impact Ranking 2025 — peringkat 601–800</div>
    </div>
    <div class="card">
      <div class="ch"><div class="ch-left"><div class="ch-icon" style="background:#d1fae5;color:#065f46;"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/></svg></div><div><div class="ch-title">5 SDG Prioritas UNSRI</div><div class="ch-sub">SDG Wajib + SDG Unggulan UNSRI</div></div></div></div>
      <div class="sdg-grid">
        <div class="sdg-card" style="background:#e5243b;"><div class="sdg-num">1</div><div class="sdg-name">Tanpa Kemiskinan</div><div class="sdg-type">Wajib</div></div>
        <div class="sdg-card" style="background:#c5192d;"><div class="sdg-num">4</div><div class="sdg-name">Pendidikan Berkualitas</div><div class="sdg-type">Wajib</div></div>
        <div class="sdg-card" style="background:#26bde2;"><div class="sdg-num">6</div><div class="sdg-name">Air Bersih & Sanitasi</div><div class="sdg-type">Unggulan UNSRI</div></div>
        <div class="sdg-card" style="background:#3f7e44;"><div class="sdg-num">13</div><div class="sdg-name">Aksi Iklim</div><div class="sdg-type">Unggulan UNSRI</div></div>
        <div class="sdg-card" style="background:#19486a;"><div class="sdg-num">17</div><div class="sdg-name">Kemitraan untuk Tujuan</div><div class="sdg-type">Wajib</div></div>
      </div>
    </div>
    <div class="card">
      <div class="ch"><div class="ch-left"><div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/></svg></div><div><div class="ch-title">Rencana Program Pencapaian IKU 7</div><div class="ch-sub">Intervensi untuk meningkatkan skor THE Impact Ranking</div></div></div></div>
      <div class="cp">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
          @foreach(['Wajibkan CPL bermuatan SDGs di setiap kurikulum prodi','SK bantuan mahasiswa S1 berekonomi lemah (SDG 1)','Integrasi SDGs dalam proposal PkM & KKN Tematik','Kaitkan kegiatan kemahasiswaan dengan 5 SDG prioritas','Penguatan riset air bersih & sanitasi (SDG 6)','Kembangkan riset aksi iklim & energi terbarukan (SDG 13)','Buat pelaporan SDGs tahunan ke THE Impact','Kolaborasi kemitraan internasional SDGs (SDG 17)'] as $prog)
          <div style="font-size:12px;color:var(--sub);background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-sm);padding:10px 12px;display:flex;gap:8px;align-items:flex-start;"><span style="color:var(--green-dk);margin-top:2px;flex-shrink:0;">✓</span>{{ $prog }}</div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="side">
    <div class="side-card"><div class="side-head"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><div class="side-head-title">TARGET PK REKTOR 2026</div></div><div class="side-body"><div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val" style="color:var(--red);">36%</span></div><div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">55%</span></div><div class="tgt-row"><span class="tgt-lbl">Gap</span><span class="tgt-val" style="color:var(--red-dk);">+19 pp</span></div><div class="tgt-row"><span class="tgt-lbl">THE Impact Ranking</span><span class="tgt-val">601–800</span></div><div class="tgt-row" style="border:none;"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR1 / Tim SDGs</span></div></div></div>
    <div class="side-card"><div class="side-head" style="background:#1e40af;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg><div class="side-head-title">SUMBER DATA</div></div><div class="side-body"><div class="formula"><strong>Sumber Data Utama:</strong><br>THE Impact Ranking (times highereducation.com)<br><br><strong>Metode Pengukuran:</strong><br>Persentase keterlibatan dari total poin THE Impact pada 5 SDG prioritas UNSRI</div></div></div>
  </div>
</div>
@endsection