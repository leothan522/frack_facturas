@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Cloud Messaging')

@section('content_header')
    <h1><i class="fas fa-bell"></i> Firebase Cloud Messaging</h1>
@endsection

@section('content')
    @livewire('f-c-m.fcm-component')
    @livewire('dashboard.dolar-component')
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        $('#dispositivos_users').select2({
            theme: 'bootstrap4',
            language: "es"
        });

        $('#dispositivos_users').on('change', function () {
            let token = $(this).val();
            Livewire.dispatch('tokenSeleccionado', { token:token });
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        function cancelar() {
            $('#dispositivos_users').val('todos').trigger('change');
            $('#customCheckbox1')
                .removeClass('checked')
                .prop('checked', false);
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
