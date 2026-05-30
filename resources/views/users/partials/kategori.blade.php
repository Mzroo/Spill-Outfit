<!-- ================= STYLE CATEGORY ================= -->

<section class="style-section">

    <div class="section-header-style">

        <div>

            <span class="section-badge-style">
                ✨ Explore Style
            </span>

            <h2>
                Pilih <span>Style Favoritmu</span>
            </h2>

            <p>
                Temukan inspirasi outfit berdasarkan gaya
                fashion yang paling cocok dengan aktivitasmu.
            </p>

        </div>

    </div>

    <div class="row g-4">

        <!-- CARD 1 -->

        <div class="col-lg-3 col-md-6">

            <div class="style-card">

                <img src="{{ asset('assets/images/style/campusLook.jpeg')}}">

                <div class="style-overlay"></div>

                <div class="style-content">

                    <span>Campus Look</span>
                    <h4>Outfit Kuliah</h4>

                    <a href=""
                       class="style-btn">

                        Explore

                    </a>

                </div>

            </div>

        </div>

        <!-- CARD 2 -->

        <div class="col-lg-3 col-md-6">

            <div class="style-card">

                <img src="{{ asset('assets/images/style/casual.jpeg')}}">

                <div class="style-overlay"></div>

                <div class="style-content">

                    <span>Casual Style</span>
                    <h4>Hangout</h4>

                    <a href=""
                       class="style-btn">

                        Explore

                    </a>

                </div>

            </div>

        </div>

        <!-- CARD 3 -->

        <div class="col-lg-3 col-md-6">

            <div class="style-card">

                <img src="{{ asset('assets/images/style/formal.jpeg')}}">

                <div class="style-overlay"></div>

                <div class="style-content">

                    <span>Office Look</span>
                    <h4>Formal Style</h4>

                    <a href=""
                       class="style-btn">

                        Explore

                    </a>

                </div>

            </div>

        </div>

        <!-- CARD 4 -->

        <div class="col-lg-3 col-md-6">

            <div class="style-card">

                <img src="{{ asset('assets/images/style/streetwear.jpeg')}}">

                <div class="style-overlay"></div>

                <div class="style-content">

                    <span>Urban Style</span>
                    <h4>Streetwear</h4>

                    <a href=""
                       class="style-btn">

                        Explore

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= STYLE SECTION ================= */

.style-section{
    margin-top:70px;
}

/* HEADER */

.section-header-style{
    margin-bottom:35px;
}

.section-badge-style{

    display:inline-flex;

    padding:10px 18px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;

    font-weight:600;

    margin-bottom:18px;
}

.section-header-style h2{

    font-size:42px;

    font-weight:700;

    color:#222;
}

.section-header-style h2 span{
    color:#B68D40;
}

.section-header-style p{

    margin-top:12px;

    color:#777;

    line-height:1.8;

    max-width:550px;
}

/* CARD */

.style-card{

    position:relative;

    height:380px;

    border-radius:35px;

    overflow:hidden;

    cursor:pointer;

    transition:.35s;
}

.style-card:hover{

    transform:translateY(-8px);

    box-shadow:
    0 20px 45px rgba(0,0,0,.08);
}

.style-card img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;
}

.style-card:hover img{
    transform:scale(1.08);
}

/* OVERLAY */

.style-overlay{

    position:absolute;

    inset:0;

    background:
    linear-gradient(
        to top,
        rgba(0,0,0,.78),
        rgba(0,0,0,.08)
    );
}

/* CONTENT */

.style-content{

    position:absolute;

    left:25px;
    bottom:25px;

    color:white;

    z-index:2;
}

.style-content span{

    font-size:13px;

    opacity:.9;
}

.style-content h4{

    font-weight:700;

    margin:8px 0 18px;
}

/* BUTTON */

.style-btn{

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

    padding:12px 20px;

    border-radius:50px;

    font-size:14px;

    font-weight:600;

    transition:.3s;
}

.style-btn:hover{

    color:white;

    transform:translateY(-2px);
}

/* MOBILE */

@media(max-width:768px){

    .section-header-style h2{
        font-size:32px;
    }

    .style-card{
        height:280px;
    }

}

</style>