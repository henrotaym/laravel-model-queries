<?php
namespace Henrotaym\LaravelModelQueries\Queries\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Henrotaym\LaravelContainerAutoRegister\Services\AutoRegister\Contracts\AutoRegistrableContract;

/**
 * Representing a generic query.
 */
interface QueryContract extends AutoRegistrableContract
{
    /**
     * Getting apps.
     * 
     * @return Collection
     */
    public function get(): Collection;

    /**
     * Getting first app matching.
     * 
     * @return mixed|null
     */
    public function first();

    /**
     * Getting number of apps matching this query.
     * 
     * @return int
     */
    public function count(): int;

    /**
     * Getting underlying query.
     * 
     * @return mixed
     */
    public function getQuery();

    /**
     * Setting underlying query.
     * 
     * @param mixed $query
     * @return QueryContract
     */
    public function setQuery($query): QueryContract;
}