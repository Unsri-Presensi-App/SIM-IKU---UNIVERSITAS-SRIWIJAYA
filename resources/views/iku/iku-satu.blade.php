@extends('layouts.app')

@section('title', 'IKU 1 – AEE PT')

@section('crumb_parent', 'Talenta')
@section('crumb_title',  'IKU 1 – AEE PT')

@section('content')

{{-- ── Hero ─────────────────────────────────────────── --}}
<section class="hero">
  <div>
    <h2>
      IKU 1 – Angka Efisiensi Edukasi Perguruan Tinggi (AEE PT)
      <span class="badge auto">OTOMATIS</span>
    </h2>
    <p>
      Data diperoleh otomatis dari SIM Akademik. Unit tidak perlu melakukan input,
      menarik data, atau mengubah angka perhitungan.
    </p>
  </div>
  <span class="badge auto">Data otomatis · Tidak perlu input</span>
</section>

{{-- ── Notice ───────────────────────────────────────── --}}
<div class="notice">
  <div>
    <strong>Informasi data otomatis:</strong>
    sinkronisasi berjalan terjadwal. Halaman ini hanya menampilkan data,
    tanggal update, dan riwayat sinkronisasi.
  </div>
  <div class="small">
    Update terakhir: <strong>{{ now()->format('d M Y, H.i') }} WIB</strong>
  </div>
</div>

{{-- ── Summary Cards ───────────────────────────────── --}}
<div class="summary-grid">
  <div class="mini-card">
    <div>
      <div class="label">Target 2026</div>
      <div class="value">{{ number_format($target, 2, ',', '.') }}%</div>
    </div>
    <div class="icon-bubble blue-bubble">🎯</div>
  </div>
  <div class="mini-card">
    <div>
      <div class="label">Realisasi</div>
      <div class="value">{{ number_format($aee_pt, 2, ',', '.') }}%</div>
    </div>
    <div class="icon-bubble green-bubble">✓</div>
  </div>
  <div class="mini-card">
    <div>
      <div class="label">Capaian Target</div>
      <div class="value">
        @if($target > 0)
          {{ number_format(($aee_pt / $target) * 100, 2, ',', '.') }}%
        @else
          –
        @endif
      </div>
    </div>
    <div class="icon-bubble yellow-bubble">↗</div>
  </div>
  <div class="mini-card">
    <div>
      <div class="label">Update / Mode</div>
      <div class="value" style="font-size:18px">{{ now()->format('d M') }}</div>
    </div>
    <div class="icon-bubble blue-bubble">⟳</div>
  </div>
</div>

{{-- ── Main Layout ──────────────────────────────────── --}}
<div class="layout">

  {{-- Left: main card --}}
  <div>
    <div class="card">

      {{-- Tabs --}}
      <div class="tabs">
        <div class="tab active" data-tab="ringkasan">Ringkasan Otomatis</div>
        <div class="tab" data-tab="rincian">Rincian Program</div>
        <div class="tab" data-tab="perhitungan">Perhitungan</div>
        <div class="tab" data-tab="riwayat">Riwayat Sinkronisasi</div>
      </div>

      {{-- Tab: Ringkasan Otomatis --}}
      <div id="tab-ringkasan" class="tab-panel">
        <div class="card-title">
          <h3>Rincian Capaian per Program Pendidikan</h3>
          <button class="btn ghost">⬇ Export Excel</button>
        </div>

        <table>
          <thead>
            <tr>
              <th>Jenjang</th>
              <th>Mahasiswa Masuk</th>
              <th>Lulus Tepat Waktu</th>
              <th>AEE Realisasi</th>
              <th>AEE Ideal</th>
              <th>Tingkat Pencapaian</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $row)
            <tr>
              <td><strong>{{ $row->jenjang }}</strong></td>
              <td>{{ number_format($row->total_mahasiswa, 0, ',', '.') }}</td>
              <td>{{ number_format($row->lulus_tepat_waktu, 0, ',', '.') }}</td>
              <td>{{ number_format($row->aee_realisasi, 2, ',', '.') }}%</td>
              <td>{{ number_format($row->aee_ideal, 2, ',', '.') }}%</td>
              <td>
                @php $pencapaian = $row->tingkat_pencapaian; @endphp

                {{-- progress bar mini --}}
                <div style="display:flex;align-items:center;gap:8px;">
                  <div class="progress {{ $pencapaian >= 90 ? 'green' : ($pencapaian >= 75 ? 'yellow' : 'red') }}"
                       style="width:80px">
                    <span style="width:{{ min($pencapaian, 100) }}%"></span>
                  </div>
                  <strong>{{ number_format($pencapaian, 2, ',', '.') }}%</strong>
                </div>
              </td>
              <td>
                @if($pencapaian >= 90)
                  <span class="badge valid">✓ Baik</span>
                @elseif($pencapaian >= 75)
                  <span class="badge draft">~ Cukup</span>
                @else
                  <span class="badge risk">! Perlu Perhatian</span>
                @endif
              </td>
            </tr>
            @endforeach

            {{-- Baris total AEE PT --}}
            <tr style="background:#f0f7ff;">
              <td colspan="3"><strong>Rata-rata AEE PT</strong></td>
              <td><strong>{{ number_format($data->avg('aee_realisasi'), 2, ',', '.') }}%</strong></td>
              <td>–</td>
              <td colspan="2">
                <strong>{{ number_format($aee_pt, 2, ',', '.') }}%</strong>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      {{-- Tab: Rincian Program --}}
      <div id="tab-rincian" class="tab-panel" style="display:none">
        <div class="card-title"><h3>Rincian Lengkap per Program</h3></div>
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Program Pendidikan</th>
              <th>Jenjang</th>
              <th>Mahasiswa Masuk</th>
              <th>Lulus Tepat Waktu</th>
              <th>AEE Realisasi</th>
              <th>AEE Ideal</th>
              <th>Pencapaian</th>
              <th>Tahun Akademik</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $i => $row)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $row->nama_program }}</td>
              <td>{{ $row->jenjang }}</td>
              <td>{{ number_format($row->total_mahasiswa, 0, ',', '.') }}</td>
              <td>{{ number_format($row->lulus_tepat_waktu, 0, ',', '.') }}</td>
              <td>{{ number_format($row->aee_realisasi, 2, ',', '.') }}%</td>
              <td>{{ number_format($row->aee_ideal, 2, ',', '.') }}%</td>
              <td>{{ number_format($row->tingkat_pencapaian, 2, ',', '.') }}%</td>
              <td>{{ $row->tahun_akademik }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Tab: Perhitungan --}}
      <div id="tab-perhitungan" class="tab-panel" style="display:none">
        <div class="card-title"><h3>Detail Perhitungan AEE PT</h3></div>

        <div style="background:#f8fafc;border-radius:12px;padding:16px;margin-bottom:16px;font-size:13px;line-height:1.8;color:#334155">
          <strong>Formula (Kepmendiktisaintek No. 358/M/KEP/2026):</strong><br>
          1. AEE = <em>(Lulus tepat waktu / Total mahasiswa) × 100%</em><br>
          2. Tingkat Pencapaian = <em>(AEE Realisasi / AEE Ideal) × 100%</em><br>
          3. AEE PT = <em>Rata-rata seluruh Tingkat Pencapaian semua program</em>
        </div>

        <table>
          <thead>
            <tr>
              <th>Program</th>
              <th>Lulus</th>
              <th>Total Mhs</th>
              <th>AEE = Lulus/Total×100</th>
              <th>AEE Ideal</th>
              <th>Pencapaian = Real/Ideal×100</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $row)
            <tr>
              <td>{{ $row->jenjang }}</td>
              <td>{{ $row->lulus_tepat_waktu }}</td>
              <td>{{ $row->total_mahasiswa }}</td>
              <td>
                {{ $row->lulus_tepat_waktu }}/{{ $row->total_mahasiswa }} × 100
                = <strong>{{ number_format($row->aee_realisasi, 2, ',', '.') }}%</strong>
              </td>
              <td>{{ number_format($row->aee_ideal, 2, ',', '.') }}%</td>
              <td>
                {{ number_format($row->aee_realisasi, 2, ',', '.') }}/{{ number_format($row->aee_ideal, 2, ',', '.') }} × 100
                = <strong>{{ number_format($row->tingkat_pencapaian, 2, ',', '.') }}%</strong>
              </td>
            </tr>
            @endforeach
            <tr style="background:#eaf2ff;font-weight:700">
              <td colspan="5">AEE PT = Rata-rata semua Tingkat Pencapaian</td>
              <td>= <strong>{{ number_format($aee_pt, 2, ',', '.') }}%</strong></td>
            </tr>
          </tbody>
        </table>
      </div>

      {{-- Tab: Riwayat Sinkronisasi --}}
      <div id="tab-riwayat" class="tab-panel" style="display:none">
        <div class="card-title"><h3>Riwayat Sinkronisasi Data</h3></div>
        <div class="timeline">
          @foreach([
            ['23 Mei 2026, 02.00 WIB', 'valid',  'Berhasil',      'SIM Akademik'],
            ['22 Mei 2026, 02.00 WIB', 'valid',  'Berhasil',      'SIM Akademik'],
            ['21 Mei 2026, 02.00 WIB', 'valid',  'Berhasil',      'SIM Akademik'],
            ['20 Mei 2026, 02.00 WIB', 'draft',  'Parsial',       'SIM Akademik'],
            ['19 Mei 2026, 02.00 WIB', 'valid',  'Berhasil',      'SIM Akademik'],
          ] as [$tgl, $cls, $label, $src])
          <div class="time-row">
            <div class="dot">✓</div>
            <div>
              <div>{{ $tgl }}</div>
              <div class="small muted">Sumber: {{ $src }}</div>
            </div>
            <span class="badge {{ $cls }}">{{ $label }}</span>
          </div>
          @endforeach
        </div>
      </div>

    </div>{{-- end .card --}}
  </div>{{-- end left column --}}

  {{-- ── Right: sidebar stack ──────────────────────── --}}
  <aside class="side-stack">

    {{-- Bar chart triwulan --}}
    <div class="card">
      <div class="card-title"><h3>Capaian per Triwulan</h3></div>
      @php
        $tw = [
          ['TW 1', $aee_pt * 0.25, 42],
          ['TW 2', $aee_pt * 0.50, 72],
          ['TW 3', $aee_pt * 0.75, 104],
          ['TW 4', $aee_pt,        138],
        ];
      @endphp
      <div class="quarter-chart">
        @foreach($tw as [$label, $val, $h])
        <div class="bar-wrap">
          <div class="bar" style="--h:{{ $h }}px"
               data-value="{{ number_format($val, 2, ',', '.') }}%"></div>
          {{ $label }}
        </div>
        @endforeach
      </div>
    </div>

    {{-- Target perjanjian kinerja --}}
    <div class="card">
      <div class="card-title"><h3>Target Perjanjian Kinerja 2026</h3></div>
      <div class="target-list">
        @php
          $twTargets = [
            'Target Tahunan' => $target,
            'TW1'            => $target * 0.25,
            'TW2'            => $target * 0.50,
            'TW3'            => $target * 0.75,
            'TW4'            => $target,
          ];
        @endphp
        @foreach($twTargets as $label => $val)
        <div class="target-row">
          <span>{{ $label }}</span>
          <strong>{{ number_format($val, 2, ',', '.') }}%</strong>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Informasi formula --}}
    <div class="card">
      <div class="card-title"><h3>Informasi Formula</h3></div>
      <p class="muted small" style="line-height:1.6">
        <strong>AEE PT</strong> = rata-rata tingkat pencapaian AEE setiap program pendidikan.<br><br>
        Tingkat Pencapaian = AEE Realisasi ÷ AEE Ideal × 100%.<br><br>
        Data otomatis dari SIM Akademik. Dasar hukum:
        Kepmendiktisaintek No. 358/M/KEP/2026.
      </p>
    </div>

    {{-- Riwayat sinkronisasi ringkas --}}
    <div class="card">
      <div class="card-title"><h3>Riwayat Sinkronisasi</h3></div>
      <div class="timeline">
        <div class="time-row">
          <div class="dot">✓</div>
          <div>23 Mei 2026, 02.00 WIB</div>
          <span class="badge valid">Berhasil</span>
        </div>
        <div class="time-row">
          <div class="dot">✓</div>
          <div>22 Mei 2026, 02.00 WIB</div>
          <span class="badge valid">Berhasil</span>
        </div>
        <div class="time-row">
          <div class="dot">✓</div>
          <div>21 Mei 2026, 02.00 WIB</div>
          <span class="badge valid">Berhasil</span>
        </div>
      </div>
    </div>

  </aside>
</div>{{-- end .layout --}}

{{-- ── Tab switching script ────────────────────────── --}}
<script>
  document.querySelectorAll('.tab[data-tab]').forEach(tab => {
    tab.addEventListener('click', () => {
      // Remove active from all tabs
      document.querySelectorAll('.tab[data-tab]').forEach(t => t.classList.remove('active'));
      // Hide all panels
      document.querySelectorAll('.tab-panel').forEach(p => p.style.display = 'none');
      // Activate clicked tab
      tab.classList.add('active');
      document.getElementById('tab-' + tab.dataset.tab).style.display = 'block';
    });
  });
</script>

@endsection