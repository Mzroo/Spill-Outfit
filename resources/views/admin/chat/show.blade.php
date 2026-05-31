@extends('layouts.admin')

@section('title', 'Detail Chat')

@section('content')

<section class="chat-page">

    <!-- HEADER -->
    <div class="chat-header">

        <div class="header-left">

            <a
                href="{{ route('admin.chat.index') }}"
                class="back-btn"
            >
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="avatar">

                @if($room->user?->profile?->foto)

                    <img
                        src="{{ asset('storage/' . $room->user->profile->foto) }}"
                        alt=""
                    >

                @else

                    {{ strtoupper(substr($room->user->name,0,1)) }}

                @endif

            </div>

            <div>

                <h4>
                    {{ $room->user->name }}
                </h4>

                <span>
                    Customer
                </span>

            </div>

        </div>

    </div>

    <!-- CHAT BODY -->
    <div class="chat-body">

        @forelse($messages as $chat)

            {{-- USER --}}
            @if($chat->sender_type == 'user')

                <div class="chat-row left">

                    <div class="chat-bubble user-bubble">

                        {{ $chat->message }}

                        <small>
                            {{ $chat->created_at->format('H:i') }}
                        </small>

                    </div>

                </div>

            @else

                {{-- ADMIN --}}
                <div class="chat-row right">

                    <div class="chat-bubble admin-bubble">

                        {{ $chat->message }}

                        <small>
                            {{ $chat->created_at->format('H:i') }}
                        </small>

                    </div>

                </div>

            @endif

        @empty

            <div class="empty-chat">

                <i class="fa-solid fa-comments"></i>

                <h4>
                    Belum ada chat
                </h4>

                <p>
                    Customer belum mengirim pesan.
                </p>

            </div>

        @endforelse

    </div>

    <!-- FORM -->
    <form
        action="{{ route('admin.chat.send', $room->id) }}"
        method="POST"
        class="chat-form"
    >

        @csrf

        <input
            type="text"
            name="message"
            placeholder="Tulis balasan..."
            required
        >

        <button type="submit">

            <i class="fa-solid fa-paper-plane"></i>

        </button>

    </form>

</section>

<style>

.chat-page{
    background:#fff;
    border-radius:30px;
    overflow:hidden;
    box-shadow:
    0 10px 30px rgba(0,0,0,.06);
}

/* HEADER */

.chat-header{
    padding:22px 28px;
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
}

.header-left{
    display:flex;
    align-items:center;
    gap:16px;
}

.back-btn{
    width:45px;
    height:45px;
    border-radius:50%;
    background:rgba(255,255,255,.2);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    text-decoration:none;
}

.avatar{
    width:60px;
    height:60px;
    border-radius:50%;
    overflow:hidden;
    background:white;
    color:#8C6A2F;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:22px;
}

.avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* BODY */

.chat-body{
    height:550px;
    overflow-y:auto;
    padding:30px;
    background:#faf8f3;
}

/* CHAT */

.chat-row{
    display:flex;
    margin-bottom:18px;
}

.chat-row.left{
    justify-content:flex-start;
}

.chat-row.right{
    justify-content:flex-end;
}

.chat-bubble{
    max-width:70%;
    padding:16px 18px;
    border-radius:22px;
    font-size:15px;
    line-height:1.8;
}

.user-bubble{
    background:white;
    border-bottom-left-radius:6px;
}

.admin-bubble{
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
    border-bottom-right-radius:6px;
}

.chat-bubble small{
    display:block;
    margin-top:10px;
    font-size:12px;
    opacity:.8;
}

/* FORM */

.chat-form{
    display:flex;
    gap:15px;
    padding:24px;
    border-top:1px solid #eee;
}

.chat-form input{
    flex:1;
    border:none;
    outline:none;
    background:#f5f5f5;
    border-radius:999px;
    padding:18px 24px;
}

.chat-form button{
    width:58px;
    height:58px;
    border:none;
    border-radius:50%;
    color:white;
    font-size:18px;
    cursor:pointer;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
}

/* EMPTY */

.empty-chat{
    height:100%;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:#777;
}

.empty-chat i{
    font-size:60px;
    color:#C9A227;
    margin-bottom:20px;
}

/* MOBILE */

@media(max-width:768px){

    .chat-body{
        height:450px;
        padding:20px;
    }

    .chat-bubble{
        max-width:90%;
    }
}

</style>

@endsection