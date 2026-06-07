@extends('layouts.user')

@section('title', 'Buat Postingan')

@section('content')

<section class="community-create-section">

    <div class="create-header-nav">
        <a href="{{ route('community.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left-long"></i>
            <span>Kembali ke Komunitas</span>
        </a>
    </div>

    <div class="create-split-card">
        
        <form action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data" class="split-form-wrapper">
            @csrf

            <div class="form-media-left">
                <div class="interactive-preview-box">
                    <img id="previewImage" src="https://placehold.co/800x1000/faf8f3/8C6A2F?text=Belum+Ada+Foto" alt="Spill Outfit Preview">
                    
                    <div class="upload-overlay-guide" id="uploadOverlay">
                        <div class="guide-content">
                            <div class="icon-circle">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>
                            <h5>Pilih Foto Outfit Terbaikmu</h5>
                            <p>Mendukung format JPG, PNG atau WEBP</p>
                        </div>
                    </div>
                </div>

                <label class="custom-upload-trigger">
                    <i class="fa-solid fa-images"></i>
                    <span>Pilih Berkas Foto</span>
                    <input type="file" name="gambar" id="gambarInput" accept="image/png, image/jpeg, image/jpg, image/webp" hidden required>
                </label>
                
                {{-- Validasi Error Server-Side untuk Gambar --}}
                @error('gambar')
                    <span class="error-msg-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-inputs-right">
                <div class="input-section-header">
                    <h2>Spill Outfit Baru ✨</h2>
                    <p>Bagikan perpaduan style, detail brand, atau inspirasi estetik fashion harianmu ke semua orang.</p>
                </div>

                <div class="fields-stack">
                    <div class="custom-input-group">
                        <label for="judul">
                            Judul Postingan <span class="optional-tag">(Opsional)</span>
                        </label>
                        <div class="input-field-wrapper @error('judul') border-danger-mode @enderror">
                            <i class="fa-solid fa-heading field-decorator"></i>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Contoh: Streetwear Retro Style">
                        </div>
                        @error('judul')
                            <span class="error-msg-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="custom-input-group">
                        <label for="caption">Caption Cerita / Detail Style</label>
                        <div class="input-field-wrapper textarea-mode @error('caption') border-danger-mode @enderror">
                            <i class="fa-solid fa-quote-left field-decorator"></i>
                            <textarea name="caption" id="caption" placeholder="Spill brand kemeja, celana, atau kombinasinya di sini agar komunitas terinspirasi..." required>{{ old('caption') }}</textarea>
                        </div>
                        @error('caption')
                            <span class="error-msg-feedback"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="action-submit-row">
                    <button type="submit" class="premium-submit-btn">
                        <span>Posting Sekarang</span>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>

</section>

<style>
/* ================= GLOBAL BASE & CONFIG ================= */
.community-create-section {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
}

/* Back Navigation Link */
.create-header-nav {
    margin-bottom: 25px;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: #8C6A2F;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    padding: 6px 0;
}

.back-btn:hover {
    color: #C9A227;
    transform: translateX(-4px);
}

/* ================= THE TWO-COLUMN SPLIT CARD ================= */
.create-split-card {
    background: white;
    border-radius: 32px;
    box-shadow: 0 15px 45px rgba(0, 0, 0, 0.04);
    border: 1px solid #f6f5f0;
    overflow: hidden;
}

.split-form-wrapper {
    display: grid;
    grid-template-columns: 460px 1fr; /* Sisi kiri berukuran tetap, kanan fleksibel */
}

/* ================= 1. LEFT SIDE: VISUAL MEDIA COMPONENT ================= */
.form-media-left {
    background: #faf8f5;
    padding: 35px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
    border-right: 1px solid #f3eee3;
}

/* Wadah Pratinjau Gambar */
.interactive-preview-box {
    position: relative;
    width: 100%;
    height: 480px;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.03);
    background: #fdfcfb;
    border: 2px dashed #e8e2d5;
}

.interactive-preview-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Penunjuk Overlay Sebelum Upload */
.upload-overlay-guide {
    position: absolute;
    inset: 0;
    background: rgba(253, 250, 244, 0.92);
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 25px;
    transition: opacity 0.3s ease;
    pointer-events: none; /* Klik tembus ke label/input */
}

.guide-content .icon-circle {
    width: 64px;
    height: 64px;
    background: rgba(140, 106, 47, 0.08);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    color: #8C6A2F;
    font-size: 24px;
}

.guide-content h5 {
    margin: 0 0 6px 0;
    font-size: 15px;
    font-weight: 700;
    color: #2c2c2c;
}

.guide-content p {
    margin: 0;
    font-size: 12px;
    color: #888;
}

/* Tombol Pilih File */
.custom-upload-trigger {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
    padding: 14px 28px;
    border-radius: 14px;
    background: #f4eee1;
    color: #8C6A2F;
    font-weight: 600;
    font-size: 14px;
    width: 100%;
    text-align: center;
    transition: all 0.2s ease;
}

.custom-upload-trigger:hover {
    background: #ebdcb9;
    color: #614619;
}

/* ================= 2. RIGHT SIDE: INPUT FORM COMPONENT ================= */
.form-inputs-right {
    padding: 45px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.input-section-header {
    margin-bottom: 30px;
}

.input-section-header h2 {
    font-size: 32px;
    font-weight: 800;
    color: #1a1a1a;
    letter-spacing: -0.5px;
    margin: 0 0 8px 0;
}

.input-section-header p {
    color: #666;
    font-size: 14.5px;
    line-height: 1.6;
    margin: 0;
}

.fields-stack {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

/* Desain Kelompok Input */
.custom-input-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.custom-input-group label {
    font-size: 14px;
    font-weight: 700;
    color: #333;
}

.optional-tag {
    font-size: 12px;
    color: #999;
    font-weight: 400;
}

/* Pembungkus Kolom Ketik & Dekorator Ikon */
.input-field-wrapper {
    display: flex;
    align-items: center;
    background: #faf8f4;
    border: 1px solid #efebe0;
    border-radius: 14px;
    padding: 0 18px;
    transition: all 0.2s ease;
}

.input-field-wrapper:focus-within {
    background: white;
    border-color: #8C6A2F;
    box-shadow: 0 0 0 4px rgba(140, 106, 47, 0.1);
}

.field-decorator {
    color: #a89f8c;
    font-size: 16px;
    margin-right: 14px;
}

.input-field-wrapper input {
    width: 100%;
    border: none;
    outline: none;
    background: transparent;
    padding: 16px 0;
    font-size: 14px;
    color: #333;
    font-family: inherit;
}

/* Setelan Khusus Textarea */
.input-field-wrapper.textarea-mode {
    align-items: flex-start;
    padding: 16px 18px;
}

.input-field-wrapper.textarea-mode .field-decorator {
    margin-top: 3px;
}

.input-field-wrapper textarea {
    width: 100%;
    border: none;
    outline: none;
    background: transparent;
    resize: none;
    height: 140px;
    font-size: 14px;
    color: #333;
    font-family: inherit;
    line-height: 1.7;
}

/* FEEDBACK ERROR DEKORATOR */
.border-danger-mode {
    border-color: #e74c3c !important;
    background: #fff8f8 !important;
}

.error-msg-feedback {
    color: #e74c3c;
    font-size: 12px;
    font-weight: 600;
    margin-top: 2px;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Tombol Publikasikan Premium */
.action-submit-row {
    margin-top: 35px;
    display: flex;
    justify-content: flex-end;
}

.premium-submit-btn {
    border: none;
    outline: none;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 16px 36px;
    border-radius: 14px;
    font-size: 15px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    box-shadow: 0 5px 20px rgba(140, 106, 47, 0.25);
    transition: all 0.2s ease;
}

.premium-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(140, 106, 47, 0.35);
}

/* ==================================================================
   ================= RESPONSIVE MEDIA BREAKPOINTS ===================
   ================================================================== */

@media(max-width: 992px) {
    .split-form-wrapper {
        grid-template-columns: 1fr; /* Menjadi 1 kolom di tablet */
    }

    .form-media-left {
        border-right: none;
        border-bottom: 1px solid #f3eee3;
        padding: 30px;
    }

    .interactive-preview-box {
        height: 380px; /* Sedikit penyesuaian tinggi */
    }

    .form-inputs-right {
        padding: 35px;
    }
}

@media(max-width: 576px) {
    .community-create-section {
        margin: 20px auto;
    }

    .create-split-card {
        border-radius: 24px;
    }

    .form-inputs-right {
        padding: 25px;
    }

    .input-section-header h2 {
        font-size: 26px;
    }

    .interactive-preview-box {
        height: 280px;
    }

    .premium-submit-btn {
        width: 100%; /* Tombol memenuhi layar di HP */
        justify-content: center;
    }
}
</style>

<script>
const gambarInput = document.getElementById('gambarInput');
const uploadOverlay = document.getElementById('uploadOverlay');
const previewImage = document.getElementById('previewImage');

gambarInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // VALIDASI CLIENT-SIDE: Proteksi Maksimal Gambar 3MB (Sesuai validasi Controller)
        if (file.size > 3 * 1024 * 1024) {
            alert('Ukuran file foto terlalu besar! Batas maksimal adalah 3MB.');
            this.value = ''; // Reset input berkas
            return;
        }

        // Jalankan pratinjau instan jika lolos validasi ukuran
        previewImage.src = URL.createObjectURL(file);
        uploadOverlay.style.opacity = '0';
    }
});
</script>

@endsection