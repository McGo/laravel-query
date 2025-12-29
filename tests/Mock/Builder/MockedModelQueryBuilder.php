<?php

namespace McGo\Query\Tests\Mock\Builder;

use McGo\Query\Contracts\AQueryBuilder;
use McGo\Query\Traits\Builder\HasContainsFilter;
use McGo\Query\Traits\Builder\HasDateFilter;
use McGo\Query\Traits\Builder\HasEqualFilter;
use McGo\Query\Traits\Builder\HasDefaultSorting;
use McGo\Query\Traits\Builder\HasLimitAndSkipFromParameterBag;

class MockedModelQueryBuilder extends AQueryBuilder
{
    use HasEqualFilter;
    use HasContainsFilter;
    use HasDateFilter;
    use HasLimitAndSkipFromParameterBag;
    use HasDefaultSorting;

    public function filters(): AQueryBuilder
    {
        $this->addContainsFilter('a_string_field', 'filterContainsStringField');
        $this->addDateEqualsFilter('a_date_field', 'filterDateEqualsDateField');
        $this->addEqualsFilter('a_string_field', 'filterEqualsStringField');
        $this->addEqualsFilterInsensitive('a_string_field', 'filterEqualsStringFieldInsensitive');

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