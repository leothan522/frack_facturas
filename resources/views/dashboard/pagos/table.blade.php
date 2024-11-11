<div class="card card-navy <!--card-outline-->">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Búsqueda <span class="d-none d-md-inline-block">{ <b class="text-warning">{{ $keyword }}</b> } [ <b class="text-warning mb-3">{{ $rows }}</b> ] </span>
                <button class="btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times-circle"></i>
                </button>
            @else
                {{ $filtro[$tipo] }} [ <b class="text-warning">{{ $rows }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <form class="form-inline" wire:submit="buscar">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Buscar" wire:model="keyword" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="mailbox-controls">

            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-default" data-toggle="dropdown" aria-expanded="false">{{ $filtro[$tipo] }}</button>
                <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    @foreach($filtro as $key => $value)
                        @if($key != $tipo)
                            <button type="button" wire:click="btnFiltro('{{ $key }}')" class="dropdown-item">{{ $value }}</button>
                        @endif
                    @endforeach
                </div>
            </div>

            @if($order == 'DESC')
                <button type="button" class="btn btn-default btn-sm" wire:click="orderAscending">
                    <i class="fas fa-sort-amount-down"></i>
                </button>
            @else
                <button type="button" class="btn btn-default btn-sm" wire:click="orderDescending">
                    <i class="fas fa-sort-amount-up-alt"></i>
                </button>
            @endif
            <button type="button" class="btn btn-default btn-sm" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <div class="float-right">
                {{ $pagos->links('layouts.custom-pagination-links') }}
            </div>
            <!-- /.float-right -->
        </div>
        <div class="table-responsive mailbox-messages" style="height: 68vh;">
            <table class="table table-hover table-striped">
                <tbody>
                @if($pagos->isNotEmpty())
                    @foreach($pagos as $pago)
                        <tr>
                            <td class="mailbox-attachment">
                                {!! $icono[$pago->estatus] !!}
                            </td>
                            <td class="mailbox-name text-nowrap text-uppercase">
                                <a class="link-dark" wire:click="show('{{ $pago->rowquid }}')" data-toggle="modal" data-target="#modal-default" style="cursor: pointer;">
                                    {{ $pago->referencia }}
                                </a>
                            </td>
                            <td class="mailbox-subject text-nowrap text-truncate" style="max-width: 200px;">

                                <b>{{ $pago->moneda }} {{ formatoMillares($pago->monto) }}</b> - {{ $filtro[$pago->metodo] }}

                            </td>
                            <td class="d-none d-md-table-cell text-nowrap text-uppercase text-truncate" style="max-width: 150px;">
                                {{ $pago->factura->cliente_nombre }} {{ $pago->factura->cliente_apellido }}
                            </td>
                            <td class="d-none d-md-table-cell text-nowrap text-uppercase">
                                Factura #: <a href="{{ route('facturas.pdf', $pago->factura->rowquid) }}" target="_blank" class="text-truncate">{{ $pago->factura->factura_numero }}</a>
                            </td>
                            <td class="mailbox-date text-center text-nowrap d-none d-md-table-cell">
                                {{ getFecha($pago->fecha) }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    @if($keyword)
                        <tr>
                            <td colspan="4" class="mailbox-subject text-center">
                                Sin Resultados.
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="4" class="mailbox-subject text-center">
                                Sin Registros Guardados.
                            </td>
                        </tr>
                    @endif
                @endif
                </tbody>
            </table>
            <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer p-0">
        <div class="mailbox-controls">

            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-default" data-toggle="dropdown" aria-expanded="false">{{ $filtro[$tipo] }}</button>
                <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    @foreach($filtro as $key => $value)
                        @if($key != $tipo)
                            <button type="button" wire:click="btnFiltro('{{ $key }}')" class="dropdown-item">{{ $value }}</button>
                        @endif
                    @endforeach
                </div>
            </div>

            @if($order == 'DESC')
                <button type="button" class="btn btn-default btn-sm" wire:click="orderAscending">
                    <i class="fas fa-sort-amount-down"></i>
                </button>
            @else
                <button type="button" class="btn btn-default btn-sm" wire:click="orderDescending">
                    <i class="fas fa-sort-amount-up-alt"></i>
                </button>
            @endif
            <button type="button" class="btn btn-default btn-sm" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <div class="float-right">
                {{ $pagos->links('layouts.custom-pagination-links') }}
            </div>

        </div>
    </div>

    {!! verSpinner() !!}

</div>
