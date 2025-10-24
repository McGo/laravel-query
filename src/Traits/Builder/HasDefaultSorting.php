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
        $orderType = $this->parameterBag->get('orderType', 'ASC');
        if ($orderType === 'DESC') {
            $this->builder->orderBy($this->parameterBag->get('orderBy'), 'DESC');
        } elseif ($orderType === 'ASC') {
            $this->builder->orderBy($this->parameterBag->get('orderBy'));
        }

        return $this;
    }
}