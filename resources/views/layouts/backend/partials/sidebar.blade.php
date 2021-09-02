
<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                @can('app.dashboard')
                    <li>
                        <a href="{{ route('app.dashboard') }}" class="{{ Request::is('app/dashboard') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            Dashboard
                        </a>
                    </li>
                @endcan

                @can('app.roles.index')
                    <li>
                        <a href="{{ route('app.roles.index') }}" class="{{ Request::is('app/roles*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-check"></i>
                            Roles
                        </a>
                    </li>
                @endcan

                @can('app.users.index')
                    <li>
                        <a href="{{ route('app.users.index') }}" class="{{ Request::is('app/users*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Users
                        </a>
                    </li>
                @endcan

                @can('app.Backups.index')
                    <li>
                        <a href="{{ route('app.backups.index') }}" class="{{ Request::is('app/backups*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-cloud"></i>
                            Backups
                        </a>
                    </li>
                @endcan

                @can('app.Pages.index')
                    <li>
                        <a href="{{ route('app.pages.index') }}" class="{{ Request::is('app/pages*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-news-paper"></i>
                            Pages
                        </a>
                    </li>
                @endcan

                @can('app.menus.index')
                    <li>
                        <a href="{{ route('app.menus.index') }}" class="{{ Request::is('app/menus*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-menu"></i>
                            Menus
                        </a>
                    </li>
                @endcan

                @can('app.menus.index')
                    <li>
                        <a href="{{ route('app.settings.general') }}" class="{{ Request::is('app/settings*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-settings"></i>
                            Settings
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
