@extends('layouts.app')

@section('title', 'IKU 6 – Publikasi Internasional · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 6 – Publikasi Bereputasi Internasional')

@push('styles')
@include('partials.iku-page-styles')
<style>
  .q-badge{display:inline-block;padding:2px 8px;border-radius:999px;font-size:10px;font-weight:700;}
  .q-top{background:#fef3c7;color:#92400e;}
  .q-q1{background:var(--indigo-lt);color:var(--indigo-dk);}
  .q-q2{background:var(--green-lt);color:var(--green-dk);}
  .q-q3{background:#f0fdf4;color:#166534;}
  .sub-metric{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;padding:16px 18px;}
  .sm-item{text-align:center;padding:14px;background:#f8f9fd;border-radius:var(--r-md);border:1px solid var(--border);}
  .sm-lbl{font-size:10px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px;}
  .sm-val-b{font-size:18px;font-weight:800;color:var(--text);}
  .sm-val-t{font-size:13px;color:var(--green-dk);font-weight:700;margin-top:2px;}
  @media(max-width:900px){.sub-metric{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:580px){.sub-metric{grid-template-columns:1fr;}}
</style>
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Total Publikasi – Baseline</div><div class="sc-val">{{ number_format($total_baseline,0,',','.') }}<span class="sc-unit">artikel</span></div></div>
      <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Total Publikasi – Target</div><div class="sc-val">{{ number_format($total_target,0,',','.') }}<span class="sc-unit">artikel</span></div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Top Tier – Target</div><div class="sc-val">{{ number_format($sub_indikator['top_tier_target'],1,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Kolab Int'l – Target</div><div class="sc-val">{{ number_format($sub_indikator['kolab_target'],1,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
    </div>
  </x-slot:cards>

  {{-- Sub-indikator --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg></div>
        <div><div class="ch-title">Ringkasan Sub-Indikator IKU 6</div><div class="ch-sub">Baseline 2025 → Target 2026</div></div>
      </div>
    </div>
    <div class="sub-metric">
      @php $p6a=round($total_baseline/$total_target*100,1); @endphp
      <div class="sm-item"><div class="sm-lbl">Total Publikasi</div><div class="sm-val-b">{{ number_format($total_baseline,0,',','.') }}</div><div class="sm-val-t">↑ {{ number_format($total_target,0,',','.') }}</div><div class="prog-bar" style="margin-top:8px;"><div class="prog-fill" style="width:{{ $p6a }}%;background:var(--indigo);"></div></div></div>
      @php $p6b=round($sub_indikator['top_tier_baseline']/$sub_indikator['top_tier_target']*100,1); @endphp
      <div class="sm-item"><div class="sm-lbl">% Top Tier</div><div class="sm-val-b">{{ number_format($sub_indikator['top_tier_baseline'],1,',','.') }}%</div><div class="sm-val-t">↑ {{ number_format($sub_indikator['top_tier_target'],1,',','.') }}%</div><div class="prog-bar" style="margin-top:8px;"><div class="prog-fill" style="width:{{ $p6b }}%;background:var(--gold);"></div></div></div>
      @php $p6c=round($sub_indikator['q1_baseline']/$sub_indikator['q1_target']*100,1); @endphp
      <div class="sm-item"><div class="sm-lbl">% Q1</div><div class="sm-val-b">{{ number_format($sub_indikator['q1_baseline'],1,',','.') }}%</div><div class="sm-val-t">↑ {{ number_format($sub_indikator['q1_target'],1,',','.') }}%</div><div class="prog-bar" style="margin-top:8px;"><div class="prog-fill" style="width:{{ $p6c }}%;background:var(--green);"></div></div></div>
      @php $p6d=round($sub_indikator['kolab_baseline']/$sub_indikator['kolab_target']*100,1); @endphp
      <div class="sm-item"><div class="sm-lbl">Kolab Int'l</div><div class="sm-val-b">{{ number_format($sub_indikator['kolab_baseline'],1,',','.') }}%</div><div class="sm-val-t">↑ {{ number_format($sub_indikator['kolab_target'],1,',','.') }}%</div><div class="prog-bar" style="margin-top:8px;"><div class="prog-fill" style="width:{{ $p6d }}%;background:var(--purple);"></div></div></div>
    </div>
  </div>

  {{-- Tabel per fakultas --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
        <div><div class="ch-title">Publikasi Internasional per Fakultas</div><div class="ch-sub">Baseline 2025 · Target 2026 · Scopus/WoS</div></div>
      </div>
      <a href="#" class="btn btn-sm">Export</a>
    </div>
    <div class="cp">
      <div class="tbl-wrap">
        <table>
          <thead><tr><th>Fakultas</th><th>Total B2025</th><th>Total T2026</th><th>Top Tier B/T</th><th>Q1 B/T</th><th>Kolab Int'l</th><th>Progres</th></tr></thead>
          <tbody>
            @php $sumTB=collect($rows_publikasi)->sum('tb'); $sumTT=collect($rows_publikasi)->sum('tt'); @endphp
            @foreach($rows_publikasi as $r)
            @php $prog=round($r['tb']/$r['tt']*100,1); $color=$prog>=100?'var(--green)':($prog>=80?'var(--amber)':'var(--red)'); @endphp
            <tr>
              <td><strong style="color:var(--text);">{{ $r['f'] }}</strong></td>
              <td>{{ $r['tb'] }}</td>
              <td><strong style="color:var(--navy);">{{ $r['tt'] }}</strong></td>
              <td><span class="q-badge q-top">{{ $r['topb'] }}</span> → <span class="q-badge q-top">{{ $r['topt'] }}</span></td>
              <td><span class="q-badge q-q1">{{ $r['q1b'] }}</span> → <span class="q-badge q-q1">{{ $r['q1t'] }}</span></td>
              <td><span style="color:var(--navy);font-weight:600;">{{ $r['kt'] }}</span></td>
              <td class="prog"><div class="prog-lbl" style="color:{{ $color }};">{{ $prog }}%</div><div class="prog-bar"><div class="prog-fill" style="width:{{ min($prog,100) }}%;background:{{ $color }};"></div></div></td>
            </tr>
            @endforeach
            <tr class="total-row">
              <td>TOTAL</td>
              <td>{{ $sumTB }}</td>
              <td>{{ $sumTT }}</td>
              <td colspan="3" style="color:var(--muted);font-size:12px;">Kolaborasi Internasional Target: 174 artikel</td>
              @php $totalProg=round($sumTB/$sumTT*100,1); @endphp
              <td class="prog"><div class="prog-lbl" style="color:var(--amber-dk);">{{ $totalProg }}%</div><div class="prog-bar"><div class="prog-fill" style="width:{{ $totalProg }}%;background:var(--amber);"></div></div></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- Bobot kuartil --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:#fef3c7;color:#92400e;"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/></svg></div>
        <div><div class="ch-title">Bobot Penilaian per Kuartil</div><div class="ch-sub">Kepmen 358/M/KEP/2026</div></div>
      </div>
    </div>
    <div class="cp">
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;">
        @foreach([['Top Tier','1,20','q-top','Nature, Science, Lancet, dsb.'],['Q1','1,00','q-q1','Kuartil 1 Scopus/WoS'],['Q2','0,75','q-q2','Kuartil 2 Scopus/WoS'],['Q3','0,50','q-q3','Kuartil 3 Scopus/WoS']] as $q)
        <div style="text-align:center;padding:14px;background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);">
          <span class="q-badge {{ $q[2] }}" style="font-size:12px;padding:4px 12px;">{{ $q[0] }}</span>
          <div style="font-size:24px;font-weight:800;color:var(--text);margin:10px 0 4px;">{{ $q[1] }}</div>
          <div style="font-size:10px;color:var(--muted);">{{ $q[3] }}</div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Total Pub. B2025</span><span class="tgt-val" style="color:var(--muted);">{{ number_format($total_baseline,0,',','.') }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Total Pub. T2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ number_format($total_target,0,',','.') }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">% Top Tier T2026</span><span class="tgt-val">{{ number_format($sub_indikator['top_tier_target'],1,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">% Q1 T2026</span><span class="tgt-val">{{ number_format($sub_indikator['q1_target'],1,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR3 / LPPM</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Formula</span></div>
      <div class="side-body"><div class="formula">{{ $iku_meta['formula'] }}</div></div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#065f46;"><span class="side-head-title">Program Peningkatan</span></div>
      <div class="side-body">
        <div style="font-size:12px;color:var(--sub);line-height:1.8;">
          • Coaching clinic jurnal Q1/Top Tier<br>
          • Insentif publikasi Top Tier per dosen<br>
          • Kolaborasi riset PT top 100 THE/QS<br>
          • Peningkatan kualitas jurnal UNSRI → Scopus
        </div>
      </div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
