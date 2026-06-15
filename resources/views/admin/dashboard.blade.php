@extends('layouts.admin')

@section('title', 'Dashboard Utama')

@section('content')

<div class="dashboard-container">

    <div class="welcome-card">
        <div class="welcome-text-side">
            <h3>Selamat Datang, {{ auth()->user()->name ?? 'Admin' }} 👋</h3>
            <p>Kelola produk, pantau arus pesanan, dan analisis data customer dengan mudah di pusat kendali Spill Outfit.</p>
        </div>
        <div class="welcome-icon">
            <i class="fa-solid fa-shirt"></i>
        </div>
    </div>

    <div class="shipping-overview-bar">
        <div class="ship-status-item">
            <div class="ship-icon-box text-orange"><i class="fa-solid fa-box-open"></i></div>
            <div class="ship-info">
                <h5>{{ $perluDikemas }} Pesanan</h5>
                <p>Perlu Dikemas</p>
            </div>
        </div>
        <div class="ship-status-item">
            <div class="ship-icon-box text-blue"><i class="fa-solid fa-truck-fast"></i></div>
            <div class="ship-info">
                <h5>{{ $sedangDikirim }} Paket</h5>
                <p>Sedang Di Jalan</p>
            </div>
        </div>
        <div class="ship-status-item">
            <div class="ship-icon-box text-purple"><i class="fa-solid fa-circle-check"></i></div>
            <div class="ship-info">
                <h5>{{ $pesananSelesai }} Transaksi</h5>
                <p>Pesanan Selesai</p>
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="dashboard-card">
            <div class="card-info-left">
                <span class="card-label">Total Produk</span>
                <h3 class="card-value">{{ $totalProduk }}</h3>
            </div>
            <div class="card-icon icon-produk">
                <i class="fa-solid fa-shirt"></i>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-info-left">
                <span class="card-label">Total Pesanan</span>
                <h3 class="card-value">{{ $totalPesanan }}</h3>
            </div>
            <div class="card-icon icon-pesanan">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-info-left">
                <span class="card-label">Total Pendapatan</span>
                <h3 class="card-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            </div>
            <div class="card-icon icon-pendapatan">
                <i class="fa-solid fa-wallet"></i>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-info-left">
                <span class="card-label">Total Customer</span>
                <h3 class="card-value">{{ $totalCustomer }}</h3>
            </div>
            <div class="card-icon icon-customer">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
    </div>

    <div class="dashboard-split-layout">
        
        <div class="table-card">
            <div class="table-header">
                <h4>Pesanan Terbaru</h4>
                <p class="table-subtitle">Daftar transaksi masuk terakhir yang membutuhkan tindakan.</p>
            </div>

            <div class="table-responsive">
                <table class="custom-dashboard-table">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th style="width: 140px; text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesananTerbaru as $order)
                        <tr>
                            <td class="font-monospace invoice-col">#{{ $order->invoice_number ?? $order->id }}</td>
                            <td class="customer-name-col">{{ $order->user->name ?? 'Guest User' }}</td>
                            <td class="price-col">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td style="text-align: center;">
                                @if($order->status == 'pending')
                                    <span class="status-badge status-pending">Pending</span>
                                @elseif($order->status == 'dibayar')
                                    <span class="status-badge status-paid">Paid (Lunas)</span>
                                @elseif($order->status == 'dikirim')
                                    <span class="status-badge status-success">Shipped</span>
                                @else
                                    <span class="status-badge status-danger">Batal</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center;" class="text-muted py-4">Belum ada data transaksi masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="analytics-column">
            
            <div class="sub-analytics-card alert-card-border">
                <div class="card-header-borderless">
                    <h4>Stok Hampir Habis ⚠️</h4>
                    <span class="badge-danger-indicator">Perlu Restock</span>
                </div>
                
                <div class="analytics-list">
                    @if(count($stokMenipis) > 0)
                        @foreach($stokMenipis as $varian)
                        <div class="stock-alert-item">
                            <div class="alert-left">
                                <span class="indicator-dot-danger"></span>
                                <div class="alert-meta">
                                    <h6>{{ $varian->produk->nama ?? 'Produk Unnamed' }}</h6>
                                    <p>Varian: <strong>{{ $varian->warna->nama ?? '-' }} / {{ $varian->ukuran->nama ?? '-' }}</strong></p>
                                </div>
                            </div>
                            <div class="alert-right-badge">Sisa {{ $varian->stok }} Pcs</div>
                        </div>
                        @endforeach
                    @else
                        <div class="p-3 text-center text-muted" style="font-size: 13px;">
                            <i class="fa-solid fa-circle-check text-success me-1"></i> Semua amunisi stok varian aman.
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

</div>

<style>
/* ================= GLOBAL DESIGN SYSTEM DASHBOARD (NORMAL CSS) ================= */
.dashboard-container { font-family: 'Poppins', sans-serif; padding: 24px 0; box-sizing: border-box; }
.dashboard-container *, .dashboard-container *::before, .dashboard-container *::after { box-sizing: border-box; }

/* WELCOME HERO BANNER */
.welcome-card { background: linear-gradient(135deg, #8C6A2F, #C9A227); border-radius: 30px; padding: 35px 40px; color: white; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; box-shadow: 0 10px 30px rgba(140, 106, 47, 0.15); }
.welcome-text-side h3 { font-size: 28px; font-weight: 700; margin: 0 0 10px 0; letter-spacing: -0.5px; }
.welcome-text-side p { margin: 0; opacity: 0.9; max-width: 550px; font-size: 14.5px; line-height: 1.6; }
.welcome-icon { width: 100px; height: 100px; background: rgba(255, 255, 255, 0.18); border-radius: 26px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
.welcome-icon i { font-size: 42px; }

/* SHIPPMENT OVERVIEW COMPONENT */
.shipping-overview-bar { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px; }
.ship-status-item { background: #ffffff; border: 1px solid #f5efe2; border-radius: 20px; padding: 16px 20px; display: flex; align-items: center; gap: 16px; }
.ship-icon-box { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
.text-orange { background: #fff5e6; color: #ff9f43; }
.text-blue { background: #ebf5ff; color: #2196f3; }
.text-purple { background: #e8f8f5; color: #1abc9c; }
.ship-info h5 { margin: 0 0 2px 0; font-size: 15px; font-weight: 700; color: #1a1a1a; }
.ship-info p { margin: 0; font-size: 12.5px; color: #777777; }

/* STATS DISPLAY (CSS GRID) */
.stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 30px; }
.dashboard-card { background: white; border-radius: 24px; padding: 24px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #f5efe2; box-shadow: 0 8px 25px rgba(140, 106, 47, 0.02); }
.card-info-left { display: flex; flex-direction: column; }
.card-label { color: #888888; font-size: 13.5px; font-weight: 500; }
.card-value { margin: 8px 0 0 0; font-size: 25px; font-weight: 800; color: #1a1a1a; letter-spacing: -0.5px; }
.card-icon { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
.icon-produk { background-color: #faf6ed; color: #8C6A2F; }
.icon-pesanan { background-color: #fafbeb; color: #ff9f43; }
.icon-pendapatan { background-color: #fdfaf3; color: #C9A227; }
.icon-customer { background-color: #f3f7fd; color: #2196f3; }

/* SPLIT SECTIONS (TABLE VS SIDE-ANALYTICS) */
.dashboard-split-layout { display: grid; grid-template-columns: 1.6fr 1.1fr; gap: 24px; align-items: start; }
.table-card { background: white; border-radius: 26px; padding: 28px; border: 1px solid #f5efe2; box-shadow: 0 10px 30px rgba(140, 106, 47, 0.02); }
.table-header { margin-bottom: 20px; }
.table-header h4 { font-weight: 800; font-size: 18px; color: #1a1a1a; margin: 0 0 4px 0; }
.table-subtitle { margin: 0; font-size: 13px; color: #777777; }
.table-responsive { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
.custom-dashboard-table { width: 100%; border-collapse: collapse; text-align: left; }
.custom-dashboard-table thead th { color: #555555; font-weight: 700; font-size: 13px; text-transform: uppercase; padding: 14px 16px; background-color: #fafaf8; }
.custom-dashboard-table tbody tr { border-bottom: 1px solid #fcfbf9; transition: background 0.2s ease; }
.custom-dashboard-table tbody tr:hover { background: #fdfbf7; }
.custom-dashboard-table tbody td { padding: 16px 16px; vertical-align: middle; font-size: 14px; }
.invoice-col { font-weight: 600; color: #8C6A2F; }
.customer-name-col { font-weight: 600; color: #333333; }
.price-col { font-weight: 700; color: #222222; }

/* BADGES SPEED MATRIX */
.status-badge { display: inline-block; padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; text-align: center; width: 100%; text-transform: uppercase;}
.status-pending { background-color: #fff9e6; color: #d97706; }
.status-paid { background-color: #e0f2fe; color: #0369a1; }
.status-success { background-color: #e8f8f5; color: #1abc9c; }
.status-danger { background-color: #fdf2f2; color: #ec5b5b; }

/* RIGHT BLOCK: FLUID DATA ANALYTICS CARDS */
.analytics-column { display: flex; flex-direction: column; gap: 24px; }
.sub-analytics-card { background: white; border-radius: 26px; padding: 24px; border: 1px solid #f5efe2; box-shadow: 0 8px 25px rgba(140, 106, 47, 0.02); }
.alert-card-border { border-left: 4px solid #ec5b5b; }
.card-header-borderless { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
.card-header-borderless h4 { font-size: 16px; font-weight: 800; color: #1a1a1a; margin: 0; }
.badge-danger-indicator { background: #fdf2f2; color: #ec5b5b; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 6px; }
.analytics-list { display: flex; flex-direction: column; gap: 14px; }

/* ITEM RENDERING: STOCK ALERT */
.stock-alert-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 14px; background: #fafaf9; border-radius: 14px; }
.alert-left { display: flex; align-items: center; gap: 10px; }
.indicator-dot-danger { width: 8px; height: 8px; background: #ec5b5b; border-radius: 50%; }
.alert-meta h6 { margin: 0 0 2px 0; font-size: 13px; font-weight: 600; color: #333; }
.alert-meta p { margin: 0; font-size: 11.5px; color: #666; }
.alert-right-badge { background: #ec5b5b; color: white; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 8px; }

/* MEDIA RESPONSIVE BREAKPOINTS */
@media (max-width: 1400px) { .dashboard-split-layout { grid-template-columns: 1fr; } }
@media (max-width: 1200px) { .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; } .shipping-overview-bar { grid-template-columns: 1fr; gap: 12px; } }
@media (max-width: 768px) { .welcome-card { flex-direction: column; text-align: center; padding: 30px 20px; gap: 20px; } .welcome-text-side p { max-width: 100%; } }
@media (max-width: 576px) { .stats-grid { grid-template-columns: 1fr; gap: 16px; } .table-card { padding: 20px 16px; } }
</style>

@endsection