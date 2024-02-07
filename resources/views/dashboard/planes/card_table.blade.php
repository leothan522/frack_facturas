<div class="card card-outline card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Resultados de la Busqueda { <b class="text-danger">{{ $keyword }}</b> }
                <button class="btn btn-tool text-danger" wire:click="limpiar"><i class="fas fa-times-circle"></i>
                </button>
            @else
                Planes Registrados
            @endif
        </h3>

        <div class="card-tools">
            <ul class="pagination pagination-sm float-right m-1">
                {{ $planes->links() }}
            </ul>
        </div>
    </div>
    <div class="card-body table-responsive p-0" {{--style="height: 400px;"--}}>
        <table class="table {{--table-head-fixed--}} table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th>Organización</th>
                <th>Nombre</th>
                <th class="text-right">Subida</th>
                <th class="text-right">Bajada</th>
                <th class="text-right">Precio</th>
                <th style="width: 5%;">Moneda</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($planes->isNotEmpty())
                @foreach($planes as $plan)
                    <tr>
                        <td>{{ $plan->organizacion->nombre }}</td>
                        <td>{{ $plan->nombre }}</td>
                        <td class="text-right">{{ $plan->bajada }} Mbps.</td>
                        <td class="text-right">{{ $plan->subida }} Mbps.</td>
                        <td class="text-right">{{ formatoMillares($plan->precio, 2) }}</td>
                        <td>{{ $plan->organizacion->moneda }} </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button wire:click="edit({{ $plan->id }})" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="6">
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
