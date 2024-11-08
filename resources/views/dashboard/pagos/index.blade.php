@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-file-invoice-dollar"></i> Pagos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    {{--<li class="breadcrumb-item active">Pagina en Blanco</li>--}}
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @livewire('dashboard.pagos-component')
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
            $("#btn_modal_default").click();
        });

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        $("#button_dolar_dispath").click(function (e) {
            Livewire.dispatch('initDollar');
        });

        console.log('Hi!');
    </script>
@endsection
