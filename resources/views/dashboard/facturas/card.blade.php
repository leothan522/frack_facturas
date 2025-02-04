<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tareas</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <button type="button" class="btn btn-block nav-link text-left" wire:click="setFacturarAutomatico" @if(!comprobarPermisos('facturas.automatico')) disabled @endif>
                    <span wire:loading wire:target="setFacturarAutomatico">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...
                    </span>
                    <span wire:loading.class="d-none" wire:target="setFacturarAutomatico">
                        <i class="fas fa-power-off @if($facturarAutomatico) text-success @endif"></i> Facturar Automático
                        @if($facturarAutomatico)
                            <span class="badge bg-success float-right">Activo</span>
                        @else
                            <span class="badge bg-warning float-right">Inactivo</span>
                        @endif
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-block nav-link text-left" wire:click="btnGenerarFacturas" @if(!comprobarPermisos('facturas.create')) disabled @endif>
                    <span wire:loading wire:target="btnGenerarFacturas">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...
                    </span>
                    <span wire:loading.class="d-none" wire:target="btnGenerarFacturas">
                        <i class="fas fa-file-invoice"></i> Generar Facturas
                        @if($verNuevasFacturas)
                            <span class="badge bg-warning float-right">{{ $nuevasFacturas }}</span>
                        @endif
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-block nav-link text-left" wire:click="btnSendFacturas" @if(!comprobarPermisos('facturas.send')) disabled @endif>
                    <span wire:loading wire:target="btnSendFacturas">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...
                    </span>
                    <span wire:loading.class="d-none" wire:target="btnSendFacturas">
                        <i class="fas fa-paper-plane"></i> Enviar Facturas
                        @if($verFacturasEnviadas)
                            <span class="badge bg-warning float-right">{{ $facturasEnviadas }}</span>
                        @endif
                    </span>
                </button>
            </li>
            <li class="nav-item d-none">
                <a href="#" class="nav-link">
                    <span wire:loading wire:target="getOrganizacion">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...
                    </span>
                    <span wire:loading.class="d-none" wire:target="getOrganizacion">
                        <i class="fas fa-filter"></i> Prueba
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
