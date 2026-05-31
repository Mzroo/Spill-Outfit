@extends('layouts.user')

@section('title', 'Checkout')

@section('content')

<section class="checkout-section">

    <div class="container py-5">

        <div class="checkout-header">

            <span>CHECKOUT</span>

            <h2>
                Selesaikan Pesanan Kamu ✨
            </h2>

            <p>
                Pastikan alamat dan pesanan sudah benar
                sebelum melakukan pembayaran.
            </p>

        </div>

        <form
            action="{{ route('pesanan.store') }}"
            method="POST"
        >
            @csrf

            <div class="row g-4">

                <!-- LEFT -->
                <div class="col-lg-8">

                    <!-- ALAMAT -->
                    <div class="checkout-card">

                        <h4>
                            Alamat Pengiriman
                        </h4>

                        <div class="form-grid">

                            <div class="input-group-custom">

                                <label>
                                    Nama Penerima
                                </label>

                                <input
                                    type="text"
                                    name="nama_penerima"
                                    value="{{ auth()->user()->profile?->nama_penerima }}"
                                >

                            </div>

                            <div class="input-group-custom">

                                <label>
                                    Nomor HP
                                </label>

                                <input
                                    type="text"
                                    name="no_hp"
                                    value="{{ auth()->user()->profile?->no_hp }}"
                                >

                            </div>

                            <div class="input-group-custom">

                                <label>
                                    Provinsi
                                </label>

                                <input
                                    type="text"
                                    name="provinsi"
                                    value="{{ auth()->user()->profile?->provinsi }}"
                                >

                            </div>

                            <div class="input-group-custom">

                                <label>
                                    Kota
                                </label>

                                <input
                                    type="text"
                                    name="kota"
                                    value="{{ auth()->user()->profile?->kota }}"
                                >

                            </div>

                            <div class="input-group-custom">

                                <label>
                                    Kode Pos
                                </label>

                                <input
                                    type="text"
                                    name="kode_pos"
                                    value="{{ auth()->user()->profile?->kode_pos }}"
                                >

                            </div>

                        </div>

                        <div class="input-group-custom">

                            <label>
                                Alamat Lengkap
                            </label>

                            <textarea
                                name="alamat"
                            >{{ auth()->user()->profile?->alamat }}</textarea>

                        </div>

                        <div class="input-group-custom">

                            <label>
                                Catatan (Opsional)
                            </label>

                            <textarea
                                name="catatan"
                                placeholder="Contoh: rumah pagar hitam, titip satpam"
                            ></textarea>

                        </div>

                    </div>

                    <!-- PEMBAYARAN -->
                    <div class="checkout-card mt-4">

                        <h4>
                            Metode Pembayaran
                        </h4>

                        <div class="payment-grid">

                            <label class="payment-box">

                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="transfer_bca"
                                    checked
                                >

                                <span>
                                    Transfer BCA
                                </span>

                            </label>

                            <label class="payment-box">

                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="transfer_bri"
                                >

                                <span>
                                    Transfer BRI
                                </span>

                            </label>

                            <label class="payment-box">

                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="dana"
                                >

                                <span>
                                    DANA
                                </span>

                            </label>

                            <label class="payment-box">

                                <input
                                    type="radio"
                                    name="metode_pembayaran"
                                    value="gopay"
                                >

                                <span>
                                    GoPay
                                </span>

                            </label>

                        </div>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-4">

                    <div class="summary-card">

                        <h4>
                            Ringkasan Belanja
                        </h4>

                        @php
                            $total = 0;
                        @endphp

                        @foreach($keranjang as $item)

                            @php
                                $harga =
                                    $item->varian->harga
                                    ?? $item->produk->harga;

                                $subtotal =
                                    $harga *
                                    $item->qty;

                                $total +=
                                    $subtotal;
                            @endphp

                            <div class="summary-item">

                                <div>

                                    <h6>
                                        {{ $item->produk->nama }}
                                    </h6>

                                    <small>
                                        Qty:
                                        {{ $item->qty }}
                                    </small>

                                </div>

                                <strong>
                                    Rp {{ number_format($subtotal,0,',','.') }}
                                </strong>

                            </div>

                        @endforeach

                        <hr>

                        <div class="total-row">

                            <span>Total</span>

                            <h4>
                                Rp {{ number_format($total,0,',','.') }}
                            </h4>

                        </div>

                        <button
                            type="submit"
                            class="btn-checkout"
                        >
                            Buat Pesanan
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</section>

<style>

.checkout-section{
    min-height:100vh;
    background:#f8f5ed;
}

.checkout-header{
    margin-bottom:40px;
}

.checkout-header span{
    background:#efe4c8;
    color:#8C6A2F;
    padding:10px 18px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
}

.checkout-header h2{
    margin-top:18px;
    font-size:48px;
    font-weight:800;
}

.checkout-header p{
    color:#777;
}

.checkout-card,
.summary-card{
    background:#fff;
    border-radius:28px;
    padding:35px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.06);
}

.checkout-card h4,
.summary-card h4{
    margin-bottom:25px;
    font-weight:800;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.input-group-custom{
    margin-bottom:20px;
}

.input-group-custom label{
    display:block;
    margin-bottom:10px;
    font-weight:700;
}

.input-group-custom input,
.input-group-custom textarea{
    width:100%;
    border:none;
    background:#f8f5ed;
    border-radius:18px;
    padding:16px 20px;
}

.input-group-custom textarea{
    height:130px;
    resize:none;
}

.payment-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
}

.payment-box{
    background:#f8f5ed;
    border-radius:18px;
    padding:20px;
    cursor:pointer;
}

.summary-item{
    display:flex;
    justify-content:space-between;
    margin-bottom:20px;
}

.total-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:20px;
}

.btn-checkout{
    width:100%;
    border:none;
    padding:18px;
    border-radius:20px;
    margin-top:30px;
    color:white;
    font-weight:700;
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
}

@media(max-width:768px){

    .form-grid{
        grid-template-columns:1fr;
    }

    .checkout-header h2{
        font-size:36px;
    }

    .checkout-card,
    .summary-card{
        padding:25px;
    }
}

</style>

@endsection