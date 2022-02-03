<?php
namespace Henrotaym\LaravelModelQueries;

use Henrotaym\LaravelPackageVersioning\Services\Versioning\VersionablePackage;

class Package extends VersionablePackage
{
    /**
     * Getting package prefix.
     * 
     * @return string
     */
    public static function prefix(): string
    {
        return "laravel_model_queries";
    }
}