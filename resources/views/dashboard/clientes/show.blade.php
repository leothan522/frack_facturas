<div class="col-12">
    <!-- Widget: user widget style 2 -->
    <div class="card card-widget widget-user-2">
        <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <span class="nav-link">
                        Cedula <span class="float-right text-bold text-uppercase">{{ formatoMillares($cedula, 0) }}</span>
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
                        Dirección <span class="float-right text-bold text-lowercase">{{ $direccion }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Instalación <span class="float-right text-bold">{{ getFecha($instalacion) }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Fecha Pago <span class="float-right text-bold">{{ getFecha($pago) }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Latitud <span class="float-right text-bold text-uppercase">{{ $latitud }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Longitud <span class="float-right text-bold text-uppercase">{{ $longitud }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        GPS <span class="float-right text-bold text-uppercase">{{ $gps }}</span>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.widget-user -->
</div>
