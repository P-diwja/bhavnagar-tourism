<?php
require_once 'auth_check.php';
require_once '../db.php';
$flash=''; $flash_type='success';

// ── HANDLE ACTIONS ──────────────────────────────────────────
if($_SERVER['REQUEST_METHOD']==='POST'){
  $act = $_POST['act']??'';

  if($act==='save'){
    $id   = intval($_POST['id']??0);
    $fields=['name','cat','rating','distance','open_hrs','lat','lng','entry','tips','img','descr'];
    $parts=[];
    foreach($fields as $f){
      $val=$conn->real_escape_string(trim($_POST[$f]??''));
      $parts[]="$f='$val'";
    }
    $vis = isset($_POST['visible'])?1:0; $parts[]="visible=$vis";
    if($id>0){
      $conn->query("UPDATE places SET ".implode(',',$parts)." WHERE id=$id");
      $flash='✅ Place updated successfully.';
    } else {
      $conn->query("INSERT INTO places SET ".implode(',',$parts));
      $flash='✅ New place added successfully.';
    }
  }
  if($act==='delete'){
    $id=intval($_POST['id']??0);
    $conn->query("DELETE FROM places WHERE id=$id");
    $flash='🗑️ Place deleted.'; $flash_type='error';
  }
  if($act==='toggle'){
    $id=intval($_POST['id']??0);
    $conn->query("UPDATE places SET visible=1-visible WHERE id=$id");
    $flash='👁️ Visibility toggled.';
  }
}

// ── LOAD DATA ────────────────────────────────────────────────
$edit=null;
if(isset($_GET['edit'])){
  $id=intval($_GET['edit']);
  $r=$conn->query("SELECT * FROM places WHERE id=$id");
  $edit=$r?$r->fetch_assoc():null;
}
$places=$conn->query("SELECT * FROM places ORDER BY id");
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Places – GoTrip Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style><?php include 'admin_styles.css.php'; ?></style>
</head><body>
<?php include 'sidebar.php'; ?>
<div class="main">
  <div class="top-bar">
    <div>
      <h1 class="page-title">🏛️ Tourist Places</h1>
      <p class="page-sub">Add, edit or hide places — changes reflect on the live site instantly</p>
    </div>
    <a href="places.php?action=add" class="btn-primary">➕ Add New Place</a>
  </div>

  <?php if($flash): ?><div class="flash <?= $flash_type ?>"><?= $flash ?></div><?php endif; ?>

  <!-- ADD / EDIT FORM -->
  <?php if(isset($_GET['action']) && $_GET['action']==='add' || $edit): ?>
  <div class="section-card" style="margin-bottom:24px">
    <h2 class="section-card-title" style="margin-bottom:20px"><?= $edit?'✏️ Edit Place':'➕ Add New Place' ?></h2>
    <form method="POST">
      <input type="hidden" name="act" value="save">
      <input type="hidden" name="id" value="<?= $edit?$edit['id']:0 ?>">
      <div class="form-grid">
        <div class="form-group"><label class="form-label">Place Name *</label>
          <input class="form-input" name="name" required placeholder="e.g. Takhteshwar Temple" value="<?= htmlspecialchars($edit['name']??'') ?>"></div>
        <div class="form-group"><label class="form-label">Category</label>
          <select class="form-select" name="cat">
            <?php foreach(['Spiritual','Nature','History','Heritage','Beach','Industrial','Adventure','Culture','Spiritual & Nature'] as $c): ?>
            <option value="<?=$c?>" <?= ($edit['cat']??'')===$c?'selected':'' ?>><?=$c?></option>
            <?php endforeach; ?>
          </select></div>
        <div class="form-group"><label class="form-label">Rating (0–5)</label>
          <input class="form-input" name="rating" type="number" step="0.1" min="0" max="5" placeholder="4.5" value="<?= $edit['rating']??'' ?>"></div>
        <div class="form-group"><label class="form-label">Distance</label>
          <input class="form-input" name="distance" placeholder="e.g. 3 km" value="<?= htmlspecialchars($edit['distance']??'') ?>"></div>
        <div class="form-group"><label class="form-label">Opening Hours</label>
          <input class="form-input" name="open_hrs" placeholder="e.g. 6 AM – 9 PM" value="<?= htmlspecialchars($edit['open_hrs']??'') ?>"></div>
        <div class="form-group"><label class="form-label">Entry Fee</label>
          <input class="form-input" name="entry" placeholder="e.g. Free or Rs.50" value="<?= htmlspecialchars($edit['entry']??'') ?>"></div>
        <div class="form-group"><label class="form-label">Latitude</label>
          <input class="form-input" name="lat" type="number" step="any" placeholder="21.7645" value="<?= $edit['lat']??'' ?>"></div>
        <div class="form-group"><label class="form-label">Longitude</label>
          <input class="form-input" name="lng" type="number" step="any" placeholder="72.1069" value="<?= $edit['lng']??'' ?>"></div>
        <div class="form-group full"><label class="form-label">Image URL</label>
          <input class="form-input" name="img" placeholder="https://…" value="<?= htmlspecialchars($edit['img']??'') ?>"></div>
        <div class="form-group full"><label class="form-label">Tips for Visitors</label>
          <input class="form-input" name="tips" placeholder="Helpful tip for visitors" value="<?= htmlspecialchars($edit['tips']??'') ?>"></div>
        <div class="form-group full"><label class="form-label">Description</label>
          <textarea class="form-textarea" name="descr" rows="4" placeholder="Full description of this place…"><?= htmlspecialchars($edit['descr']??'') ?></textarea></div>
        <div class="form-group"><label class="form-label" style="display:flex;align-items:center;gap:8px;cursor:pointer">
          <input type="checkbox" name="visible" value="1" <?= ($edit['visible']??1)?'checked':'' ?>> Visible on website</label></div>
      </div>
      <div class="form-actions">
        <button class="btn-primary" type="submit"><?= $edit?'💾 Save Changes':'➕ Add Place' ?></button>
        <a href="places.php" class="btn-sm">Cancel</a>
      </div>
    </form>
  </div>
  <?php endif; ?>

  <!-- TABLE -->
  <div class="section-card">
    <div class="section-card-header">
      <h2 class="section-card-title">All Places (<?= $places->num_rows ?>)</h2>
    </div>
    <div class="table-wrap">
      <table class="data-table">
        <thead><tr><th>Name</th><th>Category</th><th>Rating</th><th>Distance</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
          <?php while($p=$places->fetch_assoc()): ?>
          <tr>
            <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
            <td><?= htmlspecialchars($p['cat']) ?></td>
            <td style="color:#fbbf24">★ <?= $p['rating'] ?></td>
            <td><?= htmlspecialchars($p['distance']) ?></td>
            <td><?= $p['visible'] ? '<span class="badge-approved">👁️ Live</span>' : '<span class="badge-hidden">🙈 Hidden</span>' ?></td>
            <td>
              <div style="display:flex;gap:6px">
                <a href="?edit=<?= $p['id'] ?>" class="btn-edit">✏️ Edit</a>
                <form method="POST" style="display:inline" onsubmit="return confirm('Toggle visibility?')">
                  <input type="hidden" name="act" value="toggle"><input type="hidden" name="id" value="<?= $p['id'] ?>">
                  <button class="btn-sm" type="submit"><?= $p['visible']?'🙈 Hide':'👁️ Show' ?></button>
                </form>
                <form method="POST" style="display:inline" onsubmit="return confirm('Delete this place? This cannot be undone.')">
                  <input type="hidden" name="act" value="delete"><input type="hidden" name="id" value="<?= $p['id'] ?>">
                  <button class="btn-danger" type="submit">🗑️</button>
                </form>
              </div>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body></html>
