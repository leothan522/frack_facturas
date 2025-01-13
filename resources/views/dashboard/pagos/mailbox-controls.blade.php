<div class="mailbox-controls">

    <div class="btn-group btn-group-sm">
        <button type="button" class="btn btn-default" data-toggle="dropdown" aria-expanded="false">{{ getMetodoPago($metodo) }}</button>
        <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            @foreach(getMetodoPago() as $key => $value)
                @if($key != $metodo)
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
        {{ $listar->links('layouts.custom-pagination-links') }}
    </div>
</div>
