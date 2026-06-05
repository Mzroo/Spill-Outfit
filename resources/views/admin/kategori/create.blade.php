@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

<div class="container-fluid">

    <!-- ================= PAGE HEADER ================= -->
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Tambah Kategori</h1>
            <p class="page-subtitle">Buat grup kategori baru untuk mengelompokkan koleksi outfit.</p>
        </div>
    </div>

    <!-- ================= MAIN DATA CARD ================= -->
    <div class="custom-card">
        <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-5">

                <!-- KIRI: ISIAN FORM UTAMA -->
                <div class="col-lg-7">
                    
                    <!-- NAMA KATEGORI -->
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="namaKategori">
                            Nama Kategori <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama"
                            id="namaKategori"
                            class="form-control-custom @error('nama') is-invalid @enderror"
                            placeholder="Contoh: Campus Style"
                            value="{{ old('nama') }}"
                            required
                        >
                        @error('nama')
                            <small class="text-danger mt-1 d-block fw-semibold">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- SLUG OTOMATIS -->
                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom">
                            Slug URL Otomatis
                        </label>
                        <div class="slug-input-wrapper">
                            <i class="fa-solid fa-link slug-icon"></i>
                            <input
                                type="text"
                                id="slugKategori"
                                class="form-control-custom readonly-custom"
                                placeholder="slug-otomatis-terisi"
                                readonly
                            >
                        </div>
                        <small class="text-muted mt-1" style="font-size: 12px;">
                            Slug ini digunakan otomatis sebagai tautan ramah SEO pada URL browser.
                        </small>
                    </div>

                    <!-- DESKRIPSI KATEGORI (KOLOM BARU) -->
                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom" for="deskripsiKategori">
                            Deskripsi Kategori
                        </label>
                        <textarea
                            name="deskripsi"
                            id="deskripsiKategori"
                            rows="4"
                            class="form-control-custom textarea-custom @error('deskripsi') is-invalid @enderror"
                            placeholder="Tuliskan penjelasan singkat mengenai jenis gaya pakaian ini..."
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <small class="text-danger mt-1 d-block fw-semibold">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- UPLOAD GAMBAR -->
                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom" for="gambarKategori">
                            Gambar Kategori
                        </label>
                        <div class="custom-file-upload">
                            <input
                                type="file"
                                name="gambar"
                                id="gambarKategori"
                                class="form-control-custom file-input-hidden"
                                accept="image/jpg,image/jpeg,image/png,image/webp"
                            >
                            <label for="gambarKategori" class="file-upload-label">
                                <i class="fa-solid fa-cloud-arrow-up mb-2 upload-icon"></i>
                                <span>Pilih berkas gambar atau seret ke sini</span>
                                <small class="text-muted mt-1">Mendukung Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB)</small>
                            </label>
                        </div>
                        @error('gambar')
                            <small class="text-danger mt-1 d-block fw-semibold">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- STATUS PUBLIKASI (KOLOM BARU) -->
                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom">
                            Status Kategori <span class="text-danger">*</span>
                        </label>
                        <div class="status-radio-container">
                            <label class="radio-card">
                                <input type="radio" name="status" value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'checked' : '' }}>
                                <div class="radio-content">
                                    <i class="fa-solid fa-circle-check text-success icon-status"></i>
                                    <div>
                                        <strong>Aktifkan</strong>
                                        <p>Langsung tampilkan di menu utama website publik.</p>
                                    </div>
                                </div>
                            </label>

                            <label class="radio-card">
                                <input type="radio" name="status" value="nonaktif" {{ old('status') == 'nonaktif' ? 'checked' : '' }}>
                                <div class="radio-content">
                                    <i class="fa-solid fa-circle-minus text-warning icon-status"></i>
                                    <div>
                                        <strong>Sembunyikan</strong>
                                        <p>Simpan sebagai draf internal manajemen admin.</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- ACTION BUTTONS CONTROLLER -->
                    <div class="d-flex align-items-center gap-3 mt-5 action-container">
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Simpan Kategori
                        </button>
                        <a href="{{ route('admin.kategori.index') }}" class="btn-back">
                            Batal
                        </a>
                    </div>

                </div>

                <!-- KANAN: LIVE INTERACTIVE PREVIEW CARD -->
                <div class="col-lg-5">
                    <div class="sticky-preview-wrapper">
                        <div class="preview-card">
                            <span class="preview-badge"><i class="fa-solid fa-eye me-1"></i> Pratinjau Live</span>
                            
                            <div class="preview-image-box">
                                <img
                                    id="previewImage"
                                    src="https://placehold.co/500x350/faf6ef/B68D40?text=Spill+Outfit"
                                    alt="Pratinjau Gambar Kategori"
                                >
                            </div>

                            <div class="preview-details text-start">
                                <h2 id="previewNama" class="preview-name text-truncate">Nama Kategori</h2>
                                <div>
                                    <span id="previewSlug" class="preview-slug-badge">
                                        <i class="fa-solid fa-link me-1" style="font-size: 10px;"></i>slug-kategori
                                    </span>
                                </div>
                                <hr class="divider-preview">
                                <p class="preview-desc-title mb-1 fw-bold text-muted">Deskripsi Kategori:</p>
                                <p id="previewDeskripsi" class="preview-desc-text text-muted">
                                    Belum ada deskripsi yang dituliskan. Detail penjelasan mengenai karakteristik kategori busana akan tampil di bagian ini secara dinamis...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<style>
/* ================= TYPOGRAPHY & HEADER ================= */
.container-fluid {
    font-family: 'Poppins', sans-serif;
}

.page-title {
    font-size: 28px;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 6px 0;
    letter-spacing: -0.5px;
}

.page-subtitle {
    color: #777;
    margin: 0;
    font-size: 14px;
}

/* ================= CUSTOM CARD BASE ================= */
.custom-card {
    background: white;
    border-radius: 28px;
    padding: 40px;
    border: 1px solid #f5efe2;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.03);
}

/* ================= INPUT ELEMENTS STYLING ================= */
.form-group-custom {
    display: flex;
    flex-direction: column;
}

.form-label-custom {
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 10px;
    color: #2c3e50;
    letter-spacing: 0.2px;
}

.form-control-custom {
    width: 100%;
    height: 54px;
    border: 1.5px solid #ebdcb9;
    outline: none;
    border-radius: 14px;
    background: #faf8f5;
    padding: 0 18px;
    font-size: 14.5px;
    color: #333;
    transition: all 0.25s ease-in-out;
}

.form-control-custom:focus {
    background: #fff;
    border-color: #8C6A2F;
    box-shadow: 0 0 0 4px rgba(140, 106, 47, 0.12);
}

.textarea-custom {
    height: auto !important;
    padding: 16px 18px !important;
    line-height: 1.6;
}

.readonly-custom {
    background: #f0ebde !important;
    border-color: #dfd1b3 !important;
    color: #615335 !important;
    font-weight: 500;
}

.slug-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.slug-input-wrapper .form-control-custom {
    padding-left: 44px;
}

.slug-icon {
    position: absolute;
    left: 18px;
    color: #8C6A2F;
    font-size: 14px;
}

/* ================= MODERN FILE UPLOAD ================= */
.custom-file-upload {
    position: relative;
    width: 100%;
}

.file-input-hidden {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 5;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 24px;
    background: #faf8f5;
    border: 2px dashed #ebdcb9;
    border-radius: 16px;
    text-align: center;
    transition: all 0.2s ease;
    cursor: pointer;
}

.upload-icon {
    font-size: 28px;
    color: #8C6A2F;
}

.file-upload-label span {
    font-size: 14px;
    font-weight: 600;
    color: #444;
}

.custom-file-upload:hover .file-upload-label {
    background: #fcfbf9;
    border-color: #8C6A2F;
}

/* ================= RADIO BUTTON SELECTION CARD ================= */
.status-radio-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.radio-card {
    position: relative;
    cursor: pointer;
}

.radio-card input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.radio-content {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px;
    background: #faf8f5;
    border: 1.5px solid #ebdcb9;
    border-radius: 16px;
    transition: all 0.2s ease;
}

.icon-status {
    font-size: 18px;
    margin-top: 3px;
}

.radio-content strong {
    display: block;
    font-size: 14px;
    color: #222;
}

.radio-content p {
    margin: 2px 0 0 0;
    font-size: 12px;
    color: #777;
    line-height: 1.4;
}

/* Radio Checked State Styling */
.radio-card input[type="radio"]:checked + .radio-content {
    background: #fff;
    border-color: #8C6A2F;
    box-shadow: 0 6px 15px rgba(140, 106, 47, 0.08);
}

/* ================= SYSTEM BUTTON CONTROLS ================= */
.btn-save {
    border: none;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 15px 32px;
    border-radius: 16px;
    font-weight: 600;
    font-size: 14.5px;
    transition: all 0.2s ease;
    box-shadow: 0 6px 15px rgba(140, 106, 47, 0.2);
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(140, 106, 47, 0.3);
}

.btn-back {
    text-decoration: none;
    background: #f5f5f5;
    color: #555;
    padding: 15px 32px;
    border-radius: 16px;
    font-weight: 600;
    font-size: 14.5px;
    transition: background 0.2s ease;
    text-align: center;
}

.btn-back:hover {
    background: #e8e8e8;
    color: #333;
}

/* ================= LIVE PREVIEW MANAGEMENT ================= */
.sticky-preview-wrapper {
    position: sticky;
    top: 30px;
}

.preview-card {
    background: #faf6ef;
    border-radius: 24px;
    padding: 24px;
    border: 1px solid #ebdcb9;
    position: relative;
    overflow: hidden;
}

.preview-badge {
    position: absolute;
    top: 14px;
    right: 14px;
    background: rgba(140, 106, 47, 0.15);
    color: #8C6A2F;
    padding: 4px 12px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.preview-image-box {
    width: 100%;
    height: 200px;
    border-radius: 16px;
    overflow: hidden;
    background: white;
    border: 1px solid #ebdcb9;
    margin-bottom: 20px;
}

.preview-image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.preview-name {
    font-weight: 800;
    color: #1a1a1a;
    font-size: 20px;
    margin: 0 0 4px 0;
}

.preview-slug-badge {
    background: white;
    padding: 6px 14px;
    border-radius: 50px;
    display: inline-block;
    color: #8C6A2F;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid #ebdcb9;
}

.divider-preview {
    margin: 18px 0;
    border-color: #ebdcb9;
    opacity: 0.6;
}

.preview-desc-title {
    font-size: 12.5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.preview-desc-text {
    font-size: 13px;
    line-height: 1.6;
    margin: 0;
}

/* ================= RESPONSIVE DESIGN INTERFACE ================= */
@media(max-width: 991px) {
    .sticky-preview-wrapper {
        position: relative;
        top: 0;
        margin-top: 20px;
    }
}

@media(max-width: 768px) {
    .custom-card {
        padding: 24px;
    }
    
    .status-radio-container {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .action-container {
        flex-direction: column;
    }
    
    .btn-save, .btn-back {
        width: 100%;
    }
}
</style>

<script>
    // Inisialisasi Selector DOM Element
    const namaInput = document.getElementById('namaKategori');
    const slugOutput = document.getElementById('slugKategori');
    const deskripsiInput = document.getElementById('deskripsiKategori');
    
    const previewNama = document.getElementById('previewNama');
    const previewSlug = document.getElementById('previewSlug');
    const previewDeskripsi = document.getElementById('previewDeskripsi');
    const gambarInput = document.getElementById('gambarKategori');
    const previewImage = document.getElementById('previewImage');

    // EVENT LISTENER: SLUG & TEXT LIVE PREVIEW GENERATOR
    namaInput.addEventListener('keyup', function(){
        let value = namaInput.value;

        // Logika konversi text input menjadi format slug URL ramah SEO
        let slugValue = value
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')           // Ganti spasi dengan tanda penghubung (-)
            .replace(/[^\w-]+/g, '');       // Bersihkan karakter spesial di luar alfanumerik

        slugOutput.value = slugValue;

        // Perbarui Pratinjau Teks
        previewNama.innerText = value || 'Nama Kategori';
        previewSlug.innerHTML = `<i class="fa-solid fa-link me-1" style="font-size: 10px;"></i>${slugValue || 'slug-kategori'}`;
    });

    // EVENT LISTENER: DESKRIPSI LIVE PREVIEW
    deskripsiInput.addEventListener('keyup', function() {
        let value = deskripsiInput.value;
        previewDeskripsi.innerText = value || 'Belum ada deskripsi yang dituliskan. Detail penjelasan mengenai karakteristik kategori busana akan tampil di bagian ini secara dinamis...';
    });

    // EVENT LISTENER: LIVE MEDIA PREVIEW UPLOAD
    gambarInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if(file){
            previewImage.src = URL.createObjectURL(file);
        }
    });
</script>

@endsection