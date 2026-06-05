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
                <h5>12 Pesanan</h5>
                <p>Perlu Dikemas</p>
            </div>
        </div>
        <div class="ship-status-item">
            <div class="ship-icon-box text-blue"><i class="fa-solid fa-dolly"></i></div>
            <div class="ship-info">
                <h5>8 Paket</h5>
                <p>Siap Dikirim</p>
            </div>
        </div>
        <div class="ship-status-item">
            <div class="ship-icon-box text-purple"><i class="fa-solid fa-truck-ramp-box"></i></div>
            <div class="ship-info">
                <h5>24 Pengiriman</h5>
                <p>Sedang Di Jalan</p>
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="dashboard-card">
            <div class="card-info-left">
                <span class="card-label">Total Produk</span>
                <h3 class="card-value">50</h3>
            </div>
            <div class="card-icon icon-produk">
                <i class="fa-solid fa-shirt"></i>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-info-left">
                <span class="card-label">Total Pesanan</span>
                <h3 class="card-value">120</h3>
            </div>
            <div class="card-icon icon-pesanan">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-info-left">
                <span class="card-label">Total Pendapatan</span>
                <h3 class="card-value">Rp 5.000.000</h3>
            </div>
            <div class="card-icon icon-pendapatan">
                <i class="fa-solid fa-wallet"></i>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-info-left">
                <span class="card-label">Total Customer</span>
                <h3 class="card-value">75</h3>
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
                            <th style="width: 110px; text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-monospace invoice-col">#INV001</td>
                            <td class="customer-name-col">Adriansyah</td>
                            <td class="price-col">Rp 250.000</td>
                            <td style="text-align: center;">
                                <span class="status-badge status-pending">Pending</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-monospace invoice-col">#INV002</td>
                            <td class="customer-name-col">Rizky</td>
                            <td class="price-col">Rp 300.000</td>
                            <td style="text-align: center;">
                                <span class="status-badge status-success">Selesai</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-monospace invoice-col">#INV003</td>
                            <td class="customer-name-col">Budi</td>
                            <td class="price-col">Rp 180.000</td>
                            <td style="text-align: center;">
                                <span class="status-badge status-danger">Batal</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="analytics-column">
            
            <div class="sub-analytics-card">
                <div class="card-header-borderless">
                    <h4>Top Selling Outfit 🔥</h4>
                    <span class="badge-header-info">Bulan Ini</span>
                </div>
                
                <div class="analytics-list">
                    <div class="product-rank-item">
                        <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=150&auto=format&fit=crop" class="rank-img" alt="outfit">
                        <div class="rank-info">
                            <h6>Oversized Linen Shirt</h6>
                            <p>Kategori: Atasan</p>
                        </div>
                        <div class="rank-sales">
                            <strong>42 Pcs</strong>
                            <span>Terjual</span>
                        </div>
                    </div>
                    <div class="product-rank-item">
                        <img src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=150&auto=format&fit=crop" class="rank-img" alt="outfit">
                        <div class="rank-info">
                            <h6>Loose Wide Denim Pants</h6>
                            <p>Kategori: Bawahan</p>
                        </div>
                        <div class="rank-sales">
                            <strong>35 Pcs</strong>
                            <span>Terjual</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-analytics-card alert-card-border">
                <div class="card-header-borderless">
                    <h4>Stok Hampir Habis ⚠️</h4>
                    <span class="badge-danger-indicator">Perlu Restock</span>
                </div>
                
                <div class="analytics-list">
                    <div class="stock-alert-item">
                        <div class="alert-left">
                            <span class="indicator-dot-danger"></span>
                            <div class="alert-meta">
                                <h6>Kemeja Flanel Vintage</h6>
                                <p>Varian: <strong>Size L / Hitam</strong></p>
                            </div>
                        </div>
                        <div class="alert-right-badge">Sisa 2 Pcs</div>
                    </div>
                    <div class="stock-alert-item">
                        <div class="alert-left">
                            <span class="indicator-dot-danger"></span>
                            <div class="alert-meta">
                                <h6>Knitwear Cardigan Cream</h6>
                                <p>Varian: <strong>Size XL / Beige</strong></p>
                            </div>
                        </div>
                        <div class="alert-right-badge">Sisa 3 Pcs</div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<style>
/* ================= GLOBAL DESIGN SYSTEM DASHBOARD (NORMAL CSS) ================= */
.dashboard-container {
    font-family: 'Poppins', sans-serif;
    padding: 24px 0;
    box-sizing: border-box;
}
.dashboard-container *, .dashboard-container *::before, .dashboard-container *::after {
    box-sizing: border-box;
}

/* ================= WELCOME HERO BANNER ================= */
.welcome-card {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    border-radius: 30px;
    padding: 35px 40px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.15);
}
.welcome-text-side h3 {
    font-size: 28px;
    font-weight: 700;
    margin: 0 0 10px 0;
    letter-spacing: -0.5px;
}
.welcome-text-side p {
    margin: 0;
    opacity: 0.9;
    max-width: 550px;
    font-size: 14.5px;
    line-height: 1.6;
}
.welcome-icon {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.18);
    border-radius: 26px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}
.welcome-icon i { font-size: 42px; }

/* ================= SHIPPMENT OVERVIEW COMPONENT ================= */
.shipping-overview-bar {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}
.ship-status-item {
    background: #ffffff;
    border: 1px solid #f5efe2;
    border-radius: 20px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 16px;
}
.ship-icon-box {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}
.text-orange { background: #fff5e6; color: #ff9f43; }
.text-blue { background: #ebf5ff; color: #2196f3; }
.text-purple { background: #f3ebff; color: #9b5de5; }

.ship-info h5 { margin: 0 0 2px 0; font-size: 15px; font-weight: 700; color: #1a1a1a; }
.ship-info p { margin: 0; font-size: 12.5px; color: #777777; }

/* ================= STATS DISPLAY (CSS GRID) ================= */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-bottom: 30px;
}
.dashboard-card {
    background: white;
    border-radius: 24px;
    padding: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: 1px solid #f5efe2;
    box-shadow: 0 8px 25px rgba(140, 106, 47, 0.02);
}
.card-info-left { display: flex; flex-direction: column; }
.card-label { color: #888888; font-size: 13.5px; font-weight: 500; }
.card-value { margin: 8px 0 0 0; font-size: 25px; font-weight: 800; color: #1a1a1a; letter-spacing: -0.5px; }

.card-icon { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
.icon-produk { background-color: #faf6ed; color: #8C6A2F; }
.icon-pesanan { background-color: #edf7f5; color: #2ecc71; }
.icon-pendapatan { background-color: #fef9eb; color: #f1c40f; }
.icon-customer { background-color: #fdf3f3; color: #e74c3c; }

/* ================= SPLIT SECTIONS (TABLE VS SIDE-ANALYTICS) ================= */
.dashboard-split-layout {
    display: grid;
    grid-template-columns: 1.6fr 1.1fr;
    gap: 24px;
    align-items: start;
}

/* LEFT BLOCK: RECENT ORDERS CONTAINER */
.table-card {
    background: white;
    border-radius: 26px;
    padding: 28px;
    border: 1px solid #f5efe2;
    box-shadow: 0 10px 30px rgba(140, 106, 47, 0.02);
}
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
.font-monospace { font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace; }

/* BADGES SPEED MATRIX */
.status-badge { display: inline-block; padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; text-align: center; width: 100%; }
.status-pending { background-color: #fff9e6; color: #f1c40f; }
.status-success { background-color: #e8f8f5; color: #1abc9c; }
.status-danger { background-color: #fdf2f2; color: #ec5b5b; }

/* RIGHT BLOCK: FLUID DATA ANALYTICS CARDS */
.analytics-column {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.sub-analytics-card {
    background: white;
    border-radius: 26px;
    padding: 24px;
    border: 1px solid #f5efe2;
    box-shadow: 0 8px 25px rgba(140, 106, 47, 0.02);
}
.alert-card-border { border-left: 4px solid #ec5b5b; }

.card-header-borderless {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}
.card-header-borderless h4 { font-size: 16px; font-weight: 800; color: #1a1a1a; margin: 0; }

.badge-header-info { background: #faf6ed; color: #8C6A2F; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 6px; }
.badge-danger-indicator { background: #fdf2f2; color: #ec5b5b; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 6px; }

.analytics-list { display: flex; flex-direction: column; gap: 14px; }

/* ITEM RENDERING: TOP SELLING */
.product-rank-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid #fcfbf9;
}
.product-rank-item:last-child { border: none; padding-bottom: 0; }
.rank-img { width: 48px; height: 48px; border-radius: 10px; object-fit: cover; border: 1px solid #f5efe2; }
.rank-info { flex-grow: 1; }
.rank-info h6 { margin: 0 0 2px 0; font-size: 13.5px; font-weight: 600; color: #333; }
.rank-info p { margin: 0; font-size: 11.5px; color: #888; }
.rank-sales { text-align: right; }
.rank-sales strong { display: block; font-size: 14px; color: #8C6A2F; font-weight: 700; }
.rank-sales span { font-size: 11px; color: #aaa; }

/* ITEM RENDERING: STOCK ALERT */
.stock-alert-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 14px;
    background: #fafaf9;
    border-radius: 14px;
}
.alert-left { display: flex; align-items: center; gap: 10px; }
.indicator-dot-danger { width: 8px; height: 8px; background: #ec5b5b; border-radius: 50%; }
.alert-meta h6 { margin: 0 0 2px 0; font-size: 13px; font-weight: 600; color: #333; }
.alert-meta p { margin: 0; font-size: 11.5px; color: #666; }
.alert-right-badge { background: #ec5b5b; color: white; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 8px; }

/* ================= MEDIA RESPONSIVE BREAKPOINTS ================= */
@media (max-width: 1400px) {
    .dashboard-split-layout { grid-template-columns: 1fr; }
}
@media (max-width: 1200px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .shipping-overview-bar { grid-template-columns: 1fr; gap: 12px; }
}
@media (max-width: 768px) {
    .welcome-card { flex-direction: column; text-align: center; padding: 30px 20px; gap: 20px; }
    .welcome-text-side p { max-width: 100%; }
}
@media (max-width: 576px) {
    .stats-grid { grid-template-columns: 1fr; gap: 16px; }
    .table-card { padding: 20px 16px; }
}
</style>

@endsection