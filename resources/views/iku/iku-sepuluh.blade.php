@extends('layouts.app')

@section('title', 'IKU 10 – Zona Integritas WBK/WBBM · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 10 – Zona Integritas WBK/WBBM')

@push('styles')
@include('partials.iku-page-styles')
<style>
  .ic-red{background:var(--red-lt);color:var(--red);}
  .ic-teal{background:#f0fdfa;color:#0d9488;}
  .st-blue{background:var(--indigo-lt);color:var(--indigo-dk);}
  .zi-stages{display:flex;flex-direction:column;gap:0;padding:16px 18px;}
  .zi-stage{display:flex;gap:14px;align-items:flex-start;position:relative;padding-bottom:20px;}
  .zi-stage:last-child{padding-bottom:0;}
  .zi-stage::before{content:'';position:absolute;left:17px;top:36px;bottom:0;width:2px;background:var(--border);}
  .zi-stage:last-child::before{display:none;}
  .zi-dot{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:800;flex-shrink:0;border:2px solid var(--border);}
  .zi-dot.done{background:var(--green-lt);color:var(--green-dk);border-color:var(--green);}
  .zi-dot.active{background:var(--amber-lt);color:var(--amber-dk);border-color:var(--amber);}
  .zi-dot.pending{background:#f8f9fd;color:var(--muted);}
  .zi-title{font-size:13px;font-weight:700;color:var(--text);margin-bottom:3px;}
  .zi-desc{font-size:12px;color:var(--muted);line-height:1.5;}
  .zi-tag{display:inline-flex;padding:2px 8px;border-radius:999px;font-size:10px;font-weight:700;margin-top:4px;}
  .zi-tag.done{background:var(--green-lt);color:var(--green-dk);}
  .zi-tag.active{background:var(--amber-lt);color:var(--amber-dk);}
  .zi-tag.pending{background:#f1f5f9;color:var(--muted);}
  .area-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:16px 18px;}
  .area-item{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);padding:12px;text-align:center;}
  .area-num{width:32px;height:32px;border-radius:50%;background:var(--navy);color:#fff;font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center;margin:0 auto 8px;}
  .area-name{font-size:11px;font-weight:700;color:var(--text);line-height:1.4;}
  .area-sub{font-size:10px;color:var(--muted);margin-top:3px;line-height:1.4;}
  @media(max-width:900px){.area-grid{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:400px){.area-grid{grid-template-columns:1fr;}}
</style>
@endpush

@section('content')
<x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">

  <x-slot:cards>
    <div class="sc">
      <div><div class="sc-lbl">Baseline 2025</div><div class="sc-val">{{ $baseline }}<span class="sc-unit">unit</span></div><div style="font-size:11px;color:var(--red);margin-top:4px;">Belum ada WBK/WBBM</div></div>
      <div class="sc-ic ic-red"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="8" y1="12" x2="16" y2="12"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Target 2026</div><div class="sc-val">{{ $target }}<span class="sc-unit">unit</span></div><div style="font-size:11px;color:var(--green-dk);margin-top:4px;">WBK / WBBM</div></div>
      <div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Realisasi (Valid)</div><div class="sc-val" style="color:var(--amber);">{{ $realisasi }}<span class="sc-unit">unit</span></div><div style="font-size:11px;color:var(--amber-dk);margin-top:4px;">Entri tervalidasi</div></div>
      <div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></div>
    </div>
    <div class="sc">
      <div><div class="sc-lbl">Progres Pencapaian</div><div class="sc-val" style="color:{{ $prog >= 100 ? 'var(--green-dk)' : ($prog >= 50 ? 'var(--amber)' : 'var(--red)') }};">{{ $prog }}<span class="sc-unit">%</span></div><div style="font-size:11px;color:var(--muted);margin-top:4px;">dari target</div></div>
      <div class="sc-ic ic-teal"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
    </div>
  </x-slot:cards>

  <div class="big-metric">
    <div class="big-metric-label">Target Pembangunan ZI 2026</div>
    <div class="big-metric-val">{{ $target }} Unit</div>
    <div class="big-metric-target">Menuju WBK / WBBM</div>
    <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;"><div style="width:{{ min($prog,100) }}%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
    <div style="font-size:12px;opacity:.65;margin-top:8px;">{{ $realisasi }} unit diusulkan dari {{ $target }} unit target · {{ $prog }}%</div>
  </div>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon ic-teal"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
        <div><div class="ch-title">Tahapan Pembangunan Zona Integritas</div><div class="ch-sub">Proses menuju WBK dan WBBM dari KemenPANRB</div></div>
      </div>
    </div>
    <div class="zi-stages">
      <div class="zi-stage"><div class="zi-dot done">1</div><div><div class="zi-title">Pencanangan / Deklarasi ZI</div><div class="zi-desc">Komitmen pimpinan &amp; penandatanganan pakta integritas civitas akademika.</div><span class="zi-tag done">✓ Selesai</span></div></div>
      <div class="zi-stage"><div class="zi-dot active">2</div><div><div class="zi-title">Pembangunan ZI di Unit Kerja Terpilih</div><div class="zi-desc">Implementasi 6 area perubahan, pembentukan Tim Pokja, pemenuhan LKE.</div><span class="zi-tag active">⚡ Sedang Berjalan</span></div></div>
      <div class="zi-stage"><div class="zi-dot pending">3</div><div><div class="zi-title">Penilaian Internal (TPI)</div><div class="zi-desc">Evaluasi tim penilai internal. LKE min. 75 (WBK) / 85 (WBBM).</div><span class="zi-tag pending">Menunggu</span></div></div>
      <div class="zi-stage"><div class="zi-dot pending">4</div><div><div class="zi-title">Usulan ke KemenPANRB</div><div class="zi-desc">Pengajuan unit kerja calon WBK/WBBM beserta LKE dan bukti dukung.</div><span class="zi-tag pending">Menunggu</span></div></div>
      <div class="zi-stage"><div class="zi-dot pending">5</div><div><div class="zi-title">Penilaian Eksternal &amp; Penetapan</div><div class="zi-desc">Penilaian Tim Penilai Nasional. Predikat WBK (≥75) / WBBM (≥85).</div><span class="zi-tag pending">Target: Desember 2026</span></div></div>
    </div>
  </div>

  <div class="card">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:#fce7f3;color:#9d174d;"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
        <div><div class="ch-title">6 Area Perubahan Zona Integritas</div><div class="ch-sub">Komponen wajib (PermenPANRB No. 52/2014)</div></div>
      </div>
    </div>
    <div class="area-grid">
      <div class="area-item"><div class="area-num">I</div><div class="area-name">Manajemen Perubahan</div><div class="area-sub">Tim kerja, budaya integritas, agen perubahan</div></div>
      <div class="area-item"><div class="area-num">II</div><div class="area-name">Penataan Tatalaksana</div><div class="area-sub">SOP, e-Office, keterbukaan informasi</div></div>
      <div class="area-item"><div class="area-num">III</div><div class="area-name">Sistem Manajemen SDM</div><div class="area-sub">Pola mutasi, pengembangan, kinerja individu</div></div>
      <div class="area-item"><div class="area-num">IV</div><div class="area-name">Penguatan Akuntabilitas</div><div class="area-sub">Keterlibatan pimpinan, pengelolaan akuntabilitas</div></div>
      <div class="area-item"><div class="area-num">V</div><div class="area-name">Penguatan Pengawasan</div><div class="area-sub">Gratifikasi, LHKPN, WBS, benturan kepentingan</div></div>
      <div class="area-item"><div class="area-num">VI</div><div class="area-name">Kualitas Pelayanan Publik</div><div class="area-sub">Standar pelayanan, pelayanan prima, kepuasan</div></div>
    </div>
  </div>

  <x-slot:sidebar>
    <div class="side-card">
      <div class="side-head"><span class="side-head-title">Target PK Rektor 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val" style="color:var(--red);">{{ $baseline }} unit</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ $target }} unit</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Realisasi (Valid)</span><span class="tgt-val" style="color:var(--amber);">{{ $realisasi }} unit</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Skor WBK / WBBM Min.</span><span class="tgt-val">75 / 85</span></div>
        <div class="tgt-row"><span class="tgt-lbl">PJ</span><span class="tgt-val">Sek. Univ / WR2</span></div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#065f46;"><span class="side-head-title">Predikat WBK / WBBM</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">WBK</span><span class="tgt-val" style="font-size:12px;">Wilayah Bebas Korupsi</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">WBBM</span><span class="tgt-val" style="font-size:12px;">WBK + Birokrasi Bersih Melayani</span></div>
        <div class="formula"><strong>Dasar Hukum:</strong> PermenPANRB No. 52/2014.<br><strong>Penilai:</strong> TPI → Tim Penilai Nasional KemenPANRB.</div>
      </div>
    </div>
    <div class="side-card">
      <div class="side-head" style="background:#1e40af;"><span class="side-head-title">Timeline 2026</span></div>
      <div class="side-body">
        <div class="tgt-row"><span class="tgt-lbl">Jan–Mar</span><span class="tgt-val" style="font-size:12px;">Penentuan unit kerja</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Apr–Agu</span><span class="tgt-val" style="font-size:12px;">Pembangunan ZI &amp; LKE</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Sep–Okt</span><span class="tgt-val" style="font-size:12px;">Penilaian TPI internal</span></div>
        <div class="tgt-row" style="border:none;"><span class="tgt-lbl">Nov–Des</span><span class="tgt-val" style="font-size:12px;">Usulan &amp; penetapan</span></div>
      </div>
    </div>
  </x-slot:sidebar>

</x-iku-layout>
@endsection
