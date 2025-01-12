@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        console.log('Hi!');
    </script>
@endsection
