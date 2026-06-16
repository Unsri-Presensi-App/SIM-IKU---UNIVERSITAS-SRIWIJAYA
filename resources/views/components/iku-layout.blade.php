{{-- ════════════════════════════════════════════════════════════════════
     <x-iku-layout> — kerangka halaman IKU ala mockup, dipakai IKU 2–12.
     ----------------------------------------------------------------------
     Menyusun: hero + badge tipe, 4 summary cards, tab (Input/Eviden/
     Validasi/Riwayat), form input (hybrid/manual) atau notice (otomatis),
     dan sidebar kanan. Konten khas tiap IKU diisi via slot.

     Penggunaan:
       <x-iku-layout :meta="$iku_meta" :entri="$entri" :jumlah-valid="$jumlahValid">
         <x-slot:cards> ...4 kartu .sc... </x-slot:cards>
         ...konten utama (tabel/panel)...
         <x-slot:sidebar> ...kartu .side-card... </x-slot:sidebar>
       </x-iku-layout>
═══════════════════════════════════════════════════════════════════════ --}}
@props([
    'meta',
    'entri'       => null,
    'jumlahValid' => 0,
    'eyebrow'     => null,
    'cards'       => null,
    'sidebar'     => null,
    'notice'      => null,
    'titleBadges' => null,
    'actions'     => null,
])
@php
    $entri = $entri ?? collect();
    $tipe  = $meta['tipe'] ?? 'manual';
    $isAuto = $tipe === 'otomatis';
    $kode  = $meta['kode'] ?? '';

    $dim       = $meta['dimensi'] ?? '';
    $dimLabel  = ['talenta'=>'Talenta','inovasi'=>'Inovasi','kontribusi'=>'Kontribusi Masyarakat','tata_kelola'=>'Tata Kelola'][$dim] ?? '';
    $dimBadge  = ['talenta'=>'badge-talenta','inovasi'=>'badge-inovasi','kontribusi'=>'badge-kontribusi','tata_kelola'=>'badge-tata'][$dim] ?? 'badge-soft';
    $tipeLabel = ['otomatis'=>'Otomatis','hybrid'=>'Hybrid','manual'=>'Manual'][$tipe] ?? 'Manual';
    $tipeBadge = ['otomatis'=>'badge-auto','hybrid'=>'badge-hybrid','manual'=>'badge-manual'][$tipe] ?? 'badge-manual';

    $totalEviden    = $entri->sum(fn($e) => $e->eviden->count());
    $jumlahDiajukan = $entri->where('status','diajukan')->count();
    $jumlahDraft    = $entri->where('status','draft')->count();
    $eyebrow        = $eyebrow ?? ('Input Data IKU' . ($dimLabel ? ' · Dimensi '.$dimLabel : ''));
@endphp

{{-- ── Flash ── --}}
@if(session('sukses'))
<div class="alert alert-success">
  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
  {{ session('sukses') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-error">
  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
  {{ session('error') }}
</div>
@endif

{{-- ── Hero ── --}}
<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">{{ $eyebrow }}</div>
    <h1 class="ph-title">
      {{ $meta['judul'] ?? ('IKU '.$kode) }}
      <span class="badge {{ $tipeBadge }}">{{ strtoupper($tipeLabel) }}</span>
      @if($dimLabel)<span class="badge {{ $dimBadge }}">{{ $dimLabel }}</span>@endif
      {{ $titleBadges }}
    </h1>
    <p class="ph-sub">{{ $meta['desc'] ?? '' }}</p>
  </div>
  <div class="ph-right">
    {{ $actions }}
    @if(!empty($meta['badge']))
    <span class="badge {{ $tipeBadge }}">{{ $meta['badge'] }}</span>
    @endif
  </div>
</section>

{{-- ── Notice (otomatis) ── --}}
@if($isAuto)
<div class="notice notice-info">
  <div class="notice-icon">
    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
  </div>
  <div class="notice-body">
    <div class="notice-title">Data otomatis — tidak perlu input</div>
    <div class="notice-desc">Data IKU ini diperoleh terjadwal dari <strong>{{ $meta['sumber'] ?? 'sistem terkait' }}</strong>. Halaman hanya menampilkan data, tanggal pembaruan, dan riwayat sinkronisasi.</div>
  </div>
  <div class="notice-aside" style="color:var(--indigo-dk);">Update otomatis</div>
</div>
@endif

{{-- ── Notice khusus IKU (opsional) ── --}}
{{ $notice }}

{{-- ── Summary cards ── --}}
@if($cards)
<div class="sum-grid">{{ $cards }}</div>
@endif

{{-- ── Tab bar ── --}}
<div class="tab-bar">
  <button class="tab-btn active" onclick="switchIkuTab(this,'input')">
    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
    {{ $isAuto ? 'Data Otomatis' : 'Data & Input' }}
  </button>
  <button class="tab-btn" onclick="switchIkuTab(this,'eviden')">
    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
    Eviden @if($totalEviden)<span class="tab-count">{{ $totalEviden }}</span>@endif
  </button>
  <button class="tab-btn" onclick="switchIkuTab(this,'validasi')">
    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
    Validasi @if($jumlahDiajukan)<span class="tab-count warn">{{ $jumlahDiajukan }}</span>@endif
  </button>
  <button class="tab-btn" onclick="switchIkuTab(this,'riwayat')">
    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.37"/></svg>
    Riwayat @if($entri->count())<span class="tab-count">{{ $entri->count() }}</span>@endif
  </button>
</div>

{{-- ── Tab: Data & Input ── --}}
<div class="tab-pane active" id="pane-input">
  <div class="lay">
    <div>
      {{ $slot }}
      @include('partials.iku-form', ['iku_meta' => $meta])
    </div>

    <aside class="side">
      {{ $sidebar }}

      @if(!$isAuto || $entri->isNotEmpty())
      <div class="side-card">
        <div class="side-head"><span class="side-head-title">Ringkasan Entri</span></div>
        <div class="side-body">
          <div class="tgt-row"><span class="tgt-lbl">Total Entri</span><span class="tgt-val">{{ $entri->count() }}</span></div>
          <div class="tgt-row"><span class="tgt-lbl">Valid Direktorat</span><span class="tgt-val" style="color:var(--green-dk);">{{ $jumlahValid }}</span></div>
          <div class="tgt-row"><span class="tgt-lbl">Menunggu Validasi</span><span class="tgt-val" style="color:var(--amber-dk);">{{ $jumlahDiajukan }}</span></div>
          <div class="tgt-row"><span class="tgt-lbl">Draft</span><span class="tgt-val">{{ $jumlahDraft }}</span></div>
        </div>
      </div>
      @endif
    </aside>
  </div>
</div>

{{-- ── Tab: Eviden / Validasi / Riwayat ── --}}
@include('partials.iku-eviden',   ['entri' => $entri, 'jumlahValid' => $jumlahValid])
@include('partials.iku-validasi', ['entri' => $entri, 'jumlahValid' => $jumlahValid])
@include('partials.iku-riwayat',  ['entri' => $entri, 'jumlahValid' => $jumlahValid])

@once
@push('scripts')
<script>
function switchIkuTab(btn, tab){
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  var pane = document.getElementById('pane-' + tab);
  if (pane) pane.classList.add('active');
}
function previewFiles(input, listId){
  var list = document.getElementById(listId);
  if (!list) return;
  list.innerHTML = '';
  Array.from(input.files).forEach(function(f){
    var item = document.createElement('div');
    item.className = 'upload-file-item';
    item.innerHTML = '<svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/></svg> ' +
      f.name + ' <span style="color:var(--faint);margin-left:auto;">(' + (f.size/1024).toFixed(0) + ' KB)</span>';
    list.appendChild(item);
  });
}
document.querySelectorAll('.upload-area').forEach(function(area){
  area.addEventListener('dragover', function(e){ e.preventDefault(); area.classList.add('drag-over'); });
  area.addEventListener('dragleave', function(){ area.classList.remove('drag-over'); });
  area.addEventListener('drop', function(e){
    e.preventDefault(); area.classList.remove('drag-over');
    var inp = area.querySelector('input[type=file]');
    if (inp){ inp.files = e.dataTransfer.files; inp.dispatchEvent(new Event('change')); }
  });
});
</script>
@endpush
@endonce
