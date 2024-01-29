@extends('layouts.admin') @section('content')
<div class="container-lg px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header" id="titleCard">
                    Input Data Toko
                </div>
                <div class="card-body">
                    <div class="container">
                        <form class="row g-3" action="{{ route('toko.store') }}" method="post" enctype="multipart/form-data" id="formToko">
                            @csrf
                            <div class="col-md-6">
                                <label for="nama_toko" class="form-label">Nama Toko</label>
                                <input type="text" class="form-control" id="nama_toko" required name="nama_toko" value="{{ old('nama_toko') }}">
                                @if ($errors->has('nama_toko'))
                                <script>
                                    const namaToko = document.getElementById('nama_toko');
                                    namaToko.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama_toko') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="alamat_toko" class="form-label">Alamat Toko</label>
                                <input type="text" class="form-control" id="alamat_toko" required name="alamat_toko" value="{{ old('alamat_toko') }}">
                                @if ($errors->has('alamat_toko'))
                                <script>
                                    const kodeBarang = document.getElementById('alamat_toko');
                                    kodeBarang.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('alamat_toko') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="telepon_toko" class="form-label">Telepon Toko</label>
                                <input type="number" class="form-control" id="telepon_toko" required name="telepon_toko" value="{{old('telepon_toko')}}">
                                @if ($errors->has('telepon_toko'))
                                <script>
                                    const kodeBarang = document.getElementById('telepon_toko');
                                    kodeBarang.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('telepon_toko') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="email_toko" class="form-label">Email Toko</label>
                                <input type="email" class="form-control" id="email_toko" required name="email_toko" value="{{old('email_toko')}}">
                                @if ($errors->has('email_toko'))
                                <script>
                                    const kodeBarang = document.getElementById('email_toko');
                                    kodeBarang.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('email_toko') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <label for="logo_toko" class="form-label">Logo</label>
                                <input type="file" class="form-control" id="logo_toko" required name="logo_toko" value="{{old('logo_toko')}}" accept="image/*">
                            </div>
                            <div class="col-12">
                                <input class="form-check-input" type="checkbox" id="default_toko" name="default_toko" checked value="1">
                                <label class="form-check-label" for="default_toko">
                                    Toko utama
                                </label>
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
                <h5 class="modal-title" id="modalDeleteLabel">Hapus Data Toko ?</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="textToko">Apakah anda yakin ingin menghapus data toko <span></span> ?</p>
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
        $('#tokomodel-table').DataTable().on('draw', function() {
            const tooltipTriggerList = document.querySelectorAll('[data-coreui-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new coreui.Tooltip(tooltipTriggerEl))
            const urlUpdate = "{{ route('toko.update', ':id') }}";
            const urlDelete = "{{ route('toko.destroy', ':id') }}";

            $('.btn-edit').click(function() {

                const nama = $(this).data('nama');
                const alamat = $(this).data('alamat');
                const telepon = $(this).data('telpon');
                const email = $(this).data('email');
                const id = $(this).data('id');
                const url = urlUpdate.replace(':id', id);
                $('#nama_toko').val(nama);
                $('#alamat_toko').val(alamat);
                $('#telepon_toko').val(telepon);
                $('#email_toko').val(email);
                $('#formToko').attr('action', url);
                $('#titleCard').text('Edit Data Toko');
                $('#logo_toko').removeAttr('required');
                $('#formToko').append('<input type="hidden" name="_method" value="PUT">');
                $('#btnCreate').hide();
                $('#btnUpdate').show();
                $('#btnCancel').show();

            });
            $('.btn-delete').click(function() {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const url = urlDelete.replace(':id', id);
                $('#textToko').find('span').text(nama);
                $('#formDelete').attr('action', url);
                $('#modalDelete').modal('show');
            });
            $('#btnCancel').click(function() {
                window.location.reload();
            });
        });




    });
</script>

@endpush