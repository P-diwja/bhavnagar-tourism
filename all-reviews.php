<?php
// all-reviews.php — Public page: all approved reviews with photos
require_once 'db.php';

$r = $conn->query(
  "SELECT id, name, rating, message, image_path, created_at
       FROM reviews
      WHERE approved = 1
      ORDER BY created_at DESC"
);
$total = $r ? $r->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>All Reviews – GoTrip Bhavnagar</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0
    }

    :root {
      --accent: #00c2ff;
      --accent2: #ff6b35;
      --bg: #050b14;
      --bg-rgba: rgba(5, 11, 20, 0.92);
      --card: rgba(255, 255, 255, 0.04);
      --card-border: rgba(255, 255, 255, 0.08);
      --text: #e8edf5;
      --muted: #7a8ba0;
      --radius: 18px
    }

    body.light {
      --bg: #f0f4f8;
      --bg-rgba: rgba(240, 244, 248, 0.92);
      --card: rgba(255, 255, 255, 0.85);
      --card-border: rgba(0, 0, 0, 0.07);
      --text: #1a2533;
      --muted: #6b7a8d;
      --accent: #0077cc;
      --accent2: #ff5500
    }

    body.purple {
      --bg: #1a0533;
      --bg-rgba: rgba(26, 5, 51, 0.92);
      --card: rgba(255, 220, 190, 0.06);
      --card-border: rgba(255, 180, 150, 0.15);
      --text: #ffd8c0;
      --muted: #c49a7a;
      --accent: #ff9f5a;
      --accent2: #c062ff
    }

    body.ocean {
      --bg: #001824;
      --bg-rgba: rgba(0, 24, 36, 0.92);
      --card: rgba(0, 180, 160, 0.07);
      --card-border: rgba(0, 200, 180, 0.15);
      --text: #b8f0e8;
      --muted: #5a8a80;
      --accent: #00e5cc;
      --accent2: #ff7b54
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      ...
    }

    .top-bar {
      padding: 10px;
      background: var(--bg-rgba);
      border-bottom: 1px solid var(--card-border);
      backdrop-filter: blur(20px);
      ...
    }

    .logo {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      font-weight: 900;
      color: var(--accent);
      text-decoration: none
    }

    .logo span {
      color: var(--text)
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: var(--muted);
      font-size: 13px;
      font-weight: 700;
      text-decoration: none;
      padding: 8px 18px;
      border-radius: 20px;
      border: 1px solid var(--card-border);
      transition: all .2s
    }

    .back-link:hover {
      color: var(--accent);
      border-color: var(--accent)
    }

    .page-header {
      text-align: center;
      padding: 56px 20px 36px
    }

    .page-title {
      font-family: 'Playfair Display', serif;
      font-size: 36px;
      font-weight: 900;
      margin-bottom: 10px
    }

    .page-sub {
      font-size: 15px;
      color: var(--muted)
    }

    .divider {
      width: 60px;
      height: 3px;
      background: linear-gradient(90deg, var(--accent), var(--accent2));
      border-radius: 2px;
      margin: 16px auto 0
    }

    .container {
      max-width: 1160px;
      margin: 0 auto;
      padding: 0 24px
    }

    .reviews-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px
    }

    .review-card {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: var(--radius);
      padding: 22px 22px 20px;
      transition: transform .22s, box-shadow .22s;
      animation: fadeUp .3s ease
    }

    .review-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 14px 40px rgba(0, 0, 0, .28)
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(12px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    .card-top {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px
    }

    .avatar {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      font-weight: 900;
      color: #fff;
      flex-shrink: 0
    }

    .reviewer-name {
      font-weight: 800;
      font-size: 15px;
      color: var(--text)
    }

    .reviewer-date {
      font-size: 11px;
      color: var(--muted);
      margin-top: 2px
    }

    .stars {
      font-size: 14px;
      margin-left: auto;
      color: #fbbf24
    }

    .review-body {
      font-size: 13.5px;
      color: var(--muted);
      line-height: 1.75
    }

    .photo-wrap {
      margin-top: 14px;
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid var(--card-border)
    }

    .photo {
      width: 100%;
      height: 180px;
      object-fit: cover;
      display: block;
      cursor: zoom-in;
      transition: transform .3s
    }

    .photo:hover {
      transform: scale(1.03)
    }

    .empty {
      text-align: center;
      padding: 80px 20px;
      color: var(--muted)
    }

    #lightbox {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .88);
      z-index: 9999;
      align-items: center;
      justify-content: center;
      padding: 20px;
      cursor: zoom-out;
      backdrop-filter: blur(6px)
    }

    #lightbox.open {
      display: flex
    }

    #lightbox img {
      max-width: 90vw;
      max-height: 88vh;
      border-radius: 14px;
      box-shadow: 0 24px 80px rgba(0, 0, 0, .7);
      cursor: default;
      animation: fadeUp .25s ease
    }

    #lb-close {
      position: fixed;
      top: 18px;
      right: 22px;
      background: rgba(255, 255, 255, .1);
      border: 1px solid rgba(255, 255, 255, .15);
      color: #fff;
      font-size: 20px;
      width: 42px;
      height: 42px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background .2s
    }

    #lb-close:hover {
      background: rgba(255, 255, 255, .2)
    }

    @media(max-width:600px) {
      .top-bar {
        padding: 14px 16px
      }

      .page-title {
        font-size: 26px
      }

      .reviews-grid {
        grid-template-columns: 1fr
      }
    }
  </style>
</head>

<body>

  <div class="top-bar">
    <a href="index.php" class="logo">GoTrip <span>Bhavnagar</span></a>
    <a href="index.php" class="back-link">← Back to Site</a>
  </div>

  <div class="page-header">
    <h1 class="page-title">💬 Traveller Reviews</h1>
    <p class="page-sub"><?= $total ?> verified experience<?= $total !== 1 ? 's' : '' ?> from real visitors</p>
    <div class="divider"></div>
  </div>

  <div id="lightbox" onclick="closeLb()">
    <button id="lb-close" onclick="closeLb()">✕</button>
    <img id="lb-img" src="" alt="Review photo" onclick="event.stopPropagation()">
  </div>

  <div class="container">
    <?php if ($r && $r->num_rows > 0): ?>
      <div class="reviews-grid">
        <?php while ($rv = $r->fetch_assoc()):
          $initial = strtoupper(mb_substr($rv['name'], 0, 1));
          $filled  = str_repeat('★', (int)$rv['rating']);
          $empty   = str_repeat('★', 5 - (int)$rv['rating']);
          $date    = date('d M Y', strtotime($rv['created_at']));
        ?>
          <div class="review-card">
            <div class="card-top">
              <div class="avatar"><?= htmlspecialchars($initial) ?></div>
              <div>
                <div class="reviewer-name"><?= htmlspecialchars($rv['name']) ?></div>
                <div class="reviewer-date">📅 <?= $date ?></div>
              </div>
              <div class="stars"><?= $filled ?><span style="opacity:.2"><?= $empty ?></span></div>
            </div>
            <p class="review-body"><?= htmlspecialchars($rv['message']) ?></p>
            <?php if (!empty($rv['image_path'])): ?>
              <div class="photo-wrap">
                <img class="photo"
                  src="<?= htmlspecialchars($rv['image_path']) ?>"
                  alt="Photo by <?= htmlspecialchars($rv['name']) ?>"
                  onclick="openLb('<?= htmlspecialchars($rv['image_path'], ENT_QUOTES) ?>')"
                  onerror="this.parentElement.style.display='none'"
                  loading="lazy">
              </div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="empty">
        <div style="font-size:48px;margin-bottom:16px">💬</div>
        <strong style="font-size:18px;color:var(--text)">No reviews yet</strong>
        <p style="margin-top:10px">Be the first to share your Bhavnagar experience!</p>
        <a href="index.php" style="display:inline-block;margin-top:22px;padding:13px 30px;border-radius:30px;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-weight:800;text-decoration:none">← Write a Review</a>
      </div>
    <?php endif; ?>
  </div>

  <script>
    // ── THEME PERSISTENCE: read cookie set by index.php ──────────
    (function() {
      try {
        var m = document.cookie.match(/(?:^|;\s*)gotrip_theme=([^;]+)/);
        if (m && m[1] && m[1] !== 'dark') {
          document.body.classList.add(decodeURIComponent(m[1]));
        }
      } catch (e) {}
    })();
    // ─────────────────────────────────────────────────────────────

    function openLb(src) {
      document.getElementById('lb-img').src = src;
      document.getElementById('lightbox').classList.add('open');
      document.body.style.overflow = 'hidden'
    }

    function closeLb() {
      document.getElementById('lightbox').classList.remove('open');
      document.getElementById('lb-img').src = '';
      document.body.style.overflow = ''
    }
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') closeLb()
    });
  </script>
</body>

</html>