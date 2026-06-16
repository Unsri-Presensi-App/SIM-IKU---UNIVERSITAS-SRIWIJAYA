@extends('layouts.app')

@section('title', 'IKU 7 – Keterlibatan SDGs · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 7 – Keterlibatan PT dalam SDGs')

@push('styles')
@include('partials.iku-page-styles')
<style>
  .ic-red{background:var(--red-lt);color:var(--red);}
  .sdg-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:10px;padding:16px 18px;}
  .sdg-card{border-radius:var(--r-md);padding:14px 10px;text-align:center;color:#fff;font-weight:700;}
  .sdg-num{font-size:22px;font-weight:900;line-height:1;}
  .sdg-name{font-size:9px;font-weight:600;margin-top:4px;opacity:.9;line-height:1.3;}
  .sdg-type{font-size:9px;background:rgba(255,255,255,.25);border-radius:999px;padding:2px 6px;margin-top:6px;display:inline-block;}
  @media(max-width:900px){.sdg-grid{grid-template-columns:repeat(3,1fr);}}
  @media(max-width:580px){.sdg-grid{grid-template-columns:repeat(2,1fr);}}
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
      <div><div class="sc-lbl">Peringkat THE Impact</div><div class="sc-val" style="font-size:18px;">601–800</div></div>
      <div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/></svg></div>
    </div>
  </x-slot:cards>

  <x-slot:notice>
    <div class="notice notice-amber">
      <div class="notice-icon"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
      <div class="notice-body">
        <div class="notice-title">Data Progres Sementara</div>
        <div class="notice-desc">Baseline 2025 = <strong>{{ $baseline }}%</strong> (THE Impact Ranking 2025, peringkat 601–800). Program/kegiatan SDGs diinput unit lewat tab Input untuk divalidasi Direktorat Perencanaan/Pengabdian.</div>
      </div>
      <div class="notice-aside" style="color:var(--amber-dk);">Mode sementara</div>
    </div>
  </x-slot:notice>

  {{-- Big metric --}}
  <div class="big-metric">
    <div class="big-metric-label">Progres Baseline → Target 2026</div>
    <div class="big-metric-val">{{ $prog }}%</div>
    <div class="big-metric-target">Target: {{ $target }}% | Baseline: {{ $baseline }}%</div>
    <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;"><div style="width:{{ min($prog,100) }}%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
    <div style="font-size:12px;opacity:.65;margin-top:8px;">Sumber: THE Impact Ranking 2025 — peringkat 601–800</div>
  </div>

  {{-- SDG prioritas --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:#d1fae5;color:#065f46;"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/></svg></div>
        <div><div class="ch-title">5 SDG Prioritas UNSRI</div><div class="ch-sub">SDG Wajib + SDG Unggulan UNSRI</div></div>
      </div>
    </div>
    <div class="sdg-grid">
      <div class="sdg-card" style="background:#e5243b;"><div class="sdg-num">1</div><div class="sdg-name">Tanpa Kemiskinan</div><div class="sdg-type">Wajib</div></div>
      <div class="sdg-card" style="background:#c5192d;"><div class="sdg-num">4</div><div class="sdg-name">Pendidikan Berkualitas</div><div class="sdg-type">Wajib</div></div>
      <div class="sdg-card" style="background:#26bde2;"><div class="sdg-num">6</div><div class="sdg-name">Air Bersih &amp; Sanitasi</div><div class="sdg-type">Unggulan</div></div>
      <div class="sdg-card" style="background:#3f7e44;"><div class="sdg-num">13</div><div class="sdg-name">Aksi Iklim</div><div class="sdg-type">Unggulan</div></div>
      <div class="sdg-card" style="background:#19486a;"><div class="sdg-num">17</div><div class="sdg-name">Kemitraan untuk Tujuan</div><div class="sdg-type">Wajib</div></div>
    </div>
  </div>

  {{-- Rencana program --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/></svg></div>
        <div><div class="ch-title">Rencana Program Pencapaian IKU 7</div><div class="ch-sub">Intervensi peningkatan skor THE Impact Ranking</div></div>
      </div>
    </div>
    <div class="cp">
      <div class="info-grid">
        @foreach(['Wajibkan CPL bermuatan SDGs di setiap kurikulum prodi','SK bantuan mahasiswa S1 berekonomi lemah (SDG 1)','Integrasi SDGs dalam proposal PkM &amp; KKN Tematik','Kaitkan kegiatan kemahasiswaan dengan 5 SDG prioritas','Penguatan riset air bersih &amp; sanitasi (SDG 6)','Kembangkan riset aksi iklim &amp; energi terbarukan (SDG 13)','Buat pelaporan SDGs tahunan ke THE Impact','Kolaborasi kemitraan internasional SDGs (SDG 17)'] as $p)
        <div class="info-item" style="display:flex;gap:8px;align-items:flex-start;"><span style="color:var(--green-dk);flex-shrink:0;">✓</span><span>{!! $p !!}</span></div>
        @endforeach
      </div>
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val" style="color:var(--red);">{{ $baseline }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ $target }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Gap</span><span class="tgt-val" style="color:var(--red-dk);">+{{ $gap }} pp</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR1 / Tim SDGs</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Sumber Data &amp; Formula</span></div>
      <div class="side-body"><div class="formula"><strong>Sumber:</strong> THE Impact Ranking.<br><br>{{ $iku_meta['formula'] }}</div></div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
