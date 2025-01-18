<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Dirección IP:</small>
    <div class="input-group">
        <input type="text" wire:model="ip" class="form-control @error('ip') is-invalid @enderror" placeholder="Dirección IP">
        @error('ip')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>
