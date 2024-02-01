@extends('layouts.admin') @section('content')
<div class="container-lg px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header" id="titleCard">
                    Ubah Password
                </div>
                <div class="card-body">
                    <div class="container">
                        <form class="row g-3" action="{{ route('change-password') }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <label for="old_password" class="form-label">Password Lama </label>
                                <input type="password" class="form-control" id="old_password" required
                                    name="old_password">
                            </div>
                            <div class="col-md-6">
                                <label for="new_password" class="form-label">Password Baru </label>
                                <input type="password" class="form-control" id="new_password" required
                                    name="new_password">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" id="btnCreate">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push("scripts")



@endpush