<div wire:ignore.self class="modal fade" id="modal-ver-factura">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h4 class="modal-title" wire:loading.class="invisible">
                    Ver Factura
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body p-0" wire:loading.class="invisible">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span>Organización:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verOrganizacion }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Factura:</span>
                        <a href="#" target="_blank" class="float-right text-bold text-uppercase d-md-none" wire:click="btnVerPDF" data-toggle="modal" data-target="#modal-ver-pdf">{{ $facturaNumero }}</a>
                        <a href="{{ route('facturas.pdf', $rowquid ?? '') }}" target="_blank" class="float-right text-bold text-uppercase d-none d-md-inline">{{ $facturaNumero }}</a>
                    </li>
                    <li class="list-group-item">
                        <span>Fecha:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verFecha }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Cédula:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verCedula }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Cliente:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verCliente }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Plan de Servicio:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verPlan }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Total:</span>
                        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verTotal }}</span>
                    </li>
                    @if($verEstatus)
                        <li class="list-group-item bg-warning">
                            <span>Estatus:</span>
                            <span class="float-right text-bold {{ $classEstatus }} text-uppercase">{!! $verEstatus  !!}</span>
                        </li>
                    @endif
                </ul>

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

