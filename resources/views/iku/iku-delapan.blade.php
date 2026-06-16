@extends('layouts.app')

@section('title', 'IKU 8 – SDM Terlibat Kebijakan · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 8 – SDM Terlibat Penyusunan Kebijakan')

@push('styles')
@include('partials.iku-page-styles')
<style>
  .ic-red{background:var(--red-lt);color:var(--red);}
  .kebijakan-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;padding:16px 18px;}
  .keb-item{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);padding:14px;}
  .keb-type{font-size:12px;font-weight:700;color:var(--navy);margin-bottom:4px;}
  .keb-desc{font-size:11px;color:var(--sub);line-height:1.5;}
  .keb-example{font-size:10px;color:var(--muted);margin-top:6px;font-style:italic;}
  @media(max-width:900px){.kebijakan-grid{grid-template-columns:1fr;}}
</style>
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Baseline 2025</div><div class="sc-val">{{ $baseline }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-red"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target 2026</div><div class="sc-val">{{ $target }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Gap Target</div><div class="sc-val" style="color:var(--red);">+{{ $gap }}<span class="sc-unit">pp</span></div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target Jumlah Dosen</div><div class="sc-val" style="color:var(--navy);">{{ $target_dosen }}</div></div>
      <div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
    </div>
  </x-slot:cards>

  <x-slot:notice>
    <div class="notice notice-amber" style="background:var(--red-lt);border-color:#fecaca;">
      <div class="notice-icon" style="color:var(--red);"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
      <div class="notice-body">
        <div class="notice-title" style="color:var(--red-dk);">Status Kritis — Gap {{ $gap }} pp</div>
        <div class="notice-desc" style="color:var(--red-dk);">Baseline <strong>{{ $baseline }}%</strong> vs Target <strong>{{ $target }}%</strong>. Diperlukan keterlibatan tambahan <strong>{{ $target_dosen }} dosen/peneliti</strong> dalam penyusunan kebijakan. Input keterlibatan lewat tab Input.</div>
      </div>
      <div class="notice-aside" style="color:var(--red-dk);">STATUS KRITIS</div>
    </div>
  </x-slot:notice>

  <div class="big-metric">
    <div class="big-metric-label">Progres Baseline → Target 2026</div>
    <div class="big-metric-val">{{ $prog }}%</div>
    <div class="big-metric-target">Target: {{ $target }}% ({{ $target_dosen }} dosen/peneliti)</div>
    <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;"><div style="width:{{ min($prog,100) }}%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
    <div style="font-size:12px;opacity:.65;margin-top:8px;">Diperlukan peningkatan ±4× lipat dari baseline saat ini</div>
  </div>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/></svg></div>
        <div><div class="ch-title">Kategori Keterlibatan Kebijakan</div><div class="ch-sub">Jenis keterlibatan yang diakui dalam IKU 8</div></div>
      </div>
    </div>
    <div class="kebijakan-grid">
      @foreach([['Kebijakan Nasional','Tim perumus/anggota komite di Kementerian/Lembaga Pusat','Contoh: Tim Penyusun Kurikulum Nasional Kemendikbud'],['Kebijakan Daerah','Konsultan/narasumber resmi penyusunan Perda/Pergub/Perbup','Contoh: Konsultan RPJMD Provinsi Sumatera Selatan'],['Kebijakan Industri','Penyusunan standar industri, SNI, atau kebijakan BUMN/swasta','Contoh: Komite Teknis BSN / Penyusun SOP BUMN'],['Bank Indonesia & OJK','Narasumber resmi forum/sidang/kajian BI, OJK, BPS','Contoh: Tim Kajian Ekonomi Regional Bank Indonesia'],['Riset Kebijakan','Penelitian terapan yang digunakan langsung pemangku kebijakan','Contoh: Policy Brief diadopsi Pemerintah Provinsi'],['Dewan/Komite Resmi','Komisi, dewan, atau tim advisi resmi dan berkesinambungan','Contoh: Anggota Dewan Pendidikan Provinsi']] as $k)
      <div class="keb-item"><div class="keb-type">{{ $k[0] }}</div><div class="keb-desc">{{ $k[1] }}</div><div class="keb-example">{{ $k[2] }}</div></div>
      @endforeach
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val" style="color:var(--red);">{{ $baseline }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ $target }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Est. Dosen Terlibat</span><span class="tgt-val" style="color:var(--navy);">{{ $target_dosen }} dosen</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR2 &amp; WR3</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Formula</span></div>
      <div class="side-body"><div class="formula">{{ $iku_meta['formula'] }}<br><br><span style="font-size:11px;color:var(--muted);">Satu dosen masuk 1 kategori saja. Wajib dibuktikan SK/kontrak/surat tugas.</span></div></div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
