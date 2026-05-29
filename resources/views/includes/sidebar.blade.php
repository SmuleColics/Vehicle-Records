<!-- ── DESKTOP SIDEBAR ── -->
<aside class="admin-sidebar d-none d-md-flex flex-column">

    <!-- Logo -->
    <a href="{{ route('dashboard') }}"
        class="d-flex align-items-center gap-2 px-4 py-4 fw-bold text-white text-decoration-none">
        <span class="admin-logo-icon rounded-2 d-flex align-items-center justify-content-center flex-shrink-0">
            <i class="bi bi-car-front-fill text-white"></i>
        </span>
        Garahe
    </a>

    <!-- Nav -->
    <nav class="flex-grow-1 px-2">
        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="admin-nav-link nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users') }}"
                    class="admin-nav-link nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ request()->routeIs('users') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('vehicles') }}"
                    class="admin-nav-link nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ request()->routeIs('vehicles') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-spreadsheet"></i> Vehicle Records
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sign out -->
    <div class="px-2 pb-4">
        <a href="{{ route('logout') }}"
            class="admin-nav-link admin-signout nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3">
            <i class="bi bi-box-arrow-left"></i> Sign out
        </a>
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
        </span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body px-2 d-flex flex-column p-0">
        <nav class="flex-grow-1">
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="admin-nav-link nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users') }}"
                        class="admin-nav-link nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ request()->routeIs('users') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vehicles') }}"
                        class="admin-nav-link nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ request()->routeIs('vehicles') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-spreadsheet"></i> Vehicle Records
                    </a>
                </li>
            </ul>
        </nav>
        <div class="px-2 pb-4 mt-auto">
            <a href="{{ route('logout') }}"
                class="admin-nav-link admin-signout nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3">
                <i class="bi bi-box-arrow-left"></i> Sign out
            </a>
        </div>
    </div>

</div>
