<div class="row justify-content-center">
    <div class="col-sm-8 col-md-5 col-lg-4 @if($ocultarCard) d-none @endif d-md-block">
        @include('dashboard.usuarios.show')
    </div>
    <div class="col-sm-8 col-md-5 col-lg-4 @if(!$form) d-none @endif ">
        @include('dashboard.usuarios.form')
    </div>
    <div class="col-md-7 col-lg-8 @if($form || $ocultarTable) d-none @endif">
        @include('dashboard.usuarios.table')
        @if(comprobarPermisos() || comprobarPermisos('usuarios.excel'))
            <div class="row justify-content-center d-md-none">
                <div class="card col-sm-6">
                    <div class="card-header">
                        <h3 class="card-title">Tareas</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            @if(comprobarPermisos())
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-toggle="modal" onclick="verRoles()" data-target="#modal-default-roles">
                                        <i class="fas fa-user-cog"></i> Roles de Usuario
                                    </a>
                                </li>
                            @endif
                            @if(comprobarPermisos('usuarios.excel'))
                                <li class="nav-item">
                                    <a href="{{ route('usuarios.excel', $keyword) }}" class="nav-link" onclick="toastBootstrap({ toast: 'toast', type: 'info', message: 'Descargando Archivo.'})">
                                        <i class="far fa-file-excel"></i> Exportar Excel
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
