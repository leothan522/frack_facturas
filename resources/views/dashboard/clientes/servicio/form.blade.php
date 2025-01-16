<div style="height: 30px;">
    &nbsp;
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Organización:</small>
    <div wire:ignore>
        <div id="div_select_organizacion" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('organizaciones_id')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>

<div style="height: 30px;">
    &nbsp;
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Plan de Servicio:</small>
    <div wire:ignore>
        <div id="div_select_plan_servicio" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('planes_id')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>
