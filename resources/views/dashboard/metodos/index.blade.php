@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Metodos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="far fa-credit-card"></i> Metodos de Pago</h1>
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
    @livewire('dashboard.metodos-component')
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

        function select_2(id, data, event) {

            let html = '<div class="input-group-prepend">' +
                '<span class="input-group-text">' +
                '<i class="far fa-bookmark"></i>' +
                '</span>' +
                '</div>' +
                '<select class="custom-control custom-select" id="'+ id +'"></select>';

            $("#div_" + id).html(html);

            $("#" + id).select2({
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione'
            })
                .val(null)
                .trigger('change')
                .on('change', function () {
                    let value = $(this).val();
                    Livewire.dispatch(event, { rowquid: value });
                });
        }

        Livewire.on('initBancoTranferencia', ({ data }) => {
            select_2("transferencia_select_bancos", data, 'getBancoTransferencia');
        });

        Livewire.on('setBancoTransferencia', ({ rowquid }) => {
            $("#transferencia_select_bancos").val(rowquid).trigger('change');
        });

        Livewire.on('initBancoPagoMovil', ({ data }) => {
            select_2('pagomovil_select_bancos', data, 'getBancoPagoMovil');
        });

        Livewire.on('setBancoPagoMovil', ({ rowquid }) => {
            $("#pagomovil_select_bancos").val(rowquid).trigger('change');
        });



        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        console.log('Hi!');
    </script>
@endsection
