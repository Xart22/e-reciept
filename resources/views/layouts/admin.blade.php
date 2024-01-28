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
</head>

<body>
  <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
      <div class="sidebar-brand">
        <svg class="sidebar-brand-full" width="88" height="32" alt="CoreUI Logo">
          <use xlink:href="{{ asset('assets/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
          <use xlink:href="{{ asset('assets/brand/coreui.svg#signet') }}"></use>
        </svg>
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
      <li class="nav-item"><a class="nav-link" href="{{route('tanda-terima.create')}}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg>Buat Tanda Terima</a></li>
      <li class="nav-item"><a class="nav-link" href="{{route('tanda-terima.index')}}">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg> Tanda Terima</a></li>
      {{-- <li class="nav-item"><a class="nav-link" href="typography.html">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg>Invoice</a></li> --}}
      @if (Auth::user()->role == 'Admin')
      <li class="nav-title">Sparepart</li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg>Sparepart</a>
        <ul class="nav-group-items compact">
          <li class="nav-item">
            <a class="nav-link" href="{{route('stok-barang.index')}}">
              <span class="nav-icon">
                <span class="nav-icon-bullet">
                </span>
              </span>
              Stok Sparepart
            </a>
          </li>
        </ul>
      </li>
      @endif
      <li class="nav-title">Laporan</li>
      <li class="nav-item"><a class="nav-link" href="base/accordion.html"><svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg>Laporan Penjualan</a></li>
      <li class="nav-title">Pengaturan</li>
      @if (Auth::user()->role == 'Admin')
      <li class="nav-item"><a class="nav-link" href="{{route('manajemen-user.index')}}"><svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg>User</a></li>
      @endif
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
          </svg>Toko</a>
        <ul class="nav-group-items compact">
          <li class="nav-item"><a class="nav-link" href="{{route('toko.create')}}"><span class="nav-icon"><span
                  class="nav-icon-bullet"></span></span>Buat Toko</a></li>
        </ul>
      </li>
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
          <li class="nav-item">
            <button class="nav-link px-2">
              {{Auth::user()->username}}
            </button>
          </li>
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
          <li class="nav-item">
            <form action="{{route('logout')}}" method="post">
              @csrf
              <button class="nav-link py-0 pe-0" type="submit">
                <div class="avatar avatar-md">
                  <svg class="icon me-2">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
                  </svg>
                </div>
              </button>
            </form>
          </li>
        </ul>
      </div>

    </header>
    <div class="body flex-grow-1">
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
  @stack('scripts')
</body>

</html>