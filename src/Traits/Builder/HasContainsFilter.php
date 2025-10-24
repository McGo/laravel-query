<?php

namespace McGo\Query\Traits\Builder;

use McGo\Query\Contracts\AQueryBuilder;

/**
 * @mixin AQueryBuilder
 */
trait HasContainsFilter
{
    protected function addContainsFilter(string $fieldname, string $parameterName): void
    {
        if ($this->parameterBag->has($parameterName) && !empty($this->parameterBag->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, 'LIKE', '%' . $this->parameterBag->get($parameterName) . '%');
        }
    }
}