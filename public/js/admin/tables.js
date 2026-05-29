const addForm = document.getElementById('addForm');
if (addForm) {
    addForm.addEventListener('submit', e => {
        if (!addForm.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
        addForm.classList.add('was-validated');
    });
    document.getElementById('addModal').addEventListener('hidden.bs.modal', () => {
        addForm.reset();
        addForm.classList.remove('was-validated');
    });
}

const editForm = document.getElementById('editForm');
if (editForm) {
    // Reset when modal OPENS
    document.getElementById('editModal').addEventListener('show.bs.modal', () => {
        editForm.reset();
        editForm.classList.remove('was-validated');
    });

    editForm.addEventListener('submit', e => {
        if (!editForm.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
        editForm.classList.add('was-validated');
    });

    document.getElementById('editModal').addEventListener('hidden.bs.modal', () => {
        editForm.reset();
        editForm.classList.remove('was-validated');
    });
}