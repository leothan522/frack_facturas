<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Clientes:</small>
    <div wire:ignore>
        <div id="div_select_registrar_clientes" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('clientes_id')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Facturas Pendientes:</small>
    <div wire:ignore>
        <div id="div_select_registrar_facturas" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('facturas_id')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>

<div class="card card-outline card-navy" >

    <div class="card-header d-none">
        <h5 class="card-title">Detalles Factura</h5>
        <div class="card-tools" wire:ignore>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <ul class="todo-list list-group list-group-flush">
            <li class="list-group-item">
                <span>Factura: </span>
                <span class="float-right text-bold text-lightblue text-uppercase" wire:loading.class="invisible" wire:target.except="save">{{ $verNumeroFactura ?? '-' }}</span>
            </li>
            <li class="list-group-item">
                <span>Organización: </span>
                <span class="float-right text-bold text-lightblue text-uppercase" wire:loading.class="invisible" wire:target.except="save">{{ $verOrganizacionFactura ?? '-' }}</span>
            </li>
            <li class="list-group-item">
                <span>Fecha Factura: </span>
                <span class="float-right text-bold text-lightblue text-uppercase" wire:loading.class="invisible" wire:target.except="save">{{ $verFechaFactura ?? '-' }}</span>
            </li>
            <li class="list-group-item">
                <span>Total: </span>
                <span class="float-right text-bold text-lightblue text-uppercase" wire:loading.class="invisible" wire:target.except="save">{{ $verTotalFactura ?? '-' }}</span>
            </li>
        </ul>
    </div>

</div>


