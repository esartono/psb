<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('wa',function(){
            return new Wa();
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
