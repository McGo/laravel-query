<?php

namespace McGo\Query\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use McGo\Query\Contracts\AQueryTranformer;

class JSONResourceCollectionTransformer extends AQueryTranformer
{
    /**
     * @var \Illuminate\Http\Resources\Json\JsonResource|string
     */
    private $resourceClass;

    /**
     * @throws \Exception
     */
    public function __construct(string $resourceClass)
    {
        if (!is_subclass_of($resourceClass, ResourceCollection::class)) {
            throw new \Exception("Resource class must be a subclass of Illuminate\Http\Resources\Json\ResourceCollection");
        }
        $this->resourceClass = $resourceClass;
    }

    public function transform()
    {
        return new $this->resourceClass($this->collection);
    }
}