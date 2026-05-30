<!-- ================= REKOMENDASI OUTFIT ================= -->

<section class="recommend-section">

    <div class="section-header-custom">

        <div>

            <span class="section-badge">
                ✨ Personalized Outfit
            </span>

            <h2>
                Rekomendasi <span>Outfit</span>
                Untuk Kamu
            </h2>

            <p>
                Outfit pilihan yang cocok untuk kuliah,
                hangout, kerja, hingga daily style.
            </p>

        </div>

        <a href="{{ route('produk.index') }}"
           class="btn-view-all">

            Lihat Semua

        </a>

    </div>

    <!-- GRID -->

    <div class="row g-4">

        @for ($i = 1; $i <= 4; $i++)

            <div class="col-lg-3 col-md-6">

                <div class="recommend-card">

                    <!-- IMAGE -->

                    <div class="recommend-image">

                        <img src="https://picsum.photos/500/600?random={{ $i }}">

                        <span class="recommend-badge">
                            Trending
                        </span>

                    </div>

                    <!-- CONTENT -->

                    <div class="recommend-content">

                        <span class="recommend-category">
                            Campus Style
                        </span>

                        <h5>
                            Outfit Stylish {{ $i }}
                        </h5>

                        <div class="recommend-footer">

                            <div>
                                <small>Mulai dari</small>
                                <h6>Rp149.000</h6>
                            </div>

                            <a href=""
                               class="btn-detail-user">

                                Detail

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @endfor

    </div>

</section>

<style>

/* ================= SECTION ================= */

.recommend-section{
    margin-top:50px;
}

/* HEADER */

.section-header-custom{

    display:flex;

    justify-content:space-between;
    align-items:end;

    gap:20px;

    margin-bottom:35px;

    flex-wrap:wrap;
}

.section-badge{

    display:inline-flex;

    padding:10px 18px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;

    font-weight:600;

    margin-bottom:18px;
}

.section-header-custom h2{

    font-size:42px;

    font-weight:700;

    color:#222;
}

.section-header-custom h2 span{
    color:#B68D40;
}

.section-header-custom p{

    color:#777;

    max-width:500px;

    line-height:1.8;

    margin-top:12px;
}

/* BUTTON */

.btn-view-all{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    padding:14px 24px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.btn-view-all:hover{

    color:white;

    transform:translateY(-3px);
}

/* CARD */

.recommend-card{

    background:white;

    border-radius:32px;

    overflow:hidden;

    border:1px solid #f2ead8;

    transition:.35s;

    height:100%;
}

.recommend-card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 20px 40px rgba(0,0,0,.06);
}

/* IMAGE */

.recommend-image{

    position:relative;

    height:300px;

    overflow:hidden;
}

.recommend-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;
}

.recommend-card:hover img{
    transform:scale(1.08);
}

.recommend-badge{

    position:absolute;

    top:18px;
    left:18px;

    background:white;

    color:#8C6A2F;

    padding:8px 15px;

    border-radius:50px;

    font-size:12px;

    font-weight:600;
}

/* CONTENT */

.recommend-content{
    padding:22px;
}

.recommend-category{

    color:#B68D40;

    font-size:13px;

    font-weight:600;
}

.recommend-content h5{

    margin-top:10px;

    font-weight:700;

    color:#222;
}

/* FOOTER */

.recommend-footer{

    display:flex;

    justify-content:space-between;
    align-items:center;

    margin-top:22px;
}

.recommend-footer small{
    color:#999;
}

.recommend-footer h6{

    margin:0;

    font-weight:700;

    color:#222;
}

.btn-detail-user{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    border-radius:50px;

    padding:12px 18px;

    font-size:14px;

    font-weight:600;

    transition:.3s;
}

.btn-detail-user:hover{

    color:white;

    transform:translateY(-2px);
}

/* MOBILE */

@media(max-width:768px){

    .section-header-custom h2{
        font-size:32px;
    }

    .recommend-image{
        height:220px;
    }

}

</style>