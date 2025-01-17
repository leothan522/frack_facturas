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
                <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-default-antena-sectorial">
                    <i class="fas fa-satellite-dish"></i> Antena Sectorial
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('clientes.excel') }}"  class="nav-link" onclick="toastBootstrap({ toast: 'toast', type: 'info', message: 'Descargando Archivo.'})">
                    <span wire:loading wire:target="">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...
                    </span>
                    <span wire:loading.class="d-none" wire:target="">
                        <i class="far fa-file-excel"></i> Exportar Excel
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
