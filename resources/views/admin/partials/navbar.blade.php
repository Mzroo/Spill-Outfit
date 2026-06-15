<!-- ================= NAVBAR CUSTOM COMPONENT ================= -->
<nav id="navbar" class="navbar-custom">

    <!-- LEFT ACTIONS -->
    <div class="navbar-left">
        <button id="toggleBtn" class="toggle-btn" type="button" title="Toggle Sidebar Menu">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <!-- RIGHT CONTROLS -->
    <div class="navbar-right">

        {{-- <!-- SEARCH BOX ELEMENT -->
        <div class="search-box">
            <input type="text" placeholder="Cari produk...">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div> --}}

        {{-- <!-- NOTIFICATION ICON ALERT -->
        <button class="nav-icon-btn" type="button" title="Notifikasi Masuk">
            <i class="fa-regular fa-bell"></i>
            <span class="notif-badge">3</span>
        </button>

        <!-- PROFILE DROPDOWN COMPONENT (PURE CSS DROPDOWN) --> --}}
        <div class="custom-profile-dropdown" id="profileDropdownContainer">
            <button class="profile-btn" type="button" id="profileDropdownBtn">
                <div class="profile-user">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=8C6A2F&color=fff" alt="profile img">
                    <div class="profile-info">
                        <h6>{{ auth()->user()->name ?? 'Admin' }}</h6>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down profile-arrow" id="profileArrowIcon"></i>
            </button>

            <!-- DROPDOWN MENU LIST -->
            <ul class="profile-dropdown-menu" id="profileDropdownMenu">
                <li>
                    <a class="dropdown-menu-item" href="#">
                        <i class="fa-regular fa-user"></i>
                        <span>Profile Saya</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-menu-item" href="#">
                        <i class="fa-solid fa-gear"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider-line">
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="logout-form-wrapper">
                        @csrf
                        <button type="submit" class="dropdown-menu-item logout-btn-trigger">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Keluar Aplikasi</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>

<style>
/* ======================== DESIGN SYSTEM NAVBAR (NORMAL CSS) ======================== */
.navbar-custom {
    position: fixed;
    top: 0;
    left: 290px;
    right: 0;
    height: 85px;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 35px;
    border-bottom: 1px solid #f3ead8;
    z-index: 999;
    transition: all .3s ease;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
.navbar-custom *, .navbar-custom *::before, .navbar-custom *::after {
    box-sizing: border-box;
}

/* KONDISI KETIKA SIDEBAR COLLAPSE / SEMBUNYI */
.navbar-custom.full {
    left: 0;
}

/* NAVBAR LEFT: TOGGLE BUTTON */
.navbar-left {
    display: flex;
    align-items: center;
}
.toggle-btn {
    width: 48px;
    height: 48px;
    border: none;
    outline: none;
    border-radius: 16px;
    background: #fffff1;
    color: #B68D40;
    font-size: 17px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .3s ease;
}
.toggle-btn:hover {
    background: #B68D40;
    color: #ffffff;
}

/* NAVBAR RIGHT STYLES */
.navbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

/* SEARCH ENGINE COMPONENT */
.search-box {
    position: relative;
}
.search-box input {
    width: 260px;
    height: 48px;
    border: 1px solid #f1f1f1;
    outline: none;
    border-radius: 50px;
    background: #ffffff;
    padding: 0 50px 0 20px;
    font-size: 13.5px;
    font-family: inherit;
    transition: all .3s ease;
}
.search-box input:focus {
    border-color: #ebdcb9;
    box-shadow: 0 0 0 3px rgba(182, 141, 64, 0.1);
}
.search-box i {
    position: absolute;
    top: 50%;
    right: 18px;
    transform: translateY(-50%);
    color: #B68D40;
    font-size: 14px;
}

/* NOTIFICATION ICON BUTTON */
.nav-icon-btn {
    position: relative;
    width: 48px;
    height: 48px;
    border: none;
    outline: none;
    border-radius: 50%;
    background: #B68D40;
    color: #ffffff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all .3s ease;
}
.nav-icon-btn:hover {
    background: #c4953f;
}
.notif-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    min-width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #ffffff;
    color: #B68D40;
    border: 2px solid #B68D40;
    font-size: 10px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* PROFILE INTERACTION WITH DROPDOWN STRUCTURE */
.custom-profile-dropdown {
    position: relative;
}
.profile-btn {
    border: none;
    outline: none;
    background: transparent;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    padding: 6px;
    border-radius: 12px;
    transition: background 0.2s ease;
}
.profile-btn:hover {
    background: #fafaf6;
}
.profile-user {
    display: flex;
    align-items: center;
    gap: 10px;
}
.profile-user img {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #f3ead8;
}
.profile-info h6 {
    margin: 0;
    font-size: 13px;
    font-weight: 600;
    color: #333333;
    max-width: 90px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.profile-arrow {
    font-size: 11px;
    color: #888888;
    transition: transform 0.25s ease;
}

/* DROPDOWN MENU PANEL CONTAINER */
.profile-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 12px;
    width: 220px;
    background: #ffffff;
    border-radius: 16px;
    padding: 8px;
    list-style: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: 1px solid #f5efe2;
    opacity: 0;
    transform: translateY(-10px);
    pointer-events: none;
    transition: all 0.25s ease;
}
/* Trigger aktif via Javascript */
.profile-dropdown-menu.is-active {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

/* LIST COMPONENT ITEMS */
.dropdown-menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    border-radius: 10px;
    padding: 11px 14px;
    color: #444444;
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 500;
    width: 100%;
    border: none;
    background: transparent;
    text-align: left;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.2s ease;
}
.dropdown-menu-item:hover {
    background: #faf6ef;
    color: #8C6A2F;
}
.dropdown-menu-item i {
    width: 16px;
    text-align: center;
    font-size: 14px;
}
.dropdown-divider-line {
    margin: 6px 0;
    border: 0;
    border-top: 1px solid #f5efe2;
}
.logout-form-wrapper {
    margin: 0;
}
.logout-btn-trigger:hover {
    background: #fff0f0;
    color: #ec5b5b;
}

/* ==================== SCREEN RESPONSIVE BREKPOINTS ==================== */
@media(max-width: 991px) {
    .navbar-custom {
        left: 0;
        padding: 0 20px;
    }
    .search-box {
        display: none;
    }
}
@media(max-width: 576px) {
    .navbar-custom {
        height: 75px;
        padding: 0 15px;
    }
    .toggle-btn, .nav-icon-btn {
        width: 42px;
        height: 42px;
        border-radius: 12px;
    }
    .profile-info {
        display: none; /* Sembunyikan nama di HP kecil agar tidak sesak */
    }
}
</style>

<script>
// =========================================================================
// JAVASCRIPT LOGIC PURE UNTUK DROPDOWN PROFILE
// =========================================================================
document.addEventListener("DOMContentLoaded", function () {
    const profileDropdownBtn = document.getElementById('profileDropdownBtn');
    const profileDropdownMenu = document.getElementById('profileDropdownMenu');
    const profileArrowIcon = document.getElementById('profileArrowIcon');

    if (profileDropdownBtn && profileDropdownMenu) {
        // Aksi klik tombol profile untuk memunculkan/menyembunyikan menu dropdown
        profileDropdownBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = profileDropdownMenu.classList.toggle('is-active');
            
            // Putar panah kecil 180 derajat jika terbuka
            if (profileArrowIcon) {
                profileArrowIcon.style.transform = isOpen ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        });

        // Tutup dropdown otomatis jika user mengklik bagian mana saja di luar box profile
        document.addEventListener('click', function (e) {
            if (!profileDropdownBtn.contains(e.target)) {
                profileDropdownMenu.classList.remove('is-active');
                if (profileArrowIcon) {
                    profileArrowIcon.style.transform = 'rotate(0deg)';
                }
            }
        });
    }
});
</script>