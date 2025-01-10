<div class="row justify-content-center"
     x-data="{ uploading: false, progress: 0 }"
     x-on:livewire-upload-start="uploading = true"
     x-on:livewire-upload-finish="uploading = false; progress = 0"
     x-on:livewire-upload-cancel="uploading = false"
     x-on:livewire-upload-error="uploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress" wire:loading.class="invisible" wire:target="btnBorrarImagen">

    <div class="d-none">
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" wire:model.live="photo" class="custom-file-input" id="customFileLang" lang="es" accept="image/jpeg, image/png">
                <label class="custom-file-label text-sm" for="customFileLang" data-browse="Elegir">Seleccionar Imagen</label>
            </div>
        </div>
    </div>

    <div class="row col-12 justify-content-center mb-3 mt-3">
        <div class="col-8" style="cursor:pointer;">
            <img class="img-thumbnail" src="{{ asset(verImagen($imagen)) }}" alt="Logo Empesa" onclick="imgEmpresa()"   />
            @if($photo || $btnImgBorrar)
                <button type="button" class="btn badge text-danger position-absolute float-right" wire:click="btnBorrarImagen">
                    <i class="fas fa-trash-alt"></i>
                </button>
            @endif
        </div>
    </div>

    <div class="col-12 text-center mb-3">
        @error('photo')
        <span class="text-sm text-bold text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="col-10">
        <!-- Progress Bar -->
        <div x-show="uploading">
            {{--<progress max="100" x-bind:value="progress"></progress>--}}
            <div class="progress rounded mb-3">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                    <span x-text="`${progress}%`"></span>
                </div>
            </div>
        </div>
    </div>

</div>

{!! verSpinner('btnBorrarImagen') !!}
