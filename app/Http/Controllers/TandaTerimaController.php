<?php

namespace App\Http\Controllers;

use App\DataTables\PenjualanModelDataTable;
use App\Models\LogModel;
use App\Models\LogServiceModel;
use App\Models\PelangganModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanSparepartModel;
use App\Models\SettingModel;
use App\Models\StockBarangLogModel;
use App\Models\StokBarangModel;
use App\Models\TokoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $pelanggan = PelangganModel::get();
        if ($setting) {
            $tokoDefault = TokoModel::findOrFail($setting->toko_id);
            $toko = TokoModel::where('id', '!=', $setting->toko_id)->get();
        } else {
            return redirect()->route('toko.create')->with('warning', 'Silahkan tambahkan toko terlebih dahulu.');
        }

        return view('tanda-terima.create', compact('no_faktur', 'tokoDefault', 'toko', 'pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except(['_token', 'cetak_faktur']);
            $data['tanggal'] = date('Y-m-d', strtotime($data['tanggal']));
            $data['created_by'] = Auth::user()->id;
            $id = PenjualanModel::create($data)->id;
            LogModel::create([
                'id_user' => Auth::user()->id,
                'aktivitas' => 'Menambahkan data penjualan dengan no faktur ' . $request->no_faktur,
            ]);

            $check =  PelangganModel::where('telepon_pelanggan', $request->telepon_pelanggan)->first();

            if (!$check) {
                PelangganModel::create([
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'telepon_pelanggan' => $request->telepon_pelanggan,
                    'alamat_pelanggan' => $request->alamat_pelanggan,
                    'email_pelanggan' => $request->email_pelanggan,
                ]);
            }
            DB::commit();

            if ($request->cetak_faktur == '1') {
                return redirect()->route('tanda-terima.cetak', $id);
            }
            return redirect()->route('tanda-terima.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()->route('tanda-terima.index')->with('error', 'Data gagal disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PenjualanModel::where('id', $id)->with(['toko', 'userCreate', 'userUpdate', 'sparePart'])->first();
        if ($data == null) {
            $data = PenjualanModel::where('no_faktur', $id)->with(['toko', 'userCreate', 'userUpdate', 'sparePart'])->first();
        }
        return view('tanda-terima.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PenjualanModel::where('id', $id)->with(['log', 'sparePart'])->first();
        $dataSparePart = [];
        foreach ($data->sparePart as $key => $value) {
            $dataSparePart[$key]['kode_barang'] = $value->kode_barang;
        }
        $sparePart = StokBarangModel::whereNotIn('kode_barang', $dataSparePart)->get();
        return view('tanda-terima.edit', compact('data', 'sparePart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            if ($request->cancel == "1") {
                PenjualanModel::where('id', $id)->update(['status_service' => 'Cancel', 'updated_by' => Auth::user()->id, 'status_pengambilan' => 'Belum Diambil']);
                LogServiceModel::create([
                    'no_faktur' => PenjualanModel::where('id', $id)->first()->no_faktur,
                    'keterangan' => $request->keterangan_service,
                    'created_by' => Auth::user()->id,
                ]);
                LogModel::create([
                    'id_user' => Auth::user()->id,
                    'aktivitas' => 'Mengubah status service penjualan dengan no faktur ' . PenjualanModel::where('id', $id)->first()->no_faktur . ' menjadi cancel',
                ]);
                DB::commit();
                return redirect()->route('tanda-terima.index')->with('success', 'Data berhasil diupdate.');
            }
            $item_sparepart = json_decode($request->item_sparepart, true);
            $data = $request->except(['_token', 'cancel', '_method', 'cetak_faktur', 'item_sparepart', 'total', 'keterangan_service']);
            if ($request->total) {
                $data['total_harga'] = $request->total;
            }
            $data['updated_by'] = Auth::user()->id;
            PenjualanModel::where('id', $id)->update($data);
            $no_faktur = PenjualanModel::where('id', $id)->first()->no_faktur;
            LogServiceModel::create([
                'no_faktur' => $no_faktur,
                'keterangan' => $request->keterangan_service,
                'created_by' => Auth::user()->id,
            ]);
            if ($item_sparepart) {
                foreach ($item_sparepart as $item) {
                    $stok = StokBarangModel::where('kode_barang', $item['kode_barang'])->first();
                    $stok->update([
                        'stok_barang' => $stok->stok_barang - $item['qty'],
                    ]);
                    StockBarangLogModel::create([
                        'tanggal' => date('Y-m-d'),
                        'kode_barang' => $item['kode_barang'],
                        'no_faktur' => $no_faktur,
                        'out' => $item['qty'],
                        'keterangan' => 'Penjualan Barang No Faktur ' . $no_faktur . ' oleh ' . Auth::user()->username,
                        'created_by' => Auth::user()->id,
                        'saldo' => $stok->stok_barang
                    ]);
                    PenjualanSparepartModel::create([
                        'no_faktur' => $no_faktur,
                        'kode_barang' => $item['kode_barang'],
                        'nama_barang' => $item['nama_barang'],
                        'jumlah' => $item['qty'],
                        'harga' => $item['harga_barang'],
                        'subtotal' => $item['subtotal'],
                        'created_by' => Auth::user()->id,
                    ]);
                }
            }

            LogModel::create([
                'id_user' => Auth::user()->id,
                'aktivitas' => 'Mengubah data penjualan dengan no faktur ' . $no_faktur,
            ]);
            if ($request->cetak_faktur == '1') {
                PenjualanModel::where('id', $id)->update(['status_pengambilan' => 'Belum Diambil', 'status_service' => 'Selesai', 'updated_by' => Auth::user()->id,]);
                DB::commit();
                if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Kasir' || Auth::user()->role == 'User') {
                    return redirect()->route('tanda-terima.cetak-invoice', $id);
                }
            }


            DB::commit();
            return redirect()->route('tanda-terima.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('tanda-terima.index')->with('error', 'Data gagal diupdate.');
        }
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

    function deleteItemPenjualan($id, $kode_barang)
    {
        try {
            DB::beginTransaction();
            $faktur = PenjualanModel::where('id', $id)->first();
            $data = PenjualanSparepartModel::where('no_faktur', $faktur->no_faktur)->where('kode_barang', $kode_barang)->first();
            $stok = StokBarangModel::where('kode_barang', $kode_barang)->first();
            $stok->update([
                'stok_barang' => $stok->stok_barang + $data->jumlah,
            ]);
            $subTotal = str_replace('Rp ', '', $data->subtotal);
            $subTotal = str_replace('.', '', $subTotal);
            $total = preg_match_all('/\d+/', $faktur->total_harga, $matches);
            $total = implode('', $matches[0]);
            $total = $total - $subTotal;
            $total = number_format($total, 0, ',', '.');
            $faktur->update([
                'total_harga' => 'Rp ' . $total,
            ]);
            StockBarangLogModel::create([
                'tanggal' => date('Y-m-d'),
                'kode_barang' => $kode_barang,
                'no_faktur' => $faktur->no_faktur,
                'in' => $data->jumlah,
                'keterangan' => 'Pembatalan Penjualan Barang No Faktur ' . $data->no_faktur . ' oleh ' . Auth::user()->username,
                'created_by' => Auth::user()->id,
                'saldo' => $stok->stok_barang,
            ]);
            $data->delete();

            LogModel::create([
                'id_user' => Auth::user()->id,
                'aktivitas' => 'Menghapus item penjualan dengan no faktur ' . $faktur->no_faktur,
            ]);
            DB::commit();

            return redirect()->route('tanda-terima.edit', $id)->with('success', 'Item penjualan berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('tanda-terima.edit', $id)->with('error', 'Item penjualan gagal dihapus.');
        }
    }

    public function showInvoice($id)
    {
        $data = PenjualanModel::where('no_faktur', $id)->with(['toko', 'userCreate', 'userUpdate', 'sparePart'])->first();
        return view('tanda-terima.show-invoice', compact('data'));
    }
}
