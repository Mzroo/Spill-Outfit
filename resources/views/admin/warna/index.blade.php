@extends('layouts.admin')

@section('title', 'Data Warna')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Data Warna
            </h4>

            <p class="text-muted mb-0">
                Kelola warna produk outfit
            </p>
        </div>

        <a href="{{ route('admin.warna.create') }}"
           class="btn btn-warning rounded-pill px-4">

            <i class="fa-solid fa-plus me-2"></i>
            Tambah Warna

        </a>

    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert alert-success rounded-4 border-0 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead class="table-light">

                        <tr>
                            <th width="80">No</th>
                            <th>Warna</th>
                            <th>Kode Warna</th>
                            <th>Status</th>
                            <th width="180" class="text-center">
                                Aksi
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($warna as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <!-- Preview warna -->
                                        <div
                                            style="
                                                width:35px;
                                                height:35px;
                                                border-radius:50%;
                                                background:{{ $item->kode_warna }};
                                                border:2px solid #eee;
                                            ">
                                        </div>

                                        <span class="fw-semibold">
                                            {{ $item->nama }}
                                        </span>

                                    </div>

                                </td>

                                <td>

                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        {{ $item->kode_warna ?? '-' }}
                                    </span>

                                </td>

                                <td>

                                    @if($item->status == 'aktif')

                                        <span class="badge bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Nonaktif
                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    <!-- EDIT -->
                                    <a href="{{ route('admin.warna.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning rounded-pill">

                                        <i class="fa-solid fa-pen-to-square"></i>

                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('admin.warna.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger rounded-pill"
                                            onclick="return confirm('Yakin hapus warna ini?')">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center text-muted py-5">

                                    Belum ada data warna

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