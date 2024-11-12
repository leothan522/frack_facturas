<div>

    <div class="form-group">
        <small>Organización:</small>
        <div class="input-group">
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
        <small>Nombre:</small>
        <div class="input-group">
            <input type="text" class="form-control" wire:model="nombre" placeholder="Nombre">
            @error('nombre')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Etiqueta - Factura:</small>
        <div class="input-group">
            <input type="text" class="form-control" wire:model="etiqueta" placeholder="Etiqueta - Factura">
            @error('etiqueta')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Velocidad de Bajada:</small>
        <div class="input-group">
            <input type="number" step="1" class="form-control" wire:model="bajada" placeholder="Velocidad de Bajada">
            @error('bajada')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Velocidad de Subida:</small>
        <div class="input-group">
            <input type="number" step="1" class="form-control" wire:model="subida" placeholder="Velocidad de Subida">
            @error('subida')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Precio Mensual:</small>
        <div class="input-group mb-3">
            <input type="number" step="0.01" class="form-control" wire:model="precio" placeholder="Precio Mensual">
            @error('precio')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

</div>
