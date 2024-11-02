<form wire:submit="save">
    <div wire:ignore.self class="modal fade" id="modal-default" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content {{--fondo--}}">

                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        {{ $titleModal }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="@if($display != "verMetodos") d-none @endif">
                        @include('web.consultar.metodos')
                    </div>

                    <div class="@if($display != "verDetalles") d-none @endif">
                        @include('web.consultar.detalles')
                    </div>

                    <div class="@if($display != "verForm") d-none @endif">
                        @include('web.consultar.form')
                    </div>

                    <div class="@if($display != "verPago") d-none @endif">
                        @include('web.consultar.pago')
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">Cerrar</button>
                    <button type="button" wire:click="btnRegistrar" class="btn btn-primary @if($display == "verForm" || $display == "verPago") d-none @endif" @if($display != "verDetalles") disabled @endif>Registrar Pago</button>
                    <button type="submit" class="btn btn-success @if($display != "verForm") d-none @endif">Guardar</button>
                    <button type="button" wire:click="corregirPago" class="btn btn-primary @if($estatus != 2) d-none @endif">
                        <i class="fas fa-file-invoice-dollar"></i> Pagar
                    </button>
                </div>

                {!! verSpinner() !!}

            </div>
        </div>

    </div>
</form>
