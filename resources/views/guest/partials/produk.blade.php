<section class="trending-section container">

    <div class="section-header text-center">
        <span class="section-badge">
            🔥 Trending Fashion
        </span>
        <h2>
            Outfit Pilihan Minggu Ini
        </h2>
        <p>
            Temukan outfit terbaik pilihan yang sedang populer dan cocok untuk menunjang berbagai aktivitas harianmu.
        </p>
    </div>

    <div class="filter-wrapper">
        <button class="filter-btn active" data-target="all">All</button>
        
        @foreach($kategori as $cat)
            <button class="filter-btn" data-target="{{ Str::lower(Str::slug($cat->nama)) }}">
                {{ $cat->nama }}
            </button>
        @endforeach
    </div>

    <div class="product-pure-grid">

        {{-- SINKRONISASI: Menggunakan array $produk dari HomeController versi terbaru --}}
        @forelse($produk as $item)
            @php
                $slugKategori = $item->kategori ? Str::lower(Str::slug($item->kategori->nama)) : 'uncategorized';
            @endphp

            <div class="produk-card item-tren-card" data-category="{{ $slugKategori }}">

                <div class="produk-image">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" loading="lazy">
                    @else
                        <img src="https://via.placeholder.com/500x700?text=No+Image" alt="No Image">
                    @endif

                    <span class="trending-label-popular">
                        Popular
                    </span>

                    <div class="overlay-produk">
                            <a href="javascript:void(0)" onclick="pemicuLoginAlert()">
                                View Detail
                            </a>
                    </div>

                    <div class="wishlist-btn">
                        <i class="mdi mdi-heart-outline"></i>
                    </div>
                </div>

                <div class="produk-body">
                    
                    <small class="kategori">
                        {{ $item->kategori ? $item->kategori->nama : 'Casual Style' }}
                    </small>

                    <h4 class="produk-title">
                        {{ $item->nama }}
                    </h4>

                    <p class="produk-deskripsi">
                        {{ Str::limit($item->deskripsi, 80, '...') }}
                    </p>

                    <div class="produk-footer" style="align-items: center;">
                        
                        <div class="trending-info-lokal" style="margin-left: 0; margin-right: auto;">
                            <span>
                                <i class="mdi mdi-heart-outline"></i>
                                {{ rand(1, 5) }},{{ rand(1,9) }}k
                            </span>
                            <span>
                                <i class="mdi mdi-eye-outline"></i>
                                {{ rand(5, 12) }},{{ rand(1,9) }}k
                            </span>
                        </div>

                      
                            <a href="javascript:void(0)" onclick="pemicuLoginAlert()" class="btn-detail-arrow">
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
                <p>Belum ada produk pilihan trending yang terdaftar di dalam database katalog saat ini.</p>
            </div>
        @endforelse

        <div id="filter-empty-alert" class="empty-catalog-state d-none" style="grid-column: 1 / -1;">
            <div class="empty-icon-box">
                <i class="mdi mdi-shopping-outline"></i>
            </div>
            <h4>Outfit Tidak Ditemukan</h4>
            <p>Maaf, belum ada produk dengan gaya pakaian ini untuk minggu ini 😢</p>
        </div>

    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tombolFilter = document.querySelectorAll(".filter-btn");
        const kartuProduk = document.querySelectorAll(".item-tren-card");
        const alertKosong = document.getElementById("filter-empty-alert");

        tombolFilter.forEach(button => {
            button.addEventListener("click", function () {
                tombolFilter.forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");

                const targetKategori = this.getAttribute("data-target");
                let produkDitemukan = false;

                kartuProduk.forEach(card => {
                    const kategoriCard = card.getAttribute("data-category");

                    if (targetKategori === "all" || kategoriCard === targetKategori) {
                        card.style.display = "flex"; 
                        produkDitemukan = true;
                    } else {
                        card.style.display = "none"; 
                    }
                });

                if (!produkDitemukan) {
                    alertKosong.classList.remove("d-none");
                } else {
                    alertKosong.classList.add("d-none");
                }
            });
        });
    });

    function pemicuLoginAlert() {
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
            customClass: {
                popup: 'rounded-5 border shadow-sm'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    }
</script>

<style>
.d-none {
    display: none !important;
}

.trending-section {
    font-family: 'Poppins', sans-serif;
    margin-top: 50px;
    margin-bottom: 60px;
}
.trending-section *, .trending-section *::before, .trending-section *::after {
    box-sizing: border-box;
}

/* HEADER STYLE */
.section-header {
    max-width: 700px;
    margin: auto;
    margin-bottom: 35px;
}
.section-badge {
    display: inline-flex;
    align-items: center;
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
.section-header p {
    color: #666;
    line-height: 1.7;
    font-size: 14.5px;
    margin-top: 12px;
}

/* FILTER WRAPPER CHIPS */
.filter-wrapper {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 45px;
}
.filter-btn {
    border: none;
    background: #f5f5f5;
    padding: 10px 22px;
    border-radius: 50px;
    font-size: 13.5px;
    font-weight: 600;
    color: #444;
    cursor: pointer;
    transition: all 0.25s ease;
}
.filter-btn.active, .filter-btn:hover {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.15);
}

/* GRID LAYOUT UTAMA */
.product-pure-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

/* KOTAK CASING CARD */
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

/* FRAME DAN UKURAN TINGGI GAMBAR */
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
    object-fit: cover; /* Foto memenuhi cover grid secara gagah */
    transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
}
.produk-card:hover .produk-image img {
    transform: scale(1.06);
}

/* BADGES DAN TOMBOL DI ATAS FOTO */
.trending-label-popular {
    position: absolute;
    top: 15px;
    left: 15px;
    background: white;
    color: #8C6A2F;
    padding: 5px 14px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    z-index: 3;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

/* WISHLIST BUTTON */
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

/* HOVER OVERLAY CAPTURE LINK */
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

/* TEXT AREA PADDING BLOCK */
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

/* FOOTER MANAGEMENT CONTAINER */
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
.trending-info-lokal span {
    display: flex;
    align-items: center;
    gap: 4px;
}
.trending-info-lokal i { color: #B68D40; }

/* REDIRECT PREMIUM ARROW BUTTON LINK */
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

/* FALLBACK EMPTY PANEL STATE */
.empty-catalog-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: #ffffff;
    border-radius: 24px;
    border: 1px dashed #e3d5ba;
}
.empty-icon-box {
    width: 70px;
    height: 70px;
    background: #faf7f2;
    color: #e3d5ba;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    margin: 0 auto 16px;
}

.rounded-5 {
    border-radius: 28px !important;
}

/* DYNAMIC RESPONSIVE BREAKPOINTS DESIGN ENGINE */
@media (max-width: 1200px) {
    .product-pure-grid { grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .section-header h2 { font-size: 36px; }
}
@media (max-width: 991px) {
    .product-pure-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .produk-image { height: 300px; }
}
@media (max-width: 768px) {
    .filter-wrapper { gap: 8px; }
    .section-header h2 { font-size: 32px; }
}
@media (max-width: 576px) {
    .product-pure-grid { grid-template-columns: 1fr; gap: 20px; }
    .produk-image { height: 340px; }
}
</style>