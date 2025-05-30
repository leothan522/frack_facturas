<div class="row justify-content-center @if($registrar) d-none @endif" >

    <div class="col-md-4 col-lg-3 d-none d-md-block">
        @include('dashboard.gastos.card')
    </div>

    <div class="col-md-8 col-lg-9">
        @include('dashboard.gastos.table')
    </div>

    <div class="col-sm-6 d-md-none">
        @include('dashboard.gastos.card')
    </div>

</div>

<div class="row justify-content-center @if(!$registrar) d-none @endif">
    <div class="col-md-8 col-lg-9">
        @include('dashboard.gastos.registrar.card_view')
    </div>
</div>

<div class="row">
    @include('dashboard.gastos.reportes.modal')
    @include('dashboard.gastos.modal')
</div>
