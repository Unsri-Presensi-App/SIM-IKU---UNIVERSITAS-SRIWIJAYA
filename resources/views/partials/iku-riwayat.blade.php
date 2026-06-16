{{-- ── IKU Riwayat Tab Panel ──────────────────────────────────────────── --}}
<div class="tab-pane" id="pane-riwayat">
  <div class="card" style="border-radius:0 0 var(--r-lg) var(--r-lg);border-top:none;margin-top:0;">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:var(--purple-lt);">
          <svg width="14" height="14" fill="none" stroke="var(--purple)" stroke-width="1.75" viewBox="0 0 24 24">
            <polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.37"/>
          </svg>
        </div>
        <div>
          <div class="ch-title">Riwayat Entri</div>
          <div class="ch-sub">Semua data yang pernah diinput untuk IKU ini</div>
        </div>
      </div>
      <span style="font-size:12px;color:var(--muted);font-weight:600;">{{ $entri->count() }} entri · {{ $jumlahValid }} valid</span>
    </div>
    <div class="cp">
      @if($entri->isEmpty())
      <div style="text-align:center;padding:32px 20px;color:var(--muted);">
        <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:10px;color:var(--faint);"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.37"/></svg>
        <div style="font-size:13px;font-weight:600;color:var(--sub);margin-bottom:4px;">Belum ada riwayat</div>
        <div style="font-size:12px;">Data yang diinput akan muncul di sini.</div>
      </div>
      @else
      <div class="entry-list">
        @foreach($entri->sortByDesc('created_at') as $e)
        @php $st = $e->status; @endphp
        <div class="entry-item">
          <div class="entry-head">
            <div style="flex:1;min-width:0;">
              <div class="entry-title">{{ $e->judul_subjek }}</div>
              <div class="entry-meta">
                {{ $e->pembuat?->name ?? '–' }} ·
                {{ $e->created_at->format('d M Y, H:i') }} ·
                {{ $e->triwulan ? 'TW '.$e->triwulan : 'TW –' }} ·
                {{ $e->tahun }}
              </div>
            </div>
            <div class="entry-actions">
              <span class="status-badge {{ $st === 'valid' ? 'sb-valid' : ($st === 'diajukan' ? 'sb-diajukan' : ($st === 'revisi' ? 'sb-revisi' : 'sb-draft')) }}">
                {{ $e->labelStatus() }}
              </span>
              @if(in_array($st, ['draft','revisi']) && auth()->user()?->bisaInput())
              <form method="POST" action="{{ route('input.destroy', $e->id) }}" onsubmit="return confirm('Hapus entri ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm" style="color:var(--red);border-color:#fca5a5;padding:4px 10px;">Hapus</button>
              </form>
              @endif
            </div>
          </div>

          @if($e->data_json)
          <div style="display:flex;gap:6px;flex-wrap:wrap;margin-top:6px;">
            @foreach($e->data_json as $k => $v)
            @if($v)
            <div style="background:var(--bg);border:1px solid var(--border);border-radius:6px;padding:3px 9px;font-size:11px;color:var(--sub);">
              <strong>{{ $k }}</strong>: {{ $v }}
            </div>
            @endif
            @endforeach
          </div>
          @endif

          @if($e->catatan)
          <div style="margin-top:6px;font-size:11px;color:var(--muted);font-style:italic;">{{ $e->catatan }}</div>
          @endif

          @if($e->eviden->isNotEmpty())
          <div class="entry-eviden" style="margin-top:8px;">
            @foreach($e->eviden as $ev)
            <a href="{{ Storage::url($ev->path_file) }}" target="_blank" class="ev-chip">
              <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/></svg>
              {{ $ev->nama_asli }}
            </a>
            @endforeach
          </div>
          @endif

          {{-- Riwayat aksi validasi --}}
          @if($e->riwayat->isNotEmpty())
          <div style="margin-top:8px;padding-top:8px;border-top:1px solid #f2f4f7;display:flex;flex-direction:column;gap:4px;">
            @foreach($e->riwayat->take(3) as $r)
            <div style="display:flex;align-items:center;gap:6px;font-size:11px;color:var(--faint);">
              <div style="width:5px;height:5px;border-radius:50%;background:var(--border);flex-shrink:0;"></div>
              <strong style="color:var(--sub);">{{ ucfirst($r->aksi) }}</strong>
              @if($r->catatan) – {{ $r->catatan }}@endif
              <span>{{ $r->created_at->format('d M Y') }}</span>
            </div>
            @endforeach
          </div>
          @endif
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>
