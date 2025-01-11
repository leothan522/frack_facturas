<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Cédula:</small>
    <div class="input-group">
        <input type="number" wire:model="cedula" class="form-control @error('cedula') is-invalid @enderror" placeholder="Cédula">
        @error('cedula')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Nombre:</small>
    <div class="input-group">
        <input type="text" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre">
        @error('nombre')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Apellido:</small>
    <div class="input-group">
        <input type="text" wire:model="apellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Apellido">
        @error('apellido')
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
    <small class="text-lightblue text-bold text-uppercase">{{ __('Email') }}:</small>
    <div class="input-group">
        <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}">
        @error('email')
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




