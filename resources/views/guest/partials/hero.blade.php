<section class="hero-section">

    <div class="container">

        <div class="hero-wrapper">

            <div class="row align-items-center g-4">

                <!-- LEFT -->
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
                            Spill Outfit membantu kamu menemukan gaya terbaik
                            untuk kuliah, nongkrong, kerja, hingga daily outfit
                            dengan tampilan modern dan stylish.
                        </p>

                        <div class="hero-buttons">

                            <a href=""
                               class="btn-gold">

                                Jelajahi Outfit

                            </a>

                            <a href=""
                               class="btn-outline-custom">

                                Lihat Kategori

                            </a>

                        </div>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-5">

                    <div class="hero-grid">

                        <!-- CARD BESAR -->
                        <div class="hero-card large">

                            <img src="{{ asset('assets/images/banner/campus.jpg') }}"
                                 alt="Campus Outfit">

                            <div class="overlay"></div>

                            <div class="hero-card-content">

                                <span>Campus Look</span>
                                <h5>Outfit Kuliah</h5>

                            </div>

                        </div>

                        <!-- CARD 1 -->
                        <div class="hero-card">

                            <img src="{{ asset('images/hero/gambar3.jpg') }}"
                                 alt="Casual Outfit">

                            <div class="overlay"></div>

                            <div class="hero-card-content">

                                <span>Casual</span>
                                <h6>Hangout Style</h6>

                            </div>

                        </div>

                        <!-- CARD 2 -->
                        <div class="hero-card">

                            <img src="{{ asset('images/hero/gambar4.jpg') }}"
                                 alt="Office Outfit">

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

<style>

/* ================= HERO SECTION ================= */

.hero-section{

    min-height:calc(100vh - 80px);

    display:flex;
    align-items:center;

    padding:35px 0 50px;

    background:#fff;
}

/* ================= WRAPPER ================= */

.hero-wrapper{

    width:100%;

    background:
    linear-gradient(
        180deg,
        #ffffff,
        #faf8f3
    );

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

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    padding:15px 30px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.btn-gold:hover{

    color:white;

    transform:translateY(-3px);

    box-shadow:
    0 10px 25px rgba(201,162,39,.25);
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

    transition:.3s;
}

.btn-outline-custom:hover{

    border-color:#B68D40;

    color:#B68D40;
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

    box-shadow:
    0 8px 30px rgba(0,0,0,.06);

    transition:.4s;
}

.hero-card:hover{
    transform:translateY(-6px);
}

.hero-card img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;
}

.hero-card:hover img{
    transform:scale(1.08);
}

/* OVERLAY */

.overlay{

    position:absolute;
    inset:0;

    background:
    linear-gradient(
        to top,
        rgba(0,0,0,.65),
        rgba(0,0,0,.08)
    );
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

/* ================= RESPONSIVE ================= */

@media(max-width:991px){

    .hero-section{

        min-height:auto;

        padding:20px 0 40px;
    }

    .hero-wrapper{
        padding:35px;
    }

    .hero-content h1{
        font-size:42px;
    }

    .hero-grid{
        margin-top:25px;
    }

}

@media(max-width:768px){

    .hero-wrapper{
        padding:28px;
        border-radius:28px;
    }

    .hero-content h1{
        font-size:34px;
    }

    .hero-content p{
        font-size:15px;
    }

    .hero-buttons{
        flex-direction:column;
    }

    .hero-grid{
        grid-template-columns:1fr;
    }

    .large{
        grid-column:span 1;
    }

    .hero-card{
        height:220px;
    }

}

</style>