{{--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Launch Default Modal
</button>--}}

<form wire:submit="save">
    <div wire:ignore.self class="modal fade" id="modal-default-antena-sectorial">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content {{--fondo--}}">
            <div class="modal-header bg-navy">
                <h4 class="modal-title">
                    <i class="fas fa-satellite-dish"></i> Antena Sectorial
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">×</span>
                </button>
            </div>
            <div class="modal-body" wire:loading.class="invisible" style="min-height: 188px">

                <div class="row justify-content-center">
                    <div class="col-md-8 mb-3">
                        <small class="text-lightblue text-bold text-uppercase">{{ $title }}:</small>
                        <div class="input-group">
                            <input type="text" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre">
                            @if(!$form)
                                <span class="input-group-append">
                                    <button type="submit" class="btn @if($antenas_id) btn-primary @else btn-success @endif">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </span>
                            @endif
                            @error('nombre')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                        @if($form)
                            @include('dashboard.clientes.antena.form')
                        @else
                            @include('dashboard.clientes.antena.list')
                        @endif
                    </div>
                </div>



            </div>
            <div class="modal-footer @if($form) justify-content-between @endif" wire:loading.class="invisible">
                @if($form)
                    <button type="button" class="btn btn-danger" onclick="confirmToastBootstrap('deleteAntena')"><i class="fas fa-trash-alt"></i></button>
                    <button type="submit" class="btn btn-primary">Actualizar Antena</button>
                    <button type="button" class="btn btn-default" wire:click="cancel">Volver</button>
                @else
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default_antena_sectorial">Cerrar</button>
                @endif
            </div>
            {!! verSpinner() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</form>
