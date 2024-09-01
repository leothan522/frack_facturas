@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <p>Bienvenido al panel de administración.</p>
    {{--<div class="visible-print">
        {!! QrCode::size(100)->generate("https://t.me/Leothan"); !!}
        <p class="text-lightblue"><i class="fab fa-telegram"></i> Telegram</p>
        <p>
            {{ nextCodigo(200) }}
        </p>
    </div>--}}
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
        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        console.log('Hi!');
    </script>
@endsection
