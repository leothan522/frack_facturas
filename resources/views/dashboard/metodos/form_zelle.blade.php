<div class="card card-primary card-outline">

    <div class="card-header">
        <h3 class="card-title">Zelle</h3>
        <div class="card-tools">
            {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>--}}
            {{--<span class="btn btn-tool"><i class="fas fa-list"></i></span>--}}
            <button type="button" class="btn btn-tool" wire:click="limpiar">
                <i class="fas fa-arrow-circle-left"></i> Volver
            </button>
        </div>
    </div>

    <div class="card-body table-responsive" wire:loading.class="invisible" style="max-height: calc(100vh - {{ $size }}px)">


        <form wire:submit="saveZelle">


            @if($metodos_id)
                <div class="float-right">
                    <button type="button" class="btn btn-sm" onclick="confirmToastBootstrap('delete', 'NoParametros')">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </button>
                </div>
            @endif

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">Beneficiario:</small>
                <div class="input-group">
                    <input type="text" wire:model="titular" class="form-control @error('titular') is-invalid @enderror" placeholder="Nombre completo">
                    @error('titular')
                    <span class="error invalid-feedback text-bold">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">{{ __('Email') }}:</small>
                <div class="input-group">
                    <input type="text" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}">
                    @error('email')
                    <span class="error invalid-feedback text-bold">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                @if($metodos_id)
                    <button type="submit" class="btn btn-block btn-primary">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                @else
                    <button type="submit" class="btn btn-block btn-success">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                @endif
            </div>

        </form>


    </div>

    {!! verSpinner() !!}

</div>
