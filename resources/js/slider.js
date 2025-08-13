(function () {
  const slides = Array.from(document.querySelectorAll('#hero-slider .slide'));
  const dots = Array.from(document.querySelectorAll('.slider-dot'));
  let current = 0;
  const slideCount = slides.length;
  let intervalId = null;
  const INTERVAL = 2000;
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function showSlide(idx) {
    slides.forEach((s, i) => {
      const isActive = i === idx;
      s.style.opacity = isActive ? '1' : '0';
      s.setAttribute('aria-hidden', String(!isActive));
    });
    dots.forEach((d, i) => d.classList.toggle('bg-blue-600', i === idx));
    current = idx;
  }

  dots.forEach(d => {
    d.addEventListener('click', () => {
      const idx = parseInt(d.dataset.index, 10);
      showSlide(idx);
      restartInterval();
    });
  });

  function nextSlide() {
    showSlide((current + 1) % slideCount);
  }

  function startInterval() {
    if (prefersReduced) return;
    intervalId = setInterval(nextSlide, INTERVAL);
  }
  function stopInterval() { if (intervalId) clearInterval(intervalId); }
  function restartInterval() { stopInterval(); startInterval(); }

  // initialize
  showSlide(0);
  startInterval();

  // pause on hover
  const hero = document.getElementById('hero-slider');
  hero.addEventListener('mouseenter', stopInterval);
  hero.addEventListener('mouseleave', startInterval);
})();
