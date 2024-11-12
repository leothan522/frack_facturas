<div>

    <div class="form-group">
        <small>Cliente:</small>
        <div wire:ignore>
            <div class="input-group" id="div_select_clientes">
                <select class="form-control"></select>
            </div>
        </div>
        @error('clientes_id')
        <span class="col-sm-12 text-sm text-bold text-danger">
            <i class="icon fas fa-exclamation-triangle"></i>
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="form-group">
        <small>Organización:</small>
        <div class="input-group">
            <select class="custom-select" wire:model.live="organizacionRowquid">
                <option value="">Seleccione</option>
                @foreach($listarOrganizaciones as $organizacion)
                    <option value="{{ $organizacion->rowquid }}">{{ mb_strtoupper($organizacion->nombre) }}</option>
                @endforeach
            </select>
            @error('organizaciones_id')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <small>Plan de Servicio:</small>
        <div class="input-group">
            <select class="custom-select" wire:model.live="planRowquid" id="select_form_servicio_plan">
                <option value="">Seleccione</option>
                @foreach($listarPlanes as $plan)
                    <option value="{{ $plan->rowquid }}">{{ mb_strtoupper($plan->nombre) }}</option>
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
