@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        Livewire.on('initModal', () => {
            $('#launch-modal-pagos-show').click();
        });

        Livewire.on('cerrarModalShowPago', () => {
            $('#btn_modal_show_pagos').click();
        });

        function initReporte() {
            Livewire.dispatch('initReporte');
        }

        function ocultarFormRegistroPago() {
            addClassinvisible('#card_registro_pago_header')
            addClassinvisible('#card_registro_pago_body')
            verCargando('card_registro_pago')
        }

        Livewire.on('initRegistrarPago', () => {
            ocultarFormRegistroPago();
        });

        function cancelarRegistroPago() {
            ocultarFormRegistroPago();
            Livewire.dispatch('btnCancelRegistrar');
        }

        function select_2(id, data, event) {
            let html = '<select class="custom-select" id="'+ id +'"></select>';
            $('#div_' + id).html(html);

            $('#'  + id).select2({
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
            })
                .val(null)
                .trigger('change')
                .on('change', function() {
                    let value = $(this).val();
                    Livewire.dispatch(event, { id: value });
                });
        }

        Livewire.on('initSelectCliente', ({ data }) => {
            select_2('select_registrar_clientes', data, 'getSelectCliente');
            if ($('#select_registrar_facturas')){
                $('#select_registrar_facturas').val(null).trigger('change');
            }
        });

        Livewire.on('initSelectFactura', ({ data }) =>{
            select_2('select_registrar_facturas', data, 'getSelectFactura');
        });

        Livewire.on('initSelectBanco', ({ data }) => {
            select_2('select_registrar_bancos', data, 'getSelectBanco');
        });

        Livewire.on('cerrarFormRegistro', () => {
            cancelarRegistroPago();
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        console.log('Hi!');
    </script>
@endsection
