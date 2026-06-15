@extends('layouts.user') @section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container py-5 text-center">
    <div class="success-card shadow-sm mx-auto p-5" style="max-width: 550px; background: white; border-radius: 24px; border: 1px solid #f5efe2;">
        
        <div class="success-icon-box mb-4">
            <i class="mdi mdi-checkbox-marked-circle-outline text-success" style="font-size: 76px; color: #2ecc71;"></i>
        </div>

        <h2 class="fw-bold mb-2" style="color: #1a1a1a; font-family: 'Poppins', sans-serif; font-weight: 800;">
            Terima Kasih Atas Pembayaran Anda!
        </h2>
        <p class="text-muted mb-4" style="font-size: 14.5px; line-height: 1.6;">
            Pesanan Anda dengan nomor invoice <strong class="text-gold">#{{ $pesanan->kode_pesanan ?? $pesanan->id }}</strong> telah berhasil kami verifikasi. Sistem database toko telah diperbarui secara otomatis.
        </p>

        <div class="summary-box p-3 mb-4" style="background: #faf8f5; border-radius: 14px; border: 1px solid #ebdcb9; text-align: left;">
            <div class="d-flex justify-content-between mb-2" style="font-size: 14px;">
                <span class="text-muted">Total Transaksi:</span>
                <strong style="color: #8C6A2F; font-weight: 700;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong>
            </div>
            <div class="d-flex justify-content-between" style="font-size: 14px;">
                <span class="text-muted">Status Logistik:</span>
                <span class="badge bg-success-light text-success" style="font-weight: 700; background: #e8f8f5; padding: 4px 8px; border-radius: 6px;">
                    Perlu Dikemas (Lunas)
                </span>
            </div>
        </div>

        <div class="d-flex flex-column gap-2">
            <a href="{{ route('pesanan.index') }}" class="btn-check-history py-3">
                <i class="mdi mdi-clock-rotate-left me-1.5"></i> Lihat Riwayat Belanja Kamu
            </a>
            <a href="{{ url('/') }}" class="text-decoration-none pt-2" style="color: #888; font-size: 13.5px; font-weight: 500;">
                Kembali ke Beranda Utama Toko
            </a>
        </div>
    </div>
</div>

<style>
.text-gold { color: #B68D40; }
.btn-check-history {
    background: linear-gradient(135deg, #8C6A2F, #C9A227);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    display: block;
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(140, 106, 47, 0.15);
}
.btn-check-history:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(140, 106, 47, 0.25);
    color: white;
}
</style>
@endsection