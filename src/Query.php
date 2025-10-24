<?php

namespace McGo\Query;

use Illuminate\Database\Eloquent\Builder;
use McGo\Query\Builder\EmptyQueryBuilder;
use McGo\Query\Contracts\AQueryBuilder;
use McGo\Query\Contracts\AQueryTranformer;
use Exception;
use McGo\Query\Traits\Query\QuerySources;
use McGo\Query\Transformers\CollecionTransformer;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Database\Eloquent\Model;

final class Query
{
    use QuerySources;

    protected string $modelClass;
    protected string $builderClass;
    protected AQueryTranformer $transformer;
    protected ParameterBag $queryParameters;

    protected AQueryBuilder $builder;

    /**
     * @throws Exception
     */
    public function __construct(string $modelClass)
    {
        if (!is_subclass_of($modelClass,Model::class)) {
            throw new Exception("Model class must be a subclass of Illuminate\Database\Eloquent\Model");
        }

        // Initialize with defaults so that no filters are applied and the query returns all records as collection
        $this->modelClass = $modelClass;
        $this->withBuilder(EmptyQueryBuilder::class);
        $this->to(new CollecionTransformer());
        $this->queryParameters = new ParameterBag([]);
    }

    /**
     * @throws Exception
     */
    public static function theModel(string $modelClass): self
    {
        return new Query($modelClass);
    }

    /**
     * @throws Exception
     */
    public function withBuilder(string $builderClass): self
    {
        if (!is_subclass_of($builderClass,AQueryBuilder::class)) {
            throw new Exception("Builder class must be a subclass of McGo\Query\Contracts\AQueryBuilder");
        }
        $this->builderClass = $builderClass;
        return $this;
    }

    public function to(AQueryTranformer $transformer)
    {
        $this->transformer = $transformer;
        return $this;
    }

    /**
     * Builds the query and applies the query builder. Instead of returning the transformed data, it returns the query
     * builder itself, so that the user can further customize the query.
     *
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        // modelClass is subclass of Eloquent Model - so query() is present.
        $eloquentBuilder = $this->modelClass::query();
        $queryBuilder = new $this->builderClass($eloquentBuilder, $this->queryParameters);
        return $queryBuilder->build();
    }

    /**
     * Runs the query and returns the transformed data. Since it is not defined, what the output of the desired
     * transformation is, it returns mixed.
     *
     * @return mixed
     */
    public function run()
    {
        $builder = $this->getBuilder();
        $this->transformer->setCollection($builder->get());
        return $this->transformer->transform();
    }
}