@extends('layouts.admin') {{-- Disesuaikan ke layouts.admin agar navbar admin serasi --}}

@section('title', 'Galeri Produk - ' . $produk->nama)

@section('content')

<div class="container-fluid py-4">

    <div class="page-header-nav mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.produk.index') }}">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri Gambar</li>
                </ol>
            </nav>
            <h1 class="page-title">Galeri Media Produk</h1>
            <p class="page-subtitle">Kelola visual utama dan album foto pendukung untuk katalog website.</p>
        </div>
        
        <a href="{{ route('admin.produk.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="custom-card mb-4">
                <div class="card-header-clean">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark">Album Foto Tambahan</h5>
                        <p class="text-muted small mb-0">Unggah aset gambar pendukung untuk memperjelas detail produk dari berbagai sudut.</p>
                    </div>
                </div>

                <div class="card-body-clean mt-4">
                    
                    <form action="{{ route('admin.produk.gambar.store', $produk->id) }}"
                          method="POST"
                          enctype="multipart/form-data"
                          id="uploadGalleryForm">
                        @csrf

                        <div class="modern-dropzone" onclick="document.getElementById('gallery-input').click()">
                            <input type="file"
                                   name="gambar[]"
                                   id="gallery-input"
                                   multiple
                                   required
                                   accept="image/*"
                                   onchange="updatedropzoneText(this)">
                            
                            <div class="dropzone-wrapper">
                                <div class="dropzone-icon-box">
                                    <i class="fa-solid fa-images"></i>
                                </div>
                                <h6 class="fw-bold text-dark mt-3 mb-1" id="dropzone-title">
                                    Tarik berkas ke sini atau klik untuk memilih
                                </h6>
                                <p class="text-muted small mb-0">
                                    Mendukung format JPG, JPEG, PNG, atau WEBP (Maksimal 2MB per gambar)
                                </p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn-action-primary">
                                <i class="fa-solid fa-cloud-arrow-up me-2"></i>
                                Mulai Upload Gambar
                            </button>
                        </div>
                    </form>

                    <div class="section-divider my-4">
                        <span>Koleksi Foto Terunggah</span>
                    </div>

                    <div class="row g-3">
                        @forelse($produk->gambarTambahan as $gambar)
                        <div class="col-md-4 col-sm-6">
                            <div class="modern-gallery-card">
                                <img src="{{ asset('storage/' . $gambar->gambar) }}" class="gallery-img" alt="Detail {{ $produk->nama }}">
                                
                                <div class="gallery-glass-overlay">
                                    <form action="{{ route('admin.gambar.destroy', $gambar->id) }}" method="POST" class="delete-gallery-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-delete-trigger" title="Hapus Foto">
                                            <i class="fa-solid fa-trash-can"></i> Hapus Foto
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="empty-media-state py-5">
                                <div class="empty-icon-box">
                                    <i class="fa-solid fa-photo-film"></i>
                                </div>
                                <h4>Belum Ada Gambar Tambahan</h4>
                                <p class="text-muted">Album pendukung untuk produk ini masih kosong. Gunakan kotak di atas untuk menambahkan gambar baru.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="custom-card sticky-sidebar">
                <div class="card-header-clean mb-3">
                    <h5 class="fw-bold mb-0 text-dark">Gambar Utama</h5>
                </div>

                <div class="main-image-preview-box mb-4">
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="main-preview-img" alt="{{ $produk->nama }}">
                        <span class="floating-badge-main">Foto Utama</span>
                    @else
                        <div class="empty-main-preview">
                            <i class="fa-solid fa-shirt"></i>
                            <p class="small text-muted mt-2 mb-0">Belum ada foto utama</p>
                        </div>
                    @endif
                </div>

                <div class="product-summary-panel">
                    <span class="product-badge-category mb-2 d-inline-block">
                        {{ $produk->kategori->nama ?? 'Tanpa Kategori' }}
                    </span>
                    
                    <h4 class="product-summary-title mb-1">{{ $produk->nama }}</h4>
                    <p class="product-summary-code text-muted mb-3">
                        <i class="fa-solid fa-barcode me-1"></i> {{ $produk->kode }}
                    </p>
                    
                    <div class="product-summary-price-tag">
                        <span class="price-label">Harga Acuan Dasar</span>
                        <h3 class="price-value mb-0">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* ================= GLOBAL ARCHITECTURE ================= */
.container-fluid {
    font-family: 'Poppins', sans-serif;
}

.breadcrumb-item, .breadcrumb-item a {
    font-size: 13px;
    color: #8C6A2F;
    text-decoration: none;
}
.breadcrumb-item.active {
    color: #666;
}

.page-header-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.page-title {
    font-size: 26px;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 4px 0;
    letter-spacing: -0.5px;
}

.page-subtitle {
    margin: 0;
    color: #777;
    font-size: 13.5px;
}

/* ================= BACK BUTTON ================= */
.btn-back {
    background: #faf6ed;
    color: #8C6A2F;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    font-size: 13.5px;
    transition: all 0.2s ease;
    border: 1px solid #f4ebd6;
}

.btn-back:hover {
    background: #8C6A2F;
    color: white;
    transform: translateX(-3px);
}

/* ================= MODERN CONTAINER CARD ================= */
.custom-card {
    background: white;
    border-radius: 24px;
    padding: 24px;
    border: 1px solid #f5efe2;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.02);
}

.sticky-sidebar {
    position: sticky;
    top: 24px;
    z-index: 10;
}

.card-header-clean {
    border-bottom: 1px solid #fdfaf4;
    padding-bottom: 5px;
}

/* ================= MODERN DROPZONE INTERACTIVE ================= */
.modern-dropzone {
    border: 2px dashed #ebdcb9;
    border-radius: 20px;
    padding: 40px 20px;
    text-align: center;
    background: #faf8f5;
    cursor: pointer;
    transition: all 0.25s ease;
    position: relative;
    overflow: hidden;
}

.modern-dropzone:hover {
    background: #fdfaf4;
    border-color: #8C6A2F;
}

.modern-dropzone input[type="file"] {
    display: none;
}

.dropzone-icon-box {
    width: 64px;
    height: 64px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 26px;
    color: #8C6A2F;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.06);
}

/* ================= MODERN CHIPS & ACTION BUTTONS ================= */
.btn-action-primary {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 14px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.15);
}

.btn-action-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.25);
}

.section-divider {
    display: flex;
    align-items: center;
    text-align: center;
    color: #aaa;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.section-divider::before, .section-divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #f5efe2;
}

.section-divider:not(:empty)::before { margin-right: .75em; }
.section-divider:not(:empty)::after { margin-left: .75em; }

/* ================= IMAGE TILES WITH GLASSMORPHISM OVERLAY ================= */
.modern-gallery-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #f3ead7;
    aspect-ratio: 4 / 3;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.modern-gallery-card:hover .gallery-img {
    transform: scale(1.05);
}

/* Kaca Transparan / Glassmorphism Blur Effect */
.gallery-glass-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.modern-gallery-card:hover .gallery-glass-overlay {
    opacity: 1;
}

.btn-delete-trigger {
    background: #fff0f0;
    color: #e74c3c;
    border: 1px solid #ffdcd9;
    padding: 10px 18px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.1);
}

.btn-delete-trigger:hover {
    background: #e74c3c;
    color: white;
    border-color: #e74c3c;
}

/* ================= RIGHT PANEL: SIDEBAR PREVIEW ================= */
.main-image-preview-box {
    position: relative;
    background: #faf8f5;
    border-radius: 18px;
    padding: 12px;
    border: 1px solid #ebdcb9;
    aspect-ratio: 1 / 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-preview-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 12px;
}

.floating-badge-main {
    position: absolute;
    top: 20px;
    left: 20px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.3px;
    box-shadow: 0 4px 10px rgba(140, 106, 47, 0.2);
}

.empty-main-preview {
    text-align: center;
    color: #ebdcb9;
    font-size: 48px;
}

/* PRODUCT DATA DECORATIONS */
.product-badge-category {
    background: #faf6ed;
    color: #8C6A2F;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    border: 1px solid #f4ebd6;
}

.product-summary-title {
    font-weight: 800;
    color: #1a1a1a;
    font-size: 20px;
    letter-spacing: -0.3px;
}

.product-summary-code {
    font-size: 13px;
}

.product-summary-price-tag {
    background: #faf8f5;
    border: 1px solid #f5efe2;
    padding: 14px;
    border-radius: 14px;
}

.price-label {
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
    display: block;
    margin-bottom: 2px;
    font-weight: 600;
}

.price-value {
    color: #8C6A2F;
    font-weight: 800;
    font-size: 22px;
}

/* ================= EMPTY STATE PLATFORM ================= */
.empty-media-state {
    text-align: center;
    padding: 40px 20px;
}

.empty-icon-box {
    font-size: 42px;
    color: #ebdcb9;
    margin-bottom: 12px;
}

.empty-media-state h4 {
    font-weight: 700;
    font-size: 16px;
    color: #444;
}

.empty-media-state p {
    font-size: 13.5px;
    max-width: 400px;
    margin: 0 auto;
}
</style>

<script>
// Mengubah teks judul dropzone secara dinamis ketika file dipilih
function updatedropzoneText(input) {
    const title = document.getElementById('dropzone-title');
    if(input.files && input.files.length > 0) {
        title.innerText = `🔥 ${input.files.length} Berkas foto siap diunggah`;
        title.style.color = '#8C6A2F';
    } else {
        title.innerText = "Tarik berkas ke sini atau klik untuk memilih";
        title.style.color = '#1a1a1a';
    }
}

// Interseptor Tombol Hapus Menggunakan SweetAlert2 Animasi Modern
document.querySelectorAll('.btn-delete-trigger').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        let form = this.closest('.delete-gallery-form');
        
        Swal.fire({
            title: 'Hapus foto dari album?',
            text: "Berkas gambar terpilih akan dihapus selamanya dari penyimpanan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus foto!',
            cancelButtonText: 'Batal',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-4'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@endsection