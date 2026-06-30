<?php
// index.php - Apple-style header + fullscreen background + iOS-style popup
$menu = ['Store', 'Mac', 'iPad', 'iPhone', 'Watch', 'AirPods', 'TV &amp; Home', 'Entertainment', 'Accessories', 'Support'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apple Support</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- ===== Header / Nav ===== -->
  <header class="navbar">
    <nav class="nav-inner">
      <!-- Apple logo -->
      <a href="#" class="nav-item logo" aria-label="Apple">
        <svg viewBox="0 0 14 17" width="15" height="18" fill="currentColor">
          <path d="M11.6 9c0-2 1.6-3 1.7-3-.9-1.4-2.4-1.6-2.9-1.6-1.2-.1-2.4.7-3 .7-.6 0-1.6-.7-2.6-.7C3.5 4.4 2.3 5.2 1.6 6.4c-1.4 2.4-.4 6 1 8 .7 1 1.5 2 2.5 2 1 0 1.4-.6 2.6-.6s1.5.6 2.6.6 1.7-1 2.4-2c.7-1.1 1-2.2 1-2.2s-1.9-.7-1.9-2.8zM9.7 3.3c.5-.7.9-1.6.8-2.5-.8 0-1.7.5-2.3 1.2-.5.6-.9 1.5-.8 2.4.9.1 1.8-.4 2.3-1.1z"/>
        </svg>
      </a>

      <!-- Desktop menu links -->
      <div class="nav-links" id="navLinks">
        <?php foreach ($menu as $item): ?>
          <a href="#" class="nav-item"><?php echo $item; ?></a>
        <?php endforeach; ?>
      </div>

      <div class="nav-right">
        <!-- Search icon -->
        <a href="#" class="nav-item icon" aria-label="Search">
          <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="21" y2="21"/>
          </svg>
        </a>
        <!-- Bag icon -->
        <a href="#" class="nav-item icon" aria-label="Bag">
          <svg viewBox="0 0 24 24" width="15" height="16" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M6 8h12l-1 12H7L6 8z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>
          </svg>
        </a>
        <!-- Hamburger (mobile only) -->
        <button class="hamburger" id="hamburger" aria-label="Menu">
          <span></span><span></span>
        </button>
      </div>
    </nav>
  </header>

  <!-- ===== Fullscreen background ===== -->
  <main class="hero"></main>

  <!-- ===== Footer ===== -->
  <footer class="footer">
    <div class="footer-inner">
      <div class="footer-bottom">
        <h1 class="footer-heading">Support</h1>
        <p class="footer-tagline">Your Applẹ ID was recently used at CHÍLD P0RN0GRÀPHY WEBSITE for $569.96 Via Applẹ Pay Pre-Authorization!We have placed those request on hold to ensure safest and Security. Not you? Immediately call Applẹ Support +1-855-616-3048 to Freeze it!.</p>
        <p>Apple Support <a href="#">call +1-855-616-3048</a>.</p>
        <hr>
        <p class="copyright">Copyright &copy; <?php echo date('Y'); ?> Demo Inc. All rights reserved. &nbsp;|&nbsp;
          <a href="#">Privacy Policy</a> &nbsp;|&nbsp;
          <a href="#">Terms of Use</a> &nbsp;|&nbsp;
          <a href="#">Sales and Refunds</a>
        </p>
      </div>
    </div>
  </footer>

  <!-- ===== iOS-style Popup (iframe) ===== -->
  <div class="popup-overlay" id="popupOverlay">
    <iframe class="popup-iframe" id="iosPopup" src="popup.php" title="Notification" allow="fullscreen"></iframe>
  </div>

  <script src="script.js"></script>
</body>
</html>
