@extends('layouts.user')

@section('title', 'Checkout')

@section('content')
<section class="checkout-section py-5 bg-smooth-light">
    <div class="container">

        <div class="checkout-header mb-5 p-4 p-md-5 rounded-5 position-relative overflow-hidden shadow-sm">
            <div class="position-relative z-index-2">
                <span class="text-uppercase tracking-wider small fw-bold text-gold d-flex align-items-center mb-2 gap-2">
                    <i class="mdi mdi-lock-check-outline fs-6"></i> Secure Checkout
                </span>
                <h2 class="fw-extrabold text-dark m-0 tracking-tight">Checkout Pesanan</h2>
                <p class="text-muted mt-2 mb-0">Lengkapi alamat & cek ongkos kirim sebelum menyelesaikan pembayaran</p>
            </div>
            <div class="bg-pattern-overlay"></div>
        </div>

        {{-- Alert Error Validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger border-0 rounded-4 shadow-sm p-4 mb-4 d-flex align-items-start gap-3">
                <i class="mdi mdi-alert-circle-outline fs-4 text-danger mt-0.5"></i>
                <div class="flex-grow-1">
                    <h6 class="fw-bold m-0 mb-1">Periksa Kembali Data Anda:</h6>
                    <ul class="m-0 ps-3 small text-muted">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('pesanan.store') }}" method="POST" id="checkout-form">
            @csrf

            <div class="row g-4">
                {{-- FORM ALAMAT & PENGIRIMAN (KIRI) --}}
                <div class="col-lg-7 col-xl-8">
                    
                    {{-- KARTU ALAMAT --}}
                    <div class="checkout-premium-card border rounded-4 bg-white p-4 mb-4 shadow-sm">
                        <h4 class="fw-bold text-dark d-flex align-items-center gap-2 mb-4 pb-2 border-bottom-dashed">
                            <i class="mdi mdi-map-marker-outline text-gold"></i> Alamat Pengiriman
                        </h4>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <label class="small text-muted fw-bold mb-1.5 d-block">Nama Penerima</label>
                                    <input type="text" class="form-control-luxury" value="{{ auth()->user()->name }}" disabled>
                                    <small class="text-muted" style="font-size: 11px;">* Sesuai nama akun profil Anda</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <label class="small text-muted fw-bold mb-1.5 d-block">Nomor Handphone</label>
                                    <input type="text" class="form-control-luxury" value="{{ auth()->user()->phone ?? '-' }}" disabled>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating-custom dropdown-container">
                                    <label class="small text-muted fw-bold mb-1.5 d-block">Kota / Kecamatan / Kode Pos Tujuan</label>
                                    <div class="position-relative">
                                        @php
                                            $defaultLocation = '';
                                            if(auth()->user()->kota && auth()->user()->provinsi) {
                                                $defaultLocation = auth()->user()->kota . ', ' . auth()->user()->provinsi;
                                                if (auth()->user()->kode_pos) {
                                                    $defaultLocation .= ' (' . auth()->user()->kode_pos . ')';
                                                }
                                            }
                                        @endphp
                                        <input type="text" id="search-destination" class="form-control-luxury ps-5" placeholder="Ketik nama kota atau kode pos Anda (Min. 3 huruf)..." autocomplete="off" value="{{ old('search_destination', $defaultLocation) }}" required>
                                        <i class="mdi mdi-magnify position-absolute start-0 top-50 translate-middle-y ms-3 fs-5 text-muted"></i>
                                    </div>
                                    <div id="destination-list" class="destination-dropdown shadow" style="display: none;"></div>
                                </div>
                                <input type="hidden" name="destination_id" id="destination-id" value="{{ old('destination_id') }}">
                                <input type="hidden" id="base-ongkir-value">
                            </div>

                            <div class="col-12">
                                <div class="form-floating-custom">
                                    <label class="small text-muted fw-bold mb-1.5 d-block">Alamat Lengkap Pengiriman</label>
                                    <textarea class="form-control-luxury py-3" rows="3" disabled>{{ auth()->user()->alamat ?? 'Alamat belum diisi di profil.' }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <label class="small text-muted fw-bold mb-1.5 d-block">Kode Pos</label>
                                    <input type="text" id="kode-pos-field" class="form-control-luxury" value="{{ auth()->user()->kode_pos }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <label class="small text-muted fw-bold mb-1.5 d-block">Catatan Tambahan Kurir (Opsional)</label>
                                    <input type="text" name="catatan" class="form-control-luxury" placeholder="Contoh: Titip di satpam / warna cadangan" value="{{ old('catatan') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KARTU EKSPEDISI PENGIRIMAN --}}
                    <div class="checkout-premium-card border rounded-4 bg-white p-4 shadow-sm">
                        <h4 class="fw-bold text-dark d-flex align-items-center gap-2 mb-4 pb-2 border-bottom-dashed">
                            <i class="mdi mdi-truck-delivery-outline text-gold"></i> Metode Ekspedisi
                        </h4>

                        <div class="row g-3 align-items-end">
                            <div class="col-md-8">
                                <div class="form-floating-custom">
                                    <label class="small text-muted fw-bold mb-1.5 d-block">Pilih Agen Kurir</label>
                                    <div class="position-relative">
                                        <select name="courier" id="courier" class="form-select-luxury">
                                            <option value="jne">JNE (Jalur Nugraha Ekakurir)</option>
                                            <option value="jnt">J&T Express</option>
                                            <option value="sicepat">SiCepat Ekspres</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="button" id="btn-cek-ongkir" class="btn-check-fare w-100 d-flex align-items-center justify-content-center py-3 rounded-3 fw-bold shadow-sm transition-base">
                                    <span id="btn-ongkir-label"><i class="mdi mdi-calculator me-1"></i> Hitung Ongkir</span>
                                    <span id="btn-ongkir-loading" style="display:none"><i class="mdi mdi-loading mdi-spin me-1"></i> Memuat...</span>
                                </button>
                            </div>
                        </div>

                        <div id="ongkir-result" class="ongkir-result mt-4"></div>
                        <div id="ongkir-error" class="ongkir-error mt-3" style="display:none"></div>
                    </div>

                </div>

                {{-- RINGKASAN TAGIHAN BELANJA (KANAN) --}}
                <div class="col-lg-5 col-xl-4">
                    <div class="summary-checkout-card border bg-white rounded-4 p-4 shadow-sm position-sticky">
                        <h4 class="fw-extrabold text-dark tracking-tight mb-4 pb-2 border-bottom">Ringkasan Pesanan</h4>

                        @php
                            $subtotal = 0;
                            $weight   = 0;
                        @endphp

                        <div class="summary-list-scroll mb-4 pe-1">
                            @foreach($keranjang as $item)
                                @php
                                    $harga     = $item->varian->harga ?? $item->produk->harga;
                                    $subtotal += $harga * $item->qty;
                                    $weight   += ($item->produk->berat ?? 1000) * $item->qty;
                                @endphp

                                <div class="d-flex justify-content-between align-items-center gap-3 py-2.5 border-bottom-dashed">
                                    <div class="flex-grow-1 min-w-0">
                                        <span class="item-name text-dark fw-semibold small d-block text-truncate">{{ $item->produk->nama }}</span>
                                        <small class="badge-qty px-2 py-0.5 rounded-pill text-gold small fw-bold bg-gold-light mt-1 d-inline-block">
                                            Kuantitas: {{ $item->qty }}x
                                        </small>
                                    </div>
                                    <strong class="text-dark small flex-shrink-0">
                                        Rp {{ number_format($harga * $item->qty, 0, ',', '.') }}
                                    </strong>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2.5">
                            <span class="text-muted small">Subtotal Produk</span>
                            <strong class="text-dark">Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">Biaya Pengiriman</span>
                            <strong id="ongkir-text" class="text-placeholder small">— Belum Dihitung</strong>
                        </div>

                        <div class="pt-3 border-top border-2">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fw-bold text-dark fs-6">Total Pembayaran</span>
                                <span id="grand-total" class="fw-extrabold text-gold fs-4">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        {{-- Hidden Input data operasional form store --}}
                        <input type="hidden" name="ongkir"  id="ongkir-value" value="-1">
                        <input type="hidden" name="weight"  id="weight-value" value="{{ $weight }}">
                        <input type="hidden" id="subtotal-value" value="{{ $subtotal }}">
                        <input type="hidden" name="metode_pembayaran" value="midtrans">

                        <button type="submit" class="btn-checkout-premium w-100 d-flex align-items-center justify-content-center gap-2 py-3 rounded-pill text-decoration-none fw-bold shadow transition-base" id="btn-submit" disabled>
                            <i class="mdi mdi-credit-card-outline fs-5"></i> Buat Pesanan Sekarang
                        </button>

                        <div class="text-center mt-3.5">
                            <span class="text-muted d-inline-flex align-items-center gap-1.5" style="font-size: 11px;">
                                <i class="mdi mdi-shield-lock-outline text-success fs-6"></i> Pembayaran Terproteksi & Garansi Sistem Aman
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<style>
/* UTILITIES & BRANDING VARIABLES */
.checkout-section { font-family: 'Poppins', sans-serif; letter-spacing: -0.1px; }
.bg-smooth-light { background-color: #fcfbfa; }
.fw-extrabold { font-weight: 800; }
.text-gold { color: #8C6A2F; }
.bg-gold-light { background-color: #faf6ed; }
.tracking-wider { letter-spacing: 1.2px; }
.tracking-tight { letter-spacing: -0.5px; }
.z-index-2 { z-index: 2; }
.border-bottom-dashed { border-bottom: 1px dashed #efe7d3 !important; }
.transition-base { transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); }

/* HEADER BRANDING BANNER */
.checkout-header { background: #faf7f2; border: 1px solid #f3ebd9; }
.checkout-header h2 { font-size: 32px; color: #2d2a24; }
.bg-pattern-overlay { 
    position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.05; pointer-events: none;
    background-image: radial-gradient(#8C6A2F 1.5px, transparent 0); background-size: 20px 20px; 
}

.checkout-premium-card, .summary-checkout-card { border-color: #f2ebd9 !important; }
.summary-checkout-card { top: 100px; }

/* RE-ENGINEERING FORM INPUT CONTROL */
.form-control-luxury, .form-select-luxury {
    width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #dcd6cc;
    font-size: 14px; background-color: #fdfcfb; color: #2d2a24; transition: all 0.25s; outline: none !important;
}
.form-control-luxury:focus, .form-select-luxury:focus { border-color: #8C6A2F; background-color: #ffffff; box-shadow: 0 0 0 4px rgba(140, 106, 47, 0.08); }
.form-control-luxury:disabled { background-color: #f4f1eb; color: #7a756b; opacity: 0.85; cursor: not-allowed; border-color: #ebdcb9; }

.form-select-luxury {
    appearance: none; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%238C6A2F' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3csvg%3e");
    background-repeat: no-repeat; background-position: right 16px center; background-size: 12px 12px; padding-right: 40px;
}

/* REAL-TIME DROPDOWN RESULTS AREA */
.dropdown-container { position: relative; }
.destination-dropdown {
    position: absolute; top: calc(100% + 6px); left: 0; right: 0;
    background: #ffffff; border: 1px solid #ebdcb9; border-radius: 14px;
    z-index: 1050; max-height: 220px; overflow-y: auto; padding: 6px;
}
.destination-dropdown .dest-item { padding: 10px 14px; font-size: 13.5px; border-radius: 10px; cursor: pointer; color: #4a453c; transition: all 0.15s; }
.destination-dropdown .dest-item:hover { background: #faf6ed; color: #8C6A2F; font-weight: 600; }

.btn-check-fare { background-color: #ffffff; color: #8C6A2F; border: 1px solid #8C6A2F; height: 47px; }
.btn-check-fare:hover:not(:disabled) { background-color: #faf6ed; color: #705423; border-color: #705423; }

.ongkir-result .service-option {
    display: flex; justify-content: space-between; align-items: center; padding: 14px 18px; border: 1px solid #ebdcb9; border-radius: 12px;
    margin-bottom: 10px; cursor: pointer; transition: all 0.25s ease; background-color: #fff;
}
.ongkir-result .service-option:hover { border-color: #8C6A2F; background: #faf8f5; }
.ongkir-result .service-option.selected { border-color: #8C6A2F; background: #faf6ed; box-shadow: 0 0 0 1px #8C6A2F; }
.service-option .svc-name { font-weight: 700; color: #2d2a24; font-size: 14px; }
.service-option .svc-etd  { font-size: 11.5px; color: #867d6c; margin-top: 3px; }
.service-option .svc-cost { font-weight: 800; color: #8C6A2F; font-size: 16px; }

.ongkir-error { padding: 12px 16px; background: #fdf2f2; border: 1px solid #f5c6cb; border-radius: 12px; font-size: 13px; color: #b71c1c; }
.summary-list-scroll { max-height: 165px; overflow-y: auto; }
.badge-qty { background-color: #faf6ed; border: 1px solid #f2e6cb; font-size: 10px; }
.text-placeholder { color: #b2ab9c; font-style: italic; font-weight: 400; }

.btn-checkout-premium { background: linear-gradient(135deg, #8C6A2F, #705423); color: white; font-size: 15px; border: none; }
.btn-checkout-premium:hover:not(:disabled) { color: white; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(140, 106, 47, 0.25) !important; }
.btn-checkout-premium:disabled { background: #e2e8f0 !important; color: #94a3b8 !important; box-shadow: none !important; cursor: not-allowed; }

.summary-list-scroll::-webkit-scrollbar, .destination-dropdown::-webkit-scrollbar { width: 5px; }
.summary-list-scroll::-webkit-scrollbar-thumb, .destination-dropdown::-webkit-scrollbar-thumb { background: #ebdcb9; border-radius: 10px; }

@media (max-width: 991.98px) {
    .summary-checkout-card { position: static !important; margin-bottom: 25px; }
    .checkout-header h2 { font-size: 26px; }
}
</style>

<script>
(function () {
    'use strict';

    const searchInput     = document.getElementById('search-destination');
    const destinationList = document.getElementById('destination-list');
    const destinationId   = document.getElementById('destination-id');
    const baseOngkirInput = document.getElementById('base-ongkir-value');
    
    const courierSelect   = document.getElementById('courier');
    const btnCekOngkir    = document.getElementById('btn-cek-ongkir');
    const btnLabel        = document.getElementById('btn-ongkir-label');
    const btnLoading      = document.getElementById('btn-ongkir-loading');
    const ongkirResult    = document.getElementById('ongkir-result');
    const ongkirError     = document.getElementById('ongkir-error');
    const ongkirText      = document.getElementById('ongkir-text');
    const ongkirValue     = document.getElementById('ongkir-value');
    const grandTotal      = document.getElementById('grand-total');
    const subtotalInput   = document.getElementById('subtotal-value');
    const btnSubmit       = document.getElementById('btn-submit');

    function formatRupiah(angka) {
        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    function setOngkirLoading(isLoading) {
        btnCekOngkir.disabled    = isLoading;
        btnLabel.style.display   = isLoading ? 'none'   : 'inline';
        btnLoading.style.display = isLoading ? 'inline' : 'none';
    }

    function showOngkirError(msg) {
        ongkirError.textContent   = msg;
        ongkirError.style.display = 'block';
        ongkirResult.innerHTML    = '';
    }

    function hideOngkirError() {
        ongkirError.style.display = 'none';
    }

    // FIX ROUTE JALUR: Menghilangkan prefiks /api/ karena rute terdaftar di web controller biasa
    window.addEventListener('DOMContentLoaded', async () => {
        const currentLoc = searchInput.value.trim();
        if (currentLoc.length >= 3) {
            try {
                const cityName = currentLoc.split(',')[0].trim();
                const res = await fetch(`/search-city?search=${encodeURIComponent(cityName)}`);
                const json = await res.json();
                if (res.ok && json.status && json.data.length > 0) {
                    const exactMatch = json.data.find(item => item.label.toLowerCase() === currentLoc.toLowerCase()) || json.data[0];
                    baseOngkirInput.value = exactMatch.base_cost;
                    destinationId.value = exactMatch.id; // Isi ID aslinya untuk keamanan
                }
            } catch (err) {
                console.error("Gagal memuat otomatis base cost rute: ", err);
            }
        }
    });

    let searchTimer;
    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimer);
        const q = this.value.trim();

        if (q.length < 3) {
            destinationList.innerHTML = '';
            destinationList.style.display = 'none';
            return;
        }

        searchTimer = setTimeout(async () => {
            try {
                destinationList.innerHTML = '<div class="dest-item small text-muted text-center py-2"><i class="mdi mdi-loading mdi-spin me-1"></i> Mencari lokasi...</div>';
                destinationList.style.display = 'block';

                // FIX ROUTE JALUR: Sesuaikan endpoint panggilannya
                const res = await fetch(`/search-city?search=${encodeURIComponent(q)}`);
                const json = await res.json();

                if (!res.ok || json.status === false) {
                    destinationList.innerHTML = `<div class="dest-item text-danger small py-2">Gagal memuat rute wilayah.</div>`;
                    return;
                }

                if (!json.data || json.data.length === 0) {
                    destinationList.innerHTML = '<div class="dest-item text-muted small py-2 text-center">Lokasi tidak ditemukan</div>';
                    return;
                }

                destinationList.innerHTML = json.data.map(item => `
                    <div class="dest-item"
                         data-id="${item.id}"
                         data-base_cost="${item.base_cost}"
                         data-label="${item.label.replace(/"/g, '&quot;')}">
                        <i class="mdi mdi-map-marker-radius text-gold me-1.5"></i>${item.label}
                    </div>
                `).join('');

            } catch (err) {
                destinationList.innerHTML = `<div class="dest-item text-danger small py-2">Error: Hubungan database terputus</div>`;
            }
        }, 400);
    });

    destinationList.addEventListener('click', function (e) {
        const item = e.target.closest('.dest-item[data-id]');
        if (!item) return;

        destinationId.value           = item.dataset.id; // Amankan ID untuk dikirim ke request store
        searchInput.value             = item.dataset.label;
        baseOngkirInput.value         = item.dataset.base_cost; 

        destinationList.innerHTML     = '';
        destinationList.style.display = 'none';
        resetOngkir();
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('#search-destination') && !e.target.closest('#destination-list')) {
            destinationList.innerHTML = '';
            destinationList.style.display = 'none';
        }
    });

    function resetOngkir() {
        ongkirValue.value      = '-1';
        ongkirText.textContent = '— Belum Dihitung';
        ongkirText.className   = 'text-placeholder small';
        ongkirResult.innerHTML = '';
        hideOngkirError();
        updateGrandTotal(0, false);
        btnSubmit.disabled     = true;
    }

    function updateGrandTotal(cost, includeOngkir = true) {
        const subtotal = parseInt(subtotalInput.value, 10) || 0;
        const total    = includeOngkir ? subtotal + cost : subtotal;
        grandTotal.textContent = formatRupiah(total);
    }

    courierSelect.addEventListener('change', resetOngkir);

    btnCekOngkir.addEventListener('click', function () {
        const destination = destinationId.value;
        const baseCost    = parseFloat(baseOngkirInput.value);

        hideOngkirError();

        if (!destination || isNaN(baseCost)) {
            showOngkirError('Silakan pilih lokasi tujuan terlebih dahulu melalui kolom pencarian.');
            searchInput.focus();
            return;
        }

        setOngkirLoading(true);

        setTimeout(() => {
            const courier = courierSelect.value;
            let costs = [];

            if (courier === 'jne') {
                costs = [
                    { service: 'REG', description: 'Layanan Reguler', cost: baseCost, etd: '2-3 Hari' },
                    { service: 'YES', description: 'Yakin Esok Sampai', cost: baseCost + 12000, etd: '1 Hari' }
                ];
            } else if (courier === 'jnt') {
                costs = [
                    { service: 'EZ', description: 'Reguler Service', cost: baseCost + 1000, etd: '2-3 Hari' }
                ];
            } else if (courier === 'sicepat') {
                costs = [
                    { service: 'SIUNTUNG', description: 'Layanan Cepat', cost: baseCost, etd: '2-3 Hari' },
                    { service: 'HALU', description: 'Harga Mulai Lima Ribu', cost: baseCost > 7000 ? baseCost - 4000 : baseCost, etd: '3-5 Hari' }
                ];
            }

            renderOngkirOptions(costs);
            setOngkirLoading(false);
        }, 400);
    });

    function renderOngkirOptions(costs) {
        ongkirResult.innerHTML = '';
        costs.forEach(service => {
            const cost = service.cost;
            const div = document.createElement('div');
            div.className    = 'service-option';
            div.innerHTML = `
                <div>
                    <div class="svc-name">${service.service} (${service.description})</div>
                    <div class="svc-etd"><i class="mdi mdi-clock-outline me-1"></i>Estimasi: ${service.etd}</div>
                </div>
                <div class="svc-cost">${formatRupiah(cost)}</div>
            `;

            div.addEventListener('click', function () {
                document.querySelectorAll('.service-option').forEach(el => el.classList.remove('selected'));
                this.classList.add('selected');

                ongkirValue.value      = cost;
                ongkirText.textContent = formatRupiah(cost);
                ongkirText.className   = 'text-dark'; 
                updateGrandTotal(cost, true);
                btnSubmit.disabled     = false; 
            });

            ongkirResult.appendChild(div);
        });
    }
})();
</script>
@endsection