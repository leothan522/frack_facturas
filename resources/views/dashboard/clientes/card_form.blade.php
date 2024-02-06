<div class="card card-navy" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;"
     xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        <h3 class="card-title">
            @if($nuevo) Crear @else Editar @endif Cliente
        </h3>
        <div class="card-tools">
            {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>--}}
            @if($editar)
                <button class="btn btn-tool" wire:click="destroy({{ $cliente_id }})"><i class="fas fa-trash-alt"></i> Eliminar</button>
                <button class="btn btn-tool" wire:click="limpiar"><i class="fas fa-ban"></i> Cancelar</button>
            @else
                <span class="btn btn-tool"><i class="fas fa-file"></i></span>
            @endif

        </div>
    </div>

    <div class="card-body">


        <form wire:submit.prevent="save">

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Cedula</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="cedula" placeholder="[string]">
                    @error('cedula')
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
                        <span class="input-group-text text-bold">Nombre</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="nombre" placeholder="[string]">
                    @error('nombre')
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
                        <span class="input-group-text text-bold">Apellido</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="apellido" placeholder="[string]">
                    @error('apellido')
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
                        <span class="input-group-text text-bold">Email</span>
                    </div>
                    <input type="email" class="form-control" wire:model.defer="email" placeholder="[string]">
                    @error('email')
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
                        <span class="input-group-text text-bold">Teléfono</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="telefono" placeholder="[string]">
                    @error('telefono')
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
                        <span class="input-group-text text-bold">Dirección</span>
                    </div>
                    <textarea class="form-control" cols="1" rows="1" wire:model.defer="direccion" placeholder="[String]"></textarea>
                    @error('direccion')
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
                        <span class="input-group-text text-bold">Instalación</span>
                    </div>
                    <input type="date" class="form-control" wire:model.defer="instalacion" placeholder="[string]">
                    @error('instalacion')
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
                        <span class="input-group-text text-bold">Fecha Pago</span>
                    </div>
                    <input type="date" class="form-control" wire:model.defer="pago" placeholder="[string]">
                    @error('pago')
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
                        <span class="input-group-text text-bold">Latitud</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="latitud" placeholder="[string]">
                    @error('latitud')
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
                        <span class="input-group-text text-bold">Longitud</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="longitud" placeholder="[string]">
                    @error('longitud')
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
                        <span class="input-group-text text-bold">GPS</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="gps" placeholder="[string]">
                    @error('gps')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group text-right">
                <input type="submit" class="btn btn-block @if($nuevo) btn-success @else btn-primary @endif" value="Guardar @if($editar) Cambios @endif">
            </div>

        </form>

    </div>

    {!! verSpinner() !!}

</div>
