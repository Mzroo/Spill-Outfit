```html
<!-- ================= SIDEBAR ================= -->
<div id="sidebar" class="sidebar">

    <!-- LOGO -->
    <div class="sidebar-logo">

        <div class="logo-circle">
            <i class="fa-solid fa-shirt"></i>
        </div>

        <div class="logo-text">
            <h4>
                Spill <span>Outfit</span>
            </h4>

            <small>Fashion Admin</small>
        </div>

    </div>

    <!-- MENU -->
    <div class="sidebar-menu">

        <!-- DASHBOARD -->
        <a
            href="{{ route('admin.dashboard') }}"
            class="sidebar-link active"
        >
            <div class="menu-left">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </div>
        </a>

        <!-- ================= PRODUK ================= -->
        <a
            class="sidebar-link"
            data-bs-toggle="collapse"
            href="#produkMenu"
            role="button"
        >
            <div class="menu-left">
                <i class="fa-solid fa-shirt"></i>
                <span>Produk</span>
            </div>

            <i class="fa-solid fa-chevron-down arrow"></i>
        </a>

        <div class="collapse submenu" id="produkMenu">

            <a href="{{ route('admin.produk.index') }}">
                <i class="fa-solid fa-box"></i>
                <span>Semua Produk</span>
            </a>

            <a href="{{ route('admin.produk-varian.index') }}"
             class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-layer-group"></i>
                <span>Produk Varian</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}">
                <i class="fa-solid fa-tags"></i>
                <span>Kategori</span>
            </a>

            <a href="{{ route('admin.brand.index') }}">
                <i class="fa-solid fa-copyright"></i>
                <span>Brand</span>
            </a>

            <a href="{{ route('admin.ukuran.index') }}">
                <i class="fa-solid fa-ruler"></i>
                <span>Ukuran</span>
            </a>

            <a href="{{ route('admin.warna.index')}}">
                <i class="fa-solid fa-palette"></i>
                <span>Warna</span>
            </a>

        </div>

        <!-- ================= TRANSAKSI ================= -->
        <a
            class="sidebar-link"
            data-bs-toggle="collapse"
            href="#transaksiMenu"
            role="button"
        >
            <div class="menu-left">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Transaksi</span>
            </div>

            <i class="fa-solid fa-chevron-down arrow"></i>
        </a>

        <div class="collapse submenu" id="transaksiMenu">

            <a href="#">
                <i class="fa-solid fa-receipt"></i>
                <span>Pesanan</span>
            </a>

            <a href="#">
                <i class="fa-solid fa-credit-card"></i>
                <span>Pembayaran</span>
            </a>

            <a href="#">
                <i class="fa-solid fa-circle-check"></i>
                <span>Konfirmasi</span>
            </a>

            <a href="#">
                <i class="fa-solid fa-truck"></i>
                <span>Pengiriman</span>
            </a>

        </div>

        <!-- ================= CUSTOMER ================= -->
        <a
            class="sidebar-link"
            data-bs-toggle="collapse"
            href="#customerMenu"
            role="button"
        >
            <div class="menu-left">
                <i class="fa-solid fa-users"></i>
                <span>Customer</span>
            </div>

            <i class="fa-solid fa-chevron-down arrow"></i>
        </a>

        <div class="collapse submenu" id="customerMenu">

            <a href="#">
                <i class="fa-solid fa-user"></i>
                <span>Data Customer</span>
            </a>

            <a href="#">
                <i class="fa-solid fa-heart"></i>
                <span>Wishlist</span>
            </a>

            <a href="#">
                <i class="fa-solid fa-cart-plus"></i>
                <span>Keranjang</span>
            </a>

            <a href="#">
                <i class="fa-solid fa-star"></i>
                <span>Review</span>
            </a>

        </div>

        <!-- LAPORAN -->
        <a href="#" class="sidebar-link">

            <div class="menu-left">
                <i class="fa-solid fa-chart-line"></i>
                <span>Laporan</span>
            </div>

        </a>

        <!-- PENGATURAN -->
        <a href="#" class="sidebar-link">

            <div class="menu-left">
                <i class="fa-solid fa-gear"></i>
                <span>Pengaturan</span>
            </div>

        </a>

    </div>

</div>

<style>

/* ================= SIDEBAR ================= */

.sidebar{

    position: fixed;
    top: 0;
    left: 0;

    width: 290px;
    height: 100vh;

    background: #fff;

    border-right: 1px solid #f3ead8;

    padding: 28px 20px;

    overflow-y: auto;

    z-index: 1000;

    transition: .3s ease;

    box-shadow:
    0 8px 30px rgba(0,0,0,.05);

}

/* HIDE */

.sidebar.hide{

    transform: translateX(-100%);

}

/* ================= LOGO ================= */

.sidebar-logo{

    display: flex;
    align-items: center;
    gap: 15px;

    margin-bottom: 40px;

}

.logo-circle{

    width: 56px;
    height: 56px;

    border-radius: 18px;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    display: flex;
    align-items: center;
    justify-content: center;

    color: #fff;

    font-size: 22px;

}

.logo-text h4{

    margin: 0;

    font-size: 22px;
    font-weight: 700;

}

.logo-text span{

    color: #B68D40;

}

.logo-text small{

    color: #888;

}

/* ================= MENU ================= */

.sidebar-menu{

    display: flex;
    flex-direction: column;

    gap: 10px;

}

.sidebar-link{

    display: flex;
    justify-content: space-between;
    align-items: center;

    text-decoration: none;

    padding: 15px 18px;

    border-radius: 20px;

    color: #444;

    transition: .3s ease;

    font-weight: 500;

}

.menu-left{

    display: flex;
    align-items: center;
    gap: 14px;

}

.sidebar-link:hover,
.sidebar-link.active{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color: white;

}

.sidebar-link i{

    font-size: 17px;

}

/* ARROW */

.arrow{

    font-size: 12px;

    transition: .3s ease;

}

.sidebar-link[aria-expanded="true"] .arrow{

    transform: rotate(180deg);

}

/* ================= SUBMENU ================= */

.submenu{

    margin-left: 18px;

    padding-top: 8px;

    display: flex;
    flex-direction: column;

    gap: 6px;

}

.submenu a{

    display: flex;
    align-items: center;
    gap: 12px;

    text-decoration: none;

    color: #666;

    padding: 12px 15px;

    border-radius: 14px;

    transition: .3s ease;

    font-size: 14px;

}

.submenu a:hover{

    background: #faf6ef;

    color: #B68D40;

}

/* SCROLL */

.sidebar::-webkit-scrollbar{

    width: 5px;

}

.sidebar::-webkit-scrollbar-thumb{

    background: #ddd;

    border-radius: 50px;

}

/* MOBILE */

@media(max-width:991px){

    .sidebar{

        transform: translateX(-100%);

    }

    .sidebar.show{

        transform: translateX(0);

    }

}
</style>

