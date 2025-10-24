<?php

namespace McGo\Query\Tests\Unit\Builder;

use Couchbase\QueryResult;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use McGo\Query\Query;
use McGo\Query\Tests\BaseTestCase;
use McGo\Query\Tests\Mock\Builder\MockedModelQueryBuilder;
use McGo\Query\Tests\Mock\Models\MockedModel;
use PHPUnit\Framework\Attributes\Test;

class HasContainsFilterTests extends BaseTestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_filter_by_contains_filter()
    {
        // Given
        $prefix = Str::random(4);
        $suffix = Str::random(4);
        $string = Str::random(4);

        // When
        MockedModel::factory()->create([
            'a_string_field' => $prefix.$string.$suffix
        ]);
        $random_count_other = rand(1, 10);
        MockedModel::factory()->count($random_count_other)->create([
            'a_string_field' => $prefix.$suffix
        ]);
        $result_with_filter = Query::theModel(MockedModel::class)
            ->withBuilder(MockedModelQueryBuilder::class)
            ->forArray(['filterContainsStringField' => $string])
            ->run();
        $result_without_filter = Query::theModel(MockedModel::class)
            ->withBuilder(MockedModelQueryBuilder::class)
            ->run();

        // Then
        $this->assertCount(1, $result_with_filter);
        $this->assertCount(1+$random_count_other, $result_without_filter);
    }

}