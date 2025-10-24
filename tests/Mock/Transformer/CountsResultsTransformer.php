<?php

namespace McGo\Query\Tests\Mock\Transformer;

use McGo\Query\Contracts\AQueryTranformer;

/**
 * Just a simple transformer to count the results of the collection
 */
class CountsResultsTransformer extends AQueryTranformer
{
    public function transform()
    {
        return $this->collection->count();
    }
}