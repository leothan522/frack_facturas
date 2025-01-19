<div class="row justify-content-around">
    <div class="col-md-4 d-none d-md-block">
        @include('web.consultar.plan_servicio')
        @include('web.consultar.soporte')
    </div>
    @if($facturas->isNotEmpty())
        <div class="col-md-6">
            <div class="@if($ocultarFacturas) d-none @endif">
                @include('web.consultar.facturas')
            </div>
            <div class="@if(!$ocultarFacturas) d-none @endif">
                @include('web.consultar.pagar')
            </div>

            @include('web.consultar.modal_pago')
        </div>
    @endif
    <div class="col-md-4 @if($ocultarFacturas) d-none @endif d-md-none">
        @include('web.consultar.plan_servicio')
        @include('web.consultar.soporte')
    </div>
</div>
