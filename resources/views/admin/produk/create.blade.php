@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="text-center mb-4">

        <h4 class="fw-bold">Tambah Produk</h4>
        <p class="text-muted">Masukkan data produk outfit baru</p>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row g-4">

                    <!-- LEFT -->
                    <div class="col-lg-6">

                        <!-- KODE -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kode Produk</label>
                            <input type="text"
                                   name="kode"
                                   class="form-control rounded-4"
                                   placeholder="PRD-001"
                                   required>
                        </div>

                        <!-- NAMA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text"
                                   name="nama"
                                   id="namaProduk"
                                   class="form-control rounded-4"
                                   placeholder="Contoh: Hoodie Oversize"
                                   required>
                        </div>

                        <!-- KATEGORI -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="kategori_id"
                                    class="form-select rounded-4"
                                    required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
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
                                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- HARGA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Harga</label>
                            <input type="number"
                                   name="harga"
                                   class="form-control rounded-4"
                                   placeholder="150000"
                                   required>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status Produk</label>
                            <select name="status"
                                    class="form-select rounded-4">
                                <option value="public">Aktif</option>
                                <option value="block">Nonaktif</option>
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
                                      class="form-control rounded-4"
                                      placeholder="Deskripsi produk..."></textarea>
                        </div>

                        <!-- GAMBAR INPUT -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gambar Produk</label>

                            <input type="file"
                                   name="gambar"
                                   id="inputGambar"
                                   accept="image/*"
                                   class="form-control rounded-4">

                            <small class="text-muted">
                                JPG, PNG, JPEG (max 2MB)
                            </small>
                        </div>

                        <!-- PREVIEW GAMBAR -->
                        <div class="border rounded-4 p-3 text-center bg-light">

                            <h6 class="text-muted mb-3">Preview Gambar</h6>

                            <img id="previewImage"
                                 src="https://via.placeholder.com/250x200?text=No+Image"
                                 class="rounded border"
                                 style="width:100%; max-height:250px; object-fit:cover;">

                            <h6 class="mt-3 text-muted">Preview Nama</h6>

                            <h5 id="previewNama">-</h5>

                        </div>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2 mt-4">

                    <button type="submit"
                            class="btn btn-warning rounded-pill w-50">

                        Simpan Produk

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

<!-- JS PREVIEW -->
<script>
// nama preview
document.getElementById('namaProduk').addEventListener('input', function () {
    document.getElementById('previewNama').innerText = this.value || '-';
});

// gambar preview
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