@extends('layouts.admin')

@section('title', 'Chat Customer')

@section('content')

<section class="chat-wrapper">

    <div class="page-header">
        <h2>Chat Customer</h2>
        <p>Kelola pesan customer dan balas pertanyaan mereka.</p>
    </div>

    <div class="chat-list-card">

        {{-- DISESUAIKAN: Looping menggunakan data grouping dari satu tabel chats --}}
        @forelse($chatGrouped as $item)
            @php
                // Ambil pesan terakhir milik user ini untuk preview teks dan waktu chat
                $lastChat = App\Models\Chat::where('user_id', $item->user_id)
                    ->latest()
                    ->first();

                // Hitung jumlah pesan dari user yang belum dibaca oleh admin
                $unread = App\Models\Chat::where('user_id', $item->user_id)
                    ->where('sender_type', 'user')
                    ->where('is_read', false)
                    ->count();
            @endphp

            {{-- DISESUAIKAN: Route diarahkan ke chat.show dengan parameter user_id --}}
            <a href="{{ route('admin.chat.show', $item->user_id) }}" class="chat-item">

                <div class="avatar">
                    {{-- Cek langsung ke kolom avatar/foto di tabel users --}}
                    @if($item->user?->avatar) 
                        <img src="{{ asset('storage/' . $item->user->avatar) }}" alt="profile">
                    @else
                        {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                    @endif
                </div>

                <div class="chat-content">
                    <div class="chat-top">
                        <h5>{{ $item->user->name ?? 'Customer' }}</h5>
                        <span>
                            {{ $lastChat ? $lastChat->created_at->format('H:i') : '-' }}
                        </span>
                    </div>

                    <p>
                        {{ $lastChat ? Str::limit($lastChat->message, 50) : 'Belum ada pesan' }}
                    </p>
                </div>

                @if($unread > 0)
                    <div class="badge-chat">
                        {{ $unread }}
                    </div>
                @endif

            </a>

        @empty

            <div class="empty-state">
                <i class="fa-solid fa-comments"></i>
                <h4>Belum ada chat</h4>
                <p>Pesan customer akan tampil di sini.</p>
            </div>

        @endforelse

    </div>

</section>

<style>
/* ================= PAGE CONTAINER ================= */
.chat-wrapper {
    padding: 30px;
    font-family: 'Poppins', sans-serif;
}

.page-header {
    margin-bottom: 25px;
}

.page-header h2 {
    font-size: 34px;
    font-weight: 800;
    color: #2d2d2d;
}

.page-header p {
    color: #777;
}

/* ================= CARD BOX LIST ================= */
.chat-list-card {
    background: #fff;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
}

/* ================= CHAT ROW ITEM ================= */
.chat-item {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 24px;
    border-bottom: 1px solid #f1f1f1;
    text-decoration: none;
    color: inherit;
    transition: .3s;
    position: relative;
}

.chat-item:hover {
    background: #faf7ef;
}

/* ================= AVATAR PROFILE ================= */
.avatar {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    font-size: 28px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ================= TEXT BLOCK CONTENT ================= */
.chat-content {
    flex: 1;
}

.chat-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.chat-top h5 {
    font-weight: 700;
    margin: 0;
    color: #2d2d2d;
}

.chat-top span {
    color: #888;
    font-size: 13px;
}

.chat-content p {
    margin: 0;
    color: #777;
    font-size: 14px;
}

/* ================= COUNTER BADGE ================= */
.badge-chat {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #C9A227;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    box-shadow: 0 4px 10px rgba(201, 162, 39, 0.3);
}

/* ================= EMPTY STATE ================= */
.empty-state {
    padding: 80px;
    text-align: center;
}

.empty-state i {
    font-size: 60px;
    color: #C9A227;
    margin-bottom: 20px;
}

.empty-state h4 {
    font-weight: 700;
    color: #2d2d2d;
}

.empty-state p {
    color: #777;
}

/* ================= MEDIA RESPONSIVE ENGINE ================= */
@media(max-width: 768px) {
    .chat-wrapper {
        padding: 15px;
    }

    .chat-item {
        padding: 18px;
    }

    .avatar {
        width: 55px;
        height: 55px;
        font-size: 22px;
    }

    .page-header h2 {
        font-size: 28px;
    }
}
</style>

@endsection