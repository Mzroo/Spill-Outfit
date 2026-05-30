@extends('layouts.user')

@section('title', 'Settings')

@section('content')

<section class="settings-section">

    <!-- HEADER -->
    <div class="settings-header">

        <span>
            ACCOUNT SETTINGS
        </span>

        <h2>
            Kelola Profile Kamu ⚙️
        </h2>

        <p>
            Lengkapi profile agar checkout lebih cepat
            dan alamat pengiriman otomatis terisi.
        </p>

    </div>

    <!-- ALERT -->
    @if(session('success'))

    <div class="alert-success-custom">

        <i class="mdi mdi-check-circle"></i>

        {{ session('success') }}

    </div>

    @endif

    <!-- CARD -->
    <div class="settings-card">

        <form action="{{ route('settings.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- FOTO PROFILE -->
            <div class="profile-area">

                <div class="profile-preview">
                    @if(auth()->user()->profile?->foto)

                        <img
                            id="previewImage"
                            src="{{ asset('storage/' . auth()->user()->profile->foto) }}"
                        >

                    @else

                        <img
                            id="previewImage"
                            src="https://i.pravatar.cc/300"
                        >

                    @endif

                </div>

                <label class="upload-btn">

                    <i class="mdi mdi-camera"></i>
                    Ganti Foto

                    <input
                        type="file"
                        name="foto"
                        id="fotoInput"
                        hidden
                    >

                </label>

            </div>

            <!-- FORM -->
            <div class="form-grid">

                <!-- NAMA -->
                <div class="input-group-custom">

                    <label>
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="nama_penerima"
                        value="{{ auth()->user()->profile?->nama_penerima }}"
                        placeholder="Masukkan nama lengkap"
                    >

                </div>

                <!-- NO HP -->
                <div class="input-group-custom">

                    <label>
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        value="{{ auth()->user()->profile?->no_hp }}"
                        placeholder="08xxxxxxxxxx"
                    >

                </div>

                <!-- PROVINSI -->
                <div class="input-group-custom">

                    <label>
                        Provinsi
                    </label>

                    <input
                        type="text"
                        name="provinsi"
                        value="{{ auth()->user()->profile?->provinsi }}"
                        placeholder="Contoh: Jawa Barat"
                    >

                </div>

                <!-- KOTA -->
                <div class="input-group-custom">

                    <label>
                        Kota / Kabupaten
                    </label>

                    <input
                        type="text"
                        name="kota"
                        value="{{ auth()->user()->profile?->kota }}"
                        placeholder="Masukkan kota"
                    >

                </div>

                <!-- KODE POS -->
                <div class="input-group-custom">

                    <label>
                        Kode Pos
                    </label>

                    <input
                        type="text"
                        name="kode_pos"
                        value="{{ auth()->user()->profile?->kode_pos }}"
                        placeholder="Masukkan kode pos"
                    >

                </div>

            </div>

            <!-- ALAMAT -->
            <div class="input-group-custom">

                <label>
                    Alamat Lengkap
                </label>

                <textarea
                    name="alamat"
                    placeholder="Masukkan alamat lengkap"
                >{{ auth()->user()->profile?->alamat }}</textarea>

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="save-btn"
            >

                <i class="mdi mdi-content-save"></i>

                Simpan Perubahan

            </button>

        </form>

    </div>

</section>

<style>

/* SECTION */

.settings-section{
    max-width:1000px;
    margin:auto;
}

/* HEADER */

.settings-header{
    margin-bottom:40px;
}

.settings-header span{
    display:inline-block;
    padding:10px 20px;
    border-radius:999px;
    background:#efe4c8;
    color:#8C6A2F;
    font-size:13px;
    font-weight:700;
}

.settings-header h2{
    font-size:50px;
    font-weight:800;
    color:#2d2d2d;
    margin:18px 0 10px;
}

.settings-header p{
    color:#777;
    line-height:1.9;
}

/* ALERT */

.alert-success-custom{
    background:#d8f3df;
    color:#1d6b3c;
    padding:18px 22px;
    border-radius:20px;
    margin-bottom:25px;
    display:flex;
    align-items:center;
    gap:10px;
}

/* CARD */

.settings-card{
    background:white;
    border-radius:35px;
    padding:45px;
    box-shadow:
    0 10px 35px rgba(0,0,0,.08);
}

/* PROFILE */

.profile-area{
    display:flex;
    flex-direction:column;
    align-items:center;
    margin-bottom:40px;
}

.profile-preview img{
    width:160px;
    height:160px;
    border-radius:50%;
    object-fit:cover;
    border:6px solid #f5efe2;
    box-shadow:
    0 10px 30px rgba(0,0,0,.08);
}

.upload-btn{
    margin-top:18px;
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
    padding:14px 26px;
    border-radius:999px;
    cursor:pointer;
    font-weight:600;
}

/* GRID */

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:22px;
}

/* INPUT */

.input-group-custom{
    margin-bottom:22px;
}

.input-group-custom label{
    display:block;
    margin-bottom:10px;
    font-weight:700;
    color:#444;
}

.input-group-custom input,
.input-group-custom textarea{
    width:100%;
    border:none;
    outline:none;
    background:#f8f5ed;
    border:2px solid transparent;
    border-radius:20px;
    padding:18px 22px;
    transition:.3s;
}

.input-group-custom input:focus,
.input-group-custom textarea:focus{
    border-color:#C9A227;
}

.input-group-custom textarea{
    resize:none;
    height:150px;
}

/* BUTTON */

.save-btn{
    border:none;
    background:
    linear-gradient(
        135deg,
        #8C6A2F,
        #C9A227
    );
    color:white;
    padding:16px 30px;
    border-radius:999px;
    font-weight:700;
    display:flex;
    align-items:center;
    gap:10px;
    transition:.3s;
}

.save-btn:hover{
    transform:translateY(-2px);
}

/* MOBILE */

@media(max-width:768px){

    .form-grid{
        grid-template-columns:1fr;
    }

    .settings-card{
        padding:25px;
    }

    .settings-header h2{
        font-size:38px;
    }
}

</style>

<script>

const fotoInput =
document.getElementById('fotoInput');

fotoInput.addEventListener(
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