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

        function verPlanServicio() {
            addClassinvisible('#modal_clientes_servicio_header');
            addClassinvisible('#modal_clientes_servicio_body');
            addClassinvisible('#modal_clientes_servicio_footer');
            verCargando('modal-cliente-servicio');
        }

        Livewire.on('cerrarModalClienteServicio', () => {
            $("#btn_cerrar_modal_cliente_servicio").click();
        });

        function select_2_modal(id, data, event) {
            let html = '<select class="custom-select" id="'+ id +'"></select>';
            $('#div_' + id).html(html);

            $('#'  + id).select2({
                dropdownParent: $('#modal-cliente-servicio'),
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
            select_2_modal('select_organizacion', data, 'getSelectOrganizacion');
        });

        Livewire.on('setSelectOrganizacion', ({ rowquid }) => {
            $("#select_organizacion").val(rowquid).trigger('change');
        });

        Livewire.on('initSelectPlan', ({ data }) => {
            select_2_modal('select_plan_servicio', data, 'getSelectPlan');
        });

        Livewire.on('setSelectPlan', ({ rowquid }) => {
            $("#select_plan_servicio").val(rowquid).trigger('change');
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        function verFacturasCliente() {
            addClassinvisible('#modal_facturas_cliente_header');
            addClassinvisible('#modal_facturas_cliente_body');
            addClassinvisible('#modal_facturas_cliente_footer');
            verCargando('modal-facturas-cliente');
        }

        Livewire.on('cerrarModalFacturasCliente', () => {
            $("#btn_cerrar_modal_facturas_cliente").click();
        });

        function verAntenasSectoriales() {
            Livewire.dispatch('initModalAntena');
        }

        console.log('Hi!');
    </script>
@endsection
