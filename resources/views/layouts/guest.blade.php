<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Spill Outfit')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">

    {{-- Icon --}}
        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/outfit.svg') }}">


    <!-- Material Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <!-- Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">

 <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

a{
    text-decoration:none;
}

/* ================= MAIN ================= */

.content{
    padding-top:110px;
    min-height:100vh;
    padding-left:40px;
    padding-right:40px;
}



/* ================= MOBILE ================= */

@media(max-width:992px){

    .nav-menu{
        display:none;
    }

    .search-box{
        display:none;
    }

    .navbar-custom{
        padding:0 20px;
    }

    .content{
        padding-left:20px;
        padding-right:20px;
    }

}

</style>

</head>
<body>
<!-- CONTENT -->
<div class="content">

    @yield('content')

</div>

<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>

</body>
</html>