<?php

namespace McGo\Query\Tests\Unit\Builder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use McGo\Query\Tests\BaseTestCase;
use McGo\Query\Tests\Mock\Models\MockedModel;
use McGo\Query\Traits\Builder\HasDateFilter;
use PHPUnit\Framework\Attributes\Test;

/**
 * @see HasDateFilter
 */
class HasDateFilterTests extends BaseTestCase
{
    use RefreshDatabase;
    use WithFaker;

    #[Test]
    public function it_filters_for_equality_on_date()
    {
        // Given
        $date = $this->faker->date();
        $other_date = $this->faker->date();
        MockedModel::factory()->create([
            'a_date_field' => $date
        ]);

        // When & Then
        $result = $this->getMockedQueryResultWithArray(['filterDateEqualsDateField' => $date]);
        $this->assertCount(1, $result);
        $result = $this->getMockedQueryResultWithArray(['filterDateEqualsDateField' => $other_date]);
        $this->assertCount(0, $result);
    }

}