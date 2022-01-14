<?php
namespace Henrotaym\LaravelModelQueries\Providers;

use Illuminate\Support\ServiceProvider;
use Henrotaym\LaravelModelQueries\Facades\Package;
use Henrotaym\LaravelModelQueries\Package as UnderlyingPackage;
use Henrotaym\LaravelContainerAutoRegister\Services\AutoRegister\Contracts\AutoRegisterContract;

class LaravelModelQueriesServiceProvider extends ServiceProvider
{
    /**
     * Registering things to app.
     * 
     * @return void
     */
    public function register()
    {
        $this->bindFacade()
            ->registerConfig();
    }

    /**
     * Binding facade.
     * 
     * @return self
     */
    protected function bindFacade(): self
    {
        $this->app->bind(UnderlyingPackage::$prefix, function($app) {
            return new UnderlyingPackage();
        });

        return $this;
    }
    
    /**
     * Registering config
     * 
     * @return self
     */
    protected function registerConfig(): self
    {
        $this->mergeConfigFrom($this->getConfigPath(), Package::prefix());

        return $this;
    }

    /**
     * Booting application.
     * 
     * @return void
     */
    public function boot()
    {
        $this->makeConfigPublishable();
    }

    /**
     * Allowing config publication.
     * 
     * @return self
     */
    protected function makeConfigPublishable(): self
    {
        if ($this->app->runningInConsole()):
            $this->publishes([
              $this->getConfigPath() => config_path(Package::prefix() . '.php'),
            ], 'config');
        endif;

        return $this;
    }

    /**
     * Getting config path.
     * 
     * @return string
     */
    protected function getConfigPath(): string
    {
        return __DIR__.'/../config/config.php';
    }
}