<section class="style-section">

    <div class="container">

        <div class="section-header text-center">
            <span class="section-badge">
                Explore Style
            </span>
            <h2>
                Temukan Style Favoritmu
            </h2>
            <p>
                Pilih gaya fashion pilihan terbaik yang sesuai dengan personality dan aktivitas harianmu langsung dari katalog kami.
            </p>
        </div>

        <div class="row g-4 mt-2">

            @forelse($kategori as $cat)
                <div class="col-lg-3 col-md-6">
                    
                        <a href="javascript:void(0)" onclick="pemicuKategoriLoginAlert()" class="text-decoration-none text-white d-block">

                        <div class="style-card">

                            @if($cat->gambar)
                                <img src="{{ asset('storage/' . $cat->gambar) }}" alt="{{ $cat->nama }}" loading="lazy">
                            @else
                                <img src="https://picsum.photos/500/600?random={{ $cat->id }}" alt="{{ $cat->nama }}" loading="lazy">
                            @endif

                            <div class="style-overlay"></div>

                            <div class="style-content">
                                <span>{{ Str::limit($cat->deskripsi, 25, '...') }}</span>
                                <h5>{{ $cat->nama }}</h5>
                            </div>

                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada gaya busana/kategori aktif yang terdaftar di database.</p>
                </div>
            @endforelse

        </div>

    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function pemicuKategoriLoginAlert() {
        Swal.fire({
            title: 'Gaya Busana Terkunci! 🔒',
            text: 'Silakan login terlebih dahulu untuk menjelajahi koleksi outfit lengkap berdasarkan style pilihanmu.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8C6A2F', // Warna tema utama Spill Outfit
            cancelButtonColor: '#777777',
            confirmButtonText: '<i class="mdi mdi-login me-1"></i> Login Sekarang',
            cancelButtonText: 'Nanti Saja',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-5 border shadow-sm'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Alihkan guest ke halaman login aplikasi kamu
                window.location.href = "{{ route('login') }}";
            }
        });
    }
</script>

<style>
/* ================= STYLE SECTION ARCHITECTURE ================= */
.style-section {
    padding: 90px 0;
    background: #fff;
}

/* HEADER STYLE MODULE */
.section-header {
    max-width: 700px;
    margin: auto;
    margin-bottom: 50px;
}
.section-badge {
    display: inline-block;
    background: #f8f4e7;
    color: #8C6A2F;
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 20px;
    letter-spacing: 0.5px;
}
.section-header h2 {
    font-size: 42px;
    font-weight: 800;
    color: #1a1a1a;
    letter-spacing: -0.5px;
}
.section-header p {
    margin-top: 15px;
    color: #666;
    line-height: 1.9;
    font-size: 14.5px;
}

/* CARDS ARCHITECTURE COMPONENT */
.style-card {
    position: relative;
    height: 320px;
    border-radius: 32px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.03);
}
.style-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(140, 106, 47, 0.12);
}
.style-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
}
.style-card:hover img {
    transform: scale(1.06);
}

/* GRADIENT MATTE OVERLAY SCREEN */
.style-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0, 0, 0, 0.8) 0%,
        rgba(0, 0, 0, 0.4) 40%,
        transparent 100%
    );
    z-index: 1;
}

/* TYPOGRAPHY ELEMENTS */
.style-content {
    position: absolute;
    left: 25px;
    bottom: 25px;
    color: #ffffff;
    z-index: 2;
    pointer-events: none;
}
.style-content span {
    font-size: 12px;
    opacity: 0.85;
    font-weight: 500;
    letter-spacing: 0.3px;
    display: block;
}
.style-content h5 {
    margin-top: 6px;
    margin-bottom: 0;
    font-size: 24px;
    font-weight: 700;
    line-height: 1.2;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* POP-UP MODAL BORDER RADIUS TUNING */
.rounded-5 {
    border-radius: 28px !important;
}

/* RESPONSIVE LAYOUT MATRIX CONTROLS */
@media(max-width: 991px) {
    .style-card { height: 280px; }
}
@media(max-width: 768px) {
    .style-section { padding: 70px 0; }
    .section-header h2 { font-size: 32px; }
    .style-card { height: 260px; }
    .style-content h5 { font-size: 20px; }
}
</style>