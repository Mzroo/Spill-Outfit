@extends('layouts.user')

@section('content')

@php
    $varian = $produk->varian;
@endphp

<section class="modern-bg">

<div class="container py-5">

    <div class="row g-5">

        <!-- LEFT IMAGE -->
        <div class="col-lg-5">

            <div class="gallery-card">

                <div class="image-wrapper">
                    <img id="mainImage"
                         src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/600' }}"
                         class="main-image">
                </div>

                <div class="thumb-wrapper mt-3">

                    <img class="thumb active"
                         src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/100' }}"
                         onclick="setImage(this)">

                    @if(isset($produk->gambarTambahan))
                        @foreach($produk->gambarTambahan as $img)
                            <img class="thumb"
                                 src="{{ asset('storage/'.$img->gambar) }}"
                                 onclick="setImage(this)">
                        @endforeach
                    @endif

                </div>

            </div>

        </div>

        <!-- RIGHT INFO -->
        <div class="col-lg-7">

            <div class="product-info-card">

                <small class="category">
                    {{ optional($produk->kategori)->nama }}
                </small>

                <h2 class="title">
                    {{ $produk->nama }}
                </h2>

                <div class="rating">
                    ★★★★★ <span>(120 review)</span>
                </div>

                <h3 id="priceBox" class="price">
                    Rp {{ number_format($produk->harga,0,',','.') }}
                </h3>

                <div class="stock">
                    Stok:
                    <span id="stockBox">-</span>
                </div>

                <!-- WARNA -->
                <div class="option-box mt-4">

                    <b>Warna</b>

                    <div class="options">

                        @foreach($produk->varian->unique('warna_id') as $v)

                        <button type="button"
                                class="opt-btn warna-btn"
                                data-warna="{{ $v->warna_id }}">

                            {{ $v->warna->nama }}

                        </button>

                        @endforeach

                    </div>

                </div>

                <!-- UKURAN -->
                <div class="option-box mt-3">

                    <b>Ukuran</b>

                    <div class="options">

                        @foreach($produk->varian->unique('ukuran_id') as $v)

                        <button type="button"
                                class="opt-btn ukuran-btn"
                                data-ukuran="{{ $v->ukuran_id }}">

                            {{ $v->ukuran->kode }}

                        </button>

                        @endforeach

                    </div>

                </div>

                <!-- JUMLAH -->
                <div class="mt-4">

                    <b>Jumlah</b>

                    <div class="qty-box">

                        <button type="button" id="minus">
                            −
                        </button>

                        <input type="text"
                               id="qty"
                               value="1"
                               readonly>

                        <button type="button" id="plus">
                            +
                        </button>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4">

                    @auth

                    <form action="{{ route('keranjang.store', $produk->id) }}"
                          method="POST">

                        @csrf

                        <!-- qty -->
                        <input type="hidden"
                               name="qty"
                               id="qtyInput"
                               value="1">

                        <!-- INI YANG DIBUTUHKAN CONTROLLER -->
                        <input type="hidden"
                               name="produk_varian_id"
                               id="produkVarianInput">

                        <button type="submit"
                                id="btnCart"
                                class="btn-cart w-100"
                                disabled>

                            Masukkan ke Keranjang

                        </button>

                    </form>

                    @else

                    <a href="{{ route('login') }}"
                       class="btn-cart text-decoration-none d-flex justify-content-center align-items-center w-100">

                        Login untuk membeli

                    </a>

                    @endauth

                </div>

            </div>

        </div>

    </div>

    <!-- RELATED PRODUCT -->
    <div class="related mt-5">

        <h3 class="mb-3">
            Produk Serupa
        </h3>

        <div class="row g-4">

            @foreach($rekomendasi as $item)

            <div class="col-lg-3 col-md-4 col-6">

                <a href="{{ route('produk.detail', $item->id) }}"
                   class="card-related">

                    <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/300' }}">

                    <div class="body">

                        <small>
                            {{ optional($item->kategori)->nama }}
                        </small>

                        <h6>
                            {{ $item->nama }}
                        </h6>

                        <span>
                            Rp {{ number_format($item->harga,0,',','.') }}
                        </span>

                    </div>

                </a>

            </div>

            @endforeach

        </div>

    </div>

</div>

</section>

<style>

.modern-bg{
    background:#fefefe;
    min-height:100vh;
}

.gallery-card,
.product-info-card{
    background:#fff;
    padding:25px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    height:100%;
}

.image-wrapper{
    width:100%;
    height:380px;
    border-radius:14px;
    overflow:hidden;
}

.main-image{
    width:100%;
    height:100%;
    object-fit:cover;
}

.thumb-wrapper{
    display:flex;
    gap:10px;
    margin-top:12px;
}

.thumb{
    width:70px;
    height:70px;
    border-radius:12px;
    object-fit:cover;
    cursor:pointer;
    border:2px solid transparent;
}

.thumb.active{
    border-color:#c8a24a;
}

.title{
    font-weight:800;
}

.category{
    color:#a58a3a;
}

.rating{
    color:#c8a24a;
}

.price{
    color:#a67c00;
    font-weight:800;
}

.options{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
    margin-top:8px;
}

.opt-btn{
    padding:8px 14px;
    border:1px solid #d6c28d;
    border-radius:10px;
    background:#fff;
    cursor:pointer;
}

.opt-btn.active{
    background:#c8a24a;
    color:#fff;
}

.qty-box{
    display:flex;
    gap:10px;
    align-items:center;
}

.qty-box button{
    width:42px;
    height:42px;
    border:none;
    background:#f3e6c4;
    border-radius:10px;
}

.qty-box input{
    width:70px;
    text-align:center;
    border:1px solid #ddd;
    border-radius:10px;
}

.btn-cart{
    background:linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:#fff;
    border:none;
    padding:12px;
    border-radius:10px;
    font-weight:600;
}

.card-related{
    display:block;
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    text-decoration:none;
    color:#000;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.card-related img{
    width:100%;
    height:160px;
    object-fit:cover;
}

.card-related .body{
    padding:10px;
}

</style>

<script>

const varian = @json($produk->varian);

let selectedWarna = null;
let selectedUkuran = null;

function setImage(el){

    document.getElementById('mainImage').src = el.src;

    document.querySelectorAll('.thumb')
        .forEach(t => t.classList.remove('active'));

    el.classList.add('active');
}

/* pilih warna */
document.querySelectorAll('.warna-btn')
.forEach(btn => {

    btn.onclick = function(){

        document.querySelectorAll('.warna-btn')
            .forEach(b => b.classList.remove('active'));

        this.classList.add('active');

        selectedWarna = this.dataset.warna;

        update();
    };
});

/* pilih ukuran */
document.querySelectorAll('.ukuran-btn')
.forEach(btn => {

    btn.onclick = function(){

        document.querySelectorAll('.ukuran-btn')
            .forEach(b => b.classList.remove('active'));

        this.classList.add('active');

        selectedUkuran = this.dataset.ukuran;

        update();
    };
});

function update(){

    const match = varian.find(v =>
        v.warna_id == selectedWarna &&
        v.ukuran_id == selectedUkuran
    );

    if(!match){

        reset();

        return;
    }

    document.getElementById('priceBox').innerText =
        'Rp ' +
        new Intl.NumberFormat('id-ID')
        .format(match.harga);

    document.getElementById('stockBox').innerText =
        match.stok;

    document.getElementById('produkVarianInput').value =
        match.id;

    document.getElementById('btnCart').disabled =
        match.stok <= 0;
}

/* reset */
function reset(){

    document.getElementById('stockBox').innerText = '-';

    document.getElementById('produkVarianInput').value = '';

    document.getElementById('btnCart').disabled = true;
}

/* qty */
let qty = document.getElementById('qty');

document.getElementById('plus').onclick = () => {

    qty.value++;

    document.getElementById('qtyInput').value =
        qty.value;
};

document.getElementById('minus').onclick = () => {

    if(qty.value > 1){
        qty.value--;
    }

    document.getElementById('qtyInput').value =
        qty.value;
};

</script>

@endsection
