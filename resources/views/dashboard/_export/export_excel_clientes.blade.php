<table>
    <thead>
    <tr>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">#</th>
        <th style=" border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            Cédula
        </th>
        <th style=" border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            Nombre
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            Apellido
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            Teléfono
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            Email
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            Dirección
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center;">
            Fecha Instalación
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            Fecha Pago
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            Latitud
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            Longitud
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            GPS
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            Código
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            Organización
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            Plan de Servicio
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            Antena Sectorial
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            IP Antena
        </th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; ">
            Rango Señal
        </th>
    </tr>
    </thead>
    <tbody>
    @php($i = 0)
    @foreach($clientes as $cliente)
        <tr>
            <td style="border: 1px solid #000000; text-align: center">{{ ++$i}}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $cliente->cedula }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->nombre) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->apellido) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->telefono) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtolower($cliente->email) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->direccion) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ getFecha($cliente->fecha_instalacion) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ getFecha($cliente->fecha_pago) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->latitud) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->longitud) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->gps) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->codigo) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->organizacion) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->plan) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->verAntena) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->verIP) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ mb_strtoupper($cliente->rango) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
