<table>
    <thead>
    <tr>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">#</th>
        <th style=" border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            FECHA
        </th>
        <th style=" border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            CONCEPTO
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            OBSERVACIÓN O EXPLICACIÓN
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            MONEDA
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            MONTO
        </th>
    </tr>
    </thead>
    <tbody>
    @php($i = 0)
    @foreach($gastos as $gasto)
        <tr>
            <td style="border: 1px solid #000000; text-align: center">{{ ++$i }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $gasto->fecha  }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($gasto->concepto) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($gasto->descripcion) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $gasto->moneda }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $gasto->monto }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{--@if($img)
    <img src="{{ asset('img/qrcodes/qrcode.svg') }}">
@endif--}}
