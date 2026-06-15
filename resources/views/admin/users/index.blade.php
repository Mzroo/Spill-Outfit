@extends('layouts.admin')

@section('title', 'Manajemen Users')

@section('content')

<div class="container-fluid">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Kelola Data Users</h1>
            <p class="page-subtitle">Manajemen hak akses otoritas, status blokir suspensi, kontrol data akun customer dan staf.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn-add">
            <i class="fa-solid fa-user-plus"></i>
            <span>Tambah User Manual</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-custom alert-success mb-4" role="alert">
            <i class="fa-solid fa-circle-check alert-icon"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-custom alert-danger mb-4" role="alert">
            <i class="fa-solid fa-circle-exclamation alert-icon"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <div class="utility-bar mb-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="search-form">
            <div class="search-input-group">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input 
                    type="text" 
                    name="search" 
                    class="form-control custom-search-input" 
                    placeholder="Cari berdasarkan nama, email, atau kode unik user..."
                    value="{{ request('search') }}"
                >
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn-clear-search" title="Hapus Pencarian">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
                <button type="submit" class="btn-search-submit">Cari User</button>
            </div>
        </form>
    </div>

    <div class="custom-card">
        <div class="table-responsive">
            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th width="160">Kode User</th>
                        <th>Profil Pengguna</th>
                        <th>Alamat Email</th>
                        <th width="140">Hak Akses</th>
                        <th width="180" class="text-center">Status Akun</th>
                        <th width="150" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="font-monospace">
                            <span class="code-badge">
                                <i class="fa-solid fa-id-badge me-1.5"></i>{{ $user->user_code ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle-preview">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span class="user-name-text">{{ $user->name }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="email-text text-muted">{{ $user->email }}</span>
                        </td>

                        <td>
                            <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}">
                                <i class="fa-solid {{ $user->role === 'admin' ? 'fa-user-shield' : 'fa-user' }} me-1.5"></i>{{ strtoupper($user->role) }}
                            </span>
                        </td>

                        <td class="text-center">
                            <form action="{{ route('admin.users.toggle-status', ['user' => $user->id]) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="status-action-btn {{ $user->is_active ? 'status-active' : 'status-inactive' }}" title="Klik untuk mengubah suspensi akun">
                                    <span class="status-pulse-dot"></span>
                                    <span>{{ $user->is_active ? 'Aktif' : 'Nonaktif (Blokir)' }}</span>
                                </button>
                            </form>
                        </td>

                        <td>
                            <div class="action-buttons justify-content-end">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit" title="Ubah Data Pengguna">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Hapus User Permanen">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon-wrapper">
                                    <i class="fa-solid fa-users-slash"></i>
                                </div>
                                <h3>Data User Tidak Ditemukan</h3>
                                <p>
                                    @if(request('search'))
                                        Tidak ditemukan entitas user atau customer dengan kata kunci "{{ request('search') }}". Coba periksa kembali ejaan Anda.
                                    @else
                                        Belum ada data customer atau pengguna baru yang terdaftar di sistem database.
                                    @endif
                                </p>
                                @if(request('search'))
                                    <a href="{{ route('admin.users.index') }}" class="btn-add m-auto mt-3" style="width: max-content;">
                                        <i class="fa-solid fa-rotate-left"></i> Atur Ulang Filter
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
                <div class="text-muted" style="font-size: 13px;">
                    Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} record user.
                </div>
                <div class="custom-pagination-wrapper">
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

<style>
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

/* ================= PREMIUM REUSABLE BUTTON ================= */
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

/* ================= UTILITY FILTER SEARCH BAR ================= */
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

/* ================= MODERN CARD TABLE CONTAINER ================= */
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

/* ================= INTERNAL CELL BADGE ELEMENTS ================= */
.code-badge {
    background: #faf6ed;
    color: #8C6A2F;
    padding: 6px 14px;
    border-radius: 10px;
    font-size: 12.5px;
    font-weight: 700;
    border: 1px solid #f4ebd6;
    display: inline-flex;
    align-items: center;
    white-space: nowrap;
}

.avatar-circle-preview {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #f4ebd6;
    color: #8C6A2F;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 0.5px;
    border: 1px solid #ebdcb9;
}

.user-name-text {
    font-weight: 700;
    color: #222;
    font-size: 15px;
}

.email-text {
    font-size: 14px;
    font-weight: 500;
}

/* AUTH ACCESS ROLE BADGES */
.role-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 10px;
    font-size: 11.5px;
    font-weight: 700;
}

.role-admin {
    background: #f3e8ff;
    color: #7e22ce;
}

.role-user {
    background: #e0f2fe;
    color: #0369a1;
}

/* MODERN FORM TOGGLE ACTION CHIPS */
.status-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    border: 1px solid transparent;
    cursor: pointer;
    transition: all 0.2s ease;
}

.status-pulse-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
}

.status-active {
    background: #e8f8f5;
    color: #1abc9c;
    border-color: #d1f2eb;
}
.status-active .status-pulse-dot {
    background: #1abc9c;
}
.status-active:hover {
    background: #d1f2eb;
}

.status-inactive {
    background: #fdf2f2;
    color: #ec5858;
    border-color: #fde2e2;
}
.status-inactive .status-pulse-dot {
    background: #ec5858;
}
.status-inactive:hover {
    background: #fde2e2;
}

/* CONTROL OPERATOR BUTTONS */
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

/* ================= CUSTOM ALERTS BOOTSTRAP ================= */
.alert-custom {
    padding: 14px 20px;
    border-radius: 16px;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
    border: 1px solid transparent;
}
.alert-success {
    background: #e8f8f5;
    color: #1abc9c;
    border-color: #d1f2eb;
}
.alert-danger {
    background: #fdf2f2;
    color: #ec5858;
    border-color: #fde2e2;
}
.alert-icon {
    font-size: 16px;
}

/* ================= DATA EMPTY STATE ================= */
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

/* ================= PAGINATION BOOTSTRAP CUSTOM CODES ================= */
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

/* ================= MOBILE MEDIA LAYOUT RESPONSIBILITY ================= */
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