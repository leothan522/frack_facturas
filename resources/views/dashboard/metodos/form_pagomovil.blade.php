<div class="card card-primary card-outline">

    <div class="card-header">
        <h3 class="card-title">Pago móvil</h3>
        <div class="card-tools">
            {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>--}}
            {{--<span class="btn btn-tool"><i class="fas fa-list"></i></span>--}}
            <button type="button" class="btn btn-tool" wire:click="limpiar">
                <i class="fas fa-arrow-circle-left"></i> Volver
            </button>
        </div>
    </div>

    <div class="card-body table-responsive" wire:loading.class="invisible" style="max-height: calc(100vh - {{ $size }}px)">


        <form wire:submit="savePagoMovil">


            @if($metodos_id)
                <div class="float-right">
                    <button type="button" class="btn btn-sm" onclick="confirmToastBootstrap('delete', 'NoParametros')">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </button>
                </div>
            @endif

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">Número de teléfono:</small>
                <div class="input-group">
                    <input type="number" step="1" wire:model="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Número de teléfono">
                    @error('telefono')
                    <span class="error invalid-feedback text-bold">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">Rif / Cedula:</small>
                <div class="input-group">
                    <div class="input-group-prepend mr-2">
                        {{--<span class="input-group-text"><i class="far fa-bookmark"></i></span>--}}
                        <select class="custom-control custom-select" wire:model="prefijo">
                            <option value="V-">V-</option>
                            <option value="E-">E-</option>
                            <option value="J-">J-</option>
                        </select>
                    </div>
                    <input type="number" step="1" wire:model="numero" class="form-control @error('numero') is-invalid @enderror @error('cedula') is-invalid @enderror"  placeholder="numero">
                    @error('numero')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                    {{ $message }}
                </span>
                    @enderror
                    @error('cedula')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                    {{ $message }}
                </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">Banco:</small>
                <div wire:ignore>
                    <div class="input-group" id="div_pagomovil_select_bancos">
                        <select class="custom-select">
                            <option>Seleccione</option>
                        </select>
                    </div>
                </div>
                @error('bancoPagoMovil')
                <small class="text-danger text-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                @if($metodos_id)
                    <button type="submit" class="btn btn-block btn-primary">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                @else
                    <button type="submit" class="btn btn-block btn-success">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                @endif
            </div>

        </form>


    </div>

    {!! verSpinner() !!}

</div>
