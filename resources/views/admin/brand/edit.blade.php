@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="text-center mb-4">

        <h4 class="fw-bold">
            Edit Brand
        </h4>

        <p class="text-muted">
            Perbarui data brand / merek produk outfit
        </p>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form
                action="{{ route('admin.brand.update', $brand->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- FORM -->
                    <div class="col-lg-7">

                        <!-- NAMA -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Nama Brand
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="namaBrand"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $brand->nama) }}"
                                placeholder="Contoh: Nike"
                                required
                            >

                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <!-- SLUG -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Slug
                            </label>

                            <input
                                type="text"
                                id="slugBrand"
                                class="form-control"
                                value="{{ $brand->slug }}"
                                readonly
                            >

                        </div>

                        <!-- LOGO -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Logo Brand
                            </label>

                            <input
                                type="file"
                                name="logo"
                                id="logoInput"
                                class="form-control"
                                accept="image/*"
                            >

                            <small class="text-muted">
                                Upload logo baru jika ingin mengganti
                            </small>

                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                rows="5"
                                class="form-control"
                                placeholder="Deskripsi brand..."
                            >{{ old('deskripsi', $brand->deskripsi) }}</textarea>

                        </div>

                        <!-- STATUS -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select
                                name="status"
                                id="statusBrand"
                                class="form-select"
                            >
                                <option
                                    value="aktif"
                                    {{ $brand->status == 'aktif' ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="nonaktif"
                                    {{ $brand->status == 'nonaktif' ? 'selected' : '' }}
                                >
                                    Nonaktif
                                </option>

                            </select>

                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-warning rounded-pill px-4"
                            >
                                <i class="fa-solid fa-pen-to-square me-2"></i>
                                Update
                            </button>

                            <a
                                href="{{ route('admin.brand.index') }}"
                                class="btn btn-secondary rounded-pill px-4"
                            >
                                Kembali
                            </a>

                        </div>

                    </div>

                    <!-- PREVIEW -->
                    <div class="col-lg-5">

                        <div class="preview-card">

                            <h6 class="text-muted mb-4">
                                Preview Brand
                            </h6>

                            <!-- IMAGE -->
                            <img
                                src="{{ $brand->logo ? asset('storage/'.$brand->logo) : 'https://placehold.co/150x150?text=Logo' }}"
                                id="previewLogo"
                                class="preview-image"
                                alt="Logo Brand"
                            >

                            <!-- NAME -->
                            <h4
                                class="fw-bold mt-3"
                                id="previewNama"
                            >
                                {{ $brand->nama }}
                            </h4>

                            <!-- SLUG -->
                            <p
                                class="text-muted"
                                id="previewSlug"
                            >
                                {{ $brand->slug }}
                            </p>

                            <!-- STATUS -->
                            <span
                                class="badge rounded-pill px-3 py-2
                                {{ $brand->status == 'aktif'
                                    ? 'bg-success'
                                    : 'bg-secondary' }}"
                                id="previewStatus"
                            >
                                {{ $brand->status }}
                            </span>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<style>

/* CARD PREVIEW */

.preview-card{

    background: #fafafa;
    border: 1px solid #eee;

    border-radius: 30px;

    padding: 40px 25px;

    text-align: center;

    height: 100%;
}

/* IMAGE */

.preview-image{

    width: 150px;
    height: 150px;

    object-fit: cover;

    border-radius: 24px;

    border: 1px solid #ddd;
}

/* FORM */

.form-control,
.form-select{

    border-radius: 14px;

    min-height: 50px;
}

/* BUTTON */

.btn-warning{

    background: #B68D40;

    border: none;

    color: white;
}

.btn-warning:hover{

    background: #9f7b35;
}

</style>

<script>

// ================= NAMA -> SLUG =================

const namaBrand =
    document.getElementById('namaBrand');

const slugBrand =
    document.getElementById('slugBrand');

const previewNama =
    document.getElementById('previewNama');

const previewSlug =
    document.getElementById('previewSlug');

namaBrand.addEventListener('keyup', function(){

    let nama = this.value;

    let slug = nama
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'');

    slugBrand.value = slug;

    previewNama.innerText =
        nama || 'Nama Brand';

    previewSlug.innerText =
        slug || 'slug-brand';

});

// ================= PREVIEW IMAGE =================

document
.getElementById('logoInput')
.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        document
        .getElementById('previewLogo')
        .src = URL.createObjectURL(file);

    }

});

// ================= STATUS =================

document
.getElementById('statusBrand')
.addEventListener('change', function(){

    const badge =
        document.getElementById('previewStatus');

    badge.innerText =
        this.value;

    badge.className =
        'badge rounded-pill px-3 py-2 ' +
        (this.value === 'aktif'
            ? 'bg-success'
            : 'bg-secondary');

});

</script>

@endsection