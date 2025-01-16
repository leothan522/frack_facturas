<div wire:ignore.self class="card card-primary card-outline" id="card_registro_pago">
    <div class="card-header" id="card_registro_pago_header" wire:loading.class="invisible" wire:target="">
        <h3 class="card-title">
            {{ $title }}
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" {{--wire:click="cancel"--}} onclick="cancelarRegistroPago()">
                <i class="fas fa-ban"></i> Cancelar
            </button>
            {{--<button type="button" class="btn btn-tool " --}}{{--data-card-widget="remove"--}}{{-->
                <i class="fas fa-times"></i>
            </button>--}}
        </div>
    </div>
    <div class="card-body table-responsive" id="card_registro_pago_body" wire:loading.class="invisible" wire:target="save" style="max-height: calc(100vh - {{ $size }}px)">

        <form class="row" wire:submit="save">

            <div class="col-sm-7 col-lg-6">

                <div class="card card-outline card-navy" >

                    <div class="card-header">
                        <h5 class="card-title">Datos Factura</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-file-invoice"></i></span>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('dashboard.pagos.registrar.form_factura')
                    </div>

                </div>

            </div>

            <div class="col-sm-5 col-lg-6">
                <div class="card card-outline card-navy" >

                    <div class="card-header">
                        <h5 class="card-title">Datos Pago</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-file-invoice-dollar"></i></span>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('dashboard.pagos.registrar.form_pago')
                    </div>

                </div>
            </div>

            <div class="col-12">
            <button type="submit" class="col-md-4 float-right btn btn-block btn-success">
                <i class="fas fa-save mr-1"></i>
                Guardar
            </button>
        </div>

        </form>

    </div>

    {!! verSpinner() !!}

</div>

