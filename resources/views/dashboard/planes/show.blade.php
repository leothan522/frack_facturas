<ul class="todo-list list-group list-group-flush" >
    <li class="list-group-item">
        <span>Organización: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verOrganizacion->nombre ?? '' }}</span>
    </li>
    <li class="list-group-item">
        <span>Nombre: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $nombre }}</span>
    </li>
    <li class="list-group-item">
        <span>Etiqueta - Factura: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $etiqueta }}</span>
    </li>
    <li class="list-group-item">
        <span>Velocidad de Bajada: </span>
        <span class="float-right text-bold text-lightblue">{{ formatoMillares($bajada, 0) }} Mbps.</span>
    </li>
    <li class="list-group-item">
        <span>Velocidad de Subida: </span>
        <span class="float-right text-bold text-lightblue">{{ formatoMillares($subida, 0) }} Mbps.</span>
    </li>
    <li class="list-group-item">
        <span>Precio Mensual: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verOrganizacion->moneda ?? '' }} {{ formatoMillares($precio) }}</span>
    </li>
</ul>
