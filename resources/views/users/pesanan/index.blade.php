@extends('layouts.user')

@section('title', 'Riwayat Pesanan Kamu')

@section('content')
<section class="history-section">
    <div class="container py-5">
        
        <div class="page-header-modern mb-5">
            <div class="header-info">
                <span class="badge-title-modern">TRANSACTION HISTORY</span>
                <h2>Riwayat Pesanan</h2>
                <p class="text-muted mt-1">Pantau status pembayaran dan pengiriman paketmu di sini</p>
            </div>
            <div class="header-icon-box">
                <i class="mdi mdi-clock-check-outline text-muted" style="font-size: 40px;"></i>
            </div>
        </div>

        @if($pesanan->isEmpty())
            <div class="empty-state-card text-center py-5">
                <div class="empty-icon-wrapper mb-4">
                    <i class="mdi mdi-shopping-search-outline"></i>
                </div>
                <h4>Belum ada pesanan nih</h4>
                <p class="text-muted">Yuk, cari outfit favoritmu sekarang dan lakukan checkout pertamamu!</p>
                <a href="{{ url('/') }}" class="btn-shop-now mt-3">
                    <i class="mdi mdi-shopping-outline me-2"></i> Mulai Belanja
                </a>
            </div>
        @else
            <div class="d-flex flex-column gap-4">
                @foreach($pesanan as $order)
                    <div class="card-order-modern">
                        <div class="order-card-header">
                            <div class="meta-left">
                                <span class="order-date"><i class="mdi mdi-calendar-blank-outline me-1"></i> {{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                                <span class="divider-dot"></span>
                                <span class="order-invoice">#{{ $order->kode_pesanan }}</span>
                            </div>
                            
                            <div class="status-badge-modern status-{{ strtolower($order->status) }}">
                                <span class="status-dot"></span>
                                <span class="status-text">
                                    @if($order->status == 'unpaid')
                                        BELUM BAYAR
                                    @elseif($order->status == 'dibayar')
                                        LUNAS / PAID
                                    @else
                                        {{ strtoupper($order->status) }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="order-card-body">
                            @if($order->items->isNotEmpty())
                                @php $itemPertama = $order->items->first(); @endphp
                                <div class="product-preview-row">
                                    <div class="product-img-wrapper">
                                        <img src="{{ $itemPertama->gambar ? asset('storage/' . $itemPertama->gambar) : 'https://via.placeholder.com/300' }}" alt="Produk">
                                    </div>
                                    <div class="product-info-wrapper">
                                        <h5>{{ $itemPertama->nama_produk }}</h5>
                                        <p class="text-muted small mb-1">Varian: <strong>{{ $itemPertama->nama_varian ?? 'Default Varian' }}</strong></p>
                                        <span class="qty-text-indicator">{{ $itemPertama->qty }} barang x Rp {{ number_format($itemPertama->harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                @if($order->items->count() > 1)
                                    <p class="more-items-text mt-3 text-muted small">
                                        <i class="mdi mdi-plus-box-outline me-1"></i> Dan <b>{{ $order->items->count() - 1 }} produk lainnya</b> dalam pesanan ini
                                    </p>
                                @endif
                            @endif
                        </div>

                        <div class="order-card-footer">
                            <div class="price-summary">
                                <span class="text-muted small block">Total Belanja</span>
                                <h4 class="total-price-display">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h4>
                            </div>
                            <div class="action-buttons">
                                <a href="{{ route('pesanan.show', $order->id) }}" class="btn-detail-modern">
                                    Lihat Detail Transaksi <i class="mdi mdi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

{{-- STYLING PREMIUM RESEP MASAKAN UI --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.history-section { 
    background: #f8f9fa; 
    min-height: 100vh; 
    font-family: 'Plus Jakarta Sans', sans-serif; 
    color: #2d3748;
}

/* Header UI Component */
.page-header-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    background: #ffffff;
    padding: 24px 32px;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    border: 1px solid #edf2f7;
}
.badge-title-modern {
    font-size: 11px;
    letter-spacing: 1.5px;
    font-weight: 700;
    color: #8C6A2F;
    background: #fdf6e6;
    padding: 6px 12px;
    border-radius: 6px;
    display: inline-block;
}
.page-header-modern h2 {
    font-size: 32px;
    font-weight: 800;
    color: #1a202c;
    margin: 8px 0 0 0;
}

/* Empty State Styles */
.empty-state-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #edf2f7;
    padding: 60px 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,.01);
}
.empty-icon-wrapper {
    font-size: 64px;
    color: #cbd5e1;
}
.empty-state-card h4 { font-weight: 700; color: #1a202c; }
.btn-shop-now {
    background: #8C6A2F;
    color: #fff;
    padding: 12px 28px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: 0.3s;
}
.btn-shop-now:hover {
    background: #705423;
    color: white;
    transform: translateY(-2px);
}

/* Modern Order List Cards */
.card-order-modern {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #edf2f7;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.01);
    transition: all 0.25s ease;
}
.card-order-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.04);
}

/* Card Header */
.order-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 24px;
    border-bottom: 1px solid #f1f5f9;
}
.meta-left {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
}
.order-date { color: #64748b; font-weight: 500; }
.divider-dot { width: 4px; height: 4px; background: #cbd5e1; border-radius: 50%; }
.order-invoice { font-weight: 700; color: #1a202c; }

/* Card Body */
.order-card-body {
    padding: 24px;
    border-bottom: 1px dashed #e2e8f0;
}
.product-preview-row {
    display: flex;
    align-items: center;
    gap: 16px;
}
.product-img-wrapper {
    width: 65px;
    height: 65px;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    flex-shrink: 0;
}
.product-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
.product-info-wrapper h5 { font-size: 15px; font-weight: 700; margin-bottom: 2px; color: #1a202c; }
.qty-text-indicator { font-size: 13px; color: #64748b; font-weight: 500; }

/* Card Footer */
.order-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 24px;
    background: #fafafa;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}
.total-price-display { font-size: 18px; font-weight: 800; color: #8C6A2F; margin: 2px 0 0 0; }
.btn-detail-modern {
    background: #ffffff;
    color: #475569;
    border: 1px solid #d1d5db;
    padding: 10px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: 0.2s;
}
.btn-detail-modern:hover {
    background: #8C6A2F;
    color: #ffffff;
    border-color: #8C6A2F;
}

/* Status Badges Dynamic Matrix Control (FIXED SINKRONISASI DATABASENYA) */
.status-badge-modern {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 11px;
    letter-spacing: 0.3px;
}
.status-dot { width: 6px; height: 6px; border-radius: 50%; }

/* Status Colors Matrix */
.status-paid, .status-selesai, .status-dibayar { background: #e6fffa; color: #047481; border: 1px solid #b2f5ea; }
.status-paid .status-dot, .status-selesai .status-dot, .status-dibayar .status-dot { background: #319795; }

.status-unpaid { background: #fff5f5; color: #9b2c2c; border: 1px solid #fed7d7; }
.status-unpaid .status-dot { background: #e53e3e; }

.status-diproses, .status-dikirim { background: #fffaf0; color: #dd6b20; border: 1px solid #feebc8; }
.status-diproses .status-dot, .status-dikirim .status-dot { background: #ed8936; }

.status-dibatalkan { background: #f7fafc; color: #4a5568; border: 1px solid #e2e8f0; }
.status-dibatalkan .status-dot { background: #a0aec0; }
</style>
@endsection