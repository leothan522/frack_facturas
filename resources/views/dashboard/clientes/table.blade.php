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
                Todos [ <b class="text-warning">{{ $rowsClientes }}</b> ]
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
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($rows >= $rowsClientes) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" @if($tableStyle) style="height: 67vh;" @endif >
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-lightblue">
                <th class=" text-uppercase" style="width: 10%">Cédula</th>
                <th class=" text-uppercase">Nombre</th>
                <th class="d-none d-lg-table-cell text-uppercase">Teléfono</th>
                <th class="d-none d-lg-table-cell text-uppercase">Email</th>
                <th class="d-none d-lg-table-cell text-uppercase text-center">Instalación</th>
                <th class="d-none d-lg-table-cell text-uppercase text-center">Fecha Pago</th>
                <th class="text-center" style="width: 5%;"><small class="text-muted">Rows {{ $clientes->count() }}</small></th>
            </tr>
            </thead>
            <tbody>
            @if($clientes->isNotEmpty())
                @foreach($clientes as $cliente)
                    <tr>
                        <td class="text-uppercase text-right">{{ is_numeric($cliente->cedula) ? formatoMillares($cliente->cedula,0) : $cliente->cedula }}</td>
                        <td class="text-uppercase d-table-cell text-truncate" style="max-width: 150px;">{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                        <td class="d-none d-lg-table-cell">{{ $cliente->telefono }}</td>
                        <td class="d-none d-lg-table-cell text-lowercase">{{ $cliente->email }}</td>
                        <td class="d-none d-lg-table-cell text-center">{{ getFecha($cliente->fecha_instalacion) }}</td>
                        <td class="d-none d-lg-table-cell text-center">{{ getFecha($cliente->fecha_pago) }}</td>
                        <td class="text-center justify-content-center">
                            <div class="d-md-none">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default" wire:click="showCliente('{{ $cliente->rowquid }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-none d-md-block">
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default" wire:click="showCliente('{{ $cliente->rowquid }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default" wire:click="edit('{{ $cliente->rowquid }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" wire:click="destroy('{{ $cliente->rowquid }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="10">
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
        <small>Mostrando {{ $clientes->count() }}</small>
    </div>

    {!! verSpinner() !!}
</div>
