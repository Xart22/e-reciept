@extends('layouts.admin') @section('content')
<div class="container-lg px-4">
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{$jumlah_penjualan_bulan_ini}}
                            @if ($jumlah_penjualan_bulan_ini > $jumlah_penjualan_bulan_lalu)
                            <span class="fs-6 fw-normal">(+{{$persentase_penjualan}}%
                                <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                                </svg>)</span>
                            @else
                            <span class="fs-6 fw-normal">(-{{$persentase_penjualan}}%
                                <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                                </svg>)</span>
                            @endif
                        </div>
                        <div>Jumlah Service Bulan Ini</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-xl-3">
            <div class="card text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{$total_penjualan_sparepart_bulan_ini}}
                            @if ($total_penjualan_sparepart_bulan_ini > $total_penjualan_sparepart_bulan_lalu)
                            <span class="fs-6 fw-normal">(+{{$persentase_penjualan_sparepart}}%
                                <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                                </svg>)</span>
                            @else
                            <span class="fs-6 fw-normal">(-{{$persentase_penjualan_sparepart}}%
                                <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                                </svg>)</span>
                            @endif
                        </div>
                        <div>Penjualan Sparepart Bulan ini</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px">
                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-xl-3">
            <div class="card text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{$total_pendapatan_bulan_ini}}
                            @if ($total_pendapatan_bulan_ini > $total_pendapatan_bulan_lalu)
                            <span class="fs-6 fw-normal">(+{{$persentase_pendapatan}}%
                                <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                                </svg>)</span>
                            @else
                            <span class="fs-6 fw-normal">(-{{$persentase_pendapatan}}%
                                <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                                </svg>)</span>
                            @endif
                        </div>
                        <div>Pendapatan Bulan ini</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3" style="height: 70px">
                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-xl-3">
            <div class="card text-white bg-danger">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{$stok_sparepart_kritis}} Item
                        </div>
                        <div>Stok Sparepart Kritis</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px">
                    <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
            </div>
        </div>

    </div>
    @if (Auth::user()->role == 'Admin')
    <div class="card mb-4">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
    @endif

</div>
@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush