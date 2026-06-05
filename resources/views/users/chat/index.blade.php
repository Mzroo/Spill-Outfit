@extends('layouts.user')

@section('title', 'Chat Admin')

@section('content')

<section class="chat-page-container">

    <div class="chat-sidebar">
        <div class="sidebar-info-card">
            <span class="chat-badge">CUSTOMER SERVICE</span>
            <h3>Spill Outfit Support</h3>
            <p>Punya pertanyaan seputar ukuran, ketersediaan stok, atau rekomendasi style? Admin kami siap membantu!</p>
            
            <hr class="sidebar-divider">
            
            <div class="info-meta">
                <div class="meta-item">
                    <i class="mdi mdi-clock-outline"></i>
                    <div>
                        <h5>Jam Operasional</h5>
                        <p>Setiap Hari (08:00 - 21:00 WIB)</p>
                    </div>
                </div>
                <div class="meta-item">
                    <i class="mdi mdi-shield-check-outline"></i>
                    <div>
                        <h5>Respon Cepat</h5>
                        <p>Rata-rata membalas < 10 menit</p>
                    </div>
                </div>
            </div>

            <div class="sidebar-illustration">
                <svg viewBox="0 0 1000 800" width="100%">
                    <defs>
                        <linearGradient id="premium-gold" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#8C6A2F" />
                            <stop offset="100%" stop-color="#C9A227" />
                        </linearGradient>
                    </defs>
                    <circle cx="500" cy="400" r="300" fill="#fcfbf7" stroke="#e8e1d3" stroke-width="2"/>
                    <path d="M350,550 L650,550" stroke="#e3d9c6" stroke-width="6" stroke-linecap="round"/>
                    <circle cx="500" cy="350" r="90" fill="url(#premium-gold)" />
                    <path d="M360,530 C360,440 400,430 500,430 C600,430 640,440 640,530 Z" fill="#8C6A2F" />
                    <rect x="600" y="200" width="120" height="60" rx="15" fill="url(#premium-gold)" />
                    <circle cx="640" cy="230" r="5" fill="#fff" />
                    <circle cx="660" cy="230" r="5" fill="#fff" />
                    <circle cx="680" cy="230" r="5" fill="#fff" />
                </svg>
            </div>
        </div>
    </div>

    <div class="chat-main-area">
        <div class="chat-window-card">
            
            <div class="chat-window-header">
                <div class="header-user-profile">
                    <div class="admin-avatar-circle">A</div>
                    <div>
                        <h4>Admin Store</h4>
                        <div class="active-status">
                            <span class="status-pulse"></span>
                            <small>Sedia Membantu Kamu</small>
                        </div>
                    </div>
                </div>
                <div class="header-utility-icons">
                    <button class="util-btn" title="Refresh Chat" onclick="location.reload();">
                        <i class="mdi mdi-refresh"></i>
                    </button>
                    <i class="mdi mdi-dots-vertical"></i>
                </div>
            </div>

            <div class="chat-window-body">
                @forelse($messages as $chat)
                    @if($chat->sender_type == 'user')
                        <div class="message-row row-user">
                            <div class="msg-bubble bubble-user">
                                <p class="msg-text">{{ $chat->message }}</p>
                                <span class="msg-time">{{ $chat->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @else
                        <div class="message-row row-admin">
                            <div class="msg-bubble bubble-admin">
                                <p class="msg-text">{{ $chat->message }}</p>
                                <span class="msg-time">{{ $chat->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="chat-blank-state">
                        <div class="blank-icon-envelope">
                            <i class="mdi mdi-forum-outline"></i>
                        </div>
                        <h5>Belum Ada Percakapan</h5>
                        <p>Ketik pesanmu di bawah untuk memulai obrolan langsung dengan Customer Support kami.</p>
                    </div>
                @endforelse
            </div>

            <form action="{{ route('chat.send') }}" method="POST" class="chat-window-form">
                @csrf
                <div class="field-wrapper">
                    <i class="mdi mdi-emoticon-happy-outline tool-icon"></i>
                    <input type="text" name="message" placeholder="Tulis pesan ke admin toko di sini..." required autocomplete="off">
                </div>
                <button type="submit" class="btn-send-message">
                    <span>Kirim</span>
                    <i class="mdi mdi-send"></i>
                </button>
            </form>

        </div>
    </div>

</section>

<style>
/* ================= SYSTEM CONTAINER BASE ================= */
.chat-page-container {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 30px;
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
}

/* Badge Berwarna Gradasi Premium */
.chat-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 30px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.8px;
    margin-bottom: 15px;
}

/* ================= 1. SIDEBAR STYLE (KIRI) ================= */
.chat-sidebar {
    display: flex;
    flex-direction: column;
}

.sidebar-info-card {
    background: white;
    border-radius: 24px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid #f1f1f1;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.sidebar-info-card h3 {
    font-size: 22px;
    font-weight: 700;
    color: #2c2c2c;
    margin-bottom: 10px;
}

.sidebar-info-card p {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}

.sidebar-divider {
    border: 0;
    border-top: 1px solid #f1f1f1;
    margin: 25px 0;
}

.info-meta {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.meta-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.meta-item i {
    font-size: 24px;
    color: #8C6A2F;
    margin-top: 2px;
}

.meta-item h5 {
    font-size: 14px;
    font-weight: 700;
    color: #2c2c2c;
    margin-bottom: 2px;
}

.meta-item p {
    font-size: 13px;
    color: #888;
}

.sidebar-illustration {
    margin-top: auto;
    padding-top: 20px;
    max-width: 200px;
    margin-left: auto;
    margin-right: auto;
}

/* ================= 2. CHAT PANEL STYLE (KANAN) ================= */
.chat-window-card {
    background: white;
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    border: 1px solid #f1f1f1;
    overflow: hidden;
    height: 650px;
    display: flex;
    flex-direction: column;
}

/* HEADER AREA */
.chat-window-header {
    padding: 20px 30px;
    border-bottom: 1px solid #f1f1f1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
}

.header-user-profile {
    display: flex;
    align-items: center;
    gap: 15px;
}

.admin-avatar-circle {
    width: 50px;
    height: 50px;
    border-radius: 50px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 800;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.15);
}

.header-user-profile h4 {
    font-size: 16px;
    font-weight: 700;
    color: #2c2c2c;
    margin: 0;
}

.active-status {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 3px;
}

.status-pulse {
    width: 8px;
    height: 8px;
    background-color: #2ecc71;
    border-radius: 50%;
}

.active-status small {
    font-size: 12px;
    color: #777;
}

.header-utility-icons {
    display: flex;
    align-items: center;
    gap: 15px;
    color: #888;
    font-size: 20px;
}

.util-btn {
    background: none;
    border: none;
    color: #888;
    font-size: 20px;
    cursor: pointer;
    padding: 5px;
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.util-btn:hover {
    background-color: #f5f5f5;
    color: #8C6A2F;
}

/* CHAT MESSAGES PANEL SCROLLBODY */
.chat-window-body {
    flex: 1;
    overflow-y: auto;
    padding: 30px;
    background: #faf8f3; /* Warna dasar krem super soft */
}

.message-row {
    display: flex;
    margin-bottom: 20px;
    width: 100%;
}

.message-row.row-user { justify-content: flex-end; }
.message-row.row-admin { justify-content: flex-start; }

/* BUBBLE SYSTEM */
.msg-bubble {
    max-width: 65%;
    padding: 14px 20px;
    border-radius: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.01);
}

.bubble-user {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border-top-right-radius: 4px;
}

.bubble-admin {
    background: white;
    color: #333;
    border-top-left-radius: 4px;
    border: 1px solid #efebd3;
}

.msg-text {
    margin: 0;
    font-size: 14.5px;
    line-height: 1.6;
}

.msg-time {
    display: block;
    font-size: 10px;
    margin-top: 6px;
    text-align: right;
    opacity: 0.7;
}

.bubble-admin .msg-time {
    color: #999;
}

/* FIELD TEXT BOX CONTROLLER */
.chat-window-form {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px 30px;
    background: white;
    border-top: 1px solid #f1f1f1;
}

.field-wrapper {
    display: flex;
    align-items: center;
    flex: 1;
    background: #f5f1e6;
    border-radius: 14px;
    padding: 2px 18px;
}

.tool-icon {
    font-size: 22px;
    color: #8C6A2F;
    margin-right: 12px;
}

.chat-window-form input {
    flex: 1;
    border: none;
    outline: none;
    background: transparent;
    padding: 14px 0;
    font-size: 14px;
    color: #333;
}

/* BUTTON ACTION MODES */
.btn-send-message {
    border: none;
    outline: none;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    padding: 14px 24px;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(140, 106, 47, 0.2);
    transition: all 0.2s ease;
}

.btn-send-message:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.3);
}

/* BLANK STATE DESIGN */
.chat-blank-state {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 40px;
}

.blank-icon-envelope {
    width: 80px;
    height: 80px;
    background: rgba(140, 106, 47, 0.08);
    border-radius: 50%25;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.blank-icon-envelope i {
    font-size: 40px;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.chat-blank-state h5 {
    font-size: 18px;
    font-weight: 700;
    color: #2c2c2c;
    margin-bottom: 8px;
}

.chat-blank-state p {
    font-size: 14px;
    color: #777;
    max-width: 320px;
    line-height: 1.6;
}

/* ================= SCREEN MEDIA RESPONSIVE SYSTEM ================= */
@media(max-width: 992px) {
    .chat-page-container {
        grid-template-columns: 1fr; /* Di tablet/HP sidebar pindah ke atas */
        gap: 20px;
        margin: 20px auto;
    }
    
    .chat-window-card {
        height: 550px; /* Ukuran tinggi dikompensasi sedikit */
    }
    
    .sidebar-illustration {
        display: none; /* Ilustrasi hilang di layar kecil */
    }
}

@media(max-width: 576px) {
    .chat-window-header {
        padding: 15px 20px;
    }
    
    .chat-window-body {
        padding: 20px;
    }
    
    .msg-bubble {
        max-width: 85%; /* Balon teks melebar di layar HP asli */
    }
    
    .chat-window-form {
        padding: 15px 20px;
    }
    
    .btn-send-message span {
        display: none; /* Di HP hanya tampil ikon kirim saja */
    }
    
    .btn-send-message {
        padding: 14px;
        border-radius: 50%;
    }
}
</style>

@endsection