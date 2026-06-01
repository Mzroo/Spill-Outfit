@extends('layouts.user')

@section('title', 'Buat Postingan')

@section('content')

<section class="community-create-section">

    <!-- HEADER -->
    <div class="create-header">

        <a
            href="{{ route('community.index') }}"
            class="back-btn"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>

        <h2>
            Buat Postingan Community ✨
        </h2>

        <p>
            Bagikan outfit, style, atau inspirasi fashion kamu.
        </p>

    </div>

    <!-- CARD -->
    <div class="create-card">

        <form
            action="{{ route('community.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <!-- FOTO PREVIEW -->
            <div class="preview-wrapper">

                <img
                    id="previewImage"
                    src="https://placehold.co/800x500?text=Preview+Foto"
                >

            </div>

            <!-- UPLOAD -->
            <label class="upload-btn">

                <i class="fa-solid fa-image"></i>
                Upload Foto

                <input
                    type="file"
                    name="gambar"
                    id="gambarInput"
                    hidden
                >

            </label>

            <!-- JUDUL -->
            <div class="input-group">

                <label>
                    Judul (Opsional)
                </label>

                <input
                    type="text"
                    name="judul"
                    placeholder="Contoh: Outfit Nongkrong Hari Ini"
                >

            </div>

            <!-- CAPTION -->
            <div class="input-group">

                <label>
                    Caption
                </label>

                <textarea
                    name="caption"
                    placeholder="Bagikan cerita outfit kamu..."
                    required
                ></textarea>

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="submit-btn"
            >

                <i class="fa-solid fa-paper-plane"></i>

                Posting Sekarang

            </button>

        </form>

    </div>

</section>

<style>

.community-create-section{
    max-width:900px;
    margin:auto;
}

/* HEADER */

.create-header{
    margin-bottom:30px;
}

.back-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    text-decoration:none;
    color:#8C6A2F;
    font-weight:700;
    margin-bottom:20px;
}

.create-header h2{
    font-size:48px;
    font-weight:800;
    color:#2d2d2d;
    margin-bottom:10px;
}

.create-header p{
    color:#777;
    line-height:1.8;
}

/* CARD */

.create-card{
    background:white;
    border-radius:35px;
    padding:35px;
    box-shadow:
    0 10px 35px rgba(0,0,0,.06);
}

/* PREVIEW */

.preview-wrapper{
    margin-bottom:20px;
}

.preview-wrapper img{
    width:100%;
    height:420px;
    border-radius:28px;
    object-fit:cover;
    background:#f5f5f5;
}

/* BUTTON */

.upload-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    cursor:pointer;
    margin-bottom:25px;

    padding:14px 22px;

    border-radius:999px;

    background:#f3e8cf;
    color:#8C6A2F;
    font-weight:700;
}

/* INPUT */

.input-group{
    margin-bottom:25px;
}

.input-group label{
    display:block;
    margin-bottom:12px;
    font-weight:700;
    color:#444;
}

.input-group input,
.input-group textarea{
    width:100%;
    border:none;
    outline:none;
    background:#f8f5ed;
    border-radius:20px;
    padding:18px 22px;
}

.input-group textarea{
    resize:none;
    height:180px;
}

/* SUBMIT */

.submit-btn{
    border:none;
    cursor:pointer;

    display:flex;
    align-items:center;
    gap:12px;

    padding:16px 30px;

    border-radius:999px;

    color:white;
    font-weight:700;

    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );

    transition:.3s;
}

.submit-btn:hover{
    transform:translateY(-2px);
}

/* MOBILE */

@media(max-width:768px){

    .create-header h2{
        font-size:38px;
    }

    .create-card{
        padding:25px;
    }

    .preview-wrapper img{
        height:260px;
    }

}

</style>

<script>

const gambarInput =
document.getElementById(
    'gambarInput'
);

gambarInput.addEventListener(
    'change',
    function(e){

        const file =
        e.target.files[0];

        if(file){

            document.getElementById(
                'previewImage'
            ).src =
            URL.createObjectURL(file);
        }
    }
);

</script>

@endsection