<?php
namespace Henrotaym\LaravelModelQueries\Tests;

use Henrotaym\LaravelTestSuite\TestSuite;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Henrotaym\LaravelHelpers\Providers\HelperServiceProvider;
use Henrotaym\LaravelModelQueries\Providers\LaravelModelQueriesServiceProvider;
use Henrotaym\LaravelContainerAutoRegister\Providers\LaravelContainerAutoRegisterServiceProvider;

class TestCase extends BaseTestCase
{
    use TestSuite;
    
    /**
     * Providers used bu application (manual registration is compulsory)
     * 
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelModelQueriesServiceProvider::class,
            HelperServiceProvider::class,
            LaravelContainerAutoRegisterServiceProvider::class
        ];
    }
}