<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\App;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('AppHelper', function () {
            return new App;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
