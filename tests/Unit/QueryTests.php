<?php

namespace McGo\Query\Tests\Unit;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use McGo\Query\Query;
use McGo\Query\Tests\BaseTestCase;
use McGo\Query\Tests\Mock\Models\MockedModel;
use PHPUnit\Framework\Attributes\Test;

class QueryTests extends BaseTestCase
{
    use RefreshDatabase;

    #[Test]
    public function factory_creates_a_model()
    {
        // Given
        $this->assertDatabaseCount('mocked_models', 0);

        // When
        MockedModel::factory()->create();

        // Then
        $this->assertDatabaseCount('mocked_models', 1);
    }

    public function it_returns_a_query_builder_with_getbuilder()
    {
        // Given
        $count = rand(1, 10);
        MockedModel::factory()->count($count)->create();

        // When
        $builder = Query::theModel(MockedModel::class)->getBuilder();

        // Then
        $this->assertEquals(Builder::class, get_class($builder));
    }

    #[Test]
    public function it_returns_collection_by_default_initialized_by_static_method()
    {
        // Given
        $count = rand(1, 10);
        MockedModel::factory()->count($count)->create();

        // When
        $result = Query::theModel(MockedModel::class)->run();

        // Then
        $this->assertEquals(Collection::class, get_class($result));
        $this->assertCount($count, $result);

    }

    #[Test]
    public function it_returns_collection_by_default_initialized_by_constructor()
    {
        // Given
        $count = rand(1, 10);
        MockedModel::factory()->count($count)->create();

        // When
        $result = (new Query(MockedModel::class))->run();

        // Then
        $this->assertEquals(Collection::class, get_class($result));
        $this->assertCount($count, $result);

    }
}