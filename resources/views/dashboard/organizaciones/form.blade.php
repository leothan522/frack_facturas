<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">{{ __('Name') }}:</small>
    <div class="input-group">
        <input type="text" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre">
        @error('nombre')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Representante:</small>
    <div class="input-group">
        <input type="text" wire:model="representante" class="form-control @error('representante') is-invalid @enderror" placeholder="Representante">
        @error('representante')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">{{ __('Email') }}:</small>
    <div class="input-group">
        <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}">
        @error('email')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Teléfono:</small>
    <div class="input-group">
        <input type="text" wire:model="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Teléfono">
        @error('telefono')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Moneda Base:</small>
    <div class="input-group">
        <select class="custom-select @error('moneda') is-invalid @enderror" wire:model="moneda">
            <option value="">Seleccione</option>
            <option value="Bs.">Bolivares</option>
            <option value="USD">Dolares</option>
        </select>
        @error('moneda')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Dirección:</small>
    <div class="input-group">
        <input type="text" wire:model="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Dirección">
        @error('direccion')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Días Factura:</small>
    <div class="input-group">
        <input type="number" wire:model="dias" class="form-control @error('dias') is-invalid @enderror" placeholder="Días Factura">
        @error('dias')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Formato Factura:</small>
    <div class="input-group">
        <input type="text" wire:model="formato" class="form-control @error('formato') is-invalid @enderror" placeholder="Formato Factura (Opcional)">
        @error('formato')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Próxima Factura:</small>
    <div class="input-group">
        <input type="number" wire:model="proxima" class="form-control @error('proxima') is-invalid @enderror" placeholder="Próxima Factura (Opcional)">
        @error('proxima')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Web:</small>
    <div class="input-group">
        <input type="text" wire:model="web" class="form-control @error('web') is-invalid @enderror" placeholder="Web (Opcional)">
        @error('web')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>




