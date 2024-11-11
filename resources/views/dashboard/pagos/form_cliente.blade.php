<p class="text-justify pr-3 pl-3">
    Primero selecciona a un <b>Cliente</b> para mostrar las facturas que tiene pendientes por pago, luego seleccionas una de esas facturas para registrar el pago.
</p>

<div class="pr-3 pl-3">

    <div class="form-group">
        <small>¿Cliente?</small>
        <div wire:ignore>
            <div class="input-group mb-3" id="div_select_clientes">
                <select class="custom-control custom-select">
                    <option>Seleccione</option>
                </select>
            </div>
        </div>
        @error('cliente')
        <span class="col-sm-12 text-sm text-bold text-danger">
            <i class="icon fas fa-exclamation-triangle"></i>
            {{ $message }}
        </span>
        @enderror
    </div>

    @if($cliente)
        <div class="form-group">

            <small>Facturas por Pagar:</small>

            <!-- TO DO List -->
            <ul class="todo-list" data-widget="todo-list">
                @if(!empty($listarFacturas))
                    @foreach($listarFacturas as $factura)
                        <li>
                            <!-- todo text -->
                            <span class="text text-uppercase">
                            <a href="{{ route('facturas.pdf', $factura['rowquid']) }}" target="_blank">{{ $factura['numero'] }}</a>
                        </span>
                            <!-- Emphasis label -->
                            <small class="text">
                                <span class="ml-3">USD: {{ formatoMillares($factura['montoDollar']) }}</span>
                                <span class="ml-3">Bs: {{ formatoMillares($factura['montoBs']) }}</span>
                            </small>
                            <!-- General tools such as edit or delete-->
                            <div class="tools text-primary" wire:click="verMetodos('{{ $factura['rowquid'] }}')">
                                <i class="fas fa-arrow-circle-right"></i>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-center">
                        <!-- todo text -->
                        <small><span class="text">Sin Facturas pendientes</span></small>
                    </li>
                @endif

            </ul>
            <!-- /.TO DO List -->

        </div>
    @endif

</div>
