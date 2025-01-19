<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">{{ getMetodoPago($metodo) }}</small>
    <p class="text-justify">
        Copia los datos y asegúrate de pagar correctamente.
    </p>
</div>

<div class="@if($metodo != "transferencia") d-none @endif">

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Monto:</small>
        <div class="input-group">
            <span class="form-control text-bold">
                Bs {{ formatoMillares($monto) }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ number_format($monto, 2, ',', '') }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Titular:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                {{ $titular }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ mb_strtoupper($titular) }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Cuenta:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                {{ $cuenta }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ $cuenta }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Rif / Cédula:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                {{ $cedula }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ mb_strtoupper($cedula) }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Tipo:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                {{ $tipo }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ mb_strtoupper($tipo) }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Banco:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                {{ $banco }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ mb_strtoupper($banco) }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

</div>

<div class="@if($metodo != "movil") d-none @endif">

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Monto:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                Bs {{ formatoMillares($monto) }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ number_format($monto, 2, ',', '') }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Número de teléfono:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                {{ $telefono }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ $telefono }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Rif / Cédula:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                {{ $cedula }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ mb_strtoupper($cedula) }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Banco:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                {{ $banco }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ $codigoBanco }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

</div>

<div class="@if($metodo != "zelle") d-none @endif">

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Monto:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                USD {{ formatoMillares($totalFactura) }}
            </span>
            <div class="input-group-append" onclick="copiarPortapapeles('{{ number_format($totalFactura, 2, '.', '') }}')">
                <button type="button" class="input-group-text">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Beneficiario:</small>
        <div class="input-group">
            <span class="form-control text-bold text-uppercase">
                {{ $titular }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ mb_strtoupper($titular) }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <small class="text-lightblue text-bold text-uppercase">Correo Electrónico:</small>
        <div class="input-group">
            <span class="form-control text-bold text-lowercase">
                {{ $email }}
            </span>
            <div class="input-group-append">
                <button type="button" class="input-group-text" onclick="copiarPortapapeles('{{ mb_strtolower($email) }}')">
                    <i class="far fa-copy"></i>
                </button>
            </div>
        </div>
    </div>

</div>
