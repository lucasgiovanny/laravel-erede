<?php

namespace lucasgiovanny\ERede\Facades;

use Illuminate\Support\Facades\Facade;
use lucasgiovanny\ERede\Rede as RedeService;

class Rede extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RedeService::class;
    }
}
