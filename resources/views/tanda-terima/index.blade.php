@extends('layouts.admin') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>Data Service</div>
                        <div><button class="btn btn-sm btn-dark" onclick="window.location.reload();"
                                data-coreui-toggle="tooltip" data-coreui-placement="top"
                                data-coreui-custom-class="custom-tooltip" data-coreui-title="Refesh"><i
                                    class="bi bi-arrow-clockwise"></i></button></div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow: auto;max-height: 80vh;padding: 10px;">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Hapus Data Faktur ?</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="word-wrap: break-word;">
                <p id="textSparepart">Apakah anda yakin ingin menghapus data Faktur <span></span> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <form action="" method="post" id="formDelete">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

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
         const urlDetail = "{{ route('tanda-terima.show', ':id') }}";

        $('.btn-update').click(function() {
            const id = $(this).data('id');
            const url = urlUpdate.replace(':id', id);
            window.location = url;
        });
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
        if (!isElectronApp) {
            $(".btn-print").click(function() {
             const id = $(this).data('id');
             const url = urlCetak.replace(':id', id);
             window.location = url;
         });
        }
 
        $('.btn-delete').on('click', function() {
            const id = $(this).data('id');
            const no_faktur = $(this).data('id-faktur');
            const url = urlDelete.replace(':id', id);
            $('#formDelete').attr('action', url);
            $('#textSparepart span').text(no_faktur);
            $('#modalDelete').modal('show');
        });

          $('.btn-detail').on('click', function() {
            const id = $(this).data('id');
             const url = urlDetail.replace(':id', id);
             window.location = url;
        });
    });

    

   });
</script>

@endpush