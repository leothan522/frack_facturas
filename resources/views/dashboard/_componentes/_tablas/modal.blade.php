<div wire:ignore.self class="modal fade" id="modal-tabla-tipos">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content {{--fondo--}}">
            <div class="modal-header bg-navy">
                <h4 class="modal-title">
                    {{ $modalTitle }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">×</span>
                </button>
            </div>
            <div class="modal-body" {{--wire:loading.class="invisible" wire:target="create, cancel, edit"--}} style="min-height: {{ $min }}px;">

                <div class="row justify-content-center">

                    <form wire:submit="buscar" class="col-md-8 mb-3">
                        <div class="input-group close">
                            <input type="search" class="form-control" placeholder="Buscar" wire:model="keyword" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="col-12 @if($ocultarTable) d-none @endif">
                        @include('dashboard.bienes.tipos.table')
                    </div>

                    <div class="col-12 @if($ocultarCard) d-none @endif">
                        @include('dashboard.bienes.tipos.form')
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            {{--{!! verSpinner('create, cancel, edit') !!}--}}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
