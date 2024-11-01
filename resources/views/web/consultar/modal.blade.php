{{--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Launch Default Modal
</button>--}}

<form>
    <div wire:ignore.self class="modal fade" id="modal-default" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content {{--fondo--}}">

                <div class="modal-header">
                    <h4 class="modal-title">
                        ¿Cómo vas a pagar?
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" {{--class="text-white"--}}>×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div>
                        @include('web.consultar.metodos')
                    </div>

                    <div>
                        @include('web.consultar.detalles')
                    </div>

                    <div>
                        @include('web.consultar.form')
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">Cerrar</button>
                    <button type="submit" class="btn btn-primary" disabled>Registrar Pago</button>
                </div>

                {!! verSpinner() !!}

            </div>
        </div>

    </div>
</form>
