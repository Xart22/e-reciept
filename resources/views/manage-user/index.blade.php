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
                        <form class="row g-3" action="{{ route('manajemen-user.store') }}" method="post" id="formUser">
                            @csrf
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" required name="username"
                                    value="{{ old('username') }}" autocomplete="off">
                                @if ($errors->has('username'))
                                <script>
                                    const username = document.getElementById('username');
                                    username.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required name="password"
                                    value="{{ old('password') }}" autocomplete="off">
                                @if ($errors->has('password'))
                                <script>
                                    const kodeBarang = document.getElementById('password');
                                    kodeBarang.classList.add('is-invalid');
                                </script>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                                @endif
                            </div>
                            <div class="col">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="role" id="role">
                                    <option value="Admin" selected>Admin</option>
                                    <option value="Kasir">Kasir</option>
                                    <option value="Teknisi">Teknisi</option>
                                    <option value="User">User</option>
                                </select>
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
                <h5 class="modal-title" id="modalDeleteLabel">Hapus Data User ?</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="word-wrap: break-word;">
                <p id="textUser">Apakah anda yakin ingin menghapus user <span></span> ?</p>
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

        $('#user-table').DataTable().on('draw', function() {
         const tooltipTriggerList = document.querySelectorAll('[data-coreui-toggle="tooltip"]')
         const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new coreui.Tooltip(tooltipTriggerEl))
        });
   
        const urlUpdate = "{{ route('manajemen-user.update', ':id') }}";
        const urlDelete = "{{ route('manajemen-user.destroy', ':id') }}";
        $('#user-table').on('click', '.btn-edit', function() {
           $('#titleCard').text('Update Data User');
           const username = $(this).data('username');
            const id = $(this).data('id');
            const role = $(this).data('role');
            const url = urlUpdate.replace(':id', id);
            $('#formUser').attr('action', url);
            $('#formUser').append('<input type="hidden" name="_method" value="PUT">');
            $('#username').val(username);
            $('#role').find('option[value="'+role+'"]').attr('selected', true);
            $('#password').val('');
            $('#btnCreate').hide();
            $('#btnUpdate').show();
            $('#btnCancel').show();

        });
        $('#user-table').on('click', '.btn-delete', function() {
            const id = $(this).data('id');
            const username = $(this).data('username');
            const url = urlDelete.replace(':id', id);
            $('#formDelete').attr('action', url);
            $('#textUser span').text(username);
            $('#modalDelete').modal('show');
           
        });

        
    
        $('#btnCancel').click(function() {
            $('#titleCard').text('Input Data User');
            $('#formUser').attr('action', "{{ route('manajemen-user.store') }}");
            $('#formUser').attr('method', 'post');
            $('#formUser').find('input[name="_method"]').remove();
            $('#username').val('');
            $('#role').find('option[value="Admin"]').attr('selected', true);
            $('#password').val('');
            $('#btnCreate').show();
            $('#btnUpdate').hide();
            $('#btnCancel').hide();
        });
        
    });
</script>

@endpush