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

                    <div class="@if($display != "verPago") d-none @endif">
                        @include('dashboard.pagos.show')
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">Cerrar</button>
                    @if($estatus == 0)
                        <button type="button" {{--wire:click="corregirPago"--}} class="btn btn-primary">
                            <i class="fas fa-donate"></i> Procesar
                        </button>
                    @endif
                </div>

                {!! verSpinner() !!}

            </div>
        </div>

    </div>
</form>
