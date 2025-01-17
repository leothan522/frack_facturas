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
                <div class="modal-body" wire:loading.class="invisible">
                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Monto Bs:</small>
                        <div class="input-group">
                            <input type="number" step="0.01" min="1" wire:model="monto" class="form-control @error('monto') is-invalid @enderror" placeholder="Monto en Bs.">
                            @error('monto')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between" wire:loading.class="invisible">
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
                        Correo Soporte
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </div>
                <div class="modal-body" wire:loading.class="invisible">

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">{{ __('Email') }}:</small>
                        <div class="input-group">
                            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            @error('email')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between" wire:loading.class="invisible">
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
                <div class="modal-body" wire:loading.class="invisible">
                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Teléfono:</small>
                        <div class="input-group">
                            <input type="text" wire:model="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Teléfono">
                            @error('telefono')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between" wire:loading.class="invisible">
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


