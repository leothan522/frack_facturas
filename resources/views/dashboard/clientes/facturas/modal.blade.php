<div wire:ignore.self class="modal fade" id="modal-facturas-cliente">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h4 class="modal-title" id="modal_facturas_cliente_header" wire:loading.class="invisible" wire:target.except="btnVerPDF">
                    {{ $title }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_cerrar_modal_facturas_cliente">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="modal_facturas_cliente_body" wire:loading.class="invisible" wire:target.except="btnVerPDF" style="height: 358px;">

                <div class="row table-responsive p-0">
                    @include('dashboard.clientes.facturas.table')
                </div>

            </div>

            <div class="modal-footer" id="modal_facturas_cliente_footer">

                <div class="row col-12 justify-content-between" wire:loading.class="invisible" wire:target.except="btnVerPDF">

                    <button type="button" wire:click="btnGenerarFactura" class="btn btn-primary" @if(!$servicios_id) disabled @endif>
                        <i class="fas fa-file-invoice mr-1"></i> Generar Factura
                    </button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">
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

