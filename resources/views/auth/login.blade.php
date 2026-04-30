@extends('layouts.app')

@section('content')

<div class="auth-wrapper">

    <!-- ================= VIDEO BACKGROUND ================= -->
    <video autoplay muted loop class="video-bg">
        <source src="{{ asset('assets/images/banner/backgroundLogin.mp4') }}" type="video/mp4">
    </video>

    <!-- OVERLAY GELAP -->
    <div class="overlay"></div>

    <!-- CONTENT -->
    <div class="d-flex align-items-center justify-content-center min-vh-100 position-relative">

        <div class="card border-0 shadow-lg overflow-hidden auth-card">

            <div class="row g-0">

                <!-- ================= KIRI (ILUSTRASI) ================= -->
                <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light p-4">

                    <div class="text-center">

                        <h3 class="fw-bold gradient-text mb-2">Spill Outfit</h3>
                        <p class="text-muted small mb-4">
                            Temukan outfit terbaikmu dengan mudah & stylish setiap hari ✨
                        </p>
                        
                        <img src="{{ asset('assets/images/undraw.svg') }}"
                             class="img-fluid floating-img"
                             style="max-height: 260px;">

                    </div>

                </div>

                <!-- ================= KANAN (FORM) ================= -->
                <div class="col-md-6 p-4 bg-white">

                    <!-- TAB -->
                    <div class="d-flex mb-4">
                        <button id="btnLogin" class="btn w-50 active-tab">Login</button>
                        <button id="btnRegister" class="btn w-50">Register</button>
                    </div>

                    <!-- LOGIN -->
                    <div id="loginForm">

                        <form method="POST" action="">
                            @csrf

                            <div class="mb-3">
                                <input type="email" name="email" class="form-control input-custom"
                                       placeholder="Email">
                            </div>

                            <div class="mb-3 position-relative">
                                <input type="password" id="passwordLogin"
                                       class="form-control pe-5 input-custom"
                                       placeholder="Password">

                                <i class="fa-solid fa-eye togglePass"
                                   data-target="passwordLogin"></i>
                            </div>

                            <button class="btn btn-warning w-100 fw-semibold btn-main">
                                Login
                            </button>

                            <!-- DIVIDER -->
                            <div class="d-flex align-items-center my-3">
                                <hr class="flex-grow-1">
                                <span class="px-2 text-muted small">atau</span>
                                <hr class="flex-grow-1">
                            </div>

                            <!-- GOOGLE -->
                            <a href="#" class="btn btn-google w-100">
                                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg">
                                Login dengan Google
                            </a>

                        </form>

                    </div>

                    <!-- REGISTER -->
                    <div id="registerForm" style="display:none;">

                        <form method="POST" action="">
                            @csrf

                            <div class="mb-3">
                                <input type="text" class="form-control input-custom"
                                       placeholder="Nama">
                            </div>

                            <div class="mb-3">
                                <input type="email" class="form-control input-custom"
                                       placeholder="Email">
                            </div>

                            <div class="mb-3 position-relative">
                                <input type="password" id="passwordRegister"
                                       class="form-control pe-5 input-custom"
                                       placeholder="Password">

                                <i class="fa-solid fa-eye togglePass"
                                   data-target="passwordRegister"></i>
                            </div>

                            <button class="btn btn-dark w-100 fw-semibold btn-main">
                                Register
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<!-- ================= STYLE ================= -->
<style>

/* WRAPPER */
.auth-wrapper {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

/* VIDEO */
.video-bg {
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    transform: translate(-50%, -50%);
    object-fit: cover;
    z-index: -2;
}

/* OVERLAY HITAM */
.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5); /* opacity */
    z-index: 1;
}

/* CARD */
.auth-card {
    max-width: 900px;
    width: 100%;
    border-radius: 20px;
    z-index: 2;
}

/* TAB */
.active-tab {
    background: #F9ED69;
    font-weight: 600;
}

/* INPUT */
.input-custom {
    border-radius: 10px;
    transition: 0.3s;
}

.input-custom:focus {
    box-shadow: 0 0 0 2px rgba(249,237,105,0.4);
}

/* BUTTON */
.btn-main {
    border-radius: 10px;
    transition: 0.3s;
}

.btn-main:hover {
    transform: translateY(-2px);
}

/* GOOGLE */

.btn-google img {
    width: 16px;
    height: 16px;
    object-fit: contain;
}

.btn-google {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 10px;
    background: #fff;
    transition: 0.3s;
    text-decoration: none;
    color: #333;
}

.btn-google:hover {
    transform: scale(1.03);
}

/* ICON PASSWORD */
.togglePass {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    cursor: pointer;
}

/* TEXT */
.gradient-text {
    background: linear-gradient(90deg, #f08a5d, #b83b5e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ANIMASI */
.floating-img {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
}

</style>

<!-- ================= JS ================= -->
<script>

const btnLogin = document.getElementById('btnLogin');
const btnRegister = document.getElementById('btnRegister');

const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');

btnLogin.onclick = () => {
    loginForm.style.display = 'block';
    registerForm.style.display = 'none';
    btnLogin.classList.add('active-tab');
    btnRegister.classList.remove('active-tab');
};

btnRegister.onclick = () => {
    loginForm.style.display = 'none';
    registerForm.style.display = 'block';
    btnRegister.classList.add('active-tab');
    btnLogin.classList.remove('active-tab');
};

// TOGGLE PASSWORD
document.querySelectorAll('.togglePass').forEach(icon => {
    icon.onclick = function () {
        const input = document.getElementById(this.dataset.target);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
});

</script>

@endsection