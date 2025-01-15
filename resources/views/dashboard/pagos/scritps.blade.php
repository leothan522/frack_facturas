@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        Livewire.on('cerrarModalShowPago', () => {
            $('#btn_modal_show_pagos').click();
        });

        function initReporte() {
            Livewire.dispatch('limpiar');
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
            ocultarFormRegistroPago()
            Livewire.dispatch('btnCancelRegistrar');
        }

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        console.log('Hi!');
    </script>
@endsection
