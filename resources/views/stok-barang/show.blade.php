@extends('layouts.admin') @section('content')
<div class="container-lg px-4">
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header" id="titleCard">
                    Data Barang
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            @csrf
                            <div class="col-md-6">
                                <label for="kodeBarang" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" id="kodeBarang" required
                                    style="text-transform:uppercase" name="kode_barang"
                                    value="{{ $stokBarang->kode_barang }}" autocomplete="off" readonly disabled>
                                @if ($errors->has('kode_barang'))
                                <script>
                                    const kodeBarang = document.getElementById('kodeBarang');
                                    kodeBarang.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('kode_barang') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="namaBarang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="namaBarang" required
                                    style="text-transform:uppercase" name="nama_barang"
                                    value="{{ $stokBarang->nama_barang }}" autocomplete="off" readonly disabled>
                                @if ($errors->has('nama_barang'))
                                <script>
                                    const kodeBarang = document.getElementById('namaBarang');
                                    kodeBarang.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('namaBarang') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="stokBarang" class="form-label">Stok Saat ini</label>
                                <input type="number" class="form-control" id="stokBarang" required
                                    style="text-transform:uppercase" name="stok_barang"
                                    value="{{$stokBarang->stok_barang}}" autocomplete="off" readonly disabled>
                                @if ($errors->has('stok_barang'))
                                <script>
                                    const kodeBarang = document.getElementById('stok_barang');
                                    kodeBarang.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('stok_barang') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="satuanBarang" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuanBarang" required name="satuan_barang"
                                    style="text-transform:uppercase" value="{{$stokBarang->satuan_barang}}" readonly
                                    disabled>
                                @if ($errors->has('satuan_barang'))
                                <script>
                                    const kodeBarang = document.getElementById('satuan_barang');
                                    kodeBarang.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('satuan_barang') }}
                                </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="hargaBarang" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="hargaBarang" required
                                        name="harga_barang" value="{{$stokBarang->harga_barang}}" autocomplete="off"
                                        readonly disabled>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('harga_barang') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header" id="titleCard">
                    History Barang
                </div>
                <div class="card-body">
                    <div class="container">
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
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">In</th>
                                        <th scope="col">Out</th>
                                        <th scope="col">Qty</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                </tbody>
                            </table>
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
    const url = "{{ route('get-stock-barang') }}";
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
        const kodeBarang = $('#kodeBarang').val();
        const data = {
            from,
            to,
            kodeBarang
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
        console.log(result);
        if(result.length > 0){
            $('#table-body').empty();
            result.forEach((item, index) => {
                $('#table-body').append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.tanggal}</td>
                        <td>${item.vendor == null ? '-' : item.vendor}</td>
                        <td>${item.keterangan}</td>
                        <td>${item.in == null ? '0' : item.in}</td>
                        <td>${item.out == null ? '0' : item.out}</td>
                        <td>${item.saldo}</td>
                    </tr>
                `);
            });
        }else{
            $('#table-body').empty();
            $('#table-body').append(`
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            `);
        }

   }

</script>

@endpush