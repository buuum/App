<?php

namespace App\Scopes;

use App\Support\AppSupport;
use Illuminate\Database\Eloquent\Builder;

trait ImageType
{
    public static function bootImageType()
    {
        static::addGlobalScope('ImageType', function(Builder $builder) {
            $builder->whereHas('type', function ($query) {
                $query->where('id', '>', AppSupport::getCountry());
            });
        });
    }
}
