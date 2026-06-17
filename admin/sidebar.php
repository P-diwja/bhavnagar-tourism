<?php
$current = basename($_SERVER['PHP_SELF']);
require_once '../db.php';
$pending = $conn->query("SELECT COUNT(*) FROM reviews WHERE approved=0")->fetch_row()[0];
function nav($file,$icon,$label,$cur,$badge=0){
  $active = $cur===$file ? ' active' : '';
  $b = $badge>0 ? "<span class='nav-badge'>$badge</span>" : '';
  echo "<a href='$file' class='nav-link$active'><span class='nav-icon'>$icon</span><span>$label</span>$b</a>";
}
?>
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="sidebar-logo-text">GoTrip <span>Bhavnagar</span></div>
    <div class="sidebar-badge">Admin Panel</div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section">Overview</div>
    <?php nav('dashboard.php','📊','Dashboard',$current) ?>

    <div class="nav-section">Content</div>
    <?php nav('places.php','🏛️','Places',$current) ?>
    <?php nav('nearby.php','🗺️','Nearby Destinations',$current) ?>
    <?php nav('foods.php','🍽️','Food Spots',$current) ?>
    <?php nav('hotels.php','🏨','Hotels',$current) ?>
    <?php nav('events.php','🎊','Events',$current) ?>

    <div class="nav-section">Community</div>
    <?php nav('reviews.php','💬','Reviews',$current,$pending) ?>
  </nav>
  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="user-avatar"><?= strtoupper(substr($_SESSION['admin_username'],0,1)) ?></div>
      <div><div class="user-name"><?= htmlspecialchars($_SESSION['admin_username']) ?></div><div class="user-role">Administrator</div></div>
    </div>
    <a href="logout.php" class="btn-logout">🚪 <span>Logout</span></a>
  </div>
</aside>
