@extends('layouts.user')

@section('title', 'Detail Pesanan')

@section('content')

<section class="detail-section">

    <div class="container py-5">

        <!-- HEADER -->
        <div class="page-header">

            <div>

                <span class="badge-order">
                    DETAIL PESANAN
                </span>

                <h2>
                    Invoice #{{ $pesanan->kode_pesanan }}
                </h2>

                <p>
                    Detail transaksi dan status pesanan kamu
                </p>

            </div>

            <div class="status-box">

                <span class="status">
                    {{ $pesanan->status }}
                </span>

            </div>

        </div>

        <div class="row g-4">

            <!-- LEFT -->
            <div class="col-lg-8">

                <!-- PRODUK -->
                <div class="card-box">

                    <h4>
                        Produk Dipesan
                    </h4>

                    @foreach($pesanan->items as $item)

                    <div class="product-item">

                        <div class="product-image">

                            <img
                                src="{{ $item->produk->gambar
                                ? asset('storage/' . $item->produk->gambar)
                                : 'https://via.placeholder.com/300' }}"
                            >

                        </div>

                        <div class="product-body">

                            <h5>
                                {{ $item->produk->nama }}
                            </h5>

                            <p>
                                Warna:
                                {{ $item->varian?->warna?->nama ?? '-' }}
                            </p>

                            <p>
                                Ukuran:
                                {{ $item->varian?->ukuran?->kode ?? '-' }}
                            </p>

                            <small>
                                Qty:
                                {{ $item->qty }}
                            </small>

                        </div>

                        <div class="product-price">

                            Rp {{ number_format($item->subtotal,0,',','.') }}

                        </div>

                    </div>

                    @endforeach

                </div>

                <!-- ALAMAT -->
                <div class="card-box mt-4">

                    <h4>
                        Alamat Pengiriman
                    </h4>

                    <div class="address-box">

                        <h5>
                            {{ $pesanan->nama_penerima }}
                        </h5>

                        <p>
                            {{ $pesanan->no_hp }}
                        </p>

                        <p>
                            {{ $pesanan->alamat }}
                        </p>

                        <p>
                            {{ $pesanan->kota }},
                            {{ $pesanan->provinsi }}
                        </p>

                        <p>
                            {{ $pesanan->kode_pos }}
                        </p>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-lg-4">

                <!-- PEMBAYARAN -->
                <div class="card-box sticky-card">

                    <h4>
                        Pembayaran
                    </h4>

                    <div class="summary-item">
                        <span>Metode</span>
                        <b>
                            {{ $pesanan->metode_pembayaran }}
                        </b>
                    </div>

                    <div class="summary-item">
                        <span>Status</span>
                        <b>
                            {{ $pesanan->status_pembayaran }}
                        </b>
                    </div>

                    <hr>

                    <div class="summary-item">
                        <span>Subtotal</span>
                        <b>
                            Rp {{ number_format($pesanan->subtotal,0,',','.') }}
                        </b>
                    </div>

                    <div class="summary-item">
                        <span>Ongkir</span>
                        <b>
                            Rp {{ number_format($pesanan->ongkir,0,',','.') }}
                        </b>
                    </div>

                    <div class="summary-item total">
                        <span>Total</span>
                        <h3>
                            Rp {{ number_format($pesanan->total_harga,0,',','.') }}
                        </h3>
                    </div>

                    @if($pesanan->bukti_pembayaran)

                        <hr>

                        <h5>
                            Bukti Pembayaran
                        </h5>

                        <img
                            src="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}"
                            class="payment-proof"
                        >

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>

<style>

.detail-section{
    background:#faf7ef;
    min-height:100vh;
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:35px;
    flex-wrap:wrap;
    gap:20px;
}

.badge-order{
    background:#efe4c8;
    color:#8C6A2F;
    padding:10px 18px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
}

.page-header h2{
    font-size:42px;
    font-weight:800;
    color:#2d2d2d;
    margin-top:15px;
}

.page-header p{
    color:#777;
}

.status{
    background:#d7f7df;
    color:#208c4d;
    padding:14px 22px;
    border-radius:999px;
    font-weight:700;
}

.card-box{
    background:white;
    border-radius:28px;
    padding:28px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.06);
}

.card-box h4{
    font-weight:800;
    margin-bottom:25px;
}

.product-item{
    display:flex;
    align-items:center;
    gap:20px;
    border-bottom:1px solid #eee;
    padding-bottom:20px;
    margin-bottom:20px;
}

.product-image{
    width:100px;
    height:100px;
    overflow:hidden;
    border-radius:20px;
    flex-shrink:0;
}

.product-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.product-body{
    flex:1;
}

.product-body h5{
    font-weight:700;
}

.product-body p{
    margin:2px 0;
    color:#666;
}

.product-price{
    font-weight:800;
    color:#8C6A2F;
}

.address-box h5{
    font-weight:700;
}

.address-box p{
    color:#666;
    margin-bottom:8px;
}

.summary-item{
    display:flex;
    justify-content:space-between;
    margin-bottom:18px;
}

.summary-item.total{
    margin-top:20px;
}

.summary-item.total h3{
    color:#8C6A2F;
    font-weight:800;
}

.payment-proof{
    width:100%;
    border-radius:20px;
    margin-top:15px;
}

.sticky-card{
    position:sticky;
    top:100px;
}

@media(max-width:768px){

    .page-header h2{
        font-size:30px;
    }

    .product-item{
        flex-direction:column;
        align-items:flex-start;
    }
}

</style>

@endsection