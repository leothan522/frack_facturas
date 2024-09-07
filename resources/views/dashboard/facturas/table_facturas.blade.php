@if($viewFactura)
    <div class="card card-outline card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="card-header">
            <h3 class="card-title">
                @if(/*$keyword*/false)
                    Busqueda { <b class="text-danger">{{ $keyword }}</b> }
                    <button class="btn btn-tool text-danger" wire:click="limpiar"><i class="fas fa-times-circle"></i>
                    </button>
                @else
                    Facturas Cliente
                @endif
            </h3>

            <div class="card-tools">
                <button class="btn btn-sm btn-tool" wire:click="generarFactura"><i class="fas fa-file"></i> Generar
                    Factura
                </button>
                <button type="button" class="btn btn-tool" wire:click="limpiarFacturas" onclick="getServicios()"
                        data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item active">{{ $codigo }}</li>
                        <li class="breadcrumb-item active d-inline-block text-truncate"
                            style="max-width: 200px;">{{ $cliente }}</li>
                        <li class="breadcrumb-item active">{{ $plan }}</li>
                        <li class="breadcrumb-item active d-none d-lg-inline-block">{{ $organizacion }}</li>
                        <li class="breadcrumb-item active">{{ getFecha($fecha_pago, "j-m-Y") }}</li>
                    </ol>
                </div>
            </div>
            <div class="row table-responsive" @if($limit > 12) style="height: 550px;" @endif >
                <table class="table table-sm table-head-fixed table-hover text-nowrap">
                    <thead>
                    <tr class="text-navy">
                        <th>Factura</th>
                        <th class="d-none d-lg-table-cell">Plan</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-right">Total</th>
                        <th class="d-none d-lg-table-cell" style="width: 5%;">Moneda</th>
                        <th style="width: 5%;">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($listarFacturas->isNotEmpty())
                        @php($borrar = true)
                        @foreach($listarFacturas as $factura)
                            <tr>
                                <td class="text-uppercase">{{ $factura->factura_numero }}</td>
                                <td class="d-none d-lg-table-cell text-uppercase">{{ $factura->plan_nombre }}</td>
                                <td class="text-center">{{ getFecha($factura->factura_fecha) }}</td>
                                <td class="text-right">{{ formatoMillares($factura->factura_total) }}</td>
                                <td class="d-none d-lg-table-cell"><span>{{ $factura->organizacion_moneda }}</span></td>
                                <td class="justify-content-end">
                                    <div class="btn-group">
                                        <button wire:click="destroyFactura({{ $factura->id }})"
                                                class="btn btn-primary btn-xs"
                                                @if(!$borrar) disabled @endif >
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <a href="{{ route('facturas.pdf', $factura->id) }}" target="_blank"
                                           class="btn btn-primary btn-xs">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($factura->send)
                                            <button wire:click="reSendFactura({{ $factura->id }})"
                                                    class="btn btn-primary btn-xs">
                                                <i class="fas fa-envelope-open"></i>
                                            </button>
                                        @else
                                            <button wire:click="sendFactura({{ $factura->id }})"
                                                    class="btn btn-primary btn-xs">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @if($borrar)
                                @php($borrar = false)
                            @endif
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
            </div>
        </div>

        <div class="modal-footer">
            <div class="card-tools">
                @if($botonMasFacturas)
                    <button class="btn btn-sm btn-tool" wire:click="verMasFacturas({{ $limit }})"><i
                                class="fas fa-arrow-down"></i> Ver mas facturas
                    </button>
                @endif
                <button class="btn btn-sm btn-tool" wire:click="limpiarFacturas" onclick="getServicios()"
                        data-card-widget="remove">Cerrar
                </button>
            </div>
        </div>
        {!! verSpinner() !!}
    </div>
@endif
