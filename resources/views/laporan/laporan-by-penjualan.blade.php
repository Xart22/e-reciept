@extends('layouts.admin') @section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header" id="titleCard">
                    Laporan by Penjualan
                </div>
                <div class="card-body">

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
                    <div style="overflow-x:auto; max-height: 500px">
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
    const url = "{{ route('laporan-by-penjualan-api') }}";
    $(document).ready(async function() {
        
        await getData();
        $('#from').change(async function(){
            await getData();
        });
        $('#to').change(async function(){
            await getData();
        });
        
    });

   async function getData(){
        const from = $('#from').val();
        const to = $('#to').val();
        const data = {
            from,
            to,
        }
        const response = await fetch(url, {
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
                    <td colspan="9" class="text-center">Tidak ada data</td>
                </tr>
            `);
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
        const isElectronApp = isElectron();

        if (isElectronApp) {
        } else {
            $('#table-body').find("button").click(function(){
                const url = $(this).data('url');
                window.open(url, '_blank');
            });
        }else{
            $('#table-body').find("button").click(function(){
        console.log('test');
        const url = $(this).data('url');
        window.location.href = url;
    });
        }
   }


</script>

@endpush