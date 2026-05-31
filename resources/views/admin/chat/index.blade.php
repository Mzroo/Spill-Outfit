@extends('layouts.admin')

@section('title', 'Chat Customer')

@section('content')

<section class="chat-wrapper">

    <!-- HEADER -->
    <div class="page-header">

        <h2>
            Chat Customer
        </h2>

        <p>
            Kelola pesan customer dan balas pertanyaan mereka.
        </p>

    </div>

    <!-- LIST CHAT -->
    <div class="chat-list-card">

        @forelse($rooms as $room)

            <a
                href="{{ route('admin.chat.show', $room->id) }}"
                class="chat-item"
            >

                <!-- FOTO -->
                <div class="avatar">

                    @if($room->user?->profile?->foto)

                        <img
                            src="{{ asset('storage/' . $room->user->profile->foto) }}"
                            alt="profile"
                        >

                    @else

                        {{ strtoupper(substr($room->user->name ?? 'U', 0, 1)) }}

                    @endif

                </div>

                <!-- CONTENT -->
                <div class="chat-content">

                    <div class="chat-top">

                        <h5>
                            {{ $room->user->name ?? 'User' }}
                        </h5>

                        <span>
                            {{ $room->last_message_at
                                ? $room->last_message_at->format('H:i')
                                : '-' }}
                        </span>

                    </div>

                    <p>

                        {{ Str::limit(
                            $room->latestMessage?->message
                            ?? 'Belum ada pesan',
                            50
                        ) }}

                    </p>

                </div>

                <!-- BADGE -->
                @php
                    $unread =
                    $room->messages
                        ->where('sender_type', 'user')
                        ->where('is_read', false)
                        ->count();
                @endphp

                @if($unread)

                    <div class="badge-chat">

                        {{ $unread }}

                    </div>

                @endif

            </a>

        @empty

            <div class="empty-state">

                <i class="fa-solid fa-comments"></i>

                <h4>
                    Belum ada chat
                </h4>

                <p>
                    Pesan customer akan tampil di sini.
                </p>

            </div>

        @endforelse

    </div>

</section>

<style>

/* PAGE */

.chat-wrapper{
    padding:30px;
}

.page-header{
    margin-bottom:25px;
}

.page-header h2{
    font-size:34px;
    font-weight:800;
    color:#2d2d2d;
}

.page-header p{
    color:#777;
}

/* CARD */

.chat-list-card{
    background:#fff;
    border-radius:30px;
    overflow:hidden;
    box-shadow:
    0 10px 30px rgba(0,0,0,.06);
}

/* ITEM */

.chat-item{
    display:flex;
    align-items:center;
    gap:18px;
    padding:24px;
    border-bottom:1px solid #f1f1f1;
    text-decoration:none;
    color:inherit;
    transition:.3s;
    position:relative;
}

.chat-item:hover{
    background:#faf7ef;
}

/* AVATAR */

.avatar{
    width:70px;
    height:70px;
    border-radius:50%;
    overflow:hidden;
    flex-shrink:0;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;
    font-size:28px;
    font-weight:800;

    display:flex;
    align-items:center;
    justify-content:center;
}

.avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* CONTENT */

.chat-content{
    flex:1;
}

.chat-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:8px;
}

.chat-top h5{
    font-weight:700;
    margin:0;
}

.chat-top span{
    color:#888;
    font-size:13px;
}

.chat-content p{
    margin:0;
    color:#777;
}

/* BADGE */

.badge-chat{
    width:34px;
    height:34px;
    border-radius:50%;
    background:#C9A227;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
    font-weight:700;
}

/* EMPTY */

.empty-state{
    padding:80px;
    text-align:center;
}

.empty-state i{
    font-size:60px;
    color:#C9A227;
    margin-bottom:20px;
}

.empty-state h4{
    font-weight:700;
}

/* MOBILE */

@media(max-width:768px){

    .chat-wrapper{
        padding:15px;
    }

    .chat-item{
        padding:18px;
    }

    .avatar{
        width:55px;
        height:55px;
    }

    .page-header h2{
        font-size:28px;
    }
}

</style>

@endsection