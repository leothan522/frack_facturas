<div class="col-12">
    <!-- Widget: user widget style 2 -->
    <div class="card card-widget widget-user-2">
        <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <span class="nav-link">
                        Metodo <span class="float-right text-bold text-uppercase">{{ $verMetodo }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Referencia <span class="float-right text-bold text-uppercase text-primary">{{ $referencia }}</span>
                    </span>
                </li>
                @if($banco)
                    <li class="nav-item">
                    <span class="nav-link">
                        Banco <span class="float-right text-bold">{{ $banco }}</span>
                    </span>
                    </li>
                @endif
                <li class="nav-item">
                    <span class="nav-link">
                        Monto <span class="float-right text-bold">{{ $moneda }} {{ formatoMillares($monto) }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Fecha Pago <span class="float-right text-bold text-lowercase">{{ getFecha($fecha) }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Estatus
                        <span class="float-right text-bold text-capitalize">
                            <span class="@if($estatus == 0) text-primary @endif @if($estatus == 1) text-success @endif @if($estatus == 2) text-danger @endif ">{{ $verEstatus }}</span>
                        </span>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.widget-user -->

    <div class="card @if($estatus == 0) card-primary @endif @if($estatus == 1) card-success @endif @if($estatus == 2) card-danger @endif card-outline">
        <div class="card-body">
            <h5 class="card-title">Factura #: <span class="text-danger text-bold text-uppercase">{{ $factura_numero }}</span></h5>
            <p class="card-text">
                Cliente: <span class="text-bold text-uppercase">{{ $factura_cliente }}</span>
                <br>
                Plan: <span class="text-bold text-uppercase">{{ $factura_etiqueta }}</span>
                <br>
                Fecha Factura: <span class="text-bold text-uppercase">{{ getFecha($factura_fecha) }}</span>
                <span class="float-right">USD <span class="text-bold text-danger">{{ formatoMillares($factura_total) }}</span></span>
            </p>
            <a href="{{ route('facturas.pdf', [$factura_rowquid]) }}" class="btn card-link text-primary" target="_blank">Ver Factura</a>
        </div>
    </div>

</div>
