@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')

<div class="container-fluid">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Laporan & Analitik Bisnis</h1>
            <p class="page-subtitle">Rekapitulasi total pendapatan kotor, akumulasi volume transaksi berjalan, dan data performa penjualan.</p>
        </div>
        <button onclick="window.print()" class="btn-print-report">
            <i class="fa-solid fa-print"></i>
            <span>Cetak Rekap (Print)</span>
        </button>
    </div>

    <div class="stats-grid mb-4">
        
        <div class="stat-card shadow-sm">
            <div class="stat-icon-box box-gold">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div class="stat-info">
                <small class="text-muted">Total Pendapatan</small>
                <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="stat-card shadow-sm">
            <div class="stat-icon-box box-earthen">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <div class="stat-info">
                <small class="text-muted">Pesanan Selesai</small>
                <h3>{{ $totalTransaksi }} Transaksi</h3>
            </div>
        </div>

        <div class="stat-card shadow-sm">
            <div class="stat-icon-box box-cream">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-info">
                <small class="text-muted">Total Pelanggan</small>
                <h3>{{ $totalPelanggan }} Akun</h3>
            </div>
        </div>

    </div>

    <div class="custom-card">
        <div class="table-header-title mb-3">
            <h5>Jurnal Log Penjualan Masuk</h5>
        </div>
        
        <div class="table-responsive">
            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th width="80" class="text-center">No</th>
                        <th width="160">No. Invoice</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Lunas</th>
                        <th>Status Internal</th>
                        <th class="text-end">Nominal Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatLaporan as $index => $item)
                    <tr>
                        <td class="text-center text-muted font-monospace">
                            {{ ($riwayatLaporan->currentPage() - 1) * $riwayatLaporan->perPage() + $loop->iteration }}
                        </td>
                        <td class="font-monospace">
                            <span class="code-badge">#{{ $item->invoice_number ?? $item->id }}</span>
                        </td>
                        <td>
                            <span class="customer-name-text">{{ $item->user->name }}</span>
                        </td>
                        <td class="text-muted">
                            {{ $item->updated_at->format('d M Y, H:i') }} WIB
                        </td>
                        <td>
                            <span class="status-badge status-paid">
                                <i class="fa-solid fa-circle-check me-1.5"></i>Lunas Berhasil
                            </span>
                        </td>
                        <td class="text-end price-text">
                            Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon-wrapper">
                                    <i class="fa-solid fa-chart-pie"></i>
                                </div>
                                <h3>Belum Ada Laporan Kas</h3>
                                <p>Catatan keuangan akan otomatis terisi secara berkala begitu sistem menerima webhook sukses pembayaran dari Midtrans.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayatLaporan->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
                <div class="text-muted" style="font-size: 13px;">
                    Menampilkan {{ $riwayatLaporan->firstItem() }} sampai {{ $riwayatLaporan->lastItem() }} dari {{ $riwayatLaporan->total() }} log keuangan.
                </div>
                <div class="custom-pagination-wrapper">
                    {{ $riwayatLaporan->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.container-fluid { font-family: 'Poppins', sans-serif; }
.page-title { font-size: 28px; font-weight: 800; color: #1a1a1a; margin: 0 0 6px 0; letter-spacing: -0.5px; }
.page-subtitle { margin: 0; color: #777; font-size: 14px; }

/* REUSABLE PRINT BUTTON */
.btn-print-report {
    background: #faf6ed; color: #8C6A2F; border: 1px solid #ebdcb9; padding: 12px 24px; border-radius: 14px;
    font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; transition: all 0.2s;
}
.btn-print-report:hover { background: #8C6A2F; color: white; border-color: transparent; }

/* STATISTICS GRID ROW CARD COMPONENTS */
.stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; }
.stat-card { background: white; border-radius: 22px; padding: 24px; display: flex; align-items: center; gap: 18px; border: 1px solid #f5efe2; }
.stat-icon-box { width: 54px; height: 54px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
.box-gold { background: #faf6ed; color: #B68D40; }
.box-earthen { background: #ebdcb9; color: #8C6A2F; }
.box-cream { background: #fdfbf7; color: #C9A227; border: 1px solid #f3ead8; }
.stat-info h3 { margin: 4px 0 0; font-weight: 800; color: #1a1a1a; font-size: 20px; }

/* DATA TABLE CARD CONTAINER */
.custom-card { background: white; border-radius: 28px; padding: 24px; border: 1px solid #f5efe2; box-shadow: 0 10px 30px rgba(140, 106, 47, 0.03); }
.table-header-title h5 { font-weight: 700; color: #444; margin: 0; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px; }
.custom-table thead th { border: none; color: #555; font-weight: 700; font-size: 13.5px; text-transform: uppercase; padding: 16px 20px; background-color: #fafaf8; }
.custom-table tbody tr { border-bottom: 1px solid #fcfbf9; }
.custom-table tbody td { padding: 18px 20px; border: none; }

/* BADGES STYLING ELEMENTS */
.code-badge { background: #faf6ed; color: #8C6A2F; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 700; border: 1px solid #f4ebd6; }
.customer-name-text { font-weight: 700; color: #222; font-size: 14.5px; }
.price-text { font-weight: 800; color: #8C6A2F; font-size: 15px; }
.status-badge { display: inline-flex; align-items: center; padding: 6px 14px; border-radius: 50px; font-size: 11.5px; font-weight: 700; }
.status-paid { background: #e8f8f5; color: #1abc9c; }

/* EMPTY STATE GRAPHIC DESIGN */
.empty-state { padding: 60px 20px; text-align: center; max-width: 450px; margin: auto; }
.empty-icon-wrapper { width: 80px; height: 80px; background: #faf6ed; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 36px; color: #B68D40; margin: 0 auto 20px; }
.empty-state h3 { font-weight: 700; font-size: 20px; color: #333; }
.empty-state p { color: #777; font-size: 14px; }

/* PAGINATION STYLING OVERRIDES */
.custom-pagination-wrapper .pagination .page-item .page-link { border-radius: 10px; border: 1px solid #f5efe2; color: #555; padding: 10px 16px; font-size: 14px; font-weight: 600; }
.custom-pagination-wrapper .page-item.active .page-link { background: linear-gradient(135deg, #8C6A2F, #C9A227) !important; color: white !important; border: none !important; }

/* PRINT VIEW HANDLING NATIVE LAYOUT */
@media print {
    body * { visibility: hidden; }
    .custom-card, .custom-card *, .page-header, .page-header * { visibility: visible; }
    .custom-card { position: absolute; left: 0; top: 120px; width: 100%; border: none !important; box-shadow: none !important; }
    .btn-print-report, .custom-pagination-wrapper { display: none !important; }
}
</style>

@endsection