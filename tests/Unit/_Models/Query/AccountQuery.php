<?php
namespace Henrotaym\LaravelModelQueries\Tests\Unit\_Models\Query;

use Henrotaym\LaravelModelQueries\Tests\Unit\_Models\Account;
use Henrotaym\LaravelModelQueries\Queries\Abstracts\AbstractQuery;

class AccountQuery extends AbstractQuery
{
    /**
     * Model linked to this query.
     * 
     * @return string
     */
    public function getModel(): string
    {
        return Account::class;
    }
}