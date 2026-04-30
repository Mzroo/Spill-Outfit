<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProdukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function(){
    return view('auth.login');
});

// Route::get('/admin/dashboard', function(){
//     return view('admin.dashboard');
// })->name('admin.dashboard');


// Route::prefix('admin')->group(function () {

//     // Kategori
//     // INDEX
//     Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

//     // CREATE
//     Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');

//     // STORE
//     Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');

//     // EDIT
//     Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');

//     // UPDATE
//     Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');

//     // DELETE
//     Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


//     /* =========================
//     PRODUK
//     ========================= */

//     // INDEX
//     Route::get('/admin/produk', [ProdukController::class, 'index'])
//         ->name('produk.index');

//     // CREATE
//     Route::get('/admin/produk/create', [ProdukController::class, 'create'])
//         ->name('produk.create');

//     // STORE
//     Route::post('/admin/produk/store', [ProdukController::class, 'store'])
//         ->name('produk.store');

//     // EDIT
//     Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'edit'])
//         ->name('produk.edit');

//     // UPDATE
//     Route::put('/admin/produk/update/{id}', [ProdukController::class, 'update'])
//         ->name('produk.update');

//     // DELETE
//     Route::delete('/admin/produk/delete/{id}', [ProdukController::class, 'destroy'])
//         ->name('produk.destroy');

// });