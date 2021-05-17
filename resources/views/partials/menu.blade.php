<aside class="main-sidebar sidebar-light-pink elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">

        <img src="/adup.png" class="img-thumbnail" alt="...">

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link {{ request()->is('admin')? 'active' : '' }}">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-users">

                            </i>
                            <p>
                                <span>{{ trans('cruds.userManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.permission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.user.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('admin/ads*') ? 'menu-open' : '' }} {{ request()->is('admin/tags*') ? 'menu-open' : '' }}{{ request()->is('admin/types*') ? 'menu-open' : '' }}{{ request()->is('admin/domaine*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa fa-address-card nav-icon">

                            </i>
                            <p>
                                <span>Ads</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                    <a href="{{ route("admin.ads.index") }}" class="nav-link {{ request()->is('admin/ads') || request()->is('admin/ads/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-ad">

                                        </i>
                                        <p>
                                            <span>ads</span>
                                        </p>
                                    </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.tags.index") }}" class="nav-link {{ request()->is('admin/tags') || request()->is('admin/ads/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-tags">

                                    </i>
                                    <p>
                                        <span>tags</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{ route("admin.types.index") }}" class="nav-link {{ request()->is('admin/types') || request()->is('admin/types/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-cube">

                                        </i>
                                        <p>
                                            <span>types</span>
                                        </p>
                                    </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.domaine.index') }}" class="nav-link {{ request()->is('admin/domaine') || request()->is('admin/domaine/*') ? 'active' : '' }}" >
                                    <i class="nav-icon fa-fw fas fa-user-tag">

                                    </i>
                                    Domaine
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('admin/rasbarys*') ? 'menu-open' : '' }} {{ request()->is('admin/venues*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-microchip nav-icon ">

                            </i>
                            <p>
                                <span>AdUp Box</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route("admin.rasbarys.index") }}" class="nav-link {{ request()->is('admin/rasbarys') || request()->is('admin/rasbarys/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-microchip">

                                    </i>
                                    <p>
                                        <span>Box</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.venues.index") }}" class="nav-link {{ request()->is('admin/venues') || request()->is('admin/venues/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-map-marker-alt">

                                    </i>
                                    <p>
                                        <span>Locations</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('admin/locationpartner*') ? 'menu-open' : '' }} {{ request()->is('admin/advertiser*') ? 'menu-open' : '' }} ">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fas fa-handshake nav-icon ">

                            </i>
                            <p>
                                <span>Partner</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.locationpartner.index')}}" class="nav-link ">
                                    <i class="fas fa-hotel nav-icon">

                                    </i>
                                    Location Partner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.advertiser.index') }}" class="nav-link">
                                    <i class="nav-icon fa-fw fas fa-video">

                                    </i>
                                    Advertiser
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                        <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is('admin/events') || request()->is('admin/events/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-calendar">

                            </i>
                            <p>
                                <span>calendar</span>
                            </p>
                        </a>
                </li>

            @can('advertiser')
                <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa fa-address-card nav-icon">

                            </i>
                            <p>
                                <span>Ads</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                    <a href="{{ route("admin.ads.index") }}" class="nav-link {{ request()->is('admin/ads') || request()->is('admin/ads/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-ad">

                                        </i>
                                        <p>
                                            <span>ads</span>
                                        </p>
                                    </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.tags.index") }}" class="nav-link {{ request()->is('admin/tags') || request()->is('admin/tags/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-tags">

                                    </i>
                                    <p>
                                        <span>tags</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{ route("admin.types.index") }}" class="nav-link {{ request()->is('admin/types') || request()->is('admin/types/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-cube">

                                        </i>
                                        <p>
                                            <span>types</span>
                                        </p>
                                    </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.domaine.index') }}" class="nav-link" >
                                    <i class="nav-icon fa-fw fas fa-user-tag">

                                    </i>
                                    Domaine
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                                <a href="{{ route("admin.venues.index") }}" class="nav-link {{ request()->is('admin/venues') || request()->is('admin/venues/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-map-marker-alt">

                                    </i>
                                    <p>
                                        <span>Locations</span>
                                    </p>
                                </a>
                            </li>
            @endcan

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
