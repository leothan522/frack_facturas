<form wire:submit="save">
    <div class="card card-navy card-outline">
    <div class="card-header" wire:loading.class="invisible" wire:target="cancel, actualizarRegistroPago, save">
        <h3 class="card-title">
            Pagar Factura
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="actualizarRegistroPago">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool" wire:click="cancel">
                <i class="fas fa-ban"></i> Cancelar
            </button>
        </div>
    </div>
    <div class="card-body table-responsive" wire:loading.class="invisible" wire:target="cancel, actualizarRegistroPago, verDetalles, btnVolver, btnRegistrarPago, save" style="max-height: calc(100vh - {{ $size + 55 }}px)">

        @if($display == "verMetodos")
            @include('web.consultar.metodos')
        @endif

        @if($display == "verDetalles")
            @include('web.consultar.detalles')
        @endif

        <div class="@if($display != "verForm") d-none @endif">
            @include('web.consultar.form')
        </div>

    </div>

    @if($footer)
        <div class="card-footer" wire:loading.class="invisible" wire:target="cancel, save">

            @if($display != "verForm")
                <div class="row justify-content-between" wire:loading.class="invisible" wire:target="cancel, actualizarRegistroPago, verDetalles, btnVolver, btnRegistrarPago">
                    <button type="button" class="btn btn-default" wire:click="btnVolver">
                        <i class="fas fa-arrow-circle-left"></i> Volver
                    </button>

                    <button type="button" class="btn btn-primary" wire:click="btnRegistrarPago">
                        <i class="fas fa-file-invoice-dollar"></i> Registrar Pago
                    </button>
                </div>
            @else
                <div class="row justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            @endif

        </div>
    @endif

    {!! verSpinner('cancel, actualizarRegistroPago, verDetalles, btnVolver, btnRegistrarPago, save') !!}

</div>
</form>
