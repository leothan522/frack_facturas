<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">¿Cómo vas a pagar?</small>
    <p class="text-justify">
        Si no ves alguno de los métodos de pago usuales, es porque no lo tenemos disponible ahora.
    </p>
</div>

@if($datosTransferencia)
    <div class="row pr-3 pl-3" wire:click="verDetalles('transferencia')">
        <div class="info-box mb-3 bg-info" style="cursor: pointer;">
        <span class="info-box-icon">
            <img class="rounded" src="{{ asset('img/payment_9359413.png') }}" alt="Datos para Transferencias">
        </span>
            <div class="info-box-content">
            <span class="info-box-text">
                Transferencia
                <span class="float-right">
                    <i class="fas fa-chevron-right"></i>
                </span>
            </span>
            </div>
        </div>
    </div>
@endif

@if($datosPagoMovil)
    <div class="row pr-3 pl-3" wire:click="verDetalles('movil')">
        <div class="info-box mb-3 bg-info" style="cursor: pointer;">
        <span class="info-box-icon">
            <img class="rounded" src="{{ asset('img/sms_9195052.png') }}" alt="Datos para Pago Movil">
        </span>
            <div class="info-box-content">
            <span class="info-box-text">
                Pago móvil
                <span class="float-right">
                    <i class="fas fa-chevron-right"></i>
                </span>
            </span>
            </div>
        </div>
    </div>
@endif

@if($datosZelle)
    <div class="row pr-3 pl-3" wire:click="verDetalles('zelle')">
        <div class="info-box mb-3 bg-info" style="cursor: pointer;">
        <span class="info-box-icon bg-white">
            <img class="rounded" src="{{ asset('img/zelle.svg') }}" alt="Datos para Zelle">
        </span>
            <div class="info-box-content">
            <span class="info-box-text">
                Zelle
                <span class="float-right">
                    <i class="fas fa-chevron-right"></i>
                </span>
            </span>
            </div>
        </div>
    </div>
@endif
