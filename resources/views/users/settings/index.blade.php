@extends('layouts.user')

@section('title', 'Settings')

@section('content')

<section class="settings-section">

    <div class="settings-header">
        <span>ACCOUNT SETTINGS</span>
        <h2>Kelola Profile Kamu ⚙️</h2>
        <p>Lengkapi profil agar checkout lebih cepat dan alamat pengiriman otomatis terisi saat melakukan pemesanan.</p>
    </div>

    @if($errors->any())
    <div class="alert-danger-custom">
        <i class="mdi mdi-alert-circle"></i>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert-success-custom">
        <i class="mdi mdi-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    <div class="settings-card">

        <form action="{{ route('settings.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="profile-area">
                <div class="profile-preview">
                    @if(auth()->user()->avatar)
                        {{-- Cek apakah foto dari Google Login (http) atau hasil upload lokal (asset storage) --}}
                        <img id="previewImage" 
                             src="{{ str_starts_with(auth()->user()->avatar, 'http') ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}" 
                             alt="Foto Profil">
                    @else
                        <img id="previewImage" 
                             src="https://api.dicebear.com/7.x/fun-emoji/svg?seed={{ urlencode(auth()->user()->name) }}" 
                             alt="Avatar Default">
                    @endif
                </div>

                <label class="upload-btn">
                    <i class="mdi mdi-camera"></i> Ganti Foto Profil
                    <input type="file"
                           name="foto"
                           id="fotoInput"
                           accept="image/png, image/jpeg, image/jpg"
                           hidden>
                </label>
                <small class="upload-tip">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
            </div>

            <div class="form-grid">

                <div class="input-group-custom">
                    <label for="name">Nama Lengkap</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ auth()->user()->name }}"
                           placeholder="Masukkan nama lengkap Anda"
                           required>
                </div>

                <div class="input-group-custom">
                    <label for="phone">Nomor HP / WhatsApp</label>
                    <input type="text"
                           name="phone"
                           id="phone"
                           value="{{ auth()->user()->phone }}"
                           placeholder="Contoh: 08XXXXXXXXXX">
                </div>

                <div class="input-group-custom">
                    <label for="provinsi">Provinsi</label>
                    <input type="text"
                           name="provinsi"
                           id="provinsi"
                           value="{{ auth()->user()->provinsi }}"
                           placeholder="Contoh: Jawa Barat">
                </div>

                <div class="input-group-custom">
                    <label for="kota">Kota / Kabupaten</label>
                    <input type="text"
                           name="kota"
                           id="kota"
                           value="{{ auth()->user()->kota }}"
                           placeholder="Contoh: Bekasi">
                </div>

                <div class="input-group-custom">
                    <label for="kode_pos">Kode Pos</label>
                    <input type="text"
                           name="kode_pos"
                           id="kode_pos"
                           value="{{ auth()->user()->kode_pos }}"
                           placeholder="Contoh: 17610">
                </div>

            </div>

            <div class="input-group-custom mt-3">
                <label for="alamat">Alamat Lengkap Rumah</label>
                <textarea name="alamat"
                          id="alamat"
                          placeholder="Masukkan alamat lengkap (Nama Jalan, RT/RW, No. Rumah, Patokan)">{{ auth()->user()->alamat }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="save-btn">
                    <i class="mdi mdi-content-save"></i> Simpan Perubahan Profil
                </button>
            </div>

        </form>

    </div>

</section>

<style>
/* ==========================================================================
   GLOBAL SETTINGS STYLE (MODERN & PREMIUM)
   ========================================================================== */

.settings-section {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

/* HEADER STYLE */
.settings-header {
    margin-bottom: 35px;
}

.settings-header span {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 100px;
    background: rgba(140, 106, 47, 0.12);
    color: #8C6A2F;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.settings-header h2 {
    font-size: 36px;
    font-weight: 800;
    color: #1a1a1a;
    margin: 12px 0 8px;
    letter-spacing: -0.5px;
}

.settings-header p {
    color: #666;
    font-size: 15px;
    line-height: 1.6;
}

/* ALERTS CUSTOM STYLE */
.alert-success-custom, .alert-danger-custom {
    padding: 16px 20px;
    border-radius: 16px;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
    font-size: 14px;
}

.alert-success-custom {
    background: #e8f7ed;
    color: #1e7e34;
    border: 1px solid #c3e6cb;
}

.alert-danger-custom {
    background: #fdf2f2;
    color: #d32f2f;
    border: 1px solid #fde2e2;
    align-items: flex-start;
    flex-direction: column;
    gap: 4px;
}

.alert-danger-custom ul {
    margin: 0;
    padding-left: 20px;
}

/* PREMIUM CONTAINER CARD */
.settings-card {
    background: #ffffff;
    border-radius: 24px;
    padding: 40px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 15px 45px rgba(140, 106, 47, 0.05);
    transition: transform 0.3s ease;
}

/* AVATAR UPLOAD COMPONENT */
.profile-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 35px;
    padding-bottom: 30px;
    border-bottom: 1px dashed #eee;
}

.profile-preview {
    position: relative;
}

.profile-preview img {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #ffffff;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    background: #fcfbf7;
    transition: transform 0.3s ease;
}

.profile-preview img:hover {
    transform: scale(1.03);
}

.upload-btn {
    margin-top: 15px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: #ffffff;
    padding: 10px 22px;
    border-radius: 100px;
    cursor: pointer;
    font-weight: 600;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.3);
    transition: all 0.3s ease;
}

.upload-btn:hover {
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.4);
    transform: translateY(-2px);
}

.upload-tip {
    font-size: 11px;
    color: #999;
    margin-top: 6px;
}

/* SMART FORM LAYOUT */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.input-group-custom {
    display: flex;
    flex-direction: column;
}

.input-group-custom label {
    margin-bottom: 8px;
    font-weight: 700;
    color: #333333;
    font-size: 14px;
}

.input-group-custom input,
.input-group-custom textarea {
    width: 100%;
    border: 1px solid #e2e8f0;
    outline: none;
    background: #fcfbfa;
    border-radius: 14px;
    padding: 14px 18px;
    color: #2d3748;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
}

.input-group-custom input:focus,
.input-group-custom textarea:focus {
    background: #ffffff;
    border-color: #8C6A2F;
    box-shadow: 0 0 0 4px rgba(140, 106, 47, 0.1);
}

.input-group-custom input::placeholder,
.input-group-custom textarea::placeholder {
    color: #a0aec0;
    font-weight: 400;
}

.input-group-custom textarea {
    resize: none;
    height: 120px;
    line-height: 1.5;
}

/* FOOTER ACTIONS */
.form-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #f1f1f1;
}

.save-btn {
    border: none;
    outline: none;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: #ffffff;
    padding: 14px 35px;
    border-radius: 100px;
    font-weight: 700;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.25);
    transition: all 0.3s ease;
}

.save-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(140, 106, 47, 0.35);
}

.save-btn:active {
    transform: translateY(0);
}

/* RESPONSIVE LAYOUT */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .settings-card {
        padding: 25px 20px;
        border-radius: 20px;
    }

    .settings-header h2 {
        font-size: 28px;
    }
    
    .form-actions {
        justify-content: center;
    }
    
    .save-btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validasi ukuran gambar di sisi client (Maks 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Maksimal batas ukuran adalah 2MB.');
            this.value = '';
            return;
        }
        
        // Buat live preview instan
        document.getElementById('previewImage').src = URL.createObjectURL(file);
    }
});
</script>

@endsection