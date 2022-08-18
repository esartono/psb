<?php

// namespace App\Edupay\Facades;
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Edupay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Edupay';
    }
}
