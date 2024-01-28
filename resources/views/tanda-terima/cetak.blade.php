<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            font-weight: 800;
        }

        @media print {
            .btn {
                display: none;

            }

            body {
                font-size: 12px;
                background-color: white;
            }
        }
    </style>
</head>

<body>
    <div id="wraper">
        {{-- Send url to electron --}}
        <input type="hidden" id="check-url-print" value=" {{ url()->current() }}">
        <img src="{{ asset('storage/img/' . $data->toko->logo_toko) }}" width="150px">
        <p>{{$data->toko->alamat_toko}} <br>Telp/Fax. {{$data->toko->telepon_toko}}</p>
        <hr>

        <h1 class="text-center fw-bolder">FORMULIR TANDA TERIMA SERVIS</h1>
        <br>
        <p class="fw-bolder">No. {{$data->no_faktur}}</p>

        <table>
            <tr>
                <td class="py-1 px-2" colspan="2">Tanggal : <br>{{$data->tanggal}}</td>
                <td class=" py-1 px-2" rowspan="1">Waktu : <br>{{$data->waktu}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">INFORMASI KONSUMEN</td>
            </tr>
            <tr>
                <td class="py-1 px-2" colspan="2">Nama : <br>{{$data->nama_pelanggan}}</td>
                <td class="py-1 px-2" rowspan="1">Nama Perusahaan : <br>{{$data->nama_perusahaan}}</td>
            </tr>
            <tr>
                <td class="py-1 px-2">Telpon : <br>{{$data->telepon_pelanggan}}</td>
                <td class="py-1 px-2">Telpon Seluler : <br>{{$data->telepon_seluler}}</td>
                <td class="py-1 px-2" rowspan="2">Alamat: <br>{{$data->alamat_pelanggan}}</td>
            </tr>
            <tr>
                <td colspan="2" class="py-1 px-2">Email: <br> {{$data->email_pelanggan}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">INFORMASI BARANG</td>
            </tr>
            <tr>
                <td class="px-2 text-start" colspan="2">
                    <p>Spesifikasi : <br>{{$data->item}}</p>
                    <p>Kelengkapan : <br>{{$data->kelengkapan}}</p>
                </td>
                <td class="px-2 text-start text-wrap" rowspan="1">Keluhan : <br>{{$data->keluhan}}</td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">ATURAN DAN SYARAT</td>
                <td class="text-center">IZIN KONSUMEN</td>
            </tr>
            <tr>
                <td class="py-1 px-2" colspan="2">
                    <div style="width: 50vw; height: 50%;">
                        1. {{$data->toko->nama_toko}} tidak bertanggung jawab atas segala resiko kehilangan atau
                        kerusakan data yang ada didalamnya.<br>
                        2. Untuk service diluar garansi, persetujuan konsumen dibutuhkan dalam waktu 3 hari kerja
                        setelah penawaran biaya perbaikan diberikan.<br>
                        3. Formulir Tanda Terima Service ini harus dibawa saat konsumen melakukan pengambilan barangnya,
                        {{$data->toko->nama_toko}} berhak untuk menolak pengambilan barang jika konsumen tidak bisa
                        menunjukan Formulir Tanda Terima Servicenya.<br>
                        4. Konsumen harus SEGERA menghubungi {{$data->toko->nama_toko}} jika kehilangan formulir ini,
                        {{$data->toko->nama_toko}} tidak bertanggung jawab jika ada pihak lain yang menggunakan Formulir
                        tersebut untuk mengambil barang yang telah diperbaiki.<br>
                        5. Jika barang yang telah diperbaiki tidak diambil dalam jangka waktu (3) bulan maka
                        {{$data->toko->nama_toko}} tidak bertanggung jawab terhadap resiko kehilangan atau kerusakan
                        barangnya.<br>
                    </div>
                    <br><br>
                    <div>
                        <p class="text-center">DITERIMA OLEH</p>
                        <br><br><br><br> <br>
                        <p class="text-center">(&nbsp;&nbsp;&nbsp; <span>{{$data->userCreate->username}}</span>
                            &nbsp;&nbsp;&nbsp;) </p>
                    </div>
                </td>
                <td class="py-1 px-2">
                    <div style="height: 50%;">
                        Saya memberikan izin kepada {{$data->toko->nama_toko}}, Untk memperbaiki barang dengan
                        Spesifikasi yang disebutkan diatas. Saya menyatakan bahwa semua informasi yang Saya berikan
                        adalah benar adanya. Saya menyetujui aturan dan syarat yang diberikan.

                    </div>
                    <br><br><br><br><br><br><br><br>
                    <p class=" text-center">TANDA TANGAN KONSUMEN</p>
                    <br><br><br><br> <br>
                    <p class="text-center">(&nbsp;&nbsp;&nbsp; <span>{{$data->nama_pelanggan}}</span>
                        &nbsp;&nbsp;&nbsp;)
                    </p>
                </td>
            </tr>
        </table>
    </div>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-success w-100" id="cetak">Cetak</button>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary w-100" id="back">Kembali</button>

            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {

         function isElectron() {
                // Renderer process
                if (typeof window !== 'undefined' && typeof window.process === 'object' && window.process.type === 'renderer') {
                    return true;
                }

                // Main process
                if (typeof process !== 'undefined' && typeof process.versions === 'object' && !!process.versions.electron) {
                    return true;
                }

                // Detect the user agent when the `nodeIntegration` option is set to true
                if (typeof navigator === 'object' && typeof navigator.userAgent === 'string' && navigator.userAgent.indexOf('Electron') >= 0) {
                    return true;
                }

                return false;
        }
        const isElectronApp = isElectron();
        if (isElectronApp) {
            
        } else {
            window.print()
            document.querySelector('#cetak').addEventListener('click', () => {
                window.print();

            });
            document.querySelector('#back').addEventListener('click', () => {
                let url = "{{ route('tanda-terima.create') }}";

                window.location.href = url;

            });
            window.addEventListener("afterprint", (event) => {
            window.close();
            });
        }
        })
    </script>
</body>




</html>