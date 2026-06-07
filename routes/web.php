<?php

use Illuminate\Support\Facades\Route;

// Controller Auth & Umum
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RajaOngkirController;

// Controller User
use App\Http\Controllers\User\UserController;
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
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProdukGambarController;
use App\Http\Controllers\Admin\ProdukVarianController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UkuranController;
use App\Http\Controllers\Admin\WarnaController;

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

// Produk & Kategori (Bisa diakses tanpa login)
Route::controller(UserProdukController::class)->group(function () {
    Route::get('/produk', 'index')->name('produk.index');
    Route::get('/produk/{id}', 'show')->name('produk.show');
});

Route::controller(UserKategoriController::class)->group(function () {
    // Halaman Utama Semua Kategori
    Route::get('/kategori', 'index')->name('user.kategori.index');
    
    // Halaman Detail Kategori (Diberi prefix /detail/ agar aman dari bentrok URL)
    Route::get('/kategori/detail/{id}', 'show')->name('user.kategori.show');
});


/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATION & THIRD-PARTY API
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    // Auth Native
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');

    // Google OAuth
    Route::get('/auth/google', 'redirectToGoogle')->name('google.login');
    Route::get('/auth/google/callback', 'handleGoogleCallback')->name('google.callback');
});

// RajaOngkir API
Route::controller(RajaOngkirController::class)->prefix('rajaongkir')->group(function () {
    Route::get('/destination', 'getDestination');
    Route::post('/cost', 'calculateCost');
});


/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATED USER ROUTES (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Dashboard & Profile
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('user.dashboard');
        Route::get('/about', 'about')->name('about');
        Route::get('/settings', 'settings')->name('settings');
        Route::get('/search', [UserController::class, 'search'])->name('user.search');
        Route::post('/settings/update', 'updateSettings')->name('settings.update');
    });

    // Keranjang Belanja
    Route::controller(KeranjangController::class)->prefix('keranjang')->name('keranjang.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{id}', 'store')->name('store');
        Route::put('/update/{id}', 'updateQty')->name('updateQty');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Pesanan & Checkout
    Route::controller(PesananController::class)->group(function () {
        Route::get('/pesanan', 'index')->name('pesanan.index');
        Route::get('/checkout', 'checkout')->name('pesanan.checkout');
        Route::post('/checkout', 'store')->name('pesanan.store');
        Route::get('/pesanan/{id}', 'show')->name('pesanan.show');
    });

    // Pembayaran
    Route::controller(PembayaranController::class)->prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/{pesanan_id}', 'create')->name('create');
        Route::post('/{pesanan_id}', 'store')->name('store');
    });

    // Chat User
    Route::controller(ChatController::class)->prefix('chat')->name('chat.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/send', 'send')->name('send');
    });

    // Forum Komunitas
    Route::controller(CommunityController::class)->prefix('community')->name('community.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        
        // Mengubah {id} menjadi {post} untuk memanfaatkan Route Model Binding
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

    // Auth Admin
    Route::controller(AdminController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginPost')->name('login.post');
        Route::get('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
        Route::post('/logout', 'logout')->name('logout');
    });

    // Semua Manajemen Admin (Bisa ditambahkan middleware admin jika ada nanti)
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
            Route::post('/', 'store')->name('store'); // Diubah dari /store menjadi / agar RESTful
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update'); // Diubah dari /update/{id}
            Route::delete('/{id}', 'destroy')->name('destroy'); // Diubah dari /delete/{id}
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
        
        Route::controller(AdminChatController::class)->prefix('chat')->name('chat.')->group(function () {
            Route::get('/', 'index')->name('index');
            
            // DISESUAIKAN: Mengubah {id} menjadi {user_id} agar pas dengan parameter Controller
            Route::get('/{user_id}', 'show')->name('show');
            Route::post('/{user_id}/send', 'send')->name('send');
        });
    });
});