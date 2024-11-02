<p class="text-justify pr-3 pl-3">
    Asegúrate de escribir todos los dígitos en la referencia y verificar los demás datos antes de guardar.
</p>

<div class="pr-3 pl-3">

    <div class="form-group">
        <small>Referencia:</small>
        <div class="input-group mb-3">
            <input type="number" wire:model="referencia" class="form-control" placeholder="Referencia">
            <div class="input-group-append">
                <button type="button" class="input-group-text text-primary">
                    Pegar
                </button>
            </div>
            @error('referencia')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group @if($displayDetalles == "zelle") d-none @endif">
        <small>¿Qué banco utilizaste?</small>
        <div wire:ignore>
            <div class="input-group mb-3" id="div_select_bancos">
                <select class="custom-control custom-select">
                    <option>Seleccione</option>
                </select>
            </div>
        </div>
        @error('idBanco')
        <span class="col-sm-12 text-sm text-bold text-danger">
            <i class="icon fas fa-exclamation-triangle"></i>
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="form-group">
        <small>Fecha de pago:</small>
        <input type="date" wire:model="fecha" class="form-control" placeholder="Fecha">
        @error('fecha')
        <span class="col-sm-12 text-sm text-bold text-danger">
            <i class="icon fas fa-exclamation-triangle"></i>
            {{ $message }}
        </span>
        @enderror
    </div>

</div>
