@extends('layouts.user')

@section('title', 'Hasil Pencarian: "' . $keyword . '"')

@section('content')
<section class="search-section py-5 bg-smooth-light">
    <div class="container">

        <!-- HEADER STATUS PENCARIAN -->
        <div class="search-header-box p-4 p-md-5 rounded-5 mb-4 position-relative overflow-hidden shadow-sm">
            <div class="position-relative z-index-2">
                <span class="text-uppercase tracking-wider small fw-bold text-gold d-flex align-items-center mb-2 gap-2">
                    <i class="mdi mdi-tag-outline fs-6"></i> Search Result
                </span>
                <h1 class="fw-extrabold text-dark m-0 fs-2 tracking-tight">Menampilkan Hasil: "<span class="text-gold">{{ $keyword }}</span>"</h1>
                <p class="text-muted mt-2 mb-0 fs-6">
                    Ditemukan <strong class="text-dark bg-gold-light px-2 py-0.5 rounded-pill">{{ $produk->total() }}</strong> outfit yang cocok dengan pencarianmu.
                </p>
            </div>
            <div class="bg-pattern-overlay"></div>
        </div>

        <!-- TOMBOL TRIGGER COLLAPSE -->
        <div class="d-flex justify-content-end mb-4">
            <button class="btn btn-collapse-custom d-flex align-items-center gap-2 px-4 py-2 rounded-pill shadow-sm fw-bold border" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseInfoPanel" 
                    aria-expanded="false" 
                    aria-controls="collapseInfoPanel">
                <i class="mdi mdi-filter-variant text-gold fs-5"></i> 
                <span>Tampilkan Panduan & Tips Belanja</span>
                <i class="mdi mdi-chevron-down arrow-icon transition-base"></i>
            </button>
        </div>

        <!-- KONTEN YANG BISA DI-KOLAPS -->
        <div class="collapse mb-5" id="collapseInfoPanel">
            <div class="card card-body collapse-body-box rounded-4 p-4 border shadow-sm bg-white">
                <div class="row g-4">
                    <div class="col-md-4 border-end-md">
                        <h5 class="fw-bold text-dark d-flex align-items-center gap-2 mb-3">
                            <i class="mdi mdi-shirt-input-blur text-gold"></i> Panduan Ukuran (Size)
                        </h5>
                        <p class="text-muted small lh-lg m-0">Pastikan memeriksa detail *Size Chart* pada setiap halaman produk sebelum melakukan checkout. Cek lingkar dada dan panjang baju agar pas saat kamu pakai!</p>
                    </div>
                    <div class="col-md-4 border-end-md">
                        <h5 class="fw-bold text-dark d-flex align-items-center gap-2 mb-3">
                            <i class="mdi mdi-truck-delivery-outline text-gold"></i> Info Pengiriman
                        </h5>
                        <p class="text-muted small lh-lg m-0">Pesanan sebelum jam 15.00 WIB akan diproses di hari yang sama. Pengiriman dilakukan dari Bekasi menggunakan ekspedisi pilihanmu.</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="fw-bold text-dark d-flex align-items-center gap-2 mb-3">
                            <i class="mdi mdi-face-agent text-gold"></i> Butuh Bantuan?
                        </h5>
                        <p class="text-muted small lh-lg mb-2">Ragu dengan bahan atau kecocokan style pakaian pilihanmu?</p>
                        <a href="#" class="text-gold small fw-bold text-decoration-none d-inline-flex align-items-center gap-1">
                            Hubungi Admin Spill Outfit <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- GRID HASIL PRODUK -->
        <div class="row g-3 g-md-4">
            @forelse($produk as $item)
                @php
                    $hargaDisplay = $item->varian->min('harga') ?? $item->harga;
                    $stokTotal = $item->varian->sum('stok') ?? 0;
                @endphp
                
                <div class="col-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                    <div class="product-card-item border rounded-4 overflow-hidden bg-white w-100 d-flex flex-column justify-content-between position-relative shadow-sm transition-base">
                        
                        @if($stokTotal <= 0)
                            <span class="badge-sold-out-tag shadow-sm">Habis</span>
                        @endif

                        <div class="card-upper-flow w-100">
                            <!-- Foto Produk -->
                            <div class="product-card-image w-100 position-relative overflow-hidden bg-smooth-gray">
                                @if($item->gambar && \Storage::disk('public')->exists($item->gambar))
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-100 h-100 object-fit-cover transition-transform">
                                @else
                                    <img src="{{ asset('images/default-clothing.jpg') }}" alt="No Image" class="w-100 h-100 object-fit-cover transition-transform">
                                @endif
                                
                                <div class="product-card-overlay d-flex align-items-center justify-content-center transition-base">
                                    <a href="{{ route('produk.show', $item->id) }}" class="btn btn-light rounded-pill fw-bold px-4 py-2 btn-sm text-dark shadow transition-transform transform-scale">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>

                            <!-- Detail Deskripsi -->
                            <div class="p-3">
                                <span class="text-muted small d-block text-uppercase fw-bold tracking-wider mb-1 custom-muted-text">
                                    {{ optional($item->kategori)->nama ?? 'Outfit' }}
                                </span>
                                <a href="{{ route('produk.show', $item->id) }}" class="product-card-title fw-bold text-dark text-decoration-none d-block transition-color">
                                    {{ Str::limit($item->nama, 40) }}
                                </a>
                            </div>
                        </div>

                        <!-- Footer Info Harga -->
                        <div class="p-3 pt-0 w-100">
                            <div class="d-flex align-items-center justify-content-between pt-2 border-top-dashed">
                                <span class="product-card-price fw-extrabold text-gold">
                                    <span class="fs-7 fw-semibold">Rp</span>{{ number_format($hargaDisplay, 0, ',', '.') }}
                                </span>
                                <a href="{{ route('produk.show', $item->id) }}" class="btn-quick-view text-gold d-flex align-items-center justify-content-center rounded-circle transition-base shadow-sm">
                                    <i class="mdi mdi-arrow-right fs-5"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <!-- TAMPILAN JIKA PRODUK TIDAK KETEMU -->
                <div class="col-12 text-center py-5">
                    <div class="empty-search-box py-5 px-4 rounded-5 shadow-sm border-dashed">
                        <div class="empty-icon-circle mx-auto mb-4 d-flex align-items-center justify-content-center bg-gold-light rounded-circle">
                            <i class="mdi mdi-magnify-close text-gold" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="fw-extrabold text-dark mb-2">Outfit Tidak Ditemukan</h4>
                        <p class="text-muted small max-w-sm mx-auto mb-4 lh-lg">Kami tidak bisa menemukan pakaian dengan kata kunci "<span class="text-gold fw-semibold">{{ $keyword }}</span>". Coba periksa kembali ejaan kamu.</p>
                        <a href="{{ route('produk.index') }}" class="btn-reset-search px-4 py-2.5 rounded-pill text-decoration-none fw-bold shadow-sm transition-base d-inline-flex align-items-center gap-2">
                            <i class="mdi mdi-storefront-outline"></i> Lihat Semua Koleksi
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- LINK PAGINATION -->
        <div class="d-flex justify-content-center mt-5 pagination-luxury">
            <nav class="shadow-sm rounded-pill p-2 bg-white border">
                {{ $produk->appends(['search' => request('search')])->links() }}
            </nav>
        </div>

    </div>
</section>

<!-- ======================== LUXURY CORE DESIGN SYSTEM CSS ======================== -->
<style>
/* UTILITIES & BASE */
.search-section { font-family: 'Poppins', sans-serif; letter-spacing: -0.1px; }
.bg-smooth-light { background-color: #fcfbfa; }
.bg-smooth-gray { background-color: #f4f1ea; }
.fw-extrabold { font-weight: 800; }
.text-gold { color: #8C6A2F; }
.bg-gold-light { background-color: #faf6ed; }
.tracking-wider { letter-spacing: 1.2px; }
.tracking-tight { letter-spacing: -0.5px; }
.z-index-2 { z-index: 2; }
.max-w-sm { max-width: 420px; }
.fs-7 { font-size: 0.85rem; }

/* TRANSITION ENGINE */
.transition-base { transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1); }
.transition-transform { transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1); }
.transition-color { transition: color 0.2s ease; }

/* HEADER DESIGN */
.search-header-box { background: #faf7f2; border: 1px solid #f3ebd9; }
.bg-pattern-overlay { 
    position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.05; pointer-events: none;
    background-image: radial-gradient(#8C6A2F 1.5px, transparent 0); background-size: 20px 20px; 
}

/* COLLAPSE ELEMENT STYLES */
.btn-collapse-custom {
    background-color: white;
    color: #4a453c;
    border-color: #ebdcb9 !important;
    font-size: 14px;
    transition: all 0.3s ease;
}
.btn-collapse-custom:hover, .btn-collapse-custom[aria-expanded="true"] {
    background-color: #faf6ed;
    color: #8C6A2F;
    border-color: #8C6A2F !important;
}
/* Rotasi otomatis ikon panah saat panel dibuka */
.btn-collapse-custom[aria-expanded="true"] .arrow-icon {
    transform: rotate(180deg);
}
.collapse-body-box {
    border-color: #f0e6cf !important;
    background-color: #ffffff;
}
@media (min-width: 768px) {
    .border-end-md { border-right: 1px solid #f2ebda; }
}

/* PREMIUM INTERACTIVE CARD */
.product-card-item { border-color: #f2ebd9 !important; }
.product-card-item:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 15px 35px rgba(140, 106, 47, 0.12) !important; 
    border-color: #8C6A2F !important; 
}

/* IMAGE BOUNDS & ZOOM */
.product-card-image { height: 320px; aspect-ratio: 3/4; }
.product-card-item:hover .product-card-image img { transform: scale(1.06); }

/* OVERLAY */
.product-card-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(140, 106, 47, 0.25); opacity: 0; backdrop-filter: blur(2px); }
.product-card-item:hover .product-card-overlay { opacity: 1; }
.transform-scale { transform: scale(0.9); transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
.product-card-item:hover .transform-scale { transform: scale(1); }

/* TEXT ELEMENTS */
.custom-muted-text { font-size: 10px; color: #a39782 !important; }
.product-card-title { font-size: 14px; font-weight: 700; line-height: 1.5; color: #2d2a24 !important; height: 42px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
.product-card-item:hover .product-card-title { color: #8C6A2F !important; }
.product-card-price { font-size: 17px; letter-spacing: -0.3px; }
.border-top-dashed { border-top: 1px dashed #efe7d3; }

/* QUICK VIEW BUTTON */
.btn-quick-view { width: 38px; height: 38px; background: #faf7f2; border: 1px solid #ebdcb9; text-decoration: none; }
.product-card-item:hover .btn-quick-view { background: #8C6A2F; color: white !important; border-color: #8C6A2F; transform: rotate(45deg); }

/* FLAGS STOK */
.badge-sold-out-tag { position: absolute; top: 12px; left: 12px; background: #e74c3c; color: white; font-size: 10px; font-weight: 700; padding: 5px 12px; border-radius: 50px; z-index: 3; letter-spacing: 0.5px; }

/* EMPTY DATA MODULE */
.empty-search-box { background: #faf7f2; }
.border-dashed { border: 1px dashed #decfae !important; }
.empty-icon-circle { width: 80px; height: 80px; }
.btn-reset-search { background: #8C6A2F; color: white; font-size: 14px; }
.btn-reset-search:hover { background: #6e5223; color: white; transform: translateY(-2px); }

/* MODERN LUXURY PAGINATION OVERRIDE */
.pagination-luxury nav { display: inline-block; }
.pagination-luxury .pagination { margin: 0; display: flex; gap: 4px; border: none; }
.pagination-luxury .page-item .page-link { border: none; background: transparent; color: #615a4c; font-weight: 600; padding: 8px 16px; border-radius: 50px; transition: all 0.2s; }
.pagination-luxury .page-item.active .page-link { background-color: #8C6A2F !important; color: white !important; box-shadow: 0 4px 10px rgba(140, 106, 47, 0.2); }
.pagination-luxury .page-item .page-link:hover:not(.active) { background-color: #faf6ed; color: #8C6A2F; }

/* MEDIA ADAPTATION ENGINE */
@media (max-width: 992px) { .product-card-image { height: 280px; } }
@media (max-width: 768px) { .product-card-image { height: 240px; } }
@media (max-width: 576px) {
    .product-card-image { height: 195px; }
    .product-card-title { font-size: 13px; height: 39px; line-height: 1.4; }
    .product-card-price { font-size: 14px; }
    .btn-quick-view { width: 32px; height: 32px; }
    .search-header-box { border-radius: 24px !important; }
}
</style>
@endsection