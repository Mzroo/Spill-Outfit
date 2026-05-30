@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Manajemen Ukuran
            </h4>

            <p class="text-muted mb-0">
                Kelola ukuran produk outfit
            </p>
        </div>

        <a
            href="{{ route('admin.ukuran.create') }}"
            class="btn btn-warning rounded-pill px-4"
        >
            <i class="fa-solid fa-plus me-2"></i>
            Tambah Ukuran
        </a>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead class="table-light">
                        <tr>
                            <th width="60">
                                No
                            </th>

                            <th>
                                Nama Ukuran
                            </th>

                            <th>
                                Kode
                            </th>

                            <th>
                                Keterangan
                            </th>

                            <th>
                                Urutan
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="150" class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($ukuran as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td class="fw-semibold">
                                {{ $item->nama }}
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $item->kode }}
                                </span>
                            </td>

                            <td>
                                {{ $item->keterangan ?? '-' }}
                            </td>

                            <td>
                                {{ $item->urutan }}
                            </td>

                            <td>

                                @if($item->status == 'aktif')
                                    <span class="badge bg-success">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Nonaktif
                                    </span>
                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-2 justify-content-center">

                                    <!-- EDIT -->
                                    <a
                                        href="{{ route('admin.ukuran.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning rounded-circle"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <form
                                        action="{{ route('admin.ukuran.destroy', $item->id) }}"
                                        method="POST"
                                        class="delete-form"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger rounded-circle btn-delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center py-5 text-muted">

                                <i class="fa-solid fa-box-open fs-2 mb-2"></i>

                                <p class="mb-0">
                                    Belum ada data ukuran
                                </p>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection