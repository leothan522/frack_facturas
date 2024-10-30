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
        <img src="{{ asset('img/user.png') }}" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Ingrese su RIF o Cédula">
            <div class="input-group-append">
                <button type="button" class="btn">
                    <i class="fas fa-arrow-right text-muted"></i>
                </button>
            </div>
        </div>
    </form>
    <!-- /.lockscreen credentials -->

</div>
<!-- /.lockscreen-item -->

<div style="height: 40vh;">
    <div class="help-block text-center">
        Ingresa tu RIF o Cédula sin guiones o espacio para iniciar tu sesión.
    </div>
    {{--<div class="text-center">
        <a href="login.html">Or sign in as a different user</a>
    </div>--}}
</div>

<div class="lockscreen-footer text-center">
    {{--Copyright &copy; 2014-2021 <b><a href="https://adminlte.io" class="text-black">AdminLTE.io</a></b><br>
    All rights reserved--}}
    <span>&copy; 2024 {{ mb_strtoupper(config('app.name')) }}</span>&nbsp;
</div>
