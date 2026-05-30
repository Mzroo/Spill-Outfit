@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="text-center mb-4">

        <h4 class="fw-bold">Tambah Ukuran</h4>

        <p class="text-muted">
            Tambahkan ukuran baru untuk produk outfit
        </p>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.ukuran.store') }}" method="POST">
                @csrf

                <div class="row g-4">

                    <!-- FORM -->
                    <div class="col-md-7">

                        <!-- NAMA -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Nama Ukuran</label>

                            <input type="text"
                                   name="nama"
                                   id="namaUkuran"
                                   class="form-control"
                                   placeholder="Contoh: Small"
                                   required>

                        </div>

                        <!-- KODE -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Kode Ukuran</label>

                            <input type="text"
                                   name="kode"
                                   id="kodeUkuran"
                                   class="form-control"
                                   placeholder="Contoh: S"
                                   required>

                        </div>

                        <!-- KETERANGAN -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Keterangan</label>

                            <textarea name="keterangan"
                                      id="keteranganUkuran"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Contoh: Lingkar dada 88-92 cm"></textarea>

                        </div>

                        <!-- URUTAN (OPTIONAL - tidak wajib backend) -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Urutan Tampil</label>

                            <input type="number"
                                   name="urutan"
                                   class="form-control"
                                   value="0">

                        </div>

                        <!-- STATUS -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">Status</label>

                            <select name="status" class="form-select">

                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>

                            </select>

                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-warning w-50 rounded-pill">

                                Simpan

                            </button>

                            <a href="{{ route('admin.ukuran.index') }}"
                               class="btn btn-secondary w-50 rounded-pill">

                                Kembali

                            </a>

                        </div>

                    </div>

                    <!-- PREVIEW -->
                    <div class="col-md-5">

                        <div class="border rounded-4 p-4 h-100 shadow-sm bg-light">

                            <h6 class="text-muted mb-4 text-center">Preview Ukuran</h6>

                            <div class="text-center">

                                <span class="badge bg-warning text-dark px-4 py-3 fs-5"
                                      id="previewKode">

                                    S

                                </span>

                                <h5 class="mt-3 fw-bold"
                                    id="previewNama">

                                    Small

                                </h5>

                                <p class="text-muted"
                                   id="previewKeterangan">

                                    Lingkar dada 88-92 cm

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>

    const nama = document.getElementById('namaUkuran');
    const kode = document.getElementById('kodeUkuran');
    const keterangan = document.getElementById('keteranganUkuran');

    const previewNama = document.getElementById('previewNama');
    const previewKode = document.getElementById('previewKode');
    const previewKeterangan = document.getElementById('previewKeterangan');

    nama.addEventListener('input', function () {
        previewNama.innerText = this.value || 'Small';
    });

    kode.addEventListener('input', function () {
        previewKode.innerText = this.value || 'S';
    });

    keterangan.addEventListener('input', function () {
        previewKeterangan.innerText = this.value || 'Lingkar dada 88-92 cm';
    });

</script>

@endsection