@extends('layouts.app')

@section('content')

<section class="admin-login-section">

    <div class="admin-login-wrapper">

        <div class="admin-login-card">

            <div class="row g-0 h-100">

                <!-- ================= LEFT ================= -->

                <div class="col-md-5 d-none d-md-flex admin-left">

                    <div class="admin-left-content">

                        <div class="admin-logo">

                            <i class="fa-solid fa-shield-halved"></i>

                        </div>

                        <h2>
                            Spill Outfit
                            <span>Admin Panel</span>
                        </h2>

                        <p>
                            Kelola produk, kategori, user,
                            dan aktivitas website dengan
                            tampilan dashboard yang modern
                            dan mudah digunakan.
                        </p>

                    </div>

                </div>

                <!-- ================= RIGHT ================= -->

                <div class="col-md-7 admin-right">

                    <div class="login-content">

                        <span class="admin-badge">
                            ✨ Secure Login
                        </span>

                        <h3>
                            Login Admin
                        </h3>

                        <p class="subtitle">
                            Masuk ke dashboard administrator
                        </p>

                        <!-- ALERT -->

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- FORM -->

                        <form method="POST"
                              action="{{ route('admin.login.post') }}">

                            @csrf

                            <!-- EMAIL -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <div class="input-wrapper">

                                    <i class="fa-solid fa-envelope"></i>

                                    <input
                                        type="email"
                                        name="email"
                                        placeholder="Masukkan email admin"
                                        required
                                    >

                                </div>

                            </div>

                            <!-- PASSWORD -->

                            <div class="mb-4">

                                <label class="form-label">
                                    Password
                                </label>

                                <div class="input-wrapper">

                                    <i class="fa-solid fa-lock"></i>

                                    <input
                                        type="password"
                                        name="password"
                                        placeholder="Masukkan password"
                                        required
                                    >

                                </div>

                            </div>

                            <!-- BUTTON -->

                            <button type="submit"
                                    class="btn-admin-login">

                                <i class="fa-solid fa-right-to-bracket me-2"></i>

                                Login Admin

                            </button>

                        </form>

                        <!-- BACK -->

                        <div class="back-link">

                            <a href="/">
                                ← Kembali ke halaman utama
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= SECTION ================= */

.admin-login-section{

    min-height:100vh;

    background:
    linear-gradient(
        180deg,
        #ffffff,
        #faf8f3
    );

    display:flex;
    justify-content:center;
    align-items:center;

    padding:30px;
}

/* WRAPPER */

.admin-login-wrapper{

    width:100%;
    max-width:950px;
}

/* CARD */

.admin-login-card{

    background:white;

    border-radius:35px;

    overflow:hidden;

    border:1px solid #f0ece1;

    box-shadow:
    0 15px 45px rgba(0,0,0,.06);

    min-height:560px;
}

/* ================= LEFT ================= */

.admin-left{

    background:
    linear-gradient(
        180deg,
        #8C6A2F,
        #C9A227
    );

    justify-content:center;
    align-items:center;

    padding:50px;

    color:white;
}

.admin-left-content{
    text-align:center;
}

.admin-logo{

    width:100px;
    height:100px;

    margin:auto auto 25px;

    border-radius:50%;

    background:
    rgba(255,255,255,.18);

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:42px;
}

.admin-left h2{

    font-weight:700;
    font-size:38px;
}

.admin-left h2 span{

    display:block;

    font-size:22px;

    margin-top:5px;

    font-weight:500;
}

.admin-left p{

    margin-top:20px;

    line-height:1.9;

    opacity:.95;
}

/* ================= RIGHT ================= */

.admin-right{

    display:flex;
    align-items:center;

    padding:50px;
}

.login-content{

    width:100%;
}

.admin-badge{

    display:inline-flex;

    background:#f8f4e7;

    color:#8C6A2F;

    padding:10px 18px;

    border-radius:50px;

    font-size:14px;

    font-weight:600;

    margin-bottom:20px;
}

.login-content h3{

    font-size:38px;

    font-weight:700;

    color:#222;
}

.subtitle{

    color:#777;

    margin-top:10px;
    margin-bottom:35px;
}

/* LABEL */

.form-label{

    font-weight:600;

    color:#444;

    margin-bottom:10px;
}

/* INPUT */

.input-wrapper{

    position:relative;
}

.input-wrapper i{

    position:absolute;

    left:20px;
    top:50%;

    transform:translateY(-50%);

    color:#B68D40;
}

.input-wrapper input{

    width:100%;

    height:56px;

    border-radius:18px;

    border:1px solid #ececec;

    outline:none;

    padding:0 20px 0 55px;

    transition:.3s;
}

.input-wrapper input:focus{

    border-color:#C9A227;

    box-shadow:
    0 0 0 4px rgba(201,162,39,.12);
}

/* BUTTON */

.btn-admin-login{

    width:100%;

    border:none;

    height:58px;

    border-radius:18px;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    font-weight:600;

    transition:.3s;
}

.btn-admin-login:hover{

    transform:translateY(-2px);

    box-shadow:
    0 10px 25px rgba(201,162,39,.25);
}

/* BACK */

.back-link{

    text-align:center;

    margin-top:25px;
}

.back-link a{

    color:#777;

    text-decoration:none;
}

/* ================= MOBILE ================= */

@media(max-width:768px){

    .admin-login-card{
        border-radius:28px;
    }

    .admin-right{
        padding:35px;
    }

    .login-content h3{
        font-size:30px;
    }

}

</style>

@endsection