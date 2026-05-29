document.addEventListener("DOMContentLoaded", function () {

    // TOAST NOTIFICATIONS
    const toastElList = document.querySelectorAll('.toast');
    toastElList.forEach(function (toastEl) {
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    });

    // FORM VALIDATION 
    document.addEventListener('submit', function (e) {
        const form = e.target.closest('.needs-validation');
        if (!form) return;

        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });

});