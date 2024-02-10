<div class="card card-outline card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if(/*$keyword*/false)
                Resultados de la Busqueda { <b class="text-danger">{{ $keyword }}</b> }
                <button class="btn btn-tool text-danger" wire:click="limpiar"><i class="fas fa-times-circle"></i>
                </button>
            @else
                Facturas del Cliente
            @endif
        </h3>

        <div class="card-tools">
            <ul class="pagination pagination-sm float-right m-1">
                {{--<li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>--}}
            </ul>
        </div>
    </div>
    <div class="card-body table-responsive" {{--style="height: 400px;"--}}>
        @if($viewFactura)
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">{{ $codigo }}</li>
                        <li class="breadcrumb-item active">{{ $cliente }}</li>
                        <li class="breadcrumb-item active">{{ $plan }}</li>
                        <li class="breadcrumb-item active">{{ $organizacion }}</li>
                    </ol>
                </div>
            </div>
            <table class="table {{--table-head-fixed--}} table-hover text-nowrap">
                <thead>
                <tr class="text-navy">
                    <th>Factura</th>
                    <th>Plan</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-right">Total</th>
                    <th style="width: 5%;">Moneda</th>
                    <th style="width: 5%;">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @if($listarFacturas->isNotEmpty())
                    @foreach($listarFacturas as $factura)
                        <tr>
                            <td>{{ $factura->factura_numero }}</td>
                            <td>5 megas</td>
                            <td class="text-center">{{ verFecha($factura->factura_fecha) }}</td>
                            <td class="text-right">{{ $factura->factura_total }}</td>
                            <td><span>{{ $factura->organizacion_moneda }}</span></td>
                            <td class="justify-content-end">
                                <div class="btn-group">
                                    <button
                                        {{--wire:click="destroy({{ $parametro->id }})"--}} class="btn btn-primary btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <button
                                        {{--wire:click="destroy({{ $parametro->id }})"--}} class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button
                                        {{--wire:click="edit({{ $parametro->id }})"--}} class="btn btn-primary btn-sm">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center">
                        <td colspan="6">
                            @if(/*$keyword*/false)
                                <span>Sin resultados</span>
                            @else
                                <span>Sin registros guardados</span>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        @else
            <div class="row m-5">
                <div class="col-12">
                    Debes Seleccionar un cliente para empezar...
                </div>
            </div>
        @endif
    </div>

        <div class="modal-footer">
            @if($viewFactura)
            <div class="card-tools">
                @if($botonMasFacturas)
                    <button class="btn btn-sm btn-tool" {{--wire:click="generarFactura"--}}><i class="fas fa-arrow-down"></i> Ver mas facturas</button>
                @endif
                <button class="btn btn-sm btn-tool" wire:click="generarFactura"><i class="fas fa-file"></i> Generar Factura</button>
                <button class="btn btn-sm btn-tool" wire:click="limpiarFacturas">Cerrar</button>
            </div>
            @endif
        </div>
    {!! verSpinner() !!}
</div>
