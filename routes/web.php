<?php

use Illuminate\Support\Facades\Route;

// Controller Auth & Umum
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Controller User (Sisi Pelanggan)
use App\Http\Controllers\User\UserController as ClientUserController; 
use App\Http\Controllers\User\UserProdukController;
use App\Http\Controllers\User\UserKategoriController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\PesananController;
use App\Http\Controllers\User\PembayaranController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\CommunityController;

// Controller Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminChatController;
use App\Http\Controllers\Admin\AdminKeranjangController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminPengaturanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProdukGambarController;
use App\Http\Controllers\Admin\ProdukVarianController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UkuranController;
use App\Http\Controllers\Admin\WarnaController;
use App\Http\Controllers\Admin\UserController as AdminUserController; 
use App\Http\Controllers\Admin\AdminPesananController; 

/*
|--------------------------------------------------------------------------
| 1. GUEST & PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('guest');
    Route::get('/guest/about', 'about')->name('guest.about');
    Route::get('/guest/produk', 'produk')->name('guest.produk.index');
    Route::get('/guest/community', 'community')->name('guest.community');
});

Route::controller(UserProdukController::class)->group(function () {
    Route::get('/produk', 'index')->name('produk.index');
    Route::get('/produk/{id}', 'show')->name('produk.show');
});

Route::controller(UserKategoriController::class)->group(function () {
    Route::get('/kategori', 'index')->name('user.kategori.index');
    Route::get('/kategori/detail/{id}', 'show')->name('user.kategori.show');
});


/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATION & THIRD-PARTY API
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');

    // Google OAuth
    Route::get('/auth/google', 'redirectToGoogle')->name('google.login');
    Route::get('/auth/google/callback', 'handleGoogleCallback')->name('google.callback');
});


/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATED USER ROUTES (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    Route::controller(ClientUserController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('user.dashboard');
        Route::get('/about', 'about')->name('about');
        Route::get('/settings', 'settings')->name('settings');
        Route::get('/search', 'search')->name('user.search');
        Route::post('/settings/update', 'updateSettings')->name('settings.update');
    });

    Route::controller(KeranjangController::class)->prefix('keranjang')->name('keranjang.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{id}', 'store')->name('store');
        Route::put('/update/{id}', 'updateQty')->name('updateQty');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::controller(PesananController::class)->group(function () {
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::post('/pesanan/store', 'store')->name('pesanan.store');
        Route::get('/pesanan', 'index')->name('pesanan.index');
        Route::get('/pesanan/{id}', 'show')->name('pesanan.show');
        
        // SINKRONISASI JALUR: Diubah dari '/api/search-city' menjadi '/search-city' agar klop dengan JavaScript Checkout
        Route::get('/search-city', 'searchCity')->name('search.city');

        // TAMBAHAN FIX: Rute penampung jembatan sukses bayar Midtrans untuk mengubah status database lokal
        Route::get('/pesanan/sukses/{id}', 'pembayaranSukses')->name('pesanan.sukses');
    });

    Route::controller(PembayaranController::class)->prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/{pesanan_id}', 'create')->name('create');
        Route::post('/{pesanan_id}', 'store')->name('store');
    });

    Route::controller(ChatController::class)->prefix('chat')->name('chat.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/send', 'send')->name('send');
    });

    Route::controller(CommunityController::class)->prefix('community')->name('community.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{post}', 'show')->name('show');
        Route::post('/{post}/like', 'like')->name('like');
        Route::post('/{post}/comment', 'comment')->name('comment');
        Route::delete('/{post}', 'destroy')->name('destroy');
    });
});


/*
|--------------------------------------------------------------------------
| 4. ADMIN ROUTES (Prefix: /admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginPost')->name('login.post');
        Route::get('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
        Route::post('/logout', 'logout')->name('logout');
    });

    // Semua Manajemen Admin (Wajib Login)
    Route::middleware('auth')->group(function () {

        // Manajemen Kategori
        Route::controller(KategoriController::class)->prefix('kategori')->name('kategori.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Manajemen Produk
        Route::controller(ProdukController::class)->prefix('produk')->name('produk.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Gambar Produk
        Route::controller(ProdukGambarController::class)->group(function () {
            Route::get('/produk/{id}/gambar', 'index')->name('produk.gambar');
            Route::post('/produk/{id}/gambar', 'store')->name('produk.gambar.store');
            Route::delete('/gambar/{id}', 'destroy')->name('gambar.destroy');
        });

        // Manajemen Brand
        Route::controller(BrandController::class)->prefix('brand')->name('brand.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Manajemen Ukuran
        Route::controller(UkuranController::class)->prefix('ukuran')->name('ukuran.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Manajemen Warna
        Route::controller(WarnaController::class)->prefix('warna')->name('warna.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Varian Produk
        Route::controller(ProdukVarianController::class)->prefix('produk-varian')->name('produk-varian.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
        
        // Chat Admin
        Route::controller(AdminChatController::class)->prefix('chat')->name('chat.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{user_id}', 'show')->name('show');
            Route::post('/{user_id}/send', 'send')->name('send');
        });

        // Kelola Data Customer / Users Otoritas
        Route::controller(AdminUserController::class)->prefix('users')->name('users.')->group(function () {
            Route::patch('/{user}/toggle-status', 'toggleStatus')->name('toggle-status');
        });
        Route::resource('users', AdminUserController::class)->except(['show']);

        // Manajemen Transaksi Masuk Sisi Admin
        Route::controller(AdminPesananController::class)->prefix('pesanan')->name('pesanan.')->group(function () {
            Route::get('/', 'index')->name('index');                    
            Route::get('/{id}', 'show')->name('show');                  
            Route::patch('/{id}/kirim', 'kirimPesanan')->name('kirim'); 
        });

        // Manajemen Laporan Keuangan
        Route::controller(AdminLaporanController::class)->prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', 'index')->name('index'); 
        });

        // Rute Pengaturan Akun & Kontak Toko
        Route::get('/pengaturan', [AdminPengaturanController::class, 'index'])->name('pengaturan.index');
        Route::put('/pengaturan', [AdminPengaturanController::class, 'update'])->name('pengaturan.update');
    });
});