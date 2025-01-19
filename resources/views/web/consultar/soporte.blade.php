<div class="card card-navy card-outline @if($collapseSoporte) collapsed-card @endif">
    <div class="card-header">
        <h3 class="card-title">
            Soporte Técnico
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool @if($collapseSoporte) d-none @endif" wire:click="actualizarSoporte">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool d-md-none" data-card-widget="collapse" wire:click="setCollapseCard('soporte')" wire:ignore>
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0" wire:loading.class="invisible" wire:target="actualizarSoporte">

        <ul class="todo-list list-group list-group-flush" >
            <li class="list-group-item">
                <span>Teléfono: </span>
                <a href="tel:{{ $verTelefono }}" class="float-right text-bold text-uppercase">{{ $verTelefono }}</a>
            </li>
            <li class="list-group-item">
                <span>Email: </span>
                <a href="mailto:{{ $verEmail }}" class="float-right text-bold text-lowercase">{{ $verEmail }}</a>
            </li>
        </ul>

    </div>

    {!! verSpinner('actualizarSoporte') !!}

</div>
