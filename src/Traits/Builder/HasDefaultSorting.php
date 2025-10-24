<?php

namespace McGo\Query\Traits\Builder;

use McGo\Query\Contracts\AQueryBuilder;

/**
 * @mixin AQueryBuilder
 */
trait HasDefaultSorting
{
    public function order(): self
    {
        if ($this->parameterBag->has('orderBy')) {
            $orderType = $this->parameterBag->get('orderType', 'ASC');
            if ($orderType === 'DESC') {
                $this->builder->orderByDesc($this->parameterBag->has('orderBy'));
            } elseif ($orderType === 'ASC') {
                $this->builder->orderBy($this->parameterBag->has('orderBy'));
            }
        }

        return $this;
    }
}