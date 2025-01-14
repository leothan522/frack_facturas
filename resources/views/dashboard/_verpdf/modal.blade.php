<div wire:ignore.self class="modal fade" id="modal-ver-pdf">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h4 class="modal-title" wire:loading.class="invisible">
                    <span class="text-nowrap">
                        {{ $title }}
                        @if($codigo)
                            [ <b class="text-warning text-uppercase">{{ $codigo }}</b> ]
                        @endif
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body embed-responsive embed-responsive-4by3" wire:loading.class="invisible">

                @if($verPDF)
                    <iframe class="embed-responsive-item" src="{{ asset('ViewerJS/#../storage/'.$verPDF) }}" allowfullscreen></iframe>
                @endif

            </div>

            <div class="modal-footer" wire:loading.class="invisible">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
                </button>
            </div>

            {!! verSpinner() !!}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

