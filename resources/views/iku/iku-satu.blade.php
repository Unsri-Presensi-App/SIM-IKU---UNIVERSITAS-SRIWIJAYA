<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIM IKU UNSRI - IKU 1 AEE</title>
  <style>
    :root{
      --navy:#082b57;--navy2:#0e3a73;--blue:#1769e0;--blue2:#0f58c9;--bg:#f5f7fb;--card:#fff;--line:#e5e7eb;--text:#0f172a;--muted:#64748b;--green:#16a34a;--green-bg:#eaf8ef;--orange:#f59e0b;--orange-bg:#fff7e6;--red:#dc2626;--red-bg:#fee2e2;--purple:#7c3aed;--purple-bg:#f3e8ff;--shadow:0 16px 34px rgba(15,23,42,.08);--radius:18px;
    }
    *{box-sizing:border-box} body{margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Arial,sans-serif;background:var(--bg);color:var(--text)}
    .app{display:grid;grid-template-columns:285px 1fr;min-height:100vh}.sidebar{background:linear-gradient(180deg,#071d3d 0%,#0a326b 60%,#061934 100%);color:white;padding:22px 16px;position:sticky;top:0;height:100vh;overflow-y:auto}.brand{display:flex;gap:14px;align-items:center;padding:6px 8px 24px;border-bottom:1px solid rgba(255,255,255,.16);margin-bottom:18px}.logo{width:50px;height:50px;border-radius:16px;background:radial-gradient(circle at 38% 35%,#ffe86a 0 25%,#f8a80a 26% 43%,#0c55a6 44% 70%,white 71%);box-shadow:0 10px 24px rgba(0,0,0,.25)}.brand h1{font-size:21px;margin:0;letter-spacing:-.03em}.brand p{font-size:12px;color:#cbd5e1;margin:4px 0 0}.nav-title{font-size:11px;color:#b7c8df;text-transform:uppercase;letter-spacing:.08em;margin:22px 10px 8px}.nav-item,.nav-parent{display:flex;align-items:center;justify-content:space-between;border-radius:12px;padding:12px 12px;font-size:14px;color:#e5edf8;cursor:pointer}.nav-item:hover,.nav-parent:hover{background:rgba(255,255,255,.1)}.nav-item.active{background:var(--blue);box-shadow:0 10px 24px rgba(23,105,224,.28);color:#fff}.nav-left{display:flex;align-items:center;gap:10px}.nav-children{display:grid;gap:3px;margin:4px 0 12px 18px}.nav-children .nav-item{font-size:13px;padding:10px 12px}.nav-badge{font-size:10px;background:#16a34a;color:white;border-radius:999px;padding:3px 7px;margin-left:8px}.main{min-width:0}.topbar{height:76px;background:rgba(255,255,255,.9);backdrop-filter:blur(16px);border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 30px;position:sticky;top:0;z-index:9}.crumb{display:flex;align-items:center;gap:10px;color:var(--muted);font-size:14px}.crumb strong{color:var(--text)}.top-actions{display:flex;align-items:center;gap:12px}.select,.search,.btn{border:1px solid var(--line);background:#fff;border-radius:12px;padding:11px 13px;min-height:44px;color:var(--text);font:inherit}.search{width:300px;color:var(--muted)}.avatar{width:42px;height:42px;border-radius:999px;background:linear-gradient(135deg,#dbeafe,#1d4ed8);border:3px solid white;box-shadow:0 4px 16px rgba(0,0,0,.14)}.content{padding:28px 30px 46px}.page-head{display:grid;grid-template-columns:minmax(0,1fr) auto;gap:20px;align-items:start;margin-bottom:20px}.page-head h2{font-size:28px;margin:0 0 8px;letter-spacing:-.03em;line-height:1.2}.page-head p{margin:0;color:var(--muted);line-height:1.55;max-width:1060px}.badge{display:inline-flex;align-items:center;gap:7px;border-radius:999px;padding:6px 11px;font-size:12px;font-weight:800}.badge.auto{background:var(--green-bg);color:var(--green)}.badge.info{background:#eaf2ff;color:var(--blue)}.badge.warn{background:var(--orange-bg);color:#b45309}.badge.good{background:var(--green-bg);color:var(--green)}.badge.red{background:var(--red-bg);color:var(--red)}.notice{background:linear-gradient(90deg,#eff6ff,#fff);border:1px solid #bfdbfe;border-radius:var(--radius);padding:16px 18px;margin-bottom:20px;color:#1e40af;display:flex;justify-content:space-between;gap:16px;align-items:center}.notice strong{color:#1d4ed8}.tabs{display:flex;gap:10px;border-bottom:1px solid var(--line);margin-bottom:20px}.tab{padding:13px 16px;border-bottom:3px solid transparent;color:var(--muted);font-weight:800;font-size:14px;cursor:pointer}.tab.active{color:var(--blue);border-color:var(--blue)}.section{display:none}.section.active{display:block}.summary{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px;margin-bottom:20px}.mini-card,.card{background:var(--card);border:1px solid var(--line);border-radius:var(--radius);box-shadow:var(--shadow)}.mini-card{padding:18px;display:flex;justify-content:space-between;align-items:center}.mini-card .label{font-size:13px;color:var(--muted)}.mini-card .value{font-size:26px;font-weight:900;letter-spacing:-.04em;margin-top:6px}.bubble{width:54px;height:54px;border-radius:18px;display:grid;place-items:center;font-size:24px}.b-blue{background:#eaf2ff;color:var(--blue)}.b-green{background:var(--green-bg);color:var(--green)}.b-orange{background:var(--orange-bg);color:var(--orange)}.layout{display:grid;grid-template-columns:minmax(0,1fr) 350px;gap:20px}.card{padding:18px;margin-bottom:20px}.card-title{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:16px}.card-title h3{font-size:17px;margin:0}.small{font-size:12px}.muted{color:var(--muted)}table{width:100%;border-collapse:collapse;font-size:13px}th,td{padding:13px 10px;border-bottom:1px solid var(--line);text-align:left;vertical-align:middle}th{font-size:12px;color:#475569;background:#f8fafc}tr:hover td{background:#fbfdff}.progress{height:9px;background:#e5e7eb;border-radius:999px;overflow:hidden;min-width:90px}.progress span{display:block;height:100%;background:var(--blue);border-radius:999px}.progress.green span{background:var(--green)}.progress.orange span{background:var(--orange)}.btn{font-weight:800;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;gap:8px}.btn.primary{background:var(--blue);color:white;border-color:var(--blue)}.btn.ghost{background:white;color:var(--blue)}.chart{height:245px;display:grid;grid-template-columns:repeat(4,1fr);align-items:end;gap:20px;padding:30px 14px 12px;border-left:1px solid var(--line);border-bottom:1px solid var(--line);background-image:linear-gradient(to top,rgba(226,232,240,.9) 1px,transparent 1px);background-size:100% 48px}.bar-wrap{text-align:center;color:var(--muted);font-size:12px}.bar{height:var(--h);width:52%;margin:0 auto 8px;background:linear-gradient(180deg,#60a5fa,#1168e8);border-radius:12px 12px 4px 4px;position:relative}.bar:before{content:attr(data-v);position:absolute;top:-24px;left:50%;transform:translateX(-50%);color:var(--blue);font-weight:900}.side{position:sticky;top:96px}.target-row{display:flex;justify-content:space-between;gap:12px;border-bottom:1px solid var(--line);padding:10px 0;font-size:13px}.formula{font-family:Georgia,serif;background:#f8fafc;border:1px solid var(--line);border-radius:14px;padding:14px;line-height:1.6}.sync-row{display:grid;grid-template-columns:24px 1fr auto;gap:10px;align-items:center;font-size:13px;padding:9px 0;border-bottom:1px solid var(--line)}.dot{width:22px;height:22px;border-radius:999px;background:var(--green);color:white;display:grid;place-items:center;font-size:11px}.faculty-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px}.faculty-card{padding:16px;border:1px solid var(--line);border-radius:16px;background:#fff}.faculty-card h4{margin:0 0 8px;font-size:14px}.faculty-card .big{font-size:25px;font-weight:900;color:var(--blue);margin-bottom:10px}.rank{display:inline-flex;width:28px;height:28px;border-radius:999px;align-items:center;justify-content:center;background:#eaf2ff;color:var(--blue);font-weight:900}.filter-row{display:flex;gap:12px;align-items:center;flex-wrap:wrap;margin-bottom:16px}.filter-row .select,.filter-row .search{min-height:40px;padding:9px 12px}.view-note{padding:12px 14px;background:#f8fafc;border:1px dashed #cbd5e1;border-radius:14px;color:#475569;margin-bottom:16px;font-size:13px}.footer-note{margin-top:12px;color:var(--muted);font-size:12px}.mode-switch{display:flex;background:#eef2ff;border:1px solid #dbeafe;border-radius:14px;padding:4px}.mode-switch button{border:0;background:transparent;padding:10px 14px;border-radius:11px;font-weight:900;color:#475569;cursor:pointer}.mode-switch button.active{background:white;color:var(--blue);box-shadow:0 5px 16px rgba(15,23,42,.08)}@media(max-width:1200px){.app{grid-template-columns:1fr}.sidebar{position:static;height:auto}.layout{grid-template-columns:1fr}.side{position:static}.summary{grid-template-columns:repeat(2,minmax(0,1fr))}.faculty-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
  </style>
</head>
<body>
<div class="app">
  <aside class="sidebar">
    <div class="brand"><div class="logo"></div><div><h1>SIM IKU</h1><p>Universitas Sriwijaya</p></div></div>
    <div class="nav-item"><span class="nav-left">⌂ Dashboard</span></div>
    <div class="nav-item"><span class="nav-left">◉ Perjanjian Kinerja</span></div>
    <div class="nav-item"><span class="nav-left">▣ Capaian IKU</span></div>
    <div class="nav-title">Input Data IKU</div>
    <div class="nav-parent"><span class="nav-left">✦ Talenta</span><span>⌃</span></div>
    <div class="nav-children">
      <div class="nav-item active">IKU 1 - AEE PT <span class="nav-badge">Auto</span></div>
      <div class="nav-item">IKU 2 - Lulusan</div>
      <div class="nav-item">IKU 3 - Kegiatan/Prestasi</div>
      <div class="nav-item">IKU 4 - Rekognisi Dosen</div>
    </div>
    <div class="nav-parent"><span class="nav-left">⚙ Inovasi</span><span>⌄</span></div>
    <div class="nav-parent"><span class="nav-left">◇ Kontribusi Masyarakat</span><span>⌄</span></div>
    <div class="nav-parent"><span class="nav-left">▰ Tata Kelola Berintegritas</span><span>⌄</span></div>
    <div class="nav-title">Lainnya</div>
    <div class="nav-item">▤ Eviden</div>
    <div class="nav-item">✓ Validasi Direktorat</div>
    <div class="nav-item">▥ Monitoring Triwulan</div>
    <div class="nav-item">⚙ Pengaturan</div>
  </aside>
  <main class="main">
    <header class="topbar">
      <div class="crumb">☰ <span>Input Data IKU</span> <span>›</span> <strong>IKU 1 - AEE PT / {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'Universitas' : $selectedFakultas }}</strong></div>
      <div class="top-actions">
        <div class="mode-switch">
          <button type="button" id="btnUniv" class="{{ $selectedFakultas == 'Universitas Sriwijaya' ? 'active' : '' }}">User Universitas</button>
          <button type="button" id="btnFak" class="{{ $selectedFakultas != 'Universitas Sriwijaya' ? 'active' : '' }}">User Fakultas</button>
        </div>
        <form id="filterForm" method="GET" action="" style="display: flex; gap: 12px; align-items: center;">
          <select class="select" name="fakultas" id="facultySelect" onchange="document.getElementById('filterForm').submit();">
            <option value="Universitas Sriwijaya" {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'selected' : '' }}>Universitas Sriwijaya</option>
            @foreach($listFakultas as $fak)
              <option value="{{ $fak }}" {{ $selectedFakultas == $fak ? 'selected' : '' }}>{{ $fak }}</option>
            @endforeach
          </select>
          <select class="select" name="tahun" id="yearSelect" onchange="document.getElementById('filterForm').submit();">
            <option value="2026" {{ $selectedTahun == '2026' ? 'selected' : '' }}>2026</option>
            <option value="2027" {{ $selectedTahun == '2027' ? 'selected' : '' }}>2027</option>
          </select>
          <button type="submit" name="export" value="excel" class="btn ghost" form="filterForm">⬇ Export Excel</button>
        </form>
        <div class="search">Cari prodi, fakultas, atau data AEE...</div>
        <div class="avatar"></div>
      </div>
    </header>

    <div class="content">
      <section class="page-head">
        <div>
          <h2>IKU 1 - AEE {{ $selectedFakultas }} <span class="badge auto">OTOMATIS DATALAKE</span></h2>
          <p>
            @if($selectedFakultas == 'Universitas Sriwijaya')
              Menampilkan AEE keseluruhan Unsri per jenjang dan AEE rata-rata universitas. Seluruh data berasal dari API Data Lake.
            @else
              Menampilkan AEE {{ $selectedFakultas }} per jenjang dan realisasi capaian. Data ditampilkan otomatis dari API Data Lake berdasarkan sinkronisasi seeder.
            @endif
          </p>
        </div>
        <span class="badge auto">Tidak ada input manual</span>
      </section>

      <div class="notice">
        <div><strong>Data otomatis dari API Data Lake.</strong> Sistem melakukan sinkronisasi terjadwal. User hanya melihat hasil, tanggal update, dan riwayat sinkronisasi.</div>
        <div class="small">Update terakhir: <strong>{{ now()->format('d M Y, H.i') }} WIB</strong></div>
      </div>

      {{-- Tab & Section --}}
      <div class="tabs">
        <div class="tab {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'active' : '' }}" data-mode="univ">Halaman Universitas</div>
        <div class="tab {{ $selectedFakultas != 'Universitas Sriwijaya' ? 'active' : '' }}" data-mode="fak">Halaman Fakultas</div>
      </div>

      {{-- Section Universitas --}}
      <div id="univSection" class="section {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'active' : '' }}">
        <div class="summary">
          <div class="mini-card"><div><div class="label">AEE Rata-rata Universitas</div><div class="value">{{ number_format($dataTabel ? collect($dataTabel)->avg('aee_realisasi') : 0, 2, ',', '.') }}%</div></div><div class="bubble b-blue">∑</div></div>
          <div class="mini-card"><div><div class="label">Target AEE PT {{ $selectedTahun }}</div><div class="value">{{ number_format($targetAeePT, 2, ',', '.') }}%</div></div><div class="bubble b-green">🎯</div></div>
          <div class="mini-card"><div><div class="label">Capaian terhadap Target</div><div class="value">{{ number_format($aee_pt, 2, ',', '.') }}%</div></div><div class="bubble b-orange">↗</div></div>
          <div class="mini-card"><div><div class="label">Jumlah Fakultas</div><div class="value">{{ count($listFakultas) -1 }}</div></div><div class="bubble b-blue">🏛</div></div>
        </div>

        <div class="layout">
          <div>
            <div class="card">
              <div class="card-title">
                <h3>AEE Universitas per Jenjang</h3>
                <button type="submit" name="export" value="excel" form="filterForm" class="btn ghost">⬇ Export Excel</button>
              </div>
              <div class="view-note">Tabel ini menampilkan AEE agregat Universitas Sriwijaya per jenjang. Data tidak dapat diedit karena berasal dari API Data Lake.</div>
              <table>
                <thead>
                  <tr>
                    <th>Jenjang</th>
                    <th>Mhs Masuk Cohort</th>
                    <th>Lulus Tepat Waktu</th>
                    <th>AEE Realisasi</th>
                    <th>AEE Ideal (Pembagi)</th>
                    <th>Capaian AEE</th>
                    <th>Target PK Rektor</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($dataTabel as $row)
                  <tr>
                    <td><strong>{{ $row->jenjang }}</strong></td>
                    <td>{{ number_format($row->total_mahasiswa, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->lulus_tepat_waktu, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->aee_realisasi, 2, ',', '.') }}%</td>
                    <td>{{ number_format($row->aee_ideal, 2, ',', '.') }}%</td>
                    <td>
                      @php 
                        $pc = $row->tingkat_pencapaian; 
                        $tg = $row->target_pk;
                        $persen_progress = $tg > 0 ? ($pc / $tg) * 100 : 0;
                      @endphp
                      <div style="display:flex;align-items:center;gap:8px;">
                        <div class="progress {{ $pc >= $tg ? 'green' : ($persen_progress >= 80 ? 'orange' : 'red') }}" style="width:80px">
                          <span style="width:{{ min($persen_progress, 100) }}%"></span>
                        </div>
                        <strong>{{ number_format($pc, 2, ',', '.') }}%</strong>
                      </div>
                    </td>
                    <td><strong>{{ number_format($tg, 2, ',', '.') }}%</strong></td>
                    <td>
                      @if($pc >= $tg) 
                        <span class="badge good">Tercapai</span>
                      @elseif($persen_progress >= 80) 
                        <span class="badge warn">Mendekati</span>
                      @else 
                        <span class="badge red">Perlu Perhatian</span> 
                      @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="8" style="text-align: center; color: var(--muted); padding: 20px;">Data jenjang untuk fakultas ini belum tersedia.</td>
                  </tr>
                  @endforelse
                  
                  @if(count($dataTabel) > 0)
                  <tr style="background:#f0f7ff;">
                    <td colspan="3"><strong>Rata-rata Keseluruhan</strong></td>
                    <td><strong>{{ number_format(collect($dataTabel)->avg('aee_realisasi'), 2, ',', '.') }}%</strong></td>
                    <td><strong>-</strong></td>
                    <td><strong>{{ number_format($aee_pt, 2, ',', '.') }}%</strong></td>
                    <td><strong>{{ number_format($targetAeePT, 2, ',', '.') }}%</strong></td>
                    <td>
                      @if($aee_pt >= $targetAeePT) 
                        <span class="badge good">Tercapai</span>
                      @else 
                        <span class="badge warn">Pemantauan</span> 
                      @endif
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
              <div class="footer-note">Keterangan: mahasiswa pindah, DO, dan cuti lebih dari ketentuan tidak masuk perhitungan.</div>
            </div>

            <div class="card" id="detailFakultas">
              <div class="card-title"><h3>AEE per Fakultas</h3><button class="btn ghost" onclick="scrollToFakultas()">Lihat Detail Semua Fakultas</button></div>
              <div class="faculty-grid">
                <div class="faculty-card"><h4><span class="rank">1</span> Fakultas Kedokteran</h4><div class="big">48,90%</div><div class="progress green"><span style="width:100%"></span></div><p class="small muted">Capaian 113,4% dari target universitas</p></div>
                <div class="faculty-card"><h4><span class="rank">2</span> Fakultas Ekonomi</h4><div class="big">45,20%</div><div class="progress green"><span style="width:100%"></span></div><p class="small muted">Capaian 104,8% dari target universitas</p></div>
                <div class="faculty-card"><h4><span class="rank">3</span> Fakultas Teknik</h4><div class="big">42,60%</div><div class="progress orange"><span style="width:98.7%"></span></div><p class="small muted">Capaian 98,7% dari target universitas</p></div>
                <div class="faculty-card"><h4><span class="rank">4</span> FASILKOM</h4><div class="big">41,10%</div><div class="progress orange"><span style="width:95.3%"></span></div><p class="small muted">Capaian 95,3% dari target universitas</p></div>
                <div class="faculty-card"><h4><span class="rank">5</span> FKIP</h4><div class="big">39,50%</div><div class="progress orange"><span style="width:91.6%"></span></div><p class="small muted">Capaian 91,6% dari target universitas</p></div>
                <div class="faculty-card"><h4><span class="rank">6</span> Fakultas Pertanian</h4><div class="big">38,70%</div><div class="progress orange"><span style="width:89.7%"></span></div><p class="small muted">Perlu tindak lanjut pada jenjang S1</p></div>
              </div>
            </div>
          </div>
          <aside class="side">
            <div class="card"><div class="card-title"><h3>Capaian AEE per Triwulan</h3></div><div class="chart"><div class="bar-wrap"><div class="bar" style="--h:52px" data-v="10,42%"></div>TW1</div><div class="bar-wrap"><div class="bar" style="--h:92px" data-v="21,56%"></div>TW2</div><div class="bar-wrap"><div class="bar" style="--h:128px" data-v="31,44%"></div>TW3</div><div class="bar-wrap"><div class="bar" style="--h:170px" data-v="{{ number_format($aee_pt, 2, ',', '.') }}%"></div>TW4</div></div></div>
            <div class="card"><div class="card-title"><h3>Target PK Rektor {{ $selectedTahun }}</h3></div><div class="target-row"><span>AEE PT</span><strong>{{ number_format($targetAeePT, 2, ',', '.') }}%</strong></div><div class="target-row"><span>D3</span><strong>51,50%</strong></div><div class="target-row"><span>S1</span><strong>50,00%</strong></div><div class="target-row"><span>S2</span><strong>40,00%</strong></div><div class="target-row"><span>S3</span><strong>31,00%</strong></div></div>
            <div class="card"><div class="card-title"><h3>Formula</h3></div><div class="formula">AEE PT = rata-rata tingkat pencapaian AEE dari setiap program pendidikan.<br><br>AEE = lulus tepat waktu / total mahasiswa cohort × 100%</div></div>
            <div class="card"><div class="card-title"><h3>Riwayat Sinkronisasi</h3></div><div class="sync-row"><div class="dot">✓</div><div>{{ now()->format('d M Y') }}, 02.00 WIB<br><span class="muted small">API Data Lake</span></div><span class="badge good">Berhasil</span></div><div class="sync-row"><div class="dot">✓</div><div>{{ now()->subDay()->format('d M Y') }}, 02.00 WIB<br><span class="muted small">API Data Lake</span></div><span class="badge good">Berhasil</span></div></div>
          </aside>
        </div>
      </div>

      {{-- Section Fakultas --}}
      <div id="fakSection" class="section {{ $selectedFakultas != 'Universitas Sriwijaya' ? 'active' : '' }}">
        <div class="summary">
          <div class="mini-card"><div><div class="label">AEE Rata-rata Fakultas</div><div class="value">{{ number_format($dataTabel ? collect($dataTabel)->avg('aee_realisasi') : 0, 2, ',', '.') }}%</div></div><div class="bubble b-blue">∑</div></div>
          <div class="mini-card"><div><div class="label">Target AEE PT {{ $selectedTahun }}</div><div class="value">{{ number_format($targetAeePT, 2, ',', '.') }}%</div></div><div class="bubble b-green">🎯</div></div>
          <div class="mini-card"><div><div class="label">Capaian terhadap Target</div><div class="value">{{ number_format($aee_pt, 2, ',', '.') }}%</div></div><div class="bubble b-orange">↗</div></div>
          <div class="mini-card"><div><div class="label">Status Sinkronisasi</div><div class="value">Aman</div></div><div class="bubble b-blue">🎓</div></div>
        </div>
        <div class="layout">
          <div>
            <div class="card">
              <div class="card-title"><h3>AEE {{ $selectedFakultas }} per Jenjang</h3><button type="submit" name="export" value="excel" form="filterForm" class="btn ghost">⬇ Export Excel</button></div>
              <div class="view-note">Halaman user fakultas menampilkan AEE fakultas per jenjang dan rincian AEE per prodi. Seluruh data read-only dari API Data Lake.</div>
              <table>
                <thead>
                  <tr>
                    <th>Jenjang</th>
                    <th>Mhs Masuk Cohort</th>
                    <th>Lulus Tepat Waktu</th>
                    <th>AEE Realisasi</th>
                    <th>AEE Ideal (Pembagi)</th>
                    <th>Capaian AEE</th>
                    <th>Target PK Rektor</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($dataTabel as $row)
                  <tr>
                    <td><strong>{{ $row->jenjang }}</strong></td>
                    <td>{{ number_format($row->total_mahasiswa, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->lulus_tepat_waktu, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->aee_realisasi, 2, ',', '.') }}%</td>
                    <td>{{ number_format($row->aee_ideal, 2, ',', '.') }}%</td>
                    <td>
                      @php 
                        $pc = $row->tingkat_pencapaian; 
                        $tg = $row->target_pk;
                        $persen_progress = $tg > 0 ? ($pc / $tg) * 100 : 0;
                      @endphp
                      <div style="display:flex;align-items:center;gap:8px;">
                        <div class="progress {{ $pc >= $tg ? 'green' : ($persen_progress >= 80 ? 'orange' : 'red') }}" style="width:80px">
                          <span style="width:{{ min($persen_progress, 100) }}%"></span>
                        </div>
                        <strong>{{ number_format($pc, 2, ',', '.') }}%</strong>
                      </div>
                    </td>
                    <td><strong>{{ number_format($tg, 2, ',', '.') }}%</strong></td>
                    <td>
                      @if($pc >= $tg) 
                        <span class="badge good">Tercapai</span>
                      @elseif($persen_progress >= 80) 
                        <span class="badge warn">Mendekati</span>
                      @else 
                        <span class="badge red">Perlu Perhatian</span> 
                      @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="8" style="text-align: center; color: var(--muted); padding: 20px;">Data jenjang untuk fakultas ini belum tersedia.</td>
                  </tr>
                  @endforelse
                  
                  @if(count($dataTabel) > 0)
                  <tr style="background:#f0f7ff;">
                    <td colspan="3"><strong>Rata-rata Keseluruhan</strong></td>
                    <td><strong>{{ number_format(collect($dataTabel)->avg('aee_realisasi'), 2, ',', '.') }}%</strong></td>
                    <td><strong>-</strong></td>
                    <td><strong>{{ number_format($aee_pt, 2, ',', '.') }}%</strong></td>
                    <td><strong>{{ number_format($targetAeePT, 2, ',', '.') }}%</strong></td>
                    <td>
                      @if($aee_pt >= $targetAeePT) 
                        <span class="badge good">Tercapai</span>
                      @else 
                        <span class="badge warn">Pemantauan</span> 
                      @endif
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="card" id="detailProdi">
              <div class="card-title"><h3>AEE per Program Studi</h3><button class="btn ghost">Lihat Semua Prodi</button></div>
              <div class="filter-row"><select class="select"><option>Semua Jenjang</option><option>D3</option><option>S1</option><option>S2</option><option>S3</option></select><select class="select"><option>Semua Status</option><option>Tercapai</option><option>Perhatian</option></select><div class="search">Cari nama program studi...</div></div>
              <table>
                <thead><tr><th>No</th><th>Program Studi</th><th>Jenjang</th><th>Masuk</th><th>Lulus Tepat Waktu</th><th>AEE</th><th>Capaian</th><th>Status</th></tr></thead>
                <tbody>
                  <tr><td colspan="8" style="text-align:center; color: var(--muted);">[Data rincian prodi untuk {{ $selectedFakultas }} ditarik dari SIM Akademik pada rilis berikutnya]</td></tr>
                </tbody>
              </table>
            </div>
          </div>
          <aside class="side">
            <div class="card"><div class="card-title"><h3>Capaian Fakultas per Triwulan</h3></div><div class="chart"><div class="bar-wrap"><div class="bar" style="--h:54px" data-v="10,65%"></div>TW1</div><div class="bar-wrap"><div class="bar" style="--h:96px" data-v="21,30%"></div>TW2</div><div class="bar-wrap"><div class="bar" style="--h:132px" data-v="31,95%"></div>TW3</div><div class="bar-wrap"><div class="bar" style="--h:174px" data-v="42,60%"></div>TW4</div></div></div>
            <div class="card"><div class="card-title"><h3>Prodi Perlu Perhatian</h3></div><div class="target-row"><span>Teknik Elektro</span><strong style="color:var(--red)">44,57%</strong></div><div class="target-row"><span>Teknik Kimia</span><strong style="color:#b45309">46,11%</strong></div><div class="target-row"><span>Teknik Mesin</span><strong style="color:#b45309">47,20%</strong></div></div>
            <div class="card"><div class="card-title"><h3>Catatan Sistem</h3></div><p class="muted small">Tidak ada form input pada halaman IKU 1. Jika terdapat perbedaan data, perbaikan dilakukan pada sistem sumber/Data Lake, bukan di SIM IKU.</p></div>
            <div class="card"><div class="card-title"><h3>Riwayat Sinkronisasi</h3></div><div class="sync-row"><div class="dot">✓</div><div>{{ now()->format('d M Y') }}, 02.00 WIB<br><span class="muted small">API Data Lake</span></div><span class="badge good">Berhasil</span></div><div class="sync-row"><div class="dot">✓</div><div>{{ now()->subDay()->format('d M Y') }}, 02.00 WIB<br><span class="muted small">API Data Lake</span></div><span class="badge good">Berhasil</span></div></div>
          </aside>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
  // Mode switch buttons (submit form dengan mengubah nilai select)
  document.getElementById('btnUniv').addEventListener('click', function() {
    document.getElementById('facultySelect').value = 'Universitas Sriwijaya';
    document.getElementById('filterForm').submit();
  });
  document.getElementById('btnFak').addEventListener('click', function() {
    // Pilih fakultas pertama yang bukan "Universitas Sriwijaya"
    let fakultasOptions = document.querySelectorAll('#facultySelect option');
    for (let opt of fakultasOptions) {
      if (opt.value !== 'Universitas Sriwijaya') {
        document.getElementById('facultySelect').value = opt.value;
        break;
      }
    }
    document.getElementById('filterForm').submit();
  });

  // Tabs: juga mengirim form dengan mengubah nilai select fakultas
  document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
      if (this.classList.contains('active')) return;
      let mode = this.getAttribute('data-mode');
      if (mode === 'univ') {
        document.getElementById('facultySelect').value = 'Universitas Sriwijaya';
      } else {
        let fakultasOptions = document.querySelectorAll('#facultySelect option');
        for (let opt of fakultasOptions) {
          if (opt.value !== 'Universitas Sriwijaya') {
            document.getElementById('facultySelect').value = opt.value;
            break;
          }
        }
      }
      document.getElementById('filterForm').submit();
    });
  });

  // Fungsi scroll ke detail fakultas
  function scrollToFakultas() {
    let el = document.getElementById('detailFakultas');
    if (el) {
      el.scrollIntoView({ behavior: 'smooth' });
      el.style.transition = "box-shadow 0.5s";
      el.style.boxShadow = "0 0 20px rgba(23, 105, 224, 0.4)";
      setTimeout(() => { el.style.boxShadow = "var(--shadow)"; }, 1500);
    }
  }

  @if(session('info'))
    alert('{{ session('info') }}');
  @endif
</script>
</body>
</html>