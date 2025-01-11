<div class="card card-primary card-outline" id="div_view_card_{{ $modulo }}">

    <div class="card-header" id="div_view_header_{{ $modulo }}" wire:loading.class="invisible" wire:target="create, cancel, show, showHide, edit">
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

    <div class="card-body table-responsive" id="div_view_body_{{ $modulo }}" wire:loading.class="invisible" wire:target="create, cancel, save, show, showHide, edit" style="max-height: calc(100vh - {{ $size - $sizeFooter }}px)">

        <form class="row justify-content-center" wire:submit="save">

            <div class="col-sm-7 col-lg-6">

                <div class="card card-outline card-navy" >

                    <div class="card-header">
                        <h5 class="card-title">Información</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-book"></i></span>
                        </div>
                    </div>

                    <div class="card-body @if(!$form) p-0 @endif ">
                        <div class="@if(!$form) d-none @endif">
                            @include('dashboard.planes.form')
                        </div>
                        <div class="@if($form) d-none @endif">
                            @include('dashboard.planes.show')
                        </div>
                    </div>

                </div>

            </div>

            {{--<div class="col-sm-5 col-lg-6">

                <div class="card card-outline card-navy">

                    <div class="card-header">
                        <h5 class="card-title">Imagen</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-image"></i></span>
                        </div>
                    </div>

                    <div class="card-body @if(!$form) attachment-block p-0 m-0 @endif ">
                        @if($form)
                             @include('dashboard.organizaciones.form_imagen')
                        @else
                            @include('dashboard.organizaciones.show_imagen')
                        @endif
                    </div>
                </div>

            </div>--}}

            @if($form)
                <div class="col-12">
                    <div class="col-md-4 float-right">
                        <button type="submit" class="btn btn-block @if($table_id) btn-primary @else btn-success @endif">
                            <i class="fas fa-save mr-1"></i>
                            Guardar
                            @if($table_id)
                                Cambios
                            @endif
                        </button>
                    </div>
                </div>
            @endif


        </form>

    </div>

    @if(!$form)
        <div class="card-footer text-center" id="div_view_footer_{{ $modulo }}" wire:loading.class="invisible" wire:target="create, cancel, show, showHide, edit">


            <button type="button" class="btn btn-default btn-sm mr-1" onclick="confirmToastBootstrap('{{ $confirmed }}', { rowquid: '{{ $rowquid }}'})"
                    @if(!comprobarPermisos($modulo.'.destroy')) disabled @endif>
                <i class="fas fa-trash-alt"></i> Borrar
            </button>

            <button type="button" class="btn btn-default btn-sm" wire:click="edit"
                    @if(!comprobarPermisos($modulo.'.edit')) disabled @endif>
                <i class="fas fa-edit"></i> Editar
            </button>

        </div>
    @endif

    {!! verSpinner('create, cancel, save, show, showHide, edit') !!}

</div>
