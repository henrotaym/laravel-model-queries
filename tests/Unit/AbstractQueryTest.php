<?php
namespace Henrotaym\LaravelModelQueries\Tests\Unit;

use Mockery\MockInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Henrotaym\LaravelModelQueries\Tests\TestCase;
use Henrotaym\LaravelModelQueries\Tests\Unit\_Models\Account;
use Henrotaym\LaravelModelQueries\Tests\Unit\_Models\Query\AccountQuery;

class AbstractQueryTest extends TestCase
{
    /** @test */
    public function abstract_query_getting_model()
    {
        $this->setQuery();
        $this->assertEquals(Account::class, $this->query->getModel());
    }

    /** @test */
    public function abstract_query_getting_underlying_query_if_not_set_explicitely()
    {
        $this->setQuery()
            ->assertInstanceOf(Builder::class, $this->query->getQuery());
    }

    /** @test */
    public function abstract_query_setting_underlying_query()
    {
        $underlying = "salut";
        $this->setQuery()
            ->query->setQuery($underlying);
        
        $this->assertEquals($underlying, $this->query->getQuery());
    }

    /** @test */
    public function abstract_query_getting_results()
    {
        $this->mockQuery();
        $this->mocked_query->expects()->get()->passthru();
        $this->mocked_underlying_query->expects()->get()->andReturn(new Collection);

        $this->assertTrue($this->mocked_query->get()->isEmpty());
    }

    /** @test */
    public function abstract_query_getting_first_result()
    {
        $this->mockQuery();
        $this->mocked_query->expects()->first()->passthru();
        $this->mocked_underlying_query->expects()->first()->andReturnNull();

       $this->assertNull($this->mocked_query->first());
    }

    /** @test */
    public function abstract_query_counting_results()
    {
        $count = 5;
        $this->mockQuery();
        $this->mocked_query->expects()->count()->passthru();
        $this->mocked_underlying_query->expects()->count()->andReturn($count);

       $this->assertEquals($count, $this->mocked_query->count());
    }

    /** @var AccountQuery */
    protected $query;

    /** @var MockInterface */
    protected $mocked_query;

    /** @var MockInterface */
    protected $mocked_underlying_query;

    protected function setQuery()
    {
        $this->query = app()->make(AccountQuery::class);

        return $this;
    }

    protected function mockQuery()
    {
        $this->mocked_query = $this->mockThis(AccountQuery::class);
        $this->mocked_underlying_query = $this->mockThis(Builder::class);

        $this->mocked_query->expects()->getQuery()->andReturn($this->mocked_underlying_query);
    }
}