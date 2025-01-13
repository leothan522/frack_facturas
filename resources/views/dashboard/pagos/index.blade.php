@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Pagos')

@section('content')
    @livewire('dashboard.pagos-component')
    @livewire('dashboard.pagos-registro-component')
    @livewire('dashboard.pagos-reportes-component')
    @livewire('dashboard.dolar-component')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
    <style>
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


