@extends('layouts.app')

@section('title', 'IKU 11d – Anti Kekerasan/Narkoba/Korupsi · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 11d – Anti Kekerasan, Narkoba, Korupsi')

@push('styles')
@include('partials.iku-page-styles')
@endpush

@section('content')
@php
  $totalEntri = $entri->count();
  $diajukan   = $entri->where('status','diajukan')->count();
@endphp
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Total Kegiatan</div><div class="sc-val">{{ $totalEntri }}</div></div>
      <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Menunggu Validasi</div><div class="sc-val" style="color:var(--amber);">{{ $diajukan }}</div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Kegiatan Valid</div><div class="sc-val" style="color:var(--green-dk);">{{ $jumlahValid }}</div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target Capaian</div><div class="sc-val">100<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
    </div>
  </x-slot:cards>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:var(--indigo-lt);color:var(--indigo);"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <div><div class="ch-title">Program Pencegahan &amp; Penanganan</div><div class="ch-sub">Anti Kekerasan · Anti Narkoba · Anti Korupsi</div></div>
      </div>
    </div>
    <div class="cp">
      <div style="font-size:13px;color:var(--sub);line-height:1.7;">Satgas/SPI/Kemahasiswaan menginput kegiatan rencana dan realisasi beserta bukti implementasi. Tiap kegiatan dicatat sebagai entri dan dilengkapi eviden lewat tab <strong>Input</strong>.</div>
      <div class="info-grid" style="margin-top:14px;grid-template-columns:repeat(3,1fr);">
        <div class="info-item"><strong>Anti Kekerasan</strong>Satgas PPKS, sosialisasi, layanan korban, SOP penanganan</div>
        <div class="info-item"><strong>Anti Narkoba</strong>Tes urin berkala, kampanye, kerja sama BNN</div>
        <div class="info-item"><strong>Anti Korupsi</strong>Pendidikan antikorupsi, gratifikasi, WBS, LHKPN</div>
      </div>
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Sumber Data &amp; Formula</span></div>
      <div class="side-body"><div class="formula">{{ $iku_meta['formula'] }}<br><br><strong>Sumber:</strong> {{ $iku_meta['sumber'] }}.</div></div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
