@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4">

        <div>

            <h3 class="page-title">
                Tambah Kategori
            </h3>

            <p class="page-subtitle">
                Tambahkan kategori baru untuk produk outfit
            </p>

        </div>

    </div>

    <!-- CARD -->
    <div class="custom-card">

        <form
            action="{{ route('admin.kategori.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="row g-4">

                <!-- LEFT -->
                <div class="col-lg-7">

                    <!-- NAMA -->
                    <div class="form-group-custom">

                        <label class="form-label-custom">

                            Nama Kategori

                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="namaKategori"
                            class="form-control-custom @error('nama') is-invalid @enderror"
                            placeholder="Contoh: Hoodie"
                            value="{{ old('nama') }}"
                        >

                        @error('nama')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <!-- SLUG -->
                    <div class="form-group-custom mt-4">

                        <label class="form-label-custom">

                            Slug Otomatis

                        </label>

                        <input
                            type="text"
                            id="slugKategori"
                            class="form-control-custom bg-light"
                            readonly
                        >

                    </div>

                    <!-- GAMBAR -->
                    <div class="form-group-custom mt-4">

                        <label class="form-label-custom">

                            Gambar Kategori

                        </label>

                        <input
                            type="file"
                            name="gambar"
                            id="gambarKategori"
                            class="form-control-custom"
                            accept="image/*"
                        >

                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex gap-3 mt-4">

                        <button
                            type="submit"
                            class="btn-save"
                        >
                            <i class="fa-solid fa-floppy-disk"></i>
                            Simpan
                        </button>

                        <a
                            href="{{ route('admin.kategori.index') }}"
                            class="btn-back"
                        >
                            Kembali
                        </a>

                    </div>

                </div>

                <!-- RIGHT PREVIEW -->
                <div class="col-lg-5">

                    <div class="preview-card">

                        <h5 class="preview-title">
                            Preview Kategori
                        </h5>

                        <div class="preview-image-box">

                            <img
                                id="previewImage"
                                src="https://placehold.co/250x180?text=Preview"
                                alt="preview"
                            >

                        </div>

                        <h4 id="previewNama">

                            Nama Kategori

                        </h4>

                        <span id="previewSlug">

                            slug-kategori

                        </span>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

<style>

/* ================= HEADER ================= */

.page-title{

    font-size:30px;
    font-weight:700;
    color:#222;
    margin:0;

}

.page-subtitle{

    color:#888;
    margin:0;

}

/* ================= CARD ================= */

.custom-card{

    background:white;

    border-radius:30px;

    padding:35px;

    box-shadow:
    0 10px 35px rgba(0,0,0,.05);

}

/* ================= FORM ================= */

.form-group-custom{

    display:flex;
    flex-direction:column;

}

.form-label-custom{

    font-weight:600;
    margin-bottom:12px;

    color:#333;

}

.form-control-custom{

    width:100%;

    height:58px;

    border:none;
    outline:none;

    border-radius:20px;

    background:#faf6ef;

    padding:0 22px;

    font-size:15px;

    transition:.3s ease;

}

.form-control-custom:focus{

    box-shadow:
    0 0 0 3px rgba(182,141,64,.15);

}

/* ================= BUTTON ================= */

.btn-save{

    border:none;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    padding:14px 28px;

    border-radius:18px;

    font-weight:600;

    transition:.3s ease;

}

.btn-save:hover{

    transform:translateY(-2px);

}

.btn-back{

    text-decoration:none;

    background:#f2f2f2;

    color:#444;

    padding:14px 28px;

    border-radius:18px;

    font-weight:600;

}

/* ================= PREVIEW ================= */

.preview-card{

    background:#faf6ef;

    border-radius:30px;

    padding:30px;

    text-align:center;

    height:100%;

}

.preview-title{

    font-weight:700;
    margin-bottom:25px;

}

.preview-image-box{

    width:100%;

    height:220px;

    border-radius:25px;

    overflow:hidden;

    background:white;

    margin-bottom:25px;

}

.preview-image-box img{

    width:100%;
    height:100%;

    object-fit:cover;

}

#previewNama{

    font-weight:700;

    color:#222;

}

#previewSlug{

    background:white;

    padding:10px 18px;

    border-radius:50px;

    display:inline-block;

    margin-top:12px;

    color:#8C6A2F;

}

/* ================= MOBILE ================= */

@media(max-width:768px){

    .custom-card{

        padding:20px;

    }

}

</style>

<script>

    const nama =
        document.getElementById('namaKategori');

    const slug =
        document.getElementById('slugKategori');

    const previewNama =
        document.getElementById('previewNama');

    const previewSlug =
        document.getElementById('previewSlug');

    const gambarInput =
        document.getElementById('gambarKategori');

    const previewImage =
        document.getElementById('previewImage');

    // AUTO SLUG

    nama.addEventListener('keyup', function(){

        let value = nama.value;

        let slugValue = value
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w-]+/g, '');

        slug.value = slugValue;

        previewNama.innerText =
            value || 'Nama Kategori';

        previewSlug.innerText =
            slugValue || 'slug-kategori';

    });

    // IMAGE PREVIEW

    gambarInput.addEventListener('change', function(e){

        const file =
            e.target.files[0];

        if(file){

            previewImage.src =
                URL.createObjectURL(file);

        }

    });

</script>

@endsection