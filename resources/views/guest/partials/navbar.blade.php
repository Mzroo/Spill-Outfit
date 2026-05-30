
<!-- NAVBAR -->
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

    <!-- MENU -->
    <div class="nav-menu">

        <a href="/">Home</a>
        <a href="{{ route('guest.produk.index') }}">Produk</a>
        <a href="{{ route('guest.about') }}">About</a>
        <a href="{{ route('guest.community') }}">Community</a>

    </div>

    <!-- SEARCH -->
    <div class="search-box">

        <input type="text"
               placeholder="Cari outfit favoritmu...">

        <i class="mdi mdi-magnify"></i>

    </div>

    <!-- RIGHT -->
    <div class="navbar-right">

        <a href="{{ route('login') }}"
           class="btn-login">

            Login

        </a>

        <a href="{{ route('register') }}"
           class="btn-register">

            Register

        </a>

    </div>

</nav>

<style>

/* ================= NAVBAR ================= */

.navbar-custom{
    position:fixed;
    top:0;
    left:0;
    right:0;

    height:80px;

    background:rgba(255,255,255,.95);

    backdrop-filter:blur(10px);

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:0 30px;

    z-index:999;

    border-bottom:1px solid rgba(0,0,0,.06);
    box-shadow:0 4px 20px rgba(0,0,0,.05);
}

/* ================= LOGO ================= */

.logo{
    display:flex;
    align-items:center;
    gap:12px;
}

.logo-circle{
    width:48px;
    height:48px;

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

    box-shadow:0 5px 15px rgba(201,162,39,.25);
}

.logo-text{
    display:flex;
    flex-direction:column;
}

.logo-text h2{
    margin:0;
    font-size:24px;
    font-weight:700;
    color:#1f1f1f;
    
}

.logo-text span{
    font-size:12px;
    color:#777;
}

/* ================= MENU ================= */

.nav-menu{
    display:flex;
    align-items:center;
    gap:30px;
}

.nav-menu a{
    color:#444;
    font-weight:500;
    position:relative;
    transition:.3s;
}

.nav-menu a:hover{
    color:#8C6A2F;
}

.nav-menu a::after{
    content:'';
    position:absolute;
    left:0;
    bottom:-6px;

    width:0%;
    height:2px;

    background:#C9A227;
    transition:.3s;
}

.nav-menu a:hover::after{
    width:100%;
}

/* ================= SEARCH ================= */

.search-box{
    width:320px;
    position:relative;
}

.search-box input{
    width:100%;
    height:48px;

    border:none;
    outline:none;

    border-radius:50px;

    background:#efefef;

    padding:0 50px 0 20px;

    font-size:15px;
    transition:.3s;
}

.search-box input:focus{
    background:white;
    box-shadow:0 0 0 4px rgba(201,162,39,.12);
}

.search-box i{
    position:absolute;
    right:18px;
    top:50%;
    transform:translateY(-50%);

    font-size:22px;
    color:#888;
}

/* ================= RIGHT MENU ================= */

.navbar-right{
    display:flex;
    align-items:center;
    gap:15px;
}

/* LOGIN BUTTON */

.btn-login{
    padding:11px 24px;

    border-radius:50px;

    border:1px solid #d6d6d6;

    color:#444;

    font-weight:500;
    transition:.3s;
}

.btn-login:hover{
    border-color:#8C6A2F;
    color:#8C6A2F;
}

/* REGISTER BUTTON */

.btn-register{
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    padding:12px 28px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.btn-register:hover{
    transform:translateY(-2px);

    box-shadow:
    0 8px 25px rgba(201,162,39,.25);

    color:white;
}
</style>