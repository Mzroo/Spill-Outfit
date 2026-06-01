@extends('layouts.user')

@section('title', 'Detail Community')

@section('content')

<section class="community-show-section">

    <!-- BACK -->
    <a
        href="{{ route('community.index') }}"
        class="back-btn"
    >
        <i class="fa-solid fa-arrow-left"></i>
        Kembali
    </a>

    <!-- ALERT -->
    @if(session('success'))

    <div class="success-alert">

        <i class="fa-solid fa-circle-check"></i>

        {{ session('success') }}

    </div>

    @endif

    <!-- POST CARD -->
    <div class="post-detail-card">

        <!-- USER -->
        <div class="post-user">

            <div class="avatar">

                @if($post->user?->profile?->foto)

                    <img
                        src="{{ asset('storage/' . $post->user->profile->foto) }}"
                        alt=""
                    >

                @else

                    {{ strtoupper(substr($post->user?->name ?? 'U',0,1)) }}

                @endif

            </div>

            <div>

                <h4>
                    {{ $post->user?->name }}
                </h4>

                <small>
                    {{ $post->created_at->diffForHumans() }}
                </small>

            </div>

        </div>

        <!-- TITLE -->
        @if($post->judul)

        <h2 class="post-title">
            {{ $post->judul }}
        </h2>

        @endif

        <!-- CAPTION -->
        <p class="post-caption">
            {{ $post->caption }}
        </p>

        <!-- IMAGE -->
        @if($post->gambar)

        <img
            src="{{ asset('storage/' . $post->gambar) }}"
            class="post-image"
            alt=""
        >

        @endif

        <!-- ACTION -->
        <div class="post-actions">

            <!-- LIKE -->
            <form
                action="{{ route('community.like', $post->id) }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="action-btn"
                >
                    <i class="fa-solid fa-heart"></i>

                    {{ $post->total_like }}
                    Likes
                </button>

            </form>

            <!-- COMMENT TOTAL -->
            <div class="action-btn">

                <i class="fa-solid fa-comment"></i>

                {{ $post->total_comment }}
                Komentar

            </div>

        </div>

    </div>

    <!-- COMMENT -->
    <div class="comment-card">

        <h3>
            Komentar
        </h3>

        <!-- FORM -->
        <form
            action="{{ route('community.comment', $post->id) }}"
            method="POST"
            class="comment-form"
        >

            @csrf

            <textarea
                name="comment"
                placeholder="Tulis komentar..."
                required
            ></textarea>

            <button type="submit">

                <i class="fa-solid fa-paper-plane"></i>

                Kirim Komentar

            </button>

        </form>

        <!-- COMMENT LIST -->
        <div class="comment-list">

            @forelse($post->comments as $comment)

            <div class="comment-item">

                <div class="comment-user">

                    <div class="avatar small-avatar">

                        @if($comment->user?->profile?->foto)

                            <img
                                src="{{ asset('storage/' . $comment->user->profile->foto) }}"
                                alt=""
                            >

                        @else

                            {{ strtoupper(substr($comment->user?->name ?? 'U',0,1)) }}

                        @endif

                    </div>

                    <div>

                        <h5>
                            {{ $comment->user?->name }}
                        </h5>

                        <small>
                            {{ $comment->created_at->diffForHumans() }}
                        </small>

                    </div>

                </div>

                <p class="comment-text">
                    {{ $comment->comment }}
                </p>

            </div>

            @empty

            <div class="empty-comment">

                <i class="fa-solid fa-comments"></i>

                <h4>
                    Belum ada komentar
                </h4>

                <p>
                    Jadilah orang pertama yang berkomentar.
                </p>

            </div>

            @endforelse

        </div>

    </div>

</section>

<style>

.community-show-section{
    max-width:900px;
    margin:auto;
}

/* BACK */

.back-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    margin-bottom:25px;
    text-decoration:none;
    color:#8C6A2F;
    font-weight:700;
}

/* ALERT */

.success-alert{
    background:#dff5e5;
    color:#1d6b3c;
    padding:18px 22px;
    border-radius:20px;
    margin-bottom:25px;

    display:flex;
    align-items:center;
    gap:12px;
}

/* CARD */

.post-detail-card,
.comment-card{
    background:white;
    border-radius:30px;
    padding:30px;
    margin-bottom:25px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.05);
}

/* USER */

.post-user,
.comment-user{
    display:flex;
    gap:15px;
    align-items:center;
}

.avatar{
    width:60px;
    height:60px;
    border-radius:50%;
    overflow:hidden;

    display:flex;
    justify-content:center;
    align-items:center;

    font-weight:700;
    color:white;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
}

.avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.small-avatar{
    width:50px;
    height:50px;
}

/* CONTENT */

.post-title{
    margin:20px 0;
}

.post-caption{
    color:#555;
    line-height:1.9;
}

.post-image{
    width:100%;
    border-radius:25px;
    margin-top:25px;
}

/* ACTION */

.post-actions{
    display:flex;
    gap:15px;
    margin-top:20px;
}

.action-btn{
    border:none;
    background:#f8f5ed;
    color:#8C6A2F;
    border-radius:999px;
    padding:14px 22px;
    font-weight:600;
    cursor:pointer;

    display:flex;
    align-items:center;
    gap:10px;

    transition:.3s;
}

.action-btn:hover{
    background:#f3e8cf;
}

/* COMMENT */

.comment-form{
    margin-top:20px;
}

.comment-form textarea{
    width:100%;
    border:none;
    outline:none;
    resize:none;

    background:#f8f5ed;
    border-radius:20px;

    height:120px;
    padding:20px;
    margin-bottom:15px;
}

.comment-form button{
    border:none;
    color:white;
    padding:14px 26px;
    border-radius:999px;
    cursor:pointer;
    font-weight:700;

    display:flex;
    align-items:center;
    gap:10px;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
}

.comment-item{
    border-top:1px solid #eee;
    padding:20px 0;
}

.comment-text{
    margin-top:12px;
    color:#555;
    line-height:1.8;
}

/* EMPTY */

.empty-comment{
    text-align:center;
    padding:50px 20px;
    color:#888;
}

.empty-comment i{
    font-size:50px;
    margin-bottom:20px;
    color:#C9A227;
}

/* MOBILE */

@media(max-width:768px){

    .post-actions{
        flex-wrap:wrap;
    }

    .post-title{
        font-size:28px;
    }

}

</style>

@endsection