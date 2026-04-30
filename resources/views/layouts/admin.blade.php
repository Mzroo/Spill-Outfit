<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    <!-- Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>

    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar">

        <!-- LOGO -->
       <div class="text-center mb-4 logo-text">
            <h5 class="fw-bold mb-0">
                Spill <span>Outfit</span>
            </h5>
            <small>Fashion Admin</small>
        </div>

        <!-- DASHBOARD -->
        <a href="#">
            <i class="fa fa-home me-2"></i> Dashboard
        </a>

        <!-- PRODUK (DROPDOWN) -->
        <a data-bs-toggle="collapse" href="#produkMenu" role="button">
            <i class="fa fa-shirt me-2"></i> Produk
            <i class="fa fa-chevron-down float-end"></i>
        </a>

        <div class="collapse ps-3" id="produkMenu">
            <a href="{{ route('produk.index') }}"><i class="fa fa-box me-2"></i> Semua Produk</a>
            <a href="{{ route('kategori.index') }}"><i class="fa fa-tags me-2"></i> Kategori</a>
            <a href="#"><i class="fa fa-layer-group me-2"></i> Stok Barang</a>
        </div>

        <!-- TRANSAKSI -->
        <a data-bs-toggle="collapse" href="#transaksiMenu" role="button">
            <i class="fa fa-shopping-cart me-2"></i> Transaksi
            <i class="fa fa-chevron-down float-end"></i>
        </a>

        <div class="collapse ps-3" id="transaksiMenu">
            <a href="#"><i class="fa fa-receipt me-2"></i> Pesanan</a>
            <a href="#"><i class="fa fa-credit-card me-2"></i> Pembayaran</a>
        </div>

        <!-- USER -->
        <a href="#">
            <i class="fa fa-users me-2"></i> Customer
        </a>

        <!-- LAPORAN -->
        <a href="#">
            <i class="fa fa-chart-line me-2"></i> Laporan
        </a>

        <!-- SETTING -->
        <a href="#">
            <i class="fa fa-cog me-2"></i> Pengaturan
        </a>

    </div>

    <!-- NAVBAR -->
    <nav id="navbar" class="navbar navbar-light bg-light shadow-sm navbar-custom px-4">
        
        <!-- TOGGLE BUTTON -->
        <button id="toggleBtn" class="btn btn-outline-secondary">
            <i class="fa fa-bars"></i>
        </button>

        <div class="ms-auto">
            <div class="dropdown">
                <button class="user-btn" data-bs-toggle="dropdown">

                    <img class="img-profile rounded-circle"
                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}">

                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fa fa-user me-2 text-secondary"></i>
                            Profile
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fa fa-cog me-2 text-secondary"></i>
                            Settings
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="dropdown-item d-flex align-items-center text-danger">
                                <i class="fa fa-sign-out-alt me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div id="content" class="content">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>


    @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}'
    });
</script>
@endif

<script> 
        // Toogle
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const navbar = document.getElementById('navbar');

        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('hide');
            content.classList.toggle('full');
            navbar.classList.toggle('full');
        });

document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function () {

        let form = this.closest('.delete-form');

        Swal.fire({
            title: 'Yakin mau hapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f08a5d',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });
    });
});
</script>

</body>
</html>