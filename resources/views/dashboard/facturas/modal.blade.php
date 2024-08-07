{{--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Launch Default Modal
</button>--}}

<div wire:ignore.self class="modal fade" id="modal-servicios" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog">
        <form wire:submit="save">
            <div class="modal-content {{--fondo--}}">
                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        @if($nuevo) Nuevo  @else Editar @endif
                        Servicio</h4>
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
                            <select class="custom-select" wire:model.live="organizacion">
                                <option value="">Seleccione</option>
                                @foreach($organizaciones as $organizacion)
                                    <option value="{{ $organizacion->id }}">{{ mb_strtoupper($organizacion->nombre) }}</option>
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
                            <select class="custom-select" wire:model.live="plan">
                                <option value="">Seleccione</option>
                                @foreach($planes as $plan)
                                    <option value="{{ $plan->id }}">{{ mb_strtoupper($plan->nombre) }}</option>
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

                <div class="modal-footer @if($nuevo) justify-content-end @else justify-content-between @endif">
                    <button type="button" class="btn btn-default d-none" data-dismiss="modal" id="btn_modal_servicios">Close</button>
                    <button type="button" class="btn btn-danger @if($nuevo) d-none @endif" wire:click="destroy({{ $servicios_id }})"><i class="fas fa-trash-alt"></i></button>
                    <button type="submit" class="btn @if($nuevo) btn-success @else btn-primary @endif">Guardar @if($editar) Cambios @endif</button>
                </div>
                {!! verSpinner() !!}
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
