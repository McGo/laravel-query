<?php

namespace McGo\Query\Traits\Builder;

use McGo\Query\Contracts\AQueryBuilder;

/**
 * @mixin AQueryBuilder
 */
trait HasLimitAndSkipFromParameterBag
{
    public function addLimitingFromParameterBag($parmeterName)
    {
        if ($this->parameterBag->has($parmeterName) && is_numeric($this->parameterBag->get($parmeterName))) {
            $this->builder->limit($this->parameterBag->get($parmeterName));
        }
    }
    public function addSkippingFromParameterBag($parmeterName)
    {
        if ($this->parameterBag->has($parmeterName) && is_numeric($this->parameterBag->get($parmeterName))) {
            $this->builder->offset($this->parameterBag->get($parmeterName));
        }
    }
}