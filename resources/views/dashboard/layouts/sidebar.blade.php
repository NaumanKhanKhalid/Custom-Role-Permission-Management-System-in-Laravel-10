<!--aside open-->
<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="index.html">
            <img src="{{ asset('dashboard-assets/assets/images/brand/logo.png')}}" class="header-brand-img desktop-lgo"
                alt="Dayonelogo">
            <img src="{{asset('dashboard-assets/assets/images/brand/logo-white.png')}}"
                class="header-brand-img dark-logo" alt="Dayonelogo">
            <img src="{{asset('dashboard-assets/assets/images/brand/favicon.png')}}"
                class="header-brand-img mobile-logo" alt="Dayonelogo">
            <img src="{{asset('dashboard-assets/assets/images/brand/favicon1.png')}}"
                class="header-brand-img darkmobile-logo" alt="Dayonelogo">
        </a>
    </div>
    <div class="app-sidebar3">
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
                <div class="user-pic">
                    <img src="{{ asset('dashboard-assets/assets/images/users/16.jpg')}}" alt="user-img"
                        class="avatar-xxl rounded-circle mb-1">
                </div>
                <div class="user-info">
                    <h5 class=" mb-2">{{ Auth::user()->basic_info->FullName() }}</h5>
                    <span class="text-muted app-sidebar__user-name text-sm">{{ Auth::user()->role->name }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category mt-4">Dashboards</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('dashboard') }}">
                    <i class="feather feather-home sidemenu_icon"></i>
                    <span class="side-menu__label"><span class="nav-list">Dashboard</span></span>
                </a>
            </li>

            <li class="slide ">
                <a class="side-menu__item" data-bs-toggle="slide" href="#">
                    <i class="feather feather-users sidemenu_icon"></i>
                    <span class="side-menu__label">Users</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    @can('user_management', 'view_users')
                    <li><a href="{{ route('users.index') }}" class="slide-item">Users</a></li>
                    @endcan

                    <li><a href="{{ route('role.index') }}" class="slide-item">Roles</a></li>

                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="#">
                    <i class="feather feather-trash sidemenu_icon"></i>
                    <span class="side-menu__label">Trash</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">

                    <li><a href="{{ route('role.index',['trashed' => true]) }}" class="slide-item">Roles</a></li>
                    <li><a href="{{ route('users.index',['trashed' => true]) }}" class="slide-item">Users</a></li>
                </ul>
            </li>

        </ul>

    </div>
</aside>
<!--aside closed-->
