@extends('layouts.user')

@section('title', 'Produk')

@section('content')

@php
use Illuminate\Support\Str;
@endphp

<section class="produk-section">

    <!-- HEADER -->
    <div class="produk-header">

        <div>
            <span class="sub-title">SPILL OUTFIT COLLECTION</span>

            <h2>
                Temukan Outfit <br>
                Favoritmu ✨
            </h2>

            <p>
                Koleksi fashion aesthetic modern untuk tampil lebih stylish.
            </p>
        </div>

    </div>

    <!-- GRID -->
    <div class="row g-4">

        @forelse($produk as $item)

        @php
            // ambil stok dari varian (WAJIB SISTEM BARU)
            $totalStok = $item->varian->sum('stok') ?? 0;

            // ambil harga termurah dari varian (opsional)
            $hargaMin = $item->varian->min('harga') ?? $item->harga;
        @endphp

        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="produk-card">

                <!-- IMAGE -->
                <div class="produk-image">

                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}">
                    @else
                        <img src="https://via.placeholder.com/500x700?text=No+Image">
                    @endif

                    <div class="overlay-produk">
                        <a href="{{ route('produk.show', $item->id) }}">
                            View Detail
                        </a>
                    </div>

                    <div class="wishlist">
                        <i class="mdi mdi-heart-outline"></i>
                    </div>

                </div>

                <!-- BODY -->
                <div class="produk-body">

                    <small class="kategori">
                        {{ optional($item->kategori)->nama }}
                    </small>

                    <h4 class="produk-title">
                        {{ $item->nama }}
                    </h4>

                    <p class="produk-deskripsi">
                        {{ Str::limit($item->deskripsi, 65) }}
                    </p>

                    <!-- FOOTER -->
                    <div class="produk-footer">

                        <div>

                            <span class="price-label">Price</span>

                            <h5>
                                Rp {{ number_format($hargaMin,0,',','.') }}
                            </h5>

                            <small style="color:#888;">
                                Stok: {{ $totalStok }}
                            </small>

                        </div>

                        <a href="{{ route('produk.show', $item->id) }}"
                           class="btn-detail">

                            <i class="mdi mdi-arrow-right"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="empty-state">

            <i class="mdi mdi-shopping-outline"></i>

            <h4>Produk Belum Tersedia</h4>
            <p>Belum ada produk yang ditambahkan 😢</p>

        </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="pagination-wrapper">
        {{ $produk->links() }}
    </div>

</section>

<style>
    /* ================= SECTION ================= */

.produk-section{
    padding:30px 10px 60px;
    background:#fefefe;
}

/* ================= HEADER ================= */

.produk-header{
    margin-bottom:40px;
}

.sub-title{
    display:inline-block;
    padding:8px 18px;
    background:#111;
    color:#fff;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
    margin-bottom:15px;
    letter-spacing:1px;
}

.produk-header h2{
    font-size:46px;
    font-weight:800;
    color:#111;
    line-height:1.2;
}

.produk-header p{
    max-width:600px;
    color:#777;
    font-size:14px;
    line-height:1.8;
}

/* ================= CARD ================= */

.produk-card{
    background:#fff;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
    transition:0.35s;
    position:relative;
}

.produk-card:hover{
    transform:translateY(-10px);
    box-shadow:0 25px 60px rgba(0,0,0,0.12);
}

/* ================= IMAGE ================= */

.produk-image{
    position:relative;
    overflow:hidden;
}

.produk-image img{
    width:100%;
    height:340px;
    object-fit:cover;
    transition:0.5s;
}

.produk-card:hover .produk-image img{
    transform:scale(1.08);
}

/* ================= OVERLAY ================= */

.overlay-produk{
    position:absolute;
    inset:0;
    background:linear-gradient(to top, rgba(0,0,0,0.65), transparent);
    display:flex;
    align-items:flex-end;
    justify-content:center;
    padding-bottom:25px;
    opacity:0;
    transition:0.3s;
}

.produk-card:hover .overlay-produk{
    opacity:1;
}

.overlay-produk a{
    background:#fff;
    color:#111;
    padding:10px 18px;
    border-radius:30px;
    font-weight:600;
    text-decoration:none;
    transition:0.3s;
}

.overlay-produk a:hover{
    background:#111;
    color:#fff;
}

/* ================= WISHLIST ================= */

.wishlist{
    position:absolute;
    top:15px;
    right:15px;
    width:42px;
    height:42px;
    background:#fff;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    cursor:pointer;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}

.wishlist:hover{
    background:#ff3b5c;
    color:#fff;
}

/* ================= BODY ================= */

.produk-body{
    padding:18px;
}

.kategori{
    font-size:12px;
    color:#888;
    font-weight:500;
}

.produk-title{
    font-size:20px;
    font-weight:700;
    margin:8px 0 10px;
    color:#111;
}

.produk-deskripsi{
    font-size:13px;
    color:#777;
    line-height:1.7;
}

/* ================= FOOTER ================= */

.produk-footer{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:15px;
}

.price-label{
    font-size:11px;
    color:#999;
}

.produk-footer h5{
    margin:3px 0 0;
    font-size:18px;
    font-weight:800;
    color:#111;
}

/* ================= BUTTON ================= */

.btn-detail{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#111;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    text-decoration:none;
    font-size:18px;
    transition:0.3s;
}

.btn-detail:hover{
    transform:rotate(-45deg);
    background:#333;
}

/* ================= EMPTY STATE ================= */

.empty-state{
    width:100%;
    text-align:center;
    padding:80px 20px;
}

.empty-state i{
    font-size:70px;
    color:#ccc;
}

.empty-state h4{
    margin-top:15px;
    font-size:24px;
    font-weight:700;
}

.empty-state p{
    color:#888;
}

/* ================= PAGINATION ================= */

.pagination-wrapper{
    margin-top:50px;
    display:flex;
    justify-content:center;
}

/* bootstrap pagination override */
.page-link{
    border:none !important;
    margin:0 5px;
    border-radius:10px !important;
    width:40px;
    height:40px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#111;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.page-item.active .page-link{
    background:#111 !important;
    color:#fff !important;
}

/* ================= RESPONSIVE ================= */

@media (max-width:768px){

    .produk-header h2{
        font-size:34px;
    }

    .produk-image img{
        height:260px;
    }

}
</style>
@endsection