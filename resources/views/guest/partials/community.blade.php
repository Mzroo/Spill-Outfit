<!-- ================= COMMUNITY SECTION ================= -->

<section class="community-section">

    <div class="container">

        <div class="community-wrapper">

            <div class="row align-items-center g-5">

                <!-- LEFT -->
                <div class="col-lg-5">

                    <div class="community-content">

                        <span class="community-badge">
                            👥 Fashion Community
                        </span>

                        <h2>
                            Diskusi Outfit & <br>
                            Temukan Inspirasi <span>Fashion</span>
                        </h2>

                        <p>
                            Gabung bersama komunitas Spill Outfit
                            untuk berdiskusi tentang fashion,
                            rekomendasi style, hingga inspirasi outfit
                            terbaru sesuai gayamu.
                        </p>

                        <!-- FEATURES -->

                        <div class="community-features">

                            <div class="feature-box">
                                💬 Tanya rekomendasi outfit
                            </div>

                            <div class="feature-box">
                                🔥 Lihat style yang sedang trending
                            </div>

                            <div class="feature-box">
                                👕 Sharing fashion inspiration
                            </div>

                        </div>

                        <!-- BUTTON -->

                        <a href=""
                           class="btn-community">

                            Gabung Community

                        </a>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-7">

                    <div class="community-posts">

                        <!-- POST -->

                        <div class="community-card">

                            <div class="user-info">

                                <img src="https://i.pravatar.cc/100?img=12">

                                <div>

                                    <h6>
                                        Adriansyah
                                    </h6>

                                    <span>
                                        2 jam lalu
                                    </span>

                                </div>

                            </div>

                            <h5>
                                Outfit kuliah cowok biar clean dan
                                nggak terlalu formal?
                            </h5>

                            <div class="post-footer">

                                <span>💬 25 komentar</span>
                                <span>🔥 Trending</span>

                            </div>

                        </div>

                        <!-- POST -->

                        <div class="community-card">

                            <div class="user-info">

                                <img src="https://i.pravatar.cc/100?img=22">

                                <div>

                                    <h6>
                                        Nisa Putri
                                    </h6>

                                    <span>
                                        5 jam lalu
                                    </span>

                                </div>

                            </div>

                            <h5>
                                Style old money budget 200 ribuan
                                cocok nggak ya?
                            </h5>

                            <div class="post-footer">

                                <span>💬 48 komentar</span>
                                <span>✨ Popular</span>

                            </div>

                        </div>

                        <!-- POST -->

                        <div class="community-card">

                            <div class="user-info">

                                <img src="https://i.pravatar.cc/100?img=34">

                                <div>

                                    <h6>
                                        Rizky
                                    </h6>

                                    <span>
                                        1 hari lalu
                                    </span>

                                </div>

                            </div>

                            <h5>
                                Sneakers putih cocok buat cargo
                                pants nggak?
                            </h5>

                            <div class="post-footer">

                                <span>💬 17 komentar</span>
                                <span>👕 Outfit Talk</span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= COMMUNITY ================= */

.community-section{
    padding:90px 0;
    background:#fff;
}

.community-wrapper{

    background:
    linear-gradient(
        180deg,
        #ffffff,
        #faf8f3
    );

    border-radius:40px;

    padding:70px;

    border:1px solid #f3ead7;
}

/* LEFT */

.community-badge{

    display:inline-block;

    padding:10px 20px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;
    font-weight:600;

    margin-bottom:20px;
}

.community-content h2{

    font-size:48px;

    font-weight:700;

    line-height:1.3;

    color:#222;
}

.community-content h2 span{
    color:#B68D40;
}

.community-content p{

    margin-top:20px;

    line-height:1.9;

    color:#666;

    font-size:17px;
}

/* FEATURES */

.community-features{
    margin-top:30px;
}

.feature-box{

    background:#fff;

    padding:16px 22px;

    border-radius:20px;

    margin-bottom:15px;

    box-shadow:
    0 5px 15px rgba(0,0,0,.05);
}

/* BUTTON */

.btn-community{

    display:inline-block;

    margin-top:25px;

    padding:16px 28px;

    border-radius:50px;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    font-weight:600;

    transition:.3s;
}

.btn-community:hover{

    color:white;

    transform:translateY(-3px);

    box-shadow:
    0 10px 25px rgba(201,162,39,.3);
}

/* POSTS */

.community-posts{

    display:flex;
    flex-direction:column;

    gap:22px;
}

.community-card{

    background:white;

    border-radius:30px;

    padding:28px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.06);

    transition:.3s;
}

.community-card:hover{

    transform:translateY(-6px);
}

.user-info{

    display:flex;

    align-items:center;

    gap:14px;

    margin-bottom:20px;
}

.user-info img{

    width:55px;
    height:55px;

    border-radius:50%;

    object-fit:cover;
}

.user-info h6{

    margin:0;

    font-weight:600;
}

.user-info span{

    font-size:13px;

    color:#888;
}

.community-card h5{

    line-height:1.8;

    font-size:20px;

    color:#333;

    margin-bottom:20px;
}

/* FOOTER */

.post-footer{

    display:flex;

    justify-content:space-between;

    color:#888;

    font-size:14px;
}

/* RESPONSIVE */

@media(max-width:991px){

    .community-wrapper{
        padding:40px;
    }

    .community-content h2{
        font-size:38px;
    }

}

@media(max-width:768px){

    .community-section{
        padding:70px 0;
    }

    .community-content h2{
        font-size:30px;
    }

    .community-wrapper{
        padding:30px;
    }

}
</style>