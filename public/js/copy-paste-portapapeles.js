function copiarPortapapeles(texto) {
    navigator.clipboard.writeText(texto)
        .then(() => {
            Toast.fire({
                icon: "info",
                title: "Copiado al Portapapeles."
            });
            console.log('Texto copiado al portapapeles')
        })
        .catch(err => {
            console.error('Error al copiar al portapapeles:', err)
        });
}

function pegarPortapapeles() {
    navigator.clipboard.readText()
        .then(text => {
            Livewire.dispatch('pegarReferencia', { referencia: text });
            console.log('Texto del portapapeles:', text)
        })
        .catch(err => {
            console.error('Error al leer del portapapeles:', err)
        });
}
