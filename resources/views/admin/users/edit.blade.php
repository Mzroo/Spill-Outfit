@extends('layouts.admin')

@section('title', 'Edit Data Pengguna')

@section('content')

<div class="container-fluid">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Edit Data Pengguna</h1>
            <p class="page-subtitle">Perbarui informasi profil, ubah hak akses otoritas, atau sesuaikan status suspensi akun.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left-long"></i>
            <span>Kembali ke List</span>
        </a>
    </div>

    <div class="custom-card max-width-form m-auto">
        
        <div class="user-code-banner mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-circle-large">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <span class="banner-label">Identitas Unik Pengguna</span>
                    <h2 class="banner-code-text font-monospace">{{ $user->user_code ?? '-' }}</h2>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label class="custom-form-label">Nama Lengkap</label>
                <div class="input-group-custom @error('name') input-error @enderror">
                    <i class="fa-solid fa-user input-icon"></i>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="custom-form-control" placeholder="Masukkan nama lengkap..." required>
                </div>
                @error('name') <span class="form-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-4">
                <label class="custom-form-label">Alamat Email</label>
                <div class="input-group-custom @error('email') input-error @enderror">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="custom-form-control" placeholder="nama@email.com" required>
                </div>
                @error('email') <span class="form-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-4">
                <label class="custom-form-label">Password Baru <span class="text-optional">(Opsional)</span></label>
                <div class="input-group-custom @error('password') input-error @enderror">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" name="password" class="custom-form-control" placeholder="Kosongkan jika tidak ingin diganti">
                </div>
                <small class="form-text-hint">Isi kolom ini hanya jika Anda ingin mengubah sandi masuk user tersebut.</small>
                @error('password') <span class="form-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-4">
                <label class="custom-form-label">Hak Akses (Otoritas)</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-user-shield input-icon"></i>
                    <select name="role" class="custom-form-control-select">
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User Biasa (Customer)</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-5">
                <label class="custom-form-label">Status Akun</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-toggle-on input-icon"></i>
                    <select name="is_active" class="custom-form-control-select">
                        <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>Aktif (Diberikan Akses)</option>
                        <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>Nonaktif (Blokir / Suspensi)</option>
                    </select>
                </div>
            </div>

            <div class="form-actions flex-wrap gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                    Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk me-1.5"></i> Perbarui Data Pengguna
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.container-fluid {
    font-family: 'Poppins', sans-serif;
}

.max-width-form {
    max-width: 580px;
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

/* ================= COMPONENT BUTTONS ================= */
.btn-back {
    background: #faf6ed;
    color: #B68D40;
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
    border-color: transparent;
}

/* ================= MODERN FORM CARD CONTAINER ================= */
.custom-card {
    background: white;
    border-radius: 28px;
    padding: 30px;
    border: 1px solid #f5efe2;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.03);
}

/* USER CODE BANNER TOP */
.user-code-banner {
    background: #faf8f5;
    border: 1px solid #ebdcb9;
    padding: 16px 20px;
    border-radius: 18px;
}

.avatar-circle-large {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 0.5px;
}

.banner-label {
    display: block;
    font-size: 11px;
    color: #8C6A2F;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 2px;
}

.banner-code-text {
    font-size: 18px;
    font-weight: 800;
    color: #222;
    margin: 0;
}

/* ================= FORM LAYOUT FIELDS ================= */
.custom-form-label {
    display: block;
    font-weight: 700;
    color: #444;
    font-size: 13.5px;
    margin-bottom: 8px;
}

.text-optional {
    color: #aaa;
    font-weight: 500;
    font-size: 12px;
}

.form-text-hint {
    display: block;
    color: #888;
    font-size: 11.5px;
    margin-top: 6px;
}

/* STYLE INTERNAL INPUT GROUPS WITH ICONS */
.input-group-custom {
    display: flex;
    align-items: center;
    position: relative;
    background: #faf8f5;
    border-radius: 14px;
    border: 1px solid #ebdcb9;
    transition: all 0.2s ease;
}

.input-icon {
    position: absolute;
    left: 16px;
    color: #8C6A2F;
    font-size: 14px;
}

.custom-form-control, .custom-form-control-select {
    border: none !important;
    background: transparent !important;
    padding: 12px 16px 12px 44px;
    font-size: 14px;
    color: #222;
    box-shadow: none !important;
    width: 100%;
    font-weight: 500;
}

.custom-form-control-select {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%238C6A2F' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 16px center !important;
    background-size: 12px 12px !important;
}

/* FOCUS STATES */
.input-group-custom:focus-within {
    border-color: #8C6A2F;
    box-shadow: 0 0 0 3px rgba(140, 106, 47, 0.1);
    background: #fff;
}

/* ERROR VALIDATIONS WRAPPERS */
.input-error {
    border-color: #ec5858 !important;
    background: #fff3f3;
}
.input-error .input-icon {
    color: #ec5858;
}
.form-error-msg {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    color: #ec5858;
    font-size: 12px;
    font-weight: 600;
    margin-top: 6px;
}

/* ================= SUBMIT / CANCEL CONTROL BUTTONS ================= */
.form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.btn-cancel {
    background: #f5f5f5;
    color: #666;
    text-decoration: none;
    padding: 13px 26px;
    border-radius: 14px;
    font-weight: 600;
    font-size: 14px;
    transition: background 0.2s ease;
    border: none;
}
.btn-cancel:hover {
    background: #e9e9e9;
    color: #333;
}

.btn-submit {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 13px 26px;
    border-radius: 14px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 6px 15px rgba(140, 106, 47, 0.15);
}
.btn-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(140, 106, 47, 0.25);
}

/* RESPONSIVE LAYOUT */
@media(max-width: 576px) {
    .custom-card {
        padding: 20px;
        border-radius: 20px;
    }
    .form-actions {
        flex-direction: column-reverse;
    }
    .btn-cancel, .btn-submit {
        width: 100%;
        text-align: center;
        justify-content: center;
    }
}
</style>

@endsection