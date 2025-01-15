<form wire:submit="generarReporte">
    <div wire:ignore.self class="modal fade" id="modal-default-generar-reporte">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content {{--fondo--}}">
                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        Generar Reporte
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </div>
                <div class="modal-body" wire:loading.class="invisible">

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Filtro:</small>
                        <div class="input-group">
                            <select class="custom-select @error('filtro') is-invalid @enderror" wire:model="filtro">
                                <option value="all">Todos</option>
                                <option value="transferencia">Tranferencias</option>
                                <option value="movil">Pago Móvil</option>
                                <option value="zelle">Zelle</option>
                            </select>
                            @error('filtro')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Desde:</small>
                        <div class="input-group">
                            <input type="date" wire:model="desde" class="form-control @error('desde') is-invalid @enderror" placeholder="Desde">
                            @error('desde')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Hasta:</small>
                        <div class="input-group">
                            <input type="date" wire:model="hasta" class="form-control @error('hasta') is-invalid @enderror" placeholder="Desde">
                            @error('hasta')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between" wire:loading.class="invisible">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="far fa-file-excel"></i>
                        Descargar Excel
                    </button>
                </div>
                {!! verSpinner() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
