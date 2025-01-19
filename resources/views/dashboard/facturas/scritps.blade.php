@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        Livewire.on('confirmedDelete', () => {
            $('#btn_modal_ver_factura').click();
        });

        Livewire.on('initModal', () => {
            $('#launch-modal-ver-factura').click();
        });

        console.log('Hi!');
    </script>
@endsection
