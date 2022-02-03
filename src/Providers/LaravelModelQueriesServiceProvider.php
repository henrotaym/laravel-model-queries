<?php
namespace Henrotaym\LaravelModelQueries\Providers;

use Henrotaym\LaravelModelQueries\Package as UnderlyingPackage;
use Henrotaym\LaravelPackageVersioning\Providers\Abstracts\VersionablePackageServiceProvider;

class LaravelModelQueriesServiceProvider extends VersionablePackageServiceProvider
{
    public static function getPackageClass(): string
    {
        return UnderlyingPackage::class;
    }

    protected function addToRegister(): void
    {
        //
    }

    protected function addToBoot(): void
    {
        //
    }
}