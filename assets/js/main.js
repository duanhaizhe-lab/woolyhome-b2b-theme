document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('[data-year]').forEach(function (el) {
    el.textContent = new Date().getFullYear();
  });

  var toggle = document.querySelector('[data-menu-toggle]');
  var nav = document.querySelector('[data-primary-nav]');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var isOpen = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
    nav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        nav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  var form = document.querySelector('[data-inquiry-form]');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var data = new FormData(form);
      var lines = [
        'Name: ' + (data.get('name') || ''),
        'Company: ' + (data.get('company') || ''),
        'Email: ' + (data.get('email') || ''),
        'Product Interest: ' + (data.get('product_interest') || ''),
        'Quantity: ' + (data.get('quantity') || ''),
        '',
        data.get('message') || ''
      ];
      var subject = encodeURIComponent('B2B Inquiry - ' + (data.get('product_interest') || 'WoolyHome'));
      var body = encodeURIComponent(lines.join('\n'));
      window.location.href = 'mailto:duanhaizhe@gmail.com?subject=' + subject + '&body=' + body;
    });
  }
});
