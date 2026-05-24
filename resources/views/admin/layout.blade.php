<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueLight Admin</title>

    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        html,
        body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        * {
            box-sizing: border-box;
        }

        img,
        video,
        iframe,
        svg {
            max-width: 100%;
            height: auto;
        }

        #wrapper {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        #content-wrapper {
            min-width: 0;
            width: 100%;
            overflow-x: hidden;
        }

        #content {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        .container-fluid {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .img-profile {
            width: 42px;
            height: 42px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .topbar-user-box {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .topbar-user-info {
            text-align: right;
            line-height: 1.2;
            min-width: 0;
        }

        .topbar-user-info .name {
            font-weight: 600;
            color: #5a5c69;
            max-width: 160px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .topbar-user-info .role {
            font-size: 12px;
            color: #858796;
            max-width: 160px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .logout-btn {
            border: none;
            background: #e74a3b;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            white-space: nowrap;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        .topbar {
            min-width: 0;
            width: 100%;
        }

        .topbar .navbar-nav {
            min-width: 0;
        }

        .sidebar {
            flex-shrink: 0;
        }

        .table,
        table {
            width: 100%;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        input,
        select,
        textarea,
        button {
            max-width: 100%;
        }

        .card,
        .shadow,
        .alert {
            max-width: 100%;
        }

        @media (max-width: 768px) {
            body {
                font-size: 14px;
            }

            #wrapper {
                display: block;
            }

            .sidebar {
                width: 100% !important;
                min-height: auto;
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                overflow-x: auto;
                overflow-y: hidden;
                white-space: nowrap;
                position: relative;
                padding-bottom: 6px;
            }

            .sidebar .sidebar-brand {
                min-width: 160px;
                height: 58px;
                padding: 0 12px;
            }

            .sidebar .sidebar-brand-text {
                font-size: 14px;
                margin: 0 !important;
            }

            .sidebar .sidebar-divider,
            .sidebar .sidebar-heading {
                display: none;
            }

            .sidebar .nav-item {
                flex: 0 0 auto;
            }

            .sidebar .nav-item .nav-link {
                width: auto !important;
                padding: 16px 12px !important;
                text-align: center;
            }

            .sidebar .nav-item .nav-link i {
                margin-right: 4px;
                font-size: 13px;
            }

            .sidebar .nav-item .nav-link span {
                display: inline !important;
                font-size: 12px;
            }

            .topbar {
                height: auto;
                min-height: 64px;
                padding: 10px 12px;
                align-items: center;
                flex-wrap: wrap;
                gap: 8px;
            }

            .topbar>span {
                width: 100%;
                margin-left: 0 !important;
                text-align: center;
                font-size: 15px;
            }

            .topbar .navbar-nav {
                width: 100%;
                margin-left: 0 !important;
                justify-content: center;
            }

            .topbar-user-box {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
                gap: 8px;
            }

            .topbar-user-info {
                text-align: center;
                width: 100%;
                order: 1;
            }

            .topbar-user-info .name,
            .topbar-user-info .role {
                max-width: 100%;
            }

            .img-profile {
                width: 38px;
                height: 38px;
                order: 2;
            }

            .topbar-user-box form {
                order: 3;
            }

            .logout-btn {
                padding: 7px 12px;
                font-size: 13px;
            }

            .container-fluid {
                padding-left: 10px;
                padding-right: 10px;
            }

            .card-body {
                padding: 1rem;
            }

            .row {
                margin-left: -6px;
                margin-right: -6px;
            }

            .row>[class*="col-"] {
                padding-left: 6px;
                padding-right: 6px;
            }
        }

        @media (max-width: 480px) {
            .sidebar .sidebar-brand {
                min-width: 145px;
            }

            .sidebar .nav-item .nav-link {
                padding: 14px 10px !important;
            }

            .sidebar .nav-item .nav-link span {
                font-size: 11px;
            }

            .topbar>span {
                font-size: 14px;
            }

            .container-fluid {
                padding-left: 8px;
                padding-right: 8px;
            }

            h1,
            .h1 {
                font-size: 1.5rem;
            }

            h2,
            .h2 {
                font-size: 1.35rem;
            }

            h3,
            .h3 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-text mx-3">BlueLight Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Pesanan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.products.index') }}">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Produk</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.stocks.index') }}">
                    <i class="fas fa-fw fa-warehouse"></i>
                    <span>Stok</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.suppliers.index') }}">
                    <i class="fas fa-fw fa-truck"></i>
                    <span>Supplier</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Laporan
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.laporan.harian') }}">
                    <i class="fas fa-calendar-day"></i>
                    <span>Laporan Harian</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.laporan.mingguan') }}">
                    <i class="fas fa-calendar-week"></i>
                    <span>Laporan Mingguan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.laporan.bulanan') }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Laporan Bulanan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.laporan.tahunan') }}">
                    <i class="fas fa-calendar"></i>
                    <span>Laporan Tahunan</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.spk.index') }}">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>SPK</span>
                </a>
            </li>

            @auth
            @if(auth()->user()->role == 'admin')
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User</span>
                </a>
            </li>
            @endif
            @endauth

        </ul>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <span class="ml-3 font-weight-bold text-primary">Admin Panel</span>

                    <ul class="navbar-nav ml-auto">
                        @auth
                        <li class="nav-item d-flex align-items-center">
                            <div class="topbar-user-box">
                                <div class="topbar-user-info">
                                    <div class="name">{{ auth()->user()->name }}</div>
                                    <div class="role">
                                        @if(auth()->user()->role == 'admin')
                                        Pemilik / Admin
                                        @elseif(auth()->user()->role == 'pegawai')
                                        Pegawai
                                        @else
                                        Pelanggan
                                        @endif
                                    </div>
                                </div>

                                <img class="img-profile rounded-circle"
                                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4e73df&color=fff"
                                    alt="Profile">

                                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endauth
                    </ul>
                </nav>
                <!-- End Topbar -->

                <div class="container-fluid">

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 pl-3">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
</body>

</html>