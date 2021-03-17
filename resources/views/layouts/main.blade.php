<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ url('css/font-face.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="{{ url('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ url('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ url('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ url('css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{ url('images/icon/logo.png') }}" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="{{ ($menu == 'dashboard')?'active':'' }}">
                            <a href="{{ route('home') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="{{ ($menu == 'staff')?'active':'' }}">
                            <a href="{{ route('staff') }}">
                                <i class="fas fa-user"></i>Staff Toko</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-users"></i>Member</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-truck"></i>Supplier</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-box"></i>Barang</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-shopping-cart"></i>Transaksi</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-chart-bar"></i>Pembelian</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-chart-bar"></i>Pembayaran</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-chart-bar"></i>Kasir</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-chart-bar"></i>Kategori</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ url('images/icon/logo.png') }}" alt="Cool Admin" />
                    {{-- <i class="fas fa-shopping-cart"></i> --}}
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        
                        <li class="{{ ($menu == 'dashboard')?'active':'' }}">
                            <a href="{{ route('home') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        
                        @if (Auth::user()->role == 'admin')
                        <li class="{{ ($menu == 'staff')?'active':'' }}">
                            <a href="{{ route('staff') }}">
                                <i class="fas fa-user"></i>Staff Toko</a>
                        </li>
                            
                        @endif
                        <li class="{{ ($menu == 'member')?'active':'' }}">
                            <a href="{{ url('/member') }}">
                                <i class="fas fa-users"></i>Member</a>
                        </li>
                        <li class="{{ ($menu == 'supplier')?'active':'' }}">
                            <a href="{{ url('/supplier') }}">
                                <i class="fas fa-users"></i>Supplier</a>
                        </li>
                        <li class="{{ ($menu == 'barang')?'active':'' }}">
                            <a href="{{ url('/barang') }}">
                                <i class="fas fa-box"></i>Barang</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-shopping-cart"></i>Transaksi</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-shopping-bag"></i>Pembelian</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-tags"></i>Kategori</a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fas fa-money-bill-wave"></i>Pengeluaran</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="">
                        <div class="header-wrap justify-content-end">
                            <div class="header-button ">
                                <div class="noti-wrap">
                                    
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image rounded-circle">
                                            <img src="{{ !empty(Auth::user()->foto_profil)?Auth::user()->foto_profil : url('images/no-image-available.png') }}" alt="John Doe" / style="width: 100%; height:100%;">
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="{{ route('profil') }}">john doe</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image rounded-circle">
                                                    <a href="{{ route('profil') }}">
                                                        <img src="{{ url('images/no-image-available.png') }}" alt="John Doe"  style="width: 100%; height:100%;"/>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="{{ route('profil') }}">john doe</a>
                                                    </h5>
                                                    <span class="email">johndoe@example.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('profil') }}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                    <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="zmdi zmdi-power"></i> {{ __('Logout') }}</a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            @yield('content')
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ url('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ url('vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ url('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ url('vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ url('vendor/wow/wow.min.js') }}"></script>
    <script src="{{ url('vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ url('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ url('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ url('vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ url('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ url('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ url('vendor/select2/select2.min.js') }}">
    <script src="{{ url('vendor/vector-map/jquery.vmap.js')}}"></script>
    <script src="{{ url('vendor/vector-map/jquery.vmap.min.js')}}"></script>
    <script src="{{ url('vendor/vector-map/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{ url('vendor/vector-map/jquery.vmap.world.js')}}"></script>
    <script src="{{ url('vendor/DataTables/datatables.min.js') }}"></script>
    </script>

    <!-- Main JS-->
    <script src="{{ url('js/main.js') }}"></script>

    @yield('script')

</body>

</html>
<!-- end document-->
