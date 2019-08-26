<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Edupay\Edupay;

class EdupayServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Edupay', function() {
            return new Edupay;
        });
    }
}
