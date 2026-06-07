@extends('layouts.user')

@section('title', 'Detail Pesanan')

@section('content')

<section class="detail-section">
    <div class="container py-5">

        <div class="page-header-modern mb-5">
            <div class="header-info">
                <span class="badge-order-modern">INVOICE TRANSACTION</span>
                <h2>#{{ $pesanan->kode_pesanan }}</h2>
                <p class="text-muted mt-1">Dibuat pada: {{ $pesanan->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
            <div class="status-box-modern status-{{ strtolower($pesanan->status) }}">
                <span class="status-dot"></span>
                <span class="status-text">{{ strtoupper($pesanan->status) }}</span>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card-box-modern mb-4">
                    <div class="card-header-custom mb-4">
                        <i class="mdi mdi-shopping-outline icon-lead"></i>
                        <h4>Produk Dipesan</h4>
                    </div>
                    
                    <div class="product-list">
                        @foreach($pesanan->items as $item)
                        <div class="product-item-modern">
                            <div class="product-image-modern">
                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/300' }}" alt="{{ $item->nama_produk }}">
                            </div>
                            <div class="product-body-modern">
                                <h5>{{ $item->nama_produk }}</h5>
                                <span class="variant-badge">{{ $item->nama_varian ?? 'Default Varian' }}</span>
                                <div class="qty-price-info mt-2">
                                    <span class="qty-text">{{ $item->qty }} barang</span>
                                    <span class="multiplier">×</span>
                                    <span class="unit-price">Rp {{ number_format($item->harga,0,',','.') }}</span>
                                </div>
                            </div>
                            <div class="product-price-modern">
                                Rp {{ number_format($item->subtotal,0,',','.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-box-modern">
                    <div class="card-header-custom mb-4">
                        <i class="mdi mdi-map-marker-radius-outline icon-lead"></i>
                        <h4>Alamat Pengiriman</h4>
                    </div>
                    <div class="address-box-modern">
                        <h5>{{ Auth::user()->name }}</h5>
                        <div class="phone-badge mt-1 mb-3">
                            <i class="mdi mdi-phone-outline"></i> {{ Auth::user()->phone ?? '-' }}
                        </div>
                        <p class="full-address">{{ Auth::user()->alamat ?? 'Alamat utama belum dikonfigurasi di profil.' }}</p>
                        <div class="region-tags mt-3">
                            <span>{{ Auth::user()->kota ?? '-' }}</span>
                            <span>{{ Auth::user()->provinsi ?? '-' }}</span>
                            @if(Auth::user()->kode_pos)
                                <span class="postal-code">ZIP {{ Auth::user()->kode_pos }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-box-modern sticky-card-modern">
                    <div class="card-header-custom mb-4">
                        <i class="mdi mdi-wallet-outline icon-lead"></i>
                        <h4>Ringkasan Pembayaran</h4>
                    </div>
                    
                    <div class="summary-list-modern">
                        <div class="summary-item-modern">
                            <span class="text-secondary">Metode Pembayaran</span>
                            <span class="fw-semibold text-dark">{{ strtoupper($pesanan->metode_pembayaran) }}</span>
                        </div>
                        <div class="summary-item-modern">
                            <span class="text-secondary">Status Sistem</span>
                            <span class="fw-semibold badge-inline-status status-{{ strtolower($pesanan->status) }}">{{ strtoupper($pesanan->status) }}</span>
                        </div>
                        
                        <div class="divider-dashedMy my-3"></div>
                        
                        <div class="summary-item-modern">
                            <span class="text-secondary">Subtotal Produk</span>
                            <span class="text-dark">Rp {{ number_format($pesanan->subtotal,0,',','.') }}</span>
                        </div>
                        <div class="summary-item-modern">
                            <span class="text-secondary">Biaya Ongkir</span>
                            <span class="text-dark">Rp {{ number_format($pesanan->ongkir,0,',','.') }}</span>
                        </div>
                        
                        <div class="divider-dashedMy my-3"></div>
                        
                        <div class="summary-item-modern total-row-modern mb-4">
                            <span class="total-label">Total Tagihan</span>
                            <span class="total-amount-large">Rp {{ number_format($pesanan->total_harga,0,',','.') }}</span>
                        </div>
                    </div>

                    {{-- BUTTON MIDTRANS ACTION --}}
                    @if($pesanan->status == 'unpaid' && $snapToken)
                        <button id="pay-button" class="btn-pay-modern w-100 py-3 rounded-3 shadow-sm">
                            <i class="mdi mdi-credit-card-chip-outline me-2"></i> Bayar Sekarang
                        </button>
                    @endif

                    @if(isset($pesanan->bukti_pembayaran) && $pesanan->bukti_pembayaran)
                        <div class="mt-4">
                            <h5 class="small-title-heavy mb-2">Bukti Transaksi Resmi</h5>
                            <div class="proof-image-wrapper">
                                <img src="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" class="payment-proof-modern" alt="Bukti Transfer">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STYLING MODERN (CSS SENSASI PREMIUM) --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.detail-section { 
    background: #f8f9fa; 
    min-height: 100vh; 
    font-family: 'Plus Jakarta Sans', sans-serif; 
    color: #2d3748;
}

/* Header Area */
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
.badge-order-modern {
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

/* Master Cards Layout */
.card-box-modern {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
    border: 1px solid #edf2f7;
}
.card-header-custom {
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid #f7fafc;
    padding-bottom: 15px;
}
.card-header-custom h4 {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    color: #1a202c;
}
.icon-lead {
    font-size: 22px;
    color: #8C6A2F;
}

/* Product Row Styles */
.product-item-modern {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 16px 0;
    border-bottom: 1px solid #f1f5f9;
}
.product-item-modern:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.product-image-modern {
    width: 85px;
    height: 85px;
    overflow: hidden;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    flex-shrink: 0;
}
.product-image-modern img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.product-body-modern {
    flex-grow: 1;
}
.product-body-modern h5 {
    font-size: 15px;
    font-weight: 700;
    margin: 0 0 4px 0;
    color: #1a202c;
}
.variant-badge {
    font-size: 12px;
    color: #718096;
    background: #edf2f7;
    padding: 3px 8px;
    border-radius: 6px;
}
.qty-price-info {
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.qty-text { color: #4a5568; font-weight: 500; }
.multiplier { color: #a0aec0; }
.unit-price { color: #718096; }
.product-price-modern {
    font-size: 16px;
    font-weight: 700;
    color: #1a202c;
}

/* Address Box Styles */
.address-box-modern h5 {
    font-size: 16px;
    font-weight: 700;
    margin: 0;
}
.phone-badge {
    font-size: 13px;
    color: #4a5568;
    background: #f7fafc;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
}
.full-address {
    color: #4a5568;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
}
.region-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.region-tags span {
    font-size: 12px;
    font-weight: 600;
    background: #edf2f7;
    padding: 5px 12px;
    border-radius: 6px;
    color: #4a5568;
}
.region-tags span.postal-code {
    background: #e2e8f0;
    color: #2d3748;
}

/* Dynamic Badge Status Control Center */
.status-box-modern {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 0.5px;
}
.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

/* Status Colors Matrix */
.status-paid, .status-selesai { background: #e6fffa; color: #047481; border: 1px solid #b2f5ea; }
.status-paid .status-dot, .status-selesai .status-dot { background: #319795; }

.status-unpaid { background: #fff5f5; color: #9b2c2c; border: 1px solid #fed7d7; }
.status-unpaid .status-dot { background: #e53e3e; }

.status-diproses, .status-dikirim { background: #fffaf0; color: #dd6b20; border: 1px solid #feebc8; }
.status-diproses .status-dot, .status-dikirim .status-dot { background: #ed8936; }

.status-dibatalkan { background: #f7fafc; color: #4a5568; border: 1px solid #e2e8f0; }
.status-dibatalkan .status-dot { background: #a0aec0; }

.badge-inline-status {
    padding: 4px 10px !important;
    border-radius: 6px !important;
    font-size: 11px !important;
}

/* Summary System Styling */
.summary-item-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
    font-size: 14px;
}
.divider-dashedMy {
    border-top: 1px dashed #e2e8f0;
    height: 0;
    width: 100%;
}
.total-row-modern {
    margin-top: 18px;
}
.total-label {
    font-size: 15px;
    font-weight: 700;
    color: #1a202c;
}
.total-amount-large {
    font-size: 22px;
    font-weight: 800;
    color: #8C6A2F;
}

/* Premium Button Action */
.btn-pay-modern {
    background: #8C6A2F;
    color: #ffffff;
    border: none;
    font-weight: 700;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.25s ease;
}
.btn-pay-modern:hover {
    background: #705423;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(140, 106, 47, 0.25) !important;
}
.btn-pay-modern:active {
    transform: translateY(0);
}

.sticky-card-modern {
    position: sticky;
    top: 30px;
}
.proof-image-wrapper {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #edf2f7;
}
.payment-proof-modern {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
}
</style>

{{-- SCRIPT MIDTRANS SANBOX --}}
@if($pesanan->status == 'unpaid' && $snapToken)
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){ window.location.reload(); },
                onPending: function(result){ alert("Menunggu konfirmasi pembayaran Anda!"); },
                onError: function(result){ alert("Waktu pembayaran habis atau gagal!"); }
            });
        };
    </script>
@endif
@endsection