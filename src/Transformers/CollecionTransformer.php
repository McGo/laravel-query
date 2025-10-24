<?php

namespace McGo\Query\Transformers;

use McGo\Query\Contracts\AQueryTranformer;

class CollecionTransformer extends AQueryTranformer
{

    public function transform()
    {
        return $this->collection;
    }
}