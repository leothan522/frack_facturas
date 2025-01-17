<div class="card card-primary card-outline">
    <div class="card-header" wire:loading.class="invisible" wire:target="create, cancel">
        <h3 class="card-title">
            {{ $title }}
        </h3>

        <div class="card-tools">
            @if($btnNuevo)
                <button type="button" class="btn btn-tool" wire:click="create" @if(!comprobarPermisos('empresas.create')) disabled @endif>
                    <i class="fas fa-file"></i> Nuevo
                </button>
            @endif
            <button type="button" class="btn btn-tool" wire:click="cancel">
                <i class="fas fa-ban"></i> Cancelar
            </button>
            {{--<button type="button" class="btn btn-tool " --}}{{--data-card-widget="remove"--}}{{-->
                <i class="fas fa-times"></i>
            </button>--}}
        </div>
    </div>
    <div class="card-body table-responsive" wire:loading.class="invisible" wire:target="create, cancel, save" style="max-height: calc(100vh - {{ $size - ($sizeShow - 49) }}px)">

        <form wire:submit="save">

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">{{ __('Name') }}:</small>
                <div class="input-group">
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}">
                    @error('name')
                    <span class="error invalid-feedback text-bold">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">{{ __('Email') }}:</small>
                <div class="input-group">
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}">
                    @error('email')
                    <span class="error invalid-feedback text-bold">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            @if(!$btnEditar)
                <div class="form-group">
                    <small class="text-lightblue text-bold text-uppercase">{{ __('Password') }}:</small>
                    <div class="input-group">
                        <input type="text" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                        <div class="input-group-append">
                            <button type="button" wire:click="generatePassword" class="input-group-text"><i class="fas fa-key"></i></button>
                        </div>
                        @error('password')
                        <span class="error invalid-feedback text-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">{{ __('Role') }}:</small>
                <div class="input-group">
                    <select class="custom-select @error('role') is-invalid @enderror" wire:model="role">
                        <option value="">Seleccione</option>
                        @foreach($listarRoles as $role)
                            @if($role->tabla_id == -1 || $role->valor == 0 || auth()->user()->role == 1 || auth()->user()->role == 100)
                                <option value="{{ $role->rowquid }}">{{ ucwords($role->nombre) }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('role')
                    <span class="error invalid-feedback text-bold">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-block @if($users_id) btn-primary @else btn-success @endif">
                <i class="fas fa-save mr-1"></i>
                Guardar
                @if($users_id)
                    Cambios
                @endif
            </button>

        </form>

    </div>

    {!! verSpinner('create, cancel, save, generatePassword') !!}

</div>

