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
                <div class="row">
                    <div class="col">
                        <div class="row mb-3">
                            <label for="noFaktur" class="col-sm-2 col-form-label">No. Faktur</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="noFaktur"
                                    value="{{ $no_faktur }}" name="no_faktur">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row mb-3">
                            <label for="sales" class="col-sm-2 col-form-label">Sales</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="created_by" required>
                                    <option selected value="" disabled>Pilih Sales</option>
                                    @foreach ($sales as $item)
                                    <option value="{{ $item->id }}">{{ $item->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                        <div id="autocompleteResults" class="list-group" style="width: 30vw;"></div>
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
                        <input type="tel" class="form-control" id="telponKonsumen" required autocomplete="off"
                            name="telepon_pelanggan">

                    </div>
                    <div class="col-md-6">
                        <label for="telponSeluler" class="form-label">Telpon Seluler</label>
                        <input type="tel" class="form-control" id="telponSeluler" required autocomplete="off"
                            name="telepon_seluler">

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="emailKonsumen" class="form-label">Email</label>
                        <input type="text" class="form-control" id="emailKonsumen" autocomplete="off"
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
                            <textarea class="form-control" id="spesifikasiBarang" rows="4" name="item"
                                required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="keluhanBarang" class="form-label">Keluhan</label>
                            <textarea class="form-control" id="keluhanBarang" rows="4" name="keluhan"
                                required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="kelengkapanBarang" class="form-label">Kelengkapan</label>
                            <textarea class="form-control" id="kelengkapanBarang" rows="3"
                                name="kelengkapan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" id="cetakFaktur" name="cetak_faktur">
                    <div class="col-sm-6"><button type="submit" id="save" class="btn btn-success w-100">Simpan</button>
                    </div>
                    <div class="col-sm-6"><button type="submit" id="cetak" class="btn btn-primary w-100">Simpan &
                            Cetak</button>
                    </div>
                </div>




            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
    $(document).ready(function() {

        $('#cetak').on('click', function() {
            $('#cetakFaktur').val(1);
        });


        const time= new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
   
            $('#waktu').val(time.replace('.', ':'));
            $('#tanggal').val(new Date().toISOString().slice(0, 10));
            $('input[type="tel"]').on('keypress', function(e) {
                var char = e.which || e.keyCode;
                if (char == 43) return true;
                if (char > 31 && (char < 48 || char > 57)) return false;
                return true;
            });

        // Data contoh untuk autocomplete
        var dataSuggestion = {!!$pelanggan!!};
        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                $('#autocompleteResults').hide();
            }
        });


        // Fungsi untuk menampilkan hasil autocomplete
        function showAutocompleteResults(results) {

            var resultList = $('#autocompleteResults');
            resultList.empty();

            for (var i = 0; i < results.length; i++) {
            console.log(results[i]);
            resultList.append(`<a  class="list-group-item list-group-item-action" data-nama_pelanggan="${results[i].nama_pelanggan}" data-nama_perusahaan="${results[i].nama_perusahaan}" data-alamat_pelanggan="${results[i].alamat_pelanggan}" data-telepon_pelanggan="${results[i].telepon_pelanggan}" data-email_pelanggan="${results[i].email_pelanggan}">${results[i].nama_pelanggan} | ${results[i].nama_perusahaan} | ${results[i].telepon_pelanggan}</a>`);
                
            }
            resultList.show();
        }

        $('#namaKonsumen').on('click', function() {

            showAutocompleteResults(dataSuggestion);

        });

        // Fungsi untuk melakukan pencarian autocomplete
        $('#namaKonsumen').on('input', function() {
            var inputText = $(this).val().toLowerCase();
            var results = [];

            if (inputText.length > 0) {
                results = dataSuggestion.filter(function(item) {
                    return item.nama_pelanggan.toLowerCase().includes(inputText);
                });
            }

            showAutocompleteResults(results);
        });


        $('#autocompleteResults').on('click', 'a', function() {
            const nama_pelanggan = $(this).data('nama_pelanggan');
            const nama_perusahaan = $(this).data('nama_perusahaan');
            const alamat_pelanggan = $(this).data('alamat_pelanggan');
            const telepon_pelanggan = $(this).data('telepon_pelanggan');
            const email_pelanggan = $(this).data('email_pelanggan');

            $('#namaKonsumen').val(nama_pelanggan);
            $('#namaPerusahaan').val(nama_perusahaan);
            $('#alamatKonsumen').val(alamat_pelanggan);
            $('#telponKonsumen').val(telepon_pelanggan);
            $('#telponSeluler').val(telepon_pelanggan);
            $('#emailKonsumen').val(email_pelanggan);
            $('#autocompleteResults').hide();

        });


    });
    setInterval(() => {
    const time= new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
   
            $('#waktu').val(time.replace('.', ':'));
            
        }, 1000);
</script>
@endpush