<?php
require_once 'auth_check.php';
require_once '../db.php';
$places_count  = $conn->query("SELECT COUNT(*) FROM places WHERE visible=1")->fetch_row()[0];
$foods_count   = $conn->query("SELECT COUNT(*) FROM foods  WHERE visible=1")->fetch_row()[0];
$hotels_count  = $conn->query("SELECT COUNT(*) FROM hotels WHERE visible=1")->fetch_row()[0];
$events_count  = $conn->query("SELECT COUNT(*) FROM events WHERE visible=1")->fetch_row()[0];
$reviews_total = $conn->query("SELECT COUNT(*) FROM reviews")->fetch_row()[0];
$reviews_pend  = $conn->query("SELECT COUNT(*) FROM reviews WHERE approved=0")->fetch_row()[0];
$recent_reviews= $conn->query("SELECT * FROM reviews ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dashboard – GoTrip Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
<?php include 'admin_styles.css.php'; ?>
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="main">
  <div class="top-bar">
    <div>
      <h1 class="page-title">📊 Dashboard</h1>
      <p class="page-sub">Welcome back, <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong> — here's your GoTrip overview</p>
    </div>
    <a href="../index.php" class="btn-view-site" target="_blank">👁️ View Live Site</a>
  </div>

  <!-- STAT CARDS -->
  <div class="stats-grid">
    <div class="stat-card" onclick="window.location='places.php'" style="cursor:pointer">
      <div class="stat-icon">🏛️</div>
      <div class="stat-val"><?= $places_count ?></div>
      <div class="stat-lbl">Tourist Places</div>
    </div>
    <div class="stat-card" onclick="window.location='foods.php'" style="cursor:pointer">
      <div class="stat-icon">🍽️</div>
      <div class="stat-val"><?= $foods_count ?></div>
      <div class="stat-lbl">Food Spots</div>
    </div>
    <div class="stat-card" onclick="window.location='hotels.php'" style="cursor:pointer">
      <div class="stat-icon">🏨</div>
      <div class="stat-val"><?= $hotels_count ?></div>
      <div class="stat-lbl">Hotels & Stays</div>
    </div>
    <div class="stat-card" onclick="window.location='events.php'" style="cursor:pointer">
      <div class="stat-icon">🎊</div>
      <div class="stat-val"><?= $events_count ?></div>
      <div class="stat-lbl">Events</div>
    </div>
    <div class="stat-card" onclick="window.location='reviews.php'" style="cursor:pointer;<?= $reviews_pend>0 ? 'border-color:rgba(255,107,53,0.5)' : '' ?>">
      <div class="stat-icon">💬</div>
      <div class="stat-val"><?= $reviews_total ?></div>
      <div class="stat-lbl">Total Reviews</div>
      <?php if($reviews_pend>0): ?>
        <div class="stat-badge"><?= $reviews_pend ?> pending</div>
      <?php endif; ?>
    </div>
  </div>

  <!-- RECENT REVIEWS TABLE -->
  <div class="section-card">
    <div class="section-card-header">
      <h2 class="section-card-title">🕐 Recent Reviews</h2>
      <a href="reviews.php" class="btn-sm">Manage All →</a>
    </div>
    <div class="table-wrap">
      <table class="data-table">
        <thead><tr><th>Name</th><th>Rating</th><th>Message</th><th>Status</th><th>Date</th></tr></thead>
        <tbody>
          <?php while($rv=$recent_reviews->fetch_assoc()): ?>
          <tr>
            <td><strong><?= htmlspecialchars($rv['name']) ?></strong></td>
            <td><?= str_repeat('★',$rv['rating']) ?><span style="opacity:.25"><?= str_repeat('★',5-$rv['rating']) ?></span></td>
            <td style="max-width:280px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars(substr($rv['message'],0,80)) ?>…</td>
            <td><?= $rv['approved'] ? '<span class="badge-approved">✅ Live</span>' : '<span class="badge-pending">⏳ Pending</span>' ?></td>
            <td style="color:var(--muted);font-size:12px"><?= date('d M Y', strtotime($rv['created_at'])) ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- QUICK ACTIONS -->
  <div class="section-card">
    <h2 class="section-card-title" style="margin-bottom:16px">⚡ Quick Actions</h2>
    <div class="quick-actions">
      <a href="places.php?action=add" class="qa-btn">➕ Add Place</a>
      <a href="events.php?action=add" class="qa-btn">➕ Add Event</a>
      <a href="foods.php?action=add"  class="qa-btn">➕ Add Food Spot</a>
      <a href="hotels.php?action=add" class="qa-btn">➕ Add Hotel</a>
      <a href="reviews.php?filter=pending" class="qa-btn qa-btn-orange">💬 Review Approvals (<?= $reviews_pend ?>)</a>
    </div>
  </div>
</div>
</body>
</html>
