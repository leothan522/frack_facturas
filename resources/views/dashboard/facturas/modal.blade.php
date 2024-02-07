{{--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Launch Default Modal
</button>--}}

<div wire:ignore.self class="modal fade" id="modal-servicios" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog">
        <form wire:submit.prevent="save">
            <div class="modal-content {{--fondo--}}">
                <div class="modal-header bg-navy">
                    <h4 class="modal-title">Nuevo Servicio</h4>
                    <button type="button" wire:click="limpiar" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <div wire:ignore>
                            <div class="input-group mb-3" id="div_select_clientes">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-bold">Cliente</span>
                                </div>
                                <select class="form-control"></select>
                            </div>
                        </div>
                        @error('cliente')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-bold">Organización</span>
                            </div>
                            <select class="custom-select" wire:model="organizacion">
                                <option value="">Seleccione</option>
                                @foreach($organizaciones as $organizacion)
                                    <option value="{{ $organizacion->id }}">{{ $organizacion->nombre }}</option>
                                @endforeach
                            </select>
                            @error('organizacion')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-bold">Plan de Servicio</span>
                            </div>
                            <select class="custom-select" wire:model="plan">
                                <option value="">Seleccione</option>
                                @foreach($planes as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                                @endforeach
                            </select>
                            @error('plan')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>


                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default d-none" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                {!! verSpinner() !!}
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
