@extends('layouts.admin') @section('content')
<div class="container-xl">
    <div class="card">
        <div class="card-header">
            Input Data Faktur
        </div>
        <div class="card-body">
            <form action="{{ route('tanda-terima.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label for="noFaktur" class="col-sm-2 col-form-label">Toko</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="toko_id">
                            <option selected value="{{$tokoDefault->id}}">{{$tokoDefault->nama_toko}}</option>
                            @foreach ($toko as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_toko }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="noFaktur" class="col-sm-2 col-form-label">No. Faktur</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="noFaktur"
                            value="{{ $no_faktur }}" name="no_faktur">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="waktu" class="col-sm-2 col-form-label">Waktu</label>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="waktu" name="waktu">
                    </div>
                </div>
                <div class="border-bottom text-center"><strong>INFORMASI KONSUMEN</strong></div>
                <br>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="namaKonsumen" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="namaKonsumen" required autocomplete="off"
                            name="nama_pelanggan">

                    </div>
                    <div class="col-md-6">
                        <label for="namaPerusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="namaPerusahaan" required autocomplete="off"
                            name="nama_perusahaan">

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telponKonsumen" class="form-label">Telpon</label>
                        <input type="text" class="form-control" id="telponKonsumen" required autocomplete="off"
                            name="telepon_pelanggan">

                    </div>
                    <div class="col-md-6">
                        <label for="telponSeluler" class="form-label">Telpon Seluler</label>
                        <input type="text" class="form-control" id="telponSeluler" required autocomplete="off"
                            name="telepon_seluler">

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="emailKonsumen" class="form-label">Email</label>
                        <input type="text" class="form-control" id="emailKonsumen" required autocomplete="off"
                            name="email_pelanggan">

                    </div>
                    <div class="col-md-6">
                        <label for="alamatKonsumen" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamatKonsumen" required autocomplete="off"
                            name="alamat_pelanggan">

                    </div>
                </div>

                <div class="border-bottom text-center"><strong>INFORMASI BARANG</strong></div>
                <br>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="spesifikasiBarang" class="form-label">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasiBarang" rows="4" name="item"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="keluhanBarang" class="form-label">Keluhan</label>
                            <textarea class="form-control" id="keluhanBarang" rows="4" name="keluhan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kelengkapanBarang" class="form-label">Kelengkapan</label>
                            <textarea class="form-control" id="kelengkapanBarang" rows="3"
                                name="kelengkapan"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="cetakFaktur" checked name="cetak_faktur"
                                value="1">
                            <label class="form-check-label" for="cetakFaktur">
                                Cetak Faktur
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="tidakCetakFaktur" name="cetak_faktur"
                                value="0">
                            <label class="form-check-label" for="tidakCetakFaktur">
                                Tidak Cetak Faktur
                            </label>
                        </div>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
    $(document).ready(function() {
        $('input[type="date"]').val(new Date().toISOString().slice(0, 10));
        $('input[type="time"]').val(new Date().toLocaleTimeString('en-US', {
            hour12: false,
            hour: "numeric",
            minute: "numeric"
        }));
        const timer = setInterval(() => {
            $('input[type="time"]').val(new Date().toLocaleTimeString('en-US', {
                hour12: false,
                hour: "numeric",
                minute: "numeric"
            }));
        }, 1000);
    });
</script>
@endpush