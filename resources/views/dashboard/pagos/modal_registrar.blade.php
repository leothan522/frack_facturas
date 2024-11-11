<form wire:submit="savePago">
    <div wire:ignore.self class="modal fade" id="modal-default-registrar-pago" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content {{--fondo--}}">

                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        {{ $titlePago }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="@if($displayPago != "verCliente") d-none @endif">
                        @include('dashboard.pagos.form_cliente')
                    </div>

                    @if($factura)
                        <div>
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <h5 class="card-title">Factura #: <span class="text-danger text-bold text-uppercase">{{ $factura->factura_numero }}</span></h5>
                                    <p class="card-text">
                                        Cliente: <span class="text-bold text-uppercase">{{ $factura->cliente_nombre }} {{ $factura->cliente_apellido }}</span>
                                        <br>
                                        Fecha: <span class="text-bold text-uppercase">{{ getFecha($factura->factura_fecha) }}</span>
                                        <span class="float-right">USD <span class="text-bold text-danger">{{ formatoMillares($factura->factura_total) }}</span></span>
                                        <br>
                                        <span class="float-right">Bs <span class="text-bold text-danger">{{ formatoMillares($bolivares) }}</span></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="@if($displayPago != "verMetodos") d-none @endif">
                        @include('dashboard.pagos.metodos')
                    </div>

                    <div class="@if($displayPago != "verForm") d-none @endif">
                        @include('dashboard.pagos.form')
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default_pago">Cerrar</button>
                    <button type="submit" class="btn btn-success @if($displayPago != "verForm") d-none @endif">Guardar</button>
                </div>

                {!! verSpinner() !!}

            </div>
        </div>

    </div>
</form>
