<?php

namespace McGo\Query\Tests\Mock\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use McGo\Query\Tests\Mock\Models\MockedModel;

class MockedModelFactory extends Factory
{
    protected $model = MockedModel::class;

    public function definition()
    {
        return [
            'a_uuid_field' => null,
            'a_string_field' => null,
            'a_boolean_field' => null,
            'a_text_field' => null,
            'a_json_field' => null,
            'a_integer_field' => null,
            'a_date_field' => null,
            'a_datetime_field' => null,
            'a_timestamp_field' => null,
        ];
    }
}