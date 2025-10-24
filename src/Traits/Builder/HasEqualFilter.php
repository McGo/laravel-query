<?php

namespace McGo\Query\Traits\Builder;


use McGo\Query\Contracts\AQueryBuilder;

/**
 * @mixin AQueryBuilder
 */
trait HasEqualFilter
{
    protected function addEqualsFilter(string $fieldname, string $parameterName): void
    {
        if ($this->request->has($parameterName)) {
            if (is_array($this->request->get($parameterName))) {
                $this->builder->where(function ($query) use ($fieldname, $parameterName) {
                    $query->whereIn($this->tablePrefix().$fieldname, $this->request->get($parameterName));

                    // if null got passed in the array whereIn will ignore it.
                    // So we add another filter to assure that null will be considered
                    if (in_array(null, $this->request->get($parameterName))) {
                        $query->orWhereNull($this->tablePrefix().$fieldname);
                    }
                });
            } else {
                $this->builder->where($this->tablePrefix().$fieldname, $this->request->get($parameterName));
            }
        }
    }

    protected function addNotEqualsFilter(string $fieldname, string $parameterName): void
    {
        if (is_array($this->request->get($parameterName))) {
            $parameter = $this->request->get($parameterName);
        } else {
            $parameter = [$this->request->get($parameterName)];
        }

        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->builder->whereNotIn($this->tablePrefix().$fieldname, $parameter);
        }
    }

}