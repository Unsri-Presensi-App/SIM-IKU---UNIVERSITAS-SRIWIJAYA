@extends('layouts.app')

@section('title', 'IKU 11c – Integritas Akademik · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 11c – Integritas Akademik')

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
      <div><div class="sc-lbl">Total Entri</div><div class="sc-val">{{ $totalEntri }}</div></div>
      <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Menunggu Validasi</div><div class="sc-val" style="color:var(--amber);">{{ $diajukan }}</div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Entri Valid</div><div class="sc-val" style="color:var(--green-dk);">{{ $jumlahValid }}</div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Satuan</div><div class="sc-val" style="font-size:20px;">{{ $iku_meta['satuan'] }}</div><div style="font-size:11px;color:var(--muted);margin-top:4px;">semakin rendah semakin baik</div></div>
      <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
    </div>
  </x-slot:cards>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
        <div><div class="ch-title">Mekanisme Integritas Akademik</div><div class="ch-sub">Pencegahan &amp; penanganan pelanggaran integritas akademik</div></div>
      </div>
    </div>
    <div class="cp">
      <div style="font-size:13px;color:var(--sub);line-height:1.7;">Direktorat Akademik/Komisi Etik menginput jumlah laporan, tindak lanjut, dan bukti mekanisme integritas akademik. Setiap laporan dicatat sebagai entri dan dilengkapi eviden lewat tab <strong>Input</strong>.</div>
      <div class="info-grid" style="margin-top:14px;">
        <div class="info-item"><strong>Pencegahan</strong>Sosialisasi kode etik, pelatihan sitasi &amp; anti-plagiarisme, integrasi di kurikulum</div>
        <div class="info-item"><strong>Deteksi</strong>Pemeriksaan kemiripan (similarity), pelaporan dugaan pelanggaran via kanal resmi</div>
        <div class="info-item"><strong>Penanganan</strong>Verifikasi Komisi Etik, sidang, sanksi sesuai ketentuan</div>
        <div class="info-item"><strong>Dokumentasi</strong>Berita acara, SK sanksi, laporan tindak lanjut sebagai eviden</div>
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
