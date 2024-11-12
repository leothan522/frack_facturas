<form wire:submit="save">
    <div wire:ignore.self class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content {{--fondo--}}">

                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        @if($show)
                            Ver
                        @else
                            @if($nuevo)
                                Crear
                            @else
                                Editar
                            @endif
                        @endif
                        Plan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="@if($show) d-none @endif">
                        @include('dashboard.planes.form')
                    </div>

                    <div class="@if(!$show) d-none @endif">
                        @include('dashboard.planes.show')
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_cerrar">Cerrar
                    </button>
                    @if(!$show)
                        <button type="submit" class="btn @if($nuevo) btn-success @else btn-primary @endif ">
                            Guardar
                            @if($editar)
                                Cambios
                            @endif
                        </button>
                    @else
                        <button type="button" class="btn btn-danger" wire:click="destroy('{{ $rowquid }}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="edit('{{ $rowquid }}')">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                    @endif
                </div>

                {!! verSpinner() !!}

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
