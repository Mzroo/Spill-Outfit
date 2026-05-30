@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="text-center mb-4">

        <h4 class="fw-bold">Tambah Produk Varian</h4>
        <p class="text-muted">Tambahkan kombinasi ukuran & warna produk</p>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.produk-varian.store') }}"
                  method="POST">

                @csrf

                <div class="row g-4">

                    <!-- LEFT -->
                    <div class="col-lg-6">

                        <!-- PRODUK -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Produk</label>

                            <select name="produk_id"
                                    class="form-select rounded-4"
                                    required>

                                <option value="">-- Pilih Produk --</option>

                                @foreach($produk as $p)
                                    <option value="{{ $p->id }}">
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

                                <option value="">-- Pilih Ukuran --</option>

                                @foreach($ukuran as $u)
                                    <option value="{{ $u->id }}">
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

                                <option value="">-- Pilih Warna --</option>

                                @foreach($warna as $w)
                                    <option value="{{ $w->id }}">
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

                            <label class="form-label fw-semibold">Stok Varian</label>

                            <input type="number"
                                   name="stok"
                                   class="form-control rounded-4"
                                   min="0"
                                   value="0"
                                   required>

                        </div>

                        <!-- HARGA (optional override) -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Harga (Opsional)
                            </label>

                            <input type="number"
                                   name="harga"
                                   class="form-control rounded-4"
                                   placeholder="Kosongkan jika pakai harga produk">

                        </div>

                        <!-- PREVIEW -->
                        <div class="border rounded-4 p-3 bg-light text-center">

                            <h6 class="text-muted">Preview Varian</h6>

                            <h5 id="previewText">-</h5>

                            <small class="text-muted">
                                Produk + Ukuran + Warna
                            </small>

                        </div>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2 mt-4">

                    <button type="submit"
                            class="btn btn-warning rounded-pill w-50">

                        Simpan Varian

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

<!-- JS PREVIEW -->
<script>

const produk = document.querySelector('select[name="produk_id"]');
const ukuran = document.querySelector('select[name="ukuran_id"]');
const warna  = document.querySelector('select[name="warna_id"]');

const preview = document.getElementById('previewText');

function updatePreview() {

    const p = produk.options[produk.selectedIndex]?.text || '';
    const u = ukuran.options[ukuran.selectedIndex]?.text || '';
    const w = warna.options[warna.selectedIndex]?.text || '';

    if (p || u || w) {
        preview.innerText = `${p} - ${u} - ${w}`;
    } else {
        preview.innerText = '-';
    }
}

produk.addEventListener('change', updatePreview);
ukuran.addEventListener('change', updatePreview);
warna.addEventListener('change', updatePreview);

</script>

@endsection