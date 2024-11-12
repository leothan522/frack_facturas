<div>

    <div class="form-group">
        <small>Cédula:</small>
        <div class="input-group">
            <input type="number" class="form-control" wire:model="cedula" placeholder="Cédula">
            @error('cedula')
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
        <small>Apellido:</small>
        <div class="input-group">
            <input type="text" class="form-control" wire:model="apellido" placeholder="Apellido">
            @error('apellido')
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
        <small>Dirección:</small>
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


    <div class="form-group">
        <small>Instalación:</small>
        <div class="input-group">
            <input type="date" class="form-control" wire:model="instalacion" placeholder="Instalación">
            @error('instalacion')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Fecha Pago:</small>
        <div class="input-group">
            <input type="date" class="form-control" wire:model="pago" placeholder="Fecha Pago">
            @error('pago')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Latitud:</small>
        <div class="input-group">
            <input type="text" class="form-control" wire:model="latitud" placeholder="Latitud">
            @error('latitud')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Longitud:</small>
        <div class="input-group">
            <input type="text" class="form-control" wire:model="longitud" placeholder="Longitud">
            @error('longitud')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>GPS:</small>
        <div class="input-group">
            <input type="text" class="form-control" wire:model="gps" placeholder="GPS">
            @error('gps')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

</div>
