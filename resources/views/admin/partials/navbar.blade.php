<!-- ================= NAVBAR ================= -->
<nav id="navbar" class="navbar-custom">

    <!-- LEFT -->
    <div class="navbar-left">

        <!-- TOGGLE -->
        <button id="toggleBtn" class="toggle-btn">

            <i class="fa-solid fa-bars"></i>

        </button>

    </div>

    <!-- RIGHT -->
    <div class="navbar-right">

        <!-- SEARCH -->
        <div class="search-box">

            <input
                type="text"
                placeholder="Cari produk..."
            >

            <i class="fa-solid fa-magnifying-glass"></i>

        </div>

        <!-- NOTIFICATION -->
        <button class="nav-icon-btn">

            <i class="fa-regular fa-bell"></i>

            <span class="notif-badge">
                3
            </span>

        </button>

        <!-- PROFILE -->
        <div class="dropdown">

            <button
                class="profile-btn"
                data-bs-toggle="dropdown"
            >

                <div class="profile-user">

                    <img
                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}"
                        alt="profile"
                    >

                    <div class="profile-info">

                        <h6>
                            {{ auth()->user()->name ?? 'Admin' }}
                        </h6>

                    </div>

                </div>

                <i class="fa-solid fa-chevron-down profile-arrow"></i>

            </button>

            <!-- DROPDOWN -->
            <ul class="dropdown-menu dropdown-menu-end profile-dropdown shadow border-0">

                <li>

                    <a class="dropdown-item" href="#">

                        <i class="fa-regular fa-user"></i>

                        <span>Profile</span>

                    </a>

                </li>

                <li>

                    <a class="dropdown-item" href="#">

                        <i class="fa-solid fa-gear"></i>

                        <span>Settings</span>

                    </a>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <form
                        action="{{ route('admin.logout') }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="dropdown-item logout-btn w-100"
                        >

                            <i class="fa-solid fa-right-from-bracket"></i>

                            <span>Logout</span>

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>

<style>

/* ================= NAVBAR ================= */

.navbar-custom{

    position: fixed;

    top: 0;
    left: 290px;
    right: 0;

    height: 85px;

    background: #fff;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 35px;

    border-bottom: 1px solid #f3ead8;

    z-index: 999;

    transition: .3s ease;

}

/* SIDEBAR COLLAPSE */

.navbar-custom.full{

    left: 0;

}

/* ================= LEFT ================= */

.navbar-left{

    display: flex;
    align-items: center;

}

/* TOGGLE */

.toggle-btn{

    width: 48px;
    height: 48px;

    border: none;
    outline: none;

    border-radius: 16px;

    background: #fffff1;

    color: #B68D40;

    font-size: 17px;

    cursor: pointer;

    transition: .3s ease;

}

.toggle-btn:hover{

    background: #B68D40;

    color: white;

}

/* ================= RIGHT ================= */

.navbar-right{

    display: flex;
    align-items: center;

    gap: 14px;

}

/* ================= SEARCH ================= */

.search-box{

    position: relative;

}

.search-box input{

    width: 260px;
    height: 48px;

    border: 1px solid #f1f1f1;
    outline: none;

    border-radius: 50px;

    background: white;

    padding: 0 50px 0 20px;

    font-size: 14px;

    transition: .3s ease;

}



.search-box input:focus{

    box-shadow:
    0 0 0 2px rgba(182,141,64,.12);

}

.search-box i{

    position: absolute;

    top: 50%;
    right: 18px;

    transform: translateY(-50%);

    color: #B68D40;

}

/* ================= NOTIF ================= */

.nav-icon-btn{

    position: relative;

    width: 48px;
    height: 48px;

    border: none;

    border-radius: 50%;

    background: #B68D40;

    color: white;

    cursor: pointer;

    transition: .3s ease;

}

.nav-icon-btn:hover{

    background: #c4953f;

}

/* BADGE */

.notif-badge{

    position: absolute;

    top: -2px;
    right: -2px;

    min-width: 18px;
    height: 18px;

    border-radius: 50%;

    background: white;

    color: #B68D40;

    border: 2px solid #B68D40;

    font-size: 10px;
    font-weight: 700;

    display: flex;
    align-items: center;
    justify-content: center;

}

/* ================= PROFILE ================= */

.profile-btn{

    border: none;
    background: transparent;

    display: flex;
    align-items: center;

    gap: 8px;

    cursor: pointer;

}

/* USER */

.profile-user{

    display: flex;
    flex-direction: column;

    align-items: center;

}

/* IMAGE */

.profile-user img{

    width: 42px;
    height: 42px;

    border-radius: 50%;

    object-fit: cover;

    border: 2px solid #fefefe;

}

/* NAME */

.profile-info h6{

    margin-top: 4px;

    margin-bottom: 0;

    font-size: 11px;
    font-weight: 600;

    color: #444;

    max-width: 80px;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;

}

/* ARROW */

.profile-arrow{

    font-size: 12px;

    color: #777;

}

/* ================= DROPDOWN ================= */

.profile-dropdown{

    width: 220px;

    border-radius: 20px;

    padding: 10px;

    margin-top: 14px;

}

/* ITEM */

.profile-dropdown .dropdown-item{

    display: flex;
    align-items: center;

    gap: 14px;

    border-radius: 14px;

    padding: 14px;

    color: #444;

    transition: .25s ease;

}

.profile-dropdown .dropdown-item:hover{

    background: #f1f1f1;

    color: #B68D40;

}

/* ICON */

.profile-dropdown i{

    width: 18px;

    text-align: center;

}

/* LOGOUT */

.logout-btn{

    border: none;

    background: transparent;

}

.logout-btn:hover{

    background: #faf6ef !important;

    color: #B68D40 !important;

}

/* ================= RESPONSIVE ================= */

@media(max-width:991px){

    .navbar-custom{

        left: 0;

        padding: 0 20px;

    }

    .search-box{

        display: none;

    }

}

@media(max-width:576px){

    .navbar-custom{

        height: 75px;

        padding: 0 15px;

    }

    .toggle-btn{

        width: 44px;
        height: 44px;

    }

    .nav-icon-btn{

        width: 44px;
        height: 44px;

    }

}

</style>