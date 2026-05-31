@extends('layouts.user')

@section('title', 'Chat Admin')

@section('content')

<section class="chat-page">

    <div class="chat-card">

        <!-- HEADER -->
        <div class="chat-header">

            <div class="header-left">

                <div class="admin-avatar">
                    A
                </div>

                <div>

                    <h4>
                        Admin Store
                    </h4>

                    <small>
                        Customer Support
                    </small>

                </div>

            </div>

        </div>

        <!-- BODY CHAT -->
        <div class="chat-body">

            @forelse($messages as $chat)

                @if($chat->sender_type == 'user')

                    <div class="chat-row user">

                        <div class="bubble user-bubble">

                            {{ $chat->message }}

                            <small>
                                {{ $chat->created_at->format('H:i') }}
                            </small>

                        </div>

                    </div>

                @else

                    <div class="chat-row admin">

                        <div class="bubble admin-bubble">

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

                    <h5>
                        Belum ada pesan
                    </h5>

                    <p>
                        Mulai chat dengan admin toko
                    </p>

                </div>

            @endforelse

        </div>

        <!-- FORM CHAT -->
        <form
            action="{{ route('chat.send') }}"
            method="POST"
            class="chat-form"
        >

            @csrf

            <input
                type="text"
                name="message"
                placeholder="Tulis pesan..."
                required
            >

            <button type="submit">
                <i class="fa-solid fa-paper-plane"></i>
            </button>

        </form>

    </div>

</section>

<style>

.chat-page{
    max-width:900px;
    margin:auto;
}

.chat-card{
    background:#fff;
    border-radius:30px;
    overflow:hidden;
    box-shadow:
    0 10px 35px rgba(0,0,0,.08);
}

/* HEADER */

.chat-header{
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
    padding:22px 28px;
}

.header-left{
    display:flex;
    align-items:center;
    gap:14px;
}

.admin-avatar{
    width:60px;
    height:60px;
    border-radius:50%;
    background:white;
    color:#8C6A2F;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    font-weight:800;
}

/* BODY */

.chat-body{
    height:550px;
    overflow-y:auto;
    padding:30px;
    background:#faf8f3;
}

.chat-row{
    display:flex;
    margin-bottom:18px;
}

.chat-row.user{
    justify-content:flex-end;
}

.chat-row.admin{
    justify-content:flex-start;
}

/* BUBBLE */

.bubble{
    max-width:70%;
    padding:16px 18px;
    border-radius:22px;
    position:relative;
    font-size:15px;
    line-height:1.7;
}

.user-bubble{
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
    border-bottom-right-radius:6px;
}

.admin-bubble{
    background:white;
    color:#333;
    border-bottom-left-radius:6px;
    box-shadow:
    0 4px 12px rgba(0,0,0,.06);
}

.bubble small{
    display:block;
    margin-top:8px;
    font-size:12px;
    opacity:.8;
}

/* FORM */

.chat-form{
    display:flex;
    gap:12px;
    padding:22px;
    background:white;
    border-top:1px solid #eee;
}

.chat-form input{
    flex:1;
    border:none;
    outline:none;
    background:#f7f3ea;
    border-radius:999px;
    padding:18px 22px;
}

.chat-form button{
    border:none;
    width:58px;
    height:58px;
    border-radius:50%;
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
    font-size:18px;
}

/* EMPTY */

.empty-chat{
    height:100%;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    color:#777;
    text-align:center;
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

    .bubble{
        max-width:90%;
    }
}

</style>

@endsection