<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">{{ getMetodoPago($metodo) }}</small>
    <p class="text-justify">
        Asegúrate de escribir todos los dígitos en la referencia y verificar los demás datos antes de guardar.
    </p>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Referencia:</small>
    <div class="input-group">
        @if($metodo == "zelle")
            <input type="text" wire:model="referencia" class="form-control @error('referencia') is-invalid @enderror" placeholder="Referencia">
        @else
            <input type="number" step="1" wire:model="referencia" class="form-control @error('referencia') is-invalid @enderror" placeholder="Referencia">
        @endif
        <div class="input-group-append">
            <button type="button" class="input-group-text text-primary" onclick="pegarPortapapeles()">
                Pegar
            </button>
        </div>
        @error('referencia')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group @if($metodo == "zelle") d-none @endif">
    <small class="text-lightblue text-bold text-uppercase">Banco:</small>
    <div wire:ignore>
        <div id="div_select_bancos" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('bancos_id')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Fecha Pago:</small>
    <div class="input-group">
        <input type="date" wire:model="fecha" class="form-control @error('fecha') is-invalid @enderror" placeholder="Fecha Pago">
        @error('fecha')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Monto:</small>
    <div class="input-group">
        <input type="number" step="0.01" wire:model="montoPago" class="form-control @error('montoPago') is-invalid @enderror" placeholder="{{ number_format($monto, 2, '.', '') }}">
        @error('montoPago')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>
