<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Metodo:</small>
    <div class="input-group">
        <select class="custom-select @error('metodo') is-invalid @enderror" wire:model.live="metodo">
            <option value="">Seleccione</option>
            @foreach($listarMetodos as $row)
                <option value="{{ $row->metodo }}" class="text-uppercase">{{ getMetodoPago($row->metodo) }}</option>
            @endforeach
        </select>
        @error('metodo')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group @if($ocultarBanco) d-none @endif">
    <small class="text-lightblue text-bold text-uppercase">Banco:</small>
    <div wire:ignore>
        <div id="div_select_registrar_bancos" class="input-group">
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
    <small class="text-lightblue text-bold text-uppercase">Referencia:</small>
    <div class="input-group">
        <input type="text" wire:model="referencia" class="form-control @error('referencia') is-invalid @enderror" placeholder="Referencia">
        @error('referencia')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
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
        <input type="number" step="0.01" wire:model="monto" class="form-control @error('monto') is-invalid @enderror" placeholder="Monto">
        @error('monto')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>
