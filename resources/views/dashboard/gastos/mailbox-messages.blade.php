<div class="table-responsive mailbox-messages" style="height: calc(100vh - {{ $size }}px)">
    <table class="table table-hover table-striped">
        <tbody wire:loading.class="invisible" wire:target.except="">
        @if($listar->isNotEmpty())
            @foreach($listar as $registro)
                <tr>
                    <td class="text-nowrap text-uppercase" style="width: 10%">
                        <a href="#" wire:click.prevent="show('{{ $registro->rowquid }}')">
                            {{ getFecha($registro->fecha) }}
                        </a>
                    </td>
                    <td class="text-nowrap d-none d-md-table-cell  text-uppercase text-truncate" style="max-width: 150px;">
                        <b>{{ $registro->concepto }}</b> - {{ $registro->descripcion }}
                    </td>
                    <td class="text-nowrap text-right" style="width: 10%">
                        <span class="text-bold">{{ $registro->moneda }} {{ formatoMillares($registro->monto) }}</span>
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
