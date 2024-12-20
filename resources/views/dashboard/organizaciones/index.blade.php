@extends('adminlte::page')

@section('title', 'Organizaciones')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-satellite-dish"></i> Organizaciones</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">
                        <span>Opciones</span>
                    </li>
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-default-cambiar-logo" style="cursor: pointer;" onclick="initLogo()">
                        <span class="btn-link">Cambiar Logo</span>
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @livewire('dashboard.organizaciones-component')
    @livewire('dashboard.dolar-component')
    @livewire('dashboard.logos-component')
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] { -moz-appearance:textfield; }


        input[type=date]::-webkit-inner-spin-button,
        input[type=date]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=date] { -moz-appearance:textfield; }
    </style>
@stop

@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        Livewire.on('cerrarModal', () => {
            $("#btn_modal_cerrar").click();
        });

        $("#button_dolar_dispath").click(function (e) {
            Livewire.dispatch('initDollar');
        });

        $("#button_email_dispath_sistema").click(function (e) {
            Livewire.dispatch('initEmail');
        });

        $("#button_telefono_soporte_sistema").click(function (e) {
            Livewire.dispatch('initTelefono');
        });

        function imgLogo()
        {
            $('#customFileLang').click();
        }

        function initLogo() {
            Livewire.dispatch('limpiarLogo');
        }

        console.log('Hi!');
    </script>
@endsection
