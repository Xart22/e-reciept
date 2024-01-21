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
                        <form class="row g-3 needs-validation" novalidate>
                            <div class="col-md-6">
                                <label for="kodeBarangValidation" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" id="kodeBarangValidation" required>
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="namaBarangValidation" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="namaBarangValidation" required>
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="stokValidation" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stokValidation" required>
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="satuanValidation" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuanValidation" required>
                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="hargaValidation" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="hargaValidation" required>
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

@endpush