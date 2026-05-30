@extends('layouts.user')

@section('title', 'Komunitas')

@section('content')

<section class="komunitas-section">

    <!-- HEADER -->

    <div class="komunitas-header">

        <div>

            <span>
                SPILL OUTFIT COMMUNITY
            </span>

            <h2>
                Share Style <br>
                Outfit Kamu ✨
            </h2>

        </div>

    </div>

    <!-- FORM POST -->

    <div class="post-box">

        <form action="{{ route('komunitas.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <textarea
                name="caption"
                placeholder="Share outfit favoritmu hari ini..."
                required></textarea>

            <div class="post-bottom">

                <input type="file" name="gambar">

                <button type="submit">
                    Posting
                </button>

            </div>

        </form>

    </div>

    <!-- FEED -->

    @foreach($komunitas as $item)

    <div class="feed-card">

        <!-- USER -->

        <div class="feed-user">

            <img src="https://i.pravatar.cc/150?img=12">

            <div>

                <h5>
                    {{ $item->user->name }}
                </h5>

                <span>
                    {{ $item->created_at->diffForHumans() }}
                </span>

            </div>

        </div>

        <!-- CAPTION -->

        <p class="feed-caption">

            {{ $item->caption }}

        </p>

        <!-- IMAGE -->

        @if($item->gambar)

        <img src="{{ asset('storage/' . $item->gambar) }}"
             class="feed-image">

        @endif

    </div>

    @endforeach

</section>

<style>

.komunitas-section{
    max-width:850px;
    margin:auto;
}

.komunitas-header{
    margin-bottom:40px;
}

.komunitas-header span{
    background:#e9efe0;
    color:#556B2F;

    padding:8px 18px;

    border-radius:50px;

    font-size:13px;
    font-weight:600;
}

.komunitas-header h2{
    margin-top:20px;

    font-size:50px;
    font-weight:700;
}

.post-box{
    background:white;

    border-radius:30px;

    padding:25px;

    margin-bottom:40px;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.06);
}

.post-box textarea{
    width:100%;
    height:120px;

    border:none;
    outline:none;

    resize:none;

    font-size:16px;
}

.post-bottom{
    margin-top:20px;

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.post-bottom button{
    border:none;

    padding:12px 24px;

    border-radius:50px;

    background:#313E17;
    color:white;
}

.feed-card{
    background:white;

    border-radius:30px;

    padding:25px;

    margin-bottom:30px;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.06);
}

.feed-user{
    display:flex;
    align-items:center;
    gap:15px;

    margin-bottom:20px;
}

.feed-user img{
    width:55px;
    height:55px;

    border-radius:50%;
}

.feed-user h5{
    margin:0;

    font-weight:600;
}

.feed-user span{
    font-size:13px;
    color:#888;
}

.feed-caption{
    line-height:1.8;
    color:#555;

    margin-bottom:20px;
}

.feed-image{
    width:100%;
    height:500px;

    object-fit:cover;

    border-radius:25px;

    margin-top:15px;

    display:block;
}

</style>

@endsection