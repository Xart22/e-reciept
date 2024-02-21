<?php

namespace App\Http\Controllers;

use App\DataTables\LaporanDataTable;
use App\Exports\LaporanExport;
use App\Models\PelangganModel;
use App\Models\PenjualanModel;
use App\Models\StokBarangModel;
use App\Models\TokoModel;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->status_service != 'all' && $request->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->where('status_pengambilan', $request->status_barang)->with('userCreate')->get();
        } else if ($request->status_service == 'all' && $request->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_pengambilan', $request->status_barang)->with('userCreate')->get();
        } else if ($request->status_service != 'all' && $request->status_barang == 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->with('userCreate')->get();
        } else {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->with('userCreate')->get();
        }
        if ($request->action == 'excel') {
            $fileName = 'Laporan Service ' . date('d-m-Y', strtotime($request->from)) . ' - ' . date('d-m-Y', strtotime($request->to)) . '.xlsx';
            return (new LaporanExport($request->from, $request->to, $request->status_service, $request->status_barang))->download($fileName);
        }

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('Durasi Service', function ($data) {
                    $status = $data->status_service;
                    if ($status == 'Proses') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Selesai' || $status == 'Cancel') {
                        $date = date_create($data->service_selesai);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->addColumn('Durasi Pengambilan', function ($data) {
                    $status = $data->status_pengambilan;
                    if ($status == 'Belum Diambil') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Sudah Diambil') {
                        $date = date_create($data->pengambilan_barang);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->editColumn('status_service', function ($data) {
                    if ($data->status_service == 'Proses') {
                        return '<span class="badge bg-primary w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Selesai') {
                        return '<span class="badge bg-success w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Barang di terima') {
                        return '<span class="badge bg-secondary w-100 fs-6">' . $data->status_service . '</span>';
                    } else {
                        return '<span class="badge bg-danger w-100 fs-6">' . $data->status_service . '</span>';
                    }
                })
                ->addColumn('userCreate', function ($data) {
                    return $data->userCreate->username;
                })->addColumn('action', function ($data) {
                    return '<button data-url="' . route('tanda-terima.show-laporan', $data->no_faktur) . '" class="btn btn-sm btn-primary btn-print"><i class="bi bi-eye"></i></button>';
                })
                ->rawColumns(['action', 'status_service', 'Durasi Service', 'Durasi Pengambilan'])
                ->make(true);
        }

        return view('laporan.index');
    }


    public function laporanByBarang(Request $request)
    {
        $stokBarang = StokBarangModel::all();
        if ($request->status_service != 'all' && $request->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->where('status_pengambilan', $request->status_barang)->with('userCreate')->get();
        } else if ($request->status_service == 'all' && $request->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_pengambilan', $request->status_barang)->with('userCreate')->get();
        } else if ($request->status_service != 'all' && $request->status_barang == 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->with('userCreate')->get();
        } else {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->with('userCreate')->get();
        }
        if ($request->action == 'excel') {
            $fileName = 'Laporan Service ' . date('d-m-Y', strtotime($request->from)) . ' - ' . date('d-m-Y', strtotime($request->to)) . '.xlsx';
            return (new LaporanExport($request->from, $request->to, $request->status_service, $request->status_barang))->download($fileName);
        }
        $dd = [];
        if ($request->ajax()) {
            foreach ($data as $d) {
                foreach ($d->sparePart as $dataSparePart) {
                    if ($dataSparePart->kode_barang == $request->kodeBarang) {
                        $dd[] = $d;
                    }
                }
            }
            return Datatables::of($dd)
                ->addColumn('Durasi Service', function ($data) {
                    $status = $data->status_service;
                    if ($status == 'Proses') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Selesai' || $status == 'Cancel') {
                        $date = date_create($data->service_selesai);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->addColumn('Durasi Pengambilan', function ($data) {
                    $status = $data->status_pengambilan;
                    if ($status == 'Belum Diambil') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Sudah Diambil') {
                        $date = date_create($data->pengambilan_barang);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->editColumn('status_service', function ($data) {
                    if ($data->status_service == 'Proses') {
                        return '<span class="badge bg-primary w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Selesai') {
                        return '<span class="badge bg-success w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Barang di terima') {
                        return '<span class="badge bg-secondary w-100 fs-6">' . $data->status_service . '</span>';
                    } else {
                        return '<span class="badge bg-danger w-100 fs-6">' . $data->status_service . '</span>';
                    }
                })
                ->addColumn('userCreate', function ($data) {
                    return $data->userCreate->username;
                })->addColumn('action', function ($data) {
                    return '<button data-url="' . route('tanda-terima.show-laporan', $data->no_faktur) . '" class="btn btn-sm btn-primary btn-print"><i class="bi bi-eye"></i></button>';
                })
                ->rawColumns(['action', 'status_service', 'Durasi Service', 'Durasi Pengambilan'])
                ->make(true);
        }
        return view('laporan.laporan-by-barang', compact('stokBarang'));
    }
    public  function laporanByToko(Request $request)
    {
        $toko = TokoModel::all();
        if ($request->status_service != 'all' && $request->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->where('status_pengambilan', $request->status_barang)->where('toko_id', $request->tokoId)->with('userCreate')->get();
        } else if ($request->status_service == 'all' && $request->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_pengambilan', $request->status_barang)->where('toko_id', $request->tokoId)->with('userCreate')->get();
        } else if ($request->status_service != 'all' && $request->status_barang == 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->where('toko_id', $request->tokoId)->with('userCreate')->get();
        } else {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('toko_id', $request->tokoId)->with('userCreate')->get();
        }
        if ($request->action == 'excel') {
            $fileName = 'Laporan Service ' . date('d-m-Y', strtotime($request->from)) . ' - ' . date('d-m-Y', strtotime($request->to)) . '.xlsx';
            return (new LaporanExport($request->from, $request->to, $request->status_service, $request->status_barang))->download($fileName);
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('Durasi Service', function ($data) {
                    $status = $data->status_service;
                    if ($status == 'Proses') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Selesai' || $status == 'Cancel') {
                        $date = date_create($data->service_selesai);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->addColumn('Durasi Pengambilan', function ($data) {
                    $status = $data->status_pengambilan;
                    if ($status == 'Belum Diambil') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Sudah Diambil') {
                        $date = date_create($data->pengambilan_barang);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->editColumn('status_service', function ($data) {
                    if ($data->status_service == 'Proses') {
                        return '<span class="badge bg-primary w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Selesai') {
                        return '<span class="badge bg-success w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Barang di terima') {
                        return '<span class="badge bg-secondary w-100 fs-6">' . $data->status_service . '</span>';
                    } else {
                        return '<span class="badge bg-danger w-100 fs-6">' . $data->status_service . '</span>';
                    }
                })
                ->addColumn('userCreate', function ($data) {
                    return $data->userCreate->username;
                })->addColumn('action', function ($data) {
                    return '<button data-url="' . route('tanda-terima.show-laporan', $data->no_faktur) . '" class="btn btn-sm btn-primary btn-print"><i class="bi bi-eye"></i></button>';
                })
                ->rawColumns(['action', 'status_service', 'Durasi Service', 'Durasi Pengambilan'])
                ->make(true);
        }
        return view('laporan.laporan-by-toko', compact('toko'));
    }

    public function laporanByUser(Request $request)
    {
        $user = User::all();
        if ($request->status_service != 'all' && $request->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->where('status_pengambilan', $request->status_barang)->where('created_by', $request->userId)->with('sparePart')->with('userCreate')->get();
        } else if ($request->status_service == 'all' && $request->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_pengambilan', $request->status_barang)->where('created_by', $request->userId)->with('sparePart')->with('userCreate')->get();
        } else if ($request->status_service != 'all' && $request->status_barang == 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->where('created_by', $request->userId)->with('sparePart')->with('userCreate')->get();
        } else {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('created_by', $request->userId)->with('sparePart')->with('userCreate')->get();
        }
        if ($request->action == 'excel') {
            $fileName = 'Laporan Service ' . date('d-m-Y', strtotime($request->from)) . ' - ' . date('d-m-Y', strtotime($request->to)) . '.xlsx';
            return (new LaporanExport($request->from, $request->to, $request->status_service, $request->status_barang))->download($fileName);
        }

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('Durasi Service', function ($data) {
                    $status = $data->status_service;
                    if ($status == 'Proses') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Selesai' || $status == 'Cancel') {
                        $date = date_create($data->service_selesai);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->addColumn('Durasi Pengambilan', function ($data) {
                    $status = $data->status_pengambilan;
                    if ($status == 'Belum Diambil') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Sudah Diambil') {
                        $date = date_create($data->pengambilan_barang);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->editColumn('status_service', function ($data) {
                    if ($data->status_service == 'Proses') {
                        return '<span class="badge bg-primary w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Selesai') {
                        return '<span class="badge bg-success w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Barang di terima') {
                        return '<span class="badge bg-secondary w-100 fs-6">' . $data->status_service . '</span>';
                    } else {
                        return '<span class="badge bg-danger w-100 fs-6">' . $data->status_service . '</span>';
                    }
                })
                ->addColumn('userCreate', function ($data) {
                    return $data->userCreate->username;
                })->addColumn('action', function ($data) {
                    return '<button data-url="' . route('tanda-terima.show-laporan', $data->no_faktur) . '" class="btn btn-sm btn-primary btn-print"><i class="bi bi-eye"></i></button>';
                })
                ->rawColumns(['action', 'status_service', 'Durasi Service', 'Durasi Pengambilan'])
                ->make(true);
        }
        return view('laporan.laporan-by-user', compact('user'));
    }


    public function laporanByPelanggan(Request $request)
    {
        $pelangganDb = PelangganModel::all();
        if ($request->userId) {
            $pelanggan = PelangganModel::where('id', $request->userId)->first();
        }
        if ($request->status_service != 'all' && $request->status_barang != 'all' && $request->userId) {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->where('status_pengambilan', $request->status_barang)->where('nama_pelanggan', $pelanggan->nama_pelanggan)->with('userCreate')->get();
        } else if ($request->status_service == 'all' && $request->status_barang != 'all' && $request->userId) {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_pengambilan', $request->status_barang)->where('nama_pelanggan', $pelanggan->nama_pelanggan)->with('userCreate')->get();
        } else if ($request->status_service != 'all' && $request->status_barang == 'all' && $request->userId) {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', $request->status_service)->where('nama_pelanggan', $pelanggan->nama_pelanggan)->with('userCreate')->get();
        } else {
            $data = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->with('userCreate')->get();
        }
        if ($request->action == 'excel') {
            $fileName = 'Laporan Service ' . date('d-m-Y', strtotime($request->from)) . ' - ' . date('d-m-Y', strtotime($request->to)) . '.xlsx';
            return (new LaporanExport($request->from, $request->to, $request->status_service, $request->status_barang))->download($fileName);
        }

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('Durasi Service', function ($data) {
                    $status = $data->status_service;
                    if ($status == 'Proses') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Selesai' || $status == 'Cancel') {
                        $date = date_create($data->service_selesai);
                        $date2 = date_create($data->tanggal);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->addColumn('Durasi Pengambilan', function ($data) {
                    $status = $data->status_pengambilan;
                    if ($status == 'Belum Diambil') {
                        $date = date('Y-m-d');
                        $date1 = date_create($date);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date1, $date2);
                        return $diff->format("%a hari");
                    } else if ($status == 'Sudah Diambil') {
                        $date = date_create($data->pengambilan_barang);
                        $date2 = date_create($data->service_selesai);
                        $diff = date_diff($date, $date2);
                        if ($diff->format("%a hari") == 0) {
                            return '1 hari';
                        }
                        return $diff->format("%a hari");
                    } else {
                        return '-';
                    }
                })
                ->editColumn('status_service', function ($data) {
                    if ($data->status_service == 'Proses') {
                        return '<span class="badge bg-primary w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Selesai') {
                        return '<span class="badge bg-success w-100 fs-6">' . $data->status_service . '</span>';
                    } else if ($data->status_service == 'Barang di terima') {
                        return '<span class="badge bg-secondary w-100 fs-6">' . $data->status_service . '</span>';
                    } else {
                        return '<span class="badge bg-danger w-100 fs-6">' . $data->status_service . '</span>';
                    }
                })
                ->addColumn('userCreate', function ($data) {
                    return $data->userCreate->username;
                })->addColumn('action', function ($data) {
                    return '<button data-url="' . route('tanda-terima.show-laporan', $data->no_faktur) . '" class="btn btn-sm btn-primary btn-print"><i class="bi bi-eye"></i></button>';
                })
                ->rawColumns(['action', 'status_service', 'Durasi Service', 'Durasi Pengambilan'])
                ->make(true);
        }
        return view('laporan.laporan-by-pelanggan', compact('pelangganDb'));
    }

    public function laporanByPelangganApi(Request $request)
    {
        $pelanggan = PelangganModel::where('id', $request->userId)->first();
        $penjualan = PenjualanModel::whereBetween('tanggal', [$request->from, $request->to])->where('status_service', '!=', 'Cancel')->where('nama_pelanggan', $pelanggan->nama_pelanggan)->with('sparePart')->with('userCreate')->get();


        return response()->json([
            'status' => 'success',
            'data' => $penjualan
        ]);
    }

    public function showLaporan($id)
    {
        $data = PenjualanModel::where('no_faktur', $id)->with(['toko', 'userCreate', 'userUpdate', 'sparePart'])->first();
        return view('laporan.laporan-show', compact('data'));
    }
}
