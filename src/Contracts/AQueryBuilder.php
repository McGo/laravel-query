<?php

namespace McGo\Query\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AQueryBuilder
{
    protected ParameterBag $parameterBag;
    protected Builder $builder;

    public function __construct(Builder $builder, ParameterBag $parameterBag)
    {
        $this->parameterBag = $parameterBag;
        $this->builder = $builder;
    }

    public function filters(): self
    {
        return $this;
    }

    public function with(): self
    {
        return $this;
    }

    public function scopes(): self
    {
        return $this;
    }

    public function order(): self
    {
        return $this;
    }

    public function build(): Builder
    {
        return $this->builder;
    }
}