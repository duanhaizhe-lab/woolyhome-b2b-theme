(function () {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || !('IntersectionObserver' in window)) {
    return;
  }

  var targets = document.querySelectorAll(
    '.whs-section-head, .whs-p-card, .whs-why-card, .whs-buyer-card, .whs-process-cell'
  );
  targets.forEach(function (el) {
    el.classList.add('whs-reveal');
  });

  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('whs-in');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  targets.forEach(function (el) {
    io.observe(el);
  });
})();
