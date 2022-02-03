<?php
namespace Henrotaym\LaravelModelQueries\Queries\Abstracts;

use Illuminate\Database\Eloquent\Collection;
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
     * @var mixed
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
     * Getting underlying query.
     * 
     * @return mixed
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
     * @param mixed $query
     * @return static
     */
    public function setQuery($query): QueryContract
    {
        $this->query = $query;

        return $this;
    }
}