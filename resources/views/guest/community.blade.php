@extends('layouts.app')

@section('content')
@include('guest.partials.navbar')

<!-- ================= COMMUNITY SECTION ================= -->
<section class="community-section">

    <div class="container">

        <!-- HERO BRANDING -->
        <div class="community-hero">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="community-badge">
                        ✨ Fashion Community
                    </span>
                    <h1>
                        Temukan Inspirasi & <span>Komunitas Outfit</span>
                    </h1>
                    <p>
                        Jelajahi diskusi outfit, inspirasi fashion, rekomendasi style kampus, casual, hingga streetwear favorit dari komunitas Spill Outfit.
                    </p>
                    <div class="hero-btns">
                        <a href="{{ route('login') }}" class="btn-community">
                            <span>Join Community</span>
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </a>
                        <a href="#community-feed" class="btn-outline-community">
                            Lihat Preview Feed
                        </a>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="community-preview-card">
                        <h5><i class="fa-solid fa-fire text-warning me-2"></i> Trending Discussion</h5>
                        
                        <div class="discussion-item">
                            <div>
                                <h6>Outfit Kuliah Cowok Minimalis?</h6>
                                <small><i class="fa-regular fa-comment-dot"></i> 120 komentar</small>
                            </div>
                            <span class="trending-tag">#Campus</span>
                        </div>

                        <div class="discussion-item">
                            <div>
                                <h6>Rekomendasi Outfit Nongkrong</h6>
                                <small><i class="fa-regular fa-comment-dot"></i> 89 komentar</small>
                            </div>
                            <span class="trending-tag">#Casual</span>
                        </div>

                        <div class="discussion-item">
                            <div>
                                <h6>Streetwear Murah Tapi Keren?</h6>
                                <small><i class="fa-regular fa-comment-dot"></i> 65 komentar</small>
                            </div>
                            <span class="trending-tag">#Streetwear</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PILIHAN KATEGORI (VISUAL ONLY FOR GUEST) -->
        <div class="community-category">
            <button class="category-btn active">Semua</button>
            <button class="category-btn">Campus Style</button>
            <button class="category-btn">Casual</button>
            <button class="category-btn">Streetwear</button>
            <button class="category-btn">Formal</button>
            <button class="category-btn">Daily Outfit</button>
        </div>

        <!-- DYNAMIC PREVIEW FEED -->
        <div class="community-feed" id="community-feed">
            <div class="section-title">
                <h2>
                    Preview <span>Community Feed</span>
                </h2>
                <p>
                    Sebagai Guest, Anda hanya dapat melihat cuplikan. Silakan masuk akun untuk ikut berdiskusi penuh.
                </p>
            </div>

            <div class="row g-4 mt-2">
                {{-- Menampilkan data postingan asli dari database --}}
                @forelse($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="feed-card">
                            
                            <!-- HEADER USER CONTROLLER -->
                            <div class="feed-header">
                                @if($post->user?->profile?->foto)
                                    <img src="{{ asset('storage/' . $post->user->profile->foto) }}" alt="Avatar">
                                @else
                                    <div class="avatar-guest-fallback">
                                        {{ strtoupper(substr($post->user?->name ?? 'U', 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <h6>{{ $post->user?->name ?? 'User Fashion' }}</h6>
                                    <small><i class="fa-regular fa-clock"></i> {{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            </div>

                            <!-- IMAGES TARGET -->
                            <div class="feed-image">
                                @if($post->gambar)
                                    <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul ?? 'Outfit Style' }}">
                                @else
                                    <div class="feed-image-fallback">
                                        <i class="fa-solid fa-shirt"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- CAPTION CONTENT & LOCKED ACTIONS -->
                            <div class="feed-content">
                                <h5 class="feed-post-title">{{ $post->judul ?? 'Outfit Casual Style' }}</h5>
                                <p class="feed-truncated-text">
                                    {{ $post->caption }}
                                </p>
                                
                                <div class="feed-actions">
                                    <a href="{{ route('login') }}" class="action-stat-btn" title="Login untuk menyukai">
                                        <i class="fa-solid fa-heart me-1 text-danger"></i> 
                                        <span>{{ $post->total_like }}</span>
                                    </a>
                                    <a href="{{ route('login') }}" class="action-stat-btn" title="Login untuk berkomentar">
                                        <i class="fa-solid fa-comment me-1 text-secondary"></i> 
                                        <span>{{ $post->total_comment }}</span>
                                    </a>
                                    <a href="{{ route('login') }}" class="btn-detail-lock">
                                        <span>Detail</span>
                                        <i class="fa-solid fa-lock"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <!-- TAMPILAN JIKA DATA DATABASE MASIH KOSONG -->
                    <div class="col-12 text-center py-5">
                        <div class="empty-guest-box">
                            <i class="fa-solid fa-images"></i>
                            <h5>Belum Ada Postingan Publik</h5>
                            <p>Saat ini feed komunitas sedang diperbarui oleh para member.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- CALL TO ACTION (CTA) -->
        <div class="community-cta">
            <h2>Mau Ikut Diskusi Fashion?</h2>
            <p>
                Gabung sekarang juga bersama ratusan trendsetter lainnya di Spill Outfit. Bagikan gayamu dan dapatkan rating style terbaik dari pengguna lain.
            </p>
            <a href="{{ route('login') }}" class="btn-community">
                <span>Login Sekarang</span>
                <i class="fa-solid fa-circle-arrow-right"></i>
            </a>
        </div>

    </div>

</section>

<style>
/* ================= GLOBAL DESIGN SYSTEM ================= */
.content {
    margin-left: 40px;
    margin-right: 40px;
}

.community-section {
    padding: 110px 0 90px;
    background: #fff;
    font-family: 'Poppins', sans-serif;
}

/* HERO CONTAINER */
.community-hero {
    background: linear-gradient(180deg, #fff, #faf8f3);
    border: 1px solid #f3ead7;
    border-radius: 35px;
    padding: 60px;
}

.community-badge {
    display: inline-flex;
    padding: 10px 18px;
    border-radius: 50px;
    background: #f8f4e7;
    color: #8C6A2F;
    font-weight: 600;
    margin-bottom: 20px;
}

.community-hero h1 {
    font-size: 54px;
    font-weight: 800;
    line-height: 1.2;
    color: #222;
    letter-spacing: -1px;
}

.community-hero h1 span {
    color: #B68D40;
}

.community-hero p {
    margin-top: 20px;
    color: #666;
    line-height: 1.9;
    font-size: 15.5px;
}

.hero-btns {
    margin-top: 35px;
    display: flex;
    align-items: center;
    gap: 14px;
}

/* PREMIUM ACTION BUTTONS */
.btn-community {
    text-decoration: none;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 14.5px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s ease;
    border: none;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.2);
}

.btn-community:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.35);
}

.btn-outline-community {
    text-decoration: none;
    border: 1px solid #ebdcb9;
    background: #fff;
    padding: 15px 30px;
    border-radius: 50px;
    color: #8C6A2F;
    font-weight: 600;
    font-size: 14.5px;
    transition: all 0.2s ease;
}

.btn-outline-community:hover {
    background: #faf6ed;
    color: #614619;
}

/* TRENDING SIDE CARD */
.community-preview-card {
    background: white;
    border-radius: 30px;
    padding: 30px;
    border: 1px solid #f2ead8;
    box-shadow: 0 10px 30px rgba(0,0,0,0.01);
}

.community-preview-card h5 {
    font-weight: 700;
    color: #2c2c2c;
    margin-bottom: 10px;
}

.discussion-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 0;
    border-bottom: 1px solid #f8f5ee;
}

.discussion-item:last-child {
    border: none;
}

.discussion-item h6 {
    margin: 0 0 4px 0;
    font-weight: 700;
    color: #333;
    font-size: 14.5px;
}

.discussion-item small {
    color: #999;
    font-size: 12px;
}

.trending-tag {
    background: #f8f4e7;
    padding: 6px 14px;
    border-radius: 50px;
    color: #8C6A2F;
    font-size: 12px;
    font-weight: 600;
}

/* CATEGORY PILLS FILTER */
.community-category {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
    margin: 50px 0;
}

.category-btn {
    border: 1px solid #eee;
    background: #fdfdfd;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 14px;
    color: #555;
    transition: all 0.2s ease;
}

.category-btn.active, .category-btn:hover {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.15);
}

/* SECTION GLOBAL TITLE */
.section-title {
    text-align: center;
    margin-bottom: 30px;
}

.section-title h2 {
    font-size: 40px;
    font-weight: 800;
    letter-spacing: -0.5px;
}

.section-title span {
    color: #B68D40;
}

.section-title p {
    color: #777;
    font-size: 14.5px;
    max-width: 500px;
    margin: 8px auto 0;
}

/* VISUAL CARDS GRID FEED */
.feed-card {
    border: 1px solid #f2ead8;
    border-radius: 28px;
    overflow: hidden;
    background: white;
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.feed-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(140, 106, 47, 0.08);
}

.feed-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px;
}

.feed-header img, .avatar-guest-fallback {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
}

.avatar-guest-fallback {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.feed-header h6 {
    margin: 0 0 2px 0;
    font-weight: 700;
    color: #333;
    font-size: 14px;
}

.feed-header small {
    color: #999;
    font-size: 11px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.feed-image {
    height: 330px;
    background: #fdfcfb;
    position: relative;
    overflow: hidden;
}

.feed-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.feed-image-fallback {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 48px;
    color: #e3d9c3;
    background: #faf8f4;
}

.feed-content {
    padding: 22px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.feed-post-title {
    font-size: 16px;
    font-weight: 700;
    color: #222;
    margin-bottom: 8px;
}

.feed-truncated-text {
    color: #666;
    font-size: 13.5px;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 20px;
}

/* ACTIONS WITH COUNTERS */
.feed-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px dashed #f5efe2;
}

.action-stat-btn {
    text-decoration: none;
    color: #555;
    font-weight: 600;
    font-size: 13.5px;
    display: inline-flex;
    align-items: center;
}

.btn-detail-lock {
    text-decoration: none;
    background: #faf6ed;
    color: #8C6A2F;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 12.5px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
}

.btn-detail-lock:hover {
    background: #8C6A2F;
    color: white;
}

/* CALL TO ACTION ADVERTISEMENT BOX */
.community-cta {
    margin-top: 80px;
    text-align: center;
    border-radius: 35px;
    padding: 60px;
    background: linear-gradient(180deg, #faf8f3, #f5efdf);
    border: 1px solid #ebdcb9;
}

.community-cta h2 {
    font-weight: 800;
    font-size: 32px;
    color: #1a1a1a;
}

.community-cta p {
    max-width: 650px;
    margin: auto;
    margin-top: 15px;
    color: #555;
    font-size: 15px;
    line-height: 1.7;
}

.community-cta .btn-community {
    margin-top: 30px;
}

/* FALLBACK BLANK DATABASE BOX */
.empty-guest-box {
    padding: 60px 20px;
    border: 2px dashed #ebdcb9;
    border-radius: 24px;
    background: #faf8f5;
    max-width: 400px;
    margin: 20px auto;
}
.empty-guest-box i {
    font-size: 40px;
    color: #C9A227;
    margin-bottom: 12px;
}
.empty-guest-box h5 {
    font-weight: 700;
    color: #333;
}
.empty-guest-box p {
    color: #777;
    font-size: 13px;
    margin: 0;
}

/* ==================================================================
   ================= RESPONSIVE MEDIA BREAKPOINTS ===================
   ================================================================== */
@media(max-width:768px) {
    .community-section {
        padding-top: 90px;
    }

    .community-hero {
        padding: 35px;
    }

    .community-hero h1 {
        font-size: 36px;
    }

    .hero-btns {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-community, .btn-outline-community {
        justify-content: center;
    }
}
</style>

@include('guest.partials.footer')

@endsection