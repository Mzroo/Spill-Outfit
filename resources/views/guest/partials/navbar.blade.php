<nav class="navbar-custom">

    <div class="logo">
        <div class="logo-circle">
            <i class="mdi mdi-hanger"></i>
        </div>
        <div class="logo-text">
            <h2>Spill Outfit</h2>
            <span>Fashion Recommendation</span>
        </div>
    </div>

    <div class="nav-menu">
        <a href="/">Home</a>
        <a href="{{ route('guest.produk.index') }}">Produk</a>
        <a href="{{ route('guest.about') }}">About</a>
        <a href="{{ route('guest.community') }}">Community</a>
    </div>

    <form action="{{ route('guest.produk.index') }}" method="GET" class="search-box">
        
        {{-- Mengunci kategori aktif jika user sedang memfilter kategori tertentu --}}
        @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
        @endif

        <input type="text" 
               name="search" 
               value="{{ request('search') }}" 
               placeholder="Cari outfit favoritmu..."
               autocomplete="off">

        {{-- Mengubah icon mdi menjadi tombol submit transparan --}}
        <button type="submit" class="btn-search-submit">
            <i class="mdi mdi-magnify"></i>
        </button>

    </form>

    <div class="navbar-right">
        <a href="{{ route('login') }}" class="btn-login">
            Login
        </a>
        <a href="{{ route('register') }}" class="btn-register">
            Register
        </a>
    </div>

</nav>

<style>
a {
    text-decoration: none;
}

.content {
    padding-left: 40px;
    padding-right: 40px;
}

/* ================= NAVBAR ================= */
.navbar-custom {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 80px;
    background: rgba(255, 255, 255, .95);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 30px;
    z-index: 999;
    border-bottom: 1px solid rgba(0, 0, 0, .06);
    box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
}

/* ================= LOGO ================= */
.logo {
    display: flex;
    align-items: center;
    gap: 12px;
}
.logo-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 22px;
    box-shadow: 0 5px 15px rgba(201, 162, 39, .25);
}
.logo-text {
    display: flex;
    flex-direction: column;
}
.logo-text h2 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    color: #1f1f1f;
}
.logo-text span {
    font-size: 12px;
    color: #777;
}

/* ================= MENU ================= */
.nav-menu {
    display: flex;
    align-items: center;
    gap: 30px;
}
.nav-menu a {
    color: #444;
    font-weight: 500;
    position: relative;
    transition: .3s;
}
.nav-menu a:hover {
    color: #8C6A2F;
}
.nav-menu a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 0%;
    height: 2px;
    background: #C9A227;
    transition: .3s;
}
.nav-menu a:hover::after {
    width: 100%;
}

/* ================= SEARCH (FORM CONTROL) ================= */
.search-box {
    width: 320px;
    position: relative;
    margin: 0; /* Mengamankan posisi form di flexbox navbar */
}
.search-box input {
    width: 100%;
    height: 48px;
    border: none;
    outline: none;
    border-radius: 50px;
    background: #efefef;
    padding: 0 50px 0 20px;
    font-size: 15px;
    transition: .3s;
}
.search-box input:focus {
    background: white;
    border: 1px solid #e3d5ba;
    box-shadow: 0 0 0 4px rgba(201, 162, 39, .12);
}

/* TOMBOL SUBMIT SILUMAN DI ATAS ICON MDI */
.btn-search-submit {
    position: absolute;
    right: 6px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    outline: none;
    cursor: pointer;
    width: 36px;
    height: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color: #888;
    transition: all 0.2s;
}
.btn-search-submit i {
    font-size: 22px;
    transition: .2s;
}
.btn-search-submit:hover i {
    color: #8C6A2F;
    transform: scale(1.1);
}

/* ================= RIGHT MENU ================= */
.navbar-right {
    display: flex;
    align-items: center;
    gap: 15px;
}
.btn-login {
    padding: 11px 24px;
    border-radius: 50px;
    border: 1px solid #d6d6d6;
    color: #444;
    font-weight: 500;
    transition: .3s;
}
.btn-login:hover {
    border-color: #8C6A2F;
    color: #8C6A2F;
}
.btn-register {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    transition: .3s;
}
.btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(201, 162, 39, .25);
    color: white;
}
</style>