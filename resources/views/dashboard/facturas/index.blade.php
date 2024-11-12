@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Facturas')

@section('content_header')
    <h1><i class="fas fa-file-invoice"></i> Facturas</h1>
@endsection

@section('content')
    @include('dashboard.facturas.content')
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

        function select_2(id, data) {

            let html = '<select id="'+ id +'"></select>';
            $('#div_' + id).html(html);

            $('#'  + id).select2({
                dropdownParent: $('#modal-default'),
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
                /*allowClear: true*/
            });
            $('#'  + id).val(null).trigger('change');
            $('#'  + id).on('change', function() {
                var val = $(this).val();
                Livewire.dispatch('getClienteRowquid', { rowquid: val });
            });
        }

        Livewire.on('getSelectClientes', ({ clientes }) => {
            select_2('select_clientes', clientes);
        });

        Livewire.on('setSelectClientes', ({ rowquid }) => {
            $('#select_clientes').val(rowquid).trigger('change');
        });

        Livewire.on('cerrarModal', () => {
            $('#btn_modal_cerrar').click();
        });

        function getFacturas(id) {
            Livewire.dispatch('getFacturas', { rowquid: id });
        }

        function getServicios() {
            Livewire.dispatch('cerrarModal');
        }

        function buscar(){
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                //alert('Falta vincular con el componente Livewire');
                Livewire.dispatch('limpiarFacturas');
                Livewire.dispatch('buscar', { keyword:keyword });
            }
            return false;
        }

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        $("#button_dolar_dispath").click(function (e) {
            Livewire.dispatch('initDollar');
        });

        console.log('Hi!');

    </script>
@endsection
