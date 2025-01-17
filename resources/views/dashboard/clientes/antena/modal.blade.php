{{--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Launch Default Modal
</button>--}}

<div wire:ignore.self class="modal fade" id="modal-default-antena-sectorial">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content {{--fondo--}}">
            <div class="modal-header bg-navy">
                <h4 class="modal-title" wire:loading.class="invisible">
                    <i class="fas fa-satellite-dish"></i> Antena Sectorial
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">×</span>
                </button>
            </div>
            <div class="modal-body" wire:loading.class="invisible">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer" wire:loading.class="invisible">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default_antena_sectorial">Cerrar</button>
                {{--<button type="submit" class="btn btn-success">Guardar</button>--}}
            </div>
            {!! verSpinner() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
