@extends('layouts.adminlte')

@section('title', 'Consultar Cuenta')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style type="text/css">

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] { -moz-appearance:textfield; }


        input[type=date]::-webkit-inner-spin-button,
        input[type=date]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=date] { -moz-appearance:textfield; }

    </style>
@endsection

@section('navbar')

    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="{{ route('web.consultar') }}" class="navbar-brand">
                <img src="{{ asset('img/preloader_171x171.png') }}" alt="Logo Empresa" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ mb_strtoupper(config('app.name')) }}</span>
            </a>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('img/user.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{ formatoMillares($cliente['cedula'], 0) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">

                            <p>
                                Cédula: {{ formatoMillares($cliente['cedula'], 0) }}
                                <small>{{ $cliente['email'] }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                            <button type="button" class="btn btn-default btn-flat float-right" onclick="salir()">
                                <i class="fa fa-fw fa-power-off text-red"></i>
                                {{ __('adminlte::adminlte.log_out') }}
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


@endsection

@section('content')

    @livewire('web.consultar-component')

@endsection

@section('js')
    <script src="{{ asset('vendor/select2/js/select2.full.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/i18n/es.js') }}"></script>
    <script !src="">

        function salir() {
            Livewire.dispatch('cerrarSesion');
        }

        function select_2(id, data, event) {

            let html = '<select class="custom-control custom-select" id="'+ id +'"></select>';

            $("#div_" + id).html(html);

            $("#" + id).select2({
                dropdownParent: $('#modal-default'),
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione'
            })
                .val(null)
                .trigger('change')
                .on('change', function () {
                    let value = $(this).val();
                    Livewire.dispatch(event, { rowquid: value });
                });
        }

        Livewire.on('initBanco', ({ data }) => {
            select_2("select_bancos", data, 'getBanco');
        });

        Livewire.on('setBanco', ({ rowquid }) => {
            $("#select_bancos").val(rowquid).trigger('change');
        });

        Livewire.on('cerrarModal', () => {
            $("#btn_modal_default").click();
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        function copiarPortapapeles(texto) {
            navigator.clipboard.writeText(texto)
                .then(() => {
                    Toast.fire({
                        icon: "info",
                        title: "Copiado al Portapapeles."
                    });
                    console.log('Texto copiado al portapapeles')
                })
                .catch(err => {
                    console.error('Error al copiar al portapapeles:', err)
                });
        }

        function pegarPortapapeles() {
            navigator.clipboard.readText()
                .then(text => {
                    Livewire.dispatch('pegarReferencia', { referencia: text });
                    console.log('Texto del portapapeles:', text)
                })
                .catch(err => {
                    console.error('Error al leer del portapapeles:', err)
                });
        }

        console.log('hi!')
    </script>
@endsection
