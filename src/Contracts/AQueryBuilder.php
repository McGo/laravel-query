<?php

namespace McGo\Query\Contracts;

use Illuminate\Database\Query\Builder;
use McGo\Query\Traits\Builder\HasContainsFilter;
use McGo\Query\Traits\Builder\HasDateFilter;
use McGo\Query\Traits\Builder\HasEqualFilter;
use McGo\Query\Traits\Builder\HasNullFilter;
use McGo\Query\Traits\Builder\HasNumericFilters;
use McGo\Query\Traits\Builder\HasRelationsFilter;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AQueryBuilder
{
    use HasNumericFilters;
    use HasRelationsFilter;
    use HasEqualFilter;
    use HasDateFilter;
    use HasNullFilter;
    use HasContainsFilter;

    protected ParameterBag $parameterBag;
    protected Builder $builder;

    public function __construct(Builder $builder, ParameterBag $parameterBag)
    {
        $this->parameterBag = $parameterBag;
        $this->builder = $builder;
    }

    abstract public function filters(): self;

    abstract public function with(): self;

    abstract public function scopes(): self;

    abstract public function order(): self;

    public function build(): Builder
    {
        return $this->builder;
    }
}