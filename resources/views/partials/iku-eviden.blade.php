{{-- ── IKU Eviden Tab Panel ──────────────────────────────────────────── --}}
<div class="tab-pane" id="pane-eviden">
  <div class="card" style="border-radius:0 0 var(--r-lg) var(--r-lg);border-top:none;margin-top:0;">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:#f0fdf4;">
          <svg width="14" height="14" fill="none" stroke="var(--green)" stroke-width="1.75" viewBox="0 0 24 24">
            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/>
            <polyline points="13 2 13 9 20 9"/>
          </svg>
        </div>
        <div>
          <div class="ch-title">Daftar Eviden</div>
          <div class="ch-sub">File pendukung yang diunggah untuk IKU ini</div>
        </div>
      </div>
    </div>
    <div class="cp">
      @php
        $allEviden = $entri->flatMap(fn($e) => $e->eviden->map(fn($ev) => ['ev' => $ev, 'entri' => $e]));
      @endphp

      @if($allEviden->isEmpty())
      <div style="text-align:center;padding:32px 20px;color:var(--muted);">
        <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:10px;color:var(--faint);"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
        <div style="font-size:13px;font-weight:600;color:var(--sub);margin-bottom:4px;">Belum ada eviden</div>
        <div style="font-size:12px;">Unggah file pendukung saat menambah data di tab Input.</div>
      </div>
      @else
      <div class="entry-list">
        @foreach($allEviden as $item)
        @php $ev = $item['ev']; $ent = $item['entri']; @endphp
        <div class="entry-item" style="display:flex;align-items:center;gap:12px;">
          <div style="width:36px;height:36px;border-radius:8px;background:var(--indigo-lt);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:10px;font-weight:700;color:var(--indigo);text-transform:uppercase;">
            {{ $ev->tipe_file }}
          </div>
          <div style="flex:1;min-width:0;">
            <div style="font-size:13px;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $ev->nama_asli }}</div>
            <div style="font-size:11px;color:var(--faint);margin-top:2px;">
              {{ number_format($ev->ukuran_byte / 1024, 0, ',', '.') }} KB ·
              dari: <strong>{{ $ent->judul_subjek }}</strong> ·
              {{ $ev->created_at->format('d M Y') }}
            </div>
          </div>
          <div style="display:flex;gap:6px;flex-shrink:0;">
            <a href="{{ Storage::url($ev->path_file) }}" target="_blank" class="btn btn-sm">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
              Buka
            </a>
            @if(auth()->user()?->bisaInput())
            <form method="POST" action="{{ route('eviden.destroy', $ev->id) }}" onsubmit="return confirm('Hapus eviden ini?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm" style="color:var(--red);border-color:#fca5a5;">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                Hapus
              </button>
            </form>
            @endif
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>
