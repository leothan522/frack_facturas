<button id="launch-modal-pagos-show" type="button" class="d-none" data-toggle="modal" data-target="#modal-pagos-show">
    Launch Default Modal
</button>
<div wire:ignore.self class="modal fade" id="modal-pagos-show">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h4 class="modal-title" wire:loading.class="invisible" wire:target.except="btnVerPDF">
                    Ver Pago
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body p-0" wire:loading.class="invisible" wire:target.except="btnVerPDF">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-warning">
                        <span>Estatus:</span>
                        <span class="float-right text-bold {{ $classEstatus }} text-uppercase">{!! $verEstatus  !!}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Metodo:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verMetodo }}</span>
                    </li>
                    @if(mb_strtolower($verMetodo) != 'efectivo')
                        <li class="list-group-item">
                            <span>Referencia:</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">{{ $verReferencia }}</span>
                        </li>
                    @endif
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
                        @if($verFactura)
                            <a href="#" target="_blank" class="float-right text-bold text-uppercase d-md-none" wire:click="btnVerPDF" onclick="verModalPDF()" data-toggle="modal" data-target="#modal-ver-pdf">{{ $verFactura }}</a>
                            <a href="{{ route('facturas.pdf', $verRowquid ?? '') }}" target="_blank" class="float-right text-bold text-uppercase d-none d-md-inline">{{ $verFactura }}</a>
                        @else
                            <span class="float-right text-bold text-lightblue text-uppercase">Pago Adelantado</span>
                        @endif
                    </li>
                    <li class="list-group-item">
                        <span>Cliente:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verCliente }}</span>
                    </li>
                    @if($verTotal)
                        <li class="list-group-item">
                            <span>Total Factura:</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">{{ $verTotal }}{{ $verBs }}</span>
                        </li>
                    @endif

                </ul>

            </div>

            <div class="modal-footer">

                <div class="row col-12 justify-content-between" wire:loading.class="invisible" wire:target.except="btnVerPDF">

                    @if($estatus)
                        @if($band)
                            <button type="button" class="btn btn-danger" onclick="confirmToastBootstrap('delete', 'NoParametros')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        @else
                            <button type="button" class="btn btn-primary" onclick="confirmToastBootstrap('btnResetPago', 'NoParametros', { type: 'info', message: 'Su Estatus cambiara a <b>ESPERANDO VALIDACIÓN</b>', button: '¡SI, Reset!'})" @if(!comprobarPermisos('pagos.reset')) disabled @endif>
                                <i class="fas fa-eraser"></i> Reset
                            </button>
                        @endif
                    @else
                        <button type="button" class="btn btn-danger" onclick="confirmToastBootstrap('btnRechazarPago', 'NoParametros', { type: 'error', message: 'Su Estatus cambiara a <b>NO VALIDADO (REVISAR)</b>', button: '¡SI, Rechazar!'})" @if(!comprobarPermisos('pagos.validar')) disabled @endif>
                            <i class="fas fa-exclamation-triangle"></i> Rechazar
                        </button>

                        <button type="button" class="btn btn-success" onclick="confirmToastBootstrap('btnAprobarPago', 'NoParametros', { type: 'success', message: 'Su Estatus cambiara a <b>VALIDADO</b>', button: '¡SI, Aprobar!'})" @if(!comprobarPermisos('pagos.validar')) disabled @endif>
                            <i class="fas fa-check"></i> Aprobar
                        </button>
                    @endif

                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_show_pagos">
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

