@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        const div_table_card = document.querySelector("#div_table_card_{{ $modulo }}");
        const div_table_header = document.querySelector("#div_table_header_{{ $modulo }}");
        const div_table_body = document.querySelector("#div_table_body_{{ $modulo }}");
        const div_table_footer = document.querySelector("#div_table_footer_{{ $modulo }}");

        function buscar(){
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                addClassinvisible('#tbody_{{ $modulo }}')
                verCargando('div_table_card_{{ $modulo }}');
                //alert('Falta vincular con el componente Livewire');
                Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
        }

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
