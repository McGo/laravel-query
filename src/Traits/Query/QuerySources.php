<?php

namespace McGo\Query\Traits\Query;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use McGo\Query\Query;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * It is possible to use the Query class with different sources.
 *
 * @property ParameterBag $queryParameters
 * @mixin Query
 */
trait QuerySources
{

    final public function forRequest(Request $request): self
    {
        $this->queryParameters = new ParameterBag($request->all());
        return $this;
    }

    final public function forCollection(Collection $collection): self
    {
        $this->queryParameters = new ParameterBag($collection->toArray());
        return $this;
    }

    final public function forArray(array $array): self
    {
        $this->queryParameters = new ParameterBag($array);
        return $this;
    }

    final public function forParameterBag(ParameterBag $bag): self {
        $this->queryParameters = $bag;
        return $this;
    }

}