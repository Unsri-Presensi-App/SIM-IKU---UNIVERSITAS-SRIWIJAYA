{{-- ════════════════════════════════════════════════════════════════════
     Gaya halaman IKU — sumber tunggal untuk seluruh view IKU 2–12.
     Disertakan lewat: @push('styles') @include('partials.iku-page-styles') @endpush
     Tab-styles diikutkan DULU agar override di bawah selalu menang.
═══════════════════════════════════════════════════════════════════════ --}}
@include('partials.iku-tab-styles')
<style>
  :root{
    --bg:#f7f8fc;--surface:#fff;--border:#eaecf0;--border-md:#d0d5dd;
    --text:#101828;--sub:#344054;--muted:#667085;--faint:#98a2b3;
    --indigo:#4f46e5;--indigo-lt:#eef2ff;--indigo-dk:#3730a3;
    --green:#12b76a;--green-lt:#ecfdf3;--green-dk:#027a48;
    --amber:#f79009;--amber-lt:#fffaeb;--amber-dk:#b54708;
    --red:#f04438;--red-lt:#fef3f2;--red-dk:#b42318;
    --purple:#7c3aed;--purple-lt:#f5f3ff;
    --navy:#082b57;--gold:#f59e0b;
    --r-sm:8px;--r-md:12px;--r-lg:16px;--r-xl:20px;
    --sh-sm:0 1px 3px rgba(16,24,40,.06),0 1px 2px rgba(16,24,40,.04);
    --sh-md:0 8px 24px -8px rgba(16,24,40,.12),0 2px 6px -2px rgba(16,24,40,.06);
  }

  /* ── Hero / page head ── */
  .ph{display:flex;justify-content:space-between;align-items:flex-start;gap:20px;flex-wrap:wrap;margin-bottom:22px;}
  .ph-left{display:flex;flex-direction:column;gap:4px;min-width:0;}
  .ph-eyebrow{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--indigo);}
  .ph-title{font-size:23px;font-weight:800;letter-spacing:-.025em;color:var(--text);line-height:1.22;}
  .ph-sub{font-size:13px;color:var(--muted);max-width:760px;line-height:1.55;margin-top:2px;}
  .ph-right{display:flex;align-items:center;gap:10px;flex-shrink:0;}

  /* ── Badges ── */
  .badge{display:inline-flex;align-items:center;gap:5px;padding:4px 11px;border-radius:999px;font-size:11px;font-weight:700;line-height:1;vertical-align:middle;white-space:nowrap;}
  .badge-dot{width:5px;height:5px;border-radius:50%;background:currentColor;flex-shrink:0;}
  .badge-auto{background:var(--green-lt);color:var(--green-dk);}
  .badge-hybrid{background:var(--amber-lt);color:var(--amber-dk);}
  .badge-manual{background:var(--indigo-lt);color:var(--indigo-dk);}
  .badge-talenta{background:#fef3c7;color:#92400e;}
  .badge-inovasi{background:#d1fae5;color:#065f46;}
  .badge-kontribusi{background:#e0f2fe;color:#075985;}
  .badge-tata{background:#fce7f3;color:#9d174d;}
  .badge-soft{background:var(--bg);color:var(--sub);border:1px solid var(--border);}

  /* ── Notice banner ── */
  .notice{border-radius:var(--r-md);padding:13px 16px;display:flex;align-items:flex-start;gap:11px;margin-bottom:18px;}
  .notice-amber{background:var(--amber-lt);border:1px solid #fde68a;}
  .notice-amber .notice-icon{color:var(--amber);}
  .notice-amber .notice-title{color:var(--amber-dk);}
  .notice-amber .notice-desc{color:var(--amber-dk);}
  .notice-info{background:linear-gradient(90deg,#eff6ff,#fff);border:1px solid #bfdbfe;}
  .notice-info .notice-icon{color:var(--indigo);}
  .notice-info .notice-title{color:var(--indigo-dk);}
  .notice-info .notice-desc{color:#3b5bdb;}
  .notice-icon{flex-shrink:0;margin-top:1px;}
  .notice-body{flex:1;min-width:0;}
  .notice-title{font-size:13px;font-weight:700;}
  .notice-desc{font-size:12px;margin-top:2px;line-height:1.5;}
  .notice-aside{font-size:11px;font-weight:600;align-self:center;white-space:nowrap;}

  /* ── Summary cards ── */
  .sum-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:18px;}
  .sc{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);padding:16px 18px;display:flex;align-items:flex-start;justify-content:space-between;gap:12px;}
  .sc-lbl{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:7px;}
  .sc-val{font-size:25px;font-weight:800;letter-spacing:-.03em;color:var(--text);line-height:1;}
  .sc-unit{font-size:14px;font-weight:600;color:var(--muted);letter-spacing:0;}
  .sc-ic{width:42px;height:42px;border-radius:13px;display:grid;place-items:center;flex-shrink:0;}
  .ic-indigo{background:var(--indigo-lt);color:var(--indigo);}
  .ic-green{background:var(--green-lt);color:var(--green-dk);}
  .ic-amber{background:var(--amber-lt);color:var(--amber);}
  .ic-purple{background:var(--purple-lt);color:var(--purple);}
  .ic-red{background:var(--red-lt);color:var(--red);}
  .ic-navy{background:#e8f0fb;color:var(--navy);}

  /* ── Two-column layout ── */
  .lay{display:grid;grid-template-columns:minmax(0,1fr) 320px;gap:20px;align-items:start;}
  .side{position:sticky;top:16px;display:flex;flex-direction:column;gap:14px;}

  /* ── Cards ── */
  .card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;margin-bottom:16px;}
  .card:last-child{margin-bottom:0;}
  .ch{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:15px 18px;border-bottom:1px solid var(--border);}
  .ch-left{display:flex;align-items:center;gap:10px;min-width:0;}
  .ch-icon{width:30px;height:30px;border-radius:var(--r-sm);background:var(--indigo-lt);display:flex;align-items:center;justify-content:center;color:var(--indigo);flex-shrink:0;}
  .ch-title{font-size:14px;font-weight:700;color:var(--text);}
  .ch-sub{font-size:11px;color:var(--muted);margin-top:1px;}
  .cp{padding:16px 18px;}

  /* ── Buttons ── */
  .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 15px;border-radius:var(--r-md);border:1px solid var(--border-md);background:var(--surface);color:var(--sub);font-size:13px;font-weight:600;font-family:inherit;cursor:pointer;text-decoration:none;transition:all .15s;white-space:nowrap;}
  .btn:hover{background:var(--bg);color:var(--text);}
  .btn.btn-sm{padding:6px 12px;font-size:12px;}
  .btn-primary{background:var(--indigo);color:#fff;border-color:var(--indigo);}
  .btn-primary:hover{background:var(--indigo-dk);border-color:var(--indigo-dk);color:#fff;}
  .btn-ghost{background:var(--surface);color:var(--indigo);border-color:#c7d2fe;}
  .btn-ghost:hover{background:var(--indigo-lt);color:var(--indigo-dk);}

  /* ── Tables ── */
  .tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
  table{width:100%;border-collapse:collapse;font-size:13px;}
  thead th{background:var(--navy);color:#fff;padding:10px 14px;text-align:left;font-size:11px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;white-space:nowrap;}
  thead th:first-child{border-radius:var(--r-sm) 0 0 0;}
  thead th:last-child{border-radius:0 var(--r-sm) 0 0;}
  tbody tr{border-bottom:1px solid var(--border);}
  tbody tr:last-child{border-bottom:none;}
  tbody tr:hover{background:#f9fafb;}
  tbody td{padding:12px 14px;color:var(--sub);vertical-align:middle;}
  tbody tr.total-row{background:#f0f4fa;font-weight:700;}
  tbody tr.total-row td{color:var(--navy);}

  /* ── Progress ── */
  .prog{min-width:80px;}
  .prog-bar{height:6px;background:#e4e7ec;border-radius:999px;overflow:hidden;margin-top:4px;}
  .prog-fill{height:100%;border-radius:999px;}
  .pf-green{background:var(--green);}.pf-amber{background:var(--amber);}.pf-red{background:var(--red);}
  .prog-lbl{font-size:11px;font-weight:700;}

  /* ── Status pills ── */
  .st{display:inline-flex;align-items:center;gap:4px;padding:3px 9px;border-radius:999px;font-size:11px;font-weight:600;white-space:nowrap;}
  .st-green{background:var(--green-lt);color:var(--green-dk);}
  .st-amber{background:var(--amber-lt);color:var(--amber-dk);}
  .st-red{background:var(--red-lt);color:var(--red-dk);}
  .st-dot{width:5px;height:5px;border-radius:50%;background:currentColor;}

  /* ── Right-sidebar cards ── */
  .side-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;}
  .side-head{background:var(--navy);padding:12px 16px;display:flex;align-items:center;gap:8px;}
  .side-head-title{font-size:12px;font-weight:700;color:#fff;letter-spacing:.03em;text-transform:uppercase;}
  .side-body{padding:14px 16px;}
  .tgt-row{display:flex;justify-content:space-between;align-items:center;gap:10px;padding:9px 0;border-bottom:1px solid var(--border);font-size:13px;}
  .tgt-row:last-child{border-bottom:none;}
  .tgt-lbl{color:var(--muted);font-weight:500;}
  .tgt-val{font-weight:700;color:var(--text);text-align:right;}
  .formula{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-sm);padding:12px 14px;font-size:12px;color:var(--sub);line-height:1.6;}
  .formula code{font-size:11px;background:#eef0f6;padding:1px 5px;border-radius:4px;}

  /* ── Generic metric box (IKU 4 dual-panel) ── */
  .dual-panel{display:grid;grid-template-columns:1fr 1fr;gap:16px;padding:16px 18px;}
  .metric-box{border:1px solid var(--border);border-radius:var(--r-lg);padding:20px;text-align:center;position:relative;overflow:hidden;}
  .metric-box::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:var(--indigo);}
  .metric-box.accent-purple::before{background:var(--purple);}
  .metric-label{font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:12px;}
  .metric-baseline{font-size:30px;font-weight:800;color:var(--text);letter-spacing:-.04em;line-height:1;}
  .metric-target{font-size:14px;color:var(--green-dk);font-weight:600;margin-top:6px;}
  .metric-desc{font-size:11px;color:var(--muted);margin-top:4px;}

  /* ── Big metric (IKU 9) ── */
  .big-metric{text-align:center;padding:26px 20px;background:linear-gradient(135deg,var(--navy) 0%,#1a4a8a 100%);color:#fff;border-radius:var(--r-lg);margin-bottom:16px;}
  .big-metric-label{font-size:12px;font-weight:600;opacity:.75;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;}
  .big-metric-val{font-size:52px;font-weight:900;letter-spacing:-.04em;line-height:1;}
  .big-metric-target{font-size:16px;color:var(--gold);font-weight:700;margin-top:8px;}

  /* ── Allocation grid (IKU 9) ── */
  .alokasi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:16px 18px;}
  .alokasi-item{text-align:center;padding:14px;background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-md);}
  .alokasi-lbl{font-size:10px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;}
  .alokasi-baseline{font-size:22px;font-weight:800;color:var(--text);}
  .alokasi-target{font-size:13px;color:var(--green-dk);font-weight:700;margin-top:3px;}

  /* ── Criteria / info grid ── */
  .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;}
  .info-item{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-sm);padding:10px 12px;font-size:11px;color:var(--sub);line-height:1.5;}
  .info-item strong{color:var(--navy);display:block;margin-bottom:3px;}

  /* ── Tab bar: standalone rounded bar (override tab-styles connect look) ── */
  .tab-bar{border:1px solid var(--border);border-radius:var(--r-lg);margin:0 0 16px;box-shadow:var(--sh-sm);}
  .tab-pane.active>.card{border-radius:var(--r-lg);border-top:1px solid var(--border);margin-top:0;}
  .tab-pane.active>.lay>div>.card:first-child,
  .tab-pane.active>.lay .side>.side-card:first-child{margin-top:0;}

  /* ── Responsive ── */
  @media(max-width:1100px){.lay{grid-template-columns:1fr;}.side{position:static;}.dual-panel{grid-template-columns:1fr;}}
  @media(min-width:581px) and (max-width:1100px){.side{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;}}
  @media(max-width:900px){.sum-grid{grid-template-columns:repeat(2,1fr);}.alokasi-grid{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:768px){.ph-title{font-size:19px;}.sc-val{font-size:21px;}.big-metric-val{font-size:38px;}table{min-width:520px;}.info-grid{grid-template-columns:1fr;}}
  @media(max-width:580px){.sum-grid{grid-template-columns:repeat(2,1fr);}.side{display:flex;flex-direction:column;gap:12px;}.alokasi-grid{grid-template-columns:1fr;}}
</style>
