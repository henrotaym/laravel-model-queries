<?php
namespace Henrotaym\LaravelModelQueries\Queries\Abstracts;

use ReflectionFunction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Henrotaym\LaravelModelQueries\Queries\Contracts\QueryContract;

/**
 * Representing a generic query.
 */
abstract class AbstractQuery implements QueryContract
{
    /**
     * Model linked to this query.
     * 
     * @return string
     */
    abstract public function getModel(): string;
    
    /**
     * Underlying query
     * 
     * @var QueryBuilder|EloquentBuilder
     */
    private $query;

    /**
     * Getting models.
     * 
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->getQuery()->get();
    }

    /**
     * Getting first model matching.
     * 
     * @return mixed|null
     */
    public function first()
    {
        return $this->getQuery()->first();
    }

    /**
     * Getting number of apps matching this query.
     * 
     * @return int
     */
    public function count(): int
    {
        return $this->getQuery()->count();
    }

    /**
     * Including soft deleted models.
     * 
     * @return static
     */
    public function withTrashed(): QueryContract
    {
        $this->getQuery()->withTrashed();

        return $this;
    }

    /**
     * Eager loading relation.
     * 
     * @param string $relation
     * @return static
     */
    public function with(string $relation): QueryContract
    {
        $this->getQuery()->with($relation);

        return $this;
    }

    /**
     * Oldest elements first.
     * 
     * @return static
     */
    public function oldest(): QueryContract
    {
        $this->getQuery()->oldest();

        return $this;
    }

    /**
     * Latest elements first.
     * 
     * @return static
     */
    public function latest(): QueryContract
    {
        $this->getQuery()->latest();

        return $this;
    }

    /**
     * Getting underlying query.
     * 
     * @return QueryBuilder|EloquentBuilder
     */
    public function getQuery()
    {
        if (!$this->query):
            return $this->query = $this->getModel()::query();
        endif;

        return $this->query;
    }

    /**
     * Setting underlying query.
     * 
     * @param QueryBuilder|EloquentBuilder $query
     * @return static
     */
    public function setQuery($query): QueryContract
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Limiting results retrieved to given quantity.
     * 
     * @param int $limit Won't get more results than this.
     * @return static
     */
    public function limit(int $limit): QueryContract
    {
        $this->getQuery()->limit($limit);

        return $this;
    }

    /**
     * Skipping given offset results.
     * 
     * @param int $offset
     * @return static
     */
    public function offset(int $offset): QueryContract
    {
        $this->getQuery()->offset($offset);

        return $this;
    }

    public function where(callable $callback): QueryContract
    {
        $this->getQuery()->where(fn ($query) => $this->getGroupedWhereClause($query, $callback)->getQuery());

        return $this;
    }

    public function orWhere(callable $callback): QueryContract
    {
        $this->getQuery()->orWhere(fn ($query) => $this->getGroupedWhereClause($query, $callback)->getQuery());

        return $this;
    }

    /**
     * Transforming where clause to laravel query.
     * 
     * @param QueryBuilder|EloquentBuilder $query
     * @param callable $callback fn (QueryContract $query) => QueryContract
     * @return static
     */
    protected function getGroupedWhereClause($query, callable $callback): self
    {
        /** @var static */
        $typedQuery = app()->make(static::class);
        $typedQuery->setQuery($query);

        return $callback($typedQuery);
    }

    public function whereHas(string $relation, ?callable $callback = null): QueryContract
    {
        if (is_null($callback)):
            $this->getQuery()->whereHas($relation);

            return $this;
        endif;

        $this->getQuery()->whereHas(
            $relation,
            fn ($query) => $this->getWhereHasClause($query, $callback)->getQuery()
        );

        return $this;
    }

    protected function getWhereHasClause($query, callable $callback): QueryContract
    {
        $reflection = new ReflectionFunction($callback);
        $queryParameter = $reflection->getParameters()[0];
        
        /** @var QueryContract */
        $typedQuery = app()->make($queryParameter->getType()->getName());
        $typedQuery->setQuery($query);

        return $callback($typedQuery);
    }
}