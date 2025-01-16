<div class="row justify-content-center @if($registrarPago) d-none @endif">

    <div class="col-md-4 col-lg-3 d-none d-md-block">
        @include('dashboard.pagos.card')
    </div>

    <div class="col-md-8 col-lg-9">
        @include('dashboard.pagos.table')
        @include('dashboard.pagos.modal')
    </div>

    <div class="col-sm-6 d-md-none">
        @include('dashboard.pagos.card')
    </div>

</div>

<div class="row justify-content-center @if(!$registrarPago) d-none @endif">
    <div class="col-md-8 col-lg-9">
        @livewire('dashboard.pagos-registrar-component')
    </div>
</div>
