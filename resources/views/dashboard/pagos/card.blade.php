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
            <li class="nav-item active">
                <a href="#" class="nav-link" wire:click.prevent="btnRegistrarPago">
                    <span wire:loading wire:target="btnRegistrarPago">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...
                    </span>
                    <span wire:loading.class="d-none" wire:target="btnRegistrarPago">
                        <i class="fas fa-donate"></i> Registrar Pago
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="initReporte()" data-toggle="modal" data-target="#modal-default-generar-reporte">
                    <i class="far fa-file-excel"></i> Generar Reporte
                    {{--<span class="badge bg-warning float-right">65</span>--}}
                </a>
            </li>
        </ul>
    </div>
</div>
