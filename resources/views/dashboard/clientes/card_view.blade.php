<div class="card card-primary card-outline" id="div_view_card_{{ $modulo }}">

    <div class="card-header" id="div_view_header_{{ $modulo }}" wire:loading.class="invisible" wire:target="create, cancel, show, showHide, edit, btnReenviar">
        <h3 class="card-title">
            {{ $title }}
        </h3>

        <div class="card-tools">
            @if(!$form)
                <button type="button" class="btn btn-tool" wire:click="show('{{ $rowquid }}')">
                    <i class="fas fa-sync-alt"></i>
                </button>
            @endif
            @if($btnNuevo)
                <button type="button" class="btn btn-tool" wire:click="create" @if(!comprobarPermisos($modulo.'.create')) disabled @endif>
                    <i class="fas fa-file"></i> Nuevo
                </button>
            @endif
            @if($btnCancelar)
                <button type="button" class="btn btn-tool" wire:click="cancel">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
            @endif
            <button type="button" class="btn btn-tool d-md-none" wire:click="showHide">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="card-body table-responsive" id="div_view_body_{{ $modulo }}" wire:loading.class="invisible" wire:target="create, cancel, save, show, showHide, edit, btnReenviar" style="max-height: calc(100vh - {{ $size - $sizeFooter }}px)">

        <form class="row" wire:submit="save">

            <div class="col-sm-7 col-lg-6">

                <div class="card card-outline card-navy" >

                    <div class="card-header">
                        <h5 class="card-title">Datos Básicos</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-book"></i></span>
                        </div>
                    </div>

                    <div class="card-body @if(!$form) p-0 @endif ">
                        @if($form)
                            @include('dashboard.clientes.form')
                        @else
                            @include('dashboard.clientes.show')
                        @endif
                    </div>

                </div>

            </div>

            <div class="col-sm-5 col-lg-6">

                <div class="card card-outline card-navy" >

                    <div class="card-header">
                        <h5 class="card-title">Datos Instalación</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-book"></i></span>
                        </div>
                    </div>

                    <div class="card-body @if(!$form) p-0 @endif ">
                        @if($form)
                            @include('dashboard.clientes.form_instalacion')
                        @else
                            @include('dashboard.clientes.show_instalacion')
                        @endif
                    </div>

                </div>

            </div>

            @if($form)
                <div class="col-12">
                    <button type="submit" class="col-md-4 float-right btn btn-block @if($table_id) btn-primary @else btn-success @endif">
                        <i class="fas fa-save mr-1"></i>
                        Guardar
                        @if($table_id)
                            Cambios
                        @endif
                    </button>
                </div>
            @else
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-default btn-sm" wire:click="btnReenviar">
                        <i class="fas fa-paper-plane"></i> Reenviar Bienvenida
                    </button>
                    <button type="button" class="btn btn-default btn-sm ml-1 d-md-none" wire:click="btnFacturasCliente"
                            data-toggle="modal" data-target="#modal-facturas-cliente" onclick="verFacturasCliente()">
                        <i class="fas fa-file-invoice"></i> Facturas Cliente
                    </button>
                </div>
            @endif


        </form>

    </div>

    @if(!$form)
        <div class="card-footer text-center" id="div_view_footer_{{ $modulo }}" wire:loading.class="invisible" wire:target="create, cancel, show, showHide, edit, btnReenviar">


            <button type="button" class="btn btn-default btn-sm mr-1" onclick="confirmToastBootstrap('{{ $confirmed }}', { rowquid: '{{ $rowquid }}'})"
                    @if(!comprobarPermisos($modulo.'.destroy')) disabled @endif>
                <i class="fas fa-trash-alt"></i> Borrar
            </button>

            <button type="button" class="btn btn-default btn-sm mr-1" wire:click="btnPlanServicio"
                    data-toggle="modal" data-target="#modal-cliente-servicio" onclick="verPlanServicio()">
                <i class="far fa-file-alt"></i> Plan de Servicio
            </button>

            <button type="button" class="btn btn-default btn-sm mr-1 d-none d-md-inline" wire:click="btnFacturasCliente"
                    data-toggle="modal" data-target="#modal-facturas-cliente" onclick="verFacturasCliente()">
                <i class="fas fa-file-invoice"></i> Facturas Cliente
            </button>

            <button type="button" class="btn btn-default btn-sm" wire:click="edit"
                    @if(!comprobarPermisos($modulo.'.edit')) disabled @endif>
                <i class="fas fa-edit"></i> Editar
            </button>

        </div>
    @endif

    {!! verSpinner('create, cancel, save, show, showHide, edit, btnReenviar') !!}

</div>
