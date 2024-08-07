@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Facturas')

@section('content_header')
    <h1><i class="fas fa-file-invoice"></i> Facturas</h1>
@endsection

@section('content')
    @include('dashboard.facturas.content')
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
            let html = '<div class="input-group-prepend">' +
                '<span class="input-group-text text-bold">' +
                'Cliente' +
                '</span>' +
                '</div> ' +
                '<select id="'+ id +'"></select>';
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
                Livewire.dispatch('getCliente', { id: val });
            });
        }

        Livewire.on('getSelectClientes', ({ clientes }) => {
            select_2('select_clientes', clientes);
        });

        Livewire.on('setSelectClientes', ({ cliente }) => {
            $('#select_clientes').val(cliente).trigger('change');
        });

        Livewire.on('setPlan', ({ plan }) => {
            setTimeout(function () {
                $('#select_form_servicio_plan').val(plan).trigger('change');
            }, 300);
        });

        Livewire.on('cerrarModal', () => {
            $('#btn_modal_cerrar').click();
        });

        function getFacturas(id) {
            Livewire.dispatch('getFacturas', { id: id });
        }

        function getServicios() {
            Livewire.dispatch('cerrarModal');
        }

        function search(){
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

        console.log('Hi!');

    </script>
@endsection
