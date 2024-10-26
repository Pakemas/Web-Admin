<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kelola-produk', [KelolaProdukController::class, 'index'])->name('produk');
    Route::post('/kelola-produk/tambah-kategori', [KelolaProdukController::class, 'storeCategory'])->name('tambah.category');
    Route::put('/kelola-produk/update-kategori', [KelolaProdukController::class, 'updateCategory'])->name('edit.category');
    Route::delete('/kelola-produk/hapus-kategori', [KelolaProdukController::class, 'destroyCategory'])->name('hapus.category');

    Route::post('/kelola-produk/tambah-produk', [KelolaProdukController::class, 'storeProduct'])->name('tambah.produk');
    Route::put('/kelola-produk/update-produk', [KelolaProdukController::class, 'updateProduk'])->name('edit.produk');
    Route::delete('/kelola-produk/hapus-produk', [KelolaProdukController::class, 'destroyProduct'])->name('hapus.produk');


});

require __DIR__.'/auth.php';
