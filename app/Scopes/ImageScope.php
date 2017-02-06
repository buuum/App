<?php

namespace App\Scopes;

use App\Support\AppSupport;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ImageScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('type', function ($query) {
            $query->where('id', '>', AppSupport::getCountry());
        });
        //$builder->where('image_type_id', '>', 1);
    }
}