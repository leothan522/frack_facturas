<div wire:ignore.self class="modal fade" id="modal-ver-factura">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h4 class="modal-title" wire:loading.class="invisible">
                    <span class="text-nowrap">Factura [ <b class="text-warning text-uppercase">{{ $facturaNumero }}</b> ]</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body embed-responsive embed-responsive-4by3" wire:loading.class="invisible">

                @if($verPDF)
                    <iframe class="embed-responsive-item" src="{{ asset('ViewerJS/#../storage/'.$verPDF) }}" allowfullscreen></iframe>
                @endif

            </div>

            <div class="modal-footer">

                <div class="row col-12 justify-content-between" wire:loading.class="invisible">

                    <div class="btn-group">

                        <button type="button" class="btn btn-primary" onclick="confirmToastBootstrap('delete')">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        @if($send)
                            <button type="button" class="btn btn-primary" onclick="confirmToastBootstrap('reeviarFactura',  'NoParametros', { type: 'warning', message: '¡Esta Factura ya fue enviada anteriormente!', button: '¡Sí, volver a enviar!' })">
                                <i class="fas fa-envelope-open"></i>
                            </button>
                        @else
                            <button type="button" class="btn btn-primary" wire:click="btnSendFactura">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        @endif

                    </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_ver_factura">
                        Cerrar
                    </button>

                </div>

            </div>

            {!! verSpinner() !!}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

