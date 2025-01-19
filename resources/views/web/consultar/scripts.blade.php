@section('js')
    <script src="{{ asset('vendor/select2/js/select2.full.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/i18n/es.js') }}"></script>
    <script src="{{ asset("js/app.js") }}"></script>
    <script type="application/javascript">

        function salir() {
            Livewire.dispatch('cerrarSesion');
            /*document.querySelector('#div_content_home').classList.add('invisible');
            document.querySelector("#div_preloader").classList.remove('d-none');*/
        }

        Livewire.on('initFactura', ({ rowquid, option }) => {
            document.querySelector('#' + option + "_" + rowquid).click();
        });

        Livewire.on('initVerPago', ({ rowquid }) => {
            document.querySelector('#pago_' + rowquid).click();
        });

        function copiarPortapapeles(texto) {
            navigator.clipboard.writeText(texto)
                .then(() => {
                    toastBootstrap({
                        toast: true,
                        type: 'info',
                        message: 'Copiado al Portapapeles.'
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

        function select_2(id, data, event) {
            let html = '<select class="custom-select" id="'+ id +'"></select>';
            $('#div_' + id).html(html);

            $('#'  + id).select2({
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
            })
                .val(null)
                .trigger('change')
                .on('change', function() {
                    let value = $(this).val();
                    Livewire.dispatch(event, { id: value });
                });
        }

        Livewire.on('initSelectBancos', ({ data }) => {
            select_2("select_bancos", data, 'getSelectBancos');
        });

        Livewire.on('setSelectBancos', ({ id }) => {
            $("#select_bancos").val(id).trigger('change');
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        console.log('hi!')
    </script>
@endsection
