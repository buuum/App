<?php

namespace App\Scopes;

use App\Support\AppSupport;
use Illuminate\Database\Eloquent\Builder;

trait PlatformTrait
{
    public static function bootPlatformTrait()
    {
        static::addGlobalScope('Platform', function (Builder $builder) {
            $builder->whereHas('platform', function ($query) {
                $query->where('name', '=', AppSupport::get('environment.platform'));
            });
        });
    }
}
