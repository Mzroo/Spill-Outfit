@extends('layouts.admin')

@section('title', 'Tambah Ukuran Baru')

@section('content')

<div class="container-fluid">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Tambah Ukuran Baru</h1>
            <p class="page-subtitle">Buat variasi dimensi atau size charts baru untuk standar manajemen inventori inventaris outfit.</p>
        </div>
        <a href="{{ route('admin.ukuran.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left-long me-2"></i>Kembali ke Daftar
        </a>
    </div>

    <div class="custom-card p-4 p-md-5">
        <form action="{{ route('admin.ukuran.store') }}" method="POST">
            @csrf

            <div class="row g-5">
                
                <div class="col-lg-7">
                    
                    <div class="mb-4">
                        <label class="custom-form-label mb-2">Nama Ukuran <span class="text-danger">*</span></label>
                        <input type="text"
                               name="nama"
                               id="namaUkuran"
                               class="form-control custom-input @error('nama') is-invalid @enderror"
                               placeholder="Contoh: Small, Medium, Extra Large"
                               value="{{ old('nama') }}"
                               required>
                        @error('nama')
                            <div class="invalid-feedback fw-semibold mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="custom-form-label mb-2">Kode Ukuran / Abstraksi <span class="text-danger">*</span></label>
                        <input type="text"
                               name="kode"
                               id="kodeUkuran"
                               class="form-control custom-input text-uppercase @error('kode') is-invalid @enderror"
                               placeholder="Contoh: S, M, L, XL, XXL"
                               value="{{ old('kode') }}"
                               required>
                        <small class="text-muted d-block mt-1">Kode ini akan otomatis diubah menjadi huruf kapital saat disimpan.</small>
                        @error('kode')
                            <div class="invalid-feedback fw-semibold mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="custom-form-label mb-2">Keterangan / Size Detail <span class="text-muted">(Opsional)</span></label>
                        <textarea name="keterangan"
                                  id="keteranganUkuran"
                                  class="form-control custom-input @error('keterangan') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Contoh: Cocok untuk lingkar dada 88-92 cm atau panjang badan 70 cm...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback fw-semibold mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="custom-form-label mb-2">Urutan Tampil <span class="text-danger">*</span></label>
                        <input type="number"
                               name="urutan"
                               class="form-control custom-input @error('urutan') is-invalid @enderror"
                               value="{{ old('urutan', 1) }}"
                               min="1"
                               required>
                        <small class="text-muted d-block mt-1">Gunakan angka urut (1, 2, 3) untuk mengatur prioritas display di halaman katalog user.</small>
                        @error('urutan')
                            <div class="invalid-feedback fw-semibold mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="custom-form-label mb-2">Status Publikasi</label>
                        <select name="status" class="form-select custom-input">
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif (Ditampilkan di form produk)</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif (Disembunyikan sementara)</option>
                        </select>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn-submit-form">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Simpan Ukuran
                        </button>
                        <a href="{{ route('admin.ukuran.index') }}" class="btn-cancel-form">
                            Batal
                        </a>
                    </div>

                </div>

                <div class="col-lg-5">
                    <div class="sticky-preview-wrapper">
                        <div class="preview-card-frame">
                            <div class="preview-header-badge">
                                <i class="fa-solid fa-eye me-2"></i>Live Component Preview
                            </div>
                            
                            <div class="preview-content-center">
                                <div class="preview-size-badge-box mb-3">
                                    <span id="previewKode">S</span>
                                </div>

                                <h4 class="preview-size-name" id="previewNama">Small</h4>

                                <div class="preview-divider"></div>

                                <p class="preview-size-desc" id="previewKeterangan">
                                    Lingkar dada 88-92 cm
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
/* ================= TYPOGRAPHY & HEADER MANAGEMENT ================= */
.container-fluid {
    font-family: 'Poppins', sans-serif;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.page-title {
    font-size: 28px;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 6px 0;
    letter-spacing: -0.5px;
}

.page-subtitle {
    margin: 0;
    color: #777;
    font-size: 14px;
}

.btn-back {
    background: #ffffff;
    color: #666;
    border: 1px solid #ebdcb9;
    text-decoration: none;
    padding: 12px 22px;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}

.btn-back:hover {
    background: #faf6ed;
    color: #8C6A2F;
    border-color: #ebdcb9;
}

/* ================= CUSTOM CARD FORM CONTAINER ================= */
.custom-card {
    background: white;
    border-radius: 28px;
    border: 1px solid #f5efe2;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.03);
}

.custom-form-label {
    font-weight: 700;
    font-size: 14px;
    color: #333;
    display: block;
}

/* INPUT FORM FIELD STYLING */
.custom-input {
    border: 1px solid #ebdcb9 !important;
    background-color: #faf8f5 !important;
    border-radius: 14px !important;
    padding: 12px 18px !important;
    font-size: 14.5px !important;
    color: #333 !important;
    transition: all 0.2s ease !important;
}

.custom-input:focus {
    background-color: #ffffff !important;
    border-color: #8C6A2F !important;
    box-shadow: 0 0 0 4px rgba(140, 106, 47, 0.1) !important;
}

.custom-input::placeholder {
    color: #bbb;
}

/* BUTTON HANDLERS */
.btn-submit-form {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border: none;
    padding: 14px 28px;
    border-radius: 16px;
    font-weight: 600;
    font-size: 15px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    box-shadow: 0 6px 15px rgba(140, 106, 47, 0.15);
    flex: 2;
}

.btn-submit-form:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(140, 106, 47, 0.3);
}

.btn-cancel-form {
    background: #f5f4f8;
    color: #777;
    border: 1px solid #e5e4e9;
    text-decoration: none;
    padding: 14px 28px;
    border-radius: 16px;
    font-weight: 600;
    font-size: 15px;
    text-align: center;
    transition: all 0.2s ease;
    flex: 1;
}

.btn-cancel-form:hover {
    background: #e74c3c;
    color: white;
    border-color: transparent;
}

/* ================= INTERACTIVE STICKY PREVIEW CARD ================= */
.sticky-preview-wrapper {
    position: sticky;
    top: 30px;
}

.preview-card-frame {
    background: #faf8f4;
    border: 1px dashed #ebdcb9;
    border-radius: 24px;
    padding: 30px;
    position: relative;
    overflow: hidden;
}

.preview-header-badge {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    background: #f4ebd6;
    color: #8C6A2F;
    text-align: center;
    padding: 6px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.preview-content-center {
    text-align: center;
    padding-top: 20px;
}

.preview-size-badge-box {
    display: inline-block;
}

.preview-size-badge-box span {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 12px 28px;
    border-radius: 14px;
    font-size: 22px;
    font-weight: 800;
    font-family: 'SF Mono', Consolas, monospace;
    display: inline-block;
    box-shadow: 0 6px 15px rgba(140, 106, 47, 0.15);
    text-transform: uppercase;
    min-width: 80px;
}

.preview-size-name {
    font-size: 18px;
    font-weight: 700;
    color: #222;
    margin-top: 15px;
    word-break: break-all;
}

.preview-divider {
    height: 2px;
    background: #ebdcb9;
    width: 60px;
    margin: 15px auto;
}

.preview-size-desc {
    color: #666;
    font-size: 13.5px;
    line-height: 1.6;
    margin: 0;
    word-break: break-word;
}

/* INVALID FEEDBACK CUSTOMIZATION */
.is-invalid {
    border-color: #e74c3c !important;
}
.invalid-feedback {
    color: #e74c3c;
    font-size: 13px;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const namaInput = document.getElementById('namaUkuran');
        const kodeInput = document.getElementById('kodeUkuran');
        const keteranganInput = document.getElementById('keteranganUkuran');

        const previewNama = document.getElementById('previewNama');
        const previewKode = document.getElementById('previewKode');
        const previewKeterangan = document.getElementById('previewKeterangan');

        namaInput.addEventListener('input', function () {
            previewNama.innerText = this.value.trim() || 'Small';
        });

        kodeInput.addEventListener('input', function () {
            previewKode.innerText = this.value.trim().toUpperCase() || 'S';
        });

        keteranganInput.addEventListener('input', function () {
            previewKeterangan.innerText = this.value.trim() || 'Lingkar dada 88-92 cm';
        });
    });
</script>

@endsection