<?php

namespace App\Http\Controllers;

use App\DataTables\PenjualanModelDataTable;
use App\Models\LogModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanSparepartModel;
use App\Models\SettingModel;
use App\Models\StokBarangModel;
use App\Models\TokoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $no = PenjualanModel::where('tanggal', 'like', '%' . date('Y-m') . '%')->count();
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
        $data['created_by'] = Auth::user()->id;
        $id = PenjualanModel::create($data)->id;
        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Menambahkan data penjualan dengan no faktur ' . $request->no_faktur,
        ]);
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
        $data = PenjualanModel::where('id', $id)->with(['toko', 'userCreate', 'userUpdate', 'sparePart'])->first();
        return view('tanda-terima.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PenjualanModel::findOrFail($id);
        $sparePart = StokBarangModel::get();
        return view('tanda-terima.edit', compact('data', 'sparePart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->cancel == "1") {
            PenjualanModel::where('id', $id)->update(['keterangan_service' => $request->keterangan_service, 'status_service' => 'Cancel', 'updated_by' => Auth::user()->id, 'status_pengambilan' => 'Belum Diambil']);
            LogModel::create([
                'id_user' => Auth::user()->id,
                'aktivitas' => 'Mengubah status service penjualan dengan no faktur ' . PenjualanModel::where('id', $id)->first()->no_faktur . ' menjadi cancel',
            ]);

            return redirect()->route('tanda-terima.index')->with('success', 'Data berhasil diupdate.');
        }
        $item_sparepart = json_decode($request->item_sparepart, true);
        $data = $request->except(['_token', 'cancel', '_method', 'cetak_faktur', 'item_sparepart', 'total']);
        $data['total_harga'] = $request->total;
        $data['updated_by'] = Auth::user()->id;
        $data['status_service'] = 'Selesai';
        if ($request->cetak_faktur == '1') {
            $data['status_pengambilan'] = "Sudah Diambil";
        } else {
            $data['status_pengambilan'] = "Belum Diambil";
        }
        PenjualanModel::where('id', $id)->update($data);
        $no_faktur = PenjualanModel::where('id', $id)->first()->no_faktur;
        foreach ($item_sparepart as $item) {
            StokBarangModel::where('kode_barang', $item['kode_barang'])->decrement('stok_barang', $item['qty']);
            PenjualanSparepartModel::create([
                'no_faktur' => $no_faktur,
                'kode_barang' => $item['kode_barang'],
                'nama_barang' => $item['nama_barang'],
                'jumlah' => $item['qty'],
                'harga' => $item['harga_barang'],
                'subtotal' => $item['subtotal'],
            ]);
        }
        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Mengubah data penjualan dengan no faktur ' . $no_faktur,
        ]);
        if ($request->cetak_faktur == '1') {
            return redirect()->route('tanda-terima.cetak', $id);
        }
        return redirect()->route('tanda-terima.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = PenjualanModel::findOrFail($id);
        $data->delete();
        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Menghapus data penjualan dengan no faktur ' . $data->no_faktur,
        ]);
        return redirect()->route('tanda-terima.index')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Cetak tanda terima.
     */
    public function cetakTandaTerima($id)
    {
        $data = PenjualanModel::findOrFail($id)->with(['toko', 'userCreate'])->first();
        return view('tanda-terima.cetak', compact('data'));
    }

    public function updateStatusPengambilan($id)
    {
        PenjualanModel::where('id', $id)->update(['status_pengambilan' => 'Sudah Diambil']);
        LogModel::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Mengubah status pengambilan barang dengan no faktur ' . PenjualanModel::where('id', $id)->first()->no_faktur,
        ]);
        return redirect()->route('tanda-terima.show', $id)->with('success', 'Status pengambilan berhasil diupdate.');
    }

    public function cetakInvoice($id)
    {

        $data = PenjualanModel::where('id', $id)->with(['toko', 'userCreate', 'userUpdate', 'sparePart'])->first();
        return view('tanda-terima.invoice', compact('data'));
    }
}
