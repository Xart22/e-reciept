<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2023 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config("app.name", "Laravel") }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendors/simplebar.css') }}" />
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/color-modes.js') }}"></script>

    <link href="{{ asset('vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col p-4 mb-0">
                            <div class="card-body">
                                <h1>Login</h1>
                                <p class="text-medium-emphasis">
                                    Sign In to your account
                                </p>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <svg class="icon">
                                                <use
                                                    xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}">
                                                </use>
                                            </svg></span>
                                        <input class="form-control" type="text" placeholder="Username"
                                            name="username" />
                                        @if ($errors->has('username'))
                                        <script>
                                            const namaToko = document.getElementById('username');
                                        namaToko.classList.add('is-invalid');
                                        </script>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('username') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">
                                            <svg class="icon">
                                                <use xlink:href="{{
                                                asset('vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use>
                                            </svg></span>
                                        <input class="form-control" type="password" placeholder="Password"
                                            name="password" />
                                        @if ($errors->has('password'))
                                        <script>
                                            const namaToko = document.getElementById('password');
                                    namaToko.classList.add('is-invalid');
                                        </script>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-primary px-4 w-100" type="submit">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                    @if(@$errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{asset('vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
    <script src="{{asset('vendors/simplebar/js/simplebar.min.js')}}"></script>
    <script></script>
</body>

</html>