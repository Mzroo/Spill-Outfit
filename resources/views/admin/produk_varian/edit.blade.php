@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="text-center mb-4">

        <h4 class="fw-bold">Edit Produk Varian</h4>
        <p class="text-muted">Perbarui kombinasi ukuran & warna</p>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.produk-varian.update', $varian->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- LEFT -->
                    <div class="col-lg-6">

                        <!-- PRODUK -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Produk</label>

                            <select name="produk_id"
                                    class="form-select rounded-4"
                                    required>

                                @foreach($produk as $p)
                                    <option value="{{ $p->id }}"
                                        {{ $varian->produk_id == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama }} ({{ $p->kode }})
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- UKURAN -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Ukuran</label>

                            <select name="ukuran_id"
                                    class="form-select rounded-4"
                                    required>

                                @foreach($ukuran as $u)
                                    <option value="{{ $u->id }}"
                                        {{ $varian->ukuran_id == $u->id ? 'selected' : '' }}>
                                        {{ $u->nama }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- WARNA -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Warna</label>

                            <select name="warna_id"
                                    class="form-select rounded-4"
                                    required>

                                @foreach($warna as $w)
                                    <option value="{{ $w->id }}"
                                        {{ $varian->warna_id == $w->id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-lg-6">

                        <!-- STOK -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Stok</label>

                            <input type="number"
                                   name="stok"
                                   class="form-control rounded-4"
                                   value="{{ $varian->stok }}"
                                   min="0"
                                   required>

                        </div>

                        <!-- HARGA -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Harga (Opsional)</label>

                            <input type="number"
                                   name="harga"
                                   class="form-control rounded-4"
                                   value="{{ $varian->harga }}">

                        </div>

                        <!-- PREVIEW -->
                        <div class="border rounded-4 p-3 bg-light text-center">

                            <h6 class="text-muted">Preview Varian</h6>

                            <h5 id="previewText">
                                {{ $varian->produk->nama ?? '-' }}
                                -
                                {{ $varian->ukuran->nama ?? '-' }}
                                -
                                {{ $varian->warna->nama ?? '-' }}
                            </h5>

                        </div>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2 mt-4">

                    <button type="submit"
                            class="btn btn-warning rounded-pill w-50">

                        Update Varian

                    </button>

                    <a href="{{ route('admin.produk-varian.index') }}"
                       class="btn btn-secondary rounded-pill w-50">

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection