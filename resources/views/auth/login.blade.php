@extends('layouts.auth_bootstrap')

@section('title', __('Log in'))

@section('content')

    <div class="position-relative gradient-form" style="min-height: 100vh;">
        <div class="position-absolute top-50 start-50 translate-middle container">


            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center mt-5 mt-sm-auto ">
                                        <a href="{{ route('web.index') }}">
                                            <img class="img-fluid" src="{{ asset('img/logo.svg') }}" alt="logo">
                                        </a>
                                        <h6 class="mt-1 mb-4 pb-1 text_title"><strong>{{ mb_strtoupper(env('APP_NAME', 'Laravel')) }}</strong></h6>
                                    </div>

                                    <form class="needs-validation position-relative" method="POST" action="{{ route('login') }}" novalidate>
                                        @csrf

                                        @if ($errors->any())
                                            <div>
                                                <div class="fs-6 text-danger fw-normal">{{ __('Whoops! Something went wrong.') }}</div>

                                                <ul class="mt-3 fs-6 text-danger fw-normal">
                                                    @foreach ($errors->all() as $error)
                                                        <li><small>{{ $error }}</small></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (session('status'))
                                            <div class="mb-4">
                                                <p class="fs-6 d-flex text-success fw-normal" style="text-align: justify !important;">
                                                    <small>{{ session('status') }}</small>
                                                </p>
                                            </div>
                                        @endif

                                        <div class="form-floating mb-3 has-validation">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus />
                                            <label for="email">{{ __('Email') }}</label>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su {{ __('Email') }}.
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3 has-validation">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                            <label for="password">{{ __('Password') }}</label>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su {{ __('Password') }}.
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1 d-grid gap-2">

                                            <button type="submit" class="btn shadow text-white btn-block fa-lg gradient-custom-2 mb-3">{{ __('Log in') }}</button>

                                            @if (Route::has('password.request'))
                                                <a class="text-muted" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                            @endif
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center">
                                            @if (Route::has('register'))
                                                <p class="mb-0 me-2">¿No tienes una cuenta?</p>
                                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">{{ __('Register') }}</a>
                                            @endif
                                        </div>

                                        <div class="position-absolute top-50 start-50 translate-middle d-none verCargando">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>

                                    </form>

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

