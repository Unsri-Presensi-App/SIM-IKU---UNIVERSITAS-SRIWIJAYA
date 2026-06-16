@extends('layouts.app')

@section('title', 'IKU 2 – Lulusan Bekerja · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 2 – Lulusan Bekerja')

@push('styles')
@include('partials.iku-page-styles')
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  {{-- Summary cards --}}
  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Baseline 2025</div><div class="sc-val">{{ number_format($baseline,2,',','.') }}<span class="sc-unit">{{ $satuan }}</span></div></div>
      <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target 2026</div><div class="sc-val">{{ number_format($target,2,',','.') }}<span class="sc-unit">{{ $satuan }}</span></div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Kenaikan Target</div><div class="sc-val">+{{ number_format($target-$baseline,2,',','.') }}<span class="sc-unit">pp</span></div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Entri Valid</div><div class="sc-val">{{ $jumlahValid }}</div></div>
      <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
    </div>
  </x-slot:cards>

  {{-- Notice tracer --}}
  <x-slot:notice>
    <div class="notice notice-amber">
      <div class="notice-icon"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
      <div class="notice-body">
        <div class="notice-title">Data Tracer Study (dalam pengembangan API)</div>
        <div class="notice-desc">Data utama berasal dari API Tracer Study. Unit/CDC dapat melengkapi responden yang belum terjaring lewat form di tab Input. Data pelengkap divalidasi Direktorat.</div>
      </div>
    </div>
  </x-slot:notice>

  {{-- Main: tabel per fakultas --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
        <div><div class="ch-title">Lulusan Bekerja per Fakultas</div><div class="ch-sub">Baseline 2025 · Target 2026 · UNSRI</div></div>
      </div>
      <a href="#" class="btn btn-sm">Export</a>
    </div>
    <div class="cp">
      <div class="tbl-wrap">
        <table>
          <thead><tr><th>No</th><th>Fakultas</th><th>Baseline 2025</th><th>Target 2026</th><th>Selisih</th><th>Progres</th><th>Status</th></tr></thead>
          <tbody>
            @forelse($fakultas as $i => $row)
            @php
              $b = (float)($row->baseline_2025 ?? 0);
              $t = (float)($row->target_2026 ?? 0);
              $sel = $t - $b;
              $prog = $t > 0 ? min(($b / $t) * 100, 100) : 0;
              $pf = $sel <= 0 ? 'pf-green' : ($prog >= 90 ? 'pf-amber' : 'pf-red');
            @endphp
            <tr>
              <td style="color:var(--faint);">{{ $i + 1 }}</td>
              <td><strong style="color:var(--text);">{{ $row->fakultas }}</strong></td>
              <td>{{ number_format($b,2,',','.') }}%</td>
              <td style="font-weight:600;">{{ number_format($t,2,',','.') }}%</td>
              <td style="color:var(--muted);font-weight:600;">{{ $sel > 0 ? '+' : '' }}{{ number_format($sel,2,',','.') }}%</td>
              <td>
                <div style="display:flex;align-items:center;gap:8px;">
                  <div style="min-width:72px;"><div class="prog-bar"><div class="prog-fill {{ $pf }}" style="width:{{ $prog }}%;"></div></div></div>
                  <strong>{{ number_format($prog,1,',','.') }}%</strong>
                </div>
              </td>
              <td>
                @if($sel <= 0)<span class="st st-green"><span class="st-dot"></span>Stabil</span>
                @elseif($sel <= 2)<span class="st st-amber"><span class="st-dot"></span>Kenaikan Ringan</span>
                @else<span class="st st-red"><span class="st-dot"></span>Perlu Dorongan</span>@endif
              </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:24px;">Data belum tersedia.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- Sidebar --}}
  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val">{{ number_format($baseline,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ number_format($target,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Kenaikan</span><span class="tgt-val">+{{ number_format($target-$baseline,2,',','.') }} pp</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Satuan</span><span class="tgt-val">{{ $satuan }}</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Formula</span></div>
      <div class="side-body"><div class="formula">{{ $iku_meta['formula'] }}</div></div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
