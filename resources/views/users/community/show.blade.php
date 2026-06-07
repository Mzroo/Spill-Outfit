@extends('layouts.user')

@section('title', 'Detail Community')

@section('content')

<section class="community-show-section">

    <div class="back-navigation">
        <a href="{{ route('community.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left-long"></i>
            <span>Kembali ke Komunitas</span>
        </a>
    </div>

    @if(session('success'))
    <div class="success-alert">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="post-detail-card">
        
        <div class="post-user-header">
            <div class="user-avatar-wrapper">
                {{-- DISESUAIKAN: Membaca avatar langsung dari tabel users --}}
                @if($post->user?->avatar)
                    <img src="{{ str_starts_with($post->user->avatar, 'http') ? $post->user->avatar : asset('storage/' . $post->user->avatar) }}" alt="Profile User">
                @else
                    <div class="avatar-initials">
                        {{ strtoupper(substr($post->user?->name ?? 'U', 0, 1)) }}
                    </div>
                @endif
            </div>

            <div class="user-meta">
                <h4>{{ $post->user?->name }}</h4>
                <p><i class="fa-regular fa-clock"></i> {{ $post->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <div class="post-main-content">
            @if($post->judul)
                <h2 class="post-title">{{ $post->judul }}</h2>
            @endif
            <p class="post-caption">{{ $post->caption }}</p>
        </div>

        @if($post->gambar)
        <div class="post-image-container">
            <img src="{{ asset('storage/' . $post->gambar) }}" class="post-image-src" alt="Spill Outfit Picture">
        </div>
        @endif

        <div class="post-actions-bar">
            <form action="{{ route('community.like', $post->id) }}" method="POST" class="like-form-wrapper">
                @csrf
                
                {{-- DISESUAIKAN: Cek status tombol berdasarkan Array JSON liked_by_users --}}
                @php
                    $isLiked = auth()->check() && in_array(auth()->id(), $post->liked_by_users ?? []);
                @endphp

                <button type="submit" class="interaction-btn btn-like-action {{ $isLiked ? 'has-liked' : '' }}" title="{{ $isLiked ? 'Batal Suka' : 'Suka Postingan' }}">
                    <i class="{{ $isLiked ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                    <span>{{ $post->total_like }} Likes</span>
                </button>
            </form>

            <div class="interaction-btn btn-comment-static">
                <i class="fa-regular fa-comment"></i>
                <span>{{ $post->total_comment }} Komentar</span>
            </div>
        </div>

    </div>

    <div class="comment-card-panel">
        
        <div class="panel-header">
            <h3>Diskusi & Komentar</h3>
            <span class="comment-count-badge">{{ $post->total_comment }}</span>
        </div>

        <form action="{{ route('community.comment', $post->id) }}" method="POST" class="comment-write-form">
            @csrf
            <div class="textarea-wrapper">
                <textarea name="comment" placeholder="Berikan tanggapan atau tanyakan brand outfit ini..." required rows="3"></textarea>
            </div>
            <div class="form-action-row">
                <button type="submit" class="btn-submit-comment">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Kirim Komentar</span>
                </button>
            </div>
        </form>

        <div class="comments-timeline">

            @forelse($post->comments as $comment)
            <div class="comment-thread-item">
                
                <div class="comment-user-node">
                    <div class="comment-avatar">
                        {{-- DISESUAIKAN: Avatar komentator langsung dari tabel users --}}
                        @if($comment->user?->avatar)
                            <img src="{{ str_starts_with($comment->user->avatar, 'http') ? $comment->user->avatar : asset('storage/' . $comment->user->avatar) }}" alt="Comment User Avatar">
                        @else
                            <div class="avatar-initials-small">
                                {{ strtoupper(substr($comment->user?->name ?? 'U', 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div class="comment-meta-node">
                        <h5>{{ $comment->user?->name }}</h5>
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                </div>

                <div class="comment-bubble-text">
                    <p>{{ $comment->comment }}</p>
                </div>

            </div>
            @empty
            <div class="empty-comment-placeholder">
                <div class="placeholder-icon">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <h4>Belum ada diskusi</h4>
                <p>Ketikkan sesuatu di atas dan jadilah orang pertama yang mengapresiasi style ini!</p>
            </div>
            @endforelse

        </div>

    </div>

</section>

<style>
/* ================= GLOBAL WRAPPER ================= */
.community-show-section {
    max-width: 840px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
}

/* ================= NAVIGATION BACK ================= */
.back-navigation {
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
    padding: 8px 0;
}

.back-btn:hover {
    color: #C9A227;
    transform: translateX(-4px);
}

/* ================= NOTIFICATION BANNER ================= */
.success-alert {
    background: #eef9f1;
    border-left: 4px solid #2ecc71;
    color: #1e7e34;
    padding: 16px 20px;
    border-radius: 14px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14.5px;
    font-weight: 500;
    box-shadow: 0 4px 15px rgba(0,0,0,0.01);
}

/* ================= 1. POST DETAIL BASE CARD ================= */
.post-detail-card {
    background: white;
    border-radius: 24px;
    padding: 35px;
    margin-bottom: 30px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03);
    border: 1px solid #f6f6f6;
}

/* User Header Card */
.post-user-header {
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 1px solid #f8f6f0;
    padding-bottom: 20px;
    margin-bottom: 25px;
}

.user-avatar-wrapper, .avatar-initials {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.user-avatar-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-initials {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 20px;
}

.user-meta h4 {
    margin: 0 0 4px 0;
    color: #2c2c2c;
    font-size: 16px;
    font-weight: 700;
}

.user-meta p {
    margin: 0;
    font-size: 12px;
    color: #888;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Typography Content */
.post-main-content {
    margin-bottom: 25px;
}

.post-title {
    font-size: 26px;
    font-weight: 800;
    color: #1a1a1a;
    line-height: 1.4;
    margin: 0 0 12px 0;
}

.post-caption {
    color: #4a4a4a;
    line-height: 1.8;
    font-size: 15px;
    margin: 0;
    white-space: pre-line;
}

/* Image Display Box */
.post-image-container {
    width: 100%;
    border-radius: 20px;
    overflow: hidden;
    margin-top: 25px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.04);
    background-color: #fdfcf9;
}

.post-image-src {
    width: 100%;
    height: auto;
    max-height: 600px;
    object-fit: cover;
    display: block;
}

/* Action Controls Grid */
.post-actions-bar {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #f8f6f0;
}

.like-form-wrapper {
    flex: 1;
}

.interaction-btn {
    width: 100%;
    border: 1px solid #f1ebdc;
    background: #fdfcf9;
    color: #555;
    border-radius: 14px;
    padding: 14px 24px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.2s ease;
}

.btn-comment-static {
    width: auto;
    cursor: default;
    background: #fdfcf9;
    padding: 14px 28px;
}

/* MODIFIKASI: Aksen hover dan status tombol ketika sudah disukai */
.btn-like-action:hover, .btn-like-action.has-liked {
    background: #fff5f5;
    border-color: #ffccd5;
    color: #e74c3c;
}

/* ================= 2. DISCUSSION & COMMENT PANEL ================= */
.comment-card-panel {
    background: white;
    border-radius: 24px;
    padding: 35px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03);
    border: 1px solid #f6f6f6;
}

.panel-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
}

.panel-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #2c2c2c;
}

.comment-count-badge {
    background: rgba(140, 106, 47, 0.1);
    color: #8C6A2F;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 30px;
}

/* Form Write Styles */
.comment-write-form {
    margin-bottom: 35px;
}

.textarea-wrapper {
    background: #faf8f3;
    border-radius: 16px;
    padding: 5px;
    border: 1px solid #efeae0;
    transition: all 0.2s ease;
}

.textarea-wrapper:focus-within {
    background: white;
    border-color: #C9A227;
    box-shadow: 0 0 0 4px rgba(201, 162, 39, 0.1);
}

.comment-write-form textarea {
    width: 100%;
    border: none;
    outline: none;
    resize: none;
    background: transparent;
    padding: 15px;
    font-size: 14px;
    color: #333;
    font-family: inherit;
    line-height: 1.6;
}

.form-action-row {
    display: flex;
    justify-content: flex-end;
    margin-top: 15px;
}

.btn-submit-comment {
    border: none;
    outline: none;
    color: white;
    padding: 14px 28px;
    border-radius: 14px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.2);
    transition: all 0.2s ease;
}

.btn-submit-comment:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.3);
}

/* Comment Thread Component Feed */
.comments-timeline {
    display: flex;
    flex-direction: column;
}

.comment-thread-item {
    border-top: 1px solid #f8f6f0;
    padding: 25px 0 10px 0;
}

.comment-user-node {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.comment-avatar, .avatar-initials-small {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.comment-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-initials-small {
    background: #f4eee1;
    color: #8C6A2F;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
}

.comment-meta-node h5 {
    margin: 0 0 2px 0;
    font-size: 13.5px;
    font-weight: 600;
    color: #2c2c2c;
}

.comment-meta-node small {
    font-size: 11px;
    color: #999;
}

.comment-bubble-text {
    padding-left: 52px; /* Sejajar dengan teks nama di samping avatar */
}

.comment-bubble-text p {
    margin: 0;
    color: #555;
    font-size: 14px;
    line-height: 1.7;
}

/* Empty Placeholder System */
.empty-comment-placeholder {
    text-align: center;
    padding: 50px 20px;
    color: #888;
}

.placeholder-icon {
    width: 60px;
    height: 60px;
    background: rgba(140, 106, 47, 0.06);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.placeholder-icon i {
    font-size: 26px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.empty-comment-placeholder h4 {
    font-size: 16px;
    font-weight: 700;
    color: #333;
    margin: 0 0 6px 0;
}

.empty-comment-placeholder p {
    font-size: 13px;
    color: #777;
    margin: 0;
}

/* ==================================================================
   ================= RESPONSIVE MEDIA BREAKPOINTS ===================
   ================================================================== */

@media(max-width: 768px) {
    .community-show-section {
        margin: 20px auto;
    }

    .post-detail-card, .comment-card-panel {
        padding: 20px;
        border-radius: 20px;
    }

    .post-title {
        font-size: 22px;
    }

    .post-caption {
        font-size: 14px;
    }

    .post-actions-bar {
        flex-direction: column; /* Tombol bertumpuk di HP agar rapi */
        gap: 12px;
    }

    .btn-comment-static {
        justify-content: center;
        padding: 14px;
    }

    .comment-bubble-text {
        padding-left: 0; /* Kembalikan ruang penuh di layar HP */
        margin-top: 10px;
    }

    .btn-submit-comment {
        width: 100%; /* Tombol kirim full width di HP */
        justify-content: center;
    }
}
</style>

@endsection