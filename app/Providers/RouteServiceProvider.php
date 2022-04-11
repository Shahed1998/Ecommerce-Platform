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
    public const HOME = '/home';

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
                ->group(base_path('routes/api.php'));

            // Customer API
            Route::prefix('customer/api')
                ->middleware(['api'])
                ->group(base_path('routes/APIs/customer.php'));
            
            // Admin API
            Route::prefix('admin/api')
                ->middleware('api')
                ->group(base_path('routes/APIs/admin.php'));
            
            // Delivery API
            Route::prefix('api/delivery')
                ->middleware('api')
                ->group(base_path('routes/APIs/delivery.php'));
            
            // Vendor API
            Route::prefix('api/vendor')
                ->middleware('api')
                ->group(base_path('routes/APIs/vendor.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->prefix('customer')
                ->group(base_path('routes/customer.php'));

            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->prefix('vendor')
                ->group(base_path('routes/vendor.php'));

            Route::middleware('web')
                ->prefix('staff_delivery')
                ->group(base_path('routes/staff_delivery.php'));
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
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
