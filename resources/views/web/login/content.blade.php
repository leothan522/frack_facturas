<div class="position-relative" wire:loading.class="opacity-50">

    <form id="form_cliente" onsubmit="preloader()"  @if(!$user) wire:submit="validarCedula" @else wire:submit="validarCodigo" @endif>

        @if ($errors->any())
            <div>
                <div
                    class="fs-6 text-danger fw-normal">{{ __('Whoops! Something went wrong.') }}</div>

                <ul class="mt-3 fs-6 text-danger fw-normal">
                    @foreach ($errors->all() as $error)
                        <li><small>{{ $error }}</small></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(!$user)

            <div class="form-floating mb-3 has-validation">
                <input id="cedula" type="number" wire:model="cedula" class="form-control" placeholder="Ingrese Cédula" required autofocus/>
                <label for="cedula">Cédula</label>
            </div>

            <p class="text-muted mb-3 text-center">
                <small class="">Ingresa tu Cédula sin puntos o espacios.</small>
            </p>

        @else

            <div class="form-floating mb-4 has-validation">
                <input id="codigo" type="number" class="form-control" wire:model="codigo" placeholder="Ingrese Código" required autofocus/>
                <label for="codigo">Código</label>
            </div>

            <div class="mb-4">
                <p class="fs-6 d-flex text-success fw-normal" style="text-align: justify !important;">
                    <small>
                        Hemos enviado un <b>código de seguridad</b> de seis (06) dígitos a su correo electrónico:
                        <span class="text-primary text-lowercase">{{ $cliente['email'] }}</span>, revise su bandeja de entrada y use ese código para iniciar sesión.
                    </small>
                </p>
            </div>

        @endif

        <div class="text-center pt-1 mb-3 pb-1 d-grid gap-2">
            <button type="submit" class="btn shadow text-white btn-block fa-lg gradient-custom-2 mb-3">
                @if(!$user) {{ __('Log in') }} @else Validar @endif
            </button>
            @if ($user)
                <button type="button" class="btn btn-link btn-sm text-muted p-0" wire:click="deleteSession">O inicie sesión como un usuario diferente</button>
            @endif
        </div>

        <div wire:loading class="position-absolute top-50 start-50 translate-middle">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="position-absolute top-50 start-50 translate-middle d-none verCargando">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

    </form>
</div>
