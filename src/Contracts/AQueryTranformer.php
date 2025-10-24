<?php

namespace McGo\Query\Contracts;

use Illuminate\Database\Eloquent\Collection;

abstract class AQueryTranformer
{
    protected Collection $collection;

    public function setCollection(Collection $collection): void
    {
        $this->collection = $collection;
    }

    abstract public function transform();

}