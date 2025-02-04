@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-user-friends"></i> Clientes</h1>
            </div>
            <div class="col-sm-6 d-none d-md-inline">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    <li class="breadcrumb-item">
                        @if(comprobarPermisos('antenas.index'))
                            <a href="#" data-toggle="modal" data-target="#modal-default-antena-sectorial" onclick="verAntenasSectoriales()">
                                <i class="fas fa-satellite-dish"></i> Antena Sectorial
                            </a>
                        @else
                            <span class="text-muted"><i class="fas fa-satellite-dish"></i> Antena Sectorial</span>
                        @endif
                    </li>
                    <li class="breadcrumb-item">
                        @if(comprobarPermisos('clientes.excel'))
                            <a id="btn_header_exportar_excel" href="{{ route('clientes.excel') }}" onclick="toastBootstrap({ toast: 'toast', type: 'info', message: 'Descargando Archivo.'})">
                                <i class="far fa-file-excel"></i> Exportar Excel
                            </a>
                        @else
                            <span class="text-muted"><i class="far fa-file-excel"></i> Exportar Excel</span>
                        @endif
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
