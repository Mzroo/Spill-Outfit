<!-- ================= AI OUTFIT RECOMMENDATION ================= -->

<section class="ai-section">

    <div class="container">

        <div class="ai-wrapper">

            <div class="row align-items-center g-5">

                <!-- LEFT CONTENT -->
                <div class="col-lg-6">

                    <div class="ai-content">

                        <span class="ai-badge">
                            🤖 Smart Fashion AI
                        </span>

                        <h2>
                            Temukan Outfit Yang <br>
                            Cocok Untuk <span>Gayamu</span>
                        </h2>

                        <p>
                            Spill Outfit membantu kamu menemukan outfit
                            terbaik berdasarkan aktivitas, budget,
                            dan style favoritmu secara lebih personal.
                        </p>

                        <div class="ai-features">

                            <div class="feature-item">
                                ✨ Rekomendasi outfit sesuai style
                            </div>

                            <div class="feature-item">
                                💰 Menyesuaikan budget kamu
                            </div>

                            <div class="feature-item">
                                🎯 Cocok untuk kuliah, kerja, hangout
                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT FORM -->
                <div class="col-lg-6">

                    <div class="ai-card">

                        <div class="ai-card-header">

                            <h4>
                                Cari Outfit Kamu
                            </h4>

                            <p>
                                Isi preferensi fashionmu
                            </p>

                        </div>

                        <!-- FORM -->

                        <div class="mb-3">

                            <label>
                                Budget
                            </label>

                            <input type="text"
                                   class="custom-input"
                                   placeholder="Contoh: Rp 200.000">

                        </div>

                        <div class="mb-3">

                            <label>
                                Aktivitas
                            </label>

                            <select class="custom-input">

                                <option>Kuliah</option>
                                <option>Hangout</option>
                                <option>Kerja</option>
                                <option>Daily Outfit</option>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label>
                                Style
                            </label>

                            <select class="custom-input">

                                <option>Casual</option>
                                <option>Campus</option>
                                <option>Formal</option>
                                <option>Streetwear</option>
                                <option>Old Money</option>

                            </select>

                        </div>

                        <button class="btn-ai">

                            Temukan Outfit

                        </button>

                        <!-- RESULT PREVIEW -->

                        <div class="result-box">

                            <h6>
                                Preview Recommendation
                            </h6>

                            <ul>

                                <li>✔ Oversize Hoodie</li>
                                <li>✔ Cargo Pants</li>
                                <li>✔ Sneakers White</li>

                            </ul>

                        </div>

                        <!-- CTA -->

                        <div class="login-note">

                            Login untuk rekomendasi outfit
                            yang lebih personal.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= AI SECTION ================= */

.ai-section{
    padding:90px 0;
    background:#fff;
}

.ai-wrapper{

    background:
    linear-gradient(
        180deg,
        #ffffff,
        #faf8f3
    );

    border-radius:40px;

    padding:70px;

    border:1px solid #f2ead8;
}

/* LEFT */

.ai-badge{

    display:inline-block;

    padding:10px 20px;

    border-radius:50px;

    background:#f8f4e7;

    color:#8C6A2F;

    font-size:14px;
    font-weight:600;

    margin-bottom:22px;
}

.ai-content h2{

    font-size:48px;
    font-weight:700;

    line-height:1.3;

    color:#222;
}

.ai-content h2 span{
    color:#B68D40;
}

.ai-content p{

    margin-top:20px;

    font-size:17px;

    line-height:1.9;

    color:#666;
}

/* FEATURES */

.ai-features{
    margin-top:30px;
}

.feature-item{

    background:#fff;

    padding:16px 22px;

    border-radius:20px;

    margin-bottom:15px;

    box-shadow:
    0 5px 15px rgba(0,0,0,.05);
}

/* CARD */

.ai-card{

    background:#fff;

    border-radius:35px;

    padding:40px;

    box-shadow:
    0 10px 40px rgba(0,0,0,.06);
}

.ai-card-header{
    margin-bottom:25px;
}

.ai-card-header h4{

    font-weight:700;

    color:#222;
}

.ai-card-header p{
    color:#777;
}

/* INPUT */

.custom-input{

    width:100%;

    border:1px solid #eee;

    border-radius:18px;

    height:58px;

    padding:0 20px;

    outline:none;

    background:#fafafa;
}

.custom-input:focus{

    border-color:#B68D40;
}

/* BUTTON */

.btn-ai{

    width:100%;

    border:none;

    height:58px;

    border-radius:20px;

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

.btn-ai:hover{

    transform:translateY(-3px);

    box-shadow:
    0 10px 25px rgba(201,162,39,.3);
}

/* RESULT */

.result-box{

    margin-top:30px;

    background:#f9f7f2;

    border-radius:24px;

    padding:25px;
}

.result-box h6{

    font-weight:700;

    margin-bottom:15px;
}

.result-box ul{

    padding-left:0;

    list-style:none;

    margin:0;
}

.result-box li{

    margin-bottom:10px;

    color:#555;
}

/* LOGIN NOTE */

.login-note{

    margin-top:20px;

    text-align:center;

    font-size:14px;

    color:#888;
}

/* RESPONSIVE */

@media(max-width:991px){

    .ai-wrapper{
        padding:40px;
    }

    .ai-content h2{
        font-size:36px;
    }

}

@media(max-width:768px){

    .ai-section{
        padding:70px 0;
    }

    .ai-card{
        padding:30px;
    }

    .ai-content h2{
        font-size:30px;
    }

}
</style>