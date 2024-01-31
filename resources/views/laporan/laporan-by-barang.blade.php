@extends('layouts.admin') @section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header" id="titleCard">
                    Laporan by Barang
                </div>
                <div class="card-body">

                    <div class="mb-3 wraper-search">
                        <div class="form-group">
                            <label for="searchInput">Cari Barang:</label>
                            <input type="text" class="form-control" id="searchInput" autocomplete="off">
                            <input type="hidden" id="kodeBarang">
                        </div>
                        <div id="autocompleteResults" class="list-group"></div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="from" class="form-label">From</label>
                            <input type="date" class="form-control" id="from" required value="{{date('Y-m-d')}}">
                        </div>
                        <div class="col-6">
                            <label for="to" class="form-label">To</label>
                            <input type="date" class="form-control" id="to" required value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <br />
                    <div style="overflow-x:auto; max-height: 800px">
                        <table class="table table-striped table-bordered" style="position: relative">
                            <thead>
                                <tr style="position: sticky; top: 0; background: white; z-index: 1">
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">No. Faktur</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Nama Perusahaan</th>
                                    <th scope="col">Telpon</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Status Service</th>
                                    <th scope="col">Status Penganbilan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <tr>
                                    <td colspan="10" class="text-center">Tidak ada data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push("scripts")


<script type="module">
    const url = "{{ route('get-stock-barang') }}";
    $(document).ready(async function() {

        $('#from').change(async function(){
            const kodeBarang = $('#kodeBarang').val();
            if(kodeBarang != ''){
                await getData();
            }
        });
        $('#to').change(async function(){
            const kodeBarang = $('#kodeBarang').val();
            if(kodeBarang != ''){
                await getData();
            }
        });
         // Data contoh untuk autocomplete
         var dataSuggestion = {!!$stokBarang!!};
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
            
                resultList.append(`<a  class="list-group-item list-group-item-action" data-kode_barang="${results[i].kode_barang}" data-nama_barang="${results[i].nama_barang}" data-stok_barang="${results[i].stok_barang}" data-harga_barang="${results[i].harga_barang}" data-satuan_barang="${results[i].satuan_barang}">${results[i].kode_barang} - ${results[i].nama_barang} | <span class="p-1">Stok : <strong>${results[i].stok_barang}</strong></span></a></a>`);
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
                    return item.kode_barang.toLowerCase().includes(inputText) || item.nama_barang.toLowerCase().includes(inputText);
                });
            }

            showAutocompleteResults(results);
        });


        $('#autocompleteResults').on('click', 'a', function() {
            var kodeBarang = $(this).data('kode_barang');
            var namaBarang = $(this).data('nama_barang');
            $('#searchInput').val(kodeBarang + ' - ' + namaBarang);
            $('#autocompleteResults').hide();
            $('#kodeBarang').val(kodeBarang);
            getData();
        });

    });
    const isElectronApp = isElectron();

   const urlData = "{{ route('laporan-by-barang-api') }}";
   async function getData(){
        const from = $('#from').val();
        const to = $('#to').val();
        const kodeBarang = $('#kodeBarang').val();
        const data = {
            from,
            to,
            kodeBarang
        }
        const response = await fetch(urlData, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const result = await response.json();
        const urlDetail = "{{ route('tanda-terima.show', ':id') }}";
        console.log(result);
        if(result.data.length > 0){
            $('#table-body').empty();
            result.data.forEach((item, index) => {

                $('#table-body').append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.tanggal}</td>
                        <td>${item.no_faktur}</td>
                        <td>${item.nama_pelanggan}</td>
                        <td>${item.nama_perusahaan}</td>
                        <td>${item.telepon_pelanggan}</td>
                        <td>${item.item}</td>
                        <td>${item.keluhan}</td>
                        <td>${item.status_service}</td>
                        <td>${item.status_pengambilan}</td>
                        <td>
                            <button data-url="${urlDetail.replace(':id',item.no_faktur)}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                `);
            });
        }else{
            $('#table-body').empty();
            $('#table-body').append(`
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data</td>
                </tr>
            `);
        }
        if (!isElectronApp) {
    $('#table-body').find("button").click(function(){
        console.log('test');
        const url = $(this).data('url');
        window.open(url, '_blank');
    });
} else{
    $('#table-body').find("button").click(function(){
        console.log('test');
        const url = $(this).data('url');
        window.location.href = url;
    });
}
   }
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