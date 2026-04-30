@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold">Edit Produk</h4>
        <p class="text-muted">Ubah data produk</p>
    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <form action="{{ route('produk.update', $produk->id) }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-0">

                <!-- KIRI: GAMBAR -->
                <div class="col-md-5 bg-light d-flex flex-column align-items-center justify-content-center p-4">

                    <h6 class="fw-semibold mb-3">Gambar Produk</h6>

                    <!-- PREVIEW -->
                    <img id="previewImage"
                         src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/300' }}"
                         class="img-fluid rounded-3 mb-3"
                         style="max-height: 300px; object-fit: cover;">

                    <!-- INPUT FILE -->
                    <input type="file" name="gambar" id="imageInput" class="form-control">

                    <small class="text-muted mt-2">
                        Kosongkan jika tidak ingin mengganti gambar
                    </small>

                </div>

                <!-- KANAN: FORM -->
                <div class="col-md-7 p-4">

                    <div class="row">

                        <!-- KODE -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kode Produk</label>
                            <input type="text" name="kode" 
                                   class="form-control"
                                   value="{{ $produk->kode }}" required>
                        </div>

                        <!-- NAMA -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" 
                                   class="form-control"
                                   value="{{ $produk->nama }}" required>
                        </div>

                        <!-- KATEGORI -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $produk->kategori_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- STATUS -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="public" {{ $produk->status == 'public' ? 'selected' : '' }}>
                                    Public
                                </option>
                                <option value="block" {{ $produk->status == 'block' ? 'selected' : '' }}>
                                    Block
                                </option>
                            </select>
                        </div>

                        <!-- HARGA -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" 
                                   class="form-control"
                                   value="{{ $produk->harga }}" required>
                        </div>

                        <!-- STOK -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" 
                                   class="form-control"
                                   value="{{ $produk->stok }}" required>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" 
                                      class="form-control" rows="4">{{ $produk->deskripsi }}</textarea>
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        Update Produk
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