@extends('layouts.admin')

@section('title', 'Detail Chat')

@section('content')

{{-- CDN FontAwesome untuk ikon navigasi dan plane kirim pesan jika belum ada di master layout --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<section class="chat-page">

    <div class="chat-header">

        <div class="header-left">

            <a href="{{ route('admin.chat.index') }}" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="avatar">
                {{-- Cek langsung ke kolom avatar/foto di tabel users --}}
                @if($chatUser->avatar)
                    <img src="{{ asset('storage/' . $chatUser->avatar) }}" alt="profile">
                @else
                    {{ strtoupper(substr($chatUser->name ?? 'U', 0, 1)) }}
                @endif
            </div>

            <div>
                {{-- DISESUAIKAN: Mengakses nama langsung dari $chatUser --}}
                <h4>{{ $chatUser->name ?? 'Customer' }}</h4>
                <span>Customer</span>
            </div>

        </div>

    </div>

    {{-- DISESUAIKAN: Menambahkan id="adminChatBody" untuk kebutuhan auto-scroll JavaScript --}}
    <div class="chat-body" id="adminChatBody">

        @forelse($messages as $chat)

            {{-- SENDER USER (CUSTOMER) --}}
            @if($chat->sender_type == 'user')

                <div class="chat-row left">
                    <div class="chat-bubble user-bubble">
                        {{ $chat->message }}
                        <small>{{ $chat->created_at->format('H:i') }}</small>
                    </div>
                </div>

            @else

                {{-- SENDER ADMIN --}}
                <div class="chat-row right">
                    <div class="chat-bubble admin-bubble">
                        {{ $chat->message }}
                        <small>{{ $chat->created_at->format('H:i') }}</small>
                    </div>
                </div>

            @endif

        @empty

            <div class="empty-chat">
                <i class="fa-solid fa-comments"></i>
                <h4>Belum ada chat</h4>
                <p>Customer belum mengirim pesan.</p>
            </div>

        @endforelse

    </div>

    {{-- DISESUAIKAN: Action rute diarahkan ke parameter $chatUser->id --}}
    <form action="{{ route('admin.chat.send', $chatUser->id) }}" method="POST" class="chat-form">
        @csrf

        <input type="text" name="message" placeholder="Tulis balasan..." required autocomplete="off">

        <button type="submit">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </form>

</section>

<style>
/* ================= MAIN WRAPPER ================= */
.chat-page {
    background: #fff;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
    font-family: 'Poppins', sans-serif;
}

/* ================= CHAT COMPONENT HEADER ================= */
.chat-header {
    padding: 22px 28px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-left h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
}

.header-left span {
    font-size: 13px;
    opacity: 0.9;
}

.back-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: rgba(255,255,255,.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: background 0.2s;
}

.back-btn:hover {
    background: rgba(255,255,255,.3);
}

.avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    background: white;
    color: #8C6A2F;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 22px;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ================= CHAT CONTAINER SCREEN ================= */
.chat-body {
    height: 550px;
    overflow-y: auto;
    padding: 30px;
    background: #faf8f3;
}

/* ================= BUBBLE LAYOUT ENGINE ================= */
.chat-row {
    display: flex;
    margin-bottom: 18px;
}

.chat-row.left { justify-content: flex-start; }
.chat-row.right { justify-content: flex-end; }

.chat-bubble {
    max-width: 70%;
    padding: 16px 18px;
    border-radius: 22px;
    font-size: 15px;
    line-height: 1.8;
}

.user-bubble {
    background: white;
    color: #333;
    border-bottom-left-radius: 6px;
    border: 1px solid #efebd3;
}

.admin-bubble {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border-bottom-right-radius: 6px;
}

.chat-bubble small {
    display: block;
    margin-top: 8px;
    font-size: 11px;
    opacity: .8;
    text-align: right;
}

/* ================= FORM ACTIONS BAR ================= */
.chat-form {
    display: flex;
    gap: 15px;
    padding: 24px;
    border-top: 1px solid #eee;
    background: white;
}

.chat-form input {
    flex: 1;
    border: none;
    outline: none;
    background: #f5f5f5;
    border-radius: 999px;
    padding: 18px 24px;
    font-size: 14px;
    color: #333;
}

.chat-form button {
    width: 58px;
    height: 58px;
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 18px;
    cursor: pointer;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s;
}

.chat-form button:hover {
    transform: scale(1.03);
}

/* ================= EMPTY STATE CONTAINER ================= */
.empty-chat {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #777;
}

.empty-chat i {
    font-size: 60px;
    color: #C9A227;
    margin-bottom: 20px;
}

.empty-chat h4 {
    font-weight: 700;
    color: #2d2d2d;
    margin-bottom: 5px;
}

/* ================= LAYOUT MEDIA RESPONSIVE ================= */
@media(max-width:768px){
    .chat-body {
        height: 450px;
        padding: 20px;
    }

    .chat-bubble {
        max-width: 90%;
    }
}
</style>

{{-- DISESUAIKAN: Script otomatis gulir ke pesan terbawah saat ruang obrolan dibuka --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var adminChatBox = document.getElementById("adminChatBody");
        if (adminChatBox) {
            adminChatBox.scrollTop = adminChatBox.scrollHeight;
        }
    });
</script>

@endsection