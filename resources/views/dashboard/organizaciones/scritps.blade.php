@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        const div_view_card = "div_view_card_{{ $modulo }}";
        const div_view_header = "#div_view_header_{{ $modulo }}";
        const div_view_body = "#div_view_body_{{ $modulo }}";
        const div_view_footer = "#div_view_footer_{{ $modulo }}";

        Livewire.on('{{ $confirmed }}', () => {
            addClassinvisible(div_view_header)
            addClassinvisible(div_view_body)
            addClassinvisible(div_view_footer)
            verCargando(div_view_card)
        });

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

        function imgLogo()
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
