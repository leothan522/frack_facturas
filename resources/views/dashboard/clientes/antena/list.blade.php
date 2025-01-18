<ul class="todo-list list-group text-center">
    @foreach($listar as $antena)
        <li class="list-group-item btn btn-link" wire:click="edit('{{ $antena->rowquid }}')">
            <span class="text-bold text-lightblue text-uppercase float-left">{{ $antena->nombre }}</span>
            <span class="text-bold text-lightblue text-uppercase float-right">{{ $antena->direccion_ip ?? '0.0.0.0' }}</span>
        </li>
    @endforeach
</ul>
