@extends('layouts.user')

@section('content')

<section class="cart-section">

    <div class="container py-5">

        <!-- HEADER -->
        <div class="cart-header mb-4">
            <h2>Keranjang Saya</h2>
            <p>Outfit pilihanmu siap untuk checkout ✨</p>
        </div>

        <div class="row g-4">

            <!-- LEFT -->
            <div class="col-lg-8">

                @forelse($keranjang as $item)

                    @php
                        $harga = $item->varian?->harga ?? $item->produk?->harga ?? 0;
                        $subtotal = $harga * $item->qty;
                    @endphp

                    <div class="cart-card">

                        <!-- IMAGE -->
                        <div class="cart-image">
                            <img
                                src="{{ $item->produk?->gambar
                                    ? asset('storage/' . $item->produk->gambar)
                                    : 'https://via.placeholder.com/300' }}"
                                alt="produk"
                            >
                        </div>

                        <!-- BODY -->
                        <div class="cart-body">

                            <small class="category">
                                {{ optional($item->produk?->kategori)->nama }}
                            </small>

                            <h5 class="product-name">
                                {{ $item->produk?->nama }}
                            </h5>

                            <!-- VARIAN -->
                            <div class="variant-box">

                                <span class="variant-tag">
                                    Warna:
                                    {{ optional($item->varian?->warna)->nama ?? '-' }}
                                </span>

                                <span class="variant-tag">
                                    Size:
                                    {{ optional($item->varian?->ukuran)->kode ?? '-' }}
                                </span>

                            </div>

                            <!-- PRICE -->
                            <div class="price">
                                Rp {{ number_format($harga, 0, ',', '.') }}
                            </div>

                            <!-- QTY -->
                            <div class="qty-row">

                                <span>Jumlah</span>

                                <div class="qty-box">

                                    <!-- MINUS -->
                                    <form
                                        action="{{ route('keranjang.updateQty', $item->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PUT')

                                        <input
                                            type="hidden"
                                            name="action"
                                            value="minus"
                                        >

                                        <button
                                            type="submit"
                                            class="qty-btn"
                                        >
                                            −
                                        </button>
                                    </form>

                                    <span class="qty-number">
                                        {{ $item->qty }}
                                    </span>

                                    <!-- PLUS -->
                                    <form
                                        action="{{ route('keranjang.updateQty', $item->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PUT')

                                        <input
                                            type="hidden"
                                            name="action"
                                            value="plus"
                                        >

                                        <button
                                            type="submit"
                                            class="qty-btn"
                                        >
                                            +
                                        </button>
                                    </form>

                                </div>

                                @if($item->varian)
                                    <small class="stok-text">
                                        Stok:
                                        {{ $item->varian->stok }}
                                    </small>
                                @endif

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="cart-right">

                            <div class="subtotal">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </div>

                            <form
                                action="{{ route('keranjang.destroy', $item->id) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-delete"
                                    onclick="return confirm('Hapus produk dari keranjang?')"
                                >
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="empty-cart">

                        <h4>Keranjang Kosong</h4>

                        <p>
                            Yuk tambahkan outfit favoritmu 🛍️
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

            <!-- RIGHT SUMMARY -->
            <div class="col-lg-4">

                <div class="summary-card">

                    <h4>Ringkasan Belanja</h4>

                    @php
                        $total = 0;

                        foreach ($keranjang as $item) {
                            $harga = $item->varian?->harga ?? $item->produk?->harga ?? 0;
                            $total += $harga * $item->qty;
                        }
                    @endphp

                    <div class="summary-item">

                        <span>Total</span>

                        <h3>
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </h3>

                    </div>

                    @if($keranjang->count())

                    <a href="{{ route('pesanan.checkout') }}"
                        class="btn-checkout">
                        Checkout
                    </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>

<style>

.cart-section{
    min-height:100vh;
    background:linear-gradient(
        180deg,
        #faf7ef,
        #f8f4e8
    );
}

.cart-header h2{
    font-size:38px;
    font-weight:800;
    color:#6d4c1f;
}

.cart-header p{
    color:#8d7b55;
}

.cart-card{
    background:#fff;
    border-radius:24px;
    padding:22px;
    display:flex;
    gap:22px;
    margin-bottom:20px;
    align-items:center;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.cart-image{
    width:150px;
    height:150px;
    border-radius:20px;
    overflow:hidden;
    flex-shrink:0;
}

.cart-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.cart-body{
    flex:1;
}

.category{
    color:#b28d45;
}

.product-name{
    font-size:22px;
    font-weight:700;
    margin:8px 0;
}

.variant-box{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-bottom:14px;
}

.variant-tag{
    background:#f5edd7;
    color:#8b6925;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
}

.price{
    font-size:22px;
    font-weight:700;
    color:#8b6925;
}

.qty-row{
    margin-top:18px;
}

.qty-box{
    display:flex;
    align-items:center;
    gap:14px;
    margin-top:10px;
}

.qty-btn{
    width:40px;
    height:40px;
    border:none;
    border-radius:12px;
    background:#ead9a6;
    font-size:22px;
    font-weight:bold;
}

.qty-number{
    font-size:18px;
    font-weight:700;
    min-width:20px;
    text-align:center;
}

.stok-text{
    display:block;
    margin-top:10px;
    color:#777;
}

.cart-right{
    text-align:right;
}

.subtotal{
    font-size:22px;
    font-weight:800;
    color:#6d4c1f;
    margin-bottom:14px;
}

.btn-delete{
    border:none;
    padding:10px 18px;
    border-radius:12px;
    background:#d9534f;
    color:white;
}

.summary-card{
    background:#fff;
    border-radius:24px;
    padding:28px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    position:sticky;
    top:100px;
}

.summary-card h4{
    font-weight:800;
    margin-bottom:30px;
}

.summary-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.summary-item h3{
    color:#8b6925;
    font-weight:800;
}

.btn-checkout,
.btn-shop{
    display:block;
    margin-top:30px;
    text-align:center;
    text-decoration:none;
    padding:16px;
    border-radius:18px;
    background:linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
    font-weight:700;
}

.empty-cart{
    background:#fff;
    border-radius:24px;
    padding:70px;
    text-align:center;
}

@media(max-width:768px){

    .cart-card{
        flex-direction:column;
        align-items:flex-start;
    }

    .cart-right{
        width:100%;
        text-align:left;
    }

    .cart-image{
        width:100%;
        height:260px;
    }
}

</style>

@endsection