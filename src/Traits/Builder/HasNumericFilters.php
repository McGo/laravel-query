<?php

namespace McGo\Query\Traits\Builder;


use McGo\Query\Contracts\AQueryBuilder;

/**
 * @mixin AQueryBuilder
 */
trait HasNumericFilters
{


    protected function addValueLessOrEqualThanFilter(string $fieldname, string $parameterName): void
    {
        if ($this->parameterBag->has($parameterName) && !empty($this->parameterBag->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, '<=', $this->parameterBag->get($parameterName));
        }
    }


    protected function addValueLessThanFilter(string $fieldname, string $parameterName): void
    {
        if ($this->parameterBag->has($parameterName) && !empty($this->parameterBag->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, '<', $this->parameterBag->get($parameterName));
        }
    }


    protected function addValueBetweenIncludingFilter(string $fieldname, string $lowerParameter, string $higherParameter): void
    {
        if (
            $this->parameterBag->has($lowerParameter)
            &&
            !empty($this->parameterBag->get($lowerParameter))
            &&
            $this->parameterBag->has($higherParameter)
            &&
            !empty($this->parameterBag->get($higherParameter))
        ) {
            $this->builder->where($this->tablePrefix() . $fieldname, '>=', $this->parameterBag->get($lowerParameter))
                ->where($this->tablePrefix() . $fieldname, '<=', $this->parameterBag->get($higherParameter));
        }
    }

    protected function addValueBetweenExcludingFilter(string $fieldname, string $lowerParameter, string $higherParameter): void
    {
        if (
            $this->parameterBag->has($lowerParameter)
            &&
            !empty($this->parameterBag->get($lowerParameter))
            &&
            $this->parameterBag->has($higherParameter)
            &&
            !empty($this->parameterBag->get($higherParameter))
        ) {
            $this->builder->where($this->tablePrefix() . $fieldname, '>', $this->parameterBag->get($lowerParameter))
                ->where($this->tablePrefix() . $fieldname, '<', $this->parameterBag->get($higherParameter));
        }
    }

    protected function addValueMoreOrEqualThanFilter(string $fieldname, string $parameterName): void
    {
        if ($this->parameterBag->has($parameterName) && !empty($this->parameterBag->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, '>=', $this->parameterBag->get($parameterName));
        }
    }

    protected function addValueMoreThanFilter(string $fieldname, string $parameterName): void
    {
        if ($this->parameterBag->has($parameterName) && !empty($this->parameterBag->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, '>', $this->parameterBag->get($parameterName));
        }
    }
}