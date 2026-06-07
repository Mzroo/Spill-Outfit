<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Spill Outfit')</title>

    {{-- Icon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/outfit.svg') }}">

    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ================= UTILITIES & GLOBAL RESET ================= */
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body {
            background-color: #fcfbfa;
            overflow-x: hidden;
        }

        a{
            text-decoration:none;
            color: inherit;
        }

        /* ================= NAVBAR DESIGN ================= */
        .navbar-custom{
            position:fixed;
            top:0;
            left:0;
            right:0;
            height:80px;
            background: white;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding: 0 16px;
            z-index:1000;
            box-shadow:0 4px 20px rgba(0,0,0,0.04);
        }

        @media(min-width: 768px) {
            .navbar-custom { padding: 0 30px; }
        }

        .logo{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .logo-circle{
            width:42px;
            height:42px;
            border-radius:50%;
            background: linear-gradient(135deg, #8C6A2F, #C9A227);
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            font-size:20px;
            flex-shrink: 0;
        }

        .logo-text h2{
            margin:0;
            font-size:18px;
            font-weight:800;
            color:#2d2a24;
            line-height: 1.2;
        }

        .logo-text span{
            font-size:11px;
            color:#a39782;
        }

        @media(min-width: 576px) {
            .logo-text h2 { font-size: 22px; }
            .logo-text span { font-size: 12px; }
        }

        /* SEARCH BAR RESPONSIVE MECHANISM */
        .search-box-wrapper {
            flex-grow: 1;
            max-width: 450px;
            margin: 0 20px;
            display: none; /* Default sembunyi di HP kecil */
        }

        @media(min-width: 768px) {
            .search-box-wrapper { display: block; }
        }

        .search-box{
            position:relative;
            width: 100%;
        }

        .search-box input{
            width:100%;
            height:44px;
            border: 1px solid #f2ebd9;
            outline:none;
            border-radius:50px;
            background:#fdfcfb;
            padding:0 45px 0 20px;
            font-size:14px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            border-color: #8C6A2F;
            background: #white;
            box-shadow: 0 0 0 4px rgba(140, 106, 47, 0.1);
        }

        .search-box button{
            position:absolute;
            right:5px;
            top:50%;
            transform:translateY(-50%);
            background: none;
            border: none;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color:#8C6A2F;
            transition: 0.2s;
        }
        
        .search-box button:hover {
            background-color: #faf6ed;
        }

        /* RIGHT MENU ACTION */
        .navbar-right{
            display:flex;
            align-items:center;
            gap:10px;
        }

        @media(min-width: 576px) {
            .navbar-right { gap: 14px; }
        }

        .nav-btn{
            width:40px;
            height:40px;
            border-radius:50%;
            background:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
            color:#8C6A2F;
            font-size:20px;
            box-shadow:0 4px 10px rgba(140, 106, 47, 0.08);
            border: 1px solid #faf6ed;
            transition: all 0.2s;
        }

        .nav-btn:hover{
            background:#8C6A2F;
            color:white !important;
            transform: translateY(-2px);
        }

        .cart-badge{
            position:absolute;
            top:-4px;
            right:-4px;
            background:#dc3545;
            color:#fff;
            min-width:18px;
            height:18px;
            border-radius:50%;
            font-size:10px;
            font-weight:700;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:0 4px;
            border: 2px solid white;
        }

        .profile{
            display:flex;
            align-items:center;
            gap:8px;
            cursor:pointer;
            padding: 4px 8px;
            border-radius: 50px;
            transition: background 0.2s;
        }

        .profile:hover {
            background-color: #faf6ed;
        }

        .profile img{
            width:38px;
            height:38px;
            border-radius:50%;
            object-fit:cover;
            border: 2px solid #ebdcb9;
        }

        .profile h6{
            margin:0;
            font-size:14px;
            font-weight:600;
            color: #2d2a24;
            display: none; /* Sembunyikan nama di HP biar hemat ruang */
        }

        @media(min-width: 992px) {
            .profile h6 { display: block; }
        }

        /* ================= BASE CONTAINER WRAPPER ================= */
        .main{
            display:flex;
            margin-top:80px;
            min-height: calc(100vh - 80px);
        }

        /* ================= SIDEBAR SYSTEM (RESPONSIVE FOCUS) ================= */
        .sidebar{
            position:fixed;
            top:80px;
            left:0;
            width:75px;
            height:calc(100vh - 80px);
            background:white;
            transition: transform 0.3s ease, width 0.3s ease;
            overflow-y:auto;
            overflow-x:hidden;
            box-shadow:4px 0 20px rgba(0,0,0,0.02);
            z-index:999;
        }

        /* Desktop Mode: Klik Mengecil / Membesar */
        @media(min-width: 992px) {
            .sidebar.active { width: 240px; }
        }

        /* Mobile Mode: Disembunyikan ke kiri layar, muncul sebagai overlay */
        @media(max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                width: 240px;
                box-shadow: 10px 0 30px rgba(0,0,0,0.1);
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }

        .sidebar-menu{
            padding: 15px 0;
        }

        .sidebar-item{
            width:100%;
            height:54px;
            display:flex;
            align-items:center;
            padding:0 25px;
            color:#5c554a;
            transition: all 0.2s;
            cursor:pointer;
        }

        .sidebar-item:hover, .sidebar-item.ui-active{
            background:#faf6ed;
            color: #8C6A2F;
            font-weight: 600;
        }

        .sidebar-item i{
            min-width:35px;
            font-size:22px;
        }

        .sidebar-text{
            white-space:nowrap;
            opacity:0;
            pointer-events: none;
            transition: opacity 0.2s;
        }

        /* Text sidebar muncul hanya jika sidebar aktif di desktop atau saat di mobile */
        @media(max-width: 991.98px) {
            .sidebar-text { opacity: 1; pointer-events: auto; }
        }
        .sidebar.active .sidebar-text{
            opacity:1;
            pointer-events: auto;
        }

        /* BACKDROP OVERLAY DI MOBILE */
        .sidebar-overlay {
            position: fixed;
            top: 80px; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.3);
            backdrop-filter: blur(2px);
            z-index: 998;
            display: none;
        }
        @media(max-width: 991.98px) {
            .sidebar-overlay.active { display: block; }
        }

        /* ================= CONTENT MAIN SECTION ================= */
        .content{
            margin-left: 0; /* Mobile default */
            width:100%;
            padding: 16px;
            transition: margin-left 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @media(min-width: 576px) { .content { padding: 30px; } }

        /* Jarak margin kiri hanya berlaku di desktop */
        @media(min-width: 992px) {
            .content { margin-left: 75px; width: calc(100% - 75px); }
            .content.active { margin-left: 240px; width: calc(100% - 240px); }
        }

        /* ================= FOOTER PREMIUM SYSTEM ================= */
        .footer{
            margin-top:60px;
            background: linear-gradient(135deg, #8C6A2F, #705423);
            border-radius:24px;
            padding: 30px 20px;
            color:white;
        }

        @media(min-width: 768px) {
            .footer { padding: 40px; border-radius: 30px; }
        }

        .footer-logo h2{
            font-weight:800;
            font-size: 24px;
            margin-bottom:12px;
        }

        .footer-logo p{
            color:#f2ebd9;
            max-width:320px;
            line-height:1.6;
            font-size: 13px;
        }

        .footer-menu h5{
            margin-bottom:18px;
            font-weight:700;
            font-size: 16px;
            color: #ebdcb9;
        }

        .footer-menu a{
            display:block;
            margin-bottom:12px;
            color:#f2ebd9;
            font-size: 14px;
            transition:0.2s;
        }

        .footer-menu a:hover{
            color:white;
            transform:translateX(4px);
        }

        .footer-bottom{
            margin-top:40px;
            padding-top:20px;
            border-top:1px solid rgba(255,255,255,0.15);
            text-align:center;
            color:#ebdcb9;
            font-size: 13px;
        }

        /* ================= PROFILE DROPDOWN SYSTEM ================= */
        .profile-dropdown{
            position:relative;
        }

        .dropdown-menu-custom{
            position:absolute;
            top:60px;
            right:0;
            width:220px;
            background:white;
            border-radius:16px;
            padding:8px;
            box-shadow: 0 10px 30px rgba(140, 106, 47, 0.15);
            opacity:0;
            visibility:hidden;
            transform:translateY(10px);
            transition:0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index:1001;
            border: 1px solid #f2ebd9;
        }

        .dropdown-menu-custom.active{
            opacity:1;
            visibility:visible;
            transform:translateY(0);
        }

        .dropdown-menu-custom a,
        .dropdown-menu-custom button{
            width:100%;
            border:none;
            background:none;
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 16px;
            border-radius:12px;
            color:#4a453c;
            transition:0.2s;
            text-decoration:none;
            font-size:14px;
            text-align: left;
            cursor:pointer;
        }

        .dropdown-menu-custom a:hover,
        .dropdown-menu-custom button:hover{
            background:#faf6ed;
            color:#8C6A2F;
        }

        .dropdown-menu-custom i{
            font-size:20px;
            color: #a39782;
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="navbar-custom">
        
        <div class="logo">
            <button id="menu-toggle" class="nav-btn me-1 d-flex align-items-center justify-content-center" style="border:none;">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="logo-circle d-none d-sm-flex">
                <i class="mdi mdi-hanger"></i>
            </div>

            <div class="logo-text">
                <h2>Spill Outfit</h2>
                <span>Fashion Recommendation</span>
            </div>
        </div>

        <div class="search-box-wrapper">
            <form action="{{ route('user.search') }}" method="GET" class="search-box">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari outfit favoritmu...">
                <button type="submit">
                    <i class="mdi mdi-magnify fs-5"></i>
                </button>
            </form>
        </div>

        <div class="navbar-right">
            
            <button class="nav-btn d-md-none" data-bs-toggle="collapse" data-bs-target="#mobileSearchCollapse">
                <i class="mdi mdi-magnify"></i>
            </button>

            <a href="{{ route('keranjang.index') }}" class="nav-btn">
                <i class="mdi mdi-cart-outline"></i>
                @auth
                    @php
                        $jumlahKeranjang = \App\Models\Keranjang::where('user_id', auth()->id())->count();
                    @endphp
                    @if($jumlahKeranjang > 0)
                        <span class="cart-badge">{{ $jumlahKeranjang }}</span>
                    @endif
                @endauth
            </a>

            <div class="nav-btn d-none d-sm-flex">
                <i class="mdi mdi-bell-outline"></i>
            </div>

            <div class="profile-dropdown">
                <div class="profile" id="profileToggle">
                    @if(auth()->user()->avatar)
                        {{-- Cek apakah foto berasal dari Google Login (http) atau upload lokal --}}
                        <img src="{{ str_starts_with(auth()->user()->avatar, 'http') ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}" alt="Avatar">
                    @else
                        {{-- Menggunakan DiceBear API yang dinamis sesuai nama user jika belum ada foto --}}
                        <img src="https://api.dicebear.com/7.x/fun-emoji/svg?seed={{ urlencode(auth()->user()->name) }}" alt="Default Avatar">
                    @endif
                    
                    {{-- Langsung panggil nama user dari tabel users --}}
                    <h6>{{ auth()->user()->name }}</h6>
                    <i class="mdi mdi-chevron-down text-muted small"></i>
                </div>
            </div>

                <div class="dropdown-menu-custom" id="dropdownMenu">
                    <a href="{{ route('settings') }}">
                        <i class="mdi mdi-cog-outline"></i> Settings
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit">
                            <i class="mdi mdi-logout text-danger"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="collapse bg-white border-bottom p-3 position-fixed w-100 d-md-none shadow-sm" id="mobileSearchCollapse" style="top:80px; z-index:1001;">
        <form action="{{ route('user.search') }}" method="GET" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-pill" placeholder="Cari pakaian...">
            <button type="submit" class="btn btn-gold text-white position-absolute end-0 top-50 translate-middle-y me-2 rounded-circle d-flex align-items-center justify-content-center" style="width:34px; height:34px; background:#8C6A2F;">
                <i class="mdi mdi-magnify"></i>
            </button>
        </form>
    </div>

    <div class="main">

        <div class="sidebar" id="sidebar">
            <div class="sidebar-menu">

                <a href="{{ route('user.dashboard') }}" class="sidebar-item {{ request()->routeIs('user.dashboard') ? 'ui-active' : '' }}">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>

                <a href="{{ route('produk.index') }}" class="sidebar-item {{ request()->routeIs('produk.index') ? 'ui-active' : '' }}">
                    <i class="mdi mdi-shopping"></i>
                    <span class="sidebar-text">Produk</span>
                </a>

                <a href="{{ route('user.kategori.index') }}" class="sidebar-item {{ request()->routeIs('user.kategori.index') ? 'ui-active' : '' }}">
                    <i class="mdi mdi-shape"></i>
                    <span class="sidebar-text">Kategori</span>
                </a>

                <a href="{{ route('chat.index') }}" class="sidebar-item {{ request()->routeIs('chat.index') ? 'ui-active' : '' }}">
                    <i class="mdi mdi-chat-processing"></i>
                    <span class="sidebar-text">Chat</span>
                </a>

                <a href="{{ route('about') }}" class="sidebar-item {{ request()->routeIs('about') ? 'ui-active' : '' }}">
                    <i class="mdi mdi-information-outline"></i>
                    <span class="sidebar-text">About</span>
                </a>

                <a href="{{ route('community.index') }}" class="sidebar-item {{ request()->routeIs('community.index') ? 'ui-active' : '' }}">
                    <i class="mdi mdi-account-group"></i>
                    <span class="sidebar-text">Community</span>
                </a>

                <a href="{{ route('settings') }}" class="sidebar-item {{ request()->routeIs('settings') ? 'ui-active' : '' }}">
                    <i class="mdi mdi-cog-outline"></i>
                    <span class="sidebar-text">Settings</span>
                </a>

            </div>
        </div>

        <div class="content" id="content">
            
            <div class="content-body-render">
                @yield('content')
            </div>

            <div class="footer">
                <div class="row g-4">
                    <div class="col-lg-5 col-md-6">
                        <div class="footer-logo">
                            <h2>Spill Outfit</h2>
                            <p>Temukan inspirasi outfit terbaik untuk aktivitas harianmu. Fashion lebih mudah, stylish, dan modern.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="footer-menu">
                            <h5>Menu</h5>
                            <a href="{{ route('user.dashboard') }}">Home</a>
                            <a href="{{ route('produk.index') }}">Produk</a>
                            <a href="{{ route('user.kategori.index') }}">Kategori</a>
                            <a href="{{ route('about') }}">About</a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-3 col-6">
                        <div class="footer-menu">
                            <h5>Kontak</h5>
                            <a href="#"><i class="mdi mdi-instagram me-1"></i> Instagram</a>
                            <a href="#"><i class="mdi mdi-whatsapp me-1"></i> Whatsapp</a>
                            <a href="#"><i class="mdi mdi-email-outline me-1"></i> Email</a>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    &copy; 2026 Spill Outfit - All Rights Reserved
                </div>
            </div>

        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggle = document.getElementById('menu-toggle');
        const overlay = document.getElementById('sidebarOverlay');

        // Fungsi buka-tutup sidebar
        function toggleSidebar() {
            sidebar.classList.toggle('active');
            content.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        toggle.onclick = toggleSidebar;
        overlay.onclick = toggleSidebar;

        // Profile Dropdown Handler
        const profileToggle = document.getElementById('profileToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileToggle.onclick = function(e){
            e.stopPropagation();
            dropdownMenu.classList.toggle('active');
        }

        // Tutup dropdown otomatis jika klik di luar area
        window.addEventListener('click', function(e){
            if(!profileToggle.contains(e.target) && !dropdownMenu.contains(e.target)){
                dropdownMenu.classList.remove('active');
            }
        });
    </script>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>