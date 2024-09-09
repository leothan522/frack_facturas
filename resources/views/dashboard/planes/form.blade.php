<div>

    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-bold">Organización</span>
            </div>
            <select class="custom-select" wire:model="organizaciones_id">
                <option value="">Seleccione</option>
                @foreach($organizaciones as $organizacion)
                    <option value="{{ $organizacion->rowquid }}">{{ mb_strtoupper($organizacion->nombre) }}</option>
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
            <input type="text" class="form-control" wire:model="nombre" placeholder="[string]">
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
                <span class="input-group-text text-bold">Etiqueta - Factura</span>
            </div>
            <input type="text" class="form-control" wire:model="etiqueta" placeholder="[string]">
            @error('etiqueta')
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
            <input type="text" class="form-control" wire:model="bajada" placeholder="[integer]">
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
            <input type="text" class="form-control" wire:model="subida" placeholder="[integer]">
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
            <input type="text" class="form-control" wire:model="precio" placeholder="[decimal]">
            @error('precio')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

</div>
