@extends('layouts.app')

@section('content')
@include('guest.partials.navbar')

<!-- ================= COMMUNITY SECTION ================= -->
<section class="community-section">

    <div class="container">

        <!-- HERO -->
        <div class="community-hero">

            <div class="row align-items-center g-4">

                <div class="col-lg-7">

                    <span class="community-badge">
                        ✨ Fashion Community
                    </span>

                    <h1>
                        Temukan Inspirasi & <span>Komunitas Outfit</span>
                    </h1>

                    <p>
                        Jelajahi diskusi outfit, inspirasi fashion,
                        rekomendasi style kampus, casual, hingga streetwear
                        favorit dari komunitas Spill Outfit.
                    </p>

                    <div class="hero-btns">

                        <a href="{{ route('login') }}"
                           class="btn-community">

                            Join Community

                        </a>

                        <a href="#community-feed"
                           class="btn-outline-community">

                            Lihat Preview

                        </a>

                    </div>

                </div>

                <div class="col-lg-5">

                    <div class="community-preview-card">

                        <h5>🔥 Trending Discussion</h5>

                        <div class="discussion-item">

                            <div>
                                <h6>Outfit Kuliah Cowok Minimalis?</h6>
                                <small>120 komentar</small>
                            </div>

                            <span>#Campus</span>

                        </div>

                        <div class="discussion-item">

                            <div>
                                <h6>Rekomendasi Outfit Nongkrong</h6>
                                <small>89 komentar</small>
                            </div>

                            <span>#Casual</span>

                        </div>

                        <div class="discussion-item">

                            <div>
                                <h6>Streetwear Murah Tapi Keren?</h6>
                                <small>65 komentar</small>
                            </div>

                            <span>#Streetwear</span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- KATEGORI -->
        <div class="community-category">

            <button class="category-btn active">
                Semua
            </button>

            <button class="category-btn">
                Campus Style
            </button>

            <button class="category-btn">
                Casual
            </button>

            <button class="category-btn">
                Streetwear
            </button>

            <button class="category-btn">
                Formal
            </button>

            <button class="category-btn">
                Daily Outfit
            </button>

        </div>

        <!-- FEED -->
        <div class="community-feed" id="community-feed">

            <div class="section-title">

                <h2>
                    Preview <span>Community Feed</span>
                </h2>

                <p>
                    Guest hanya bisa melihat preview.
                    Login untuk ikut diskusi, like, dan komentar.
                </p>

            </div>

            <div class="row g-4 mt-2">

                @for ($i = 1; $i <= 6; $i++)

                    <div class="col-lg-4 col-md-6">

                        <div class="feed-card">

                            <div class="feed-header">

                                <img src="https://i.pravatar.cc/150?img={{ $i }}">

                                <div>
                                    <h6>User Fashion {{ $i }}</h6>
                                    <small>Campus Style</small>
                                </div>

                            </div>

                            <div class="feed-image">

                                <img src="https://picsum.photos/600/700?random={{ $i }}">

                            </div>

                            <div class="feed-content">

                                <p>
                                    Outfit simple tapi tetap clean buat
                                    ngampus 😎🔥
                                </p>

                                <div class="feed-actions">

                                    <a href="{{ route('login') }}">
                                        ❤️ 230
                                    </a>

                                    <a href="{{ route('login') }}">
                                        💬 54
                                    </a>

                                    <a href="{{ route('login') }}">
                                        Detail
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @endfor

            </div>

        </div>

        <!-- CTA -->
        <div class="community-cta">

            <h2>
                Mau Ikut Diskusi Fashion?
            </h2>

            <p>
                Login sekarang untuk bergabung dengan komunitas
                Spill Outfit dan temukan inspirasi style terbaikmu.
            </p>

            <a href="{{ route('login') }}"
               class="btn-community">

                Login Sekarang

            </a>

        </div>

    </div>

</section>

<style>

/* ================= COMMUNITY ================= */

.content {
    margin-left: 40px;
    margin-right: 40px;
}

.community-section{
    padding:110px 0 90px;
    background:#fff;
}

/* HERO */

.community-hero{
    background:
    linear-gradient(
        180deg,
        #fff,
        #faf8f3
    );

    border:1px solid #f3ead7;
    border-radius:35px;

    padding:60px;
}

.community-badge{

    display:inline-flex;

    padding:10px 18px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-weight:600;

    margin-bottom:20px;
}

.community-hero h1{
    font-size:58px;
    font-weight:700;
    line-height:1.2;
    color:#222;
}

.community-hero h1 span{
    color:#B68D40;
}

.community-hero p{
    margin-top:20px;
    color:#666;
    line-height:1.9;
}

.hero-btns{
    margin-top:35px;
    display:flex;
    gap:14px;
}

/* BUTTON */

.btn-community{
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;
    padding:15px 28px;
    border-radius:50px;
    font-weight:600;
}

.btn-community:hover{
    color:white;
}

.btn-outline-community{
    border:1px solid #ddd;
    padding:15px 28px;
    border-radius:50px;
    color:#444;
}

/* TRENDING */

.community-preview-card{
    background:white;
    border-radius:30px;
    padding:30px;
    border:1px solid #f2ead8;
}

.discussion-item{
    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:18px 0;
    border-bottom:1px solid #eee;
}

.discussion-item:last-child{
    border:none;
}

.discussion-item span{
    background:#f8f4e7;
    padding:8px 14px;
    border-radius:50px;
    color:#8C6A2F;
}

/* CATEGORY */

.community-category{
    display:flex;
    flex-wrap:wrap;
    gap:12px;

    justify-content:center;

    margin:50px 0;
}

.category-btn{
    border:none;
    background:#f5f5f5;

    padding:12px 20px;

    border-radius:50px;
    font-weight:600;
}

.category-btn.active,
.category-btn:hover{
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
}

/* SECTION TITLE */

.section-title{
    text-align:center;
}

.section-title h2{
    font-size:42px;
    font-weight:700;
}

.section-title span{
    color:#B68D40;
}

/* FEED */

.feed-card{
    border:1px solid #f2ead8;
    border-radius:28px;
    overflow:hidden;
    background:white;
    transition:.3s;
}

.feed-card:hover{
    transform:translateY(-6px);
}

.feed-header{
    display:flex;
    align-items:center;
    gap:12px;
    padding:18px;
}

.feed-header img{
    width:55px;
    height:55px;
    border-radius:50%;
}

.feed-image{
    height:330px;
}

.feed-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.feed-content{
    padding:20px;
}

.feed-actions{
    display:flex;
    justify-content:space-between;
    margin-top:20px;
}

.feed-actions a{
    color:#8C6A2F;
    font-weight:600;
    text-decoration:none;
}

/* CTA */

.community-cta{
    margin-top:80px;
    text-align:center;

    border-radius:35px;
    padding:60px;

    background:
    linear-gradient(
        180deg,
        #faf8f3,
        #f5efdf
    );
}

.community-cta h2{
    font-weight:700;
}

.community-cta p{
    max-width:650px;
    margin:auto;
    margin-top:15px;
    color:#666;
}

.community-cta .btn-community{
    margin-top:30px;
    display:inline-block;
}

/* MOBILE */

@media(max-width:768px){

    .community-section{
        padding-top:90px;
    }

    .community-hero{
        padding:35px;
    }

    .community-hero h1{
        font-size:38px;
    }

    .hero-btns{
        flex-direction:column;
    }

}

</style>

@include('guest.partials.footer')

@endsection