{{-- NAV LINKS, SHARED BY THE DESKTOP AND MOBILE SIDEBAR --}}
<ul class="nav flex-column gap-1">
    @if (session('user')->isAdmin())
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
    @else
        <li class="nav-item">
            <a href="{{ route('portal') }}"
                class="admin-nav-link nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ request()->routeIs('portal') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('vehicles') }}"
                class="admin-nav-link nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ request()->routeIs('vehicles') ? 'active' : '' }}">
                <i class="bi bi-car-front"></i> My Vehicles
            </a>
        </li>
    @endif
</ul>
