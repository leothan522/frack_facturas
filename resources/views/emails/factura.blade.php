<h1>Hola {{ $factura->cliente_nombre }} {{ $factura->cliente_apellido }}</h1>
<p>
    Te anexamos la factura correcpondiente al mes de {{ mesEspanol(getFecha($factura->factura_fecha, 'm')) }}
    de tu servicio de internet.
</p>
