<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Maja\Maja;

class MajaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Maja', function () {
            return new Maja;
        });
    }
}
