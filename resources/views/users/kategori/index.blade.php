@extends('layouts.user')

@section('title', 'Kategori')

@section('content')

<section class="kategori-section">

    <!-- HEADER -->

    <div class="kategori-header">

        <span>
            SPILL OUTFIT CATEGORY
        </span>

        <h2>
            Pilih Style <br>
            Favoritmu ✨
        </h2>

        <p>
            Temukan kategori fashion terbaik sesuai gaya dan aktivitasmu.
        </p>

    </div>

    <!-- GRID -->

    <div class="row g-4">

        @foreach($kategori as $item)

        <div class="col-xl-3 col-lg-4 col-md-6">

            <a href="{{ route('user.kategori.show', $item->id) }}"
               class="kategori-card">

                <!-- ICON -->

                <div class="kategori-icon">

                    <i class="mdi mdi-hanger"></i>

                </div>

                <!-- NAMA -->

                <h4>
                    {{ $item->nama }}
                </h4>

                <!-- TOTAL -->

                <p>

                    {{ $item->produk->count() }}

                    Produk

                </p>

                <!-- ARROW -->

                <div class="arrow-icon">

                    <i class="mdi mdi-arrow-top-right"></i>

                </div>

            </a>

        </div>

        @endforeach

    </div>

</section>

<style>

/* ================= SECTION ================= */

.kategori-section{
    padding:10px;
}

/* ================= HEADER ================= */

.kategori-header{
    margin-bottom:50px;
}

.kategori-header span{
    display:inline-block;

    padding:8px 18px;

    border-radius:50px;

    background:#e9efe0;

    color:#556B2F;

    font-size:13px;
    font-weight:600;

    margin-bottom:20px;
}

.kategori-header h2{
    font-size:52px;
    font-weight:700;

    color:#222;

    line-height:1.2;

    margin-bottom:15px;
}

.kategori-header p{
    max-width:600px;

    color:#777;

    line-height:1.8;
}

/* ================= CARD ================= */

.kategori-card{
    background:white;

    border-radius:30px;

    padding:35px;

    display:block;

    position:relative;

    overflow:hidden;

    transition:0.4s;

    color:#222;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.06);
}

.kategori-card:hover{
    transform:translateY(-10px);

    color:white;

    background:
    linear-gradient(
        135deg,
        #313E17,
        #556B2F
    );
}

/* ICON */

.kategori-icon{
    width:75px;
    height:75px;

    border-radius:25px;

    background:#f5f7fb;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:35px;

    margin-bottom:25px;

    transition:0.4s;
}

.kategori-card:hover .kategori-icon{
    background:rgba(255,255,255,0.15);
}

/* TEXT */

.kategori-card h4{
    font-size:28px;
    font-weight:700;

    margin-bottom:10px;
}

.kategori-card p{
    color:#888;

    transition:0.4s;
}

.kategori-card:hover p{
    color:#ddd;
}

/* ARROW */

.arrow-icon{
    position:absolute;
    right:25px;
    bottom:25px;

    width:50px;
    height:50px;

    border-radius:50%;

    background:#f5f7fb;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:24px;

    transition:0.4s;
}

.kategori-card:hover .arrow-icon{
    background:white;
    color:#313E17;

    transform:rotate(45deg);
}

/* RESPONSIVE */

@media(max-width:768px){

    .kategori-header h2{
        font-size:38px;
    }

}

</style>

@endsection