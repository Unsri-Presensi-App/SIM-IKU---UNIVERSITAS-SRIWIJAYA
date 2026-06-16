@extends('layouts.app')

@section('title', 'IKU 3 – Mahasiswa Berkegiatan · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 3 – Mahasiswa di Luar Prodi')

@push('styles')
@include('partials.iku-page-styles')
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Baseline 2025</div><div class="sc-val">{{ number_format($baseline,2,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target 2026</div><div class="sc-val">{{ number_format($target,2,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target Mhs MBKM</div><div class="sc-val">{{ number_format($total_target,0,',','.') }}</div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Entri Valid</div><div class="sc-val">{{ $jumlahValid }}</div></div>
      <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
    </div>
  </x-slot:cards>

  <x-slot:notice>
    <div class="notice notice-amber">
      <div class="notice-icon"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
      <div class="notice-body">
        <div class="notice-title">Data MBKM / Kegiatan Luar Prodi (dalam pengembangan API)</div>
        <div class="notice-desc">Data utama berasal dari sistem MBKM &amp; SIM Kemahasiswaan. Unit prodi/fakultas melengkapi capaian yang belum terjaring lewat form di tab Input.</div>
      </div>
    </div>
  </x-slot:notice>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
        <div><div class="ch-title">Mahasiswa Berkegiatan di Luar Prodi per Fakultas</div><div class="ch-sub">Target 2026 · S1 dan D3 · UNSRI</div></div>
      </div>
    </div>
    <div class="cp">
      <div class="tbl-wrap">
        <table>
          <thead><tr><th>#</th><th>Fakultas</th><th>Mhs S1</th><th>Mhs D3</th><th>Target MBKM</th><th>% Target</th></tr></thead>
          <tbody>
            @forelse($rows_fakultas as $i => $row)
            @php $total_mhs = $row['s1'] + $row['d3']; $pct = $total_mhs > 0 ? round($row['target'] / $total_mhs * 100, 1) : 0; @endphp
            <tr>
              <td style="color:var(--faint);">{{ $i+1 }}</td>
              <td><strong style="color:var(--text);">{{ $row['fak'] }}</strong></td>
              <td>{{ number_format($row['s1'],0,',','.') }}</td>
              <td>{{ $row['d3'] > 0 ? number_format($row['d3'],0,',','.') : '–' }}</td>
              <td style="font-weight:600;color:var(--indigo);">{{ number_format($row['target'],0,',','.') }}</td>
              <td style="color:var(--muted);">{{ $pct }}%</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:24px;">Data belum tersedia.</td></tr>
            @endforelse
            <tr class="total-row">
              <td colspan="2">Total UNSRI</td>
              <td>{{ number_format($total_s1,0,',','.') }}</td>
              <td>{{ number_format($total_d3,0,',','.') }}</td>
              <td>{{ number_format($total_target,0,',','.') }}</td>
              <td>–</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val">{{ number_format($baseline,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ number_format($target,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target Mhs MBKM</span><span class="tgt-val">{{ number_format($total_target,0,',','.') }}</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Formula</span></div>
      <div class="side-body"><div class="formula">{{ $iku_meta['formula'] }}</div></div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
