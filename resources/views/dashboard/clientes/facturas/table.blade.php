<table class="table table-sm table-head-fixed table-hover text-nowrap">
    <thead>
    <tr class="text-lightblue">
        <th class="text-center text-uppercase" style="width: 5%">#</th>
        <th class="d-none d-md-table-cell text-uppercase">Factura</th>
        <th class="text-uppercase" colspan="2">Fecha</th>
        <th class="text-uppercase">Total</th>
        <th class="text-center" style="width: 5%;"><small>Rows @if($listar) {{ $listar->count() }} @endif</small></th>
    </tr>
    </thead>
    <tbody id="tbody_facturas_cliente" wire:loading.class="invisible">
    @if($listar)
        @if($listar->isNotEmpty())
            @php($i = 0)
            @foreach($listar as $factura)
                <tr>
                    <td class="align-middle text-bold text-center">{{ ++$i }}</td>
                    <td class="align-middle d-none d-md-table-cell text-uppercase text-truncate" style="max-width: 150px;">
                        <a href="{{ route('facturas.pdf', $factura->rowquid) }}" target="_blank">
                        {{ $factura->factura_numero }}
                        </a>
                    </td>
                    <td class="align-middle">
                        <a class="d-md-none" href="{{ route('facturas.pdf', $factura->rowquid) }}" target="_blank">
                            {{ getFecha($factura->factura_fecha) }}
                        </a>
                        <span class="d-none d-md-inline">
                            {{ getFecha($factura->factura_fecha) }}
                        </span>
                    </td>
                    <td class="align-middle">
                        @if($factura->pagos_id)
                            @if($factura->pago->estatus == 1)
                                <i class="fas fa-check-circle text-success"></i>
                            @elseif($factura->pago->estatus == 2)
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                            @else
                                <i class="fas fa-exclamation-circle text-primary"></i>
                            @endif
                        @endif
                    </td>
                    <td class="align-middle text-nowrap">
                        <span>
                            {{ $factura->organizacion_moneda }}
                            {{ formatoMillares($factura->factura_total) }}
                        </span>
                    </td>
                    <td class="justify-content-end">

                        <div class="btn-group d-md-none">

                            <button type="button" onclick="confirmToastBootstrap('deleteFacturaCliente',  { rowquid: '{{ $factura->rowquid }}' })"
                                    class="btn btn-primary" @if($factura->pagos_id) disabled @endif >
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            @if($factura->send)
                                <button type="button" onclick="confirmToastBootstrap('reeviarFacturaCliente',  { rowquid: '{{ $factura->rowquid }}' }, { type: 'warning', message: '¡Esta Factura ya fue enviada anteriormente!', button: '¡Sí, volver a enviar!' })"
                                        class="btn btn-primary">
                                    <i class="fas fa-envelope-open"></i>
                                </button>
                            @else
                                <button type="button" wire:click="btnSendFactura('{{ $factura->rowquid }}')" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            @endif

                        </div>

                        <div class="btn-group  d-none d-md-flex">

                            <button type="button" onclick="confirmToastBootstrap('deleteFacturaCliente',  { rowquid: '{{ $factura->rowquid }}' })"
                                    class="btn btn-primary btn-sm" @if($factura->pagos_id) disabled @endif >
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            @if($factura->send)
                                <button type="button" onclick="confirmToastBootstrap('reeviarFacturaCliente',  { rowquid: '{{ $factura->rowquid }}' }, { type: 'warning', message: '¡Esta Factura ya fue enviada anteriormente!', button: '¡Sí, volver a enviar!' })"
                                        class="btn btn-primary btn-sm">
                                    <i class="fas fa-envelope-open"></i>
                                </button>
                            @else
                                <button type="button" wire:click="btnSendFactura('{{ $factura->rowquid }}')" class="btn btn-primary btn-sm">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            @endif

                        </div>

                    </td>
                </tr>
            @endforeach
        @else
            <tr class="text-center">
                <td colspan="5">
                    <span>Sin registros guardados</span>
                </td>
            </tr>
        @endif
    @endif

    </tbody>
</table>
