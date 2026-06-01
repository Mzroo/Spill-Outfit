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
            Outfit Community 🔥
        </h2>

        <p>
            Bagikan style terbaikmu, cari inspirasi outfit,
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

    <!-- BUTTON -->
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

            <a
                href="{{ route('community.show', $post->id) }}"
                class="card-link"
            >

                <!-- IMAGE WRAPPER -->
                <div class="image-wrapper">

                    @if($post->gambar)

                    <img
                        src="{{ asset('storage/' . $post->gambar) }}"
                        class="post-image"
                        alt=""
                    >

                    @else

                    <div class="image-placeholder">

                        <i class="fa-solid fa-shirt"></i>

                    </div>

                    @endif

                    <!-- USER OVERLAY -->
                    <div class="post-user-overlay">

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

                        <div class="user-info">

                            <h5>
                                {{ $post->user?->name }}
                            </h5>

                            <small>
                                {{ $post->created_at->diffForHumans() }}
                            </small>

                        </div>

                    </div>

                </div>

                <!-- CONTENT -->
                <div class="post-content">

                    @if($post->judul)

                    <h3 class="post-title">
                        {{ $post->judul }}
                    </h3>

                    @endif

                    <p class="post-caption">
                        {{ $post->caption }}
                    </p>

                </div>

            </a>

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
                Jadilah orang pertama yang spill outfit 🔥
            </p>

        </div>

        @endforelse

    </div>

</section>

<style>

.community-section{
    max-width:1500px;
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
    font-size:50px;
    margin:15px 0;
    color:#222;
}

.community-header p{
    color:#777;
    line-height:1.8;
}

/* ALERT */

.success-alert{
    background:#dff5e5;
    color:#1d6b3c;
    padding:18px 20px;
    border-radius:20px;
    margin-bottom:25px;

    display:flex;
    align-items:center;
    gap:12px;
}

/* BUTTON */

.top-community-action{
    display:flex;
    justify-content:flex-end;
    margin-bottom:35px;
}

.create-post-btn{
    text-decoration:none;
    color:white;
    font-weight:700;
    border-radius:999px;
    padding:15px 26px;

    display:flex;
    align-items:center;
    gap:10px;

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

/* GRID */

.post-wrapper{
    display:grid;
    grid-template-columns:
    repeat(4,1fr);

    gap:22px;
}

/* CARD */

.post-card{
    background:white;
    border-radius:30px;
    overflow:hidden;

    box-shadow:
    0 10px 35px rgba(0,0,0,.05);

    transition:.3s;
}

.post-card:hover{
    transform:translateY(-5px);
}

.card-link{
    text-decoration:none;
}

/* IMAGE */

.image-wrapper{
    position:relative;
}

.post-image{
    width:100%;
    height:280px;
    object-fit:cover;
    display:block;
}

.image-placeholder{
    height:280px;

    display:flex;
    justify-content:center;
    align-items:center;

    background:#f8f5ed;
    color:#C9A227;
    font-size:50px;
}

/* USER OVERLAY */

.post-user-overlay{
    position:absolute;
    top:8px;
    left:8px;

    display:flex;
    align-items:center;
    
    gap:12px;
    background: rgba(255, 255, 255, 0.4);
    padding:5px 9px;
    border-radius:999px;

    box-shadow:
    0 8px 20px rgba(0,0,0,.08);
}

.avatar{
    width:33px;
    height:33px;
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

    flex-shrink:0;
}

.avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.user-info h5{
    margin:0;
    color: #333;
    font-size:13px;
}

.user-info small{
    font-size:10px;
    color: #444;
}

/* CONTENT */

.post-content{
    padding:18px;
}

.post-title{
    color:#222;
    font-size:18px;
    margin-bottom:10px;
    line-height:1.5;
}

.post-caption{
    color:#666;
    line-height:1.7;
    font-size:14px;

    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

/* ACTION */

.post-action{
    display:flex;
    gap:10px;
    padding:0 18px 18px;
}

.post-action form{
    flex:1;
}

.action-btn{
    width:100%;
    border:none;
    background:#f8f5ed;
    border-radius:999px;
    padding:13px;

    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;

    cursor:pointer;

    text-decoration:none;
    color:#8C6A2F;
    font-weight:700;

    transition:.3s;
}

.action-btn:hover{
    background:#f3e8cf;
}

/* EMPTY */

.empty-community{
    grid-column:1/-1;
    text-align:center;
    padding:90px;
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

/* RESPONSIVE */

@media(max-width:1300px){

    .post-wrapper{
        grid-template-columns:
        repeat(3,1fr);
    }

}

@media(max-width:900px){

    .post-wrapper{
        grid-template-columns:
        repeat(2,1fr);
    }

}

@media(max-width:600px){

    .post-wrapper{
        grid-template-columns:1fr;
    }

    .community-header h2{
        font-size:35px;
    }

    .top-community-action{
        justify-content:center;
    }

}

</style>

@endsection