<header class="erp-navbar">
    <div class="d-flex align-items-center gap-2">
        <button class="btn btn-sm btn-outline-primary d-lg-none" id="sidebarToggle" type="button">
            <i class="bi bi-list"></i>
        </button>

        <div>
            <h1 class="page-title">@yield('page_title', 'Dashboard')</h1>
            <div class="page-subtitle">@yield('page_subtitle', 'Manage your business operations')</div>
        </div>
    </div>

    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle user-dropdown" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i>
            {{ Auth::user()->name ?? 'User' }}
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person me-2"></i>Profile
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger" type="submit">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</header>
