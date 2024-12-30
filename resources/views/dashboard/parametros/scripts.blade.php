@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        const btnCerrarModal = document.querySelector("#btn_modal_default");

        Livewire.on('cerrarModal', () => {
            btnCerrarModal.click();
            setTimeout(function () {
                addClassinvisible("#tbody_parametros");
                verCargando('div_table_parametros');
            });
        });

        Livewire.on('delete', () => {
            btnCerrarModal.click();
            addClassinvisible("#tbody_parametros");
            verCargando('div_table_parametros');
        });

        Livewire.on('buscar', () => {
            addClassinvisible("#tbody_parametros");
            verCargando('div_table_parametros');
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
