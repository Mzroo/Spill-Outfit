@extends('layouts.user')

@section('title', 'Keranjang Belanja')

@section('content')
<section class="cart-section py-5 bg-smooth-light">
    <div class="container">

        <div class="cart-header mb-5 p-4 p-md-5 rounded-5 position-relative overflow-hidden shadow-sm">
            <div class="position-relative z-index-2">
                <span class="text-uppercase tracking-wider small fw-bold text-gold d-flex align-items-center mb-2 gap-2">
                    <i class="mdi mdi-shopping-outline fs-6"></i> My Cart
                </span>
                <h2 class="fw-extrabold text-dark m-0 tracking-tight">Keranjang Saya</h2>
                <p class="text-muted mt-2 mb-0">Outfit pilihanmu siap untuk dibawa pulang ✨</p>
            </div>
            <div class="bg-pattern-overlay"></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                @forelse($keranjang as $item)
                    @php
                        $harga = $item->varian?->harga ?? $item->produk?->harga ?? 0;
                        $subtotal = $harga * $item->qty;
                    @endphp

                    <div class="cart-card-item border rounded-4 bg-white p-3 p-md-4 mb-3 position-relative shadow-sm transition-base">
                        
                        <div class="d-flex flex-column flex-sm-row gap-4 align-items-start align-items-sm-center w-100">
                            
                            <div class="cart-image-wrapper bg-smooth-gray rounded-4 overflow-hidden position-relative flex-shrink-0">
                                @if($item->produk?->gambar && \Storage::disk('public')->exists($item->produk->gambar))
                                    <img src="{{ asset('storage/' . $item->produk->gambar) }}" alt="{{ $item->produk->nama }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <img src="{{ asset('images/default-clothing.jpg') }}" alt="No Image" class="w-100 h-100 object-fit-cover">
                                @endif
                            </div>

                            <div class="flex-grow-1 w-100">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                    <span class="text-muted small text-uppercase fw-bold tracking-wider custom-muted-text">
                                        {{ optional($item->produk?->kategori)->nama ?? 'Outfit' }}
                                    </span>
                                    
                                    <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete-minimalist transition-base" onclick="return confirm('Hapus produk dari keranjang?')">
                                            <i class="mdi mdi-delete-outline fs-5"></i>
                                        </button>
                                    </form>
                                </div>

                                <h5 class="product-name fw-bold text-dark mb-2 transition-color">
                                    {{ $item->produk?->nama }}
                                </h5>

                                <div class="variant-box d-flex gap-2 flex-wrap mb-3">
                                    <span class="variant-tag small fw-semibold px-3 py-1 rounded-pill">
                                        Warna: {{ optional($item->varian?->warna)->nama ?? '-' }}
                                    </span>
                                    <span class="variant-tag small fw-semibold px-3 py-1 rounded-pill">
                                        Size: {{ optional($item->varian?->ukuran)->kode ?? '-' }}
                                    </span>
                                </div>

                                <div class="price-unit fw-bold text-gold mb-3 fs-6">
                                    Rp {{ number_format($harga, 0, ',', '.') }}
                                </div>

                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-3 border-top-dashed">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="small text-muted fw-semibold">Jumlah:</span>
                                        <div class="qty-control-box d-flex align-items-center rounded-pill border bg-light p-1">
                                            
                                            <form action="{{ route('keranjang.updateQty', $item->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="action" value="minus">
                                                <button type="submit" class="qty-control-btn d-flex align-items-center justify-content-center rounded-circle border-0 transition-base" {{ $item->qty <= 1 ? 'disabled' : '' }}>
                                                    <i class="mdi mdi-minus fw-bold"></i>
                                                </button>
                                            </form>

                                            <span class="qty-display-number fw-bold text-center mx-2">
                                                {{ $item->qty }}
                                            </span>

                                            <form action="{{ route('keranjang.updateQty', $item->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="action" value="plus">
                                                <button type="submit" class="qty-control-btn d-flex align-items-center justify-content-center rounded-circle border-0 transition-base">
                                                    <i class="mdi mdi-plus fw-bold"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="text-sm-end">
                                        <span class="small text-muted d-block fs-7 mb-0.5">Subtotal</span>
                                        <span class="item-subtotal-price fw-extrabold text-dark fs-5">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="empty-cart-box text-center py-5 px-4 rounded-5 shadow-sm border-dashed bg-white">
                        <div class="empty-icon-circle mx-auto mb-4 d-flex align-items-center justify-content-center bg-gold-light rounded-circle">
                            <i class="mdi mdi-cart-remove text-gold" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="fw-extrabold text-dark mb-2">Keranjang Belanja Kosong</h4>
                        <p class="text-muted small max-w-sm mx-auto mb-4 lh-lg">Kamu belum menambahkan item apa pun ke keranjang. Cari outfit impianmu sekarang!</p>
                        <a href="{{ route('produk.index') }}" class="btn-shop-now px-4 py-2.5 rounded-pill text-decoration-none fw-bold shadow-sm transition-base d-inline-flex align-items-center gap-2">
                            <i class="mdi mdi-storefront-outline"></i> Mulai Belanja
                        </a>
                    </div>
                @endforelse

                @if($keranjang->count() > 0 && method_exists($keranjang, 'links'))
                    <div class="d-flex justify-content-center mt-4 pagination-luxury">
                        <nav class="shadow-sm rounded-pill p-2 bg-white border">
                            {{ $keranjang->links() }}
                        </nav>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="summary-checkout-card border bg-white rounded-4 p-4 shadow-sm position-sticky">
                    <h4 class="fw-extrabold text-dark tracking-tight mb-4 pb-2 border-bottom">Ringkasan Belanja</h4>

                    @php
                        $total = 0;
                        foreach ($keranjang as $item) {
                            $harga = $item->varian?->harga ?? $item->produk?->harga ?? 0;
                            $total += $harga * $item->qty;
                        }
                    @endphp

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted fw-semibold">Total Tagihan</span>
                        <span class="total-summary-price fw-extrabold text-gold fs-4">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    @if($keranjang->count() > 0)
                        <a href="{{ route('checkout') }}" class="btn-checkout-premium w-100 d-flex align-items-center justify-content-center gap-2 py-3 rounded-pill text-decoration-none fw-bold shadow transition-base">
                            <i class="mdi mdi-lock-outline fs-5"></i> Lanjut ke Checkout
                        </a>
                    @else
                        <button class="btn btn-secondary w-100 py-3 rounded-pill fw-bold border-0 opacity-50" disabled>
                            Checkout Dikunci
                        </button>
                    @endif

                    <div class="text-center mt-3">
                        <span class="text-muted d-inline-flex align-items-center gap-1" style="font-size: 11px;">
                            <i class="mdi mdi-shield-check-outline text-success"></i> Transaksi Aman & Terenkripsi
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
/* BASE LAYOUT ENGINE */
.cart-section { font-family: 'Poppins', sans-serif; letter-spacing: -0.1px; }
.bg-smooth-light { background-color: #fcfbfa; }
.bg-smooth-gray { background-color: #f5f2eb; }
.fw-extrabold { font-weight: 800; }
.text-gold { color: #8C6A2F; }
.bg-gold-light { background-color: #faf6ed; }
.tracking-wider { letter-spacing: 1.2px; }
.tracking-tight { letter-spacing: -0.5px; }
.z-index-2 { z-index: 2; }
.max-w-sm { max-width: 400px; }
.fs-7 { font-size: 0.82rem; }
.border-top-dashed { border-top: 1px dashed #efe7d3; }

/* TRANSITION LOOPS */
.transition-base { transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); }

/* HEADER BRANDING */
.cart-header { background: #faf7f2; border: 1px solid #f3ebd9; }
.cart-header h2 { font-size: 32px; color: #2d2a24; }
.bg-pattern-overlay { 
    position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.05; pointer-events: none;
    background-image: radial-gradient(#8C6A2F 1.5px, transparent 0); background-size: 20px 20px; 
}

/* PREMIUM SHOPPING CARD ITEM */
.cart-card-item { border-color: #f2ebd9 !important; }
.cart-card-item:hover { 
    box-shadow: 0 12px 30px rgba(140, 106, 47, 0.08) !important; 
    border-color: #ebdcb9 !important; 
}
.cart-image-wrapper { width: 110px; height: 110px; border: 1px solid #e3d5ba; }
.custom-muted-text { font-size: 10px; color: #a39782 !important; }
.product-name { font-size: 16px; color: #2d2a24; line-height: 1.4; }

/* VARIANT FLAGS */
.variant-tag { background: #faf6ed; color: #8C6A2F; border: 1px solid #f2e6cb; font-size: 11px; }

/* QUANTITY CONTROLLER MECHANISM */
.qty-control-box { border-color: #e3d5ba !important; background-color: #ffffff !important; }
.qty-control-btn { width: 28px; height: 28px; background-color: #faf7f2; color: #8C6A2F; font-size: 14px; }
.qty-control-btn:hover:not(:disabled) { background-color: #8C6A2F; color: white; }
.qty-control-btn:disabled { opacity: 0.3; cursor: not-allowed; }
.qty-display-number { min-width: 30px; font-size: 14px; color: #2d2a24; }

/* ACTION TRASH BUTTON */
.btn-delete-minimalist { background: none; border: none; color: #b7b0a3; padding: 4px 8px; border-radius: 8px; }
.btn-delete-minimalist:hover { color: #e74c3c; background-color: #fdf2f2; }

/* SUMMARY SIDEBAR PANELS */
.summary-checkout-card { border-color: #f2ebd9 !important; top: 100px; }
.total-summary-price { letter-spacing: -0.5px; }
.btn-checkout-premium { 
    background: linear-gradient(135deg, #8C6A2F, #705423); 
    color: white; font-size: 15px; border: none;
}
.btn-checkout-premium:hover { color: white; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(140, 106, 47, 0.25) !important; }

/* EMPTY MODULES */
.empty-cart-box { border: 1px dashed #decfae !important; background: #ffffff; }
.empty-icon-circle { width: 85px; height: 85px; background-color: #faf6ed; }
.btn-shop-now { background: #8C6A2F; color: white; font-size: 14px; }
.btn-shop-now:hover { background: #6e5223; color: white; transform: translateY(-2px); }

/* LUXURY CORE PAGINATION SYSTEM */
.pagination-luxury nav { display: inline-block; }
.pagination-luxury .pagination { margin: 0; display: flex; gap: 4px; border: none; }
.pagination-luxury .page-item .page-link { border: none; background: transparent; color: #615a4c; font-weight: 600; padding: 6px 14px; border-radius: 50px; transition: all 0.2s; font-size: 13px; }
.pagination-luxury .page-item.active .page-link { background-color: #8C6A2F !important; color: white !important; box-shadow: 0 4px 10px rgba(140, 106, 47, 0.2); }
.pagination-luxury .page-item .page-link:hover:not(.active) { background-color: #faf6ed; color: #8C6A2F; }

/* MEDIA BREAKPOINT LAYOUTS */
@media (max-width: 576px) {
    .cart-image-wrapper { width: 100%; height: 200px; }
    .product-name { font-size: 15px; }
    .cart-header h2 { font-size: 26px; }
    .cart-header { border-radius: 24px !important; }
}
</style>
@endsection