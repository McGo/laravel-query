<?php

namespace McGo\Query\Tests\Mock\Builder;

use McGo\Query\Contracts\AQueryBuilder;
use McGo\Query\Traits\Builder\HasContainsFilter;

class MockedModelQueryBuilder extends AQueryBuilder
{
    use HasContainsFilter;

    public function filters(): AQueryBuilder
    {
        $this->addContainsFilter('a_string_field', 'filterContainsStringField');
        return $this;
    }

    public function with(): AQueryBuilder
    {
        return $this;
    }

    public function scopes(): AQueryBuilder
    {
        return $this;
    }

    public function order(): AQueryBuilder
    {
        return $this;
    }
}