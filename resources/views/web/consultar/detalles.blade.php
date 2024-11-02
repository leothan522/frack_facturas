<p class="text-justify pr-3 pl-3">
    Copia los datos y asegúrate de pagar correctamente.
</p>

<div class="pr-3 pl-3 @if($displayDetalles != "transferencia") d-none @endif">

    <div class="float-right">
        <button type="button" class="btn btn-sm" wire:click="initModal('{{ $rowquid }}')">
            <i class="fas fa-arrow-circle-left"></i> Volver
        </button>
    </div>

    <div class="form-group">
        <small>Monto:</small>
        <div class="input-group mb-3">
            <label class="form-control">
                Bs {{ formatoMillares($monto) }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Titular:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                {{ $titular }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Cuenta:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                {{ $cuenta }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Rif / Cédula:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                {{ $cedula }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Tipo:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                {{ $tipo }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Banco:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                {{ $banco }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

</div>

<div class="pr-3 pl-3 @if($displayDetalles != "movil") d-none @endif">

    <div class="float-right">
        <button type="button" class="btn btn-sm" wire:click="initModal('{{ $rowquid }}')">
            <i class="fas fa-arrow-circle-left"></i> Volver
        </button>
    </div>

    <div class="form-group">
        <small>Monto:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                Bs {{ formatoMillares($monto) }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Número de teléfono:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                {{ $telefono }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Rif / Cédula:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                {{ $cedula }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Banco:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                {{ $banco }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

</div>

<div class="pr-3 pl-3 @if($displayDetalles != "zelle") d-none @endif">

    <div class="float-right">
        <button type="button" class="btn btn-sm" wire:click="initModal('{{ $rowquid }}')">
            <i class="fas fa-arrow-circle-left"></i> Volver
        </button>
    </div>

    <div class="form-group">
        <small>Monto:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                USD {{ formatoMillares($totalFactura) }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Beneficiario:</small>
        <div class="input-group mb-3">
            <label class="form-control text-uppercase">
                {{ $titular }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small>Correo Electrónico:</small>
        <div class="input-group mb-3">
            <label class="form-control text-lowercase">
                {{ $email }}
            </label>
            <div class="input-group-append">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

</div>
