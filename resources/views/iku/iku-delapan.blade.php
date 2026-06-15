@extends('layouts.app')
@section('title', 'IKU 8 – SDM Terlibat Kebijakan · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 8 – SDM Terlibat Penyusunan Kebijakan')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root{--bg:#f7f8fc;--surface:#fff;--border:#eaecf0;--border-md:#d0d5dd;--text:#101828;--sub:#344054;--muted:#667085;--faint:#98a2b3;--indigo:#4f46e5;--indigo-lt:#eef2ff;--indigo-dk:#3730a3;--green:#12b76a;--green-lt:#ecfdf3;--green-dk:#027a48;--amber:#f79009;--amber-lt:#fffaeb;--amber-dk:#b54708;--red:#f04438;--red-lt:#fef3f2;--red-dk:#b42318;--purple:#7c3aed;--purple-lt:#f5f3ff;--navy:#082b57;--gold:#f59e0b;--r-sm:8px;--r-md:12px;--r-lg:16px;--r-xl:20px;--sh-sm:0 1px 3px rgba(16,24,40,.06),0 1px 2px rgba(16,24,40,.04);}
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
  body{font-family:'Inter',system-ui,sans-serif;background:var(--bg);color:var(--text);}
  .ph{display:flex;justify-content:space-between;align-items:flex-start;gap:20px;flex-wrap:wrap;margin-bottom:24px;}
  .ph-left{display:flex;flex-direction:column;gap:3px;}
  .ph-eyebrow{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--indigo);}
  .ph-title{font-size:22px;font-weight:800;letter-spacing:-.025em;color:var(--text);line-height:1.25;}
  .ph-sub{font-size:13px;color:var(--muted);max-width:680px;line-height:1.55;margin-top:2px;}
  .badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;}
  .badge.wajib{background:var(--indigo-lt);color:var(--indigo-dk);}
  .badge.tata{background:#fce7f3;color:#9d174d;}
  .notice-kritis{background:var(--red-lt);border:1px solid #fecaca;border-radius:var(--r-md);padding:12px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;}
  .sum-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px;}
  .sc{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);padding:16px;display:flex;align-items:flex-start;justify-content:space-between;gap:12px;}
  .sc-lbl{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px;}
  .sc-val{font-size:26px;font-weight:800;letter-spacing:-.03em;color:var(--text);line-height:1;}
  .sc-ic{width:36px;height:36px;border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
  .ic-red{background:var(--red-lt);color:var(--red);}
  .ic-green{background:var(--green-lt);color:var(--green-dk);}
  .ic-amber{background:var(--amber-lt);color:var(--amber);}
  .ic-navy{background:#e8f0fb;color:var(--navy);}
  .lay{display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;}
  .side{position:sticky;top:20px;display:flex;flex-direction:column;gap:14px;}
  .card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;margin-bottom:16px;}
  .card:last-child{margin-bottom:0;}
  .ch{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:16px 20px;border-bottom:1px solid var(--border);}
  .ch-left{display:flex;align-items:center;gap:10px;}
  .ch-icon{width:30px;height:30px;border-radius:var(--r-sm);background:var(--indigo-lt);display:flex;align-items:center;justify-content:center;color:var(--indigo);flex-shrink:0;}
  .ch-title{font-size:14px;font-weight:700;color:var(--text);}
  .ch-sub{font-size:11px;color:var(--muted);margin-top:1px;}
  .cp{padding:16px 20px;}
  .big-metric{text-align:center;padding:32px 20px;background:linear-gradient(135deg,var(--navy) 0%,#1a4a8a 100%);color:#fff;border-radius:var(--r-lg);margin-bottom:16px;}
  .big-metric-label{font-size:12px;font-weight:600;opacity:.7;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;}
  .big-metric-val{font-size:56px;font-weight:900;letter-spacing:-.04em;line-height:1;}
  .big-metric-target{font-size:18px;color:var(--gold);font-weight:700;margin-top:8px;}
  .kebijakan-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;padding:16px 20px;}
  .keb-item{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);padding:14px;}
  .keb-type{font-size:12px;font-weight:700;color:var(--navy);margin-bottom:4px;}
  .keb-desc{font-size:11px;color:var(--sub);line-height:1.5;}
  .keb-example{font-size:10px;color:var(--muted);margin-top:6px;font-style:italic;}
  .side-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;}
  .side-head{background:var(--navy);padding:12px 16px;display:flex;align-items:center;gap:8px;}
  .side-head-title{font-size:12px;font-weight:700;color:#fff;letter-spacing:.03em;}
  .side-body{padding:14px 16px;}
  .tgt-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);font-size:13px;}
  .tgt-row:last-child{border-bottom:none;}
  .tgt-lbl{color:var(--muted);font-weight:500;}
  .tgt-val{font-weight:700;color:var(--text);}
  .formula{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-sm);padding:12px 14px;font-size:12px;color:var(--sub);line-height:1.6;margin-top:10px;}
  @media(max-width:1100px){.lay{grid-template-columns:1fr;}.side{position:static;}}
  @media(min-width:581px) and (max-width:1100px){.side{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;}}
  @media(max-width:900px){.sum-grid{grid-template-columns:repeat(2,1fr);}.kebijakan-grid{grid-template-columns:1fr;}}
  @media(max-width:768px){.ph-title{font-size:18px;}.sum-grid{gap:8px;}.sc{padding:12px;}.sc-val{font-size:20px;}.big-metric-val{font-size:38px;}}
  @media(max-width:580px){.sum-grid{grid-template-columns:repeat(2,1fr);}.side{display:flex;flex-direction:column;gap:12px;}}
</style>
@endpush
@section('content')
<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Dimensi Tata Kelola</div>
    <div class="ph-title">
      IKU 8 – Persentase SDM (Dosen/Peneliti) Terlibat Langsung dalam Penyusunan Kebijakan
      <span class="badge wajib" style="vertical-align:middle;margin-left:6px;font-size:11px;">IKU Wajib</span>
      <span class="badge tata" style="vertical-align:middle;margin-left:4px;font-size:11px;">Tata Kelola</span>
    </div>
    <div class="ph-sub">Persentase dosen dan peneliti yang terlibat langsung dalam penyusunan kebijakan (nasional/daerah/industri) sebagai narasumber, anggota tim perumus, atau konsultan resmi. PJ: WR2 & WR3.</div>
  </div>
</section>
<div class="notice-kritis">
  <div style="color:var(--red);flex-shrink:0;"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
  <div><div style="font-size:13px;font-weight:700;color:var(--red-dk);">⚠ Status Kritis — Gap 20 Percentage Point</div><div style="font-size:12px;color:var(--red-dk);margin-top:2px;line-height:1.5;">Baseline 2025 = <strong>{{ $baseline }}%</strong> vs Target 2026 = <strong>{{ $target }}%</strong>. Diperlukan keterlibatan tambahan <strong>{{ $target_dosen }} dosen/peneliti</strong> dalam penyusunan kebijakan.</div></div>
  <div style="font-size:11px;color:var(--red-dk);font-weight:700;background:var(--red-lt);padding:4px 10px;border-radius:999px;white-space:nowrap;align-self:center;">STATUS KRITIS</div>
</div>
<div class="sum-grid">
  <div class="sc"><div><div class="sc-lbl">Baseline 2025</div><div class="sc-val">{{ $baseline ?? 5 }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div><div class="sc-ic ic-red"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg></div></div>
  <div class="sc"><div><div class="sc-lbl">Target 2026</div><div class="sc-val">{{ $target ?? 25 }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div></div><div class="sc-ic ic-green"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div></div>
  <div class="sc"><div><div class="sc-lbl">Gap Target</div><div class="sc-val" style="color:var(--red);">+{{ $gap }}<span style="font-size:14px;font-weight:600;color:var(--muted);">pp</span></div></div><div class="sc-ic ic-amber"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg></div></div>
  <div class="sc"><div><div class="sc-lbl">Target Jumlah Dosen</div><div class="sc-val" style="color:var(--navy);">{{ $target_dosen }}</div></div><div class="sc-ic ic-navy"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div></div>
</div>
<div class="lay">
  <div>
    {{-- $prog dari controller --}}
    <div class="big-metric">
      <div class="big-metric-label">Progres Baseline → Target 2026</div>
      <div class="big-metric-val">{{ $prog }}%</div>
      <div class="big-metric-target">Target: {{ $target }}% ({{ $target_dosen }} dosen/peneliti)</div>
      <div style="margin:16px auto 0;max-width:400px;height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden;"><div style="width:{{ $prog }}%;height:100%;background:var(--gold);border-radius:999px;"></div></div>
      <div style="font-size:12px;opacity:.6;margin-top:8px;">Diperlukan peningkatan 4× lipat dari baseline saat ini</div>
    </div>
    <div class="card">
      <div class="ch"><div class="ch-left"><div class="ch-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/></svg></div><div><div class="ch-title">Kategori Keterlibatan Kebijakan</div><div class="ch-sub">Jenis keterlibatan yang diakui dalam perhitungan IKU 8</div></div></div></div>
      <div class="kebijakan-grid">
        @foreach([['Kebijakan Nasional','Terlibat sebagai tim perumus atau anggota komite di Kementerian/Lembaga Pusat','Contoh: Anggota Tim Penyusun Kurikulum Nasional Kemendikbud'],['Kebijakan Daerah','Konsultan atau narasumber resmi dalam penyusunan Perda/Pergub/Perbup/Perwali','Contoh: Konsultan RPJMD Provinsi Sumatera Selatan'],['Kebijakan Industri','Keterlibatan dalam penyusunan standar industri, SNI, atau kebijakan BUMN/swasta','Contoh: Anggota Komite Teknis BSN / Penyusun SOP BUMN'],['Bank Indonesia & OJK','Narasumber resmi dalam forum/sidang/kajian BI, OJK, BPS, dan lembaga serupa','Contoh: Tim Kajian Ekonomi Regional Bank Indonesia'],['Riset Kebijakan Berbayar','Penelitian terapan yang hasilnya digunakan langsung oleh pemangku kebijakan','Contoh: Policy Brief yang diadopsi Pemerintah Provinsi'],['Anggota Dewan/Komite Resmi','Menjabat dalam komisi, dewan, atau tim advisi yang bersifat resmi dan berkesinambungan','Contoh: Anggota Dewan Pendidikan Provinsi']] as $k)
        <div class="keb-item"><div class="keb-type">{{ $k[0] }}</div><div class="keb-desc">{{ $k[1] }}</div><div class="keb-example">{{ $k[2] }}</div></div>
        @endforeach
      </div>
    </div>
    <div class="card">
      <div class="ch"><div class="ch-left"><div class="ch-icon" style="background:var(--red-lt);color:var(--red);"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><div><div class="ch-title">Rencana Kerja Pencapaian IKU 8</div><div class="ch-sub">Prioritas intervensi 2026</div></div></div></div>
      <div class="cp">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
          @foreach(['Inventarisasi dosen yang sudah terlibat kebijakan & dokumentasikan','MoU dengan Pemprov Sumsel, DPRD, Bank Indonesia Palembang','Mapping ekspertise dosen vs kebutuhan kebijakan daerah','Program liaison rektorat dengan K/L pemerintah pusat','Insentif khusus dosen yang terlibat penyusunan kebijakan','Pelaporan keterlibatan kebijakan wajib di laporan kinerja dosen','Dorong dosen jadi anggota Dewan/Komite resmi daerah','Buat database rekam jejak keterlibatan kebijakan dosen'] as $rk)
          <div style="font-size:12px;color:var(--sub);background:#fef2f2;border:1px solid #fecaca;border-radius:var(--r-sm);padding:10px 12px;display:flex;gap:8px;align-items:flex-start;"><span style="color:var(--red-dk);margin-top:2px;flex-shrink:0;">→</span>{{ $rk }}</div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="side">
    <div class="side-card"><div class="side-head"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><div class="side-head-title">TARGET PK REKTOR 2026</div></div><div class="side-body"><div class="tgt-row"><span class="tgt-lbl">Baseline 2025</span><span class="tgt-val" style="color:var(--red);">{{ $baseline }}%</span></div><div class="tgt-row"><span class="tgt-lbl">Target 2026</span><span class="tgt-val" style="color:var(--green-dk);">{{ $target }}%</span></div><div class="tgt-row"><span class="tgt-lbl">Gap</span><span class="tgt-val" style="color:var(--red-dk);">+{{ $gap }} pp</span></div><div class="tgt-row"><span class="tgt-lbl">Est. Dosen Terlibat</span><span class="tgt-val" style="color:var(--navy);">{{ $target_dosen }} dosen</span></div><div class="tgt-row" style="border:none;"><span class="tgt-lbl">PJ</span><span class="tgt-val">WR2 & WR3</span></div></div></div>
    <div class="side-card"><div class="side-head" style="background:#1e40af;"><svg width="14" height="14" fill="none" stroke="#fff" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg><div class="side-head-title">FORMULA</div></div><div class="side-body"><div class="formula"><strong>Formula:</strong><br><code style="font-size:11px;">Σ Dosen/Peneliti terlibat kebijakan ÷ Total Dosen PT × 100%</code><br><br><strong>Ketentuan:</strong><br>Satu dosen bisa masuk 1 kategori saja (tidak double-counted). Wajib dibuktikan dengan dokumen resmi (SK, kontrak, surat tugas).</div></div></div>
  </div>
</div>
@endsection