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

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .navbar {
            min-height: 75px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo img {
            height: 42px;
        }

        .nav-menu {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #111;
            font-weight: 600;
            font-size: 14px;
        }

        .nav-menu a.active {
            border-bottom: 2px solid #1f2e4a;
            padding-bottom: 5px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .icon-btn {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            border: none;
            background: #f5f6fa;
            cursor: pointer;
            display: flex;
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
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
        }

        .profile-wrapper {
            position: relative;
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
        }

        .profile-btn img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
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
            z-index: 999;
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
            padding: 20px;
            width: 100%;
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: stretch;
                padding: 15px;
            }

            .logo {
                text-align: center;
            }

            .nav-menu {
                justify-content: center;
                flex-wrap: wrap;
                gap: 18px;
            }

            .nav-right {
                justify-content: center;
            }

            .content {
                padding: 15px;
            }

            .login-btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .nav-menu a {
                font-size: 13px;
            }

            .icon-btn {
                width: 38px;
                height: 38px;
                font-size: 14px;
            }

            .profile-btn {
                height: 38px;
            }

            .content {
                padding: 10px;
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
    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&background=ffffff&color=1f2e4a' }}">
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
    </script>

</body>

</html>