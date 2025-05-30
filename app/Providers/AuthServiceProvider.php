<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('usuarios', function ($user){
            return comprobarPermisos('usuarios.index');
        });

        Gate::define('parametros', function ($user){
            return $user->role == 100;
        });

        Gate::define('clientes', function ($user){
            return comprobarPermisos('clientes.index');
        });

        Gate::define('organizaciones', function ($user){
            return comprobarPermisos('organizaciones.index');
        });

        Gate::define('planes', function ($user){
            return comprobarPermisos('planes.index');
        });

        Gate::define('facturas', function ($user){
            return comprobarPermisos('facturas.index');
        });

        Gate::define('pruebas', function ($user){
            return $user->role == 100;
        });

        Gate::define('fcm', function ($user){
            return $user->role == 100;
        });

        Gate::define('metodos', function ($user){
            return comprobarPermisos('metodos.index');
        });

        Gate::define('pagos', function ($user){
            return comprobarPermisos('pagos.index');
        });

        Gate::define('gastos', function ($user){
           return comprobarPermisos('gastos.index');
        });

        Gate::define('configuracion', function ($user){
            return comprobarPermisos();
        });

    }
}
