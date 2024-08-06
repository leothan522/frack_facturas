<div xmlns:wire="http://www.w3.org/1999/xhtml">

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
                <span class="input-group-text text-bold">Email</span>
            </div>
            <input type="email" class="form-control" wire:model="email" placeholder="[string]">
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
            <input type="text" class="form-control" wire:model="telefono" placeholder="[string]">
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
                <span class="input-group-text text-bold">Web</span>
            </div>
            <input type="text" class="form-control" wire:model="web" placeholder="[string]">
            @error('web')
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
                <span class="input-group-text text-bold">Moneda</span>
            </div>
            <select wire:model="moneda" class="custom-select">
                <option value="">Seleccione</option>
                <option value="Bs.">Bs.</option>
                <option value="USD">USD</option>
            </select>
            @error('moneda')
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
                <span class="input-group-text text-bold">Dias Factura</span>
            </div>
            <input type="text" class="form-control" wire:model="dias" placeholder="[integer]">
            @error('dias')
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
                <span class="input-group-text text-bold">Formato Factura</span>
            </div>
            <input type="text" class="form-control" wire:model="formato" placeholder="[string]">
            @error('formato')
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
                <span class="input-group-text text-bold">Proxima Factura</span>
            </div>
            <input type="text" class="form-control" wire:model="proxima" placeholder="[integer]">
            @error('proxima')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text text-bold">Dirección</span>
            </div>
            <input type="text" class="form-control" wire:model="direccion" placeholder="[String]">
            @error('direccion')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

</div>
