<table>
    <thead>
    <tr>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">#</th>
        <th style=" border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            FECHA
        </th>
        <th style=" border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            REFERENCIA
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            MONEDA
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            MONTO
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            METODO DE PAGO
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            CEDULA
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            CLIENTE
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            FACTURA
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            ESTATUS
        </th>
    </tr>
    </thead>
    <tbody>
    @php($i = 0)
    @foreach($pagos as $pago)
        <tr>
            <td style="border: 1px solid #000000; text-align: center">{{ ++$i }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ getFecha($pago->fecha)  }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($pago->referencia) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pago->moneda }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pago->monto }}</td>
            <td style="border: 1px solid #000000; text-align: center">
                @if($pago->metodo == 'transferencia')
                    TRANFERENCIAS
                @endif
                @if($pago->metodo == 'movil')
                    PAGO MÓVIL
                @endif
                @if($pago->metodo == 'zelle')
                    ZELLE
                @endif
            </td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pago->cliente->cedula  }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($pago->cliente->nombre.' '.$pago->cliente->apellido)}}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($pago->factura->factura_numero) }}</td>
            <td style="border: 1px solid #000000; text-align: center">
                @if($pago->estatus == 0)
                    {{ strtoupper('Esperando Validación') }}
                @endif
                @if($pago->estatus == 1)
                    {{ strtoupper('Validado') }}
                @endif
                @if($pago->estatus == 2)
                    {{ strtoupper('NO Validado (Revisar)"') }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{--@if($img)
    <img src="{{ asset('img/qrcodes/qrcode.svg') }}">
@endif--}}
