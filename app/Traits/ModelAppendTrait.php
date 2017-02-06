<?php

namespace App\Traits;

trait ModelAppendTrait
{
    public static $add_appends = false;

    protected function getArrayableAppends()
    {
        if (self::$add_appends) {
            return self::$add_appends;
        }
        return parent::getArrayableAppends();
    }

    //public static $withoutAppends = false;
    //
    //protected function getArrayableAppends_()
    //{
    //    if (self::$withoutAppends) {
    //        return [];
    //    }
    //    return parent::getArrayableAppends();
    //}
}