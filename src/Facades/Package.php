<?php
namespace Henrotaym\LaravelModelQueries\Facades;

use Illuminate\Support\Facades\Facade;
use Henrotaym\LaravelModelQueries\Package as UnderlyingPackage;

class Package extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return UnderlyingPackage::$prefix;
    }
}