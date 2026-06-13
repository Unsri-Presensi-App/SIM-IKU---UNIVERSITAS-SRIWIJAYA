{{-- ============================================================
     IKU 11 | resources/views/iku/iku-sebelas.blade.php
     Opini WTP BPK + Predikat SAKIP
     Baseline 2025: WTP / A | Target 2026: WTP / AA
     ============================================================ --}}
@extends('layouts.app')
@section('title', 'IKU 11 – Opini WTP & SAKIP · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 11 – Opini WTP BPK & Predikat SAKIP')
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
  .ic-gold{background:#fef3c7;color:#92400e;}
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
  /* Dual metric cards */
  .dual-metric{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px;}
  .metric-card{border-radius:var(--r-lg);padding:24px 20px;text-align:center;color:#fff;position:relative;overflow:hidden;}
  .metric-card::before{content:'';position:absolute;top:-30px;right:-30px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.08);}
  .metric-card-label{font-size:11px;font-weight:700;opacity:.75;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;}
  .metric-card-val{font-size:52px;font-weight:900;letter-spacing:-.04em;line-height:1;}
  .metric-card-sub{font-size:13px;opacity:.8;margin-top:6px;}
  .metric-card-arrow{font-size:20px;margin:10px 0 6px;opacity:.9;}
  .metric-wtp{background:linear-gradient(135deg,#065f46 0%,#047857 100%);}
  .metric-sakip{background:linear-gradient(135deg,var(--navy) 0%,#1e40af 100%);}
  /* SAKIP Level gauge */
  .sakip-levels{display:flex;gap:0;padding:16px 20px;border-bottom:1px solid var(--border);}
  .sakip-level{flex:1;text-align:center;padding:12px 6px;border-right:1px solid var(--border);position:relative;}
  .sakip-level:last-child{border-right:none;}
  .sakip-level-badge{display:inline-flex;width:36px;height:36px;border-radius:50%;align-items:center;justify-content:center;font-size:14px;font-weight:900;margin:0 auto 6px;border:2px solid transparent;}
  .sakip-level-label{font-size:11px;font-weight:700;display:block;}
  .sakip-level-score{font-size:10px;color:var(--muted);margin-top:2px;}
  .sakip-current{background:var(--indigo-lt);border-color:var(--indigo)!important;color:var(--indigo);}
  .sakip-target-lv{background:var(--green-lt);border-color:var(--green-dk)!important;color:var(--green-dk);}
  .sakip-lower{background:#f8f9fd;color:var(--faint);border-color:var(--border)!important;}
  .sakip-level .sakip-pointer{position:absolute;top:-6px;left:50%;transform:translateX(-50%);font-size:9px;font-weight:700;white-space:nowrap;padding:1px 6px;border-radius:999px;}
  .ptr-current{background:var(--indigo);color:#fff;}
  .ptr-target{background:var(--green-dk);color:#fff;}
  /* Sub indicators */
  .subind-list{padding:14px 20px;display:flex;flex-direction:column;gap:10px;}
  .subind-item{display:flex;align-items:center;gap:12px;padding:12px 14px;background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);}
  .subind-icon{width:36px;height:36px;border-radius:var(--r-sm);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:16px;}
  .subind-body{flex:1;}
  .subind-title{font-size:13px;font-weight:700;color:var(--text);}
  .subind-desc{font-size:11px;color:var(--muted);margin-top:2px;}
  .subind-right{text-align:right;}
  .subind-bl{font-size:12px;color:var(--muted);white-space:nowrap;}
  .subind-tgt{font-size:14px;font-weight:800;color:var(--navy);white-space:nowrap;}
  .st{display:inline-flex;padding:2px 8px;border-radius:999px;font-size:10px;font-weight:700;}
  .st-green{background:var(--green-lt);color:var(--green-dk);}
  .st-amber{background:var(--amber-lt);color:var(--amber-dk);}
  .st-red{background:var(--red-lt);color:var(--red-dk);}
  .st-blue{background:var(--indigo-lt);color:var(--indigo-dk);}
  /* Prog bar */
  .prog-row{display:flex;flex-direction:column;gap:6px;margin-bottom:10px;}
  .prog-label{display:flex;justify-content:space-between;font-size:12px;}
  .prog-bar{height:8px;background:#eaecf0;border-radius:999px;overflow:hidden;}
  .prog-fill{height:100%;border-radius:999px;transition:width .4s;}
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
  @media(max-width:900px){.sum-grid{grid-template-columns:repeat(2,1fr);}.sakip-levels{flex-wrap:wrap;}.sakip-level{flex:0 0 33.33%;border-bottom:1px solid var(--border);}}
  @media(max-width:768px){.ph-title{font-size:18px;}.sum-grid{gap:8px;}.sc{padding:12px;}.sc-val{font-size:20px;}.dual-metric{grid-template-columns:1fr;}.metric-card-val{font-size:38px;}.metric-card{padding:18px 16px;}}
  @media(max-width:580px){.sum-grid{grid-template-columns:repeat(2,1fr);}.side{display:flex;flex-direction:column;gap:12px;}.sakip-levels{flex-wrap:wrap;}.sakip-level{flex:0 0 50%;}
    .subind-item{flex-wrap:wrap;}.subind-right{text-align:left;width:100%;display:flex;gap:12px;align-items:center;}}
  @media(max-width:400px){.sum-grid{grid-template-columns:1fr;}.sakip-level{flex:0 0 100%;}}
</style>
@endpush
@section('content')
<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Dimensi Tata Kelola</div>
    <div class="ph-title">
      IKU 11 – Opini WTP BPK & Predikat SAKIP
      <span class="badge wajib" style="vertical-align:middle;margin-left:6px;">IKU Wajib</span>
      <span class="badge tata" style="vertical-align:middle;margin-left:4px;">Tata Kelola</span>
    </div>
    <div class="ph-sub">Opini Wajar Tanpa Pengecualian (WTP) dari BPK RI atas Laporan Keuangan UNSRI, dan peningkatan predikat SAKIP dari <strong>A</strong> menuju <strong>AA</strong>. PJ: Rektor / WR2 / Biro Keuangan.</div>
  </div>
</section>

<div class="notice">
  <div style="color:var(--amber);flex-shrink:0;"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
  <div><div class="notice-title">Data Progres Sementara</div><div class="notice-desc">Baseline 2025: <strong>WTP (Opini BPK)</strong> dan <strong>Predikat A (SAKIP)</strong>. Hasil audit BPK 2026 dan evaluasi SAKIP 2026 dari Kemendikbudristek belum keluar. Nilai SAKIP indikatif: <strong>85/100</strong> (Predikat A = 75–90).</div></div>
  <div style="font-size:11px;color:var(--amber-dk);font-weight:600;white-space:nowrap;align-self:center;">Mode sementara</div>
</div>

@php
  $opini_baseline = $opini_baseline ?? 'WTP';
  $opini_target = $opini_target ?? 'WTP';
  $sakip_baseline = $sakip_baseline ?? 'A';
  $sakip_target = $sakip_target ?? 'AA';
  $sakip_nilai_baseline = $sakip_nilai_baseline ?? 85;
  $sakip_nilai_target = $sakip_nilai_target ?? 95;
  $sakip_prog = round($sakip_nilai_baseline / $sakip_nilai_target * 100, 1);
@endphp

<div class="sum-grid">
  <div class="sc">
    <div>
      <div class="sc-lbl">Opini BPK Baseline</div>
      <div class="sc-val" style="font-size:20px;line-height:1.3;color:var(--green-dk);">{{ $opini_baseline }}</div>
      <div style="font-size:11px;color:var(--green-dk);margin-top:4px;">Wajar Tanpa Pengecualian</div>
    </div>
    <div class="sc-ic ic-green">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
    </div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">Opini BPK Target</div>
      <div class="sc-val" style="font-size:20px;line-height:1.3;color:var(--green-dk);">{{ $opini_target }}</div>
      <div style="font-size:11px;color:var(--green-dk);margin-top:4px;">Dipertahankan 2026</div>
    </div>
    <div class="sc-ic ic-green">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
    </div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">SAKIP Baseline</div>
      <div class="sc-val" style="color:var(--indigo);">{{ $sakip_baseline }}</div>
      <div style="font-size:11px;color:var(--muted);margin-top:4px;">Nilai ~{{ $sakip_nilai_baseline }}/100</div>
    </div>
    <div class="sc-ic ic-navy">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
    </div>
  </div>
  <div class="sc">
    <div>
      <div class="sc-lbl">SAKIP Target</div>
      <div class="sc-val" style="color:var(--gold);">{{ $sakip_target }}</div>
      <div style="font-size:11px;color:var(--amber-dk);margin-top:4px;">Nilai ≥90/100</div>
    </div>
    <div class="sc-ic ic-gold">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
    </div>
  </div>
</div>

<div class="lay">
  <div>
    {{-- Dual Big Metric --}}
    <div class="dual-metric">
      <div class="metric-card metric-wtp">
        <div class="metric-card-label">Opini BPK RI</div>
        <div class="metric-card-val">WTP</div>
        <div class="metric-card-arrow">↓</div>
        <div class="metric-card-sub">Target: Dipertahankan</div>
        <div style="margin:12px auto 0;max-width:200px;height:6px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;">
          <div style="width:100%;height:100%;background:var(--gold);border-radius:999px;"></div>
        </div>
        <div style="font-size:11px;opacity:.6;margin-top:6px;">100% — Status dipertahankan</div>
      </div>
      <div class="metric-card metric-sakip">
        <div class="metric-card-label">Predikat SAKIP</div>
        <div class="metric-card-val">A → AA</div>
        <div class="metric-card-arrow">↑</div>
        <div class="metric-card-sub">~{{ $sakip_nilai_baseline }} / {{ $sakip_nilai_target }} poin</div>
        <div style="margin:12px auto 0;max-width:200px;height:6px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;">
          <div style="width:{{ $sakip_prog }}%;height:100%;background:var(--gold);border-radius:999px;"></div>
        </div>
        <div style="font-size:11px;opacity:.6;margin-top:6px;">{{ $sakip_prog }}% menuju target</div>
      </div>
    </div>

    {{-- SAKIP Level Gauge --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon" style="background:#fef3c7;color:#92400e;">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <div><div class="ch-title">Skala Predikat SAKIP Kemendikbudristek</div><div class="ch-sub">Sistem Akuntabilitas Kinerja Instansi Pemerintah — Level UNSRI</div></div>
        </div>
      </div>
      <div class="sakip-levels">
        <div class="sakip-level">
          <div class="sakip-level-badge sakip-lower">D</div>
          <span class="sakip-level-label" style="color:var(--faint);">D</span>
          <div class="sakip-level-score">&lt;30</div>
        </div>
        <div class="sakip-level">
          <div class="sakip-level-badge sakip-lower">CC</div>
          <span class="sakip-level-label" style="color:var(--faint);">CC</span>
          <div class="sakip-level-score">30–50</div>
        </div>
        <div class="sakip-level">
          <div class="sakip-level-badge sakip-lower">C</div>
          <span class="sakip-level-label" style="color:var(--faint);">C</span>
          <div class="sakip-level-score">50–60</div>
        </div>
        <div class="sakip-level">
          <div class="sakip-level-badge sakip-lower">B</div>
          <span class="sakip-level-label" style="color:var(--faint);">B</span>
          <div class="sakip-level-score">60–70</div>
        </div>
        <div class="sakip-level">
          <div class="sakip-level-badge sakip-lower">BB</div>
          <span class="sakip-level-label" style="color:var(--muted);">BB</span>
          <div class="sakip-level-score">70–75</div>
        </div>
        <div class="sakip-level" style="position:relative;">
          <div class="sakip-pointer ptr-current" style="position:absolute;top:-8px;left:50%;transform:translateX(-50%);">SAAT INI</div>
          <div class="sakip-level-badge sakip-current">A</div>
          <span class="sakip-level-label" style="color:var(--indigo-dk);">A</span>
          <div class="sakip-level-score">75–90</div>
        </div>
        <div class="sakip-level" style="position:relative;">
          <div class="sakip-pointer ptr-target" style="position:absolute;top:-8px;left:50%;transform:translateX(-50%);">TARGET</div>
          <div class="sakip-level-badge sakip-target-lv">AA</div>
          <span class="sakip-level-label" style="color:var(--green-dk);">AA</span>
          <div class="sakip-level-score">90–100</div>
        </div>
      </div>
      <div class="cp" style="padding-top:10px;">
        <div class="prog-row">
          <div class="prog-label">
            <span style="font-size:13px;font-weight:600;">Progres Nilai SAKIP: {{ $sakip_nilai_baseline }} → {{ $sakip_nilai_target }}</span>
            <span style="font-weight:700;color:var(--navy);">{{ $sakip_prog }}%</span>
          </div>
          <div class="prog-bar"><div class="prog-fill" style="width:{{ $sakip_prog }}%;background:linear-gradient(90deg,var(--indigo),var(--gold));"></div></div>
        </div>
        <div style="font-size:11px;color:var(--muted);">Gap nilai: <strong>{{ $sakip_nilai_target - $sakip_nilai_baseline }} poin</strong> — Perlu naik dari predikat A (75–90) ke predikat AA (≥90)</div>
      </div>
    </div>

    {{-- Sub Indikator IKU 11 --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon" style="background:#e8f0fb;color:var(--navy);">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
          </div>
          <div><div class="ch-title">Sub-Indikator IKU 11</div><div class="ch-sub">4 sub-indikator penilaian tata kelola dan integritas UNSRI</div></div>
        </div>
      </div>
      <div class="subind-list">
        <div class="subind-item">
          <div class="subind-icon" style="background:var(--green-lt);">📋</div>
          <div class="subind-body">
            <div class="subind-title">Opini WTP BPK RI</div>
            <div class="subind-desc">Laporan keuangan UNSRI mendapat opini Wajar Tanpa Pengecualian dari BPK RI. Dipertahankan setiap tahun.</div>
          </div>
          <div class="subind-right">
            <div class="subind-bl">Baseline: <strong>WTP</strong></div>
            <div class="subind-tgt">Target: WTP</div>
            <span class="st st-green" style="margin-top:4px;display:inline-flex;">Dipertahankan</span>
          </div>
        </div>
        <div class="subind-item">
          <div class="subind-icon" style="background:#fef3c7;">⭐</div>
          <div class="subind-body">
            <div class="subind-title">Predikat SAKIP</div>
            <div class="subind-desc">Peningkatan predikat SAKIP dari A (nilai ~85) menuju AA (nilai ≥90) berdasarkan evaluasi Kemendikbudristek.</div>
          </div>
          <div class="subind-right">
            <div class="subind-bl">Baseline: <strong>A</strong></div>
            <div class="subind-tgt">Target: AA</div>
            <span class="st st-amber" style="margin-top:4px;display:inline-flex;">Perlu Peningkatan</span>
          </div>
        </div>
        <div class="subind-item">
          <div class="subind-icon" style="background:var(--green-lt);">🔒</div>
          <div class="subind-body">
            <div class="subind-title">Laporan Pelanggaran (Whistleblowing)</div>
            <div class="subind-desc">Jumlah pelanggaran yang dilaporkan melalui sistem WBS. Target nol pelanggaran berat / tidak tertangani.</div>
          </div>
          <div class="subind-right">
            <div class="subind-bl">Baseline: <strong>0</strong></div>
            <div class="subind-tgt">Target: 0</div>
            <span class="st st-green" style="margin-top:4px;display:inline-flex;">Dipertahankan</span>
          </div>
        </div>
        <div class="subind-item">
          <div class="subind-icon" style="background:var(--indigo-lt);">🛡️</div>
          <div class="subind-body">
            <div class="subind-title">Pencegahan Kekerasan, Narkoba & Korupsi</div>
            <div class="subind-desc">Implementasi program pencegahan kekerasan seksual, penyalahgunaan narkoba, dan korupsi di lingkungan UNSRI. Target capaian 100%.</div>
          </div>
          <div class="subind-right">
            <div class="subind-bl">Baseline: <strong>100%</strong></div>
            <div class="subind-tgt">Target: 100%</div>
            <span class="st st-green" style="margin-top:4px;display:inline-flex;">Dipertahankan</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Rencana Peningkatan SAKIP --}}
    <div class="card">
      <div class="ch">
        <div class="ch-left">
          <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></div>
          <div><div class="ch-title">Rencana Aksi Peningkatan SAKIP A → AA</div><div class="ch-sub">Intervensi strategis untuk menaikan nilai SAKIP ≥90 (Predikat AA)</div></div>
        </div>
      </div>
      <div class="cp">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
          @foreach([
            'Penajaman indikator kinerja utama (IKU) berbasis outcome',
            'Cascading target IKU ke seluruh unit kerja (Fakultas–Prodi)',
            'Penguatan sistem monitoring & evaluasi capaian IKU real-time',
            'Penyempurnaan dokumen Renstra dan Perjanjian Kinerja (PK)',
            'Peningkatan kualitas laporan kinerja (LKj) berbasis data',
            'Penguatan pengendalian gratifikasi dan LHKPN ASN',
            'Peningkatan akuntabilitas laporan keuangan unit kerja',
            'Pelatihan penyusunan anggaran berbasis kinerja (PABK)'
          ] as $rencana)
          <div style="font-size:12px;color:var(--sub);background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-sm);padding:10px 12px;display:flex;gap:8px;align-items:flex-start;">
            <span style="color:var(--green-dk);margin-top:2px;flex-shrink:0;">✓</span>{{ $rencana }}
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="side">
    <div class="side-card">
      <div class="side-head">
        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <div class="side-head-title">TARGET PK REKTOR 2026</div>
      </div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Opini BPK Baseline</span><span class="tgt-val" style="color:var(--green-dk);">{{ $opini_baseline }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Opini BPK Target</span><span class="tgt-val" style="color:var(--green-dk);">{{ $opini_target }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">SAKIP Baseline</span><span class="tgt-val" style="color:var(--indigo);">{{ $sakip_baseline }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">SAKIP Target</span><span class="tgt-val" style="color:var(--gold);">{{ $sakip_target }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Nilai SAKIP Saat Ini</span><span class="tgt-val">~{{ $sakip_nilai_baseline }}/100</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Nilai SAKIP Target</span><span class="tgt-val">≥{{ $sakip_nilai_target }}/100</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ Opini BPK</span><span class="tgt-val">WR2 / Biro Keu.</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">PJ SAKIP</span><span class="tgt-val">Rektor / Biro Prend.</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#065f46;">
        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
        <div class="side-head-title">TENTANG OPINI WTP</div>
      </div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Auditor</span><span class="tgt-val">BPK RI</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Frekuensi</span><span class="tgt-val">Tahunan</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">Objek Audit</span><span class="tgt-val">LK UNSRI</span></div>
        <div class="formula">WTP = Wajar Tanpa Pengecualian. Laporan Keuangan disajikan secara wajar dalam semua hal yang material sesuai SAP/SAK.</div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;">
        <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>
        <div class="side-head-title">SUMBER DATA</div>
      </div>
      <div class="side-body">
        <div class="formula">
          <strong>Opini WTP:</strong><br>
          Laporan Hasil Pemeriksaan (LHP) BPK RI atas Laporan Keuangan UNSRI<br><br>
          <strong>SAKIP:</strong><br>
          Laporan Evaluasi SAKIP dari Kemendikbudristek / Inspektorat Jenderal
        </div>
      </div>
    </div>
  </div>
</div>
@endsection