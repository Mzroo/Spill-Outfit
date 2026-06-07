@extends('layouts.user')

@section('title', 'Kategori: ' . $kategori->nama)

@section('content')
<section class="kategori-produk-section py-5">
    <div class="container">
        
        <div class="mb-4">
            <a href="{{ route('produk.index')}}" class="back-to-catalog d-inline-flex align-items-center gap-2">
                <i class="mdi mdi-arrow-left"></i> Kembali ke Semua Produk
            </a>
        </div>

        <div class="category-header-box p-4 p-md-5 rounded-5 mb-5 text-center position-relative overflow-hidden">
            <div class="position-relative z-index-2">
                <span class="text-uppercase tracking-wider small fw-bold text-gold d-block mb-2">Browsing Kategori</span>
                <h1 class="fw-extrabold text-dark m-0 fs-2">{{ $kategori->nama }}</h1>
                <p class="text-muted mt-2 mb-0 max-w-md mx-auto fs-6">
                    {{ $kategori->deskripsi ?? 'Menampilkan koleksi busana terbaik dari database untuk menunjang gaya outfit harianmu.' }}
                </p>
            </div>
            <div class="bg-pattern-overlay"></div>
        </div>

        <div class="row g-3 g-md-4">
            {{-- Loop mengambil semua data produk yang terikat dengan kategori ini dari database --}}
            @forelse($kategori->produk as $item)
                @php
                    // Ambil harga terendah dari varian produk di database, jika tidak ada pakai harga master
                    $hargaDisplay = $item->varian->min('harga') ?? $item->harga;
                    $stokTotal = $item->varian->sum('stok') ?? 0;
                @endphp
                
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card-item border rounded-4 overflow-hidden bg-white h-100 d-flex flex-column justify-content-between position-relative shadow-sm">
                        
                        @if($stokTotal <= 0)
                            <span class="badge-sold-out-tag">Habis</span>
                        @endif

                        <div>
                            <div class="product-card-image w-100 position-relative overflow-hidden bg-light">
                                @if($item->gambar && \Storage::disk('public')->exists($item->gambar))
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <img src="{{ asset('images/default-clothing.jpg') }}" alt="No Image" class="w-100 h-100 object-fit-cover">
                                @endif
                                
                                <div class="product-card-overlay d-flex align-items-center justify-content-center">
                                    <a href="{{ route('produk.show', $item->id) }}" class="btn btn-light rounded-pill fw-bold px-3 py-2 btn-sm text-dark shadow-sm">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>

                            <div class="p-3">
                                <span class="text-muted small d-block text-uppercase fw-semibold tracking-wider mb-1" style="font-size: 10px;">
                                    {{ $kategori->nama }}
                                </span>
                                <a href="{{ route('produk.show', $item->id) }}" class="product-card-title fw-bold text-dark text-decoration-none d-block mb-2">
                                    {{ Str::limit($item->nama, 40) }}
                                </a>
                            </div>
                        </div>

                        <div class="p-3 pt-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="product-card-price fw-extrabold text-gold">
                                    Rp {{ number_format($hargaDisplay, 0, ',', '.') }}
                                </span>
                                <a href="{{ route('produk.show', $item->id) }}" class="btn-quick-view text-gold d-flex align-items-center justify-content-center rounded-circle">
                                    <i class="mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-category-box py-5">
                        <i class="mdi mdi-hanger text-muted mb-3" style="font-size: 4rem;"></i>
                        <h4 class="fw-bold text-dark">Koleksi Belum Tersedia</h4>
                        <p class="text-muted small">Produk untuk kategori "{{ $kategori->nama }}" sedang dipersiapkan di database admin.</p>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</section>

<style>
.kategori-produk-section {
    font-family: 'Poppins', sans-serif;
}
.fw-extrabold { font-weight: 800; }
.text-gold { color: #8C6A2F; }
.tracking-wider { letter-spacing: 0.8px; }
.z-index-2 { z-index: 2; }

/* BACK TO CATALOG BUTTON */
.back-to-catalog {
    color: #8C6A2F;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: transform 0.2s ease;
}
.back-to-catalog:hover {
    transform: translateX(-4px);
    color: #C9A227;
}

/* TOP HERO BANNER KATEGORI */
.category-header-box {
    background: #faf7f2;
    border: 1px solid #f6f0e5;
}
.bg-pattern-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.04;
    pointer-events: none;
    background-image: radial-gradient(#8C6A2F 1px, transparent 0);
    background-size: 24px 24px;
}

/* CARD ITEM ARCHITECTURE */
.product-card-item {
    border-color: #f1ebd9 !important;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.product-card-item:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(140, 106, 47, 0.12) !important;
    border-color: #8C6A2F !important;
}

/* FIXING BOX IMAGE RATIO (Mencegah Gambar Melar) */
.product-card-image {
    height: 280px;
}

/* HOVER IMAGE OVERLAY EFFECT */
.product-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(140, 106, 47, 0.2);
    opacity: 0;
    transition: all 0.25s ease;
}
.product-card-item:hover .product-card-overlay {
    opacity: 1;
}

/* LIMIT TITLE TEXT (Mencegah Card Berantakan akibat Judul Kepanjangan) */
.product-card-title {
    font-size: 14px;
    line-height: 1.4;
    height: 38px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.product-card-title:hover {
    color: #8C6A2F !important;
}
.product-card-price {
    font-size: 16px;
}

/* BADGE STOK HABIS */
.badge-sold-out-tag {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #e74c3c;
    color: white;
    font-size: 10px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 6px;
    z-index: 3;
    box-shadow: 0 4px 8px rgba(231, 76, 60, 0.2);
}

/* INTERACTIVE BUTTON VIEW DETAIL */
.btn-quick-view {
    width: 34px;
    height: 34px;
    background: #faf7f2;
    text-decoration: none;
    border: 1px solid #e3d5ba;
    transition: all 0.2s ease;
}
.product-card-item:hover .btn-quick-view {
    background: #8C6A2F;
    color: white !important;
    border-color: #8C6A2F;
}

/* BREAKPOINT RESPONSIVE DEVICE */
@media (max-width: 768px) {
    .product-card-image { height: 220px; }
    .category-header-box { border-radius: 20px !important; }
}
@media (max-width: 576px) {
    .product-card-image { height: 185px; }
    .product-card-title { font-size: 13px; height: 36px; }
    .product-card-price { font-size: 14px; }
}
</style>
@endsection