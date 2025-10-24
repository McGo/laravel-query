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
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, '<=', $this->request->get($parameterName));
        }
    }


    protected function addValueLessThanFilter(string $fieldname, string $parameterName): void
    {
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, '<', $this->request->get($parameterName));
        }
    }


    protected function addValueBetweenIncludingFilter(string $fieldname, string $lowerParameter, string $higherParameter): void
    {
        if (
            $this->request->has($lowerParameter)
            &&
            !empty($this->request->get($lowerParameter))
            &&
            $this->request->has($higherParameter)
            &&
            !empty($this->request->get($higherParameter))
        ) {
            $this->builder->where($this->tablePrefix() . $fieldname, '>=', $this->request->get($lowerParameter))
                ->where($this->tablePrefix() . $fieldname, '<=', $this->request->get($higherParameter));
        }
    }

    protected function addValueBetweenExcludingFilter(string $fieldname, string $lowerParameter, string $higherParameter): void
    {
        if (
            $this->request->has($lowerParameter)
            &&
            !empty($this->request->get($lowerParameter))
            &&
            $this->request->has($higherParameter)
            &&
            !empty($this->request->get($higherParameter))
        ) {
            $this->builder->where($this->tablePrefix() . $fieldname, '>', $this->request->get($lowerParameter))
                ->where($this->tablePrefix() . $fieldname, '<', $this->request->get($higherParameter));
        }
    }

    protected function addValueMoreOrEqualThanFilter(string $fieldname, string $parameterName): void
    {
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, '>=', $this->request->get($parameterName));
        }
    }

    protected function addValueMoreThanFilter(string $fieldname, string $parameterName): void
    {
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, '>', $this->request->get($parameterName));
        }
    }
}