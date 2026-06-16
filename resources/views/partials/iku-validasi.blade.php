{{-- ── IKU Validasi Tab Panel ──────────────────────────────────────────── --}}
<div class="tab-pane" id="pane-validasi">
  <div class="card" style="border-radius:0 0 var(--r-lg) var(--r-lg);border-top:none;margin-top:0;">
    <div class="ch">
      <div class="ch-left">
        <div class="ch-icon" style="background:var(--amber-lt);">
          <svg width="14" height="14" fill="none" stroke="var(--amber)" stroke-width="1.75" viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </div>
        <div>
          <div class="ch-title">Antrian Validasi</div>
          <div class="ch-sub">Entri yang menunggu persetujuan Direktorat</div>
        </div>
      </div>
    </div>
    <div class="cp">
      @php $pending = $entri->whereIn('status', ['diajukan']); @endphp

      @if($pending->isEmpty())
      <div style="text-align:center;padding:32px 20px;color:var(--muted);">
        <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:10px;color:var(--faint);"><polyline points="20 6 9 17 4 12"/></svg>
        <div style="font-size:13px;font-weight:600;color:var(--sub);margin-bottom:4px;">Tidak ada antrian validasi</div>
        <div style="font-size:12px;">Semua entri sudah divalidasi atau masih draft.</div>
      </div>
      @else
      <div class="entry-list">
        @foreach($pending as $e)
        <div class="entry-item">
          <div class="entry-head">
            <div>
              <div class="entry-title">{{ $e->judul_subjek }}</div>
              <div class="entry-meta">
                Oleh: {{ $e->pembuat?->name ?? '–' }} ·
                Diajukan: {{ $e->diajukan_at?->format('d M Y, H:i') ?? '–' }} ·
                TW {{ $e->triwulan ?? '–' }}
              </div>
            </div>
            <div class="entry-actions">
              <span class="status-badge sb-diajukan">Menunggu Validasi</span>
              @if(auth()->user()?->bisaValidasi())
              <form method="POST" action="{{ route('validasi.terima', $e->id) }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">Terima</button>
              </form>
              <form method="POST" action="{{ route('validasi.kembalikan', $e->id) }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-sm" style="color:var(--red);border-color:#fca5a5;">Kembalikan</button>
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
        </div>
        @endforeach
      </div>
      @endif

      {{-- All entries with status --}}
      @php $all = $entri->sortByDesc('created_at'); @endphp
      @if($all->isNotEmpty())
      <div style="margin-top:20px;padding-top:16px;border-top:1px solid var(--border);">
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--faint);margin-bottom:10px;">Semua Entri</div>
        <div class="tbl-wrap">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Oleh</th>
                <th>TW</th>
                <th>Status</th>
                <th>Tgl Input</th>
              </tr>
            </thead>
            <tbody>
              @foreach($all as $i => $e)
              <tr>
                <td style="color:var(--faint);">{{ $i + 1 }}</td>
                <td style="font-weight:500;color:var(--text);">{{ $e->judul_subjek }}</td>
                <td>{{ $e->pembuat?->name ?? '–' }}</td>
                <td>{{ $e->triwulan ? 'TW '.$e->triwulan : '–' }}</td>
                <td>
                  @php $st = $e->status; @endphp
                  <span class="status-badge {{ $st === 'valid' ? 'sb-valid' : ($st === 'diajukan' ? 'sb-diajukan' : ($st === 'revisi' ? 'sb-revisi' : 'sb-draft')) }}">
                    {{ $e->labelStatus() }}
                  </span>
                </td>
                <td style="color:var(--faint);font-size:11px;">{{ $e->created_at->format('d M Y') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
