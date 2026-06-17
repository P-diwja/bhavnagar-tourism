<?php
require_once 'auth_check.php';
require_once '../db.php';
$flash=''; $flash_type='success';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $act=trim($_POST['act']??'');
  if($act==='save'){
    $id=intval($_POST['id']??0);
    $fields=['name','event_date','event_time','loc','event_type','descr'];
    $parts=[];
    foreach($fields as $f){$v=$conn->real_escape_string(trim($_POST[$f]??''));$parts[]="$f='$v'";}
    $seasonal=isset($_POST['seasonal'])?1:0; $parts[]="seasonal=$seasonal";
    $vis=isset($_POST['visible'])?1:0;       $parts[]="visible=$vis";
    if($id>0){$conn->query("UPDATE events SET ".implode(',',$parts)." WHERE id=$id");$flash='✅ Event updated.';}
    else{$conn->query("INSERT INTO events SET ".implode(',',$parts));$flash='✅ Event added.';}
  }
  if($act==='delete'){$id=intval($_POST['id']??0);$conn->query("DELETE FROM events WHERE id=$id");$flash='🗑️ Event deleted.';$flash_type='error';}
  if($act==='toggle'){$id=intval($_POST['id']??0);$conn->query("UPDATE events SET visible=1-visible WHERE id=$id");$flash='👁️ Visibility toggled.';}
}

$edit=null;
if(isset($_GET['edit'])){$id=intval($_GET['edit']);$r=$conn->query("SELECT * FROM events WHERE id=$id");$edit=$r?$r->fetch_assoc():null;}
$events=$conn->query("SELECT * FROM events ORDER BY seasonal DESC,id");
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Events – GoTrip Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style><?php include 'admin_styles.css.php'; ?></style>
</head><body>
<?php include 'sidebar.php'; ?>
<div class="main">
  <div class="top-bar">
    <div><h1 class="page-title">🎊 Events</h1>
    <p class="page-sub">Manage upcoming and recurring events shown on GoTrip</p></div>
    <a href="events.php?action=add" class="btn-primary">➕ Add New Event</a>
  </div>
  <?php if($flash): ?><div class="flash <?=$flash_type?>"><?=$flash?></div><?php endif; ?>

  <?php if(isset($_GET['action'])&&$_GET['action']==='add'||$edit): ?>
  <div class="section-card" style="margin-bottom:24px">
    <h2 class="section-card-title" style="margin-bottom:20px"><?=$edit?'✏️ Edit Event':'➕ Add New Event'?></h2>
    <form method="POST">
      <input type="hidden" name="act" value="save">
      <input type="hidden" name="id" value="<?=$edit?$edit['id']:0?>">
      <div class="form-grid">
        <div class="form-group full"><label class="form-label">Event Name *</label>
          <input class="form-input" name="name" required placeholder="e.g. Navratri Garba Festival" value="<?=htmlspecialchars($edit['name']??'')?>"></div>
        <div class="form-group"><label class="form-label">Date / Period</label>
          <input class="form-input" name="event_date" placeholder="e.g. Annual (Sep/Oct) or Jan 14" value="<?=htmlspecialchars($edit['event_date']??'')?>"></div>
        <div class="form-group"><label class="form-label">Time</label>
          <input class="form-input" name="event_time" placeholder="e.g. 9 PM – 2 AM" value="<?=htmlspecialchars($edit['event_time']??'')?>"></div>
        <div class="form-group"><label class="form-label">Location</label>
          <input class="form-input" name="loc" placeholder="e.g. Victoria Park area" value="<?=htmlspecialchars($edit['loc']??'')?>"></div>
        <div class="form-group"><label class="form-label">Event Type</label>
          <select class="form-select" name="event_type">
            <?php foreach(['Spiritual','Cultural','Nature','Adventure','Wellness','Offbeat'] as $t): ?>
            <option value="<?=$t?>" <?=($edit['event_type']??'')===$t?'selected':''?>><?=$t?></option>
            <?php endforeach; ?>
          </select></div>
        <div class="form-group full"><label class="form-label">Description</label>
          <textarea class="form-textarea" name="descr" rows="4" placeholder="Describe this event for visitors…"><?=htmlspecialchars($edit['descr']??'')?></textarea></div>
        <div class="form-group" style="display:flex;flex-direction:column;gap:10px">
          <label class="form-label" style="display:flex;align-items:center;gap:8px;cursor:pointer">
            <input type="checkbox" name="seasonal" value="1" <?=($edit['seasonal']??1)?'checked':''?>> Seasonal/Annual event (vs. recurring weekly)</label>
          <label class="form-label" style="display:flex;align-items:center;gap:8px;cursor:pointer">
            <input type="checkbox" name="visible" value="1" <?=($edit['visible']??1)?'checked':''?>> Visible on website</label>
        </div>
      </div>
      <div class="form-actions">
        <button class="btn-primary" type="submit"><?=$edit?'💾 Save Changes':'➕ Add Event'?></button>
        <a href="events.php" class="btn-sm">Cancel</a>
      </div>
    </form>
  </div>
  <?php endif; ?>

  <div class="section-card">
    <div class="section-card-header"><h2 class="section-card-title">All Events (<?=$events->num_rows?>)</h2></div>
    <div class="table-wrap">
      <table class="data-table">
        <thead><tr><th>Name</th><th>Date</th><th>Type</th><th>Kind</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
          <?php while($ev=$events->fetch_assoc()): ?>
          <tr>
            <td><strong><?=htmlspecialchars($ev['name'])?></strong><div style="font-size:11px;color:var(--muted);margin-top:2px">📍 <?=htmlspecialchars($ev['loc'])?></div></td>
            <td style="font-size:12px;color:var(--muted)"><?=htmlspecialchars($ev['event_date'])?></td>
            <td><?=htmlspecialchars($ev['event_type'])?></td>
            <td><?=$ev['seasonal']?'🗓️ Seasonal':'🔄 Recurring'?></td>
            <td><?=$ev['visible']?'<span class="badge-approved">👁️ Live</span>':'<span class="badge-hidden">🙈 Hidden</span>'?></td>
            <td><div style="display:flex;gap:6px">
              <a href="?edit=<?=$ev['id']?>" class="btn-edit">✏️ Edit</a>
              <form method="POST" style="display:inline" onsubmit="return confirm('Toggle?')">
                <input type="hidden" name="act" value="toggle"><input type="hidden" name="id" value="<?=$ev['id']?>">
                <button class="btn-sm" type="submit"><?=$ev['visible']?'🙈':'👁️'?></button>
              </form>
              <form method="POST" style="display:inline" onsubmit="return confirm('Delete event?')">
                <input type="hidden" name="act" value="delete"><input type="hidden" name="id" value="<?=$ev['id']?>">
                <button class="btn-danger" type="submit">🗑️</button>
              </form>
            </div></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body></html>
