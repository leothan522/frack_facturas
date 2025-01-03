<div class="card card-navy">

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

    <div class="card-body">


        <form wire:submit="saveZelle">


            @if($metodos_id)
                <div class="float-right">
                    <button type="button" class="btn btn-sm" wire:click="destroy">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </button>
                </div>
            @endif

            <div class="form-group">
                <label for="name">Beneficiario:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model="titular" placeholder="Nombre Completo">
                    @error('titular')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="name">Correo Electrónico:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                    </div>
                    <input type="email" class="form-control" wire:model="email" placeholder="Correo Electrónico">
                    @error('email')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
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

</div>
