<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Fecha:</small>
    <div class="input-group">
        <input type="date" wire:model="fecha" class="form-control @error('fecha') is-invalid @enderror" placeholder="Fecha">
        @error('fecha')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Concepto:</small>
    <div class="input-group">
        <input type="text" wire:model="concepto" class="form-control @error('concepto') is-invalid @enderror" placeholder="Concepto">
        @error('concepto')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Moneda:</small>
    <div class="input-group">
        <select class="custom-select @error('moneda') is-invalid @enderror" wire:model="moneda">
            <option value="">Seleccione</option>
            @foreach($listarMonedas as $moneda)
                <option value="{{ $moneda->codigo }}">{{ $moneda->nombre }}</option>
            @endforeach
        </select>
        @error('moneda')
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

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Observación o Explicación:</small>
    <div class="input-group">
        <textarea wire:model="descripcion" class="form-control @error('descripcion') is-invalid @enderror" cols="1" rows="2" placeholder="Observaciones"></textarea>
        @error('descripcion')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>
