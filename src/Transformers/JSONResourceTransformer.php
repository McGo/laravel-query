<?php

namespace McGo\Query\Transformers;

use McGo\Query\Contracts\AQueryTranformer;

class JSONResourceTransformer extends AQueryTranformer
{
    /**
     * @var \Illuminate\Http\Resources\Json\JsonResource|string
     */
    private $resourceClass;

    public function __construct(string $resourceClass)
    {
        if (!is_subclass_of($resourceClass, \Illuminate\Http\Resources\Json\JsonResource::class)) {
            throw new \Exception("Resource class must be a subclass of Illuminate\Http\Resources\Json\JsonResource");
        }
        $this->resourceClass = $resourceClass;
    }

    public function transform()
    {
        return new $this->resourceClass($this->collection);
    }
}