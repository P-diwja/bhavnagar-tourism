<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GoTrip Bhavnagar – AI Smart Tourism</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
  <style>
    /* ── RESET & ROOT ── */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --bg: #050b14;
      --card: rgba(255, 255, 255, 0.04);
      --card-border: rgba(255, 255, 255, 0.08);
      --text: #e8edf5;
      --muted: #7a8ba0;
      --accent: #00c2ff;
      --accent2: #ff6b35;
      --hero-grad: linear-gradient(160deg, #0a1628, #050b14 60%, #0d1f3c);
      --glass: rgba(10, 22, 40, 0.85);
      --radius: 20px;
      --modal-bg: #050b14;
      --modal-text: #ffffff;
      --modal-text-muted: rgba(255, 255, 255, 0.55);
      --modal-tile-bg: rgba(255, 255, 255, 0.05);
      --modal-tile-lbl: rgba(255, 255, 255, 0.3);
      --modal-tile-val: #ffffff;
      --modal-border: rgba(255, 255, 255, 0.07);
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      overflow-x: hidden;
    }

    ::-webkit-scrollbar {
      width: 5px;
    }

    ::-webkit-scrollbar-thumb {
      background: rgba(0, 194, 255, 0.22);
      border-radius: 4px;
    }

    a {
      text-decoration: none;
    }

    button {
      font-family: inherit;
    }

    /* ── THEMES ── */
    body.light {
      --bg: #f0f4f8;
      --card: rgba(255, 255, 255, 0.85);
      --card-border: rgba(0, 0, 0, 0.07);
      --text: #1a2533;
      --muted: #6b7a8d;
      --accent: #0077cc;
      --accent2: #ff5500;
      --hero-grad: linear-gradient(160deg, #dbeafe, #f0f4f8 60%, #e0f2fe);
      --glass: rgba(240, 244, 248, 0.92);
      --modal-bg: #ffffff;
      --modal-text: #1a2533;
      --modal-text-muted: #6b7a8d;
      --modal-tile-bg: rgba(0, 0, 0, 0.04);
      --modal-tile-lbl: #8a9ab0;
      --modal-tile-val: #1a2533;
      --modal-border: rgba(0, 0, 0, 0.08);
    }

    body.purple {
      --bg: #1a0533;
      --card: rgba(255, 220, 190, 0.06);
      --card-border: rgba(255, 180, 150, 0.15);
      --text: #ffd8c0;
      --muted: #c49a7a;
      --accent: #ff9f5a;
      --accent2: #c062ff;
      --hero-grad: linear-gradient(160deg, #280a4a, #1a0533 60%, #3d0a60);
      --glass: rgba(26, 5, 51, 0.88);
      --modal-bg: #1a0533;
      --modal-text: #ffd8c0;
      --modal-text-muted: rgba(255, 216, 192, 0.55);
      --modal-tile-bg: rgba(255, 220, 190, 0.07);
      --modal-tile-lbl: rgba(255, 216, 192, 0.4);
      --modal-tile-val: #ffd8c0;
      --modal-border: rgba(255, 180, 150, 0.15);
    }

    body.ocean {
      --bg: #001824;
      --card: rgba(0, 180, 160, 0.07);
      --card-border: rgba(0, 200, 180, 0.15);
      --text: #b8f0e8;
      --muted: #5a8a80;
      --accent: #00e5cc;
      --accent2: #ff7b54;
      --hero-grad: linear-gradient(160deg, #003040, #001824 60%, #004050);
      --glass: rgba(0, 24, 36, 0.88);
      --modal-bg: #001824;
      --modal-text: #b8f0e8;
      --modal-text-muted: rgba(184, 240, 232, 0.55);
      --modal-tile-bg: rgba(0, 180, 160, 0.08);
      --modal-tile-lbl: rgba(184, 240, 232, 0.4);
      --modal-tile-val: #b8f0e8;
      --modal-border: rgba(0, 200, 180, 0.15);
    }

    /* ── PARTICLES ── */
    #particles {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 0;
      overflow: hidden;
    }

    .pt {
      position: absolute;
      border-radius: 50%;
      background: var(--accent);
      opacity: 0.1;
      animation: floatPt linear infinite;
    }

    @keyframes floatPt {

      0%,
      100% {
        transform: translateY(0);
        opacity: 0.04
      }

      50% {
        transform: translateY(-48px);
        opacity: 0.18
      }
    }

    /* ── NAVBAR ── */
    #navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
      height: 66px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 18px;
      transition: background 0.35s, border 0.35s, backdrop-filter 0.35s;
    }

    #navbar.scrolled {
      background: var(--glass);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--card-border);
    }

    .nav-logo {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      font-weight: 900;
      color: var(--accent);
      cursor: pointer;
    }

    .nav-logo span {
      color: var(--text);
    }

    .nav-tabs {
      display: flex;
      gap: 2px;
      flex-wrap: nowrap;
      overflow: auto;
    }

    .nav-tab {
      padding: 6px 11px;
      border-radius: 9px;
      background: transparent;
      border: none;
      color: var(--muted);
      font-weight: 500;
      cursor: pointer;
      font-size: 13px;
      transition: background 0.2s, color 0.2s;
      white-space: nowrap;
    }

    .nav-tab.active,
    .nav-tab:hover {
      background: rgba(0, 194, 255, 0.12);
      color: var(--accent);
      font-weight: 700;
    }

    .theme-btns {
      display: flex;
      align-items: center;
      gap: 5px;
      flex-shrink: 0;
    }

    .theme-select-mobile {
      display: none;
      flex-shrink: 0;
      background: var(--card);
      border: 1px solid var(--card-border);
      color: var(--text);
      border-radius: 8px;
      padding: 3px 4px;
      font-size: 13px;
      line-height: 1;
      font-family: inherit;
      cursor: pointer;
    }

    /* ── ADMIN NAVBAR BUTTON ── */
    .btn-admin-nav {
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 6px 13px;
      border-radius: 20px;
      background: transparent;
      border: 1.5px solid var(--card-border);
      color: var(--muted);
      font-family: inherit;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      transition: border-color 0.2s, color 0.2s, background 0.2s;
      margin-right: 6px;
      white-space: nowrap;
    }

    .btn-admin-nav:hover {
      border-color: var(--accent);
      color: var(--accent);
      background: rgba(0, 194, 255, 0.06);
    }

    /* ── NAVBAR: MOBILE ── */
    @media (max-width: 640px) {
      #navbar {
        padding: 0 10px;
      }

      .nav-logo {
        font-size: 16px;
      }

      .nav-logo span {
        display: none;
      }

      .nav-tabs {
        flex: 1;
        min-width: 0;
        scrollbar-width: thin;
      }

      .nav-tabs::-webkit-scrollbar {
        height: 3px;
      }

      .nav-tab {
        padding: 6px 9px;
        font-size: 12px;
      }

      .theme-btns {
        display: none;
      }

      .theme-select-mobile {
        display: block;
      }

      .btn-admin-nav {
        padding: 7px 9px;
        margin-right: 2px;
      }

      .btn-admin-nav .admin-label {
        display: none;
      }
    }

    /* ── ADMIN LOGIN MODAL ── */
    #adminModalOverlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.65);
      z-index: 9998;
      align-items: center;
      justify-content: center;
      padding: 20px;
      backdrop-filter: blur(6px);
      animation: fadeIn 0.2s ease;
    }

    #adminModalOverlay.open {
      display: flex;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    #adminModal {
      background: var(--modal-bg, #0d1520);
      border: 1px solid var(--card-border);
      border-radius: 24px;
      padding: 40px 36px 36px;
      width: 100%;
      max-width: 400px;
      position: relative;
      animation: modalUp 0.3s ease;
      box-shadow: 0 24px 80px rgba(0, 0, 0, 0.5);
    }

    @keyframes modalUp {
      from {
        opacity: 0;
        transform: translateY(20px) scale(0.97);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .admin-modal-close {
      position: absolute;
      top: 14px;
      right: 16px;
      background: transparent;
      border: none;
      color: var(--muted);
      font-size: 20px;
      cursor: pointer;
      line-height: 1;
      padding: 4px 8px;
      border-radius: 8px;
      transition: color 0.2s, background 0.2s;
    }

    .admin-modal-close:hover {
      color: var(--text);
      background: var(--card);
    }

    .admin-modal-icon {
      font-size: 40px;
      text-align: center;
      margin-bottom: 12px;
    }

    .admin-modal-title {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      font-weight: 900;
      color: var(--modal-text, var(--text));
      text-align: center;
      margin-bottom: 4px;
    }

    .admin-modal-sub {
      font-size: 12px;
      color: var(--muted);
      text-align: center;
      margin-bottom: 28px;
    }

    .admin-modal-field {
      margin-bottom: 16px;
    }

    .admin-modal-label {
      display: block;
      font-size: 11px;
      font-weight: 800;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 1.2px;
      margin-bottom: 8px;
    }

    .admin-modal-input {
      width: 100%;
      background: var(--review-input-bg, rgba(255, 255, 255, 0.05));
      border: 1px solid var(--card-border);
      border-radius: 12px;
      padding: 12px 15px;
      color: var(--modal-text, var(--text));
      font-family: inherit;
      font-size: 14px;
      font-weight: 500;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      box-sizing: border-box;
    }

    .admin-modal-input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px var(--review-focus-glow, rgba(0, 194, 255, 0.12));
    }

    .admin-modal-input::placeholder {
      color: var(--muted);
    }

    .admin-modal-error {
      display: none;
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #ef4444;
      padding: 10px 14px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 14px;
    }

    .admin-modal-error.show {
      display: block;
    }

    .btn-admin-login {
      width: 100%;
      padding: 14px;
      border-radius: 50px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      font-weight: 800;
      font-size: 15px;
      border: none;
      cursor: pointer;
      font-family: inherit;
      transition: transform 0.2s, opacity 0.2s;
      margin-top: 4px;
    }

    .btn-admin-login:hover {
      transform: scale(1.02);
    }

    .btn-admin-login:disabled {
      opacity: 0.65;
      cursor: not-allowed;
      transform: none;
    }

    .theme-btn {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 11px;
      border: 2px solid var(--card-border);
      transition: transform 0.2s, border-color 0.2s;
    }

    .theme-btn:hover {
      transform: scale(1.15);
    }

    .theme-btn.active {
      border-color: var(--accent);
    }

    /* ── PAGES ── */
    .page {
      display: none;
      animation: fadeUp 0.26s ease;
    }

    .page.active {
      display: block;
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

    /* ── HERO ── */
    #hero {
      min-height: 100vh;
      background: var(--hero-grad);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
      padding: 0 20px;
      background-attachment: fixed;
    }

    .hero-grid {
      position: absolute;
      inset: 0;
      background-image: linear-gradient(rgba(0, 194, 255, 0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 194, 255, 0.04) 1px, transparent 1px);
      background-size: 60px 60px;
      pointer-events: none;
    }

    .hero-orb1 {
      position: absolute;
      width: 460px;
      height: 460px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(0, 194, 255, 0.1), transparent 70%);
      top: -8%;
      left: 8%;
    }

    .hero-orb2 {
      position: absolute;
      width: 360px;
      height: 360px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255, 107, 53, 0.07), transparent 70%);
      bottom: 10%;
      right: 5%;
      animation: pulsate 6s ease-in-out infinite;
    }

    @keyframes pulsate {

      0%,
      100% {
        transform: scale(1)
      }

      50% {
        transform: scale(1.16)
      }
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(0, 194, 255, 0.1);
      border: 1px solid rgba(0, 194, 255, 0.21);
      border-radius: 50px;
      padding: 6px 20px;
      margin-bottom: 24px;
      font-size: 12px;
      color: var(--accent);
      font-weight: 600;
      letter-spacing: 1px;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(40px, 8vw, 86px);
      font-weight: 900;
      line-height: 1.05;
      letter-spacing: -2px;
      color: var(--text);
      margin-bottom: 20px;
      text-align: center;
    }

    .hero-title .highlight {
      position: relative;
      display: inline-block;
      color: var(--accent);
      text-shadow: 0 0 36px rgba(0, 194, 255, 0.28);
    }

    .hero-sub {
      font-size: clamp(14px, 2.3vw, 18px);
      color: var(--muted);
      margin: 0 auto 40px;
      max-width: 540px;
      line-height: 1.7;
      text-align: center;
    }

    .hero-btns {
      display: flex;
      gap: 12px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn-primary {
      padding: 14px 36px;
      border-radius: 50px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      font-weight: 800;
      font-size: 16px;
      border: none;
      cursor: pointer;
      box-shadow: 0 8px 26px rgba(0, 194, 255, 0.22);
      transition: transform 0.2s;
    }

    .btn-primary:hover {
      transform: scale(1.06);
    }

    .btn-outline {
      padding: 14px 36px;
      border-radius: 50px;
      background: transparent;
      color: var(--text);
      font-weight: 700;
      font-size: 16px;
      border: 2px solid var(--card-border);
      cursor: pointer;
      transition: transform 0.2s;
    }

    .btn-outline:hover {
      transform: scale(1.06);
    }

    .hero-intro-strip {
      position: absolute;
      bottom: 44px;
      display: flex;
      gap: 10px;
      z-index: 2;
      flex-wrap: wrap;
      justify-content: center;
      padding: 0 20px;
    }

    .intro-tag {
      background: var(--card);
      border: 1px solid var(--card-border);
      backdrop-filter: blur(8px);
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 700;
      color: var(--muted);
      letter-spacing: 0.5px;
    }

    .hero-arrow {
      position: absolute;
      bottom: 16px;
      font-size: 18px;
      color: var(--muted);
      animation: bounce 1.5s ease-in-out infinite;
    }

    @keyframes bounce {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(8px)
      }
    }

    /* ── SECTION HEADER ── */
    .section-header {
      text-align: center;
      margin-bottom: 44px;
    }

    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(26px, 5vw, 50px);
      font-weight: 900;
      color: var(--text);
    }

    .section-sub {
      font-size: 15px;
      color: var(--muted);
      margin-top: 9px;
    }

    .section-divider {
      width: 56px;
      height: 4px;
      border-radius: 2px;
      background: linear-gradient(90deg, var(--accent), var(--accent2));
      margin: 13px auto 0;
    }

    /* ── CARD ── */
    .card {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: var(--radius);
      backdrop-filter: blur(14px);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .card.hoverable:hover {
      transform: scale(1.02) translateY(-3px);
      box-shadow: 0 12px 36px rgba(0, 0, 0, 0.22);
    }

    /* ── GRID ── */
    .container {
      max-width: 1180px;
      margin: 0 auto;
      padding: 80px 20px 56px;
    }

    .grid-auto {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
      gap: 20px;
    }

    .grid-auto-lg {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 20px;
    }

    .grid-auto-sm {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 16px;
    }

    .grid-auto-nb {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
      gap: 20px;
    }

    /* ── FILTER CHIPS ── */
    .chips {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      margin-bottom: 34px;
      justify-content: center;
    }

    .chip {
      padding: 8px 18px;
      border-radius: 50px;
      border: 1px solid var(--card-border);
      background: transparent;
      color: var(--muted);
      font-weight: 500;
      cursor: pointer;
      font-size: 13px;
      transition: all 0.2s;
      font-family: inherit;
    }

    .chip:hover,
    .chip.active {
      border-color: var(--accent);
      background: rgba(0, 194, 255, 0.12);
      color: var(--accent);
      font-weight: 700;
    }

    /* ── SEARCH BAR ── */
    .search-wrap {
      position: relative;
      margin-bottom: 22px;
    }

    .search-input {
      width: 100%;
      padding: 13px 18px 13px 46px;
      border-radius: 50px;
      border: 1px solid var(--card-border);
      background: var(--card);
      color: var(--text);
      font-family: inherit;
      font-size: 14px;
      font-weight: 500;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      box-sizing: border-box;
    }

    .search-input::placeholder {
      color: var(--muted);
    }

    .search-input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(0, 194, 255, 0.1);
    }

    .search-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 17px;
      pointer-events: none;
      opacity: 0.55;
    }

    .search-clear {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: var(--card-border);
      border: none;
      border-radius: 50%;
      width: 22px;
      height: 22px;
      cursor: pointer;
      font-size: 13px;
      color: var(--muted);
      display: none;
      align-items: center;
      justify-content: center;
      font-family: inherit;
      transition: background 0.2s;
    }

    .search-clear.visible {
      display: flex;
    }

    .search-clear:hover {
      background: var(--accent);
      color: #fff;
    }

    .search-no-results {
      text-align: center;
      padding: 60px 20px;
      color: var(--muted);
      font-size: 15px;
      grid-column: 1 / -1;
    }

    .search-no-results span {
      font-size: 40px;
      display: block;
      margin-bottom: 14px;
    }

    .place-img-wrap {
      position: relative;
      height: 196px;
      overflow: hidden;
      border-radius: var(--radius) var(--radius) 0 0;
    }

    .place-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s;
    }

    .place-img-wrap:hover img {
      transform: scale(1.07);
    }

    .badge {
      position: absolute;
      padding: 3px 11px;
      border-radius: 50px;
      font-size: 11px;
      font-weight: 700;
      color: #fff;
    }

    .badge-cat {
      top: 11px;
      left: 11px;
      background: rgba(0, 194, 255, 0.87);
    }

    .badge-rating {
      top: 11px;
      right: 11px;
      background: rgba(0, 0, 0, 0.6);
      color: #fbbf24;
    }

    .place-body {
      padding: 17px;
    }

    .place-name {
      font-size: 18px;
      font-weight: 800;
      color: var(--text);
      margin-bottom: 6px;
    }

    .place-desc {
      font-size: 13px;
      color: var(--muted);
      line-height: 1.6;
      margin-bottom: 8px;
    }

    .place-tip {
      font-size: 12px;
      color: var(--accent);
      background: rgba(0, 194, 255, 0.06);
      border-radius: 8px;
      padding: 5px 9px;
      margin-bottom: 9px;
    }

    .place-meta {
      font-size: 12px;
      color: var(--muted);
      margin-bottom: 11px;
    }

    .card-btns {
      display: flex;
      gap: 8px;
    }

    .btn-grad {
      flex: 1;
      padding: 9px 0;
      border-radius: 11px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      font-weight: 700;
      font-size: 13px;
      text-align: center;
      border: none;
      cursor: pointer;
      transition: transform 0.2s;
      font-family: inherit;
    }

    .btn-grad:hover {
      transform: scale(1.04);
    }

    .btn-soft {
      flex: 1;
      padding: 9px 0;
      border-radius: 11px;
      background: rgba(255, 107, 53, 0.1);
      border: 1px solid rgba(255, 107, 53, 0.3);
      color: var(--accent2);
      cursor: pointer;
      font-size: 13px;
      font-weight: 700;
      transition: transform 0.2s;
      font-family: inherit;
    }

    .btn-soft:hover {
      transform: scale(1.04);
    }

    /* ── MODAL ── */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.87);
      z-index: 1000;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 14px;
    }

    .modal-overlay.open {
      display: flex;
    }

    .modal-box {
      background: var(--modal-bg, #050b14);
      border-radius: 22px;
      overflow: hidden;
      max-width: 580px;
      width: 100%;
      border: 1px solid var(--card-border);
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 36px 72px rgba(0, 0, 0, 0.7);
      animation: scaleIn 0.25s ease;
    }

    .modal-box.light-modal {
      background: #fff;
    }

    @keyframes scaleIn {
      from {
        transform: scale(0.84) translateY(34px);
        opacity: 0
      }

      to {
        transform: scale(1) translateY(0);
        opacity: 1
      }
    }

    .modal-img {
      position: relative;
      height: 224px;
      flex-shrink: 0;
    }

    .modal-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .modal-img-grad {
      position: absolute;
      inset: 0;
      background: linear-gradient(transparent 28%, rgba(5, 11, 20, 0.97));
    }

    .modal-close {
      position: absolute;
      top: 11px;
      right: 11px;
      background: rgba(0, 0, 0, 0.55);
      border: none;
      color: #fff;
      width: 33px;
      height: 33px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 18px;
    }

    .modal-cat {
      position: absolute;
      top: 11px;
      left: 11px;
      background: rgba(0, 194, 255, 0.8);
      color: #fff;
      padding: 3px 12px;
      border-radius: 50px;
      font-size: 11px;
      font-weight: 700;
    }

    .modal-title-area {
      position: absolute;
      bottom: 13px;
      left: 17px;
    }

    .modal-title-area h2 {
      color: #fff;
      font-size: 22px;
      font-weight: 900;
    }

    .modal-title-area .modal-sub {
      color: rgba(255, 255, 255, 0.52);
      font-size: 12px;
    }

    .modal-tabs {
      display: flex;
      border-bottom: 1px solid var(--modal-border);
    }

    .modal-tab {
      flex: 1;
      padding: 13px;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 14px;
      font-weight: 700;
      color: var(--modal-text-muted);
      border-bottom: 2px solid transparent;
      transition: all 0.2s;
      font-family: inherit;
    }

    .modal-tab.active {
      color: #00c2ff;
      border-bottom-color: #00c2ff;
    }

    .modal-body {
      padding: 20px;
    }

    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
      margin-bottom: 13px;
    }

    .info-tile {
      background: var(--modal-tile-bg);
      border-radius: 11px;
      padding: 9px 12px;
    }

    .info-tile-lbl {
      color: var(--modal-tile-lbl);
      font-size: 10px;
      margin-bottom: 3px;
    }

    .info-tile-val {
      color: var(--modal-tile-val);
      font-weight: 700;
      font-size: 12px;
    }

    .info-tile-val.gold {
      color: #fbbf24;
    }

    .tip-box {
      background: rgba(0, 194, 255, 0.07);
      border: 1px solid rgba(0, 194, 255, 0.18);
      border-radius: 11px;
      padding: 11px 14px;
      margin-bottom: 15px;
    }

    .tip-box-lbl {
      color: #00c2ff;
      font-size: 11px;
      font-weight: 700;
      margin-bottom: 3px;
    }

    .tip-box-txt {
      color: var(--modal-text);
      font-size: 13px;
      opacity: 0.78;
    }

    .modal-actions {
      display: flex;
      gap: 9px;
    }

    .btn-navigate {
      flex: 1;
      padding: 13px;
      border-radius: 13px;
      background: linear-gradient(135deg, #00c2ff, #ff6b35);
      color: #fff;
      font-weight: 800;
      text-align: center;
      font-size: 14px;
      font-family: inherit;
      border: none;
      cursor: pointer;
    }

    .btn-food {
      flex: 1;
      padding: 13px;
      border-radius: 13px;
      background: rgba(255, 107, 53, 0.14);
      border: 1px solid rgba(255, 107, 53, 0.3);
      color: #ff6b35;
      font-weight: 800;
      cursor: pointer;
      font-size: 14px;
      font-family: inherit;
    }

    /* ── FOOD MINI CARD ── */
    .food-mini {
      display: flex;
      gap: 11px;
      margin-bottom: 12px;
      background: var(--modal-tile-bg);
      border-radius: 14px;
      overflow: hidden;
      border: 1px solid var(--modal-border);
    }

    .food-mini-img {
      width: 90px;
      flex-shrink: 0;
      position: relative;
    }

    .food-mini-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .food-mini-badge {
      position: absolute;
      bottom: 4px;
      left: 4px;
      padding: 2px 6px;
      border-radius: 20px;
      font-size: 9px;
      font-weight: 700;
      color: #fff;
    }

    .food-mini-body {
      flex: 1;
      padding: 10px 10px 10px 0;
    }

    .food-mini-name {
      color: var(--modal-text);
      font-weight: 800;
      font-size: 14px;
      margin-bottom: 2px;
    }

    .food-mini-meta {
      color: var(--modal-text-muted);
      font-size: 11px;
      margin-bottom: 8px;
    }

    .food-mini-btns {
      display: flex;
      gap: 6px;
    }

    .fmb {
      padding: 5px 10px;
      border-radius: 8px;
      font-size: 11px;
      font-weight: 700;
      border: none;
      cursor: pointer;
      font-family: inherit;
    }

    .fmb-nav {
      background: linear-gradient(135deg, #00c2ff, #ff6b35);
      color: #fff;
    }

    .fmb-call {
      background: rgba(37, 211, 102, 0.13);
      border: 1px solid rgba(37, 211, 102, 0.28) !important;
      color: #25d366;
    }

    /* ── NEARBY CARD ── */
    .nb-img-wrap {
      position: relative;
      height: 175px;
    }

    .nb-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .nb-grad {
      position: absolute;
      inset: 0;
      background: linear-gradient(transparent 38%, rgba(0, 0, 0, 0.82));
    }

    .nb-info {
      position: absolute;
      bottom: 11px;
      left: 13px;
    }

    .nb-name {
      color: #fff;
      font-weight: 800;
      font-size: 17px;
    }

    .nb-sub {
      color: var(--muted);
      font-size: 12px;
    }

    .nb-body {
      padding: 15px;
    }

    .nb-desc {
      font-size: 13px;
      color: var(--muted);
      line-height: 1.6;
      margin-bottom: 13px;
    }

    .btn-full-grad {
      display: block;
      padding: 9px 0;
      border-radius: 11px;
      text-align: center;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      font-weight: 700;
      font-size: 13px;
      border: none;
      cursor: pointer;
      transition: transform 0.2s;
      font-family: inherit;
    }

    .btn-full-grad:hover {
      transform: scale(1.04);
    }

    .nb-details-btn {
      padding: 7px 16px;
      border-radius: 20px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      font-weight: 700;
      font-size: 12px;
      border: none;
      cursor: pointer;
      font-family: inherit;
      transition: all 0.2s;
      white-space: nowrap;
      flex-shrink: 0;
    }

    .nb-details-btn:hover {
      opacity: 0.85;
      transform: translateX(2px);
    }

    /* ── FOOD SECTION ── */
    /* ── FOOD CARD HEADER (text-only, no images) ── */
    .food-card-header {
      border-radius: var(--radius) var(--radius) 0 0;
      padding: 18px 17px 14px;
      border-bottom: 1px solid var(--card-border);
      position: relative;
    }

    .food-type-pill {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 10px;
      font-weight: 800;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      padding: 3px 10px;
      border-radius: 20px;
      margin-bottom: 8px;
    }

    .food-type-pill.veg {
      background: rgba(34, 197, 94, 0.12);
      color: #22c55e;
      border: 1px solid rgba(34, 197, 94, 0.25);
    }

    .food-type-pill.nonveg {
      background: rgba(239, 68, 68, 0.12);
      color: #ef4444;
      border: 1px solid rgba(239, 68, 68, 0.25);
    }

    .food-cat-tag {
      display: inline-flex;
      align-items: center;
      font-size: 10px;
      font-weight: 700;
      padding: 3px 9px;
      border-radius: 20px;
      margin-left: 5px;
      background: rgba(0, 194, 255, 0.08);
      color: var(--accent);
      border: 1px solid rgba(0, 194, 255, 0.15);
    }

    .food-header-rating {
      position: absolute;
      top: 14px;
      right: 14px;
      font-size: 12px;
      font-weight: 700;
      color: #fbbf24;
    }

    .food-header-budget {
      font-size: 15px;
      font-weight: 900;
      color: var(--text);
      margin-top: 2px;
    }

    .food-body {
      padding: 16px 17px 17px;
    }

    .food-name {
      font-size: 16px;
      font-weight: 800;
      color: var(--text);
      margin-bottom: 5px;
    }

    .food-meta {
      color: var(--muted);
      font-size: 12px;
      margin-bottom: 4px;
    }

    .must-try-chips {
      display: flex;
      gap: 5px;
      flex-wrap: wrap;
      margin-bottom: 12px;
    }

    .mtc {
      padding: 3px 8px;
      border-radius: 20px;
      background: rgba(0, 194, 255, 0.08);
      border: 1px solid rgba(0, 194, 255, 0.15);
      color: var(--accent);
      font-size: 11px;
      font-weight: 600;
    }

    /* ── EVENTS ── */
    .evt-type {
      padding: 3px 11px;
      border-radius: 50px;
      font-size: 12px;
      font-weight: 700;
    }

    .evt-date {
      font-size: 12px;
      color: var(--muted);
    }

    .evt-card-body {
      padding: 21px;
    }

    .evt-name {
      font-size: 17px;
      font-weight: 800;
      color: var(--text);
      margin-bottom: 6px;
    }

    .evt-desc {
      font-size: 13px;
      color: var(--muted);
      line-height: 1.6;
      margin-bottom: 12px;
    }

    .evt-meta {
      display: flex;
      gap: 13px;
      margin-bottom: 13px;
      font-size: 12px;
      color: var(--muted);
    }

    .btn-evt {
      width: 100%;
      padding: 10px;
      border-radius: 10px;
      font-weight: 700;
      cursor: pointer;
      font-size: 14px;
      font-family: inherit;
      transition: transform 0.2s;
    }

    .btn-evt:hover {
      transform: scale(1.03);
    }

    /* ── GUIDES ── */
    .guide-card {
      padding: 21px;
    }

    .guide-head {
      display: flex;
      gap: 13px;
      align-items: center;
      margin-bottom: 15px;
    }

    .guide-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid var(--accent);
    }

    .guide-name {
      font-weight: 800;
      font-size: 16px;
      color: var(--text);
    }

    .guide-rating {
      color: var(--accent);
      font-size: 13px;
    }

    .guide-label {
      font-size: 11px;
      color: var(--muted);
      margin-bottom: 3px;
    }

    .guide-spec {
      color: var(--text);
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 11px;
    }

    .lang-chips {
      display: flex;
      gap: 5px;
      flex-wrap: wrap;
      margin-bottom: 15px;
    }

    .lang-chip {
      padding: 3px 9px;
      border-radius: 20px;
      background: rgba(0, 194, 255, 0.08);
      color: var(--accent);
      font-size: 12px;
      font-weight: 600;
    }

    .guide-btns {
      display: flex;
      gap: 8px;
    }

    .btn-call {
      flex: 1;
      padding: 11px;
      border-radius: 11px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      font-weight: 700;
      font-size: 14px;
      text-align: center;
      font-family: inherit;
      border: none;
      cursor: pointer;
    }

    .btn-wa {
      flex: 1;
      padding: 11px;
      border-radius: 11px;
      background: #25d366;
      color: #fff;
      font-weight: 700;
      font-size: 14px;
      text-align: center;
    }

    /* ── PLANNER ── */
    .planner-label {
      color: var(--muted);
      font-size: 11px;
      font-weight: 800;
      margin-bottom: 10px;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .day-chips {
      display: flex;
      gap: 5px;
      flex-wrap: wrap;
    }

    .day-chip {
      min-width: 38px;
      padding: 9px 8px;
      border-radius: 10px;
      border: 1px solid var(--card-border);
      background: transparent;
      color: var(--muted);
      font-weight: 700;
      cursor: pointer;
      font-size: 14px;
      transition: all 0.2s;
      font-family: inherit;
      text-align: center;
    }

    .day-chip.active {
      border-color: var(--accent);
      background: linear-gradient(135deg, rgba(0, 194, 255, 0.18), rgba(255, 107, 53, 0.08));
      color: var(--accent);
      box-shadow: 0 0 12px rgba(0, 194, 255, 0.18);
    }

    .planner-select {
      display: none;
    }

    .custom-select {
      position: relative;
      width: 100%;
      user-select: none;
    }

    .custom-select-trigger {
      width: 100%;
      padding: 11px 38px 11px 13px;
      border-radius: 11px;
      border: 1px solid var(--card-border);
      background: var(--card);
      color: var(--text);
      font-size: 14px;
      font-family: inherit;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
      transition: border-color 0.2s;
      box-sizing: border-box;
    }

    .custom-select-trigger:hover {
      border-color: var(--accent);
    }

    .custom-select-trigger.open {
      border-color: var(--accent);
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }

    .custom-select-arrow {
      color: var(--accent);
      font-size: 11px;
      transition: transform 0.2s;
      flex-shrink: 0;
    }

    .custom-select-trigger.open .custom-select-arrow {
      transform: rotate(180deg);
    }

    .custom-select-opts {
      display: none;
      position: relative;
      top: 0;
      left: 0;
      right: 0;
      background: var(--card);
      border: 1px solid var(--accent);
      border-top: none;
      border-radius: 0 0 11px 11px;
      max-height: 260px;
      overflow-y: auto;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      margin-top: -1px;
    }

    .custom-select-opts.open {
      display: block;
    }

    .custom-select-opt {
      padding: 11px 14px;
      cursor: pointer;
      font-size: 13px;
      color: var(--text);
      transition: background 0.15s;
      border-bottom: 1px solid var(--card-border);
    }

    .custom-select-opt:last-child {
      border-bottom: none;
    }

    .custom-select-opt:hover {
      background: rgba(0, 194, 255, 0.08);
    }

    .custom-select-opt.selected {
      background: rgba(0, 194, 255, 0.12);
      color: var(--accent);
    }

    .custom-select-opt .opt-sub {
      font-size: 11px;
      color: var(--muted);
    }

    .custom-select-opt.selected .opt-sub {
      color: var(--accent);
      opacity: 0.7;
    }

    .travel-chips {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .trav-chip {
      padding: 9px 15px;
      border-radius: 10px;
      border: 1px solid var(--card-border);
      background: transparent;
      color: var(--muted);
      font-weight: 700;
      cursor: pointer;
      font-size: 13px;
      transition: all 0.2s;
      font-family: inherit;
    }

    .trav-chip.active {
      border-color: var(--accent2);
      background: linear-gradient(135deg, rgba(255, 107, 53, 0.14), rgba(0, 194, 255, 0.05));
      color: var(--accent2);
    }

    .int-chip {
      padding: 8px 15px;
      border-radius: 50px;
      border: 1px solid var(--card-border);
      background: transparent;
      color: var(--muted);
      font-weight: 600;
      cursor: pointer;
      font-size: 13px;
      transition: all 0.2s;
      font-family: inherit;
    }

    .int-chip.active {
      border-color: var(--accent);
      background: rgba(0, 194, 255, 0.1);
      color: var(--accent);
    }

    .planner-form {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 20px;
      padding: 28px;
      position: relative;
    }

    .planner-section {
      margin-bottom: 26px;
    }

    .planner-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 22px;
      margin-bottom: 26px;
    }

    .planner-ints {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      margin-bottom: 6px;
    }

    .planner-hint {
      color: var(--muted);
      font-size: 11px;
      margin-top: 8px;
      font-style: italic;
    }

    .btn-generate {
      width: 100%;
      padding: 17px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      font-weight: 900;
      font-size: 16px;
      border: none;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
      font-family: inherit;
      letter-spacing: 0.5px;
      margin-top: 8px;
    }

    .btn-generate:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(0, 194, 255, 0.3);
    }

    .btn-generate:disabled {
      background: var(--muted);
      cursor: default;
      transform: none;
      box-shadow: none;
    }

    /* Itinerary output */
    .itin-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 30px;
      padding: 22px;
      background: linear-gradient(135deg, rgba(0, 194, 255, 0.08), rgba(255, 107, 53, 0.06));
      border-radius: 18px;
      border: 1px solid var(--card-border);
    }

    .itin-title {
      font-size: 22px;
      font-weight: 900;
      color: var(--text);
    }

    .itin-subtitle {
      color: var(--muted);
      font-size: 13px;
      margin-top: 4px;
    }

    .itin-totals {
      display: flex;
      gap: 16px;
    }

    .itin-stat {
      text-align: center;
    }

    .itin-stat-val {
      font-size: 20px;
      font-weight: 900;
      color: var(--accent2);
    }

    .itin-stat-lbl {
      font-size: 10px;
      color: var(--muted);
      font-weight: 700;
      letter-spacing: 0.5px;
      margin-top: 2px;
    }

    .day-card-wrap {
      display: flex;
      gap: 16px;
      margin-bottom: 24px;
    }

    .day-left {
      display: flex;
      flex-direction: column;
      align-items: center;
      min-width: 46px;
    }

    .day-circle {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-weight: 900;
      font-size: 16px;
      flex-shrink: 0;
    }

    .day-connector {
      width: 2px;
      background: linear-gradient(to bottom, rgba(0, 194, 255, 0.3), transparent);
      flex: 1;
      margin-top: 6px;
    }

    .day-card {
      flex: 1;
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 18px;
      overflow: hidden;
    }

    .day-card-head {
      padding: 16px 20px 12px;
      border-bottom: 1px solid var(--card-border);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 8px;
    }

    .day-label {
      color: var(--accent);
      font-size: 10px;
      font-weight: 800;
      letter-spacing: 1.5px;
    }

    .day-theme {
      color: var(--text);
      font-size: 17px;
      font-weight: 800;
      margin-top: 2px;
    }

    .day-budget-pill {
      background: rgba(255, 107, 53, 0.1);
      border: 1px solid rgba(255, 107, 53, 0.25);
      color: var(--accent2);
      font-size: 13px;
      font-weight: 700;
      padding: 5px 13px;
      border-radius: 20px;
    }

    .day-body {
      padding: 16px 20px;
    }

    /* Activity slots */
    .slot {
      display: flex;
      gap: 12px;
      margin-bottom: 10px;
    }

    .slot-time-col {
      min-width: 68px;
      padding-top: 2px;
    }

    .slot-time {
      color: var(--accent);
      font-size: 11px;
      font-weight: 800;
    }

    .slot-label {
      color: var(--muted);
      font-size: 10px;
      letter-spacing: 0.5px;
      margin-top: 1px;
    }

    .slot-content {
      flex: 1;
      background: rgba(0, 194, 255, 0.04);
      border: 1px solid var(--card-border);
      border-radius: 12px;
      padding: 10px 13px;
      transition: background 0.2s;
    }

    .slot-content:hover {
      background: rgba(0, 194, 255, 0.08);
    }

    .slot-place-name {
      color: var(--text);
      font-weight: 700;
      font-size: 14px;
    }

    .slot-meta {
      display: flex;
      gap: 10px;
      margin-top: 4px;
      flex-wrap: wrap;
    }

    .slot-tag {
      font-size: 11px;
      color: var(--muted);
    }

    .slot-tag.free {
      color: #22c55e;
    }

    .slot-tag.paid {
      color: var(--accent2);
    }

    .slot-food {
      background: rgba(255, 107, 53, 0.06);
      border-color: rgba(255, 107, 53, 0.2);
    }

    .slot-food .slot-place-name {
      color: var(--accent2);
    }

    .slot-nearby {
      background: rgba(139, 92, 246, 0.06);
      border-color: rgba(139, 92, 246, 0.2);
    }

    .slot-nearby .slot-place-name {
      color: #a78bfa;
    }

    .day-hotel {
      margin-top: 14px;
      padding: 10px 14px;
      border-radius: 12px;
      background: linear-gradient(135deg, rgba(255, 107, 53, 0.06), rgba(0, 194, 255, 0.04));
      border: 1px solid rgba(255, 107, 53, 0.15);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 6px;
    }

    .hotel-info {
      color: var(--text);
      font-size: 13px;
      font-weight: 700;
    }

    .hotel-price {
      color: var(--accent2);
      font-size: 12px;
      font-weight: 700;
    }

    /* Itin summary bar */
    .itin-summary {
      margin-top: 28px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
      gap: 14px;
    }

    .itin-sum-card {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 14px;
      padding: 16px;
      text-align: center;
    }

    .itin-sum-val {
      font-size: 22px;
      font-weight: 900;
      color: var(--accent);
    }

    .itin-sum-lbl {
      color: var(--muted);
      font-size: 11px;
      margin-top: 4px;
      font-weight: 700;
    }

    .itin-regen {
      display: flex;
      justify-content: center;
      margin-top: 24px;
      gap: 10px;
      flex-wrap: wrap;
    }

    .btn-regen {
      padding: 12px 28px;
      border-radius: 50px;
      border: 2px solid var(--accent);
      background: transparent;
      color: var(--accent);
      font-weight: 800;
      font-size: 14px;
      cursor: pointer;
      font-family: inherit;
      transition: all 0.2s;
    }

    .btn-regen:hover {
      background: rgba(0, 194, 255, 0.1);
    }

    /* ── SHARE ITINERARY ── */
    .btn-share-itin {
      padding: 12px 28px;
      border-radius: 50px;
      border: 2px solid var(--accent2);
      background: transparent;
      color: var(--accent2);
      font-weight: 800;
      font-size: 14px;
      cursor: pointer;
      font-family: inherit;
      transition: all 0.2s;
    }

    .btn-share-itin:hover {
      background: rgba(255, 107, 53, 0.1);
    }

    .share-itin-panel {
      display: none;
      margin-top: 16px;
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 16px;
      padding: 18px 20px;
      animation: fadeUp 0.2s ease;
    }

    .share-itin-panel.open {
      display: block;
    }

    .share-itin-title {
      font-size: 11px;
      font-weight: 800;
      color: var(--muted);
      letter-spacing: 1.5px;
      text-transform: uppercase;
      margin-bottom: 14px;
    }

    .share-itin-btns {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .share-itin-btn {
      flex: 1;
      min-width: 120px;
      padding: 11px 16px;
      border-radius: 12px;
      border: 1px solid var(--card-border);
      background: var(--card);
      color: var(--text);
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      font-family: inherit;
      transition: all 0.2s;
      text-align: center;
    }

    .share-itin-btn:hover {
      border-color: var(--accent);
      color: var(--accent);
      background: rgba(0, 194, 255, 0.06);
    }

    .share-itin-btn.copied {
      border-color: #22c55e;
      color: #22c55e;
      background: rgba(34, 197, 94, 0.08);
    }

    /* ── PRINT STYLES ── */
    @media print {
      body {
        background: #fff !important;
        color: #000 !important;
      }

      #navbar,
      #quiz-btn,
      #quiz-panel,
      #quiz-overlay,
      .btn-regen,
      .btn-share-itin,
      .share-itin-panel,
      .page:not(#page-Planner) {
        display: none !important;
      }

      #page-Planner {
        display: block !important;
      }

      .planner-form {
        display: none !important;
      }

      #itinerary {
        display: block !important;
      }

      .itinerary-container {
        display: block !important;
      }

      .itin-header {
        background: #f0f4f8 !important;
        color: #000 !important;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
      }

      .itin-title {
        color: #1a2533 !important;
        font-size: 22px !important;
      }

      .itin-subtitle {
        color: #6b7a8d !important;
      }

      .itin-stat-val {
        color: #0077cc !important;
      }

      .day-card {
        border: 1px solid #dde3ea !important;
        break-inside: avoid;
      }

      .day-card-head {
        background: #f0f4f8 !important;
      }

      .day-label {
        color: #6b7a8d !important;
      }

      .day-theme {
        color: #1a2533 !important;
      }

      .day-budget-pill {
        background: #e0f2fe !important;
        color: #0077cc !important;
      }

      .slot-content {
        background: #f8fafc !important;
      }

      .slot-place-name {
        color: #1a2533 !important;
      }

      .slot-time {
        color: #6b7a8d !important;
      }

      .slot-label {
        color: #0077cc !important;
      }

      .day-hotel {
        background: #f0f4f8 !important;
        color: #1a2533 !important;
      }

      .day-circle {
        background: #0077cc !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

      .day-connector {
        background: #dde3ea !important;
      }

      * {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
    }


    #quiz-btn {
      position: fixed;
      bottom: 26px;
      right: 26px;
      z-index: 500;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border: none;
      cursor: pointer;
      box-shadow: 0 8px 26px rgba(0, 194, 255, 0.28);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      animation: quizBounce 2.4s ease-in-out infinite;
      transition: transform 0.2s;
    }

    @keyframes quizBounce {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-7px)
      }
    }

    #quiz-btn:hover {
      transform: scale(1.13);
    }

    #quiz-panel {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0.88);
      z-index: 600;
      width: min(620px, 94vw);
      border-radius: 24px;
      overflow: hidden;
      background: #050b14;
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 40px 100px rgba(0, 0, 0, 0.75);
      display: none;
      max-height: 88vh;
      overflow-y: auto;
      opacity: 0;
      transition: opacity 0.25s ease, transform 0.25s ease;
    }

    #quiz-panel.open {
      display: block;
      opacity: 1;
      transform: translate(-50%, -50%) scale(1);
    }

    #quiz-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      z-index: 599;
    }

    #quiz-overlay.open {
      display: block;
    }

    .quiz-header {
      padding: 18px 22px;
      background: linear-gradient(135deg, rgba(0, 194, 255, 0.15), rgba(255, 107, 53, 0.1));
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
      display: flex;
      align-items: center;
      gap: 13px;
      position: sticky;
      top: 0;
      z-index: 2;
    }

    .quiz-icon {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
    }

    .quiz-title {
      color: #fff;
      font-weight: 800;
      font-size: 16px;
    }

    .quiz-sub {
      color: rgba(255, 255, 255, 0.42);
      font-size: 13px;
    }

    .quiz-body {
      padding: 22px 24px;
      min-height: 300px;
    }

    .quiz-start-btn {
      width: 100%;
      padding: 15px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      font-weight: 800;
      border: none;
      cursor: pointer;
      font-size: 17px;
      font-family: inherit;
    }

    .quiz-q-progress {
      display: flex;
      justify-content: space-between;
      margin-bottom: 11px;
      font-size: 12px;
    }

    .quiz-q-num {
      color: var(--accent);
      font-weight: 700;
      font-size: 14px;
    }

    .quiz-score {
      color: rgba(255, 255, 255, 0.42);
      font-size: 14px;
    }

    .quiz-q-box {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 14px;
      padding: 18px;
      margin-bottom: 16px;
      color: #fff;
      font-size: 17px;
      line-height: 1.6;
      font-weight: 600;
    }

    .quiz-opts {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .quiz-opt {
      padding: 13px 16px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: #fff;
      text-align: left;
      cursor: pointer;
      font-size: 15px;
      transition: all 0.22s;
      font-family: inherit;
    }

    .quiz-opt.correct {
      background: rgba(34, 197, 94, 0.18);
      border-color: #22c55e;
      font-weight: 700;
    }

    .quiz-opt.wrong {
      background: rgba(239, 68, 68, 0.18);
      border-color: #ef4444;
    }

    .quiz-result {
      text-align: center;
    }

    .quiz-trophy {
      font-size: 52px;
      margin-bottom: 10px;
    }

    .quiz-result-score {
      color: #fff;
      font-size: 20px;
      font-weight: 900;
      margin-bottom: 6px;
    }

    .quiz-result-msg {
      color: rgba(255, 255, 255, 0.52);
      font-size: 13px;
      margin-bottom: 20px;
    }

    .quiz-replay {
      padding: 14px 24px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      font-weight: 800;
      border: none;
      cursor: pointer;
      font-size: 16px;
      font-family: inherit;
    }

    /* ── HOME QUICK CARDS ── */
    .quick-card {
      padding: 24px 20px 22px;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.28s ease;
      text-align: left;
    }

    .quick-card::before {
      content: '';
      position: absolute;
      inset: 0;
      opacity: 0;
      background: radial-gradient(ellipse at 30% 50%, rgba(0, 194, 255, 0.1), transparent 70%);
      transition: opacity 0.3s;
    }

    .quick-card:hover {
      transform: translateY(-7px);
      box-shadow: 0 20px 48px rgba(0, 0, 0, 0.45);
    }

    .quick-card:hover::before {
      opacity: 1;
    }

    .quick-card:hover .quick-icon {
      transform: rotate(-8deg) scale(1.15);
    }

    .quick-card:hover .quick-sub {
      opacity: 1;
      transform: translateY(0);
    }

    .quick-card:hover .quick-arrow {
      opacity: 1;
      transform: translateX(0);
    }

    .quick-icon {
      font-size: 34px;
      margin-bottom: 14px;
      display: inline-block;
      transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .quick-title {
      font-size: 15px;
      font-weight: 900;
      color: var(--text);
      line-height: 1.3;
      margin-bottom: 6px;
    }

    .quick-title span {
      background: linear-gradient(90deg, var(--accent), var(--accent2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .quick-sub {
      font-size: 11.5px;
      color: var(--muted);
      line-height: 1.5;
      opacity: 0;
      transform: translateY(5px);
      transition: all 0.25s ease;
    }

    .quick-arrow {
      position: absolute;
      bottom: 18px;
      right: 18px;
      font-size: 13px;
      font-weight: 800;
      color: var(--accent);
      opacity: 0;
      transform: translateX(-6px);
      transition: all 0.25s ease;
    }

    /* ── FOOTER ── */
    footer {
      border-top: 1px solid var(--card-border);
      padding: 34px 20px;
      text-align: center;
      color: var(--muted);
      font-size: 14px;
    }

    .footer-ref-link {
      display: flex;
      align-items: center;
      gap: 6px;
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 20px;
      padding: 5px 13px;
      color: var(--muted);
      font-size: 11px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s;
    }

    .footer-ref-link:hover {
      color: var(--accent);
      border-color: var(--accent);
    }

    .footer-ref-label {
      font-size: 11px;
      font-weight: 800;
      letter-spacing: 1.5px;
      color: var(--muted);
      text-transform: uppercase;
      margin-bottom: 16px;
      opacity: 0.6;
    }

    .footer-disclaimer {
      font-size: 10px;
      color: var(--muted);
      margin-top: 4px;
      opacity: 0.5;
    }

    footer .footer-logo {
      font-family: 'Playfair Display', serif;
      font-size: 19px;
      font-weight: 900;
      color: var(--accent);
      margin-bottom: 9px;
    }

    /* ── FOOD MODAL ── */
    .stat-grid {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 8px;
      margin-bottom: 15px;
    }

    .stat-tile {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 10px;
      padding: 8px 11px;
      text-align: center;
    }

    .stat-tile-lbl {
      color: var(--muted);
      font-size: 10px;
      margin-bottom: 2px;
    }

    .stat-tile-val {
      font-weight: 700;
      font-size: 12px;
    }

    .address-row {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 10px;
      padding: 10px 13px;
      margin-bottom: 9px;
      display: flex;
      gap: 9px;
      align-items: center;
    }

    .address-row-label {
      color: var(--muted);
      font-size: 10px;
      margin-bottom: 1px;
    }

    .address-row-val {
      color: var(--text);
      font-size: 13px;
      font-weight: 600;
    }

    .must-try-section {
      margin-bottom: 16px;
    }

    .must-try-lbl {
      color: var(--muted);
      font-size: 11px;
      font-weight: 700;
      margin-bottom: 7px;
    }

    .must-try-chips2 {
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
    }

    .mtc2 {
      padding: 5px 12px;
      border-radius: 50px;
      background: rgba(255, 107, 53, 0.13);
      border: 1px solid rgba(255, 107, 53, 0.26);
      color: #ff6b35;
      font-size: 12px;
      font-weight: 600;
    }

    .modal-food-actions {
      display: flex;
      gap: 9px;
      margin-top: 4px;
    }

    .btn-wa-full {
      flex: 1;
      padding: 12px;
      border-radius: 12px;
      background: #25d366;
      color: #fff;
      font-weight: 800;
      text-align: center;
      font-size: 14px;
    }

    .explore-more-btn {
      display: block;
      padding: 11px;
      border-radius: 11px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: rgba(255, 255, 255, 0.45);
      text-align: center;
      font-size: 12px;
      font-weight: 600;
      margin-top: 10px;
    }

    /* ── WEATHER WIDGET ─────────────────────────────────────────────────────── */
    .weather-widget {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: 20px;
      padding: 20px 24px;
      margin-bottom: 36px;
      position: relative;
      overflow: hidden;
    }

    .weather-widget::before {
      content: '';
      position: absolute;
      top: -40px;
      right: -40px;
      width: 180px;
      height: 180px;
      background: radial-gradient(circle, rgba(0, 194, 255, 0.07), transparent 70%);
      pointer-events: none;
    }

    .weather-label {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 16px;
    }

    .weather-label-bar {
      width: 3px;
      height: 20px;
      background: linear-gradient(180deg, var(--accent), var(--accent2));
      border-radius: 2px;
    }

    .weather-label-text {
      color: var(--accent);
      font-size: 11px;
      font-weight: 800;
      letter-spacing: 1.5px;
      text-transform: uppercase;
    }

    .weather-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 14px;
    }

    .weather-left {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .weather-icon-big {
      font-size: 52px;
      line-height: 1;
    }

    .weather-temp {
      font-size: 38px;
      font-weight: 900;
      color: var(--text);
      line-height: 1;
    }

    .weather-temp span {
      font-size: 18px;
      font-weight: 600;
      color: var(--muted);
    }

    .weather-cond {
      font-size: 13px;
      color: var(--muted);
      margin-top: 4px;
      text-transform: capitalize;
    }

    .weather-stats {
      display: flex;
      gap: 18px;
      flex-wrap: wrap;
    }

    .weather-stat {
      text-align: center;
    }

    .weather-stat-val {
      font-size: 15px;
      font-weight: 800;
      color: var(--text);
    }

    .weather-stat-lbl {
      font-size: 10px;
      color: var(--muted);
      font-weight: 700;
      letter-spacing: 0.5px;
      margin-top: 2px;
    }

    .weather-suggestion {
      margin-top: 16px;
      padding: 12px 16px;
      background: linear-gradient(135deg, rgba(0, 194, 255, 0.05), rgba(255, 107, 53, 0.04));
      border: 1px solid var(--card-border);
      border-radius: 12px;
      font-size: 13px;
      color: var(--text);
      line-height: 1.6;
    }

    .weather-suggestion strong {
      color: var(--accent);
    }

    @media (max-width: 480px) {
      .weather-icon-big {
        font-size: 38px;
      }

      .weather-temp {
        font-size: 30px;
      }

      .weather-stats {
        gap: 12px;
      }
    }

    /* ══════════════════════════════════════════════════════════════
       REVIEW SYSTEM — CSS (theme-aware)
    ══════════════════════════════════════════════════════════════ */
    .review-form-wrap {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: var(--radius);
      padding: 32px 28px;
      max-width: 640px;
      margin: 0 auto;
      backdrop-filter: blur(14px);
    }

    .review-field {
      margin-bottom: 20px;
    }

    .review-label {
      display: block;
      font-size: 11px;
      font-weight: 800;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: 1.2px;
      margin-bottom: 9px;
    }

    .review-input {
      width: 100%;
      background: var(--review-input-bg, rgba(255, 255, 255, 0.04));
      border: 1px solid var(--card-border);
      border-radius: 13px;
      padding: 13px 16px;
      color: var(--text);
      font-family: inherit;
      font-size: 14px;
      font-weight: 500;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      resize: vertical;
      box-sizing: border-box;
    }

    .review-input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px var(--review-focus-glow, rgba(0, 194, 255, 0.1));
    }

    .review-input::placeholder {
      color: var(--muted);
    }

    .star-rating {
      display: flex;
      gap: 6px;
      cursor: pointer;
    }

    .star {
      font-size: 32px;
      color: var(--star-empty, rgba(255, 255, 255, 0.15));
      transition: color 0.15s, transform 0.15s;
      user-select: none;
      line-height: 1;
    }

    .star.active {
      color: #fbbf24;
    }

    .star:hover {
      color: #fbbf24;
      transform: scale(1.15);
    }

    .review-msg {
      padding: 11px 16px;
      border-radius: 11px;
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 10px;
      display: none;
    }

    .review-msg.success {
      background: rgba(34, 197, 94, 0.12);
      border: 1px solid rgba(34, 197, 94, 0.3);
      color: #16a34a;
      display: block;
    }

    .review-msg.error {
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #ef4444;
      display: block;
    }

    .review-card-hp {
      background: var(--card);
      border: 1px solid var(--card-border);
      border-radius: var(--radius);
      padding: 22px 22px 20px;
      transition: transform 0.22s, box-shadow 0.22s;
      animation: fadeUp 0.3s ease;
    }

    .review-card-hp:hover {
      transform: translateY(-4px);
      box-shadow: var(--review-card-shadow, 0 14px 40px rgba(0, 0, 0, 0.28));
    }

    .review-card-top {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
    }

    .review-avatar {
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
      flex-shrink: 0;
    }

    .review-name {
      font-weight: 800;
      font-size: 15px;
      color: var(--text);
    }

    .review-date {
      font-size: 11px;
      color: var(--muted);
      margin-top: 2px;
    }

    .review-stars {
      font-size: 14px;
      margin-left: auto;
    }

    .review-text {
      font-size: 13.5px;
      color: var(--muted);
      line-height: 1.75;
    }

    .btn-see-more {
      display: inline-block;
      padding: 13px 32px;
      border-radius: 50px;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff !important;
      font-weight: 800;
      font-size: 15px;
      text-decoration: none;
      transition: transform 0.2s;
    }

    .btn-see-more:hover {
      transform: scale(1.05);
    }

    /* ── LIGHT THEME overrides for review section ── */
    body.light {
      --star-empty: rgba(0, 0, 0, 0.15);
      --review-input-bg: rgba(0, 0, 0, 0.04);
      --review-focus-glow: rgba(0, 119, 204, 0.12);
      --review-card-shadow: 0 14px 40px rgba(0, 0, 0, 0.10);
    }

    /* ── PURPLE THEME overrides ── */
    body.purple {
      --star-empty: rgba(255, 216, 192, 0.18);
      --review-input-bg: rgba(255, 220, 190, 0.06);
      --review-focus-glow: rgba(255, 159, 90, 0.15);
      --review-card-shadow: 0 14px 40px rgba(0, 0, 0, 0.35);
    }

    /* ── OCEAN THEME overrides ── */
    body.ocean {
      --star-empty: rgba(184, 240, 232, 0.18);
      --review-input-bg: rgba(0, 180, 160, 0.07);
      --review-focus-glow: rgba(0, 229, 204, 0.15);
      --review-card-shadow: 0 14px 40px rgba(0, 0, 0, 0.35);
    }
  </style>
</head>

<body>

  <!-- ADMIN LOGIN MODAL -->
  <div id="adminModalOverlay" onclick="closeAdminModal(event)">
    <div id="adminModal">
      <button class="admin-modal-close" onclick="closeAdminModal()" title="Close">✕</button>
      <div class="admin-modal-icon">🔐</div>
      <div class="admin-modal-title">Admin Login</div>
      <div class="admin-modal-sub">GoTrip Bhavnagar — Authorised Access Only</div>
      <div class="admin-modal-error" id="adminModalError"></div>
      <div class="admin-modal-field">
        <label class="admin-modal-label">Username</label>
        <input class="admin-modal-input" type="text" id="adminUser"
          placeholder="admin" autocomplete="username" onkeydown="if(event.key==='Enter')doAdminLogin()">
      </div>
      <div class="admin-modal-field">
        <label class="admin-modal-label">Password</label>
        <input class="admin-modal-input" type="password" id="adminPass"
          placeholder="••••••••" autocomplete="current-password" onkeydown="if(event.key==='Enter')doAdminLogin()">
      </div>
      <button class="btn-admin-login" id="adminLoginBtn" onclick="doAdminLogin()">
        Login to Dashboard →
      </button>
    </div>
  </div>

  <!-- PARTICLES -->
  <div id="particles"></div>

  <!-- NAVBAR -->
  <nav id="navbar">
    <div class="nav-logo" onclick="navigate('Home')">GoTrip <span>Bhavnagar</span></div>
    <div class="nav-tabs" id="navTabs"></div>
    <a href="admin/login.php" class="btn-admin-nav" title="Admin Login">🔐 <span class="admin-label">Admin</span></a>
    <div class="theme-btns" id="themeBtns"></div>
    <select class="theme-select-mobile" id="themeSelectMobile" onchange="setTheme(this.value)" title="Theme" aria-label="Theme"></select>
  </nav>

  <!-- PAGES -->
  <div id="page-Home" class="page active">
    <div id="hero">
      <div class="hero-grid"></div>
      <div class="hero-orb1"></div>
      <div class="hero-orb2"></div>
      <div style="text-align:center;z-index:2;max-width:840px;">
        <div class="hero-badge">✨ AI-POWERED SMART TOURISM</div>
        <h1 class="hero-title">Discover<br><span class="highlight">Bhavnagar</span></h1>
        <p class="hero-sub">Gujarat's hidden gem — where ancient temples meet coastal serenity, and royal heritage
          blends with wildlife wonder.</p>
        <div class="hero-btns">
          <button class="btn-primary" onclick="navigate('Places')">Explore Places</button>
          <button class="btn-outline" onclick="navigate('Planner')">Plan My Trip</button>
        </div>
      </div>
      <div class="hero-intro-strip">
        <div class="intro-tag">🏙️ FOUNDED 1723</div>
        <div class="intro-tag">🌊 GULF OF KHAMBHAT</div>
        <div class="intro-tag">🦚 SAURASHTRA REGION</div>
        <div class="intro-tag">🛕 CITY OF TEMPLES</div>
      </div>
      <div class="hero-arrow">↓</div>
    </div>
    <div class="container" id="homeContent"></div>
  </div>

  <div id="page-Places" class="page">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Tourist Places</h2>
        <p class="section-sub">Explore the iconic landmarks of Bhavnagar</p>
        <div class="section-divider"></div>
      </div>
      <div class="chips" id="placesFilter"></div>
      <div class="grid-auto-lg" id="placesGrid"></div>
    </div>
  </div>

  <div id="page-Nearby" class="page">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Nearby Destinations</h2>
        <p class="section-sub">Day trips and weekend escapes from Bhavnagar</p>
        <div class="section-divider"></div>
      </div>
      <div class="grid-auto-nb" id="nearbyGrid" style="grid-template-columns:repeat(auto-fill,minmax(260px,1fr))"></div>
    </div>
  </div>

  <div id="page-Planner" class="page">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">AI Tour Planner</h2>
        <p class="section-sub">Tell us your preferences and AI crafts your perfect itinerary</p>
        <div class="section-divider"></div>
      </div>
      <div id="plannerContent"></div>
    </div>
  </div>

  <div id="page-Events" class="page">
    <div class="container">
      <!-- Upcoming -->
      <div class="section-header">
        <h2 class="section-title">Upcoming Events</h2>
        <p class="section-sub">Don't miss these — happening soon in Bhavnagar</p>
        <div class="section-divider"></div>
      </div>
      <div class="grid-auto" id="eventsUpcoming"></div>

      <!-- Regular -->
      <div class="section-header" style="margin-top:44px">
        <h2 class="section-title">Regular Events</h2>
        <p class="section-sub">Recurring experiences you can join any time</p>
        <div class="section-divider"></div>
      </div>
      <div class="grid-auto" id="eventsRegular"></div>

    </div>
  </div>

  <div id="page-Food" class="page">
    <div class="container" style="max-width:1060px">
      <!-- Bhavnagar section -->
      <div class="section-header">
        <h2 class="section-title">🍽️ Eat in Bhavnagar</h2>
        <p class="section-sub">From royal thalis to beloved street food stalls</p>
        <div class="section-divider"></div>
      </div>
      <div style="background:linear-gradient(135deg,rgba(0,194,255,0.06),rgba(255,107,53,0.06));border-left:3px solid var(--accent2);border-radius:0 12px 12px 0;padding:14px 20px;margin-bottom:20px">
        <p style="color:var(--text);font-size:13px;line-height:1.75;font-style:italic">"Bhavnagar is not just about places — it&#39;s about flavors. From sunrise fafda to sunset bhajiya, every stop has a taste story."</p>
      </div>
      <div class="chips" id="foodFilter"></div>
      <div class="grid-auto" id="foodGrid"></div>

      <!-- Nearby food section -->
      <div class="section-header" style="margin-top:48px">
        <h2 class="section-title">🗺️ Eat Near Day-Trip Destinations</h2>
        <p class="section-sub">Best food stops when exploring beyond Bhavnagar</p>
        <div class="section-divider"></div>
      </div>
      <div class="grid-auto" id="nearbyFoodGrid"></div>
    </div>
  </div>

  <div id="page-Hotels" class="page">
    <div class="container" style="max-width:1060px">
      <div class="section-header">
        <h2 class="section-title">🏨 Hotels & Stays</h2>
        <p class="section-sub">Verified hotels, resorts and dharamshalas — every budget covered</p>
        <div class="section-divider"></div>
      </div>
      <div style="background:linear-gradient(135deg,rgba(0,194,255,0.07),rgba(255,107,53,0.05));border:1px solid var(--card-border);border-radius:16px;padding:16px 20px;margin-bottom:24px;font-size:13px;color:var(--muted)">
        💡 Prices are approximate and seasonal. Book via <strong style="color:var(--accent)">Booking.com</strong>, <strong style="color:var(--accent)">MakeMyTrip</strong> or contact hotels directly for best rates.
      </div>
      <div class="chips" id="hotelFilter"></div>
      <div class="grid-auto" id="hotelGrid"></div>
    </div>
  </div>

  <div id="page-Guides" class="page">
    <div class="container" style="max-width:1060px">
      <div class="section-header">
        <h2 class="section-title">🧭 Tour Guides & Operators</h2>
        <p class="section-sub">Verified, active tour companies serving Bhavnagar — researched & cross-checked</p>
        <div class="section-divider"></div>
      </div>
      <div style="background:linear-gradient(135deg,rgba(0,194,255,0.07),rgba(255,107,53,0.05));border:1px solid var(--card-border);border-radius:14px;padding:14px 18px;margin-bottom:22px;font-size:13px;color:var(--muted);line-height:1.65">
        💡 These are <strong style="color:var(--text)">verified tour companies</strong> registered with Gujarat Tourism or major travel bodies. For individual licensed guides, contact <strong style="color:var(--accent)">Gujarat Tourism</strong> at <strong style="color:var(--text)">gujarattourism.com</strong> or call Bhavnagar tourism office.
      </div>
      <div class="grid-auto" id="guidesGrid"></div>
    </div>
  </div>

  <!-- MODALS -->
  <div class="modal-overlay" id="placeModal" onclick="closePlaceModal(event)">
    <div class="modal-box" id="placeModalBox"></div>
  </div>
  <div class="modal-overlay" id="foodModal" onclick="closeFoodModal(event)">
    <div class="modal-box" id="foodModalBox"></div>
  </div>
  <div class="modal-overlay" id="nearbyModal" onclick="closeNearbyModal(event)">
    <div class="modal-box" id="nearbyModalBox"></div>
  </div>

  <!-- FOOTER -->
  <footer>
    <div class="footer-logo">GoTrip Bhavnagar</div>
    <p>AI-Powered Smart Tourism Platform • Bhavnagar, Gujarat, India</p>
    <p style="margin-top:6px">Made with love for the jewel of Saurashtra</p>

    <div style="margin-top:28px;padding-top:22px;border-top:1px solid var(--card-border)">
      <div class="footer-ref-label">Data Sources & References</div>
      <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:10px;margin-bottom:18px">
        <a href="https://www.gujarattourism.com/saurashtra/bhavnagar.html" target="_blank" class="footer-ref-link">🏛️
          Gujarat Tourism</a>
        <a href="https://www.tripadvisor.in/Attractions-g679050-Activities-Bhavnagar_Bhavnagar_District_Gujarat.html"
          target="_blank" class="footer-ref-link">🌍 TripAdvisor</a>
        <a href="https://www.makemytrip.com/tripideas/places-to-visit-in-bhavnagar" target="_blank"
          class="footer-ref-link">✈️ MakeMyTrip</a>
        <a href="https://www.holidify.com/places/bhavnagar/" target="_blank" class="footer-ref-link">🗺️ Holidify</a>
        <a href="https://bhavnagar.nic.in" target="_blank" class="footer-ref-link">🏛️ Bhavnagar NIC</a>
        <a href="https://wanderlog.com" target="_blank" class="footer-ref-link">📍 WanderLog</a>
        <a href="https://www.justdial.com/Bhavnagar" target="_blank" class="footer-ref-link">📞 JustDial</a>
        <a href="https://www.zomato.com/bhavnagar" target="_blank" class="footer-ref-link">🍽️ Zomato</a>
        <a href="https://www.booking.com/city/in/bhavnagar.html" target="_blank" class="footer-ref-link">🏨 Booking.com</a>
        <a href="https://www.tripadvisor.in/Tourism-g679050-Bhavnagar_Bhavnagar_District_Gujarat-Vacations.html" target="_blank" class="footer-ref-link">⭐ TripAdvisor</a>
        <a href="https://bhavnagar.city" target="_blank" class="footer-ref-link">🏙️ Bhavnagar.city</a>
        <a href="https://magicpin.in/Bhavnagar" target="_blank" class="footer-ref-link">📍 MagicPin</a>
        <a href="https://www.openstreetmap.org/#map=13/21.7645/72.1519" target="_blank" class="footer-ref-link">🗺️ OpenStreetMap</a>
        <a href="https://server.arcgisonline.com" target="_blank" class="footer-ref-link">🛰️ Esri Satellite</a>
      </div>

      <div class="footer-ref-label" style="margin-bottom:14px">Image Credits</div>
      <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:10px;margin-bottom:22px">
        <a href="https://commons.wikimedia.org" target="_blank" class="footer-ref-link">📷 Wikimedia Commons</a>
        <a href="https://www.wikipedia.org" target="_blank" class="footer-ref-link">📖 Wikipedia</a>
        <a href="https://www.google.com/maps" target="_blank" class="footer-ref-link">🗺️ Google Maps</a>
        <a href="https://picsum.photos" target="_blank" class="footer-ref-link">🖼️ Picsum (Fallback)</a>
      </div>

      <p class="footer-disclaimer">All place information is for informational purposes only. Please verify timings and
        entry fees before visiting. Images belong to their respective copyright holders.</p>
    </div>
  </footer>

  <!-- QUIZ BOT -->
  <div id="quiz-overlay" onclick="toggleQuiz()"></div>
  <button id="quiz-btn" onclick="toggleQuiz()">🤖</button>
  <div id="quiz-panel">
    <div class="quiz-header">
      <div class="quiz-icon">🤖</div>
      <div>
        <div class="quiz-title">GoTrip Quiz Bot</div>
        <div class="quiz-sub">Test your Bhavnagar knowledge!</div>
      </div>
    </div>
    <div class="quiz-body" id="quizBody"></div>
  </div>

  <script>
    // ── DATA ──────────────────────────────────────────────────────────────────────
    const THEMES = {
      dark: {
        name: "Dark",
        icon: "🌙",
        cls: ""
      },
      light: {
        name: "Light",
        icon: "🌞",
        cls: "light"
      },
      purple: {
        name: "Royal",
        icon: "🎨",
        cls: "purple"
      },
      ocean: {
        name: "Ocean",
        icon: "🌊",
        cls: "ocean"
      },
    };

    const PLACES = [{
        id: 1,
        name: "Takhteshwar Temple",
        cat: "Spiritual",
        rating: 4.8,
        distance: "1 km",
        open: "6:00 AM – 9:00 PM",
        lat: 21.76599757522935,
        lng: 72.14574289592163,
        entry: "Free",
        tips: "Visit at sunrise or sunset for panoramic Gulf views.",
        img: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/08/07/fa/fe/caption.jpg?w=2000&h=-1&s=1",
        desc: "Built in 1893 by Maharaja Takhatsinghji, this marble hilltop Shiva temple commands 360° views of Bhavnagar city and the Gulf of Khambhat."
      },
      {
        id: 2,
        name: "Gaurishankar Lake",
        cat: "Nature",
        rating: 4.5,
        distance: "3 km",
        open: "Open All Day",
        lat: 21.755262346977474,
        lng: 72.12051824279825,
        entry: "Rs.10",
        tips: "Musical fountain runs evenings. Birdwatchers should arrive at dawn.",
        img: "https://i0.wp.com/www.jovialholiday.com/wp-content/uploads/2024/11/gaurishankar-lake-bhavnagar.jpg?w=1080&ssl=1",
        desc: "Historic Bor Talav reservoir built in 1872. Recreational hub with boat rides, musical fountain, planetarium and 200+ bird species."
      },
      {
        id: 3,
        name: "Barton Museum",
        cat: "History",
        rating: 4.6,
        distance: "1 km",
        open: "9 AM – 1 PM, 2 PM – 6 PM (Closed Sun)",
        lat: 21.772102995339804,
        lng: 72.15354704111691,
        entry: "Rs.5",
        tips: "Entry just Rs.5. Closed Sundays and 2nd/4th Saturday.",
        img: "https://hblimg.mmtcdn.com/content/hubble/img/ttd_images/mmt/activities/m_Bhavnagar_Barton_library_1_l_349_639.jpg",
        desc: "1895 Victorian-era museum with royal artefacts and folk arts of the Gohil dynasty. Features rare Mahatma Gandhi photographs and personal artefacts from his years in Bhavnagar."
      },
      {
        id: 4,
        name: "Nilambag Palace",
        cat: "Heritage",
        rating: 4.7,
        distance: "2 km",
        open: "Restaurant 7:30 AM – 10 PM",
        lat: 21.76741100872262,
        lng: 72.13077744340774,
        entry: "Hotel guests / Cafe visitors",
        tips: "Non-guests can visit the garden, cafe and restaurant without a room booking. Call ahead for a heritage dining experience or palace tour.",
        img: "https://www.nilambagpalace.com/img/restaurant/heritage-1.jpg",
        desc: "Grand 19th-century Gohil dynasty residence — now a heritage hotel with peacocks in lush gardens. Mahatma Gandhi was a frequent guest here."
      },
      {
        id: 5,
        name: "Victoria Park",
        cat: "Nature",
        rating: 4.3,
        distance: "3 km",
        open: "6 AM – 9 AM & 4 PM – 7 PM",
        lat: 21.75239106292993,
        lng: 72.12807535454998,
        entry: "Free",
        tips: "Early morning 6 to 8 AM is best for birdwatching and wildlife spotting.",
        img: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/12/6a/c4/2e/img-20180314-074349-largejpg.jpg?w=1200&h=-1&s=1",
        desc: "500-acre protected tropical forest established 1888. Home to nilgai, foxes, porcupines, jackals and 200+ bird species with walking trails."
      },
      {
        id: 6,
        name: "Nishkalank Mahadev",
        cat: "Spiritual",
        rating: 4.9,
        distance: "24 km",
        open: "Tide-dependent (~10 AM – 2 PM)",
        lat: 21.59762810941261,
        lng: 72.29256108465377,
        entry: "Free",
        tips: "Check tide timings before visiting. Grand festival on Maha Shivratri.",
        img: "https://hblimg.mmtcdn.com/content/hubble/img/ttd_images/mmt/activities/m_Bhavnagar_Nishkalank_mahadev_temple_1_l_360_640.jpg",
        desc: "Extraordinary sea temple 1 km into the Arabian Sea. Submerges at high tide. At low tide devotees walk barefoot to worship 5 Shivalingas placed here by the Pandavas."
      },
      {
        id: 7,
        name: "Alang Ship Yard",
        cat: "Industrial",
        rating: 4.3,
        distance: "37 km",
        open: "Restricted Access",
        lat: 21.463339230904847,
        lng: 72.29680847594203,
        entry: "Permission required",
        tips: "General tourism is restricted by Gujarat Maritime Board. Visit the road-side ship furniture market on the Alang highway — open freely with hundreds of stalls selling ship goods.",
        img: "https://akm-img-a-in.tosshub.com/indiatoday/images/story/201406/alang_650_062814030008.jpg",
        desc: "World's largest ship recycling yard stretching 10 km along Gulf of Khambhat. Over 20,000 workers dismantle supertankers and warships."
      },
      {
        id: 15,
        name: "Ghogha Beach",
        cat: "Beach",
        rating: 4.4,
        distance: "17 km",
        open: "Open All Day",
        lat: 21.67673560458154,
        lng: 72.28455468340937,
        entry: "Free",
        tips: "Safe for swimming at low tide. Visit Ghogha's historic mosque nearby.",
        img: "https://bmcgujarat.com/media/sbtpzebg/bhavnagar_mahuva_beach_006.jpg",
        desc: "Golden-sand beach in ancient port town of Ghogha. Marco Polo visited this port in the 13th century. Known for sunrise views and a relaxed family atmosphere."
      },
      {
        id: 9,
        name: "BAPS Swaminarayan Mandir",
        cat: "Spiritual",
        rating: 4.7,
        distance: "2 km",
        open: "6 AM – 12 PM and 4 PM – 8 PM",
        lat: 21.754023735361454,
        lng: 72.14201566023426,
        entry: "Free",
        tips: "Dress modestly — no shorts. Prasad available after morning prayers. Photography allowed in the campus grounds but not inside the temple sanctum.",
        img: "https://www.baps.org//Data/Sites/1/Media/LocationImages/131131-bhavnagar.jpg",
        desc: "Stunning BAPS Aksharwadi Temple with intricate marble carvings and a peaceful campus. One of Bhavnagar's most architecturally impressive religious sites."
      },
      {
        id: 11,
        name: "Piram Bet Island",
        cat: "Adventure",
        rating: 4.5,
        distance: "29 km by boat",
        open: "Daytime boat dependent",
        lat: 21.595667555195995,
        lng: 72.36076985144977,
        entry: "Rs.200 boat",
        tips: "Book the lighthouse boat at Bhavnagar port. Take food and water — no facilities on island.",
        img: "https://hblimg.mmtcdn.com/content/hubble/img/ttd_images/mmt/activities/m_Bhavnagar_Gopnath_beach_1_l_504_640.jpg",
        desc: "Remote Gulf island with a historic lighthouse, ancient fossils including dinosaur eggs, and a Shiva temple. An off-the-beaten-path adventure by boat."
      },
      {
        id: 14,
        name: "Crescent Circle Market",
        cat: "Culture",
        rating: 4.2,
        distance: "1 km",
        open: "9 AM – 9 PM",
        lat: 21.773043022200646,
        lng: 72.15340461114752,
        entry: "Free",
        tips: "Shop for Bhavnagri Gathiya and handmade silver jewellery. Bargaining is expected and welcomed.",
        img: "https://berqwp-cdn.sfo3.cdn.digitaloceanspaces.com/cache/bhavnagar.city/wp-content/uploads/2024/07/crescent-tower-2-edited-jpg.webp?bwp",
        desc: "The vibrant old city market at Bhavnagar's historic centre. Famous for Bhavnagri Gathiya snack shops, silver and gold jewellery, hand-embroidered fabrics, and traditional spice merchants."
      },
      {
        id: 20,
        name: "Bhavnagar Science Centre",
        cat: "Culture",
        rating: 4.2,
        distance: "8 km",
        open: "10 AM – 7 PM (Closed Mon)",
        lat: 21.783694166094055,
        lng: 72.07801095767107,
        entry: "Rs.50 general",
        tips: "Opened in 2022 with Rs.100 crore investment. Has VR simulators, animatronic dinosaurs, Marine Aquatic gallery, and science-theme toy train. Extra charges apply for VR rides.",
        img: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/14/d9/9a/nice-place-to-visit.jpg?w=1200&h=-1&s=1",
        desc: "Regional science centre with interactive exhibits on astronomy, physics and biology. Houses a working planetarium and a dedicated children's science gallery. Popular school trip destination in Gujarat."
      },
      {
        id: 29,
        name: "Bhav Vilas Palace",
        cat: "Heritage",
        rating: 4.4,
        distance: "4 km",
        open: "Exterior view only",
        lat: 21.755750622382756,
        lng: 72.11764112883553,
        entry: "Free",
        tips: "The iron gate was cast in Dublin, Ireland — look closely at its craftsmanship. Best viewed from the Gaurishankar lakeside promenade.",
        img: "https://lh3.googleusercontent.com/gps-cs-s/AHVAwerbvi-c5bZZGBHuHtMQx9Mo9ZKuoZNX2KKP1cEzQqvaPszy9KoFYeLyqHsorFqNj1MEsn_IhJzlLT4C99JW-m5Grcr6EUIV1eUQdHNiTkQ6016HNxw6qeV5G-vqb_Mmb3dPw2xW=s1360-w1360-h1020-rw",
        desc: "Built in 1893 by Maharaja Takhtsinghji facing Gaurishankar Lake. Designed by Sir John Griffiths in traditional Hindu style, its Dublin-cast iron gates are a marvel. Now a private royal residence — best admired from the lakefront."
      },
      {
        id: 30,
        name: "Sardar Baug",
        cat: "Heritage",
        rating: 4.2,
        distance: "1 km",
        open: "8 AM – 6 PM",
        lat: 21.772017775492188,
        lng: 72.14137453562644,
        entry: "Rs.10",
        tips: "The garden is especially beautiful in the morning light. The small palace inside is worth a slow walk-around.",
        img: "https://itin-dev.wanderlogstatic.com/freeImage/wF79eCZH3BDk565DY3uilbpXzKt70xMn",
        desc: "A beautifully landscaped royal garden in the heart of Bhavnagar featuring a historic Gohil dynasty palace. With well-maintained lawns, colourful flower beds, fountains and shaded walkways, it is a peaceful retreat in the city."
      },
      {
        id: 32,
        name: "Ganga Deri",
        cat: "Heritage",
        rating: 4.3,
        distance: "2 km",
        open: "8 AM – 8 PM",
        lat: 21.776010465486245,
        lng: 72.14422296881868,
        entry: "Free",
        tips: "The marble work is best appreciated up close at midday when the light reflects off the white surface. A quiet and meditative space.",
        img: "https://static.wixstatic.com/media/1787fd_7db1b727e8694bd79ecd3f3fa9e159ab~mv2.jpg/v1/fill/w_1002,h_928,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/IMG_20210414_0806201.jpg",
        desc: "A stunning all-marble memorial built in the style of the Taj Mahal on the banks of Gangajalia Lake. Built by the Gohil royal family, Ganga Deri is one of Bhavnagar's most beautiful and least-known architectural treasures."
      },
      {
        id: 35,
        name: "Malnath Mahadev Temple",
        cat: "Spiritual & Nature",
        rating: 4.5,
        distance: "19 km",
        open: "6 AM – 8 PM",
        lat: 21.60416168385368,
        lng: 72.10241740007702,
        entry: "Free",
        tips: "Combine with Trambak Waterfall nearby — both are within walking distance. Monsoon season is magical here.",
        img: "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhncrOU3NtAuFtHP0Prs2mv4gQ5mjZmSmuBdN9Y-JbB03j-uOUfTHwOXQKOTAngjXo7GiMNpU0maW6irhacuDUFV1aiatoTHgzqfvQCL3IwcvJ3EcBtFXseIvwlLw7YzWA2KKETwFHKEh5y/s1600/3972158390_3959d128ac_z.jpg",
        desc: "Ancient Shiva temple nestled at the base of forested hills, 19 km from Bhavnagar. The temple sits beside the Trambak Waterfall stream — in monsoon, rushing water surrounds the complex creating an almost mythical atmosphere. A beloved pilgrimage site and nature retreat in one."
      },
      {
        id: 36,
        name: "Nath Hills",
        cat: "Nature",
        rating: 4.5,
        distance: "18 km",
        open: "Open All Day",
        lat: 21.605228375216807,
        lng: 72.10956228087886,
        entry: "Free (resort charges apply)",
        tips: "Visit at sunset for the most dramatic windmill and valley views. The Elysium restaurant at the top serves great food with a panoramic view.",
        img: "https://www.nathhills.com/images/optim.jpg",
        desc: "A stunning hilltop retreat at Bhadi village on the Malnath Hills along NH-51. The hills are dotted with giant windmills that create a dramatic skyline. The Nath Hills resort offers panoramic valley views, an open-air restaurant, event venues and a rare hilltop experience unique to all of Saurashtra."
      },
    ];



    const NEARBY = [{
        id: 1,
        name: "Palitana",
        cat: "Spiritual",
        distance: "42 km",
        best: "Oct–Mar",
        lat: 21.533986646546165,
        lng: 71.8277549970066,
        entry: "Free",
        tips: "Start climbing by 6 AM to avoid the afternoon heat. Hire a doli (palanquin) if needed.",
        img: "https://bmcgujarat.com/media/y5ifnm3f/1__rx-bf1wofzi7-sgqds3ca.png",
        desc: "World's only city to legally ban meat. 900+ marble Jain temples on Shatrunjaya Hill — 3,500 steps with stunning Gulf views. UNESCO World Heritage tentative site. The sunrise view from the summit is among the most spectacular in all of India.",
        highlights: ["900+ Jain Temples", "3,500 Steps", "Shatrunjaya Hill", "World's Only Vegetarian City"]
      },
      {
        id: 2,
        name: "Velavadar NP",
        cat: "Wildlife",
        distance: "34 km",
        best: "Dec–Mar",
        lat: 22.043966098755316,
        lng: 72.02046097733044,
        entry: "Rs.20 + vehicle fee",
        tips: "Safaris run 6:30–9:30 AM and 3:30–6:30 PM. Park closed mid-June to mid-Oct. Rs.20 person entry + Rs.200-400 per vehicle. Hire a guide at the gate for the best blackbuck sightings.",
        img: "https://bmcgujarat.com/media/3phfsxhl/2-blackbucks-can-achive-speeds-of-upto-80-kmph-when-leaping-1.jpg",
        desc: "India's finest grassland sanctuary with 3,000+ blackbuck — the densest population on Earth. Also shelters wolves, foxes and the rare lesser florican. A UNESCO Biosphere Reserve candidate.",
        highlights: ["3000+ Blackbuck", "Lesser Florican", "Grassland Safari", "Bird Watching"]
      },
      {
        id: 3,
        name: "Diu",
        cat: "Beach Heritage",
        distance: "168 km",
        best: "Nov–Mar",
        lat: 20.719256062933944,
        lng: 70.98581818598922,
        entry: "Free",
        tips: "Stay overnight — Diu is completely different after sundown. Sunset at Nagoa Beach is legendary.",
        img: "https://s7ap1.scene7.com/is/image/incredibleindia/2-ghoghla-beach-diu-daman-and-diu-city-ff?qlt=82&ts=1726737882980",
        desc: "Former Portuguese colony with stunning beaches, a 16th-century sea fort and whitewashed churches. Unique fusion of Indo-Portuguese culture. Perfect coastal weekend escape from Bhavnagar.",
        highlights: ["16th Century Fort", "Nagoa Beach", "Portuguese Churches", "Fresh Seafood"]
      },
      {
        id: 4,
        name: "Sarangpur",
        cat: "Spiritual",
        distance: "59 km",
        best: "Year Round",
        lat: 22.157548401186165,
        lng: 71.77131340808889,
        entry: "Free",
        tips: "Visit on a Tuesday for the massive weekly pilgrimage gathering — absolutely extraordinary spectacle.",
        img: "https://www.templepurohit.com/wp-content/uploads/2016/04/Hanuman-temple-Salangpur.jpg",
        desc: "Home to Kashtabhanjan Hanumanji Temple and a magnificent BAPS marble complex. Draws 50,000+ pilgrims every Tuesday — one of Gujarat's most powerful temple towns.",
        highlights: ["Kashtabhanjan Hanuman", "BAPS Marble Temple", "50K+ Tuesday Pilgrims", "Prasad Meals"]
      },
      {
        id: 5,
        name: "Talaja Caves",
        cat: "History",
        distance: "47 km",
        best: "Oct–Mar",
        lat: 21.355598799079424,
        lng: 72.03274151315271,
        entry: "Free",
        tips: "Entry is free. Open 6 AM – 6 PM. Wear sturdy shoes — cave floors can be slippery. Carry a torch for the inner chambers. Combine with a Palitana visit on the same day.",
        img: "https://bmcgujarat.com/media/2zfm2oeg/talaja-caves-banner.jpg",
        desc: "Buddhist rock-cut caves from the 3rd century BCE carved into sandstone cliffs. Ancient monk meditation cells, rain-water cisterns and carved stupas dating back over 2,300 years.",
        highlights: ["3rd Century BCE", "Monk Cells", "Rock-Cut Stupas", "Ancient Cisterns"]
      },
      {
        id: 6,
        name: "Mahuva",
        cat: "Beach Nature",
        distance: "85 km",
        best: "Nov–Feb",
        lat: 21.092577044123452,
        lng: 71.77046301621769,
        entry: "Free",
        tips: "Try the fresh coconut at Bhavani Beach. The local market sells excellent dried garlic — Mahuva's famous export.",
        img: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0b/0e/4c/c6/mahuva-beach-bhavani.jpg?w=1200&h=-1&s=1",
        desc: "The Kashmir of Saurashtra — lush and serene. Bhavani Beach with an ancient hilltop temple, coconut groves and garlic farming. One of South Gujarat's most beautiful coastal escapes.",
        highlights: ["Bhavani Beach", "Ancient Temple", "Coconut Groves", "Mahuva Garlic"]
      },
      {
        id: 7,
        name: "Sihor",
        cat: "Heritage",
        distance: "21 km",
        best: "Oct–Mar",
        lat: 21.719529874862307,
        lng: 71.95960009800594,
        entry: "Free",
        tips: "Visit the old walled city lanes — some havelis are 300 years old and still occupied by original families.",
        img: "data:image/jpeg;base64,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",
        desc: "Ancient royal capital of the Gohil dynasty before Bhavnagar was founded. Famous for its ornate step-wells, old havelis, and the magnificent Sihor Fort overlooking the town.",
        highlights: ["Gohil Dynasty Capital", "Sihor Fort", "Ancient Step-Wells", "300-yr Old Havelis"]
      },
      {
        id: 8,
        name: "Gopnath Beach",
        cat: "Beach",
        distance: "62 km",
        best: "Oct–Mar",
        lat: 21.211571076958883,
        lng: 72.10721298562797,
        entry: "Free",
        tips: "The beach is deserted on weekdays — perfect for peaceful camping. Watch for dolphins in the early morning.",
        img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWFCt3flViglee1xxdgheZCyk_6GDrzpLaxQ&s",
        desc: "Remote and pristine beach at the tip of the Shetrunji river delta. Home to an ancient Gopnath Mahadev temple right on the shore, and one of Gujarat's few locations where dolphins are regularly spotted.",
        highlights: ["Gopnath Temple", "Dolphin Sightings", "Deserted Beach", "River Delta"]
      },
      {
        id: 9,
        name: "Lothal",
        cat: "History",
        distance: "83 km",
        best: "Nov–Feb",
        lat: 22.50689457340972,
        lng: 72.2350458001391,
        entry: "Rs.5 (ASI)",
        tips: "Open 10 AM – 5 PM, closed Friday. Entry just Rs.5 (ASI). Visit the museum first for context — the ancient dock and bead factory ruins are the highlights. Plan 2–3 hours for the full site.",
        img: "https://www.harappa.com/sites/default/files/styles/large/public/images/lothal-slideshow-image.jpg",
        desc: "One of the most important Indus Valley Civilisation sites in India, dating to 2400 BCE. Lothal had the world's first known tidal dock, a sophisticated grid city plan, and a bead-making industry that traded as far as Mesopotamia.",
        highlights: ["4500-Year-Old City", "World's First Dock", "Indus Valley Museum", "Ancient Beads"]
      },
      {
        id: 11,
        name: "Rajpara",
        cat: "Spiritual",
        distance: "16 km",
        best: "Year Round",
        lat: 21.722413412038414,
        lng: 72.00524403877735,
        entry: "Free",
        tips: "The annual cattle fair held here every winter draws thousands of Saurashtra farmers — a living slice of rural Gujarat.",
        img: "https://bmcgujarat.com/media/1bofuyfj/khodiyar-mandir-banner.jpg",
        desc: "Quiet agricultural town famous for a revered Mataji temple and an extraordinary winter cattle fair. A window into authentic rural Saurashtra life that most tourists never discover.",
        highlights: ["Mataji Temple", "Winter Cattle Fair", "Rural Saurashtra", "Local Crafts"]
      },
      {
        id: 13,
        name: "Gir National Park",
        cat: "Wildlife",
        distance: "174 km",
        best: "Dec–May",
        lat: 21.1688411606028,
        lng: 70.59854977634868,
        entry: "~Rs.5500–7000 per jeep",
        tips: "Book online at girlion.gujarat.gov.in at least 2–3 months in advance — slots fill very fast. Max 6 per jeep. Park closed mid-June to mid-Oct. Morning safari gives best lion sightings.",
        img: "https://lh3.googleusercontent.com/gps-cs-s/AHVAweor2vUJuat8c-cafkB37Y3IYdTN1S8qwIM_F69AI1gtpUJe85d9k2rq6eG_1sYY2ukUE6Z9DgK6-3gUdeCh_ebN4FWKb2nHOVVNWOCpUHwsy4I9ISu-tc1uVRae50DpxZEvcpXAxw=s1360-w1360-h1020-rw",
        desc: "The only home of the Asiatic Lion in the world. Gir National Park protects over 600 lions in 1,400 sq km of dry deciduous forest. A bucket-list wildlife experience just a 3-hour drive from Bhavnagar.",
        highlights: ["Asiatic Lions", "Leopards", "Jungle Safaris", "Over 600 Lions"]
      },
      {
        id: 14,
        name: "Shamlaji Temple",
        cat: "Spiritual",
        distance: "248 km",
        best: "Oct–Mar",
        lat: 23.68793659817596,
        lng: 73.3871761730132,
        entry: "Free",
        tips: "The annual Shamlaji Fair in November draws millions. Visit the ancient museum beside the temple too.",
        img: "https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/Shamlaji_Temple2_%28cropped%29.jpg/500px-Shamlaji_Temple2_%28cropped%29.jpg",
        desc: "A magnificent ancient Vishnu temple on the banks of the Meshvo River. One of the 108 Divya Desams of Vaishnavism. The 15th-century sculpture collection in the adjacent museum is among the finest in Gujarat.",
        highlights: ["Ancient Vishnu Temple", "Riverside Location", "November Fair", "Sculpture Museum"]
      },
      {
        id: 16,
        name: "Nalsarovar Bird Sanctuary",
        cat: "Wildlife",
        distance: "118 km",
        best: "Nov–Feb",
        lat: 22.82003749502405,
        lng: 72.045348640591,
        entry: "Rs.80",
        tips: "Hire a local boatman at the main jetty — they know exactly where the best flamingo flocks gather.",
        img: "data:image/jpeg;base64,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",
        desc: "One of India's largest bird sanctuaries — a vast shallow lake that attracts over 200 species including flamingos, pelicans and painted storks. Boat rides through the bird colonies at dawn are magical.",
        highlights: ["200+ Bird Species", "Flamingo Flocks", "Sunrise Boat Rides", "Pelicans"]
      },
      {
        id: 17,
        name: "Junagadh",
        cat: "Heritage",
        distance: "177 km",
        best: "Oct–Mar",
        lat: 21.52417878268781,
        lng: 70.45941089380386,
        entry: "Rs.50",
        tips: "Climb Girnar Hill (10,000 steps) for stunning views. The Mahabat Maqbara tombs are free to visit.",
        img: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Bahauddin_Maqbara_by_Kshitij.jpg/960px-Bahauddin_Maqbara_by_Kshitij.jpg",
        desc: "Ancient city at the foot of Mount Girnar, one of Gujarat most sacred hills. Features Buddhist caves dating to 250 BCE, Ashoka rock edicts, magnificent Islamic tombs and the start of the Girnar pilgrimage trail.",
        highlights: ["Girnar Hill", "Ashoka Edicts", "Buddhist Caves", "Mahabat Maqbara"]
      },
      {
        id: 18,
        name: "Dwarka",
        cat: "Spiritual",
        distance: "333 km",
        best: "Oct–Mar",
        lat: 22.244133222896945,
        lng: 68.96823488576239,
        entry: "Free",
        tips: "Visit the Dwarkadhish Temple at sunrise — the golden light on the temple spire is spectacular. The Bet Dwarka island (20 min boat) is a must-visit.",
        img: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Dwarakadheesh_Temple%2C_2014.jpg/960px-Dwarakadheesh_Temple%2C_2014.jpg",
        desc: "One of the four sacred dhams of Hinduism and the ancient kingdom of Lord Krishna. The 2,500-year-old Dwarkadhish Temple rises majestically on the banks of the Gomti River where it meets the Arabian Sea. A deeply moving pilgrimage destination.",
        highlights: ["Dwarkadhish Temple", "Bet Dwarka Island", "Gomti Ghat", "Sudama Setu"]
      },
    ];

    // section: "city" = in Bhavnagar, "nearby" = near a day-trip destination
    const FOODS = [

      // ── STREET FOOD / LOCAL LEGENDS ─────────────────────────────────────────────
      {
        id: 1,
        name: "Lachhubhai Ganthiyawala",
        type: "Veg",
        cat: "Street Food",
        rating: 4.6,
        budget: "Rs.20–80",
        specialty: "Pav Gathiya, Bhavnagri Gathiya",
        area: "Ghogha Circle",
        lat: 21.7624,
        lng: 72.1516,
        phone: "",
        open: "7 AM – 10 PM",
        desc: "Since 1951 — a true Bhavnagar icon. Ghogha Circle's most famous Pav Gathiya stall with over 70 years of legacy. The spongy gathiya stuffed in pav with house tamarind chutney is Bhavnagar's most iconic street bite.",
        tips: "The Pav Gathiya here is what every local recommends first to any visitor. Get it fresh in the morning.",
        mustTry: ["Pav Gathiya", "Bhavnagri Gathiya", "Nylon Gathiya"]
      },

      {
        id: 2,
        name: "Narsidas Bavabhai Gathiyawala",
        type: "Veg",
        cat: "Street Food",
        rating: 4.7,
        budget: "Rs.20–100",
        specialty: "Bhavnagri Gathiya, Lasaniya Gathiya",
        area: "Khargate",
        lat: 21.7618,
        lng: 72.1490,
        phone: "093771 00049",
        open: "8 AM – 8 PM",
        desc: "Established in 1920 — the oldest gathiya institution in Bhavnagar. Jawaharlal Nehru once ate here, making it part of the city's living history. Famous for Bhavnagri Gathiya in all varieties including garlic (lasaniya), methi and double mari.",
        tips: "One of the most historically significant snack shops in Saurashtra. Try the double mari vanela gathiya — a Bhavnagar original.",
        mustTry: ["Bhavnagri Gathiya", "Lasaniya Gathiya", "Methi Gathiya", "Champakali"]
      },

      {
        id: 3,
        name: "Jay Somnath Dal Puri",
        type: "Veg",
        cat: "Street Food",
        rating: 4.5,
        budget: "Rs.40–80",
        specialty: "Dal Puri, Aloo Curry",
        area: "Khargate",
        lat: 21.7618,
        lng: 72.1508,
        phone: "",
        open: "6 AM – 12 PM",
        desc: "A beloved breakfast institution in Bhavnagar's historic Khargate area. Hot fluffy puris with thick secret-spiced dal and spicy aloo curry — a ritual for generations of locals on weekend mornings.",
        tips: "Go before 9 AM — the dal runs out. Cash only, no frills, pure flavour.",
        mustTry: ["Dal Puri", "Aloo Curry", "Shrikhand Puri"]
      },

      {
        id: 4,
        name: "Bapa Sitaram Nasta Gruh",
        type: "Veg",
        cat: "Street Food",
        rating: 4.4,
        budget: "Rs.30–80",
        specialty: "Dal Puri, Farsan",
        area: "Kalanala",
        lat: 21.7630,
        lng: 72.1500,
        phone: "",
        open: "7 AM – 12 PM",
        desc: "A trusted morning institution in the Kalanala area. Popular for dal puri, fresh farsan and quick Gujarati breakfast items. Always busy with regulars who have been coming for decades.",
        tips: "Arrives early — opens at 7 AM and closes when food runs out. Very popular on weekday mornings.",
        mustTry: ["Dal Puri", "Fafda", "Khaman", "Sev Usal"]
      },

      {
        id: 5,
        name: "Pahadi Momos",
        type: "Veg",
        cat: "Street Food",
        rating: 4.6,
        budget: "Rs.40–100",
        specialty: "Steamed & Fried Momos",
        area: "Takhteshwar Hill",
        lat: 21.7638,
        lng: 72.1548,
        phone: "",
        open: "3 PM – 10 PM",
        desc: "A tiny wildly popular momo stall at the base of Takhteshwar hill (pahadi). Run by a local family for years, it draws long queues of students and evening walkers. The steamed momos with house-made red garlic chutney are extraordinary for the price.",
        tips: "Fried momos with schezwan chutney are the crowd favourite. Only open evenings — arrive by 5 PM.",
        mustTry: ["Steamed Momos", "Fried Momos", "Garlic Red Chutney"]
      },

      {
        id: 6,
        name: "Balaji Ice Dish Gola",
        type: "Veg",
        cat: "Street Food",
        rating: 4.3,
        budget: "Rs.20–60",
        specialty: "Ice Gola, Kala Khatta",
        area: "Ghogha Circle",
        lat: 21.7622,
        lng: 72.1514,
        phone: "",
        open: "11 AM – 10 PM",
        desc: "A beloved shaved ice stall at Ghogha Circle. Colourful ice golas drenched in flavoured syrups — a summer staple for locals and a refreshing stop after exploring the old city market area.",
        tips: "Kala Khatta and Kesar are the most popular flavours. Best on a hot afternoon.",
        mustTry: ["Kala Khatta Gola", "Kesar Gola", "Mixed Fruit Gola"]
      },

      {
        id: 7,
        name: "Shree Ram Farsan",
        type: "Veg",
        cat: "Street Food",
        rating: 4.3,
        budget: "Rs.30–100",
        specialty: "Bhavnagri Gathiya, Bhajiya",
        area: "Ghogha Circle",
        lat: 21.7630,
        lng: 72.1530,
        phone: "",
        open: "8 AM – 9 PM",
        desc: "Since 1962 — one of Bhavnagar's most loved farsan shops with 40+ varieties. Famous for soft Bhavnagri Gathiya and fresh bhajiya. A great place to also pick up vacuum-packed snacks as gifts to take home.",
        tips: "Vacuum-packed Bhavnagri Gathiya makes the best souvenir from Bhavnagar.",
        mustTry: ["Bhavnagri Gathiya", "Bhajiya", "Chakri", "Mohanthal"]
      },

      // ── RESTAURANTS / DINING ─────────────────────────────────────────────────────
      {
        id: 8,
        name: "Nilambag Palace Dining",
        type: "Veg",
        cat: "Restaurant",
        rating: 4.8,
        budget: "Rs.400–900",
        specialty: "Royal Gujarati Thali",
        area: "Nilambag Palace",
        lat: 21.7574,
        lng: 72.1540,
        phone: "+912782424241",
        open: "7:30 AM – 10:30 PM",
        desc: "Dine like royalty in the 19th-century palace dining hall. An 18-dish Royal Thali with sev tameta, methi dhokla, mohanthal and shrikhand. Non-guests can visit the restaurant without booking a room.",
        tips: "Book the garden dinner in advance for a heritage experience under the stars.",
        mustTry: ["Royal Gujarati Thali", "Shrikhand Puri", "Mohanthal", "Sev Tameta"]
      },

      {
        id: 9,
        name: "Rasoi Dining Hall",
        type: "Veg",
        cat: "Restaurant",
        rating: 4.5,
        budget: "Rs.120–250",
        specialty: "Gujarati Thali, Dal Dhokli",
        area: "Kalanala",
        lat: 21.7628,
        lng: 72.1505,
        phone: "02782522535",
        open: "11 AM – 3:30 PM and 6:30 – 10:30 PM",
        desc: "One of Bhavnagar's most consistently praised dining halls for authentic Gujarati thali. Unlimited refills of dal, rotla and seasonal sabji in a clean, family-friendly setting. Located on Kalubha Road near Madhav Jyot.",
        tips: "Lunch thali is the best value — arrive by 12:30 PM on weekdays to avoid waiting.",
        mustTry: ["Gujarati Thali", "Dal Dhokli", "Kadhi Khichdi", "Chaas"]
      },

      {
        id: 10,
        name: "Jalaram Paratha House",
        type: "Veg",
        cat: "Restaurant",
        rating: 4.4,
        budget: "Rs.80–180",
        specialty: "Butter Paratha, Sev Tameta",
        area: "Kalanala",
        lat: 21.7625,
        lng: 72.1498,
        phone: "",
        open: "7 AM – 3 PM and 6:30 – 10:30 PM",
        desc: "A cherished local restaurant on Kalanala Road known for its buttery parathas and authentic Kathiyawadi sev tameta — a tangy tomato curry topped with fine sev. Simple, hearty and honest food loved by locals.",
        tips: "Sev Tameta with butter paratha is a combo locals swear by. Best for breakfast or early lunch.",
        mustTry: ["Butter Paratha", "Sev Tameta", "Masala Chai"]
      },

      {
        id: 11,
        name: "Shiv Shakti Kathiyawadi Dhaba",
        type: "Veg",
        cat: "Restaurant",
        rating: 4.3,
        budget: "Rs.80–200",
        specialty: "Bajra Rotla, Lasaniya Bataka",
        area: "Ghogha Highway",
        lat: 21.7400,
        lng: 72.1750,
        phone: "",
        open: "11 AM – 4 PM and 7 – 11 PM",
        desc: "A classic highway dhaba on the Ghogha road serving authentic Kathiyawadi food. Famous for bajra rotla with lasaniya bataka — garlic-spiced potato curry — and unlimited chaas. A true taste of rural Saurashtra.",
        tips: "Best visited on the way to Ghogha Beach or Alang. Order the bajra thali — you'll need to loosen your belt.",
        mustTry: ["Bajra Rotla", "Lasaniya Bataka", "Dal", "Chaas"]
      },

      {
        id: 12,
        name: "Mahavir Restaurant",
        type: "Veg",
        cat: "Restaurant",
        rating: 4.2,
        budget: "Rs.100–220",
        specialty: "Gujarati Thali",
        area: "Hill Park / Sidsar Road",
        lat: 21.7580,
        lng: 72.1580,
        phone: "",
        open: "11 AM – 3 PM and 7 – 10:30 PM",
        desc: "A reliable Gujarati thali restaurant near Hill Park area, popular with locals from the surrounding residential areas. Consistent quality, generous portions and good value lunch thali.",
        tips: "Good option if you are exploring the Hill Drive area and need a filling Gujarati meal.",
        mustTry: ["Gujarati Thali", "Kadhi", "Rotla", "Chaas"]
      },

      {
        id: 13,
        name: "RGB Restaurant",
        type: "Veg",
        cat: "Restaurant",
        rating: 4.3,
        budget: "Rs.200–400",
        specialty: "North Indian, Chinese",
        area: "Waghawadi Road",
        lat: 21.7632,
        lng: 72.1620,
        phone: "",
        open: "11 AM – 11 PM",
        desc: "A popular multi-cuisine vegetarian restaurant at Hotel Sun N Shine on Waghawadi Road. Extensive North Indian and Chinese menu — clean interiors, reliable quality and a safe choice for families who want variety beyond Gujarati food.",
        tips: "Paneer dishes and the Chinese section are the highlights. Good for mixed groups with different preferences.",
        mustTry: ["Paneer Tikka Masala", "Veg Manchurian", "Dal Makhani", "Naan"]
      },

      // ── CAFES / MODERN FOOD ──────────────────────────────────────────────────────
      {
        id: 14,
        name: "The Chocolate Room",
        type: "Veg",
        cat: "Cafe",
        rating: 4.1,
        budget: "Rs.150–350",
        specialty: "Chocolate Desserts, Shakes",
        area: "Waghawadi Road",
        lat: 21.7560,
        lng: 72.1630,
        phone: "",
        open: "11 AM – 10:30 PM",
        desc: "Bhavnagar's favourite dessert cafe near Valentine Circle on Waghawadi Road. Famous for an indulgent range of chocolate desserts — sizzling brownies, hot chocolates and thick shakes. A go-to spot for students and sweet-toothed families.",
        tips: "The hot sizzling brownie with ice cream is the signature must-try. Best visited after dinner for dessert.",
        mustTry: ["Sizzling Brownie", "Hot Chocolate", "Waffles", "Chocolate Shake"]
      },

      {
        id: 15,
        name: "Coffee Culture",
        type: "Veg",
        cat: "Cafe",
        rating: 4.2,
        budget: "Rs.120–300",
        specialty: "Coffee, Pizza, Sizzlers",
        area: "Hill Drive / Waghawadi",
        lat: 21.7558,
        lng: 72.1628,
        phone: "",
        open: "10 AM – 11 PM",
        desc: "Bhavnagar's most popular Italian-style coffee cafe with a social, modern atmosphere. Known for Rainbow Coffee and Cappuccino Latte, plus a menu covering pizzas, pastas, sizzlers and desserts. Popular with students and young professionals.",
        tips: "Try the Rainbow Coffee — it's their signature. Good for a long catch-up session with friends.",
        mustTry: ["Rainbow Coffee", "Cappuccino Latte", "Farmhouse Pizza", "Veg Sizzler"]
      },

      // ── SWEETS / SNACKS ──────────────────────────────────────────────────────────
      {
        id: 16,
        name: "Mehta Sweets",
        type: "Veg",
        cat: "Sweets",
        rating: 4.3,
        budget: "Rs.40–200",
        specialty: "Ghari, Peda, Mithai",
        area: "Kalanala Market",
        lat: 21.7631,
        lng: 72.1495,
        phone: "",
        open: "8 AM – 9 PM",
        desc: "A popular local sweet shop in Kalanala Market known for traditional Gujarati mithai — Ghari, Peda and seasonal sweets. A go-to for locals during festivals and celebrations.",
        tips: "Ghari is a Bhavnagar-style rich sweet — try the fresh batch in the morning.",
        mustTry: ["Ghari", "Peda", "Mohanthal", "Ladoo"]
      },

      {
        id: 17,
        name: "Gwalia Sweets & Fast Food",
        type: "Veg",
        cat: "Sweets",
        rating: 4.4,
        budget: "Rs.50–300",
        specialty: "Mithai, Ice Cream, Farsan",
        area: "ISCON Mega City",
        lat: 21.7552,
        lng: 72.1628,
        phone: "",
        open: "9 AM – 10:30 PM",
        desc: "A well-known Gujarat sweet chain at ISCON Mega City. Massive range of traditional Indian sweets including Kaju Katli, Gulab Jamun and Kesar Katli, plus farsan, ice cream and ready-to-eat snacks. Great for festival orders and gifting.",
        tips: "Pre-order hampers 2–4 days in advance for festivals and bulk orders.",
        mustTry: ["Kaju Katli", "Kesar Katli", "Gulab Jamun", "Dahi Chaat"]
      },

      // ── NON-VEG ──────────────────────────────────────────────────────────────────
      {
        id: 18,
        name: "Hotel Yadgar",
        type: "Non-Veg",
        cat: "Non-Veg",
        rating: 4.2,
        budget: "Rs.150–350",
        specialty: "Chicken Biryani, Mughlai",
        area: "Near Railway Station",
        lat: 21.7643,
        lng: 72.1449,
        phone: "",
        open: "11 AM – 11 PM",
        desc: "One of Bhavnagar's most recommended non-vegetarian restaurants near the Railway Station in the Handiyavad area. Known for flavourful Chicken Biryani and Mughlai dishes. A reliable option for non-veg food in a primarily vegetarian city.",
        tips: "Chicken Biryani is the crowd favourite. Arrive by 1 PM for lunch — gets crowded quickly.",
        mustTry: ["Chicken Biryani", "Mughlai Chicken", "Seekh Kebab"]
      },

      // ── CHAINS ───────────────────────────────────────────────────────────────────
      {
        id: 19,
        name: "Domino's — Surabhi Mall",
        type: "Veg",
        cat: "Chain",
        rating: 4.0,
        budget: "Rs.200–500",
        specialty: "Pizza, Garlic Bread",
        area: "Waghawadi Road",
        lat: 21.7558,
        lng: 72.1625,
        phone: "",
        open: "11 AM – 11 PM",
        desc: "The Domino's outlet at Surabhi Mall on Waghawadi Road — the city's most accessible pizza option for dine-in. Reliable quality, quick service and popular for family outings and student groups.",
        tips: "Online ordering gives extra discounts. Farmhouse and Peppy Paneer are local favourites.",
        mustTry: ["Farmhouse Pizza", "Garlic Bread", "Peppy Paneer", "Pasta"]
      },

      {
        id: 20,
        name: "Domino's — ISCON Mega City",
        type: "Veg",
        cat: "Chain",
        rating: 3.9,
        budget: "Rs.200–500",
        specialty: "Pizza (Delivery focus)",
        area: "Vidhyanagar",
        lat: 21.7550,
        lng: 72.1622,
        phone: "",
        open: "11 AM – 11 PM",
        desc: "The Domino's outlet at ISCON Mega City, mainly popular for delivery across the Vidhyanagar and Waghawadi area. Convenient for hotel stays in the area when you want a quick familiar meal.",
        tips: "Better for delivery than dine-in. Use the app for faster ordering and combo deals.",
        mustTry: ["Peppy Paneer Pizza", "Garlic Bread Sticks", "Choco Lava Cake"]
      },

      {
        id: 21,
        name: "Pizza Hut",
        type: "Veg",
        cat: "Chain",
        rating: 3.9,
        budget: "Rs.300–600",
        specialty: "Dine-in Pan Pizza",
        area: "Waghawadi Road",
        lat: 21.7555,
        lng: 72.1622,
        phone: "",
        open: "11 AM – 11 PM",
        desc: "Bhavnagar's Pizza Hut outlet on Waghawadi Road. Full dine-in experience with pan pizzas, pastas and sides. A comfortable option for families wanting a familiar international chain with proper seating.",
        tips: "Pan crust pizzas are better than thin crust here. Weekday lunch deals offer good value.",
        mustTry: ["Pan Pizza", "Stuffed Garlic Bread", "Pasta", "Choco Lava Cake"]
      },

      {
        id: 22,
        name: "Subway Bhavnagar",
        type: "Veg",
        cat: "Chain",
        rating: 4.0,
        budget: "Rs.150–350",
        specialty: "Submarine Sandwich",
        area: "Vidhyanagar",
        lat: 21.7549,
        lng: 72.1618,
        phone: "",
        open: "10 AM – 11 PM",
        desc: "Subway's Bhavnagar outlet in Vidhyanagar. Customizable submarine sandwiches with fresh ingredients — popular with the student crowd and office-goers looking for a quick healthy meal.",
        tips: "The Aloo Patty and Paneer Tikka subs are the most popular locally. Build your own for best value.",
        mustTry: ["Paneer Tikka Sub", "Aloo Patty Sub", "Veggie Delight", "Cookie"]
      },

      // ── 🏍️ HIDDEN GEMS ────────────────────────────────────────────────────────
      {
        id: 23,
        name: "Burger Singh Bhavnagar",
        type: "Veg",
        cat: "Hidden Gem",
        rating: 4.2,
        budget: "Rs.150–350",
        specialty: "Indian-style Burgers",
        area: "Near ISCON / Victoria Park",
        lat: 21.7552,
        lng: 72.1610,
        phone: "",
        open: "11 AM – 11 PM",
        desc: "A popular Indian fast-food chain at Bhavnagar with desi-style burgers — think spicy aloo tikki patties, paneer burgers and masala-laden buns. A fun local take on the classic burger concept.",
        tips: "Try the Maharaja Burger — their signature Indian-spiced beef alternative patty.",
        mustTry: ["Maharaja Burger", "Chilli Cheese Burger", "Loaded Fries"]
      },
      {
        id: 24,
        name: "Jay Khodiyar Sandwich",
        type: "Veg",
        cat: "Hidden Gem",
        rating: 4.3,
        budget: "Rs.40–100",
        specialty: "Loaded Sandwich",
        area: "Kalanala / College Area",
        lat: 21.7630,
        lng: 72.1490,
        phone: "",
        open: "9 AM – 10 PM",
        desc: "A beloved sandwich stall near the college area loaded with vegetables, cheese, spicy chutneys and Bhavnagar's signature touch. A student favourite with generous portions and unbeatable value.",
        tips: "Ask for extra green chutney — it's what makes their sandwich unique.",
        mustTry: ["Loaded Veg Sandwich", "Cheese Sandwich", "Masala Toast"]
      },
      {
        id: 25,
        name: "Aslam Frankie",
        type: "Veg",
        cat: "Hidden Gem",
        rating: 4.2,
        budget: "Rs.40–80",
        specialty: "Frankie Rolls",
        area: "Near Gulista / City Centre",
        lat: 21.7635,
        lng: 72.1520,
        phone: "",
        open: "11 AM – 10 PM",
        desc: "A popular frankie stall near Gulista known for its spicy, tightly-wrapped rolls. A quick, filling and affordable street meal with a loyal following of students and evening walkers.",
        tips: "The paneer frankie is the most popular. Add extra schezwan sauce.",
        mustTry: ["Paneer Frankie", "Aloo Frankie", "Veg Roll"]
      },
      {
        id: 26,
        name: "Prayosha Hot Dog Stall",
        type: "Veg",
        cat: "Hidden Gem",
        rating: 4.1,
        budget: "Rs.30–60",
        specialty: "Hot Dog",
        area: "Near Atabhai Joggers Park",
        lat: 21.7600,
        lng: 72.1480,
        phone: "",
        open: "4 PM – 10 PM",
        desc: "Bhavnagar's only dedicated hot dog stall near Atabhai Joggers Park. A quirky local snack stop that draws joggers and evening walkers. Simple but remarkably popular.",
        tips: "Best visited at 6 PM when evening walkers stop by. Fresh and quick.",
        mustTry: ["Classic Hot Dog", "Cheese Hot Dog"]
      },
      {
        id: 27,
        name: "Balaji Gola (Sahakari Haat)",
        type: "Veg",
        cat: "Hidden Gem",
        rating: 4.3,
        budget: "Rs.20–50",
        specialty: "Ice Gola, Limbu Soda",
        area: "Ghogha Circle / Sahakari Haat",
        lat: 21.7622,
        lng: 72.1510,
        phone: "",
        open: "10 AM – 10 PM",
        desc: "The original Ram aur Shyam ice gola stall at Sahakari Haat, Ghogha Circle. Famous for colourful ice golas and refreshing Limbu Gola. A summer ritual for Bhavnagar residents.",
        tips: "Kala Khatta is their signature flavour. Also try the fresh-squeezed lime gola.",
        mustTry: ["Kala Khatta Gola", "Kesar Gola", "Limbu Gola"]
      },

      // ── 🍕 LOCAL FAST FOOD ─────────────────────────────────────────────────────
      {
        id: 28,
        name: "Dilip Pav Gathiya",
        type: "Veg",
        cat: "Fast Food",
        rating: 4.5,
        budget: "Rs.20–50",
        specialty: "Pav Gathiya",
        area: "Waghawadi Road (Vishwakarma Circle)",
        lat: 21.7560,
        lng: 72.1600,
        phone: "",
        open: "7 AM – 2 PM",
        desc: "Since 1969 — a legendary institution near Vishwakarma Circle on Waghawadi Road. Famous for using special small-sized pavs with a unique tamarind chutney. One of the most historically significant pav gathiya stalls in the city.",
        tips: "Visit before 10 AM for the freshest batch. Cash only.",
        mustTry: ["Pav Gathiya", "Chana Math", "Masala Chai"]
      },
      {
        id: 29,
        name: "Pappubhai Chaat",
        type: "Veg",
        cat: "Fast Food",
        rating: 4.4,
        budget: "Rs.30–80",
        specialty: "Pani Puri, Dahi Puri",
        area: "Near Kalanala",
        lat: 21.7632,
        lng: 72.1498,
        phone: "",
        open: "11 AM – 9 PM",
        desc: "Bhavnagar's most famous chaat stall near Kalanala area. The pani puri is crisp, the pani is perfectly spiced, and the dahi puri is a flavour explosion. A must-stop for any food lover visiting the city.",
        tips: "Go in the evening when the chaat is freshest. Try both pani puri and dahi puri.",
        mustTry: ["Pani Puri", "Dahi Puri", "Sev Puri"]
      },
      {
        id: 30,
        name: "Wimpey's",
        type: "Veg",
        cat: "Fast Food",
        rating: 4.1,
        budget: "Rs.80–200",
        specialty: "Burgers, Sandwiches",
        area: "Waghawadi Road",
        lat: 21.7558,
        lng: 72.1625,
        phone: "",
        open: "10 AM – 10:30 PM",
        desc: "A popular local fast food joint on Waghawadi Road known for its burgers and sandwiches. A favourite with the young crowd and families looking for a quick, affordable Western-style meal in a comfortable setting.",
        tips: "The grilled sandwich is better than the burger here. Ask for extra mayo.",
        mustTry: ["Grilled Sandwich", "Veg Burger", "Cold Coffee"]
      },
      {
        id: 31,
        name: "Mahant Fast Food",
        type: "Veg",
        cat: "Fast Food",
        rating: 4.0,
        budget: "Rs.50–150",
        specialty: "Quick Snacks, Fast Food",
        area: "Near Airport",
        lat: 21.7720,
        lng: 72.1050,
        phone: "",
        open: "8 AM – 10 PM",
        desc: "A quick-service food stall near Bhavnagar airport area. Popular with travelers and airport staff for its affordable and filling snacks. Reliable quality and fast service.",
        tips: "Good for a quick bite before or after a flight. Try the local snacks platter.",
        mustTry: ["Veg Puff", "Samosa", "Masala Chai"]
      },
      {
        id: 32,
        name: "KFC Bhavnagar",
        type: "Non-Veg",
        cat: "Chain",
        rating: 3.8,
        budget: "Rs.300–600",
        specialty: "Fried Chicken",
        area: "Vartej Highway",
        lat: 21.7850,
        lng: 72.1200,
        phone: "",
        open: "11 AM – 11 PM",
        desc: "Bhavnagar's KFC outlet on the Vartej Highway. The only major international fried chicken chain in the city. Popular with non-veg food lovers and families wanting a quick highway meal stop.",
        tips: "Located on the highway — good stop en route to/from Ahmedabad or airport.",
        mustTry: ["Crispy Chicken Burger", "Bucket Chicken", "Zinger Burger"]
      },
      {
        id: 33,
        name: "Zam Zam Restaurant",
        type: "Non-Veg",
        cat: "Non-Veg",
        rating: 4.1,
        budget: "Rs.150–400",
        specialty: "Mughlai, Biryani",
        area: "Kalanala Area",
        lat: 21.7628,
        lng: 72.1488,
        phone: "",
        open: "11 AM – 11 PM",
        desc: "A well-known Mughlai restaurant in the Kalanala area serving fragrant biryanis, kebabs and curry dishes. One of the few good non-vegetarian options in a predominantly vegetarian city. Consistent quality and generous portions.",
        tips: "The Chicken Dum Biryani is their signature dish — rich and aromatic.",
        mustTry: ["Chicken Dum Biryani", "Seekh Kebab", "Mutton Curry", "Roomali Roti"]
      },

    ];


    // ── NEARBY_FOODS — food near day-trip destinations ────────────────────────────
    const NEARBY_FOODS = [{
        id: 1,
        name: "Palitana Prasad Bhojanshala",
        type: "Veg",
        rating: 4.5,
        budget: "Rs.50-100",
        specialty: "Jain Thali, Prasad Meals",
        nearDest: "Palitana",
        lat: 21.5242,
        lng: 71.8224,
        open: "6 AM – 2 PM",
        address: "Near Taleti Base, Palitana",
        img: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Gujarati_Thali.jpg/640px-Gujarati_Thali.jpg",
        desc: "Community-run Jain bhojanshala at the base of Shatrunjaya Hill. Pure Jain vegetarian — no onion, no garlic. Wholesome thali served to pilgrims and visitors at rock-bottom prices. Best eaten after the descent from Palitana.",
        tips: "Eat here after the climb — the simple khichdi and kadhi will restore you. Cash only.",
        mustTry: ["Jain Thali", "Khichdi", "Kadhi", "Papad"]
      },
      {
        id: 2,
        name: "Hotel Sumeru, Palitana",
        type: "Veg",
        rating: 4.3,
        budget: "Rs.100-220",
        specialty: "Gujarati & Jain Thali",
        nearDest: "Palitana",
        lat: 21.5250,
        lng: 71.8230,
        open: "7 AM – 10 PM",
        address: "Station Road, Palitana",
        img: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Gujarati_food.jpg/640px-Gujarati_food.jpg",
        desc: "Best sit-down restaurant in Palitana town. Clean interiors, reliable Gujarati and Jain thali, and a cold lassi after the Shatrunjaya pilgrimage that feels absolutely earned.",
        tips: "Book a table for large groups. The cold lassi after the pilgrimage is the best Rs.40 you'll spend.",
        mustTry: ["Gujarati Thali", "Lassi", "Puri Shaak"]
      },
      {
        id: 3,
        name: "Near Velavadar Canteen",
        type: "Veg",
        rating: 4.1,
        budget: "Rs.80-180",
        specialty: "Gujarati Thali, Snacks",
        nearDest: "Velavadar NP",
        lat: 21.9166,
        lng: 71.9540,
        open: "8 AM – 8 PM",
        address: "Near Velavadar NP Entry Gate",
        img: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Gujarati_Thali.jpg/640px-Gujarati_Thali.jpg",
        desc: "Simple canteen near the Velavadar NP entrance. Basic Gujarati meals — thali, rotla, chaas. Your best option before or after the safari when you don't want to drive all the way back to Bhavnagar to eat.",
        tips: "Pack additional snacks — options inside the park are zero. The rotla here is filling and good fuel before a long safari walk.",
        mustTry: ["Bajra Rotla", "Gujarati Thali", "Chaas"]
      },
      {
        id: 4,
        name: "Girnar Dhaba, Junagadh",
        type: "Veg",
        rating: 4.3,
        budget: "Rs.80-200",
        specialty: "Kathiyawadi Thali, Bajra Rotla",
        nearDest: "Junagadh",
        lat: 21.5222,
        lng: 70.4579,
        open: "7 AM – 10 PM",
        address: "Near Girnar Ropeway Base, Junagadh",
        img: "https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Gujarati_Thali.jpg/640px-Gujarati_Thali.jpg",
        desc: "Famous dhaba at the foot of Girnar Hill, loved by pilgrims and trekkers finishing the 10,000-step climb. Hearty Kathiyawadi thali with bajra rotla, ringan olo and unlimited chaas.",
        tips: "Eat here before starting the Girnar climb — the rotla gives lasting energy for the 10,000-step ascent.",
        mustTry: ["Kathiyawadi Thali", "Bajra Rotla", "Ringan Olo", "Chaas"]
      },
      {
        id: 5,
        name: "Rasoi Restaurant, Diu",
        type: "Veg",
        rating: 4.5,
        budget: "Rs.120-350",
        specialty: "Diu Cuisine, Gujarati Thali",
        nearDest: "Diu",
        lat: 20.7141,
        lng: 70.9876,
        open: "9 AM – 11 PM",
        address: "Collectorate Road, Diu",
        img: "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Gujarati_food.jpg/640px-Gujarati_food.jpg",
        desc: "One of Diu's top-rated local restaurants. Blends Gujarati flavours with Portuguese-influenced Diu cuisine. The Diu-style fish curry is exceptional for non-vegetarians. Vegetarians love the thali with coconut chutney.",
        tips: "Diu has a uniquely relaxed food culture — try the coconut-based dishes you won't find on the Gujarat mainland.",
        mustTry: ["Diu Fish Curry", "Gujarati Thali", "Coconut Chutney"]
      },
      {
        id: 6,
        name: "ASI Canteen, Lothal",
        type: "Veg",
        rating: 4.0,
        budget: "Rs.60-120",
        specialty: "Simple Gujarati Meals",
        nearDest: "Lothal",
        lat: 22.5200,
        lng: 72.2500,
        open: "9 AM – 5 PM",
        address: "Inside ASI Lothal Complex",
        img: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Dhokla.jpg/640px-Dhokla.jpg",
        desc: "Simple canteen inside the ASI Lothal archaeological complex. Basic dal, roti and chaas — nothing fancy, but convenient after 2-3 hours exploring the 4,500-year-old Indus Valley site on foot.",
        tips: "Pack snacks if you are picky — options are minimal at Lothal. The canteen suits a mid-visit break.",
        mustTry: ["Dal Rice", "Roti Sabji", "Chaas"]
      },
    ];

    // ── HOTELS & STAYS ───────────────────────────────────────────────────────────
    const HOTELS = [

      // ULTRA BUDGET — ₹100–500
      {
        id: 1,
        name: "Jain Dharamshala",
        tier: "ultra",
        price: "₹100–300",
        rating: 0,
        area: "Near Old City / Temples",
        desc: "Community-run Jain dharamshalas near the old city temples. Basic clean rooms with shared bathrooms. Primarily for Jain pilgrims but generally open to respectful guests. Very basic, very affordable.",
        type: "Dharamshala",
        amenities: ["Basic rooms", "Shared bathroom", "Spiritual environment"]
      },
      {
        id: 2,
        name: "Swaminarayan Dharamshala",
        tier: "ultra",
        price: "₹100–300",
        rating: 0,
        area: "Near BAPS Temple",
        desc: "Accommodation run by the Swaminarayan Sanstha near the temple complex. Clean, disciplined environment. Best for spiritual travelers visiting BAPS or nearby temples. Availability depends on pilgrim season.",
        type: "Dharamshala",
        amenities: ["Basic rooms", "Clean", "Spiritual setting"]
      },

      // BUDGET — ₹500–1500
      {
        id: 3,
        name: "Hotel Mini",
        tier: "budget",
        price: "₹600–1,200",
        rating: 3.8,
        area: "City Centre",
        desc: "A compact no-frills budget hotel in the city centre. Clean basic rooms, convenient location for exploring the old city. Popular with solo travelers and backpackers on a tight budget.",
        type: "Hotel",
        amenities: ["AC rooms", "City centre location", "24hr reception"]
      },
      {
        id: 4,
        name: "Hotel Jubilee",
        tier: "budget",
        price: "₹1,200–2,000",
        rating: 3.6,
        area: "Crescent Circle",
        desc: "Located near Crescent Circle market area, one of Bhavnagar's oldest hotels. Budget rooms with basic amenities. Good access to the old city market, Gandhi Smriti and Barton Museum. Listed on OYO.",
        type: "Hotel",
        amenities: ["AC rooms", "Near market", "Free WiFi", "24hr reception"]
      },
      {
        id: 5,
        name: "Hotel Relax Inn",
        tier: "budget",
        price: "₹800–1,500",
        rating: 3.9,
        area: "Near Railway Station",
        desc: "A budget hotel conveniently located 1 km from Bhavnagar Railway Station. Functional clean rooms, useful for early morning train departures or arrivals. Free WiFi and 24-hour service.",
        type: "Hotel",
        amenities: ["Free WiFi", "Near railway", "AC rooms", "Parking"]
      },

      // BUDGET COMFORT — ₹1500–2500
      {
        id: 6,
        name: "Hotel Sun N Shine",
        tier: "comfort",
        price: "₹1,800–2,500",
        rating: 3.8,
        area: "Waghawadi Road",
        desc: "A reliable mid-budget hotel on Waghawadi Road housing the popular RGB Restaurant. Clean rooms, central location on the city's main commercial strip. Good for families and business travelers wanting a familiar standard without premium pricing.",
        type: "Hotel",
        amenities: ["Restaurant", "Free WiFi", "AC rooms", "Parking", "City location"]
      },
      {
        id: 7,
        name: "Hotel White Rose",
        tier: "comfort",
        price: "₹1,200–2,000",
        rating: 4.0,
        area: "Near Bus Stand / Victoria",
        desc: "A clean and peaceful budget hotel near the bus stand, railway station and airport. Convenient for travelers in transit. Opposite Vithawadi — easy access to Victoria Park.",
        type: "Hotel",
        amenities: ["Near bus stand", "AC rooms", "Free WiFi", "Airport accessible"]
      },
      {
        id: 8,
        name: "Hotel The Sankalp Retreat",
        tier: "comfort",
        price: "₹1,400–2,500",
        rating: 4.3,
        area: "Main City",
        desc: "One of Bhavnagar's most highly reviewed budget-comfort hotels. Closest hotel to the city centre at 2.1 km. Clean modern rooms, good service and reliable amenities make it a top pick in this price range.",
        type: "Hotel",
        amenities: ["Restaurant", "Free WiFi", "AC rooms", "Parking", "24hr service"]
      },

      // MID-RANGE — ₹2500–4500
      {
        id: 9,
        name: "Hotel Virgo Sumeru",
        tier: "midrange",
        price: "₹2,800–4,500",
        rating: 4.1,
        area: "Waghawadi Road",
        desc: "A well-appointed 3-star hotel on Waghawadi Road beside HDFC Bank. Modern rooms, business-class amenities and a good restaurant. Popular with corporate travelers and families wanting comfort without luxury pricing.",
        type: "Hotel",
        amenities: ["Restaurant", "Free WiFi", "AC rooms", "Parking", "Business centre", "Room service"]
      },
      {
        id: 10,
        name: "Hotel Clarks Collection",
        tier: "midrange",
        price: "₹2,500–3,500",
        rating: 4.8,
        area: "City Centre",
        desc: "TripAdvisor's top-rated hotel in Bhavnagar with a 4.8 rating. Clean rooms, excellent staff behaviour and a Chinese restaurant on premises. Central city location gives access to all major attractions. Very good value for the price.",
        type: "Hotel",
        amenities: ["Restaurant", "Free WiFi", "AC rooms", "Parking", "Fitness centre"]
      },
      {
        id: 11,
        name: "Narayani Heritage",
        tier: "midrange",
        price: "₹2,500–4,000",
        rating: 4.3,
        area: "City Area",
        desc: "A heritage-themed mid-range property with traditional design elements. Popular with families visiting Bhavnagar for tourism. Clean rooms, good hospitality and a peaceful atmosphere away from main road noise.",
        type: "Hotel",
        amenities: ["Restaurant", "Free WiFi", "AC rooms", "Heritage décor", "Parking"]
      },
      {
        id: 12,
        name: "The Basil Park",
        tier: "midrange",
        price: "₹3,000–4,500",
        rating: 4.1,
        area: "ISCON / Victoria Park",
        desc: "A modern hotel opposite Victoria Park near ISCON Mega City. Clean contemporary rooms, in-house restaurant and easy access to the park, science centre and Waghawadi Road shopping. A reliable mid-range choice.",
        type: "Hotel",
        amenities: ["Restaurant", "Free WiFi", "AC rooms", "Parking", "Modern amenities"]
      },
      {
        id: 13,
        name: "Top3 Lords Resort",
        tier: "midrange",
        price: "₹2,600–3,500",
        rating: 4.7,
        area: "Near Airport / Outskirts",
        desc: "Bhavnagar's highest-rated resort property (4.7 on TripAdvisor). Located on Budhel-Vertej Cross Road near the airport. Excellent rooms, spa, pool and restaurant. A resort feel at a mid-range price — the best value property in Bhavnagar for leisure travelers.",
        type: "Resort",
        amenities: ["Pool", "Spa", "Restaurant", "Free WiFi", "Parking", "Garden", "Fitness centre"]
      },

      // PREMIUM — ₹4500+
      {
        id: 14,
        name: "Efcee Sarovar Premiere",
        tier: "premium",
        price: "₹4,500–7,000",
        rating: 4.5,
        area: "Near Victoria Park",
        desc: "A premium 4-star hotel opposite Victoria Park near ISCON Mega City. Rated 8.0/10 on Hotels Combined with 332 reviews. Excellent rooms, multiple dining options, spa, pool and one of the best breakfast spreads in the city. Highly recommended for couples and families.",
        type: "Hotel",
        amenities: ["Pool", "Spa", "Restaurant", "Free WiFi", "Parking", "Gym", "24hr room service", "Bar"]
      },
      {
        id: 15,
        name: "Iscon The Fern Resort & Spa",
        tier: "premium",
        price: "₹2,800–4,500",
        rating: 4.5,
        area: "Opposite Victoria Forest",
        desc: "A premium resort-style property opposite Victoria Forest. Rated 8.2/10 with 65 reviews. Beautiful green surroundings, spa, pool and multiple dining options. A peaceful retreat feel within the city — excellent for families and nature-loving travelers.",
        type: "Resort",
        amenities: ["Pool", "Spa", "Restaurant", "Free WiFi", "Parking", "Garden", "Gym"]
      },
      {
        id: 16,
        name: "Nilambag Palace Hotel",
        tier: "luxury",
        price: "₹4,000–6,500",
        rating: 4.5,
        area: "Nilambaug Circle",
        desc: "Bhavnagar's only heritage palace hotel — a living piece of royal history. Once the residence of the Gohil royal family, now a heritage hotel with old-world charm, beautiful gardens, a tennis court and the legendary royal dining hall. An experience unlike any other hotel.",
        type: "Heritage",
        amenities: ["Restaurant", "Free WiFi", "Pool", "Tennis", "Garden", "Heritage tours", "Parking", "Pet-friendly"]
      },
      {
        id: 17,
        name: "The Blackbuck Trails Velavadar",
        tier: "luxury",
        price: "₹8,000–12,000",
        rating: 4.6,
        area: "Velavadar (~42 km)",
        desc: "A premium wildlife lodge adjacent to Velavadar National Park — perfect for visitors doing blackbuck safaris. Beautiful natural setting, pool and intimate lodge experience. Best booked in advance for the Oct–Mar safari season.",
        type: "Wildlife Lodge",
        amenities: ["Pool", "Restaurant", "Safari packages", "Free WiFi", "Nature walks", "Bonfire"]
      },

    ];


    const EVENTS = [
      // ── UPCOMING (future-dated, real annual events) ─────────────────────────────
      {
        id: 1,
        name: "Palitana Shatrunjaya Pilgrimage Season",
        date: "Oct–Mar (Peak Season)",
        time: "Dawn onwards",
        loc: "Palitana Hills (60 km)",
        type: "Spiritual",
        seasonal: true,
        desc: "The 3,800+ step climb to the 900 Jain temples atop Shatrunjaya Hill. Considered the holiest pilgrimage in Jainism — most visited Oct to March when weather is cool. Palitana is 60 km from Bhavnagar."
      },
      {
        id: 2,
        name: "Velavadar Blackbuck Safari Season",
        date: "Oct – Mar",
        time: "6–8 AM / 4–6 PM",
        loc: "Velavadar NP (42 km)",
        type: "Nature",
        seasonal: true,
        desc: "Best season to spot blackbucks, wolves, hyenas and migratory birds at Velavadar National Park. Jeep safaris available at park entry. Book guides in advance for the morning slot."
      },
      {
        id: 3,
        name: "Maha Shivratri — Nishkalank Mahadev",
        date: "Annual (Feb/Mar)",
        time: "4 AM – midnight",
        loc: "Nishkalank Mahadev, Koliyak",
        type: "Spiritual",
        seasonal: true,
        desc: "The most sacred night at Nishkalank Mahadev — a Shiva temple that appears only at low tide in the sea. Thousands gather for the all-night celebration. The low-tide walk at 4 AM is a once-in-a-lifetime experience."
      },
      {
        id: 4,
        name: "Janmashtami at BAPS Swaminarayan Mandir",
        date: "Annual (Aug)",
        time: "6 PM – midnight",
        loc: "BAPS Mandir, Bhavnagar",
        type: "Spiritual",
        seasonal: true,
        desc: "One of Bhavnagar's biggest celebrations. The BAPS Swaminarayan temple transforms with lights, devotional music and midnight abhinandan. Thousands of devotees attend the midnight janma celebration."
      },
      {
        id: 5,
        name: "Navratri Garba — City Grounds",
        date: "Annual (Sep/Oct)",
        time: "9 PM – 2 AM",
        loc: "City Grounds / Victoria Park area",
        type: "Cultural",
        seasonal: true,
        desc: "Nine nights of garba and dandiya raas across Bhavnagar. Victoria Park area and city grounds host the biggest gatherings. Traditional Gujarati dress, live folk music and competitive garba circles."
      },
      {
        id: 6,
        name: "Shamlaji Tribal Fair (Shamlaji Melo)",
        date: "Annual (Nov, Kartik Purnima)",
        time: "All day",
        loc: "Shamlaji Temple (~120 km)",
        type: "Cultural",
        seasonal: true,
        desc: "One of Gujarat's most important tribal fairs held over 3 weeks near Shamlaji Temple. Thousands arrive on foot and camel carts. Silver ornaments, cloth, folk music and the Meshwo riverside bathing ritual."
      },
      {
        id: 7,
        name: "Uttarayan — Kite Festival",
        date: "Jan 14 every year",
        time: "All day",
        loc: "Across Bhavnagar city",
        type: "Cultural",
        seasonal: true,
        desc: "Bhavnagar's skies fill with thousands of kites on Makar Sankranti. Rooftop kite battles, street food stalls, and the famous 'kaipo che!' battles all day and into the evening. An unmissable Gujarat experience."
      },
      {
        id: 8,
        name: "Monsoon Waterfall Trek — Shetrunji Dam",
        date: "Jul – Sep",
        time: "6 AM – 2 PM",
        loc: "Shetrunji Dam / Palitana foothills",
        type: "Adventure",
        seasonal: true,
        desc: "Post-monsoon waterfalls appear around the Shetrunji river and Palitana foothills during July–September. Local trekking groups organise guided walks on weekends. Check weather before going."
      },
      {
        id: 9,
        name: "Gopnath Beach Camping Season",
        date: "Oct – Feb",
        time: "Overnight",
        loc: "Gopnath Beach (35 km)",
        type: "Adventure",
        seasonal: true,
        desc: "The secluded Gopnath Beach near the historic Gopnath Mahadev temple becomes a camping spot for groups from October to February. No commercial setup — bring your own supplies. Stargazing and sunrise are the highlight."
      },
      {
        id: 10,
        name: "Piram Island Boat Trip Season",
        date: "Nov – Mar (best tides)",
        time: "7 AM – 1 PM",
        loc: "Ghogha Jetty → Piram Island",
        type: "Offbeat",
        seasonal: true,
        desc: "The best season to visit Piram Bet island by boat from Ghogha jetty. Ancient Shiva temple, undisturbed beaches and dolphin sightings en route. Trips are tide-dependent — arrange at the jetty in the morning."
      },
      {
        id: 11,
        name: "Alang Ship Yard Industrial Tour",
        date: "Year-round (weekdays)",
        time: "9 AM – 2 PM",
        loc: "Alang Ship Breaking Yard (50 km)",
        type: "Offbeat",
        seasonal: false,
        desc: "The world's largest ship-recycling yard — a surreal landscape of beached vessels being dismantled by hand. Entry requires prior permit from SRIA (Ship Recycling Industries Association). Arrange 2–3 days ahead."
      },
      // ── RECURRING (weekly / regular events) ──────────────────────────────────────
      {
        id: 12,
        name: "Ganga Deri Evening Aarti",
        date: "Every Friday 7 PM",
        time: "7:00 – 8:00 PM",
        loc: "Ganga Deri Cenotaph, Old City",
        type: "Spiritual",
        seasonal: false,
        desc: "A serene weekly aarti at the royal cenotaphs of Ganga Deri in the old city. Oil lamps, devotional music and a quiet reflective atmosphere. Rarely crowded — a hidden gem for spiritual visitors."
      },
      {
        id: 13,
        name: "Saturday Antique Bazaar",
        date: "Every Saturday",
        time: "8 AM – 1 PM",
        loc: "Crescent Circle Market area",
        type: "Cultural",
        seasonal: false,
        desc: "A weekly market near Crescent Circle where vendors sell old coins, antique brass items, vintage jewellery, old photographs and Bhavnagari artefacts. Best browsed early before the heat picks up."
      },
      {
        id: 14,
        name: "Takhteshwar Hill Sunrise Walk",
        date: "Every Sunday 5:30 AM",
        time: "5:30 – 7:00 AM",
        loc: "Takhteshwar Temple, Hill top",
        type: "Wellness",
        seasonal: false,
        desc: "A local tradition — Sunday morning walkers climb Takhteshwar Hill to catch the sunrise over the Gulf of Khambhat. The temple opens before dawn. Bring water, enjoy the 360° city view and return before the heat."
      },
    ];

    const GUIDES = [{
        id: 1,
        name: "Parag Travels Pvt. Ltd.",
        type: "Tour Operator",
        spec: "Full-service Saurashtra tour packages, Palitana day trips, Gir safaris, city sightseeing, car rental",
        lang: ["English", "Hindi", "Gujarati"],
        exp: "Est. 1980s • IATA & TAAI Certified",
        rating: 4.8,
        phone: "+912782426100",
        whatsapp: "9879692140",
        area: "Madhav Hill, Waghawadi Road",
        verified: true,
        active: true,
        badge: "⭐ Top Rated",
        img: "https://picsum.photos/seed/parag1/200/200"
      },
      {
        id: 2,
        name: "G. M. Tours & Travels",
        type: "Tour Operator",
        spec: "Bhavnagar city tours, Palitana packages, Velavadar NP safaris, airport transfers, hotel bookings",
        lang: ["English", "Hindi", "Gujarati"],
        exp: "Est. 2000s • Gujarat Tourism Recognized",
        rating: 4.6,
        phone: "+912782569930",
        whatsapp: "9824882331",
        area: "Waghawadi Road, Beside Domino's Pizza",
        verified: true,
        active: true,
        badge: "✅ Verified",
        img: "https://picsum.photos/seed/gm2/200/200"
      },
      {
        id: 3,
        name: "99 Destinations Holidays Pvt. Ltd.",
        type: "Tour Operator",
        spec: "Custom Gujarat packages, Bhavnagar–Palitana–Gir circuits, group tours, honeymoon packages",
        lang: ["English", "Hindi", "Gujarati"],
        exp: "Active • Ministry of Tourism Recognized",
        rating: 4.5,
        phone: "",
        whatsapp: "",
        area: "Near Dhor Dabba, Bhavnagar",
        verified: true,
        active: true,
        badge: "✅ Verified",
        img: "https://picsum.photos/seed/99dest3/200/200"
      },
      {
        id: 4,
        name: "Seagull Travel Services",
        type: "Travel Agency",
        spec: "Domestic & international tours, Bhavnagar sightseeing, Alang ship yard visits, coastal Gujarat",
        lang: ["English", "Gujarati"],
        exp: "Active • Bhavnagar based",
        rating: 4.3,
        phone: "",
        whatsapp: "",
        area: "Bhavnagar City",
        verified: true,
        active: true,
        badge: "✅ Verified",
        img: "https://picsum.photos/seed/seagull4/200/200"
      },
      {
        id: 5,
        name: "Sunny Travels",
        type: "Travel Agency",
        spec: "City sightseeing tours, ST bus booking, railway tickets, local day trips to Sihor & Palitana",
        lang: ["Hindi", "Gujarati"],
        exp: "Active • Crescent Circle area",
        rating: 4.2,
        phone: "+912782425494",
        whatsapp: "9377105494",
        area: "Crescent Circle, Bhavnagar",
        verified: true,
        active: true,
        badge: "✅ Verified",
        img: "https://picsum.photos/seed/sunny5/200/200"
      },
      {
        id: 6,
        name: "Global Travel Solutions",
        type: "Travel Agency",
        spec: "Corporate travel, custom tour packages, Bhavnagar–Ahmedabad transfers, Gujarat circuit tours",
        lang: ["English", "Hindi", "Gujarati"],
        exp: "Active • Waghawadi Road",
        rating: 4.4,
        phone: "+912783001223",
        whatsapp: "9879006900",
        area: "Parimal Chowk, Waghawadi Road",
        verified: true,
        active: true,
        badge: "✅ Verified",
        img: "https://picsum.photos/seed/global6/200/200"
      },
    ];

    // ── QUESTION BANK (50 questions — all shuffled every round) ───────────────────
    const QUIZ_BANK = [{
        q: "Which sea temple near Bhavnagar goes underwater at high tide?",
        opts: ["Somnath", "Nishkalank Mahadev", "Dwarkadheesh", "Nageshwar"],
        ans: 1
      },
      {
        q: "Alang near Bhavnagar is famous worldwide for what?",
        opts: ["Salt farming", "Diamond polishing", "Ship breaking yard", "Fishing port"],
        ans: 2
      },
      {
        q: "Palitana legally banned which activity — a world first?",
        opts: ["Using plastics", "Eating meat", "Fishing", "Drinking alcohol"],
        ans: 1
      },
      {
        q: "Which dynasty founded Bhavnagar in 1723?",
        opts: ["Solanki", "Gohil Rajputs", "Marathas", "Mughals"],
        ans: 1
      },
      {
        q: "Bhavnagar sits on the shore of which Gulf?",
        opts: ["Gulf of Kutch", "Gulf of Mannar", "Gulf of Oman", "Gulf of Khambhat"],
        ans: 3
      },
      {
        q: "Victoria Park was established in 1888 and covers approximately?",
        opts: ["100 acres", "250 acres", "500 acres", "1000 acres"],
        ans: 2
      },
      {
        q: "The Barton Museum has a memorial to which Indian leader?",
        opts: ["Sardar Patel", "B.R. Ambedkar", "Mahatma Gandhi", "Nehru"],
        ans: 2
      },
      {
        q: "Which famous traveller visited Ghogha port in the 13th century?",
        opts: ["Vasco da Gama", "Ibn Battuta", "Marco Polo", "Columbus"],
        ans: 2
      },
      {
        q: "Takhteshwar Temple was built by Maharaja Takhatsinghji in?",
        opts: ["1845", "1893", "1910", "1872"],
        ans: 1
      },
      {
        q: "How many Jain temples are on Shatrunjaya Hill in Palitana?",
        opts: ["300+", "500+", "900+", "1200+"],
        ans: 2
      },
      {
        q: "Velavadar National Park has the world's densest population of?",
        opts: ["Asiatic Lion", "Blackbuck", "Indian Wolf", "Florican"],
        ans: 1
      },
      {
        q: "Gaurishankar Lake was originally built in which year?",
        opts: ["1840", "1855", "1872", "1901"],
        ans: 2
      },
      {
        q: "What is the famous soft gram-flour snack unique to Bhavnagar?",
        opts: ["Khandvi", "Chakri", "Bhavnagri Gathiya", "Sev"],
        ans: 2
      },
      {
        q: "Which BAPS temple near Bhavnagar draws 50,000+ pilgrims every Tuesday?",
        opts: ["Aksharwadi Bhavnagar", "Swaminarayan Surat", "Sarangpur", "Gondal Temple"],
        ans: 2
      },
      {
        q: "Best season to visit Trambak Waterfall near Bhavnagar?",
        opts: ["Winter", "Summer", "Monsoon", "Spring"],
        ans: 2
      },
      {
        q: "What rare thing is found on Piram Bet Island?",
        opts: ["Ancient coins", "Dinosaur egg fossils", "Buddhist scrolls", "Roman pottery"],
        ans: 1
      },
      {
        q: "Nilambag Palace today works as a?",
        opts: ["Museum", "Heritage hotel", "University", "Sanctuary"],
        ans: 1
      },
      {
        q: "How far into the sea does Nishkalank Mahadev temple sit?",
        opts: ["200 metres", "500 metres", "1 kilometre", "3 kilometres"],
        ans: 2
      },
      {
        q: "Talaja Buddhist caves near Bhavnagar date back to?",
        opts: ["3rd century BCE", "5th century CE", "10th century CE", "2nd century BCE"],
        ans: 0
      },
      {
        q: "Alang Ship Yard stretches how many km along the coast?",
        opts: ["2 km", "5 km", "10 km", "20 km"],
        ans: 2
      },
      {
        q: "What festival runs for 9 days at Khodiyar Mandir?",
        opts: ["Diwali", "Navratri Garba", "Rath Yatra", "Uttarayan"],
        ans: 1
      },
      {
        q: "Palitana is the world's only city to legally ban?",
        opts: ["Plastic bags", "Eating meat", "Alcohol", "Fireworks"],
        ans: 1
      },
      {
        q: "Mahuva near Bhavnagar is called 'the Kashmir of' which region?",
        opts: ["Gujarat", "Rajasthan", "Saurashtra", "Kutch"],
        ans: 2
      },
      {
        q: "Shree Ram Farsan in Bhavnagar has been serving since?",
        opts: ["1930", "1945", "1962", "1978"],
        ans: 2
      },
      {
        q: "The Pandavas placed how many Shivalingas at Nishkalank Mahadev?",
        opts: ["1", "3", "5", "7"],
        ans: 2
      },
      {
        q: "Entry fee at Barton Museum is?",
        opts: ["Free", "Rs.10", "Rs.30", "Rs.100"],
        ans: 2
      },
      {
        q: "Which palace in Bhavnagar did Mahatma Gandhi visit as a student?",
        opts: ["Laxmi Vilas", "Nilambag Palace", "Umaid Bhawan", "Jai Vilas"],
        ans: 1
      },
      {
        q: "Gaurishankar Lake is also known locally as?",
        opts: ["Neel Talav", "Bor Talav", "Hari Talav", "Ratan Talav"],
        ans: 1
      },
      {
        q: "Which wild animals live in Victoria Park?",
        opts: ["Lions and tigers", "Nilgai, foxes, porcupines", "Elephants", "Crocodiles"],
        ans: 1
      },
      {
        q: "What evening attraction runs daily at Gaurishankar Lake?",
        opts: ["Laser show", "Musical fountain", "Classical concert", "Puppet show"],
        ans: 1
      },
      {
        q: "Best time to visit Nishkalank Mahadev is?",
        opts: ["Early morning", "High tide", "Low tide", "After sunset"],
        ans: 2
      },
      {
        q: "How do you reach Piram Bet Island?",
        opts: ["Car", "Train", "Boat", "Helicopter"],
        ans: 2
      },
      {
        q: "Velavadar National Park also shelters which rare bird?",
        opts: ["Flamingo", "Lesser Florican", "Peacock", "Siberian Crane"],
        ans: 1
      },
      {
        q: "Alang Ship Yard employs approximately how many workers?",
        opts: ["2,000", "5,000", "20,000", "1,00,000"],
        ans: 2
      },
      {
        q: "Sarangpur temple is famous for which deity?",
        opts: ["Lord Shiva", "Lord Vishnu", "Hanumanji", "Goddess Kali"],
        ans: 2
      },
      {
        q: "What can you buy cheap near Alang Ship Yard?",
        opts: ["Diamonds", "Ship furniture & fittings", "Silk fabric", "Antique clothes"],
        ans: 1
      },
      {
        q: "How many steps are there on the Palitana hill pilgrimage?",
        opts: ["500", "1,000", "2,500", "3,500"],
        ans: 3
      },
      {
        q: "BAPS Swaminarayan Mandir in Bhavnagar is known for?",
        opts: ["Golden dome", "Intricate marble carvings", "Wooden carvings", "Giant bell"],
        ans: 1
      },
      {
        q: "What type of temple is Khodiyar Mandir?",
        opts: ["Shiva temple", "Jain temple", "Goddess Mata temple", "Buddha temple"],
        ans: 2
      },
      {
        q: "Takhteshwar Temple has a 360° view of which water body?",
        opts: ["Arabian Sea", "Indian Ocean", "Gulf of Khambhat", "Sabarmati River"],
        ans: 2
      },
      {
        q: "Approximate distance from Bhavnagar to Alang?",
        opts: ["10 km", "30 km", "50 km", "100 km"],
        ans: 2
      },
      {
        q: "Bhavnagar is most famous for which regional cuisine?",
        opts: ["Mughlai", "Rajasthani", "Kathiyawadi", "South Indian"],
        ans: 2
      },
      {
        q: "What is Bajra Rotla?",
        opts: ["A sweet dessert", "A millet flatbread", "A type of curry", "A fried snack"],
        ans: 1
      },
      {
        q: "Bhavnagar city was founded in which year?",
        opts: ["1623", "1700", "1723", "1810"],
        ans: 2
      },
      {
        q: "Diu, a popular getaway near Bhavnagar, was a colony of?",
        opts: ["France", "Britain", "Portugal", "Netherlands"],
        ans: 2
      },
      {
        q: "Ghogha Beach is approximately how far from Bhavnagar city?",
        opts: ["5 km", "19 km", "40 km", "60 km"],
        ans: 1
      },
      {
        q: "What makes Trambak Waterfall special near Malnath Temple?",
        opts: ["It glows at night", "It flows uphill", "Nature + spiritual combo", "It has hot water"],
        ans: 2
      },
      {
        q: "Entry ticket for Piram Bet Island boat ride costs?",
        opts: ["Free", "Rs.50", "Rs.200", "Rs.500"],
        ans: 2
      },
      {
        q: "Palitana temples are built mainly from?",
        opts: ["Red sandstone", "Black granite", "White marble", "Limestone"],
        ans: 2
      },
      {
        q: "Which Bhavnagar lake has a planetarium nearby?",
        opts: ["Piram Lake", "Victoria Lake", "Gaurishankar Lake", "Alang Lake"],
        ans: 2
      },
      {
        q: "Malnath Mahadev Temple is near which waterfall?",
        opts: ["Trambak Waterfall", "Jog Falls", "Keoti Falls", "Dudhsagar"],
        ans: 0
      },
      {
        q: "Malnath Mahadev Temple is a place of which two things?",
        opts: ["History & Culture", "Spiritual & Nature", "Beach & Adventure", "Industrial & Heritage"],
        ans: 1
      },
      {
        q: "How far is Malnath Mahadev Temple from Bhavnagar city?",
        opts: ["5 km", "12 km", "24 km", "45 km"],
        ans: 2
      },
      {
        q: "Nath Hills in Bhavnagar is famous for what view?",
        opts: ["Sunrise over the sea", "Windmills on the hills", "Train passing through valley", "Hot air balloons"],
        ans: 1
      },
      {
        q: "Nath Hills resort is located in which village?",
        opts: ["Sihor", "Alang", "Bhadi", "Rajpara"],
        ans: 2
      },
      {
        q: "The restaurant at Nath Hills resort is called?",
        opts: ["The Summit", "Elysium", "Hilltop Cafe", "Sky Dine"],
        ans: 1
      },
      {
        q: "Bhav Vilas Palace faces which Bhavnagar lake?",
        opts: ["Bor Talav", "Gangajalia Lake", "Gaurishankar Lake", "Piram Lake"],
        ans: 2
      },
      {
        q: "Bhav Vilas Palace was built in which year?",
        opts: ["1850", "1873", "1893", "1920"],
        ans: 2
      },
      {
        q: "The iron gates of Bhav Vilas Palace were cast in which city?",
        opts: ["London", "Dublin", "Paris", "Manchester"],
        ans: 1
      },
      {
        q: "Sardar Baug in Bhavnagar is what kind of attraction?",
        opts: ["A beach", "A royal garden with palace", "A wildlife sanctuary", "A temple complex"],
        ans: 1
      },
      {
        q: "Ganga Deri in Bhavnagar is often compared to which monument?",
        opts: ["Eiffel Tower", "Red Fort", "Taj Mahal", "Qutub Minar"],
        ans: 2
      },
      {
        q: "Ganga Deri was built by Maharaja Takhtsinhji in memory of?",
        opts: ["His father", "His queen", "A battle victory", "Lord Shiva"],
        ans: 1
      },
      {
        q: "Ganga Deri is built from which material?",
        opts: ["Red sandstone", "Granite", "White marble", "Limestone"],
        ans: 2
      },
      {
        q: "Ganga Deri sits on the banks of which lake?",
        opts: ["Gaurishankar Lake", "Gangajalia Lake", "Bor Talav", "Piram Lake"],
        ans: 1
      },
    ];

    // ── PLACE STORIES — short & punchy ────────────────────────────────────────────
    const QUIZ_STORIES = [{
        place: "Nishkalank Mahadev",
        emoji: "🌊",
        img: "https://hblimg.mmtcdn.com/content/hubble/img/ttd_images/mmt/activities/m_Bhavnagar_Nishkalank_mahadev_temple_1_l_360_640.jpg",
        title: "The Temple That Vanishes",
        story: "The Pandavas felt guilty after the Kurukshetra war and prayed to Lord Shiva for forgiveness. Shiva told them to walk into the sea — and the waves parted! They found 5 sacred Shivalingas 1 km inside the Arabian Sea and worshipped there. Today, that same temple still disappears under the sea at high tide and reappears at low tide, as if the ocean is protecting it. Pilgrims walk barefoot through the warm shallow water to reach it. A true miracle you can visit!",
      },
      {
        place: "Alang Ship Yard",
        emoji: "⚓",
        img: "https://akm-img-a-in.tosshub.com/indiatoday/images/story/201406/alang_650_062814030008.jpg",
        title: "Where Giant Ships Come to Die",
        story: "Huge ships — bigger than 3 football fields — sail their very last journey to a beach near Bhavnagar called Alang. Here, 20,000 workers cut them apart piece by piece using gas cutters and bare hands. Why Alang? Because the tides here are perfect — ships get beached at high tide and the workers dismantle them on dry land! The steel goes to build Indian roads and buildings. And the old ship furniture — tables, chairs, portholes — is sold cheap in roadside shops. It's the world's biggest ship-breaking yard!",
      },
      {
        place: "Takhteshwar Temple",
        emoji: "🛕",
        img: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/08/07/fa/fe/caption.jpg?w=2000&h=-1&s=1",
        title: "The Temple on Top of Everything",
        story: "In 1893, King Takhatsinghji climbed the highest hill in Bhavnagar and said — this is where Lord Shiva should live. He built a stunning white marble temple that can be seen from everywhere in the city. Sailors used to spot it from far out at sea to find their way home. Every morning at sunrise, the Gulf of Khambhat glows golden from up there. Locals say if you sit on the steps at dawn, even your biggest worries feel small.",
      },
      {
        place: "Palitana",
        emoji: "🏛️",
        img: "https://bmcgujarat.com/media/y5ifnm3f/1__rx-bf1wofzi7-sgqds3ca.png",
        title: "The Holy City That Sleeps Alone",
        story: "Every evening in Palitana, a bell rings and everyone — priests, monks, even caretakers — must leave the hilltop. No human is allowed to spend the night there. The 900+ marble temples on top of the hill are left only for the gods. Pilgrims climb 3,500 steps barefoot at dawn with lanterns in hand to reach the top. In 2014, Palitana also became the world's first city to legally ban the eating of meat. It's peaceful, powerful, and unlike any place in the world.",
      },
      {
        place: "Nilambag Palace",
        emoji: "👑",
        img: "https://www.nilambagpalace.com/img/restaurant/heritage-1.jpg",
        title: "The Palace Where Gandhi Once Stayed",
        story: "When Mahatma Gandhi was just a young student in Bhavnagar, the Maharaja liked him so much that he invited him to stay at Nilambag Palace — one of the finest royal homes in Saurashtra. Gandhi walked the peacock-filled gardens every morning, thinking about the future of India. Today, that same palace is a heritage hotel where you can eat a Royal Gujarati Thali under original chandeliers. You might not change history here, but you can definitely eat like a king!",
      },
      {
        place: "Gaurishankar Lake",
        emoji: "🦅",
        img: "https://i0.wp.com/www.jovialholiday.com/wp-content/uploads/2024/11/gaurishankar-lake-bhavnagar.jpg?w=1080&ssl=1",
        title: "The Lake Birds Never Forgot",
        story: "In 1872, a reservoir was dug to solve Bhavnagar's water problem. Nobody expected what happened next — birds started arriving! Hundreds, then thousands — flamingos, herons, pelicans. Over 200 species visit today. The word spread across Asia's bird flyways that this lake is safe and full of fish! The Maharaja renamed it Gaurishankar after the divine union of Shiva and Parvati. Now every evening a musical fountain lights up the lake while the birds quietly watch from the other side.",
      },
      {
        place: "Piram Bet Island",
        emoji: "🏝️",
        img: "https://hblimg.mmtcdn.com/content/hubble/img/ttd_images/mmt/activities/m_Bhavnagar_Gopnath_beach_1_l_504_640.jpg",
        title: "The Island That Time Forgot",
        story: "Take a boat 20 km into the Gulf of Khambhat and you'll find Piram Bet — an island with no hotels, no restaurants, and no mobile signal. But it has something more exciting: dinosaur egg fossils! Half-buried in the clay cliffs are bones and eggs of creatures that lived millions of years ago. Scientists call it one of South Asia's top fossil sites. A lighthouse blinks in the fog at night. Fishermen call it home. And visitors who make the bumpy boat ride say it feels like arriving at the edge of the world.",
      },
    ];

    // ── Active quiz round state ───────────────────────────────────────────────────
    let QUIZ = [];
    let currentStory = null;

    const PLACE_FOOD = {
      1: [1, 5, 7], // Takhteshwar: Lachhubhai Ganthiyawala, Pahadi Momos, Shree Ram Farsan
      2: [6, 16, 1], // Gaurishankar Lake: Balaji Ice Gola, Mehta Sweets, Lachhubhai
      3: [3, 4, 7], // Barton Museum: Jay Somnath Dal Puri, Bapa Sitaram, Shree Ram Farsan
      4: [8, 14, 15], // Nilambag Palace: Palace Dining, The Chocolate Room, Coffee Culture
      5: [22, 23, 15], // Victoria Park: Subway, Burger Singh, Coffee Culture
      6: [11, 9, 7], // Nishkalank Mahadev: Shiv Shakti Dhaba, Rasoi Dining, Shree Ram
      7: [11, 7, 4], // Alang: Shiv Shakti Dhaba, Shree Ram Farsan, Bapa Sitaram
      9: [9, 10, 7], // BAPS Temple: Rasoi Dining, Jalaram Paratha, Shree Ram Farsan
      11: [1, 7, 3], // Piram Island: No food — nearest in city
      14: [2, 1, 6], // Crescent Circle: Narsidas, Lachhubhai, Balaji Gola
      15: [11, 7, 1], // Ghogha Beach: Shiv Shakti Dhaba, Shree Ram Farsan, Lachhubhai
      20: [19, 21, 15], // Science Centre: Domino's Surabhi, Pizza Hut, Coffee Culture
      29: [6, 16, 3], // Bhav Vilas Palace: Balaji Gola, Mehta Sweets, Jay Somnath Dal Puri
      30: [24, 6, 17], // Sardar Baug: Jay Khodiyar Sandwich (id:24), Balaji Gola, Gwalia Sweets
      32: [17, 15, 16], // Ganga Deri: Gwalia Sweets, Coffee Culture, Mehta Sweets
      35: [11, 7, 4], // Malnath Temple: Shiv Shakti Dhaba, Shree Ram, Bapa Sitaram
      36: [8, 12, 15], // Nath Hills: Mahavir Restaurant, Mahavir, Coffee Culture
    };
    const EVT_COLORS = {
      Cultural: "#00c2ff",
      Spiritual: "#ff9f5a",
      Nature: "#22c55e",
      Festival: "#a855f7",
      Adventure: "#f59e0b",
      Food: "#ef4444",
      Offbeat: "#6366f1",
      Wellness: "#10b981"
    };

    // ── STATE ──────────────────────────────────────────────────────────────────────
    let currentPage = 'Home';
    let currentTheme = 'dark';
    let placesFilter = 'All';
    let foodFilter = 'All';
    let hotelFilter = 'All';
    let hotelSearch = '';
    let placesSearch = '';
    let nearbySearch = '';
    let foodSearch = '';
    let planner = {
      days: 2,
      budget: 'economy',
      travelType: 'Couple',
      interests: []
    };
    let quizOpen = false;
    let quizStep = 'idle'; // idle | quiz | result
    let quizIdx = 0;
    let quizScore = 0;
    let quizPicked = null;
    let quizAnswered = false;

    // ── HELPERS ──────────────────────────────────────────────────────────────────
    function mapsNav(lat, lng, name) {
      return `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}&destination_place_name=${encodeURIComponent(name)}&travelmode=driving`;
    }

    function mapsSearch(q) {
      return `https://www.google.com/maps/search/${encodeURIComponent(q)}`;
    }

    function nearbyFoods(pid) {
      return (PLACE_FOOD[pid] || [1, 2, 3]).map(id => FOODS.find(f => f.id === id)).filter(Boolean);
    }

    function imgFallback(el, seed, size = '600/400') {
      el.onerror = () => {
        el.src = `https://picsum.photos/seed/${seed}/${size}`;
        el.onerror = null;
      };
    }

    // ── PARTICLES ─────────────────────────────────────────────────────────────────
    function initParticles() {
      const container = document.getElementById('particles');
      container.innerHTML = '';
      for (let i = 0; i < 14; i++) {
        const pt = document.createElement('div');
        pt.className = 'pt';
        const size = Math.random() * 3 + 1;
        const x = Math.random() * 100;
        const y = Math.random() * 100;
        const dur = Math.random() * 13 + 7;
        const delay = Math.random() * 5;
        pt.style.cssText = `left:${x}%;top:${y}%;width:${size}px;height:${size}px;animation-duration:${dur}s;animation-delay:${delay}s`;
        container.appendChild(pt);
      }
    }

    // ── NAV ───────────────────────────────────────────────────────────────────────
    // ── HOME MAP ──────────────────────────────────────────────────────────────────
    const MAP_ROAD = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59416.04!2d72.1069!3d21.7645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f5e30cf70a5f9%3A0x1e2e3b4c5d6f7a8b!2sBhavnagar%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1708000000000!5m2!1sen!2sin";
    const MAP_SAT = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59416.04!2d72.1069!3d21.7645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f5e30cf70a5f9%3A0x1e2e3b4c5d6f7a8b!2sBhavnagar%2C%20Gujarat!5e1!3m2!1sen!2sin!4v1708000000000!5m2!1sen!2sin";

    function setMapType(type) {
      const frame = document.getElementById('bhavnagarMapFrame');
      const btnRoad = document.getElementById('mapBtnRoad');
      const btnSat = document.getElementById('mapBtnSat');
      if (!frame) return;
      const active = 'background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;border:none;border-radius:16px;padding:6px 13px;font-size:11px;font-weight:700;cursor:pointer;font-family:inherit;transition:all 0.2s';
      const inactive = 'background:var(--card);border:1px solid var(--card-border);color:var(--muted);border-radius:16px;padding:6px 13px;font-size:11px;font-weight:700;cursor:pointer;font-family:inherit;transition:all 0.2s';
      if (type === 'satellite') {
        frame.src = MAP_SAT;
        btnSat.style.cssText = active;
        btnRoad.style.cssText = inactive;
      } else {
        frame.src = MAP_ROAD;
        btnRoad.style.cssText = active;
        btnSat.style.cssText = inactive;
      }
    }

    function navigateWithFilter(page, filter) {
      if (page === 'Places' && filter && filter !== 'null') {
        navigate(page);
        setTimeout(() => {
          setPlaceFilter(filter);
        }, 80);
      } else {
        navigate(page);
      }
    }

    function navigate(page, pushState = true) {
      document.getElementById('page-' + currentPage)?.classList.remove('active');
      currentPage = page;
      document.getElementById('page-' + page)?.classList.add('active');
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
      document.querySelectorAll('.nav-tab').forEach(t => {
        t.classList.toggle('active', t.dataset.page === page);
      });
      if (pushState) {
        try {
          history.pushState({
            page
          }, '', '#' + page);
        } catch (e) {}
      }
      if (page === 'Places') {
        placesSearch = '';
        renderPlaces();
      }
      if (page === 'Nearby') {
        nearbySearch = '';
        renderNearby();
      }
      if (page === 'Events') renderEvents();
      if (page === 'Food') {
        foodSearch = '';
        renderFood();
      }
      if (page === 'Hotels') renderHotels();
      if (page === 'Guides') renderGuides();
      if (page === 'Planner') renderPlanner();
    }

    // Back button support
    window.addEventListener('popstate', e => {
      const page = (e.state && e.state.page) ? e.state.page : 'Home';
      navigate(page, false);
    });

    function initNav() {
      const tabs = ['Home', 'Places', 'Nearby', 'Planner', 'Events', 'Food', 'Hotels', 'Guides'];
      const tabsEl = document.getElementById('navTabs');
      tabsEl.innerHTML = tabs.map(t => `<button class="nav-tab${t === currentPage ? ' active' : ''}" data-page="${t}" onclick="navigate('${t}')">${t}</button>`).join('');

      const themeEl = document.getElementById('themeBtns');
      themeEl.innerHTML = Object.entries(THEMES).map(([k, th]) =>
        `<button class="theme-btn${k === currentTheme ? ' active' : ''}" onclick="setTheme('${k}')" title="${th.name}" style="background:${k === 'dark' ? '#050b14' : k === 'light' ? '#f0f4f8' : k === 'purple' ? '#1a0533' : '#001824'}">${th.icon}</button>`
      ).join('');

      const themeSelectEl = document.getElementById('themeSelectMobile');
      if (themeSelectEl) {
        themeSelectEl.innerHTML = Object.entries(THEMES).map(([k, th]) =>
          `<option value="${k}"${k === currentTheme ? ' selected' : ''} title="${th.name}">${th.icon}</option>`
        ).join('');
      }
    }

    function setTheme(k) {
      document.body.className = THEMES[k].cls;
      currentTheme = k;
      document.querySelectorAll('.theme-btn').forEach((b, i) => {
        b.classList.toggle('active', Object.keys(THEMES)[i] === k);
      });
      const themeSelectEl = document.getElementById('themeSelectMobile');
      if (themeSelectEl) themeSelectEl.value = k;
      // ── Persist choice in a 1-year cookie ──
      var d = new Date();
      d.setFullYear(d.getFullYear() + 1);
      document.cookie = 'gotrip_theme=' + encodeURIComponent(k) +
        '; expires=' + d.toUTCString() + '; path=/; SameSite=Lax';
    }

    window.addEventListener('scroll', () => {
      document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
    });


    // ── WEATHER WIDGET ────────────────────────────────────────────────────────
    const WMO_EMOJI = {
      0: '☀️',
      1: '🌤️',
      2: '⛅',
      3: '☁️',
      45: '🌫️',
      48: '🌫️',
      51: '🌦️',
      53: '🌦️',
      55: '🌧️',
      61: '🌧️',
      63: '🌧️',
      65: '🌧️',
      71: '🌨️',
      73: '🌨️',
      75: '❄️',
      80: '🌦️',
      81: '🌦️',
      82: '⛈️',
      95: '⛈️',
      96: '⛈️',
      99: '⛈️',
    };
    const WMO_CODES = {
      0: 'Clear sky',
      1: 'Mainly clear',
      2: 'Partly cloudy',
      3: 'Overcast',
      45: 'Foggy',
      48: 'Icy fog',
      51: 'Light drizzle',
      53: 'Drizzle',
      55: 'Heavy drizzle',
      61: 'Light rain',
      63: 'Moderate rain',
      65: 'Heavy rain',
      71: 'Light snow',
      73: 'Snow',
      75: 'Heavy snow',
      80: 'Light showers',
      81: 'Showers',
      82: 'Heavy showers',
      95: 'Thunderstorm',
      96: 'Thunderstorm',
      99: 'Thunderstorm',
    };

    function getWeatherSuggestion(code, temp, hour, wind) {
      const isRainy = [51, 53, 55, 61, 63, 65, 80, 81, 82, 95, 96, 99].includes(code);
      const isStormy = [95, 96, 99].includes(code);
      const isClear = [0, 1, 2].includes(code);
      const isHot = temp >= 34;
      const isCool = temp <= 24;
      const isMorning = hour >= 5 && hour <= 9;
      const isEvening = hour >= 17 && hour <= 20;
      const isNight = hour >= 20 || hour < 5;
      const isWindy = wind >= 30;
      const isMild = temp >= 20 && temp <= 30;

      if (isStormy)
        return {
          icon: '⛈️',
          text: '<strong>Stay indoors today.</strong> Good time for <strong>Barton Museum</strong> or <strong>Regional Science Centre</strong> — both fully covered.'
        };
      if (isRainy)
        return {
          icon: '🌧️',
          text: 'Rain today — perfect for <strong>Nilambag Palace</strong> heritage tour or the <strong>Bhavnagar Science Centre</strong>. Skip beach and low-tide visits.'
        };
      if (isMorning && isClear && isCool)
        return {
          icon: '🌅',
          text: '<strong>Ideal morning!</strong> Head to <strong>Takhteshwar Hill</strong> for sunrise, or catch the <strong>Victoria Park</strong> birdwatching window (5–8 AM).'
        };
      if (isMorning && isClear)
        return {
          icon: '☀️',
          text: '<strong>Great morning</strong> for the <strong>Ghogha Circle</strong> street food trail — Pav Gathiya and Dal Puri spots open from 6 AM.'
        };
      if (isEvening && isClear)
        return {
          icon: '🌇',
          text: 'Perfect sunset evening — climb <strong>Takhteshwar Hill</strong> for the city + Gulf view, or walk <strong>Gaurishankar Lake</strong> promenade.'
        };
      if (isEvening && !isRainy)
        return {
          icon: '🌆',
          text: 'Good evening for <strong>Crescent Circle</strong> street food or the <strong>Ganga Deri</strong> cenotaph evening walk in the old city.'
        };
      if (isClear && isCool && !isHot)
        return {
          icon: '✨',
          text: '<strong>Ideal weather for Bhavnagar!</strong> Great conditions for <strong>Nishkalank Mahadev</strong> low-tide walk 🌊 or the <strong>Alang</strong> ship yard tour.'
        };
      if (isHot && isClear)
        return {
          icon: '🥵',
          text: 'Hot day — visit <strong>Barton Museum</strong> or <strong>Nilambag Palace</strong> (AC indoors). Save outdoor places for after 5 PM.'
        };
      if (isWindy)
        return {
          icon: '💨',
          text: 'Windy today — <strong>Piram Island boat trips</strong> may be cancelled. Good day for the old city walk or museum visits instead.'
        };
      if (isNight)
        return {
          icon: '🌙',
          text: 'Evening in Bhavnagar — try <strong>Rasoi Dining Hall</strong> for a Gujarati thali, or enjoy the lit-up <strong>Takhteshwar Temple</strong>.'
        };
      if (isMild && isClear)
        return {
          icon: '🌤️',
          text: 'Comfortable weather — good day for <strong>Velavadar National Park</strong> (42 km) blackbuck safari or the <strong>Palitana</strong> pilgrimage.'
        };
      return {
        icon: '🗺️',
        text: 'Weather looks fine — any spot in Bhavnagar is good to visit today. Check <strong>Places</strong> for inspiration.'
      };
    }

    let _weatherFetched = false;

    async function fetchWeather() {
      if (_weatherFetched) return;
      const el = document.getElementById('weatherWidget');
      if (!el) return;
      try {
        const url = 'https://api.open-meteo.com/v1/forecast?latitude=21.7645&longitude=72.1520' +
          '&current=temperature_2m,apparent_temperature,relative_humidity_2m,windspeed_10m,weathercode' +
          '&timezone=Asia%2FKolkata&forecast_days=1';
        const res = await fetch(url);
        const data = await res.json();
        const c = data.current;
        const code = c.weathercode;
        const temp = Math.round(c.temperature_2m);
        const feels = Math.round(c.apparent_temperature);
        const humidity = c.relative_humidity_2m;
        const wind = Math.round(c.windspeed_10m);
        const hour = new Date().getHours();
        const emoji = WMO_EMOJI[code] || '🌡️';
        const cond = WMO_CODES[code] || 'Current weather';
        const suggestion = getWeatherSuggestion(code, temp, hour, wind);
        _weatherFetched = true;

        el.innerHTML = `
          <div class="weather-widget">
            <div class="weather-label">
              <div class="weather-label-bar"></div>
              <span class="weather-label-text">Live Weather · Bhavnagar</span>
              <span style="margin-left:auto;font-size:10px;color:var(--muted);font-weight:600">Open-Meteo</span>
            </div>
            <div class="weather-top">
              <div class="weather-left">
                <div class="weather-icon-big">${emoji}</div>
                <div>
                  <div class="weather-temp">${temp}<span>°C</span></div>
                  <div class="weather-cond">${cond} · Feels ${feels}°C</div>
                </div>
              </div>
              <div class="weather-stats">
                <div class="weather-stat">
                  <div class="weather-stat-val">💧 ${humidity}%</div>
                  <div class="weather-stat-lbl">HUMIDITY</div>
                </div>
                <div class="weather-stat">
                  <div class="weather-stat-val">💨 ${wind} km/h</div>
                  <div class="weather-stat-lbl">WIND</div>
                </div>
                <div class="weather-stat">
                  <div class="weather-stat-val">🌡️ ${feels}°C</div>
                  <div class="weather-stat-lbl">FEELS LIKE</div>
                </div>
              </div>
            </div>
            <div class="weather-suggestion">${suggestion.icon} ${suggestion.text}</div>
          </div>`;
      } catch (e) {
        // Silent fail — widget stays hidden, nothing breaks
        if (el) el.innerHTML = '';
      }
    }

    // ── HOME ─────────────────────────────────────────────────────────────────────
    function renderHome() {
      // ── Bhavnagar Introduction card ─────────────────────────────────────────────
      const introHtml = `
  <div style="background:var(--card);border:1px solid var(--card-border);border-radius:20px;padding:28px 30px;margin-bottom:32px;position:relative;overflow:hidden">
    <div style="position:absolute;top:-40px;right:-40px;width:180px;height:180px;background:radial-gradient(circle,rgba(0,194,255,0.08),transparent 70%);pointer-events:none"></div>
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px">
      <div style="width:3px;height:22px;background:linear-gradient(180deg,var(--accent),var(--accent2));border-radius:2px"></div>
      <span style="color:var(--accent);font-size:11px;font-weight:800;letter-spacing:2px;text-transform:uppercase">About Bhavnagar</span>
    </div>
    <h2 style="font-family:'Playfair Display',serif;font-size:22px;font-weight:900;color:var(--text);margin-bottom:14px;line-height:1.3">The Jewel of Saurashtra</h2>
    <p style="color:var(--text);font-size:14px;line-height:1.85;margin-bottom:18px;opacity:0.8">Bhavnagar is a coastal city on the shores of the Gulf of Khambhat in Gujarat, India. Founded in 1723 by Maharaja Bhavsinhji Gohil, it grew from a small trading port into one of Saurashtra's most culturally rich cities. Known as the "City of Temples," Bhavnagar blends royal heritage with natural beauty — from the hilltop marble of Takhteshwar Temple to the tidal wonder of Nishkalank Mahadev, which disappears beneath the Arabian Sea every day at high tide.</p>
    <p style="color:var(--muted);font-size:13px;line-height:1.8;margin-bottom:20px">Home to the world's largest ship-breaking yard at Alang, the ancient Jain pilgrimage city of Palitana, and the grassland paradise of Velavadar National Park, Bhavnagar district offers an extraordinary range of experiences. The city is famous across Gujarat for its signature snack — Bhavnagri Gathiya — and its vibrant Navratri celebrations that draw thousands of visitors every year.</p>
    <div style="display:flex;flex-wrap:wrap;gap:10px">
      <div style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:10px 16px;text-align:center;flex:1;min-width:100px">
        <div style="font-size:18px;font-weight:900;color:var(--accent)">1723</div>
        <div style="font-size:10px;color:var(--muted);font-weight:700;letter-spacing:0.5px;margin-top:2px">FOUNDED</div>
      </div>
      <div style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:10px 16px;text-align:center;flex:1;min-width:100px">
        <div style="font-size:18px;font-weight:900;color:var(--accent2)">600K+</div>
        <div style="font-size:10px;color:var(--muted);font-weight:700;letter-spacing:0.5px;margin-top:2px">POPULATION</div>
      </div>
      <div style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:10px 16px;text-align:center;flex:1;min-width:100px">
        <div style="font-size:18px;font-weight:900;color:var(--accent)">20+</div>
        <div style="font-size:10px;color:var(--muted);font-weight:700;letter-spacing:0.5px;margin-top:2px">ATTRACTIONS</div>
      </div>
      <div style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:10px 16px;text-align:center;flex:1;min-width:100px">
        <div style="font-size:18px;font-weight:900;color:var(--accent2)">Gulf</div>
        <div style="font-size:10px;color:var(--muted);font-weight:700;letter-spacing:0.5px;margin-top:2px">OF KHAMBHAT</div>
      </div>
    </div>
  </div>`;
      document.getElementById('homeContent').innerHTML = introHtml;
      const quick = [{
          ico: '🌟',
          title: 'Discover the',
          accent: 'Unseen Beauty',
          sub: 'From serene temples to royal palaces — Bhavnagar has it all.',
          page: 'Places',
          filter: null
        },
        {
          ico: '🌄',
          title: 'Beyond',
          accent: "Bhavnagar's Horizon",
          sub: 'Day trips, ancient caves and wildlife just hours away.',
          page: 'Nearby',
          filter: null
        },
        {
          ico: '🍴',
          title: 'Taste the',
          accent: 'Soul of Bhavnagar',
          sub: 'From Royal Thalis to Bhavnagri Gathiya — flavours to remember.',
          page: 'Food',
          filter: null
        },
        {
          ico: '🎊',
          title: 'Moments Worth',
          accent: 'Experiencing',
          sub: 'Cultural festivals and spiritual events that move you.',
          page: 'Events',
          filter: null
        },
        {
          ico: '🗺',
          title: 'Craft Your',
          accent: 'Ideal Escape',
          sub: 'Let AI plan every detail of your Bhavnagar journey.',
          page: 'Planner',
          filter: null
        },
        {
          ico: '🤝',
          title: 'Experience',
          accent: 'Like a Local',
          sub: 'Verified guides who share stories from the heart of the city.',
          page: 'Guides',
          filter: null
        },
      ];
      const quickHtml = `
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:16px;margin-bottom:56px">
      ${quick.map(q => `
        <div class="card hoverable quick-card" onclick="navigateWithFilter('${q.page}','${q.filter}')">
          <div class="quick-icon">${q.ico}</div>
          <div class="quick-title">${q.title} <span>${q.accent}</span></div>
          <div class="quick-sub">${q.sub}</div>
          <div class="quick-arrow">Explore →</div>
        </div>
      `).join('')}
    </div>
    <div class="section-header">
      <h2 class="section-title">Featured Places</h2>
      <p class="section-sub">Top-rated attractions in Bhavnagar</p>
      <div class="section-divider"></div>
    </div>
    <div class="grid-auto">
      ${[1, 2, 3, 6, 36, 29].map(id => PLACES.find(p => p.id === id)).filter(Boolean).map(p => `
        <div class="card hoverable" style="overflow:hidden;cursor:pointer" onclick="openPlaceModal(${p.id})">
          <div class="place-img-wrap" style="height:175px">
            <img src="${p.img}" alt="${p.name}" onerror="this.src='https://picsum.photos/seed/hp${p.id}/600/400'">
            <div style="position:absolute;inset:0;background:linear-gradient(transparent 38%,rgba(0,0,0,0.74))"></div>
            <div style="position:absolute;bottom:11px;left:13px;color:#fff">
              <div style="font-weight:800;font-size:16px">${p.name}</div>
              <div style="font-size:12px;opacity:0.75">⭐ ${p.rating} • ${p.distance}</div>
            </div>
          </div>
        </div>
      `).join('')}
    </div>
    <div style="text-align:center;margin-top:22px">
      <button class="btn-primary" onclick="navigate('Places')">View All Places →</button>
    </div>

    <div id="weatherWidget" style="margin-top:40px"></div>

    <div style="margin-top:8px;margin-bottom:8px">
      <div class="section-header" style="margin-bottom:20px">
        <h2 class="section-title">📍 Find Your Next Adventure</h2>
        <p class="section-sub">Every corner of Bhavnagar holds a story — start exploring on the map</p>
        <div class="section-divider"></div>
      </div>
      <div style="border-radius:18px;overflow:hidden;border:1px solid var(--card-border);position:relative;box-shadow:0 12px 40px rgba(0,0,0,0.35)">
        <div style="position:absolute;top:14px;left:50%;transform:translateX(-50%);z-index:10;background:var(--card);border:1px solid var(--card-border);backdrop-filter:blur(12px);padding:7px 18px;border-radius:20px;font-size:12px;font-weight:700;color:var(--accent);white-space:nowrap;pointer-events:none">
          🗺️ Bhavnagar, Gujarat, India
        </div>
        <div style="position:absolute;top:14px;left:14px;z-index:10;display:flex;gap:6px">
          <button id="mapBtnRoad" onclick="setMapType('road')" style="background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;border:none;border-radius:16px;padding:6px 13px;font-size:11px;font-weight:700;cursor:pointer;font-family:inherit;transition:all 0.2s">🗺️ Map</button>
          <button id="mapBtnSat" onclick="setMapType('satellite')" style="background:var(--card);border:1px solid var(--card-border);color:var(--muted);border-radius:16px;padding:6px 13px;font-size:11px;font-weight:700;cursor:pointer;font-family:inherit;transition:all 0.2s">🛰️ Satellite</button>
        </div>
        <iframe id="bhavnagarMapFrame"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59416.04!2d72.1069!3d21.7645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f5e30cf70a5f9%3A0x1e2e3b4c5d6f7a8b!2sBhavnagar%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1708000000000!5m2!1sen!2sin"
          width="100%" height="400"
          style="border:0;display:block;filter:grayscale(15%) contrast(1.05)"
          allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <div style="position:absolute;bottom:0;left:0;right:0;height:60px;background:linear-gradient(transparent,rgba(0,0,0,0.4));pointer-events:none"></div>
        <a href="https://www.google.com/maps/place/Bhavnagar,+Gujarat" target="_blank"
          style="position:absolute;bottom:14px;right:14px;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-size:12px;font-weight:700;padding:7px 16px;border-radius:20px;text-decoration:none;z-index:10">
          Open in Google Maps →
        </a>
      </div>
    </div>
  `;
      document.getElementById('homeContent').innerHTML += quickHtml;

      // ── INJECT REVIEW SECTIONS ──────────────────────────────────
      const reviewHtml = `
    <!-- TRAVELLER REVIEWS DISPLAY -->
    <div style="margin-top:60px">
      <div class="section-header">
        <h2 class="section-title">💬 Traveller Reviews</h2>
        <p class="section-sub">Real experiences from GoTrip visitors</p>
        <div class="section-divider"></div>
      </div>
      <div id="reviews-display">
        <div style="text-align:center;padding:44px 0;color:var(--muted)">
          <div style="font-size:36px;margin-bottom:12px">⏳</div>Loading reviews…
        </div>
      </div>
      <div style="text-align:center;margin-top:28px">
        <a href="all-reviews.php" class="btn-see-more">See All Reviews →</a>
      </div>
    </div>

    <!-- SUBMIT REVIEW FORM -->
    <div style="margin-top:60px;margin-bottom:10px">
      <div class="section-header">
        <h2 class="section-title">✍️ Share Your Experience</h2>
        <p class="section-sub">Visited Bhavnagar? Help fellow travellers by leaving a review!</p>
        <div class="section-divider"></div>
      </div>
      <div class="review-form-wrap">
        <div class="review-field">
          <label class="review-label">Your Rating</label>
          <div class="star-rating" id="starRating">
            <span class="star" data-val="1">★</span>
            <span class="star" data-val="2">★</span>
            <span class="star" data-val="3">★</span>
            <span class="star" data-val="4">★</span>
            <span class="star" data-val="5">★</span>
          </div>
          <input type="hidden" id="reviewRating" value="0">
        </div>
        <div class="review-field">
          <label class="review-label">Your Name</label>
          <input class="review-input" type="text" id="reviewName"
            placeholder="e.g. Rahul Sharma" maxlength="100" autocomplete="name">
        </div>
        <div class="review-field">
          <label class="review-label">Your Review</label>
          <textarea class="review-input" id="reviewMessage" rows="4"
            placeholder="What did you love most about Bhavnagar? Any hidden gems or tips?"
            maxlength="2000"></textarea>
        </div>
        <div class="review-field">
          <label class="review-label">Upload a Photo <span style="font-weight:500;text-transform:none;letter-spacing:0;color:var(--muted);font-size:10px">(optional — JPG/PNG/WEBP, max 5MB)</span></label>
          <label id="photoUploadLabel" style="display:flex;align-items:center;gap:12px;background:rgba(255,255,255,0.04);border:1.5px dashed var(--card-border);border-radius:13px;padding:14px 16px;cursor:pointer;transition:border-color 0.2s" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--card-border)'">
            <span style="font-size:24px">📷</span>
            <span id="photoUploadText" style="font-size:13px;color:var(--muted);font-weight:500">Click to choose a photo from your device</span>
            <input type="file" id="reviewPhoto" accept="image/jpeg,image/png,image/webp,image/gif" style="display:none" onchange="previewPhoto(this)">
          </label>
          <div id="photoPreviewWrap" style="display:none;margin-top:10px;position:relative">
            <img id="photoPreview" style="width:100%;max-height:160px;object-fit:cover;border-radius:10px;border:1px solid var(--card-border)" alt="Preview">
            <button onclick="clearPhoto()" style="position:absolute;top:6px;right:6px;background:rgba(0,0,0,0.7);border:none;color:#fff;border-radius:50%;width:26px;height:26px;cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center">✕</button>
          </div>
        </div>
        <div id="reviewMsg" class="review-msg"></div>
        <button id="reviewSubmitBtn" class="btn-primary"
          style="width:100%;margin-top:4px;font-size:15px;padding:14px"
          onclick="submitReview()">
          Submit Review 🚀
        </button>
      </div>
    </div>
  `;
      document.getElementById('homeContent').innerHTML += reviewHtml;
      fetchWeather(); // called AFTER all innerHTML done — weatherWidget div now stable in DOM
      loadReviews(); // load latest reviews dynamically
    }

    // ── PLACES ────────────────────────────────────────────────────────────────────
    function renderPlaces() {
      const cats = ['All', 'Spiritual', 'Nature', 'History', 'Heritage', 'Beach', 'Industrial', 'Adventure', 'Culture'];
      const filterEl = document.getElementById('placesFilter');
      if (!document.getElementById('placesSearchInput')) {
        filterEl.insertAdjacentHTML('beforebegin', `
          <div class="search-wrap">
            <span class="search-icon">🔍</span>
            <input id="placesSearchInput" class="search-input" type="text" placeholder="Search places, categories, tips…" value="${placesSearch}" oninput="onPlacesSearch(this.value)" autocomplete="off">
            <button class="search-clear${placesSearch ? ' visible' : ''}" id="placesSearchClear" onclick="onPlacesSearch('')" title="Clear">×</button>
          </div>`);
      } else {
        document.getElementById('placesSearchInput').value = placesSearch;
        document.getElementById('placesSearchClear').classList.toggle('visible', !!placesSearch);
      }
      filterEl.innerHTML = cats.map(c =>
        `<button class="chip${placesFilter === c ? ' active' : ''}" onclick="setPlaceFilter('${c}')">${c}</button>`
      ).join('');
      const q = placesSearch.trim().toLowerCase();
      let list = placesFilter === 'All' ? PLACES : PLACES.filter(p => p.cat.includes(placesFilter));
      if (q) list = list.filter(p =>
        p.name.toLowerCase().includes(q) ||
        p.cat.toLowerCase().includes(q) ||
        p.desc.toLowerCase().includes(q) ||
        (p.tips && p.tips.toLowerCase().includes(q))
      );
      if (list.length === 0) {
        document.getElementById('placesGrid').innerHTML = `<div class="search-no-results"><span>🔍</span>No places found for "<strong>${placesSearch}</strong>"</div>`;
        return;
      }
      document.getElementById('placesGrid').innerHTML = list.map(pl => `
    <div class="card hoverable" style="overflow:hidden;cursor:pointer" onclick="openPlaceModal(${pl.id})">
      <div class="place-img-wrap">
        <img src="${pl.img}" alt="${pl.name}" onerror="this.src='https://picsum.photos/seed/pl${pl.id}/800/500'">
        <span class="badge badge-cat">${pl.cat}</span>
        <span class="badge badge-rating">⭐ ${pl.rating}</span>
      </div>
      <div class="place-body">
        <h3 class="place-name">${pl.name}</h3>
        <p class="place-desc">${pl.desc}</p>
        ${pl.tips ? `<div class="place-tip">💡 ${pl.tips}</div>` : ''}
        <div class="place-meta">📍 ${pl.distance} &nbsp; ⏰ ${pl.open} &nbsp; 🎟️ ${pl.entry}</div>
        <div class="card-btns">
          <a href="https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(pl.name + ' Bhavnagar Gujarat')}" target="_blank" class="btn-grad" onclick="event.stopPropagation()">🗺️ Navigate</a>
          <button class="btn-soft" onclick="event.stopPropagation();openPlaceModal(${pl.id},true)">🍽️ Nearby Food</button>
        </div>
      </div>
    </div>
  `).join('');
    }

    function onPlacesSearch(val) {
      placesSearch = val;
      renderPlaces();
    }

    function setPlaceFilter(cat) {
      placesFilter = cat;
      renderPlaces();
    }

    // ── GEOLOCATION ───────────────────────────────────────────────────────────────
    let userLat = null,
      userLng = null,
      locationAsked = false;

    function haversineKm(lat1, lng1, lat2, lng2) {
      const R = 6371;
      const dLat = (lat2 - lat1) * Math.PI / 180;
      const dLng = (lng2 - lng1) * Math.PI / 180;
      const a = Math.sin(dLat / 2) ** 2 + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLng / 2) ** 2;
      return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    }

    const ROAD_FACTOR = 1.3; // straight-line to road distance approximation

    function roadKm(lat, lng) {
      return haversineKm(userLat, userLng, lat, lng) * ROAD_FACTOR;
    }

    function liveDistance(plLat, plLng, fallback) {
      if (userLat !== null) {
        const km = roadKm(plLat, plLng);
        const label = km < 1 ? `${Math.round(km * 1000)} m` : `${km.toFixed(1)} km`;
        return `📡 ${label} from you`;
      }
      return `📍 ${fallback}`;
    }

    function driveTime(plLat, plLng, fallback) {
      if (userLat === null) return fallback;
      const km = roadKm(plLat, plLng); // uses road factor for realistic distance
      let speedKmh;
      if (km < 5) speedKmh = 20; // dense city traffic
      else if (km < 20) speedKmh = 35; // mixed city/suburban roads
      else if (km < 60) speedKmh = 55; // state highway
      else speedKmh = 70; // national highway
      const mins = Math.round((km / speedKmh) * 60);
      if (mins < 60) return `🚗 ~${mins} min drive`;
      const h = Math.floor(mins / 60);
      const m = mins % 60;
      return m > 0 ? `🚗 ~${h}h ${m}m drive` : `🚗 ~${h}h drive`;
    }

    function requestLocation(callback) {
      if (userLat !== null) {
        callback();
        return;
      }
      if (!navigator.geolocation) {
        callback();
        return;
      }
      navigator.geolocation.getCurrentPosition(
        pos => {
          userLat = pos.coords.latitude;
          userLng = pos.coords.longitude;
          callback();
        },
        () => {
          callback();
        }, // silently fall back
        {
          timeout: 6000
        }
      );
    }

    // ── PLACE MODAL ───────────────────────────────────────────────────────────────
    let modalFoodTab = false;
    let currentOpenPlaceId = null;
    let currentOpenNearbyId = null;

    function openPlaceModal(id, foodTab = false) {
      const pl = PLACES.find(p => p.id === id);
      if (!pl) return;
      currentOpenPlaceId = id;
      modalFoodTab = foodTab;
      document.getElementById('placeModal').classList.add('open');
      // Show modal instantly, then refresh distance once location arrives
      renderPlaceModalContent(pl);
      if (userLat === null && !locationAsked) {
        locationAsked = true;
        requestLocation(() => renderPlaceModalContent(pl));
      }
    }

    function renderPlaceModalContent(pl) {
      const foods = nearbyFoods(pl.id);
      const distLabel = liveDistance(pl.lat, pl.lng, pl.distance);
      const mapsNavUser = userLat !== null ?
        `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${pl.lat},${pl.lng}&travelmode=driving` :
        `https://www.google.com/maps/dir/?api=1&destination=${pl.lat},${pl.lng}&travelmode=driving`;

      document.getElementById('placeModalBox').innerHTML = `
    <div class="modal-img">
      <img src="${pl.img}" alt="${pl.name}" onerror="this.src='https://picsum.photos/seed/pm${pl.id}/800/500'">
      <div class="modal-img-grad"></div>
      <button class="modal-close" onclick="closePlaceModal()">×</button>
      <span class="modal-cat">${pl.cat}</span>
      <div class="modal-title-area">
        <h2>${pl.name}</h2>
        <div class="modal-sub">⭐ ${pl.rating} &nbsp;•&nbsp; 📍 ${pl.distance}</div>
      </div>
    </div>
    <div class="modal-tabs">
      <button class="modal-tab${!modalFoodTab ? ' active' : ''}" onclick="switchPlaceTab(${pl.id},false)">📍 Details</button>
      <button class="modal-tab${modalFoodTab ? ' active' : ''}" onclick="switchPlaceTab(${pl.id},true)">🍽️ Nearby Food</button>
    </div>
    <div class="modal-body">
      ${!modalFoodTab ? `
        <p style="color:var(--modal-text-muted);line-height:1.75;font-size:13px;margin-bottom:15px">${pl.desc}</p>
        <div class="info-grid">
          <div class="info-tile"><div class="info-tile-lbl">OPEN</div><div class="info-tile-val">⏰ ${pl.open}</div></div>
          <div class="info-tile"><div class="info-tile-lbl">ENTRY</div><div class="info-tile-val">🎟️ ${pl.entry || 'Free'}</div></div>
          <div class="info-tile"><div class="info-tile-lbl">RATING</div><div class="info-tile-val gold">⭐ ${pl.rating}/5</div></div>
        </div>
        
        ${pl.tips ? `<div class="tip-box"><div class="tip-box-lbl">💡 LOCAL TIP</div><div class="tip-box-txt">${pl.tips}</div></div>` : ''}
        <div class="modal-actions">
          <a href="https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(pl.name + ' Bhavnagar Gujarat')}" target="_blank" class="btn-navigate">📍 Get Directions</a>
          <button class="btn-food" onclick="switchPlaceTab(${pl.id},true)">🍽️ Nearby Food</button>
        </div>
      ` : `
        <p style="color:var(--muted);font-size:12px;margin-bottom:13px">Top restaurants near <strong style="color:var(--text)">${pl.name}</strong></p>
        ${foods.map(fd => `
          <div class="food-mini">
            <div style="width:44px;height:44px;border-radius:10px;flex-shrink:0;background:${fd.type === 'Veg' ? 'rgba(34,197,94,0.12)' : 'rgba(239,68,68,0.12)'};border:1px solid ${fd.type === 'Veg' ? 'rgba(34,197,94,0.25)' : 'rgba(239,68,68,0.25)'};display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;color:${fd.type === 'Veg' ? '#22c55e' : '#ef4444'}">${fd.type === 'Veg' ? '🌿' : '🍖'}</div>
            <div class="food-mini-body">
              <div class="food-mini-name">${fd.name}</div>
              <div class="food-mini-meta">⭐ ${fd.rating} • 💰 ${fd.budget}</div>
              <div style="color:var(--muted);font-size:11px;margin-bottom:4px">🍽️ ${fd.specialty}</div>
              <div style="color:var(--muted);font-size:10px;margin-bottom:8px">📍 ${fd.area}</div>
              <div class="food-mini-btns">
                <button class="fmb fmb-nav" onclick="event.stopPropagation();closePlaceModal();setTimeout(()=>{navigate('Food',false);openFoodModal(${fd.id});},120)">View Details →</button>
              </div>
            </div>
          </div>
        `).join('')}
        <a href="${mapsSearch('restaurants near ' + pl.name + ' Bhavnagar')}" target="_blank" class="explore-more-btn">🔍 Search More on Google Maps</a>
      `}
    </div>
  `;
    }

    function switchPlaceTab(id, foodTab) {
      const pl = PLACES.find(p => p.id === id);
      if (!pl) return;
      modalFoodTab = foodTab;
      renderPlaceModalContent(pl);
    }

    function closePlaceModal(e) {
      if (!e || e.target === document.getElementById('placeModal')) {
        document.getElementById('placeModal').classList.remove('open');
        modalFoodTab = false;
      }
    }

    // ── NEARBY ────────────────────────────────────────────────────────────────────
    function renderNearby() {
      const gridEl = document.getElementById('nearbyGrid');
      if (!document.getElementById('nearbySearchInput')) {
        gridEl.insertAdjacentHTML('beforebegin', `
          <div class="search-wrap">
            <span class="search-icon">🔍</span>
            <input id="nearbySearchInput" class="search-input" type="text" placeholder="Search destinations, categories…" value="${nearbySearch}" oninput="onNearbySearch(this.value)" autocomplete="off">
            <button class="search-clear${nearbySearch ? ' visible' : ''}" id="nearbySearchClear" onclick="onNearbySearch('')" title="Clear">×</button>
          </div>`);
      } else {
        document.getElementById('nearbySearchInput').value = nearbySearch;
        document.getElementById('nearbySearchClear').classList.toggle('visible', !!nearbySearch);
      }
      const q = nearbySearch.trim().toLowerCase();
      let list = q ? NEARBY.filter(d =>
        d.name.toLowerCase().includes(q) ||
        d.cat.toLowerCase().includes(q) ||
        d.desc.toLowerCase().includes(q) ||
        (d.tips && d.tips.toLowerCase().includes(q)) ||
        (d.highlights && d.highlights.some(h => h.toLowerCase().includes(q)))
      ) : NEARBY;
      if (list.length === 0) {
        gridEl.innerHTML = `<div class="search-no-results"><span>🔍</span>No destinations found for "<strong>${nearbySearch}</strong>"</div>`;
        return;
      }
      gridEl.innerHTML = list.map(d => `
    <div class="card hoverable" style="overflow:hidden;cursor:pointer" onclick="openNearbyModal(${d.id})">
      <div class="nb-img-wrap">
        <img src="${d.img}" alt="${d.name}" onerror="this.src='https://picsum.photos/seed/nb${d.id}/600/400'">
        <div class="nb-grad"></div>
        <div style="position:absolute;top:11px;left:11px;background:rgba(0,194,255,0.82);color:#fff;padding:3px 11px;border-radius:50px;font-size:11px;font-weight:700">${d.cat}</div>
        <div style="position:absolute;top:11px;right:11px;background:rgba(0,0,0,0.55);color:#fff;padding:3px 9px;border-radius:50px;font-size:11px">📍 ${d.distance}</div>
        <div class="nb-info">
          <div class="nb-name">${d.name}</div>
          <div class="nb-sub">Best: ${d.best}</div>
        </div>
      </div>
      <div class="nb-body">
        <p class="nb-desc">${d.desc.slice(0, 110)}…</p>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px">
          <div style="display:flex;gap:6px;flex-wrap:wrap">
            ${d.highlights ? d.highlights.slice(0, 2).map(h => `<span style="background:rgba(0,194,255,0.1);border:1px solid rgba(0,194,255,0.2);color:var(--accent);font-size:10px;font-weight:700;padding:3px 8px;border-radius:20px">${h}</span>`).join('') : ''}
          </div>
          <button class="nb-details-btn" onclick="event.stopPropagation();openNearbyModal(${d.id})">Explore →</button>
        </div>
      </div>
    </div>
  `).join('');
    }

    function onNearbySearch(val) {
      nearbySearch = val;
      renderNearby();
    }

    function openNearbyModal(id) {
      const d = NEARBY.find(n => n.id === id);
      if (!d) return;
      currentOpenNearbyId = id;
      document.getElementById('nearbyModal').classList.add('open');
      renderNearbyModalContent(d);
      if (userLat === null && !locationAsked) {
        locationAsked = true;
        requestLocation(() => renderNearbyModalContent(d));
      }
    }

    function renderNearbyModalContent(d) {
      const distLabel = liveDistance(d.lat, d.lng, d.distance);
      const mapsNavUser = userLat !== null ?
        `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${d.lat},${d.lng}&travelmode=driving` :
        `https://www.google.com/maps/dir/?api=1&destination=${d.lat},${d.lng}&travelmode=driving`;

      document.getElementById('nearbyModalBox').innerHTML = `
    <div class="modal-img" style="height:230px">
      <img src="${d.img}" alt="${d.name}" style="width:100%;height:100%;object-fit:cover" onerror="this.src='https://picsum.photos/seed/nbm${d.id}/800/500'">
      <div class="modal-img-grad"></div>
      <button class="modal-close" onclick="closeNearbyModal()">×</button>
      <span class="modal-cat">${d.cat}</span>
      <div class="modal-title-area">
        <h2>${d.name}</h2>
        <div class="modal-sub">📍 ${d.distance} &nbsp;•&nbsp; 🌤 ${d.best}</div>
      </div>
    </div>
    <div class="modal-body">
      <p style="color:var(--modal-text-muted);line-height:1.78;font-size:13px;margin-bottom:16px">${d.desc}</p>
      <div class="info-grid" style="margin-bottom:15px">
        <div class="info-tile"><div class="info-tile-lbl">DISTANCE</div><div class="info-tile-val">📍 ${d.distance}</div></div>
        <div class="info-tile"><div class="info-tile-lbl">BEST SEASON</div><div class="info-tile-val">🌤 ${d.best}</div></div>
        <div class="info-tile"><div class="info-tile-lbl">ENTRY</div><div class="info-tile-val">🎟️ ${d.entry}</div></div>
      </div>
      
      ${d.highlights ? `
        <div style="margin-bottom:15px">
          <div style="color:var(--modal-tile-lbl);font-size:11px;font-weight:700;margin-bottom:8px;letter-spacing:0.5px">✨ HIGHLIGHTS</div>
          <div style="display:flex;flex-wrap:wrap;gap:6px">
            ${d.highlights.map(h => `<span style="padding:5px 12px;border-radius:50px;background:rgba(0,194,255,0.1);border:1px solid rgba(0,194,255,0.2);color:var(--accent);font-size:12px;font-weight:600">${h}</span>`).join('')}
          </div>
        </div>
      ` : ''}
      ${d.tips ? `
        <div class="tip-box" style="margin-bottom:16px">
          <div class="tip-box-lbl">💡 LOCAL TIP</div>
          <div class="tip-box-txt">${d.tips}</div>
        </div>
      ` : ''}
      <div class="modal-actions">
        <a href="https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(d.name + ' Gujarat')}" target="_blank" class="btn-navigate">📍 Get Directions</a>
        <button onclick="event.stopPropagation();shareNearby(${d.id})" style="flex:1;padding:13px;border-radius:13px;background:rgba(255,107,53,0.14);border:1px solid rgba(255,107,53,0.3);color:#ff6b35;font-weight:800;text-align:center;font-size:14px;cursor:pointer;font-family:inherit;border-width:1px;border-style:solid">🔗 Share</button>
      </div>
    </div>
  `;
    }

    function shareNearby(id) {
      const d = NEARBY.find(n => n.id === id);
      if (!d) return;
      const url = `https://www.google.com/maps/search/${encodeURIComponent(d.name + ' Bhavnagar Gujarat')}`;
      const text = `📍 ${d.name} — ${d.desc.slice(0, 80)}...`;
      if (navigator.share) {
        navigator.share({
          title: d.name,
          text,
          url
        });
      } else {
        navigator.clipboard.writeText(text + ' ' + url)
          .then(() => alert('📋 Copied to clipboard!'))
          .catch(() => window.open(url, '_blank'));
      }
    }

    function closeNearbyModal(e) {
      if (!e || e.target === document.getElementById('nearbyModal')) {
        document.getElementById('nearbyModal').classList.remove('open');
      }
    }

    // ── FOOD ──────────────────────────────────────────────────────────────────────
    function renderFood() {
      const filterEl = document.getElementById('foodFilter');
      if (!document.getElementById('foodSearchInput')) {
        filterEl.insertAdjacentHTML('beforebegin', `
          <div class="search-wrap">
            <span class="search-icon">🔍</span>
            <input id="foodSearchInput" class="search-input" type="text" placeholder="Search dishes, restaurants, specialties…" value="${foodSearch}" oninput="onFoodSearch(this.value)" autocomplete="off">
            <button class="search-clear${foodSearch ? ' visible' : ''}" id="foodSearchClear" onclick="onFoodSearch('')" title="Clear">×</button>
          </div>`);
      } else {
        document.getElementById('foodSearchInput').value = foodSearch;
        document.getElementById('foodSearchClear').classList.toggle('visible', !!foodSearch);
      }
      filterEl.innerHTML = ['All', 'Veg', 'Non-Veg'].map(f =>
        `<button class="chip${foodFilter === f ? ' active' : ''}" onclick="setFoodFilter('${f}')">${f === 'Veg' ? '🌿 Veg' : f === 'Non-Veg' ? '🍖 Non-Veg' : '🍽️ All'}</button>`
      ).join('');
      const q = foodSearch.trim().toLowerCase();
      let list = foodFilter === 'All' ? FOODS : FOODS.filter(f => f.type === foodFilter);
      if (q) list = list.filter(r =>
        r.name.toLowerCase().includes(q) ||
        r.specialty.toLowerCase().includes(q) ||
        r.desc.toLowerCase().includes(q) ||
        (r.mustTry && r.mustTry.some(m => m.toLowerCase().includes(q))) ||
        (r.near || '').toLowerCase().includes(q)
      );
      if (list.length === 0) {
        document.getElementById('foodGrid').innerHTML = `<div class="search-no-results"><span>🍽️</span>No restaurants found for "<strong>${foodSearch}</strong>"</div>`;
      } else {
        document.getElementById('foodGrid').innerHTML = list.map(r => `
    <div class="card hoverable" style="overflow:hidden;cursor:pointer" onclick="openFoodModal(${r.id})">
      <div class="food-card-header">
        <div class="food-header-rating">⭐ ${r.rating}</div>
        <div>
          <span class="food-type-pill ${r.type === 'Veg' ? 'veg' : 'nonveg'}">${r.type === 'Veg' ? '🌿 Veg' : '🍖 Non-Veg'}</span>
          <span class="food-cat-tag">${r.cat}</span>
        </div>
        <div class="food-header-budget">${r.budget}</div>
        <div style="font-size:11px;color:var(--muted);margin-top:2px">📍 ${r.area}</div>
      </div>
      <div class="food-body">
        <h3 class="food-name">${r.name}</h3>
        <div class="food-meta" style="margin-bottom:9px">🍽️ ${r.specialty}</div>
        ${r.mustTry ? '<div class="must-try-chips">' + r.mustTry.slice(0, 3).map(item => '<span class="mtc">' + item + '</span>').join('') + '</div>' : ''}
        <div class="card-btns"><button class="btn-grad" onclick="event.stopPropagation();openFoodModal(${r.id})">View Details</button></div>
      </div>
    </div>
  `).join('');
      }
      // Render nearby food section
      if (document.getElementById('nearbyFoodGrid')) {
        let nearbyList = NEARBY_FOODS;
        if (q) nearbyList = nearbyList.filter(r =>
          r.name.toLowerCase().includes(q) ||
          r.specialty.toLowerCase().includes(q) ||
          r.desc.toLowerCase().includes(q) ||
          (r.mustTry && r.mustTry.some(m => m.toLowerCase().includes(q))) ||
          r.nearDest.toLowerCase().includes(q)
        );
        if (nearbyList.length === 0) {
          document.getElementById('nearbyFoodGrid').innerHTML = `<div class="search-no-results"><span>🗺️</span>No nearby food found for "<strong>${foodSearch}</strong>"</div>`;
        } else {
          document.getElementById('nearbyFoodGrid').innerHTML = nearbyList.map(r => `
      <div class="card hoverable" style="overflow:hidden;cursor:pointer" onclick="openNearbyFoodModal(${r.id})">
        <div class="food-card-header">
          <div style="position:absolute;top:12px;right:12px;background:rgba(139,92,246,0.15);color:#a78bfa;font-size:10px;font-weight:700;padding:3px 9px;border-radius:20px;border:1px solid rgba(139,92,246,0.25)">📍 ${r.nearDest}</div>
          <span class="food-type-pill veg">🌿 Veg</span>
          <div class="food-header-budget">${r.budget}</div>
          <div style="font-size:11px;color:var(--muted);margin-top:2px">Near ${r.nearDest}</div>
        </div>
        <div class="food-body">
          <h3 class="food-name">${r.name}</h3>
          <div class="food-meta" style="margin-bottom:9px">🍽️ ${r.specialty}</div>
          ${r.mustTry ? '<div class="must-try-chips">' + r.mustTry.slice(0, 3).map(item => '<span class="mtc">' + item + '</span>').join('') + '</div>' : ''}
        </div>
      </div>
    `).join('');
        }
      }
    }

    function onFoodSearch(val) {
      foodSearch = val;
      renderFood();
    }

    function onHotelSearch(val) {
      hotelSearch = val;
      const input = document.getElementById('hotelSearchInput');
      const clear = document.getElementById('hotelSearchClear');
      if (input) input.value = val;
      if (clear) clear.classList.toggle('visible', !!val);
      renderHotels();
    }

    function setFoodFilter(f) {
      foodFilter = f;
      renderFood();
    }

    function openNearbyFoodModal(id) {
      const r = NEARBY_FOODS.find(f => f.id === id);
      if (!r) return;
      document.getElementById('foodModalBox').innerHTML = `
    <button class="modal-close" onclick="closeFoodModal()" style="position:absolute;top:14px;right:14px;z-index:10">×</button>
    <div style="padding:24px">
      <div style="display:flex;gap:8px;margin-bottom:14px;flex-wrap:wrap;align-items:center">
        <span class="badge food-veg">🌿 Veg</span>
        <span style="background:rgba(139,92,246,0.15);color:#a78bfa;font-size:12px;font-weight:700;padding:4px 12px;border-radius:20px">📍 Near ${r.nearDest}</span>
      </div>
      <h2 style="color:var(--modal-text);font-size:22px;font-weight:900;margin-bottom:6px">${r.name}</h2>
      <p style="color:var(--modal-text-muted);font-size:13px;margin-bottom:16px">${r.address}</p>
      <p style="color:var(--modal-text);font-size:13px;line-height:1.75;margin-bottom:16px;opacity:0.8">${r.desc}</p>
      <div class="info-grid" style="margin-bottom:14px">
        <div class="info-tile"><div class="info-tile-lbl">BUDGET</div><div class="info-tile-val" style="color:#22c55e">${r.budget}</div></div>
        <div class="info-tile"><div class="info-tile-lbl">OPEN</div><div class="info-tile-val">⏰ ${r.open}</div></div>
      </div>
      ${r.mustTry ? `<div class="tip-box"><div class="tip-box-lbl">🍽️ MUST TRY</div><div class="must-try-chips" style="margin-top:8px">${r.mustTry.map(item => `<span class="mtc">${item}</span>`).join('')}</div></div>` : ''}
      ${r.tips ? `<div class="tip-box" style="margin-top:10px"><div class="tip-box-lbl">💡 LOCAL TIP</div><div class="tip-box-txt">${r.tips}</div></div>` : ''}
      <div class="modal-food-actions" style="margin-top:16px">
        <a href="${mapsNav(r.lat, r.lng, r.name)}" target="_blank" class="btn-navigate">🗺️ Navigate</a>
      </div>
    </div>
  `;
      document.getElementById('foodModal').classList.add('open');
      document.body.style.overflow = 'hidden';
    }

    function openFoodModal(id) {
      const r = FOODS.find(f => f.id === id);
      if (!r) return;
      document.getElementById('foodModal').classList.add('open');
      document.getElementById('foodModalBox').innerHTML = `
    <div style="padding:18px 20px 12px;border-bottom:1px solid var(--card-border);position:relative">
      <button class="modal-close" onclick="closeFoodModal()" style="position:absolute;top:12px;right:14px">×</button>
      <div style="display:flex;gap:7px;align-items:center;margin-bottom:8px;flex-wrap:wrap">
        <span class="food-type-pill ${r.type === 'Veg' ? 'veg' : 'nonveg'}">${r.type === 'Veg' ? '🌿 Veg' : '🍖 Non-Veg'}</span>
        <span class="food-cat-tag">${r.cat}</span>
      </div>
      <h2 style="color:var(--modal-text);font-size:20px;font-weight:900;margin-bottom:3px">${r.name}</h2>
      <div style="color:var(--modal-text-muted);font-size:12px">📍 ${r.area}</div>
    </div>
    <div class="modal-body">
      <div class="stat-grid">
        <div class="stat-tile"><div class="stat-tile-lbl">RATING</div><div class="stat-tile-val" style="color:#fbbf24">⭐ ${r.rating}</div></div>
        <div class="stat-tile"><div class="stat-tile-lbl">BUDGET</div><div class="stat-tile-val" style="color:#22c55e">${r.budget}</div></div>
        <div class="stat-tile"><div class="stat-tile-lbl">TYPE</div><div class="stat-tile-val" style="color:${r.type === 'Veg' ? '#22c55e' : '#ef4444'}">${r.type}</div></div>
      </div>
      <p style="color:var(--muted);font-size:13px;line-height:1.75;margin-bottom:13px">${r.desc}</p>
      ${r.open ? `<div class="address-row"><span>⏰</span><div><div class="address-row-label">HOURS</div><div class="address-row-val">${r.open}</div></div></div>` : ''}
      ${r.tips ? `<div class="tip-box"><div class="tip-box-lbl">💡 LOCAL TIP</div><div class="tip-box-txt">${r.tips}</div></div>` : ''}
      ${r.mustTry ? `<div class="must-try-section"><div class="must-try-lbl">🌟 MUST TRY</div><div class="must-try-chips2">${r.mustTry.map(i => `<span class="mtc2">${i}</span>`).join('')}</div></div>` : ''}
      <div class="modal-food-actions">
        <a href="https://www.google.com/maps/search/${encodeURIComponent(r.name + '+Bhavnagar+Gujarat')}" target="_blank" class="btn-navigate" style="width:100%;text-align:center">🗺️ Navigate on Google Maps</a>
      </div>
    </div>
  `;
    }

    function closeFoodModal(e) {
      if (!e || e.target === document.getElementById('foodModal')) {
        document.getElementById('foodModal').classList.remove('open');
      }
    }

    // ── EVENTS ────────────────────────────────────────────────────────────────────
    function isRegularEvent(ev) {
      return ev.date.startsWith('Every');
    }


    function buildEventCard(ev, past = false) {
      const c = EVT_COLORS[ev.type] || '#00c2ff';
      const isRegular = isRegularEvent(ev);
      const badge = past ?
        `<span style="background:rgba(255,255,255,0.06);color:var(--muted);font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px">Past</span>` :
        isRegular ?
        `<span style="background:${c}18;color:${c};font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px">🔁 Recurring</span>` :
        `<span style="background:rgba(34,197,94,0.12);color:#22c55e;font-size:11px;font-weight:700;padding:4px 10px;border-radius:20px">🗓 Upcoming</span>`;
      return `
    <div class="card hoverable${past ? ' evt-past' : ''}">
      <div class="evt-card-body">
        <div style="display:flex;justify-content:space-between;margin-bottom:11px;align-items:center;flex-wrap:wrap;gap:6px">
          <span class="evt-type" style="background:${c}20;color:${c}">${ev.type}</span>
          ${badge}
        </div>
        <h3 class="evt-name"${past ? ' style="opacity:0.6"' : ''}>${ev.name}</h3>
        <p class="evt-desc">${ev.desc}</p>
        <div class="evt-meta">
          <span>⏰ ${ev.time}</span>
          <span>📅 ${ev.date}</span>
          <span>📍 ${ev.loc}</span>
        </div>
        ${ev.seasonal ? `<span style="font-size:11px;color:${c};background:${c}10;border:1px solid ${c}20;padding:5px 12px;border-radius:20px;margin-top:8px;display:inline-block">🔁 Recurring annually</span>` : ""}
      </div>
    </div>
  `;
    }

    function renderEvents() {
      const regular = EVENTS.filter(ev => isRegularEvent(ev));
      const seasonal = EVENTS.filter(ev => !isRegularEvent(ev) && ev.seasonal);
      const specific = EVENTS.filter(ev => !isRegularEvent(ev) && !ev.seasonal);
      const upcoming = [...specific, ...seasonal];

      document.getElementById('eventsUpcoming').innerHTML = upcoming.length ?
        upcoming.map(ev => buildEventCard(ev, false)).join('') :
        `<p style="color:var(--muted);padding:16px">No upcoming events — check back soon.</p>`;

      document.getElementById('eventsRegular').innerHTML = regular.length ?
        regular.map(ev => buildEventCard(ev, false)).join('') :
        '';
    }

    // ── GUIDES ────────────────────────────────────────────────────────────────────
    function renderGuides() {
      document.getElementById('guidesGrid').innerHTML = GUIDES.map(g => `
    <div class="card hoverable guide-card">
      <div class="guide-head">
        <div style="position:relative">
          <div style="width:52px;height:52px;border-radius:14px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0">
            ${g.type === 'Tour Operator' ? '🗺️' : '✈️'}
          </div>
          ${g.verified ? `<div style="position:absolute;bottom:-4px;right:-4px;width:18px;height:18px;background:#22c55e;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;border:2px solid var(--card)">✓</div>` : ''}
        </div>
        <div style="flex:1;min-width:0">
          <div class="guide-name" style="font-size:15px">${g.name}</div>
          <div style="display:flex;gap:6px;align-items:center;flex-wrap:wrap;margin-top:3px">
            <span style="background:rgba(0,194,255,0.1);color:var(--accent);font-size:10px;font-weight:700;padding:2px 8px;border-radius:10px">${g.type}</span>
            ${g.active ? `<span style="background:rgba(34,197,94,0.1);color:#22c55e;font-size:10px;font-weight:700;padding:2px 8px;border-radius:10px">● Active</span>` : ''}
          </div>
        </div>
      </div>
      <div class="guide-label" style="margin-top:12px">SERVICES</div>
      <div class="guide-spec" style="font-size:12px;line-height:1.6">${g.spec}</div>
      <div class="guide-label" style="margin-top:10px">LANGUAGES</div>
      <div class="lang-chips">${g.lang.map(l => `<span class="lang-chip">${l}</span>`).join('')}</div>
      <div style="display:flex;gap:8px;align-items:center;margin-top:10px;margin-bottom:12px">
        <span style="font-size:11px;color:var(--muted)">📍 ${g.area}</span>
      </div>
      <div style="font-size:11px;color:var(--muted);margin-bottom:12px">🕐 ${g.exp}</div>
      <div class="guide-btns">
        ${g.phone ? `<a href="tel:${g.phone}" class="btn-call">📞 Call</a>` : `<a href="https://www.google.com/search?q=${encodeURIComponent(g.name + ' Bhavnagar')}" target="_blank" class="btn-call" style="background:rgba(0,194,255,0.1);border-color:rgba(0,194,255,0.3);color:var(--accent)">🔍 Search</a>`}
        ${g.whatsapp ? `<a href="https://wa.me/${g.whatsapp}" target="_blank" class="btn-wa">WhatsApp</a>` : `<a href="https://www.google.com/maps/search/${encodeURIComponent(g.name + ' Bhavnagar Gujarat')}" target="_blank" class="btn-wa">📍 Maps</a>`}
      </div>
    </div>
  `).join('');
    }

    // ── PLANNER ───────────────────────────────────────────────────────────────────
    // ── PLANNER ──────────────────────────────────────────────────────────────────

    const BUDGET_OPTIONS = [{
        id: 'backpacker',
        label: '🎒 Backpacker',
        sub: 'Under ₹1,500/day',
        daily: 1000,
        foodTier: 0,
        hotelLabel: 'Jain / Swaminarayan Dharamshala',
        hotelRange: '₹100–300/night'
      },
      {
        id: 'budget',
        label: '💰 Budget',
        sub: '₹1,500–3,000/day',
        daily: 2000,
        foodTier: 0,
        hotelLabel: 'Hotel Relax Inn / Hotel Mini',
        hotelRange: '₹600–1,500/night'
      },
      {
        id: 'economy',
        label: '🏨 Economy',
        sub: '₹3,000–5,000/day',
        daily: 4000,
        foodTier: 1,
        hotelLabel: 'Hotel Sun N Shine / Hotel The Sankalp',
        hotelRange: '₹1,400–2,500/night'
      },
      {
        id: 'comfort',
        label: '✨ Comfort',
        sub: '₹5,000–10,000/day',
        daily: 7000,
        foodTier: 1,
        hotelLabel: 'Hotel Virgo Sumeru / Hotel Clarks Collection',
        hotelRange: '₹2,500–4,500/night'
      },
      {
        id: 'premium',
        label: '🌟 Premium',
        sub: '₹10,000–20,000/day',
        daily: 14000,
        foodTier: 2,
        hotelLabel: 'Efcee Sarovar Premiere / Iscon The Fern Resort',
        hotelRange: '₹4,500–7,000/night'
      },
      {
        id: 'luxury',
        label: '👑 Luxury',
        sub: '₹20,000+/day',
        daily: 25000,
        foodTier: 2,
        hotelLabel: 'Nilambag Palace Heritage Hotel',
        hotelRange: '₹4,000–6,500/night'
      },
    ];

    const TRAVEL_TYPES = [{
        id: 'Solo',
        emoji: '🧍',
        label: 'Solo'
      },
      {
        id: 'Couple',
        emoji: '💑',
        label: 'Couple'
      },
      {
        id: 'Family',
        emoji: '👨‍👩‍👧',
        label: 'Family'
      },
      {
        id: 'Friends',
        emoji: '🎉',
        label: 'Friends'
      },
    ];

    const INTEREST_OPTS = [{
        id: 'Spiritual',
        emoji: '🛕',
        cats: ['Spiritual', 'Spiritual & Nature', 'Spiritual Heritage']
      },
      {
        id: 'Heritage',
        emoji: '🏛️',
        cats: ['Heritage', 'Beach Heritage', 'Spiritual Heritage']
      },
      {
        id: 'Nature',
        emoji: '🌿',
        cats: ['Nature', 'Spiritual & Nature', 'Beach Nature']
      },
      {
        id: 'History',
        emoji: '📜',
        cats: ['History']
      },
      {
        id: 'Beach',
        emoji: '🏖️',
        cats: ['Beach', 'Beach Nature', 'Beach Heritage']
      },
      {
        id: 'Culture',
        emoji: '🎭',
        cats: ['Culture']
      },
      {
        id: 'Adventure',
        emoji: '⛵',
        cats: ['Adventure']
      },
      {
        id: 'Wildlife',
        emoji: '🦌',
        cats: ['Wildlife']
      },
      {
        id: 'Offbeat',
        emoji: '🗺️',
        cats: ['Industrial']
      },
    ];

    // Food tiers: 0=street/backpacker, 1=budget/economy, 2=comfort/premium/luxury
    // Multiple options per slot — rotated by day number
    const FOOD_PICKS = [{
        tier: 0, // Backpacker / Street
        bkfast: ['Jay Somnath Dal Puri (Khargate) — Dal Puri + Aloo Curry (Rs.40–60)', 'Bapa Sitaram Nasta Gruh (Kalanala) — Fafda + Khaman (Rs.50)', 'Shree Ram Farsan (Ghogha Circle) — Gathiya + Chai (Rs.40)'],
        lunch: ['Jalaram Paratha House (Kalanala) — Butter Paratha + Sev Tameta (Rs.80)', 'Lachhubhai Ganthiyawala (Ghogha Circle) — Pav Gathiya (Rs.40)', 'Shiv Shakti Kathiyawadi Dhaba (Ghogha Hwy) — Dal Rotla (Rs.80)'],
        dinner: ['Shree Ram Farsan (Ghogha Circle) — Bhajiya + Chai (Rs.60)', 'Balaji Ice Dish Gola (Ghogha Circle) — Ice Gola (Rs.30)', 'Aslam Frankie (City) — Frankie Roll (Rs.60)'],
      },
      {
        tier: 1, // Budget / Economy
        bkfast: ['Bapa Sitaram Nasta Gruh (Kalanala) — Dal Puri + Farsan (Rs.70)', 'Jalaram Paratha House (Kalanala) — Butter Paratha + Masala Chai (Rs.80)', 'Jay Somnath Dal Puri (Khargate) — Shrikhand Puri (Rs.60)'],
        lunch: ['Rasoi Dining Hall (Kalanala) — Unlimited Gujarati Thali (Rs.150)', 'Mahavir Restaurant (Hill Park) — Gujarati Thali (Rs.130)', 'Jalaram Paratha House (Kalanala) — Sev Tameta Paratha (Rs.100)'],
        dinner: ['RGB Restaurant (Waghawadi Road) — North Indian / Chinese (Rs.250)', 'Rasoi Dining Hall (Kalanala) — Dinner Thali (Rs.150)', 'Mehta Sweets (Kalanala) — Ghari + Sweets (Rs.80)'],
      },
      {
        tier: 2, // Comfort / Premium
        bkfast: ['Nilambag Palace Café — Heritage Breakfast Spread (Rs.350)', 'Coffee Culture (Hill Drive) — Rainbow Coffee + Breakfast (Rs.200)', 'The Chocolate Room (Waghawadi) — Waffles + Hot Chocolate (Rs.250)'],
        lunch: ['Nilambag Palace Dining — Royal Gujarati Thali (Rs.600)', 'Rasoi Dining Hall (Kalanala) — Premium Thali (Rs.200)', 'RGB Restaurant (Waghawadi) — Paneer Tikka Masala + Naan (Rs.350)'],
        dinner: ['Nilambag Palace Dining — Garden Dinner by reservation (Rs.700)', 'The Chocolate Room (Waghawadi) — Sizzling Brownie Dessert (Rs.300)', 'Coffee Culture (Hill Drive) — Veg Sizzler + Pasta (Rs.350)'],
      },
    ];

    function getFoodForDay(bOpt, dayNum) {
      const pool = FOOD_PICKS[bOpt.foodTier];
      const i = (dayNum - 1) % 3;
      return {
        bkfast: pool.bkfast[i],
        lunch: pool.lunch[i],
        dinner: pool.dinner[i],
      };
    }


    // ── HOTELS ────────────────────────────────────────────────────────────────────
    const TIER_LABEL = {
      ultra: '💸 Ultra Budget',
      budget: '🎒 Budget',
      comfort: '🏨 Comfort',
      midrange: '⭐ Mid-Range',
      premium: '✨ Premium',
      luxury: '👑 Luxury'
    };
    const TIER_COLOR = {
      ultra: '#22c55e',
      budget: '#84cc16',
      comfort: '#00c2ff',
      midrange: '#a855f7',
      premium: '#f59e0b',
      luxury: '#ef4444'
    };
    const TYPE_ICON = {
      Hotel: '🏨',
      Resort: '🏝️',
      Heritage: '🏛️',
      Dharamshala: '🛕',
      'Wildlife Lodge': '🦌'
    };

    function renderHotels() {
      if (!document.getElementById('hotelFilter')) return;
      const filterEl = document.getElementById('hotelFilter');
      // Inject search bar once
      if (!document.getElementById('hotelSearchInput')) {
        filterEl.insertAdjacentHTML('beforebegin', `
      <div class="search-wrap" style="margin-bottom:12px">
        <span class="search-icon">🔍</span>
        <input id="hotelSearchInput" class="search-input" type="text" placeholder="Search by name, area, amenity…" oninput="onHotelSearch(this.value)" autocomplete="off">
        <button class="search-clear" id="hotelSearchClear" onclick="onHotelSearch('')" title="Clear">×</button>
      </div>`);
      }
      const tiers = ['All', 'Ultra Budget', 'Budget', 'Comfort', 'Mid-Range', 'Premium', 'Luxury'];
      const tierMap = {
        'All': 'all',
        'Ultra Budget': 'ultra',
        'Budget': 'budget',
        'Comfort': 'comfort',
        'Mid-Range': 'midrange',
        'Premium': 'premium',
        'Luxury': 'luxury'
      };
      filterEl.innerHTML = tiers.map(t =>
        `<button class="chip${hotelFilter===t?' active':''}" onclick="setHotelFilter('${t}')">${t}</button>`
      ).join('');

      let list = hotelFilter === 'All' ? HOTELS : HOTELS.filter(h => tierMap[hotelFilter] === h.tier);
      const hq = hotelSearch.trim().toLowerCase();
      if (hq) list = list.filter(h =>
        h.name.toLowerCase().includes(hq) ||
        h.area.toLowerCase().includes(hq) ||
        h.type.toLowerCase().includes(hq) ||
        (h.amenities || []).some(a => a.toLowerCase().includes(hq)) ||
        TIER_LABEL[h.tier].toLowerCase().includes(hq)
      );

      if (list.length === 0) {
        document.getElementById('hotelGrid').innerHTML = `<div class="search-no-results"><span>🏨</span>No hotels found for "<strong>${hotelSearch}</strong>"</div>`;
        return;
      }
      document.getElementById('hotelGrid').innerHTML = list.map(h => {
        const color = TIER_COLOR[h.tier] || '#00c2ff';
        const icon = TYPE_ICON[h.type] || '🏨';
        return `
    <div class="card hoverable" style="overflow:hidden;cursor:pointer" onclick="openHotelModal(${h.id})">
      <div style="padding:20px 20px 0">
        <div style="display:flex;justify-content:flex-end;align-items:center;margin-bottom:10px">
          <span style="background:${color}20;color:${color};font-size:11px;font-weight:800;padding:4px 12px;border-radius:20px;letter-spacing:0.5px">${TIER_LABEL[h.tier]}</span>
        </div>
        <h3 style="color:var(--text);font-size:16px;font-weight:800;margin-bottom:4px">${h.name}</h3>
        <div style="color:var(--muted);font-size:12px;margin-bottom:8px">📍 ${h.area}</div>
        <div style="color:${color};font-size:14px;font-weight:800;margin-bottom:10px">${h.price}<span style="color:var(--muted);font-size:11px;font-weight:400"> / night</span></div>
        <p style="color:var(--muted);font-size:12px;line-height:1.6;margin-bottom:14px">${h.desc.substring(0,90)}…</p>
        <div style="display:flex;flex-wrap:wrap;gap:5px;margin-bottom:14px">
          ${(h.amenities||[]).slice(0,4).map(a=>`<span style="background:rgba(0,194,255,0.06);border:1px solid var(--card-border);color:var(--muted);font-size:10px;padding:3px 8px;border-radius:8px">${a}</span>`).join('')}
        </div>
      </div>
      <div style="border-top:1px solid var(--card-border);padding:12px 20px;display:flex;gap:8px">
        ${h.rating > 0 ? `<span style="color:#fbbf24;font-size:12px;font-weight:700">⭐ ${h.rating}</span>` : ''}
        <span style="color:var(--muted);font-size:12px">${h.type}</span>
      </div>
    </div>`;
      }).join('');
    }

    function setHotelFilter(f) {
      hotelFilter = f;
      renderHotels();
    }

    function openHotelModal(id) {
      const h = HOTELS.find(x => x.id === id);
      if (!h) return;
      const color = TIER_COLOR[h.tier] || '#00c2ff';
      const icon = TYPE_ICON[h.type] || '🏨';
      document.getElementById('placeModalBox').innerHTML = `
    <button class="modal-close" onclick="closePlaceModal()" style="position:absolute;top:14px;right:14px;z-index:10" aria-label="Close">×</button>
    <div style="padding:24px">
      <div style="display:flex;gap:10px;align-items:center;margin-bottom:16px;flex-wrap:wrap">
        <span style="font-size:36px">${icon}</span>
        <div>
          <div style="background:${color}20;color:${color};font-size:11px;font-weight:800;padding:4px 12px;border-radius:20px;display:inline-block;margin-bottom:6px">${TIER_LABEL[h.tier]}</div>
          <h2 style="color:var(--text);font-size:22px;font-weight:900;line-height:1.2">${h.name}</h2>
        </div>
      </div>
      <div style="display:flex;gap:16px;margin-bottom:16px;flex-wrap:wrap">
        <div style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:12px 16px;text-align:center;flex:1;min-width:100px">
          <div style="color:${color};font-size:18px;font-weight:900">${h.price}</div>
          <div style="color:var(--muted);font-size:10px;margin-top:2px">PER NIGHT</div>
        </div>
        ${h.rating > 0 ? `<div style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:12px 16px;text-align:center;flex:1;min-width:80px">
          <div style="color:#fbbf24;font-size:18px;font-weight:900">⭐ ${h.rating}</div>
          <div style="color:var(--muted);font-size:10px;margin-top:2px">RATING</div>
        </div>` : ''}
        <div style="background:var(--card);border:1px solid var(--card-border);border-radius:12px;padding:12px 16px;text-align:center;flex:1;min-width:80px">
          <div style="color:var(--text);font-size:14px;font-weight:700">${h.type}</div>
          <div style="color:var(--muted);font-size:10px;margin-top:2px">TYPE</div>
        </div>
      </div>
      <div style="background:rgba(0,194,255,0.04);border:1px solid var(--card-border);border-radius:12px;padding:14px 16px;margin-bottom:14px">
        <div style="color:var(--muted);font-size:11px;font-weight:700;letter-spacing:1px;margin-bottom:6px">📍 LOCATION</div>
        <div style="color:var(--text);font-size:13px">${h.area}</div>
      </div>
      <p style="color:var(--text);font-size:13px;line-height:1.75;margin-bottom:16px">${h.desc}</p>
      <div style="margin-bottom:16px">
        <div style="color:var(--muted);font-size:11px;font-weight:700;letter-spacing:1px;margin-bottom:8px">✅ AMENITIES</div>
        <div style="display:flex;flex-wrap:wrap;gap:6px">
          ${(h.amenities||[]).map(a=>`<span style="background:rgba(0,194,255,0.08);border:1px solid rgba(0,194,255,0.2);color:var(--accent);font-size:12px;padding:4px 10px;border-radius:8px">${a}</span>`).join('')}
        </div>
      </div>
      <div style="background:linear-gradient(135deg,rgba(255,107,53,0.06),rgba(0,194,255,0.04));border:1px solid var(--card-border);border-radius:12px;padding:12px 16px">
        <div style="color:var(--muted);font-size:11px;font-weight:700;margin-bottom:4px">💡 TIP</div>
        <div style="color:var(--text);font-size:12px">Prices are approximate. Book via Booking.com, MakeMyTrip or call the hotel directly for best rates.</div>
      </div>
    </div>
  `;
      document.getElementById('placeModal').classList.add('open');
    }

    function renderPlanner() {
      const bOpt = BUDGET_OPTIONS.find(b => b.id === planner.budget) || BUDGET_OPTIONS[2];
      document.getElementById('plannerContent').innerHTML = `
    <div class="planner-form">

      <div class="planner-section">
        <div class="planner-label">📅 Number of Days</div>
        <div class="day-chips">
          ${[1, 2, 3, 4, 5, 6, 7, 8, 9, 10].map(d => `
            <button class="day-chip${planner.days === d ? ' active' : ''}" onclick="setPlannerVal('days',${d})">${d}</button>
          `).join('')}
        </div>
      </div>

      <div class="planner-grid">
        <div>
          <div class="planner-label">💸 Budget</div>
          <div class="custom-select" id="budgetDropdown">
            <div class="custom-select-trigger${planner.budget ? ' ' : ' open'}" id="budgetTrigger" onclick="toggleBudgetDropdown()">
              <span>${(BUDGET_OPTIONS.find(b => b.id === planner.budget) || BUDGET_OPTIONS[2]).sub}</span>
              <span class="custom-select-arrow">▼</span>
            </div>
            <div class="custom-select-opts" id="budgetOpts">
              ${BUDGET_OPTIONS.map(b => `
                <div class="custom-select-opt${planner.budget === b.id ? ' selected' : ''}" onclick="selectBudget('${b.id}')">
                  ${b.sub}
                </div>
              `).join('')}
            </div>
          </div>
        </div>
        <div>
          <div class="planner-label">🧳 Travel Type</div>
          <div class="travel-chips">
            ${TRAVEL_TYPES.map(t => `
              <button class="trav-chip${planner.travelType === t.id ? ' active' : ''}" onclick="setPlannerVal('travelType','${t.id}')">${t.emoji} ${t.label}</button>
            `).join('')}
          </div>
        </div>
      </div>

      <div class="planner-section">
        <div class="planner-label">🎯 Interests <span style="font-weight:400;text-transform:none;letter-spacing:0;font-size:11px;color:var(--muted)">(pick one or more — or leave blank for everything)</span></div>
        <div class="planner-ints">
          ${INTEREST_OPTS.map(i => `
            <button class="int-chip${planner.interests.includes(i.id) ? ' active' : ''}" onclick="togglePlannerInterest('${i.id}')">${i.emoji} ${i.id}</button>
          `).join('')}
        </div>
      </div>

      <button class="btn-generate" id="genBtn" onclick="generateItinerary()">✨ Generate My Itinerary</button>
    </div>
    <div id="itinerary"></div>
  `;
    }

    function toggleBudgetDropdown() {
      const trigger = document.getElementById('budgetTrigger');
      const opts = document.getElementById('budgetOpts');
      if (!trigger || !opts) return;
      const isOpen = opts.classList.contains('open');
      // Close all first
      document.querySelectorAll('.custom-select-opts').forEach(el => el.classList.remove('open'));
      document.querySelectorAll('.custom-select-trigger').forEach(el => el.classList.remove('open'));
      if (!isOpen) {
        opts.classList.add('open');
        trigger.classList.add('open');
      }
    }

    function selectBudget(id) {
      setPlannerVal('budget', id);
      // renderPlanner re-renders so dropdown resets automatically
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.custom-select')) {
        document.querySelectorAll('.custom-select-opts').forEach(el => el.classList.remove('open'));
        document.querySelectorAll('.custom-select-trigger').forEach(el => el.classList.remove('open'));
      }
    });

    function setPlannerVal(key, val) {
      planner[key] = val;
      renderPlanner();
    }

    function togglePlannerInterest(id) {
      if (planner.interests.includes(id)) planner.interests = planner.interests.filter(x => x !== id);
      else planner.interests.push(id);
      renderPlanner();
    }

    // Legacy compat
    function setPlannerDay(d) {
      setPlannerVal('days', d);
    }

    function setPlannerTravel(t) {
      setPlannerVal('travelType', t);
    }

    function toggleInterest(i) {
      togglePlannerInterest(i);
    }

    // ── ITINERARY GENERATOR ────────────────────────────────────────────────────────

    function generateItinerary() {
      const btn = document.getElementById('genBtn');
      btn.disabled = true;
      btn.innerHTML = '<span style="opacity:0.8">🤖 Building your itinerary...</span>';

      setTimeout(() => {
        try {
          const plan = buildItinerary();
          renderItinerary(plan);
        } catch (e) {
          document.getElementById('itinerary').innerHTML = `<p style="color:var(--accent2);padding:20px">Could not build itinerary. Please try different selections.</p>`;
        }
        btn.disabled = false;
        btn.innerHTML = '✨ Generate My Itinerary';
      }, 900);
    }

    function buildItinerary() {
      const bOpt = BUDGET_OPTIONS.find(b => b.id === planner.budget) || BUDGET_OPTIONS[2];
      const tt = planner.travelType;
      const days = planner.days;

      // ── Filter places by interests ────────────────────────────────────────────
      let selectedCats = [];
      if (planner.interests.length > 0) {
        planner.interests.forEach(id => {
          const opt = INTEREST_OPTS.find(o => o.id === id);
          if (opt) selectedCats.push(...opt.cats);
        });
      }

      let pool = [...PLACES];

      // Interest filter
      if (selectedCats.length > 0) {
        const filtered = pool.filter(p => selectedCats.some(c => p.cat.includes(c)));
        pool = filtered.length > 0 ? filtered : pool; // fallback to full pool if no matches
      }

      // Travel type adjustments
      if (tt === 'Family') {
        pool = pool.filter(p => !['Industrial', 'Adventure'].includes(p.cat));
      }
      if (tt === 'Couple') {
        pool.sort((a, b) => {
          const pref = ['Heritage', 'Nature', 'Beach', 'Spiritual'];
          return (pref.includes(b.cat) ? 1 : 0) - (pref.includes(a.cat) ? 1 : 0);
        });
      }
      if (tt === 'Solo') {
        // Solo gets Adventure + Industrial too, already in pool
      }

      // ── Sort pool by rating (highest first) — primary criteria ──────────────────
      // Small random tiebreaker (0.0–0.2) only between places with identical ratings
      // so Regenerate still gives slightly different combos within same tier
      pool.sort((a, b) => {
        const ratingDiff = b.rating - a.rating;
        if (Math.abs(ratingDiff) >= 0.2) return ratingDiff; // clear rating difference — respect it
        return Math.random() - 0.5; // within 0.2 of each other — allow tiebreak shuffle
      });

      // Nearby pool — filter by interest cats, then sort by rating desc
      let nearbyPool = [...NEARBY];
      if (selectedCats.length > 0) {
        const matched = nearbyPool.filter(n => selectedCats.some(c => n.cat.includes(c)));
        const rest = nearbyPool.filter(n => !selectedCats.some(c => n.cat.includes(c)));
        // matched interests come first, sorted by distance; rest follow
        matched.sort((a, b) => parseInt(a.distance) - parseInt(b.distance));
        rest.sort((a, b) => parseInt(a.distance) - parseInt(b.distance));
        nearbyPool = [...matched, ...rest];
      } else {
        // No filter — sort closer destinations first
        nearbyPool.sort((a, b) => parseInt(a.distance) - parseInt(b.distance));
      }

      // ── Build days ─────────────────────────────────────────────────────────────
      const placesPerDay = (tt === 'Family' || tt === 'Couple') ? 2 : tt === 'Friends' ? 3 : 3;
      const usedPlaces = new Set();
      const usedNearby = new Set();
      const dayPlans = [];

      // How many city days vs nearby days
      const cityDays = Math.min(days, Math.ceil(pool.length / placesPerDay));
      const nearbyDays = days - cityDays;

      for (let d = 1; d <= days; d++) {
        let dayType = d <= cityDays ? 'city' : 'nearby';
        const dayPlaces = [];

        if (dayType === 'city') {
          // Pick next placesPerDay places
          for (const p of pool) {
            if (dayPlaces.length >= placesPerDay) break;
            if (!usedPlaces.has(p.id)) {
              usedPlaces.add(p.id);
              dayPlaces.push({
                type: 'place',
                data: p
              });
            }
          }
          // If not enough places, try pulling a nearby day trip
          if (dayPlaces.length === 0 && nearbyPool.length > 0) {
            dayType = 'nearby';
          }
        }

        if (dayType === 'nearby') {
          const n = nearbyPool.find(n => !usedNearby.has(n.id));
          if (n) {
            usedNearby.add(n.id);
            dayPlaces.push({
              type: 'nearby',
              data: n
            });
          }
        }

        // Build theme name
        let theme = getTheme(dayPlaces, tt, d, planner.interests, bOpt);

        // Build activity schedule
        const schedule = buildSchedule(dayPlaces, getFoodForDay(bOpt, d), bOpt, tt);

        // Estimated daily cost
        const entryCost = dayPlaces.reduce((sum, item) => {
          if (item.type === 'nearby') return sum + 200;
          const e = item.data.entry || 'Free';
          const num = parseInt(e.replace(/[^\d]/g, '')) || 0;
          return sum + num;
        }, 0);
        const foodCost = bOpt.daily * 0.35;
        const transportCost = dayType === 'nearby' ? 600 : 200;
        const totalDay = Math.round(entryCost + foodCost + transportCost);

        dayPlans.push({
          day: d,
          type: dayType,
          theme,
          schedule,
          places: dayPlaces,
          cost: totalDay,
          hotel: bOpt.hotelLabel,
          hotelRange: bOpt.hotelRange
        });
      }

      const hotelNightCost = parseInt((bOpt.hotelRange.match(/\d+/) || ['0'])[0]);
      const totalCost = dayPlans.reduce((s, d) => s + d.cost, 0) + (days * hotelNightCost);
      return {
        days,
        travelType: tt,
        budget: bOpt,
        dayPlans,
        totalCost,
        placesCount: usedPlaces.size + usedNearby.size
      };
    }

    function getTheme(dayPlaces, tt, day, interests = [], bOpt = null) {
      if (dayPlaces.length === 0) return '🛌 Rest & Explore';

      const isLuxury = bOpt && ['premium', 'luxury'].includes(bOpt.id);
      const isBudget = bOpt && ['backpacker', 'budget'].includes(bOpt.id);

      // Nearby day trip
      if (dayPlaces[0].type === 'nearby') {
        const n = dayPlaces[0].data;
        const icons = {
          Spiritual: '🛕',
          Wildlife: '🦌',
          Beach: '🏖️',
          History: '📜',
          Heritage: '🏛️',
          Culture: '🎭',
          Adventure: '⛵'
        };
        const icon = icons[n.cat] || '🗺️';
        if (isLuxury) return `${icon} Exclusive Day Trip — ${n.name}`;
        if (isBudget) return `${icon} Budget Escape — ${n.name}`;
        return `${icon} Day Trip — ${n.name}`;
      }

      const cats = dayPlaces.map(p => p.data.cat);
      const catCount = {};
      cats.forEach(c => {
        catCount[c] = (catCount[c] || 0) + 1;
      });
      const dominant = Object.entries(catCount).sort((a, b) => b[1] - a[1])[0]?.[0] || '';

      // Day 1 — shaped by travel type + budget
      if (day === 1) {
        if (isLuxury) {
          const d1Lux = {
            Solo: '✨ Luxury Arrival & First Impressions',
            Couple: '👑 Royal Arrival & Romantic Evening',
            Family: '🏨 Grand Arrival — Family Check-in & Explore',
            Friends: '🥂 Arrive in Style'
          };
          return d1Lux[tt] || '✨ Grand Arrival';
        }
        if (isBudget) {
          const d1Bud = {
            Solo: '🎒 Backpacker Arrival & City Wander',
            Couple: '🌅 Arrive & Discover Together',
            Family: '👨‍👩‍👧 Family Arrival & Settle In',
            Friends: '🎉 Arrive & Hit the Streets'
          };
          return d1Bud[tt] || '🌅 Arrival & First Wander';
        }
        const d1 = {
          Solo: '🌅 Solo Arrival & First Wander',
          Couple: '💑 Arrive & Fall in Love with the City',
          Family: '👨‍👩‍👧 Family Arrival & City Introduction',
          Friends: '🎉 Arrive & Explore Together'
        };
        return d1[tt] || '🌅 Arrival & First Impressions';
      }

      // If interests selected — theme should reflect them
      if (interests.length > 0) {
        // Map interest → themed day name (with budget + travel type flavour)
        const interestThemes = {
          Spiritual: {
            backpacker: '🛕 Pilgrimage on a Budget',
            budget: '🛕 Spiritual Circuit',
            economy: '🛕 Spiritual Journey',
            comfort: '🛕 Serene Temple Trail',
            premium: '🛕 Sacred & Serene',
            luxury: '🛕 Exclusive Spiritual Retreat',
          },
          Heritage: {
            backpacker: '🏛️ Heritage Walk',
            budget: '🏛️ History on a Budget',
            economy: '🏛️ Royal Heritage Trail',
            comfort: '🏛️ Palace & Heritage Circuit',
            premium: '🏛️ Regal Bhavnagar',
            luxury: '👑 Royal Legacy Experience',
          },
          Nature: {
            backpacker: '🌿 Nature Walk',
            budget: '🌿 Nature & Fresh Air',
            economy: '🌿 Nature & Outdoors',
            comfort: '🌿 Scenic Nature Day',
            premium: '🌿 Luxury Nature Escape',
            luxury: '✨ Private Nature Retreat',
          },
          History: {
            backpacker: '📜 History Buff on a Budget',
            budget: '📜 History Trail',
            economy: '📜 History & Culture Day',
            comfort: '📜 Deep History Trail',
            premium: '📜 Curated History Experience',
            luxury: '🏛️ Private History Tour',
          },
          Beach: {
            backpacker: '🏖️ Beach Day (Free!)',
            budget: '🏖️ Coastal Escape',
            economy: '🏖️ Beach & Coastline',
            comfort: '🏖️ Scenic Coastal Day',
            premium: '🌅 Sunset Coastal Drive',
            luxury: '🚢 Private Coastal Experience',
          },
          Adventure: {
            backpacker: '⛵ Adventure on a Budget',
            budget: '⛵ Thrill Seekers Day',
            economy: '⛵ Adventure Day',
            comfort: '⛵ Guided Adventure',
            premium: '⛵ Premium Adventure',
            luxury: '🎯 Exclusive Adventure Experience',
          },
          Wildlife: {
            backpacker: '🦌 Wildlife Walk',
            budget: '🦌 Wildlife Day',
            economy: '🦌 Wildlife Safari',
            comfort: '🦌 Nature & Wildlife',
            premium: '🦌 Premium Safari',
            luxury: '🦌 Private Wildlife Safari',
          },
          Culture: {
            backpacker: '🎭 Street Culture Day',
            budget: '🎭 Local Culture Dive',
            economy: '🎭 Culture & Local Life',
            comfort: '🎭 Art & Culture Trail',
            premium: '🎭 Cultural Immersion',
            luxury: '✨ Curated Cultural Experience',
          },
          Offbeat: {
            backpacker: '🔩 Offbeat Wander',
            budget: '🔩 Off-the-Beaten-Path',
            economy: '🔩 Offbeat Industrial',
            comfort: '🔩 Hidden Bhavnagar',
            premium: '🔩 Exclusive Offbeat Tour',
            luxury: '🔩 Private Offbeat Discovery',
          },
        };
        // Use the first/dominant selected interest that matches today's places
        const matchedInterest = interests.find(i => {
          const opt = INTEREST_OPTS.find(o => o.id === i);
          return opt && opt.cats.some(c => cats.includes(c));
        }) || interests[0];

        const tier = bOpt?.id || 'economy';
        const themed = interestThemes[matchedInterest];
        if (themed && themed[tier]) return themed[tier];
        if (themed) return themed['economy'];
      }

      // No interests — use dominant category with budget flavour
      const catThemes = {
        Spiritual: isLuxury ? '🛕 Sacred & Serene' : isBudget ? '🛕 Pilgrimage Trail' : '🛕 Spiritual Journey',
        'Spiritual & Nature': isLuxury ? '🛕 Retreat in Nature' : '🛕 Spiritual & Nature Trail',
        Heritage: isLuxury ? '👑 Regal Heritage Experience' : isBudget ? '🏛️ Heritage Walk' : '🏛️ Royal Heritage Trail',
        History: isLuxury ? '📜 Private History Tour' : '📜 History & Culture',
        Nature: isLuxury ? '🌿 Luxury Nature Day' : isBudget ? '🌿 Nature Walk (Free!)' : '🌿 Nature & Outdoors',
        Beach: isLuxury ? '🌅 Exclusive Coastal Drive' : '🏖️ Beach & Coastline',
        Culture: '🎭 Culture & Local Life',
        Adventure: isBudget ? '⛵ Adventure on a Budget' : '⛵ Adventure Day',
        Industrial: '🔩 Offbeat Industrial',
      };

      if (catThemes[dominant]) return catThemes[dominant];

      // Mixed — travel type + budget
      const mixedLux = {
        Solo: '✨ Curated Luxury Day',
        Couple: '🌹 Exclusive Romantic Day',
        Family: '👑 Premium Family Experience',
        Friends: '🥂 Luxury Group Day'
      };
      const mixedBud = {
        Solo: '🎒 Backpacker Day',
        Couple: '🌅 Budget Romantic Day',
        Family: '👨‍👩‍👧 Affordable Family Day',
        Friends: '🎉 Budget Hangout Day'
      };
      const mixedMid = {
        Solo: ['🔍 Off-the-Beaten-Path', '🗺️ Deep Exploration', '📸 Solo Discovery', '🌟 Hidden Bhavnagar'],
        Couple: ['💑 Romantic Afternoon', '🌇 Golden Hour Trail', '🌹 Peaceful Escapes', '✨ Just the Two of You'],
        Family: ['👨‍👩‍👧 Family Fun Day', '🎡 Kid-Friendly Sights', '🌈 Family Adventure', '🏰 Castle & Gardens'],
        Friends: ['🎊 Good Times Trail', '🎭 Culture Crawl', '📸 Insta-worthy Stops', '🎉 Squad Sightseeing'],
      };

      if (isLuxury) return mixedLux[tt] || '✨ Luxury Day';
      if (isBudget) return mixedBud[tt] || '🎒 Budget Explorer Day';
      const opts = mixedMid[tt] || ['🗺️ Mixed Exploration'];
      return opts[(day - 1) % opts.length];
    }

    const TIMES_2 = [{
        time: '7:30 AM',
        label: 'MORNING'
      },
      {
        time: '10:30 AM',
        label: 'MID MORNING'
      },
      {
        time: '1:00 PM',
        label: 'LUNCH'
      },
      {
        time: '3:30 PM',
        label: 'AFTERNOON'
      },
      {
        time: '7:30 PM',
        label: 'DINNER'
      },
    ];
    const TIMES_3 = [{
        time: '7:00 AM',
        label: 'MORNING'
      },
      {
        time: '10:00 AM',
        label: 'MID MORNING'
      },
      {
        time: '1:00 PM',
        label: 'LUNCH'
      },
      {
        time: '2:30 PM',
        label: 'AFTERNOON'
      },
      {
        time: '5:00 PM',
        label: 'EVENING'
      },
      {
        time: '7:30 PM',
        label: 'DINNER'
      },
    ];

    function buildSchedule(dayPlaces, food, bOpt, tt) {
      const slots = [];
      const times = dayPlaces.length <= 2 ? TIMES_2 : TIMES_3;
      let tIdx = 0;

      // If nearby day trip
      if (dayPlaces.length > 0 && dayPlaces[0].type === 'nearby') {
        const n = dayPlaces[0].data;
        slots.push({
          time: '6:00 AM',
          label: 'DEPART',
          name: 'Leave early for ' + n.name,
          sub: `${n.distance} from Bhavnagar`,
          cls: 'slot-nearby',
          entry: ''
        });
        slots.push({
          time: 'On arrival',
          label: 'EXPLORE',
          name: n.name,
          sub: n.desc.substring(0, 80) + '…',
          cls: 'slot-nearby',
          entry: n.entry
        });
        slots.push({
          time: '1:00 PM',
          label: 'LUNCH',
          name: 'Local lunch at ' + n.name,
          sub: food.lunch,
          cls: 'slot-food',
          entry: ''
        });
        slots.push({
          time: 'Afternoon',
          label: 'EXPLORE',
          name: 'More of ' + n.name,
          sub: (n.highlights || []).join(' · '),
          cls: 'slot-nearby',
          entry: ''
        });
        slots.push({
          time: 'Evening',
          label: 'RETURN',
          name: 'Drive back to Bhavnagar',
          sub: `${n.distance} from Bhavnagar`,
          cls: '',
          entry: ''
        });
        slots.push({
          time: '8:00 PM',
          label: 'DINNER',
          name: 'Dinner in Bhavnagar',
          sub: food.dinner,
          cls: 'slot-food',
          entry: ''
        });
        return slots;
      }

      // Morning slot — breakfast first
      slots.push({
        time: times[tIdx].time,
        label: times[tIdx].label,
        name: 'Breakfast',
        sub: food.bkfast,
        cls: 'slot-food',
        entry: ''
      });
      tIdx++;

      // Place slots
      for (let i = 0; i < dayPlaces.length && tIdx < times.length - 1; i++) {
        const p = dayPlaces[i].data;
        // Insert lunch before afternoon slot
        if (tIdx === 2 || (i > 0 && tIdx === 3)) {
          slots.push({
            time: times[2].time,
            label: times[2].label,
            name: 'Lunch Break',
            sub: food.lunch,
            cls: 'slot-food',
            entry: ''
          });
          tIdx = 3;
        }
        if (tIdx >= times.length - 1) break;
        const t = times[tIdx];
        slots.push({
          time: t.time,
          label: t.label,
          name: p.name,
          sub: p.desc.substring(0, 75) + '…',
          cls: '',
          entry: p.entry || 'Free',
          open: p.open,
          tip: p.tips
        });
        tIdx++;
      }

      // Dinner
      slots.push({
        time: times[times.length - 1].time,
        label: times[times.length - 1].label,
        name: 'Dinner',
        sub: food.dinner,
        cls: 'slot-food',
        entry: ''
      });

      return slots;
    }

    function renderItinerary(plan) {
      const totalCostFmt = plan.totalCost > 0 ? '₹' + plan.totalCost.toLocaleString('en-IN') + '*' : '—';

      document.getElementById('itinerary').innerHTML = `
    <div class="itinerary-container">
      <div class="itin-header">
        <div>
          <div class="itin-title">${plan.days}-Day Bhavnagar Itinerary</div>
          <div class="itin-subtitle">${plan.travelType} • ${plan.budget.label} • ${plan.placesCount} places</div>
        </div>
        <div class="itin-totals">
          <div class="itin-stat">
            <div class="itin-stat-val">${plan.days}</div>
            <div class="itin-stat-lbl">DAYS</div>
          </div>
          <div class="itin-stat">
            <div class="itin-stat-val">${plan.placesCount}</div>
            <div class="itin-stat-lbl">PLACES</div>
          </div>
          <div class="itin-stat">
            <div class="itin-stat-val">${totalCostFmt}</div>
            <div class="itin-stat-lbl">EST. TOTAL</div>
          </div>
        </div>
      </div>

      ${plan.dayPlans.map((day, i) => `
        <div class="day-card-wrap">
          <div class="day-left">
            <div class="day-circle">${day.day}</div>
            ${i < plan.dayPlans.length - 1 ? '<div class="day-connector"></div>' : ''}
          </div>
          <div class="day-card">
            <div class="day-card-head">
              <div>
                <div class="day-label">DAY ${day.day} OF ${plan.days}</div>
                <div class="day-theme">${day.theme}</div>
              </div>
              <div class="day-budget-pill">~₹${day.cost.toLocaleString('en-IN')}</div>
            </div>
            <div class="day-body">
              ${day.schedule.map(slot => `
                <div class="slot">
                  <div class="slot-time-col">
                    <div class="slot-time">${slot.time}</div>
                    <div class="slot-label">${slot.label}</div>
                  </div>
                  <div class="slot-content ${slot.cls || ''}">
                    <div class="slot-place-name">${slot.name}</div>
                    <div class="slot-meta">
                      ${slot.sub ? `<span class="slot-tag">${slot.sub}</span>` : ''}
                      ${slot.entry ? `<span class="slot-tag ${slot.entry === 'Free' || slot.entry === '' ? 'free' : 'paid'}">${slot.entry === 'Free' ? '✅ Free' : slot.entry !== '' ? '🎟️ ' + slot.entry : ''}</span>` : ''}
                      ${slot.open ? `<span class="slot-tag">⏰ ${slot.open}</span>` : ''}
                    </div>
                    ${slot.tip ? `<div style="margin-top:5px;font-size:11px;color:var(--accent);opacity:0.8">💡 ${slot.tip}</div>` : ''}
                  </div>
                </div>
              `).join('')}
              <div class="day-hotel">
                <div class="hotel-info">🏨 ${day.hotel}</div>
                <div class="hotel-price">${day.hotelRange}</div>
              </div>
            </div>
          </div>
        </div>
      `).join('')}

      <p style="color:var(--muted);font-size:11px;text-align:center;margin-top:8px">* Estimated costs are approximate and exclude travel to Bhavnagar. Prices vary by season.</p>
      <div class="itin-regen">
        <button class="btn-regen" onclick="generateItinerary()">🔁 Regenerate</button>
        <button class="btn-share-itin" onclick="toggleSharePanel()">🔗 Share Itinerary</button>
      </div>
      <div class="share-itin-panel" id="shareItinPanel">
        <div class="share-itin-title">📤 Share your itinerary</div>
        <div class="share-itin-btns">
          <button class="share-itin-btn" onclick="downloadItinPdf()">📄 Save as PDF</button>
          <button class="share-itin-btn" id="copyItinBtn" onclick="copyItinText()">📋 Copy Summary</button>
          <button class="share-itin-btn" onclick="nativeShareItin()" id="nativeShareBtn" style="display:none">📱 Share</button>
        </div>
      </div>
    </div>
  `;

      // Scroll to itinerary
      document.getElementById('itinerary').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });

      // Show native share button if supported
      if (navigator.share) {
        const nb = document.getElementById('nativeShareBtn');
        if (nb) nb.style.display = 'block';
      }
    }

    // ── SHARE ITINERARY FUNCTIONS ─────────────────────────────────────────────────
    function toggleSharePanel() {
      const panel = document.getElementById('shareItinPanel');
      if (panel) panel.classList.toggle('open');
    }

    function downloadItinPdf() {
      // Focus the Planner page content and trigger print dialog
      // Print CSS above will hide everything except the itinerary
      document.title = 'GoTrip Bhavnagar — My Itinerary';
      window.print();
      setTimeout(() => {
        document.title = 'GoTrip Bhavnagar – AI Smart Tourism';
      }, 2000);
    }

    function copyItinText() {
      const container = document.querySelector('.itinerary-container');
      if (!container) return;
      // Build a clean text summary from the itinerary DOM
      const title = container.querySelector('.itin-title')?.textContent || 'Bhavnagar Itinerary';
      const subtitle = container.querySelector('.itin-subtitle')?.textContent || '';
      const days = [...container.querySelectorAll('.day-card')].map(card => {
        const theme = card.querySelector('.day-theme')?.textContent || '';
        const budget = card.querySelector('.day-budget-pill')?.textContent || '';
        const slots = [...card.querySelectorAll('.slot-place-name')].map(s => '  • ' + s.textContent).join('\n');
        return `${theme} (${budget})\n${slots}`;
      });
      const text = `🗺️ ${title}\n${subtitle}\n\n${days.join('\n\n')}\n\n📍 Plan yours at GoTrip Bhavnagar`;
      navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copyItinBtn');
        if (btn) {
          btn.textContent = '✅ Copied!';
          btn.classList.add('copied');
          setTimeout(() => {
            btn.textContent = '📋 Copy Summary';
            btn.classList.remove('copied');
          }, 2500);
        }
      }).catch(() => {
        alert('Could not copy — please copy the itinerary manually.');
      });
    }

    function nativeShareItin() {
      const container = document.querySelector('.itinerary-container');
      if (!container) return;
      const title = container.querySelector('.itin-title')?.textContent || 'My Bhavnagar Itinerary';
      const text = `Check out my ${title} — planned with GoTrip Bhavnagar! 🗺️`;
      navigator.share({
        title: 'GoTrip Bhavnagar',
        text
      }).catch(() => {});
    }

    // ── QUIZ ──────────────────────────────────────────────────────────────────────
    function shuffleArray(arr) {
      return [...arr].sort(() => Math.random() - 0.5);
    }

    function toggleQuiz() {
      quizOpen = !quizOpen;
      document.getElementById('quiz-panel').classList.toggle('open', quizOpen);
      document.getElementById('quiz-overlay').classList.toggle('open', quizOpen);
      document.getElementById('quiz-btn').textContent = quizOpen ? '✕' : '🤖';
      document.getElementById('quiz-btn').style.animation = quizOpen ? 'none' : '';
      document.body.style.overflow = quizOpen ? 'hidden' : '';
      if (quizOpen && quizStep === 'idle') renderQuiz();
    }

    function renderQuiz() {
      const body = document.getElementById('quizBody');

      if (quizStep === 'idle') {
        body.innerHTML = `
      <div style="text-align:center;margin-bottom:14px;font-size:28px">🧠</div>
      <p style="color:#fff;font-size:15px;font-weight:800;text-align:center;margin-bottom:6px">Think you know Bhavnagar?</p>
      <p style="color:rgba(255,255,255,0.5);font-size:12px;text-align:center;margin-bottom:18px">5 questions. Picked randomly. Different every round!</p>
      <button class="quiz-start-btn" onclick="startQuiz()">▶ Start the Challenge</button>
    `;

      } else if (quizStep === 'quiz') {
        const q = QUIZ[quizIdx];
        const pct = Math.round((quizIdx / QUIZ.length) * 100);
        body.innerHTML = `
      <div class="quiz-q-progress">
        <span class="quiz-q-num">Q ${quizIdx + 1} / ${QUIZ.length}</span>
        <span class="quiz-score">✅ ${quizScore}</span>
      </div>
      <div style="height:3px;background:rgba(255,255,255,0.08);border-radius:2px;margin-bottom:12px;overflow:hidden">
        <div style="height:100%;width:${pct}%;background:linear-gradient(90deg,#00c2ff,#ff6b35);border-radius:2px;transition:width 0.4s"></div>
      </div>
      <div class="quiz-q-box">${q.q}</div>
      <div class="quiz-opts">
        ${q.opts.map((opt, i) => {
          let cls = '';
          if (quizAnswered && i === q.ans) cls = 'correct';
          if (quizAnswered && i === quizPicked && i !== q.ans) cls = 'wrong';
          const prefix = quizAnswered && i === q.ans ? '✓ ' : quizAnswered && i === quizPicked ? '✗ ' : `${String.fromCharCode(65 + i)}. `;
          return `<button class="quiz-opt ${cls}" onclick="pickAnswer(${i})" ${quizAnswered ? 'disabled' : ''}>${prefix}${opt}</button>`;
        }).join('')}
      </div>
    `;

      } else if (quizStep === 'story') {
        const s = currentStory;
        const pct = Math.round((quizScore / QUIZ.length) * 100);
        const emoji = quizScore === QUIZ.length ? '🏆' : quizScore >= Math.floor(QUIZ.length * 0.7) ? '🌟' : quizScore >= Math.floor(QUIZ.length * 0.4) ? '👍' : '📚';
        const msg = quizScore === QUIZ.length ? 'Perfect! You\'re a Bhavnagar legend!' : quizScore >= Math.floor(QUIZ.length * 0.7) ? 'Great job! You really know this city.' : quizScore >= Math.floor(QUIZ.length * 0.4) ? 'Not bad! Keep exploring.' : 'Bhavnagar has much more to teach you!';

        body.innerHTML = `
      <div style="animation:fadeUp 0.4s ease">
        <div style="text-align:center;margin-bottom:12px">
          <div style="font-size:30px;margin-bottom:3px">${emoji}</div>
          <div style="color:#fff;font-size:16px;font-weight:900">${quizScore} / ${QUIZ.length} Correct</div>
          <div style="color:rgba(255,255,255,0.42);font-size:11px;margin-top:2px">${msg}</div>
          <div style="height:4px;background:rgba(255,255,255,0.08);border-radius:2px;margin:8px 0;overflow:hidden">
            <div style="height:100%;width:${pct}%;background:linear-gradient(90deg,#00c2ff,#ff6b35);border-radius:2px"></div>
          </div>
        </div>
        <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:14px;overflow:hidden;margin-bottom:12px">
          <div style="position:relative;height:100px">
            <img src="${s.img}" alt="${s.place}" style="width:100%;height:100%;object-fit:cover" onerror="this.src='https://picsum.photos/seed/story/400/200'">
            <div style="position:absolute;inset:0;background:linear-gradient(transparent 10%,rgba(5,11,20,0.95))"></div>
            <div style="position:absolute;bottom:9px;left:11px">
              <div style="color:rgba(255,255,255,0.45);font-size:9px;letter-spacing:1px">✨ PLACE STORY</div>
              <div style="color:#fff;font-weight:900;font-size:13px">${s.emoji} ${s.title}</div>
            </div>
          </div>
          <div style="padding:12px">
            <p style="color:rgba(255,255,255,0.65);font-size:12px;line-height:1.7;margin:0">${s.story}</p>
          </div>
        </div>
        <button class="quiz-replay" onclick="startQuiz()" style="width:100%">🔁 Play Again</button>
      </div>
    `;
      }
    }

    function startQuiz() {
      QUIZ = shuffleArray(QUIZ_BANK).slice(0, 5);
      quizStep = 'quiz';
      quizIdx = 0;
      quizScore = 0;
      quizPicked = null;
      quizAnswered = false;
      currentStory = QUIZ_STORIES[Math.floor(Math.random() * QUIZ_STORIES.length)];
      renderQuiz();
    }

    function pickAnswer(idx) {
      if (quizAnswered) return;
      quizPicked = idx;
      quizAnswered = true;
      if (idx === QUIZ[quizIdx].ans) quizScore++;
      renderQuiz();
      setTimeout(() => {
        if (quizIdx + 1 < QUIZ.length) {
          quizIdx++;
          quizPicked = null;
          quizAnswered = false;
        } else {
          quizStep = 'story';
        }
        renderQuiz();
      }, 1100);
    }

    // ── INIT ──────────────────────────────────────────────────────────────────────
    // Restore saved theme from cookie BEFORE rendering to avoid flash
    (function() {
      try {
        var m = document.cookie.match(/(?:^|;\s*)gotrip_theme=([^;]+)/);
        if (m && m[1]) {
          var saved = decodeURIComponent(m[1]);
          if (THEMES[saved]) {
            document.body.className = THEMES[saved].cls;
            currentTheme = saved;
          }
        }
      } catch (e) {}
    })();

    initParticles();
    initNav();
    renderHome();
    // Seed initial history entry so back button works from page 1
    try {
      history.replaceState({
        page: 'Home'
      }, '', '#Home');
    } catch (e) {};

    // ══════════════════════════════════════════════════════════════
    //  REVIEW SYSTEM — JavaScript
    // ══════════════════════════════════════════════════════════════

    // ── ESCAPE HTML (XSS protection) ──────────────────────────────
    function escHtml(str) {
      return String(str)
        .replace(/&/g, '&amp;').replace(/</g, '&lt;')
        .replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    // ── STAR RATING ───────────────────────────────────────────────
    function initStarRating() {
      const stars = document.querySelectorAll('#starRating .star');
      if (!stars.length) return;
      stars.forEach(star => {
        star.addEventListener('mouseover', () => highlightStars(parseInt(star.dataset.val)));
        star.addEventListener('mouseout', () => highlightStars(parseInt(document.getElementById('reviewRating').value)));
        star.addEventListener('click', () => {
          document.getElementById('reviewRating').value = star.dataset.val;
          highlightStars(parseInt(star.dataset.val));
        });
      });
    }

    function highlightStars(val) {
      document.querySelectorAll('#starRating .star').forEach(s => {
        s.classList.toggle('active', parseInt(s.dataset.val) <= val);
      });
    }

    // ── LOAD LATEST REVIEWS (homepage) ───────────────────────────
    function loadReviews() {
      const el = document.getElementById('reviews-display');
      if (!el) return;
      el.innerHTML = `<div style="text-align:center;padding:40px;color:var(--muted)">
        <div style="font-size:32px;margin-bottom:10px">⏳</div>Loading reviews…</div>`;
      fetch('api/get_reviews.php')
        .then(r => {
          if (!r.ok) throw new Error('Server error ' + r.status);
          return r.json();
        })
        .then(data => {
          if (!data.success) {
            el.innerHTML = `<p style="text-align:center;color:#ef4444;padding:30px">${escHtml(data.message)}</p>`;
            return;
          }
          if (data.reviews.length === 0) {
            el.innerHTML = `<div style="text-align:center;padding:44px;color:var(--muted)">
              <div style="font-size:36px;margin-bottom:12px">💬</div>
              No reviews yet — be the first to share your experience!</div>`;
            initStarRating();
            return;
          }
          el.innerHTML = `<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px">
            ${data.reviews.map(rv => buildReviewCard(rv)).join('')}
          </div>`;
          initStarRating();
        })
        .catch(() => {
          el.innerHTML = `<div style="text-align:center;padding:44px;color:var(--muted)">
            <div style="font-size:36px;margin-bottom:14px">⚠️</div>
            <strong style="color:#ef4444;font-size:15px">Could not load reviews.</strong><br><br>
            Make sure XAMPP <strong>Apache</strong> &amp; <strong>MySQL</strong> are running and you're
            visiting via <span style="color:var(--accent)">http://localhost/gotrip/</span></div>`;
        });
    }

    // ── BUILD ONE REVIEW CARD ─────────────────────────────────────
    function buildReviewCard(rv) {
      const initial = rv.name.trim().charAt(0).toUpperCase();
      const filled = '★'.repeat(parseInt(rv.rating));
      const empty = '☆'.repeat(5 - parseInt(rv.rating));
      const date = new Date(rv.created_at).toLocaleDateString('en-IN', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
      });
      const photoHtml = rv.image_path ?
        `<div style="margin-top:12px;border-radius:10px;overflow:hidden;border:1px solid var(--card-border)">
             <img src="${escHtml(rv.image_path)}"
                  alt="Photo by ${escHtml(rv.name)}"
                  style="width:100%;height:140px;object-fit:cover;display:block"
                  onerror="this.parentElement.style.display='none'"
                  loading="lazy">
           </div>` :
        '';
      return `
        <div class="review-card-hp">
          <div class="review-card-top">
            <div class="review-avatar">${initial}</div>
            <div>
              <div class="review-name">${escHtml(rv.name)}</div>
              <div class="review-date">📅 ${date}</div>
            </div>
            <div class="review-stars" style="color:#fbbf24">
              ${filled}<span style="opacity:0.22">${empty}</span>
            </div>
          </div>
          <p class="review-text">${escHtml(rv.message)}</p>
          ${photoHtml}
        </div>`;
    }

    // ── SUBMIT REVIEW ─────────────────────────────────────────────
    function submitReview() {
      const nameEl = document.getElementById('reviewName');
      const msgAreaEl = document.getElementById('reviewMessage');
      const ratingEl = document.getElementById('reviewRating');
      const btn = document.getElementById('reviewSubmitBtn');
      if (!nameEl || !msgAreaEl || !ratingEl) return;

      const name = nameEl.value.trim();
      const message = msgAreaEl.value.trim();
      const rating = parseInt(ratingEl.value);

      if (!name || name.length < 2) {
        showReviewMsg('error', '⚠️ Please enter your name (at least 2 characters).');
        nameEl.focus();
        return;
      }
      if (rating < 1 || rating > 5) {
        showReviewMsg('error', '⭐ Please select a star rating (1–5).');
        return;
      }
      if (!message || message.length < 10) {
        showReviewMsg('error', '✏️ Please write at least 10 characters.');
        msgAreaEl.focus();
        return;
      }

      btn.disabled = true;
      btn.textContent = '⏳ Submitting…';

      const formData = new FormData();
      formData.append('name', name);
      formData.append('rating', rating);
      formData.append('message', message);
      const photoInput = document.getElementById('reviewPhoto');
      if (photoInput && photoInput.files[0]) {
        formData.append('photo', photoInput.files[0]);
      }

      fetch('api/add_review.php', {
          method: 'POST',
          body: formData
        })
        .then(r => {
          if (!r.ok) throw new Error('Server error ' + r.status);
          return r.json();
        })
        .then(data => {
          if (data.success) {
            showReviewMsg('success', '🎉 ' + data.message);
            nameEl.value = '';
            msgAreaEl.value = '';
            ratingEl.value = '0';
            highlightStars(0);
            clearPhoto();
            loadReviews();
          } else {
            showReviewMsg('error', '❌ ' + data.message);
          }
        })
        .catch(() => showReviewMsg('error', '⚠️ Network error — is XAMPP running?'))
        .finally(() => {
          btn.disabled = false;
          btn.textContent = 'Submit Review 🚀';
        });
    }

    // ── SHOW FORM MESSAGE ─────────────────────────────────────────
    function showReviewMsg(type, text) {
      const el = document.getElementById('reviewMsg');
      if (!el) return;
      el.className = 'review-msg ' + type;
      el.textContent = text;
      clearTimeout(el._t);
      el._t = setTimeout(() => {
        el.className = 'review-msg';
        el.textContent = '';
      }, 5000);
    }

    // ── PHOTO UPLOAD PREVIEW ──────────────────────────────────────
    function previewPhoto(input) {
      const file = input.files[0];
      if (!file) return;
      if (file.size > 5 * 1024 * 1024) {
        showReviewMsg('error', '⚠️ Image is too large. Please choose a file under 5MB.');
        input.value = '';
        return;
      }
      const reader = new FileReader();
      reader.onload = e => {
        document.getElementById('photoPreview').src = e.target.result;
        document.getElementById('photoPreviewWrap').style.display = 'block';
        document.getElementById('photoUploadText').textContent = '✅ ' + file.name;
        document.getElementById('photoUploadLabel').style.borderColor = 'var(--accent)';
      };
      reader.readAsDataURL(file);
    }

    function clearPhoto() {
      const input = document.getElementById('reviewPhoto');
      if (input) input.value = '';
      const pw = document.getElementById('photoPreviewWrap');
      if (pw) pw.style.display = 'none';
      const prev = document.getElementById('photoPreview');
      if (prev) prev.src = '';
      const txt = document.getElementById('photoUploadText');
      if (txt) txt.textContent = 'Click to choose a photo from your device';
      const lbl = document.getElementById('photoUploadLabel');
      if (lbl) lbl.style.borderColor = 'var(--card-border)';
    }

    // ══════════════════════════════════════════════════════════════
    //  ADMIN LOGIN MODAL — JavaScript
    // ══════════════════════════════════════════════════════════════

    function openAdminModal() {
      document.getElementById('adminModalOverlay').classList.add('open');
      document.body.style.overflow = 'hidden';
      setTimeout(() => document.getElementById('adminUser').focus(), 300);
      // Clear previous state
      document.getElementById('adminUser').value = '';
      document.getElementById('adminPass').value = '';
      document.getElementById('adminModalError').classList.remove('show');
      document.getElementById('adminModalError').textContent = '';
    }

    function closeAdminModal(e) {
      // If called from overlay click, only close if clicking the backdrop itself
      if (e && e.target !== document.getElementById('adminModalOverlay')) return;
      document.getElementById('adminModalOverlay').classList.remove('open');
      document.body.style.overflow = '';
    }

    // Close on ESC key
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') {
        document.getElementById('adminModalOverlay').classList.remove('open');
        document.body.style.overflow = '';
      }
    });

    function doAdminLogin() {
      const username = document.getElementById('adminUser').value.trim();
      const password = document.getElementById('adminPass').value;
      const btn = document.getElementById('adminLoginBtn');
      const errEl = document.getElementById('adminModalError');

      // Client-side empty check
      if (!username || !password) {
        errEl.textContent = '⚠️ Please enter both username and password.';
        errEl.classList.add('show');
        return;
      }

      btn.disabled = true;
      btn.textContent = '⏳ Logging in…';
      errEl.classList.remove('show');

      const fd = new FormData();
      fd.append('username', username);
      fd.append('password', password);

      fetch('admin/ajax_login.php', {
          method: 'POST',
          body: fd
        })
        .then(r => {
          if (!r.ok) throw new Error('Server error ' + r.status);
          return r.json();
        })
        .then(data => {
          if (data.success) {
            btn.textContent = '✅ Redirecting…';
            window.location.href = 'admin/dashboard.php';
          } else {
            errEl.textContent = '⚠️ ' + data.message;
            errEl.classList.add('show');
            document.getElementById('adminPass').value = '';
            document.getElementById('adminPass').focus();
            btn.disabled = false;
            btn.textContent = 'Login to Dashboard →';
          }
        })
        .catch(() => {
          errEl.textContent = '⚠️ Network error. Make sure XAMPP is running.';
          errEl.classList.add('show');
          btn.disabled = false;
          btn.textContent = 'Login to Dashboard →';
        });
    }
  </script>
</body>

</html>
