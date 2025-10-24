<?php

namespace McGo\Query\Tests\Unit\Builder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use McGo\Query\Tests\BaseTestCase;
use McGo\Query\Tests\Mock\Models\MockedModel;
use McGo\Query\Traits\Builder\HasDefaultSorting;
use PHPUnit\Framework\Attributes\Test;

/**
 * @see HasDefaultSorting
 */
class HasDefaultSortingTests extends BaseTestCase
{
    use RefreshDatabase;
    use WithFaker;

    #[Test]
    public function it_sorts_for_int_field()
    {
        // Given
        $number_of_values = rand(4,10);
        $max = 0;
        $min = 100;
        for ($i = 0; $i < $number_of_values; $i++) {
            $number = rand(1,100);
            $max = $number > $max ? $number : $max;
            $min = $number < $min ? $number : $min;
            MockedModel::factory()->create([
                'a_integer_field' => $number
            ]);
        }

        // When
        $result_desc = $this->getMockedQueryResultWithArray(['orderBy' => 'a_integer_field', 'orderType' => 'DESC']);
        $result_asc = $this->getMockedQueryResultWithArray(['orderBy' => 'a_integer_field', 'orderType' => 'ASC']);
        $result = $this->getMockedQueryResultWithArray(['orderBy' => 'a_integer_field']);

        // Then
        $this->assertEquals($max, $result_desc[0]->a_integer_field);
        $this->assertEquals($min, $result_asc[0]->a_integer_field);
        $this->assertEquals($min, $result[0]->a_integer_field);
    }

    #[Test]
    public function it_sorts_for_date_field()
    {
        // Given
        $number_of_values = rand(4,10);
        $max = null;
        $min = null;
        for ($i = 0; $i < $number_of_values; $i++) {
            $new_date = Carbon::createFromFormat('Y-m-d', $this->faker->date());
            $max = is_null($max) ? $new_date : ($new_date->gt($max) ? $new_date : $max);
            $min = is_null($min) ? $new_date : ($new_date->lt($min) ? $new_date : $min);
            MockedModel::factory()->create([
                'a_date_field' => $new_date
            ]);
        }

        // When
        $result_desc = $this->getMockedQueryResultWithArray(['orderBy' => 'a_date_field', 'orderType' => 'DESC']);
        $result_asc = $this->getMockedQueryResultWithArray(['orderBy' => 'a_date_field', 'orderType' => 'ASC']);
        $result = $this->getMockedQueryResultWithArray(['orderBy' => 'a_date_field']);

        // Then
        $this->assertEquals($max, $result_desc[0]->a_date_field);
        $this->assertEquals($min, $result_asc[0]->a_date_field);
        $this->assertEquals($min, $result[0]->a_date_field);
    }


    #[Test]
    public function it_sorts_for_datetime_field()
    {
        // Given
        $number_of_values = rand(4,10);
        $max = null;
        $min = null;
        for ($i = 0; $i < $number_of_values; $i++) {
            $new_date = Carbon::createFromFormat('Y-m-d', $this->faker->date());
            $max = is_null($max) ? $new_date : ($new_date->gt($max) ? $new_date : $max);
            $min = is_null($min) ? $new_date : ($new_date->lt($min) ? $new_date : $min);
            MockedModel::factory()->create([
                'a_datetime_field' => $new_date
            ]);
        }

        // When
        $result_desc = $this->getMockedQueryResultWithArray(['orderBy' => 'a_datetime_field', 'orderType' => 'DESC']);
        $result_asc = $this->getMockedQueryResultWithArray(['orderBy' => 'a_datetime_field', 'orderType' => 'ASC']);
        $result = $this->getMockedQueryResultWithArray(['orderBy' => 'a_datetime_field']);

        // Then
        $this->assertEquals($max, $result_desc[0]->a_datetime_field);
        $this->assertEquals($min, $result_asc[0]->a_datetime_field);
        $this->assertEquals($min, $result[0]->a_datetime_field);
    }

    #[Test]
    public function it_sorts_for_timestamp_field()
    {
        // Given
        $number_of_values = rand(4,10);
        $max = null;
        $min = null;
        for ($i = 0; $i < $number_of_values; $i++) {
            $new_date = Carbon::createFromFormat('Y-m-d', $this->faker->date());
            $max = is_null($max) ? $new_date : ($new_date->gt($max) ? $new_date : $max);
            $min = is_null($min) ? $new_date : ($new_date->lt($min) ? $new_date : $min);
            MockedModel::factory()->create([
                'a_timestamp_field' => $new_date
            ]);
        }

        // When
        $result_desc = $this->getMockedQueryResultWithArray(['orderBy' => 'a_timestamp_field', 'orderType' => 'DESC']);
        $result_asc = $this->getMockedQueryResultWithArray(['orderBy' => 'a_timestamp_field', 'orderType' => 'ASC']);
        $result = $this->getMockedQueryResultWithArray(['orderBy' => 'a_timestamp_field']);

        // Then
        $this->assertEquals($max, $result_desc[0]->a_timestamp_field);
        $this->assertEquals($min, $result_asc[0]->a_timestamp_field);
        $this->assertEquals($min, $result[0]->a_timestamp_field);
    }

}