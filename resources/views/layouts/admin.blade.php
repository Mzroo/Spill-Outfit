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
<style>

/* ================= GLOBAL ================= */

body{
    background:#f8f9fc;
    font-family:'Poppins', sans-serif;
    overflow-x:hidden;
}

/* ================= CONTENT ================= */

.content{

    margin-left:290px;
    margin-top:90px;

    padding:35px;

    min-height:100vh;

    transition:.3s ease;

}

/* SAAT SIDEBAR HIDE */

.content.full{

    margin-left:0;

}

/* CARD DEFAULT (BIAR PREMIUM) */

.content .card{

    border:none;

    border-radius:28px;

    background:#fff;

    box-shadow:
    0 10px 35px rgba(0,0,0,.05);

}

/* TABLE */

.table{

    border-radius:20px;
    overflow:hidden;
}

/* TITLE */

.page-heading{

    margin-bottom:28px;
}

.page-heading h2{

    font-size:32px;
    font-weight:700;

    color:#222;
}

.page-heading p{

    margin:0;

    color:#888;
}

/* FORM */

.form-control,
.form-select{

    border-radius:18px;

    min-height:52px;

    border:1px solid #ece4d4;
}

.form-control:focus,
.form-select:focus{

    border-color:#B68D40;

    box-shadow:
    0 0 0 .15rem rgba(182,141,64,.18);
}

/* BUTTON */

.btn-premium{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    border:none;

    border-radius:16px;

    padding:12px 22px;

    font-weight:600;

    transition:.3s;
}

.btn-premium:hover{

    transform:translateY(-2px);

    color:white;
}

/* MOBILE */

@media(max-width:991px){

    .content{

        margin-left:0;
        margin-top:90px;

        padding:20px;

    }

}

</style>
</head>

<body>
    @include('admin.partials.slidebar')
    @include('admin.partials.navbar')

    <!-- CONTENT -->
    <div id="content" class="content">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>


 {{-- ================= SWEET ALERT SUCCESS ================= --}}
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


{{-- ================= SWEET ALERT ERROR ================= --}}
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

    // ================= ELEMENT =================

    const toggleBtn =
        document.getElementById('toggleBtn');

    const sidebar =
        document.getElementById('sidebar');

    const content =
        document.getElementById('content');

    const navbar =
        document.getElementById('navbar');


    // ================= TOGGLE SIDEBAR =================

    if(toggleBtn){

        toggleBtn.addEventListener('click', function(){

            // MOBILE
            if(window.innerWidth < 992){

                sidebar.classList.toggle('show');

            }

            // DESKTOP
            else{

                sidebar.classList.toggle('hide');

                content.classList.toggle('full');

                navbar.classList.toggle('full');

            }

        });

    }


    // ================= AUTO CLOSE MOBILE =================

    document.addEventListener('click', function(e){

        if(
            window.innerWidth < 992 &&
            sidebar &&
            toggleBtn &&
            !sidebar.contains(e.target) &&
            !toggleBtn.contains(e.target)
        ){

            sidebar.classList.remove('show');

        }

    });


    // ================= RESET DESKTOP =================

    window.addEventListener('resize', function(){

        if(window.innerWidth >= 992){

            sidebar.classList.remove('show');

        }

    });


    // ================= ACTIVE SIDEBAR MENU =================

    const sidebarLinks =
        document.querySelectorAll('.sidebar-link');

    sidebarLinks.forEach(link => {

        link.addEventListener('click', function(){

            sidebarLinks.forEach(item => {

                item.classList.remove('active');

            });

            this.classList.add('active');

        });

    });


    // ================= SWEET ALERT DELETE =================

    document
    .querySelectorAll('.btn-delete')
    .forEach(button => {

        button.addEventListener('click', function(e){

            e.preventDefault();

            let form =
                this.closest('.delete-form');

            Swal.fire({

                title: 'Yakin mau hapus?',

                text:
                'Data yang dihapus tidak bisa dikembalikan!',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#B68D40',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Ya, hapus!',

                cancelButtonText: 'Batal',

                background: '#fff',

                borderRadius: '20px'

            }).then((result) => {

                if(result.isConfirmed){

                    form.submit();

                }

            });

        });

    });

</script>

</body>
</html>