@extends('adminlte::page')

@section('title', 'Pruebas')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-tools"></i> Pagina de Pruebas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    <li class="breadcrumb-item active">Probar Componentes</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @livewire('dashboard.pruebas-component')
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

        function search(){
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                alert('Falta vincular con el componente Livewire');
                //Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
        }

        $("#button_dolar_dispath").click(function (e) {
            Livewire.dispatch('initDollar');
        });

        $("#button_email_dispath_sistema").click(function (e) {
            Livewire.dispatch('initEmail');
        });

        $("#button_telefono_soporte_sistema").click(function (e) {
            Livewire.dispatch('initTelefono');
        });

        console.log('Hi!');
    </script>
@endsection
