@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        Livewire.on('buscar', () => {
            addClassinvisible('#tbody_usuarios');
            verCargando('div_table_usuarios');
        });

        Livewire.on('delete', () => {
            addClassinvisible('#tbody_usuarios');
            verCargando('div_table_usuarios');
        });

        Livewire.on('deleteHide', () => {
            addClassinvisible('#div_show_header');
            addClassinvisible('#div_show_body');
            verCargando('div_show_user');
        });

        Livewire.on('deleteRole', () => {
            addClassinvisible('#div_footer_roles');
        });

        function verRoles() {
            addClassinvisible('#div_header_roles');
            addClassinvisible('#div_footer_roles');
            Livewire.dispatch('initModal');
        }

        function verPermisos(rowquid) {
            addClassinvisible('#div_header_roles');
            addClassinvisible('#div_footer_roles');
            Livewire.dispatch('showPermisos', { rowquid: rowquid });
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
