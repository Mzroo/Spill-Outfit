@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Galeri Produk</h3>
            <p class="text-muted mb-0">
                Kelola gambar utama dan gambar tambahan produk
            </p>
        </div>
    </div>

    <div class="row g-4">

        <!-- KIRI : GAMBAR TAMBAHAN -->
        <div class="col-lg-8">

            <!-- CARD LIST -->
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        Gambar Tambahan
                    </h5>
                </div>

                <div class="card-body px-4 pb-4">

                    <!-- FORM -->
                    <form action="{{ route('admin.produk.gambar.store', $produk->id) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="upload-box mb-4">

                            <i class="fa fa-cloud-upload-alt upload-icon"></i>

                            <h6 class="fw-bold mt-3">
                                Upload Gambar Tambahan
                            </h6>

                            <p class="text-muted small mb-3">
                                Bisa upload banyak gambar sekaligus
                            </p>

                            <input type="file"
                                   name="gambar[]"
                                   class="form-control"
                                   multiple
                                   required>

                        </div>

                        <button class="btn btn-dark rounded-pill px-4">
                            <i class="fa fa-upload me-2"></i>
                            Upload Gambar
                        </button>

                    </form>

                    <hr class="my-4">

                    <!-- LIST GAMBAR -->
                    <div class="row g-4">

                        @forelse($produk->gambarTambahan as $gambar)

                        <div class="col-md-4">

                            <div class="gallery-card">

                                <img src="{{ asset('storage/' . $gambar->gambar) }}"
                                     class="gallery-img">

                                <div class="gallery-overlay">

                                    <form action="{{ route('admin.gambar.destroy', $gambar->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm rounded-pill">
                                            <i class="fa fa-trash"></i>
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                        @empty

                        <div class="text-center py-5">
                            <i class="fa fa-image fa-3x text-muted mb-3"></i>

                            <h6 class="text-muted">
                                Belum ada gambar tambahan
                            </h6>
                        </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

        <!-- KANAN : GAMBAR UTAMA -->
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 sticky-top">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Gambar Utama
                    </h5>

                    <!-- IMAGE -->
                    <div class="main-image-card mb-3">

                        <img src="{{ asset('storage/' . $produk->gambar) }}"
                             class="main-image">

                    </div>

                    <!-- INFO -->
                    <div class="text-center">

                        <h5 class="fw-bold mb-1">
                            {{ $produk->nama }}
                        </h5>

                        <p class="text-muted small mb-3">
                            {{ optional($produk->kategori)->nama }}
                        </p>

                        <div class="price-box">
                            Rp {{ number_format($produk->harga,0,',','.') }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

/* BACKGROUND */
body{
    background:#f5f7fb;
}

/* CARD */
.card{
    overflow:hidden;
}

/* UPLOAD */
.upload-box{
    border:2px dashed #d6dbe4;
    border-radius:20px;
    padding:40px;
    text-align:center;
    background:#fafbfd;
}

.upload-icon{
    font-size:45px;
    color:#313E17;
}

/* GALLERY */
.gallery-card{
    position:relative;
    border-radius:18px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.gallery-img{
    width:100%;
    height:240px;
    object-fit:cover;
}

/* OVERLAY */
.gallery-overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.35);
    display:flex;
    justify-content:center;
    align-items:center;
    opacity:0;
    transition:.3s;
}

.gallery-card:hover .gallery-overlay{
    opacity:1;
}

/* MAIN IMAGE */
.main-image-card{
    background:#f8f9fb;
    border-radius:20px;
    padding:15px;
}

.main-image{
    width:100%;
    height:380px;
    object-fit:cover;
    border-radius:18px;
}

/* PRICE */
.price-box{
    background:#313E17;
    color:white;
    padding:10px;
    border-radius:12px;
    font-weight:bold;
}

/* BUTTON */
.btn-dark{
    background:#313E17;
    border:none;
}

.btn-dark:hover{
    background:#3e4d1f;
}

/* RESPONSIVE */
@media(max-width:768px){

    .main-image{
        height:300px;
    }

    .gallery-img{
        height:200px;
    }

}

</style>

@endsection