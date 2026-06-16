{{-- Shared styles for IKU Tab + Form + Upload + Entry layout --}}
<style>
/* ─── Tab Bar ─── */
.tab-bar{display:flex;background:var(--surface);border:1px solid var(--border);border-bottom:none;border-radius:var(--r-lg) var(--r-lg) 0 0;overflow-x:auto;overflow-y:hidden;scrollbar-width:none;margin-top:20px;}
.tab-bar::-webkit-scrollbar{display:none;}
.tab-btn{display:inline-flex;align-items:center;gap:7px;padding:12px 18px;font-size:13px;font-weight:600;color:var(--muted);background:none;border:none;border-bottom:2.5px solid transparent;cursor:pointer;font-family:inherit;transition:all .15s;white-space:nowrap;flex-shrink:0;}
.tab-btn:hover{color:var(--text);background:var(--bg);}
.tab-btn.active{color:var(--indigo);border-bottom-color:var(--indigo);}
.tab-count{background:var(--indigo-lt);color:var(--indigo);border-radius:999px;padding:1px 7px;font-size:10px;font-weight:700;margin-left:2px;}
.tab-count.warn{background:var(--amber-lt);color:var(--amber-dk);}

/* ─── Tab Pane ─── */
.tab-pane{display:none;}
.tab-pane.active{display:block;}
.tab-pane.active > .card{border-radius:0 0 var(--r-lg) var(--r-lg);border-top:none;margin-top:0;}

/* ─── Form ─── */
.form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-bottom:12px;}
.form-group{display:flex;flex-direction:column;gap:5px;}
.form-group.full{grid-column:1/-1;}
.form-label{font-size:12px;font-weight:600;color:var(--sub);}
.form-input{padding:9px 12px;border-radius:var(--r-md);border:1.5px solid var(--border-md);background:var(--surface);color:var(--text);font-size:13px;font-family:inherit;outline:none;transition:border-color .15s,box-shadow .15s;width:100%;}
.form-input:focus{border-color:var(--indigo);box-shadow:0 0 0 3px rgba(79,70,229,.1);}
select.form-input{appearance:none;-webkit-appearance:none;background-image:url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='%2398a2b3' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 10px center;padding-right:30px;}
textarea.form-input{resize:vertical;min-height:72px;}

/* ─── Upload Area ─── */
.upload-area{border:2px dashed var(--border-md);border-radius:var(--r-lg);padding:22px;text-align:center;cursor:pointer;transition:all .15s;margin-bottom:12px;background:var(--bg);}
.upload-area:hover,.upload-area.drag-over{border-color:var(--indigo);background:var(--indigo-lt);}
.upload-icon{width:38px;height:38px;border-radius:10px;background:var(--indigo-lt);display:inline-flex;align-items:center;justify-content:center;margin-bottom:8px;color:var(--indigo);}
.upload-label{font-size:13px;color:var(--sub);line-height:1.5;}
.upload-hint{font-size:11px;color:var(--faint);margin-top:3px;}
.upload-files{display:flex;flex-direction:column;gap:5px;margin-top:10px;text-align:left;}
.upload-file-item{display:flex;align-items:center;gap:8px;padding:7px 10px;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-sm);font-size:12px;color:var(--sub);}

/* ─── Form Actions ─── */
.form-actions{display:flex;gap:10px;justify-content:flex-end;padding-top:14px;border-top:1px solid var(--border);margin-top:4px;}

/* ─── Alert flash ─── */
.alert{padding:12px 16px;border-radius:var(--r-md);margin-bottom:14px;font-size:13px;display:flex;align-items:center;gap:10px;}
.alert-success{background:var(--green-lt);border:1px solid #86efac;color:var(--green-dk);}
.alert-error{background:var(--red-lt);border:1px solid #fca5a5;color:var(--red-dk);}

/* ─── Status badge ─── */
.status-badge{display:inline-flex;align-items:center;gap:4px;padding:2px 9px;border-radius:999px;font-size:11px;font-weight:600;white-space:nowrap;}
.sb-draft{background:#f1f5f9;color:#64748b;}
.sb-diajukan{background:var(--amber-lt);color:var(--amber-dk);}
.sb-valid{background:var(--green-lt);color:var(--green-dk);}
.sb-revisi{background:var(--red-lt);color:var(--red-dk);}

/* ─── Entry list ─── */
.entry-list{display:flex;flex-direction:column;gap:8px;}
.entry-item{background:#f8f9fd;border:1px solid var(--border);border-radius:var(--r-lg);padding:14px 16px;}
.entry-head{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;flex-wrap:wrap;}
.entry-title{font-size:13px;font-weight:700;color:var(--text);}
.entry-meta{font-size:11px;color:var(--faint);margin-top:2px;}
.entry-actions{display:flex;align-items:center;gap:6px;flex-shrink:0;flex-wrap:wrap;}
.entry-eviden{display:flex;gap:6px;flex-wrap:wrap;}
.ev-chip{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-sm);font-size:11px;color:var(--sub);text-decoration:none;}
.ev-chip:hover{background:var(--indigo-lt);color:var(--indigo);border-color:#c7d2fe;}

/* ─── Responsive ─── */
@media(max-width:768px){
  .tab-btn{padding:10px 14px;font-size:12px;}
  .form-grid{grid-template-columns:1fr;}
  .form-actions{flex-direction:column;}
  .form-actions .btn{width:100%;justify-content:center;}
}
</style>
