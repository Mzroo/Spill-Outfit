@extends('layouts.admin')

@section('title', 'Tambah Brand')

@section('content')

<div class="container-fluid">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Tambah Brand</h1>
            <p class="page-subtitle">Daun grup produsen atau penyuplai produk outfit baru ke dalam ekosistem.</p>
        </div>
    </div>

    <div class="custom-card">
        <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-5">

                <div class="col-lg-7">
                    
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="namaBrand">
                            Nama Brand / Merek <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama"
                            id="namaBrand"
                            class="form-control-custom @error('nama') is-invalid @enderror"
                            placeholder="Contoh: Roughneck 1991"
                            value="{{ old('nama') }}"
                            required
                        >
                        @error('nama')
                            <small class="text-danger mt-1 d-block fw-semibold">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom">
                            Slug URL Otomatis
                        </label>
                        <div class="slug-input-wrapper">
                            <i class="fa-solid fa-link slug-icon"></i>
                            <input
                                type="text"
                                id="slugBrand"
                                class="form-control-custom readonly-custom"
                                placeholder="slug-merek-otomatis"
                                readonly
                            >
                        </div>
                    </div>

                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom" for="deskripsiBrand">
                            Deskripsi Singkat Profil Merek
                        </label>
                        <textarea
                            name="deskripsi"
                            id="deskripsiBrand"
                            rows="4"
                            class="form-control-custom textarea-custom"
                            placeholder="Tuliskan latar belakang singkat atau ciri khas dari apparel brand ini..."
                        >{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom" for="logoInput">
                            Logo Resmi Brand
                        </label>
                        <div class="custom-file-upload">
                            <input
                                type="file"
                                name="logo"
                                id="logoInput"
                                class="form-control-custom file-input-hidden"
                                accept="image/jpg,image/jpeg,image/png,image/webp"
                            >
                            <label for="logoInput" class="file-upload-label">
                                <i class="fa-solid fa-cloud-arrow-up mb-2 upload-icon"></i>
                                <span>Pilih file logo brand atau seret ke sini</span>
                                <small class="text-muted mt-1">Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB)</small>
                            </label>
                        </div>
                        @error('logo')
                            <small class="text-danger mt-1 d-block fw-semibold">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom">
                            Status Publikasi Brand <span class="text-danger">*</span>
                        </label>
                        <div class="status-radio-container">
                            <label class="radio-card">
                                <input type="radio" name="status" value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'checked' : '' }}>
                                <div class="radio-content">
                                    <i class="fa-solid fa-circle-check text-success icon-status"></i>
                                    <div>
                                        <strong>Aktif & Bekerjasama</strong>
                                        <p>Tampilkan logo merek ini pada daftar penjelajah beranda utama.</p>
                                    </div>
                                </div>
                            </label>

                            <label class="radio-card">
                                <input type="radio" name="status" value="nonaktif" {{ old('status') == 'nonaktif' ? 'checked' : '' }}>
                                <div class="radio-content">
                                    <i class="fa-solid fa-circle-minus text-warning icon-status"></i>
                                    <div>
                                        <strong>Nonaktifkan Dulu</strong>
                                        <p>Sembunyikan seluruh produk terkait brand ini dari hadapan publik.</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mt-5 action-container">
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Simpan Brand Baru
                        </button>
                        <a href="{{ route('admin.brand.index') }}" class="btn-back">
                            Batal
                        </a>
                    </div>

                </div>

                <div class="col-lg-5">
                    <div class="sticky-preview-wrapper">
                        <div class="preview-card">
                            <span class="preview-badge"><i class="fa-solid fa-eye me-1"></i> Live Preview</span>
                            
                            <div class="preview-logo-wrapper">
                                <div class="preview-image-box">
                                    <img
                                        id="previewLogo"
                                        src="https://placehold.co/300x300/faf6ef/B68D40?text=LOGO+BRAND"
                                        alt="Pratinjau Logo Brand"
                                    >
                                </div>
                            </div>

                            <div class="preview-details text-center mt-3">
                                <h2 id="previewNama" class="preview-name text-truncate">Nama Brand</h2>
                                <div class="mb-2">
                                    <span id="previewSlug" class="preview-slug-badge">
                                        <i class="fa-solid fa-link me-1" style="font-size: 10px;"></i>slug-brand
                                    </span>
                                </div>
                                
                                <span id="previewStatusBadge" class="status-badge status-active mt-1">
                                    <i class="fa-solid fa-circle-check me-1"></i>aktif
                                </span>

                                <hr class="divider-preview">
                                
                                <div class="text-start">
                                    <p class="preview-desc-title mb-1 fw-bold text-muted">Deskripsi Profil:</p>
                                    <p id="previewDeskripsi" class="preview-desc-text text-muted">
                                        Belum ada deskripsi profil brand fashion yang dituliskan saat ini...
                                    </p>
                                </div>
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

/* ================= MODERN BOX FILE UPLOAD ================= */
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

/* ================= RADIO SELECTION CARDS ================= */
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
    height: 100%;
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

.radio-card input[type="radio"]:checked + .radio-content {
    background: #fff;
    border-color: #8C6A2F;
    box-shadow: 0 6px 15px rgba(140, 106, 47, 0.08);
}

/* ================= CONTROLLER SYSTEM BUTTONS ================= */
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

/* ================= LIVE PREVIEW VISUAL CARD ================= */
.sticky-preview-wrapper {
    position: sticky;
    top: 30px;
}

.preview-card {
    background: #faf6ef;
    border-radius: 24px;
    padding: 30px 24px;
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

.preview-logo-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.preview-image-box {
    width: 160px;
    height: 160px;
    border-radius: 24px;
    overflow: hidden;
    background: white;
    border: 1px solid #ebdcb9;
    box-shadow: 0 8px 20px rgba(140, 106, 47, 0.04);
}

.preview-image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.preview-name {
    font-weight: 800;
    color: #1a1a1a;
    font-size: 22px;
    margin: 0 0 4px 0;
}

.preview-slug-badge {
    background: white;
    padding: 5px 14px;
    border-radius: 50px;
    display: inline-block;
    color: #8C6A2F;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid #ebdcb9;
}

/* CHIPS FOR PREVIEW STATUS */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 14px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-active {
    background: #e8f8f5;
    color: #1abc9c;
}

.status-inactive {
    background: #fef9e7;
    color: #f39c12;
}

.divider-preview {
    margin: 20px 0;
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

/* ================= INTERFACE RESPONSIVE SYSTEM ================= */
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
    // Referensi Objek DOM Element
    const namaBrand = document.getElementById('namaBrand');
    const slugBrand = document.getElementById('slugBrand');
    const deskripsiBrand = document.getElementById('deskripsiBrand');
    const logoInput = document.getElementById('logoInput');
    
    const previewNama = document.getElementById('previewNama');
    const previewSlug = document.getElementById('previewSlug');
    const previewDeskripsi = document.getElementById('previewDeskripsi');
    const previewLogo = document.getElementById('previewLogo');
    const previewStatusBadge = document.getElementById('previewStatusBadge');
    const statusRadios = document.querySelectorAll('input[name="status"]');

    // EVENT LISTENER: LIVE SLUG GENERATOR & NAME TEXT PREVIEW
    namaBrand.addEventListener('keyup', function(){
        let namaValue = this.value;

        let slugValue = namaValue
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')             // Spasi diganti strip (-)
            .replace(/[^\w-]+/g, '');         // Bersihkan tanda baca tak dikenal

        slugBrand.value = slugValue;

        previewNama.innerText = namaValue || 'Nama Brand';
        previewSlug.innerHTML = `<i class="fa-solid fa-link me-1" style="font-size: 10px;"></i>${slugValue || 'slug-brand'}`;
    });

    // EVENT LISTENER: LIVE DESKRIPSI TEXT PREVIEW
    deskripsiBrand.addEventListener('keyup', function(){
        previewDeskripsi.innerText = this.value || 'Belum ada deskripsi profil brand fashion yang dituliskan saat ini...';
    });

    // EVENT LISTENER: LIVE IMAGE FILE LOGO PREVIEW
    logoInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if(file){
            previewLogo.src = URL.createObjectURL(file);
        }
    });

    // EVENT LISTENER: LIVE RADIO BUTTON STATUS BADGE CHANGEOVER
    statusRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if(this.checked) {
                let statusValue = this.value;
                if(statusValue === 'aktif') {
                    previewStatusBadge.className = 'status-badge status-active mt-1';
                    previewStatusBadge.innerHTML = `<i class="fa-solid fa-circle-check me-1"></i>aktif`;
                } else {
                    previewStatusBadge.className = 'status-badge status-inactive mt-1';
                    previewStatusBadge.innerHTML = `<i class="fa-solid fa-circle-minus me-1"></i>nonaktif`;
                }
            }
        });
    });
</script>

@endsection