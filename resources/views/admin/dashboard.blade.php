@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid dashboard-content">

    <!-- ================= WELCOME ================= -->
    <div class="welcome-card">

        <div>

            <h3>
                Selamat Datang,
                {{ auth()->user()->name ?? 'Admin' }} 👋
            </h3>

            <p>
                Kelola produk, pesanan, dan customer
                dengan mudah di dashboard admin
                Spill Outfit.
            </p>

        </div>

        <div class="welcome-icon">

            <i class="fa-solid fa-shirt"></i>

        </div>

    </div>

    <!-- ================= STATISTIC ================= -->
    <div class="row g-4 mb-4">

        <!-- TOTAL PRODUK -->
        <div class="col-lg-3 col-md-6">

            <div class="dashboard-card">

                <div>

                    <span>Total Produk</span>

                    <h3>50</h3>

                </div>

                <div class="card-icon bg-primary">

                    <i class="fa-solid fa-shirt"></i>

                </div>

            </div>

        </div>

        <!-- TOTAL PESANAN -->
        <div class="col-lg-3 col-md-6">

            <div class="dashboard-card">

                <div>

                    <span>Total Pesanan</span>

                    <h3>120</h3>

                </div>

                <div class="card-icon bg-success">

                    <i class="fa-solid fa-cart-shopping"></i>

                </div>

            </div>

        </div>

        <!-- PENDAPATAN -->
        <div class="col-lg-3 col-md-6">

            <div class="dashboard-card">

                <div>

                    <span>Pendapatan</span>

                    <h3>Rp 5JT</h3>

                </div>

                <div class="card-icon bg-warning">

                    <i class="fa-solid fa-wallet"></i>

                </div>

            </div>

        </div>

        <!-- CUSTOMER -->
        <div class="col-lg-3 col-md-6">

            <div class="dashboard-card">

                <div>

                    <span>Total Customer</span>

                    <h3>75</h3>

                </div>

                <div class="card-icon bg-danger">

                    <i class="fa-solid fa-users"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- ================= TABLE ================= -->
    <div class="table-card">

        <div class="table-header">

            <h4>
                Pesanan Terbaru
            </h4>

        </div>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>#INV001</td>
                        <td>Adriansyah</td>
                        <td>Rp250.000</td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>#INV002</td>
                        <td>Rizky</td>
                        <td>Rp300.000</td>
                        <td>
                            <span class="badge bg-success">
                                Selesai
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>#INV003</td>
                        <td>Budi</td>
                        <td>Rp180.000</td>
                        <td>
                            <span class="badge bg-danger">
                                Dibatalkan
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<style>

/* ================= CONTENT ================= */

.dashboard-content{

    padding-top: 20px;

}

/* ================= WELCOME ================= */

.welcome-card{

    background:
    linear-gradient(
        135deg,
        #B68D40,
        #d9b25f
    );

    border-radius: 30px;

    padding: 35px;

    color: white;

    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 30px;

    box-shadow:
    0 10px 30px rgba(182,141,64,.20);

}

.welcome-card h3{

    font-size: 30px;
    font-weight: 700;

    margin-bottom: 10px;

}

.welcome-card p{

    margin: 0;

    opacity: .9;

    max-width: 500px;

}

.welcome-icon{

    width: 110px;
    height: 110px;

    background:
    rgba(255,255,255,.2);

    border-radius: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

}

.welcome-icon i{

    font-size: 45px;

}

/* ================= CARD ================= */

.dashboard-card{

    background: white;

    border-radius: 26px;

    padding: 25px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    box-shadow:
    0 5px 25px rgba(0,0,0,.05);

}

.dashboard-card span{

    color: #888;

    font-size: 14px;

}

.dashboard-card h3{

    margin-top: 8px;

    font-size: 28px;
    font-weight: 700;

}

/* ICON */

.card-icon{

    width: 70px;
    height: 70px;

    border-radius: 24px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: white;

    font-size: 28px;

}

/* ================= TABLE ================= */

.table-card{

    background: white;

    border-radius: 30px;

    padding: 30px;

    box-shadow:
    0 5px 25px rgba(0,0,0,.05);

}

.table-header{

    margin-bottom: 20px;

}

.table-header h4{

    font-weight: 700;

    margin: 0;

}

.table thead tr th{

    border: none;

    color: #999;

    font-size: 14px;

}

.table tbody tr{

    border-top: 1px solid #f5f5f5;

}

.table tbody td{

    padding: 18px 10px;

}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    .welcome-card{

        flex-direction: column;
        text-align: center;
        gap: 20px;

    }

}

</style>

@endsection