<?php

namespace McGo\Query\Traits\Builder;

use McGo\Query\Contracts\AQueryBuilder;

/**
 * @mixin AQueryBuilder
 */
trait HasRelationsFilter
{

    protected function addWithFilter(string $relation, string $parameterName): void
    {
        if ($this->request->has($parameterName)) {
            $this->builder->with($relation);
        }
    }

    protected function addWhereHasFilter(
        string $relatedModel,
        string $pivotTable,
        $localPivotColumn,
        $foreignPivotColumn,
        string $parameterName,
        string $relationName = 'tempRelation'
    ) {
        if ($this->request->has($parameterName) && !empty($this->request->get($parameterName))) {
            $this->model_class::resolveRelationUsing($relationName,
                function ($entity) use ($relatedModel, $pivotTable, $localPivotColumn, $foreignPivotColumn) {
                    return $entity->belongsToMany($relatedModel, $pivotTable, $localPivotColumn, $foreignPivotColumn);
                });

            $this->builder->whereHas($relationName,
                function (\Illuminate\Database\Eloquent\Builder $tags) use ($parameterName, $relatedModel) {
                    $tags->whereIn((new $relatedModel)->getTable().'.id', $this->request->get($parameterName));
                });
        }
    }

}