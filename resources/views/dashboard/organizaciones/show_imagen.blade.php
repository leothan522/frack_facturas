<div class="row justify-content-center">

    <div class="row col-12 justify-content-center mb-3 mt-3">
        <div class="col-8">
            @if($mini)
                <a href="{{ verImagen($imagen, false, true) }}" data-toggle="lightbox" data-title="Ver Imagen">
                    <img class="img-thumbnail" src="{{ verImagen($mini, false, true) }}" alt="Logo Empresa"/>
                </a>
            @else
                <img class="img-thumbnail" src="{{ verImagen(null, false, true) }}" alt="Logo Empresa"/>
            @endif
        </div>
    </div>

</div>
