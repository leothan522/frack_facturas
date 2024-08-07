<div>

    <div class="form-group">
        <div wire:ignore>
            <div class="input-group mb-3" id="div_select_clientes">
                <div class="input-group-prepend">
                    <span class="input-group-text text-bold">Cliente</span>
                </div>
                <select class="form-control"></select>
            </div>
        </div>
        @error('cliente')
        <span class="col-sm-12 text-sm text-bold text-danger">
            <i class="icon fas fa-exclamation-triangle"></i>
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-bold">Organización</span>
            </div>
            <select class="custom-select" wire:model.live="organizacionesID">
                <option value="">Seleccione</option>
                @foreach($organizaciones as $organizacion)
                    <option value="{{ $organizacion->id }}">{{ mb_strtoupper($organizacion->nombre) }}</option>
                @endforeach
            </select>
            @error('organizacionesID')
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
                <span class="input-group-text text-bold">Plan de Servicio</span>
            </div>
            <select class="custom-select" wire:model="planes_id" id="select_form_servicio_plan">
                <option value="">Seleccione</option>
                @foreach($planes as $plan)
                    <option value="{{ $plan->id }}">{{ mb_strtoupper($plan->nombre) }}</option>
                @endforeach
            </select>
            @error('planes_id')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

</div>
