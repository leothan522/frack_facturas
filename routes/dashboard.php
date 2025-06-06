<?php

use App\Http\Controllers\Dashboard\ClientesController;
use App\Http\Controllers\Dashboard\FacturasController;
use App\Http\Controllers\Dashboard\GastosController;
use App\Http\Controllers\Dashboard\MetodosController;
use App\Http\Controllers\Dashboard\OrganizacionesController;
use App\Http\Controllers\Dashboard\PagosController;
use App\Http\Controllers\Dashboard\PlanesController;
use App\Http\Controllers\Dashboard\PruebasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ParametrosController;
use App\Http\Controllers\Dashboard\UsuariosController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\FCM\FcmController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'user.admin',
    'user.estatus',
    'user.permisos'
])->prefix('/dashboard')->group(function (){

    Route::get('fcm', [FcmController::class, 'index'])->name('fcm.index');

    Route::get('parametros', [ParametrosController::class, 'index'])->name('parametros.index');
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('export/usuarios/{buscar?}', [UsuariosController::class, 'export'])->name('usuarios.excel');

    Route::get('pruebas', [PruebasController::class, 'index'])->name('pagina.pruebas');
    Route::get('clientes', [ ClientesController::class, 'index'])->name('clientes.index');
    Route::get('clientes/export', [ClientesController::class, 'export'])->name('clientes.excel');
    Route::get('organizaciones', [ OrganizacionesController::class, 'index'])->name('organizaciones.index');
    Route::get('planes', [PlanesController::class, 'index'])->name('planes.index');
    Route::get('facturas', [FacturasController::class, 'index'])->name('facturas.index');
    Route::get('metodos', [MetodosController::class, 'index'])->name('metodos.index');
    Route::get('pagos', [PagosController::class, 'index'])->name('pagos.index');
    Route::get('gastos', [GastosController::class, 'index'])->name('gastos.index');



});

Route::get('dashboard/perfil', [UsuariosController::class, 'perfil'])->middleware('auth')->name('usuarios.perfil');
Route::get('chat-directo/{id?}', [ChatController::class, 'index'])->middleware(['user.android'])->name('chat.directo');
Route::get('facturas/{id}/export', [FacturasController::class, 'exportFactura'])->name('facturas.pdf');
