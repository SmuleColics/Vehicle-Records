// Toggle password visibility
document.querySelectorAll('.toggle-pw').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const input = document.getElementById(this.dataset.target);
        const icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
});

// Profile form validation
const profileForm = document.getElementById('profileForm');
if (profileForm) {
    profileForm.addEventListener('submit', function (e) {
        if (!profileForm.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        profileForm.classList.add('was-validated');
    });
}


