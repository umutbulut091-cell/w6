// iOS-style popup behaviour
document.addEventListener("DOMContentLoaded", function () {
  const overlay = document.getElementById("popupOverlay");

  // Mobile hamburger toggle
  const hamburger = document.getElementById("hamburger");
  const navLinks = document.getElementById("navLinks");
  if (hamburger) {
    hamburger.addEventListener("click", function () {
      hamburger.classList.toggle("open");
      navLinks.classList.toggle("open");
    });
  }

  // Show popup on load (like iOS alert)
  setTimeout(() => overlay.classList.add("show"), 400);

  // Popup does NOT close when clicking outside (stays put)
  overlay.addEventListener("click", function (e) {
    if (e.target === overlay) {
      // small "bounce" to show it won't dismiss
      const popup = document.getElementById("iosPopup");
      popup.style.transform = "scale(1.04)";
      setTimeout(() => (popup.style.transform = "scale(1)"), 120);
    }
  });

  // Close when the iframe's Continue button sends a message
  window.addEventListener("message", function (e) {
    if (e.data === "closePopup") {
      overlay.classList.remove("show");
    }
  });
});
