<?php

namespace App\Exports;

use App\Models\PenjualanModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    protected $from;
    protected $to;
    protected $status_service;
    protected $status_barang;

    public function __construct($from, $to, $status_service, $status_barang)
    {
        $this->from = $from;
        $this->to = $to;
        $this->status_service = $status_service;
        $this->status_barang = $status_barang;
    }

    public function collection()
    {
        if ($this->status_service != 'all' && $this->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$this->from, $this->to])->where('status_service', $this->status_service)->where('status_pengambilan', $this->status_barang)->with('sparePart')->get();
        } else if ($this->status_service == 'all' && $this->status_barang != 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$this->from, $this->to])->where('status_pengambilan', $this->status_barang)->with('sparePart')->get();
        } else if ($this->status_service != 'all' && $this->status_barang == 'all') {
            $data = PenjualanModel::whereBetween('tanggal', [$this->from, $this->to])->where('status_service', $this->status_service)->with('sparePart')->get();
        } else {
            $data = PenjualanModel::whereBetween('tanggal', [$this->from, $this->to])->with('sparePart')->get();
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'No Faktur',
            'Tanggal',
            'Duraasi Service',
            'Nama Pelanggan',
            'Nama Perusahaan',
            'Telpon',
            'Item',
            'Status Service',
            'Status Pengambilan',
            'Duraasi Pengambilan',
            'Spare Part',
        ];
    }

    public function map($data): array
    {
        $sparePart = '';
        foreach ($data->sparePart as $sp) {
            $sparePart .= $sp->nama_barang . ' Jumlah : ' . $sp->jumlah  . ' Harga : ' . $sp->harga . ' Total : ' . $sp->subtotal . "\n";
        }
        return [
            $data->no_faktur,
            date('d-m-Y', strtotime($data->tanggal)),
            $this->durasiService($data),
            $data->nama_pelanggan,
            $data->nama_perusahaan,
            $data->telepon_pelanggan,
            $data->item,
            $data->status_service,
            $data->status_pengambilan,
            $this->durasiPengambilan($data),
            $sparePart
        ];
    }

    public function durasiService($data)
    {
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
            if ($diff->format("%a") == 0) {
                return '1 hari Service Selesai pada ' . date('d-m-Y', strtotime($data->service_selesai));
            }
            return $diff->format("%a") . ' hari Service Selesai pada ' . date('d-m-Y', strtotime($data->service_selesai));
        } else {
            return '-';
        }
    }

    public function durasiPengambilan($data)
    {
        $status = $data->status_pengambilan;
        if ($status == 'Belum Diambil') {
            $date = date('Y-m-d');
            $date1 = date_create($date);
            $date2 = date_create($data->service_selesai);
            $diff = date_diff($date1, $date2);
            return $diff->format("%a") . ' hari Dari Tanggal Service Selesai';
        } else if ($status == 'Sudah Diambil') {
            $date = date_create($data->pengambilan_barang);
            $date2 = date_create($data->service_selesai);
            $diff = date_diff($date, $date2);
            if ($diff->format("%a") == 0) {
                return '1 hari Barang diambil pada ' . date('d-m-Y', strtotime($data->pengambilan_barang));
            }
            return $diff->format("%a") . ' hari Dari Tanggal Service Selesai Barang diambil pada ' . date('d-m-Y', strtotime($data->pengambilan_barang));
        } else {
            return '-';
        }
    }
}
