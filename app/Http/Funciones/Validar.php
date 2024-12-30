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
