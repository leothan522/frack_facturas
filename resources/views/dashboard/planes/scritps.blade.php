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
                    Livewire.dispatch(event, { rowquid: value });
                });
        }

        Livewire.on('initSelectOrganizacion', ({ data }) => {
            select_2('select_organizacion', data, 'getSelectOrganizacion');
        });

        Livewire.on('setSelectOrganizacion', ({ rowquid }) => {
            $("#select_organizacion").val(rowquid).trigger('change');
        });


        console.log('Hi!');
    </script>
@endsection
