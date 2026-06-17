<?php
require_once 'auth_check.php';
require_once '../db.php';
$flash=''; $flash_type='success';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $act=trim($_POST['act']??'');
  if($act==='save'){
    $id=intval($_POST['id']??0);
    $fields=['name','tier','price','rating','area','descr','hotel_type','amenities'];
    $parts=[];
    foreach($fields as $f){$v=$conn->real_escape_string(trim($_POST[$f]??''));$parts[]="$f='$v'";}
    $vis=isset($_POST['visible'])?1:0;$parts[]="visible=$vis";
    if($id>0){$conn->query("UPDATE hotels SET ".implode(',',$parts)." WHERE id=$id");$flash='✅ Hotel updated.';}
    else{$conn->query("INSERT INTO hotels SET ".implode(',',$parts));$flash='✅ Hotel added.';}
  }
  if($act==='delete'){$id=intval($_POST['id']??0);$conn->query("DELETE FROM hotels WHERE id=$id");$flash='🗑️ Deleted.';$flash_type='error';}
  if($act==='toggle'){$id=intval($_POST['id']??0);$conn->query("UPDATE hotels SET visible=1-visible WHERE id=$id");$flash='👁️ Toggled.';}
}

$edit=null;
if(isset($_GET['edit'])){$id=intval($_GET['edit']);$r=$conn->query("SELECT * FROM hotels WHERE id=$id");$edit=$r?$r->fetch_assoc():null;}
$hotels=$conn->query("SELECT * FROM hotels ORDER BY FIELD(tier,'ultra','budget','comfort','midrange','premium','luxury'),id");
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Hotels – GoTrip Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style><?php include 'admin_styles.css.php'; ?></style>
</head><body>
<?php include 'sidebar.php'; ?>
<div class="main">
  <div class="top-bar">
    <div><h1 class="page-title">🏨 Hotels & Stays</h1>
    <p class="page-sub">Manage accommodation listings across all budget tiers</p></div>
    <a href="hotels.php?action=add" class="btn-primary">➕ Add Hotel</a>
  </div>
  <?php if($flash): ?><div class="flash <?=$flash_type?>"><?=$flash?></div><?php endif; ?>

  <?php if(isset($_GET['action'])&&$_GET['action']==='add'||$edit): ?>
  <div class="section-card" style="margin-bottom:24px">
    <h2 class="section-card-title" style="margin-bottom:20px"><?=$edit?'✏️ Edit Hotel':'➕ Add Hotel'?></h2>
    <form method="POST">
      <input type="hidden" name="act" value="save">
      <input type="hidden" name="id" value="<?=$edit?$edit['id']:0?>">
      <div class="form-grid">
        <div class="form-group full"><label class="form-label">Hotel Name *</label>
          <input class="form-input" name="name" required placeholder="e.g. Hotel Clarks Collection" value="<?=htmlspecialchars($edit['name']??'')?>"></div>
        <div class="form-group"><label class="form-label">Budget Tier</label>
          <select class="form-select" name="tier">
            <?php foreach(['ultra'=>'Ultra Budget','budget'=>'Budget','comfort'=>'Budget Comfort','midrange'=>'Mid-Range','premium'=>'Premium','luxury'=>'Luxury'] as $k=>$v): ?>
            <option value="<?=$k?>" <?=($edit['tier']??'')===$k?'selected':''?>><?=$v?></option>
            <?php endforeach; ?>
          </select></div>
        <div class="form-group"><label class="form-label">Price Range</label>
          <input class="form-input" name="price" placeholder="e.g. ₹1,800–2,500" value="<?=htmlspecialchars($edit['price']??'')?>"></div>
        <div class="form-group"><label class="form-label">Rating</label>
          <input class="form-input" name="rating" type="number" step="0.1" min="0" max="5" placeholder="4.2" value="<?=$edit['rating']??''?>"></div>
        <div class="form-group"><label class="form-label">Area / Location</label>
          <input class="form-input" name="area" placeholder="e.g. Waghawadi Road" value="<?=htmlspecialchars($edit['area']??'')?>"></div>
        <div class="form-group"><label class="form-label">Hotel Type</label>
          <select class="form-select" name="hotel_type">
            <?php foreach(['Hotel','Resort','Heritage','Dharamshala','Wildlife Lodge','Hostel'] as $t): ?>
            <option value="<?=$t?>" <?=($edit['hotel_type']??'')===$t?'selected':''?>><?=$t?></option>
            <?php endforeach; ?>
          </select></div>
        <div class="form-group full"><label class="form-label">Amenities (comma-separated)</label>
          <input class="form-input" name="amenities" placeholder="e.g. Pool,Free WiFi,Parking,Restaurant" value="<?=htmlspecialchars($edit['amenities']??'')?>"></div>
        <div class="form-group full"><label class="form-label">Description</label>
          <textarea class="form-textarea" name="descr" rows="4" placeholder="Describe this hotel…"><?=htmlspecialchars($edit['descr']??'')?></textarea></div>
        <div class="form-group"><label class="form-label" style="display:flex;align-items:center;gap:8px;cursor:pointer">
          <input type="checkbox" name="visible" value="1" <?=($edit['visible']??1)?'checked':''?>> Visible on website</label></div>
      </div>
      <div class="form-actions">
        <button class="btn-primary" type="submit"><?=$edit?'💾 Save Changes':'➕ Add Hotel'?></button>
        <a href="hotels.php" class="btn-sm">Cancel</a>
      </div>
    </form>
  </div>
  <?php endif; ?>

  <div class="section-card">
    <div class="section-card-header"><h2 class="section-card-title">All Hotels (<?=$hotels->num_rows?>)</h2></div>
    <div class="table-wrap">
      <table class="data-table">
        <thead><tr><th>Name</th><th>Tier</th><th>Price</th><th>Rating</th><th>Area</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
          <?php
          $tier_colors=['ultra'=>'#7a8ba0','budget'=>'#22c55e','comfort'=>'#00c2ff','midrange'=>'#a78bfa','premium'=>'#fbbf24','luxury'=>'#ff6b35'];
          while($h=$hotels->fetch_assoc()): ?>
          <tr>
            <td><strong><?=htmlspecialchars($h['name'])?></strong><div style="font-size:11px;color:var(--muted);margin-top:2px"><?=htmlspecialchars($h['hotel_type'])?></div></td>
            <td><span style="color:<?=$tier_colors[$h['tier']]??'var(--muted)'?>;font-weight:700;font-size:12px"><?=ucfirst($h['tier'])?></span></td>
            <td style="font-size:12px"><?=htmlspecialchars($h['price'])?></td>
            <td style="color:#fbbf24">★ <?=$h['rating']?></td>
            <td style="font-size:12px;color:var(--muted)"><?=htmlspecialchars($h['area'])?></td>
            <td><?=$h['visible']?'<span class="badge-approved">👁️ Live</span>':'<span class="badge-hidden">🙈 Hidden</span>'?></td>
            <td><div style="display:flex;gap:6px">
              <a href="?edit=<?=$h['id']?>" class="btn-edit">✏️</a>
              <form method="POST" style="display:inline" onsubmit="return confirm('Toggle?')">
                <input type="hidden" name="act" value="toggle"><input type="hidden" name="id" value="<?=$h['id']?>">
                <button class="btn-sm" type="submit"><?=$h['visible']?'🙈':'👁️'?></button>
              </form>
              <form method="POST" style="display:inline" onsubmit="return confirm('Delete?')">
                <input type="hidden" name="act" value="delete"><input type="hidden" name="id" value="<?=$h['id']?>">
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
