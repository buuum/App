<?php

namespace App\Model;

use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{

    use ModelAppendTrait;

    public $timestamps = false;

    protected $table = 'country';
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(UserModel::class, 'country_id');
    }

}
