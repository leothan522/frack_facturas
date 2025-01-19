<div class="card card-navy card-outline">
    <div class="card-header" wire:loading.class="invisible">
        <h3 class="card-title">
            Titulo
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool">
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool">
                <i class="fas fa-ban"></i> Cancelar
            </button>
            <button type="button" class="btn btn-tool d-md-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body table-responsive" wire:loading.class="invisible" style="max-height: calc(100vh - {{ $size }}px)">

        hola

    </div>

    <div class="card-footer text-center" wire:loading.class="invisible">

        <button type="button" class="btn btn-default btn-sm mr-1" onclick="confirmToastBootstrap('delete')">
            <i class="fas fa-trash-alt"></i> Borrar
        </button>

        <button type="button" class="btn btn-default btn-sm"
                @if(!comprobarPermisos('empresas.edit')) disabled @endif>
            <i class="fas fa-edit"></i> Editar Información
        </button>

    </div>

    {!! verSpinner() !!}

</div>
