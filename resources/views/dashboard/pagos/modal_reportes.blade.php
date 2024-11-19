<form wire:submit="generarReporte">
    <div wire:ignore.self class="modal fade" id="modal-default-generar-reporte" xmlns:wire="http://www.w3.org/1999/xhtml">
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
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-12">

                            <div class="form-group">
                                <small>Filtro:</small>
                                <div class="input-group mb-3">
                                    <select class="custom-select" wire:model="filtro">
                                        <option value="all">Todos</option>
                                        <option value="transferencia">Tranferencias</option>
                                        <option value="movil">Pago Móvil</option>
                                        <option value="zelle">Zelle</option>
                                    </select>
                                    @error('filtro')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <small>Desde:</small>
                                <div class="input-group mb-3">
                                    <input type="date" wire:model="desde" class="form-control">
                                    @error('desde')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <small>Hasta:</small>
                                <div class="input-group mb-3">
                                    <input type="date" wire:model="hasta" class="form-control">
                                    @error('hasta')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default_dollar">Cerrar</button>
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


