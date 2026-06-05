<!-- ================= COMMUNITY SECTION ================= -->
<section class="community-section">

    <div class="community-header">
        <div>
            <span class="community-badge">
                ✨ Fashion Community
            </span>
            <h2>
                Inspirasi Dari <span>Community</span>
            </h2>
            <p>
                Lihat style terbaik dari member Spill Outfit dan temukan inspirasi outfit favoritmu.
            </p>
        </div>
        <a href="{{ route('community.index') }}" class="btn-community">
            Explore Community
        </a>
    </div>

    <!-- GRID CONTROLLER -->
    <div class="row g-4">
        @forelse($posts as $post)
            {{-- Mengubah col-md-6 agar pembagian grid di tablet (iPad) terlihat jauh lebih simetris dan rapi --}}
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="community-card">

                    <!-- IMAGE BOX -->
                    <div class="community-image">
                        <a href="{{ route('community.show', $post->id) }}">
                            @if($post->gambar)
                                <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul ?? 'Outfit Image' }}">
                            @else
                                <div class="image-placeholder-fallback">
                                    <i class="fa-solid fa-shirt"></i>
                                </div>
                            @endif
                        </a>
                    </div>

                    <!-- CONTENT CARD -->
                    <div class="community-content">
                        
                        <!-- USER INFO -->
                        <div class="community-user">
                            @if($post->user?->profile?->foto)
                                <img src="{{ asset('storage/' . $post->user->profile->foto) }}" alt="Avatar Pengguna">
                            @else
                                <div class="avatar-initial-fallback">
                                    {{ strtoupper(substr($post->user?->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <h6>{{ $post->user?->name ?? 'User Fashion' }}</h6>
                                <small><i class="fa-regular fa-clock"></i> {{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>

                        <!-- TITLE & CAPTION -->
                        <a href="{{ route('community.show', $post->id) }}" class="card-text-link">
                            <h5>{{ $post->judul ?? 'Outfit Casual Style' }}</h5>
                            <p class="truncated-caption">
                                {{ $post->caption }}
                            </p>
                        </a>

                        <!-- FOOTER STATS -->
                        <div class="community-footer">
                            <div class="community-stats">
                                {{-- Ikon diganti ke Font Awesome v6 solid & regular agar serasi dengan halaman detail --}}
                                <span title="Likes" class="stat-item-like">
                                    <i class="fa-solid fa-heart"></i> 
                                    <span>{{ $post->total_like }}</span>
                                </span>
                                <span title="Komentar" class="stat-item-comment">
                                    <i class="fa-solid fa-comment"></i> 
                                    <span>{{ $post->total_comment }}</span>
                                </span>
                            </div>

                            <a href="{{ route('community.show', $post->id) }}" class="btn-view-post">
                                <span>Lihat</span>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <!-- BLANK DATA EMPTY STATE -->
            <div class="col-12 text-center py-5">
                <div class="empty-home-community">
                    <div class="empty-icon-box">
                        <i class="fa-solid fa-users-rectangle"></i>
                    </div>
                    <h5>Belum Ada Inspirasi Outfit</h5>
                    <p>Jadilah yang pertama membagikan style terbaikmu di dalam komunitas!</p>
                </div>
            </div>
        @endforelse
    </div>

</section>

<style>
/* ================= COMMUNITY SECTION BASE ================= */
.community-section {
    margin-top: 70px;
    font-family: 'Poppins', sans-serif;
}

/* HEADER DESCRIPTIONS */
.community-header {
    display: flex;
    justify-content: space-between;
    align-items: end;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 35px;
}

.community-badge {
    display: inline-flex;
    padding: 10px 18px;
    border-radius: 50px;
    background: #f8f4e7;
    color: #8C6A2F;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 18px;
}

.community-header h2 {
    font-size: 42px;
    font-weight: 700;
    color: #222;
    letter-spacing: -0.5px;
}

.community-header h2 span {
    color: #B68D40;
}

.community-header p {
    margin-top: 12px;
    max-width: 550px;
    color: #777;
    line-height: 1.9;
}

/* EXPLORE ACTION BUTTON */
.btn-community {
    text-decoration: none;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 15px 28px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.15);
}

.btn-community:hover {
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(140, 106, 47, 0.3);
}

/* FLEXIBLE GRID COMMUNITY CARD */
.community-card {
    background: white;
    border-radius: 32px;
    overflow: hidden;
    border: 1px solid #f5efe4;
    transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: 0 5px 20px rgba(0,0,0,0.01);
}

.community-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(140, 106, 47, 0.08);
    border-color: #e6dcbe;
}

/* POST CARDS IMAGE SCALING */
.community-image {
    height: 260px;
    overflow: hidden;
    position: relative;
    background: #faf8f5;
}

.community-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.community-card:hover .community-image img {
    transform: scale(1.05);
}

.image-placeholder-fallback {
    height: 100%;
    background: #faf8f5;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 48px;
    color: #C9A227;
}

/* WRAPPER CONTENT INNER CARD */
.community-content {
    padding: 26px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* PROFILE ACCOUNT METADATA */
.community-user {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
}

.community-user img, .avatar-initial-fallback {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
}

.avatar-initial-fallback {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.community-user h6 {
    margin: 0 0 3px 0;
    font-weight: 700;
    color: #2c2c2c;
    font-size: 14.5px;
}

.community-user small {
    color: #999;
    font-size: 11.5px;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* TYPOGRAPHY LINK ANCHOR */
.card-text-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.community-content h5 {
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 10px;
    font-size: 18px;
    line-height: 1.4;
    transition: color 0.2s ease;
}

.community-card:hover .community-content h5 {
    color: #8C6A2F;
}

.truncated-caption {
    color: #555;
    line-height: 1.7;
    font-size: 13.5px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 20px;
}

/* GRID INNER FOOTER ACTIONS & STATUS COUNTERS */
.community-footer {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1px dashed #ebdcb9;
}

.community-stats {
    display: flex;
    gap: 16px;
    color: #666;
    font-size: 13.5px;
    font-weight: 600;
}

.community-stats span {
    display: flex;
    align-items: center;
    gap: 6px;
}

.stat-item-like i {
    color: #e74c3c; /* Warna hati solid merah lembut agar tampak modern */
}

.stat-item-comment i {
    color: #8C6A2F;
}

/* CARD REDIRECT NAVIGATION BUTTON */
.btn-view-post {
    text-decoration: none;
    background: #faf6ed;
    color: #8C6A2F;
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}

.btn-view-post:hover {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    transform: translateX(2px);
}

/* FALLBACK FOR COMPLETELY EMPTY DB HOOKS */
.empty-home-community {
    padding: 50px 30px;
    background: #fdfcf9;
    border-radius: 28px;
    border: 2px dashed #ebdcb9;
    max-width: 500px;
    margin: 0 auto;
}

.empty-icon-box {
    width: 64px;
    height: 64px;
    background: rgba(140, 106, 47, 0.06);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    color: #8C6A2F;
    font-size: 26px;
}

.empty-home-community h5 {
    font-weight: 700;
    color: #333;
    margin-bottom: 6px;
}

.empty-home-community p {
    color: #777;
    font-size: 13.5px;
    margin: 0;
}

/* ==================================================================
   ================= RESPONSIVE MEDIA BREAKPOINTS ===================
   ================================================================== */
@media(max-width: 992px) {
    .community-image {
        height: 230px;
    }
}

@media(max-width: 768px) {
    .community-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .community-header h2 {
        font-size: 32px;
    }

    .btn-community {
        width: 100%;
        text-align: center;
    }

    .community-image {
        height: 220px;
    }
}
</style>