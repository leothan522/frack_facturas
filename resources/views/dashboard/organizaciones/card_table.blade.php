<div class="card card-outline card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Resultados de la Busqueda { <b class="text-danger">{{ $keyword }}</b> }
                <button class="btn btn-tool text-danger" wire:click="limpiar"><i class="fas fa-times-circle"></i>
                </button>
            @else
                Organizaciones Registradas
            @endif
        </h3>

        <div class="card-tools">
            <ul class="pagination pagination-sm float-right m-1">
                {{ $organizaciones->links() }}
            </ul>
        </div>
    </div>
    <div class="card-body table-responsive p-0" {{--style="height: 400px;"--}}>
        <table class="table {{--table-head-fixed--}} table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th>Nombre</th>
                <th class="d-none d-lg-table-cell">Email</th>
                <th>Telefono</th>
                <th>Moneda</th>
                {{--<th class="d-none d-lg-table-cell">Web</th>--}}
                <th class="d-none d-lg-table-cell text-right">Dias Factura</th>
                <th class="d-none d-lg-table-cell text-right">Formato Factura</th>
                <th class="d-none d-lg-table-cell text-right">Proxima Factura</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($organizaciones as $organizacion)
                <tr>
                    <td>{{ $organizacion->nombre }}</td>
                    <td class="d-none d-lg-table-cell">{{ $organizacion->email }}</td>
                    <td>{{ $organizacion->telefono }}</td>
                    <td>{{ $organizacion->moneda }}</td>
                    {{--<td class="d-none d-lg-table-cell">{{ $organizacion->dias_factura }}</td>--}}
                    <td class="d-none d-lg-table-cell text-right">{{ $organizacion->dias_factura }}</td>
                    <td class="d-none d-lg-table-cell text-right">{{ $organizacion->formato_factura }}</td>
                    <td class="d-none d-lg-table-cell text-right">{{ $organizacion->proxima_factura }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button wire:click="edit({{ $organizacion->id }})" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {!! verSpinner() !!}
</div>
