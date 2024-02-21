@extends('layouts.admin') @section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header" id="titleCard">
                    Laporan by Pelanggan
                </div>
                <div class="card-body">

                    <div class="mb-3 wraper-search">
                        <div class="form-group">
                            <label for="searchInput">Cari Pelanggan:</label>
                            <input type="text" class="form-control" id="searchInput" autocomplete="off">
                            <input type="hidden" id="user">
                        </div>
                        <div id="autocompleteResults" class="list-group"></div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="from" class="form-label">Dari</label>
                            <input type="date" class="form-control" id="from" required value="{{date('Y-m-d')}}"
                                name="from">
                        </div>
                        <div class="col-6">
                            <label for="to" class="form-label">Sampai</label>
                            <input type="date" class="form-control" id="to" required value="{{date('Y-m-d')}}"
                                name="to">
                        </div>
                    </div>
                    <div class="mt-3 p-3">
                        <h5>Parameter Status Service :</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="statusSelesai" name="status_service"
                                value="Selesai">
                            <label class="form-check-label fw-bolder" for="statusSelesai">
                                Selesai
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input " type="radio" id="statusProses" name="status_service"
                                value="Proses">
                            <label class="form-check-label fw-bolder" for="statusProses">
                                Proses
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input " type="radio" id="statusGagal" name="status_service"
                                value="Cancel">
                            <label class="form-check-label fw-bolder" for="statusGagal">
                                Gagal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input " type="radio" id="statusServiceAll" name="status_service"
                                value="all" checked>
                            <label class="form-check-label fw-bolder" for="statusServiceAll">
                                Semua
                            </label>
                        </div>
                        <h5 class="mt-3">Parameter Status Pengambilan Barang :</h5>
                        <div class="form-check">
                            <input class="form-check-input " type="radio" id="statusPengambilanSudah"
                                name="status_barang" value="Sudah Diambil">
                            <label class="form-check-label fw-bolder" for="statusPengambilanSudah">
                                Sudah diambil
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input " type="radio" id="statusPengambilanBelum"
                                name="status_barang" value="Belum Diambil">
                            <label class="form-check-label fw-bolder" for="statusPengambilanBelum">
                                Belum diambil
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input " type="radio" id="statusPengambilanAll" name="status_barang"
                                value="all" checked>
                            <label class="form-check-label fw-bolder" for="statusPengambilanAll">
                                Semua
                            </label>
                        </div>
                    </div>
                    <br />
                    <div class="row mb-3">
                        <div class="col">
                            <button class="btn btn-primary w-100" id="filter" type="button">Cari</button>
                        </div>
                    </div>

                    <table class="table table-bordered data-table" id="table">
                        <thead>
                            <tr>
                                <th>No Faktur</th>
                                <th>Tanggal</th>
                                <th>Duraasi Service</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama Perusahaan</th>
                                <th>Telpon</th>
                                <th>Item</th>
                                <th>Status Service</th>
                                <th>Status Pengambilan</th>
                                <th>Duraasi Pengambilan</th>
                                <th>Dibuat Oleh</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push("scripts")


<script type="module">
    $(document).ready(async function() {
         // Data contoh untuk autocomplete
         var dataSuggestion = {!!$pelangganDb!!};
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
                resultList.append(`<a  class="list-group-item list-group-item-action" data-id="${results[i].id}" data-nama_pelanggan="${results[i].nama_pelanggan}" data-nama_perusahaan="${results[i].nama_perusahaan}">${results[i].nama_pelanggan} | ${results[i].nama_perusahaan}</a>`);
            }
            resultList.show();
        }

        $('#searchInput').on('click', function() {

            showAutocompleteResults(dataSuggestion);

        });

        // Fungsi untuk melakukan pencarian autocomplete
        $('#searchInput').on('input', function() {
            var inputText = $(this).val().toLowerCase();
            var results = [];

            if (inputText.length > 0) {
                results = dataSuggestion.filter(function(item) {
                    return item.nama_pelanggan.toLowerCase().includes(inputText) || item.nama_perusahaan.toLowerCase().includes(inputText);
                });
            }

            showAutocompleteResults(results);
        });


        $('#autocompleteResults').on('click', 'a', function() {
            var userId = $(this).data('id');
            var nama_pelanggan = $(this).data('nama_pelanggan');
            var nama_perusahaan = $(this).data('nama_perusahaan');
            $('#searchInput').val(nama_pelanggan + ' | ' + nama_perusahaan);
            $('#autocompleteResults').hide();
            $('#user').val(userId);
        });
        const isElectronApp = isElectron();
        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('laporan-by-pelanggan') }}",
            data: function (d) {
                d.userId = $('#user').val();
                d.from = $('#from').val();
                d.to = $('#to').val();
                d.status_service = $('input[name=status_service]:checked').val();
                d.status_barang = $('input[name=status_barang]:checked').val();
            }
        },
        autoWidth: false,
        columns: [
            {data: 'no_faktur', name: 'no_faktur'},
            {data: 'tanggal', name: 'Tanggal'},
            {data: 'Durasi Service', name: 'durasi_service'},
            {data: 'nama_pelanggan', name: 'nama_pelanggan'},
            {data: 'nama_perusahaan', name: 'nama_perusahaan'},
            {data: 'telepon_pelanggan', name: 'telpon'},
            {data: 'item', name: 'item'},
            {data: 'status_service', name: 'status_service'},
            {data: 'status_pengambilan', name: 'status_pengambilan'},
            {data: 'Durasi Pengambilan', name: 'durasi_pengambilan'},
            {data: 'userCreate', name: 'userCreate'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
  
        ],
        buttons: [
             'excel'
        ]
        });
        $('#filter').click(function () {
            $('.data-table').DataTable().draw(true);
        });
        
        if (!isElectronApp) {
            $('table').on('click', 'button', function () {
                const url = $(this).data('url');
                window.open(url, '_blank');
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