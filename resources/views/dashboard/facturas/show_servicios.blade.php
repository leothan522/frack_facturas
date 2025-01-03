<div class="col-12">
    <!-- Widget: user widget style 2 -->
    <div class="card card-widget widget-user-2">
        <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <span class="nav-link">
                        Código <span class="float-right text-bold text-uppercase">{{ $codigo }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Cédula <span class="float-right text-bold text-uppercase">{{ is_numeric($cedula) ? formatoMillares($cedula,0) : $cedula }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Nombre <span class="float-right text-bold text-uppercase">{{ $nombre }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Apellido <span class="float-right text-bold text-uppercase">{{ $apellido }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Teléfono <span class="float-right text-bold text-uppercase">{{ $telefono }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Email <span class="float-right text-bold text-lowercase">{{ $email }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Plan <span class="float-right text-bold text-uppercase">{{ $plan }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Organización <span class="float-right text-bold text-uppercase">{{ $organizacion }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Fecha Pago <span class="float-right text-bold">{{ getFecha($pago) }}</span>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.widget-user -->
    <div class="row">
        <div class="col-12">
            <button type="button" wire:click="btnReenviar" class="btn btn-default btn-xs mb-3 float-right">
                <i class="fas fa-paper-plane"></i> Reenviar Contrato
            </button>
        </div>
    </div>
</div>
