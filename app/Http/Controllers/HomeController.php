<?php

namespace App\Http\Controllers;

use App\DataTables\LogsDataTable;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use App\Models\PenjualanSparepartModel;
use App\Models\StokBarangModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(LogsDataTable $dataTable)
    {

        $jumlah_penjualan_bulan_ini = PenjualanModel::whereMonth('tanggal', date('m'))->where('status_service', '!=', 'Cancel')->whereYear('tanggal', date('Y'))->count();
        // bandingkan dengan bulan lalu
        $jumlah_penjualan_bulan_lalu = PenjualanModel::whereMonth('tanggal', date('m', strtotime('-1 month')))->where('status_service', '!=', 'Cancel')->whereYear('tanggal', date('Y'))->count();

        $jumlah_penjualan_sparepart_bulan_ini = PenjualanSparepartModel::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        $total_penjualan_sparepart_bulan_ini = 0;
        foreach ($jumlah_penjualan_sparepart_bulan_ini as $penjualan_sparepart) {
            $total_penjualan_sparepart_bulan_ini += $penjualan_sparepart->jumlah;
        }
        // bandingkan dengan bulan lalu
        $jumlah_penjualan_sparepart_bulan_lalu = PenjualanSparepartModel::whereMonth('created_at', date('m', strtotime('-1 month')))->whereYear('created_at', date('Y'))->get();
        $total_penjualan_sparepart_bulan_lalu = 0;
        foreach ($jumlah_penjualan_sparepart_bulan_lalu as $penjualan_sparepart) {
            $total_penjualan_sparepart_bulan_lalu += $penjualan_sparepart->jumlah;
        }

        //pendapatan bulan ini
        $pendapatan_bulan_ini = PenjualanModel::whereMonth('tanggal', date('m'))->where('status_service', '!=', 'Cancel')->whereYear('tanggal', date('Y'))->get();
        $total_pendapatan_bulan_ini = 0;
        foreach ($pendapatan_bulan_ini as $penjualan) {
            if ($penjualan->status_service != 'Proses' && $penjualan->status_service != 'Cancel') {
                $total = preg_match_all('/\d+/', $penjualan->total_harga, $matches);
                $total = implode('', $matches[0]);
                $total_pendapatan_bulan_ini += (int) $total;
            }
        }
        //bandingkan dengan bulan lalu
        $pendapatan_bulan_lalu = PenjualanModel::whereMonth('tanggal', date('m', strtotime('-1 month')))
            ->where('status_service', '!=', 'Cancel')
            ->whereYear('tanggal', date('Y'))->get();
        $total_pendapatan_bulan_lalu = 0;
        foreach ($pendapatan_bulan_lalu as $penjualan) {
            if ($penjualan->status_service != 'Proses' && $penjualan->status_service != 'Cancel') {
                $total = preg_match_all('/\d+/', $penjualan->total_harga, $matches);
                $total = implode('', $matches[0]);
                if ($total != 0) {

                    $total_pendapatan_bulan_lalu += (int) $total;
                }
            }
        }

        $stok_sparepart_kritis = StokBarangModel::where('stok_barang', '<=', 5)->count();

        //persentase
        $persentase_penjualan = 0;
        if ($jumlah_penjualan_bulan_lalu != 0) {
            $persentase_penjualan = ($jumlah_penjualan_bulan_ini - $jumlah_penjualan_bulan_lalu) / $jumlah_penjualan_bulan_lalu * 100;
        }
        $persentase_penjualan_sparepart = 0;
        if ($total_penjualan_sparepart_bulan_lalu != 0) {
            $persentase_penjualan_sparepart = ($total_penjualan_sparepart_bulan_ini - $total_penjualan_sparepart_bulan_lalu) / $total_penjualan_sparepart_bulan_lalu * 100;
        }
        $persentase_pendapatan = 0;
        if ($total_pendapatan_bulan_lalu != 0) {
            $persentase_pendapatan = ($total_pendapatan_bulan_ini - $total_pendapatan_bulan_lalu) / $total_pendapatan_bulan_lalu * 100;
        }


        return $dataTable->render('dashboard.index', [
            'jumlah_penjualan_bulan_ini' => $jumlah_penjualan_bulan_ini,
            'jumlah_penjualan_bulan_lalu' => $jumlah_penjualan_bulan_lalu,
            'total_penjualan_sparepart_bulan_ini' => $total_penjualan_sparepart_bulan_ini,
            'total_penjualan_sparepart_bulan_lalu' => $total_penjualan_sparepart_bulan_lalu,
            'total_pendapatan_bulan_ini' => $total_pendapatan_bulan_ini,
            'total_pendapatan_bulan_lalu' => $total_pendapatan_bulan_lalu,
            'persentase_penjualan' => $persentase_penjualan,
            'persentase_penjualan_sparepart' => $persentase_penjualan_sparepart,
            'persentase_pendapatan' => $persentase_pendapatan,
            'stok_sparepart_kritis' => $stok_sparepart_kritis
        ]);
    }

    public function changePassword()
    {
        return view('profile.index');
    }

    public function updatePassword(Request $request)
    {
        try {
            if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
                return redirect()->back()->with("error", "Password lama tidak sesuai. Silakan coba lagi");
            }
            $userId = Auth::user()->id;
            $user = User::find($userId);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route('home')->with('success', 'Password berhasil diubah');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
