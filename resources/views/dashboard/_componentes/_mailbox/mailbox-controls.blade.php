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
        {{ $listar->links('layouts.custom-pagination-links') }}
    </div>
</div>
