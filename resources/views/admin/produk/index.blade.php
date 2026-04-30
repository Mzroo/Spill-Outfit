@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Manajemen Produk</h4>

        <a href="{{ route('produk.create') }}" class="btn btn-warning">
            <i class="fa fa-plus"></i> Tambah Produk
        </a>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($produk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <!-- KODE -->
                            <td>
                                <span class="badge bg-dark">{{ $item->kode }}</span>
                            </td>

                            <!-- GAMBAR -->
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}"
                                         width="60" class="rounded border">
                                @else
                                    <img src="https://via.placeholder.com/60?text=No+Image"
                                         width="60" class="rounded border">
                                @endif
                            </td>

                            <!-- NAMA -->
                            <td>{{ $item->nama }}</td>

                            <!-- KATEGORI -->
                            <td>{{ optional($item->kategori)->nama ?? '-' }}</td>

                            <!-- HARGA -->
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>

                            <!-- STOK -->
                            <td>
                                @if($item->stok > 10)
                                    <span class="badge bg-success">{{ $item->stok }}</span>
                                @elseif($item->stok > 0)
                                    <span class="badge bg-warning text-dark">{{ $item->stok }}</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>

                            <!-- STATUS -->
                            <td>
                                @if($item->status == 'public')
                                    <span class="badge bg-success">Tampil</span>
                                @else
                                    <span class="badge bg-secondary">Disembunyikan</span>
                                @endif
                            </td>

                            <!-- AKSI -->
                            <td>

                                <!-- TAMBAH GAMBAR -->
                                <a href="#" class="btn btn-sm btn-secondary" title="Tambah Gambar">
                                    <i class="fa fa-image"></i>
                                </a>

                                <!-- EDIT -->
                                <a href="{{ route('produk.edit', $item->id) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('produk.destroy', $item->id) }}" 
                                      method="POST" 
                                      class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" 
                                            class="btn btn-sm btn-danger btn-delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                Belum ada produk
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<!-- SWEETALERT DELETE -->
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            let form = this.closest('.delete-form');

            Swal.fire({
                title: 'Yakin hapus?',
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