@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="text-center mb-4">
        <h4 class="fw-bold">Edit Kategori</h4>
        <p class="text-muted">Perbarui kategori produk</p>
    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- FORM -->
                    <div class="col-md-6">

                        <!-- NAMA -->
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" 
                                   name="nama"
                                   id="namaKategori"
                                   class="form-control"
                                   value="{{ $kategori->nama }}"
                                   required>
                        </div>

                        <!-- SLUG -->
                        <div class="mb-3">
                            <label class="form-label">Slug (otomatis)</label>
                            <input type="text" 
                                   id="slugKategori"
                                   class="form-control"
                                   value="{{ $kategori->slug }}"
                                   readonly>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn btn-warning w-50">
                                Update
                            </button>

                            <a href="{{ route('kategori.index') }}" class="btn btn-secondary w-50">
                                Kembali
                            </a>
                        </div>

                    </div>

                    <!-- PREVIEW -->
                    <div class="col-md-6">

                        <div class="border rounded-4 p-4 text-center h-100 d-flex flex-column justify-content-center">

                            <h6 class="text-muted mb-3">Preview</h6>

                            <h5 id="previewNama">{{ $kategori->nama }}</h5>

                            <small class="text-muted" id="previewSlug">{{ $kategori->slug }}</small>

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<!-- JS -->
<script>
    const nama = document.getElementById('namaKategori');
    const slug = document.getElementById('slugKategori');

    const previewNama = document.getElementById('previewNama');
    const previewSlug = document.getElementById('previewSlug');

    nama.addEventListener('keyup', function() {
        let value = nama.value;

        let slugValue = value
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');

        slug.value = slugValue;

        previewNama.innerText = value;
        previewSlug.innerText = slugValue;
    });
</script>

@endsection