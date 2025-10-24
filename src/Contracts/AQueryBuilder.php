<?php

namespace McGo\Query\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AQueryBuilder
{
    protected ParameterBag $parameterBag;
    protected Builder $builder;
    private string $tableName;
    private string $modelClass;

    public function __construct(Builder $builder, ParameterBag $parameterBag)
    {
        $this->parameterBag = $parameterBag;
        $this->builder = $builder;
        $model = $this->builder->getModel();
        $this->modelClass = get_class($model);
        $this->tableName = $model->getTable();
    }

    public function tablePrefix(): string
    {
        return $this->tableName . '.';
    }

    public function filters(): self
    {
        return $this;
    }

    public function with(): self
    {
        return $this;
    }

    public function scopes(): self
    {
        return $this;
    }

    public function order(): self
    {
        return $this;
    }

    /**
     * Limit the number of results if desired.
     *
     * @return $this
     */
    public function limit(): self
    {
        return $this;
    }

    /**
     * Skip some records.
     *
     * @return $this
     */
    public function skip(): self
    {
        return $this;
    }

    public function build(): Builder
    {
        $this->with();
        $this->scopes();
        $this->filters();
        $this->order();
        $this->limit();
        $this->skip();
        return $this->builder;
    }
}