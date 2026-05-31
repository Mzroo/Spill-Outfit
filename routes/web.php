<?php

use App\Http\Controllers\Admin\AdminChatController;
use Illuminate\Support\Facades\Route;

// =========================
// CONTROLLER
// =========================

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProdukController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\UserKategoriController;
use App\Http\Controllers\KomunitasController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProdukGambarController;
use App\Http\Controllers\Admin\ProdukVarianController;
use App\Http\Controllers\Admin\StokBarangController;
use App\Http\Controllers\Admin\UkuranController;
use App\Http\Controllers\Admin\WarnaController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\PembayaranController;
use App\Http\Controllers\User\PesananController;
use App\Models\ProdukVarian;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/


// =========================
// GUEST
// =========================

Route::get('/', [HomeController::class, 'index'])
    ->name('guest');

Route::get('/guest/about', [HomeController::class, 'about'])->name('guest.about');

Route::get('/guest/produk', [HomeController::class, 'produk'])->name('guest.produk.index');

Route::get('/guest/community', [HomeController::class, 'community'])->name('guest.community');


// =========================
// AUTH USER
// =========================

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// =========================
// USER ROUTER
// =========================

// DASHBOARD
Route::get('/dashboard', [UserController::class, 'index'])
    ->name('user.dashboard');


// =========================
// PRODUK USER
// =========================

// SEMUA PRODUK
Route::get('/produk', [UserProdukController::class, 'index'])
    ->name('produk.index');

// DETAIL PRODUK
Route::get('/produk/{id}', [UserProdukController::class, 'show'])
    ->name('produk.show');


// =========================
// KATEGORI USER
// =========================

// SEMUA KATEGORI
Route::get('/kategori', [UserKategoriController::class, 'index'])
    ->name('user.kategori.index');

// DETAIL KATEGORI
Route::get('/kategori/{id}', [UserKategoriController::class, 'show'])
    ->name('user.kategori.show');

// =========================
// ABOUT
// =========================

Route::get('/about', [UserController::class, 'about'])
    ->name('about');

// =========================
// KOMUNITAS
// =========================

// FEED
Route::get('/komunitas', [KomunitasController::class, 'index'])
    ->name('komunitas.index');

// POSTING
Route::post('/komunitas/store', [KomunitasController::class, 'store'])
    ->middleware('auth')
    ->name('komunitas.store');


// =========================
// PROFILE
// =========================

// HALAMAN SETTINGS
Route::get('/settings', [UserController::class, 'settings'])
    ->middleware('auth')
    ->name('settings');

// UPDATE SETTINGS
Route::post('/settings/update', [UserController::class, 'updateSettings'])
    ->middleware('auth')
    ->name('settings.update');


// =========================
// KERANJANG
// =========================

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | KERANJANG
    |--------------------------------------------------------------------------
    */

    // HALAMAN KERANJANG
    Route::get(
        '/keranjang',
        [KeranjangController::class, 'index']
    )->name('keranjang.index');

    // TAMBAH KE KERANJANG
    Route::post(
        '/keranjang/{id}',
        [KeranjangController::class, 'store']
    )->name('keranjang.store');

    // UPDATE QTY (+ / -)
Route::put(
    '/keranjang/update/{id}',
    [KeranjangController::class, 'updateQty']
)->name('keranjang.updateQty');

    // HAPUS ITEM KERANJANG
    Route::delete(
        '/keranjang/{id}',
        [KeranjangController::class, 'destroy']
    )->name('keranjang.destroy');

       /*
    |--------------------------------------------------------------------------
    | PESANAN
    |--------------------------------------------------------------------------
    */

    // list semua pesanan user
    Route::get('/pesanan', [PesananController::class, 'index'])
        ->name('pesanan.index');

    // checkout page (dari keranjang)
    Route::get('/checkout', [PesananController::class, 'checkout'])
        ->name('pesanan.checkout');

    // proses buat pesanan
    Route::post('/checkout', [PesananController::class, 'store'])
        ->name('pesanan.store');

    // detail pesanan
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])
        ->name('pesanan.show');

    /*
    |--------------------------------------------------------------------------
    | PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    // form pembayaran (upload bukti / pilih metode)
    Route::get('/pembayaran/{pesanan_id}', [PembayaranController::class, 'create'])
        ->name('pembayaran.create');

    // simpan pembayaran
    Route::post('/pembayaran/{pesanan_id}', [PembayaranController::class, 'store'])
        ->name('pembayaran.store');

    // Chat Halaman
        Route::get('/chat',[ChatController::class, 'index'])->name('chat.index');
        
        Route::post('/chat/send',[ChatController::class, 'send'])->name('chat.send');
});



// =========================
// ADMIN ROUTER
// =========================

Route::prefix('admin')->group(function(){

    // =========================
    // AUTH ADMIN
    // =========================

    // LOGIN
    Route::get('/login', [AdminController::class, 'login'])
        ->name('admin.login');

    // LOGIN POST
    Route::post('/login', [AdminController::class, 'loginPost'])
        ->name('admin.login.post');

    // DASHBOARD
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->middleware('auth')
        ->name('admin.dashboard');

    // LOGOUT
    Route::post('/logout', [AdminController::class, 'logout'])
        ->name('admin.logout');


    // =========================
    // KATEGORI ADMIN
    // =========================

    // INDEX
    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('admin.kategori.index');

    // CREATE
    Route::get('/kategori/create', [KategoriController::class, 'create'])
        ->name('admin.kategori.create');

    // STORE
    Route::post('/kategori', [KategoriController::class, 'store'])
        ->name('admin.kategori.store');

    // EDIT
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])
        ->name('admin.kategori.edit');

    // UPDATE
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])
        ->name('admin.kategori.update');

    // DELETE
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])
        ->name('admin.kategori.destroy');


    // =========================
    // PRODUK ADMIN
    // =========================

    // INDEX
    Route::get('/produk', [ProdukController::class, 'index'])
        ->name('admin.produk.index');

    // CREATE
    Route::get('/produk/create', [ProdukController::class, 'create'])
        ->name('admin.produk.create');

    // STORE
    Route::post('/produk/store', [ProdukController::class, 'store'])
        ->name('admin.produk.store');

    // EDIT
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])
        ->name('admin.produk.edit');

    // UPDATE
    Route::put('/produk/update/{id}', [ProdukController::class, 'update'])
        ->name('admin.produk.update');

    // DELETE
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])
        ->name('admin.produk.destroy');


    // =========================
    // GAMBAR PRODUK
    // =========================

    // HALAMAN GAMBAR
    Route::get('/produk/{id}/gambar', [ProdukGambarController::class, 'index'])
        ->name('admin.produk.gambar');

    // STORE GAMBAR
    Route::post('/produk/{id}/gambar', [ProdukGambarController::class, 'store'])
        ->name('admin.produk.gambar.store');

    // DELETE GAMBAR
    Route::delete('/gambar/{id}', [ProdukGambarController::class, 'destroy'])
        ->name('admin.gambar.destroy');

    // Halaman Brand

    Route::get('/brand', [BrandController::class, 'index'])
        ->name('admin.brand.index');

    // CREATE
    Route::get('/brand/create', [BrandController::class, 'create'])
        ->name('admin.brand.create');

    // STORE
    Route::post('/brand/store', [BrandController::class, 'store'])
        ->name('admin.brand.store');

    // EDIT
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])
        ->name('admin.brand.edit');

    // UPDATE
    Route::put('/brand/update/{id}', [BrandController::class, 'update'])
        ->name('admin.brand.update');

    // DELETE
    Route::delete('/brand/delete/{id}', [BrandController::class, 'destroy'])
        ->name('admin.brand.destroy');

    // ================= UKURAN =================

    Route::get('/ukuran', [UkuranController::class, 'index'])
        ->name('admin.ukuran.index');

    Route::get('/ukuran/create', [UkuranController::class, 'create'])
        ->name('admin.ukuran.create');

    Route::post('/ukuran/store', [UkuranController::class, 'store'])
        ->name('admin.ukuran.store');

    Route::get('/ukuran/edit/{id}', [UkuranController::class, 'edit'])
        ->name('admin.ukuran.edit');

    Route::put('/ukuran/update/{id}', [UkuranController::class, 'update'])
        ->name('admin.ukuran.update');

    Route::delete('/ukuran/{id}', [UkuranController::class, 'destroy'])
        ->name('admin.ukuran.destroy');

    // Warna 
     Route::get('/warna', [WarnaController::class, 'index'])
        ->name('admin.warna.index');

    Route::get('/warna/create', [WarnaController::class, 'create'])
        ->name('admin.warna.create');

    Route::post('/warna', [WarnaController::class, 'store'])
        ->name('admin.warna.store');

    Route::get('/warna/{id}/edit', [WarnaController::class, 'edit'])
        ->name('admin.warna.edit');

    Route::put('/warna/{id}', [WarnaController::class, 'update'])
        ->name('admin.warna.update');

    Route::delete('/warna/{id}', [WarnaController::class, 'destroy'])
        ->name('admin.warna.destroy');

    // Produk Varian
    Route::get('/produk-varian', [ProdukVarianController::class, 'index'])
        ->name('admin.produk-varian.index');

    Route::get('/produk-varian/create', [ProdukVarianController::class, 'create'])
        ->name('admin.produk-varian.create');

    Route::post('/produk-varian', [ProdukVarianController::class, 'store'])
        ->name('admin.produk-varian.store');

    Route::get('/produk-varian/{id}/edit', [ProdukVarianController::class, 'edit'])
        ->name('admin.produk-varian.edit');

    Route::put('/produk-varian/{id}', [ProdukVarianController::class, 'update'])
        ->name('admin.produk-varian.update');

    Route::delete('/produk-varian/{id}', [ProdukVarianController::class, 'destroy'])
        ->name('admin.produk-varian.destroy');

     /*
        |--------------------------------------------------------------------------
        | CHAT CUSTOMER
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/chat',
            [AdminChatController::class, 'index']
        )->name('admin.chat.index');

        Route::get(
            '/chat/{id}',
            [AdminChatController::class, 'show']
        )->name('admin.chat.show');

        Route::post(
            '/chat/{id}/send',
            [AdminChatController::class, 'send']
        )->name('admin.chat.send');

});