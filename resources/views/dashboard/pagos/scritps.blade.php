@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        Livewire.on('cerrarModalShowPago', () => {
            $('#btn_modal_show_pagos').click();
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

        function initReporte() {
            Livewire.dispatch('limpiar');
        }

        console.log('Hi!');
    </script>
@endsection
