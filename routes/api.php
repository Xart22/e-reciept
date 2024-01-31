<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\TandaTerimaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/get-stock-barang', [StokBarangController::class, 'getStockBarang'])->name('get-stock-barang');
Route::post('/laporan-by-barang', [LaporanController::class, 'laporanByBarangApi'])->name('laporan-by-barang-api');
Route::post('/laporan-by-toko', [LaporanController::class, 'laporanByTokoApi'])->name('laporan-by-toko-api');
Route::post('/laporan-by-penjualan', [LaporanController::class, 'laporanByPenjualanApi'])->name('laporan-by-penjualan-api');
Route::post('/laporan-by-user', [LaporanController::class, 'laporanByUserApi'])->name('laporan-by-user-api');
Route::post('/laporan-by-pelanggan', [LaporanController::class, 'laporanByPelangganApi'])->name('laporan-by-pelanggan-api');
