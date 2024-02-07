<div class="card card-navy" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;"
     xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        <h3 class="card-title">
            @if($nuevo) Crear @else Editar @endif Plan
        </h3>
        <div class="card-tools">
            {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>--}}
            @if($editar)
                <button class="btn btn-tool" wire:click="destroy({{ $planes_id }})"><i class="fas fa-trash-alt"></i> Eliminar</button>
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
                        <span class="input-group-text text-bold">Organización</span>
                    </div>
                    <select class="custom-select" wire:model.defer="organizaciones_id">
                        <option value="">Seleccione</option>
                        @foreach($organizaciones as $organizacion)
                            <option value="{{ $organizacion->id }}">{{ $organizacion->nombre }}</option>
                        @endforeach
                    </select>
                    @error('organizaciones_id')
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
                        <span class="input-group-text text-bold">Velocidad de Bajada</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="bajada" placeholder="[integer]">
                    @error('bajada')
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
                        <span class="input-group-text text-bold">Velocidad de Subida</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="subida" placeholder="[integer]">
                    @error('subida')
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
                        <span class="input-group-text text-bold">Precio Mensual</span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="precio" placeholder="[decimal]">
                    @error('precio')
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
