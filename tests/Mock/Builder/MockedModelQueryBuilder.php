<?php

namespace McGo\Query\Tests\Mock\Builder;

use McGo\Query\Contracts\AQueryBuilder;
use McGo\Query\Traits\Builder\HasContainsFilter;
use McGo\Query\Traits\Builder\HasDateFilter;
use McGo\Query\Traits\Builder\HasLimitAndSkipFromParameterBag;

class MockedModelQueryBuilder extends AQueryBuilder
{
    use HasContainsFilter;
    use HasDateFilter;
    use HasLimitAndSkipFromParameterBag;

    public function filters(): AQueryBuilder
    {
        $this->addContainsFilter('a_string_field', 'filterContainsStringField');
        $this->addDateEqualsFilter('a_date_field', 'filterDateEqualsDateField');
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

    public function limit(): AQueryBuilder
    {
        $this->addLimitingFromParameterBag('limit');
        return $this;
    }

    public function skip(): AQueryBuilder
    {
        $this->addSkippingFromParameterBag('skip');
        return $this;
    }
}