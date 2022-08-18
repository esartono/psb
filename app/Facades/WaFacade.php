<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class WaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wa';
    }
}