@extends('layouts.app')

@section('title', 'IKU 5 – Luaran Kerja Sama · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 5 – Luaran Kerja Sama / Hilirisasi')

@push('styles')
@include('partials.iku-page-styles')
<style>
  .ic-teal{background:#f0fdfa;color:#0d9488;}
  .luaran-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:16px 18px;}
  .luaran-item{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);padding:14px;text-align:center;}
  .luaran-icon{width:36px;height:36px;border-radius:var(--r-sm);background:var(--indigo-lt);color:var(--indigo);display:flex;align-items:center;justify-content:center;margin:0 auto 8px;}
  .luaran-type{font-size:12px;font-weight:700;color:var(--text);margin-bottom:3px;}
  .luaran-desc{font-size:10px;color:var(--muted);line-height:1.5;}
  @media(max-width:900px){.luaran-grid{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:580px){.luaran-grid{grid-template-columns:1fr;}}
</style>
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Baseline 2025</div><div class="sc-val">{{ number_format($baseline,2,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-red"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target 2026</div><div class="sc-val">{{ number_format($target,2,',','.') }}<span class="sc-unit">%</span></div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Gap ke Target</div><div class="sc-val" style="color:var(--red);">+{{ number_format($target-$baseline,2,',','.') }}<span class="sc-unit">pp</span></div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target Luaran</div><div class="sc-val" style="color:var(--navy);">{{ $target_luaran }}</div></div>
      <div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div>
    </div>
  </x-slot:cards>

  <x-slot:notice>
    <div class="notice notice-amber" style="background:var(--red-lt);border-color:#fecaca;">
      <div class="notice-icon" style="color:var(--red);"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
      <div class="notice-body">
        <div class="notice-title" style="color:var(--red-dk);">Status Kritis — Gap Target Sangat Besar</div>
        <div class="notice-desc" style="color:var(--red-dk);">Baseline 2025 hanya <strong>{{ number_format($baseline,2,',','.') }}%</strong> vs Target 2026 <strong>{{ number_format($target,2,',','.') }}%</strong> (perlu <strong>+{{ number_format($target-$baseline,2,',','.') }} pp</strong>). Perlu intervensi segera.</div>
      </div>
      <div class="notice-aside" style="color:var(--red-dk);">STATUS KRITIS</div>
    </div>
  </x-slot:notice>

  {{-- Big metric --}}
  <div class="big-metric">
    <div class="big-metric-label">Progres Baseline → Target 2026</div>
    <div class="big-metric-val">{{ $prog }}%</div>
    <div class="big-metric-target">Target: {{ number_format($target,2,',','.') }}% ({{ $target_luaran }} luaran kerja sama)</div>
    <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;"><div style="width:{{ min($prog,100) }}%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
    <div style="font-size:12px;opacity:.65;margin-top:8px;">Posisi saat ini: {{ number_format($baseline,2,',','.') }}% dari total kerja sama aktif PT</div>
  </div>

  {{-- Rekap --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
        <div><div class="ch-title">Rekap Target &amp; Realisasi IKU 5</div><div class="ch-sub">Kerja sama aktif · Luaran dihasilkan · Target 2026</div></div>
      </div>
      <a href="#" class="btn btn-sm">Export</a>
    </div>
    <div class="cp">
      <div class="tbl-wrap">
        <table>
          <thead><tr><th>Metrik</th><th>Baseline 2025</th><th>Target 2026</th><th>Kenaikan</th><th>Progres</th><th>Realisasi*</th><th>Status</th></tr></thead>
          <tbody>
            <tr>
              <td><strong style="color:var(--text);">% Luaran Kerja Sama</strong><div style="font-size:11px;color:var(--muted);">terhadap total kerja sama PT</div></td>
              <td>{{ number_format($baseline,2,',','.') }}%</td>
              <td><strong style="color:var(--navy);">{{ number_format($target,2,',','.') }}%</strong></td>
              <td style="color:var(--red-dk);">+{{ number_format($target-$baseline,2,',','.') }} pp</td>
              <td class="prog"><div class="prog-lbl" style="color:var(--red);">{{ $prog }}%</div><div class="prog-bar"><div class="prog-fill" style="width:{{ min($prog,100) }}%;background:var(--red);"></div></div></td>
              <td style="color:var(--muted);">–</td>
              <td><span class="st st-red"><span class="st-dot"></span>Kritis</span></td>
            </tr>
            <tr>
              <td><strong style="color:var(--text);">Jumlah Luaran (estimasi)</strong><div style="font-size:11px;color:var(--muted);">judul/karya, bukan jumlah dosen</div></td>
              <td>~{{ round($baseline * 17) }} luaran</td>
              <td><strong style="color:var(--navy);">{{ $target_luaran }} luaran</strong></td>
              <td style="color:var(--red-dk);">+{{ $target_luaran - round($baseline * 17) }} luaran</td>
              <td class="prog"><div class="prog-lbl" style="color:var(--red);">{{ min(round($baseline * 17 / $target_luaran * 100, 1), 100) }}%</div><div class="prog-bar"><div class="prog-fill" style="width:{{ min(round($baseline * 17 / $target_luaran * 100, 1), 100) }}%;background:var(--red);"></div></div></td>
              <td style="color:var(--muted);">–</td>
              <td><span class="st st-red"><span class="st-dot"></span>Kritis</span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div style="font-size:11px;color:var(--muted);margin-top:10px;">*Realisasi aktual dari sistem SRIKANDI/DKIA — diperbarui saat API aktif.</div>
    </div>
  </div>

  {{-- Jenis luaran --}}
  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon ic-teal"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/></svg></div>
        <div><div class="ch-title">Jenis Luaran yang Diperhitungkan</div><div class="ch-sub">Kepmen 358/M/KEP/2026 – Kriteria IKU 5</div></div>
      </div>
    </div>
    <div class="luaran-grid">
      <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div><div class="luaran-type">Jurnal / Buku Kolaborasi</div><div class="luaran-desc">Karya ilmiah dengan mitra sebagai co-author/penyandang dana</div></div>
      <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div class="luaran-type">Paten / HKI Kolaborasi</div><div class="luaran-desc">Paten atau HKI yang dihasilkan bersama industri/lembaga mitra</div></div>
      <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/></svg></div><div class="luaran-type">Teknologi / Prototype</div><div class="luaran-desc">Produk inovasi / prototype yang dikembangkan bersama mitra</div></div>
      <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/></svg></div><div class="luaran-type">Layanan / Jasa Konsultasi</div><div class="luaran-desc">Layanan profesional / konsultasi teknis yang dikontrakkan</div></div>
      <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/></svg></div><div class="luaran-type">Pelatihan / Capacity Building</div><div class="luaran-desc">Program pelatihan SDM mitra yang dilaksanakan PT</div></div>
      <div class="luaran-item"><div class="luaran-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div><div class="luaran-type">Riset Bersama Industri</div><div class="luaran-desc">Penelitian terapan yang dibiayai &amp; dilaksanakan bersama mitra</div></div>
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val" style="color:var(--red);">{{ number_format($baseline,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ number_format($target,2,',','.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Est. Luaran</span><span class="tgt-val" style="color:var(--navy);">{{ $target_luaran }} judul/karya</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR3 / DIH</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Formula</span></div>
      <div class="side-body"><div class="formula">{{ $iku_meta['formula'] }}<br><br><span style="font-size:11px;color:var(--muted);">Dihitung per judul/karya yang sudah dimanfaatkan mitra &amp; dibuktikan dokumen resmi.</span></div></div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#7c2d12;"><span class="side-head-title">Intervensi Prioritas</span></div>
      <div class="side-body">
        <div style="font-size:12px;color:var(--sub);line-height:1.8;">
          • Inventarisasi MoU yang belum menghasilkan luaran<br>
          • Matching fund riset dengan BUMN/Swasta<br>
          • SOP klaim luaran kerja sama yang mudah<br>
          • Laporan rutin bulanan ke WR3 &amp; Rektorat
        </div>
      </div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
