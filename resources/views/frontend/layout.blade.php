<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueLight Aquarium</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #111827;
        }

        img,
        video,
        iframe,
        svg {
            max-width: 100%;
            height: auto;
        }

        a,
        button {
            -webkit-tap-highlight-color: transparent;
        }

        button {
            font-family: inherit;
        }

        .navbar {
            width: 100%;
            min-height: 75px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 28px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
            gap: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .logo img {
            height: 42px;
            width: auto;
            display: block;
        }

        .nav-menu {
            display: flex;
            gap: 28px;
            align-items: center;
            justify-content: center;
            flex: 1;
            min-width: 0;
        }

        .nav-menu a {
            text-decoration: none;
            color: #111;
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            padding: 8px 0;
        }

        .nav-menu a.active {
            border-bottom: 2px solid #1f2e4a;
        }

        .nav-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-shrink: 0;
        }

        .icon-btn {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            border: none;
            background: #f5f6fa;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #333;
            text-decoration: none;
            font-size: 16px;
            flex-shrink: 0;
        }

        .login-btn {
            background: #1f2e4a;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .profile-wrapper {
            position: relative;
            flex-shrink: 0;
        }

        .profile-btn {
            height: 42px;
            border-radius: 10px;
            border: none;
            background: #1f2e4a;
            color: white;
            padding: 0 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .profile-btn img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .dropdown {
            position: absolute;
            right: 0;
            top: 52px;
            background: white;
            width: 190px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            z-index: 9999;
            opacity: 0;
            transform: translateY(8px);
            pointer-events: none;
            transition: 0.2s ease;
        }

        .dropdown.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .dropdown a,
        .dropdown button {
            display: block;
            width: 100%;
            padding: 13px 16px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            border: none;
            background: white;
            text-align: left;
            cursor: pointer;
        }

        .dropdown a:hover,
        .dropdown button:hover {
            background: #f2f2f2;
        }

        .logout-text {
            color: red !important;
        }

        .content {
            width: 100%;
            max-width: 100%;
            padding: 0;
            overflow-x: hidden;
        }

        .content table {
            width: 100%;
        }

        .content input,
        .content select,
        .content textarea,
        .content button {
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .navbar {
                display: grid;
                grid-template-columns: 1fr auto;
                grid-template-areas:
                    "logo right"
                    "menu menu";
                align-items: center;
                padding: 12px 14px;
                gap: 10px;
            }

            .logo {
                grid-area: logo;
                justify-content: flex-start;
            }

            .logo img {
                height: 36px;
            }

            .nav-right {
                grid-area: right;
                justify-content: flex-end;
                gap: 7px;
            }

            .nav-menu {
                grid-area: menu;
                width: 100%;
                justify-content: center;
                gap: 8px;
                flex-wrap: wrap;
                padding-top: 4px;
            }

            .nav-menu a {
                font-size: 13px;
                padding: 8px 14px;
                border-radius: 999px;
                background: #f5f6fa;
            }

            .nav-menu a.active {
                border-bottom: none;
                background: #1f2e4a;
                color: white;
            }

            .icon-btn {
                width: 38px;
                height: 38px;
                font-size: 14px;
            }

            .profile-btn {
                height: 38px;
                padding: 0 9px;
            }

            .profile-btn img {
                width: 28px;
                height: 28px;
            }

            .login-btn {
                padding: 9px 15px;
                font-size: 13px;
            }

            .dropdown {
                right: 0;
                top: 46px;
            }
        }

        @media (max-width: 420px) {
            .navbar {
                padding: 10px;
            }

            .logo img {
                height: 32px;
            }

            .nav-menu a {
                font-size: 12px;
                padding: 7px 11px;
            }

            .icon-btn {
                width: 35px;
                height: 35px;
            }

            .profile-btn {
                height: 35px;
            }

            .profile-btn img {
                width: 25px;
                height: 25px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('frontend/img/logo.png') }}" alt="BlueLight Aquarium">
        </div>

        <div class="nav-menu">
            <a href="{{ route('frontend.beranda') }}" class="{{ request()->routeIs('frontend.beranda') ? 'active' : '' }}">
                Beranda
            </a>
            <a href="{{ route('frontend.products.index') }}" class="{{ request()->routeIs('frontend.products.index') ? 'active' : '' }}">
                Produk
            </a>
        </div>

        <div class="nav-right">
            @auth
            <a href="{{ route('cart.index') }}" class="icon-btn" title="Keranjang">
                <i class="fas fa-shopping-cart"></i>
            </a>

            <div class="profile-wrapper">
                <button type="button" class="profile-btn" id="profileBtn">
                    @php
                    $user = auth()->user();
                    @endphp

                    <img src="{{ $user && $user->foto 
                        ? asset('storage/' . $user->foto) 
                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&background=ffffff&color=1f2e4a' }}"
                        alt="Profile">
                    <i class="fas fa-caret-down"></i>
                </button>

                <div class="dropdown" id="profileDropdown">
                    <a href="{{ route('profile.show') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-text">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <a href="{{ route('my.orders') }}" class="icon-btn" title="Riwayat Pesanan">
                <i class="fas fa-clock-rotate-left"></i>
            </a>
            @else
            <a href="{{ route('login') }}" class="login-btn">
                Login
            </a>
            @endauth
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    <script>
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            });

            profileDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            document.addEventListener('click', function() {
                profileDropdown.classList.remove('show');
            });
        }
    </script>

</body>

</html>