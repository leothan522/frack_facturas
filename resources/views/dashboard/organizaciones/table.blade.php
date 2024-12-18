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
                Todos [ <b class="text-warning">{{ $rowsOrganizaciones }}</b> ]
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
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($rows >= $rowsOrganizaciones) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" @if($tableStyle) style="height: 67vh;" @endif >
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-lightblue">
                <th class="text-uppercase">Nombre</th>
                <th class="d-none d-lg-table-cell text-uppercase">Email</th>
                <th class="d-none d-lg-table-cell text-uppercase">Telefono</th>
                <th class="d-none d-lg-table-cell text-uppercase text-center" style="width: 5%;">Moneda</th>
                <th class="d-none d-lg-table-cell text-uppercase text-right">Dias Factura</th>
                <th class="d-none d-lg-table-cell text-uppercase text-right">Formato Factura</th>
                <th class="d-none d-lg-table-cell text-uppercase text-right">Proxima Factura</th>
                <th class="text-center" style="width: 5%;"><small class="text-muted">Rows {{ $organizaciones->count() }}</small></th>
            </tr>
            </thead>
            <tbody>
            @if($organizaciones->isNotEmpty())
                @foreach($organizaciones as $organizacion)
                    <tr>
                        <td class="text-uppercase">{{ $organizacion->nombre }}</td>
                        <td class="d-none d-lg-table-cell text-lowercase">{{ $organizacion->email }}</td>
                        <td class="d-none d-lg-table-cell text-uppercase">{{ $organizacion->telefono }}</td>
                        <td class="d-none d-lg-table-cell text-center">{{ $organizacion->moneda }}</td>
                        <td class="d-none d-lg-table-cell text-right">{{ $organizacion->dias_factura }}</td>
                        <td class="d-none d-lg-table-cell text-right text-uppercase">{{ $organizacion->formato_factura }}</td>
                        <td class="d-none d-lg-table-cell text-right">
                            @if(!empty($organizacion->proxima_factura))
                                {{ $organizacion->proxima_factura }}
                            @else
                                1
                            @endif
                        </td>
                        <td class="text-center justify-content-center">
                            <div class="d-md-none">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default"
                                            wire:click="showOrganizacion('{{ $organizacion->rowquid }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-none d-md-block">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default"
                                            wire:click="showOrganizacion('{{ $organizacion->rowquid }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default"
                                            wire:click="edit('{{ $organizacion->rowquid }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm"
                                            wire:click="destroy('{{ $organizacion->rowquid }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="8">
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
        <small>Mostrando {{ $organizaciones->count() }}</small>
    </div>

    {!! verSpinner() !!}
</div>
