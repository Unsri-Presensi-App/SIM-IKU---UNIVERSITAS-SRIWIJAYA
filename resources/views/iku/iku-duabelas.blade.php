@extends('layouts.app')

@section('title', 'IKU 12 – Kesejahteraan Dosen · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 12 – Kesejahteraan Dosen')

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
      <div><div class="sc-lbl">Dokumen Diinput</div><div class="sc-val">{{ $totalEntri }}</div></div>
      <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Menunggu Validasi</div><div class="sc-val" style="color:var(--amber);">{{ $diajukan }}</div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Dokumen Valid</div><div class="sc-val" style="color:var(--green-dk);">{{ $jumlahValid }}</div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target</div><div class="sc-val" style="font-size:20px;">1 Dokumen</div></div>
      <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"/></svg></div>
    </div>
  </x-slot:cards>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
        <div><div class="ch-title">Perencanaan Strategis Kesejahteraan Dosen</div><div class="ch-sub">Dokumen resmi: kebijakan, program, target, dan pendanaan</div></div>
      </div>
    </div>
    <div class="cp">
      <div style="font-size:13px;color:var(--sub);line-height:1.7;">Direktorat SDM/Perencanaan mengunggah dokumen resmi yang memuat kebijakan, program, target, dan pendanaan kesejahteraan dosen lewat tab <strong>Input</strong> untuk divalidasi.</div>
      <div class="info-grid" style="margin-top:14px;">
        <div class="info-item"><strong>Kebijakan</strong>SK/Peraturan tentang kesejahteraan dosen</div>
        <div class="info-item"><strong>Program</strong>Tunjangan, insentif, jaminan kesehatan, pengembangan karier</div>
        <div class="info-item"><strong>Target &amp; Indikator</strong>Sasaran terukur peningkatan kesejahteraan</div>
        <div class="info-item"><strong>Pendanaan</strong>Sumber &amp; alokasi anggaran yang menjamin keberlanjutan</div>
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
