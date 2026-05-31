@extends('layouts.user')

@section('title', 'Invoice')

@section('content')

<section class="invoice-section">

    <div class="container py-5">

        <div class="invoice-card">

            <!-- HEADER -->
            <div class="invoice-header">

                <div>
                    <span class="badge-invoice">
                        INVOICE
                    </span>

                    <h2>
                        Invoice Pesanan
                    </h2>

                    <p>
                        Detail pembayaran dan pesanan kamu
                    </p>
                </div>

                <div class="invoice-number">

                    <h5>
                        {{ $pesanan->kode_pesanan }}
                    </h5>

                    <small>
                        {{ $pesanan->created_at->format('d M Y H:i') }}
                    </small>

                </div>

            </div>

            <!-- CUSTOMER -->
            <div class="invoice-box">

                <h5>
                    Informasi Penerima
                </h5>

                <div class="info-grid">

                    <div>
                        <span>Nama</span>
                        <p>
                            {{ $pesanan->nama_penerima }}
                        </p>
                    </div>

                    <div>
                        <span>No HP</span>
                        <p>
                            {{ $pesanan->no_hp }}
                        </p>
                    </div>

                    <div>
                        <span>Provinsi</span>
                        <p>
                            {{ $pesanan->provinsi }}
                        </p>
                    </div>

                    <div>
                        <span>Kota</span>
                        <p>
                            {{ $pesanan->kota }}
                        </p>
                    </div>

                </div>

                <div class="mt-3">

                    <span>Alamat Lengkap</span>

                    <p>
                        {{ $pesanan->alamat }}
                    </p>

                </div>

            </div>

            <!-- PRODUK -->
            <div class="invoice-box mt-4">

                <h5>
                    Produk Dibeli
                </h5>

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>
                                <th>Produk</th>
                                <th>Varian</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($pesanan->detail as $item)

                            <tr>

                                <td>

                                    <div class="product-cell">

                                        <img
                                            src="{{ asset('storage/' . $item->produk->gambar) }}"
                                        >

                                        <div>

                                            <h6>
                                                {{ $item->produk->nama }}
                                            </h6>

                                            <small>
                                                {{ optional($item->produk->kategori)->nama }}
                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    {{ $item->varian?->warna?->nama ?? '-' }}
                                    /
                                    {{ $item->varian?->ukuran?->kode ?? '-' }}

                                </td>

                                <td>
                                    {{ $item->qty }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->harga,0,',','.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->subtotal,0,',','.') }}
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- PAYMENT -->
            <div class="invoice-footer">

                <div class="payment-box">

                    <h5>
                        Pembayaran
                    </h5>

                    <p>
                        Metode:
                        <b>
                            {{ $pesanan->metode_pembayaran }}
                        </b>
                    </p>

                    <p>
                        Status:
                        <span class="status">

                            {{ $pesanan->status }}

                        </span>
                    </p>

                </div>

                <div class="total-box">

                    <div class="total-item">

                        <span>Total</span>

                        <h3>
                            Rp {{ number_format($pesanan->total_harga,0,',','.') }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

.invoice-section{
    background:#f8f5ed;
    min-height:100vh;
}

.invoice-card{
    background:#fff;
    border-radius:35px;
    padding:45px;
    box-shadow:0 15px 35px rgba(0,0,0,.08);
}

.invoice-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    border-bottom:1px solid #eee;
    padding-bottom:30px;
    margin-bottom:35px;
}

.badge-invoice{
    background:#efe4c8;
    color:#8C6A2F;
    padding:10px 18px;
    border-radius:999px;
    font-weight:700;
}

.invoice-header h2{
    font-weight:800;
    margin-top:18px;
}

.invoice-number{
    text-align:right;
}

.invoice-box{
    background:#faf8f2;
    border-radius:24px;
    padding:25px;
}

.info-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.info-grid span,
.invoice-box span{
    color:#777;
    font-size:14px;
}

.info-grid p{
    margin-top:4px;
    font-weight:700;
}

.product-cell{
    display:flex;
    align-items:center;
    gap:14px;
}

.product-cell img{
    width:75px;
    height:75px;
    border-radius:14px;
    object-fit:cover;
}

.invoice-footer{
    margin-top:35px;
    display:flex;
    justify-content:space-between;
    gap:20px;
}

.payment-box,
.total-box{
    flex:1;
    background:#faf8f2;
    border-radius:24px;
    padding:25px;
}

.total-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.total-item h3{
    color:#8C6A2F;
    font-weight:800;
}

.status{
    color:#C9A227;
    font-weight:700;
}

@media(max-width:768px){

    .invoice-header,
    .invoice-footer{
        flex-direction:column;
    }

    .info-grid{
        grid-template-columns:1fr;
    }

    .invoice-card{
        padding:25px;
    }
}

</style>

@endsection