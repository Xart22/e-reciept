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
    </style>
</head>

<body>
    <div class="px-3">
        <img src="{{ asset('assets/img/tes_logo.jpg') }}" width="500px" alt="">
        <p>Jl. Sapujagat No.9 Sukaluyu Bandung <br>Telp/Fax. 022-2502521</p>
        <hr>

        <h1 class="text-center fw-bolder">FORMULIR TANDA TERIMA SERVIS</h1>
        <br>
        <p class="fw-bolder">No. 15432454</p>

        <table>
            <tr>
                <td class="py-1 px-2" colspan="2">Tanggal : <br>22/11/202 3</td>
                <td class=" py-1 px-2" rowspan="1" style="width: 50%">Waktu : <br>19:20</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">INFORMASI KONSUMEN</td>
            </tr>
            <tr>
                <td class="py-1 px-2" colspan="2">Nama : <br>Ahmad</td>
                <td class="py-1 px-2" rowspan="1">Nama Perusahaan : <br>Itil</td>
            </tr>
            <tr>
                <td class="py-1 px-2">Telpon : <br>082218902325</td>
                <td class="py-1 px-2">Telpon : <br>082218902325</td>
                <td class="py-1 px-2">Alamat: <br>082218902325</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">INFORMASI BARANG</td>
            </tr>
            <tr>
                <td class="px-2 text-start" colspan="2">
                    <p>Spesifikasi : <br>Laptop Acer Nitro 5 515</p>
                    <p>Kelengkapan : <br>Tas,Laptop,Charger</p>
                </td>
                <td class="px-2 text-start" rowspan="1" style="height: 200px">Keluhan : <br>Lorem Ipsum is
                    simply dummy
                    text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                    text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                    type specimen book. It has survived not only five centuries, but also the leap into electronic
                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of
                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.</td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">ATURAN DAN SYARAT</td>
                <td class="text-center">IZIN KONSUMEN</td>
            </tr>
            <tr>
                <td class="py-1 px-2" colspan="2">
                    1. sadsadasdsadetgaraewraeraeresgrghrd<br>
                    2. sadsadasdsadetgaraewraeraeresgrghrd<br>
                    3. sadsadasdsadetgaraewraeraeresgrghrd<br>
                    4. sadsadasdsadetgaraewraeraeresgrghrd<br>
                    5. sadsadasdsadetgaraewraeraeresgrghrd<br>
                    6. sadsadasdsadetgaraewraeraeresgrghrd<br>
                    7. sadsadasdsadetgaraewraeraeresgrghrd<br>
                </td>
                <td class="py-1 px-2" rowspan="1">Saya
                    ajuwhduiawnjeaibngyuhigfrieujhbgniwyergftkbnhiujgq;bfdaujgsvfiuadsbfgghjkervfqgtyeuvfdlqyhvfgeqwufvewf
                </td>
            </tr>
        </table>
    </div>


</body>

</html>