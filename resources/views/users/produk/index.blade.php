@extends('layouts.user')

@section('title', 'Koleksi Produk')

@section('content')

@php
use Illuminate\Support\Str;
@endphp

<div class="produk-section">

    <div class="produk-header">
        <div class="header-inner">
            <span class="sub-title">SPILL OUTFIT COLLECTION</span>
            <h2>Temukan Outfit <br>Favoritmu ✨</h2>
            <p>Koleksi fashion aesthetic modern pilihan dengan sentuhan premium earth-tone untuk menunjang penampilan harianmu agar tampil lebih percaya diri.</p>
        </div>
    </div>

    <div class="product-pure-grid">

        @forelse($produk as $item)

            @php
                // Ambil rekap total stok & harga termurah dari relasi varian
                $totalStok = $item->varian->sum('stok') ?? 0;
                $hargaMin = $item->varian->min('harga') ?? $item->harga;
            @endphp

            <div class="produk-card">

                <div class="produk-image">

                    @if($totalStok <= 0)
                        <div class="out-of-stock-badge">Stok Habis</div>
                    @endif

                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                    @else
                        <img src="https://via.placeholder.com/500x700?text=No+Image" alt="No Image">
                    @endif

                    <div class="overlay-produk">
                        <a href="{{ route('produk.show', $item->id) }}">
                            View Detail
                        </a>
                    </div>

                    <div class="wishlist-btn">
                        <i class="mdi mdi-heart-outline"></i>
                    </div>

                </div>

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

                    <div class="produk-footer">

                        <div class="price-info-side">
                            <span class="price-label">Harga Mulai</span>
                            <h5 class="price-value">
                                Rp {{ number_format($hargaMin, 0, ',', '.') }}
                            </h5>
                            
                            @if($totalStok > 0)
                                <small class="stock-text text-available">Stok: {{ $totalStok }} pcs</small>
                            @else
                                <small class="stock-text text-empty">Sold Out</small>
                            @endif
                        </div>

                        <a href="{{ route('produk.show', $item->id) }}" class="btn-detail-arrow">
                            <i class="mdi mdi-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="empty-catalog-state">
                <div class="empty-icon-box">
                    <i class="mdi mdi-shopping-outline"></i>
                </div>
                <h4>Koleksi Belum Tersedia</h4>
                <p>Maaf, belum ada produk pilihan yang ditambahkan ke dalam katalog ini 😢</p>
            </div>

        @endforelse

    </div>

    <div class="pagination-container-center">
        @if ($produk->hasPages())
            <ul class="pagination">
                {{-- Tombol Halaman Sebelumnya (Prev) --}}
                @if ($produk->onFirstPage())
                    <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-left"></i></span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $produk->previousPageUrl() }}" rel="prev"><i class="mdi mdi-chevron-left"></i></a></li>
                @endif

                {{-- Loop Angka Numerik Halaman --}}
                @foreach ($produk->render()->elements[0] as $page => $url)
                    @if ($page == $produk->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Tombol Halaman Selanjutnya (Next) --}}
                @if ($produk->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $produk->nextPageUrl() }}" rel="next"><i class="mdi mdi-chevron-right"></i></a></li>
                @else
                    <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-right"></i></span></li>
                @endif
            </ul>
        @endif
    </div>

</div>

<style>
/* ======================== DESIGN SYSTEM KATALOG PRODUK (PURE CSS) ======================== */
.produk-section {
    font-family: 'Poppins', sans-serif;
    max-width: 1300px;
    margin: 0 auto;
    padding: 40px 20px 80px;
    box-sizing: border-box;
}
.produk-section *, .produk-section *::before, .produk-section *::after {
    box-sizing: border-box;
}

/* ================= CATALOG HEADER ================= */
.produk-header {
    margin-bottom: 45px;
}
.sub-title {
    display: inline-block;
    padding: 6px 16px;
    background: #8C6A2F;
    color: #ffffff;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 16px;
    letter-spacing: 1.5px;
    box-shadow: 0 4px 10px rgba(140, 106, 47, 0.15);
}
.produk-header h2 {
    font-size: 42px;
    font-weight: 800;
    color: #1a1a1a;
    line-height: 1.2;
    margin: 0 0 12px 0;
    letter-spacing: -0.5px;
}
.produk-header p {
    max-width: 580px;
    color: #666666;
    font-size: 14px;
    line-height: 1.7;
    margin: 0;
}

/* ================= PURE CSS GRID CONTROLLER ================= */
.product-pure-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

/* ================= PRODUCT LAYOUT CARD ================= */
.produk-card {
    background: #ffffff;
    border-radius: 24px;
    overflow: hidden;
    border: 1px solid #f6f0e5;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.02);
    transition: transform 0.35s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.35s cubic-bezier(0.25, 1, 0.5, 1);
    display: flex;
    flex-direction: column;
}
.produk-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(140, 106, 47, 0.08);
}

/* IMAGE GRAPHICS */
.produk-image {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 350px;
    background: #fafaf8;
}
.produk-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
}
.produk-card:hover .produk-image img {
    transform: scale(1.06);
}

/* SPECIAL BADGES & BUTTONS OVER IMAGE */
.out-of-stock-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #e74c3c;
    color: white;
    font-size: 11px;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 8px;
    z-index: 3;
    box-shadow: 0 4px 10px rgba(231, 76, 60, 0.2);
}
.wishlist-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 40px;
    height: 40px;
    background: #ffffff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: all 0.2s ease;
    color: #444;
    z-index: 2;
}
.wishlist-btn:hover {
    background: #fff0f0;
    color: #e74c3c;
}

/* FLUID MOUSE HOVER OVERLAY */
.overlay-produk {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(140, 106, 47, 0.4), transparent);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 30px;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}
.produk-card:hover .overlay-produk {
    opacity: 1;
}
.overlay-produk a {
    background: #ffffff;
    color: #8C6A2F;
    padding: 10px 22px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
}
.overlay-produk a:hover {
    background: #8C6A2F;
    color: #ffffff;
}

/* ================= INFO DETAILS BODY ================= */
.produk-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
.kategori {
    font-size: 11px;
    color: #8C6A2F;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.produk-title {
    font-size: 18px;
    font-weight: 700;
    margin: 6px 0 8px 0;
    color: #1a1a1a;
    line-height: 1.4;
}
.produk-deskripsi {
    font-size: 12.5px;
    color: #777777;
    line-height: 1.6;
    margin: 0 0 16px 0;
}

/* CARD INNER BOTTOM MATRIX */
.produk-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px dashed #f6f0e5;
}
.price-info-side {
    display: flex;
    flex-direction: column;
}
.price-label {
    font-size: 11px;
    color: #aaa;
}
.price-value {
    margin: 2px 0 4px 0;
    font-size: 17px;
    font-weight: 800;
    color: #8C6A2F;
}
.stock-text {
    font-size: 11px;
    font-weight: 600;
}
.text-available { color: #2ecc71; }
.text-empty { color: #e74c3c; }

/* ACTION REDIRECT BUTTON LINK */
.btn-detail-arrow {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #faf7f2;
    border: 1px solid #e3d5ba;
    color: #8C6A2F;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    font-size: 16px;
    transition: all 0.3s ease;
}
.btn-detail-arrow:hover {
    transform: rotate(-45deg);
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: #ffffff;
    border-color: transparent;
}

/* ================= EMPTY GLOBAL FALLBACK STATE ================= */
.empty-catalog-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    background: #ffffff;
    border-radius: 24px;
    border: 1px dashed #e3d5ba;
}
.empty-icon-box {
    width: 80px;
    height: 80px;
    background: #faf7f2;
    color: #e3d5ba;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    margin: 0 auto 20px;
}
.empty-catalog-state h4 {
    font-size: 20px;
    font-weight: 700;
    color: #222222;
    margin: 0 0 8px 0;
}
.empty-catalog-state p {
    color: #777777;
    font-size: 14px;
    margin: 0;
}

/* ================= RE-TUNING USER PAGINATION DESIGN SYSTEM ================= */
.pagination-container-center {
    margin-top: 50px;
    display: flex;
    justify-content: center;
}
.pagination-container-center .pagination {
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
}
.pagination-container-center .page-item .page-link {
    border: 1px solid #e3d5ba !important;
    background: #ffffff !important;
    color: #8C6A2F !important;
    font-weight: 600;
    margin: 0;
    border-radius: 12px !important;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.02);
    transition: all 0.2s ease;
    text-decoration: none !important; /* Reset garis bawah text link */
    box-sizing: border-box;
}
.pagination-container-center .page-item.active .page-link,
.pagination-container-center .page-item .page-link:hover {
    background: linear-gradient(135deg, #8C6A2F, #C9A227) !important;
    color: #ffffff !important;
    border-color: transparent !important;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.2);
}
.pagination-container-center .page-item.disabled .page-link {
    opacity: 0.4;
    cursor: not-allowed;
    background: #f5f5f5 !important;
    color: #aaa !important;
    border-color: #e3d5ba !important;
}

/* ================= MEDIA RESPONSIVE GRAPHICS BREAKPOINTS ================= */
@media (max-width: 1200px) {
    .product-pure-grid { grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .produk-header h2 { font-size: 36px; }
}
@media (max-width: 991px) {
    .product-pure-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .produk-image { height: 300px; }
}
@media (max-width: 576px) {
    .product-pure-grid { grid-template-columns: 1fr; gap: 20px; }
    .produk-header h2 { font-size: 30px; }
    .produk-image { height: 340px; }
}
</style>

@endsection