@extends('adminlte::page')

@section('title', 'Planes de Servicio')

@section('content_header')
    <h1><i class="fas fa-list-ol"></i> Planes de Servicio</h1>
@endsection

@section('content')
    @livewire('dashboard.planes-component')
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>
        console.log('Hi!');
    </script>
@endsection
