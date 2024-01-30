<?php

namespace App\Http\Controllers;

use App\Models\StokBarangModel;
use Illuminate\Http\Request;
use App\DataTables\StokBarangDataTable;
use App\Models\LogModel;
use App\Models\StockBarangLogModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        try {
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
            DB::beginTransaction();

            StokBarangModel::create($request->all());
            StockBarangLogModel::create([
                'tanggal' => date('Y-m-d'),
                'kode_barang' => $request->kode_barang,
                'vendor' => $request->vendor,
                'in' => $request->stok_barang,
                'saldo' => $request->stok_barang,
                'keterangan' => $request->keterangan,
                'created_by' => Auth::user()->id,

            ]);
            LogModel::create([
                'id_user' => Auth::user()->id,
                'aktivitas' => 'Menambahkan data stok barang ' . $request->nama_barang,
            ]);
            DB::commit();
            return redirect()->route('stok-barang.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('stok-barang.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stokBarang = StokBarangModel::where('kode_barang', $id)->first();
        return view('stok-barang.show', compact('stokBarang'));
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
        try {
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
            DB::beginTransaction();
            $stokBarang = StokBarangModel::find($id);
            $stokBarang->nama_barang = $request->nama_barang;
            $stokBarang->stok_barang = $request->stok_barang;
            $stokBarang->harga_barang = $request->harga_barang;
            $stokBarang->save();
            StockBarangLogModel::create([
                'tanggal' => date('Y-m-d'),
                'kode_barang' => $stokBarang->kode_barang,
                'vendor' => $request->vendor,
                'in' => $request->stok_barang,
                'saldo' => $request->stok_barang,
                'keterangan' => $request->keterangan,
                'created_by' => Auth::user()->id,

            ]);
            LogModel::create([
                'id_user' => Auth::user()->id,
                'aktivitas' => 'Mengubah data stok barang ' . $stokBarang->kode_barang,
            ]);
            DB::commit();

            return redirect()->route('stok-barang.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('stok-barang.index')->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stokBarang = StokBarangModel::find($id);
        StockBarangLogModel::where('kode_barang', $stokBarang->kode_barang)->delete();


        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Menghapus data stok barang ' . $stokBarang->kode_barang,
        ]);
        $stokBarang->delete();

        return redirect()->route('stok-barang.index')->with('success', 'Data berhasil dihapus');
    }

    function getStockBarang(Request $request)
    {

        $stokBarang = StockBarangLogModel::where('kode_barang', $request->kodeBarang)->whereBetween('tanggal', [$request->from, $request->to])->get();
        return response()->json($stokBarang);
    }
}
