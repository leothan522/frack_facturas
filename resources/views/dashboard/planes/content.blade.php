<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4 @if($ocultarTable) d-none @endif ">
        @include('dashboard.planes.table')
    </div>
    <div class="col-md-7 col-lg-8 @if($ocultarCard) d-none @endif d-md-block">
        @include('dashboard.planes.card_view')
    </div>
</div>
