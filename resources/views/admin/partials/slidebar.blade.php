<div id="sidebar" class="sidebar">

    <div class="sidebar-logo">
        <div class="logo-circle">
            <i class="fa-solid fa-shirt"></i>
        </div>
        <div class="logo-text">
            <h4>Spill <span>Outfit</span></h4>
            <small>Fashion Admin</small>
        </div>
    </div>

    <div class="sidebar-menu">

        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <div class="menu-left">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </div>
        </a>

        <div class="menu-dropdown-wrapper {{ request()->routeIs('admin.produk.*') || request()->routeIs('admin.produk-varian.*') || request()->routeIs('admin.kategori.*') || request()->routeIs('admin.brand.*') || request()->routeIs('admin.ukuran.*') || request()->routeIs('admin.warna.*') ? 'is-expanded' : '' }}">
            <a class="sidebar-link toggle-dropdown-trigger" href="javascript:void(0);">
                <div class="menu-left">
                    <i class="fa-solid fa-shirt"></i>
                    <span>Produk</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>

            <div class="submenu-list">
                <a href="{{ route('admin.produk.index') }}" class="{{ request()->routeIs('admin.produk.index') || request()->routeIs('admin.produk-varian.index') ? 'submenu-active' : '' }}">
                    <i class="fa-solid fa-box"></i>
                    <span>Semua Produk</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.index') ? 'submenu-active' : '' }}">
                    <i class="fa-solid fa-tags"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.brand.index') }}" class="{{ request()->routeIs('admin.brand.index') ? 'submenu-active' : '' }}">
                    <i class="fa-solid fa-copyright"></i>
                    <span>Brand</span>
                </a>
                <a href="{{ route('admin.ukuran.index') }}" class="{{ request()->routeIs('admin.ukuran.index') ? 'submenu-active' : '' }}">
                    <i class="fa-solid fa-ruler"></i>
                    <span>Ukuran</span>
                </a>
                <a href="{{ route('admin.warna.index') }}" class="{{ request()->routeIs('admin.warna.index') ? 'submenu-active' : '' }}">
                    <i class="fa-solid fa-palette"></i>
                    <span>Warna</span>
                </a>
            </div>
        </div>

        <div class="menu-dropdown-wrapper {{ request()->routeIs('admin.pesanan.*') ? 'is-expanded' : '' }}">
            <a class="sidebar-link toggle-dropdown-trigger" href="javascript:void(0);">
                <div class="menu-left">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Transaksi</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>

            <div class="submenu-list">
                <a href="{{ route('admin.pesanan.index') }}" class="{{ request()->routeIs('admin.pesanan.*') ? 'submenu-active' : '' }}">
                    <i class="fa-solid fa-receipt"></i> 
                    <span>Pesanan</span>
                </a>
            </div>
        </div>

        <div class="menu-dropdown-wrapper {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.chat.*') ? 'is-expanded' : '' }}">
            <a class="sidebar-link toggle-dropdown-trigger" href="javascript:void(0);">
                <div class="menu-left">
                    <i class="fa-solid fa-users"></i>
                    <span>Customer</span>
                </div>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>

            <div class="submenu-list">
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'submenu-active' : '' }}">
                    <i class="fa-solid fa-user"></i> 
                    <span>Data Customer</span>
                </a>
                <a href="{{ route('admin.chat.index') }}" class="{{ request()->routeIs('admin.chat.index') || request()->routeIs('admin.chat.show') ? 'submenu-active' : '' }}">
                    <i class="fa-solid fa-message"></i> 
                    <span>Chat</span>
                </a>
            </div>
        </div>

        <a href="{{ route('admin.laporan.index') }}" class="sidebar-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
            <div class="menu-left">
                <i class="fa-solid fa-chart-line"></i>
                <span>Laporan</span>
            </div>
        </a>

        <a href="{{ route('admin.pengaturan.index') }}" class="sidebar-link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
            <div class="menu-left">
                <i class="fa-solid fa-gear"></i>
                <span>Pengaturan</span>
            </div>
        </a>
        
    </div>
</div>

<style>
/* ======================== DESIGN SYSTEM SIDEBAR (NORMAL CSS) ======================== */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 290px;
    height: 100vh;
    background: #ffffff;
    border-right: 1px solid #f3ead8;
    padding: 28px 20px;
    overflow-y: auto;
    z-index: 1000;
    transition: all .3s ease;
    box-shadow: 0 8px 30px rgba(0,0,0,.05);
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
.sidebar *, .sidebar *::before, .sidebar *::after {
    box-sizing: border-box;
}

.sidebar.hide {
    transform: translateX(-100%);
}

.sidebar-logo {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 40px;
}
.logo-circle {
    width: 56px;
    height: 56px;
    border-radius: 18px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 22px;
}
.logo-text h4 {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
}
.logo-text span {
    color: #B68D40;
}
.logo-text small {
    color: #888888;
    display: block;
    margin-top: 2px;
    font-size: 12px;
}

.sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.sidebar-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-decoration: none;
    padding: 15px 18px;
    border-radius: 20px;
    color: #444444;
    font-weight: 500;
    font-size: 14.5px;
    transition: all .3s ease;
    cursor: pointer;
}
.menu-left {
    display: flex;
    align-items: center;
    gap: 14px;
}
.sidebar-link i {
    font-size: 17px;
}

.sidebar-link:hover,
.sidebar-link.active {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: #ffffff;
}

.arrow {
    font-size: 12px;
    transition: transform .3s ease;
}

.menu-dropdown-wrapper {
    display: flex;
    flex-direction: column;
}
.submenu-list {
    margin-left: 18px;
    display: flex;
    flex-direction: column;
    gap: 4px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s cubic-bezier(0, 1, 0, 1);
}

.menu-dropdown-wrapper.is-expanded .submenu-list {
    max-height: 500px;
    transition: max-height 0.3s cubic-bezier(1, 0, 1, 0);
    padding-top: 8px;
}
.menu-dropdown-wrapper.is-expanded .toggle-dropdown-trigger .arrow {
    transform: rotate(180deg);
}

.submenu-list a {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: #666666;
    padding: 12px 15px;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 500;
    transition: all .3s ease;
}
.submenu-list a:hover {
    background: #faf6ed;
    color: #B68D40;
}

.submenu-list a.submenu-active {
    background-color: #faf6ed;
    color: #8C6A2F;
    font-weight: 600;
    border-left: 3.5px solid #8C6A2F;
    border-radius: 4px 14px 14px 4px;
    padding-left: 11.5px;
}

.sidebar::-webkit-scrollbar {
    width: 5px;
}
.sidebar::-webkit-scrollbar-thumb {
    background: #e2d7c3;
    border-radius: 50px;
}

@media(max-width: 991px) {
    .sidebar {
        transform: translateX(-100%);
    }
    .sidebar.show {
        transform: translateX(0);
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const dropdownTriggers = document.querySelectorAll('.toggle-dropdown-trigger');

    dropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            const parentWrapper = this.parentElement;
            const wasExpanded = parentWrapper.classList.contains('is-expanded');

            // Akordion: Tutup dropdown lain kecuali yang punya submenu sedang aktif
            document.querySelectorAll('.menu-dropdown-wrapper').forEach(wrapper => {
                if (!wrapper.querySelector('.submenu-active')) {
                    wrapper.classList.remove('is-expanded');
                }
            });

            if (!wasExpanded) {
                parentWrapper.classList.add('is-expanded');
            } else {
                parentWrapper.classList.remove('is-expanded');
            }
        });
    });
});
</script>