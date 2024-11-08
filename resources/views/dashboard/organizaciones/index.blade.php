@extends('adminlte::page')

@section('title', 'Organizaciones')

@section('content_header')
    <h1><i class="fas fa-satellite-dish"></i> Organizaciones</h1>
@endsection

@section('content')
    @livewire('dashboard.organizaciones-component')
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

        Livewire.on('cerrarModal', () => {
            $("#btn_modal_cerrar").click();
        });

        $("#button_dolar_dispath").click(function (e) {
            Livewire.dispatch('initDollar');
        });

        console.log('Hi!');
    </script>
@endsection
