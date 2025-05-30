<?php
//Funciones Personalizadas para el Proyecto
use Illuminate\Support\Facades\Auth;

function comprobarPermisos($routeName = null)
{

    if (leerJson(Auth::user()->permisos, $routeName) || Auth::user()->role == 1 || Auth::user()->role == 100) {
        return true;
    } else {
        return false;
    }

}

function allPermisos()
{
    $permisos = [
        'Clientes' => [
            'route' => 'clientes.index',
            'submenu' => [
                'Exportar Excel' => 'clientes.excel',
                'Reenviar Bienvenida' => 'clientes.bienvenida',
                'Reenviar Contrato' => 'clientes.contrato',
                'Crear Clientes' => 'clientes.create',
                'Editar Clientes' => 'clientes.edit',
                'Borrar Clientes' => 'clientes.destroy',
                'Establecer Planes' => 'clientes.createplan',
                'Quitar Planes' => 'clientes.destroyplan',
            ]
        ],
        'Antenas' => [
            'route' => 'antenas.index',
            'submenu' => [
                'Registrar Antenas' => 'antenas.create',
                'Actualizar Antenas' => 'antenas.edit',
                'Borrar Antenas' => 'antenas.destroy',
            ]
        ],
        'Pagos' => [
            'route' => 'pagos.index',
            'submenu' => [
                'Precio Dolar' => 'precio.dollar',
                'Exportar Excel' => 'pagos.excel',
                'Registrar Pagos' => 'pagos.create',
                'Validar Pagos' => 'pagos.validar',
                'Reset Pagos' => 'pagos.reset',
            ]
        ],
        'Facturas' => [
            'route' => 'facturas.index',
            'submenu' => [
                'Facturar Automático' => 'facturas.automatico',
                'Generar Facturas' => 'facturas.create',
                'Enviar Facturas' => 'facturas.send',
                'Borrar Facturas' => 'facturas.destroy',
            ]
        ],
        'Gastos' => [
            'route' => 'gastos.index',
            'submenu' => [
                'Crear Gastos' => 'gastos.create',
                'Editar Gastos' => 'gastos.edit',
                'Borrar Gastos' => 'gastos.destroy',
            ]
        ],
        'Planes' => [
            'route' => 'planes.index',
            'submenu' => [
                'Crear Planes' => 'planes.create',
                'Editar Planes' => 'planes.edit',
                'Borrar Planes' => 'planes.destroy',
            ]
        ],
        'Organizaciones' => [
            'route' => 'organizaciones.index',
            'submenu' => [
                'Crear Organizaciones' => 'organizaciones.create',
                'Editar Organizaciones' => 'organizaciones.edit',
                'Borrar Organizaciones' => 'organizaciones.destroy',
            ]
        ],
        'Metodos Pago' => [
            'route' => 'metodos.index',
            'submenu' => [
                'Editar Metodos' => 'metodos.edit',
                'Borrar Metodos' => 'metodos.destroy',
            ]
        ],
        'Usuarios' => [
            'route' => 'usuarios.index',
            'submenu' => [
                'Exportar Excel' => 'usuarios.excel',
                'Suspender Usuarios' => 'usuarios.estatus',
                'Restituir Contraseña' => 'usuarios.password',
                'Crear Usuarios' => 'usuarios.create',
                'Editar Usuarios' => 'usuarios.edit',
                'Borrar Usuarios' => 'usuarios.destroy',
            ]
        ],
    ];
    return $permisos;
}
