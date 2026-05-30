@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">Produk Varian</h4>
            <p class="text-muted mb-0">Kelola varian ukuran & warna produk</p>
        </div>

        <a href="{{ route('admin.produk-varian.create') }}"
           class="btn btn-warning rounded-pill">

            <i class="fa fa-plus"></i> Tambah Varian

        </a>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Ukuran</th>
                            <th>Warna</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($varian as $item)

                        <tr>

                            <!-- NO -->
                            <td>{{ $loop->iteration }}</td>

                            <!-- PRODUK -->
                            <td>
                                <span class="fw-semibold">
                                    {{ $item->produk->nama ?? '-' }}
                                </span>
                                <br>
                                <small class="text-muted">
                                    {{ $item->produk->kode ?? '-' }}
                                </small>
                            </td>

                            <!-- UKURAN -->
                            <td>
                                <span class="badge bg-primary">
                                    {{ $item->ukuran->nama ?? '-' }}
                                </span>
                            </td>

                            <!-- WARNA -->
                            <td>
                                <span class="badge bg-dark">
                                    {{ $item->warna->nama ?? '-' }}
                                </span>
                            </td>

                            <!-- STOK -->
                            <td>
                                @if($item->stok > 10)
                                    <span class="badge bg-success">
                                        {{ $item->stok }}
                                    </span>
                                @elseif($item->stok > 0)
                                    <span class="badge bg-warning text-dark">
                                        {{ $item->stok }}
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Habis
                                    </span>
                                @endif
                            </td>

                            <!-- HARGA -->
                            <td>
                                Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                            </td>

                            <!-- AKSI -->
                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <!-- EDIT -->
                                    <a href="{{ route('admin.produk-varian.edit', $item->id) }}"
                                       class="btn btn-sm btn-outline-primary rounded-circle">

                                        <i class="fa fa-edit"></i>

                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('admin.produk-varian.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline delete-form">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-circle btn-delete">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7">

                                <div class="text-center py-5">

                                    <i class="fa fa-layer-group fa-3x text-muted mb-3"></i>

                                    <h5 class="text-muted">
                                        Belum ada varian produk
                                    </h5>

                                    <p class="text-muted">
                                        Silakan tambahkan ukuran & warna produk
                                    </p>

                                </div>

                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- DELETE CONFIRM -->
<script>
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function () {

        let form = this.closest('.delete-form');

        Swal.fire({
            title: 'Hapus varian ini?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f59e0b',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });
});
</script>

@endsection