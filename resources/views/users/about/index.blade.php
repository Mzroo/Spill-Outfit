@extends('layouts.user')

@section('title', 'About Us')

@section('content')

<section class="about-section">

    <!-- ================= HERO SECTION ================= -->
    <div class="about-hero">
        <div class="about-left">
            <span class="about-badge">ABOUT SPILL OUTFIT</span>
            <h1>Fashion Bukan Sekadar Pakaian, Tapi Cara Kamu Berekspresi ✨</h1>
            <p>
                Spill Outfit hadir untuk membantu kamu menemukan style terbaik yang aesthetic, 
                modern, dan sesuai dengan personality kamu.
            </p>
        </div>
        <div class="about-right">
            <div class="hero-img-wrapper">
                <img src="{{ asset('assets/images/banner/about.jpeg') }}" alt="Hero Image">
            </div>
        </div>
    </div>

    <!-- ================= VISION MISSION CARDS ================= -->
    <div class="about-content">
        <div class="about-card">
            <div class="icon-box">
                <i class="mdi mdi-lightbulb-on-outline"></i>
            </div>
            <h3>Our Vision</h3>
            <p>Menjadi platform fashion recommendation terbaik untuk generasi modern.</p>
        </div>

        <div class="about-card">
            <div class="icon-box">
                <i class="mdi mdi-star-outline"></i>
            </div>
            <h3>Our Mission</h3>
            <p>Membantu pengguna menemukan outfit yang stylish, aesthetic, dan nyaman dipakai sehari-hari.</p>
        </div>

        <div class="about-card">
            <div class="icon-box">
                <i class="mdi mdi-heart-outline"></i>
            </div>
            <h3>Our Value</h3>
            <p>Fashion harus membuat semua orang percaya diri dan tampil lebih baik.</p>
        </div>
    </div>

    <!-- ================= WHY CHOOSE US ================= -->
    <div class="why-section">
        <div class="why-left">
            <img src="{{ asset('assets/images/banner/Philippos.jpeg') }}" alt="Why Choose Us">
        </div>

        <div class="why-right">
            <span class="about-badge">WHY CHOOSE US</span>
            <h2>Kenapa Spill Outfit?</h2>

            <div class="why-item">
                <i class="mdi mdi-check-circle"></i>
                <div>
                    <h5>Fashion Modern</h5>
                    <p>Selalu mengikuti trend fashion terbaru.</p>
                </div>
            </div>

            <div class="why-item">
                <i class="mdi mdi-check-circle"></i>
                <div>
                    <h5>Style Recommendation</h5>
                    <p>Outfit sesuai aktivitas dan personality.</p>
                </div>
            </div>

            <div class="why-item">
                <i class="mdi mdi-check-circle"></i>
                <div>
                    <h5>User Friendly</h5>
                    <p>Tampilan nyaman dan mudah digunakan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= OUR TEAM SECTION (5 MEMBERS SIMETRIS) ================= -->
    <div class="team-section">
        <div class="team-header">
            <span class="about-badge">CREATIVE MIND</span>
            <h2>Meet Our Team</h2>
            <p>Orang-orang hebat di balik pengembangan platform Spill Outfit.</p>
        </div>

        <div class="team-container-flex">
            <!-- Anggota 1 -->
            <div class="team-card">
                <div class="team-img-container">
                    <img src="{{ asset('assets/images/anngota/sponchbob.jpeg') }}" alt="M. Adriansyah">
                </div>
                <div class="team-info">
                    <h4>M. Adriansyah</h4>
                    <span class="role">Backend Developer</span>
                    <p>Sistem Informasi - Universitas BSI</p>
                    <div class="team-social">
                        <a href="#"><i class="mdi mdi-github"></i></a>
                        <a href="#"><i class="mdi mdi-instagram"></i></a>
                        <a href="#"><i class="mdi mdi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <!-- Anggota 2 -->
            <div class="team-card">
                <div class="team-img-container">
                    <img src="{{ asset('assets/images/anngota/sponchbob.jpeg') }}" alt="Anggota 2">
                </div>
                <div class="team-info">
                    <h4>Felisa Kirana Agata</h4>
                    <span class="role">Project Manager</span>
                    <p>Sistem Informasi - Universitas BSI</p>
                    <div class="team-social">
                        <a href="#"><i class="mdi mdi-github"></i></a>
                        <a href="#"><i class="mdi mdi-instagram"></i></a>
                        <a href="#"><i class="mdi mdi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <!-- Anggota 3 -->
            <div class="team-card">
                <div class="team-img-container">
                    <img src="{{ asset('assets/images/anngota/sponchbob.jpeg') }}" alt="Anggota 3">
                </div>
                <div class="team-info">
                    <h4>Nicko Syahputra</h4>
                    <span class="role">Frontend Developer</span>
                    <p>Sistem Informasi - Universitas BSI</p>
                    <div class="team-social">
                        <a href="#"><i class="mdi mdi-github"></i></a>
                        <a href="#"><i class="mdi mdi-instagram"></i></a>
                        <a href="#"><i class="mdi mdi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <!-- Anggota 4 -->
            <div class="team-card">
                <div class="team-img-container">
                    <img src="{{ asset('assets/images/anngota/sponchbob.jpeg') }}" alt="Anggota 4">
                </div>
                <div class="team-info">
                    <h4>Julia Amelia</h4>
                    <span class="role">UI/UX Designer</span>
                    <p>Sistem Informasi - Universitas BSI</p>
                    <div class="team-social">
                        <a href="#"><i class="mdi mdi-github"></i></a>
                        <a href="#"><i class="mdi mdi-instagram"></i></a>
                        <a href="#"><i class="mdi mdi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <!-- Anggota 5 -->
            <div class="team-card">
                <div class="team-img-container">
                    <img src="{{ asset('assets/images/anngota/sponchbob.jpeg') }}" alt="Anggota 5">
                </div>
                <div class="team-info">
                    <h4>Tika Herlina</h4>
                    <span class="role">System Analyst</span>
                    <p>Sistem Informasi - Universitas BSI</p>
                    <div class="team-social">
                        <a href="#"><i class="mdi mdi-github"></i></a>
                        <a href="#"><i class="mdi mdi-instagram"></i></a>
                        <a href="#"><i class="mdi mdi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<style>
/* ================= UTILITIES & RESET GLOBAL ================= */
.about-section {
    padding: 60px 20px;
    max-width: 1200px;
    margin: 0 auto;
    font-family: 'Poppins', sans-serif;
}

.about-badge {
    display: inline-block;
    padding: 8px 20px;
    border-radius: 50px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.2);
}

/* ================= HERO SECTION ================= */
.about-hero {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-bottom: 120px;
}

.about-left h1 {
    font-size: 48px;
    font-weight: 800;
    line-height: 1.2;
    color: #2c2c2c;
    margin-bottom: 25px;
}

.about-left p {
    color: #666;
    line-height: 1.8;
    font-size: 16px;
}

.about-right img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

/* ================= VISION MISSION CARDS ================= */
.about-content {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 120px;
}

.about-card {
    background: white;
    border-radius: 24px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.4s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    border: 1px solid #f1f1f1;
}

.about-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 40px rgba(140, 106, 47, 0.12);
}

.icon-box {
    width: 80px;
    height: 80px;
    margin: 0 auto 25px;
    background: linear-gradient(135deg, rgba(140, 106, 47, 0.1), rgba(201, 162, 39, 0.1));
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-card i {
    font-size: 38px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.about-card h3 {
    font-size: 22px;
    font-weight: 700;
    color: #2c2c2c;
    margin-bottom: 15px;
}

.about-card p {
    color: #777;
    font-size: 15px;
    line-height: 1.7;
}

/* ================= WHY CHOOSE US ================= */
.why-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    margin-bottom: 120px;
}

.why-left img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

.why-right h2 {
    font-size: 38px;
    font-weight: 800;
    color: #2c2c2c;
    margin-bottom: 35px;
}

.why-item {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
}

.why-item i {
    font-size: 28px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.why-item h5 {
    font-size: 18px;
    font-weight: 700;
    color: #2c2c2c;
    margin-bottom: 5px;
}

.why-item p {
    color: #777;
    font-size: 15px;
}

/* ================= OUR TEAM SECTION (OPTIMIZED FOR 5 MEMBERS) ================= */
.team-section {
    padding-top: 40px;
}

.team-header {
    text-align: center;
    margin-bottom: 60px;
}

.team-header h2 {
    font-size: 38px;
    font-weight: 800;
    color: #2c2c2c;
    margin-bottom: 15px;
}

.team-header p {
    color: #777;
    font-size: 16px;
}

/* Menggunakan Flexbox agar baris kedua otomatis center */
.team-container-flex {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
}

.team-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    border: 1px solid #f1f1f1;
    transition: all 0.3s ease;
    text-align: center;
    /* Lebar diatur agar pas 3 kolom di layar besar kalkulasi margin */
    width: calc(33.333% - 20px);
    min-width: 280px; 
}

.team-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(140, 106, 47, 0.15);
    border-color: rgba(201, 162, 39, 0.2);
}

.team-img-container {
    width: 100%;
    height: 320px;
    overflow: hidden;
    background-color: #f9f9f9;
}

.team-img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.team-card:hover .team-img-container img {
    transform: scale(1.05);
}

.team-info {
    padding: 25px 20px;
}

.team-info h4 {
    font-size: 19px;
    font-weight: 700;
    color: #2c2c2c;
    margin-bottom: 5px;
}

.team-info .role {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    color: #8C6A2F;
    margin-bottom: 10px;
    background-color: rgba(140, 106, 47, 0.06);
    padding: 3px 12px;
    border-radius: 30px;
}

.team-info p {
    font-size: 13px;
    color: #999;
    margin-bottom: 15px;
}

.team-social {
    display: flex;
    justify-content: center;
    gap: 12px;
}

.team-social a {
    width: 36px;
    height: 36px;
    background: #f5f5f5;
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #555;
    text-decoration: none;
    transition: all 0.3s ease;
}

.team-social a:hover {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
}

/* ================= RESPONSIVE DESIGN ================= */
@media(max-width: 992px) {
    .about-hero, .why-section {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .about-content {
        grid-template-columns: 1fr;
    }

    .team-card {
        width: calc(50% - 15px); /* Menjadi 2 kolom di tablet */
    }

    .about-left h1 {
        font-size: 36px;
    }

    .why-right h2, .team-header h2 {
        font-size: 32px;
    }
    
    .about-right img, .why-left img {
        height: 400px;
    }
}

@media(max-width: 600px) {
    .team-card {
        width: 100%; /* Menjadi 1 kolom penuh di HP */
    }
}
</style>

@endsection