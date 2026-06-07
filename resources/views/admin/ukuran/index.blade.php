@extends('layouts.admin')

@section('title', 'Manajemen Ukuran')

@section('content')

<div class="container-fluid">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Manajemen Ukuran</h1>
            <p class="page-subtitle">Kelola daftar variasi ukuran standar produk outfit beserta status aktifnya.</p>
        </div>

        <a href="{{ route('admin.ukuran.create') }}" class="btn-add">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Ukuran</span>
        </a>
    </div>

    <div class="utility-bar mb-4">
        <form action="{{ route('admin.ukuran.index') }}" method="GET" class="search-form">
            <div class="search-input-group">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input 
                    type="text" 
                    name="search" 
                    class="form-control custom-search-input" 
                    placeholder="Cari berdasarkan nama ukuran, kode size, atau keterangan..."
                    value="{{ request('search') }}"
                >
                @if(request('search'))
                    <a href="{{ route('admin.ukuran.index') }}" class="btn-clear-search" title="Hapus Pencarian">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
                <button type="submit" class="btn-search-submit">Cari</button>
            </div>
        </form>
    </div>

    <div class="custom-card">
        <div class="table-responsive">
            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th width="70" class="text-center">No</th>
                        <th width="140">Kode</th>
                        <th>Nama Ukuran</th>
                        <th>Keterangan</th>
                        <th width="120" class="text-center">Status</th>
                        <th width="150" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ukuran as $item)
                    <tr>
                        <td class="text-center text-muted font-monospace">
                            {{ ($ukuran->currentPage() - 1) * $ukuran->perPage() + $loop->iteration }}
                        </td>

                        <td>
                            <span class="code-badge">
                                <i class="fa-solid fa-tag me-1" style="font-size: 11px;"></i>{{ $item->kode }}
                            </span>
                        </td>

                        <td>
                            <span class="size-name-text">{{ $item->nama }}</span>
                        </td>

                        <td class="text-muted">
                            {{ $item->keterangan ?? '-' }}
                        </td>

                        <td class="text-center">
                            @if($item->status == 'aktif')
                                <span class="status-badge status-active">
                                    <i class="fa-solid fa-circle-check me-1"></i>Aktif
                                </span>
                            @else
                                <span class="status-badge status-inactive">
                                    <i class="fa-solid fa-circle-minus me-1"></i>Nonaktif
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="action-buttons justify-content-end">
                                <a href="{{ route('admin.ukuran.edit', $item->id) }}" class="btn-edit" title="Ubah Ukuran">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('admin.ukuran.destroy', $item->id) }}" method="POST" class="delete-form d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ukuran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Hapus Ukuran">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon-wrapper">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                                <h3>Data Ukuran Kosong</h3>
                                <p>
                                    @if(request('search'))
                                        Tidak ditemukan standar ukuran dengan kata kunci "{{ request('search') }}". Coba cari kata kunci lainnya.
                                    @else
                                        Belum ada data variasi ukuran produk yang tersimpan di database.
                                    @endif
                                </p>
                                @if(request('search'))
                                    <a href="{{ route('admin.ukuran.index') }}" class="btn-add m-auto mt-3" style="width: max-content;">
                                        <i class="fa-solid fa-rotate-left"></i> Kembali ke Semua Data
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($ukuran->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
                <div class="text-muted" style="font-size: 13px;">
                    Menampilkan {{ $ukuran->firstItem() ?? 0 }} sampai {{ $ukuran->lastItem() ?? 0 }} dari {{ $ukuran->total() }} data ukuran.
                </div>
                <div class="custom-pagination-wrapper">
                    {{ $ukuran->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

<style>
/* ================= TYPOGRAPHY & COLOR MANAGEMENT ================= */
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

/* ================= ACTION ADD BUTTON ================= */
.btn-add {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    text-decoration: none;
    padding: 14px 24px;
    border-radius: 18px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: none;
    box-shadow: 0 6px 15px rgba(140, 106, 47, 0.15);
}

.btn-add:hover {
    transform: translateY(-2px);
    color: white;
    box-shadow: 0 10px 22px rgba(140, 106, 47, 0.3);
}

/* ================= SEARCH UTILITY BAR ================= */
.utility-bar {
    background: white;
    border-radius: 20px;
    padding: 16px;
    border: 1px solid #f5efe2;
    box-shadow: 0 4px 15px rgba(0,0,0,0.01);
}

.search-input-group {
    display: flex;
    align-items: center;
    position: relative;
    background: #faf8f5;
    border-radius: 14px;
    padding: 4px;
    border: 1px solid #ebdcb9;
}

.search-icon {
    position: absolute;
    left: 18px;
    color: #8C6A2F;
    font-size: 15px;
}

.custom-search-input {
    border: none !important;
    background: transparent !important;
    padding: 10px 10px 10px 48px;
    font-size: 14px;
    color: #333;
    box-shadow: none !important;
    width: 100%;
}

.custom-search-input::placeholder {
    color: #aaa;
}

.btn-clear-search {
    background: none;
    border: none;
    color: #999;
    padding: 10px;
    margin-right: 5px;
    transition: color 0.2s ease;
}

.btn-clear-search:hover {
    color: #e74c3c;
}

.btn-search-submit {
    background: #8C6A2F;
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 13.5px;
    transition: background 0.2s ease;
}

.btn-search-submit:hover {
    background: #6b4f20;
}

/* ================= DATATABLE CONTAINER ================= */
.custom-card {
    background: white;
    border-radius: 28px;
    padding: 24px;
    border: 1px solid #f5efe2;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.03);
}

.custom-table thead tr {
    border-bottom: 2px solid #f5efe2;
}

.custom-table thead th {
    border: none;
    color: #555;
    font-weight: 700;
    font-size: 13.5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 16px 20px;
    background-color: #fafaf8;
}

.custom-table tbody tr {
    border-bottom: 1px solid #fcfbf9;
    transition: background 0.2s ease;
}

.custom-table tbody tr:hover {
    background: #fdfbf7;
}

.custom-table tbody td {
    padding: 18px 20px;
    border: none;
}

/* ================= COMPONENT INNER BADGES ================= */
.code-badge {
    background: #faf6ed;
    color: #8C6A2F;
    padding: 6px 14px;
    border-radius: 10px;
    font-size: 12.5px;
    font-weight: 700;
    font-family: 'Poppins', sans-serif;
    border: 1px solid #f4ebd6;
    display: inline-flex;
    align-items: center;
    white-space: nowrap;
    width: max-content;
    max-width: 100%;
}

.size-name-text {
    font-weight: 700;
    color: #222;
    font-size: 15px;
}

/* Style .order-badge dihapus dari CSS karena komponennya sudah tidak digunakan */

/* STATUS CHIPS */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
}

.status-active {
    background: #e8f8f5;
    color: #1abc9c;
}

.status-inactive {
    background: #fef9e7;
    color: #f39c12;
}

/* BUTTON CONTROLS ACTION */
.action-buttons {
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-edit, .btn-delete {
    width: 42px;
    height: 42px;
    border: none;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    transition: all 0.2s ease;
}

.btn-edit {
    background: #faf6ed;
    color: #B68D40;
    text-decoration: none;
}

.btn-delete {
    background: #fff3f3;
    color: #e74c3c;
}

.btn-edit:hover {
    background: #8C6A2F;
    color: white;
}

.btn-delete:hover {
    background: #e74c3c;
    color: white;
}

/* ================= EMPTY STATE ================= */
.empty-state {
    padding: 60px 20px;
    text-align: center;
    max-width: 450px;
    margin: auto;
}

.empty-icon-wrapper {
    width: 80px;
    height: 80px;
    background: #faf6ed;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 36px;
    color: #B68D40;
    margin: 0 auto 20px;
}

.empty-state h3 {
    font-weight: 700;
    font-size: 20px;
    color: #333;
}

.empty-state p {
    color: #777;
    font-size: 14px;
    margin-bottom: 0;
}

/* ================= BOOTSTRAP PAGINATION CUSTOMIZATION ================= */
.custom-pagination-wrapper .pagination {
    margin: 0;
    justify-content: flex-end;
    gap: 4px;
}

.custom-pagination-wrapper .page-item .page-link {
    border-radius: 10px;
    border: 1px solid #f5efe2;
    color: #555;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 600;
    background-color: #fff;
    transition: all 0.2s ease;
}

.custom-pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #8C6A2F, #C9A227) !important;
    border-color: transparent !important;
    color: white !important;
}

.custom-pagination-wrapper .page-item .page-link:hover {
    background-color: #faf6ed;
    color: #8C6A2F;
    border-color: #ebdcb9;
}

/* ================= MOBILE MEDIA BREAKPOINTS ================= */
@media(max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
    }

    .btn-add {
        width: 100%;
        justify-content: center;
    }
    
    .search-input-group {
        flex-direction: column;
        gap: 10px;
        background: transparent;
        border: none;
        padding: 0;
    }
    
    .custom-search-input {
        background: #faf8f5 !important;
        border: 1px solid #ebdcb9 !important;
        border-radius: 12px;
    }
    
    .btn-search-submit {
        width: 100%;
        padding: 12px;
        border-radius: 12px;
    }
}
</style>

@endsection