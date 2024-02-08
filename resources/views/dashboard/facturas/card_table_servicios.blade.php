<div class="card card-outline card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Resultados de la Busqueda { <b class="text-danger">{{ $keyword }}</b> }
                <button class="btn btn-tool text-danger" wire:click="limpiar"><i class="fas fa-times-circle"></i>
                </button>
            @else
                Servicios Registrados
            @endif
        </h3>

        <div class="card-tools">
            <ul class="pagination pagination-sm float-right m-1">
                {{ $servicios->links() }}
            </ul>
        </div>
    </div>
    <div class="card-body table-responsive p-0" {{--style="height: 400px;"--}}>
        <table class="table {{--table-head-fixed--}} table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th class="text-center">Codigo</th>
                <th>Cliente</th>
                <th>Plan</th>
                <th>Organización</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($servicios->isNotEmpty())
                @foreach($servicios as $servicio)
                    <tr>
                        <td class="text-center">{{ $servicio->codigo }}</td>
                        <td>{{ $servicio->cliente->nombre }} {{ $servicio->cliente->apellido }}</td>
                        <td>{{ $servicio->plan->nombre }}</td>
                        <td>{{ $servicio->organizacion->nombre }}</td>
                        <td class="justify-content-end">
                            <div class="btn-group">
                                <button wire:click="edit({{ $servicio->id }})" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-servicios">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button wire:click="getFacturas({{ $servicio->id }})" class="btn btn-primary btn-sm">
                                    <i class="fas fa-file-invoice"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="5">
                        @if($keyword)
                            <span>Sin resultados</span>
                        @else
                            <span>Sin registros guardados</span>
                        @endif
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="modal-footer justify-content-end">
        <div class="card-tools">
            <button class="btn btn-sm btn-tool" wire:click="limpiar" data-toggle="modal" data-target="#modal-servicios">
                <i class="fas fa-file"></i> Nuevo Servicio
            </button>
        </div>
    </div>
</div>
