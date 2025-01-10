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

        function imgEmpresa()
        {
            $('#customFileLang').click();
        }

        /* Ekko Lightbox */
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        });

        console.log('Hi!');
    </script>
@endsection
