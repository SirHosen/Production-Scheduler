<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
=======
use Illuminate\Pagination\Paginator;
>>>>>>> 2db00e5 (update)

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
<<<<<<< HEAD
        //
=======
        // Use Bootstrap for pagination
        Paginator::useBootstrap();
>>>>>>> 2db00e5 (update)
    }
}
