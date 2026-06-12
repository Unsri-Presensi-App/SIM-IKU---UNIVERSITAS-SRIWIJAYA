@extends('layouts.app')

@section('title', 'IKU 1 – AEE PT · SIM IKU UNSRI')
@section('crumb_parent', 'Input Data IKU')
@section('crumb_title', 'IKU 1 – AEE PT')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root {
    --bg:        #f7f8fc;
    --surface:   #ffffff;
    --border:    #eaecf0;
    --border-md: #d0d5dd;
    --text:      #101828;
    --sub:       #344054;
    --muted:     #667085;
    --faint:     #98a2b3;

    --indigo:    #4f46e5;
    --indigo-lt: #eef2ff;
    --indigo-dk: #3730a3;

    --green:     #12b76a;
    --green-lt:  #ecfdf3;
    --green-dk:  #027a48;

    --amber:     #f79009;
    --amber-lt:  #fffaeb;
    --amber-dk:  #b54708;

    --red:       #f04438;
    --red-lt:    #fef3f2;
    --red-dk:    #b42318;

    --purple:    #7c3aed;
    --purple-lt: #f5f3ff;

    --r-sm: 8px;
    --r-md: 12px;
    --r-lg: 16px;
    --r-xl: 20px;

    --sh-sm: 0 1px 3px rgba(16,24,40,.06), 0 1px 2px rgba(16,24,40,.04);
    --sh-md: 0 4px 8px -2px rgba(16,24,40,.06), 0 2px 4px -2px rgba(16,24,40,.04);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Inter', system-ui, sans-serif; background: var(--bg); color: var(--text); }

  /* ─── Page Header ─── */
  .ph { display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; flex-wrap: wrap; margin-bottom: 24px; }
  .ph-left { display: flex; flex-direction: column; gap: 3px; }
  .ph-eyebrow { font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--indigo); }
  .ph-title { font-size: 22px; font-weight: 800; letter-spacing: -.025em; color: var(--text); line-height: 1.25; }
  .ph-sub { font-size: 13px; color: var(--muted); max-width: 680px; line-height: 1.55; margin-top: 2px; }

  /* ─── Control Bar ─── */
  .ctrl-bar {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--r-xl);
    box-shadow: var(--sh-sm);
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 24px;
  }
  .ctrl-left { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
  .ctrl-right { display: flex; align-items: center; gap: 10px; }

  /* ─── Role Buttons ─── */
  .role-btn {
    display: inline-flex; align-items: center; gap: 9px;
    padding: 11px 20px; border-radius: var(--r-lg);
    border: 1.5px solid var(--border-md);
    background: var(--surface); color: var(--sub);
    font-size: 14px; font-weight: 600; font-family: inherit;
    cursor: pointer; transition: all .18s; white-space: nowrap; line-height: 1;
  }
  .role-btn svg { flex-shrink: 0; }
  .role-btn:hover { border-color: var(--indigo); color: var(--indigo); background: var(--indigo-lt); }
  .role-btn.active { background: var(--indigo); border-color: var(--indigo); color: #fff; }
  .role-btn.active:hover { background: var(--indigo-dk); border-color: var(--indigo-dk); }

  /* ─── Ctrl separator ─── */
  .ctrl-sep { width: 1px; height: 32px; background: var(--border); flex-shrink: 0; }

  /* ─── Fakultas Dropdown ─── */
  .fak-dropdown-wrap { position: relative; }
  .fak-trigger {
    display: inline-flex; align-items: center; justify-content: space-between; gap: 10px;
    padding: 11px 16px; min-width: 230px;
    border-radius: var(--r-lg); border: 1.5px solid var(--border-md);
    background: var(--surface); color: var(--sub);
    font-size: 14px; font-weight: 600; font-family: inherit;
    cursor: pointer; transition: all .18s; line-height: 1;
  }
  .fak-trigger-left { display: flex; align-items: center; gap: 9px; }
  .fak-trigger svg.chevron { transition: transform .2s; flex-shrink: 0; }
  .fak-trigger:hover,
  .fak-trigger.open { border-color: var(--indigo); color: var(--indigo); background: var(--indigo-lt); }
  .fak-trigger.open svg.chevron { transform: rotate(180deg); }

  .fak-dropdown {
    display: none; position: absolute;
    top: calc(100% + 8px); left: 0;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--r-xl);
    box-shadow: 0 8px 28px rgba(16,24,40,.13);
    min-width: 270px; z-index: 300;
    overflow: hidden; padding: 6px 0;
  }
  .fak-dropdown.open { display: block; }

  .fak-dropdown-header {
    padding: 9px 16px 5px;
    font-size: 10.5px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .08em; color: var(--faint);
  }
  .fak-item {
    display: flex; align-items: center; gap: 10px;
    width: 100%; padding: 11px 16px;
    font-size: 14px; color: var(--sub);
    font-family: inherit; font-weight: 500;
    background: none; border: none; cursor: pointer;
    text-align: left; transition: background .13s;
  }
  .fak-item svg { flex-shrink: 0; color: var(--faint); }
  .fak-item:hover { background: var(--bg); color: var(--text); }
  .fak-item:hover svg { color: var(--muted); }
  .fak-item.active { background: var(--indigo-lt); color: var(--indigo); font-weight: 700; }
  .fak-item.active svg { color: var(--indigo); }
  .fak-divider { height: 1px; background: var(--border); margin: 5px 0; }

  /* Year Select */
  .year-sel {
    padding: 10px 32px 10px 14px; border-radius: var(--r-lg); border: 1.5px solid var(--border-md);
    background: var(--surface); color: var(--text); font-size: 14px; font-weight: 600;
    font-family: inherit; cursor: pointer; outline: none; appearance: none; -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='%2398a2b3' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 10px center;
    transition: border-color .15s, box-shadow .15s;
  }
  .year-sel:focus { border-color: var(--indigo); box-shadow: 0 0 0 3px rgba(79,70,229,.12); }

  /* Status Pill */
  .status-pill { display: inline-flex; align-items: center; gap: 7px; padding: 8px 14px; background: var(--surface); border: 1px solid var(--border); border-radius: 99px; font-size: 13px; font-weight: 600; color: var(--sub); }
  .pulse { width: 8px; height: 8px; border-radius: 50%; background: var(--green); box-shadow: 0 0 0 3px var(--green-lt); animation: pulse 2.4s ease infinite; flex-shrink: 0; }
  @keyframes pulse { 0%,100%{box-shadow:0 0 0 3px var(--green-lt)} 50%{box-shadow:0 0 0 5px #86efac33} }

  /* ─── Notice Banner ─── */
  .notice {
    display: flex; align-items: center; justify-content: space-between; gap: 16px;
    background: var(--indigo-lt); border: 1px solid #c7d2fe;
    border-radius: var(--r-lg); padding: 12px 18px; margin-bottom: 20px; flex-wrap: wrap;
  }
  .notice-left { display: flex; align-items: center; gap: 10px; }
  .notice-ic { width: 30px; height: 30px; border-radius: 8px; background: var(--indigo); display: grid; place-items: center; flex-shrink: 0; }
  .notice-ic svg { color: #fff; }
  .notice-text { font-size: 13px; color: #3730a3; }
  .notice-text strong { color: var(--indigo-dk); font-weight: 700; }
  .notice-meta { font-size: 12px; color: #4f46e5; font-weight: 600; white-space: nowrap; }

  /* ─── Summary Grid ─── */
  .sum-grid { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 14px; margin-bottom: 20px; }
  .sc { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); box-shadow: var(--sh-sm); padding: 20px; display: flex; justify-content: space-between; align-items: flex-start; }
  .sc-lbl { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--faint); }
  .sc-val { font-size: 26px; font-weight: 800; letter-spacing: -.04em; color: var(--text); margin-top: 10px; line-height: 1; }
  .sc-ic { width: 40px; height: 40px; border-radius: 10px; display: grid; place-items: center; flex-shrink: 0; }
  .ic-indigo { background: var(--indigo-lt); color: var(--indigo); }
  .ic-green  { background: var(--green-lt);  color: var(--green);  }
  .ic-amber  { background: var(--amber-lt);  color: var(--amber);  }
  .ic-purple { background: var(--purple-lt); color: var(--purple); }

  /* ─── Layout ─── */
  .lay { display: grid; grid-template-columns: minmax(0,1fr) 320px; gap: 16px; align-items: start; }

  /* ─── Card ─── */
  .card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--r-xl); box-shadow: var(--sh-sm); padding: 22px; margin-bottom: 16px; }
  .card:last-child { margin-bottom: 0; }

  /* ─── Card Header ─── */
  .ch { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
  .ch-left { display: flex; align-items: center; gap: 8px; }
  .ch-icon { width: 28px; height: 28px; border-radius: 7px; background: var(--indigo-lt); display: grid; place-items: center; flex-shrink: 0; }
  .ch-icon svg { color: var(--indigo); }
  .ch-title { font-size: 14px; font-weight: 700; color: var(--text); letter-spacing: -.01em; }
  .ch-sub { font-size: 12px; color: var(--muted); font-weight: 400; }

  /* ─── View Note ─── */
  .view-note { background: var(--bg); border: 1px solid var(--border); border-radius: var(--r-md); padding: 10px 14px; font-size: 12px; color: var(--muted); margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
  .view-note svg { color: var(--faint); flex-shrink: 0; }

  /* ─── Table ─── */
  .tbl-wrap { overflow-x: auto; margin: 0 -22px; padding: 0 22px; -webkit-overflow-scrolling: touch; }
  table { width: 100%; border-collapse: collapse; font-size: 13px; }
  thead th { padding: 8px 10px; border-bottom: 1px solid var(--border); font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--faint); text-align: left; white-space: nowrap; background: transparent; }
  thead th:first-child { padding-left: 0; }
  thead th:last-child  { padding-right: 0; }
  tbody td { padding: 13px 10px; border-bottom: 1px solid #f2f4f7; color: var(--sub); vertical-align: middle; }
  tbody td:first-child { padding-left: 0; }
  tbody td:last-child  { padding-right: 0; }
  tbody tr:last-child td { border-bottom: none; }
  tbody tr:hover td { background: var(--bg); }
  .sum-row td { background: #f8faff !important; font-weight: 700; color: var(--text); }
  .sum-row:hover td { background: #eef2ff !important; }

  /* ─── Table scroll hint (mobile only) ─── */
  .tbl-scroll-hint { display: none; }

  /* ─── Progress ─── */
  .prog { height: 5px; background: var(--border); border-radius: 99px; overflow: hidden; min-width: 72px; }
  .prog-f { height: 100%; border-radius: 99px; transition: width .4s ease; }
  .pf-indigo { background: var(--indigo); }
  .pf-green  { background: var(--green); }
  .pf-amber  { background: var(--amber); }
  .pf-red    { background: var(--red); }

  /* ─── Badge ─── */
  .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 99px; font-size: 11px; font-weight: 700; letter-spacing: .01em; white-space: nowrap; }
  .badge-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; flex-shrink: 0; }
  .badge.good  { background: var(--green-lt); color: var(--green-dk); }
  .badge.warn  { background: var(--amber-lt); color: var(--amber-dk); }
  .badge.crit  { background: var(--red-lt);   color: var(--red-dk);   }
  .badge.info  { background: var(--indigo-lt);color: var(--indigo-dk);}
  .badge.auto  { background: var(--green-lt); color: var(--green-dk); }

  /* ─── Buttons ─── */
  .btn { padding: 8px 16px; border-radius: var(--r-md); border: 1px solid var(--border-md); background: var(--surface); color: var(--sub); font-size: 13px; font-weight: 600; cursor: pointer; transition: all .16s; font-family: inherit; line-height: 1; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; white-space: nowrap; }
  .btn:hover { background: var(--bg); border-color: var(--border-md); color: var(--text); }
  .btn-sm { padding: 6px 12px; font-size: 12px; }
  .btn-primary { background: var(--indigo); color: #fff; border-color: var(--indigo); }
  .btn-primary:hover { background: var(--indigo-dk); border-color: var(--indigo-dk); color: #fff; }

  /* ─── Sidebar Cards ─── */
  .side { position: sticky; top: 20px; display: flex; flex-direction: column; gap: 16px; }

  /* Chart bars */
  .triwulan-chart { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; align-items: end; height: 180px; padding: 24px 8px 0; border-left: 1px solid var(--border); border-bottom: 1px solid var(--border); }
  .twc-col { display: flex; flex-direction: column; align-items: center; gap: 8px; height: 100%; justify-content: flex-end; }
  .twc-bar { width: 60%; border-radius: 5px 5px 3px 3px; background: linear-gradient(180deg, #818cf8 0%, var(--indigo) 100%); position: relative; transition: height .4s ease; min-height: 8px; }
  .twc-val { position: absolute; top: -20px; left: 50%; transform: translateX(-50%); font-size: 10px; font-weight: 700; color: var(--indigo); white-space: nowrap; }
  .twc-lbl { font-size: 11px; font-weight: 600; color: var(--faint); margin-top: 8px; }

  /* Target rows */
  .tgt-row { display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid var(--border); font-size: 13px; }
  .tgt-row:last-child { border-bottom: none; }
  .tgt-lbl { color: var(--muted); font-weight: 500; }
  .tgt-val { font-weight: 700; color: var(--text); }

  /* Formula */
  .formula { background: var(--bg); border: 1px solid var(--border); border-radius: var(--r-lg); padding: 14px 16px; font-size: 13px; line-height: 1.7; color: var(--sub); }
  .formula strong { color: var(--indigo); font-style: italic; }

  /* Sync rows */
  .sync-row { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--border); }
  .sync-row:last-child { border-bottom: none; }
  .sync-dot { width: 24px; height: 24px; border-radius: 50%; background: var(--green-lt); border: 1px solid #86efac; display: grid; place-items: center; flex-shrink: 0; }
  .sync-dot svg { color: var(--green); }
  .sync-info { flex: 1; }
  .sync-date { font-size: 12px; font-weight: 600; color: var(--sub); }
  .sync-src  { font-size: 11px; color: var(--faint); margin-top: 1px; }

  /* Faculty grid */
  .fac-grid { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 12px; }
  .fac-card { padding: 14px; border: 1px solid var(--border); border-radius: var(--r-lg); background: var(--surface); }
  .fac-rank { width: 24px; height: 24px; border-radius: 6px; background: var(--indigo-lt); display: inline-flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; color: var(--indigo); margin-bottom: 8px; }
  .fac-name { font-size: 12px; font-weight: 600; color: var(--sub); margin-bottom: 6px; }
  .fac-val  { font-size: 22px; font-weight: 800; letter-spacing: -.03em; color: var(--text); margin-bottom: 8px; line-height: 1; }
  .fac-note { font-size: 11px; color: var(--muted); margin-top: 6px; }

  /* Prodi filter */
  .filter-row { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; margin-bottom: 14px; }
  .flt-sel { padding: 7px 28px 7px 10px; border-radius: var(--r-sm); border: 1px solid var(--border); background: var(--surface); color: var(--sub); font-size: 12px; font-weight: 600; font-family: inherit; cursor: pointer; appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='%2398a2b3' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 8px center; outline: none; }
  .flt-sel:focus { border-color: var(--indigo); }

  /* Hr */
  .hr { height: 1px; background: var(--border); margin: 14px 0; }

  /* Sections */
  .section { display: none; }
  .section.active { display: block; }

  /* Footer note */
  .fn { font-size: 11px; color: var(--faint); margin-top: 10px; display: flex; align-items: center; gap: 5px; }
  .fn svg { flex-shrink: 0; }

  /* Empty */
  .empty-cell { text-align: center; padding: 32px 20px !important; color: var(--muted) !important; }

  /* ═══════════════════════════════════════════════════════════
     MOBILE OPTIMIZATIONS
     Breakpoints:
       1100px  — sidebar turun ke bawah (sudah ada, dipertahankan)
        900px  — sum-grid 2 kolom, fac-grid 2 kolom
        768px  — tablet/HP landscape: ctrl-bar, card, tabel
        580px  — HP portrait: ctrl-bar full-column, sum-grid 1 kolom
  ═══════════════════════════════════════════════════════════ */

  /* ── 1100px: sidebar ke bawah ── */
  @media (max-width: 1100px) {
    .lay { grid-template-columns: 1fr; }
    .side { position: static; }
  }

  /* ── 900px: grid 2 kolom ── */
  @media (max-width: 900px) {
    .sum-grid { grid-template-columns: repeat(2, 1fr); }
    .fac-grid  { grid-template-columns: repeat(2, 1fr); }
  }

  /* ── Sidebar: grid 2 kolom di rentang tablet ── */
  @media (min-width: 581px) and (max-width: 1100px) {
    .side {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 14px;
    }
    .side .card { margin-bottom: 0 !important; }
  }

  /* ── 768px: penyesuaian umum tablet/HP landscape ── */
  @media (max-width: 768px) {

    /* Page header */
    .ph {
      flex-direction: column;
      gap: 12px;
      margin-bottom: 16px;
    }
    .ph-title { font-size: 18px; }
    .ph-sub   { font-size: 12px; }
    .ph > div:last-child { width: 100%; }
    .ph .btn-sm { width: 100%; justify-content: center; }

    /* Control bar */
    .ctrl-bar {
      padding: 12px 14px;
      gap: 10px;
      border-radius: var(--r-lg);
      margin-bottom: 16px;
      flex-direction: column;
      align-items: stretch;
    }
    .ctrl-left {
      width: 100%;
      flex-direction: column;
      align-items: stretch;
      gap: 8px;
    }
    .ctrl-right {
      width: 100%;
      justify-content: space-between;
    }
    .role-btn {
      width: 100%;
      justify-content: center;
      padding: 10px 16px;
    }
    .ctrl-sep { display: none !important; }
    .fak-dropdown-wrap { width: 100%; }
    .fak-trigger {
      min-width: unset !important;
      width: 100% !important;
    }
    .fak-dropdown {
      min-width: unset;
      width: 100%;
      left: 0;
      right: 0;
      /* Batasi tinggi dropdown agar tidak keluar layar */
      max-height: 60vh;
      overflow-y: auto;
    }
    .year-sel { flex: 1; }
    .status-pill { font-size: 12px; padding: 7px 12px; }

    /* Notice */
    .notice {
      flex-direction: column;
      gap: 8px;
      padding: 12px 14px;
      margin-bottom: 14px;
    }
    .notice-meta { font-size: 11px; white-space: normal; }

    /* Summary cards */
    .sum-grid {
      gap: 10px;
      margin-bottom: 14px;
    }
    .sc { padding: 14px; }
    .sc-lbl { font-size: 10px; }
    .sc-val { font-size: 20px; margin-top: 8px; }
    .sc-ic { width: 34px; height: 34px; border-radius: 9px; }

    /* Cards */
    .card {
      padding: 14px;
      border-radius: var(--r-lg);
      margin-bottom: 12px;
    }
    .ch { margin-bottom: 12px; gap: 8px; }
    .ch-title { font-size: 13px; }
    .ch-sub   { font-size: 11px; }

    /* Table scroll hint */
    .tbl-scroll-hint {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 10.5px;
      color: var(--faint);
      margin-bottom: 6px;
      font-style: italic;
    }

    /* Table wrapper — perlebar keluar card sesuai padding baru */
    .tbl-wrap {
      margin: 0 -14px;
      padding: 0 14px;
      -webkit-overflow-scrolling: touch;
      /* Fade kanan sebagai petunjuk scroll */
      -webkit-mask-image: linear-gradient(to right, black 90%, transparent 100%);
      mask-image: linear-gradient(to right, black 90%, transparent 100%);
    }
    table {
      min-width: 600px;
      font-size: 12px;
    }
    thead th {
      font-size: 10px;
      padding: 7px 8px;
    }
    tbody td {
      padding: 10px 8px;
      font-size: 12px;
    }
    .prog { min-width: 48px; }

    /* View note */
    .view-note {
      font-size: 11px;
      padding: 8px 10px;
      margin-bottom: 10px;
    }

    /* Faculty grid */
    .fac-card { padding: 12px; }
    .fac-val  { font-size: 18px; }
    .fac-name { font-size: 11px; }
    .fac-note { font-size: 10px; }

    /* Triwulan chart */
    .triwulan-chart {
      height: 140px;
      padding: 20px 4px 0;
      gap: 8px;
    }
    .twc-bar { width: 75%; }
    .twc-val { font-size: 9px; }
    .twc-lbl { font-size: 10px; }

    /* Sidebar rows */
    .tgt-row { font-size: 12px; padding: 8px 0; }
    .sync-date { font-size: 11px; }
    .sync-src  { font-size: 10px; }
    .formula   { font-size: 12px; padding: 12px 14px; }

    /* Filter row */
    .filter-row { flex-direction: column; align-items: stretch; }
    .flt-sel { width: 100%; }

    /* Badge & footnote */
    .badge { font-size: 10px; padding: 2px 7px; }
    .fn    { font-size: 10px; }
  }

  /* ── 580px: HP portrait, single-column agresif ── */
  @media (max-width: 580px) {
    .sum-grid { grid-template-columns: 1fr; }
    .fac-grid { grid-template-columns: repeat(2, 1fr); }

    .side {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    .side .card { margin-bottom: 0 !important; }

    /* Badge di ph-title tetap inline tapi font lebih kecil */
    .ph-title .badge { font-size: 10px; padding: 2px 6px; }

    /* Kartu summary jadi 2 kolom agar tidak terlalu panjang */
    .sum-grid { grid-template-columns: repeat(2, 1fr); }
  }

  /* ── 400px: HP sangat kecil ── */
  @media (max-width: 400px) {
    .fac-grid { grid-template-columns: 1fr; }
    .sum-grid { grid-template-columns: 1fr; }
    .sc-val   { font-size: 18px; }
  }
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<section class="ph">
  <div class="ph-left">
    <div class="ph-eyebrow">Input Data IKU · Talenta</div>
    <div class="ph-title">
      IKU 1 – Angka Efisiensi Edukasi (AEE)
      <span class="badge auto" style="vertical-align:middle; margin-left:6px; font-size:11px;">
        <span class="badge-dot"></span>Otomatis Datalake
      </span>
    </div>
    <div class="ph-sub">
      @if($selectedFakultas == 'Universitas Sriwijaya')
        Menampilkan AEE keseluruhan Unsri per jenjang dan rata-rata universitas. Seluruh data berasal dari API Data Lake secara otomatis.
      @else
        Menampilkan AEE {{ $selectedFakultas }} per jenjang dan realisasi capaian. Data ditarik otomatis dari API Data Lake.
      @endif
    </div>
  </div>
  <div>
    <a href="{{ route('iku.satu.export') }}" class="btn btn-sm">
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
      Export Excel
    </a>
  </div>
</section>

{{-- ── CONTROL BAR ── --}}
<form method="GET" id="filterForm" action="">
<div class="ctrl-bar">
  <div class="ctrl-left">

    {{-- Hidden select untuk submit form Laravel – tidak diubah --}}
    <select name="fakultas" id="facultySelect" style="display:none;">
      <option value="Universitas Sriwijaya" {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'selected' : '' }}>
        Universitas Sriwijaya
      </option>
      @foreach($listFakultas as $fak)
        <option value="{{ $fak }}" {{ $selectedFakultas == $fak ? 'selected' : '' }}>{{ $fak }}</option>
      @endforeach
    </select>

    {{-- Tombol Universitas --}}
    <button type="button" id="btnUniv"
      class="role-btn {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'active' : '' }}">
      <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
      </svg>
      Universitas
    </button>

    {{-- Tombol Fakultas --}}
    <button type="button" id="btnFak"
      class="role-btn {{ $selectedFakultas != 'Universitas Sriwijaya' ? 'active' : '' }}">
      <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
        <path d="M2 17l10 5 10-5"/>
        <path d="M2 12l10 5 10-5"/>
      </svg>
      Fakultas
    </button>

    {{-- Separator, hanya muncul saat mode Fakultas --}}
    <div class="ctrl-sep" id="fakSep"
      style="{{ $selectedFakultas != 'Universitas Sriwijaya' ? '' : 'display:none;' }}">
    </div>

    {{-- Dropdown pilih fakultas, hanya muncul saat mode Fakultas --}}
    <div class="fak-dropdown-wrap" id="fakDropWrap"
      style="{{ $selectedFakultas != 'Universitas Sriwijaya' ? '' : 'display:none;' }}">

      <button type="button"
        class="fak-trigger"
        id="fakTrigger"
        onclick="toggleFakDropdown()">
        <div class="fak-trigger-left">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          <span id="fakLabel">
            {{ $selectedFakultas != 'Universitas Sriwijaya' ? $selectedFakultas : 'Pilih Fakultas…' }}
          </span>
        </div>
        <svg class="chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <polyline points="6 9 12 15 18 9"/>
        </svg>
      </button>

      <div class="fak-dropdown" id="fakDropdown">
        <div class="fak-dropdown-header">Pilih Fakultas</div>

        @foreach($listFakultas as $fak)
          @php $isSps = strtoupper(trim($fak)) === 'SPS'; @endphp
          @if($fak !== 'Universitas Sriwijaya' && !$isSps)
          <button type="button"
            class="fak-item {{ $selectedFakultas == $fak ? 'active' : '' }}"
            onclick="setFakultas('{{ $fak }}')">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
              <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            {{ $fak }}
          </button>
          @endif
        @endforeach

        <div class="fak-divider"></div>
        <div class="fak-dropdown-header">Sekolah Pascasarjana</div>

        @foreach($listFakultas as $fak)
          @if(strtoupper(trim($fak)) === 'SPS')
          <button type="button"
            class="fak-item {{ $selectedFakultas == $fak ? 'active' : '' }}"
            onclick="setFakultas('{{ $fak }}')">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
              <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
            Sekolah Pascasarjana (SPS)
          </button>
          @endif
        @endforeach
      </div>
    </div>

  </div>

  <div class="ctrl-right">
    <div class="status-pill"><span class="pulse"></span>Data Tersinkron</div>
    <select name="tahun" class="year-sel" onchange="document.getElementById('filterForm').submit();">
      <option value="2026" {{ $selectedTahun == '2026' ? 'selected' : '' }}>2026</option>
      <option value="2027" {{ $selectedTahun == '2027' ? 'selected' : '' }}>2027</option>
    </select>
  </div>
</div>
</form>

{{-- ── NOTICE ── --}}
<div class="notice">
  <div class="notice-left">
    <div class="notice-ic">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
    </div>
    <div class="notice-text">
      <strong>Data otomatis dari API Data Lake.</strong>
      Sistem melakukan sinkronisasi terjadwal. User hanya melihat hasil, tanggal update, dan riwayat sinkronisasi.
    </div>
  </div>
  <div class="notice-meta">Update: {{ now()->format('d M Y, H.i') }} WIB</div>
</div>

{{-- ── SECTIONS ── --}}

{{-- ─ SECTION UNIVERSITAS ─ --}}
<div id="univSection" class="section {{ $selectedFakultas == 'Universitas Sriwijaya' ? 'active' : '' }}">

  <div class="sum-grid">
    <div class="sc">
      <div>
        <div class="sc-lbl">AEE Rata-rata Universitas</div>
        <div class="sc-val">{{ number_format($dataTabel ? collect($dataTabel)->avg('aee_realisasi') : 0, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-indigo">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Target AEE PT {{ $selectedTahun }}</div>
        <div class="sc-val">{{ number_format($targetAeePT, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-green">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Capaian terhadap Target</div>
        <div class="sc-val">{{ number_format($aee_pt, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-amber">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Jumlah Fakultas</div>
        <div class="sc-val">{{ count($listFakultas) - 1 }}</div>
      </div>
      <div class="sc-ic ic-purple">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      </div>
    </div>
  </div>

  <div class="lay">
    <div>

      {{-- Tabel Jenjang --}}
      <div class="card">
        <div class="ch">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
            </div>
            <div>
              <div class="ch-title">AEE Universitas per Jenjang</div>
              <div class="ch-sub">Agregat Universitas Sriwijaya · Tahun {{ $selectedTahun }}</div>
            </div>
          </div>
          <a href="{{ route('iku.satu.export') }}" class="btn btn-sm">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export
          </a>
        </div>
        <div class="view-note">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          Tabel read-only — data berasal dari API Data Lake dan tidak dapat diedit secara manual.
        </div>
        {{-- Scroll hint khusus mobile --}}
        <div class="tbl-scroll-hint">
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          Geser ke kanan untuk melihat semua kolom
        </div>
        <div class="tbl-wrap">
          <table>
            <thead>
              <tr>
                <th>Jenjang</th>
                <th>Mhs Cohort</th>
                <th>Lulus Tepat Waktu</th>
                <th>AEE Realisasi</th>
                <th>AEE Ideal</th>
                <th>Capaian AEE</th>
                <th>Target PK</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($dataTabel as $row)
              @php
                $pc = $row->tingkat_pencapaian;
                $tg = $row->target_pk;
                $pp = $tg > 0 ? ($pc / $tg) * 100 : 0;
                $pfClass = $pc >= $tg ? 'pf-green' : ($pp >= 80 ? 'pf-amber' : 'pf-red');
              @endphp
              <tr>
                <td><strong style="color:var(--text);">{{ $row->jenjang }}</strong></td>
                <td>{{ number_format($row->total_mahasiswa, 0, ',', '.') }}</td>
                <td>{{ number_format($row->lulus_tepat_waktu, 0, ',', '.') }}</td>
                <td style="font-weight:600;">{{ number_format($row->aee_realisasi, 2, ',', '.') }}%</td>
                <td>{{ number_format($row->aee_ideal, 2, ',', '.') }}%</td>
                <td>
                  <div style="display:flex;align-items:center;gap:8px;">
                    <div class="prog" style="width:72px;">
                      <div class="prog-f {{ $pfClass }}" style="width:{{ min($pp, 100) }}%"></div>
                    </div>
                    <strong style="color:var(--text);">{{ number_format($pc, 2, ',', '.') }}%</strong>
                  </div>
                </td>
                <td style="color:var(--muted); font-weight:600;">{{ number_format($tg, 2, ',', '.') }}%</td>
                <td>
                  @if($pc >= $tg)
                    <span class="badge good"><span class="badge-dot"></span>Tercapai</span>
                  @elseif($pp >= 80)
                    <span class="badge warn"><span class="badge-dot"></span>Mendekati</span>
                  @else
                    <span class="badge crit"><span class="badge-dot"></span>Perlu Perhatian</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr><td colspan="8" class="empty-cell">Data jenjang belum tersedia.</td></tr>
              @endforelse

              @if(count($dataTabel) > 0)
              <tr class="sum-row">
                <td colspan="3">Rata-rata Keseluruhan</td>
                <td>{{ number_format(collect($dataTabel)->avg('aee_realisasi'), 2, ',', '.') }}%</td>
                <td>—</td>
                <td>{{ number_format($aee_pt, 2, ',', '.') }}%</td>
                <td>{{ number_format($targetAeePT, 2, ',', '.') }}%</td>
                <td>
                  @if($aee_pt >= $targetAeePT)
                    <span class="badge good"><span class="badge-dot"></span>Tercapai</span>
                  @else
                    <span class="badge warn"><span class="badge-dot"></span>Pemantauan</span>
                  @endif
                </td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
        <div class="fn">
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          Mahasiswa pindah, DO, dan cuti melebihi ketentuan tidak masuk perhitungan.
        </div>
      </div>

      {{-- AEE per Fakultas --}}
      <div class="card" id="detailFakultas">
        <div class="ch">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div class="ch-title">AEE per Fakultas</div>
          </div>
          <button class="btn btn-sm" onclick="scrollToFakultas()">Lihat Semua</button>
        </div>
        <div class="fac-grid">
          <div class="fac-card">
            <div class="fac-rank">1</div>
            <div class="fac-name">Fak. Kedokteran</div>
            <div class="fac-val">48,90%</div>
            <div class="prog"><div class="prog-f pf-green" style="width:100%"></div></div>
            <div class="fac-note">Capaian 113,4% dari target</div>
          </div>
          <div class="fac-card">
            <div class="fac-rank">2</div>
            <div class="fac-name">Fak. Ekonomi</div>
            <div class="fac-val">45,20%</div>
            <div class="prog"><div class="prog-f pf-green" style="width:100%"></div></div>
            <div class="fac-note">Capaian 104,8% dari target</div>
          </div>
          <div class="fac-card">
            <div class="fac-rank">3</div>
            <div class="fac-name">Fak. Teknik</div>
            <div class="fac-val">42,60%</div>
            <div class="prog"><div class="prog-f pf-amber" style="width:99%"></div></div>
            <div class="fac-note">Capaian 98,7% dari target</div>
          </div>
          <div class="fac-card">
            <div class="fac-rank">4</div>
            <div class="fac-name">FASILKOM</div>
            <div class="fac-val">41,10%</div>
            <div class="prog"><div class="prog-f pf-amber" style="width:95%"></div></div>
            <div class="fac-note">Capaian 95,3% dari target</div>
          </div>
          <div class="fac-card">
            <div class="fac-rank">5</div>
            <div class="fac-name">FKIP</div>
            <div class="fac-val">39,50%</div>
            <div class="prog"><div class="prog-f pf-amber" style="width:92%"></div></div>
            <div class="fac-note">Capaian 91,6% dari target</div>
          </div>
          <div class="fac-card">
            <div class="fac-rank">6</div>
            <div class="fac-name">Fak. Pertanian</div>
            <div class="fac-val">38,70%</div>
            <div class="prog"><div class="prog-f pf-amber" style="width:90%"></div></div>
            <div class="fac-note">Perlu tindak lanjut S1</div>
          </div>
        </div>
      </div>

    </div>

    {{-- Sidebar --}}
    <aside class="side">

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:12px;">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
            </div>
            <div class="ch-title">Capaian per Triwulan</div>
          </div>
        </div>
        <div class="triwulan-chart">
          <div class="twc-col">
            <div class="twc-bar" style="height:42px;"><span class="twc-val">10,42%</span></div>
            <div class="twc-lbl">TW1</div>
          </div>
          <div class="twc-col">
            <div class="twc-bar" style="height:76px;"><span class="twc-val">21,56%</span></div>
            <div class="twc-lbl">TW2</div>
          </div>
          <div class="twc-col">
            <div class="twc-bar" style="height:108px;"><span class="twc-val">31,44%</span></div>
            <div class="twc-lbl">TW3</div>
          </div>
          <div class="twc-col">
            <div class="twc-bar" style="height:140px;"><span class="twc-val">{{ number_format($aee_pt, 2, ',', '.') }}%</span></div>
            <div class="twc-lbl">TW4</div>
          </div>
        </div>
      </div>

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:12px;">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="ch-title">Target PK Rektor {{ $selectedTahun }}</div>
          </div>
        </div>
        <div class="tgt-row"><span class="tgt-lbl">AEE PT</span><span class="tgt-val">{{ number_format($targetAeePT, 2, ',', '.') }}%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">D3</span><span class="tgt-val">51,50%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">S1</span><span class="tgt-val">50,00%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">S2</span><span class="tgt-val">40,00%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">S3</span><span class="tgt-val">31,00%</span></div>
      </div>

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:10px;">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
            </div>
            <div class="ch-title">Formula</div>
          </div>
        </div>
        <div class="formula">
          <strong>AEE PT</strong> = rata-rata tingkat pencapaian AEE dari setiap program pendidikan.<br><br>
          <strong>AEE</strong> = lulus tepat waktu ÷ total mahasiswa cohort × 100%
        </div>
      </div>

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:12px;">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.37"/></svg>
            </div>
            <div class="ch-title">Riwayat Sinkronisasi</div>
          </div>
        </div>
        <div class="sync-row">
          <div class="sync-dot">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="sync-info">
            <div class="sync-date">{{ now()->format('d M Y') }}, 02.00 WIB</div>
            <div class="sync-src">API Data Lake</div>
          </div>
          <span class="badge good"><span class="badge-dot"></span>Berhasil</span>
        </div>
        <div class="sync-row">
          <div class="sync-dot">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="sync-info">
            <div class="sync-date">{{ now()->subDay()->format('d M Y') }}, 02.00 WIB</div>
            <div class="sync-src">API Data Lake</div>
          </div>
          <span class="badge good"><span class="badge-dot"></span>Berhasil</span>
        </div>
      </div>

    </aside>
  </div>
</div>

{{-- ─ SECTION FAKULTAS ─ --}}
<div id="fakSection" class="section {{ $selectedFakultas != 'Universitas Sriwijaya' ? 'active' : '' }}">

  <div class="sum-grid">
    <div class="sc">
      <div>
        <div class="sc-lbl">AEE Rata-rata Fakultas</div>
        <div class="sc-val">{{ number_format($dataTabel ? collect($dataTabel)->avg('aee_realisasi') : 0, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-indigo">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Target AEE PT {{ $selectedTahun }}</div>
        <div class="sc-val">{{ number_format($targetAeePT, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-green">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Capaian terhadap Target</div>
        <div class="sc-val">{{ number_format($aee_pt, 2, ',', '.') }}<span style="font-size:14px;font-weight:600;color:var(--muted);">%</span></div>
      </div>
      <div class="sc-ic ic-amber">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/></svg>
      </div>
    </div>
    <div class="sc">
      <div>
        <div class="sc-lbl">Status Sinkronisasi</div>
        <div class="sc-val" style="font-size:18px; margin-top:12px; display:flex; align-items:center; gap:7px;">
          <span class="pulse"></span>Aman
        </div>
      </div>
      <div class="sc-ic ic-purple">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      </div>
    </div>
  </div>

  <div class="lay">
    <div>

      {{-- Tabel Jenjang Fakultas --}}
      <div class="card">
        <div class="ch">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
            </div>
            <div>
              <div class="ch-title">AEE {{ $selectedFakultas }} per Jenjang</div>
              <div class="ch-sub">Tahun {{ $selectedTahun }}</div>
            </div>
          </div>
          <a href="{{ route('iku.satu.export') }}" class="btn btn-sm">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export
          </a>
        </div>
        <div class="view-note">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          Data halaman Fakultas bersifat read-only dari API Data Lake.
        </div>
        {{-- Scroll hint khusus mobile --}}
        <div class="tbl-scroll-hint">
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          Geser ke kanan untuk melihat semua kolom
        </div>
        <div class="tbl-wrap">
          <table>
            <thead>
              <tr>
                <th>Jenjang</th>
                <th>Mhs Cohort</th>
                <th>Lulus Tepat Waktu</th>
                <th>AEE Realisasi</th>
                <th>AEE Ideal</th>
                <th>Capaian AEE</th>
                <th>Target PK</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($dataTabel as $row)
              @php
                $pc = $row->tingkat_pencapaian;
                $tg = $row->target_pk;
                $pp = $tg > 0 ? ($pc / $tg) * 100 : 0;
                $pfClass = $pc >= $tg ? 'pf-green' : ($pp >= 80 ? 'pf-amber' : 'pf-red');
              @endphp
              <tr>
                <td><strong style="color:var(--text);">{{ $row->jenjang }}</strong></td>
                <td>{{ number_format($row->total_mahasiswa, 0, ',', '.') }}</td>
                <td>{{ number_format($row->lulus_tepat_waktu, 0, ',', '.') }}</td>
                <td style="font-weight:600;">{{ number_format($row->aee_realisasi, 2, ',', '.') }}%</td>
                <td>{{ number_format($row->aee_ideal, 2, ',', '.') }}%</td>
                <td>
                  <div style="display:flex;align-items:center;gap:8px;">
                    <div class="prog" style="width:72px;">
                      <div class="prog-f {{ $pfClass }}" style="width:{{ min($pp, 100) }}%"></div>
                    </div>
                    <strong style="color:var(--text);">{{ number_format($pc, 2, ',', '.') }}%</strong>
                  </div>
                </td>
                <td style="color:var(--muted); font-weight:600;">{{ number_format($tg, 2, ',', '.') }}%</td>
                <td>
                  @if($pc >= $tg)
                    <span class="badge good"><span class="badge-dot"></span>Tercapai</span>
                  @elseif($pp >= 80)
                    <span class="badge warn"><span class="badge-dot"></span>Mendekati</span>
                  @else
                    <span class="badge crit"><span class="badge-dot"></span>Perlu Perhatian</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr><td colspan="8" class="empty-cell">Data jenjang untuk {{ $selectedFakultas }} belum tersedia.</td></tr>
              @endforelse

              @if(count($dataTabel) > 0)
              <tr class="sum-row">
                <td colspan="3">Rata-rata Keseluruhan</td>
                <td>{{ number_format(collect($dataTabel)->avg('aee_realisasi'), 2, ',', '.') }}%</td>
                <td>—</td>
                <td>{{ number_format($aee_pt, 2, ',', '.') }}%</td>
                <td>{{ number_format($targetAeePT, 2, ',', '.') }}%</td>
                <td>
                  @if($aee_pt >= $targetAeePT)
                    <span class="badge good"><span class="badge-dot"></span>Tercapai</span>
                  @else
                    <span class="badge warn"><span class="badge-dot"></span>Pemantauan</span>
                  @endif
                </td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

      {{-- AEE per Prodi --}}
      <div class="card" id="detailProdi">
        <div class="ch">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            </div>
            <div class="ch-title">AEE per Program Studi</div>
          </div>
          <button class="btn btn-sm">Lihat Semua Prodi</button>
        </div>
        <div class="filter-row">
          <select class="flt-sel">
            <option>Semua Jenjang</option>
            <option>D3</option><option>S1</option><option>S2</option><option>S3</option>
          </select>
          <select class="flt-sel">
            <option>Semua Status</option>
            <option>Tercapai</option><option>Perlu Perhatian</option>
          </select>
        </div>
        <div class="tbl-scroll-hint">
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          Geser ke kanan untuk melihat semua kolom
        </div>
        <div class="tbl-wrap">
          <table>
            <thead>
              <tr>
                <th>No</th><th>Program Studi</th><th>Jenjang</th>
                <th>Masuk</th><th>Lulus Tepat Waktu</th>
                <th>AEE</th><th>Capaian</th><th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="8" class="empty-cell" style="color:var(--faint);">
                  Data rincian prodi untuk {{ $selectedFakultas }} akan ditarik dari SIM Akademik pada rilis berikutnya.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

    {{-- Sidebar Fakultas --}}
    <aside class="side">

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:12px;">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
            </div>
            <div class="ch-title">Capaian per Triwulan</div>
          </div>
        </div>
        <div class="triwulan-chart">
          <div class="twc-col">
            <div class="twc-bar" style="height:42px;"><span class="twc-val">10,65%</span></div>
            <div class="twc-lbl">TW1</div>
          </div>
          <div class="twc-col">
            <div class="twc-bar" style="height:76px;"><span class="twc-val">21,30%</span></div>
            <div class="twc-lbl">TW2</div>
          </div>
          <div class="twc-col">
            <div class="twc-bar" style="height:108px;"><span class="twc-val">31,95%</span></div>
            <div class="twc-lbl">TW3</div>
          </div>
          <div class="twc-col">
            <div class="twc-bar" style="height:140px;"><span class="twc-val">42,60%</span></div>
            <div class="twc-lbl">TW4</div>
          </div>
        </div>
      </div>

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:12px;">
          <div class="ch-left">
            <div class="ch-icon" style="background:var(--red-lt);">
              <svg width="14" height="14" fill="none" stroke="var(--red)" stroke-width="1.75" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div class="ch-title">Prodi Perlu Perhatian</div>
          </div>
        </div>
        <div class="tgt-row"><span class="tgt-lbl">Teknik Elektro</span><span style="font-weight:700; color:var(--red);">44,57%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Teknik Kimia</span><span style="font-weight:700; color:var(--amber-dk);">46,11%</span></div>
        <div class="tgt-row"><span class="tgt-lbl">Teknik Mesin</span><span style="font-weight:700; color:var(--amber-dk);">47,20%</span></div>
      </div>

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:10px;">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="ch-title">Catatan Sistem</div>
          </div>
        </div>
        <p style="font-size:13px; color:var(--muted); line-height:1.6;">
          Tidak ada form input pada halaman IKU 1. Jika terdapat perbedaan data, perbaikan dilakukan pada sistem sumber/Data Lake, bukan di SIM IKU.
        </p>
      </div>

      <div class="card" style="margin-bottom:0;">
        <div class="ch" style="margin-bottom:12px;">
          <div class="ch-left">
            <div class="ch-icon">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.37"/></svg>
            </div>
            <div class="ch-title">Riwayat Sinkronisasi</div>
          </div>
        </div>
        <div class="sync-row">
          <div class="sync-dot">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="sync-info">
            <div class="sync-date">{{ now()->format('d M Y') }}, 02.00 WIB</div>
            <div class="sync-src">API Data Lake</div>
          </div>
          <span class="badge good"><span class="badge-dot"></span>Berhasil</span>
        </div>
        <div class="sync-row">
          <div class="sync-dot">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="sync-info">
            <div class="sync-date">{{ now()->subDay()->format('d M Y') }}, 02.00 WIB</div>
            <div class="sync-src">API Data Lake</div>
          </div>
          <span class="badge good"><span class="badge-dot"></span>Berhasil</span>
        </div>
      </div>

    </aside>
  </div>
</div>

@push('scripts')
<script>
  /* ─── setFakultas: tidak berubah, submit form Laravel ─── */
  function setFakultas(val) {
    document.getElementById('facultySelect').value = val;
    document.getElementById('filterForm').submit();
  }

  /* ─── Buka/tutup dropdown pilih fakultas ─── */
  function toggleFakDropdown() {
    var dd = document.getElementById('fakDropdown');
    var tr = document.getElementById('fakTrigger');
    dd.classList.toggle('open');
    tr.classList.toggle('open');
  }

  /* ─── Tutup dropdown jika klik di luar area ─── */
  document.addEventListener('click', function(e) {
    var wrap = document.getElementById('fakDropWrap');
    if (wrap && !wrap.contains(e.target)) {
      document.getElementById('fakDropdown').classList.remove('open');
      document.getElementById('fakTrigger').classList.remove('open');
    }
  });

  /* ─── Tombol Universitas ─── */
  document.getElementById('btnUniv').addEventListener('click', function() {
    setFakultas('Universitas Sriwijaya');
  });

  /* ─── Tombol Fakultas ─── */
  document.getElementById('btnFak').addEventListener('click', function() {
    var fakSep      = document.getElementById('fakSep');
    var fakDropWrap = document.getElementById('fakDropWrap');

    fakSep.style.display      = 'block';
    fakDropWrap.style.display = 'block';

    var currentVal = document.getElementById('facultySelect').value;
    if (currentVal && currentVal !== 'Universitas Sriwijaya') {
      /* Sudah ada pilihan sebelumnya, cukup buka dropdown */
      toggleFakDropdown();
    } else {
      /* Belum ada pilihan, langsung buka dropdown */
      document.getElementById('fakDropdown').classList.add('open');
      document.getElementById('fakTrigger').classList.add('open');
    }
  });

  /* ─── scrollToFakultas: tidak berubah ─── */
  function scrollToFakultas() {
    var el = document.getElementById('detailFakultas');
    if (el) {
      el.scrollIntoView({ behavior: 'smooth', block: 'start' });
      el.style.transition = 'box-shadow 0.4s';
      el.style.boxShadow = '0 0 0 2px var(--indigo)';
      setTimeout(function() { el.style.boxShadow = ''; }, 1600);
    }
  }

  @if(session('info'))
    console.info('{{ session('info') }}');
  @endif
</script>
@endpush
@endsection