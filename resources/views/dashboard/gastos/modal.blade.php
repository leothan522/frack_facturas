<button id="launch-modal-gastos-show" type="button" class="d-none" data-toggle="modal" data-target="#modal-gastos-show">
    Launch Default Modal
</button>
<div wire:ignore.self class="modal fade" id="modal-gastos-show">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h4 class="modal-title" wire:loading.class="invisible" wire:target.except="btnVerPDF">
                    Ver Gasto
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body p-0" wire:loading.class="invisible" wire:target.except="btnVerPDF">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span>Fecha:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verFecha }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Concepto:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verConcepto }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Monto:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verMoneda }} {{ $verMonto }}</span>
                    </li>
                    @if($verDescripcion)
                        <li class="list-group-item">
                            <span>Observación:</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">{{ $verDescripcion }}</span>
                        </li>
                    @endif

                </ul>

            </div>

            <div class="modal-footer">

                <div class="row col-12 justify-content-between" wire:loading.class="invisible" wire:target.except="btnVerPDF">

                    <button type="button" class="btn btn-danger" onclick="confirmToastBootstrap('delete', 'NoParametros')" @if(!comprobarPermisos('gastos.destroy')) disabled @endif>
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button type="button" class="btn btn-primary" onclick="" data-dismiss="modal" @if(!comprobarPermisos('gastos.edit')) disabled @endif>
                        <i class="fas fa-edit"></i> Editar
                    </button>
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

