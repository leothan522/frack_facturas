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
                        Referencia <span class="float-right text-bold text-uppercase">{{ $referencia }}</span>
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
                        Fecha de pago <span class="float-right text-bold text-lowercase">{{ $fecha }}</span>
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
</div>
