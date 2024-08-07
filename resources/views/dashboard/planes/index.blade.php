@extends('adminlte::page')

@section('title', 'Planes de Servicio')

@section('content_header')
    <h1><i class="fas fa-list-ol"></i> Planes de Servicio</h1>
@endsection

@section('content')
    @livewire('dashboard.planes-component')
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
            $('#btn_modal_cerrar').click();
        });

        function search(){
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                //alert('Falta vincular con el componente Livewire');
                Livewire.dispatch('buscar', { keyword:keyword });
            }
            return false;
        }

        console.log('Hi!');
    </script>
@endsection
