<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Spill Outfit')</title>

    {{-- Icon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/outfit.svg') }}">

    <!-- Bootstrap -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Font Alsome --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <!-- Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        a{
            text-decoration:none;
        }

        /* ================= NAVBAR ================= */

        .navbar-custom{
            position:fixed;
            top:0;
            left:0;
            right:0;

            height:80px;

            background:white;

            display:flex;
            align-items:center;
            justify-content:space-between;

            padding:0 30px;

            z-index:999;

            box-shadow:0 4px 20px rgba(0,0,0,0.06);
        }

        /* LOGO */

        .logo{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .logo-circle{
            width:45px;
            height:45px;

            border-radius:50%;

                background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

            display:flex;
            justify-content:center;
            align-items:center;

            color:white;
            font-size:22px;
        }

        .logo-text{
            display:flex;
            flex-direction:column;
        }

        .logo-text h2{
            margin:0;
            font-size:24px;
            font-weight:700;
            color:#222;
        }

        .logo-text span{
            font-size:12px;
            color:#888;
        }

        /* SEARCH */

        .search-box{
            width:40%;
            position:relative;
        }

        .search-box input{
            width:100%;
            height:48px;

            border:none;
            outline:none;

            border-radius:50px;

            background:#f1f3f6;

            padding:0 50px 0 20px;

            font-size:15px;
        }

        .search-box i{
            position:absolute;
            right:18px;
            top:50%;
            transform:translateY(-50%);

            font-size:22px;
            color:#777;
        }

        /* RIGHT MENU */

        .navbar-right{
            display:flex;
            align-items:center;
            gap:15px;
        }
.nav-btn{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
    color:#8C6A2F;
    font-size:22px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.cart-badge{
    position:absolute;
    top:-6px;
    right:-6px;
    background:#dc3545;
    color:#fff;
    min-width:20px;
    height:20px;
    border-radius:50%;
    font-size:12px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:0 5px;
}


        .nav-btn:hover{
            background:#C9A227;
            color:white;
        }

        .profile{
            display:flex;
            align-items:center;
            gap:10px;

            cursor:pointer;
        }

        .profile img{
            width:45px;
            height:45px;

            border-radius:50%;

            object-fit:cover;
        }

        .profile h6{
            margin:0;
            font-size:15px;
            font-weight:600;
        }

        /* ================= MAIN ================= */

        .main{
            display:flex;
            margin-top:80px;
        }

        /* ================= SIDEBAR ================= */

        .sidebar{
            position:fixed;
            top:80px;
            left:0;

            width:85px;
            height:100vh;

            background:white;

            transition:0.3s;

            overflow:hidden;

            box-shadow:4px 0 20px rgba(0,0,0,0.05);

            z-index:998;
        }

        .sidebar.active{
            width:240px;
        }

        .sidebar-menu{
            padding-top:20px;
        }

        .sidebar-item{
            width:100%;
            height:65px;

            display:flex;
            align-items:center;

            padding:0 25px;

            color:#444;

            transition:0.3s;

            cursor:pointer;
        }


        .sidebar-item:hover{
            background:#f5f7fb;
            color: #C9A227;
        }

        .sidebar-item i{
            min-width:35px;
            font-size:24px;
        }

        .sidebar-text{
            white-space:nowrap;
            opacity:0;

            transition:0.3s;
        }

        .sidebar.active .sidebar-text{
            opacity:1;
        }

        /* ================= CONTENT ================= */

        .content{
            margin-left:85px;

            width:100%;

            padding:30px;

            transition:0.3s;
        }

        .content.active{
            margin-left:240px;
        }

        /* ================= FOOTER ================= */

        .footer{
            margin-top:50px;

            background:
                linear-gradient(
                    135deg,
                    #8C6A2F,
                    #C9A227
                );

            border-radius:30px;

            padding:40px;

            color:white;
        }

        .footer-wrapper{
            display:flex;
            justify-content:space-between;
            flex-wrap:wrap;
            gap:30px;
        }

        .footer-logo h2{
            font-weight:700;
            margin-bottom:10px;
        }

        .footer-logo p{
            color:#dcdcdc;
            max-width:300px;
            line-height:1.7;
        }

        .footer-menu h5{
            margin-bottom:15px;
            font-weight:600;
        }

        .footer-menu a{
            display:block;
            margin-bottom:10px;

            color:#dcdcdc;

            transition:0.3s;
        }

        .footer-menu a:hover{
            color:white;
            transform:translateX(5px);
        }

        .footer-bottom{
            margin-top:30px;
            padding-top:20px;

            border-top:1px solid rgba(255,255,255,0.2);

            text-align:center;

            color:#dcdcdc;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:768px){

            .search-box{
                display:none;
            }

            .content{
                padding:20px;
            }

            .sidebar.active{
                width:200px;
            }

            .content.active{
                margin-left:200px;
            }

        }
        /* ================= PROFILE DROPDOWN ================= */

        .profile-dropdown{
            position:relative;
        }

        /* MENU */

        .dropdown-menu-custom{
            position:absolute;

            top:65px;
            right:0;

            width:220px;

            background:white;

            border-radius:20px;

            padding:12px;

            box-shadow:
            0 10px 30px rgba(0,0,0,0.08);

            opacity:0;
            visibility:hidden;

            transform:translateY(10px);

            transition:0.3s;

            z-index:999;
        }

        /* ACTIVE */

        .dropdown-menu-custom.active{
            opacity:1;
            visibility:visible;

            transform:translateY(0);
        }

        /* LINK */

        .dropdown-menu-custom a,
        .dropdown-menu-custom button{
            width:100%;

            border:none;
            background:none;

            display:flex;
            align-items:center;

            gap:12px;

            padding:14px 16px;

            border-radius:14px;

            color:#444;

            transition:0.3s;

            text-decoration:none;

            font-size:15px;

            cursor:pointer;
        }

        /* HOVER */

        .dropdown-menu-custom a:hover,
        .dropdown-menu-custom button:hover{
            background:#f5f7fb;

            color:#313E17;
        }

        /* ICON */

        .dropdown-menu-custom i{
            font-size:22px;
        }

    </style>

</head>
<body>

    <!-- ================= NAVBAR ================= -->

    <div class="navbar-custom">

        <!-- LOGO -->
        <div class="logo">

            <div class="logo-circle">
                <i class="mdi mdi-hanger"></i>
            </div>

            <div class="logo-text">
                <h2>Spill Outfit</h2>
                <span>Fashion Recommendation</span>
            </div>

        </div>

        <!-- SEARCH -->
        <div class="search-box">
            <input type="text" placeholder="Cari outfit favoritmu...">
            <i class="mdi mdi-magnify"></i>
        </div>

        <!-- RIGHT -->
        <div class="navbar-right">

        
            <a href="{{ route('keranjang.index') }}"
            class="nav-btn position-relative text-decoration-none">

                <i class="mdi mdi-cart-outline"></i>

                @auth
                    @php
                        $jumlahKeranjang = \App\Models\Keranjang::where(
                            'user_id',
                            auth()->id()
                        )->count();
                    @endphp

                    @if($jumlahKeranjang > 0)
                        <span class="cart-badge">
                            {{ $jumlahKeranjang }}
                        </span>
                    @endif
                @endauth

            </a>


            <div class="nav-btn">
                <i class="mdi mdi-bell-outline"></i>
            </div>

            <div class="profile-dropdown">

                <!-- PROFILE -->

                <div class="profile" id="profileToggle">

                    @if(auth()->user()->profile?->foto)

                        <img src="{{ asset('storage/' . auth()->user()->profile->foto) }}">

                    @else

                        <img src="https://i.pravatar.cc/150?img=12">

                    @endif

                    <h6>

                        {{ auth()->user()->profile?->nama_penerima ?? auth()->user()->name }}

                    </h6>

                    <i class="mdi mdi-chevron-down"></i>

                </div>

                <!-- DROPDOWN -->

                <div class="dropdown-menu-custom" id="dropdownMenu">

                    <!-- SETTINGS -->

                    <a href="{{ route('settings') }}">

                        <i class="mdi mdi-cog-outline"></i>

                        Settings

                    </a>

                    <!-- LOGOUT -->

                    <form action="{{ route('logout') }}"
                        method="POST">

                        @csrf

                        <button type="submit">

                            <i class="mdi mdi-logout"></i>

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- ================= MAIN ================= -->

    <div class="main">

        <!-- SIDEBAR -->

        <div class="sidebar" id="sidebar">

            <div class="sidebar-menu">

                <div class="sidebar-item" id="menu-toggle">
                    <i class="mdi mdi-menu"></i>
                    <span class="sidebar-text">Menu</span>
                </div>

                <a href="{{ route('user.dashboard') }}" class="sidebar-item">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    <span class="sidebar-text">
                        Dashboard
                    </span>
                </a>

                <a href="{{ route('produk.index') }}" class="sidebar-item">
                <i class="mdi mdi-shopping"></i>
                    <span class="sidebar-text">Produk</span>
                </a>

                <a href="{{ route('user.kategori.index') }}" class="sidebar-item">
                    <i class="mdi mdi-shape"></i>
                    <span class="sidebar-text">Kategori</span>

                </a>

                <a href="{{ route('chat.index') }}" class="sidebar-item">
                    <i class="mdi mdi-chat-processing"></i>
                <span class="sidebar-text">Chat</span>
                </a>

               <a href="{{ route('about') }}" class="sidebar-item">
                <i class="mdi mdi-information-outline"></i>
                <span class="sidebar-text">About</span>
                </a>

                <a href="{{ route('community.index') }}" class="sidebar-item">
                    <i class="mdi mdi-account-group"></i>
                    <span class="sidebar-text">Community</span>
                </a>

                <a href="{{ route('settings') }}" class="sidebar-item">

                    <i class="mdi mdi-cog-outline"></i>

                    <span class="sidebar-text">
                        Settings
                    </span>

                </a>

            </div>

        </div>

        <!-- CONTENT -->

        <div class="content" id="content">

            @yield('content')

            <!-- FOOTER -->

            <div class="footer">

                <div class="footer-wrapper">

                    <div class="footer-logo">

                        <h2>Spill Outfit</h2>

                        <p>
                            Temukan inspirasi outfit terbaik untuk aktivitas harianmu.
                            Fashion lebih mudah, stylish, dan modern.
                        </p>

                    </div>

                    <div class="footer-menu">

                        <h5>Menu</h5>

                        <a href="{{ route('user.dashboard') }}">Home</a>
                        <a href="">Produk</a>
                        <a href="">Kategori</a>
                        <a href="">About</a>

                    </div>

                    <div class="footer-menu">

                        <h5>Kontak</h5>

                        <a href="">Instagram</a>
                        <a href="">Whatsapp</a>
                        <a href="">Email</a>

                    </div>

                </div>

                <div class="footer-bottom">
                    © 2026 Spill Outfit - All Rights Reserved
                </div>

            </div>

        </div>

    </div>

    <!-- ================= JS ================= -->

    <script>

        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggle = document.getElementById('menu-toggle');

        toggle.onclick = function(){

            sidebar.classList.toggle('active');
            content.classList.toggle('active');

        }
                // ================= PROFILE DROPDOWN =================

        const profileToggle = document.getElementById('profileToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileToggle.onclick = function(){

            dropdownMenu.classList.toggle('active');

        }

        // CLOSE OUTSIDE

        window.addEventListener('click', function(e){

            if(
                !profileToggle.contains(e.target)
                &&
                !dropdownMenu.contains(e.target)
            ){

                dropdownMenu.classList.remove('active');

            }

        });

    </script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>

</body>
</html>