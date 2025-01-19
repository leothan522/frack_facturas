@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        Livewire.on('initModal', () => {
            $("#launch_default_modal").click();
        });

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

        function buscar(){
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                addClassinvisible("#tbody_parametros");
                verCargando('div_table_parametros');
                Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
        }

        console.log('Hi!');
    </script>
@endsection
