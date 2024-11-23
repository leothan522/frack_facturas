<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewPDF</title>
    <link rel="stylesheet" href="{{ asset('css/invoice_style.css') }}" type="text/css" media="all" />
</head>

<body>
<div>
    <div class="py-4">
        <div class="px-14 py-6">
            <table class="w-full border-collapse border-spacing-0">
                <tbody>
                <tr>
                    <td class="w-full align-top">
                        <div>
                            <img src="{{ $imagen }}" class="h-12" />
                        </div>
                    </td>

                    <td class="align-top">
                        <div class="text-sm">
                            <table class="border-collapse border-spacing-0">
                                <tbody>
                                <tr>
                                    <td class="border-r pr-4">
                                        <div>
                                            <p class="whitespace-nowrap text-slate-400 text-right">Fecha</p>
                                            <p class="whitespace-nowrap font-bold text-main text-right">{{--April 26, 2023--}}{{ $factura_fecha }}</p>
                                        </div>
                                    </td>
                                    <td class="pl-4">
                                        <div>
                                            <p class="whitespace-nowrap text-slate-400 text-right">Factura #</p>
                                            <p class="whitespace-nowrap font-bold text-main text-right">{{ $factura_numero }}</p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-slate-100 px-14 py-6 text-sm">
            <table class="w-full border-collapse border-spacing-0">
                <tbody>
                <tr>
                    <td class="w-1/2 align-top">
                        <div class="text-sm text-neutral-600">
                            <p class="font-bold">{{ $organizacion_nombre }}</p>
                            <p>{{ $organizacion_rif }}</p>
                            <p>{{ $organizacion_direccion }}</p>
                        </div>
                    </td>
                    <td class="w-1/2 align-top text-right">
                        <div class="text-sm text-neutral-600">
                            <p class="font-bold">Cliente</p>
                            <p>{{ $cliente_nombre }}</p>
                            <p>Cédula: {{ $cliente_cedula }}</p>
                            <p>Tlf: {{ $cliente_telefono }}</p>
                            <p>{{ $cliente_email }}</p>
                            <p>{{ $cliente_direccion }}</p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="px-14 py-10 text-sm text-neutral-700">
            <table class="w-full border-collapse border-spacing-0">
                <thead>
                <tr>
                    <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">#</td>
                    <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Plan de Servicio</td>
                    <td class="border-b-2 border-main pb-3 pl-2 pr-3 text-right font-bold text-main">Precio</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="border-b py-3 pl-3">1.</td>
                    <td class="border-b py-3 pl-2">{{ $plan_servicio }}</td>
                    <td class="border-b py-3 pl-2 pr-3 text-right">{{ $organizacion_moneda }} {{ $total }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table class="w-full border-collapse border-spacing-0">
                            <tbody>
                            <tr>
                                <td class="w-full"></td>
                                <td>
                                    <table class="w-full border-collapse border-spacing-0">
                                        <tbody>
                                        <tr>
                                            <td class="border-b p-3">
                                                <div class="whitespace-nowrap text-slate-400">Subtotal:</div>
                                            </td>
                                            <td class="border-b p-3 text-right">
                                                <div class="whitespace-nowrap font-bold text-main">{{ $organizacion_moneda }} {{ $total }}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-3">
                                                <div class="whitespace-nowrap text-slate-400">I.V.A:</div>
                                            </td>
                                            <td class="p-3 text-right">
                                                <div class="whitespace-nowrap font-bold text-main">-</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-main p-3">
                                                <div class="whitespace-nowrap font-bold text-white">Total:</div>
                                            </td>
                                            <td class="bg-main p-3 text-right">
                                                <div class="whitespace-nowrap font-bold text-white">{{ $organizacion_moneda }} {{ $total }}</div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        @if($pago)
            <div class="px-14 text-sm text-neutral-700">
                <p class="text-main font-bold">DETALLES DE PAGO</p>
                <p>Metodo: {{ $metodo }}</p>
                <p>Referencia: {{ $referencia }}</p>
                @if(!empty($banco))
                    <p>Banco: {{ $banco }}</p>
                @endif
                <p>Monto: {{ $monto }}</p>
                <p>Fecha Pago: {{ $fecha_pago }}</p>
            </div>
        @endif

        @if(!empty($notas))
            <div class="px-14 py-10 text-sm text-neutral-700">
                <p class="text-main font-bold">Notas</p>
                <p class="italic">{{ $notas }}</p>
            </div>
        @endif

        <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
            {{ $organizacion_nombre }}
            <span class="text-slate-300 px-2">|</span>
            {{ $organizacion_email }}
            <span class="text-slate-300 px-2">|</span>
            {{ $organizacion_telefono }}
        </footer>
    </div>
</div>
</body>

</html>
