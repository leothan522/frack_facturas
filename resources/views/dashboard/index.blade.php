@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <p>Bienvenido al panel de administración.</p>
    <p>Precio Dólar: <b class="text-danger" id="ver_print_dollar"></b></p>
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
        });

        $("#button_dolar_dispath").click(function (e) {
            Livewire.dispatch('initDollar');
        });

        Livewire.on('printDollar', ({ dollar }) => {
            $("#ver_print_dollar").text(dollar);
        });

        console.log('Hi!');
    </script>
@endsection
