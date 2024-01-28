@extends('layouts.admin') @section('content')
<div class="container-lg px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header" id="titleCard">
                    Input Data Sparepart
                </div>
                <div class="card-body">
                    <div class="container">
                        <form class="row g-3" action="{{ route('stok-barang.store') }}" method="post"
                            id="formStockBarang">
                            @csrf
                            <div class="col-md-6">
                                <label for="kodeBarang" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" id="kodeBarang" required
                                    style="text-transform:uppercase" name="kode_barang" value="{{ old('kode_barang') }}"
                                    autocomplete="off">
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
                                    style="text-transform:uppercase" name="nama_barang" value="{{ old('nama_barang') }}"
                                    autocomplete="off">
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
                                <label for="stokBarang" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stokBarang" required
                                    style="text-transform:uppercase" name="stok_barang" value="{{old('stok_barang')}}"
                                    autocomplete="off">
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
                                    style="text-transform:uppercase" value="{{old('satuan_barang')}}">
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
                                <input type="text" class="form-control" id="hargaBarang" required name="harga_barang"
                                    value="{{old('harga_barang')}}" autocomplete="off">
                                <div class="invalid-feedback">
                                    {{ $errors->first('harga_barang') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" id="btnCreate">Simpan</button>
                                <button class="btn btn-warning w-100 mb-2" type="submit" id="btnUpdate">Update</button>
                                <button class="btn btn-danger w-100" type="button" id="btnCancel">Cancel</button>
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
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Hapus Data Sparepart ?</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="word-wrap: break-word;">
                <p id="textSparepart">Apakah anda yakin ingin menghapus data Sparepart <span></span> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <form action="" method="post" id="formDelete">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@push("scripts")

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script type="module">
    $(document).ready(async function() {
        $(".dt-buttons").hide();
        $("#btnUpdate").hide();
        $("#btnCancel").hide();

        $('#hargaBarang').on('keyup',async function() {
            const harga = $(this).val().replace(/\D/g, "");
             const hargaFormat =await new Intl.NumberFormat('id-ID', {
                 style: 'currency',
                 currency: 'IDR',
                 minimumFractionDigits: 0
             }).format(harga);
          
             $(this).val(hargaFormat);
    
        });


        $('#stokbarang-table').DataTable().on('draw', function() {
         const tooltipTriggerList = document.querySelectorAll('[data-coreui-toggle="tooltip"]')
         const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new coreui.Tooltip(tooltipTriggerEl))
        });
   
        const urlUpdate = "{{ route('stok-barang.update', ':id') }}";
        const urlDelete = "{{ route('stok-barang.destroy', ':id') }}";
        $('#stokbarang-table').on('click', '.btn-edit', function() {
           $('#titleCard').text('Update Data Sparepart');
           const kode = $(this).data('kode_barang');
           const nama = $(this).data('nama_barang');
           const stok = $(this).data('stok_barang');
           const satuan = $(this).data('satuan_barang');
           const harga = $(this).data('harga_barang');
            const id = $(this).data('id');
            const url = urlUpdate.replace(':id', id);
            $('#formStockBarang').attr('action', url);
            $('#formStockBarang').append('<input type="hidden" name="_method" value="PUT">');
            $('#kodeBarang').val(kode);
            $('#kodeBarang').attr('disabled', true);
            $('#namaBarang').val(nama);
            $('#stokBarang').val(stok);
            $('#satuanBarang').val(satuan);
            $('#hargaBarang').val(harga);
            $('#btnCreate').hide();
            $('#btnUpdate').show();
            $('#btnCancel').show();

        });
        $('#stokbarang-table').on('click', '.btn-delete', function() {
            const id = $(this).data('id');
            const kode = $(this).data('kode_barang');
            const nama = $(this).data('nama_barang');
            const url = urlDelete.replace(':id', id);
            $('#formDelete').attr('action', url);
            $('#textSparepart span').text(kode + ' - ' + nama);
            $('#modalDelete').modal('show');
           
        });

        
    
        $('#btnCancel').click(function() {
            $('#titleCard').text('Input Data Sparepart');
            $('#formStockBarang').attr('action', "{{ route('stok-barang.store') }}");
            $('#formStockBarang').attr('method', 'post');
            $('#formStockBarang').find('input[name="_method"]').remove();
            $('#kodeBarang').append('<input type="hidden" name="_method" value="POST">');
            $('#kodeBarang').attr('disabled', false);
            $('#kodeBarang').val('');
            $('#namaBarang').val('');
            $('#stokBarang').val('');
            $('#satuanBarang').val('');
            $('#hargaBarang').val('');
            $('#btnCreate').show();
            $('#btnUpdate').hide();
            $('#btnCancel').hide();


        });
        
    });
</script>

@endpush