<?php
namespace Henrotaym\LaravelModelQueries\Facades;

use Henrotaym\LaravelModelQueries\Package as UnderlyingPackage;
use Henrotaym\LaravelPackageVersioning\Facades\Abstracts\VersionablePackageFacade;

class Package extends VersionablePackageFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getPackageClass(): string
    {
        return UnderlyingPackage::class;
    }
}