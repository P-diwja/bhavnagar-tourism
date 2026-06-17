:root{
  --bg:#050b14;--sidebar:#07101f;--card:rgba(255,255,255,0.04);
  --card-border:rgba(255,255,255,0.08);--text:#e8edf5;--muted:#7a8ba0;
  --accent:#00c2ff;--accent2:#ff6b35;--radius:16px;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);display:flex;min-height:100vh}
a{text-decoration:none;color:inherit}

/* ── SIDEBAR ── */
.sidebar{width:230px;min-height:100vh;background:var(--sidebar);border-right:1px solid var(--card-border);display:flex;flex-direction:column;padding:0;position:fixed;top:0;left:0;z-index:100}
.sidebar-logo{padding:24px 20px 18px;border-bottom:1px solid var(--card-border)}
.sidebar-logo-text{font-family:'Playfair Display',serif;font-size:18px;font-weight:900;color:var(--accent)}
.sidebar-logo-text span{color:var(--text)}
.sidebar-badge{font-size:10px;font-weight:700;color:var(--muted);letter-spacing:1px;text-transform:uppercase;margin-top:3px}
.sidebar-nav{flex:1;padding:14px 10px}
.nav-section{font-size:10px;font-weight:800;color:var(--muted);letter-spacing:1.5px;text-transform:uppercase;padding:14px 10px 6px}
.nav-link{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;font-size:13px;font-weight:600;color:var(--muted);transition:all .18s;margin-bottom:2px;cursor:pointer}
.nav-link:hover,.nav-link.active{background:rgba(0,194,255,0.1);color:var(--accent);font-weight:700}
.nav-link .nav-icon{font-size:16px;width:20px;text-align:center}
.nav-badge{margin-left:auto;background:var(--accent2);color:#fff;font-size:10px;font-weight:800;padding:2px 7px;border-radius:20px}
.sidebar-footer{padding:14px 10px;border-top:1px solid var(--card-border)}
.sidebar-user{padding:10px 12px;border-radius:10px;background:var(--card);display:flex;align-items:center;gap:10px;margin-bottom:8px}
.user-avatar{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:900;color:#fff;flex-shrink:0}
.user-name{font-size:13px;font-weight:700}
.user-role{font-size:10px;color:var(--muted)}
.btn-logout{display:flex;align-items:center;justify-content:center;gap:6px;width:100%;padding:9px;border-radius:10px;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.2);color:#ef4444;font-size:12px;font-weight:700;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-logout:hover{background:rgba(239,68,68,0.15)}

/* ── MAIN AREA ── */
.main{margin-left:230px;flex:1;padding:32px 30px;min-height:100vh}
.top-bar{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;gap:16px;flex-wrap:wrap}
.page-title{font-family:'Playfair Display',serif;font-size:28px;font-weight:900;color:var(--text)}
.page-sub{font-size:13px;color:var(--muted);margin-top:5px}
.btn-view-site{padding:10px 20px;border-radius:50px;background:rgba(0,194,255,0.1);border:1px solid rgba(0,194,255,0.25);color:var(--accent);font-size:13px;font-weight:700;cursor:pointer;white-space:nowrap;transition:all .2s}
.btn-view-site:hover{background:rgba(0,194,255,0.18)}

/* ── STAT CARDS ── */
.stats-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:16px;margin-bottom:28px}
.stat-card{background:var(--card);border:1px solid var(--card-border);border-radius:var(--radius);padding:20px 18px;position:relative;transition:transform .2s,box-shadow .2s}
.stat-card:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(0,0,0,0.28)}
.stat-icon{font-size:26px;margin-bottom:10px}
.stat-val{font-size:32px;font-weight:900;color:var(--accent);line-height:1}
.stat-lbl{font-size:11px;color:var(--muted);font-weight:700;margin-top:4px}
.stat-badge{position:absolute;top:12px;right:12px;background:var(--accent2);color:#fff;font-size:10px;font-weight:800;padding:2px 8px;border-radius:20px}

/* ── SECTION CARD ── */
.section-card{background:var(--card);border:1px solid var(--card-border);border-radius:var(--radius);padding:24px;margin-bottom:24px}
.section-card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
.section-card-title{font-size:16px;font-weight:800;color:var(--text)}

/* ── BUTTONS ── */
.btn-sm{padding:7px 16px;border-radius:50px;background:rgba(0,194,255,0.1);border:1px solid rgba(0,194,255,0.2);color:var(--accent);font-size:12px;font-weight:700;cursor:pointer;transition:all .2s;font-family:inherit}
.btn-sm:hover{background:rgba(0,194,255,0.18)}
.btn-primary{padding:11px 22px;border-radius:12px;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-weight:700;font-size:14px;border:none;cursor:pointer;font-family:inherit;transition:transform .2s}
.btn-primary:hover{transform:scale(1.03)}
.btn-danger{padding:7px 14px;border-radius:9px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.25);color:#ef4444;font-size:12px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .2s}
.btn-danger:hover{background:rgba(239,68,68,0.2)}
.btn-success{padding:7px 14px;border-radius:9px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.25);color:#22c55e;font-size:12px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .2s}
.btn-success:hover{background:rgba(34,197,94,0.2)}
.btn-edit{padding:7px 14px;border-radius:9px;background:rgba(0,194,255,0.08);border:1px solid rgba(0,194,255,0.2);color:var(--accent);font-size:12px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .2s}
.btn-edit:hover{background:rgba(0,194,255,0.15)}

/* ── TABLE ── */
.table-wrap{overflow-x:auto}
.data-table{width:100%;border-collapse:collapse;font-size:13px}
.data-table th{text-align:left;padding:10px 14px;font-size:10px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:1px;border-bottom:1px solid var(--card-border)}
.data-table td{padding:12px 14px;border-bottom:1px solid rgba(255,255,255,0.04);vertical-align:middle}
.data-table tr:last-child td{border-bottom:none}
.data-table tr:hover td{background:rgba(255,255,255,0.02)}
.badge-approved{background:rgba(34,197,94,0.12);border:1px solid rgba(34,197,94,0.3);color:#22c55e;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700}
.badge-pending{background:rgba(255,107,53,0.12);border:1px solid rgba(255,107,53,0.3);color:var(--accent2);padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700}
.badge-hidden{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#ef4444;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700}

/* ── FORM ── */
.form-card{background:var(--card);border:1px solid var(--card-border);border-radius:var(--radius);padding:28px}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.form-group{margin-bottom:18px}
.form-group.full{grid-column:1/-1}
.form-label{display:block;font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:8px}
.form-input,.form-textarea,.form-select{width:100%;background:rgba(255,255,255,0.04);border:1px solid var(--card-border);border-radius:11px;padding:12px 15px;color:var(--text);font-family:inherit;font-size:14px;outline:none;transition:border-color .2s,box-shadow .2s}
.form-input:focus,.form-textarea:focus,.form-select:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(0,194,255,0.1)}
.form-input::placeholder,.form-textarea::placeholder{color:var(--muted)}
.form-textarea{resize:vertical;min-height:100px}
.form-select option{background:#0a1628;color:var(--text)}
.form-actions{display:flex;gap:12px;align-items:center;margin-top:8px}

/* ── QUICK ACTIONS ── */
.quick-actions{display:flex;gap:10px;flex-wrap:wrap}
.qa-btn{padding:11px 20px;border-radius:12px;background:rgba(0,194,255,0.08);border:1px solid rgba(0,194,255,0.2);color:var(--accent);font-size:13px;font-weight:700;cursor:pointer;transition:all .2s}
.qa-btn:hover{background:rgba(0,194,255,0.15)}
.qa-btn-orange{background:rgba(255,107,53,0.08);border-color:rgba(255,107,53,0.25);color:var(--accent2)}
.qa-btn-orange:hover{background:rgba(255,107,53,0.15)}

/* ── FLASH MESSAGES ── */
.flash{padding:12px 18px;border-radius:11px;font-size:13px;font-weight:600;margin-bottom:20px}
.flash.success{background:rgba(34,197,94,0.12);border:1px solid rgba(34,197,94,0.3);color:#22c55e}
.flash.error{background:rgba(239,68,68,0.12);border:1px solid rgba(239,68,68,0.3);color:#ef4444}

/* ── FILTER CHIPS ── */
.filter-bar{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px}
.filter-chip{padding:6px 16px;border-radius:50px;border:1px solid var(--card-border);background:transparent;color:var(--muted);font-size:12px;font-weight:600;cursor:pointer;font-family:inherit;transition:all .2s}
.filter-chip:hover,.filter-chip.active{border-color:var(--accent);background:rgba(0,194,255,0.1);color:var(--accent);font-weight:700}

/* ── RESPONSIVE ── */
@media(max-width:900px){
  .sidebar{width:60px;overflow:hidden}
  .sidebar-logo-text,.sidebar-badge,.nav-link span,.nav-section,.user-name,.user-role,.btn-logout span{display:none}
  .nav-link{justify-content:center;padding:12px}
  .main{margin-left:60px}
  .form-grid{grid-template-columns:1fr}
}
