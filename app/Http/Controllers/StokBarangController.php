<?php

namespace App\Http\Controllers;

use App\Models\StokBarangModel;
use Illuminate\Http\Request;
use App\DataTables\StokBarangDataTable;
use Illuminate\Support\Facades\Validator;

class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StokBarangDataTable $dataTable)
    {
        return $dataTable->render('stok-barang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StokBarangDataTable $dataTable)
    {
        return $dataTable->render('stok-barang.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'kode_barang.required' => 'Kode Barang tidak boleh kosong',
            'kode_barang.unique' => 'Kode Barang sudah ada',
            'nama_barang.required' => 'Nama Barang tidak boleh kosong',
            'stok_barang.required' => 'Stok Barang tidak boleh kosong',
            'harga_barang.required' => 'Harga Barang tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|unique:stok_barang',
            'nama_barang' => 'required',
            'stok_barang' => 'required',
            'harga_barang' => 'required',
        ], $message);

        if ($validator->fails()) {
            return redirect()->route('stok-barang.index')
                ->withErrors($validator)
                ->withInput();
        }

        StokBarangModel::create($request->all());

        return redirect()->route('stok-barang.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $message = [
            'nama_barang.required' => 'Nama Barang tidak boleh kosong',
            'stok_barang.required' => 'Stok Barang tidak boleh kosong',
            'harga_barang.required' => 'Harga Barang tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'stok_barang' => 'required',
            'harga_barang' => 'required',
        ], $message);

        if ($validator->fails()) {
            return redirect()->route('stok-barang.index')->withErrors($validator);
        }

        $stokBarang = StokBarangModel::find($id);
        $stokBarang->nama_barang = $request->nama_barang;
        $stokBarang->stok_barang = $request->stok_barang;
        $stokBarang->harga_barang = $request->harga_barang;
        $stokBarang->save();

        return redirect()->route('stok-barang.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stokBarang = StokBarangModel::find($id);
        $stokBarang->delete();

        return redirect()->route('stok-barang.index')->with('success', 'Data berhasil dihapus');
    }
}
