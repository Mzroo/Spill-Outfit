@extends('layouts.admin')

@section('title', 'Manajemen Transaksi')

@section('content')

<div class="container-fluid">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Manajemen Transaksi</h1>
            <p class="page-subtitle">Pantau arus kas masuk dari Midtrans, kelola pengiriman barang, dan input resi logistik kurir.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-custom alert-success mb-4" role="alert">
            <i class="fa-solid fa-circle-check alert-icon"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="status-filter-tabs mb-4">
        <a href="{{ route('admin.pesanan.index') }}" class="tab-item {{ !request('status') ? 'tab-active' : '' }}">
            Semua Transaksi
        </a>
        <a href="{{ route('admin.pesanan.index', ['status' => 'pending']) }}" class="tab-item {{ request('status') == 'pending' ? 'tab-active' : '' }}">
            Belum Bayar (Pending)
        </a>
        <a href="{{ route('admin.pesanan.index', ['status' => 'dibayar']) }}" class="tab-item {{ request('status') == 'dibayar' ? 'tab-active' : '' }}">
            <span class="indicator-dot-green"></span> Perlu Dikirim (Paid)
        </a>
        <a href="{{ route('admin.pesanan.index', ['status' => 'dikirim']) }}" class="tab-item {{ request('status') == 'dikirim' ? 'tab-active' : '' }}">
            Dalam Pengiriman
        </a>
    </div>

    <div class="custom-card">
        <div class="table-responsive">
            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th width="160">ID Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Bayar</th>
                        <th class="text-center">Status Pembayaran</th>
                        <th width="200" class="text-end">Aksi Operasional</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanan as $item)
                    <tr>
                        <td class="font-monospace">
                            <span class="code-badge">#{{ $item->invoice_number ?? $item->id }}</span>
                        </td>

                        <td>
                            <div class="d-flex flex-column">
                                <span class="customer-name-text">{{ $item->user->name }}</span>
                                <small class="text-muted" style="font-size: 12px;">{{ $item->user->email }}</small>
                            </div>
                        </td>

                        <td class="text-muted">{{ $item->created_at->format('d M Y, H:i') }} WIB</td>

                        <td class="price-text">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>

                        <td class="text-center">
                            @if($item->status == 'pending')
                                <span class="status-badge status-pending">
                                    <i class="fa-solid fa-clock me-1.5"></i>Menunggu Pembayaran
                                </span>
                            @elseif($item->status == 'dibayar')
                                <span class="status-badge status-paid">
                                    <i class="fa-solid fa-circle-check me-1.5"></i>Lunas (Perlu Dikirim)
                                </span>
                            @elseif($item->status == 'dikirim')
                                <span class="status-badge status-shipped">
                                    <i class="fa-solid fa-truck-fast me-1.5"></i>Sedang Dikirim
                                </span>
                            @else
                                <span class="status-badge status-expired">
                                    <i class="fa-solid fa-circle-xmark me-1.5"></i>Batal / Kedaluwarsa
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="action-buttons justify-content-end">
                                @if($item->status == 'dibayar')
                                    <button class="btn-action-process" data-bs-toggle="modal" data-bs-target="#resiModal-{{ $item->id }}">
                                        <i class="fa-solid fa-box-open me-1.5"></i> Proses Kirim
                                    </button>
                                @else
                                    <a href="{{ route('admin.pesanan.show', $item->id) }}" class="btn-view" title="Lihat Detail Invoice">
                                        <i class="fa-solid fa-file-invoice"></i> Detail
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="resiModal-{{ $item->id }}" {{-- input id modal dinamis --}} tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content custom-modal">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="modal-title font-weight-bold">Input Resi Pengiriman</h5>
                                    <button type="submit" class="btn-close-modal" data-bs-dismiss="modal">✕</button>
                                </div>
                                <form action="{{ route('admin.pesanan.kirim', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body py-4">
                                        <p class="text-muted mb-3" style="font-size: 13.5px;">Masukkan nomor resi ekspedisi resmi (JNE/J&T/Sicepat) untuk mengonfirmasi pengiriman paket kepada <strong>{{ $item->user->name }}</strong>.</p>
                                        <div class="input-group-custom">
                                            <i class="fa-solid fa-barcode input-icon"></i>
                                            <input type="text" name="nomor_resi" class="custom-form-control" placeholder="Contoh: JX123456789" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 pt-0">
                                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn-modal-submit">Konfirmasi Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon-wrapper">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>
                                <h3>Data Transaksi Nihil</h3>
                                <p>Tidak ada catatan riwayat transaksi pembayaran masuk dalam kategori filter ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pesanan->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
                <div class="text-muted" style="font-size: 13px;">
                    Menampilkan {{ $pesanan->firstItem() ?? 0 }} sampai {{ $pesanan->lastItem() ?? 0 }} dari {{ $pesanan->total() }} invoice transaksi.
                </div>
                <div class="custom-pagination-wrapper">
                    {{ $pesanan->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.container-fluid { font-family: 'Poppins', sans-serif; }
.page-title { font-size: 28px; font-weight: 800; color: #1a1a1a; margin: 0 0 6px 0; letter-spacing: -0.5px; }
.page-subtitle { margin: 0; color: #777; font-size: 14px; }

/* STATUS TABS FILTER MENU */
.status-filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; border-bottom: 1px solid #f5efe2; padding-bottom: 12px; }
.tab-item { text-decoration: none; color: #666; font-size: 13.5px; font-weight: 600; padding: 10px 20px; border-radius: 12px; transition: all 0.2s ease; background: #fafaf8; border: 1px solid #f5efe2; display: inline-flex; align-items: center; gap: 6px;}
.tab-item:hover { background: #faf6ed; color: #8C6A2F; }
.tab-active { background: #8C6A2F !important; color: white !important; border-color: transparent !important; }
.indicator-dot-green { width: 8px; height: 8px; background: #1abc9c; border-radius: 50%; display: inline-block; }

/* MODIFIED CARD CONTAINER */
.custom-card { background: white; border-radius: 28px; padding: 24px; border: 1px solid #f5efe2; box-shadow: 0 10px 30px rgba(140, 106, 47, 0.03); }
.custom-table thead th { border: none; color: #555; font-weight: 700; font-size: 13.5px; text-transform: uppercase; padding: 16px 20px; background-color: #fafaf8; }
.custom-table tbody tr { border-bottom: 1px solid #fcfbf9; }
.custom-table tbody tr:hover { background: #fdfbf7; }
.custom-table tbody td { padding: 18px 20px; border: none; }

/* CELL DETAILS STYLING */
.code-badge { background: #faf6ed; color: #8C6A2F; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 700; border: 1px solid #f4ebd6; }
.customer-name-text { font-weight: 700; color: #222; font-size: 15px; }
.price-text { font-weight: 700; color: #1a1a1a; font-size: 15px; }

/* MIDTRANS STATE TRANSACTION CHIPS */
.status-badge { display: inline-flex; align-items: center; padding: 6px 14px; border-radius: 50px; font-size: 12px; font-weight: 700; }
.status-pending { background: #fffbeb; color: #d97706; }
.status-paid { background: #e8f8f5; color: #1abc9c; }
.status-shipped { background: #eff6ff; color: #2563eb; }
.status-expired { background: #fdf2f2; color: #ec5858; }

/* ACTION BUTTON DESIGN OPTIONS */
.action-buttons { display: flex; align-items: center; gap: 8px; }
.btn-view { background: #faf6ed; color: #B68D40; text-decoration: none; padding: 10px 20px; border-radius: 12px; font-size: 13.5px; font-weight: 600; display: inline-flex; align-items: center; border: 1px solid #f4ebd6; transition: all 0.2s; }
.btn-view:hover { background: #8C6A2F; color: white; }

.btn-action-process { background: linear-gradient(135deg, #8C6A2F, #C9A227); color: white; border: none; padding: 10px 20px; border-radius: 12px; font-size: 13.5px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(140, 106, 47, 0.15); }
.btn-action-process:hover { transform: translateY(-1px); box-shadow: 0 6px 15px rgba(140, 106, 47, 0.25); }

/* CUSTOM LIGHTBOX MODAL BOOTSTRAP OVERRIDES */
.custom-modal { border-radius: 24px; border: 1px solid #f5efe2; padding: 16px; }
.btn-close-modal { background: #f5f5f5; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 12px; font-weight: bold; cursor: pointer; color: #666; }
.input-group-custom { display: flex; align-items: center; position: relative; background: #faf8f5; border-radius: 14px; border: 1px solid #ebdcb9; width: 100%; }
.input-icon { position: absolute; left: 16px; color: #8C6A2F; }
.custom-form-control { border: none !important; background: transparent !important; padding: 12px 16px 12px 46px; font-size: 14px; width: 100%; font-weight: 500; }
.btn-modal-cancel { background: #f5f5f5; color: #666; border: none; padding: 12px 24px; border-radius: 12px; font-size: 14px; font-weight: 600; }
.btn-modal-submit { background: #8C6A2F; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-size: 14px; font-weight: 600; }

/* ALERT SETTING SYSTEM */
.alert-custom { padding: 14px 20px; border-radius: 16px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 12px; border: 1px solid transparent; }
.alert-success { background: #e8f8f5; color: #1abc9c; border-color: #d1f2eb; }

/* DATA EMPTY STATE */
.empty-state { padding: 60px 20px; text-align: center; max-width: 450px; margin: auto; }
.empty-icon-wrapper { width: 80px; height: 80px; background: #faf6ed; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 36px; color: #B68D40; margin: 0 auto 20px; }
.empty-state h3 { font-weight: 700; font-size: 20px; color: #333; }
.empty-state p { color: #777; font-size: 14px; }

/* PAGINATION BOOTSTRAP OVERRIDES */
.custom-pagination-wrapper .pagination .page-item .page-link { border-radius: 10px; border: 1px solid #f5efe2; color: #555; padding: 10px 16px; font-size: 14px; font-weight: 600; }
.custom-pagination-wrapper .page-item.active .page-link { background: linear-gradient(135deg, #8C6A2F, #C9A227) !important; color: white !important; border: none !important; }
</style>

@endsection