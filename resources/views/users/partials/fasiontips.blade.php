<!-- ================= FASHION TIPS ================= -->

<section class="fashion-tips-section">

    <!-- HEADER -->

    <div class="tips-header">

        <div>

            <span class="tips-badge">
                ✨ Fashion Tips
            </span>

            <h2>
                Tips Fashion Untuk
                <span>Tampil Stylish</span>
            </h2>

            <p>
                Pelajari berbagai tips sederhana agar outfit
                harianmu terlihat lebih keren, modern,
                dan percaya diri.
            </p>

        </div>

        <a href=""
           class="btn-view-tips">

            Lihat Semua Tips

        </a>

    </div>

    <!-- GRID -->

    <div class="row g-4">

        <!-- CARD 1 -->

        <div class="col-lg-4 col-md-6">

            <div class="tips-card">

                <div class="tips-icon">

                    <i class="mdi mdi-tshirt-crew-outline"></i>

                </div>

                <span class="tips-category">
                    Outfit Kuliah
                </span>

                <h4>
                    Cara Mix Outfit Kuliah
                    Agar Tetap Stylish
                </h4>

                <p>
                    Gunakan kombinasi hoodie, jeans,
                    dan sneakers agar terlihat simple,
                    rapi, tetapi tetap fashionable.
                </p>

                <a href=""
                   class="tips-link">

                    Baca Selengkapnya

                    <i class="mdi mdi-arrow-right"></i>

                </a>

            </div>

        </div>

        <!-- CARD 2 -->

        <div class="col-lg-4 col-md-6">

            <div class="tips-card">

                <div class="tips-icon">

                    <i class="mdi mdi-palette-outline"></i>

                </div>

                <span class="tips-category">
                    Warna Outfit
                </span>

                <h4>
                    Memilih Kombinasi
                    Warna Yang Cocok
                </h4>

                <p>
                    Gunakan warna netral seperti hitam,
                    putih, dan beige agar outfit lebih
                    mudah dipadukan.
                </p>

                <a href=""
                   class="tips-link">

                    Baca Selengkapnya

                    <i class="mdi mdi-arrow-right"></i>

                </a>

            </div>

        </div>

        <!-- CARD 3 -->

        <div class="col-lg-4 col-md-6">

            <div class="tips-card">

                <div class="tips-icon">

                    <i class="mdi mdi-star-outline"></i>

                </div>

                <span class="tips-category">
                    Daily Fashion
                </span>

                <h4>
                    Tampil Stylish
                    Dengan Budget Minim
                </h4>

                <p>
                    Fokus pada outfit basic berkualitas
                    dan mix & match sederhana agar tetap
                    fashionable tanpa mahal.
                </p>

                <a href=""
                   class="tips-link">

                    Baca Selengkapnya

                    <i class="mdi mdi-arrow-right"></i>

                </a>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= FASHION TIPS ================= */

.fashion-tips-section{
    margin-top:90px;
}

/* HEADER */

.tips-header{

    display:flex;

    justify-content:space-between;

    align-items:end;

    gap:20px;

    flex-wrap:wrap;

    margin-bottom:40px;
}

.tips-badge{

    display:inline-flex;

    padding:10px 18px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;

    font-weight:600;

    margin-bottom:18px;
}

.tips-header h2{

    font-size:42px;

    font-weight:700;

    color:#222;
}

.tips-header h2 span{
    color:#B68D40;
}

.tips-header p{

    margin-top:14px;

    max-width:550px;

    color:#777;

    line-height:1.9;
}

/* BUTTON */

.btn-view-tips{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    padding:15px 26px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.btn-view-tips:hover{

    color:white;

    transform:translateY(-3px);
}

/* CARD */

.tips-card{

    background:white;

    border-radius:32px;

    padding:35px;

    border:1px solid #f2ead8;

    transition:.35s;

    height:100%;
}

.tips-card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 20px 40px rgba(0,0,0,.06);
}

/* ICON */

.tips-icon{

    width:75px;
    height:75px;

    border-radius:24px;

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

    margin-bottom:22px;
}

/* CONTENT */

.tips-category{

    color:#B68D40;

    font-size:14px;

    font-weight:600;
}

.tips-card h4{

    margin-top:14px;

    font-size:24px;

    font-weight:700;

    color:#222;

    line-height:1.5;
}

.tips-card p{

    margin-top:14px;

    color:#777;

    line-height:1.9;
}

/* LINK */

.tips-link{

    display:inline-flex;

    align-items:center;

    gap:8px;

    margin-top:20px;

    color:#8C6A2F;

    font-weight:600;

    transition:.3s;
}

.tips-link:hover{

    color:#B68D40;

    transform:translateX(4px);
}

/* MOBILE */

@media(max-width:768px){

    .fashion-tips-section{
        margin-top:70px;
    }

    .tips-header h2{
        font-size:32px;
    }

    .tips-card{
        padding:28px;
    }

    .tips-card h4{
        font-size:20px;
    }

}

</style>