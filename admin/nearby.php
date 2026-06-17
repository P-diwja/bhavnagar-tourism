<?php
require_once 'auth_check.php';
require_once '../db.php';
$flash=''; $flash_type='success';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $act=trim($_POST['act']??'');
  if($act==='save'){
    $id=intval($_POST['id']??0);
    $fields=['name','cat','distance','best','lat','lng','entry','tips','img','descr','highlights'];
    $parts=[];
    foreach($fields as $f){$v=$conn->real_escape_string(trim($_POST[$f]??''));$parts[]="$f='$v'";}
    $vis=isset($_POST['visible'])?1:0;$parts[]="visible=$vis";
    if($id>0){$conn->query("UPDATE nearby SET ".implode(',',$parts)." WHERE id=$id");$flash='✅ Destination updated.';}
    else{$conn->query("INSERT INTO nearby SET ".implode(',',$parts));$flash='✅ Destination added.';}
  }
  if($act==='delete'){$id=intval($_POST['id']??0);$conn->query("DELETE FROM nearby WHERE id=$id");$flash='🗑️ Deleted.';$flash_type='error';}
  if($act==='toggle'){$id=intval($_POST['id']??0);$conn->query("UPDATE nearby SET visible=1-visible WHERE id=$id");$flash='👁️ Toggled.';}
}

$edit=null;
if(isset($_GET['edit'])){$id=intval($_GET['edit']);$r=$conn->query("SELECT * FROM nearby WHERE id=$id");$edit=$r?$r->fetch_assoc():null;}
$nearby=$conn->query("SELECT * FROM nearby ORDER BY id");
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Nearby – GoTrip Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style><?php include 'admin_styles.css.php'; ?></style>
</head><body>
<?php include 'sidebar.php'; ?>
<div class="main">
  <div class="top-bar">
    <div><h1 class="page-title">🗺️ Nearby Destinations</h1>
    <p class="page-sub">Manage day-trip and weekend destinations near Bhavnagar</p></div>
    <a href="nearby.php?action=add" class="btn-primary">➕ Add Destination</a>
  </div>
  <?php if($flash): ?><div class="flash <?=$flash_type?>"><?=$flash?></div><?php endif; ?>

  <?php if(isset($_GET['action'])&&$_GET['action']==='add'||$edit): ?>
  <div class="section-card" style="margin-bottom:24px">
    <h2 class="section-card-title" style="margin-bottom:20px"><?=$edit?'✏️ Edit Destination':'➕ Add Destination'?></h2>
    <form method="POST">
      <input type="hidden" name="act" value="save">
      <input type="hidden" name="id" value="<?=$edit?$edit['id']:0?>">
      <div class="form-grid">
        <div class="form-group full"><label class="form-label">Name *</label>
          <input class="form-input" name="name" required placeholder="e.g. Palitana" value="<?=htmlspecialchars($edit['name']??'')?>"></div>
        <div class="form-group"><label class="form-label">Category</label>
          <select class="form-select" name="cat">
            <?php foreach(['Spiritual','Wildlife','Beach Heritage','Beach','History','Cultural','Heritage'] as $c): ?>
            <option value="<?=$c?>" <?=($edit['cat']??'')===$c?'selected':''?>><?=$c?></option>
            <?php endforeach; ?>
          </select></div>
        <div class="form-group"><label class="form-label">Distance</label>
          <input class="form-input" name="distance" placeholder="e.g. 42 km" value="<?=htmlspecialchars($edit['distance']??'')?>"></div>
        <div class="form-group"><label class="form-label">Best Time to Visit</label>
          <input class="form-input" name="best" placeholder="e.g. Oct–Mar" value="<?=htmlspecialchars($edit['best']??'')?>"></div>
        <div class="form-group"><label class="form-label">Entry Fee</label>
          <input class="form-input" name="entry" placeholder="e.g. Free or Rs.25" value="<?=htmlspecialchars($edit['entry']??'')?>"></div>
        <div class="form-group"><label class="form-label">Latitude</label>
          <input class="form-input" name="lat" type="number" step="any" value="<?=$edit['lat']??''?>"></div>
        <div class="form-group"><label class="form-label">Longitude</label>
          <input class="form-input" name="lng" type="number" step="any" value="<?=$edit['lng']??''?>"></div>
        <div class="form-group full"><label class="form-label">Image URL</label>
          <input class="form-input" name="img" placeholder="https://…" value="<?=htmlspecialchars($edit['img']??'')?>"></div>
        <div class="form-group full"><label class="form-label">Tips</label>
          <input class="form-input" name="tips" placeholder="Best tip for visitors" value="<?=htmlspecialchars($edit['tips']??'')?>"></div>
        <div class="form-group full"><label class="form-label">Highlights (comma-separated)</label>
          <input class="form-input" name="highlights" placeholder="e.g. 900+ Jain Temples,3500 Steps" value="<?=htmlspecialchars($edit['highlights']??'')?>"></div>
        <div class="form-group full"><label class="form-label">Description</label>
          <textarea class="form-textarea" name="descr" rows="4" placeholder="Describe this destination…"><?=htmlspecialchars($edit['descr']??'')?></textarea></div>
        <div class="form-group"><label class="form-label" style="display:flex;align-items:center;gap:8px;cursor:pointer">
          <input type="checkbox" name="visible" value="1" <?=($edit['visible']??1)?'checked':''?>> Visible on website</label></div>
      </div>
      <div class="form-actions">
        <button class="btn-primary" type="submit"><?=$edit?'💾 Save Changes':'➕ Add Destination'?></button>
        <a href="nearby.php" class="btn-sm">Cancel</a>
      </div>
    </form>
  </div>
  <?php endif; ?>

  <div class="section-card">
    <div class="section-card-header"><h2 class="section-card-title">All Nearby Destinations (<?=$nearby->num_rows?>)</h2></div>
    <div class="table-wrap">
      <table class="data-table">
        <thead><tr><th>Name</th><th>Category</th><th>Distance</th><th>Best Time</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
          <?php while($nb=$nearby->fetch_assoc()): ?>
          <tr>
            <td><strong><?=htmlspecialchars($nb['name'])?></strong></td>
            <td><?=htmlspecialchars($nb['cat'])?></td>
            <td><?=htmlspecialchars($nb['distance'])?></td>
            <td style="font-size:12px;color:var(--muted)"><?=htmlspecialchars($nb['best'])?></td>
            <td><?=$nb['visible']?'<span class="badge-approved">👁️ Live</span>':'<span class="badge-hidden">🙈 Hidden</span>'?></td>
            <td><div style="display:flex;gap:6px">
              <a href="?edit=<?=$nb['id']?>" class="btn-edit">✏️</a>
              <form method="POST" style="display:inline" onsubmit="return confirm('Toggle?')">
                <input type="hidden" name="act" value="toggle"><input type="hidden" name="id" value="<?=$nb['id']?>">
                <button class="btn-sm" type="submit"><?=$nb['visible']?'🙈':'👁️'?></button>
              </form>
              <form method="POST" style="display:inline" onsubmit="return confirm('Delete?')">
                <input type="hidden" name="act" value="delete"><input type="hidden" name="id" value="<?=$nb['id']?>">
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
