<div class="table-responsive mailbox-messages" style="height: calc(100vh - {{ $size }}px)">
    <table class="table table-hover table-striped">
        <tbody wire:loading.class="invisible" wire:target.except="setFacturarAutomatico">
        @if($listar->isNotEmpty())
            @foreach($listar as $registro)
                <tr>
                    <td class="text-nowrap text-uppercase" style="width: 10%">
                        <a href="#">
                            {{ $registro->factura_numero }}
                        </a>
                    </td>
                    <td class="text-nowrap d-none d-md-table-cell " style="width: 10%">
                        {{ getFecha($registro->factura_fecha) }}
                    </td>
                    <td class="text-nowrap d-none d-md-table-cell  text-uppercase text-truncate" style="max-width: 150px;">
                        {{ $registro->cliente_nombre }} {{ $registro->cliente_apellido }}
                    </td>
                    <td class="text-nowrap" style="width: 5%">
                        {!! $icono[1] !!}
                    </td>
                    <td class="text-nowrap text-right" style="width: 10%">
                        <span class="text-bold">{{ $registro->organizacion_moneda }} {{ formatoMillares($registro->factura_total) }}</span>
                    </td>
                </tr>
            @endforeach
        @else
            @if($keyword)
                <tr>
                    <td colspan="4" class="mailbox-subject text-center">
                        Sin Resultados.
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="4" class="mailbox-subject text-center">
                        Sin Registros Guardados.
                    </td>
                </tr>
            @endif
        @endif
        </tbody>
    </table>
    <!-- /.table -->
</div>
