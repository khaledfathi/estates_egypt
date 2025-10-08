@php
    use App\Shared\Infrastructure\Utilities\Helper;
@endphp
<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.2
 * @link http://coreui.io
 * Copyright (c) 2016 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
    <title>@yield('title')</title>
    @include('shared::main-header-assets')
    @vite('resources/css/shared/main.css')
    @yield('styles')
</head>

<body class="navbar-fixed sidebar-nav fixed-nav">
    <header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
            <a class="navbar-brand" href="#"></a>
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>

                <!--<li class="nav-item p-x-1">
                    <a class="nav-link" href="#">داشبورد</a>
                </li>
                <li class="nav-item p-x-1">
                    <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item p-x-1">
                    <a class="nav-link" href="#">Settings</a>
                </li>-->
            </ul>
            <ul class="nav navbar-nav pull-left hidden-md-down">
                {{-- notifications --}}

                {{-- <li class="nav-item">
                    <a class="nav-link aside-toggle" href="#"><i class="icon-bell"></i><span
                            class="tag tag-pill tag-danger">5</span></a>
                </li> --}}

                {{-- / notifications --}}

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-md-down">{{ Helper::getFirstWord(Auth::user()->name) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa fa-user"></i> حسابى</a>
                        <!--<a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="tag tag-default">42</span></a>-->
                        <div class="divider"></div>
                        <form class="" method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"> <i class="-item fa fa-lock"></i> خروج</button>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link navbar-toggler aside-toggle" href="#">&#9776;</a> --}}
                </li>

            </ul>
        </div>
    </header>

    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link @yield('dashboard')" href="{{ route('dashboard') }}"><i
                            class="icon-speedometer"></i> لوحة القيادة </a>
                </li>

                <li class="nav-title"> العمليات </li>
                <li class="nav-item">
                    <a class="nav-link @yield('active-estates')" href="{{ route('estates.index') }}">
                        <i class="icon-home icons "></i>
                        العقارات</a>
                    <a class="nav-link @yield('active-owners')" href="{{ route('owners.index') }}">
                        <i class="icon-people"></i>
                        الملاك</a>
                    <a class="nav-link @yield('active-renters')" href="{{ route('renters.index') }}">
                        <i class="icon-people"></i>
                        المستأجرين</a>
                </li>

                <li class="nav-title"> الادارة </li>
                <li class="nav-item">
                    <a class="nav-link @yield('active-queries')" href="{{ route('queries.index') }}"><i class="icon-docs"></i>
                        استعلامات</a>
                    <a class="nav-link @yield('active-transactions')" href="{{ route('transactions.index') }}">
                        <i class="fa fa-dollar"></i>
                        الحسابات</a>
                </li>

                <li class="nav-title"> الحساب </li>
                <li class="nav-item">
                    <a class="nav-link @yield('active-profile')" href="{{ route('profile.edit') }}">
                        <i class="icon-user icons"></i>
                        حسابى</a>
                    <a class="nav-link @yield('active-settings')" href="{{ route('settings.index') }}">
                        <i class="icon-settings icons"></i>
                        إعدادات</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn  btn-link nav-link" type="submit">
                            <i class="icon-logout icons"></i>
                            خروج </button>
                    </form>
                </li>
                <!--<li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> ثبت کاربر جدید</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="components-buttons.html"><i class="icon-puzzle"></i> لیست کاربران</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="components-social-buttons.html"><i class="icon-puzzle"></i> Social Buttons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="components-cards.html"><i class="icon-puzzle"></i> Cards</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="components-forms.html"><i class="icon-puzzle"></i> Forms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="components-switches.html"><i class="icon-puzzle"></i> Switches</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="components-tables.html"><i class="icon-puzzle"></i> Tables</a>
                        </li>
                    </ul>
                </li>-->

                <!--<li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> Icons</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="icons-font-awesome.html"><i class="icon-star"></i> Font Awesome</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="icons-simple-line-icons.html"><i class="icon-star"></i> Simple Line Icons</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="widgets.html"><i class="icon-calculator"></i> Widgets <span class="tag tag-info">NEW</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="charts.html"><i class="icon-pie-chart"></i> Charts</a>
                </li>-->
                <!--<li class="divider"></li>
                <li class="nav-title">
                    Extras
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> Pages</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="pages-login.html" target="_top"><i class="icon-star"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages-register.html" target="_top"><i class="icon-star"></i> Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages-404.html" target="_top"><i class="icon-star"></i> Error 404</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages-500.html" target="_top"><i class="icon-star"></i> Error 500</a>
                        </li>
                    </ul>
                </li>-->

            </ul>
        </nav>
    </div>

    <main class="main">

        <!-- position -->
        {{-- <ol class="breadcrumb">

            <li class="breadcrumb-item">مجلد 1</li>
            <li class="breadcrumb-item active"><a href="#">مجلد 2</a> </li>
            <li class="breadcrumb-item">مجلد 3</li>

            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="{{ route('dashboard') }}"><i class="icon-graph"></i>
                        &nbsp;لوحة القيادة</a>
                    <a class="btn btn-secondary" href="{{ route('settings.index') }}"><i class="icon-settings"></i>
                        &nbsp;اعدادت</a>
                </div>
            </li>
        </ol> --}}

        @yield('content')
    </main>

    <aside class="aside-menu">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="timeline" role="tabpanel">
                <div class="callout m-a-0 p-y-h text-muted text-xs-center bg-faded text-uppercase">
                    <small><b>Today</b>
                    </small>
                </div>
                <hr class="transparent m-x-1 m-y-0">
                <div class="callout callout-warning m-a-0 p-y-1">
                    <div class="avatar pull-xs-right">
                        <img src="{{ asset('img/avatars/7.jpg') }}"class="img-avatar"
                            alt="admin@bootstrapmaster.com">
                    </div>
                    <div>Meeting with
                        <strong>Lucas</strong>
                    </div>
                    <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                    <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
                </div>
                <hr class="m-x-1 m-y-0">
                <div class="callout callout-info m-a-0 p-y-1">
                    <div class="avatar pull-xs-right">
                        <img src="{{ asset('img/avatars/4.jpg') }}" class="img-avatar"
                            alt="admin@bootstrapmaster.com">
                    </div>
                    <div>Skype with
                        <strong>Megan</strong>
                    </div>
                    <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
                    <small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line</small>
                </div>
                <hr class="transparent m-x-1 m-y-0">
                <div class="callout m-a-0 p-y-h text-muted text-xs-center bg-faded text-uppercase">
                    <small><b>Tomorrow</b>
                    </small>
                </div>
                <hr class="transparent m-x-1 m-y-0">
                <div class="callout callout-danger m-a-0 p-y-1">
                    <div>New UI Project -
                        <strong>deadline</strong>
                    </div>
                    <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 10 - 11pm</small>
                    <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                    <div class="avatars-stack m-t-h">
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/2.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/3.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/4.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/5.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/6.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                    </div>
                </div>
                <hr class="m-x-1 m-y-0">
                <div class="callout callout-success m-a-0 p-y-1">
                    <div>
                        <strong>#10 Startups.Garden</strong>Meetup
                    </div>
                    <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
                    <small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA</small>
                </div>
                <hr class="m-x-1 m-y-0">
                <div class="callout callout-primary m-a-0 p-y-1">
                    <div>
                        <strong>Team meeting</strong>
                    </div>
                    <small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
                    <small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ</small>
                    <div class="avatars-stack m-t-h">
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/2.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/3.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/4.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/5.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/6.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/7.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                        <div class="avatar avatar-xs">
                            <img src="{{ asset('img/avatars/8.jpg') }}" class="img-avatar"
                                alt="admin@bootstrapmaster.com">
                        </div>
                    </div>
                </div>
                <hr class="m-x-1 m-y-0">
            </div>

        </div>
    </aside>

    @include('shared::main-footer-assets')
    @yield('scripts')
</body>

</html>
