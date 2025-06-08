<table>
    <thead>
    <tr>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">#</th>
        <th style=" border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            FECHA
        </th>
        <th style=" border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            FACTURA
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            CEDULA
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            CLIENTE
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            MONEDA
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            MONTO
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            ESTATUS PAGO
        </th>
    </tr>
    </thead>
    <tbody>
    @php($i = 0)
    @foreach($facturas as $factura)
        <tr>
            <td style="border: 1px solid #000000; text-align: center">{{ ++$i }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ getFecha($factura->factura_fecha)  }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($factura->factura_numero) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $factura->cliente_cedula  }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($factura->cliente_nombre.' '.$factura->cliente_apellido)}}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $factura->organizacion_moneda }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $factura->factura_total }}</td>
            <td style="border: 1px solid #000000; text-align: center">
                @if($factura->pagos_id)
                    @if($factura->pago->estatus == 0)
                        {{ strtoupper('Pago Esperando Validación') }}
                    @endif
                    @if($factura->pago->estatus == 1)
                        {{ strtoupper('Pago Validado') }}
                    @endif
                    @if($factura->pago->estatus == 2)
                        {{ strtoupper('Pago NO Validado (Revisar)"') }}
                    @endif
                @else
                    {{ strtoupper('Sin Pago') }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
