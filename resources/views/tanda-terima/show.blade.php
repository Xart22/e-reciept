@extends('layouts.admin') @section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <strong>No. Faktur {{ $data->no_faktur }}</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{$data->tanggal}}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label for="waktu" class="col-sm-2 col-form-label">Waktu</label>
                            <input type="time" class="form-control" id="waktu" name="waktu" value="{{$data->waktu}}"
                                disabled />
                        </div>
                    </div>
                    <div class="border-bottom text-center">
                        <strong>INFORMASI KONSUMEN</strong>
                    </div>
                    <br />
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="namaKonsumen" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="namaKonsumen" required autocomplete="off"
                                name="nama_pelanggan" value="{{$data->nama_pelanggan}}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label for="namaPerusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="namaPerusahaan" required autocomplete="off"
                                name="nama_perusahaan" value="{{$data->nama_perusahaan}}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="telponKonsumen" class="form-label">Telpon</label>
                            <input type="text" class="form-control" id="telponKonsumen" required autocomplete="off"
                                name="telepon_pelanggan" value="{{$data->telepon_pelanggan}}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label for="telponSeluler" class="form-label">Telpon Seluler</label>
                            <input type="text" class="form-control" id="telponSeluler" required autocomplete="off"
                                name="telepon_seluler" value="{{$data->telepon_seluler}}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="emailKonsumen" class="form-label">Email</label>
                            <input type="text" class="form-control" id="emailKonsumen" required autocomplete="off"
                                name="email_pelanggan" value="{{$data->email_pelanggan}}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label for="alamatKonsumen" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamatKonsumen" required autocomplete="off"
                                name="alamat_pelanggan" value="{{$data->alamat_pelanggan}}" disabled />
                        </div>
                    </div>
                    <div class="border-bottom text-center">
                        <strong>INFORMASI BARANG</strong>
                    </div>
                    <br />
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="spesifikasiBarang" class="form-label">Spesifikasi</label>
                                <textarea class="form-control" id="spesifikasiBarang" rows="4" name="item"
                                    disabled>{{$data->item}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kelengkapanBarang" class="form-label">Kelengkapan</label>
                                <textarea class="form-control" id="kelengkapanBarang" rows="4" name="kelengkapan"
                                    disabled>{{$data->kelengkapan}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="mb-3">
                                <label for="keluhanBarang" class="form-label">Keluhan</label>
                                <textarea class="form-control" id="keluhanBarang" rows="5" name="keluhan"
                                    disabled>{{$data->keluhan}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Toko : <strong>{{$data->toko->nama_toko}}</strong></p>
                            @if($data->status_service == 'Cancel')
                            <p>Status : <span class="text-danger"><strong>{{$data->status_service}}</strong></span>
                            </p>
                            @else
                            <p>Status : <strong>{{$data->status_service}}</strong></p>
                            @endif
                            <p>Create By : <strong>{{$data->userCreate->username}}</strong></p>
                            <p>Update By : <strong>{{$data->userUpdate->username}}</strong></p>
                            <p>Update At : <strong>{{$data->updated_at}}</strong></p>


                            <div class="row mb-3">
                                <div class="col">
                                    <div class="col">
                                        <div class="border-bottom text-center">
                                            <strong>History SERVICE</strong>
                                        </div>
                                        <div style="max-height: 400px; overflow-y: auto; min-height: 360px;">
                                            <section class="py-5">
                                                <ul class="timeline">
                                                    @if(count($data->log) != 0)
                                                    @foreach ($data->log as $item)
                                                    <li class="timeline-item mb-5">
                                                        <h5 class="fw-bold">{{$item->userCreate->username}}</h5>
                                                        <p class="text-muted mb-2 fw-bold">{{$item->created_at}}</p>
                                                        <p class="text-muted">
                                                            {{$item->keterangan}}
                                                        </p>
                                                    </li>
                                                    @endforeach
                                                    @else
                                                    <li class="timeline-item mb-5">
                                                        <h5 class="fw-bold">Belum ada history</h5>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </section>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div style="overflow-x: hidden; overflow-y: auto; max-height: 345px;">
                                <table class="table table-striped table-hover" id="tableSparepart">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Sparepart</th>
                                            <th scope="col">Nama Sparepart</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->sparePart as $sparepart)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$sparepart->kode_barang}}</td>
                                            <td>{{$sparepart->nama_barang}}</td>
                                            <td>{{$sparepart->jumlah}}</td>
                                            <td>{{$sparepart->harga}}</td>
                                            <td>{{$sparepart->subtotal}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-end">Total</td>
                                            <td>{{$data->total_harga == null ? "Rp 0" : $data->total_harga}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    @if($data->status_pengambilan == 'Belum Diambil')
                                    <div class="col">

                                        <a href="{{route('tanda-terima.update-pengambilan',$data->id)}}"
                                            class="btn btn-success w-100">Barang Sudah
                                            Diambil</a>

                                    </div>
                                    @endif
                                    @if($data->status_service != 'Cancel')
                                    <div class="col">
                                        <button data-url="{{route('tanda-terima.cetak-invoice',$data->id)}}"
                                            class="btn btn-dark w-100" id="cetakInvoice">Cetak Invoice</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push("scripts")
<script type="module">
    $(document).ready(function () {
        const isElectronApp = isElectron();
        if (isElectronApp) {

        } else {
            $('#cetakInvoice').on('click', function () {
        const url = $(this).data('url');
        window.location.href = url;
    });
        }
    });
    function isElectron() {
                // Renderer process
                if (typeof window !== 'undefined' && typeof window.process === 'object' && window.process.type === 'renderer') {
                    return true;
                }

                // Main process
                if (typeof process !== 'undefined' && typeof process.versions === 'object' && !!process.versions.electron) {
                    return true;
                }

                // Detect the user agent when the `nodeIntegration` option is set to true
                if (typeof navigator === 'object' && typeof navigator.userAgent === 'string' && navigator.userAgent.indexOf('Electron') >= 0) {
                    return true;
                }

                return false;
        }
</script>
@endpush