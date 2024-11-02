<div class="col-lg-6">

    @if($facturas->isNotEmpty())

        @foreach($facturas as $factura)

            @if(is_null($factura->pagos_id))

                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Pago Pendiente</h5>
                        <div class="card-tools">
                            <a href="{{ route('facturas.pdf', [$factura->rowquid]) }}" class="btn btn-tool" target="_blank">
                                Ver Factura
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Factura #: <span class="text-danger text-bold text-uppercase">{{ $factura->factura_numero }}</span></h6>
                        <p class="card-text">
                            Plan: <span class="text-bold text-uppercase">{{ $factura->plan_etiqueta }}</span>
                            <br>
                            Fecha: <span class="text-bold">{{ getFecha($factura->factura_fecha) }}</span>
                            <span class="float-right">USD <span class="text-bold text-danger">{{ formatoMillares($factura->factura_total) }}</span></span>
                        </p>
                        <button type="button" wire:click="initModal('{{ $factura->rowquid }}')" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            <i class="fas fa-file-invoice-dollar"></i> Pagar
                        </button>
                    </div>
                </div>

            @else

                <div class="card @if($factura->pago->estatus == 0) card-primary @endif @if($factura->pago->estatus == 1) card-success @endif @if($factura->pago->estatus == 2) card-danger @endif card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Factura #: <span class="text-danger text-bold text-uppercase">{{ $factura->factura_numero }}</span></h5>
                        <p class="card-text">
                            Plan: <span class="text-bold text-uppercase">{{ $factura->plan_etiqueta }}</span>
                            <br>
                            Fecha: <span class="text-bold text-uppercase">{{ getFecha($factura->factura_fecha) }}</span>
                            <span class="float-right">USD <span class="text-bold text-danger">{{ formatoMillares($factura->factura_total) }}</span></span>
                        </p>
                        <button type="button" wire:click="initModal('{{ $factura->rowquid }}')" class="btn card-link text-primary" data-toggle="modal" data-target="#modal-default">
                            Ver Pago
                        </button>
                        <a href="{{ route('facturas.pdf', [$factura->rowquid]) }}" class="btn card-link text-primary" target="_blank">Ver Factura</a>
                    </div>
                </div>

            @endif

        @endforeach

    @else
        @if(!empty($servicio))
            <div class="card card-outline">
                <div class="card-body">
                    <p class="card-text">
                        Plan: <span class="text-bold text-uppercase">{{ $servicio->plan->etiqueta_factura }}</span>
                        <br>
                        Fecha Facturación: <span class="text-bold">{{ getFecha($cliente['fecha_pago']) }}</span>
                        <span class="float-right">USD <span class="text-bold text-danger">{{ formatoMillares($servicio->plan->precio) }}</span></span>
                    </p>
                </div>
            </div>
        @endif
    @endif

</div>
