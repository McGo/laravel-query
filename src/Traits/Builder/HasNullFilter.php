<?php

namespace McGo\Query\Traits\Builder;


use McGo\Query\Contracts\AQueryBuilder;

/**
 * @mixin AQueryBuilder
 */
trait HasNullFilter
{

    protected function addNullFilter(string $fieldname, string $parameterName): void
    {
        if ($this->parameterBag->has($parameterName)) {
            $this->builder->whereNull($this->tablePrefix() . $fieldname);
        }
    }

    protected function addNotNullFilter(string $fieldname, string $parameterName): void
    {
        if ($this->parameterBag->has($parameterName)) {
            $this->builder->whereNotNull($this->tablePrefix() . $fieldname);
        }
    }

}