<!-- ================= CATEGORY STYLE ================= -->

<section class="style-section">

    <div class="container">

        <!-- HEADER -->
        <div class="section-header text-center">

            <span class="section-badge">
                Explore Style
            </span>

            <h2>
                Temukan Style Favoritmu
            </h2>

            <p>
                Pilih gaya fashion yang sesuai dengan personality
                dan aktivitas harianmu.
            </p>

        </div>

        <!-- STYLE GRID -->
        <div class="row g-4 mt-2">

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="style-card">

                    <img src="{{ asset('assets/images/style/casual.jpeg') }}"
                         alt="Casual Style">

                    <div class="style-overlay"></div>

                    <div class="style-content">

                        <span>Relaxed Daily</span>
                        <h5>Casual</h5>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="style-card">

                    <img src="{{ asset('assets/images/style/streetwear.jpeg') }}"
                         alt="Streetwear">

                    <div class="style-overlay"></div>

                    <div class="style-content">

                        <span>Urban Fashion</span>
                        <h5>Streetwear</h5>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="style-card">

                    <img src="{{ asset('assets/images/style/formal.jpeg') }}"
                         alt="Formal Style">

                    <div class="style-overlay"></div>

                    <div class="style-content">

                        <span>Professional Look</span>
                        <h5>Formal</h5>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="style-card">

                    <img src="{{ asset('assets/images/style/campus.jpeg') }}"
                         alt="Campus Outfit">

                    <div class="style-overlay"></div>

                    <div class="style-content">

                        <span>Campus Look</span>
                        <h5>Campus</h5>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="style-card">

                    <img src="{{ asset('assets/images/style/vintage.jpeg') }}"
                         alt="Vintage Style">

                    <div class="style-overlay"></div>

                    <div class="style-content">

                        <span>Classic Vibes</span>
                        <h5>Vintage</h5>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="style-card">

                    <img src="{{ asset('assets/images/style/oldmoney.jpeg') }}"
                         alt="Old Money">

                    <div class="style-overlay"></div>

                    <div class="style-content">

                        <span>Luxury Minimal</span>
                        <h5>Old Money</h5>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="style-card">

                    <img src="{{ asset('assets/images/style/minimalist.jpeg') }}"
                         alt="Minimalist">

                    <div class="style-overlay"></div>

                    <div class="style-content">

                        <span>Simple Clean</span>
                        <h5>Minimalist</h5>

                    </div>

                </div>

            </div>

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6">

                <div class="style-card">

                    <img src="{{ asset('assets/images/style/korean.jpeg') }}"
                         alt="Korean Style">

                    <div class="style-overlay"></div>

                    <div class="style-content">

                        <span>Modern Korean</span>
                        <h5>Korean</h5>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= STYLE SECTION ================= */

.style-section{
    padding:90px 0;
    background:#fff;
}

/* HEADER */

.section-header{
    max-width:700px;
    margin:auto;
    margin-bottom:50px;
}

.section-badge{

    display:inline-block;

    background:#f8f4e7;

    color:#8C6A2F;

    padding:10px 20px;

    border-radius:50px;

    font-size:14px;
    font-weight:600;

    margin-bottom:20px;
}

.section-header h2{

    font-size:42px;
    font-weight:700;

    color:#222;
}

.section-header p{

    margin-top:15px;

    color:#666;

    line-height:1.9;
}

/* CARD */

.style-card{

    position:relative;

    height:320px;

    border-radius:32px;

    overflow:hidden;

    cursor:pointer;

    transition:.4s;

    box-shadow:
    0 10px 30px rgba(0,0,0,.05);
}

.style-card:hover{

    transform:translateY(-8px);
}

.style-card img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.5s;
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
        rgba(0,0,0,.75),
        rgba(0,0,0,.05)
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

.style-content h5{

    margin-top:8px;
    margin-bottom:0;

    font-size:24px;
    font-weight:600;
}

/* RESPONSIVE */

@media(max-width:768px){

    .style-section{
        padding:70px 0;
    }

    .section-header h2{
        font-size:32px;
    }

    .style-card{
        height:260px;
    }

}

</style>