<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Aquí registramos las rutas para la API
        $this->mapApiRoutes();
    }

    /**
     * Mapea las rutas de la API.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api') // Las rutas de la API deben empezar con 'api'
             ->middleware('api')  // Usamos el middleware 'api'
             ->namespace('App\Http\Controllers') // Aseguramos que el espacio de nombres sea correcto
             ->group(base_path('routes/api.php')); // Cargamos las rutas desde 'routes/api.php'
    }
}
