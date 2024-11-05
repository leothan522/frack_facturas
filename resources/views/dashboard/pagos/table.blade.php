<div class="card card-navy <!--card-outline-->">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Búsqueda { <b class="text-warning">{{ $keyword }}</b> } [ <b class="text-warning">{{ $rows }}</b> ]
                <button class="btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times-circle"></i>
                </button>
            @else
                Total [ <b class="text-warning">{{ $rows }}</b> ]
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
        <div class="table-responsive mailbox-messages" style="height: 64vh;">
            <table class="table table-hover table-striped">
                <tbody>
                @if($pagos->isNotEmpty())
                    @foreach($pagos as $pago)
                        <tr>
                            <td class="mailbox-name text-nowrap">
                                <a class="link-dark" wire:click="show('{{ $pago->rowquid }}')" style="cursor: pointer;">
                                    123654789654
                                </a>
                            </td>
                            <td class="mailbox-subject text-nowrap text-truncate" style="max-width: 150px;">

                                <b>Dirigido a</b>

                            </td>
                            <td>
                                <small class="float-right text-nowrap">
                                    <i class="far fa-copy"></i>
                                </small>
                            </td>
                            <td class="mailbox-attachment d-none d-md-table-cell">
                                <i class="fas fa-paperclip"></i>
                            </td>
                            <td class="mailbox-date text-center text-nowrap d-none d-md-table-cell">
                                02-02-2024
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
