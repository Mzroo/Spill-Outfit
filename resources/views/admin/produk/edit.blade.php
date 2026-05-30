@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="text-center mb-4">

        <h4 class="fw-bold">Edit Produk</h4>
        <p class="text-muted">Perbarui data produk</p>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.produk.update', $produk->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- LEFT -->
                    <div class="col-lg-6">

                        <!-- KODE -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kode Produk</label>
                            <input type="text"
                                   name="kode"
                                   class="form-control rounded-4"
                                   value="{{ $produk->kode }}"
                                   required>
                        </div>

                        <!-- NAMA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text"
                                   name="nama"
                                   id="namaProduk"
                                   class="form-control rounded-4"
                                   value="{{ $produk->nama }}"
                                   required>
                        </div>

                        <!-- KATEGORI -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="kategori_id"
                                    class="form-select rounded-4"
                                    required>

                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- BRAND -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Brand</label>
                            <select name="brand_id"
                                    class="form-select rounded-4">

                                <option value="">-- Pilih Brand --</option>

                                @foreach($brand as $b)
                                    <option value="{{ $b->id }}"
                                        {{ $produk->brand_id == $b->id ? 'selected' : '' }}>
                                        {{ $b->nama }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- HARGA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Harga</label>
                            <input type="number"
                                   name="harga"
                                   class="form-control rounded-4"
                                   value="{{ $produk->harga }}"
                                   required>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status"
                                    class="form-select rounded-4">

                                <option value="public"
                                    {{ $produk->status == 'public' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="block"
                                    {{ $produk->status == 'block' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>

                            </select>
                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-lg-6">

                        <!-- DESKRIPSI -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi"
                                      rows="4"
                                      class="form-control rounded-4">{{ $produk->deskripsi }}</textarea>
                        </div>

                        <!-- GAMBAR -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gambar Produk</label>

                            <input type="file"
                                   name="gambar"
                                   id="inputGambar"
                                   accept="image/*"
                                   class="form-control rounded-4">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin diganti
                            </small>
                        </div>

                        <!-- PREVIEW GAMBAR -->
                        <div class="border rounded-4 p-3 text-center bg-light">

                            <h6 class="text-muted mb-3">Preview Gambar</h6>

                            <img id="previewImage"
                                 src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/250x200?text=No+Image' }}"
                                 class="rounded border"
                                 style="width:100%; max-height:250px; object-fit:cover;">

                            <h6 class="mt-3 text-muted">Preview Nama</h6>

                            <h5 id="previewNama">{{ $produk->nama }}</h5>

                        </div>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2 mt-4">

                    <button type="submit"
                            class="btn btn-warning rounded-pill w-50">

                        Update Produk

                    </button>

                    <a href="{{ route('admin.produk.index') }}"
                       class="btn btn-secondary rounded-pill w-50">

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- JS -->
<script>
// preview nama
document.getElementById('namaProduk').addEventListener('input', function () {
    document.getElementById('previewNama').innerText = this.value || '-';
});

// preview gambar
document.getElementById('inputGambar').addEventListener('change', function (e) {
    const file = e.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('previewImage').src = e.target.result;
        }

        reader.readAsDataURL(file);
    }
});
</script>

@endsection