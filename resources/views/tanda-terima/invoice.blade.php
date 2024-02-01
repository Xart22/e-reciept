<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Document</title>
    <style>
        h1 {
            color: black;
            font-family: Tahoma, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 40pt;
            float: right;
            padding-right: 50px;
            padding-top: calc(200px - 130pt);
        }

        p {
            color: black;
            font-family: Tahoma, sans-serif;
            font-style: normal;
            text-decoration: none;
        }

        #wraper {
            background-color: white;
            /* width A4 */
            width: 21cm;
            height: 29.7cm;
            border: 1px solid black;
            color: black;
            font-family: Tahoma, sans-serif;
            font-style: normal;
            text-decoration: none;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }

        @media print {
            #wraper-btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="wraper" class="p-3">
        {{-- Send url to electron --}}
        <input type="hidden" id="check-url-print" value=" {{ url()->current() }}">
        <div class="d-flex justify-content-between">
            <div class="col">
                <div class=" d-flex p-2" style="width: 200px; height: 120px;">
                    <div class="mx-auto">
                        <img src=" {{ asset('storage/img/' . $data->toko->logo_toko) }}" width="100px">
                        <p style="font-size: 10px">{{$data->toko->alamat_toko}} <br>Telp/Fax.
                            {{$data->toko->telepon_toko}}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <h1>
                    Invoice
                </h1>
            </div>
        </div>
        <br>
        <hr>
        <div class="row">
            <div class="col">
                <div class="row fw-bolder p-3">
                    <p>
                        Bill :
                    </p>
                    <div class=" p-2 rounded border-black border">
                        <p>
                            {{$data->nama_pelanggan}}
                            <br>
                            {{$data->nama_perusahaan}} <br>
                            {{$data->alamat_pelanggan}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col p-3">
                <br>
                <div class="row p-3">
                    <div class="col rounded border-black border">
                        <p>Invoice Date :</p>
                        <p class="fw-bolder">{{date('d M Y', strtotime($data->tanggal))}}</p>
                    </div>
                    <div class="col rounded border-black border">
                        <p>Invoice No :</p>
                        <p class="fw-bolder">{{$data->no_faktur}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pe-2">
            <div class="container rounded border-black border mb-3">
                Service {{$data->item}}
            </div>
        </div>

        <table style="border-collapse: collapse;" cellspacing="0">
            <tr style="height: 27pt">
                <td style="
                    width: 73pt;
                    border-top-style: solid;
                    border-top-width: 2px;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s1" style="
                        padding-top: 8pt;
                        padding-left: 17pt;
                        padding-right: 17pt;
                        text-indent: 0pt;
                        text-align: center;
                    ">
                        Item
                    </p>
                </td>
                <td style="
                    width: 156pt;
                    border-top-style: solid;
                    border-top-width: 2px;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s1" style="
                        padding-top: 8pt;
                        padding-left: 43pt;
                        text-indent: 0pt;
                        text-align: left;
                    ">
                        Item Description
                    </p>
                </td>
                <td style="
                    width: 58pt;
                    border-top-style: solid;
                    border-top-width: 2px;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s1" style="
                        padding-top: 8pt;
                        padding-left: 20pt;
                        padding-right: 20pt;
                        text-indent: 0pt;
                        text-align: center;
                    ">
                        Qty
                    </p>
                </td>
                <td style="
                    width: 99pt;
                    border-top-style: solid;
                    border-top-width: 2px;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s1" style="
                        padding-top: 8pt;
                        padding-left: 2px;
                        text-indent: 0pt;
                        text-align: left;
                    ">
                        Unit Price ( IDR )
                    </p>
                </td>
                <td style="
                    width: 173pt;
                    border-top-style: solid;
                    border-top-width: 2px;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s1" style="
                        padding-top: 8pt;
                        padding-left: 42px;
                        text-indent: 0pt;
                        text-align: left;
                    ">
                        Amount ( IDR )
                    </p>
                </td>
            </tr>
            @foreach ($data->sparepart as $item)
            <tr style="height: 12pt">
                <td style="
                    width: 73pt;
                    border-top-style: solid;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s2" style="
                        padding-left: 19pt;
                        padding-right: 17pt;
                        text-indent: 0pt;
                        text-align: center;
                    ">
                        {{$item->kode_barang}}
                    </p>
                </td>
                <td style="
                    width: 156pt;
                    border-top-style: solid;
          
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s2" style="
                        padding-left: 4pt;
                        text-indent: 0pt;
                        text-align: left;
                    ">
                        {{$item->nama_barang}}
                    </p>
                </td>
                <td style="
                    width: 58pt;
                    border-top-style: solid;
     
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s2" style="text-indent: 0pt; text-align: center">
                        {{$item->jumlah}}
                    </p>
                </td>
                <td style="
                    width: 99pt;
                    border-top-style: solid;

                    border-left-style: solid;
                    border-left-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s2" style="
                        padding-right: 2px;
                        text-indent: 0pt;
                        text-align: right;
                    ">
                        {{$item->harga}}
                    </p>
                </td>
                <td style="
                    width: 173pt;
                    border-top-style: solid;
   
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p class="s2" style="
                        padding-right: 2px;
                        text-indent: 0pt;
                        text-align: right;
                    ">
                        {{$item->subtotal}}
                    </p>
                </td>
            </tr>
            @endforeach

            <tr style="height: 10pt">
                <td style="
                    width: 73pt;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p style="text-indent: 0pt; text-align: left"><br /></p>
                </td>
                <td style="
                    width: 156pt;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p style="text-indent: 0pt; text-align: left"><br /></p>
                </td>
                <td style="
                    width: 58pt;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p style="text-indent: 0pt; text-align: left"><br /></p>
                </td>
                <td style="
                    width: 99pt;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p style="text-indent: 0pt; text-align: left"><br /></p>
                </td>
                <td style="
                    width: 173pt;
                    border-left-style: solid;
                    border-left-width: 2px;
                    border-bottom-style: solid;
                    border-bottom-width: 2px;
                    border-right-style: solid;
                    border-right-width: 2px;
                ">
                    <p style="text-indent: 0pt; text-align: left"><br /></p>
                </td>
            </tr>
        </table>
        <br>
        <div class="row">
            <div class="col">
                <div class="rounded border-black border p-2">
                    <span class="fw-bolder">Say :
                        @php
                        $total = preg_match_all('/\d+/', $data->total_harga, $matches);
                        $total = implode('', $matches[0]);
                        @endphp
                    </span><span class="text-capitalize">{{
                        Riskihajar\Terbilang\Facades\Terbilang::make($total)}}
                        Rupiah</span>
                </div>
            </div>
            <div class="col">
                <div class="col rounded border-black border p-2">
                    <div class="d-flex justify-content-between">
                        <div class="fw-bolder">Sub total :</div>
                        <div class="fw-bolder">{{$data->total_harga}}</div>
                    </div>
                </div>
                <div class="col rounded border-black border p-2">
                    <div class="d-flex justify-content-between">
                        <div class="fw-bolder">Discount :</div>
                        <div class="fw-bolder">0</div>
                    </div>
                </div>
                <div class="col rounded border-black border p-2">
                    <div class="d-flex justify-content-between">
                        <div class="fw-bolder">Total Invoice :</div>
                        <div class="fw-bolder">{{$data->total_harga}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class=" text-center">Received By</p>
                <br><br><br>
                <hr>
                <p>Date.</p>
            </div>
            <div class="col">
                <p class=" text-center">Prepared By</p>
                <br><br><br>
                <hr>
                <p>Date.</p>
            </div>
        </div>
    </div>
    <div class="container mt-3 mb-3" id="wraper-btn">
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
            const back = $('#back');
            const cetak = $('#cetak');
            const url ="{{ route('tanda-terima.index') }}";

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
            //window.print()
            cetak.on('click', () => {
                window.print();
            });
            back.on('click', () => {
                window.location.href = url;
            });
        }
        })
    </script>
</body>




</html>