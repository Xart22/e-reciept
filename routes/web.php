<?php

use App\Http\Controllers\TandaTerimaController;
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
    Route::get('penjualan-update-pengambilan/{id}', [App\Http\Controllers\TandaTerimaController::class, 'updateStatusPengambilan'])->name('tanda-terima.update-pengambilan');
    Route::delete('/delete-item-penjualan/{no_faktur}/{kode_barang}', [TandaTerimaController::class, 'deleteItemPenjualan'])->name('delete-item-penjualan');
    Route::resource('toko', App\Http\Controllers\TokoController::class);
    Route::resource('manajemen-user', App\Http\Controllers\ManajemenUserController::class);
    Route::get('change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password');
    Route::post('change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('change-password');
    Route::get('laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan');
    Route::get('laporan-by-barang', [App\Http\Controllers\LaporanController::class, 'laporanByBarang'])->name('laporan-by-barang');
    Route::get('laporan-by-toko', [App\Http\Controllers\LaporanController::class, 'laporanByToko'])->name('laporan-by-toko');
    Route::get('laporan-by-penjualan', [App\Http\Controllers\LaporanController::class, 'laporanByPenjualan'])->name('laporan-by-penjualan');
    Route::get('laporan-by-user', [App\Http\Controllers\LaporanController::class, 'laporanByUser'])->name('laporan-by-user');
    Route::get('laporan-by-pelanggan', [App\Http\Controllers\LaporanController::class, 'laporanByPelanggan'])->name('laporan-by-pelanggan');
});
Route::get('cetak-tanda-terima/{id}', [App\Http\Controllers\TandaTerimaController::class, 'cetakTandaTerima'])->name('tanda-terima.cetak');
Route::get('cetak-invoice/{id}', [App\Http\Controllers\TandaTerimaController::class, 'cetakInvoice'])->name('tanda-terima.cetak-invoice');
Route::get('show-invoice/{id}', [App\Http\Controllers\TandaTerimaController::class, 'showInvoice'])->name('tanda-terima.show-invoice');
Route::get('show-laporan/{id}', [App\Http\Controllers\LaporanController::class, 'showLaporan'])->name('tanda-terima.show-laporan');
