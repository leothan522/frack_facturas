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
                <button type="button" class="btn btn-block nav-link text-left" data-toggle="modal" data-target="#modal-default-antena-sectorial" onclick="verAntenasSectoriales()" @if(!comprobarPermisos('antenas.index')) disabled @endif>
                    <i class="fas fa-satellite-dish"></i> Antena Sectorial
                </button>
            </li>
            <li class="nav-item">
                @if(comprobarPermisos('clientes.excel'))
                    <a href="{{ route('clientes.excel') }}"  class="nav-link" onclick="toastBootstrap({ toast: 'toast', type: 'info', message: 'Descargando Archivo.'})">
                    <span wire:loading wire:target="">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...
                    </span>
                        <span wire:loading.class="d-none" wire:target="">
                        <i class="far fa-file-excel"></i> Exportar Excel
                    </span>
                    </a>
                @else
                    <span class="nav-link text-muted"><i class="far fa-file-excel"></i> Exportar Excel</span>
                @endif
            </li>
        </ul>
    </div>
</div>
