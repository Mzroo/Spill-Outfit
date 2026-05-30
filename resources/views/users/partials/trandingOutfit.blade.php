<!-- ================= TRENDING OUTFIT ================= -->

<section class="trending-section">

    <div class="trending-header">

        <div>

            <span class="trending-badge">
                🔥 Trending Fashion
            </span>

            <h2>
                Outfit Yang Sedang
                <span>Trending</span>
            </h2>

            <p>
                Temukan outfit populer yang banyak diminati
                pengguna Spill Outfit minggu ini.
            </p>

        </div>

        <a href="{{ route('produk.index') }}"
           class="btn-trending">

            Lihat Semua

        </a>

    </div>

    <!-- GRID -->

    <div class="row g-4">

        @for ($i = 1; $i <= 4; $i++)

            <div class="col-lg-3 col-md-6">

                <div class="trending-card">

                    <!-- IMAGE -->

                    <div class="trending-image">

                        <img src="https://picsum.photos/500/600?random={{ $i + 40 }}"
                             alt="Trending Outfit">

                        <span class="trending-label">
                            Popular
                        </span>

                    </div>

                    <!-- CONTENT -->

                    <div class="trending-content">

                        <span class="trending-category">
                            Casual Style
                        </span>

                        <h5>
                            Outfit Trending {{ $i }}
                        </h5>

                        <p>
                            Outfit stylish modern untuk
                            kuliah, hangout, dan daily style.
                        </p>

                        <!-- FOOTER -->

                        <div class="trending-footer">

                            <div class="trending-info">

                                <span>
                                    <i class="mdi mdi-heart-outline"></i>
                                    2.3k
                                </span>

                                <span>
                                    <i class="mdi mdi-eye-outline"></i>
                                    5.1k
                                </span>

                            </div>

                            <a href=""
                               class="btn-detail-trending">

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

/* ================= TRENDING ================= */

.trending-section{
    margin-top:80px;
}

/* HEADER */

.trending-header{

    display:flex;

    justify-content:space-between;

    align-items:end;

    gap:20px;

    flex-wrap:wrap;

    margin-bottom:35px;
}

.trending-badge{

    display:inline-flex;

    padding:10px 18px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;

    font-weight:600;

    margin-bottom:18px;
}

.trending-header h2{

    font-size:42px;

    font-weight:700;

    color:#222;
}

.trending-header h2 span{
    color:#B68D40;
}

.trending-header p{

    margin-top:12px;

    color:#777;

    line-height:1.9;

    max-width:550px;
}

/* BUTTON */

.btn-trending{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    padding:15px 25px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.btn-trending:hover{

    color:white;

    transform:translateY(-3px);
}

/* CARD */

.trending-card{

    background:white;

    border-radius:32px;

    overflow:hidden;

    border:1px solid #f2ead8;

    transition:.35s;

    height:100%;
}

.trending-card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 20px 45px rgba(0,0,0,.07);
}

/* IMAGE */

.trending-image{

    position:relative;

    height:300px;

    overflow:hidden;
}

.trending-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;
}

.trending-card:hover img{
    transform:scale(1.08);
}

/* LABEL */

.trending-label{

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

.trending-content{
    padding:22px;
}

.trending-category{

    font-size:13px;

    color:#B68D40;

    font-weight:600;
}

.trending-content h5{

    margin-top:10px;

    font-weight:700;

    color:#222;
}

.trending-content p{

    margin-top:12px;

    color:#777;

    line-height:1.8;
}

/* FOOTER */

.trending-footer{

    margin-top:22px;

    display:flex;

    justify-content:space-between;

    align-items:center;
}

.trending-info{

    display:flex;

    gap:16px;
}

.trending-info span{

    display:flex;

    align-items:center;

    gap:6px;

    color:#777;

    font-size:14px;
}

.trending-info i{
    color:#B68D40;
}

/* BUTTON */

.btn-detail-trending{

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

.btn-detail-trending:hover{

    color:white;

    transform:translateY(-2px);
}

/* MOBILE */

@media(max-width:768px){

    .trending-header h2{
        font-size:32px;
    }

    .trending-image{
        height:220px;
    }

}

</style>