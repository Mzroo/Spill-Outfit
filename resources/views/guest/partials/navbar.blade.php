<nav class="navbar navbar-expand-lg sticky-top py-3">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold fs-2 logo-navbar text-white" href="/">
            Spill <span style="color: #313E17;">Outfit</span>
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarGuest">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarGuest">

            <!-- Menu kiri -->
            <ul class="navbar-nav me-auto">
                {{-- <li class="nav-item">
                    <a href="/" class="nav-link fw-semibold text-dark">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#kategori" class="nav-link fw-semibold text-dark">Kategori</a>
                </li>
                <li class="nav-item">
                    <a href="#produk" class="nav-link fw-semibold text-dark">Produk</a>
                </li> --}}
            </ul>

            <!-- Menu kanan -->
            <ul class="navbar-nav align-items-center">

                <!-- Search -->
                <li class="nav-item me-3 d-none d-md-block">
                    <form class="d-flex position-relative">
                        <input 
                            class="form-control rounded-pill ps-3 pe-5 " 
                            type="search" 
                            placeholder="Cari outfit..."
                        >
                        <button type="submit" 
                            class="position-absolute top-50 end-0 translate-middle-y me-3 btn btn-link p-0 text-dark">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </li>

                <!-- Cart -->
                <li class="nav-item me-4">
                    <a href="#" class="nav-link position-relative text-dark">
                        <i class="fa-solid fa-bag-shopping fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>
                    </a>
                </li>

                <!-- Login -->
                <li class="nav-item">
                    <a href="" class="btn px-4 py-2 rounded-pill fw-semibold"
                       style="background-color:#313E17; color:#fff;">
                        Masuk
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>