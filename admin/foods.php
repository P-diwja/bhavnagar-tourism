<?php
require_once 'auth_check.php';
require_once '../db.php';
$flash=''; $flash_type='success';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $act=trim($_POST['act']??'');
  if($act==='save'){
    $id=intval($_POST['id']??0);
    $fields=['name','food_type','cat','rating','budget','specialty','area','lat','lng','phone','open_hrs','descr','tips','must_try'];
    $parts=[];
    foreach($fields as $f){$v=$conn->real_escape_string(trim($_POST[$f]??''));$parts[]="$f='$v'";}
    $vis=isset($_POST['visible'])?1:0;$parts[]="visible=$vis";
    if($id>0){$conn->query("UPDATE foods SET ".implode(',',$parts)." WHERE id=$id");$flash='✅ Food spot updated.';}
    else{$conn->query("INSERT INTO foods SET ".implode(',',$parts));$flash='✅ Food spot added.';}
  }
  if($act==='delete'){$id=intval($_POST['id']??0);$conn->query("DELETE FROM foods WHERE id=$id");$flash='🗑️ Deleted.';$flash_type='error';}
  if($act==='toggle'){$id=intval($_POST['id']??0);$conn->query("UPDATE foods SET visible=1-visible WHERE id=$id");$flash='👁️ Toggled.';}
}

$edit=null;
if(isset($_GET['edit'])){$id=intval($_GET['edit']);$r=$conn->query("SELECT * FROM foods WHERE id=$id");$edit=$r?$r->fetch_assoc():null;}
$foods=$conn->query("SELECT * FROM foods ORDER BY cat,name");
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Foods – GoTrip Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style><?php include 'admin_styles.css.php'; ?></style>
</head><body>
<?php include 'sidebar.php'; ?>
<div class="main">
  <div class="top-bar">
    <div><h1 class="page-title">🍽️ Food Spots</h1>
    <p class="page-sub">Manage restaurants, street food and hidden gems</p></div>
    <a href="foods.php?action=add" class="btn-primary">➕ Add Food Spot</a>
  </div>
  <?php if($flash): ?><div class="flash <?=$flash_type?>"><?=$flash?></div><?php endif; ?>

  <?php if(isset($_GET['action'])&&$_GET['action']==='add'||$edit): ?>
  <div class="section-card" style="margin-bottom:24px">
    <h2 class="section-card-title" style="margin-bottom:20px"><?=$edit?'✏️ Edit Food Spot':'➕ Add Food Spot'?></h2>
    <form method="POST">
      <input type="hidden" name="act" value="save">
      <input type="hidden" name="id" value="<?=$edit?$edit['id']:0?>">
      <div class="form-grid">
        <div class="form-group full"><label class="form-label">Name *</label>
          <input class="form-input" name="name" required placeholder="e.g. Lachhubhai Ganthiyawala" value="<?=htmlspecialchars($edit['name']??'')?>"></div>
        <div class="form-group"><label class="form-label">Type</label>
          <select class="form-select" name="food_type">
            <?php foreach(['Veg','Non-Veg','Both'] as $t): ?>
            <option value="<?=$t?>" <?=($edit['food_type']??'')===$t?'selected':''?>><?=$t?></option>
            <?php endforeach; ?>
          </select></div>
        <div class="form-group"><label class="form-label">Category</label>
          <select class="form-select" name="cat">
            <?php foreach(['Street Food','Restaurant','Cafe','Sweets','Fast Food','Non-Veg','Chain','Hidden Gem'] as $c): ?>
            <option value="<?=$c?>" <?=($edit['cat']??'')===$c?'selected':''?>><?=$c?></option>
            <?php endforeach; ?>
          </select></div>
        <div class="form-group"><label class="form-label">Rating</label>
          <input class="form-input" name="rating" type="number" step="0.1" min="0" max="5" placeholder="4.5" value="<?=$edit['rating']??''?>"></div>
        <div class="form-group"><label class="form-label">Budget Range</label>
          <input class="form-input" name="budget" placeholder="e.g. Rs.20–80" value="<?=htmlspecialchars($edit['budget']??'')?>"></div>
        <div class="form-group"><label class="form-label">Specialty</label>
          <input class="form-input" name="specialty" placeholder="e.g. Pav Gathiya, Bhavnagri Gathiya" value="<?=htmlspecialchars($edit['specialty']??'')?>"></div>
        <div class="form-group"><label class="form-label">Area / Location</label>
          <input class="form-input" name="area" placeholder="e.g. Ghogha Circle" value="<?=htmlspecialchars($edit['area']??'')?>"></div>
        <div class="form-group"><label class="form-label">Opening Hours</label>
          <input class="form-input" name="open_hrs" placeholder="e.g. 7 AM – 10 PM" value="<?=htmlspecialchars($edit['open_hrs']??'')?>"></div>
        <div class="form-group"><label class="form-label">Phone</label>
          <input class="form-input" name="phone" placeholder="+91…" value="<?=htmlspecialchars($edit['phone']??'')?>"></div>
        <div class="form-group"><label class="form-label">Latitude</label>
          <input class="form-input" name="lat" type="number" step="any" value="<?=$edit['lat']??''?>"></div>
        <div class="form-group"><label class="form-label">Longitude</label>
          <input class="form-input" name="lng" type="number" step="any" value="<?=$edit['lng']??''?>"></div>
        <div class="form-group full"><label class="form-label">Must Try Items (comma-separated)</label>
          <input class="form-input" name="must_try" placeholder="e.g. Pav Gathiya,Nylon Gathiya,Chaas" value="<?=htmlspecialchars($edit['must_try']??'')?>"></div>
        <div class="form-group full"><label class="form-label">Tips</label>
          <input class="form-input" name="tips" placeholder="Quick tip for visitors" value="<?=htmlspecialchars($edit['tips']??'')?>"></div>
        <div class="form-group full"><label class="form-label">Description</label>
          <textarea class="form-textarea" name="descr" rows="4" placeholder="Describe this food spot…"><?=htmlspecialchars($edit['descr']??'')?></textarea></div>
        <div class="form-group"><label class="form-label" style="display:flex;align-items:center;gap:8px;cursor:pointer">
          <input type="checkbox" name="visible" value="1" <?=($edit['visible']??1)?'checked':''?>> Visible on website</label></div>
      </div>
      <div class="form-actions">
        <button class="btn-primary" type="submit"><?=$edit?'💾 Save Changes':'➕ Add Food Spot'?></button>
        <a href="foods.php" class="btn-sm">Cancel</a>
      </div>
    </form>
  </div>
  <?php endif; ?>

  <div class="section-card">
    <div class="section-card-header"><h2 class="section-card-title">All Food Spots (<?=$foods->num_rows?>)</h2></div>
    <div class="table-wrap">
      <table class="data-table">
        <thead><tr><th>Name</th><th>Category</th><th>Type</th><th>Rating</th><th>Area</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
          <?php while($f=$foods->fetch_assoc()): ?>
          <tr>
            <td><strong><?=htmlspecialchars($f['name'])?></strong></td>
            <td><?=htmlspecialchars($f['cat'])?></td>
            <td><span style="color:<?=$f['food_type']==='Veg'?'#22c55e':'#ff6b35'?>"><?=$f['food_type']?></span></td>
            <td style="color:#fbbf24">★ <?=$f['rating']?></td>
            <td style="font-size:12px;color:var(--muted)"><?=htmlspecialchars($f['area'])?></td>
            <td><?=$f['visible']?'<span class="badge-approved">👁️ Live</span>':'<span class="badge-hidden">🙈 Hidden</span>'?></td>
            <td><div style="display:flex;gap:6px">
              <a href="?edit=<?=$f['id']?>" class="btn-edit">✏️</a>
              <form method="POST" style="display:inline" onsubmit="return confirm('Toggle?')">
                <input type="hidden" name="act" value="toggle"><input type="hidden" name="id" value="<?=$f['id']?>">
                <button class="btn-sm" type="submit"><?=$f['visible']?'🙈':'👁️'?></button>
              </form>
              <form method="POST" style="display:inline" onsubmit="return confirm('Delete?')">
                <input type="hidden" name="act" value="delete"><input type="hidden" name="id" value="<?=$f['id']?>">
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
