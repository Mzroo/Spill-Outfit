@extends('layouts.app')

@section('content')
@include('guest.partials.navbar')
@include('guest.partials.hero')
@include('guest.partials.kategori')
<div class="container py-5">

    <!-- TITLE -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Outfit Kuliah 🎓</h2>
        <p class="text-muted">
            Rekomendasi outfit simpel, nyaman, dan tetap stylish untuk ke kampus.
        </p>
    </div>

    <!-- OUTFIT UTAMA -->
    <div class="row align-items-center">

        <!-- GAMBAR -->
        <div class="col-md-6 text-center mb-4">
            <img src="{{ asset('images/outfit/kuliah.jpg') }}" 
                 class="img-fluid rounded shadow-sm">
        </div>

        <!-- DETAIL -->
        <div class="col-md-6">

            <h4 class="fw-bold mb-3">Rekomendasi Outfit</h4>

            <ul class="list-group mb-4">
                <li class="list-group-item">👕 Atasan : Kaos Polos</li>
                <li class="list-group-item">👖 Bawahan : Jeans</li>
                <li class="list-group-item">👟 Sepatu : Sneakers</li>
                <li class="list-group-item">🎒 Tas : Backpack</li>
            </ul>

            <a href="#produk" class="btn btn-dark rounded-pill px-4">
                Lihat Produk
            </a>

        </div>

    </div>

    <!-- ALTERNATIF -->
    <div class="mt-5">
        <h5 class="fw-bold mb-3">Alternatif Outfit</h5>

        <div class="row">

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm p-3">
                    <h6>Casual Look</h6>
                    <p class="text-muted small">
                        Hoodie + Jeans + Sneakers
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm p-3">
                    <h6>Semi Formal</h6>
                    <p class="text-muted small">
                        Kemeja + Chino + Sepatu Casual
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection