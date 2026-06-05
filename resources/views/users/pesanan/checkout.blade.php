@extends('layouts.user')

@section('title', 'Checkout')

@section('content')

<section class="checkout-section">
<div class="container">

    <div class="checkout-header">
        <h2>Checkout Pesanan</h2>
        <p>Lengkapi alamat & cek ongkir sebelum bayar</p>
    </div>

    {{-- Alert error validasi --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pesanan.store') }}" method="POST" id="checkout-form">
        @csrf

        <div class="checkout-wrapper">

            {{-- ================= LEFT ================= --}}
            <div class="checkout-left">

                {{-- ALAMAT --}}
                <div class="checkout-card">
                    <h4>Alamat Pengiriman</h4>

                    <div class="field-group">
                        <label>Nama Penerima</label>
                        <input type="text"
                            name="nama_penerima"
                            placeholder="Nama Penerima"
                            value="{{ old('nama_penerima', auth()->user()->profile?->nama_penerima) }}"
                            required>
                    </div>

                    <div class="field-group">
                        <label>No HP</label>
                        <input type="text"
                            name="no_hp"
                            placeholder="08xxxxxxxxxx"
                            value="{{ old('no_hp', auth()->user()->profile?->no_hp) }}"
                            required>
                    </div>

                    {{-- SEARCH DESTINATION --}}
                    <div class="field-group dropdown-container">
                        <label>Kota / Kecamatan Tujuan</label>
                        <input type="text"
                            id="search-destination"
                            placeholder="Ketik min. 3 huruf untuk mencari..."
                            autocomplete="off">
                        
                        {{-- Dropdown diposisikan relatif terhadap kontainer ini --}}
                        <div id="destination-list" class="destination-dropdown" style="display: none;"></div>
                    </div>

                    <input type="hidden" name="destination" id="destination-id">

                    <div class="field-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat"
                            placeholder="Nama jalan, nomor rumah, RT/RW, cluster, atau patokan terdekat."
                            rows="3"
                            required>{{ old('alamat', auth()->user()->profile?->alamat) }}</textarea>
                    </div>
                </div>

                {{-- ONGKIR --}}
                <div class="checkout-card">
                    <h4>Pengiriman</h4>

                    <div class="field-group">
                        <label>Kurir</label>
                        <select name="courier" id="courier">
                            <option value="jne">JNE (Jalur Nugraha Ekakurir)</option>
                            <option value="jnt">J&T Express</option>
                            <option value="sicepat">SiCepat Ekspres</option>
                        </select>
                    </div>

                    <button type="button" id="btn-cek-ongkir" class="btn-secondary">
                        <span id="btn-ongkir-label">Cek Ongkir</span>
                        <span id="btn-ongkir-loading" style="display:none">Mengecek Tarif...</span>
                    </button>

                    <div id="ongkir-result" class="ongkir-result"></div>
                    <div id="ongkir-error" class="ongkir-error" style="display:none"></div>
                </div>

            </div>

            {{-- ================= RIGHT ================= --}}
            <div class="checkout-right">

                <div class="summary-card">
                    <h4>Ringkasan Pesanan</h4>

                    @php
                        $subtotal = 0;
                        $weight   = 0;
                    @endphp

                    <div class="summary-list">
                        @foreach($keranjang as $item)
                            @php
                                $harga     = $item->varian->harga ?? $item->produk->harga;
                                $subtotal += $harga * $item->qty;
                                $weight   += ($item->produk->berat ?? 1000) * $item->qty;
                            @endphp

                            <div class="summary-item">
                                <span class="item-name">{{ $item->produk->nama }} <span class="qty">x{{ $item->qty }}</span></span>
                                <strong>Rp {{ number_format($harga * $item->qty, 0, ',', '.') }}</strong>
                            </div>
                        @endforeach
                    </div>

                    <hr>

                    <div class="summary-item">
                        <span>Subtotal Produk</span>
                        <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>Biaya Pengiriman</span>
                        <strong id="ongkir-text" class="text-placeholder">— (Belum dipilih)</strong>
                    </div>

                    <hr>

                    <div class="summary-total">
                        <span>Total Pembayaran</span>
                        <strong id="grand-total">Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                    </div>

                    <input type="hidden" name="ongkir"  id="ongkir-value" value="-1">
                    <input type="hidden" name="weight"  id="weight-value" value="{{ $weight }}">
                    <input type="hidden" id="subtotal-value" value="{{ $subtotal }}">

                    <button type="submit" class="btn-checkout" id="btn-submit" disabled>
                        Buat Pesanan
                    </button>
                </div>

            </div>

        </div>
    </form>

</div>
</section>

{{-- ================= STYLE ================= --}}
<style>
.checkout-section {
    background: #f8f5ed;
    min-height: 100vh;
    padding: 40px 0;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    color: #333;
}

.container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 15px;
}

.checkout-header {
    text-align: center;
    margin-bottom: 35px;
}

.checkout-header h2 {
    font-size: 32px;
    font-weight: 800;
    color: #2d1e0e;
    margin: 0;
}

.checkout-header p {
    color: #777;
    margin-top: 8px;
    font-size: 15px;
}

.alert-error {
    background: #fff0f0;
    border: 1px solid #f5c6cb;
    border-radius: 12px;
    padding: 14px 20px;
    margin-bottom: 25px;
    color: #842029;
    font-size: 14px;
}
.alert-error ul { margin: 0; padding-left: 20px; }

.checkout-wrapper {
    display: grid;
    grid-template-columns: 1.6fr 1fr;
    gap: 30px;
    align-items: start;
}

.checkout-card,
.summary-card {
    background: #fff;
    padding: 26px;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(140, 106, 47, 0.06);
    margin-bottom: 25px;
}

.checkout-card h4,
.summary-card h4 {
    font-size: 18px;
    font-weight: 700;
    color: #2d1e0e;
    margin-top: 0;
    margin-bottom: 20px;
    border-left: 4px solid #8C6A2F;
    padding-left: 12px;
}

.field-group {
    margin-bottom: 18px;
}

.field-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #444;
    margin-bottom: 6px;
}

.checkout-card input[type="text"],
.checkout-card textarea,
.checkout-card select {
    width: 100%;
    padding: 12px 15px;
    border-radius: 10px;
    border: 1px solid #dcd6cc;
    font-size: 14px;
    transition: all .2s ease;
    box-sizing: border-box;
    background-color: #fff;
}

.checkout-card input:focus,
.checkout-card textarea:focus,
.checkout-card select:focus {
    outline: none;
    border-color: #8C6A2F;
    box-shadow: 0 0 0 3px rgba(140, 106, 47, 0.12);
}

.dropdown-container {
    position: relative;
}

.destination-dropdown {
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #dcd6cc;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    z-index: 999;
    max-height: 240px;
    overflow-y: auto;
}

.destination-dropdown .dest-item {
    padding: 12px 16px;
    font-size: 14px;
    cursor: pointer;
    border-bottom: 1px solid #f5f2eb;
    color: #333;
    transition: background .15s, color .15s;
}

.destination-dropdown .dest-item:last-child {
    border-bottom: none;
}

.destination-dropdown .dest-item:hover {
    background: #fbf9f5;
    color: #8C6A2F;
    font-weight: 600;
}

.btn-secondary {
    width: 100%;
    padding: 13px;
    border: 2px solid #8C6A2F;
    border-radius: 10px;
    background: transparent;
    color: #8C6A2F;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: all .2s ease;
}

.btn-secondary:hover {
    background: #8C6A2F;
    color: #fff;
}

.btn-secondary:disabled {
    opacity: .5;
    cursor: not-allowed;
}

.btn-checkout {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 12px;
    background: #8C6A2F;
    color: #fff;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    transition: background .2s, transform .1s;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.2);
}

.btn-checkout:hover { 
    background: #735624; 
}

.btn-checkout:disabled {
    background: #cbd5e1;
    color: #64748b;
    box-shadow: none;
    cursor: not-allowed;
}

.ongkir-result {
    margin-top: 15px;
}

.ongkir-result .service-option {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    border: 1px solid #e0dbd3;
    border-radius: 10px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: all .2s;
}

.ongkir-result .service-option:hover {
    border-color: #8C6A2F;
    background: #fdfbf7;
}

.ongkir-result .service-option.selected {
    border-color: #8C6A2F;
    background: #fdf6ec;
    box-shadow: 0 0 0 1px #8C6A2F;
}

.service-option .svc-name { font-weight: 600; color: #2d1e0e; font-size: 14px; }
.service-option .svc-etd  { font-size: 12px; color: #777; margin-top: 2px; }
.service-option .svc-cost { font-weight: 700; color: #8C6A2F; font-size: 15px; }

.ongkir-error {
    margin-top: 12px;
    padding: 12px 16px;
    background: #fff0f0;
    border: 1px solid #f5c6cb;
    border-radius: 10px;
    font-size: 13px;
    color: #842029;
}

.summary-list {
    max-height: 180px;
    overflow-y: auto;
    padding-right: 5px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 14px;
}

.summary-item .item-name {
    color: #555;
    max-width: 75%;
}

.summary-item .qty {
    color: #999;
    font-size: 12px;
    font-weight: 600;
    margin-left: 4px;
}

.text-placeholder { color: #a39e93; font-style: italic; }

.summary-total {
    display: flex;
    justify-content: space-between;
    font-size: 19px;
    font-weight: 800;
    color: #2d1e0e;
    margin-top: 12px;
}

hr { border: none; border-top: 1px dashed #e5dfd5; margin: 15px 0; }

@media (max-width: 992px) {
    .checkout-wrapper { grid-template-columns: 1fr; gap: 10px; }
    .checkout-right   { order: -1; }
}
</style>

{{-- ================= SCRIPT ================= --}}
<script>
(function () {
    'use strict';

    const ORIGIN = {{ config('rajaongkir.origin', 114) }};
    const CSRF   = '{{ csrf_token() }}';

    const searchInput     = document.getElementById('search-destination');
    const destinationList = document.getElementById('destination-list');
    const destinationId   = document.getElementById('destination-id');
    const courierSelect   = document.getElementById('courier');
    const btnCekOngkir    = document.getElementById('btn-cek-ongkir');
    const btnLabel        = document.getElementById('btn-ongkir-label');
    const btnLoading      = document.getElementById('btn-ongkir-loading');
    const ongkirResult    = document.getElementById('ongkir-result');
    const ongkirError     = document.getElementById('ongkir-error');
    const ongkirText      = document.getElementById('ongkir-text');
    const ongkirValue     = document.getElementById('ongkir-value');
    const grandTotal      = document.getElementById('grand-total');
    const weightInput     = document.getElementById('weight-value');
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
        ongkirError.textContent   = '';
    }

    /* -------------------------------------------------- */
    /* Search Destination                                 */
    /* -------------------------------------------------- */
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
                destinationList.innerHTML = '<div class="dest-item" style="color:#888;cursor:default">Mencari lokasi...</div>';
                destinationList.style.display = 'block';

                const res = await fetch(`/rajaongkir/destination?search=${encodeURIComponent(q)}`);
                const contentType = res.headers.get('content-type');
                
                if (!contentType || !contentType.includes('application/json')) {
                    destinationList.innerHTML = '<div class="dest-item" style="color:#c00;cursor:default">Gagal memuat format data.</div>';
                    return;
                }

                const json = await res.json();

                // FIX: Validasi dicocokkan dengan kembalian service baru (status: false)
                if (!res.ok || json.status === false) {
                    destinationList.innerHTML = `<div class="dest-item" style="color:#c00;cursor:default">${json?.message || 'Terjadi kesalahan sistem.'}</div>`;
                    return;
                }

                if (!json.data || json.data.length === 0) {
                    destinationList.innerHTML = '<div class="dest-item" style="color:#888;cursor:default">Lokasi tidak ditemukan</div>';
                    return;
                }

                destinationList.innerHTML = json.data.map(item => `
                    <div class="dest-item"
                         data-id="${item.id}"
                         data-label="${item.label.replace(/"/g, '&quot;')}">
                        ${item.label}
                    </div>
                `).join('');

            } catch (err) {
                destinationList.innerHTML = `<div class="dest-item" style="color:#c00;cursor:default">Error: ${err.message}</div>`;
            }
        }, 400);
    });

    destinationList.addEventListener('click', function (e) {
        const item = e.target.closest('.dest-item[data-id]');
        if (!item) return;

        destinationId.value           = item.dataset.id;
        searchInput.value             = item.dataset.label;
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

    /* -------------------------------------------------- */
    /* Logika Ongkir & Perhitungan                       */
    /* -------------------------------------------------- */
    function resetOngkir() {
        ongkirValue.value      = '-1';
        ongkirText.textContent = '— (Belum dipilih)';
        ongkirText.className   = 'text-placeholder';
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

    btnCekOngkir.addEventListener('click', async function () {
        const destination = destinationId.value;
        const courier     = courierSelect.value;
        const weight      = parseInt(weightInput.value, 10) || 1000;

        hideOngkirError();

        if (!destination) {
            showOngkirError('Pilih kota / kecamatan tujuan terlebih dahulu melalui pencarian.');
            searchInput.focus();
            return;
        }

        setOngkirLoading(true);

        try {
            const res = await fetch('/rajaongkir/cost', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                },
                body: JSON.stringify({
                    destination: destination,
                    weight:      weight,
                    courier:     courier,
                }),
            });

            const json = await res.json();

            if (!res.ok || json.status === false) {
                throw new Error(json?.message || `Server error: ${res.status}`);
            }

            const costs = json?.data?.costs;
            if (!costs || costs.length === 0) {
                throw new Error('Tidak ada layanan pengiriman tersedia untuk kurir ini.');
            }

            renderOngkirOptions(costs);

        } catch (err) {
            showOngkirError(err.message || 'Gagal mengecek ongkir. Coba lagi.');
            btnSubmit.disabled = true;
        } finally {
            setOngkirLoading(false);
        }
    });

    function renderOngkirOptions(costs) {
        ongkirResult.innerHTML = '';

        console.log("Data ongkir yang diterima:", costs);

        if (!Array.isArray(costs) || costs.length === 0) {
            showOngkirError('Tidak ada layanan pengiriman yang tersedia.');
            return;
        }

        costs.forEach(service => {
            // Support fleksibel untuk data multi-struktur (Komerce & Official)
            const cost = service.cost ?? service.value ?? (service.costs?.[0]?.value) ?? 0;
            const serviceName = service.service ?? service.name ?? 'Reguler';
            const description = service.description ?? '';
            const etd = service.etd ?? service.estimation ?? (service.costs?.[0]?.etd) ?? 'tidak tersedia';

            const div = document.createElement('div');
            div.className    = 'service-option';
            div.dataset.cost = cost;
            div.innerHTML    = `
                <div>
                    <div class="svc-name">${serviceName} ${description ? `- ${description}` : ''}</div>
                    <div class="svc-etd">Estimasi sampai: ${etd} ${etd.toLowerCase().includes('hari') ? '' : 'Hari'}</div>
                </div>
                <div class="svc-cost">${formatRupiah(cost)}</div>
            `;

            div.addEventListener('click', function () {
                document.querySelectorAll('.service-option').forEach(el => el.classList.remove('selected'));
                this.classList.add('selected');

                ongkirValue.value      = cost;
                ongkirText.textContent = formatRupiah(cost);
                ongkirText.className   = ''; 
                updateGrandTotal(cost, true);
                btnSubmit.disabled     = false; 
            });

            ongkirResult.appendChild(div);
        });
    }
})();
</script>
@endsection