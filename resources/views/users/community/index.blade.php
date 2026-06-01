@extends('layouts.user')

@section('title', 'Community')

@section('content')

<section class="community-section">

    <!-- HEADER -->
    <div class="community-header">

        <span>
            COMMUNITY
        </span>

        <h2>
            Community Outfit 🔥
        </h2>

        <p>
            Bagikan style terbaik kamu, cari inspirasi outfit,
            dan terhubung dengan komunitas fashion.
        </p>

    </div>

    <!-- ALERT -->
    @if(session('success'))

    <div class="success-alert">

        <i class="fa-solid fa-circle-check"></i>

        {{ session('success') }}

    </div>

    @endif

    <!-- ACTION -->
    <div class="top-community-action">

        <a
            href="{{ route('community.create') }}"
            class="create-post-btn"
        >

            <i class="fa-solid fa-plus"></i>

            Buat Postingan

        </a>

    </div>

    <!-- POSTS -->
    <div class="post-wrapper">

        @forelse($posts as $post)

        <div class="post-card">

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

                    <h5>
                        {{ $post->user?->name }}
                    </h5>

                    <small>
                        {{ $post->created_at->diffForHumans() }}
                    </small>

                </div>

            </div>

            <!-- TITLE -->
            @if($post->judul)

            <h3 class="post-title">
                {{ $post->judul }}
            </h3>

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
            >

            @endif

            <!-- ACTION -->
            <div class="post-action">

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

                    </button>

                </form>

                <!-- COMMENT -->
                <a
                    href="{{ route('community.show', $post->id) }}"
                    class="action-btn"
                >

                    <i class="fa-solid fa-comment"></i>

                    {{ $post->total_comment }}

                </a>

            </div>

        </div>

        @empty

        <div class="empty-community">

            <i class="fa-solid fa-users"></i>

            <h3>
                Belum ada postingan
            </h3>

            <p>
                Jadilah orang pertama yang membagikan outfit.
            </p>

        </div>

        @endforelse

    </div>

</section>

<style>

.community-section{
    max-width:950px;
    margin:auto;
}

/* HEADER */

.community-header{
    margin-bottom:35px;
}

.community-header span{
    display:inline-block;
    padding:10px 18px;
    border-radius:999px;
    background:#f3e8cf;
    color:#8C6A2F;
    font-size:13px;
    font-weight:700;
}

.community-header h2{
    font-size:52px;
    font-weight:800;
    color:#2d2d2d;
    margin:15px 0;
}

.community-header p{
    color:#777;
    line-height:1.8;
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

/* ACTION */

.top-community-action{
    display:flex;
    justify-content:flex-end;
    margin-bottom:30px;
}

.create-post-btn{
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:10px;

    padding:15px 26px;
    border-radius:999px;

    color:white;
    font-weight:700;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    transition:.3s;
}

.create-post-btn:hover{
    transform:translateY(-2px);
}

/* POST */

.post-card{
    background:white;
    padding:28px;
    border-radius:30px;
    margin-bottom:24px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.05);
}

/* USER */

.post-user{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:20px;
}

.avatar{
    width:60px;
    height:60px;
    border-radius:50%;
    overflow:hidden;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    display:flex;
    justify-content:center;
    align-items:center;

    font-weight:700;
    font-size:18px;
}

.avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* CONTENT */

.post-title{
    margin-bottom:12px;
    color:#2d2d2d;
}

.post-caption{
    color:#555;
    line-height:1.8;
}

/* IMAGE */

.post-image{
    width:100%;
    border-radius:25px;
    margin-top:20px;
}

/* ACTION */

.post-action{
    display:flex;
    gap:15px;
    margin-top:20px;
}

.action-btn{
    border:none;
    outline:none;
    background:#f8f5ed;

    padding:14px 20px;

    border-radius:999px;

    cursor:pointer;

    color:#8C6A2F;
    text-decoration:none;

    display:flex;
    align-items:center;
    gap:10px;

    font-weight:600;

    transition:.3s;
}

.action-btn:hover{
    background:#f3e8cf;
}

/* EMPTY */

.empty-community{
    text-align:center;
    padding:80px;
}

.empty-community i{
    font-size:60px;
    color:#C9A227;
    margin-bottom:20px;
}

.empty-community h3{
    margin-bottom:10px;
}

.empty-community p{
    color:#777;
}

/* MOBILE */

@media(max-width:768px){

    .community-header h2{
        font-size:38px;
    }

    .top-community-action{
        justify-content:center;
    }

    .post-action{
        flex-wrap:wrap;
    }

}

</style>

@endsection