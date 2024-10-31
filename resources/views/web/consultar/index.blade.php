@extends('layouts.adminlte')

@section('title', 'Consultar Cuenta')

@section('navbar')

    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="{{ route('web.consultar') }}" class="navbar-brand">
                <img src="{{ asset('img/preloader_171x171.png') }}" alt="Logo Empresa" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ mb_strtoupper(config('app.name')) }}</span>
            </a>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('img/user.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{ formatoMillares($cliente['cedula'], 0) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">

                            <p>
                                Cédula: {{ formatoMillares($cliente['cedula'], 0) }}
                                <small>{{ $cliente['email'] }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                            <button type="button" class="btn btn-default btn-flat float-right" onclick="salir()">
                                <i class="fa fa-fw fa-power-off text-red"></i>
                                {{ __('adminlte::adminlte.log_out') }}
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


@endsection


@section('content')

    @livewire('web.consultar-component')

@endsection

@section('js')
    <script !src="">

        function salir() {
            Livewire.dispatch('cerrarSesion');
        }

        console.log('hi!')
    </script>
@endsection
