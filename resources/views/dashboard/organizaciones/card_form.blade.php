<div class="card card-navy" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;"
     xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        <h3 class="card-title">
            @if($nuevo) Crear @else Editar @endif Organizacion
        </h3>
        <div class="card-tools">
            {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>--}}
            @if($editar)
                <button class="btn btn-tool" wire:click="destroy({{ $organizaciones_id }})"><i class="fas fa-trash-alt"></i> Eliminar</button>
                <button class="btn btn-tool" wire:click="limpiar"><i class="fas fa-ban"></i> Cancelar</button>
            @else
                <span class="btn btn-tool"><i class="fas fa-file"></i></span>
            @endif

        </div>
    </div>

    <div class="card-body">


        <form wire:submit="save">

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Nombre</span>
                    </div>
                    <input type="text" class="form-control" wire:model="nombre" placeholder="[string]">
                    @error('nombre')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Email</span>
                    </div>
                    <input type="email" class="form-control" wire:model="email" placeholder="[string]">
                    @error('email')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Teléfono</span>
                    </div>
                    <input type="text" class="form-control" wire:model="telefono" placeholder="[string]">
                    @error('telefono')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Web</span>
                    </div>
                    <input type="text" class="form-control" wire:model="web" placeholder="[string]">
                    @error('web')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Moneda</span>
                    </div>
                    <select wire:model="moneda" class="custom-select">
                        <option value="">Seleccione</option>
                        <option value="Bs.">Bs.</option>
                        <option value="USD">USD</option>
                    </select>
                    @error('moneda')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Dias Factura</span>
                    </div>
                    <input type="text" class="form-control" wire:model="dias" placeholder="[integer]">
                    @error('dias')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Formato Factura</span>
                    </div>
                    <input type="text" class="form-control" wire:model="formato" placeholder="[string]">
                    @error('formato')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Proxima Factura</span>
                    </div>
                    <input type="text" class="form-control" wire:model="proxima" placeholder="[integer]">
                    @error('proxima')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Dirección</span>
                    </div>
                    <textarea class="form-control" cols="1" rows="1" wire:model="direccion" placeholder="[String]"></textarea>
                    @error('direccion')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>



            <div class="form-group text-right">
                <input type="submit" class="btn btn-block @if($nuevo) btn-success @else btn-primary @endif" value="Guardar @if($editar) Cambios @endif">
            </div>

        </form>

    </div>

    {!! verSpinner() !!}

</div>
