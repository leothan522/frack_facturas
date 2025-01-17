<div class="col-md-4">
    <div class="card {{ $classTransferencia }} card-outline">
        <div class="card-body">
            <h5 class="card-title">Transferencia</h5>

            <div class="row card-text justify-content-end">
                <img class="rounded mr-4" src="{{ asset('img/payment_9359413.png') }}" width="100px" height="100px" alt="Datos para Transferencias">
            </div>

            <a href="#" class="card-link" wire:click.prevent="irTransferencia">
                <i class="fas fa-edit"></i> Verificar
            </a>
        </div>
        {!! verSpinner('irTransferencia') !!}
    </div>
</div>

<div class="col-md-4">
    <div class="card {{ $classPagoMovil }} card-outline">
        <div class="card-body">
            <h5 class="card-title">Pago móvil</h5>

            <div class="row card-text justify-content-end">
                <img class="rounded mr-4" src="{{ asset('img/sms_9195052.png') }}" width="100px" height="100px" alt="Datos para Pago Movil">
            </div>

            <a href="#" class="card-link" wire:click.prevent="irPagoMovil">
                <i class="fas fa-edit"></i> Verificar
            </a>
        </div>
        {!! verSpinner('irPagoMovil') !!}
    </div>
</div>

<div class="col-md-4">
    <div class="card {{ $classZelle }} card-outline">
        <div class="card-body">
            <h5 class="card-title">Zelle</h5>

            <div class="row card-text justify-content-end">
                <img class="rounded mr-4" src="{{ asset('img/zelle.svg') }}" width="100px" height="100px" alt="Datos para Zelle">
            </div>

            <a href="#" class="card-link" wire:click.prevent="irZelle">
                <i class="fas fa-edit"></i> Verificar
            </a>
        </div>
        {!! verSpinner('irZelle') !!}
    </div>
</div>

