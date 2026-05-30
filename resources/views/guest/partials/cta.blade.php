<!-- ================= CTA SECTION ================= -->

<section class="cta-section">

    <div class="container">

        <div class="cta-wrapper">

            <div class="cta-content text-center">

                <span class="cta-badge">
                    🚀 Join Spill Outfit
                </span>

                <h2>
                    Siap Upgrade <span>Style Kamu</span>?
                </h2>

                <p>
                    Gabung sekarang dan temukan outfit terbaik,
                    rekomendasi fashion personal, serta komunitas
                    yang siap membantu style kamu makin keren.
                </p>

                <div class="cta-buttons">

                    <a href="{{ route('register') }}"
                       class="btn-cta-primary">

                        Register Sekarang

                    </a>

                    <a href="{{ route('login') }}"
                       class="btn-cta-secondary">

                        Login

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= CTA ================= */

.cta-section{
    padding:90px 0 50px;
    background:#fff;
}

/* WRAPPER */

.cta-wrapper{

    position:relative;

    overflow:hidden;

    border-radius:45px;

    padding:80px 40px;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    box-shadow:
    0 20px 60px rgba(182,141,64,.18);
}

/* DECORATION */

.cta-wrapper::before{

    content:"";

    position:absolute;

    top:-120px;
    right:-120px;

    width:260px;
    height:260px;

    border-radius:50%;

    background:
    rgba(255,255,255,.08);
}

.cta-wrapper::after{

    content:"";

    position:absolute;

    bottom:-100px;
    left:-100px;

    width:220px;
    height:220px;

    border-radius:50%;

    background:
    rgba(255,255,255,.08);
}

/* CONTENT */

.cta-content{

    position:relative;
    z-index:2;

    max-width:760px;
    margin:auto;
}

.cta-badge{

    display:inline-flex;

    align-items:center;

    padding:12px 22px;

    border-radius:50px;

    background:
    rgba(255,255,255,.15);

    color:white;

    font-size:14px;
    font-weight:600;

    margin-bottom:24px;

    backdrop-filter:blur(10px);
}

.cta-content h2{

    font-size:52px;
    font-weight:700;

    color:white;

    margin-bottom:20px;
}

.cta-content h2 span{
    color:#fff6d8;
}

.cta-content p{

    font-size:18px;

    color:rgba(255,255,255,.92);

    line-height:1.9;

    max-width:650px;
    margin:auto;
}

/* BUTTON */

.cta-buttons{

    display:flex;

    justify-content:center;

    gap:18px;

    margin-top:40px;
}

.btn-cta-primary{

    background:white;

    color:#8C6A2F;

    padding:16px 34px;

    border-radius:50px;

    font-weight:700;

    transition:.3s;
}

.btn-cta-primary:hover{

    transform:translateY(-4px);

    color:#8C6A2F;

    box-shadow:
    0 10px 25px rgba(255,255,255,.18);
}

.btn-cta-secondary{

    border:1px solid rgba(255,255,255,.3);

    color:white;

    padding:16px 34px;

    border-radius:50px;

    font-weight:600;

    transition:.3s;

    backdrop-filter:blur(10px);
}

.btn-cta-secondary:hover{

    background:white;

    color:#8C6A2F;
}

/* RESPONSIVE */

@media(max-width:991px){

    .cta-content h2{
        font-size:40px;
    }

}

@media(max-width:768px){

    .cta-section{
        padding:70px 0 40px;
    }

    .cta-wrapper{
        padding:60px 30px;
        border-radius:30px;
    }

    .cta-content h2{
        font-size:32px;
    }

    .cta-content p{
        font-size:16px;
    }

    .cta-buttons{
        flex-direction:column;
    }

}

</style>