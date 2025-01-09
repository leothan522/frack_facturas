<div class="card card-navy card-outline">
    <div class="card-header" wire:loading.class="invisible" wire:target="create, cancel, buscar">
        <h3 class="card-title">
            @if($tabla_id)
                Editar
            @else
                Nuevo
            @endif
        </h3>

        <div class="card-tools">
            @if($btnNuevo)
                <button type="button" class="btn btn-tool" wire:click="create" @if(!comprobarPermisos($modulo.'.create')) disabled @endif>
                    <i class="fas fa-file"></i> Nuevo
                </button>
            @endif
            <button type="button" class="btn btn-tool" wire:click="cancel">
                <i class="fas fa-ban"></i> Cancelar
            </button>
        </div>
    </div>
    <div class="card-body" wire:loading.class="invisible" wire:target="create, cancel, save, buscar" style="max-height: calc(100vh - {{ $size }}px)">

        <form wire:submit="save">

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">{{ __('Name') }}:</small>
                <div class="input-group">
                    <input type="text" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="{{ __('Name') }}">
                    @error('nombre')
                    <span class="error invalid-feedback text-bold">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-block @if($tabla_id) btn-primary @else btn-success @endif">
                <i class="fas fa-save mr-1"></i>
                Guardar
                @if($tabla_id)
                    Cambios
                @endif
            </button>

        </form>

    </div>

    {!! verSpinner('create, cancel, save, buscar') !!}

</div>

