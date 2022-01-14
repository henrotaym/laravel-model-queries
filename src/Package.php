<?php
namespace Henrotaym\LaravelModelQueries;

class Package
{
    /**
     * Package prefix.
     * 
     * @var string
     */
    public static $prefix = "laravel_model_queries";

    /**
     * Getting package version (useful to make sure projetcs use same version).
     * 
     * @return string
     */
    public function version(): string
    {
        return "1.0.1";
    }

    /**
     * Getting package prefix.
     * 
     * @return string
     */
    public function prefix(): string
    {
        return self::$prefix;
    }

    /**
     * Getting config value.
     * Prefix is automatically added to given key.
     * 
     * @param string $key key to get in config file.
     * @return mixed
     */
    public function config(string $key = null)
    {
        return config($this->prefix(). ($key ? ".$key" : ''));
    }
}