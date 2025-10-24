<?php

namespace McGo\Query\Tests\Mock\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use McGo\Query\Tests\Mock\Factories\MockedModelFactory;

class MockedModel extends Model
{
    use HasFactory;
    protected $table = 'mocked_models';
    public $timestamps = false;
    protected $fillable = [
        'a_uuid_field',
        'a_string_field',
        'a_boolean_field',
        'a_text_field',
        'a_json_field',
        'a_integer_field',
        'a_date_field',
        'a_datetime_field',
        'a_timestamp_field'
    ];

    public static function newFactory()
    {
        return new MockedModelFactory();
    }

}