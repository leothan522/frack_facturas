@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Pagos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-file-invoice-dollar"></i> Pagos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item" onclick="initRegistro()" data-toggle="modal" data-target="#modal-default-registrar-pago" style="cursor: pointer;">
                        <span class="btn-link">Registrar Pago</span>
                    </li>
                    {{--<li class="breadcrumb-item active">Pagina en Blanco</li>--}}
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @livewire('dashboard.pagos-component')
    @livewire('dashboard.dolar-component')
    @livewire('dashboard.pagos-registro-component')
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
            $("#btn_modal_default").click();
        });

        Livewire.on('cerrarModalPago', () => {
            $("#btn_modal_default_pago").click();
        });

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        $("#button_dolar_dispath").click(function (e) {
            Livewire.dispatch('initDollar');
        });

        $("#button_email_dispath_sistema").click(function (e) {
            Livewire.dispatch('initEmail');
        });

        function select_2(id, data, event) {

            let html = '<select class="custom-control custom-select" id="'+ id +'"></select>';

            $("#div_" + id).html(html);

            $("#" + id).select2({
                dropdownParent: $('#modal-default-registrar-pago'),
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

        function initRegistro() {
            Livewire.dispatch('initRegistrarPago');
        }

        Livewire.on('initCliente', ({ data }) => {
            select_2("select_clientes", data, "getCliente");
        });

        Livewire.on('setCliente', ({ rowquid }) => {
            $("#select_clientes").val(rowquid).trigger('change');
        });

        Livewire.on('initBanco', ({ data }) => {
            select_2("select_bancos", data, 'getBanco');
        });

        Livewire.on('setBanco', ({ rowquid }) => {
            $("#select_bancos").val(rowquid).trigger('change');
        });

        function pegarPortapapeles() {
            navigator.clipboard.readText()
                .then(text => {
                    Livewire.dispatch('pegarReferencia', { referencia: text });
                    console.log('Texto del portapapeles:', text)
                })
                .catch(err => {
                    console.error('Error al leer del portapapeles:', err)
                });
        }

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        console.log('Hi!');
    </script>
@endsection
