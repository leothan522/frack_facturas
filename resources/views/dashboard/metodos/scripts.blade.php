@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        function select_2(id, data, event) {

            let html = '<select class="custom-control custom-select" id="'+ id +'"></select>';

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
