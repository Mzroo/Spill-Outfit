@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Manajemen Brand
            </h4>

            <p class="text-muted mb-0">
                Kelola data brand / merek produk outfit
            </p>
        </div>

        <a
            href="{{ route('admin.brand.create') }}"
            class="btn btn-warning rounded-pill px-4"
        >
            <i class="fa-solid fa-plus me-2"></i>
            Tambah Brand
        </a>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead>
                        <tr>

                            <th width="70">
                                No
                            </th>

                            <th>
                                Logo
                            </th>

                            <th>
                                Nama Brand
                            </th>

                            <th>
                                Slug
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="170" class="text-center">
                                Aksi
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse($brands as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <!-- LOGO -->
                            <td>

                                @if($item->logo)

                                    <img
                                        src="{{ asset('storage/' . $item->logo) }}"
                                        alt="{{ $item->nama }}"
                                        class="brand-logo"
                                    >

                                @else

                                    <div class="brand-empty">

                                        <i class="fa-solid fa-image"></i>

                                    </div>

                                @endif

                            </td>

                            <!-- NAMA -->
                            <td>

                                <div class="fw-semibold">
                                    {{ $item->nama }}
                                </div>

                            </td>

                            <!-- SLUG -->
                            <td class="text-muted">

                                {{ $item->slug }}

                            </td>

                            <!-- STATUS -->
                            <td>

                                @if($item->status == 'aktif')

                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        Aktif
                                    </span>

                                @else

                                    <span class="badge bg-secondary rounded-pill px-3 py-2">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>

                            <!-- AKSI -->
                            <td class="text-center">

                                <a
                                    href="{{ route('admin.brand.edit', $item->id) }}"
                                    class="btn btn-sm btn-warning rounded-circle"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form
                                    action="{{ route('admin.brand.destroy', $item->id) }}"
                                    method="POST"
                                    class="d-inline delete-form"
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

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center py-5 text-muted">

                                <i class="fa-solid fa-box-open fa-2x mb-3"></i>

                                <div>
                                    Belum ada data brand
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

<style>

/* TABLE HEADER */

.table thead th{

    border: none;

    color: #777;

    font-size: 14px;

    font-weight: 600;

}

/* TABLE BODY */

.table tbody td{

    vertical-align: middle;

    border-color: #f2f2f2;

}

/* BRAND LOGO */

.brand-logo{

    width: 60px;
    height: 60px;

    object-fit: cover;

    border-radius: 16px;

    border: 1px solid #eee;

}

/* EMPTY IMAGE */

.brand-empty{

    width: 60px;
    height: 60px;

    border-radius: 16px;

    background: #f8f8f8;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #bbb;

    border: 1px dashed #ddd;

}

/* BUTTON */

.btn-warning{

    background: #B68D40;
    border: none;

}

.btn-warning:hover{

    background: #9f7b35;

}

</style>

@endsection