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
            body {
                zoom: 80%;
            }
        }
    </style>
</head>

<body>
    <div class="px-3 container">
        <img src="{{ asset('assets/img/$data->logo_toko') }}" width="500px" alt="">
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
                    <div class="text-wrap" style="width: 50vw">
                        1. Saya telah membaca dan menyetujui aturan dan syarat yang
                        berlaku di Prima Tech <br>
                        2. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        3. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        4. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        5. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        6. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        7. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        <br><br>
                        <p class="text-center">DITERIMA OLEH</p>
                        <br><br><br><br> <br>
                        <p class="text-center">(&nbsp;&nbsp;&nbsp; <span>sadsadsa</span> &nbsp;&nbsp;&nbsp;)
                    </div>
                </td>
                <td class="py-1 px-2">
                    <div class="text-wrap">
                        1. Saya telah membaca dan menyetujui aturan dan syarat yang
                        berlaku di Prima Tech <br>
                        2. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        3. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        4. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        5. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        6. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        7. sadsadasdsadetgaraewraeraeresgrghrd<br>
                        <br><br>
                        <p class="text-center">TANDA TANGAN KONSUMEN</p>
                        <br><br><br><br> <br>
                        <p class="text-center">(&nbsp;&nbsp;&nbsp; <span>sadsadsa</span> &nbsp;&nbsp;&nbsp;)
                        </p>
                    </div>
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
            //window.print()
            document.querySelector('#cetak').addEventListener('click', () => {
                window.print()
            });
            document.querySelector('#back').addEventListener('click', () => {
                let url = "{{ route('tanda-terima.create') }}";

                window.location.href = url;

            });

        })
    </script>
</body>




</html>