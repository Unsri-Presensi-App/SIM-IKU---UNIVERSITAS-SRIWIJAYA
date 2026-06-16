@extends('layouts.app')

@section('title', 'IKU 11b – Predikat SAKIP · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 11b – Predikat SAKIP')

@push('styles')
@include('partials.iku-page-styles')
<style>
  .ic-gold{background:#fef3c7;color:#92400e;}
  .sakip-levels{display:flex;gap:0;padding:18px;border:1px solid var(--border);border-radius:var(--r-md);}
  .sakip-level{flex:1;text-align:center;padding:12px 6px;border-right:1px solid var(--border);position:relative;}
  .sakip-level:last-child{border-right:none;}
  .sakip-badge{display:flex;width:38px;height:38px;border-radius:50%;align-items:center;justify-content:center;font-size:14px;font-weight:900;margin:0 auto 6px;color:#fff;}
  .sakip-name{font-size:12px;font-weight:700;display:block;}
  .sakip-score{font-size:10px;color:var(--muted);margin-top:2px;}
  .sakip-pointer{position:absolute;top:-9px;left:50%;transform:translateX(-50%);font-size:9px;font-weight:700;white-space:nowrap;padding:1px 6px;border-radius:999px;color:#fff;}
  @media(max-width:900px){.sakip-levels{flex-wrap:wrap;}.sakip-level{flex:0 0 33.33%;border-bottom:1px solid var(--border);}}
  @media(max-width:580px){.sakip-level{flex:0 0 50%;}}
</style>
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">SAKIP Baseline</div><div class="sc-val" style="color:var(--indigo);">{{ $sakip_baseline }}</div><div style="font-size:11px;color:var(--muted);margin-top:4px;">Nilai 75–90</div></div>
      <div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">SAKIP Target</div><div class="sc-val" style="color:var(--gold);">{{ $sakip_target }}</div><div style="font-size:11px;color:var(--amber-dk);margin-top:4px;">Nilai ≥90</div></div>
      <div class="sc-ic ic-gold"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Evaluator</div><div class="sc-val" style="font-size:18px;">Kemendikti</div></div>
      <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Entri Valid</div><div class="sc-val">{{ $jumlahValid }}</div></div>
      <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
    </div>
  </x-slot:cards>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:#fef3c7;color:#92400e;"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
        <div><div class="ch-title">Skala Predikat SAKIP</div><div class="ch-sub">Sistem Akuntabilitas Kinerja Instansi Pemerintah — posisi UNSRI: {{ $sakip_baseline }} → {{ $sakip_target }}</div></div>
      </div>
    </div>
    <div class="cp">
      <div class="sakip-levels">
        @foreach($sakip_levels as $lv)
        @php $isActive = !empty($lv['aktif']); $isTarget = !empty($lv['target']); @endphp
        <div class="sakip-level">
          @if($isActive)<span class="sakip-pointer" style="background:var(--indigo);">SAAT INI</span>@endif
          @if($isTarget)<span class="sakip-pointer" style="background:var(--green-dk);">TARGET</span>@endif
          <div class="sakip-badge" style="background:{{ $lv['warna'] }};{{ ($isActive||$isTarget) ? '' : 'opacity:.55;' }}">{{ $lv['predikat'] }}</div>
          <span class="sakip-name" style="color:{{ ($isActive||$isTarget) ? 'var(--text)' : 'var(--faint)' }};">{{ $lv['predikat'] }}</span>
          <div class="sakip-score">{{ $lv['range'] }}</div>
        </div>
        @endforeach
      </div>
      <div style="font-size:12px;color:var(--muted);margin-top:12px;">Peningkatan predikat dari <strong>{{ $sakip_baseline }}</strong> (75–90) menuju <strong>{{ $sakip_target }}</strong> (90–100) berdasarkan evaluasi Kementerian. Unggah hasil evaluasi resmi lewat tab Input.</div>
    </div>
  </div>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></div>
        <div><div class="ch-title">Rencana Aksi Peningkatan SAKIP {{ $sakip_baseline }} → {{ $sakip_target }}</div><div class="ch-sub">Intervensi strategis menaikkan nilai SAKIP</div></div>
      </div>
    </div>
    <div class="cp">
      <div class="info-grid">
        @foreach(['Penajaman IKU berbasis outcome','Cascading target IKU ke seluruh unit kerja','Penguatan monitoring &amp; evaluasi capaian real-time','Penyempurnaan Renstra dan Perjanjian Kinerja','Peningkatan kualitas laporan kinerja (LKj) berbasis data','Pelatihan penyusunan anggaran berbasis kinerja'] as $r)
        <div class="info-item" style="display:flex;gap:8px;align-items:flex-start;"><span style="color:var(--green-dk);flex-shrink:0;">✓</span><span>{!! $r !!}</span></div>
        @endforeach
      </div>
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">SAKIP Baseline</span><span class="tgt-val" style="color:var(--indigo);">{{ $sakip_baseline }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">SAKIP Target</span><span class="tgt-val" style="color:var(--gold);">{{ $sakip_target }}</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ</span><span class="tgt-val">Rektor / Dir. Perenc.</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Sumber Data &amp; Formula</span></div>
      <div class="side-body"><div class="formula">{{ $iku_meta['formula'] }}<br><br><strong>Sumber:</strong> Laporan Evaluasi SAKIP dari Kementerian / Inspektorat Jenderal.</div></div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
