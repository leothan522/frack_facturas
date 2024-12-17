@extends('layouts.auth_bootstrap')

@section('title', 'Olvidé mi contraseña')

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

                                    <form class="needs-validation" method="POST" action="{{ route('password.email') }}" novalidate>
                                        @csrf

                                        <div class="mb-4">
                                            <p class="fs-6 d-flex" style="text-align: justify !important;">
                                                <small class="text-muted">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</small>
                                            </p>
                                        </div>

                                        @if (session('status'))
                                            <div class="mb-4">
                                                <p class="fs-6 d-flex text-success fw-normal" style="text-align: justify !important;">
                                                    <small>{{ session('status') }}</small>
                                                </p>
                                            </div>
                                        @endif

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

                                        <div class="form-floating mb-3 has-validation">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus />
                                            <label for="email">{{ __('Email') }}</label>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su {{ __('Email') }}.
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 pb-1 d-grid gap-2">

                                            <button type="submit" class="btn shadow text-white btn-block  gradient-custom-2">{{ __('Email Password Reset Link') }}</button>

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

