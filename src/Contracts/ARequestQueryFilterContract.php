<?php

namespace McGo\RequestQueryFilter\Contracts;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

abstract class ARequestQueryFilterContract implements RequestQueryFilterContract
{
    protected EloquentBuilder $builder;
    protected Request $request;
    protected string $model_class;
    protected $table_name;

    public function forModel(string $model): self
    {
        $this->model_class = $model;
        return $this;
    }

    public function forRequest(Request $request): self
    {
        $this->request = $request;
        return $this;
    }

    abstract public function filters(): self;

    abstract public function with(): self;

    abstract public function scopes(): self;

    abstract public function order(): self;


    private function initialize(): self
    {
        $this->builder = $this->model_class::query();
        return $this;
    }

    public function build(): EloquentBuilder
    {
        $this->initialize();
        $this->filters();
        $this->with();
        $this->scopes();
        $this->order();

        return $this->builder;
    }

    private function tablePrefix()
    {
        return $this->table_name.'.';
    }

    private function setTable(): self
    {
        if ($this->model_class) {
            $this->table_name = App::make($this->model_class)->getTable();
        }

        return $this;
    }
}