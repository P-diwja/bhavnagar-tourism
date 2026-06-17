<?php
// admin/reviews.php — Manage reviews: approve / hide / delete (+ remove image)
require_once 'auth_check.php';
require_once '../db.php';

$flash = '';
$flash_type = 'success';

// ── POST ACTIONS ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $act = trim($_POST['act'] ?? '');
    $id  = intval($_POST['id'] ?? 0);

    if ($id > 0) {
        if ($act === 'approve') {
            $stmt = $conn->prepare("UPDATE reviews SET approved = 1 WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
            $flash = '✅ Review approved and is now live.';

        } elseif ($act === 'reject') {
            $stmt = $conn->prepare("UPDATE reviews SET approved = 0 WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
            $flash = '⏳ Review hidden from public.';
            $flash_type = 'error';

        } elseif ($act === 'delete') {
            // Fetch image_path before deleting so we can remove the file
            $stmt = $conn->prepare("SELECT image_path FROM reviews WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row    = $result->fetch_assoc();
            $stmt->close();

            // Delete the image file from disk if one exists
            if (!empty($row['image_path'])) {
                $filePath = dirname(__DIR__) . '/' . ltrim($row['image_path'], '/');
                if (is_file($filePath)) {
                    @unlink($filePath);
                }
            }

            // Delete the review record
            $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
            $flash = '🗑️ Review and image permanently deleted.';
            $flash_type = 'error';
        }
    }
}

// ── FETCH FOR DISPLAY ─────────────────────────────────────────────────────────
$filter = $_GET['filter'] ?? 'all';
if ($filter === 'pending') {
    $where = 'WHERE approved = 0';
} elseif ($filter === 'approved') {
    $where = 'WHERE approved = 1';
} else {
    $where = '';
}

$reviews = $conn->query("SELECT * FROM reviews $where ORDER BY created_at DESC");
$total   = $conn->query("SELECT COUNT(*) FROM reviews")->fetch_row()[0];
$pend    = $conn->query("SELECT COUNT(*) FROM reviews WHERE approved = 0")->fetch_row()[0];
$live    = $conn->query("SELECT COUNT(*) FROM reviews WHERE approved = 1")->fetch_row()[0];
$hasImg  = $conn->query("SELECT COUNT(*) FROM reviews WHERE image_path IS NOT NULL AND image_path != ''")->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reviews – GoTrip Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  <?php include 'admin_styles.css.php'; ?>

  /* ── Review image thumbnail ── */
  .review-thumb-wrap {
    margin-top: 10px;
  }
  .review-thumb {
    width: 100%;
    max-width: 220px;
    height: 110px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.08);
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    display: block;
  }
  .review-thumb:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 24px rgba(0,0,0,0.4);
  }
  .has-img-badge {
    display: inline-block;
    background: rgba(0,194,255,0.12);
    border: 1px solid rgba(0,194,255,0.25);
    color: #00c2ff;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.5px;
    padding: 2px 8px;
    border-radius: 20px;
    margin-top: 4px;
  }

  /* ── Lightbox overlay ── */
  #lightbox {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.88);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
    cursor: zoom-out;
    backdrop-filter: blur(6px);
  }
  #lightbox.open { display: flex; }
  #lightbox img {
    max-width: 90vw;
    max-height: 88vh;
    border-radius: 14px;
    box-shadow: 0 24px 80px rgba(0,0,0,0.7);
    animation: fadeUp .25s ease;
    cursor: default;
  }
  #lightbox-close {
    position: fixed;
    top: 18px;
    right: 22px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff;
    font-size: 22px;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
  }
  #lightbox-close:hover { background: rgba(255,255,255,0.2); }
</style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<!-- Lightbox for full-size image preview -->
<div id="lightbox" onclick="closeLightbox()">
  <button id="lightbox-close" onclick="closeLightbox()" title="Close">✕</button>
  <img id="lightbox-img" src="" alt="Review photo" onclick="event.stopPropagation()">
</div>

<div class="main">
  <div class="top-bar">
    <div>
      <h1 class="page-title">💬 Reviews</h1>
      <p class="page-sub">Verify, approve, hide or permanently delete visitor reviews</p>
    </div>
  </div>

  <?php if ($flash): ?>
  <div class="flash <?= $flash_type ?>"><?= htmlspecialchars($flash) ?></div>
  <?php endif; ?>

  <!-- ── STATS ─────────────────────────────────────────────────── -->
  <div class="stats-grid" style="grid-template-columns:repeat(4,1fr);max-width:600px;margin-bottom:20px">
    <div class="stat-card">
      <div class="stat-val"><?= $total ?></div>
      <div class="stat-lbl">Total</div>
    </div>
    <div class="stat-card">
      <div class="stat-val" style="color:#22c55e"><?= $live ?></div>
      <div class="stat-lbl">Live</div>
    </div>
    <div class="stat-card" style="<?= $pend > 0 ? 'border-color:rgba(255,107,53,.5)' : '' ?>">
      <div class="stat-val" style="color:var(--accent2)"><?= $pend ?></div>
      <div class="stat-lbl">Pending</div>
    </div>
    <div class="stat-card">
      <div class="stat-val" style="color:var(--accent)"><?= $hasImg ?></div>
      <div class="stat-lbl">With Photo</div>
    </div>
  </div>

  <!-- ── FILTERS ────────────────────────────────────────────────── -->
  <div class="filter-bar" style="margin-bottom:20px">
    <a href="?filter=all"      class="filter-chip <?= $filter === 'all'      ? 'active' : '' ?>">All (<?= $total ?>)</a>
    <a href="?filter=pending"  class="filter-chip <?= $filter === 'pending'  ? 'active' : '' ?>">⏳ Pending (<?= $pend ?>)</a>
    <a href="?filter=approved" class="filter-chip <?= $filter === 'approved' ? 'active' : '' ?>">✅ Live (<?= $live ?>)</a>
  </div>

  <!-- ── TABLE ──────────────────────────────────────────────────── -->
  <div class="section-card">
    <div class="table-wrap">
      <table class="data-table">
        <thead>
          <tr>
            <th>Reviewer</th>
            <th>Rating</th>
            <th>Review</th>
            <th>Photo</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

          <?php if ($reviews->num_rows === 0): ?>
          <tr>
            <td colspan="7" style="text-align:center;padding:48px;color:var(--muted)">
              <div style="font-size:32px;margin-bottom:10px">💬</div>
              No reviews found for this filter.
            </td>
          </tr>
          <?php endif; ?>

          <?php while ($rv = $reviews->fetch_assoc()): ?>
          <tr>

            <!-- Reviewer name + avatar initial -->
            <td>
              <div style="display:flex;align-items:center;gap:10px">
                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-weight:900;color:#fff;font-size:14px;flex-shrink:0">
                  <?= strtoupper(mb_substr($rv['name'], 0, 1)) ?>
                </div>
                <strong><?= htmlspecialchars($rv['name']) ?></strong>
              </div>
            </td>

            <!-- Star rating -->
            <td style="color:#fbbf24;white-space:nowrap;font-size:15px">
              <?= str_repeat('★', (int)$rv['rating']) ?>
              <span style="opacity:.2"><?= str_repeat('★', 5 - (int)$rv['rating']) ?></span>
              <div style="font-size:11px;color:var(--muted);margin-top:2px"><?= $rv['rating'] ?>/5</div>
            </td>

            <!-- Review text (truncated) -->
            <td style="max-width:280px">
              <div style="max-height:56px;overflow:hidden;color:var(--muted);font-size:13px;line-height:1.65">
                <?= htmlspecialchars($rv['message']) ?>
              </div>
            </td>

            <!-- Photo thumbnail / lightbox -->
            <td style="min-width:130px">
              <?php if (!empty($rv['image_path'])): ?>
                <div class="review-thumb-wrap">
                  <img
                    class="review-thumb"
                    src="../<?= htmlspecialchars($rv['image_path']) ?>"
                    alt="Review photo by <?= htmlspecialchars($rv['name']) ?>"
                    onclick="openLightbox('<?= htmlspecialchars('../' . $rv['image_path'], ENT_QUOTES) ?>')"
                    onerror="this.style.display='none'"
                  >
                  <span class="has-img-badge">📷 has photo</span>
                </div>
              <?php else: ?>
                <span style="color:var(--muted);font-size:12px">—</span>
              <?php endif; ?>
            </td>

            <!-- Status badge -->
            <td>
              <?php if ($rv['approved']): ?>
                <span class="badge-approved">✅ Live</span>
              <?php else: ?>
                <span class="badge-pending">⏳ Pending</span>
              <?php endif; ?>
            </td>

            <!-- Date -->
            <td style="color:var(--muted);font-size:12px;white-space:nowrap">
              <?= date('d M Y', strtotime($rv['created_at'])) ?>
              <div style="color:var(--muted);font-size:11px;opacity:0.6">
                <?= date('h:i A', strtotime($rv['created_at'])) ?>
              </div>
            </td>

            <!-- Action buttons -->
            <td>
              <div style="display:flex;gap:6px;flex-wrap:wrap;align-items:center">

                <!-- APPROVE (only when pending) -->
                <?php if (!$rv['approved']): ?>
                <form method="POST" style="display:inline">
                  <input type="hidden" name="act" value="approve">
                  <input type="hidden" name="id"  value="<?= $rv['id'] ?>">
                  <button class="btn-success" type="submit" title="Approve — makes review live">
                    ✅ Approve
                  </button>
                </form>
                <?php else: ?>
                <!-- HIDE (only when live) -->
                <form method="POST" style="display:inline"
                      onsubmit="return confirm('Hide this review from the public?')">
                  <input type="hidden" name="act" value="reject">
                  <input type="hidden" name="id"  value="<?= $rv['id'] ?>">
                  <button class="btn-sm" type="submit" title="Hide from public">🙈 Hide</button>
                </form>
                <?php endif; ?>

                <!-- DELETE (always available — also removes image file) -->
                <form method="POST" style="display:inline"
                      onsubmit="return confirm('Permanently delete this review<?= !empty($rv['image_path']) ? ' AND its uploaded photo' : '' ?>?\n\nThis cannot be undone.')">
                  <input type="hidden" name="act" value="delete">
                  <input type="hidden" name="id"  value="<?= $rv['id'] ?>">
                  <button class="btn-danger" type="submit"
                    title="Delete review<?= !empty($rv['image_path']) ? ' + remove photo from server' : '' ?>">
                    🗑️<?= !empty($rv['image_path']) ? ' +🖼️' : '' ?>
                  </button>
                </form>

              </div>
            </td>

          </tr>
          <?php endwhile; ?>

        </tbody>
      </table>
    </div><!-- /table-wrap -->
  </div><!-- /section-card -->

</div><!-- /main -->

<!-- Lightbox JS -->
<script>
  function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.getElementById('lightbox-img').src = '';
    document.body.style.overflow = '';
  }
  // ESC key closes lightbox
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>

</body>
</html>
