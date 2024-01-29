@extends('layouts.admin') @section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <strong>No. Faktur {{ $data->no_faktur }}</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{$data->tanggal}}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label for="waktu" class="col-sm-2 col-form-label">Waktu</label>
                            <input type="time" class="form-control" id="waktu" name="waktu" value="{{$data->waktu}}"
                                disabled />
                        </div>
                    </div>
                    <div class="border-bottom text-center">
                        <strong>INFORMASI KONSUMEN</strong>
                    </div>
                    <br />
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="namaKonsumen" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="namaKonsumen" required autocomplete="off"
                                name="nama_pelanggan" value="{{$data->nama_pelanggan}}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label for="namaPerusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="namaPerusahaan" required autocomplete="off"
                                name="nama_perusahaan" value="{{$data->nama_perusahaan}}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="telponKonsumen" class="form-label">Telpon</label>
                            <input type="text" class="form-control" id="telponKonsumen" required autocomplete="off"
                                name="telepon_pelanggan" value="{{$data->telepon_pelanggan}}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label for="telponSeluler" class="form-label">Telpon Seluler</label>
                            <input type="text" class="form-control" id="telponSeluler" required autocomplete="off"
                                name="telepon_seluler" value="{{$data->telepon_seluler}}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="emailKonsumen" class="form-label">Email</label>
                            <input type="text" class="form-control" id="emailKonsumen" required autocomplete="off"
                                name="email_pelanggan" value="{{$data->email_pelanggan}}" disabled />
                        </div>
                        <div class="col-md-6">
                            <label for="alamatKonsumen" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamatKonsumen" required autocomplete="off"
                                name="alamat_pelanggan" value="{{$data->alamat_pelanggan}}" disabled />
                        </div>
                    </div>
                    <div class="border-bottom text-center">
                        <strong>INFORMASI BARANG</strong>
                    </div>
                    <br />
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="spesifikasiBarang" class="form-label">Spesifikasi</label>
                                <textarea class="form-control" id="spesifikasiBarang" rows="4" name="item"
                                    disabled>{{$data->item}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kelengkapanBarang" class="form-label">Kelengkapan</label>
                                <textarea class="form-control" id="kelengkapanBarang" rows="4" name="kelengkapan"
                                    disabled>{{$data->kelengkapan}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="mb-3">
                                <label for="keluhanBarang" class="form-label">Keluhan</label>
                                <textarea class="form-control" id="keluhanBarang" rows="5" name="keluhan"
                                    disabled>{{$data->keluhan}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <form action="{{route('tanda-terima.update',$data->id)}}" method="post"
                            id="formSaveTransaction">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="keteranganService" class="form-label">Keterangan Servis</label>
                                            <textarea class="form-control" id="keteranganService" rows="5"
                                                name="keterangan_service" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="container mb-3 wraper-search">
                                    <div class="form-group">
                                        <label for="searchInput">Cari Sparepart:</label>
                                        <input type="text" class="form-control" id="searchInput" autocomplete="off">
                                    </div>
                                    <div id="autocompleteResults" class="list-group"></div>
                                </div>
                                <div style="overflow-x: hidden; overflow-y: auto; max-height: 345px;">
                                    <table class="table table-striped table-hover" id="tableSparepart">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Sparepart</th>
                                                <th scope="col">Nama Sparepart</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Subtotal</th>
                                                <th scope="col">-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" class="text-end">Total</td>
                                                <td>Rp 0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="cetakFaktur" checked
                                        name="cetak_faktur" value="1">
                                    <label class="form-check-label" for="cetakFaktur">
                                        Cetak Invoice
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="tidakCetakFaktur"
                                        name="cetak_faktur" value="0">
                                    <label class="form-check-label" for="tidakCetakFaktur">
                                        Tidak Cetak Invoice
                                    </label>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-danger w-100"
                                            id="cancelTransaction">Batalkan Transaksi</button>
                                    </div>
                                    <div class="col">

                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="item_sparepart" id="itemSparepart">
                                        <input type="hidden" name="total" id="total">
                                        <button type="submit" class="btn btn-success w-100">Simpan Transaksi</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection @push('scripts')
<script type="module">
    $(document).ready(function() {
        // Data contoh untuk autocomplete
        var dataSuggestion = {!!$sparePart!!};
        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                $('#autocompleteResults').hide();
            }
        });


        // Fungsi untuk menampilkan hasil autocomplete
        function showAutocompleteResults(results) {

            var resultList = $('#autocompleteResults');
            resultList.empty();

            for (var i = 0; i < results.length; i++) {
                if (results[i].stok_barang == 0) {

                    resultList.append(`<a  class="list-group-item list-group-item-action bg-secondary" disabled>${results[i].kode_barang} - ${results[i].nama_barang} | <span class="bg-danger text-white p-1"><strong>Stok Kosong</strong></span></a>`);
                } else {
                    resultList.append(`<a  class="list-group-item list-group-item-action" data-kode_barang="${results[i].kode_barang}" data-nama_barang="${results[i].nama_barang}" data-stok_barang="${results[i].stok_barang}" data-harga_barang="${results[i].harga_barang}" data-satuan_barang="${results[i].satuan_barang}">${results[i].kode_barang} - ${results[i].nama_barang} | <span class="p-1">Stok : <strong>${results[i].stok_barang}</strong></span></a></a>`);
                }
            }
            resultList.show();
        }

        $('#searchInput').on('click', function() {

            showAutocompleteResults(dataSuggestion);

        });

        // Fungsi untuk melakukan pencarian autocomplete
        $('#searchInput').on('input', function() {
            var inputText = $(this).val().toLowerCase();
            var results = [];

            if (inputText.length > 0) {
                results = dataSuggestion.filter(function(item) {
                    return item.kode_barang.toLowerCase().includes(inputText) || item.nama_barang.toLowerCase().includes(inputText);
                });
            }

            showAutocompleteResults(results);
        });


        $('#autocompleteResults').on('click', 'a', function() {
            if ($(this).attr('disabled') == 'disabled') {
                return false;
            }
            var selectedValue = $(this).text();
            var kode_barang = $(this).data('kode_barang');
            var nama_barang = $(this).data('nama_barang');
            var stok_barang = $(this).data('stok_barang');
            var harga_barang = $(this).data('harga_barang');
            var satuan_barang = $(this).data('satuan_barang');
            dataSuggestion = dataSuggestion.filter(function(item) {
                return item.kode_barang != kode_barang;

            });

            // Menambahkan item ke tabel
            var table = $('#tableSparepart tbody');
            var row = `
     <tr>
       <td>${table.children().length + 1}</td>
       <td class="text-center">${kode_barang}</td>
       <td class="text-center"> ${nama_barang}</td>
       <td><input type="number" class="form-control qty"  min="1" max="${stok_barang}" value="1"></td>
       <td>${harga_barang}</td>
       <td>${harga_barang}</td>
       <td><button type="button" class="btn btn-danger btn-sm btn-delete"><i class="bi bi-x-circle"></i></button></td>
     </tr>
   `;
            row = $(row);
            table.append(row);
            var itemSparepart = [{
                kode_barang: kode_barang,
                nama_barang: nama_barang,
                qty: 1,
                harga_barang: harga_barang,
                satuan_barang: satuan_barang,
                subtotal: harga_barang,
            }];
            if ($('#itemSparepart').val() != '') {
                var itemValue = $('#itemSparepart').val();
                var item = JSON.parse(itemValue);
                item.push({
                    kode_barang: kode_barang,
                    nama_barang: nama_barang,
                    qty: 1,
                    harga_barang: harga_barang,
                    satuan_barang: satuan_barang,
                    subtotal: harga_barang,
                });
                $('#itemSparepart').val(JSON.stringify(item));
            } else {
                $('#itemSparepart').val(JSON.stringify(itemSparepart));
            }


            $('#searchInput').val('');
            calculateTotal();
            showAutocompleteResults([]);
        });

        $('#tableSparepart').on('change', '.qty', function() {
            var qty = $(this).val();
            var max = $(this).attr('max');
            if (qty > max) {
                $(this).val(max);
                qty = max;
            }
            var kode_barang = $(this).closest('tr').find('td:nth-child(2)').text();
            const itemValue = $('#itemSparepart').val();
            const item = JSON.parse(itemValue);

            $('#itemSparepart').val(JSON.stringify(item));
            var price = $(this).closest('tr').find('td:nth-child(5)').text().replace(/[^\d.-]+/g, '').replace('.', '');
            var subtotal = qty * price;
            for (var i = 0; i < item.length; i++) {
                if (item[i].kode_barang == kode_barang) {
                    item[i].qty = qty;
                    item[i].subtotal = formatRupiah(subtotal);
                }
            }
            $('#itemSparepart').val(JSON.stringify(item));
            $(this).closest('tr').find('td:nth-child(6)').text(formatRupiah(subtotal));
            calculateTotal();
        });

        function calculateTotal() {
            var total = 0;
            $('#tableSparepart tbody tr').each(function() {
                var subtotal = $(this).find('td:nth-child(6)').text().replace(/[^\d.-]+/g, '').replace('.', '');
                total += parseInt(subtotal);
            });

            $('#tableSparepart tfoot tr td:nth-child(2)').text(formatRupiah(total));
            $('#total').val(formatRupiah(total));
            console.log($('#itemSparepart').val());
        }

        function formatRupiah(val) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(val);
        }

        $('#tableSparepart').on('click', '.btn-delete', function() {
            var row = $(this).closest('tr');
            var kode_barang = row.find('td:nth-child(2)').text();
            var nama_barang = row.find('td:nth-child(3)').text();
            var stok_barang = row.find('td:nth-child(4)').find('input').attr('max');
            var harga_barang = row.find('td:nth-child(5)').text();
            var satuan_barang = row.find('td:nth-child(6)').text();
            var qty = row.find('td:nth-child(7)').text();
            var subtotal = row.find('td:nth-child(8)').text();
            var item = {
                kode_barang: kode_barang,
                nama_barang: nama_barang,
                stok_barang: stok_barang,
                harga_barang: harga_barang,
                satuan_barang: satuan_barang,
            };
            var itemValue = $('#itemSparepart').val();
            var itemSparepart = JSON.parse(itemValue);
            for (var i = 0; i < itemSparepart.length; i++) {
                if (itemSparepart[i].kode_barang == kode_barang) {
                    itemSparepart.splice(i, 1);
                }
            }
            $('#itemSparepart').val(JSON.stringify(itemSparepart));

            dataSuggestion.push(item);
            row.remove();
            calculateTotal();

        });

        $('#cancelTransaction').on('click', function() {
            $('#tableSparepart tbody').empty();
            $('#tableSparepart tfoot tr td:nth-child(2)').text('Rp 0');
            $('#itemSparepart').val('');
            $('#total').val('');


            var inputCancel = '<input type="hidden" name="cancel" value="1">';
            $('#formSaveTransaction').append(inputCancel);
        });


    });
</script>
@endpush