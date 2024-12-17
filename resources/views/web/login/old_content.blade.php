<div class="lockscreen-logo">
    {{--<a href="../../index2.html"><b>Admin</b>LTE</a>--}}
    {{--{{ config('app.name') }}--}}
    <img src="{{ asset('img/preloader_171x171.png') }}" alt="Logo {{ config('app.name') }}">
</div>

<!-- User name -->
<div class="lockscreen-name">Consultar tu cuenta</div>

<!-- START LOCK SCREEN ITEM -->
<div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
        @if(!$user)
            <img src="{{ asset('img/user.png') }}" alt="User Image">
        @else
            <img src="{{ asset('img/password_2721619.png') }}" alt="User Image">
        @endif
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->

    @if(!$user)
        <form class="lockscreen-credentials" wire:submit="validarCedula">
            <div class="input-group">
                <input type="number" wire:model="cedula" class="form-control" placeholder="Ingrese Cédula">
                <div class="input-group-append">
                    <button type="submit" class="btn">
                        <i class="fas fa-arrow-right text-muted"></i>
                    </button>
                </div>
            </div>
        </form>
    @else
        <form class="lockscreen-credentials" wire:submit="validarCodigo">
            <div class="input-group">
                <input type="number" wire:model="codigo" class="form-control" placeholder="Ingrese Código">
                <div class="input-group-append">
                    <button type="submit" class="btn">
                        <i class="fas fa-check text-muted"></i>
                    </button>
                </div>
            </div>
        </form>
    @endif

    <!-- /.lockscreen credentials -->

</div>
<!-- /.lockscreen-item -->

<div style="height: 40vh;">
    @if(!$user)
        @error('cedula')
        <div class="help-block text-center p-3">
            <span class="text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
        </div>
        @enderror
        <div class="help-block text-center p-3">
            Ingresa tu Cédula sin puntos o espacios.
        </div>
    @else
        @error('codigo')
        <div class="help-block text-center p-3">
            <span class="text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
        </div>
        @enderror
        <div class="help-block text-justify p-3">
            Hemos enviado un <b>código de seguridad</b> de seis (06) dígitos a su correo electrónico:
            <span class="text-primary text-lowercase">{{ $cliente['email'] }}</span>, revise su bandeja de entrada y use ese código para iniciar sesión.
        </div>
        <div class="text-center">
            <button class="btn btn-link" wire:click="deleteSession">O inicie sesión como un usuario diferente</button>
        </div>
    @endif
</div>

<div class="lockscreen-footer text-center">
    {{--Copyright &copy; 2014-2021 <b><a href="https://adminlte.io" class="text-black">AdminLTE.io</a></b><br>
    All rights reserved--}}
    <span>&copy; 2024 {{ mb_strtoupper(config('app.name')) }}</span>&nbsp;
</div>

{!! verSpinner() !!}
