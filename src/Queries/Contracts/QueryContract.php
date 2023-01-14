<?php
namespace Henrotaym\LaravelModelQueries\Queries\Contracts;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder as QueryBuilder;
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
     * @return QueryBuilder|EloquentBuilder
     */
    public function getQuery();

    /**
     * Setting underlying query.
     * 
     * @param QueryBuilder|EloquentBuilder $query
     * @return static
     */
    public function setQuery($query): QueryContract;

    /**
     * Including soft deleted models.
     * 
     * @return static
     */
    public function withTrashed(): QueryContract;

    /**
     * Eager loading relation.
     * 
     * @param string $relation Relation name to load.
     * @return static
     */
    public function with(string $relation): QueryContract;

    /**
     * Oldest elements first.
     * 
     * @return static
     */
    public function oldest(): QueryContract;

    /**
     * Latest elements first.
     * 
     * @return static
     */
    public function latest(): QueryContract;

    /**
     * Limiting results quantity to given value.
     * 
     * @param int $limit.
     * @return static
     */
    public function limit(int $limit): QueryContract;

    /**
     * Skipping given value amount of results.
     * 
     * @param int $offset
     * @return static
     */
    public function offset(int $offset): QueryContract;

    /**
     * Grouping in a where clause.
     * 
     * @param callable $callback fn (QueryContract $query) => QueryContract
     * @return static
     */
    public function where(callable $callback): QueryContract;

    /**
     * Grouping in an or where clause.
     * 
     * @param callable $callback fn (QueryContract $query) => QueryContract
     * @return static
     */
    public function orWhere(callable $callback): QueryContract;

    /**
     * Limiting to models having related models matching given query.
     * 
     * @param callable $callback fn (QueryContract $query) => QueryContract
     * @return static
     */
    public function whereHas(string $relation, callable $callback = null): QueryContract;
}