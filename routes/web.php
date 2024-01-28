<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('stok-barang', App\Http\Controllers\StokBarangController::class);
    Route::resource('tanda-terima', App\Http\Controllers\TandaTerimaController::class);
    Route::resource('toko', App\Http\Controllers\TokoController::class);
    Route::resource('manajemen-user', App\Http\Controllers\ManajemenUserController::class);
    Route::get('cetak-tanda-terima/{id}', [App\Http\Controllers\TandaTerimaController::class, 'cetakTandaTerima'])->name('tanda-terima.cetak');
});
