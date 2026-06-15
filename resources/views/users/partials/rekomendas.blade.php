<section class="recommend-section container">

    <div class="section-header-custom">
        <div>
            <span class="section-badge">
                ✨ Personalized Outfit
            </span>
            <h2>
                Rekomendasi <span>Outfit</span> Untuk Kamu
            </h2>
            <p>
                Outfit pilihan terbaik yang cocok untuk kuliah, hangout, kerja, hingga daily style langsung dari katalog kami.
            </p>
        </div>
        <a href="{{ route('produk.index') }}" class="btn-view-all">
            Lihat Semua
        </a>
    </div>

    <div class="product-pure-grid">

        {{-- Lakukan perulangan data produk rekomendasi asli dari database controller --}}
        @forelse($produk_rekomendasi as $item)

            @php
                // Mengambil akumulasi total stok dari relasi varian
                $totalStok = $item->varian->sum('stok') ?? 0;
            @endphp

            <div class="produk-card">

                <div class="produk-image">

                    @if($totalStok <= 0)
                        <div class="out-of-stock-badge">Stok Habis</div>
                    @else
                        <span class="trending-label-popular">
                            Recommended
                        </span>
                    @endif

                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" loading="lazy">
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
                        {{ $item->kategori ? $item->kategori->nama : 'Campus Style' }}
                    </small>

                    <h4 class="produk-title">
                        {{ $item->nama }}
                    </h4>

                    <p class="produk-deskripsi">
                        {{ Str::limit($item->deskripsi, 65, '...') }}
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
                <h4>Rekomendasi Belum Tersedia</h4>
                <p>Maaf, belum ada produk pilihan khusus yang direkomendasikan untukmu saat ini 😢</p>
            </div>
        @endforelse

    </div>

</section>

<style>
/* ======================== INTEGRASI PENYAMAAAN UKURAN CARD & LAYOUT ======================== */
.recommend-section {
    margin-top: 80px;
    margin-bottom: 60px;
}
.recommend-section *, .recommend-section *::before, .recommend-section *::after {
    box-sizing: border-box;
}

/* HEADER STYLE */
.section-header-custom {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 45px;
}
.section-badge {
    display: inline-flex;
    padding: 6px 16px;
    border-radius: 30px;
    background: #f8f4e7;
    color: #8C6A2F;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 16px;
    letter-spacing: 1.5px;
}
.section-header-custom h2 {
    font-size: 42px;
    font-weight: 800;
    color: #1a1a1a;
    line-height: 1.2;
    margin: 0;
    letter-spacing: -0.5px;
}
.section-header-custom h2 span { color: #B68D40; }
.section-header-custom p {
    margin-top: 12px;
    color: #666;
    font-size: 14px;
    line-height: 1.7;
    max-width: 550px;
}

/* BUTTON HEADER */
.btn-view-all {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white !important;
    padding: 14px 28px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: transform .3s, box-shadow .3s;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.2);
}
.btn-view-all:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.4);
}

/* PURE CSS GRID LAYOUT BLOCK */
.product-pure-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

/* ARCHITECTURE STANDARD CARD SIZE */
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

/* IMAGE FRAME DURATION FIXED */
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

/* IMMERSIVE COMPONENT BADGES OVER IMAGE */
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

/* FIX TRANSISI HOVER LOVE MERAH MENYALA */
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

/* IMMERSIVE HOVER LAYER MOUSE EFFECT */
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

/* DETAILS CONTENTS WRAPPER */
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

/* FOOTER CONNECTIVITY PANELS */
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

/* RE-ENGINEERING ARROW REDIRECT CHIPS */
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

/* BLANK CATALOG RECOVERY DATA FALLBACK */
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

/* DYNAMIC RESPONSIVE BREAKPOINTS ENGINE */
@media (max-width: 1200px) {
    .product-pure-grid { grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .section-header-custom h2 { font-size: 36px; }
}
@media (max-width: 991px) {
    .product-pure-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .produk-image { height: 300px; }
}
@media (max-width: 768px) {
    .section-header-custom { flex-direction: column; align-items: flex-start; gap: 15px; }
    .btn-view-all { width: 100%; text-align: center; }
}
@media (max-width: 576px) {
    .product-pure-grid { grid-template-columns: 1fr; gap: 20px; }
    .section-header-custom h2 { font-size: 30px; }
    .produk-image { height: 340px; }
}
</style>