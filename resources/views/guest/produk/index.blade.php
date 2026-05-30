@extends('layouts.app')

@section('content')

@include('guest.partials.navbar')

<section class="all-product-section">

    <div class="container">

        <!-- ================= HEADER ================= -->

        <div class="section-header">

            <span class="section-badge">
                ✨ Fashion Collection
            </span>

            <h2>
                Semua <span>Outfit</span>
            </h2>

            <p>
                Jelajahi berbagai outfit terbaik untuk kuliah,
                nongkrong, kerja, hingga daily style favoritmu.
            </p>

        </div>

        <!-- ================= FILTER ================= -->

        <div class="product-filter">

            <button class="filter-btn active">
                Semua
            </button>

            <button class="filter-btn">
                Casual
            </button>

            <button class="filter-btn">
                Campus
            </button>

            <button class="filter-btn">
                Streetwear
            </button>

            <button class="filter-btn">
                Formal
            </button>

        </div>

        <!-- ================= GRID ================= -->

        <div class="row g-4">

            @for ($i = 1; $i <= 12; $i++)

                <div class="col-lg-3 col-md-4 col-6">

                    <div class="product-card">

                        <!-- IMAGE -->

                        <div class="product-image">

                            <img
                                src="https://picsum.photos/500/650?random={{ $i }}"
                                alt="Outfit">

                            <span class="product-badge">
                                Trending
                            </span>

                        </div>

                        <!-- CONTENT -->

                        <div class="product-content">

                            <span class="product-category">
                                Campus Style
                            </span>

                            <h5>
                                Outfit Stylish {{ $i }}
                            </h5>

                            <div class="product-footer">

                                <div>

                                    <small>
                                        Mulai dari
                                    </small>

                                    <h6>
                                        Rp149.000
                                    </h6>

                                </div>

                                <a href="{{ route('login') }}"
                                   class="btn-detail">

                                    Detail

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @endfor

        </div>

        <!-- ================= PAGINATION ================= -->

        <div class="custom-pagination">

            <a href="#" class="page-btn">
                <i class="mdi mdi-chevron-left"></i>
            </a>

            <a href="#" class="page-btn active">
                1
            </a>

            <a href="#" class="page-btn">
                2
            </a>

            <a href="#" class="page-btn">
                3
            </a>

            <a href="#" class="page-btn">
                4
            </a>

            <a href="#" class="page-btn">
                <i class="mdi mdi-chevron-right"></i>
            </a>

        </div>

    </div>

</section>

@include('guest.partials.footer')

<style>

a{
    text-decoration:none;
}

.content {
 padding-left:40px;
 padding-right:40px;
}
/* ================= PAGE ================= */

.all-product-section{

    padding:130px 0 90px;

    background:#fff;

    min-height:100vh;
}

/* ================= HEADER ================= */

.section-header{

    text-align:center;

    max-width:720px;

    margin:0 auto 50px auto;
}

.section-badge{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    padding:12px 22px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;

    font-weight:600;

    margin-bottom:22px;
}

.section-header h2{

    font-size:56px;

    font-weight:700;

    color:#222;
}

.section-header h2 span{

    color:#B68D40;
}

.section-header p{

    margin-top:18px;

    color:#777;

    line-height:1.9;

    font-size:16px;
}

/* ================= FILTER ================= */

.product-filter{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:14px;

    flex-wrap:wrap;

    margin-bottom:50px;
}

.filter-btn{

    border:none;

    background:#f5f5f5;

    border-radius:50px;

    padding:13px 24px;

    font-weight:600;

    color:#444;

    transition:.3s;
}

.filter-btn:hover,
.filter-btn.active{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    transform:translateY(-2px);
}

/* ================= CARD ================= */

.product-card{

    background:white;

    border-radius:28px;

    overflow:hidden;

    border:1px solid #f2ead8;

    transition:.35s;

    height:100%;
}

.product-card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 20px 45px rgba(0,0,0,.08);
}

/* IMAGE */

.product-image{

    position:relative;

    height:320px;

    overflow:hidden;
}

.product-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.45s;
}

.product-card:hover img{

    transform:scale(1.08);
}

/* BADGE */

.product-badge{

    position:absolute;

    top:18px;
    left:18px;

    background:white;

    color:#8C6A2F;

    padding:8px 16px;

    border-radius:50px;

    font-size:12px;

    font-weight:600;

    box-shadow:
    0 4px 15px rgba(0,0,0,.08);
}

/* CONTENT */

.product-content{

    padding:22px;
}

.product-category{

    color:#B68D40;

    font-size:13px;

    font-weight:600;
}

.product-content h5{

    margin-top:10px;

    font-size:20px;

    font-weight:700;

    color:#222;
}

/* FOOTER */

.product-footer{

    margin-top:22px;

    display:flex;

    justify-content:space-between;

    align-items:center;
}

.product-footer small{

    color:#999;
}

.product-footer h6{

    margin:0;

    font-size:18px;

    font-weight:700;

    color:#222;
}

/* BUTTON DETAIL */

.btn-detail{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    border-radius:50px;

    padding:11px 22px;

    font-size:14px;

    font-weight:600;

    transition:.3s;
}

.btn-detail:hover{

    color:white;

    transform:translateY(-3px);

    box-shadow:
    0 10px 25px rgba(182,141,64,.25);
}

/* ================= PAGINATION ================= */

.custom-pagination{

    margin-top:70px;

    display:flex;

    justify-content:center;

    align-items:center;

    gap:14px;

    flex-wrap:wrap;
}

.page-btn{

    width:52px;
    height:52px;

    border-radius:50%;

    display:flex;

    justify-content:center;
    align-items:center;

    background:#f8f4e7;

    color:#8C6A2F;

    font-weight:600;

    transition:.3s;
}

.page-btn:hover{

    transform:translateY(-3px);

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;
}

.page-btn.active{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    box-shadow:
    0 10px 25px rgba(182,141,64,.25);
}

/* ================= MOBILE ================= */

@media(max-width:768px){

    .all-product-section{

        padding:110px 0 70px;
    }

    .section-header h2{

        font-size:36px;
    }

    .section-header p{

        font-size:14px;
    }

    .product-image{

        height:220px;
    }

    .product-content{

        padding:16px;
    }

    .product-content h5{

        font-size:16px;
    }

    .btn-detail{

        padding:10px 14px;

        font-size:12px;
    }

    .page-btn{

        width:45px;
        height:45px;
    }

}

</style>

@endsection