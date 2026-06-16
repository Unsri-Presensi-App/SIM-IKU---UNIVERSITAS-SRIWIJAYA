@extends('layouts.app')

@section('title', 'IKU 4 – Rekognisi Internasional Dosen · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 4 – Rekognisi Internasional Dosen')

@push('styles')
@include('partials.iku-page-styles')
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Rekognisi – Baseline</div><div class="sc-val">{{ number_format($baseline_rekognisi,2,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-indigo"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Rekognisi – Target</div><div class="sc-val">{{ number_format($target_rekognisi,2,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Dosen S3 – Baseline</div><div class="sc-val">{{ number_format($baseline_s3,2,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-purple"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Dosen S3 – Target</div><div class="sc-val">{{ number_format($target_s3,2,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/></svg></div>
    </div>
  </x-slot:cards>

  <x-slot:notice>
    <div class="notice notice-amber">
      <div class="notice-icon"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
      <div class="notice-body">
        <div class="notice-title">Data Progres Sementara (Baseline → Target)</div>
        <div class="notice-desc">Angka menampilkan posisi Baseline 2025 terhadap Target 2026. Realisasi aktual berasal dari API SISTER/SIMDOSEN yang sedang dikembangkan; pelengkapan manual lewat tab Input.</div>
      </div>
      <div class="notice-aside" style="color:var(--amber-dk);">Mode sementara</div>
    </div>
  </x-slot:notice>

  {{-- Dual metric panel --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg></div>
        <div><div class="ch-title">Ringkasan Dua Sub-Indikator IKU 4</div><div class="ch-sub">Rekognisi Internasional Dosen · Dosen Berpendidikan S3</div></div>
      </div>
    </div>
    <div class="dual-panel">
      <div class="metric-box">
        <div class="metric-label">Rekognisi Internasional</div>
        <div class="metric-baseline">{{ number_format($baseline_rekognisi,2,',','.') }}%</div>
        <div class="metric-target">↑ Target 2026: {{ number_format($target_rekognisi,2,',','.') }}%</div>
        <div class="metric-desc">Target ± 784 dosen dari total dosen aktif</div>
        <div class="prog-bar" style="margin-top:12px;height:8px;"><div class="prog-fill" style="width:{{ $prog_rekognisi }}%;background:var(--indigo);"></div></div>
        <div style="font-size:11px;color:var(--indigo-dk);font-weight:700;margin-top:4px;">Progres: {{ $prog_rekognisi }}%</div>
      </div>
      <div class="metric-box accent-purple">
        <div class="metric-label">Dosen Berpendidikan S3</div>
        <div class="metric-baseline">{{ number_format($baseline_s3,2,',','.') }}%</div>
        <div class="metric-target">↑ Target 2026: {{ number_format($target_s3,2,',','.') }}%</div>
        <div class="metric-desc">Target ± 689 dosen dari total dosen aktif</div>
        <div class="prog-bar" style="margin-top:12px;height:8px;"><div class="prog-fill" style="width:{{ $prog_s3 }}%;background:var(--purple);"></div></div>
        <div style="font-size:11px;color:var(--purple);font-weight:700;margin-top:4px;">Progres: {{ $prog_s3 }}%</div>
      </div>
    </div>
  </div>

  {{-- Tabel detail --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
        <div><div class="ch-title">Detail Target IKU 4</div><div class="ch-sub">Rekognisi &amp; S3 · Kontrak Kinerja Rektor 2026</div></div>
      </div>
      <a href="#" class="btn btn-sm">Export</a>
    </div>
    <div class="cp">
      <div class="tbl-wrap">
        <table>
          <thead><tr><th>Sub-Indikator</th><th>Baseline 2025</th><th>Target 2026</th><th>Kenaikan</th><th>Progres</th><th>Realisasi*</th><th>Status</th></tr></thead>
          <tbody>
            <tr>
              <td><strong style="color:var(--text);">Rekognisi Internasional</strong><div style="font-size:11px;color:var(--muted);">% dosen dari total dosen PT</div></td>
              <td>{{ number_format($baseline_rekognisi,2,',','.') }}%</td>
              <td><strong style="color:var(--navy);">{{ number_format($target_rekognisi,2,',','.') }}%</strong></td>
              <td style="color:var(--amber-dk);">+{{ number_format($delta_rekognisi,2,',','.') }} pp</td>
              <td class="prog"><div class="prog-lbl" style="color:var(--indigo);">{{ $prog_rekognisi }}%</div><div class="prog-bar"><div class="prog-fill" style="width:{{ $prog_rekognisi }}%;background:var(--indigo);"></div></div></td>
              <td style="color:var(--muted);">–</td>
              <td><span class="st st-amber"><span class="st-dot"></span>Mendekati</span></td>
            </tr>
            <tr>
              <td><strong style="color:var(--text);">Dosen Berpendidikan S3</strong><div style="font-size:11px;color:var(--muted);">% dosen dari total dosen PT</div></td>
              <td>{{ number_format($baseline_s3,2,',','.') }}%</td>
              <td><strong style="color:var(--navy);">{{ number_format($target_s3,2,',','.') }}%</strong></td>
              <td style="color:var(--amber-dk);">+{{ number_format($delta_s3,2,',','.') }} pp</td>
              <td class="prog"><div class="prog-lbl" style="color:var(--purple);">{{ $prog_s3 }}%</div><div class="prog-bar"><div class="prog-fill" style="width:{{ $prog_s3 }}%;background:var(--purple);"></div></div></td>
              <td style="color:var(--muted);">–</td>
              <td><span class="st st-red"><span class="st-dot"></span>Kritis</span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div style="font-size:11px;color:var(--muted);margin-top:10px;">*Realisasi aktual dari SISTER/SIMDOSEN — diperbarui saat API aktif.</div>
    </div>
  </div>

  {{-- Kriteria --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:var(--green-lt);color:var(--green-dk);"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
        <div><div class="ch-title">Kriteria Rekognisi Internasional</div><div class="ch-sub">Kepmen 358/M/KEP/2026 – IKU 4</div></div>
      </div>
    </div>
    <div class="cp">
      <div class="info-grid">
        <div class="info-item"><strong>Jurnal Internasional Bereputasi</strong>Karya ilmiah terindeks Scopus/WoS sebagai penulis</div>
        <div class="info-item"><strong>Keynote / Invited Speaker</strong>Pembicara undangan di konferensi internasional bereputasi</div>
        <div class="info-item"><strong>Paten / HKI Internasional</strong>Paten terdaftar di lembaga paten internasional</div>
        <div class="info-item"><strong>Visiting Researcher</strong>Peneliti tamu di PT/lembaga luar negeri bereputasi</div>
        <div class="info-item"><strong>Editor / Reviewer Jurnal Int'l</strong>Editor atau reviewer jurnal internasional bereputasi</div>
        <div class="info-item"><strong>Penghargaan Internasional</strong>Award dari lembaga/asosiasi akademik internasional</div>
      </div>
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Rekognisi – Baseline</span><span class="tgt-val" style="color:var(--muted);">{{ number_format($baseline_rekognisi,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Rekognisi – Target</span><span class="tgt-val" style="color:var(--green-dk);">{{ number_format($target_rekognisi,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">S3 – Baseline</span><span class="tgt-val" style="color:var(--muted);">{{ number_format($baseline_s3,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">S3 – Target</span><span class="tgt-val" style="color:var(--green-dk);">{{ number_format($target_s3,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR2 / Dir SDM</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Formula</span></div>
      <div class="side-body"><div class="formula"><strong>Rekognisi:</strong> <code>Σ Dosen rekognisi int'l ÷ Total Dosen PT × 100%</code><br><br><strong>S3:</strong> <code>Σ Dosen S3 aktif ÷ Total Dosen PT × 100%</code></div></div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#065f46;"><span class="side-head-title">Rencana Program</span></div>
      <div class="side-body">
        <div style="font-size:12px;color:var(--sub);line-height:1.8;">
          • Coaching clinic penulisan jurnal Q1/Top Tier<br>
          • Beasiswa studi S3 dalam &amp; luar negeri<br>
          • Insentif dosen rekognisi internasional<br>
          • Kolaborasi riset PT top 100 THE/QS
        </div>
      </div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
