<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
  <style>
    .wraper-search {
      position: relative !important;
    }

    #autocompleteResults {
      position: absolute;
      width: 100%;
      max-height: 350px;
      overflow-y: auto;
      z-index: 9999;
      display: none;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #autocompleteResults a {
      cursor: pointer;
      display: block;
      padding: 10px;
      color: #333;
    }

    #autocompleteResults.show {
      display: block;
    }
  </style>
  @stack('styles')

</head>

<body>
  <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
      <div class="sidebar-brand">
      </div>
      <button class="btn-close d-lg-none" type="button" data-coreui-dismiss="offcanvas" data-coreui-theme="dark"
        aria-label="Close"
        onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item"><a class="nav-link " href="{{route('home')}}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
          </svg> Dashboard</a>
      </li>
      <li class="nav-title">Faktur</li>
      @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Kasir' || Auth::user()->role == 'User')
      <li class="nav-item"><a class="nav-link" href="{{route('tanda-terima.create')}}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg>Buat Tanda Terima</a></li>
      @endif
      <li class="nav-item"><a class="nav-link" href="{{route('tanda-terima.index')}}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg> Tanda Terima</a></li>
      {{-- <li class="nav-item"><a class="nav-link" href="typography.html">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg>Invoice</a></li> --}}
      @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Kasir')
      <li class="nav-title">Barang</li>
      <li class="nav-item"><a class="nav-link" href="{{route('stok-barang.index')}}"><i
            class="bi bi-projector-fill m-2"></i>
          Stok Barang</a></li>
      </li>
      @endif
      @if (Auth::user()->role == 'Admin')
      <li class="nav-title">Laporan Penjualan</li>
      <li class="nav-item"><a class="nav-link" href="{{route('laporan')}}"><i class="bi bi-receipt m-2"></i>Laporan</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="{{route('laporan-by-barang')}}"><i
            class="bi bi-receipt m-2"></i>Laporan by
          Barang</a></li>
      <li class="nav-item"><a class="nav-link" href="{{route('laporan-by-toko')}}"><i class="bi bi-receipt m-2"></i>
          Laporan by
          Toko</a></li>
      <li class="nav-item"><a class="nav-link" href="{{route('laporan-by-user')}}"><i class="bi bi-receipt m-2"></i>
          Laporan by
          Sales</a></li>
      <li class="nav-item"><a class="nav-link" href="{{route('laporan-by-pelanggan')}}"><i
            class="bi bi-receipt m-2"></i> Laporan by
          Pelanggan</a></li>
      @endif
      @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Kasir')
      <li class="nav-title">Pengaturan</li>
      @if (Auth::user()->role == 'Admin')
      <li class="nav-item"><a class="nav-link" href="{{route('manajemen-user.index')}}"><i
            class="bi bi-people m-2"></i>User</a></li>
      @endif
      <li class="nav-item"><a class="nav-link" href="{{route('toko.create')}}"><i class="bi bi-shop m-2"></i>Toko</a>
      </li>
      @endif
    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
  </div>
  <div class="wrapper d-flex flex-column min-vh-100">
    <header class="header header-sticky p-0 mb-4">
      <div class="container-fluid border-bottom px-4">
        <button class="header-toggler" type="button"
          onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
          style="margin-inline-start: -14px;">
          <svg class="icon icon-lg">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
          </svg>
        </button>
        <ul class="header-nav">
          <li class="nav-item dropdown">
            <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button"
              aria-expanded="false" data-coreui-toggle="dropdown">
              <svg class="icon icon-lg theme-icon-active">
                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-contrast') }}"></use>
              </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
              <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="light">
                  <svg class="icon icon-lg me-3">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-sun') }}"></use>
                  </svg>Light
                </button>
              </li>
              <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="dark">
                  <svg class="icon icon-lg me-3">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-moon') }}"></use>
                  </svg>Dark
                </button>
              </li>
              <li>
                <button class="dropdown-item d-flex align-items-center active" type="button"
                  data-coreui-theme-value="auto">
                  <svg class="icon icon-lg me-3">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-contrast') }}"></use>
                  </svg>Auto
                </button>
              </li>
            </ul>
          </li>
          <li class="nav-item py-1">
            <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button"
              aria-expanded="false" data-coreui-toggle="dropdown">
              {{ Auth::user()->username }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{route('change-password')}}">
                  <svg class="icon icon-lg me-3">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                  </svg>Ubah Password
                </a>
              </li>
              <li>
                <form action="{{route('logout')}}" method="post">
                  @csrf
                  <button class="dropdown-item d-flex align-items-center" type="submit">
                    <svg class="icon icon-lg me-3">
                      <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
                    </svg>Logout
                  </button>
                </form>
              </li>

            </ul>
          </li>
        </ul>
      </div>

    </header>

    <div class="body flex-grow-1">
      {{-- show error --}}
      <div class="d-flex justify-content-center mx-auto w-100"
        style="position: absolute; top: 20; left: 0; right: 0; z-index: 9999;" id="alert">
        @if (Session::has('error'))
        <div class="alert alert-danger w-100" role="alert">
          {{Session::get('error')}}
        </div>
        @endif
        {{-- show success --}}
        @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
          {{Session::get('success')}}
        </div>
        @endif
      </div>
      @yield('content')
    </div>
  </div>






  <script src="{{asset('vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
  <script src="{{asset('vendors/simplebar/js/simplebar.min.js')}}"></script>
  <script>
    const header = document.querySelector("header.header");
            document.addEventListener("scroll", () => {
                if (header) {
                    header.classList.toggle(
                        "shadow-sm",
                        document.documentElement.scrollTop > 0
                    );
                }
            });  
  </script>
  <script type="module">
    $(document).ready(function () {
      $(".alert").delay(3000).fadeOut(500);
    });
  </script>
  @stack('scripts')
</body>

</html>