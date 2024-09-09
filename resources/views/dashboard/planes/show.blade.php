<div class="col-12">
    <!-- Widget: user widget style 2 -->
    <div class="card card-widget widget-user-2">
        <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <span class="nav-link">
                        Organización <span class="float-right text-bold text-uppercase">{{ $organizacion }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Nombre <span class="float-right text-bold text-uppercase">{{ $nombre }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Etiqueta - Factura <span class="float-right text-bold text-uppercase">{{ $etiqueta }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Velocidad de Bajada <span class="float-right text-bold">{{ $bajada }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Velocidad de Subida <span class="float-right text-bold">{{ $subida }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Precio Mensual <span class="float-right text-bold">{{ formatoMillares($precio) }}</span>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.widget-user -->
</div>
