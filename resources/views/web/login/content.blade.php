<div class="position-relative gradient-form" style="min-height: 100vh;">
    <div class="position-absolute top-50 start-50 translate-middle container">


        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6 position-relative">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center mt-5 mt-sm-auto ">
                                    <a href="{{ route('web.index') }}">
                                        <img class="img-fluid" src="{{ asset('img/logo.svg') }}" alt="logo">
                                    </a>
                                    <h6 class="mt-1 mb-4 pb-1 text_title">
                                        <strong>{{ mb_strtoupper(env('APP_NAME', 'Laravel')) }}</strong></h6>
                                </div>


                                <div class="position-relative" wire:loading.class="opacity-50">

                                    <form  @if(!$user) wire:submit="validarCedula" @else wire:submit="validarCodigo" @endif >

                                        @if ($errors->any())
                                            <div>
                                                <div
                                                    class="fs-6 text-danger fw-normal">{{ __('Whoops! Something went wrong.') }}</div>

                                                <ul class="mt-3 fs-6 text-danger fw-normal">
                                                    @foreach ($errors->all() as $error)
                                                        <li><small>{{ $error }}</small></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if(!$user)

                                            <div class="form-floating mb-3 has-validation">
                                                <input id="cedula" type="number" wire:model="cedula" class="form-control" placeholder="Ingrese Cédula" required autofocus/>
                                                <label for="cedula">Cédula</label>
                                            </div>

                                            <p class="text-muted mb-3 text-center">
                                                <small class="">Ingresa tu Cédula sin puntos o espacios.</small>
                                            </p>

                                        @else

                                            <div class="form-floating mb-4 has-validation">
                                                <input id="codigo" type="number" class="form-control" wire:model="codigo" placeholder="Ingrese Código" required autofocus/>
                                                <label for="codigo">Código</label>
                                            </div>

                                            <div class="mb-4">
                                                <p class="fs-6 d-flex text-success fw-normal" style="text-align: justify !important;">
                                                    <small>
                                                        Hemos enviado un <b>código de seguridad</b> de seis (06) dígitos a su correo electrónico:
                                                        <span class="text-primary text-lowercase">{{ $cliente['email'] }}</span>, revise su bandeja de entrada y use ese código para iniciar sesión.
                                                    </small>
                                                </p>
                                            </div>

                                        @endif

                                        <div class="text-center pt-1 mb-3 pb-1 d-grid gap-2">
                                            <button type="submit" class="btn shadow text-white btn-block fa-lg gradient-custom-2 mb-3">
                                                @if(!$user) {{ __('Log in') }} @else Validar @endif
                                            </button>
                                            @if ($user)
                                                <button type="button" class="btn btn-link btn-sm text-muted p-0" wire:click="deleteSession">O inicie sesión como un usuario diferente</button>
                                            @endif
                                        </div>

                                        <div wire:loading class="position-absolute top-50 start-50 translate-middle verCargando">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>

                                    </form>
                                </div>



                            </div>

                        </div>
                        <div class="col-lg-6 d-none d-lg-flex align-items-center gradient-custom-2"
                             style="min-height: 70vh">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4 text-center">
                                <h3>Desarrollado por Morros Devops</h3>
                                <a href="https://www.morros-devops.xyz" target="_blank"
                                   class="text-white text-decoration-none">www.morros-devops.xyz</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
