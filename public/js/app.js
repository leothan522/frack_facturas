//CAMPO BUSQUEDA EN EL NAVBAR
$("#navbarSearch").focus(function(){
    let form = $(this).closest("form");
    form.attr("onsubmit","return buscar()");
});
function buscar(){
    let input = $("#navbarSearch");
    let keyword  = input.val();
    if (keyword.length > 0){
        input.blur();
        alert('Falta vincular con el componente Livewire');
    }
    return false;
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover({
        html: true
    });
});

$("#button_dolar_dispath").click(function (e) {
    Livewire.dispatch('initDollar');
});

$("#button_email_dispath_sistema").click(function (e) {
    Livewire.dispatch('initEmail');
});

$("#button_telefono_soporte_sistema").click(function (e) {
    Livewire.dispatch('initTelefono');
});

function verModalPDF() {
    addClassinvisible('#modal_ver_pdf_header');
    addClassinvisible('#modal_ver_pdf_body');
    addClassinvisible('#modal_ver_pdf_footer');
    verCargando('modal-ver-pdf');
}

/**
 * Muestra un Spinner mientras Carga.
 *
 * require agregar con php la funcion verCargando()
 * @param id
 * @param show
 */
function verCargando(id, show = true) {
    let selector = document.querySelector('#' + id);
    if (selector){
        let spinner = document.querySelector("#" + id + " .verCargando");
        if (spinner){
            if (show){
                //selector.classList.add('invisible');
                spinner.classList.add('d-block');
            }else{
                //selector.classList.remove('invisible');
                spinner.classList.add('d-none');
            }
        }else {
            console.log('Falta verCargando() dentro del elemento #' + id)
            alert('verCargando(): Falta Elemento, ver mas detalles en consola.');
        }
    }else{
        console.log("Selector no encontrado: \n #" + id);
        alert('verCargando(): Falta Elemento, ver mas detalles en consola.');
    }

}

/**
 * Desabilita todos los botones con el selector indicado.
 *
 * @param selector
 */
function disabledButtons(selector = ".buttons_disabled") {
    const buttons = document.querySelectorAll(selector);
    buttons.forEach(boton => {
        boton.disabled = true;
    });
}

/**
 * Muestra un ToastBootstrap preguntando si esta seguro
 * Dispara un evento Livewire pasando como argumento rowquid
 *
 * @param eventLivewire
 * @param rowquid
 */
function destroyMessage(eventLivewire, rowquid) {
    confirmToastBootstrap(eventLivewire, { rowquid: rowquid });
}


/**
 * Agrega la clase invisible al selector indicado
 * Para ocultar el elemento mientras se muestra el cargando
 *
 * @param selector
 */
function addClassinvisible(selector) {
    document.querySelector(selector).classList.add('invisible');
}

/**
 * Copiar texto al portapapeles
 *
 * @param texto
 */
function copiarPortapapeles(texto) {
    navigator.clipboard.writeText(texto)
        .then(() => {
            toastBootstrap({ type: 'info', message: "Texto copiado al portapapeles", toast: true});
            console.log('Texto copiado al portapapeles');
        })
        .catch(err => {
            console.error('Error al copiar al portapapeles:', err)
        });
}

