@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        function ocultarFormRegistro() {
            addClassinvisible('#card_registro_gasto_header')
            addClassinvisible('#card_registro_gasto_body')
            verCargando('card_registro_gasto')
        }

        Livewire.on('initRegistrar', () => {
            ocultarFormRegistro();
        });

        function cancelarRegistro() {
            ocultarFormRegistro();
            Livewire.dispatch('btnCancelRegistrar');
        }

        function initReporte() {
            Livewire.dispatch('initReporte');
        }

        Livewire.on('initModal', () => {
            $('#launch-modal-gastos-show').click();
        });

        Livewire.on('cerrarModal', () => {
            $('#btn_modal_show_gastos').click();
        });

        console.log('Hi!');
    </script>
@endsection
