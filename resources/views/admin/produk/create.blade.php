@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold">Tambah Produk</h4>
        <p class="text-muted">Isi data produk dan upload gambar</p>
    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-0">

                <!-- KIRI: GAMBAR -->
                <div class="col-md-5 bg-light d-flex flex-column align-items-center justify-content-center p-4">

                    <h6 class="fw-semibold mb-3">Preview Gambar</h6>

                    <!-- PREVIEW -->
                    <img id="previewImage"
                         src="https://via.placeholder.com/300x300?text=Preview"
                         class="img-fluid rounded-3 mb-3"
                         style="max-height: 300px; object-fit: cover;">

                    <!-- INPUT FILE -->
                    <input type="file" name="gambar" id="imageInput" 
                           class="form-control mt-3">

                    <small class="text-muted mt-2">
                        Upload gambar produk
                    </small>

                </div>

                <!-- KANAN: FORM -->
                <div class="col-md-7 p-4">

                    <div class="row">

                        <!-- KODE -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kode Produk</label>
                            <input type="text" name="kode" class="form-control" required>
                        </div>

                        <!-- NAMA -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <!-- KATEGORI -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- STATUS -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="public">Public</option>
                                <option value="block">Block</option>
                            </select>
                        </div>

                        <!-- HARGA -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>

                        <!-- STOK -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="btn btn-warning w-100 mt-2 fw-semibold">
                        Simpan Produk
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- JS PREVIEW -->
<script>
    const input = document.getElementById('imageInput');
    const previewMain = document.getElementById('previewImage');

    input.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            previewMain.src = URL.createObjectURL(file);
        }
    });
</script>

@endsection