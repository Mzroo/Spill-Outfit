@extends('layouts.app')

@section('title', 'Koleksi Produk Pilihan')

@section('content')

@include('guest.partials.navbar')

<section class="all-product-section">
    <div class="container">

        <div class="section-header">
            <span class="section-badge">
                ✨ Fashion Collection
            </span>
            <h2>
                Semua <span>Outfit</span>
            </h2>
            <p>
                Jelajahi berbagai outfit terbaik pilihan untuk kuliah, nongkrong, kerja, hingga daily style favoritmu langsung dari katalog kami.
            </p>
        </div>

        <div class="product-filter">
            <a href="{{ route('guest.produk.index') }}" 
               data-kategori="all"
               class="filter-btn {{ !request('kategori') ? 'active' : '' }}">
                Semua Produk
            </a>

            @foreach($kategori as $cat)
                <a href="{{ route('guest.produk.index', ['kategori' => $cat->id]) }}" 
                   data-kategori="{{ $cat->id }}"
                   class="filter-btn {{ request('kategori') == $cat->id ? 'active' : '' }}">
                    {{ $cat->nama }}
                </a>
            @endforeach
        </div>

        <div id="ajax-product-container" class="smooth-fade">
            
            @if(request('search'))
                <div class="search-result-alert text-center mb-4" style="margin-bottom: 40px;">
                    <p class="text-muted" style="font-size: 14px;">
                        Menampilkan hasil pencarian untuk kata kunci: <strong style="color: #8C6A2F;">"{{ request('search') }}"</strong>
                        <a href="{{ route('guest.produk.index', request()->except('search')) }}" class="ms-2 text-danger text-decoration-none small" style="margin-left: 10px; color: #e74c3c; text-decoration: none;">
                            <i class="mdi mdi-close-circle"></i> Hapus Pencarian
                        </a>
                    </p>
                </div>
            @endif

            <div class="product-pure-grid">
                @forelse($produk as $item)
                    @php
                        $totalStok = $item->varian->sum('stok') ?? 0;
                    @endphp

                    <div class="produk-card">
                        <div class="produk-image">
                            @if($totalStok <= 0)
                                <div class="out-of-stock-badge">Stok Habis</div>
                            @endif

                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" loading="lazy">
                            @else
                                <img src="https://via.placeholder.com/500x700?text=No+Image" alt="No Image">
                            @endif

                            <div class="overlay-produk">
                                    <a href="javascript:void(0)" onclick="pemicuKatalogLoginAlert()">View Detail</a>
                            </div>

                            <div class="wishlist-btn">
                                <i class="mdi mdi-heart-outline"></i>
                            </div>
                        </div>

                        <div class="produk-body">
                            <small class="kategori">{{ $item->kategori ? $item->kategori->nama : 'Casual Style' }}</small>
                            <h4 class="produk-title">{{ $item->nama }}</h4>
                            <p class="produk-deskripsi">{{ Str::limit($item->deskripsi, 65, '...') }}</p>

                            <div class="produk-footer" style="align-items: center;">
                                <div class="trending-info-lokal" style="margin-left: 0; margin-right: auto;">
                                    <span><i class="mdi mdi-heart-outline"></i> {{ rand(1, 5) }},{{ rand(1,9) }}k</span>
                                    <span><i class="mdi mdi-eye-outline"></i> {{ rand(5, 12) }},{{ rand(1,9) }}k</span>
                                </div>
                                    <a href="javascript:void(0)" onclick="pemicuKatalogLoginAlert()" class="btn-detail-arrow"><i class="mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-catalog-state">
                        <div class="empty-icon-box"><i class="mdi mdi-shopping-outline"></i></div>
                        <h4>Produk Tidak Ditemukan</h4>
                        <p>Maaf, belum ada item pakaian untuk kategori atau kata kunci pencarian ini 😢</p>
                    </div>
                @endforelse
            </div>

            <div class="pagination-container-center">
                @if ($produk->hasPages())
                    <ul class="pagination">
                        @if ($produk->onFirstPage())
                            <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-left"></i></span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $produk->previousPageUrl() }}" rel="prev"><i class="mdi mdi-chevron-left"></i></a></li>
                        @endif

                        @foreach ($produk->render()->elements[0] as $page => $url)
                            @if ($page == $produk->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($produk->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $produk->nextPageUrl() }}" rel="next"><i class="mdi mdi-chevron-right"></i></a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-right"></i></span></li>
                        @endif
                    </ul>
                @endif
            </div>

        </div> </div>
</section>

@include('guest.partials.footer')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.getElementById('ajax-product-container');
        
        // Intersepsi semua klik tombol filter dan link pagination agar tidak reload kasar
        document.body.addEventListener('click', function(e) {
            const targetLink = e.target.closest('.filter-btn, .pagination a');
            
            if (targetLink) {
                e.preventDefault(); // Kunci jalur reload bawaan browser
                
                const url = targetLink.getAttribute('href');
                if(!url || url === 'javascript:void(0)') return;

                // 1. Jalankan animasi pudar (fade-out)
                container.classList.add('fade-hidden');

                // Jika yang diklik tombol filter, ubah status visual active-nya secara instan
                if(targetLink.classList.contains('filter-btn')) {
                    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                    targetLink.classList.add('active');
                }

                // 2. Tembak data via AJAX Fetch
                fetch(url, {
                    headers: { "X-Requested-With": "XMLHttpRequest" }
                })
                .then(response => response.text())
                .then(html => {
                    // Buat parser virtual untuk memotong HTML hasil fetch
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('ajax-product-container').innerHTML;
                    
                    // 3. Masukkan data baru dan kembalikan efek transisi pudar (fade-in)
                    setTimeout(() => {
                        container.innerHTML = newContent;
                        container.classList.remove('fade-hidden');
                        
                        // Push URL ke address bar browser agar filter tersinkronisasi jika di-refresh
                        window.history.pushState({ path: url }, '', url);
                        
                        // Otomatis scroll halus ke atas grid produk agar user tahu halaman berganti
                        document.querySelector('.product-filter').scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 250); // Delay halus milidetik untuk transisi mata
                })
                .catch(error => {
                    console.error("Gagal memuat katalog AJAX:", error);
                    container.classList.remove('fade-hidden');
                });
            }
        });

        // Menjaga fungsionalitas tombol Back/Forward browser tetap aman
        window.addEventListener('popstate', function() {
            window.location.reload();
        });
    });

    function pemicuKatalogLoginAlert() {
        Swal.fire({
            title: 'Akses Terbatas! ✨',
            text: 'Kamu harus login terlebih dahulu untuk melihat spesifikasi detail outfit premium ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8C6A2F',
            cancelButtonColor: '#777777',
            confirmButtonText: '<i class="mdi mdi-login me-1"></i> Login Sekarang',
            cancelButtonText: 'Nanti Saja',
            background: '#ffffff',
            customClass: { popup: 'rounded-5 border shadow-sm' }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    }
</script>

<style>
/* ======================== EFFEK SMOOTH TRANSITION GRAPHICS ENGINE ======================== */
.smooth-fade {
    opacity: 1;
    transform: translateY(0);
    transition: opacity 0.3s cubic-bezier(0.25, 1, 0.5, 1), transform 0.3s cubic-bezier(0.25, 1, 0.5, 1);
}
.smooth-fade.fade-hidden {
    opacity: 0;
    transform: translateY(15px); /* Efek turun sedikit saat memudar keluar */
}

/* ======================== INTEGRASI LAYOUT KATALOG PREMIUM (PURE CSS) ======================== */
.all-product-section {
    font-family: 'Poppins', sans-serif;
    padding: 140px 0 90px;
    background: #fff;
    min-height: 100vh;
}
.all-product-section *, .all-product-section *::before, .all-product-section *::after {
    box-sizing: border-box;
}

/* CATALOG HEADER SECTION */
.section-header {
    text-align: center;
    max-width: 720px;
    margin: 0 auto 45px auto;
}
.section-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 16px;
    border-radius: 30px;
    background: #f8f4e7;
    color: #8C6A2F;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 16px;
    letter-spacing: 1.5px;
}
.section-header h2 {
    font-size: 44px;
    font-weight: 800;
    color: #1a1a1a;
    letter-spacing: -0.5px;
}
.section-header h2 span { color: #B68D40; }
.section-header p {
    margin-top: 12px;
    color: #666;
    line-height: 1.7;
    font-size: 14.5px;
}

/* RE-ENGINEERING FILTER NAVIGATION AREA UNTUK SINKRONISASI TINGGI FIX */
.product-filter {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 50px;
    min-height: 50px; /* Mengunci tinggi agar button bar tidak bergetar / lari atas bawah */
}
.filter-btn {
    border: none;
    background: #f5f5f5;
    border-radius: 50px;
    padding: 10px 22px;
    font-size: 13.5px;
    font-weight: 600;
    color: #444;
    text-decoration: none;
    transition: background 0.25s ease, color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    display: inline-block;
    white-space: nowrap;
}
.filter-btn:hover, .filter-btn.active {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.15);
}

/* GRID CONTROLLER MATRIX */
.product-pure-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

/* LAYOUT CASING CARD COMPONENT */
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

/* FRAME DAN TINGGI UKURAN FOTO IMAGES */
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

/* SPECIAL BADGES OVER IMAGES */
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

/* TRANSISI HOVER LOVE MERAH MERONA (WISHLIST CORNER) */
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
    color: #444;
    z-index: 2;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.wishlist-btn:hover {
    background: #fff0f0 !important;
    color: #e74c3c !important;
    transform: scale(1.12);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.2);
}

/* OVERLAY TEXT BOX LAYERS MOUSE INTERFACE */
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
.produk-card:hover .overlay-produk { opacity: 1; }
.overlay-produk a {
    background: #ffffff;
    color: #8C6A2F;
    padding: 10px 22px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* INFO DETAILS BLOCK */
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

/* CARD FOOTER DESIGN COMPONENT */
.produk-footer {
    display: flex;
    justify-content: space-between;
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px dashed #f6f0e5;
}
.trending-info-lokal {
    display: flex;
    gap: 12px;
    font-size: 12px;
    color: #777;
}
.trending-info-lokal span { display: flex; align-items: center; gap: 4px; }
.trending-info-lokal i { color: #B68D40; }

/* REDIRECT PANEL PANAH LINK ANIMATION */
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

/* ======================== FIXED CUSTOM PAGINATION BAR DESIGN ======================== */
.pagination-container-center {
    margin-top: 60px;
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
    border-radius: 12px !important; 
    width: 46px; 
    height: 46px;
    display: flex; 
    align-items: center; 
    justify-content: center; 
    transition: all 0.2s ease;
    text-decoration: none !important;
    box-sizing: border-box;
}
.pagination-container-center .page-item.active .page-link,
.pagination-container-center .page-item .page-link:hover {
    background: linear-gradient(135deg, #8C6A2F, #C9A227) !important; 
    color: #ffffff !important; 
    border-color: transparent !important;
}
.pagination-container-center .page-item.disabled .page-link {
    opacity: 0.4;
    cursor: not-allowed;
    background: #f5f5f5 !important;
    color: #aaa !important;
    border-color: #e3d5ba !important;
}

/* BLANK RECOVERY GRID MODULE */
.empty-catalog-state {
    grid-column: 1 / -1; text-align: center; padding: 70px 20px; background: #ffffff; border-radius: 24px; border: 1px dashed #e3d5ba;
}
.empty-icon-box {
    width: 70px; height: 70px; background: #faf7f2; color: #e3d5ba; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 16px;
}
.rounded-5 { border-radius: 28px !important; }

/* MEDIA ADAPTIVE BREAKPOINTS DESIGN SCREEN MODULE */
@media (max-width: 1200px) {
    .product-pure-grid { grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .section-header h2 { font-size: 36px; }
}
@media (max-width: 991px) {
    .product-pure-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .produk-image { height: 300px; }
}
@media (max-width: 768px) {
    .product-filter { gap: 8px; margin-bottom: 35px; }
    .section-header h2 { font-size: 32px; }
}
@media (max-width: 576px) {
    .product-pure-grid { grid-template-columns: 1fr; gap: 20px; }
    .produk-image { height: 340px; }
}
</style>
@endsection