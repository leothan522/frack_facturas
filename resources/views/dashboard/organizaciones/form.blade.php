<div>

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
        <small>Email:</small>
        <div class="input-group">
            <input type="email" class="form-control" wire:model="email" placeholder="Email">
            @error('email')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Teléfono:</small>
        <div class="input-group">
            <input type="text" class="form-control" wire:model="telefono" placeholder="Teléfono">
            @error('telefono')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Web:</small>
        <div class="input-group mb-3">
            <input type="text" class="form-control" wire:model="web" placeholder="Web">
            @error('web')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Moneda:</small>
        <div class="input-group">
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
        <small>Dias Factura:</small>
        <div class="input-group">
            <input type="number" step="1" class="form-control" wire:model="dias" placeholder="Dias Factura">
            @error('dias')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Formato Factura:</small>
        <div class="input-group">
            <input type="text" class="form-control" wire:model="formato" placeholder="Formato Factura">
            @error('formato')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Proxima Factura:</small>
        <div class="input-group">
            <input type="number" step="1" class="form-control" wire:model="proxima" placeholder="Proxima Factura">
            @error('proxima')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Dirección</small>
        <div class="input-group">
            <input type="text" class="form-control" wire:model="direccion" placeholder="Dirección">
            @error('direccion')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

</div>
