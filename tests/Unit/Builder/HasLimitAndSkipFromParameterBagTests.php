<?php

namespace McGo\Query\Tests\Unit\Builder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use McGo\Query\Tests\BaseTestCase;
use McGo\Query\Tests\Mock\Models\MockedModel;
use PHPUnit\Framework\Attributes\Test;

class HasLimitAndSkipFromParameterBagTests extends BaseTestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_limits_to_parameter() {
        // Given
        $count_models = rand(9,99);
        MockedModel::factory()->count($count_models)->create();

        // When
        $count_limit = rand(1,8);
        $result = $this->getMockedQueryResultWithArray([
            'limit' => $count_limit
        ]);

        // Then
        $this->assertCount($count_limit, $result);
    }
    #[Test]
    public function it_skips_to_parameter() {
        // Given
        $count_models = rand(9,99);
        MockedModel::factory()->count($count_models)->create();

        // When
        $count_skip = rand(1,8);
        $builder = $this->getMockedQueryBuilderWithArray([
            'skip' => $count_skip
        ]);

        // Since we are testing with sqlite, limit has to be added as well - only in tests...
        $builder->limit(PHP_INT_MAX);
        $result = $builder->get();


        // Then
        $this->assertCount($count_models - $count_skip, $result);
    }

}