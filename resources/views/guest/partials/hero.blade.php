<div class="page-fade-entrance" id="pageEntranceWrapper">

    <section class="hero-section">
        <div class="container">
            <div class="hero-wrapper">
                <div class="row align-items-center g-4">

                    <div class="col-lg-7">
                        <div class="hero-content">
                            <span class="hero-badge">
                                ✨ Fashion Recommendation
                            </span>

                            <h1>
                                Temukan Outfit <br>
                                Terbaik Untuk <span>Gayamu</span>
                            </h1>

                            <p>
                                Spill Outfit membantu kamu menemukan gaya terbaik untuk kuliah, nongkrong, kerja, hingga daily outfit dengan tampilan modern dan stylish.
                            </p>

                            <div class="hero-buttons">
                                <a href="{{ route('guest.produk.index') }}" class="btn-gold">
                                    Jelajahi Outfit
                                </a>

                                @auth
                                    <a href="{{ route('guest.produk.index') }}" class="btn-outline-custom">
                                        Lihat Kategori
                                    </a>
                                @else
                                    <a href="javascript:void(0)" onclick="pemicuHeroKategoriAlert()" class="btn-outline-custom">
                                        Lihat Kategori
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="hero-grid">

                            <div class="hero-card large">
                                <img src="{{ asset('assets/images/banner/campus.jpg') }}" alt="Campus Outfit">
                                <div class="overlay"></div>
                                <div class="hero-card-content">
                                    <span>Campus Look</span>
                                    <h5>Outfit Kuliah</h5>
                                </div>
                            </div>

                            <div class="hero-card">
                                <img src="{{ asset('assets/images/banner/casual.jpeg') }}" alt="Casual Outfit">
                                <div class="overlay"></div>
                                <div class="hero-card-content">
                                    <span>Casual</span>
                                    <h6>Hangout Style</h6>
                                </div>
                            </div>

                            <div class="hero-card">
                                <img src="{{ asset('assets/images/banner/office.jpeg') }}" alt="Office Outfit">
                                <div class="overlay"></div>
                                <div class="hero-card-content">
                                    <span>Office</span>
                                    <h6>Work Style</h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // FUNGSI AKTIVASI SMOOTH ENTRANCE SAAAT DOM SELESAI LOAD
    document.addEventListener("DOMContentLoaded", function() {
        const wrapper = document.getElementById("pageEntranceWrapper");
        if(wrapper) {
            wrapper.classList.add("loaded");
        }
    });

    function pemicuHeroKategoriAlert() {
        Swal.fire({
            title: 'Akses Terbatas! ✨',
            text: 'Kamu harus login terlebih dahulu untuk menjelajahi berbagai kategori grup outfit premium kami.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8C6A2F',
            cancelButtonColor: '#777777',
            confirmButtonText: '<i class="mdi mdi-login me-1"></i> Login Sekarang',
            cancelButtonText: 'Nanti Saja',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-5 border shadow-sm'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Efek transisi keluar sebelum pindah halaman login
                document.getElementById("pageEntranceWrapper").style.opacity = "0";
                setTimeout(() => {
                    window.location.href = "{{ route('login') }}";
                }, 300);
            }
        });
    }
</script>

<style>
/* ================= MAGIC SMOOTH ANIMATION LAYER ================= */
.page-fade-entrance {
    opacity: 0;
    transform: translateY(12px); /* Efek melayang naik sedikit saat muncul */
    transition: opacity 0.6s cubic-bezier(0.25, 1, 0.5, 1), transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    will-change: opacity, transform;
}

.page-fade-entrance.loaded {
    opacity: 1;
    transform: translateY(0);
}

/* ================= HERO SECTION ================= */
.hero-section{
    min-height:calc(100vh - 80px);
    display:flex;
    align-items:center;
    padding:35px 0 50px;
    background:#fff;
    font-family: 'Poppins', sans-serif;
}
.hero-section *, .hero-section *::before, .hero-section *::after {
    box-sizing: border-box;
}

/* ================= WRAPPER ================= */
.hero-wrapper{
    width:100%;
    background: linear-gradient(180deg, #ffffff, #faf8f3);
    border:1px solid #f0ece1;
    border-radius:40px;
    padding:55px;
    overflow:hidden;
}

/* ================= LEFT CONTENT ================= */
.hero-content{
    max-width:580px;
}

/* BADGE */
.hero-badge{
    display:inline-flex;
    align-items:center;
    padding:10px 18px;
    border-radius:50px;
    background:#f8f4e7;
    color:#8C6A2F;
    font-size:14px;
    font-weight:600;
    margin-bottom:20px;
}

/* TITLE */
.hero-content h1{
    font-size:58px;
    font-weight:700;
    line-height:1.15;
    color:#222;
}
.hero-content h1 span{
    color:#B68D40;
}

/* DESCRIPTION */
.hero-content p{
    margin-top:20px;
    font-size:17px;
    line-height:1.9;
    color:#666;
}

/* ================= BUTTON ================= */
.hero-buttons{
    margin-top:35px;
    display:flex;
    gap:15px;
}

/* GOLD BUTTON */
.btn-gold{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color:white;
    padding:15px 30px;
    border-radius:50px;
    font-weight:600;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
}
.btn-gold:hover{
    color:white;
    transform:translateY(-4px); /* Peninggian lonjakan hover biar makin kenyal */
    box-shadow: 0 12px 28px rgba(140, 106, 47, 0.25);
}

/* OUTLINE BUTTON */
.btn-outline-custom{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid #ddd;
    color:#444;
    padding:15px 30px;
    border-radius:50px;
    font-weight:600;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
}
.btn-outline-custom:hover{
    border-color:#B68D40;
    color:#B68D40;
    background-color: #faf7f2;
    transform:translateY(-2px);
}

/* ================= RIGHT GRID ================= */
.hero-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}

/* BIG CARD */
.large{
    grid-column:span 2;
    height:250px !important;
}

/* CARD */
.hero-card{
    position:relative;
    height:190px;
    border-radius:28px;
    overflow:hidden;
    cursor:pointer;
    box-shadow: 0 8px 30px rgba(0,0,0,.06);
    transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.5s ease;
}
.hero-card:hover{
    transform:translateY(-6px);
    box-shadow: 0 15px 35px rgba(140, 106, 47, 0.12);
}
.hero-card img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition: transform 0.7s cubic-bezier(0.25, 1, 0.5, 1);
}
.hero-card:hover img{
    transform:scale(1.06);
}

/* OVERLAY */
.overlay{
    position:absolute;
    inset:0;
    background: linear-gradient(to top, rgba(0,0,0,.65), rgba(0,0,0,.08));
}

/* TEXT */
.hero-card-content{
    position:absolute;
    bottom:22px;
    left:22px;
    color:white;
    z-index:2;
}
.hero-card-content span{
    font-size:13px;
    opacity:.9;
}
.hero-card-content h5,
.hero-card-content h6{
    margin-top:5px;
    margin-bottom:0;
    font-weight:600;
}

/* SWEETALERT POPUP OVERRIDE ROUNDED */
.rounded-5 {
    border-radius: 24px !important;
}

/* ================= RESPONSIVE ================= */
@media(max-width:991px){
    .hero-section{ min-height:auto; padding:20px 0 40px; }
    .hero-wrapper{ padding:35px; }
    .hero-content h1{ font-size:42px; }
    .hero-grid{ margin-top:25px; }
}

@media(max-width:768px){
    .hero-wrapper{ padding:28px; border-radius:28px; }
    .hero-content h1{ font-size:34px; }
    .hero-content p{ font-size:15px; }
    .hero-buttons{ flex-direction:column; }
    .hero-grid{ grid-template-columns:1fr; }
    .large{ grid-column:span 1; }
    .hero-card{ height:220px; }
}
</style>