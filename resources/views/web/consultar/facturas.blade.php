<div class="card card-navy card-outline @if($collapseFacturas) collapsed-card @endif">
    <div class="card-header" wire:loading.class="invisible" wire:target="btnPagar">
        <h3 class="card-title">
            Facturas Cliente
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool @if($collapseFacturas) d-none @endif" wire:click="actualizarFacturas">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool d-md-none" data-card-widget="collapse" wire:click="setCollapseCard('facturas')" wire:ignore>
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body table-responsive" wire:loading.class="invisible" wire:target="actualizarFacturas, showFactura, btnVerPago, btnCorregirPago, btnPagar" style="max-height: calc(100vh - {{ $size }}px)">

        @foreach($facturas as $factura)
            <div class="card {{ $factura->cardClase }} card-outline">
                <div class="card-body">
                    <h6 class="card-title">Factura #: <span class="text-danger text-bold text-uppercase">{{ $factura->factura_numero }}</span></h6>
                    <p class="card-text">
                        Servicio: <span class="text-bold text-uppercase">{{ $factura->plan_servicio }}</span>
                        <br>
                        Fecha: <span class="text-bold">{{ getFecha($factura->factura_fecha) }}</span>
                        <span class="float-right text-uppercase">{{ $factura->organizacion_moneda }} <span class="text-bold text-danger">{{ formatoMillares($factura->factura_total) }}</span></span>
                    </p>
                    @if($factura->pagos_id)
                        <a id="pago_{{ $factura->pago->rowquid }}" class="d-none" href="#" data-toggle="modal" data-target="#modal-pagos-show">Ver Pago</a>
                        <a href="#" class="card-link" wire:click.prevent="btnVerPago('{{ $factura->pago->rowquid }}')">Ver Pago</a>
                    @else
                        <a href="#" class="card-link btn btn-primary" wire:click.prevent="btnPagar('{{ $factura->rowquid }}')">
                            <i class="fas fa-file-invoice-dollar"></i> Pagar
                        </a>
                    @endif
                    <a id="movil_{{ $factura->rowquid }}" class="d-none" href="#"  wire:click="btnVerPDF('{{ $factura->rowquid }}')" onclick="verModalPDF()" data-toggle="modal" data-target="#modal-ver-pdf">Ver Factura</a>
                    <a id="web_{{ $factura->rowquid }}" class="d-none" href="{{ route('facturas.pdf', $factura->rowquid) }}" target="_blank">Ver Factura</a>
                    <a href="#" class="card-link float-right d-md-none" wire:click.prevent="showFactura('{{ $factura->rowquid }}', 'movil')">Ver Factura</a>
                    <a href="#" class="card-link float-right d-none d-md-inline" wire:click.prevent="showFactura('{{ $factura->rowquid }}', 'web')">Ver Factura</a>
                </div>
            </div>
        @endforeach

    </div>

    {!! verSpinner('actualizarFacturas, showFactura, btnVerPago, btnCorregirPago, btnPagar') !!}

</div>

