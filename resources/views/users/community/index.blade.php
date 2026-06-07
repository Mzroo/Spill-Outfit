@extends('layouts.user')

@section('title', 'Community')

@section('content')

<section class="community-section">

    <div class="community-header">
        <div class="header-text">
            <span class="community-badge">OUTFIT INSPO</span>
            <h2>Spill Outfit Community 🔥</h2>
            <p>Bagikan style terbaikmu, cari inspirasi outfit harian, dan terhubung dengan sesama pencinta fashion modern.</p>
        </div>
        
        <div class="top-community-action">
            <a href="{{ route('community.create') }}" class="create-post-btn">
                <i class="fa-solid fa-plus"></i>
                <span>Buat Postingan</span>
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="success-alert">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="post-wrapper">

        @forelse($posts as $post)
        <div class="post-card">
            
            <div class="image-container-block">
                <a href="{{ route('community.show', $post->id) }}" class="card-image-link">
                    @if($post->gambar)
                        <img src="{{ asset('storage/' . $post->gambar) }}" class="post-image" alt="Outfit Image">
                    @else
                        <div class="image-placeholder">
                            <i class="fa-solid fa-shirt"></i>
                        </div>
                    @endif
                </a>

                <div class="post-user-overlay">
                    <div class="avatar-circle">
                        {{-- DISESUAIKAN: Membaca langsung dari kolom avatar tabel users & support login Google --}}
                        @if($post->user?->avatar)
                            <img src="{{ str_starts_with($post->user->avatar, 'http') ? $post->user->avatar : asset('storage/' . $post->user->avatar) }}" alt="Profile">
                        @else
                            {{ strtoupper(substr($post->user?->name ?? 'U', 0, 1)) }}
                        @endif
                    </div>
                    <div class="user-meta-info">
                        <h5>{{ $post->user?->name }}</h5>
                        <small>{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>

            <div class="post-content">
                <a href="{{ route('community.show', $post->id) }}" class="card-text-link">
                    @if($post->judul)
                        <h3 class="post-title">{{ $post->judul }}</h3>
                    @endif
                    <p class="post-caption">{{ $post->caption }}</p>
                </a>
            </div>

            <div class="post-action-footer">
                <form action="{{ route('community.like', $post->id) }}" method="POST" class="like-form">
                    @csrf
                    
                    {{-- DISESUAIKAN: Mengecek status aktif like berdasarkan array JSON liked_by_users --}}
                    @php
                        $isLiked = auth()->check() && in_array(auth()->id(), $post->liked_by_users ?? []);
                    @endphp

                    <button type="submit" class="action-btn-item btn-like {{ $isLiked ? 'has-liked' : '' }}" title="{{ $isLiked ? 'Batal Suka' : 'Suka' }}">
                        <i class="{{ $isLiked ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                        <span>{{ $post->total_like }}</span>
                    </button>
                </form>

                <a href="{{ route('community.show', $post->id) }}" class="action-btn-item btn-comment" title="Komentar">
                    <i class="fa-regular fa-comment"></i>
                    <span>{{ $post->total_comment }}</span>
                </a>
            </div>

        </div>
        @empty
        <div class="empty-community-state">
            <div class="blank-icon-box">
                <i class="fa-solid fa-users"></i>
            </div>
            <h3>Belum Ada Postingan</h3>
            <p>Jadilah trendsetter pertama yang membagikan ide spill outfit kecemu di sini! 🔥</p>
            <a href="{{ route('community.create') }}" class="create-post-btn" style="margin-top: 20px;">
                <i class="fa-solid fa-plus"></i> Mulai Post Sekarang
            </a>
        </div>
        @endforelse

    </div>

</section>

<style>
/* ================= UTILITIES & GLOBAL COMMUNITY STYLE ================= */
.community-section {
    max-width: 1300px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
}

/* Badge Header Gradasi */
.community-badge {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 50px;
    background: linear-gradient(135deg, rgba(140, 106, 47, 0.1), rgba(201, 162, 39, 0.1));
    color: #8C6A2F;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 12px;
}

/* ================= COMMUNITY HEADER FLEX ================= */
.community-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 45px;
    gap: 30px;
    border-bottom: 1px solid #f1f1f1;
    padding-bottom: 30px;
}

.header-text {
    max-width: 700px;
}

.community-header h2 {
    font-size: 42px;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 10px 0;
    letter-spacing: -0.5px;
}

.community-header p {
    color: #666;
    font-size: 15px;
    line-height: 1.6;
    margin: 0;
}

/* Tombol Floating / Tambah Postingan */
.create-post-btn {
    text-decoration: none;
    color: white;
    font-weight: 600;
    font-size: 14px;
    border-radius: 14px;
    padding: 14px 24px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.25);
    transition: all 0.3s ease;
    white-space: nowrap;
}

.create-post-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(140, 106, 47, 0.35);
}

/* Alert Box */
.success-alert {
    background: #eef9f1;
    border-left: 4px solid #2ecc71;
    color: #1e7e34;
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    font-weight: 500;
}

.success-alert i {
    font-size: 18px;
}

/* ================= GRID DECK SYSTEM ================= */
.post-wrapper {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
}

/* ================= PREMIUM POST CARD STYLE ================= */
.post-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
    border: 1px solid #f5f5f5;
    display: flex;
    flex-direction: column;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.post-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(140, 106, 47, 0.1);
    border-color: rgba(201, 162, 39, 0.15);
}

/* Media/Image Area */
.image-container-block {
    position: relative;
    width: 100%;
    height: 320px;
    overflow: hidden;
    background-color: #fcfbf9;
}

.card-image-link {
    display: block;
    width: 100%;
    height: 100%;
}

.post-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.post-card:hover .post-image {
    transform: scale(1.04);
}

.image-placeholder {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fdfaf2;
    color: #C9A227;
    font-size: 54px;
}

/* Glassmorphism User Tag Overlay */
.post-user-overlay {
    position: absolute;
    top: 15px;
    left: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    padding: 6px 14px;
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.4);
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    max-width: 85%;
}

.avatar-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 11px;
    font-weight: 700;
    color: white;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    flex-shrink: 0;
}

.avatar-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-meta-info {
    overflow: hidden;
}

.user-meta-info h5 {
    margin: 0;
    color: #2c2c2c;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-meta-info small {
    font-size: 9.5px;
    color: #777;
    display: block;
}

/* Typography Content Area */
.post-content {
    padding: 20px;
    flex: 1;
}

.card-text-link {
    text-decoration: none;
    display: block;
}

.post-title {
    color: #1a1a1a;
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 8px 0;
    line-height: 1.4;
    transition: color 0.2s;
}

.post-card:hover .post-title {
    color: #8C6A2F;
}

.post-caption {
    color: #666;
    line-height: 1.6;
    font-size: 13.5px;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Interactive Footer Action Controls */
.post-action-footer {
    display: flex;
    gap: 12px;
    padding: 0 20px 20px;
}

.like-form {
    flex: 1;
}

.action-btn-item {
    width: 100%;
    border: 1px solid #f1ebdc;
    background: #fdfcf9;
    border-radius: 12px;
    padding: 10px 14px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    text-decoration: none;
    color: #555;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-comment {
    width: auto;
    padding: 10px 18px;
}

/* Hover States Efektif */
.btn-like:hover, .btn-like.has-liked {
    background: #fff5f5;
    border-color: #ffccd5;
    color: #e74c3c;
}

.btn-comment:hover {
    background: #f0f7ff;
    border-color: #cce5ff;
    color: #3498db;
}

/* ================= BLANK STATE DESIGN ================= */
.empty-community-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    background: #faf8f5;
    border-radius: 24px;
    border: 2px dashed #eadecc;
}

.blank-icon-box {
    width: 70px;
    height: 70px;
    background: rgba(140, 106, 47, 0.08);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.blank-icon-box i {
    font-size: 32px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.empty-community-state h3 {
    font-size: 20px;
    font-weight: 700;
    color: #2c2c2c;
    margin: 0 0 8px 0;
}

.empty-community-state p {
    color: #777;
    font-size: 14px;
    max-width: 340px;
    margin: 0 auto;
    line-height: 1.5;
}

/* ================= MEDIA BREAKPOINT RESPONSIVE INTERFACES ================= */
@media(max-width: 1200px) {
    .post-wrapper {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    .community-header h2 { font-size: 36px; }
}

@media(max-width: 900px) {
    .post-wrapper {
        grid-template-columns: repeat(2, 1fr);
    }
    .community-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }
    .top-community-action {
        width: 100%;
    }
    .create-post-btn {
        width: 100%;
        justify-content: center;
    }
}

@media(max-width: 576px) {
    .post-wrapper {
        grid-template-columns: 1fr;
    }
    .community-header h2 { font-size: 30px; }
    .image-container-block { height: 280px; }
}
</style>

@endsection