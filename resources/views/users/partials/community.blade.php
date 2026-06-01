<!-- ================= COMMUNITY SECTION ================= -->

<section class="community-section">

    <div class="community-header">

        <div>

            <span class="community-badge">
                ✨ Fashion Community
            </span>

            <h2>
                Inspirasi Dari
                <span>Community</span>
            </h2>

            <p>
                Lihat style terbaik dari member Spill Outfit
                dan temukan inspirasi outfit favoritmu.
            </p>

        </div>

        <a href="{{ route('community.index') }}"
           class="btn-community">

            Explore Community

        </a>

    </div>

    <!-- GRID -->

    <div class="row g-4">

        @for ($i = 1; $i <= 3; $i++)

            <div class="col-lg-4">

                <div class="community-card">

                    <!-- IMAGE -->

                    <div class="community-image">

                        <img src="https://picsum.photos/700/500?random={{ $i + 20 }}">

                    </div>

                    <!-- CONTENT -->

                    <div class="community-content">

                        <div class="community-user">

                            <img src="https://i.pravatar.cc/150?img={{ $i + 10 }}">

                            <div>

                                <h6>User Fashion {{ $i }}</h6>

                                <small>Fashion Enthusiast</small>

                            </div>

                        </div>

                        <h5>
                            Outfit Casual Modern {{ $i }}
                        </h5>

                        <p>
                            Inspirasi outfit untuk tampil stylish
                            saat kuliah, nongkrong, maupun daily style.
                        </p>

                        <div class="community-footer">

                            <div class="community-stats">

                                <span>
                                    <i class="mdi mdi-heart-outline"></i>
                                    120
                                </span>

                                <span>
                                    <i class="mdi mdi-comment-outline"></i>
                                    45
                                </span>
                            </div>

                            <a href=""
                               class="btn-view-post">

                                Lihat

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @endfor

    </div>

</section>

<style>

/* ================= COMMUNITY ================= */

.community-section{
    margin-top:70px;
}

/* HEADER */

.community-header{

    display:flex;

    justify-content:space-between;

    align-items:end;

    gap:20px;

    flex-wrap:wrap;

    margin-bottom:35px;
}

.community-badge{

    display:inline-flex;

    padding:10px 18px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;

    font-weight:600;

    margin-bottom:18px;
}

.community-header h2{

    font-size:42px;

    font-weight:700;

    color:#222;
}

.community-header h2 span{
    color:#B68D40;
}

.community-header p{

    margin-top:12px;

    max-width:550px;

    color:#777;

    line-height:1.8;
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

    padding:15px 26px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.btn-community:hover{

    color:white;

    transform:translateY(-3px);
}

/* CARD */

.community-card{

    background:white;

    border-radius:35px;

    overflow:hidden;

    border:1px solid #f2ead8;

    transition:.35s;

    height:100%;
}

.community-card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 20px 45px rgba(0,0,0,.07);
}

/* IMAGE */

.community-image{

    height:260px;

    overflow:hidden;
}

.community-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;
}

.community-card:hover img{
    transform:scale(1.06);
}

/* CONTENT */

.community-content{
    padding:24px;
}

/* USER */

.community-user{

    display:flex;

    align-items:center;

    gap:14px;

    margin-bottom:20px;
}

.community-user img{

    width:55px;
    height:55px;

    border-radius:50%;

    object-fit:cover;
}

.community-user h6{

    margin:0;

    font-weight:700;
}

.community-user small{
    color:#888;
}

/* TEXT */

.community-content h5{

    font-weight:700;

    color:#222;

    margin-bottom:12px;
}

.community-content p{

    color:#777;

    line-height:1.8;
}

/* FOOTER */

.community-footer{

    margin-top:22px;

    display:flex;

    justify-content:space-between;

    align-items:center;
}

.community-stats{

    display:flex;

    gap:18px;

    color:#888;
}

.community-stats span{

    display:flex;

    align-items:center;

    gap:6px;
}

.community-stats i{
    color:#B68D40;
}

/* BUTTON */

.btn-view-post{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    padding:12px 20px;

    border-radius:50px;

    font-size:14px;

    font-weight:600;

    transition:.3s;
}

.btn-view-post:hover{

    color:white;

    transform:translateY(-2px);
}

/* MOBILE */

@media(max-width:768px){

    .community-header h2{
        font-size:32px;
    }

    .community-image{
        height:220px;
    }

}

</style>