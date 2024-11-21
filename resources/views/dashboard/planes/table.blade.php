<div class="card card-outline card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Búsqueda { <b class="text-danger">{{ $keyword }}</b> } [ <b class="text-danger">{{ $totalRows }}</b> ]
                <button class="btn btn-tool text-danger" wire:click="cerrarBusqueda">
                    <i class="fas fa-times-circle"></i>
                </button>
            @else
                Total [ <b class="text-danger">{{ $rowsPlanes }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="limpiar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="btn btn-tool" data-toggle="modal" data-target="#modal-default" wire:click="limpiar">
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($rows >= $rowsPlanes) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" @if($tableStyle) style="height: 67vh;" @endif >
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
                <th class="text-center" style="width: 5%;"><small class="text-muted">Rows {{ $planes->count() }}</small></th>
            </tr>
            </thead>
            <tbody>
            @if($planes->isNotEmpty())
                @foreach($planes as $plan)
                    <tr>
                        <td class="text-uppercase">{{ $plan->nombre }}</td>
                        <td class="d-none d-lg-table-cell text-uppercase">{{ $plan->organizacion->nombre }}</td>
                        <td class="d-none d-lg-table-cell text-right text-uppercase">{{ $plan->etiqueta_factura }}</td>
                        <td class="d-none d-lg-table-cell text-right">{{ $plan->bajada }} Mbps.</td>
                        <td class="d-none d-lg-table-cell text-right">{{ $plan->subida }} Mbps.</td>
                        <td class="d-none d-lg-table-cell text-right">{{ formatoMillares($plan->precio, 2) }}</td>
                        <td class="d-none d-lg-table-cell">{{ $plan->organizacion->moneda }} </td>
                        <td class="text-center justify-content-center">
                            <div class="d-md-none">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default" wire:click="showPlan('{{ $plan->rowquid }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-none d-md-block">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default" wire:click="showPlan('{{ $plan->rowquid }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default" wire:click="edit('{{ $plan->rowquid }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" wire:click="destroy('{{ $plan->rowquid }}')">
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
