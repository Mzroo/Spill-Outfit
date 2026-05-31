@extends('layouts.user')

@section('title', 'Pesanan Saya')

@section('content')

<section class="pesanan-section">

    <div class="container py-5">

        <!-- HEADER -->
        <div class="page-header">

            <span class="badge-title">
                ORDER HISTORY
            </span>

            <h2>
                Pesanan Saya 📦
            </h2>

            <p>
                Lihat status pembelian, pembayaran,
                invoice, dan detail pesanan kamu.
            </p>

        </div>

        @forelse($pesanan as $item)

        <div class="order-card">

            <!-- LEFT -->
            <div class="order-left">

                <div class="invoice-code">
                    {{ $item->kode_pesanan }}
                </div>

                <div class="order-date">
                    {{ $item->created_at->format('d M Y - H:i') }}
                </div>

                <div class="order-info">

                    <h5>
                        {{ $item->detail->count() }}
                        Produk
                    </h5>

                    <div class="price">
                        Rp {{ number_format($item->total_harga,0,',','.') }}
                    </div>

                </div>

            </div>

            <!-- STATUS -->
            <div class="order-center">

                @php
                    $statusClass = match($item->status){

                        'pending' => 'status-warning',
                        'menunggu_verifikasi' => 'status-info',
                        'diproses' => 'status-primary',
                        'dikirim' => 'status-success',
                        'selesai' => 'status-finished',
                        'dibatalkan' => 'status-danger',

                        default => 'status-secondary'
                    };
                @endphp

                <span class="status-badge {{ $statusClass }}">

                    {{ ucfirst(str_replace('_',' ',$item->status)) }}

                </span>

            </div>

            <!-- ACTION -->
            <div class="order-right">

                <a
                    href="{{ route('pesanan.detail', $item->id) }}"
                    class="btn-detail"
                >
                    Detail
                </a>

                <a
                    href="{{ route('pesanan.invoice', $item->id) }}"
                    class="btn-invoice"
                >
                    Invoice
                </a>

                @if($item->status == 'pending')

                    <a
                        href="{{ route('pesanan.uploadBukti', $item->id) }}"
                        class="btn-pay"
                    >
                        Upload Bukti
                    </a>

                @endif

            </div>

        </div>

        @empty

        <div class="empty-order">

            <h3>
                Belum Ada Pesanan
            </h3>

            <p>
                Yuk checkout outfit favoritmu ✨
            </p>

            <a
                href="{{ route('produk.index') }}"
                class="btn-shop"
            >
                Belanja Sekarang
            </a>

        </div>

        @endforelse

    </div>

</section>

<style>

.pesanan-section{
    min-height:100vh;
    background:#f8f5ed;
}

/* HEADER */

.page-header{
    margin-bottom:40px;
}

.badge-title{
    background:#efe4c8;
    color:#8C6A2F;
    padding:10px 18px;
    border-radius:999px;
    font-size:13px;
    font-weight:700;
}

.page-header h2{
    font-size:48px;
    font-weight:800;
    margin-top:18px;
    color:#2f2f2f;
}

.page-header p{
    color:#777;
}

/* CARD */

.order-card{
    background:white;
    border-radius:30px;
    padding:30px;
    margin-bottom:22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:30px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.06);
}

.invoice-code{
    font-size:22px;
    font-weight:800;
    color:#8C6A2F;
}

.order-date{
    color:#777;
    margin-top:8px;
}

.order-info{
    margin-top:15px;
}

.order-info h5{
    font-weight:700;
}

.price{
    font-size:24px;
    font-weight:800;
    color:#C9A227;
}

/* STATUS */

.status-badge{
    padding:12px 22px;
    border-radius:999px;
    font-weight:700;
}

.status-warning{
    background:#fff3cd;
    color:#856404;
}

.status-info{
    background:#dbeafe;
    color:#1d4ed8;
}

.status-primary{
    background:#ede9fe;
    color:#6d28d9;
}

.status-success{
    background:#dcfce7;
    color:#166534;
}

.status-finished{
    background:#d1fae5;
    color:#065f46;
}

.status-danger{
    background:#fee2e2;
    color:#991b1b;
}

/* BUTTON */

.order-right{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.btn-detail,
.btn-invoice,
.btn-pay,
.btn-shop{
    border:none;
    text-decoration:none;
    border-radius:16px;
    padding:14px 22px;
    font-weight:700;
}

.btn-detail{
    background:#f5f5f5;
    color:#222;
}

.btn-invoice{
    background:#8C6A2F;
    color:white;
}

.btn-pay{
    background:#C9A227;
    color:white;
}

/* EMPTY */

.empty-order{
    background:white;
    border-radius:35px;
    text-align:center;
    padding:80px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.06);
}

.btn-shop{
    display:inline-block;
    margin-top:20px;
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
}

/* MOBILE */

@media(max-width:768px){

    .order-card{
        flex-direction:column;
        align-items:flex-start;
    }

    .page-header h2{
        font-size:38px;
    }

    .order-right{
        width:100%;
    }

    .btn-detail,
    .btn-invoice,
    .btn-pay{
        width:100%;
        text-align:center;
    }
}

</style>

@endsection