@extends('layouts.app')

@section('title', 'IKU 9 – Pendapatan Non-UKT · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 9 – Pendapatan Non Pendidikan/UKT')

@push('styles')
@include('partials.iku-page-styles')
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Non-UKT Baseline</div><div class="sc-val">{{ number_format($baseline,1,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Non-UKT Target</div><div class="sc-val">{{ number_format($target,1,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Dana Abadi Target</div><div class="sc-val">4<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Alokasi Riset Target</div><div class="sc-val">11,5<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v11m0 0h10m-10 0H3"/></svg></div>
    </div>
  </x-slot:cards>

  <div class="big-metric">
    <div class="big-metric-label">Progres Pendapatan Non-UKT Baseline → Target</div>
    <div class="big-metric-val">{{ $prog }}%</div>
    <div class="big-metric-target">Baseline: {{ number_format($baseline,1,',','.') }}% | Target: {{ number_format($target,1,',','.') }}%</div>
    <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;"><div style="width:{{ min($prog,100) }}%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
    <div style="font-size:12px;opacity:.65;margin-top:8px;">Gap tersisa: +{{ number_format($gap,1,',','.') }} pp — relatif terjangkau, perlu konsistensi</div>
  </div>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
        <div><div class="ch-title">Rincian Sub-Indikator IKU 9</div><div class="ch-sub">Komponen pendapatan &amp; alokasi — Baseline 2025 → Target 2026</div></div>
      </div>
      <a href="#" class="btn btn-sm">Export</a>
    </div>
    <div class="cp">
      <div class="tbl-wrap">
        <table>
          <thead><tr><th>Sub-Indikator</th><th>Baseline 2025</th><th>Target 2026</th><th>Progres</th><th>Status</th></tr></thead>
          <tbody>
            @foreach($sub_rows as $r)
            @php
              $color = $r['status']==='green'?'var(--green)':($r['status']==='amber'?'var(--amber)':'var(--red)');
              $stCls = $r['status']==='green'?'st-green':($r['status']==='amber'?'st-amber':'st-red');
              $stLbl = $r['status']==='green'?'Mendekati':($r['status']==='amber'?'Mendekati':'Kritis');
            @endphp
            <tr>
              <td><strong style="color:var(--text);">{{ $r['label'] }}</strong></td>
              <td>{{ $r['baseline'] }}</td>
              <td><strong style="color:var(--navy);">{{ $r['target'] }}</strong></td>
              <td class="prog"><div class="prog-lbl" style="color:{{ $color }};">{{ $r['prog'] }}%</div><div class="prog-bar"><div class="prog-fill" style="width:{{ min($r['prog'],100) }}%;background:{{ $color }};"></div></div></td>
              <td><span class="st {{ $stCls }}"><span class="st-dot"></span>{{ $stLbl }}</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:var(--green-lt);color:var(--green-dk);"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
        <div><div class="ch-title">Alokasi Dana Masyarakat — Target 2026</div><div class="ch-sub">Total alokasi peningkatan dari pendapatan dana masyarakat (target 21,5%)</div></div>
      </div>
    </div>
    <div class="alokasi-grid">
      @foreach($alokasi as $al)
      <div class="alokasi-item"><div class="alokasi-lbl">{{ $al['label'] }}</div><div class="alokasi-baseline">{{ $al['baseline'] }}</div><div class="alokasi-target">↑ Target: {{ $al['target'] }}</div></div>
      @endforeach
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Non-UKT Baseline</span><span class="tgt-val" style="color:var(--amber-dk);">{{ number_format($baseline,1,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Non-UKT Target</span><span class="tgt-val" style="color:var(--green-dk);">{{ number_format($target,1,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Dana Abadi Target</span><span class="tgt-val">4% aset</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Alokasi Total Target</span><span class="tgt-val">21,5%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR2, WR3, WR4</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Formula</span></div>
      <div class="side-body"><div class="formula"><strong>Formula Utama:</strong> <code>Pendapatan Non-UKT ÷ Total Pendapatan PT × 100%</code><br><br>Sumber non-UKT: hibah, riset, kerja sama, usaha PT, sewa aset, jasa layanan, dana abadi, lain-lain.</div></div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#065f46;"><span class="side-head-title">Strategi Peningkatan</span></div>
      <div class="side-body">
        <div style="font-size:12px;color:var(--sub);line-height:1.8;">
          • Optimasi usaha BPU (kantin, parkir, aula)<br>
          • Riset berbasis hibah Kemendikbud/industri<br>
          • Pengembangan dana abadi (endowment fund)<br>
          • Sewa aset bangunan &amp; lahan produktif
        </div>
      </div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
