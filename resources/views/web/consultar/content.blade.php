<div class="row justify-content-center" wire:loading.class="invisible" wire:target.except="initModal, verDetalles, btnRegistrar, save">
    @include('web.consultar.show')
</div>

<div>
    @include('web.consultar.modal')
</div>


<div class="overlay-wrapper verCargando" wire:loading wire:target.except="initModal, verDetalles, btnRegistrar, save">
    <div class="overlay bg-transparent">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
