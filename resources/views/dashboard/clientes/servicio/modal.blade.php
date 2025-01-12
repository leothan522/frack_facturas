<form wire:submit="save">
    <div wire:ignore.self class="modal fade" id="modal-cliente-servicio">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header bg-navy">
                    <h4 class="modal-title" id="modal_clientes_servicio_header" wire:loading.class="invisible">
                        {{ $title }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_cerrar_modal_cliente_servicio">
                        <span class="text-white" aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="modal_clientes_servicio_body" wire:loading.class="invisible" style="height: 358px;">

                    <div class="col-12 p-0 @if($form) d-none @endif">
                        @include('dashboard.clientes.servicio.show')
                    </div>

                    <div class="@if(!$form) d-none @endif">
                        @include('dashboard.clientes.servicio.form')
                    </div>

                </div>

                <div class="modal-footer" id="modal_clientes_servicio_footer">

                    @if($form)
                        <div class="row col-12 justify-content-between" wire:loading.class="invisible"
                             wire:target="limpiar, edit">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">
                                Cerrar
                            </button>
                            <button type="submit" class="btn  @if($servicios_id) btn-primary @else btn-success @endif ">
                                Guardar @if($servicios_id)
                                    Cambios
                                @endif
                            </button>
                        </div>
                    @else
                        <div class="row col-12 justify-content-between" wire:loading.class="invisible">

                            <div class="btn-group">

                                <button type="button" class="btn btn-primary" onclick="confirmToastBootstrap('deleteClienteServicio')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <button type="button" class="btn btn-primary" wire:click="edit">
                                    <i class="fas fa-edit"></i>
                                </button>

                            </div>

                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Cerrar
                            </button>

                        </div>
                    @endif
                </div>

                {!! verSpinner() !!}

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
