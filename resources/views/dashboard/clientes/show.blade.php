<ul class="todo-list list-group list-group-flush" >
    <li class="list-group-item">
        <span>Cédula: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ formatoMillares($cedula, 0) }}</span>
    </li>
    <li class="list-group-item">
        <span>Nombre: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $nombre }}</span>
    </li>
    <li class="list-group-item">
        <span>Apellido: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $apellido }}</span>
    </li>
    <li class="list-group-item">
        <span>Teléfono: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $telefono }}</span>
    </li>
    <li class="list-group-item">
        <span>Email: </span>
        <span class="float-right text-bold text-lightblue text-lowercase">{{ $email }}</span>
    </li>
    <li class="list-group-item">
        <span>Dirección: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $direccion }}</span>
    </li>
</ul>
