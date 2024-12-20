@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Usuarios')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-4">
                <h1 class="m-0 text-dark"><i class="fas fa-users-cog"></i> Usuarios</h1>
            </div>
            <div class="col-sm-8">
                <ol class="breadcrumb float-sm-right" id="header_div_listar_roles">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    <li class="breadcrumb-item active">
                        <span>Roles [ <span id="header_span_roles_rows">{{ $smListarRoles->count() }}</span> ]</span>
                    </li>
                    @if($smListarRoles->isNotEmpty())
                        @foreach($smListarRoles as $rol)
                            <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-roles-usuarios"
                                onclick="showRol('{{ $rol->rowquid }}')" style="cursor: pointer"
                                id="header_button_role_id_{{ $rol->rowquid }}">
                                <span class="btn-link" id="li_text_rol_{{ $rol->rowquid }}">{{ ucfirst($rol->nombre) }}</span>
                            </li>
                        @endforeach
                    @endif
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @livewire('dashboard.usuarios-component')
    @livewire('dashboard.roles-component')
    @livewire('dashboard.dolar-component')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        $("#from_role_usuario").submit(function(e) {
            e.preventDefault();
            let nombre = $('#input_role_nombre').val();
            Livewire.dispatch('save', { nombre: nombre });
        });

        $('#sm_from_role_usuario').submit(function (e) {
            e.preventDefault();
            let nombre = $('#sm_input_role_nombre').val();
            Livewire.dispatch('save', { nombre: nombre });
        });

        Livewire.on('addRoleList', ({ id, nombre, rows }) => {

            $('#input_role_nombre')
                .val('')
                .blur();

            $('#sm_input_role_nombre')
                .val('')
                .blur();

            let boton = '';
            boton += '<button type="button" class="btn btn-primary btn-sm btn-block m-1" data-toggle="modal"';
            boton += 'data-target="#modal-roles-usuarios" onclick="showRol(\'' + id + '\')" id="button_role_id_' + id + '" >';
            boton += nombre;
            boton += '</button>';

            let li = '';
            li += '<li class="breadcrumb-item" data-toggle="modal" data-target="#modal-roles-usuarios"';
            li += 'onclick="showRol(\'' + id + '\')" id="header_button_role_id_' + id + '">';
            li += '<span class="btn-link" id="li_text_rol_' + id + '">' + nombre + '</span>';
            li += '</li>';

            $('#div_listar_roles').append(boton);
            $('#header_div_listar_roles').append(li);

            $('#span_roles_rows').text(rows);
            $('#header_span_roles_rows').text(rows);
            Livewire.dispatch('actualizar');
        });

        function showRol(id){
            $('#div_ver_spinner_roles').removeClass('d-none');
            Livewire.dispatch('edit', { rowquid: id } );
        }

        Livewire.on('setRolList', ({ id, nombre }) => {
            $('#button_role_id_' + id).text(nombre);
            $('#li_text_rol_' + id).text(nombre);
            Livewire.dispatch('actualizar');
        });

        Livewire.on('removeRolList', ({ id, rows }) =>{
            Livewire.dispatch('limpiar');
            $('#button_role_id_' + id).addClass('d-none');
            $('#header_button_role_id_' + id).addClass('d-none');
            $('#button_rol_modal_cerrar').click();
            $('#span_roles_rows').text(rows);
            $('#header_span_roles_rows').text(rows);
            Livewire.dispatch('actualizar');
        });

        Livewire.on('cerrarModal', ({ selector }) => {
            $('#' + selector).click();
        });

        $('#button_rol_modal_cerrar').click(function (e) {
            $('#div_ver_spinner_roles').removeClass('d-none');
        });

        $('#button_permisos_modal_cerrar').click(function (e) {
            $('#div_ver_spinner_usuarios').removeClass('d-none');
        });

        //acceso a empresas ******************************************************

        function selectEmpresas(id, data)
        {

            $('#' + id).select2({
                theme: 'bootstrap4',
                data: data
            });

            $('#'  + id).val(null).trigger('change');
        }

        Livewire.on('selectEmpresas', ({ data }) => {
            selectEmpresas('select_acceso_empresas', data);
        });

        $("#select_acceso_empresas").on('change', function() {
            var val = $(this).val();
            Livewire.dispatch('empresasSeleccionadas', { data: val });
            // te muestra un array de todos los seleccionados
            //console.log(val);
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
