<div class="card card-primary card-outline" id="div_table_card_{{ $modulo }}">

    <div class="card-header" id="div_table_header_{{ $modulo }}" wire:loading.class="invisible" wire:target="createHide, showHide">

        <h3 class="card-title mb-2 mb-sm-auto">
            @if($keyword)
                Búsqueda
                <span class="text-nowrap">{ <b class="text-warning">{{ $keyword }}</b> }</span>
                <span class="text-nowrap">[ <b class="text-warning">{{ $rows }}</b> ]</span>
                <button class="d-sm-none btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times"></i>
                </button>
            @else
                Todos [ <b class="text-warning">{{ $rows }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            @if($keyword)
                <button class="d-none d-sm-inline-block btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times"></i>
                </button>
            @endif
            <button type="button" class="btn btn-tool" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
                <button class="btn btn-tool d-sm-none" wire:click="createHide" @if(!comprobarPermisos($modulo.'.create')) disabled @endif>
                    <i class="fas fa-file"></i> Nuevo
                </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($btnDisabled) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>

    </div>

    <div class="card-body table-responsive p-0" id="div_table_body_{{ $modulo }}" wire:loading.class="invisible" wire:target="createHide, showHide" style="max-height: calc(100vh - {{ $size }}px)">
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-lightblue">
                <th class="text-center text-uppercase" style="width: 5%">id</th>
                <th class="text-uppercase">nombre</th>
                {{--<th class="d-none d-md-table-cell text-uppercase">table_id</th>
                <th class="d-none d-md-table-cell text-uppercase">valor</th>--}}
                <th class="text-center" style="width: 5%;"><small>Rows {{ $listar->count() }}</small></th>
            </tr>
            </thead>
            <tbody id="tbody_{{ $modulo }}" wire:loading.class="invisible" wire:target="actualizar, cerrarBusqueda, setLimit">
            @if($listar->isNotEmpty())
                @php($i = 0)
                @foreach($listar as $parametro)
                    <tr>
                        <td class="align-middle text-bold text-center">{{ ++$i }}</td>
                        <td class="align-middle d-table-cell text-uppercase text-truncate" style="max-width: 150px;">{{ $parametro->nombre }}</td>
                        {{--<td class="align-middle d-none d-md-table-cell">table_id</td>
                        <td class="align-middle d-none d-md-table-cell text-truncate" style="max-width: 150px;">table_id</td>--}}
                        <td class="justify-content-end">

                            <div class="btn-group d-md-none">
                                <button wire:click="showHide('{{ $parametro->rowquid }}')" class="btn btn-primary"
                                        data-toggle="modal" data-target="#modal-default">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <div class="btn-group d-none d-md-flex">
                                <button wire:click="show('{{ $parametro->rowquid }}')" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="5">
                        @if($keyword)
                            <span>Sin resultados</span>
                        @else
                            <span>Sin registros guardados</span>
                        @endif
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>

    <div class="card-footer" id="div_table_footer_{{ $modulo }}" wire:loading.class="invisible" wire:target="createHide, showHide">
        <small>Mostrando {{ $listar->count() }}</small>
    </div>

    {!! verSpinner('actualizar, cerrarBusqueda, setLimit, createHide, showHide') !!}

</div>
