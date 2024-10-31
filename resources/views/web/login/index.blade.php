@extends('layouts.lockscreen')

@section('title', 'Login')

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
    <script !src="">
        console.log('hi!');
    </script>
@endsection
