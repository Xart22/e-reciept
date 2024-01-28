@extends('layouts.admin') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    Data Stok Sparepart
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("scripts")

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script type="module">
    $(document).ready(function () {
    
    $('#penjualanmodel-table').DataTable().on('draw', function() {
         const tooltipTriggerList = document.querySelectorAll('[data-coreui-toggle="tooltip"]')
         const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new coreui.Tooltip(tooltipTriggerEl))
         const urlUpdate = "{{ route('tanda-terima.edit', ':id') }}";
         const urlDelete = "{{ route('tanda-terima.destroy', ':id') }}";
         const urlCetak = "{{ route('tanda-terima.cetak', ':id') }}";

        $('.btn-update').click(function() {
            const id = $(this).data('id');
            const url = urlUpdate.replace(':id', id);
            window.location = url;
        });
        $(".btn-print").click(function() {
            const id = $(this).data('id');
            const url = urlCetak.replace(':id', id);
            window.location = url;
        });
    });

    

   });
</script>

@endpush