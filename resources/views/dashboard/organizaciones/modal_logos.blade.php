{{--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Launch Default Modal
</button>--}}

<form wire:submit="save">
    <div wire:ignore.self class="modal fade" id="modal-default-cambiar-logo" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content {{--fondo--}}">
                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        Cambiar Logo
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <small>Organización:</small>
                        <div class="input-group">
                            <select class="custom-select" wire:model.live="organizacion">
                                <option value="">Seleccione</option>
                                @foreach($listarOrganizaciones as $organizacion)
                                    <option value="{{ $organizacion->rowquid }}">{{ mb_strtoupper($organizacion->nombre) }}</option>
                                @endforeach
                            </select>
                            @error('organizacion')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center attachment-block p-3"
                         x-data="{ uploading: false, progress: 0 }"
                         x-on:livewire-upload-start="uploading = true"
                         x-on:livewire-upload-finish="uploading = false; progress = 0"
                         x-on:livewire-upload-cancel="uploading = false"
                         x-on:livewire-upload-error="uploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >

                        <div class="d-none">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" wire:model.live="photo" class="custom-file-input"
                                           id="customFileLang"
                                           lang="es" accept="image/jpeg, image/png">
                                    <label class="custom-file-label text-sm" for="customFileLang" data-browse="Elegir">Seleccionar Imagen</label>
                                </div>
                                <input type="text" wire:model.live="img_borrar">
                            </div>
                        </div>

                        <div class="col-md-8 mt-3 mb-3">
                            <div class="text-center" @if($clinkImagen) style="cursor:pointer;"  @endif>
                                <img class="img-thumbnail" src="{{ $verImagen }}" alt="Logo Empesa" @if($clinkImagen) onclick="imgLogo()" @endif />
                                @if($iconoBorrar)
                                <button type="button" class="btn badge text-danger position-absolute float-right"
                                        wire:click="btnBorrarImagen">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            @error('photo')
                            <span class="text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-10">
                            <!-- Progress Bar -->
                            <div x-show="uploading">
                                <div class="progress rounded">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                        <span x-text="`${progress}%`"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">Cerrar
                    </button>
                    <button type="submit" class="btn btn-success" @if(!$btnGuardar) disabled @endif>Guardar</button>
                </div>
                {!! verSpinner() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
