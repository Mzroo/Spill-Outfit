@extends('layouts.admin')

@section('title', 'Detail Invoice #' . ($pesanan->kode_pesanan ?? $pesanan->id))

@section('content')

<div class="container-fluid">

    <div class="page-header mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="page-title">Detail Invoice</h1>
            <p class="page-subtitle">Manajemen rincian item produk belanjaan, data logistik pengiriman, dan validasi pembayaran keuangan.</p>
        </div>
        <a href="{{ route('admin.pesanan.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left-long"></i>
            <span>Kembali ke Pesanan</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-custom alert-success mb-4" role="alert">
            <i class="fa-solid fa-circle-check alert-icon"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-custom alert-danger mb-4" role="alert">
            <i class="fa-solid fa-circle-xmark alert-icon"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <div class="row g-4">
        
        <div class="col-lg-8">
            <div class="custom-card mb-4">
                <div class="card-section-title mb-3">
                    <h5><i class="fa-solid fa-basket-shopping me-2"></i> Daftar Produk Yang Dibeli</h5>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle custom-show-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Kuantitas</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="outfit" class="product-img-preview">
                                        @else
                                            <div class="product-placeholder-icon">
                                                <i class="fa-solid fa-shirt"></i>
                                            </div>
                                        @endif
                                        
                                        <div class="d-flex flex-column">
                                            <span class="product-title-text">{{ $item->nama_produk }}</span>
                                            @if($item->nama_varian)
                                                <small class="text-gold font-weight-bold" style="font-size: 11.5px;">
                                                    Varian: {{ $item->nama_varian }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center font-weight-bold">x{{ $item->qty }}</td>
                                <td class="text-end text-muted">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="text-end font-weight-bold price-text">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="invoice-summary-block mt-4">
                    <div class="summary-row">
                        <span class="text-muted">Subtotal Produk</span>
                        <span class="font-weight-bold">Rp {{ number_format($pesanan->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="text-muted">Biaya Ongkos Kirim ({{ strtoupper($pesanan->courier ?? 'Ekspedisi') }})</span>
                        <span class="font-weight-bold">Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span>
                    </div>
                    <hr class="summary-divider">
                    <div class="summary-row row-total">
                        <span class="total-label">Total Pembayaran</span>
                        <span class="total-value">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="custom-card mb-4">
                <div class="card-section-title mb-3">
                    <h5><i class="fa-solid fa-circle-info me-2"></i> Status Informasi</h5>
                </div>
                <div class="mb-3">
                    <label class="d-block text-muted small mb-1">Status Pembayaran / Sistem</label>
                    @if($pesanan->status == 'pending')
                        <span class="status-badge status-pending w-100 justify-content-center"><i class="fa-solid fa-clock me-1.5"></i>Menunggu Pembayaran</span>
                    @elseif($pesanan->status == 'dibayar')
                        <span class="status-badge status-paid w-100 justify-content-center"><i class="fa-solid fa-circle-check me-1.5"></i>Lunas (Perlu Dikirim)</span>
                    @elseif($pesanan->status == 'dikirim')
                        <span class="status-badge status-shipped w-100 justify-content-center"><i class="fa-solid fa-truck-fast me-1.5"></i>Sedang Dikirim</span>
                    @else
                        <span class="status-badge status-expired w-100 justify-content-center"><i class="fa-solid fa-circle-xmark me-1.5"></i>{{ ucfirst($pesanan->status) }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="d-block text-muted small mb-1">Metode Pembayaran</label>
                    <span class="info-value-text"><i class="fa-solid fa-credit-card me-1.5 text-gold"></i>{{ strtoupper($pesanan->metode_pembayaran ?? 'Midtrans Gateway') }}</span>
                </div>

                @if($pesanan->status == 'dibayar')
                <div class="mt-3 pt-3 border-top-dashed">
                    <form action="{{ route('admin.pesanan.kirim', $pesanan->id) }}" method="POST">
                        @csrf
                        <label class="form-label custom-label text-dark">Input Nomor Resi Pengiriman</label>
                        <div class="d-flex flex-column gap-2">
                            <input type="text" name="nomor_resi" class="form-control custom-input" placeholder="Contoh: JNE123456789" required>
                            <button type="submit" class="btn-submit-resi">
                                <i class="fa-solid fa-paper-plane me-1"></i> Proses Pengiriman
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                @if($pesanan->nomor_resi)
                <div class="mt-3 pt-3 border-top-dashed">
                    <label class="d-block text-muted small mb-1">Nomor Resi Pengiriman</label>
                    <span class="code-badge font-monospace w-100 text-center"><i class="fa-solid fa-barcode me-1.5"></i>{{ $pesanan->nomor_resi }}</span>
                </div>
                @endif
            </div>

            <div class="custom-card">
                <div class="card-section-title mb-3">
                    <h5><i class="fa-solid fa-user-gear me-2"></i> Data Pelanggan</h5>
                </div>
                <div class="mb-3">
                    <label class="d-block text-muted small mb-1">Nama Pemesan</label>
                    <span class="info-value-text font-weight-bold">{{ $pesanan->user->name ?? 'User Terhapus' }}</span>
                </div>
                <div class="mb-3">
                    <label class="d-block text-muted small mb-1">Kontak Telepon</label>
                    <span class="info-value-text">{{ $pesanan->user->phone ?? '-' }}</span>
                </div>
                <div class="mb-1">
                    <label class="d-block text-muted small mb-1">Alamat Tujuan Pengiriman</label>
                    <div class="address-box-preview shadow-sm">
                        <p class="mb-1 font-weight-bold text-dark">{{ $pesanan->user->alamat ?? 'Alamat belum diisi' }}</p>
                        <small class="text-muted d-block">{{ $pesanan->user->kota ?? '-' }}, {{ $pesanan->user->provinsi ?? '-' }}</small>
                        <small class="text-muted d-block">Kode Pos: {{ $pesanan->user->kode_pos ?? '-' }}</small>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<style>
.container-fluid { font-family: 'Poppins', sans-serif; }
.page-title { font-size: 28px; font-weight: 800; color: #1a1a1a; margin: 0 0 6px 0; letter-spacing: -0.5px; }
.page-subtitle { margin: 0; color: #777; font-size: 14px; }

/* BACK NAVIGATION BUTTON */
.btn-back { background: #faf6ed; color: #B68D40; text-decoration: none; padding: 12px 20px; border-radius: 14px; display: inline-flex; align-items: center; gap: 8px; font-weight: 600; font-size: 13.5px; border: 1px solid #f4ebd6; transition: all 0.2s; }
.btn-back:hover { background: #8C6A2F; color: white; border-color: transparent; }

/* MODERN DETAIL CARDS WRAPPER */
.custom-card { background: white; border-radius: 24px; padding: 26px; border: 1px solid #f5efe2; box-shadow: 0 10px 30px rgba(140, 106, 47, 0.02); }
.card-section-title h5 { font-size: 15px; font-weight: 700; color: #8C6A2F; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; }

/* INTERNAL INVOICE TABLE STYLING */
.custom-show-table thead th { border: none; color: #555; font-weight: 700; font-size: 13px; text-transform: uppercase; padding: 12px 16px; background-color: #fafaf8; }
.custom-show-table tbody tr { border-bottom: 1px solid #fcfbf9; }
.custom-show-table tbody td { padding: 16px; border: none; font-size: 14px; }

.product-img-preview { width: 45px; height: 45px; border-radius: 10px; object-fit: cover; border: 1px solid #ebdcb9; }
.product-placeholder-icon { width: 45px; height: 45px; background: #faf6ed; color: #B68D40; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; border: 1px solid #f4ebd6; }
.product-title-text { font-weight: 700; color: #222; font-size: 14.5px; }
.price-text { color: #8C6A2F; }
.font-weight-bold { font-weight: 700; }
.text-gold { color: #B68D40; }

/* INPUT FORM ELEMENTS */
.custom-label { font-size: 13px; font-weight: 600; margin-bottom: 4px; }
.custom-input { background: #faf8f5; border: 1px solid #ebdcb9 !important; padding: 10px 14px; border-radius: 10px; font-size: 13.5px; color: #222; }
.custom-input:focus { background: white; border-color: #8C6A2F !important; box-shadow: 0 0 0 3px rgba(140, 106, 47, 0.1) !important; }
.btn-submit-resi { background: #8C6A2F; color: white; border: none; padding: 10px; border-radius: 10px; font-weight: 600; font-size: 13px; cursor: pointer; transition: background 0.2s; }
.btn-submit-resi:hover { background: #C9A227; }

/* INVOICE RECAP COSTS COMPONENT */
.invoice-summary-block { background: #fafaf8; padding: 20px; border-radius: 18px; border: 1px solid #f1f1ee; display: flex; flex-direction: column; gap: 10px; }
.summary-row { display: flex; justify-content: space-between; font-size: 14px; }
.summary-divider { border-top: 1px solid #e2e2de; margin: 6px 0; opacity: 1; }
.row-total { align-items: center; }
.total-label { font-weight: 800; color: #1a1a1a; font-size: 15px; }
.total-value { font-weight: 800; color: #8C6A2F; font-size: 20px; letter-spacing: -0.5px; }

/* BADGES & BLOCKS INLINE CHIPS */
.status-badge { display: inline-flex; align-items: center; padding: 8px 16px; border-radius: 50px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
.status-pending { background: #fffbeb; color: #d97706; }
.status-paid { background: #e8f8f5; color: #1abc9c; }
.status-shipped { background: #eff6ff; color: #2563eb; }
.status-expired { background: #fdf2f2; color: #ec5858; }

.info-value-text { font-size: 14.5px; font-weight: 600; color: #333; display: block; }
.code-badge { background: #faf6ed; color: #8C6A2F; padding: 8px 14px; border-radius: 10px; font-size: 13px; font-weight: 700; border: 1px solid #f4ebd6; display: inline-block; }
.border-top-dashed { border-top: 1px dashed #ebdcb9; }

/* CUSTOMER ADDRESS INTERNALS BOX */
.address-box-preview { background: #fffdf9; border: 1px solid #ebdcb9; padding: 14px; border-radius: 14px; margin-top: 6px; }
.text-dark { color: #1a1a1a; }
.d-block { display: block; }

/* ALERTS */
.alert-custom { padding: 12px 18px; border-radius: 12px; font-size: 13.5px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
.alert-success { background: #e8f8f5; color: #1abc9c; border: 1px solid #d1f2eb; }
.alert-danger { background: #fdf2f2; color: #ec5858; border: 1px solid #fde8e8; }
</style>

@endsection