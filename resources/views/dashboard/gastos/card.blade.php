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
                <button type="button" class="btn btn-block nav-link text-left" wire:click="btnRegistrar" @if(!comprobarPermisos('gastos.create')) disabled @endif>
                    <span wire:loading wire:target="btnRegistrar">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...
                    </span>
                    <span wire:loading.class="d-none" wire:target="btnRegistrar">
                        <i class="fas fa-donate"></i> Registrar Gasto
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-block nav-link text-left" onclick="initReporte()" data-toggle="modal" data-target="#modal-default-generar-reporte" @if(!comprobarPermisos('pagos.excel')) disabled @endif>
                    <i class="far fa-file-excel"></i> Generar Reporte
                    {{--<span class="badge bg-warning float-right">65</span>--}}
                </button>
            </li>
        </ul>
    </div>
</div>
