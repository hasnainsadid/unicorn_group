<aside id="layout-menu" class="layout-menu menu-vertical menu"
    style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">

    <div class="app-brand demo ">
        <a href="/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('backend/logo/unicorn_logo.png') }}" alt="Logo" height="40"
                    class="app-brand-logo-default">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-3">Unicorn</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1 ps ps--active-y">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }} open">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div>Dashboards</div>
            </a>
        </li>

        <!-- pages -->
        <li class="menu-header small">
            <span class="menu-header-text">Main pages</span>
        </li>
        <li class="menu-item {{ request()->routeIs('sliders.*') ? 'active' : '' }}">
            <a href="{{ route('sliders.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-slideshow"></i>
                <div>Hero Slider</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('clients.*') ? 'active' : '' }}">
            <a href="{{ route('clients.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-users-group"></i>
                <div>Clients</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('albums.*') ? 'active' : '' }}">
            <a href="{{ route('albums.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-photo"></i>
                <div>Gallery</div>
            </a>
        </li>

        <!-- Forms -->
        <li class="menu-item">
            <a href="{{ route('contacts.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-message"></i>
                <div>Contact Us</div>
            </a>
        </li>
    </ul>
</aside>

<div class="menu-mobile-toggler d-xl-none rounded-1">
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
        <i class="ti tabler-menu icon-base"></i>
        <i class="ti tabler-chevron-right icon-base"></i>
    </a>
</div>
