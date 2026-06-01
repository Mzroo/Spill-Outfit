<!-- ================= HERO USER ================= -->

<section class="user-hero">

    <div class="hero-user-wrapper">

        <div class="row align-items-center g-4">

            <!-- LEFT -->

            <div class="col-lg-7">

                <div class="hero-user-content">

                    <span class="hero-user-badge">
                        ✨ Welcome to Spill Outfit
                    </span>

                    <h1>
                        Halo,
                        <span>
                            {{ auth()->user()->name }}
                        </span>
                        👋
                    </h1>

                    <p>
                        Temukan outfit terbaik untuk kuliah,
                        nongkrong, kerja, hingga daily style.
                        Jelajahi fashion recommendation yang
                        sesuai dengan gayamu hari ini.
                    </p>

                    <div class="hero-user-buttons">

                        <a href="{{ route('produk.index') }}"
                           class="btn-gold-user">

                            Jelajahi Outfit

                        </a>

                        <a href="{{ route('community.index') }}"
                           class="btn-outline-user">

                            Community

                        </a>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="col-lg-5">

                <div class="hero-user-card">

                    <div class="mini-card">

                        <div class="mini-icon">
                            <i class="mdi mdi-tshirt-crew-outline"></i>
                        </div>

                        <div>
                            <h5>120+</h5>
                            <p>Fashion Collection</p>
                        </div>

                    </div>

                    <div class="mini-card">

                        <div class="mini-icon">
                            <i class="mdi mdi-account-group-outline"></i>
                        </div>

                        <div>
                            <h5>2.5K+</h5>
                            <p>Community Member</p>
                        </div>

                    </div>

                    <div class="mini-card">

                        <div class="mini-icon">
                            <i class="mdi mdi-star-outline"></i>
                        </div>

                        <div>
                            <h5>Premium</h5>
                            <p>Fashion Recommendation</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= USER HERO ================= */

.user-hero{
    margin-bottom:35px;
}

.hero-user-wrapper{

    background:
    linear-gradient(
        180deg,
        #ffffff,
        #faf7ef
    );

    border:1px solid #f2ead8;

    border-radius:40px;

    padding:50px;

    overflow:hidden;

    position:relative;
}

/* LEFT */

.hero-user-content{
    max-width:650px;
}

.hero-user-badge{

    display:inline-flex;

    padding:10px 18px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;

    font-weight:600;

    margin-bottom:20px;
}

.hero-user-content h1{

    font-size:52px;

    font-weight:700;

    color:#222;

    margin-bottom:18px;
}

.hero-user-content h1 span{
    color:#B68D40;
}

.hero-user-content p{

    font-size:17px;

    line-height:1.9;

    color:#666;

    max-width:600px;
}

/* BUTTON */

.hero-user-buttons{

    display:flex;

    gap:15px;

    margin-top:30px;
}

.btn-gold-user{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    padding:16px 28px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.btn-gold-user:hover{

    color:white;

    transform:translateY(-3px);

    box-shadow:
    0 12px 30px rgba(182,141,64,.25);
}

.btn-outline-user{

    border:1px solid #ddd;

    color:#444;

    padding:16px 28px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;
}

.btn-outline-user:hover{

    border-color:#B68D40;

    color:#B68D40;
}

/* RIGHT CARD */

.hero-user-card{

    background:white;

    border-radius:35px;

    padding:30px;

    border:1px solid #f2ead8;

    display:flex;

    flex-direction:column;

    gap:18px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.04);
}

.mini-card{

    display:flex;

    align-items:center;

    gap:18px;

    padding:18px;

    border-radius:22px;

    background:#faf7ef;
}

.mini-icon{

    width:60px;
    height:60px;

    border-radius:20px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    font-size:28px;
}

.mini-card h5{

    margin:0;

    font-weight:700;

    color:#222;
}

.mini-card p{

    margin:0;

    color:#777;
}

/* MOBILE */

@media(max-width:768px){

    .hero-user-wrapper{
        padding:30px;
        border-radius:30px;
    }

    .hero-user-content h1{
        font-size:34px;
    }

    .hero-user-buttons{
        flex-direction:column;
    }

}

</style>