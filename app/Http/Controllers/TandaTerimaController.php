<?php

namespace App\Http\Controllers;

use App\DataTables\PenjualanModelDataTable;
use App\Models\PenjualanModel;
use App\Models\SettingModel;
use App\Models\TokoModel;
use Illuminate\Http\Request;

class TandaTerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PenjualanModelDataTable $dataTable)
    {

        return $dataTable->render('tanda-terima.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $no = PenjualanModel::where('tanggal', date('Y-m-d'))->count();
        $no_faktur = 'S' . date('my') . '-' . str_pad($no + 1, 3, '0', STR_PAD_LEFT);
        $setting = SettingModel::first();
        if ($setting) {
            $tokoDefault = TokoModel::findOrFail($setting->toko_id);
            $toko = TokoModel::where('id', '!=', $setting->toko_id)->get();
        } else {
            return redirect()->route('toko.create')->with('warning', 'Silahkan tambahkan toko terlebih dahulu.');
        }

        return view('tanda-terima.create', compact('no_faktur', 'tokoDefault', 'toko'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token', 'cetak_faktur']);
        $data['tanggal'] = date('Y-m-d', strtotime($data['tanggal']));
        $data['user_id'] = 1;
        $id = PenjualanModel::create($data)->id;
        if ($request->cetak_faktur == '1') {
            return redirect()->route('tanda-terima.cetak', $id);
        }
        return redirect()->route('tanda-terima.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PenjualanModel::findOrFail($id);
        return view('tanda-terima.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Cetak tanda terima.
     */
    public function cetakTandaTerima($id)
    {
        $data = PenjualanModel::findOrFail($id)->load('toko');
        return view('tanda-terima.cetak', compact('data'));
    }
}
