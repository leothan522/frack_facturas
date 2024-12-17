@extends('layouts.auth_bootstrap')

@section('content')

    <div class="position-relative gradient-form" style="min-height: 100vh;">
        <div class="position-absolute top-50 start-50 translate-middle container">


            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center mt-5 pt-5">
                                        <img class="img-fluid mt-lg-5" src="{{ asset('img/logo.svg') }}" alt="logo">
                                        <h6 class="mt-1 mb-5 pb-1 text_title"><strong>{{ mb_strtoupper(env('APP_NAME', 'Laravel')) }}</strong></h6>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        @auth
                                            <a class="text-muted" href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                                            <a class="text-muted ms-3" href="{{ url('/dashboard') }}">Dashboard</a>
                                        @else
                                            <a class="text-muted me-3" href="{{ route('web.consultar') }}">Consultar tu cuenta</a>
                                            <a class="text-muted" href="{{ route('login') }}">{{ __('Log in') }}</a>
                                            @if (Route::has('register'))
                                                <a class="text-muted ms-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            @endif
                                        @endauth
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-flex align-items-center gradient-custom-2" style="min-height: 70vh">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4 text-center">
                                    <h3>Desarrollado por Morros Devops</h3>
                                    <a href="https://www.morros-devops.xyz"  target="_blank" class="text-white text-decoration-none">www.morros-devops.xyz</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
@endsection
