@extends('layouts.app')

@section('content')

<section class="auth-section">

    <div class="auth-container">

        <div class="auth-card">

            <div class="row g-0 h-100">

                <!-- ================= LEFT ================= -->

                <div class="col-md-6 auth-left d-none d-md-flex">

                    <div class="left-content">

                        <div class="brand-logo">

                            <i class="mdi mdi-hanger"></i>

                        </div>

                        <h2>
                            Spill Outfit
                        </h2>

                        <h5>
                            Mulai Upgrade Style Kamu ✨
                        </h5>

                        <p>
                            Buat akun dan temukan rekomendasi outfit
                            terbaik untuk kuliah, nongkrong, kerja,
                            hingga daily outfit favoritmu.
                        </p>

                        <div class="brand-tag">
                            Fashion Recommendation Platform
                        </div>

                    </div>

                </div>

                <!-- ================= RIGHT ================= -->

                <div class="col-md-6 auth-right">

                    <div class="form-wrapper">

                        <div class="text-center mb-4">

                            <h3 class="fw-bold">
                                Register
                            </h3>

                            <p class="text-muted">
                                Buat akun baru 👋
                            </p>

                        </div>

                        <!-- ALERT -->

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())

                            <div class="alert alert-danger">

                                @foreach ($errors->all() as $error)

                                    <p class="mb-0">
                                        {{ $error }}
                                    </p>

                                @endforeach

                            </div>

                        @endif

                        <!-- FORM -->

                        <form method="POST"
                              action="{{ route('register') }}">

                            @csrf

                            <!-- NAMA -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Nama
                                </label>

                                <input type="text"
                                       name="name"
                                       class="form-control custom-input"
                                       placeholder="Masukkan nama"
                                       required>

                            </div>

                            <!-- EMAIL -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email"
                                       name="email"
                                       class="form-control custom-input"
                                       placeholder="Masukkan email"
                                       required>

                            </div>

                            <!-- PASSWORD -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Password
                                </label>

                                <input type="password"
                                       name="password"
                                       class="form-control custom-input"
                                       placeholder="Masukkan password"
                                       required>

                            </div>

                            <!-- CONFIRM PASSWORD -->

                            <div class="mb-4">

                                <label class="form-label">
                                    Konfirmasi Password
                                </label>

                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control custom-input"
                                       placeholder="Ulangi password"
                                       required>

                            </div>

                            <!-- BUTTON -->

                            <button type="submit"
                                    class="btn-login-custom w-100">

                                Register

                            </button>

                            <!-- DIVIDER -->

                            <div class="divider">

                                <span>
                                    atau
                                </span>

                            </div>

                            <!-- LOGIN -->

                            <div class="register-text">

                                Sudah punya akun?

                                <a href="{{ route('login') }}">
                                    Login
                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= SECTION ================= */

.auth-section{
    width:100%;
    min-height:100vh;
    background:
    linear-gradient(
        180deg,
        #ffffff,
        #faf8f3
    );
}

/* ================= CENTER ================= */

.auth-container{

    width:100%;
    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    padding:20px;
}

/* ================= CARD ================= */

.auth-card{

    width:100%;
    max-width:920px;

    min-height:580px;

    background:white;

    border-radius:32px;

    overflow:hidden;

    border:1px solid #f2ead8;

    box-shadow:
    0 18px 50px rgba(0,0,0,.06);
}

/* ================= LEFT ================= */

.auth-left{

    background:
    linear-gradient(
        180deg,
        #faf8f3,
        #f5efdf
    );

    display:flex;
    justify-content:center;
    align-items:center;

    padding:45px;

    text-align:center;
}

.left-content{
    max-width:320px;
}

.brand-logo{

    width:78px;
    height:78px;

    border-radius:24px;

    margin:auto auto 22px;

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

    font-size:34px;
}

.left-content h2{

    font-size:34px;
    font-weight:700;
    color:#222;
}

.left-content h5{

    margin-top:8px;

    color:#8C6A2F;

    font-size:18px;

    font-weight:600;
}

.left-content p{

    margin-top:18px;

    color:#666;

    line-height:1.8;

    font-size:14px;
}

.brand-tag{

    margin-top:24px;

    display:inline-block;

    background:white;

    color:#8C6A2F;

    padding:10px 18px;

    border-radius:50px;

    font-size:13px;

    font-weight:600;
}

/* ================= RIGHT ================= */

.auth-right{

    display:flex;
    justify-content:center;
    align-items:center;

    background:white;
}

.form-wrapper{

    width:100%;
    max-width:360px;

    padding:35px;
}

/* INPUT */

.custom-input{

    height:52px;

    border-radius:16px;

    border:1px solid #eee;

    background:#fafafa;

    padding:0 18px;
}

.custom-input:focus{

    border-color:#B68D40;

    box-shadow:none;
}

/* BUTTON */

.btn-login-custom{

    height:52px;

    border:none;

    border-radius:16px;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    font-weight:600;
}

/* DIVIDER */

.divider{

    margin:22px 0;

    text-align:center;

    position:relative;
}

.divider::before{

    content:"";

    position:absolute;

    width:100%;
    height:1px;

    background:#eee;

    top:50%;
    left:0;
}

.divider span{

    background:white;

    position:relative;

    padding:0 14px;

    color:#888;
}

/* GOOGLE */

.btn-google{

    height:52px;

    border:1px solid #eee;

    border-radius:16px;

    display:flex;
    justify-content:center;
    align-items:center;

    gap:10px;

    color:#333;
}

.btn-google img{
    width:18px;
}

.register-text{

    margin-top:20px;

    text-align:center;

    color:#666;
}

.register-text a{

    color:#B68D40;

    font-weight:600;
}

/* MOBILE */

@media(max-width:768px){

    .auth-card{
        max-width:430px;
        border-radius:28px;
    }

    .form-wrapper{
        padding:28px;
    }

}

</style>

@endsection