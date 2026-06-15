@extends('layouts.admin')

@section('title', 'Pengaturan Toko')

@section('content')

<div class="container-fluid">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Pengaturan Sistem</h1>
            <p class="page-subtitle">Kelola informasi profil admin, kontak resmi operasional *Spill Outfit*, dan kredensial keamanan akun.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-custom alert-success mb-4" role="alert">
            <i class="fa-solid fa-circle-check alert-icon"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-custom alert-danger mb-4" role="alert">
            <i class="fa-solid fa-circle-xmark alert-icon"></i>
            <div>Periksa kembali inputan Anda. Ada beberapa data yang tidak valid.</div>
        </div>
    @endif

    <div class="custom-card">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                
                <div class="col-md-12">
                    <h5 class="section-form-title"><i class="fa-solid fa-store me-2"></i> Profil & Kontak Operasional</h5>
                    <hr class="form-divider">
                </div>

                <div class="col-md-6">
                    <label class="form-label custom-label">Nama Lengkap Administrator</label>
                    <input type="text" name="name" class="form-control custom-input @error('name') is-invalid @enderror" value="{{ old('name', $admin->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label custom-label">Email Log In Sistem</label>
                    <input type="email" name="email" class="form-control custom-input @error('email') is-invalid @enderror" value="{{ old('email', $admin->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label custom-label">Nomor Hotline Toko (WhatsApp)</label>
                    <input type="text" name="phone" class="form-control custom-input @error('phone') is-invalid @enderror" value="{{ old('phone', $admin->phone) }}" placeholder="Contoh: 08123456789">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label custom-label">Alamat Rumah Produksi / Gudang Asal</label>
                    <textarea name="alamat" class="form-control custom-input @error('alamat') is-invalid @enderror" rows="1" placeholder="Lokasi pengiriman titik asal kurir...">{{ old('alamat', $admin->alamat) }}</textarea>
                    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>


                <div class="col-md-12 mt-5">
                    <h5 class="section-form-title"><i class="fa-solid fa-lock me-2"></i> Perbarui Kata Sandi <small class="text-muted" style="font-size: 12px; font-weight: 400;">(Kosongkan jika tidak ingin diubah)</small></h5>
                    <hr class="form-divider">
                </div>

                <div class="col-md-6">
                    <label class="form-label custom-label">Password Baru</label>
                    <input type="password" name="password" class="form-control custom-input @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter unik">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label custom-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="Ulangi ketik password baru">
                </div>

                <div class="col-md-12 text-end mt-4">
                    <button type="submit" class="btn-save-settings">
                        <i class="fa-solid fa-floppy-disk me-1.5"></i> Simpan Konfigurasi
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<style>
.container-fluid { font-family: 'Poppins', sans-serif; }
.page-title { font-size: 28px; font-weight: 800; color: #1a1a1a; margin: 0 0 6px 0; letter-spacing: -0.5px; }
.page-subtitle { margin: 0; color: #777; font-size: 14px; }

/* CARD BASE FORM BLOCK */
.custom-card { background: white; border-radius: 28px; padding: 32px; border: 1px solid #f5efe2; box-shadow: 0 10px 30px rgba(140, 106, 47, 0.02); }
.section-form-title { font-size: 16px; font-weight: 700; color: #8C6A2F; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; }
.form-divider { border-top: 1px solid #f3ead8; margin-top: 10px; opacity: 1; }

/* FORM FIELD INPUT CONTROLS */
.custom-label { font-size: 13.5px; font-weight: 600; color: #444; margin-bottom: 8px; }
.custom-input { background: #faf8f5; border: 1px solid #ebdcb9 !important; padding: 12px 16px; border-radius: 12px; font-size: 14px; color: #222; transition: all 0.2s; }
.custom-input:focus { background: white; border-color: #8C6A2F !important; box-shadow: 0 0 0 3px rgba(140, 106, 47, 0.1) !important; }

/* ACTION BUTTON */
.btn-save-settings {
    background: linear-gradient(135deg, #8C6A2F, #C9A227); color: white; border: none; padding: 14px 32px;
    border-radius: 14px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(140, 106, 47, 0.2);
}
.btn-save-settings:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(140, 106, 47, 0.3); }

/* ALERTS NOTIFICATION CONTROL */
.alert-custom { padding: 14px 20px; border-radius: 16px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 12px; border: 1px solid transparent; }
.alert-success { background: #e8f8f5; color: #1abc9c; border-color: #d1f2eb; }
.alert-danger { background: #fdf2f2; color: #e74c3c; border-color: #fde8e8; }
</style>

@endsection