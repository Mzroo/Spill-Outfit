<section class="mt-4">
    <div class="container">

        <div id="heroCarousel" 
             class="carousel slide carousel-fade rounded-4 overflow-hidden shadow"
             data-bs-ride="carousel"
             data-bs-interval="4000"
             data-bs-pause="false">

            <!-- INDICATOR -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
            </div>

            <div class="carousel-inner">

                <!-- SLIDE 1 -->
                <div class="carousel-item active">
                    <img src="{{ asset('images/hero/gambar1.jpg') }}" class="d-block w-100 hero-img">

                    <div class="hero-overlay"></div>

                    <div class="carousel-caption text-start">
                        <div class="hero-box">
                            <h1 class="fw-bold mb-3">
                                Bingung Mau Pakai Apa Hari Ini?
                            </h1>

                            <p class="mb-3">
                                Pilih aktivitasmu dan dapatkan rekomendasi outfit lengkap
                                mulai dari baju, sepatu, hingga aksesoris.
                            </p>

                            <div class="d-flex gap-2 flex-wrap">
                                <a href="#kategori" class="btn hero-btn">
                                    Mulai Pilih Outfit
                                </a>

                                <a href="#produk" class="btn btn-outline-light rounded-pill">
                                    Lihat Produk
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2 -->
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/banner/campus.jpg') }}" class="d-block w-100 hero-img">
                    <div class="hero-overlay"></div>

                    <div class="carousel-caption text-start">
                        <div class="hero-box">
                            <h2 class="fw-bold">Outfit Kuliah</h2>
                            <p>Simple, nyaman, tapi tetap stylish untuk aktivitas kampus.</p>
                            <a href="/outfit/kuliah" class="btn hero-btn">Lihat Outfit</a>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 3 -->
                <div class="carousel-item">
                    <img src="{{ asset('images/hero/gambar3.jpg') }}" class="d-block w-100 hero-img">
                    <div class="hero-overlay"></div>

                    <div class="carousel-caption text-start">
                        <div class="hero-box">
                            <h2 class="fw-bold">Outfit Hangout</h2>
                            <p>Mix & match outfit santai biar tetap keren.</p>
                            <a href="/outfit/hangout" class="btn hero-btn">Coba Sekarang</a>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 4 -->
                <div class="carousel-item">
                    <img src="{{ asset('images/hero/gambar4.jpg') }}" class="d-block w-100 hero-img">
                    <div class="hero-overlay"></div>

                    <div class="carousel-caption text-start">
                        <div class="hero-box">
                            <h2 class="fw-bold">Outfit Kerja</h2>
                            <p>Profesional tapi tetap fashionable.</p>
                            <a href="/outfit/kerja" class="btn hero-btn">Lihat Rekomendasi</a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CONTROL -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.querySelector('#heroCarousel');

    new bootstrap.Carousel(carousel, {
        interval: 4000,   // 4 detik
        ride: 'carousel',
        pause: false,
        wrap: true
    });
});
</script>