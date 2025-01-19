<div wire:ignore.self class="modal fade" id="modal-pagos-show">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h4 class="modal-title" wire:loading.class="invisible">
                    Ver Pago
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body p-0" wire:loading.class="invisible">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-warning">
                        <span>Estatus:</span>
                        <span class="float-right text-bold {{ $classEstatus }} text-uppercase">{!! $verEstatus  !!}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Metodo:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verMetodo }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Referencia:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verReferencia }}</span>
                    </li>
                    @if($verBanco)
                        <li class="list-group-item">
                            <span>Banco:</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">{{ $verBanco }}</span>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <span>Monto:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verMoneda }} {{ $verMonto }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Fecha:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verFecha }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Factura:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verFactura }}</span>
                    </li>
                </ul>

            </div>

            <div class="modal-footer @if($estatusPago == 2) justify-content-between @endif" wire:loading.class="invisible">

                @if($estatusPago == 2)
                    <button type="button" class="btn btn-primary" wire:click="btnCorregirPago" data-dismiss="modal">
                        <i class="fas fa-file-invoice-dollar"></i> Pagar
                    </button>
                @endif

                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_show_pagos">
                    Cerrar
                </button>

            </div>

            {!! verSpinner() !!}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

