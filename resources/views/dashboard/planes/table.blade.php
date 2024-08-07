<div class="card card-outline card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Busqueda { <b class="text-danger">{{ $keyword }}</b> }
                <button class="btn btn-tool text-danger" wire:click="limpiar"><i class="fas fa-times-circle"></i>
                </button>
            @else
                Registrados
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="limpiar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="btn btn-tool" data-toggle="modal" data-target="#modal-default" wire:click="limpiar">
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($rows > $rowsPlanes) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" @if($tableStyle) style="height: 72vh;" @endif >
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th>Nombre</th>
                <th class="d-none d-lg-table-cell">Organización</th>
                <th class="d-none d-lg-table-cell text-right">Etiqueta</th>
                <th class="d-none d-lg-table-cell text-right">Subida</th>
                <th class="d-none d-lg-table-cell text-right">Bajada</th>
                <th class="d-none d-lg-table-cell text-right">Precio</th>
                <th class="d-none d-lg-table-cell" style="width: 5%;">Moneda</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($planes->isNotEmpty())
                @foreach($planes as $plan)
                    <tr>
                        <td class="text-uppercase">{{ $plan->nombre }}</td>
                        <td class="d-none d-lg-table-cell text-uppercase">{{ $plan->organizacion->nombre }}</td>
                        <td class="d-none d-lg-table-cell text-right">{{ $plan->etiqueta_factura }}</td>
                        <td class="d-none d-lg-table-cell text-right">{{ $plan->bajada }} Mbps.</td>
                        <td class="d-none d-lg-table-cell text-right">{{ $plan->subida }} Mbps.</td>
                        <td class="d-none d-lg-table-cell text-right">{{ formatoMillares($plan->precio, 2) }}</td>
                        <td class="d-none d-lg-table-cell">{{ $plan->organizacion->moneda }} </td>
                        <td class="text-center">
                            <div class="d-md-none">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-default" wire:click="showPlan({{ $plan->id }})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-none d-md-block">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal-default" wire:click="edit({{ $plan->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-primary btn-xs" wire:click="destroy({{ $plan->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="7">
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

    <div class="card-footer">
        <small>Mostrando {{ $planes->count() }}</small>
    </div>

    {!! verSpinner() !!}

</div>
