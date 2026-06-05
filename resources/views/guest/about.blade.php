@extends('layouts.app')

@section('content')

@include('guest.partials.navbar')

<section class="about-page">

    <div class="container">

        <!-- ================= HERO BRANDING ================= -->
        <div class="about-hero">

            <span class="about-badge">
                <i class="fa-solid fa-sparkles me-1"></i> Tentang Spill Outfit
            </span>

            <h1>
                Fashion Lebih Mudah, <br>
                Lebih <span>Stylish</span>, Lebih Modern
            </h1>

            <p>
                Spill Outfit hadir untuk membantu kamu menemukan outfit terbaik
                untuk kuliah, nongkrong, kerja, hingga daily style dengan
                rekomendasi fashion yang simpel, interaktif, dan modern.
            </p>

        </div>

        <!-- ================= STORY & STATS ================= -->
        <section class="about-section">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <div class="about-card">

                        <span class="card-badge">
                            <i class="fa-solid fa-book-open me-1"></i> Our Story
                        </span>

                        <h2>
                            Kenapa Spill Outfit Dibuat?
                        </h2>

                        <p>
                            Banyak orang sering membuang waktu dan bingung menentukan padu padan outfit yang cocok untuk aktivitas sehari-hari. Karena itu, Spill Outfit dibuat sebagai platform rekomendasi fashion terpadu yang membantu pengguna menemukan inspirasi outfit dengan cepat dan nyaman.
                        </p>

                        <p>
                            Kami percaya bahwa tampil stylish tidak harus mahal atau ribet. Dengan rekomendasi dan kurasi style yang tepat, siapa pun bisa tampil lebih percaya diri setiap hari.
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

        <!-- ================= VISION & MISSION ================= -->
        <section class="vision-section">

            <div class="row g-4">

                <div class="col-lg-6">

                    <div class="vision-card">

                        <div class="icon-box">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </div>

                        <h3>Visi</h3>

                        <p>
                            Menjadi platform fashion recommendation terbaik yang membantu pengguna tampil lebih percaya diri dengan panduan gaya outfit modern, inklusif, dan stylish di segala aktivitas.
                        </p>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="vision-card">

                        <div class="icon-box">
                            <i class="fa-solid fa-rocket"></i>
                        </div>

                        <h3>Misi</h3>

                        <p>
                            Memberikan inspirasi outfit terbaik, membangun wadah komunitas fashion yang interaktif, memberikan pengalaman pengguna yang sederhana, serta rekomendasi tren ter-update.
                        </p>

                    </div>

                </div>

            </div>

        </section>

        <!-- ================= WHY CHOOSE US ================= -->
        <section class="choose-section">

            <div class="section-title">

                <span class="sub-title-badge">
                    Why Choose Us
                </span>

                <h2>
                    Kenapa Memilih <span>Spill Outfit?</span>
                </h2>

            </div>

            <div class="row g-4 mt-3">

                <div class="col-lg-3 col-md-6">

                    <div class="choose-card">
                        <div class="choose-icon-wrapper">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <h4>Recommendation</h4>
                        <p>Rekomendasi outfit akurat yang dipersonalisasi sesuai jenis aktivitasmu.</p>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="choose-card">
                        <div class="choose-icon-wrapper">
                            <i class="fa-solid fa-fire-flame-curved"></i>
                        </div>
                        <h4>Trend Style</h4>
                        <p>Selalu bergerak maju dan update dengan perkembangan kiblat fashion modern.</p>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="choose-card">
                        <div class="choose-icon-wrapper">
                            <i class="fa-solid fa-shirt"></i>
                        </div>
                        <h4>Many Categories</h4>
                        <p>Temukan ragam pilihan mulai dari outfit kuliah, kerja, kasual, hingga streetwear.</p>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="choose-card">
                        <div class="choose-icon-wrapper">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h4>Easy To Use</h4>
                        <p>Antarmuka (interface) aplikasi yang bersih, simpel, intuitif, dan nyaman digunakan.</p>
                    </div>

                </div>

            </div>

        </section>

        <!-- ================= CALL TO ACTION (CTA) ================= -->
        <section class="about-cta">

            <h2>Temukan Outfit Terbaikmu Sekarang</h2>

            <p>
                Gabung sekarang untuk mulai mengeksplorasi dan membagikan berbagai inspirasi outfit terbaik demi memaksimalkan gaya fashion harianmu! ✨
            </p>

            <div class="cta-buttons">

                <a href="{{ route('login') }}" class="btn-gold">
                    <span>Login Sekarang</span>
                    <i class="fa-solid fa-right-to-bracket ms-1"></i>
                </a>

                <a href="{{ route('produk.index') }}" class="btn-outline-custom">
                    <span>Jelajahi Produk</span>
                    <i class="fa-solid fa-bag-shopping ms-1"></i>
                </a>

            </div>

        </section>

    </div>

</section>

@include('guest.partials.footer')

<style>
/* ================= GLOBAL CONFIGURATION ================= */
.content {
    margin-left: 40px;
    margin-right: 40px;
}

.about-page {
    padding: 140px 0 90px;
    background: #fff;
    font-family: 'Poppins', sans-serif;
}

/* HERO BRANDING TITLE */
.about-hero {
    text-align: center;
    max-width: 850px;
    margin: auto;
}

.about-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 20px;
    border-radius: 50px;
    background: #f8f4e7;
    color: #8C6A2F;
    font-weight: 600;
    font-size: 14px;
}

.about-hero h1 {
    margin-top: 25px;
    font-size: 56px;
    font-weight: 800;
    color: #222;
    letter-spacing: -1.5px;
    line-height: 1.2;
}

.about-hero h1 span {
    color: #B68D40;
}

.about-hero p {
    margin-top: 20px;
    color: #666;
    line-height: 1.9;
    font-size: 16px;
}

/* LAYOUT CONTAINER INTERACTION */
.about-section, .vision-section, .choose-section {
    margin-top: 95px;
}

/* CARDS REFACTOR SYSTEM */
.about-card, .vision-card, .choose-card {
    background: white;
    border: 1px solid #f5efe2;
    border-radius: 32px;
    padding: 38px;
    transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    height: 100%;
}

.about-card:hover, .vision-card:hover, .choose-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(140, 106, 47, 0.06);
    border-color: #ebdcb9;
}

.card-badge {
    color: #B68D40;
    font-weight: 700;
    font-size: 13.5px;
    display: inline-flex;
    align-items: center;
}

.about-card h2 {
    margin: 18px 0;
    font-weight: 800;
    color: #222;
    font-size: 28px;
}

.about-card p {
    color: #555;
    font-size: 14.5px;
    line-height: 1.8;
}

/* STATISTICS COUNTER BOXES */
.about-highlight {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}

.highlight-item {
    background: #faf8f3;
    border-radius: 28px;
    padding: 40px 20px;
    text-align: center;
    border: 1px solid #f9f5eb;
    transition: all 0.3s ease;
}

.highlight-item:hover {
    background: #fdfaf2;
    border-color: #e6dcbe;
}

.highlight-item h3 {
    color: #8C6A2F;
    font-size: 40px;
    font-weight: 800;
    margin-bottom: 6px;
}

.highlight-item p {
    color: #666;
    font-weight: 600;
    font-size: 14px;
    margin: 0;
}

/* VISIONS VECTOR ICON CIRCLE */
.icon-box {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    background: #f8f4e7;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 26px;
    margin-bottom: 24px;
    color: #8C6A2F;
}

.vision-card h3 {
    font-weight: 800;
    font-size: 24px;
    color: #222;
    margin-bottom: 14px;
}

.vision-card p {
    color: #555;
    line-height: 1.8;
    font-size: 14.5px;
    margin: 0;
}

/* SECTION TITLES CENTERED */
.section-title {
    text-align: center;
}

.sub-title-badge {
    color: #8C6A2F;
    font-weight: 700;
    background: #faf6ed;
    padding: 8px 18px;
    border-radius: 50px;
    font-size: 13px;
}

.section-title h2 {
    margin-top: 16px;
    font-size: 42px;
    font-weight: 800;
    letter-spacing: -0.5px;
}

.section-title h2 span {
    color: #B68D40;
}

/* CHOOSE CARDS INNER ELEMENTS */
.choose-icon-wrapper {
    width: 52px;
    height: 52px;
    background: #fdfbf7;
    border: 1px solid #f5efe2;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #B68D40;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.choose-card:hover .choose-icon-wrapper {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border-color: transparent;
}

.choose-card h4 {
    font-size: 18px;
    font-weight: 700;
    color: #222;
    margin-bottom: 10px;
}

.choose-card p {
    color: #666;
    font-size: 13.5px;
    line-height: 1.6;
    margin: 0;
}

/* MARKETING CTA DECORATION */
.about-cta {
    margin-top: 110px;
    text-align: center;
    padding: 75px 40px;
    border-radius: 40px;
    background: linear-gradient(180deg, #faf8f3, #f5efdf);
    border: 1px solid #ebdcb9;
}

.about-cta h2 {
    font-weight: 800;
    font-size: 34px;
    color: #1a1a1a;
}

.about-cta p {
    max-width: 600px;
    margin: 15px auto 0;
    color: #555;
    font-size: 15px;
    line-height: 1.7;
}

.cta-buttons {
    margin-top: 35px;
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-gold {
    text-decoration: none;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 15px 32px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 14.5px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.2);
}

.btn-gold:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.35);
}

.btn-outline-custom {
    text-decoration: none;
    border: 1px solid #ebdcb9;
    background: #fff;
    padding: 15px 32px;
    border-radius: 50px;
    color: #8C6A2F;
    font-weight: 600;
    font-size: 14.5px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}

.btn-outline-custom:hover {
    background: #faf6ed;
    color: #614619;
}

/* ==================================================================
   ================= RESPONSIVE MEDIA BREAKPOINTS ===================
   ================================================================== */
@media(max-width: 768px) {
    .about-page {
        padding: 110px 0 70px;
    }

    .about-hero h1 {
        font-size: 36px;
    }

    .section-title h2 {
        font-size: 32px;
    }

    .about-highlight {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .about-card, .vision-card, .choose-card {
        padding: 30px;
    }

    .about-cta {
        padding: 50px 20px;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-gold, .btn-outline-custom {
        justify-content: center;
    }
}
</style>

@endsection