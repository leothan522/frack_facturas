<div class="card card-primary card-outline">
    <div class="card-header" wire:loading.class="invisible" wire:target="">

        <div class="row p-0">
            <div class="col-7 col-sm-8 col-md-9 p-0">
                <h3 class="card-title">
                    @if($keyword)
                        Búsqueda
                        <span class="text-nowrap">{ <b class="text-warning">{{ $keyword }}</b> }</span>
                        <span class="text-nowrap">[ <b class="text-warning">{{ $rows }}</b> ]</span>
                        <button class="btn btn-tool text-warning" wire:click="cerrarBusqueda">
                            <i class="fas fa-times"></i>
                        </button>
                    @else
                        Todos [ <b class="text-warning">{{ $rows }}</b> ]
                    @endif
                </h3>
            </div>

            <div class="col-5 col-sm-4 col-md-3 p-0">
                <div class="card-tools">
                    <form wire:submit="buscar">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Buscar" wire:model="keyword" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <div class="card-body p-0" wire:loading.class="invisible" wire:target="">

        @include('dashboard.facturas.mailbox-controls')
        @include('dashboard.facturas.mailbox-messages')

    </div>


    <div class="card-footer p-0" wire:loading.class="invisible" wire:target="">
        @include('dashboard.facturas.mailbox-controls')
    </div>

    {!! verSpinner() !!}

</div>
