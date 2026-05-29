(() => {
  const form = document.querySelector('.needs-validation');
  if (form) {
    form.addEventListener('submit', e => {
      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
      }
      form.classList.add('was-validated');
    });
  }

  const togglePassword = document.getElementById('togglePassword');
  if (togglePassword) {
    togglePassword.addEventListener('click', function () {
      const input = document.getElementById('password');
      const icon = this.querySelector('i');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
      }
    });
  }

  const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
  if (togglePasswordConfirm) {
    togglePasswordConfirm.addEventListener('click', function () {
      const input = document.getElementById('confirm_password');
      const icon = this.querySelector('i');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
      }
    });
  }

  // Auto-close offcanvas on resize past mobile breakpoint
const mobileSidebar = document.getElementById('mobileSidebar');
  if (mobileSidebar) {
    let resizeTimer;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        if (window.innerWidth >= 768) {
          if (mobileSidebar.classList.contains('show')) {
            const offcanvasInstance =
              bootstrap.Offcanvas.getInstance(mobileSidebar) ||
              new bootstrap.Offcanvas(mobileSidebar);
            offcanvasInstance.hide();
          }
        }
      }, 100);
    });
  }

})();