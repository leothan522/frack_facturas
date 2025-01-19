<div class="card card-navy card-outline @if($collapseServicio) collapsed-card @endif @if(!$verPlanServicio) d-none @endif">
    <div class="card-header">
        <h3 class="card-title">
            Plan de Servicio
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool @if($collapseServicio) d-none @endif" wire:click="actualizarServicio">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool d-md-none" data-card-widget="collapse" wire:click="setCollapseCard('servicio')" wire:ignore>
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0" wire:loading.class="invisible" wire:target="actualizarServicio">

        <ul class="todo-list list-group list-group-flush" >
            <li class="list-group-item">
                <span>Código: </span>
                <span class="float-right text-bold text-lightblue text-uppercase">{{ $verCodigo }}</span>
            </li>
            <li class="list-group-item">
                <span>Organización: </span>
                <span class="float-right text-bold text-lightblue text-uppercase">{{ $verOrganizacion }}</span>
            </li>
            <li class="list-group-item">
                <span>Nombre: </span>
                <span class="float-right text-bold text-lightblue text-uppercase">{{ $verPlan }}</span>
            </li>
            <li class="list-group-item">
                <span>Velocidad de Bajada: </span>
                <span class="float-right text-bold text-lightblue">{{ $verBajada }}</span>
            </li>
            <li class="list-group-item">
                <span>Velocidad de Subida: </span>
                <span class="float-right text-bold text-lightblue">{{ $verSubida }}</span>
            </li>
            <li class="list-group-item">
                <span>Precio Mensual: </span>
                <span class="float-right text-bold text-lightblue text-uppercase">{{ $verPrecio }}</span>
            </li>
        </ul>

    </div>

    {!! verSpinner('actualizarServicio') !!}

</div>
