@extends('layouts.user')

@section('title', 'About')

@section('content')

<section class="about-section">

    <!-- ================= HERO ================= -->

    <div class="about-hero">

        <div class="about-left">

            <span class="about-badge">
                ABOUT SPILL OUTFIT
            </span>

            <h1>
                Fashion Bukan Sekadar Pakaian,
                Tapi Cara Kamu Berekspresi ✨
            </h1>

            <p>
                Spill Outfit hadir untuk membantu kamu menemukan style
                terbaik yang aesthetic, modern, dan sesuai dengan
                personality kamu.
            </p>

        </div>

        <div class="about-right">

            <img src="{{ asset('images/hero/gambar1.jpg') }}">

        </div>

    </div>

    <!-- ================= ABOUT ================= -->

    <div class="about-content">

        <div class="about-card">

            <i class="mdi mdi-lightbulb-on-outline"></i>

            <h3>Our Vision</h3>

            <p>
                Menjadi platform fashion recommendation terbaik
                untuk generasi modern.
            </p>

        </div>

        <div class="about-card">

            <i class="mdi mdi-star-outline"></i>

            <h3>Our Mission</h3>

            <p>
                Membantu pengguna menemukan outfit yang stylish,
                aesthetic, dan nyaman dipakai sehari-hari.
            </p>

        </div>

        <div class="about-card">

            <i class="mdi mdi-heart-outline"></i>

            <h3>Our Value</h3>

            <p>
                Fashion harus membuat semua orang percaya diri
                dan tampil lebih baik.
            </p>

        </div>

    </div>

    <!-- ================= WHY US ================= -->

    <div class="why-section">

        <div class="why-left">

            <img src="{{ asset('images/hero/gambar3.jpg') }}">

        </div>

        <div class="why-right">

            <span>
                WHY CHOOSE US
            </span>

            <h2>
                Kenapa Spill Outfit?
            </h2>

            <div class="why-item">

                <i class="mdi mdi-check-circle"></i>

                <div>

                    <h5>Fashion Modern</h5>

                    <p>
                        Selalu mengikuti trend fashion terbaru.
                    </p>

                </div>

            </div>

            <div class="why-item">

                <i class="mdi mdi-check-circle"></i>

                <div>

                    <h5>Style Recommendation</h5>

                    <p>
                        Outfit sesuai aktivitas dan personality.
                    </p>

                </div>

            </div>

            <div class="why-item">

                <i class="mdi mdi-check-circle"></i>

                <div>

                    <h5>User Friendly</h5>

                    <p>
                        Tampilan nyaman dan mudah digunakan.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= SECTION ================= */

.about-section{
    padding:10px;
}

/* ================= HERO ================= */

.about-hero{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:50px;

    align-items:center;

    margin-bottom:100px;
}

/* LEFT */

.about-badge{
    display:inline-block;

    padding:8px 18px;

    border-radius:50px;

    background:#e9efe0;

    color:#556B2F;

    font-size:13px;
    font-weight:600;

    margin-bottom:25px;
}

.about-left h1{
    font-size:58px;
    font-weight:700;

    line-height:1.2;

    color:#222;

    margin-bottom:20px;
}

.about-left p{
    color:#777;

    line-height:1.9;

    font-size:16px;
}

/* RIGHT */

.about-right img{
    width:100%;

    height:650px;

    object-fit:cover;

    border-radius:35px;

    box-shadow:
    0 20px 50px rgba(0,0,0,0.12);
}

/* ================= CARD ================= */

.about-content{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:30px;

    margin-bottom:100px;
}

.about-card{
    background:white;

    border-radius:30px;

    padding:40px;

    transition:0.4s;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.06);
}

.about-card:hover{
    transform:translateY(-10px);
}

.about-card i{
    font-size:50px;
    color:#556B2F;

    margin-bottom:20px;
}

.about-card h3{
    font-size:28px;
    font-weight:700;

    margin-bottom:15px;
}

.about-card p{
    color:#777;

    line-height:1.8;
}

/* ================= WHY ================= */

.why-section{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:60px;

    align-items:center;
}

/* IMAGE */

.why-left img{
    width:100%;
    height:600px;

    object-fit:cover;

    border-radius:35px;
}

/* RIGHT */

.why-right span{
    display:inline-block;

    padding:8px 18px;

    border-radius:50px;

    background:#e9efe0;

    color:#556B2F;

    font-size:13px;
    font-weight:600;

    margin-bottom:20px;
}

.why-right h2{
    font-size:48px;
    font-weight:700;

    margin-bottom:40px;
}

.why-item{
    display:flex;
    gap:20px;

    margin-bottom:30px;
}

.why-item i{
    font-size:30px;
    color:#556B2F;
}

.why-item h5{
    font-size:22px;
    font-weight:600;
}

.why-item p{
    color:#777;
}

/* ================= RESPONSIVE ================= */

@media(max-width:992px){

    .about-hero,
    .why-section{
        grid-template-columns:1fr;
    }

    .about-content{
        grid-template-columns:1fr;
    }

    .about-left h1{
        font-size:42px;
    }

    .why-right h2{
        font-size:38px;
    }

}

</style>

@endsection