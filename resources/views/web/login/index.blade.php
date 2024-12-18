@extends('layouts.auth_bootstrap')

@section('title', __('Log in'))

@section('css')
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

@section('content')

    @livewire('web.login-component')

@endsection


@section('js')
    <script type="application/javascript">
        console.log('Hi!');

        function preloader() {
            document.querySelector('#form_cliente').classList.add('opacity-50');
            document.querySelector(".verCargando").classList.remove('d-none');
        }

    </script>
@endsection
