@extends('layouts.user')

@section('title', 'Pembayaran')

@section('content')

<section class="payment-section">

    <div class="container py-5">

        <!-- HEADER -->
        <div class="payment-header">

            <span>
                PEMBAYARAN PESANAN
            </span>

            <h2>
                Selesaikan Pembayaran 💳
            </h2>

            <p>
                Transfer sesuai nominal lalu upload bukti pembayaran.
            </p>

        </div>

        <div class="row g-4">

            <!-- LEFT -->
            <div class="col-lg-8">

                <div class="payment-card">

                    <h4>
                        Detail Pembayaran
                    </h4>

                    <div class="payment-info">

                        <div class="info-item">
                            <span>No Invoice</span>
                            <strong>
                                INV-20260531-001
                            </strong>
                        </div>

                        <div class="info-item">
                            <span>Status</span>

                            <span class="badge-payment">
                                Menunggu Pembayaran
                            </span>
                        </div>

                        <div class="info-item">
                            <span>Total Bayar</span>

                            <h3 class="price">
                                Rp 450.000
                            </h3>
                        </div>

                    </div>

                </div>

                <!-- PAYMENT METHOD -->
                <div class="payment-card mt-4">

                    <h4>
                        Transfer Ke
                    </h4>

                    <div class="rekening-card">

                        <div class="rekening-icon">
                            💳
                        </div>

                        <div>

                            <small>
                                Bank BCA
                            </small>

                            <h5>
                                1234567890
                            </h5>

                            <p>
                                a/n OutfitStore
                            </p>

                        </div>

                    </div>

                    <div class="rekening-card">

                        <div class="rekening-icon">
                            📱
                        </div>

                        <div>

                            <small>
                                DANA
                            </small>

                            <h5>
                                081234567890
                            </h5>

                            <p>
                                a/n OutfitStore
                            </p>

                        </div>

                    </div>

                </div>

                <!-- UPLOAD -->
                <div class="payment-card mt-4">

                    <h4>
                        Upload Bukti Pembayaran
                    </h4>

                    <form
                        action="#"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="upload-box">

                            <img
                                id="previewImage"
                                src="https://via.placeholder.com/500x250?text=Preview+Bukti+Transfer"
                            >

                        </div>

                        <input
                            type="file"
                            name="bukti_pembayaran"
                            id="buktiInput"
                            class="form-control mt-3"
                        >

                        <button
                            type="submit"
                            class="btn-submit mt-4"
                        >
                            Upload Bukti Pembayaran
                        </button>

                    </form>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-lg-4">

                <div class="summary-card">

                    <h4>
                        Ringkasan Pesanan
                    </h4>

                    <div class="summary-item">
                        <span>Total Barang</span>
                        <strong>3 Item</strong>
                    </div>

                    <div class="summary-item">
                        <span>Ongkir</span>
                        <strong>
                            Rp 20.000
                        </strong>
                    </div>

                    <hr>

                    <div class="summary-total">

                        <span>Total</span>

                        <h3>
                            Rp 450.000
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

.payment-section{
    background:#f8f5ed;
    min-height:100vh;
}

.payment-header{
    margin-bottom:40px;
}

.payment-header span{
    background:#efe4c8;
    color:#8C6A2F;
    padding:10px 20px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
}

.payment-header h2{
    font-size:48px;
    font-weight:800;
    margin-top:20px;
    color:#2d2d2d;
}

.payment-header p{
    color:#777;
}

.payment-card,
.summary-card{
    background:white;
    border-radius:30px;
    padding:30px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.06);
}

.payment-card h4,
.summary-card h4{
    font-weight:800;
    margin-bottom:25px;
}

.info-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.badge-payment{
    background:#fff3cd;
    color:#856404;
    padding:8px 15px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
}

.price{
    color:#8C6A2F;
    font-weight:800;
}

.rekening-card{
    display:flex;
    gap:20px;
    align-items:center;
    background:#f8f5ed;
    padding:20px;
    border-radius:20px;
    margin-bottom:15px;
}

.rekening-icon{
    width:60px;
    height:60px;
    border-radius:50%;
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    font-size:24px;
}

.upload-box{
    border-radius:20px;
    overflow:hidden;
    border:2px dashed #d7c89b;
}

.upload-box img{
    width:100%;
    height:250px;
    object-fit:cover;
}

.btn-submit{
    width:100%;
    border:none;
    padding:16px;
    border-radius:20px;
    color:white;
    font-weight:700;
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
}

.summary-item,
.summary-total{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.summary-total h3{
    color:#8C6A2F;
    font-weight:800;
}

@media(max-width:768px){

    .payment-header h2{
        font-size:35px;
    }

    .payment-card,
    .summary-card{
        padding:22px;
    }
}

</style>

<script>

document
.getElementById('buktiInput')
.addEventListener(
    'change',
    function(e){

        const file =
        e.target.files[0];

        if(file){

            document
            .getElementById(
                'previewImage'
            ).src =
            URL.createObjectURL(file);
        }
    }
);

</script>

@endsection