@extends('layouts.user')

@section('content')

@php
    $varian = $produk->varian;
@endphp

<div class="product-detail-container">
    
    <!-- ================= MAIN SPLIT LAYOUT ================= -->
    <div class="main-detail-layout">
        
        <!-- LEFT SIDE: IMAGE GALLERY -->
        <div class="gallery-card">
            <div class="image-wrapper">
                <img id="mainImage"
                     src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/600' }}"
                     class="main-image" 
                     alt="{{ $produk->nama }}">
            </div>

            <div class="thumb-wrapper">
                <img class="thumb active"
                     src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/100' }}"
                     onclick="setImage(this)">

                @if(isset($produk->gambarTambahan))
                    @foreach($produk->gambarTambahan as $img)
                        <img class="thumb"
                             src="{{ asset('storage/'.$img->gambar) }}"
                             onclick="setImage(this)">
                    @endforeach
                @endif
            </div>
        </div>

        <!-- RIGHT SIDE: PRODUCT SPECIFICATION INFO -->
        <div class="product-info-card">
            <small class="category-tag">
                {{ optional($produk->kategori)->nama }}
            </small>

            <h2 class="product-title">
                {{ $produk->nama }}
            </h2>

            <div class="rating-bar">
                <span class="stars">★★★★★</span>
                <span class="review-count">(120 ulasan customer)</span>
            </div>

            <h3 id="priceBox" class="product-price">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
            </h3>

            <div class="stock-status">
                <i class="fa-solid fa-warehouse"></i> Status Stok: <span id="stockBox" class="stock-highlight">Pilih Varian Terlebih Dahulu</span>
            </div>

            <hr class="divider">

            <!-- COLOR SELECTOR OPTION -->
            <div class="option-group">
                <label class="option-label">Pilih Warna Outfit</label>
                <div class="options-flex">
                    @foreach($produk->varian->unique('warna_id') as $v)
                        <button type="button"
                                class="opt-btn warna-btn"
                                data-warna="{{ $v->warna_id }}">
                            {{ $v->warna->nama }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- SIZE SELECTOR OPTION -->
            <div class="option-group">
                <label class="option-label">Pilih Ukuran</label>
                <div class="options-flex">
                    @foreach($produk->varian->unique('ukuran_id') as $v)
                        <button type="button"
                                class="opt-btn ukuran-btn"
                                data-ukuran="{{ $v->ukuran_id }}">
                            {{ $v->ukuran->kode }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- QUANTITY SELECTOR -->
            <div class="option-group quantity-section">
                <label class="option-label">Jumlah Atur</label>
                <div class="qty-counter-box">
                    <button type="button" id="minus" class="qty-btn" disabled>−</button>
                    <input type="text" id="qty" value="1" readonly>
                    <button type="button" id="plus" class="qty-btn" disabled>+</button>
                </div>
            </div>

            <!-- ACTION BUTTON FORM -->
            <div class="action-form-wrapper">
                @auth
                    <form action="{{ route('keranjang.store', $produk->id) }}" method="POST" id="cartForm">
                        @csrf
                        <input type="hidden" name="qty" id="qtyInput" value="1">
                        <input type="hidden" name="produk_varian_id" id="produkVarianInput">

                        <button type="submit" id="btnCart" class="btn-submit-cart" disabled>
                            <i class="fa-solid fa-cart-plus"></i> Silakan Pilih Varian
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-login-redirect">
                        <i class="fa-solid fa-right-to-bracket"></i> Login Untuk Membeli
                    </a>
                @endauth
            </div>

        </div>

    </div>

    <!-- ================= RELATED PRODUCTS AREA ================= -->
    <div class="related-section">
        <h3 class="section-title">Produk Serupa Untukmu ✨</h3>
        
        <div class="related-products-grid">
            @foreach($rekomendasi as $item)
                <a href="{{ route('produk.detail', $item->id) }}" class="card-related">
                    <div class="related-img-wrapper">
                        <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/300' }}" alt="{{ $item->nama }}">
                    </div>
                    <div class="related-body">
                        <small class="related-cat">{{ optional($item->kategori)->nama }}</small>
                        <h6 class="related-title">{{ $item->nama }}</h6>
                        <span class="related-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>

<style>
/* ======================== DESIGN SYSTEM DETAIL PRODUK (PURE CSS) ======================== */
.product-detail-container {
    font-family: 'Poppins', sans-serif;
    max-width: 1300px;
    margin: 0 auto;
    padding: 40px 20px;
    box-sizing: border-box;
}
.product-detail-container *, .product-detail-container *::before, .product-detail-container *::after {
    box-sizing: border-box;
}

/* MAIN LAYOUT SPLIT */
.main-detail-layout {
    display: grid;
    grid-template-columns: 1.1fr 1.3fr;
    gap: 40px;
    align-items: start;
    margin-bottom: 60px;
}

/* GALLERY CARDS */
.gallery-card {
    background: #ffffff;
    padding: 20px;
    border-radius: 24px;
    border: 1px solid #f6f0e5;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.03);
}
.image-wrapper {
    width: 100%;
    height: 480px;
    border-radius: 16px;
    overflow: hidden;
    background: #fafaf8;
}
.main-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.thumb-wrapper {
    display: flex;
    gap: 12px;
    margin-top: 16px;
    overflow-x: auto;
    padding-bottom: 4px;
}
.thumb {
    width: 76px;
    height: 76px;
    border-radius: 12px;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.2s ease;
}
.thumb.active, .thumb:hover {
    border-color: #8C6A2F;
    transform: translateY(-2px);
}

/* PRODUCT INFO BLOCK */
.product-info-card {
    background: #ffffff;
    padding: 35px;
    border-radius: 24px;
    border: 1px solid #f6f0e5;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.03);
}
.category-tag {
    color: #8C6A2F;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    display: inline-block;
    margin-bottom: 8px;
}
.product-title {
    font-size: 28px;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 12px 0;
    line-height: 1.3;
}
.rating-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}
.stars { color: #C9A227; font-size: 16px; }
.review-count { color: #888; font-size: 13px; }
.product-price {
    font-size: 30px;
    font-weight: 800;
    color: #8C6A2F;
    margin: 0 0 16px 0;
}
.stock-status {
    font-size: 14px;
    color: #555;
    display: flex;
    align-items: center;
    gap: 8px;
}
.stock-highlight {
    font-weight: 700;
    color: #222;
}
.divider {
    border: 0;
    border-top: 1px solid #f6f0e5;
    margin: 24px 0;
}

/* SELECTION OPTIONS CONTROL */
.option-group {
    margin-bottom: 20px;
}
.option-label {
    display: block;
    font-size: 13.5px;
    font-weight: 700;
    color: #444;
    margin-bottom: 10px;
}
.options-flex {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.opt-btn {
    padding: 10px 18px;
    border: 1px solid #e3d5ba;
    border-radius: 12px;
    background: #ffffff;
    color: #444;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}
.opt-btn:hover:not(:disabled) {
    border-color: #8C6A2F;
    color: #8C6A2F;
    background: #fdfbf7;
}
.opt-btn.active {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: #ffffff;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.2);
}
.opt-btn:disabled {
    background: #f5f5f5;
    border-color: #e0e0e0;
    color: #bbbbbb;
    cursor: not-allowed;
    opacity: 0.6;
}

/* QUANTITY SETTER COMPONENTS */
.qty-counter-box {
    display: flex;
    align-items: center;
    background: #faf7f2;
    border: 1px solid #e3d5ba;
    border-radius: 12px;
    width: max-content;
    overflow: hidden;
}
.qty-btn {
    width: 44px;
    height: 44px;
    border: none;
    background: transparent;
    font-size: 18px;
    font-weight: 600;
    color: #8C6A2F;
    cursor: pointer;
    transition: background 0.2s;
}
.qty-btn:hover:not(:disabled) { background: #f0e6d2; }
.qty-btn:disabled { color: #ccc; cursor: not-allowed; }
#qty {
    width: 60px;
    height: 44px;
    text-align: center;
    border: none;
    background: transparent;
    font-size: 15px;
    font-weight: 700;
    color: #222;
}

/* PURCHASE BUTTON STYLINGS */
.action-form-wrapper {
    margin-top: 30px;
}
.btn-submit-cart {
    width: 100%;
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border: none;
    padding: 16px;
    border-radius: 14px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.3s ease;
}
.btn-submit-cart:hover:not(:disabled) {
    opacity: 0.9;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(140, 106, 47, 0.25);
}
.btn-submit-cart:disabled {
    background: #e0e0e0;
    color: #999;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}
.btn-login-redirect {
    width: 100%;
    background: #222222;
    color: white;
    text-decoration: none;
    padding: 16px;
    border-radius: 14px;
    font-size: 16px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: background 0.2s;
}
.btn-login-redirect:hover { background: #444444; }

/* ================= RELATED GRID LIST ================= */
.related-section {
    margin-top: 50px;
}
.section-title {
    font-size: 20px;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 24px;
}
.related-products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}
.card-related {
    background: #ffffff;
    border-radius: 18px;
    overflow: hidden;
    text-decoration: none;
    border: 1px solid #f6f0e5;
    box-shadow: 0 6px 20px rgba(0,0,0,0.02);
    transition: all 0.3s ease;
}
.card-related:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(140, 106, 47, 0.08);
}
.related-img-wrapper {
    width: 100%;
    height: 240px;
    overflow: hidden;
    background: #fbfbf9;
}
.related-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
.related-body { padding: 16px; }
.related-cat { color: #8C6A2F; font-size: 11px; font-weight: 700; text-transform: uppercase; display: block; margin-bottom: 4px; }
.related-title { font-size: 14px; font-weight: 600; color: #222; margin: 0 0 8px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.related-price { font-size: 15px; font-weight: 700; color: #222; display: block; }

/* ================= RESPONSIVE GRAPHICS BREAKPOINTS ================= */
@media (max-width: 991px) {
    .main-detail-layout { grid-template-columns: 1fr; gap: 30px; }
    .image-wrapper { height: 400px; }
    .related-products-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
}
@media (max-width: 576px) {
    .product-info-card { padding: 20px; }
    .image-wrapper { height: 320px; }
    .related-products-grid { grid-template-columns: 1fr; }
}
</style>

<script>
// AMBIL REKAPAN LENGKAP VARIAN DARI LARAVEL BACKEND
const listVarian = @json($produk->varian);

let warnaTerpilih = null;
let ukuranTerpilih = null;
let maxStokTersedia = 0;

function setImage(el) {
    document.getElementById('mainImage').src = el.src;
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
}

// LOGIKA PILIH WARNA
document.querySelectorAll('.warna-btn').forEach(btn => {
    btn.onclick = function() {
        if (this.classList.contains('active')) {
            this.classList.remove('active');
            warnaTerpilih = null;
        } else {
            document.querySelectorAll('.warna-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            warnaTerpilih = this.dataset.warna;
        }
        validasiKetersediaanOpsi();
        sinkronisasiDataVarian();
    };
});

// LOGIKA PILIH UKURAN
document.querySelectorAll('.ukuran-btn').forEach(btn => {
    btn.onclick = function() {
        if (this.classList.contains('active')) {
            this.classList.remove('active');
            ukuranTerpilih = null;
        } else {
            document.querySelectorAll('.ukuran-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            ukuranTerpilih = this.dataset.ukuran;
        }
        validasiKetersediaanOpsi();
        sinkronisasiDataVarian();
    };
});

// MEMBATASI DAN MENGUNCI TOMBOL YANG KOMBINASI VARIANNYA TIDAK TERSEDIA / STOK HABIS
function validasiKetersediaanOpsi() {
    // 1. Validasi Tombol Ukuran berdasarkan Warna yang sedang diklik
    document.querySelectorAll('.ukuran-btn').forEach(btnUkuran => {
        const idUkuran = btnUkuran.dataset.ukuran;
        if (warnaTerpilih) {
            const adaKombinasi = listVarian.some(v => v.warna_id == warnaTerpilih && v.ukuran_id == idUkuran && v.stok > 0);
            btnUkuran.disabled = !adaKombinasi;
            if (!adaKombinasi && ukuranTerpilih == idUkuran) {
                btnUkuran.classList.remove('active');
                ukuranTerpilih = null;
            }
        } else {
            btnUkuran.disabled = false;
        }
    });

    // 2. Validasi Tombol Warna berdasarkan Ukuran yang sedang diklik
    document.querySelectorAll('.warna-btn').forEach(btnWarna => {
        const idWarna = btnWarna.dataset.warna;
        if (ukuranTerpilih) {
            const adaKombinasi = listVarian.some(v => v.ukuran_id == ukuranTerpilih && v.warna_id == idWarna && v.stok > 0);
            btnWarna.disabled = !adaKombinasi;
            if (!adaKombinasi && warnaTerpilih == idWarna) {
                btnWarna.classList.remove('active');
                warnaTerpilih = null;
            }
        } else {
            btnWarna.disabled = false;
        }
    });
}

// UPDATE INTERFACES (HARGA, STOK, DAN INPUT FORM) KETIKA DUONYA MATCH
function sinkronisasiDataVarian() {
    const match = listVarian.find(v => v.warna_id == warnaTerpilih && v.ukuran_id == ukuranTerpilih);
    const btnCart = document.getElementById('btnCart');

    if (!warnaTerpilih || !ukuranTerpilih || !match) {
        // State jika pilihan belum lengkap
        document.getElementById('stockBox').innerHTML = `<span style="color:#e67e22;">Pilih warna & ukuran dahulu</span>`;
        document.getElementById('produkVarianInput').value = '';
        
        if(btnCart) {
            btnCart.disabled = true;
            btnCart.innerHTML = `<i class="fa-solid fa-cart-plus"></i> Silakan Pilih Varian`;
        }
        
        kontrolAksesQty(0);
        return;
    }

    // Set Max Stock & Update Text Tampilan UI
    maxStokTersedia = match.stok;
    document.getElementById('priceBox').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(match.harga);
    
    if(maxStokTersedia > 0) {
        document.getElementById('stockBox').innerHTML = `<span style="color:#2ecc71; font-weight:700;">Tersedia (${maxStokTersedia} pcs)</span>`;
        document.getElementById('produkVarianInput').value = match.id;
        if(btnCart) {
            btnCart.disabled = false;
            btnCart.innerHTML = `<i class="fa-solid fa-cart-shopping"></i> Masukkan Ke Keranjang`;
        }
        kontrolAksesQty(maxStokTersedia);
    } else {
        document.getElementById('stockBox').innerHTML = `<span style="color:#e74c3c; font-weight:700;">Stok Habis</span>`;
        document.getElementById('produkVarianInput').value = '';
        if(btnCart) {
            btnCart.disabled = true;
            btnCart.innerHTML = `<i class="fa-solid fa-circle-xmark"></i> Stok Varian Habis`;
        }
        kontrolAksesQty(0);
    }
}

// MENGATUR LOCK/UNLOCK PLUS MINUS QTY
function kontrolAksesQty(stok) {
    const inputQty = document.getElementById('qty');
    const btnPlus = document.getElementById('plus');
    const btnMinus = document.getElementById('minus');
    
    if (stok <= 0) {
        inputQty.value = 1;
        btnPlus.disabled = true;
        btnMinus.disabled = true;
    } else {
        inputQty.value = 1;
        btnMinus.disabled = true; // Angka awal 1, minus mati
        btnPlus.disabled = (stok <= 1); // Jika stok cuma 1, plus mati
    }
    document.getElementById('qtyInput').value = inputQty.value;
}

// LOGIKA EVENT TOMBOL QUANTITY INPUT
const elemenQty = document.getElementById('qty');

document.getElementById('plus').onclick = function() {
    let currentVal = parseInt(elemenQty.value);
    if (currentVal < maxStokTersedia) {
        elemenQty.value = currentVal + 1;
        document.getElementById('minus').disabled = false;
    }
    if (parseInt(elemenQty.value) >= maxStokTersedia) {
        this.disabled = true;
    }
    document.getElementById('qtyInput').value = elemenQty.value;
};

document.getElementById('minus').onclick = function() {
    let currentVal = parseInt(elemenQty.value);
    if (currentVal > 1) {
        elemenQty.value = currentVal - 1;
        document.getElementById('plus').disabled = false;
    }
    if (parseInt(elemenQty.value) <= 1) {
        this.disabled = true;
    }
    document.getElementById('qtyInput').value = elemenQty.value;
};
</script>

@endsection