@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')

<div class="container-fluid">

    <!-- ================= PAGE HEADER ================= -->
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Edit Produk</h1>
            <p class="page-subtitle">Perbarui data detail dan spesifikasi katalog produk Anda.</p>
        </div>
    </div>

    <!-- ================= MAIN DATA CARD ================= -->
    <div class="custom-card">
        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-5">

                <!-- KIRI: ISIAN FORM UTAMA -->
                <div class="col-lg-7">
                    
                    <h5 class="mb-4 fw-bold text-dark" style="letter-spacing: -0.3px;">
                        <i class="fa-solid fa-pen-to-square me-2 text-warning" style="color: #8C6A2F !important;"></i>Perbarui Data Produk
                    </h5>

                    <!-- KODE PRODUK (READONLY) -->
                    <div class="form-group-custom mb-4">
                        <label class="form-label-custom">
                            Kode Produk <span class="text-muted">(Otomatis/Sistem)</span>
                        </label>
                        <div class="slug-input-wrapper">
                            <i class="fa-solid fa-barcode slug-icon"></i>
                            <input
                                type="text"
                                name="kode"
                                class="form-control-custom readonly-custom"
                                value="{{ $produk->kode }}"
                                readonly
                            >
                        </div>
                    </div>

                    <div class="row g-4">
                        <!-- NAMA PRODUK -->
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="namaProduk">
                                    Nama Produk <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    id="namaProduk"
                                    class="form-control-custom @error('nama') is-invalid @enderror"
                                    placeholder="Contoh: Hoodie Oversize"
                                    value="{{ old('nama', $produk->nama) }}"
                                    required
                                >
                                @error('nama')
                                    <small class="text-danger mt-1 d-block fw-semibold">
                                        <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <!-- HARGA PRODUK -->
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="hargaProduk">
                                    Harga (Rp) <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="number"
                                    name="harga"
                                    id="hargaProduk"
                                    class="form-control-custom @error('harga') is-invalid @enderror"
                                    placeholder="Contoh: 150000"
                                    value="{{ old('harga', $produk->harga) }}"
                                    required
                                >
                                @error('harga')
                                    <small class="text-danger mt-1 d-block fw-semibold">
                                        <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <!-- KATEGORI -->
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="kategoriProduk">
                                    Kategori <span class="text-danger">*</span>
                                </label>
                                <select name="kategori_id" id="kategoriProduk" class="form-control-custom form-select-custom @error('kategori_id') is-invalid @enderror" required>
                                    <option value="">Pilih Kategori...</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id }}" {{ old('kategori_id', $produk->kategori_id) == $k->id ? 'selected' : '' }} data-nama="{{ $k->nama }}">
                                            {{ $k->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <small class="text-danger mt-1 d-block fw-semibold">
                                        <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <!-- BRAND -->
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="brandProduk">
                                    Brand
                                </label>
                                <select name="brand_id" id="brandProduk" class="form-control-custom form-select-custom @error('brand_id') is-invalid @enderror">
                                    <option value="">Pilih Brand...</option>
                                    @foreach($brand as $b)
                                        <option value="{{ $b->id }}" {{ old('brand_id', $produk->brand_id) == $b->id ? 'selected' : '' }} data-nama="{{ $b->nama }}">
                                            {{ $b->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <small class="text-danger mt-1 d-block fw-semibold">
                                        <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- DESKRIPSI PRODUK -->
                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom" for="deskripsiProduk">
                            Deskripsi Produk
                        </label>
                        <textarea
                            name="deskripsi"
                            id="deskripsiProduk"
                            rows="4"
                            class="form-control-custom textarea-custom @error('deskripsi') is-invalid @enderror"
                            placeholder="Tuliskan spesifikasi detail mengenai produk fashion ini..."
                        >{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <small class="text-danger mt-1 d-block fw-semibold">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- UPLOAD GAMBAR -->
                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom" for="gambarProduk">
                            Gambar Produk
                        </label>
                        <div class="custom-file-upload">
                            <input
                                type="file"
                                name="gambar"
                                id="gambarProduk"
                                class="form-control-custom file-input-hidden @error('gambar') is-invalid @enderror"
                                accept="image/jpg,image/jpeg,image/png"
                            >
                            <label for="gambarProduk" class="file-upload-label">
                                <i class="fa-solid fa-cloud-arrow-up mb-2 upload-icon"></i>
                                <span>Pilih gambar baru untuk mengganti gambar lama</span>
                                <small class="text-muted mt-1">Kosongkan jika tidak ingin mengubah berkas saat ini.</small>
                            </label>
                        </div>
                        @error('gambar')
                            <small class="text-danger mt-1 d-block fw-semibold">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- STATUS PUBLIKASI -->
                    <div class="form-group-custom mt-4">
                        <label class="form-label-custom">
                            Status Publikasi <span class="text-danger">*</span>
                        </label>
                        <div class="status-radio-container">
                            <label class="radio-card">
                                <input type="radio" name="status" value="public" {{ old('status', $produk->status) == 'public' ? 'checked' : '' }}>
                                <div class="radio-content">
                                    <i class="fa-solid fa-circle-check text-success icon-status"></i>
                                    <div>
                                        <strong>Public</strong>
                                        <p>Produk aktif dan dapat diakses pembeli pada katalog toko.</p>
                                    </div>
                                </div>
                            </label>

                            <label class="radio-card">
                                <input type="radio" name="status" value="block" {{ old('status', $produk->status) == 'block' ? 'checked' : '' }}>
                                <div class="radio-content">
                                    <i class="fa-solid fa-circle-minus text-danger icon-status"></i>
                                    <div>
                                        <strong>Block / Arsipkan</strong>
                                        <p>Sembunyikan produk sementara waktu dari halaman publik.</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- ACTION BUTTONS CONTROLLER -->
                    <div class="d-flex align-items-center gap-3 mt-5 action-container">
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-rotate me-2"></i>Perbarui Produk
                        </button>
                        <a href="{{ route('admin.produk.index') }}" class="btn-back">
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
                                    src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://placehold.co/400x400/faf6ef/8C6A2F?text=No+Image' }}"
                                    alt="Pratinjau Gambar Produk"
                                >
                            </div>

                            <div class="preview-details text-start">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h2 id="previewNama" class="preview-name text-truncate flex-grow-1 me-2">{{ $produk->nama }}</h2>
                                    <span id="previewHarga" class="preview-price-tag text-nowrap">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="d-flex gap-2 mb-3">
                                    <span id="previewKategori" class="preview-meta-badge">
                                        <i class="fa-solid fa-tags me-1"></i>{{ $produk->kategori->nama ?? 'Kategori' }}
                                    </span>
                                    <span id="previewBrand" class="preview-meta-badge">
                                        <i class="fa-solid fa-copyright me-1"></i>{{ $produk->brand->nama ?? 'Brand' }}
                                    </span>
                                </div>

                                <hr class="divider-preview">
                                <p class="preview-desc-title mb-1 fw-bold text-muted">Deskripsi Detail Produk:</p>
                                <p id="previewDeskripsi" class="preview-desc-text text-muted">
                                    {{ $produk->deskripsi ?? 'Detail penjelasan produk akan muncul secara dinamis di sini...' }}
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

.form-select-custom {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%238C6A2F' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 18px center;
    background-size: 14px;
    padding-right: 40px;
}

.form-control-custom:focus {
    background: #fff;
    border-color: #8C6A2F;
    box-shadow: 0 0 0 4px rgba(140, 106, 47, 0.12);
}

.form-control-custom.is-invalid {
    border-color: #dc3545 !important;
    background-color: #fffbfa;
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
    font-weight: 600;
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
    z-index: 2;
}

.preview-image-box {
    width: 100%;
    height: 280px;
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
    margin: 0;
}

.preview-price-tag {
    font-weight: 800;
    color: #8C6A2F;
    font-size: 18px;
}

.preview-meta-badge {
    background: white;
    padding: 5px 12px;
    border-radius: 50px;
    display: inline-block;
    color: #615335;
    font-size: 11.5px;
    font-weight: 600;
    border: 1px solid #ebdcb9;
}

.divider-preview {
    margin: 15px 0;
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
    document.addEventListener("DOMContentLoaded", function () {
        // Selector Form Inputs
        const namaInput = document.getElementById('namaProduk');
        const hargaInput = document.getElementById('hargaProduk');
        const kategoriSelect = document.getElementById('kategoriProduk');
        const brandSelect = document.getElementById('brandProduk');
        const deskripsiInput = document.getElementById('deskripsiProduk');
        const gambarInput = document.getElementById('gambarProduk');

        // Selector Live Previews
        const previewNama = document.getElementById('previewNama');
        const previewHarga = document.getElementById('previewHarga');
        const previewKategori = document.getElementById('previewKategori');
        const previewBrand = document.getElementById('previewBrand');
        const previewDeskripsi = document.getElementById('previewDeskripsi');
        const previewImage = document.getElementById('previewImage');

        // Fungsi Helper Format Rupiah
        function formatRupiah(angka) {
            if (!angka) return 'Rp 0';
            return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }

        // Live Preview: Nama Produk
        namaInput.addEventListener('input', function() {
            previewNama.innerText = this.value.trim() || 'Nama Produk Baru';
        });

        // Live Preview: Harga Produk
        hargaInput.addEventListener('input', function() {
            previewHarga.innerText = formatRupiah(this.value);
        });

        // Live Preview: Kategori Dropdown
        kategoriSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const namaKategori = selectedOption.getAttribute('data-nama');
            previewKategori.innerHTML = `<i class="fa-solid fa-tags me-1"></i>${namaKategori || 'Kategori'}`;
        });

        // Live Preview: Brand Dropdown
        brandSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const namaBrand = selectedOption.getAttribute('data-nama');
            previewBrand.innerHTML = `<i class="fa-solid fa-copyright me-1"></i>${namaBrand || 'Brand'}`;
        });

        // Live Preview: Deskripsi
        deskripsiInput.addEventListener('input', function() {
            previewDeskripsi.innerText = this.value.trim() || 'Detail penjelasan mengenai spesifikasi akan muncul di sini...';
        });

        // Live Preview: Media Gambar Upload
        gambarInput.addEventListener('change', function(e){
            const file = e.target.files[0];
            if(file){
                previewImage.src = URL.createObjectURL(file);
            }
        });

        // Sinkronisasi data awal saat halaman selesai dimuat (old data atau database data)
        if(namaInput.value) previewNama.innerText = namaInput.value;
        if(hargaInput.value) previewHarga.innerText = formatRupiah(hargaInput.value);
        if(deskripsiInput.value) previewDeskripsi.innerText = deskripsiInput.value;
    });
</script>

@endsection