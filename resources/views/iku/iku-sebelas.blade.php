@extends('layouts.app')

@section('title', 'IKU 11a – Opini Laporan Keuangan · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 11a – Opini Laporan Keuangan')

@push('styles')
@include('partials.iku-page-styles')
<style>
  .ic-gold{background:#fef3c7;color:#92400e;}
  .metric-card{border-radius:var(--r-lg);padding:26px 20px;text-align:center;color:#fff;position:relative;overflow:hidden;background:linear-gradient(135deg,#065f46 0%,#047857 100%);}
  .metric-card::before{content:'';position:absolute;top:-30px;right:-30px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.08);}
  .metric-card-label{font-size:11px;font-weight:700;opacity:.8;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;}
  .metric-card-val{font-size:52px;font-weight:900;letter-spacing:-.04em;line-height:1;}
  .metric-card-sub{font-size:13px;opacity:.85;margin-top:8px;}
</style>
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Opini Baseline</div><div class="sc-val" style="font-size:22px;color:var(--green-dk);">{{ $opini_baseline }}</div><div style="font-size:11px;color:var(--green-dk);margin-top:4px;">Wajar Tanpa Pengecualian</div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Opini Target</div><div class="sc-val" style="font-size:22px;color:var(--green-dk);">{{ $opini_target }}</div><div style="font-size:11px;color:var(--green-dk);margin-top:4px;">Dipertahankan 2026</div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Auditor</div><div class="sc-val" style="font-size:22px;">BPK RI</div></div>
      <div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Frekuensi Audit</div><div class="sc-val" style="font-size:22px;">Tahunan</div></div>
      <div class="sc-ic ic-gold"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
    </div>
  </x-slot:cards>

  <div class="metric-card">
    <div class="metric-card-label">Opini Laporan Keuangan UNSRI</div>
    <div class="metric-card-val">{{ $opini_baseline }}</div>
    <div class="metric-card-sub">Target 2026: {{ $opini_target }} — Dipertahankan</div>
    <div style="margin:14px auto 0;max-width:240px;height:8px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;"><div style="width:100%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
    <div style="font-size:11px;opacity:.65;margin-top:6px;">100% — Status dipertahankan</div>
  </div>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:var(--green-lt);color:var(--green-dk);"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div>
        <div><div class="ch-title">Tentang Opini WTP</div><div class="ch-sub">Wajar Tanpa Pengecualian dari BPK RI</div></div>
      </div>
    </div>
    <div class="cp">
      <div style="font-size:13px;color:var(--sub);line-height:1.7;">
        Opini <strong>WTP (Wajar Tanpa Pengecualian)</strong> berarti laporan keuangan disajikan secara wajar dalam semua hal yang material sesuai Standar Akuntansi Pemerintahan. Direktorat Keuangan/SPI mengunggah Laporan Hasil Pemeriksaan (LHP) BPK serta dokumen pendukung lewat tab <strong>Input</strong> untuk divalidasi.
      </div>
      <div class="info-grid" style="margin-top:14px;">
        <div class="info-item"><strong>Objek Audit</strong>Laporan Keuangan UNSRI tahun berjalan</div>
        <div class="info-item"><strong>Tingkatan Opini</strong>WTP · WDP · TW · TMP</div>
      </div>
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Opini Baseline</span><span class="tgt-val" style="color:var(--green-dk);">{{ $opini_baseline }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Opini Target</span><span class="tgt-val" style="color:var(--green-dk);">{{ $opini_target }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Auditor</span><span class="tgt-val">BPK RI</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR2 / Biro Keu.</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Sumber Data &amp; Formula</span></div>
      <div class="side-body"><div class="formula">{{ $iku_meta['formula'] }}<br><br><strong>Sumber:</strong> Laporan Hasil Pemeriksaan (LHP) BPK RI atas Laporan Keuangan UNSRI.</div></div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
