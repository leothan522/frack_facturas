<!--1-50/200-->
{{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} / {{ $paginator->total() }}
<div class="btn-group">
    @if ($paginator->hasPages())
        @if ($paginator->onFirstPage())
            <button type="button" class="btn btn-default btn-sm disabled">
                <i class="fas fa-chevron-left"></i>
            </button>
        @else
            <button type="button" class="btn btn-default btn-sm" wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                <i class="fas fa-chevron-left"></i>
            </button>
        @endif

        @if ($paginator->onLastPage())
            <button type="button" class="btn btn-default btn-sm disabled">
                <i class="fas fa-chevron-right"></i>
            </button>
        @else
            <button type="button" class="btn btn-default btn-sm" wire:click="nextPage" wire:loading.attr="disabled"
                    rel="next">
                <i class="fas fa-chevron-right"></i>
            </button>
        @endif

    @endif
</div>
