<?php
namespace Henrotaym\LaravelModelQueries\Tests;

use Henrotaym\LaravelModelQueries\Package;
use Henrotaym\LaravelModelQueries\Providers\LaravelModelQueriesServiceProvider;
use Henrotaym\LaravelPackageVersioning\Testing\VersionablePackageTestCase;

class TestCase extends VersionablePackageTestCase
{
    public static function getPackageClass(): string
    {
        return Package::class;
    }

    /**
     * Providers used bu application (manual registration is compulsory)
     * 
     * @return array
     */
    public function getServiceProviders(): array
    {
        return [
            LaravelModelQueriesServiceProvider::class
        ];
    }
}