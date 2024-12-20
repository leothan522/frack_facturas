<div class="card card-outline card-primary" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Búsqueda
                <span class="text-nowrap">{ <b class="text-warning">{{ $keyword }}</b> }</span>
                <span class="text-nowrap">[ <b class="text-warning">{{ $totalRows }}</b> ]</span>
                <button class="d-sm-none btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times"></i>
                </button>
            @else
                Servicios [ <b class="text-warning">{{ $rowsServicios }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            @if($keyword)
                <button class="d-none d-sm-inline-block btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times"></i>
                </button>
            @endif
            <button type="button" class="btn btn-tool" wire:click="limpiar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="btn btn-tool" data-toggle="modal" data-target="#modal-default" wire:click="limpiar">
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($rows >= $rowsServicios) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" @if($tableStyle) style="height: 67vh;" @endif >
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-lightblue">
                <th class=" text-uppercase text-center" style="width: 10%">Código</th>
                <th class=" text-uppercase">Cliente</th>
                <th class="d-none d-lg-table-cell text-uppercase">Email</th>
                <th class="d-none d-lg-table-cell text-uppercase">Plan</th>
                <th class="d-none d-lg-table-cell text-uppercase">Organización</th>
                <th class="d-none d-lg-table-cell text-uppercase text-center">Fecha Pago</th>
                <th class="text-center" style="width: 5%;"><small class="text-muted">Rows {{ $servicios->count() }}</small></th>
            </tr>
            </thead>
            <tbody>
            @if($servicios->isNotEmpty())
                @foreach($servicios as $servicio)
                    <tr>
                        <td class="text-uppercase text-center">{{ $servicio->codigo }}</td>
                        <td class="text-uppercase d-table-cell text-truncate"
                            style="max-width: 150px;">{{ $servicio->cliente->nombre }} {{ $servicio->cliente->apellido }}</td>
                        <td class="d-none d-lg-table-cell text-lowercase">{{ $servicio->cliente->email }}</td>
                        <td class="d-none d-lg-table-cell">{{ $servicio->plan->nombre }}</td>
                        <td class="d-none d-lg-table-cell">{{ $servicio->organizacion->nombre }}</td>
                        <td class="d-none d-lg-table-cell text-center">{{ getFecha($servicio->cliente->fecha_pago) }}</td>
                        <td class="justify-content-end">
                            <div class="d-md-none">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm" onclick="getFacturas('{{ $servicio->rowquid }}')" data-card-widget="remove">
                                        <i class="fas fa-file-invoice"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default" wire:click="showServicio('{{ $servicio->rowquid }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-none d-md-block">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm" onclick="getFacturas('{{ $servicio->rowquid }}')" data-card-widget="remove">
                                        <i class="fas fa-file-invoice"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default" wire:click="showServicio('{{ $servicio->rowquid }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default" wire:click="edit('{{ $servicio->rowquid }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" wire:click="destroy('{{ $servicio->rowquid }}')">
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
        <div class="row justify-content-between">
            <small>Mostrando {{ $servicios->count() }}</small>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" wire:click="btnFacturarAutomatico">
                    <i class="fas fa-power-off @if($facturarAutomatico) text-success @endif"></i>
                    Facturar Automático
                </button>
            </div>
        </div>
    </div>

    {!!  verSpinner() !!}

</div>
