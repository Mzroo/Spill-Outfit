@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Manajemen Kategori</h4>
            <p class="text-muted mb-0">Kelola kategori produk toko outfit</p>
        </div>

          <a href="{{ route('kategori.create') }}" class="btn btn-warning">
            <i class="fa fa-plus"></i> Tambah kategori
        </a>
    </div>

    <!-- CARD -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($kategori as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $item->nama }}</td>
                            <td class="text-muted">{{ $item->slug }}</td>
                            <td>

                                <!-- EDIT -->
                                <a href="{{ route('kategori.edit', $item->id) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('kategori.destroy', $item->id) }}" 
                                    method="POST" 
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-sm btn-danger btn-delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Belum ada kategori
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