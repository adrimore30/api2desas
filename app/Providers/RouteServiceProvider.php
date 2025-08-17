<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

   // Método que se ejecuta al iniciar el proveedor de servicios
    public function boot(): void
    {
        // Mapea las rutas de la API
        $this->mapApiRoutes();
    }

    // Método para definir las rutas de la API
    protected function mapApiRoutes(): void
    {
        Route::prefix('v1') // Define el prefijo de las rutas como 'v1'
            ->middleware('api') // Aplica el middleware 'api'
            ->group(base_path('routes/api.php')); // Agrupa las rutas desde el archivo api.php

    }
}
