<?php

namespace McGo\Query\Tests\Mock\Builder;

use McGo\Query\Contracts\AQueryBuilder;

class MockedModelQueryBuilder extends AQueryBuilder
{

    public function filters(): AQueryBuilder
    {
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