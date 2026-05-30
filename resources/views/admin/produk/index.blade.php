@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">Manajemen Produk</h4>
            <p class="text-muted mb-0">Kelola semua produk outfit</p>
        </div>

        <a href="{{ route('admin.produk.create') }}"
           class="btn btn-warning rounded-pill">

            <i class="fa fa-plus"></i> Tambah Produk

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
                            <th>Kode</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Brand</th>
                            <th>Harga</th>
                            <th>Total Stok</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($produk as $item)

                        <tr>

                            <!-- NO -->
                            <td>{{ $loop->iteration }}</td>

                            <!-- KODE -->
                            <td>
                                <span class="badge bg-dark">
                                    {{ $item->kode }}
                                </span>
                            </td>

                            <!-- GAMBAR -->
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}"
                                         width="60"
                                         height="60"
                                         class="rounded border object-fit-cover">
                                @else
                                    <img src="https://via.placeholder.com/60"
                                         width="60"
                                         height="60"
                                         class="rounded border">
                                @endif
                            </td>

                            <!-- NAMA -->
                            <td class="fw-semibold">
                                {{ $item->nama }}
                            </td>

                            <!-- KATEGORI -->
                            <td>
                                {{ optional($item->kategori)->nama ?? '-' }}
                            </td>

                            <!-- BRAND -->
                            <td>
                                {{ optional($item->brand)->nama ?? '-' }}
                            </td>

                            <!-- HARGA -->
                            <td>
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>

                            <!-- TOTAL STOK (DARI VARIAN) -->
                            <td>

                                @php
                                    $stok = $item->total_stok ?? 0;
                                @endphp

                                @if($stok > 10)
                                    <span class="badge bg-success">{{ $stok }}</span>

                                @elseif($stok > 0)
                                    <span class="badge bg-warning text-dark">{{ $stok }}</span>

                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif

                            </td>

                            <!-- STATUS -->
                            <td>
                                @if($item->status == 'public')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>

                            <!-- AKSI -->
                            <td class="text-center align-middle">

                                <div class="d-flex justify-content-center gap-2">

                                    <!-- GAMBAR -->
                                    <a href="{{ route('admin.produk.gambar', $item->id) }}"
                                       class="btn btn-sm btn-outline-secondary rounded-circle"
                                       title="Gambar">

                                        <i class="fa fa-image"></i>

                                    </a>

                                    <!-- EDIT -->
                                    <a href="{{ route('admin.produk.edit', $item->id) }}"
                                       class="btn btn-sm btn-outline-primary rounded-circle"
                                       title="Edit">

                                        <i class="fa fa-edit"></i>

                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('admin.produk.destroy', $item->id) }}"
                                          method="POST"
                                          class="delete-form">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger rounded-circle btn-delete"
                                                title="Hapus">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="10">

                                <div class="text-center py-5">

                                    <div class="mb-3">
                                        <i class="fa fa-box-open fa-3x text-muted"></i>
                                    </div>

                                    <h5 class="text-muted">
                                        Belum ada produk
                                    </h5>

                                    <p class="text-muted">
                                        Silakan tambahkan produk terlebih dahulu
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
            title: 'Yakin hapus produk?',
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