{{-- ── IKU Input Form Partial ──────────────────────────────────────────
     Vars: $iku_meta (from config/iku.php), passed via @include
     Requires: $iku_meta['kode'], $iku_meta['tipe'], $iku_meta['fields'],
               $iku_meta['form_title'] (optional)
──────────────────────────────────────────────────────────────────── --}}

@php $isAuto = ($iku_meta['tipe'] ?? 'manual') === 'otomatis'; @endphp

@if($isAuto)
{{-- Read-only notice for auto IKUs --}}
<div class="card" style="background:var(--bg);border-color:var(--border);">
  <div class="cp" style="display:flex;align-items:center;gap:12px;padding:20px;">
    <div style="width:38px;height:38px;border-radius:10px;background:var(--indigo-lt);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <svg width="18" height="18" fill="none" stroke="var(--indigo)" stroke-width="1.75" viewBox="0 0 24 24">
        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
      </svg>
    </div>
    <div>
      <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:3px;">Data Otomatis – Tidak Perlu Input</div>
      <div style="font-size:12px;color:var(--muted);line-height:1.5;">
        Data IKU ini diperoleh secara otomatis dari <strong>{{ $iku_meta['sumber'] ?? 'sistem terkait' }}</strong>.
        Operator unit tidak perlu menginput data secara manual.
      </div>
    </div>
  </div>
</div>
@else
{{-- Input form for hybrid/manual IKUs --}}
@php $canInput = auth()->user()?->bisaInput() ?? false; @endphp

<div class="card" id="form-input-iku">
  <div class="ch">
    <div class="ch-left">
      <div class="ch-icon">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
          <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
        </svg>
      </div>
      <div>
        <div class="ch-title">{{ $iku_meta['form_title'] ?? 'Tambah Data Baru' }}</div>
        <div class="ch-sub">{{ $iku_meta['badge'] ?? '' }}</div>
      </div>
    </div>
    @if(!$canInput)
    <span class="status-badge sb-diajukan">
      <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      Akses Terbatas
    </span>
    @endif
  </div>

  @if($canInput)
  <div class="cp">
    <form action="{{ route('input.store', ['kode' => $iku_meta['kode']]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="tahun" value="{{ date('Y') }}">
      <input type="hidden" name="semester" value="1">

      {{-- Judul/Keterangan --}}
      <div class="form-group full" style="margin-bottom:12px;">
        <label class="form-label">Judul / Keterangan Singkat</label>
        <input type="text" name="judul_subjek" class="form-input" placeholder="Judul" value="{{ old('judul_subjek') }}">
      </div>

      {{-- Dynamic fields from config --}}
      @if(!empty($iku_meta['fields']))
      <div class="form-grid">
        @foreach($iku_meta['fields'] as $f)
        <div class="form-group">
          <label class="form-label">{{ $f['label'] }}</label>
          @if($f['type'] === 'select')
            <select name="data[{{ $f['name'] }}]" class="form-input">
              <option value="">— Pilih —</option>
              @foreach($f['options'] ?? [] as $opt)
                <option value="{{ $opt }}" {{ old("data.{$f['name']}") == $opt ? 'selected' : '' }}>{{ $opt }}</option>
              @endforeach
            </select>
          @elseif($f['type'] === 'date')
            <input type="date" name="data[{{ $f['name'] }}]" class="form-input" value="{{ old("data.{$f['name']}") }}">
          @elseif($f['type'] === 'textarea')
            <textarea name="data[{{ $f['name'] }}]" class="form-input" rows="3" placeholder="{{ $f['label'] }}">{{ old("data.{$f['name']}") }}</textarea>
          @else
            <input type="{{ $f['type'] ?? 'text' }}" name="data[{{ $f['name'] }}]" class="form-input" placeholder="{{ $f['label'] }}" value="{{ old("data.{$f['name']}") }}">
          @endif
        </div>
        @endforeach
      </div>
      @endif

      {{-- Triwulan & Catatan row --}}
      <div class="form-grid" style="grid-template-columns:1fr 2fr;margin-top:0;">
        <div class="form-group">
          <label class="form-label">Triwulan</label>
          <select name="triwulan" class="form-input">
            <option value="">— Opsional —</option>
            <option value="1" {{ old('triwulan') == '1' ? 'selected' : '' }}>TW 1 (Jan–Mar)</option>
            <option value="2" {{ old('triwulan') == '2' ? 'selected' : '' }}>TW 2 (Apr–Jun)</option>
            <option value="3" {{ old('triwulan') == '3' ? 'selected' : '' }}>TW 3 (Jul–Sep)</option>
            <option value="4" {{ old('triwulan') == '4' ? 'selected' : '' }}>TW 4 (Okt–Des)</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Catatan (opsional)</label>
          <input type="text" name="catatan" class="form-input" placeholder="Keterangan tambahan..." value="{{ old('catatan') }}">
        </div>
      </div>

      {{-- Upload area --}}
      <div class="upload-area" id="upload-drop-{{ $iku_meta['kode'] }}" onclick="document.getElementById('eviden-file-{{ $iku_meta['kode'] }}').click()">
        <input type="file" name="eviden[]" id="eviden-file-{{ $iku_meta['kode'] }}" multiple hidden
               accept=".pdf,.jpg,.jpeg,.png,.xlsx,.xls"
               onchange="previewFiles(this,'upload-list-{{ $iku_meta['kode'] }}')">
        <div class="upload-icon">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
            <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
          </svg>
        </div>
        <div class="upload-label">
          Seret &amp; lepas file eviden di sini, atau <strong style="color:var(--indigo);">Klik untuk memilih</strong>
        </div>
        <div class="upload-hint">PDF, JPG, PNG, Excel – maks. 10 MB per file</div>
        <div class="upload-files" id="upload-list-{{ $iku_meta['kode'] }}"></div>
      </div>

      {{-- Error validation --}}
      @if($errors->any())
      <div class="alert alert-error" style="margin-bottom:12px;">
        {{ $errors->first() }}
      </div>
      @endif

      {{-- Submit --}}
      <div class="form-actions">
        <button type="submit" name="aksi" value="draft" class="btn">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
          Simpan Draft
        </button>
        <button type="submit" name="aksi" value="ajukan" class="btn btn-primary">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 2 11 13"/><path d="M22 2 15 22 11 13 2 9l20-7z"/></svg>
          Ajukan ke Direktorat
        </button>
      </div>
    </form>
  </div>
  @else
  <div class="cp">
    <div style="text-align:center;padding:24px;color:var(--muted);font-size:13px;">
      <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:8px;color:var(--faint);"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg><br>
      Anda tidak memiliki akses untuk menginput data. Hubungi administrator untuk mendapatkan akses Operator.
    </div>
  </div>
  @endif
</div>
@endif
