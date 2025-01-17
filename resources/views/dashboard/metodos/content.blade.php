<div class="table-responsive @if($view != 'show') d-none @endif" style="max-height: calc(100vh - {{ $size }}px)">
    <div class="row col-12 justify-content-center">
        @include('dashboard.metodos.show')
    </div>
</div>

<div class="row justify-content-center @if($view != 'transferencia') d-none @endif">
    <div class="col-md-4">
        @include('dashboard.metodos.form_transferencia')
    </div>
</div>

<div class="row justify-content-center @if($view != 'pago-movil') d-none @endif">
    <div class="col-md-4">
        @include('dashboard.metodos.form_pagomovil')
    </div>
</div>

<div class="row justify-content-center @if($view != 'zelle') d-none @endif">
    <div class="col-md-4">
        @include('dashboard.metodos.form_zelle')
    </div>
</div>

