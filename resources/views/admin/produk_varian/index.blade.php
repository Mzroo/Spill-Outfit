@extends('layouts.admin')

@section('title', 'Kelola Varian Produk - ' . $produk->nama)

@section('content')

<div class="varian-container">

    <div class="page-header-nav">
        <div>
            <nav class="custom-breadcrumb">
                <a href="{{ route('admin.produk.index') }}">Produk</a>
                <span class="divider">/</span>
                <span class="active">Varian & Stok</span>
            </nav>
            <h1 class="page-title">Manajemen Varian Produk</h1>
            <p class="page-subtitle">Atur kombinasi ukuran, opsi warna, serta alokasi stok penyimpanan gudang secara mendetail.</p>
        </div>
        
        <div class="action-nav-buttons">
            <a href="{{ route('admin.produk.index') }}" class="btn-back-nav">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
            
            <button type="button" class="btn-add-variant" id="btnBukaTambah">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Varian Baru</span>
            </button>
        </div>
    </div>

    @if ($errors->any())
        <div class="custom-alert-danger">
            <h6 class="alert-title"><i class="fa-solid fa-triangle-exclamation"></i> Gagal Menyimpan Data:</h6>
            <ul class="alert-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="product-context-card">
        <div class="product-context-left">
            @if($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}" class="product-context-img" alt="{{ $produk->nama }}">
            @else
                <div class="product-context-empty-img"><i class="fa-solid fa-shirt"></i></div>
            @endif
            
            <div class="product-context-info">
                <span class="context-badge-category">{{ $produk->kategori->nama ?? 'Tanpa Kategori' }}</span>
                <h4 class="context-product-title">{{ $produk->nama }}</h4>
                <div class="context-meta">
                    <span class="meta-item"><i class="fa-solid fa-barcode"></i> {{ $produk->kode }}</span>
                    <span class="meta-item"><i class="fa-solid fa-tags"></i> Harga Dasar: <strong>Rp {{ number_format($produk->harga, 0, ',', '.') }}</strong></span>
                </div>
            </div>
        </div>
        
        <div class="total-variant-indicator">
            <span class="indicator-label">Total Kombinasi</span>
            <h3 class="indicator-value">{{ $varian->count() }} Varian</h3>
        </div>
    </div>

    <div class="custom-card">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">No</th>
                        <th>Ukuran / Size</th>
                        <th>Opsi Warna</th>
                        <th>Tingkat Stok</th>
                        <th>Harga Khusus Varian</th>
                        <th style="width: 120px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($varian as $item)
                    <tr>
                        <td style="text-align: center;" class="text-muted font-monospace">{{ $loop->iteration }}</td>

                        <td>
                            <span class="size-pill">
                                <i class="fa-solid fa-ruler-combined"></i> {{ $item->ukuran->nama ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <div class="color-flex-wrapper">
                                <span class="color-indicator-dot" style="background-color: {{ $item->warna->kode_warna ?? '#333' }};"></span>
                                <span class="color-name">{{ $item->warna->nama ?? '-' }}</span>
                            </div>
                        </td>

                        <td>
                            @if($item->stok > 10)
                                <span class="stock-badge stock-high"><i class="fa-solid fa-square-check"></i> {{ $item->stok }} Pcs</span>
                            @elseif($item->stok > 0)
                                <span class="stock-badge stock-warning"><i class="fa-solid fa-triangle-exclamation"></i> {{ $item->stok }} Pcs</span>
                            @else
                                <span class="stock-badge stock-empty"><i class="fa-solid fa-circle-xmark"></i> Habis</span>
                            @endif
                        </td>

                        <td>
                            @if($item->harga)
                                <span class="variant-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                            @else
                                <span class="price-parent-fallback">Mengikuti Harga Utama</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-buttons-wrapper">
                                <button type="button" 
                                        class="btn-edit-action btn-trigger-edit" 
                                        title="Ubah Parameter Varian"
                                        data-id="{{ $item->id }}"
                                        data-ukuran="{{ $item->ukuran_id }}"
                                        data-warna="{{ $item->warna_id }}"
                                        data-stok="{{ $item->stok }}"
                                        data-harga="{{ $item->harga }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <form action="{{ route('admin.produk-varian.destroy', $item->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-action btn-delete" title="Hapus Kombinasi Varian">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-variant-state">
                                <div class="empty-icon-wrapper"><i class="fa-solid fa-layer-group"></i></div>
                                <h4>Kombinasi Varian Belum Tersedia</h4>
                                <p>Produk ini belum memiliki pembagian ukuran atau warna spesifik. Klik tombol di kanan atas untuk membuat variasi produk.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="custom-modal-overlay" id="modalTambahVarian">
    <div class="custom-modal-box">
        <div class="modal-header">
            <h5 class="modal-box-title">Buat Varian Komponen</h5>
            <button type="button" class="btn-modal-close-icon">&times;</button>
        </div>
        <form action="{{ route('admin.produk-varian.store') }}" method="POST">
            @csrf
            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
            
            <div class="modal-body">
                <div class="form-group">
                    <label class="custom-form-label">Pilih Ukuran / Size</label>
                    <select name="ukuran_id" class="custom-input-field" required>
                        <option value="" disabled selected>-- Pilih Ukuran --</option>
                        @foreach($ukuran as $uk)
                            <option value="{{ $uk->id }}">{{ $uk->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="custom-form-label">Pilih Opsi Warna</label>
                    <select name="warna_id" class="custom-input-field" required>
                        <option value="" disabled selected>-- Pilih Warna --</option>
                        @foreach($warna as $wr)
                            <option value="{{ $wr->id }}">{{ $wr->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row-grid">
                    <div class="form-group">
                        <label class="custom-form-label">Jumlah Stok Awal</label>
                        <input type="number" name="stok" class="custom-input-field" min="0" placeholder="Contoh: 50" required>
                    </div>
                    <div class="form-group">
                        <label class="custom-form-label">Harga Spesifik (Opsional)</label>
                        <input type="number" name="harga" class="custom-input-field" min="0" placeholder="Kosongkan jika sama">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel">Batal</button>
                <button type="submit" class="btn-modal-submit">Simpan Varian</button>
            </div>
        </form>
    </div>
</div>

<div class="custom-modal-overlay" id="modalEditVarian">
    <div class="custom-modal-box">
        <div class="modal-header">
            <h5 class="modal-box-title">Perbarui Parameter Varian</h5>
            <button type="button" class="btn-modal-close-icon">&times;</button>
        </div>
        <form action="" method="POST" id="formEditVarianTarget">
            @csrf
            @method('PUT')
            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
            
            <div class="modal-body">
                <div class="form-group">
                    <label class="custom-form-label">Pilih Ukuran / Size</label>
                    <select name="ukuran_id" id="edit_ukuran_id" class="custom-input-field" required>
                        @foreach($ukuran as $uk)
                            <option value="{{ $uk->id }}">{{ $uk->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="custom-form-label">Pilih Opsi Warna</label>
                    <select name="warna_id" id="edit_warna_id" class="custom-input-field" required>
                        @foreach($warna as $wr)
                            <option value="{{ $wr->id }}">{{ $wr->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row-grid">
                    <div class="form-group">
                        <label class="custom-form-label">Alokasi Stok</label>
                        <input type="number" name="stok" id="edit_stok" class="custom-input-field" min="0" required>
                    </div>
                    <div class="form-group">
                        <label class="custom-form-label">Harga Khusus</label>
                        <input type="number" name="harga" id="edit_harga" class="custom-input-field" min="0" placeholder="Mengikuti harga utama">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel">Batal</button>
                <button type="submit" class="btn-modal-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<style>
/* ================= GLOBAL DESIGN SYSTEM (NORMAL CSS) ================= */
.varian-container {
    font-family: 'Poppins', sans-serif;
    padding: 24px 0;
    box-sizing: border-box;
}
.varian-container *, .custom-modal-overlay * {
    box-sizing: border-box;
}

/* BREADCRUMB */
.custom-breadcrumb {
    font-size: 13px;
    margin-bottom: 6px;
}
.custom-breadcrumb a {
    color: #8C6A2F;
    text-decoration: none;
}
.custom-breadcrumb .divider {
    color: #aaa;
    margin: 0 6px;
}
.custom-breadcrumb .active {
    color: #666;
}

/* PAGE HEADER */
.page-header-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 24px;
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

/* NAV ACTIONS BUTTONS */
.action-nav-buttons {
    display: flex;
    gap: 10px;
}
.btn-back-nav {
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
    cursor: pointer;
}
.btn-back-nav:hover {
    background: #8C6A2F;
    color: white;
    transform: translateX(-3px);
}
.btn-add-variant {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border: none;
    padding: 12px 22px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    font-size: 13.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.15);
    cursor: pointer;
}
.btn-add-variant:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.25);
}

/* DANGER ALERT BANNER */
.custom-alert-danger {
    background-color: #fdf2f2;
    border-radius: 16px;
    padding: 16px;
    margin-bottom: 24px;
}
.alert-title {
    color: #ec5b5b;
    font-weight: 700;
    font-size: 14px;
    margin: 0 0 8px 0;
}
.alert-title i { margin-right: 6px; }
.alert-list {
    margin: 0;
    padding-left: 20px;
    color: #555;
    font-size: 13px;
}

/* PRODUCT CONTEXT BANNER CARD */
.product-context-card {
    background: white;
    border-radius: 20px;
    padding: 16px 24px;
    border: 1px solid #f5efe2;
    box-shadow: 0 4px 15px rgba(0,0,0,0.01);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 24px;
}
.product-context-left {
    display: flex;
    align-items: center;
    gap: 16px;
}
.product-context-img {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    object-fit: cover;
    border: 1px solid #f3ead7;
}
.product-context-empty-img {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: #faf6ef;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #B68D40;
    font-size: 18px;
    border: 1px dashed #ebdcb9;
}
.product-context-info {
    display: flex;
    flex-direction: column;
}
.context-badge-category {
    background: #faf6ed;
    color: #8C6A2F;
    padding: 2px 10px;
    border-radius: 6px;
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    border: 1px solid #f4ebd6;
    width: max-content;
    margin-bottom: 4px;
}
.context-product-title {
    font-weight: 800;
    color: #1a1a1a;
    font-size: 18px;
    letter-spacing: -0.3px;
    margin: 0 0 4px 0;
}
.context-meta {
    font-size: 13px;
    color: #666;
}
.meta-item {
    margin-right: 16px;
}
.meta-item i {
    color: #888;
    margin-right: 4px;
}
.total-variant-indicator {
    background: #faf8f5;
    border: 1px solid #ebdcb9;
    padding: 10px 18px;
    border-radius: 12px;
    text-align: right;
}
.indicator-label {
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
    display: block;
    font-weight: 600;
}
.indicator-value {
    color: #8C6A2F;
    font-weight: 800;
    font-size: 16px;
    margin: 0;
}

/* MAIN CARD AND TABLE SCROLL */
.custom-card {
    background: white;
    border-radius: 24px;
    padding: 24px;
    border: 1px solid #f5efe2;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.02);
}
.table-responsive {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.custom-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}
.custom-table thead th {
    color: #555;
    font-weight: 700;
    font-size: 13.5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 16px 20px;
    background-color: #fafaf8;
    border: none;
}
.custom-table tbody tr {
    border-bottom: 1px solid #fcfbf9;
    transition: background 0.2s ease;
}
.custom-table tbody tr:hover {
    background: #fdfbf7;
}
.custom-table tbody td {
    padding: 16px 20px;
    vertical-align: middle;
}

/* DATA RENDERING CHIPS */
.size-pill {
    background: #f4f5f7;
    color: #495057;
    padding: 6px 14px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    border: 1px solid #e9ecef;
}
.color-flex-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}
.color-indicator-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    display: inline-block;
    border: 1px solid rgba(0,0,0,0.15);
}
.color-name {
    font-weight: 600;
    color: #333;
}

/* STOCK MATRIX STYLES */
.stock-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 12.5px;
    font-weight: 600;
}
.stock-high { background: #e8f8f5; color: #1abc9c; }
.stock-warning { background: #fff9e6; color: #f1c40f; }
.stock-empty { background: #fdf2f2; color: #ec5b5b; }

.variant-price {
    font-weight: 700;
    color: #222;
}
.price-parent-fallback {
    color: #888;
    font-size: 12.5px;
    font-style: italic;
}

/* ROW OPERATIONS CONTROLS BUTTONS */
.action-buttons-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
}
.delete-form {
    margin: 0;
    display: inline-block;
}
.btn-edit-action, .btn-delete-action {
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13.5px;
    transition: all 0.2s ease;
    cursor: pointer;
}
.btn-edit-action { background: #faf6ed; color: #B68D40; }
.btn-edit-action:hover { background: #8C6A2F; color: white; }
.btn-delete-action { background: #fff3f3; color: #e74c3c; }
.btn-delete-action:hover { background: #e74c3c; color: white; }

/* EMPTY DATA BLOCK GRAPHICS */
.empty-variant-state {
    text-align: center;
    padding: 40px 20px;
}
.empty-icon-wrapper {
    width: 70px;
    height: 70px;
    background: #faf6ed;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 30px;
    color: #B68D40;
    margin: 0 auto 16px;
}
.empty-variant-state h4 { font-weight: 700; font-size: 16px; color: #333; margin: 0 0 6px 0; }
.empty-variant-state p { font-size: 13.5px; max-width: 450px; margin: 0 auto; color: #777; line-height: 1.5; }

/* ================= THE NORMAL CSS POP-UP OVERLAY MODAL ================= */
.custom-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.45);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s ease;
}
/* Trigger aktif dari Javascript */
.custom-modal-overlay.is-open {
    opacity: 1;
    pointer-events: auto;
}
.custom-modal-box {
    background: white;
    border-radius: 24px;
    width: 100%;
    max-width: 480px;
    box-shadow: 0 15px 45px rgba(0,0,0,0.15);
    padding: 24px;
    transform: translateY(-20px);
    transition: transform 0.25s ease;
}
.custom-modal-overlay.is-open .custom-modal-box {
    transform: translateY(0);
}

/* MODAL SECTIONS PARTS */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.modal-box-title {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}
.btn-modal-close-icon {
    background: none;
    border: none;
    font-size: 24px;
    color: #aaa;
    cursor: pointer;
    line-height: 1;
}
.btn-modal-close-icon:hover { color: #333; }

.modal-body {
    margin-bottom: 24px;
}
.form-group {
    margin-bottom: 16px;
}
.form-row-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}
.custom-form-label {
    font-size: 12.5px;
    font-weight: 700;
    color: #444;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin-bottom: 6px;
    display: block;
}
.custom-input-field {
    width: 100%;
    border: 1px solid #ebdcb9;
    background-color: #faf8f5;
    border-radius: 12px;
    padding: 11px 16px;
    font-size: 14px;
    color: #333;
    outline: none;
    font-family: inherit;
    transition: all 0.2s ease;
}
.custom-input-field:focus {
    background-color: white;
    border-color: #8C6A2F;
    box-shadow: 0 0 0 3px rgba(140, 106, 47, 0.1);
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
.btn-modal-cancel {
    background: #f4f5f7;
    color: #6c757d;
    border: none;
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    cursor: pointer;
}
.btn-modal-cancel:hover { background: #e9ecef; color: #495057; }

.btn-modal-submit {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.15);
    cursor: pointer;
}
.btn-modal-submit:hover { box-shadow: 0 6px 18px rgba(140, 106, 47, 0.25); }

/* RESPONSIVE CSS MEDIA QUERIES */
@media(max-width: 768px) {
    .page-header-nav { flex-direction: column; align-items: flex-start; gap: 12px; }
    .action-nav-buttons, .btn-back-nav, .btn-add-variant { width: 100%; justify-content: center; }
    .product-context-card { flex-direction: column; align-items: flex-start; }
    .total-variant-indicator { text-align: left; width: 100%; }
    .form-row-grid { grid-template-columns: 1fr; gap: 16px; }
    .custom-modal-box { width: 92%; margin: 0 auto; }
}
</style>

<script>
// =========================================================================
// JAVASCRIPT LOGIC UNTUK BUKA/TUTUP POP-UP CSS MODAL
// =========================================================================
const modalTambah = document.getElementById('modalTambahVarian');
const modalEdit = document.getElementById('modalEditVarian');

// Buka Modal Tambah
document.getElementById('btnBukaTambah').addEventListener('click', () => {
    modalTambah.classList.add('is-open');
});

// Deteksi Seluruh Tombol Batal & Icon Silang di Semua Modal untuk Close
document.querySelectorAll('.btn-modal-cancel, .btn-modal-close-icon').forEach(closeBtn => {
    closeBtn.addEventListener('click', () => {
        modalTambah.classList.remove('is-open');
        modalEdit.classList.remove('is-open');
    });
});

// Klik di Luar Box Modal untuk Menutup Pop-Up
window.addEventListener('click', (e) => {
    if (e.target === modalTambah) modalTambah.classList.remove('is-open');
    if (e.target === modalEdit) modalEdit.classList.remove('is-open');
});

// Dynamic Data Injection saat Tombol Edit baris Tabel di-klik
document.querySelectorAll('.btn-trigger-edit').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const ukuranId = this.getAttribute('data-ukuran');
        const warnaId = this.getAttribute('data-warna');
        const stok = this.getAttribute('data-stok');
        const harga = this.getAttribute('data-harga');

        // Setel Action Form URL target update
        document.getElementById('formEditVarianTarget').setAttribute('action', `/admin/produk-varian/${id}`);

        // Isi form value modal edit
        document.getElementById('edit_ukuran_id').value = ukuranId;
        document.getElementById('edit_warna_id').value = warnaId;
        document.getElementById('edit_stok').value = stok;
        document.getElementById('edit_harga').value = (harga === 'null' || !harga) ? '' : harga;

        // Buka Pop-up Edit Modal
        modalEdit.classList.add('is-open');
    });
});

// =========================================================================
// INTERCEPTOR CONFIRMATION SWEETALERT HAPUS DATA
// =========================================================================
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();
        let form = this.closest('.delete-form');
        
        Swal.fire({
            title: 'Hapus varian produk?',
            text: "Kombinasi ukuran & warna spesifik ini akan dihapus permanen beserta data stoknya.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-4' }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@endsection