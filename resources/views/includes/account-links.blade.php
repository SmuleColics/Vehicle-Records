{{-- PROFILE + SIGN OUT, PINNED TO THE BOTTOM OF THE SIDEBAR --}}
<ul class="nav flex-column gap-1">
    <li class="nav-item">
        <a href="{{ route('profile') }}"
            class="admin-nav-link nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="bi bi-person"></i> Profile
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('logout') }}" data-bs-toggle="modal" data-bs-target="#logoutModal"
            class="admin-nav-link admin-signout nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3">
            <i class="bi bi-box-arrow-left"></i> Sign out
        </a>
    </li>
</ul>
