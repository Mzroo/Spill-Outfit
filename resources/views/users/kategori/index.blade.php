@extends('layouts.user')

@section('title', 'Semua Kategori Style')

@section('content')

<section class="kategori-section py-5">
    <div class="container">
        
        <div class="kategori-header mb-5">
            <span class="category-badge mb-3">SPILL OUTFIT CATEGORY</span>
            <h2 class="fw-extrabold text-dark lh-sm mb-3">Pilih Style <br>Favoritmu ✨</h2>
            <p class="text-muted fs-6 lh-lg m-0 max-w-600">
                Temukan kategori fashion terbaik yang dirancang khusus untuk menyempurnakan gaya dan aktivitas harianmu.
            </p>
        </div>

        <div class="row g-4">
            @foreach($kategori as $item)
            <div class="col-xl-3 col-lg-4 col-md-6">
                
                <a href="{{ route('user.kategori.show', $item->id) }}" class="kategori-card d-flex flex-column h-100 justify-content-between">
                    
                    <div class="card-upper-content">
                        <div class="kategori-icon d-flex align-items-center justify-content-center mb-4">
                            <i class="mdi mdi-hanger"></i>
                        </div>

                        <div class="kategori-details">
                            <h4 class="fw-bold mb-2">{{ $item->nama }}</h4>
                            <p class="product-count-text m-0">{{ $item->produk->count() }} Produk Tersedia</p>
                        </div>
                    </div>

                    <div class="arrow-icon d-flex align-items-center justify-content-center">
                        <i class="mdi mdi-arrow-top-right"></i>
                    </div>

                </a>

            </div>
            @endforeach
        </div>

    </div>
</section>

<style>
/* ======================== LUXURY DESIGN SYSTEM HYBRID ======================== */
.kategori-section {
    font-family: 'Poppins', sans-serif;
}
.max-w-600 {
    max-width: 600px;
}
.fw-extrabold {
    font-weight: 800;
}

/* ================= PREMIUM BADGE ================= */
.category-badge {
    display: inline-block;
    padding: 6px 16px;
    background: #faf6ed;
    color: #8C6A2F;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.5px;
    border: 1px solid #f6f0e5;
}

/* ================= HYBRID LUXURY CARD ================= */
.kategori-card {
    background: #ffffff;
    border-radius: 26px;
    padding: 35px;
    position: relative;
    overflow: hidden;
    text-decoration: none;
    color: #222222;
    border: 1px solid #f6f0e5;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.02);
    min-height: 250px;
    z-index: 1;
    transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1), 
                box-shadow 0.4s cubic-bezier(0.25, 1, 0.5, 1);
}

/* BACKGROUND HOVER LAYER GRADIENT */
.kategori-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    opacity: 0;
    z-index: -1;
    transition: opacity 0.4s ease;
}

.kategori-card:hover {
    transform: translateY(-8px);
    color: #ffffff !important;
    box-shadow: 0 15px 35px rgba(140, 106, 47, 0.15);
    border-color: transparent;
}

.kategori-card:hover::before {
    opacity: 1;
}

/* CARD INNER COMPONENTS */
.kategori-icon {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    background: #faf7f2;
    border: 1px solid #e3d5ba;
    font-size: 28px;
    color: #8C6A2F;
    transition: all 0.4s ease;
}
.kategori-card:hover .kategori-icon {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    border-color: transparent;
}

.kategori-details h4 {
    font-size: 22px;
    letter-spacing: -0.3px;
    transition: color 0.4s;
}

.product-count-text {
    color: #777777;
    font-size: 13.5px;
    font-weight: 500;
    transition: color 0.4s;
}
.kategori-card:hover .product-count-text {
    color: #f0e6d2;
}

/* INTERACTIVE ARROW CONTAINER */
.arrow-icon {
    position: absolute;
    right: 30px;
    bottom: 30px;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #faf7f2;
    border: 1px solid #e3d5ba;
    color: #8C6A2F;
    font-size: 18px;
    transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
}
.kategori-card:hover .arrow-icon {
    background: #ffffff;
    color: #8C6A2F;
    border-color: transparent;
    transform: rotate(45deg);
}
</style>

@endsection