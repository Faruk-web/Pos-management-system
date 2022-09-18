<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    public static function redirectTo($guard){
        return $guard.'/dashboard';
    }

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/backend.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/pos.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/PosAgent.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/admin.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/agentPanel.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/suppler.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/employeer.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/adminCart.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/order.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/product.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/allCategory.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/brand.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/shopOwner.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/shipping.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/manager.php'));
            Route::namespace($this->namespace)
            ->group(base_path('routes/backend/banner.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
