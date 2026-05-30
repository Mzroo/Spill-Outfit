@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')

<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4">

        <div>
            <h3 class="page-title">
                Manajemen Kategori
            </h3>

            <p class="page-subtitle">
                Kelola kategori produk Spill Outfit
            </p>
        </div>

        <a
            href="{{ route('admin.kategori.create') }}"
            class="btn-add"
        >
            <i class="fa-solid fa-plus"></i>
            Tambah Kategori
        </a>

    </div>

    <!-- CARD -->
    <div class="custom-card">

        <div class="table-responsive">

            <table class="table custom-table align-middle">

                <thead>
                    <tr>
                        <th width="80">
                            No
                        </th>

                        <th>
                            Gambar
                        </th>

                        <th>
                            Nama Kategori
                        </th>

                        <th>
                            Slug
                        </th>

                        <th width="180">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($kategori as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <!-- GAMBAR -->
                        <td>

                            @if($item->gambar)

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    class="kategori-image"
                                    alt="{{ $item->nama }}"
                                >

                            @else

                                <div class="empty-image">

                                    <i class="fa-solid fa-image"></i>

                                </div>

                            @endif

                        </td>

                        <!-- NAMA -->
                        <td>

                            <h6 class="kategori-name">
                                {{ $item->nama }}
                            </h6>

                        </td>

                        <!-- SLUG -->
                        <td>

                            <span class="slug-badge">

                                {{ $item->slug }}

                            </span>

                        </td>

                        <!-- AKSI -->
                        <td>

                            <div class="action-buttons">

                                <!-- EDIT -->
                                <a
                                    href="{{ route('admin.kategori.edit', $item->id) }}"
                                    class="btn-edit"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <!-- DELETE -->
                                <form
                                    action="{{ route('admin.kategori.destroy', $item->id) }}"
                                    method="POST"
                                    class="delete-form"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="button"
                                        class="btn-delete"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5">

                            <div class="empty-state">

                                <i class="fa-solid fa-box-open"></i>

                                <h5>
                                    Belum Ada Kategori
                                </h5>

                                <p>
                                    Tambahkan kategori produk terlebih dahulu
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

<style>

/* ================= PAGE HEADER ================= */

.page-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:20px;

}

.page-title{

    font-size:30px;
    font-weight:700;
    color:#222;
    margin:0;

}

.page-subtitle{

    margin:0;
    color:#888;
}

/* ================= BUTTON ADD ================= */

.btn-add{

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    color:white;

    text-decoration:none;

    padding:14px 22px;

    border-radius:18px;

    display:flex;
    align-items:center;
    gap:10px;

    font-weight:600;

    transition:.3s ease;

}

.btn-add:hover{

    transform:translateY(-2px);

    color:white;

    box-shadow:
    0 8px 20px rgba(182,141,64,.2);

}

/* ================= CARD ================= */

.custom-card{

    background:white;

    border-radius:30px;

    padding:25px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.05);

}

/* ================= TABLE ================= */

.custom-table{

    margin:0;

}

.custom-table thead tr{

    border-bottom:2px solid #f5efe2;

}

.custom-table thead th{

    border:none;

    color:#666;

    font-weight:600;

    padding:20px;

}

.custom-table tbody td{

    padding:22px 20px;

    border:none;

    vertical-align:middle;

}

.custom-table tbody tr{

    border-bottom:1px solid #f5f5f5;

}

.custom-table tbody tr:hover{

    background:#faf6ef;

}

/* ================= IMAGE ================= */

.kategori-image{

    width:70px;
    height:70px;

    border-radius:18px;

    object-fit:cover;

}

.empty-image{

    width:70px;
    height:70px;

    border-radius:18px;

    background:#faf6ef;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#B68D40;
}

/* ================= NAME ================= */

.kategori-name{

    margin:0;

    font-weight:700;

    color:#222;

}

/* ================= SLUG ================= */

.slug-badge{

    background:#faf6ef;

    color:#8C6A2F;

    padding:10px 16px;

    border-radius:50px;

    font-size:13px;

}

/* ================= ACTION ================= */

.action-buttons{

    display:flex;
    align-items:center;
    gap:10px;

}

.btn-edit,
.btn-delete{

    width:48px;
    height:48px;

    border:none;

    border-radius:16px;

    display:flex;
    align-items:center;
    justify-content:center;

    transition:.3s ease;

}

.btn-edit{

    background:#faf6ef;

    color:#B68D40;

}

.btn-delete{

    background:#fff3f3;

    color:#e74c3c;

}

.btn-edit:hover{

    background:#B68D40;
    color:white;

}

.btn-delete:hover{

    background:#e74c3c;
    color:white;

}

/* ================= EMPTY ================= */

.empty-state{

    padding:80px 20px;

    text-align:center;

}

.empty-state i{

    font-size:65px;

    color:#B68D40;

    margin-bottom:20px;

}

.empty-state h5{

    font-weight:700;
}

.empty-state p{

    color:#888;
}

/* ================= MOBILE ================= */

@media(max-width:768px){

    .page-header{

        flex-direction:column;
        align-items:flex-start;

    }

}

</style>

@endsection