<?php
//Funciones Personalizadas para el Proyecto

use App\Models\Parametro;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

function generarStringAleatorio($largo = 10, $soloNumeros = false , $espacio = false): string
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($soloNumeros){
        $caracteres = '0123456789';
    }
    $caracteres = $espacio ? $caracteres . ' ' : $caracteres;
    $string = '';
    for ($i = 0; $i < $largo; $i++) {
        $string .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $string;
}

function verRole($role, $roles_id): string
{
    $response = 'Root';

    if (is_null($roles_id)){
        $roles = Parametro::where('tabla_id', '-2')->where('valor', $role)->first();
    }else{
        $roles = Parametro::where('id', $roles_id)->first();
    }

    if ($roles){
        $response = ucwords($roles->nombre);
    }
    return $response;
}

function verImagen($path, $user = false, $web = null): string
{
    if (!is_null($path)){
        if ($user){
            if (file_exists(public_path('storage/'.$path))){
                return asset('storage/'.$path);
            }else{
                return asset('img/user.png');
            }
        }else{
            if (file_exists(public_path($path))){
                return asset($path);
            }else{
                if (is_null($web)){
                    return asset('img/img_placeholder.png');
                }else{
                    return asset('img/web_img_placeholder.jpg');
                }

            }
        }
    }else{
        if ($user){
            return asset('img/user.png');
        }
        if (is_null($web)){
            return asset('img/img_placeholder.png');
        }else{
            return asset('img/web_img_placeholder.jpg');
        }
    }
}

//Leer JSON
function leerJson($json, $key)
{
    if ($json == null) {
        return null;
    } else {
        $json = $json;
        $json = json_decode($json, true);
        if (array_key_exists($key, $json)) {
            return $json[$key];
        } else {
            return null;
        }
    }
}

function numRowsPaginate(): int
{
    $num = 15;
    $parametro = Parametro::where("nombre", "numRowsPaginate")->first();
    if ($parametro) {
        if (intval($parametro->valor)) {
            $num = intval($parametro->valor);
        }
    }
    return $num;
}

function haceCuanto($fecha): string
{
    return Carbon::parse($fecha)->diffForHumans();
}

function getFecha($fecha, $format = null): string
{
    if (is_null($fecha)){
        if (is_null($format)){
            $date = Carbon::now(env('APP_TIMEZONE', "America/Caracas"))->toDateString();
        }else{
            $date = Carbon::now(env('APP_TIMEZONE', "America/Caracas"))->format($format);
        }
    }else{
        if (is_null($format)){
            $date = Carbon::parse($fecha)->format("d/m/Y");
        }else{
            $date = Carbon::parse($fecha)->format($format);
        }
    }
    return $date;
}

// Obtener la fecha en español
function fechaEnLetras($fecha, $isoFormat = null): string
{
    // dddd => Nombre del DIA ejemplo: lunes
    // MMMM => nombre del mes ejemplo: febrero
    $format = "dddd D [de] MMMM [de] YYYY"; // fecha completa
    if (!is_null($isoFormat)){
        $format = $isoFormat;
    }
    return Carbon::parse($fecha)->isoFormat($format);
}

function listarDias(): array
{
    return ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
}

function ListarMeses(): array
{
    return ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
}

function formatoMillares($cantidad, $decimal = 2): string
{
    if (!is_numeric($cantidad)){
        $cantidad = 0;
    }
    return number_format($cantidad, $decimal, ',', '.');
}

function qrCodeGenerate($string = 'Hello World!', $size = 100, $filename = 'qrcode', $path = false, $margin = 0): string
{
    $renderer = new \BaconQrCode\Renderer\ImageRenderer(
        new \BaconQrCode\Renderer\RendererStyle\RendererStyle($size,$margin),
        new \BaconQrCode\Renderer\Image\SvgImageBackEnd(),
    );
    $writer = new \BaconQrCode\Writer($renderer);
    $writer->writeFile($string, "storage/{$filename}.svg");

    if ($path){
        return asset("storage/{$filename}.svg");
    }

    if (file_exists(public_path("storage/{$filename}.svg"))){
        return '<img src="'.asset("storage/{$filename}.svg").'" alt="QRCode">';
    }
    return "QRCode";
}

function verSpinner($target = null): string
{
    if (!empty($target)){
        $target = 'wire:target="'.$target.'"';
    }
    $spinner = '
        <div class="overlay-wrapper verCargando" wire:loading '.$target.'>
            <div class="overlay bg-transparent">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    ';

    return $spinner;
}

function verToastBootstrap(): string
{
    return '
        <div id="toastBootstrap" class="row justify-content-center">
            <!-- JS -->
        </div>
    ';
}

function numSizeCodigo(): int
{
    $num = 6;
    $parametro = Parametro::where("nombre", "size_codigo")->first();
    if ($parametro) {
        if (is_int($parametro->tabla_id)) {
            $num = intval($parametro->tabla_id);
        }
    }
    return $num;
}

function cerosIzquierda($cantidad, $cantCeros = 2): int|string
{
    if ($cantidad == 0) {
        return 0;
    }
    return str_pad($cantidad, $cantCeros, "0", STR_PAD_LEFT);
}

function nextCodigo($parametros_nombre, $parametros_tabla_id, $nombre_formato = null): string
{

    $next = 1;
    $formato = null;

    //buscamos algun formato para el codigo
    if (!is_null($nombre_formato)){
        $parametro = Parametro::where("nombre", $nombre_formato)->where('tabla_id', $parametros_tabla_id)->first();
        if ($parametro) {
            $formato = $parametro->valor;
        }else{
            $formato = "N".$parametros_tabla_id.'-';
        }
    }

    //buscamos el proximo numero
    $parametro = Parametro::where("nombre", $parametros_nombre)->where('tabla_id', $parametros_tabla_id)->first();
    if ($parametro){
        if (is_int(intval($parametro->valor))){
            $next = $parametro->valor;
        }
        $parametro->valor = $next + 1;
    }else{
        $parametro = new Parametro();
        $parametro->nombre = $parametros_nombre;
        $parametro->tabla_id = $parametros_tabla_id;
        $parametro->valor = 2;
    }
    do{
        $rowquid = generarStringAleatorio(16);
        $existe = Parametro::where('rowquid', $rowquid)->first();
    }while($existe);
    $parametro->save();

    $size = cerosIzquierda($next, numSizeCodigo());

    return $formato . $size;

}

function crearMiniaturas($imagen_data, $path_data, $opcion = 'mini'): array
{
    //ejemplo de path
    //$miniatura = 'storage/productos/size_'.$nombreImagen;

    //definir tamaños
    switch ($opcion){
        case 'mini':
            $sizes = [
                'mini' => [
                    'width' => 320,
                    'height' => 320,
                    'path' => str_replace('size_', 'mini_', $path_data)
                ]
            ];
            break;
        case 'temporal':
            $sizes = [
                'temporal' => [
                    'width' => 320,
                    'height' => 320,
                    'path' => strtolower(str_replace(' ', '', $path_data))
                ]
            ];
            break;
        default:
            $sizes = [
                'mini' => [
                    'width' => 320,
                    'height' => 320,
                    'path' => str_replace('size_', 'mini_', $path_data)
                ],
                'detail' => [
                    'width' => 540,
                    'height' => 560,
                    'path' => str_replace('size_', 'detail_', $path_data)
                ],
                'cart' => [
                    'width' => 101,
                    'height' => 100,
                    'path' => str_replace('size_', 'cart_', $path_data)
                ],
                'banner' => [
                    'width' => 570,
                    'height' => 270,
                    'path' => str_replace('size_', 'banner_', $path_data)
                ]
            ];
            break;
    }

    $respuesta = array();

    $image = Image::make($imagen_data);
    foreach ($sizes as $nombre => $items){
        $width = null;
        $height = null;
        $path = null;
        foreach ($items as $key => $valor){
            if ($key == 'width') { $width = $valor; }
            if ($key == 'height') { $height = $valor; }
            if ($key == 'path') { $path = $valor; }
        }
        $respuesta[$nombre] = $path;
        $image->resize($width, $height);
        $image->save($path);
    }

    return $respuesta;

}

function crearImagenTemporal($photo, $carpeta): string
{
    $path_data = "storage/$carpeta/tmp_".$photo->getClientOriginalName();
    $imagen = $photo->temporaryUrl();
    $miniatura = crearMiniaturas($imagen, $path_data, 'temporal');
    return "".$miniatura['temporal'];
}



//borrar imagenes incluyendo las miniaturas
function borrarImagenes($imagen, $carpeta): void
{
    if ($imagen){
        //reenplazamos storage por public
        $imagen = str_replace('storage/', 'public/', $imagen);
        //definir tamaños
        $sizes = [
            'mini' => [
                'path' => str_replace($carpeta.'/', $carpeta.'/mini_', $imagen)
            ],
            'detail' => [
                'path' => str_replace($carpeta.'/', $carpeta.'/detail_', $imagen)
            ],
            'cart' => [
                'path' => str_replace($carpeta.'/', $carpeta.'/cart_', $imagen)
            ],
            'banner' => [
                'path' => str_replace($carpeta.'/', $carpeta.'/banner_', $imagen)
            ]
        ];

        $exite = Storage::exists($imagen);
        if ($exite){
            Storage::delete($imagen);
        }

        foreach ($sizes as $items){
            $exite = Storage::exists($items['path']);
            if ($exite){
                Storage::delete($items['path']);
            }
        }
    }
}

function verUtf8($string, $safeNull = false): string
{
    //$utf8_string = "Some UTF-8 encoded BATE QUEBRADO ÑñíÍÁÜ niño ó Ó string: é, ö, ü";
    $response = null;
    $text = 'NULL';
    if ($safeNull){
        $text = '';
    }
    if (!is_null($string)){
        $response = mb_convert_encoding($string, 'UTF-8');
    }
    if (!is_null($response)){
        $text = "$response";
    }
    return $text;
}

//calculo de porcentaje
function obtenerPorcentaje($cantidad, $total): float|int
{
    if ($total != 0) {
        $porcentaje = ((float)$cantidad * 100) / $total; // Regla de tres
        $porcentaje = round($porcentaje, 2);  // Quitar los decimales
        return $porcentaje;
    }
    return 0;
}

//Crear JSON
function crearJson($array): false|string
{
    $json = array();
    foreach ($array as $key){
        $json[$key] = true;
    }
    return json_encode($json);
}

//Función comprueba una hora entre un rango
function hourIsBetween($from, $to, $input): bool
{
    $dateFrom = DateTime::createFromFormat('!H:i', $from);
    $dateTo = DateTime::createFromFormat('!H:i', $to);
    $dateInput = DateTime::createFromFormat('!H:i', $input);
    if ($dateFrom > $dateTo) $dateTo->modify('+1 day');
    return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
    /*En la función lo que haremos será pasarle, el desde y el hasta del rango de horas que queremos que se encuentre y el datetime con la hora que nos llega.
Comprobaremos si la segunda hora que le pasamos es inferior a la primera, con lo cual entenderemos que es para el día siguiente.
Y al final devolveremos true o false dependiendo si el valor introducido se encuentra entre lo que le hemos pasado.*/
}

function getDataSelect2($rows, $text, $id = "rowquid"): array
{
    $data = [];
    $filas = $rows->toArray();
    foreach ($filas as $row){
        $option = [
            'id' => $row[$id],
            'text' => $row[$text]
        ];
        $data[] = $option;
    }
    return $data;
}

function borrarQR(): void
{
    $path = public_path('storage');;
    File::delete(File::glob($path.'/*.svg'));
}

//********************** FUNCIONES PROPIAS DEL PROYECTO ATUAL ******************************

function mesEspanol($numMes = null){
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    if (!is_null($numMes)){
        $mes = $meses[$numMes - 1];
        return $mes;
    }else{
        return $meses;
    }
}

function getCorreoSistema(): string
{
    $email = '';
    $parametro = Parametro::where('nombre', 'email_sistema')->first();
    if ($parametro){
        $email = strtolower($parametro->valor);
    }
    return $email;
}

function getTelefonoSistema(): string
{
    $telefono = '';
    $parametro = Parametro::where('nombre', 'telefono_sistema')->first();
    if ($parametro){
        $telefono = strtolower($parametro->valor);
    }
    return $telefono;
}

function getDollar(): float
{
    $dolar = 1.00;
    $parametro = Parametro::where('nombre', 'precio_dolar')->first();
    if ($parametro){
        $dolar = floatval($parametro->valor);
    }
    return $dolar;
}

function getMetodoPago($metodo = null): array|string
{
    $filtro = [
        'transferencia' => 'Tranferencias',
        'movil' => 'Pago Móvil',
        'zelle' => 'Zelle',
        'all'   => 'Todos'
    ];

    if (!is_null($metodo)){
        return $filtro[$metodo];
    }else{
        return $filtro;
    }
}

function getPdfFactura($factura, $out = "stream"): \Illuminate\Http\Response|string
{
    $imagen = asset('img/logo.png');
    if ($factura->organizacion_mini){
        $imagen = verImagen($factura->organizacion_mini, false, true);
    }

    $pago = false;
    $metodo = '';
    $referencia = '';
    $banco = '';
    $monto = '';
    $fecha = '';
    $notas = '';
    if ($factura->estatus == 1){
        $pago = true;
        $metodo = getMetodoPago($factura->pago->metodo);
        $referencia = strtoupper($factura->pago->referencia);
        $banco = $factura->pago->nombre;
        $monto = $factura->pago->moneda.' '.formatoMillares($factura->pago->monto);
        $fecha = getFecha($factura->pago->fecha);
    }else{
        if ($factura->pagos_id){
            if ($factura->pago->estatus == 0){
                $notas = "Esta factura tiene un pago registrado esperando validación.";
            }
            if ($factura->pago->estatus == 2){
                $notas = "Esta factura tiene un pago registrado que fue rechazado porque no se pudo comprobar la operación.";
            }
        }
    }

    $data = [
        'imagen' => $imagen,
        'factura_fecha' => ucfirst(fechaEnLetras($factura->factura_fecha, "MMMM D[,] YYYY")),
        'factura_numero' => strtoupper($factura->factura_numero),
        'organizacion_nombre' => strtoupper($factura->organizacion_nombre),
        'organizacion_rif' => strtoupper($factura->organizacion_rif),
        'organizacion_representante' => strtoupper('Frank Sierra'),
        'organizacion_telefono' => strtoupper($factura->organizacion_telefono),
        'organizacion_email' => strtolower($factura->organizacion_email),
        'organizacion_direccion' => ucfirst($factura->organizacion_direccion),
        'organizacion_moneda' => $factura->organizacion_moneda,
        'cliente_cedula' => strtoupper($factura->cliente_cedula),
        'cliente_nombre' => strtoupper($factura->cliente_nombre.' '.$factura->cliente_apellido),
        'cliente_email' => strtolower($factura->cliente_email),
        'cliente_telefono' => strtoupper($factura->cliente_telefono),
        'cliente_direccion' => ucfirst($factura->cliente_direccion),
        'plan_servicio' => strtoupper($factura->plan_etiqueta .' ('. mesEspanol(getFecha($factura->factura_fecha, 'm')) .')'),
        'total' => formatoMillares($factura->factura_total),
        'pago' => $pago,
        'metodo' => $metodo,
        'referencia' => $referencia,
        'banco' => $banco,
        'monto' => $monto,
        'fecha_pago' => $fecha,
        'notas' => $notas
    ];
    //creamos el PDF y lo guardamos en Storage => public
    $filename = "sendFacturaID_$factura->rowquid.pdf";
    $pdf = Pdf::loadView('dashboard._export.pdf_factura', $data);

    if ($out == "stream"){
        return $pdf->stream('Factura_'.strtoupper($factura->factura_numero).'.pdf');
    }else{
        $pdf->save($filename, 'public');
        return $filename;
    }
}
