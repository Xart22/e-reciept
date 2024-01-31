<?php

namespace App\Http\Controllers;

use App\Models\PelangganModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanSparepartModel;
use App\Models\StokBarangModel;
use App\Models\TokoModel;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanByBarang()
    {
        $stokBarang = StokBarangModel::all();
        return view('laporan.laporan-by-barang', compact('stokBarang'));
    }

    public function laporanByBarangApi(Request $request)
    {
        $data = [];
        $penjualan = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', '!=', 'Cancel')->with('sparePart')->get();

        foreach ($penjualan as $dataPenjualan) {
            foreach ($dataPenjualan->sparePart as $dataSparePart) {
                if ($dataSparePart->kode_barang == $request->kodeBarang) {
                    $data[] = $dataPenjualan;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public  function laporanByToko()
    {
        $toko = TokoModel::all();
        return view('laporan.laporan-by-toko', compact('toko'));
    }

    public function laporanByTokoApi(Request $request)
    {

        $penjualan = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', '!=', 'Cancel')->where('toko_id', $request->tokoId)->with('sparePart')->get();
        return response()->json([
            'status' => 'success',
            'data' => $penjualan
        ]);
    }

    public function laporanByPenjualan()
    {
        return view('laporan.laporan-by-penjualan');
    }

    public function laporanByPenjualanApi(Request $request)
    {
        $penjualan = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', '!=', 'Cancel')->with('sparePart')->get();
        return response()->json([
            'status' => 'success',
            'data' => $penjualan
        ]);
    }

    public function laporanByUser()
    {
        $user = User::all();
        return view('laporan.laporan-by-user', compact('user'));
    }

    public function laporanByUserApi(Request $request)
    {
        $dataPenjualan = [];
        $penjualan = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', '!=', 'Cancel')->where('created_by', $request->userId)->with('sparePart')->get();
        foreach ($penjualan as $data) {
            if ($data->user_id == $request->userId) {
                $dataPenjualan[] = $data;
            }
            foreach ($data->sparePart as $dataSparePart) {
                if ($dataSparePart->created_by == $request->userId) {
                    $dataPenjualan[] = $data;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $dataPenjualan
        ]);
    }

    public function laporanByPelanggan()
    {
        $pelanggan = PelangganModel::all();
        return view('laporan.laporan-by-pelanggan', compact('pelanggan'));
    }

    public function laporanByPelangganApi(Request $request)
    {
        $pelanggan = PelangganModel::where('id', $request->userId)->first();
        $penjualan = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', '!=', 'Cancel')->where('nama_pelanggan', $pelanggan->nama_pelanggan)->with('sparePart')->get();


        return response()->json([
            'status' => 'success',
            'data' => $penjualan
        ]);
    }
}
