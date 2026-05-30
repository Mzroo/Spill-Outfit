
<!-- ================= TRENDING OUTFIT ================= -->

<section class="trending-section">

    <div class="container">

        <!-- HEADER -->
        <div class="section-header text-center">

            <span class="section-badge">
                🔥 Trending Fashion
            </span>

            <h2>
                Outfit Pilihan Minggu Ini
            </h2>

            <p>
                Temukan outfit terbaik yang sedang populer dan
                cocok untuk berbagai aktivitas harianmu.
            </p>

        </div>

        <!-- FILTER -->
        <div class="filter-wrapper">

            <button class="filter-btn active">
                All
            </button>

            <button class="filter-btn">
                Casual
            </button>

            <button class="filter-btn">
                Campus
            </button>

            <button class="filter-btn">
                Formal
            </button>

            <button class="filter-btn">
                Streetwear
            </button>

        </div>

        <!-- PRODUCT GRID -->
        <div class="row g-4">

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="product-card">

                    <div class="product-image">

                        <img src="{{ asset('images/products/hoodie.jpg') }}">

                        <span class="product-badge">
                            Casual
                        </span>

                    </div>

                    <div class="product-content">

                        <h5>
                            Campus Hoodie Oversize
                        </h5>

                        <div class="rating">

                            ⭐ 4.9
                            <span>(120 Review)</span>

                        </div>

                        <div class="price-row">

                            <h4>
                                Rp149.000
                            </h4>

                            <a href=""
                               class="btn-detail">

                                Detail

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="product-card">

                    <div class="product-image">

                        <img src="{{ asset('images/products/jacket.jpg') }}">

                        <span class="product-badge">
                            Streetwear
                        </span>

                    </div>

                    <div class="product-content">

                        <h5>
                            Varsity Jacket Style
                        </h5>

                        <div class="rating">

                            ⭐ 4.8
                            <span>(90 Review)</span>

                        </div>

                        <div class="price-row">

                            <h4>
                                Rp210.000
                            </h4>

                            <a href=""
                               class="btn-detail">

                                Detail

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="product-card">

                    <div class="product-image">

                        <img src="{{ asset('images/products/formal.jpg') }}">

                        <span class="product-badge">
                            Formal
                        </span>

                    </div>

                    <div class="product-content">

                        <h5>
                            Formal Office Shirt
                        </h5>

                        <div class="rating">

                            ⭐ 4.7
                            <span>(70 Review)</span>

                        </div>

                        <div class="price-row">

                            <h4>
                                Rp175.000
                            </h4>

                            <a href=""
                               class="btn-detail">

                                Detail

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="product-card">

                    <div class="product-image">

                        <img src="{{ asset('images/products/casual.jpg') }}">

                        <span class="product-badge">
                            Campus
                        </span>

                    </div>

                    <div class="product-content">

                        <h5>
                            Daily Campus Outfit
                        </h5>

                        <div class="rating">

                            ⭐ 5.0
                            <span>(200 Review)</span>

                        </div>

                        <div class="price-row">

                            <h4>
                                Rp199.000
                            </h4>

                            <a href=""
                               class="btn-detail">

                                Detail

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= SECTION ================= */

.trending-section{
    padding:90px 0;
    background:#fff;
}

/* HEADER */

.section-header{
    max-width:700px;
    margin:auto;
    margin-bottom:35px;
}

.section-badge{

    display:inline-flex;

    align-items:center;

    padding:10px 20px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;
    font-weight:600;

    margin-bottom:20px;
}

.section-header h2{

    font-size:44px;
    font-weight:700;

    color:#222;
}

.section-header p{

    color:#666;

    line-height:1.9;
}

/* FILTER */

.filter-wrapper{

    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:12px;

    margin-bottom:45px;
}

.filter-btn{

    border:none;

    background:#f5f5f5;

    padding:12px 22px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.filter-btn.active,
.filter-btn:hover{

    background:#B68D40;
    color:white;
}

/* PRODUCT CARD */

.product-card{

    background:white;

    border-radius:32px;

    overflow:hidden;

    box-shadow:
    0 10px 35px rgba(0,0,0,.05);

    transition:.4s;
}

.product-card:hover{

    transform:translateY(-8px);
}

/* IMAGE */

.product-image{

    position:relative;

    overflow:hidden;
}

.product-image img{

    width:100%;
    height:320px;

    object-fit:cover;

    transition:.5s;
}

.product-card:hover img{
    transform:scale(1.06);
}

/* BADGE */

.product-badge{

    position:absolute;

    top:20px;
    left:20px;

    background:#B68D40;

    color:white;

    padding:8px 16px;

    border-radius:50px;

    font-size:13px;
    font-weight:600;
}

/* CONTENT */

.product-content{
    padding:25px;
}

.product-content h5{

    font-size:20px;

    font-weight:600;

    color:#222;
}

/* RATING */

.rating{

    margin:14px 0;

    color:#777;
}

.rating span{
    font-size:14px;
}

/* PRICE */

.price-row{

    display:flex;

    justify-content:space-between;
    align-items:center;
}

.price-row h4{

    margin:0;

    color:#B68D40;

    font-size:22px;
    font-weight:700;
}

/* BUTTON */

.btn-detail{

    background:#f8f4e7;

    color:#8C6A2F;

    padding:12px 22px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.btn-detail:hover{

    background:#B68D40;

    color:white;
}

/* RESPONSIVE */

@media(max-width:768px){

    .trending-section{
        padding:70px 0;
    }

    .section-header h2{
        font-size:32px;
    }

    .product-image img{
        height:260px;
    }

}
</style>