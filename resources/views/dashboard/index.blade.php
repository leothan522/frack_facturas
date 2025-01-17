@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    {{--<p>Bienvenido al panel de administración.</p>--}}
    {{--<p>Precio Dólar: <b class="text-danger" id="ver_print_dollar"></b></p>
    <p>Correo Electrónico: <b class="text-danger" id="ver_print_email"></b></p>
    <p>Teléfono Soporte: <b class="text-danger" id="ver_print_telefono"></b></p>--}}

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-primary card-outline" id="card_dashboard">
                <div class="card-body invisible" id="card_dashboard_body">
                    <p>Bienvenido al Panel de Administración.</p>
                    <p>Precio Dólar: <b class="text-lightblue" id="ver_print_dollar"></b></p>
                    <p>Correo Soporte: <b class="text-lightblue" id="ver_print_email"></b></p>
                    <p>Teléfono Soporte: <b class="text-lightblue" id="ver_print_telefono"></b></p>
                </div>
                <div class="overlay-wrapper" id="ver_cargando_dashboard">
                <div class="overlay bg-transparent">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>


    @livewire('dashboard.dolar-component')
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>
        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
            Livewire.dispatch('verDollar');
            Livewire.dispatch('verEmail');
            Livewire.dispatch('verTelefono');
        });

        function removerCargando() {
            $("#ver_cargando_dashboard").addClass('d-none');
            $("#card_dashboard_body").removeClass('invisible');
        }

        Livewire.on('printDollar', ({ dollar }) => {
            $("#ver_print_dollar").text(dollar);
            removerCargando();
        });

        Livewire.on('printEmail', ({ email }) => {
            $("#ver_print_email").text(email);
        });

        Livewire.on('printTelefono', ({ telefono }) => {
            $("#ver_print_telefono").text(telefono);
        });

        console.log('Hi!');
    </script>
@endsection
