<ul class="todo-list list-group list-group-flush" >
    <li class="list-group-item">
        <span>{{ __('Name') }}: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $nombre }}</span>
    </li>
    <li class="list-group-item">
        <span>Representante: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $representante }}</span>
    </li>
    <li class="list-group-item">
        <span>Email: </span>
        <span class="float-right text-bold text-lightblue text-lowercase">{{ $email }}</span>
    </li>
    <li class="list-group-item">
        <span>Teléfono: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $telefono }}</span>
    </li>
    <li class="list-group-item">
        <span>Moneda Base: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $moneda }}</span>
    </li>
    <li class="list-group-item">
        <span>Dirección: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $direccion }}</span>
    </li>
    <li class="list-group-item">
        <span>Días Factura: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $dias }}</span>
    </li>
    <li class="list-group-item">
        <span>Formato Factura: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $formato }}</span>
    </li>
    <li class="list-group-item">
        <span>Próxima Factura: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ formatoMillares($proxima, 0) }}</span>
    </li>
    @if($web)
        <li class="list-group-item">
            <span>Web: </span>
            <span class="float-right text-bold text-lightblue text-lowercase">
                @php($explode = explode('://', $web))
                @if(count($explode) > 1)
                    <a href="{{ $web }}" target="_blank">
                    {{ $explode[1] }}
                </a>
                @else
                    {{ $web }}
                @endif
            </span>
        </li>
    @endif
</ul>
