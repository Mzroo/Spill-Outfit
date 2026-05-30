@extends('layouts.admin')

@section('title', 'Edit Warna')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="text-center mb-4">

        <h4 class="fw-bold">
            Edit Warna
        </h4>

        <p class="text-muted">
            Perbarui data warna produk outfit
        </p>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.warna.update', $warna->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- FORM -->
                    <div class="col-lg-6">

                        <!-- NAMA WARNA -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Nama Warna
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="namaWarna"
                                class="form-control rounded-4"
                                value="{{ old('nama', $warna->nama) }}"
                                required
                            >

                        </div>

                        <!-- KODE WARNA -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Pilih Warna
                            </label>

                            <input
                                type="color"
                                name="kode_warna"
                                id="kodeWarna"
                                class="form-control form-control-color w-100 rounded-4"
                                value="{{ old('kode_warna', $warna->kode_warna ?? '#000000') }}"
                            >

                        </div>

                        <!-- STATUS -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select rounded-4">

                                <option value="aktif"
                                    {{ $warna->status == 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="nonaktif"
                                    {{ $warna->status == 'nonaktif' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>

                            </select>

                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-warning rounded-pill w-50">

                                Update

                            </button>

                            <a href="{{ route('admin.warna.index') }}"
                               class="btn btn-secondary rounded-pill w-50">

                                Kembali

                            </a>

                        </div>

                    </div>

                    <!-- PREVIEW -->
                    <div class="col-lg-6">

                        <div class="border rounded-4 p-5 h-100 d-flex flex-column justify-content-center align-items-center text-center">

                            <h6 class="text-muted mb-4">
                                Preview Warna
                            </h6>

                            <!-- PREVIEW BULATAN -->
                            <div id="previewColor"
                                style="
                                    width:140px;
                                    height:140px;
                                    border-radius:50%;
                                    background:{{ $warna->kode_warna ?? '#000000' }};
                                    border:6px solid #f3f3f3;
                                    box-shadow:0 8px 25px rgba(0,0,0,.08);
                                ">
                            </div>

                            <h4 id="previewNama"
                                class="mt-4 fw-bold">

                                {{ $warna->nama }}

                            </h4>

                            <small id="previewKode"
                                   class="text-muted">

                                {{ $warna->kode_warna }}

                            </small>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- JS PREVIEW -->
<script>

    const namaWarna =
        document.getElementById('namaWarna');

    const kodeWarna =
        document.getElementById('kodeWarna');

    const previewNama =
        document.getElementById('previewNama');

    const previewKode =
        document.getElementById('previewKode');

    const previewColor =
        document.getElementById('previewColor');

    // Update nama realtime
    namaWarna.addEventListener('keyup', function(){

        previewNama.innerText =
            namaWarna.value || 'Nama Warna';

    });

    // Update warna realtime
    kodeWarna.addEventListener('input', function(){

        previewColor.style.background =
            kodeWarna.value;

        previewKode.innerText =
            kodeWarna.value;

    });

</script>

@endsection