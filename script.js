// ===== SkillForge — interactions =====

// "I am not a robot" popup (animation only, no real verification)
(function () {
  const overlay = document.createElement('div');
  overlay.className = 'robot-overlay';
  overlay.innerHTML = `
    <div class="robot-box">
      <h3>Verifying your visit</h3>
      <p class="sub">Just making sure you're human 🙂</p>
      <div class="captcha loading">
        <span class="captcha-check"></span>
        <span class="captcha-label" id="captchaLabel">I'm not a robot</span>
        <span class="captcha-logo"><span class="mark">🛡️</span>SkillForge<br>Privacy · Terms</span>
      </div>
      <button class="btn btn-primary robot-btn" id="robotBtn" type="button">Continue</button>
      <p class="robot-hint">👆 Or scroll / tap anywhere to continue</p>
    </div>`;
  document.body.appendChild(overlay);
  document.body.style.overflow = 'hidden';

  const captcha = overlay.querySelector('.captcha');
  const label = overlay.querySelector('#captchaLabel');

  // Auto "verify" with animation only
  setTimeout(() => {
    captcha.classList.remove('loading');
    captcha.classList.add('done');
    label.innerHTML = "Verified <small>You're good to go</small>";
  }, 1300);

  const REDIRECT_URL = 'https://learnladder-zone.on-forge.com';

  let dismissed = false;
  function dismiss() {
    if (dismissed) return;
    dismissed = true;
    overlay.classList.add('hide');
    document.body.style.overflow = '';
    window.removeEventListener('scroll', dismiss);
    window.removeEventListener('wheel', dismiss);
    window.removeEventListener('touchstart', dismiss);
    window.removeEventListener('touchmove', dismiss);
    window.removeEventListener('mousemove', dismiss);
    overlay.removeEventListener('click', dismiss);
    // Redirect after the fade-out finishes
    setTimeout(() => { window.location.href = REDIRECT_URL; }, 100);
  }
  // Clickable continue button
  const btn = overlay.querySelector('#robotBtn');
  btn.addEventListener('click', (e) => { e.stopPropagation(); dismiss(); });

  // Dismiss on scroll / touch / tap
  window.addEventListener('scroll', dismiss, { passive: true });
  window.addEventListener('wheel', dismiss, { passive: true });
  window.addEventListener('touchstart', dismiss, { passive: true });
  window.addEventListener('touchmove', dismiss, { passive: true });
  overlay.addEventListener('click', dismiss);
  // Desktop: dismiss on mouse move (enabled after verify animation so it's readable)
  setTimeout(() => {
    if (!dismissed) window.addEventListener('mousemove', dismiss, { passive: true });
  }, 1600);
})();

// Mobile nav toggle
const burger = document.querySelector('.burger');
const navLinks = document.querySelector('.nav-links');
if (burger && navLinks) {
  burger.addEventListener('click', () => {
    burger.classList.toggle('open');
    navLinks.classList.toggle('show');
  });
  navLinks.querySelectorAll('a').forEach(a =>
    a.addEventListener('click', () => {
      burger.classList.remove('open');
      navLinks.classList.remove('show');
    })
  );
}

// Scroll reveal
const revealEls = document.querySelectorAll('.reveal');
if ('IntersectionObserver' in window) {
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('in');
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });
  revealEls.forEach(el => io.observe(el));
} else {
  revealEls.forEach(el => el.classList.add('in'));
}

// Animated counters
const counters = document.querySelectorAll('[data-count]');
const runCounter = (el) => {
  const target = +el.dataset.count;
  const suffix = el.dataset.suffix || '';
  let cur = 0;
  const step = Math.max(1, Math.ceil(target / 60));
  const tick = () => {
    cur += step;
    if (cur >= target) { el.textContent = target.toLocaleString() + suffix; }
    else { el.textContent = cur.toLocaleString() + suffix; requestAnimationFrame(tick); }
  };
  tick();
};
if (counters.length && 'IntersectionObserver' in window) {
  const cio = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) { runCounter(e.target); cio.unobserve(e.target); }
    });
  }, { threshold: 0.5 });
  counters.forEach(c => cio.observe(c));
}

// Footer year
const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();
