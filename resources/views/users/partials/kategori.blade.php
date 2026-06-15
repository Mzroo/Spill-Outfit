<section class="style-section container">

    <div class="section-header-style">
        <div>
            <span class="section-badge-style">
                ✨ Explore Style
            </span>
            <h2>
                Pilih <span>Style Favoritmu</span>
            </h2>
            <p>
                Temukan inspirasi outfit berdasarkan gaya fashion yang paling cocok dengan aktivitasmu.
            </p>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

        {{-- Lakukan looping dari data $kategori yang dikirim oleh Controller --}}
        @forelse($kategori as $item)
        <div class="col">
            {{-- Mengarahkan link ke halaman produk berdasarkan filter kategori id --}}
            <a href="{{ route('produk.index', ['kategori_id' => $item->id]) }}" class="style-card-link">
                <div class="style-card">
                    
                    {{-- Cek apakah kategori ada gambar fisik, jika tidak tampilkan placeholder default --}}
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" loading="lazy">
                    @else
                        <img src="https://via.placeholder.com/400x380" alt="No Image">
                    @endif

                    <div class="style-overlay"></div>

                    <div class="style-content">
                        <span>Fashion Style</span>
                        <h4>{{ $item->nama }}</h4>

                        <div class="style-btn">
                            Explore
                        </div>
                    </div>

                </div>
            </a>
        </div>
        @empty
        <div class="col-12 text-center py-4">
            <p class="text-muted">Belum ada data kategori yang aktif di database.</p>
        </div>
        @endforelse

    </div>

</section>

<style>
/* ================= STYLE SECTION ================= */
.style-section {
    margin-top: 70px;
    margin-bottom: 50px;
}

/* HEADER */
.section-header-style {
    margin-bottom: 35px;
}

.section-badge-style {
    display: inline-flex;
    padding: 10px 18px;
    border-radius: 50px;
    background: #f8f4e7;
    color: #8C6A2F;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 18px;
}

.section-header-style h2 {
    font-size: 42px;
    font-weight: 700;
    color: #222;
}

.section-header-style h2 span {
    color: #B68D40;
}

.section-header-style p {
    margin-top: 12px;
    color: #777;
    line-height: 1.8;
    max-width: 550px;
}

/* CARD LAYOUT & ANIMATION */
.style-card-link {
    text-decoration: none !important;
    display: block;
}

.style-card {
    position: relative;
    height: 380px; /* Default untuk laptop / desktop */
    border-radius: 35px;
    overflow: hidden;
    cursor: pointer;
    transition: transform .35s, box-shadow .35s;
    background: #e5dfcf; /* Background fallback saat image loading */
}

.style-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 45px rgba(140, 106, 47, 0.15);
}

.style-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .4s ease;
}

.style-card:hover img {
    transform: scale(1.08);
}

/* OVERLAY GRADIASI GELAP */
.style-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0, 0, 0, 0.85) 0%,
        rgba(0, 0, 0, 0.3) 50%,
        rgba(0, 0, 0, 0.05) 100%
    );
    z-index: 1;
}

/* CONTENT TEXT */
.style-content {
    position: absolute;
    left: 25px;
    bottom: 25px;
    color: white;
    z-index: 2;
    right: 25px; /* Menjaga teks panjang tidak off-screen */
}

.style-content span {
    font-size: 12px;
    opacity: .85;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
}

.style-content h4 {
    font-weight: 700;
    font-size: 22px;
    margin: 6px 0 16px;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
}

/* PREMIUM GRADIENT BUTTON */
.style-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white !important;
    padding: 10px 24px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    transition: transform .3s, box-shadow .3s;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.3);
}

.style-card:hover .style-btn {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.5);
}

/* ================= PERFECT RESPONSIVE BREAKPOINTS ================= */
@media(max-width: 1200px) {
    .style-card {
        height: 340px; /* Menyesuaikan layar monitor sedang */
    }
}

@media(max-width: 992px) {
    .section-header-style h2 {
        font-size: 36px;
    }
    .style-card {
        height: 320px; /* Menyesuaikan layar tablet */
    }
    .style-content h4 {
        font-size: 20px;
    }
}

@media(max-width: 768px) {
    .section-header-style h2 {
        font-size: 30px;
    }
    .style-card {
        height: 300px; /* Menyesuaikan layar handphone landscape */
        border-radius: 25px; /* Radius sedikit mengecil di mobile agar proporsional */
    }
}

@media(max-width: 480px) {
    .section-header-style {
        text-align: center; /* Center teks di HP agar rapi */
    }
    .section-header-style p {
        margin: 12px auto 0;
    }
    .style-card {
        height: 280px; /* Tinggi optimal di layar HP potrait */
    }
}
</style>