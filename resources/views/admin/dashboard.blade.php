@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">
    <div class="row g-3">

        <!-- WELCOME CARD -->
        <div class="col-12">
            <div class="card shadow border-0 mb-4">
                <div class="card-body text-center">

                    <img src="" 
                        alt="Dashboard Admin" 
                        class="img-fluid mb-3" 
                        style="max-height: 200px;">

                    <h4 class="fw-bold">Selamat Datang di Dashboard Admin Toko Outfit</h4>
                    <p class="text-muted">
                        Kelola produk, pesanan, dan pelanggan dengan mudah.
                    </p>

                </div>
            </div>
        </div>

        <!-- CARD 1 -->
        <div class="col-md-3 col-sm-6">
            <div class="card-dashboard shadow-sm">
                <div>
                    <p class="card-title">Total Produk</p>
                    <h4>50</h4>
                </div>
                <div class="icon bg-primary">
                    <i class="fa fa-tshirt"></i>
                </div>
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="col-md-3 col-sm-6">
            <div class="card-dashboard shadow-sm">
                <div>
                    <p class="card-title">Total Pesanan</p>
                    <h4>120</h4>
                </div>
                <div class="icon bg-success">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="col-md-3 col-sm-6">
            <div class="card-dashboard shadow-sm">
                <div>
                    <p class="card-title">Pendapatan</p>
                    <h4>Rp 5.000.000</h4>
                </div>
                <div class="icon bg-warning">
                    <i class="fa fa-money-bill"></i>
                </div>
            </div>
        </div>

        <!-- CARD 4 -->
        <div class="col-md-3 col-sm-6">
            <div class="card-dashboard shadow-sm">
                <div>
                    <p class="card-title">Total Pelanggan</p>
                    <h4>75</h4>
                </div>
                <div class="icon bg-danger">
                    <i class="fa fa-users"></i>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection