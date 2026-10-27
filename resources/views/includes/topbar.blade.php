{{-- TOPBAR WITH SEARCH AND PROFILE AT THE RIGHT --}}
<header class="admin-topbar d-flex align-items-center justify-content-between px-4 py-3 border-bottom bg-white">
    <button class="btn d-md-none p-1 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
        <i class="bi bi-list fs-5"></i>
    </button>
    <div class="position-relative flex-grow-1" style="max-width: 440px;">
        <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3 text-secondary small"></i>
        <input type="text" class="form-control form-control-sm admin-search ps-5"
            placeholder="Search records, plates, owners…" />
    </div>
    <div class="d-flex align-items-center gap-3 ms-3">
        <button class="btn btn-light rounded-circle p-2 d-flex align-items-center justify-content-center"
            style="width:36px;height:36px;">
            <i class="bi bi-bell small"></i>
        </button>
        <a href="{{ route('profile') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
            <span class="d-none d-sm-block text-end lh-sm">
                <span class="d-block small fw-semibold">{{ session('user')->name }}</span>
                <span class="d-block text-secondary" style="font-size:0.7rem;">{{ session('user')->isAdmin() ? 'Administrator' : 'Client' }}</span>
            </span>
            <img src="{{ session('user')->avatarUrl() }}"
                class="rounded-circle"
                width="36" height="36"
                style="object-fit:cover;" />
        </a>
    </div>
</header>