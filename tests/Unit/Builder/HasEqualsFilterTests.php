<?php

namespace McGo\Query\Tests\Unit\Builder;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use McGo\Query\Query;
use McGo\Query\Tests\BaseTestCase;
use PHPUnit\Framework\Attributes\Test;
use McGo\Query\Tests\Mock\Models\MockedModel;

class HasEqualsFilterTests extends BaseTestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function it_filters_for_case_sensitive_equality()
    {
        // Given
        MockedModel::factory()->count(rand(2,10))->create([
            'a_string_field' => Str::random(16)
        ]);
        $match = $this->getCaseSensitiveWord();
        $match_model = MockedModel::factory()->create([
            'a_string_field' => $match
        ]);
        MockedModel::factory()->count(rand(2,10))->create([
            'a_string_field' => Str::random(16)
        ]);

        // When
        $results = $this->getMockedQueryResultWithArray(['filterEqualsStringField' => $match]);
        $this->assertCount(1, $results);
        $result = $results[0];
        $this->assertEquals($match_model->id, $result->id);
    }


    private function getCaseSensitiveWord()
    {
        $chars = rand(8, 16);
        $word = '';
        for ($i = 0; $i < $chars; $i++) {
            $char = Str::random(1);
            if (rand(0, 1)) {
                $word .= Str::upper($char);
            } else {
                $word .= Str::lower($char);
            }
        }

        return $word;
    }

}