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
        if ($this->parameterBag->has($parameterName)) {
            if (is_array($this->parameterBag->get($parameterName))) {
                $this->builder->where(function ($query) use ($fieldname, $parameterName) {
                    $query->whereIn($this->tablePrefix().$fieldname, $this->parameterBag->get($parameterName));

                    // if null got passed in the array whereIn will ignore it.
                    // So we add another filter to assure that null will be considered
                    if (in_array(null, $this->parameterBag->get($parameterName))) {
                        $query->orWhereNull($this->tablePrefix().$fieldname);
                    }
                });
            } else {
                $this->builder->where($this->tablePrefix().$fieldname, $this->parameterBag->get($parameterName));
            }
        }
    }

    protected function addNotEqualsFilter(string $fieldname, string $parameterName): void
    {
        if (is_array($this->parameterBag->get($parameterName))) {
            $parameter = $this->parameterBag->get($parameterName);
        } else {
            $parameter = [$this->parameterBag->get($parameterName)];
        }

        if ($this->parameterBag->has($parameterName) && !empty($this->parameterBag->get($parameterName))) {
            $this->builder->whereNotIn($this->tablePrefix().$fieldname, $parameter);
        }
    }

}