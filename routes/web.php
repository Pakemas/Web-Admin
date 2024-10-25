<?php

use App\Http\Controllers\KelolaProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kelola-produk', [KelolaProdukController::class, 'index'])->name('produk');
    Route::post('/kelola-produk/tambah-category', [KelolaProdukController::class, 'storeCategory'])->name('tambah.category');
    Route::post('/kelola-produk/tambah-product', [KelolaProdukController::class, 'storeProduct'])->name('tambah.produk');

});

require __DIR__.'/auth.php';
