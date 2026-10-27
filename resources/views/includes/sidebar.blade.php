<!-- ── DESKTOP SIDEBAR ── -->
<aside class="admin-sidebar d-none d-md-flex flex-column">

    <!-- Logo -->
    <a href="{{ session('user')->homeRoute() }}"
        class="d-flex align-items-center gap-2 px-4 py-4 fw-bold text-white text-decoration-none">
        <span class="admin-logo-icon rounded-2 d-flex align-items-center justify-content-center flex-shrink-0">
            <i class="bi bi-car-front-fill text-white"></i>
        </span>
        Garahe
        <span class="sidebar-role-badge rounded-pill ms-auto">{{ session('user')->isAdmin() ? 'Admin' : 'Client' }}</span>
    </a>

    <!-- Nav -->
    <nav class="flex-grow-1 px-2">
        @include('includes.nav-links')
    </nav>

    <!-- Profile + Sign out -->
    <div class="sidebar-account px-2 pt-3 pb-4">
        @include('includes.account-links')
    </div>

</aside>

<!-- ── MOBILE SIDEBAR (Offcanvas) ── -->
<div class="offcanvas offcanvas-start d-md-none" tabindex="-1"
    id="mobileSidebar" data-bs-backdrop="false" data-bs-scroll="true">

    <div class="offcanvas-header border-0 px-4 pt-4 pb-2">
        <span class="d-flex align-items-center gap-2 fw-bold text-white">
            <span class="admin-logo-icon rounded-2 d-flex align-items-center justify-content-center flex-shrink-0">
                <i class="bi bi-car-front-fill text-white"></i>
            </span>
            Garahe
            <span class="sidebar-role-badge rounded-pill">{{ session('user')->isAdmin() ? 'Admin' : 'Client' }}</span>
        </span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body px-2 d-flex flex-column p-0">
        <nav class="flex-grow-1">
            @include('includes.nav-links')
        </nav>
        <div class="sidebar-account px-2 pt-3 pb-4 mt-auto">
            @include('includes.account-links')
        </div>
    </div>

</div>

<!-- ── SIGN OUT CONFIRMATION MODAL ── -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 rounded-4 overflow-hidden">
            <div class="modal-header border-0 px-4 pt-4 pb-0">
                <h5 class="modal-title fw-bold">Sign out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <p class="small text-secondary mb-0">Are you sure you want to sign out of
                    <strong>{{ session('user')->name }}</strong>?</p>
            </div>
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-light btn-sm rounded-3 px-4"
                    data-bs-dismiss="modal">Cancel</button>
                <a href="{{ route('logout') }}" class="btn btn-dark btn-sm rounded-3 px-4 fw-semibold">Sign out</a>
            </div>
        </div>
    </div>
</div>
