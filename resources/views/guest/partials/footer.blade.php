<!-- ================= FOOTER ================= -->

<footer class="footer">

    <div class="container">

        <div class="footer-wrapper">

            <!-- BRAND -->

            <div class="footer-brand">

                <div class="footer-logo">

                    <div class="footer-logo-icon">
                        <i class="mdi mdi-hanger"></i>
                    </div>

                    <div>

                        <h3>
                            Spill Outfit
                        </h3>

                        <span>
                            Fashion Recommendation
                        </span>

                    </div>

                </div>

                <p>
                    Temukan inspirasi outfit terbaik untuk kuliah,
                    nongkrong, kerja, hingga daily outfit dengan
                    tampilan modern dan stylish.
                </p>

                <!-- SOCIAL -->

                <div class="footer-social">

                    <a href="">
                        <i class="mdi mdi-instagram"></i>
                    </a>

                    <a href="">
                        <i class="mdi mdi-whatsapp"></i>
                    </a>

                    <a href="">
                        <i class="mdi mdi-facebook"></i>
                    </a>

                    <a href="">
                        <i class="mdi mdi-email-outline"></i>
                    </a>

                </div>

            </div>

            <!-- MENU -->

            <div class="footer-column">

                <h4>
                    Menu
                </h4>

                <a href="/">
                    Home
                </a>

                <a href="">
                    Produk
                </a>

                <a href="">
                    About
                </a>

                <a href="">
                    Community
                </a>

            </div>

            <!-- SUPPORT -->

            <div class="footer-column">

                <h4>
                    Support
                </h4>

                <a href="">
                    FAQ
                </a>

                <a href="">
                    Terms & Condition
                </a>

                <a href="">
                    Privacy Policy
                </a>

                <a href="">
                    Contact Us
                </a>

            </div>

            <!-- NEWSLETTER -->

            <div class="footer-column footer-newsletter">

                <h4>
                    Stay Updated
                </h4>

                <p>
                    Dapatkan update fashion terbaru dan inspirasi outfit.
                </p>

                <div class="newsletter-box">

                    <input type="email"
                           placeholder="Masukkan email">

                    <button>
                        Kirim
                    </button>

                </div>

            </div>

        </div>

        <!-- BOTTOM -->

        <div class="footer-bottom">

            <p>
                © 2026 Spill Outfit — All Rights Reserved
            </p>

            <span>
                Made with ❤️ for Fashion Lovers
            </span>

        </div>

    </div>

</footer>

<style>

/* ================= FOOTER ================= */

.footer{

    margin-top:100px;

    background:
    linear-gradient(
        180deg,
        #8C6A2F,
        #6B4F1D
    );

    border-radius:50px 50px 0 0;

    padding:80px 0 35px;

    color:white;

    position:relative;

    overflow:hidden;
}

/* DECORATION */

.footer::before{

    content:"";

    position:absolute;

    width:300px;
    height:300px;

    background:
    rgba(255,255,255,.05);

    border-radius:50%;

    top:-100px;
    right:-100px;
}

.footer::after{

    content:"";

    position:absolute;

    width:220px;
    height:220px;

    background:
    rgba(255,255,255,.05);

    border-radius:50%;

    bottom:-100px;
    left:-80px;
}

/* WRAPPER */

.footer-wrapper{

    position:relative;
    z-index:2;

    display:grid;

    grid-template-columns:
    2fr 1fr 1fr 1.5fr;

    gap:50px;
}

/* BRAND */

.footer-logo{

    display:flex;

    align-items:center;

    gap:15px;

    margin-bottom:25px;
}

.footer-logo-icon{

    width:65px;
    height:65px;

    border-radius:20px;

    background:
    rgba(255,255,255,.12);

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:32px;
}

.footer-logo h3{

    margin:0;

    font-weight:700;
}

.footer-logo span{

    color:
    rgba(255,255,255,.8);

    font-size:14px;
}

.footer-brand p{

    color:
    rgba(255,255,255,.85);

    line-height:1.9;

    max-width:400px;
}

/* COLUMN */

.footer-column h4{

    margin-bottom:25px;

    font-weight:700;
}

.footer-column a{

    display:block;

    margin-bottom:14px;

    color:
    rgba(255,255,255,.85);

    transition:.3s;
}

.footer-column a:hover{

    color:white;

    transform:translateX(6px);
}

/* SOCIAL */

.footer-social{

    display:flex;

    gap:14px;

    margin-top:25px;
}

.footer-social a{

    width:48px;
    height:48px;

    border-radius:50%;

    background:
    rgba(255,255,255,.12);

    color:white;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:22px;

    transition:.3s;
}

.footer-social a:hover{

    transform:translateY(-5px);

    background:
    rgba(255,255,255,.22);
}

/* NEWSLETTER */

.footer-newsletter p{

    color:
    rgba(255,255,255,.85);

    margin-bottom:20px;
}

.newsletter-box{

    display:flex;

    background:white;

    border-radius:50px;

    overflow:hidden;
}

.newsletter-box input{

    flex:1;

    border:none;

    outline:none;

    padding:16px 22px;
}

.newsletter-box button{

    border:none;

    background:#B68D40;

    color:white;

    padding:0 24px;

    font-weight:600;
}

/* BOTTOM */

.footer-bottom{

    position:relative;
    z-index:2;

    margin-top:60px;

    padding-top:25px;

    border-top:
    1px solid rgba(255,255,255,.15);

    display:flex;

    justify-content:space-between;

    align-items:center;

    flex-wrap:wrap;

    gap:15px;
}

.footer-bottom p,
.footer-bottom span{

    margin:0;

    color:
    rgba(255,255,255,.8);
}

/* RESPONSIVE */

@media(max-width:991px){

    .footer-wrapper{

        grid-template-columns:
        1fr 1fr;
    }

}

@media(max-width:768px){

    .footer{

        border-radius:35px 35px 0 0;

        padding:60px 0 30px;
    }

    .footer-wrapper{

        grid-template-columns:1fr;
    }

    .footer-bottom{

        text-align:center;

        justify-content:center;
    }

    .newsletter-box{

        flex-direction:column;

        border-radius:25px;
    }

    .newsletter-box button{

        height:55px;
    }

}

</style>