@extends('layouts.app')

@section('content')

@include('guest.partials.navbar')

<section class="about-page">

    <div class="container">

        <!-- ================= HERO ================= -->

        <div class="about-hero">

            <span class="about-badge">
                ✨ Tentang Spill Outfit
            </span>

            <h1>
                Fashion Lebih Mudah, <br>
                Lebih <span>Stylish</span>, Lebih Modern
            </h1>

            <p>
                Spill Outfit hadir untuk membantu kamu menemukan outfit terbaik
                untuk kuliah, nongkrong, kerja, hingga daily style dengan
                rekomendasi fashion yang simpel dan modern.
            </p>

        </div>

        <!-- ================= STORY ================= -->

        <section class="about-section">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <div class="about-card">

                        <span class="card-badge">
                            Our Story
                        </span>

                        <h2>
                            Kenapa Spill Outfit Dibuat?
                        </h2>

                        <p>
                            Banyak orang bingung menentukan outfit yang cocok
                            untuk aktivitas sehari-hari. Karena itu,
                            Spill Outfit dibuat sebagai platform rekomendasi
                            fashion yang membantu pengguna menemukan inspirasi
                            outfit dengan cepat dan nyaman.
                        </p>

                        <p>
                            Kami percaya bahwa tampil stylish tidak harus ribet.
                            Dengan rekomendasi yang tepat, siapa pun bisa tampil
                            percaya diri.
                        </p>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="about-highlight">

                        <div class="highlight-item">
                            <h3>1000+</h3>
                            <p>Inspirasi Outfit</p>
                        </div>

                        <div class="highlight-item">
                            <h3>100+</h3>
                            <p>Kategori Style</p>
                        </div>

                        <div class="highlight-item">
                            <h3>24/7</h3>
                            <p>Fashion Inspiration</p>
                        </div>

                        <div class="highlight-item">
                            <h3>Modern</h3>
                            <p>Recommendation</p>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- ================= VISION MISSION ================= -->

        <section class="vision-section">

            <div class="row g-4">

                <div class="col-lg-6">

                    <div class="vision-card">

                        <div class="icon-box">
                            ✨
                        </div>

                        <h3>
                            Visi
                        </h3>

                        <p>
                            Menjadi platform fashion recommendation terbaik
                            yang membantu pengguna tampil lebih percaya diri
                            dengan gaya outfit modern dan stylish.
                        </p>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="vision-card">

                        <div class="icon-box">
                            🚀
                        </div>

                        <h3>
                            Misi
                        </h3>

                        <p>
                            Memberikan inspirasi outfit terbaik, pengalaman
                            pengguna yang sederhana, dan rekomendasi fashion
                            yang mudah diakses semua orang.
                        </p>

                    </div>

                </div>

            </div>

        </section>

        <!-- ================= WHY CHOOSE US ================= -->

        <section class="choose-section">

            <div class="section-title">

                <span>
                    Why Choose Us
                </span>

                <h2>
                    Kenapa Memilih
                    <span>Spill Outfit?</span>
                </h2>

            </div>

            <div class="row g-4 mt-3">

                <div class="col-lg-3 col-md-6">

                    <div class="choose-card">

                        <h4>
                            🎯 Recommendation
                        </h4>

                        <p>
                            Rekomendasi outfit sesuai aktivitasmu.
                        </p>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="choose-card">

                        <h4>
                            🔥 Trend Style
                        </h4>

                        <p>
                            Selalu update dengan style modern.
                        </p>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="choose-card">

                        <h4>
                            👕 Many Categories
                        </h4>

                        <p>
                            Outfit kuliah, kerja, casual, dan lainnya.
                        </p>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="choose-card">

                        <h4>
                            ⚡ Easy To Use
                        </h4>

                        <p>
                            Interface simpel dan nyaman digunakan.
                        </p>

                    </div>

                </div>

            </div>

        </section>

        <!-- ================= CTA ================= -->

        <section class="about-cta">

            <h2>
                Temukan Outfit Terbaikmu Sekarang
            </h2>

            <p>
                Login dan mulai eksplorasi berbagai inspirasi outfit terbaik
                untuk gaya fashionmu ✨
            </p>

            <div class="cta-buttons">

                <a href="{{ route('login') }}"
                   class="btn-gold">

                    Login Sekarang

                </a>

                <a href="{{ route('produk.index') }}"
                   class="btn-outline-custom">

                    Jelajahi Produk

                </a>

            </div>

        </section>

    </div>

</section>

@include('guest.partials.footer')

<style>

.content {
    margin-left: 40px;
    margin-right: 40px;
}

/* ================= PAGE ================= */

.about-page{
    padding:130px 0 90px;
    background:#fff;
}

/* HERO */

.about-hero{
    text-align:center;
    max-width:850px;
    margin:auto;
}

.about-badge{
    display:inline-flex;
    padding:12px 20px;
    border-radius:50px;
    background:#f8f4e7;
    color:#8C6A2F;
    font-weight:600;
}

.about-hero h1{
    margin-top:25px;
    font-size:58px;
    font-weight:700;
    color:#222;
}

.about-hero h1 span{
    color:#B68D40;
}

.about-hero p{
    margin-top:20px;
    color:#666;
    line-height:1.9;
}

/* SECTION */

.about-section,
.vision-section,
.choose-section{
    margin-top:90px;
}

/* CARD */

.about-card,
.vision-card,
.choose-card{
    background:white;
    border:1px solid #f2ead8;
    border-radius:30px;
    padding:35px;
    transition:.3s;
}

.about-card:hover,
.vision-card:hover,
.choose-card:hover{
    transform:translateY(-6px);
    box-shadow:0 20px 40px rgba(0,0,0,.08);
}

.card-badge{
    color:#B68D40;
    font-weight:600;
}

.about-card h2{
    margin:20px 0;
}

/* HIGHLIGHT */

.about-highlight{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
}

.highlight-item{
    background:#faf8f3;
    border-radius:25px;
    padding:35px;
    text-align:center;
}

.highlight-item h3{
    color:#B68D40;
    font-size:36px;
}

/* VISION */

.icon-box{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#f8f4e7;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:30px;
    margin-bottom:20px;
}

/* TITLE */

.section-title{
    text-align:center;
}

.section-title span{
    color:#B68D40;
    font-weight:600;
}

.section-title h2{
    margin-top:12px;
    font-size:46px;
}

/* CTA */

.about-cta{
    margin-top:100px;
    text-align:center;
    padding:70px;
    border-radius:40px;
    background:linear-gradient(
        180deg,
        #faf8f3,
        #f5efdf
    );
}

.cta-buttons{
    margin-top:30px;
    display:flex;
    justify-content:center;
    gap:15px;
    flex-wrap:wrap;
}

.btn-gold{
    background:linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
    padding:16px 28px;
    border-radius:50px;
}

.btn-outline-custom{
    border:1px solid #ddd;
    padding:16px 28px;
    border-radius:50px;
    color:#444;
}

@media(max-width:768px){

    .about-page{
        padding:110px 0 70px;
    }

    .about-hero h1{
        font-size:38px;
    }

    .section-title h2{
        font-size:32px;
    }

    .about-highlight{
        grid-template-columns:1fr;
    }

    .about-cta{
        padding:40px 25px;
    }

}

</style>

@endsection