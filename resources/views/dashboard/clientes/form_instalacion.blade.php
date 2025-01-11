<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Fecha Instalación:</small>
    <div class="input-group">
        <input type="date" wire:model="fechaInstalacion" class="form-control @error('fechaInstalacion') is-invalid @enderror" placeholder="Fecha Instalación">
        @error('fechaInstalacion')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Fecha Pago:</small>
    <div class="input-group">
        <input type="date" wire:model="fechaPago" class="form-control @error('fechaPago') is-invalid @enderror" placeholder="Fecha Pago">
        @error('fechaPago')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Latitud:</small>
    <div class="input-group">
        <input type="text" wire:model="latitud" class="form-control @error('latitud') is-invalid @enderror" placeholder="Latitud">
        @error('latitud')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Longitud:</small>
    <div class="input-group">
        <input type="text" wire:model="longitud" class="form-control @error('longitud') is-invalid @enderror" placeholder="Longitud">
        @error('longitud')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">GPS:</small>
    <div class="input-group">
        <input type="text" wire:model="gps" class="form-control @error('gps') is-invalid @enderror" placeholder="GPS">
        @error('gps')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>


