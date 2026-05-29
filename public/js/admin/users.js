$(document).ready(function () {
    $('#usersTable').DataTable({
        pageLength: 10,
        dom: '<"d-flex align-items-center justify-content-between mb-3"lf>tip',
        language: {
            search: '',
            searchPlaceholder: 'Search users…',
            info: 'Showing _START_ to _END_ of _TOTAL_ users',
            paginate: {
                previous: '<i class="bi bi-chevron-left"></i>',
                next: '<i class="bi bi-chevron-right"></i>',
            },
        },
        columnDefs: [{ orderable: false, targets: -1 }],
    });

    // ── MODAL PASSWORD TOGGLE ──
    const modalTogglePassword = document.getElementById('modalTogglePassword');
    if (modalTogglePassword) {
        modalTogglePassword.addEventListener('click', function () {
            const input = document.getElementById('modalPassword');
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

    // ── MODAL CONFIRM PASSWORD TOGGLE ──
    const modalTogglePasswordConfirm = document.getElementById('modalTogglePasswordConfirm');
    if (modalTogglePasswordConfirm) {
        modalTogglePasswordConfirm.addEventListener('click', function () {
            const input = document.getElementById('modalConfirmPassword');
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

});