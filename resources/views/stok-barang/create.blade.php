@extends('layouts.admin') @section('content')
<div class="container-lg px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    Input Data Sparepart
                </div>
                <div class="card-body">
                    <div class="container">
                        <form class="row g-3" action="{{ route('stok-barang.store') }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <label for="kodeBarang" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" id="kodeBarang" required style="text-transform:uppercase" name="kode_barang" value="{{ old('kode_barang') }}">
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
                                <input type="text" class="form-control" id="namaBarang" required style="text-transform:uppercase" name="nama_barang" value="{{ old('nama_barang') }}">
                                @if ($errors->has('kode_barang'))
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
                                <label for="stokBarang" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stokBarang" required style="text-transform:uppercase" name="stok_barang" value="{{old('stok_barang')}}">
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
                                <input type="text" class="form-control" id="satuanBarang" required name="satuan_barang" style="text-transform:uppercase" value="{{old('satuan_barang')}}">
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
                            <div class="col-12">
                                <label for="hargaBarang" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="hargaBarang" required name="harga_barang" value="{{old('harga_barang')}}">
                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <br />
                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("scripts")

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script type="module">
    $(document).ready(function() {
        $(".dt-buttons").hide();
    });
</script>

@endpush