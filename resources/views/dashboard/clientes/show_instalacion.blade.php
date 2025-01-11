<ul class="todo-list list-group list-group-flush" >
    <li class="list-group-item">
        <span>Fecha Instalación: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ getFecha($fechaInstalacion) }}</span>
    </li>
    <li class="list-group-item">
        <span>Fecha Pago: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ getFecha($fechaPago) }}</span>
    </li>
    <li class="list-group-item">
        <span>Latitud: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $latitud ?? '-' }}</span>
    </li>
    <li class="list-group-item">
        <span>Longitud: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $longitud ?? '-' }}</span>
    </li>
    <li class="list-group-item">
        <span>GPS: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $gps ?? '-' }}</span>
    </li>
</ul>
