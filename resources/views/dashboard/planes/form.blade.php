<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Organización:</small>
    <div wire:ignore>
        <div id="div_select_organizacion" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('organizaciones_id')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>

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
    <small class="text-lightblue text-bold text-uppercase">Etiqueta - Factura:</small>
    <div class="input-group">
        <input type="text" wire:model="etiqueta" class="form-control @error('etiqueta') is-invalid @enderror" placeholder="Etiqueta - Factura">
        @error('etiqueta')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Velocidad de Bajada:</small>
    <div class="input-group">
        <input type="number" wire:model="bajada" class="form-control @error('bajada') is-invalid @enderror" placeholder="Velocidad de Bajada">
        @error('bajada')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Velocidad de Subida:</small>
    <div class="input-group">
        <input type="number" wire:model="subida" class="form-control @error('subida') is-invalid @enderror" placeholder="Velocidad de Subida">
        @error('subida')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Precio Mensual:</small>
    <div class="input-group">
        <input type="number" step="0.01" wire:model="precio" class="form-control @error('precio') is-invalid @enderror" placeholder="Precio Mensual">
        @error('precio')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>




