@extends('layouts.app')

@section('content')

<section class="error-wrapper d-flex align-items-center justify-content-center">

    <div class="container">

        <div class="error-card">

            <div class="row align-items-center">

                <!-- LEFT CONTENT -->
                <div class="col-lg-7">
                    <div class="content-area">

                        <!-- ERROR + GIF -->
                        <div class="error-top d-flex align-items-center">
                            
                            <h1 class="error-code">
                                Not Found
                            </h1>
                            
                            <img src="{{ asset('assets/images/404.gif') }}"
                                 alt="404 Error"
                                 class="error-gif">
                        </div>

                        <!-- TEXT -->
                        <h2 class="error-title">
                            Halaman Tidak Ditemukan
                        </h2>

                        <p class="error-text">
                            Upss... halaman yang kamu cari mungkin sudah dipindahkan,
                            dihapus, atau URL yang dimasukkan salah.
                        </p>

                        <!-- BUTTON -->
                        <a href="{{ url('/') }}" class="btn btn-home mt-3">
                            Kembali ke Beranda
                        </a>

                    </div>
                </div>

                <!-- RIGHT DECOR -->
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="circle-decoration"></div>
                </div>

            </div>

        </div>

    </div>

</section>


<style>

/* BODY */
body{
    background: #f8fafc;
    overflow-x: hidden;
}

/* WRAPPER */
.error-wrapper{
    min-height: 100vh;
    padding: 30px;
    background:
    radial-gradient(circle at top left, rgba(239,68,68,0.08), transparent 30%),
    radial-gradient(circle at bottom right, rgba(59,130,246,0.08), transparent 30%),
    #f8fafc;
}

/* CARD */
.error-card{
    width: 100%;
    max-width: 1100px;
    margin: auto;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 35px;
    padding: 60px;
    backdrop-filter: blur(10px);
    overflow: hidden;
    position: relative;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* TOP */
.error-top{
    gap: 20px;
    margin-bottom: 20px;
}

/* GIF */
.error-gif{
    width: 120px;
    height: auto;
    animation: floating 3s ease-in-out infinite;
    filter: drop-shadow(0 0 10px rgba(239,68,68,0.2));
}

/* ERROR CODE */
.error-code{
    font-size: 70px;
    font-weight: 900;
    margin: 0;
    line-height: 1;
    background: linear-gradient(135deg, #111827, #ef4444);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* TITLE */
.error-title{
    font-size: 42px;
    color: #111827;
    font-weight: 800;
    margin-bottom: 20px;
}

/* TEXT */
.error-text{
    color: #475569;
    font-size: 17px;
    line-height: 1.8;
    max-width: 600px;
}

/* BUTTON */
.btn-home{
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    padding: 14px 32px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s ease;
    display: inline-block;
    box-shadow: 0 5px 15px rgba(239,68,68,0.25);
}

.btn-home:hover{
    transform: translateY(-4px);
    color: white;
    box-shadow: 0 10px 25px rgba(239,68,68,0.35);
}

/* DECORATION */
.circle-decoration{
    width: 350px;
    height: 350px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(239,68,68,0.15), transparent 70%);
    margin: auto;
    animation: pulse 4s infinite ease-in-out;
}

/* ANIMATION */
@keyframes floating{
    0%{ transform: translateY(0px); }
    50%{ transform: translateY(-10px); }
    100%{ transform: translateY(0px); }
}

@keyframes pulse{
    0%{
        transform: scale(1);
        opacity: 0.7;
    }
    50%{
        transform: scale(1.08);
        opacity: 1;
    }
    100%{
        transform: scale(1);
        opacity: 0.7;
    }
}

/* RESPONSIVE */
@media(max-width: 991px){

    .error-card{
        padding: 40px 25px;
        text-align: center;
    }

    .error-top{
        justify-content: center;
        flex-direction: column;
    }

    .error-code{
        font-size: 80px;
    }

    .error-title{
        font-size: 32px;
    }

    .error-text{
        margin: auto;
        font-size: 15px;
    }

    .error-gif{
        width: 100px;
    }
}

</style>

@endsection