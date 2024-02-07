<div class="card card-outline card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Resultados de la Busqueda { <b class="text-danger">{{ $keyword }}</b> }
                <button class="btn btn-tool text-danger" wire:click="limpiar"><i class="fas fa-times-circle"></i>
                </button>
            @else
                Clientes Registrados
            @endif
        </h3>

        <div class="card-tools">
            <ul class="pagination pagination-sm float-right m-1">
                {{ $clientes->links() }}
            </ul>
        </div>
    </div>
    <div class="card-body table-responsive p-0" {{--style="height: 400px;"--}}>
        <table class="table {{--table-head-fixed--}} table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th class="d-none d-lg-table-cell">Email</th>
                {{--<th class="d-none d-lg-table-cell">Instalación</th>--}}
                <th class="d-none d-lg-table-cell">Fecha Pago</th>
                <th class="d-none d-lg-table-cell">Latitud</th>
                <th class="d-none d-lg-table-cell">Longitud</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($clientes->isNotEmpty())
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->cedula }}</td>
                        <td>{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td class="d-none d-lg-table-cell">{{ $cliente->email }}</td>
                        {{--<td class="d-none d-lg-table-cell">{{ verFecha($cliente->fecha_instalacion) }}</td>--}}
                        <td class="d-none d-lg-table-cell">{{ verFecha($cliente->fecha_pago) }}</td>
                        <td class="d-none d-lg-table-cell">{{ $cliente->latitud }}</td>
                        <td class="d-none d-lg-table-cell">{{ $cliente->longitud }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button wire:click="edit({{ $cliente->id }})" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>

                                {{--<button --}}{{--wire:click="destroy({{ $parametro->id }})"--}}{{-- class="btn btn-primary btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>--}}
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
    {!! verSpinner() !!}
</div>
