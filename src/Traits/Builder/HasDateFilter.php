<?php

namespace McGo\Query\Traits\Builder;

use Illuminate\Support\Carbon;
use McGo\Query\Contracts\AQueryBuilder;

/**
 * @mixin AQueryBuilder
 */
trait HasDateFilter
{

    protected function addContainsFilter(string $fieldname, string $parameterName): void
    {
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->where($this->tablePrefix() . $fieldname, 'LIKE', '%' . $this->request->get($parameterName) . '%');
        }
    }

    protected function addDateEqualsFilter(string $fieldname, string $parameterName): void
    {
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->whereDate($this->tablePrefix() . $fieldname, '=', $this->request->get($parameterName));
        }
    }

    protected function addDateBeforeFilter(string $fieldname, string $parameterName): void
    {
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->whereDate($this->tablePrefix() . $fieldname, '<=', $this->request->get($parameterName));
        }
    }

    protected function addDateAfterFilter(string $fieldname, string $parameterName): void
    {
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->whereDate($this->tablePrefix() . $fieldname, '>=', $this->request->get($parameterName));
        }
    }

    protected function addDatePastAndNotNullFilter(string $fieldname, string $parameterName): void
    {
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->whereNotNull($this->tablePrefix().$fieldname)
                ->whereDate($this->tablePrefix() . $fieldname, '<=', Carbon::now());
        }
    }
}