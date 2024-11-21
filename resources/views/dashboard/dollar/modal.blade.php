<form wire:submit="save">
    <div wire:ignore.self class="modal fade" id="modal-default-dollar" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content {{--fondo--}}">
                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        Precio del dólar
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="form-group">
                                <small>Monto Bs:</small>
                                <div class="input-group mb-3">
                                    <input type="number" wire:model="monto" step="0.01" min="1" class="form-control" placeholder="Monto en Bs.">
                                    @error('monto')
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
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                {!! verSpinner() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

<form wire:submit="saveEmail">
    <div wire:ignore.self class="modal fade" id="modal-corro-email-sistema" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content {{--fondo--}}">
                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        Correo Electrónico
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="form-group">
                                <small>Email:</small>
                                <div class="input-group mb-3">
                                    <input type="email" wire:model="email" class="form-control" placeholder="Email">
                                    @error('email')
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_email_sistema">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                {!! verSpinner() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

<form wire:submit="saveTelefono">
    <div wire:ignore.self class="modal fade" id="modal-telefono-soporte-sistema" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content {{--fondo--}}">
                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        Teléfono Soporte
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="form-group">
                                <small>Teléfono:</small>
                                <div class="input-group mb-3">
                                    <input type="text" wire:model="telefono" class="form-control" placeholder="Teléfono">
                                    @error('telefono')
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_email_sistema">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                {!! verSpinner() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>


