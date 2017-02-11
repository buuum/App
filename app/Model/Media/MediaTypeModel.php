<?php

namespace App\Model\Media;

use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class MediaTypeModel extends Model
{

    use ModelAppendTrait;

    protected $table = 'media_type';
    protected $guarded = [];

    public function variants()
    {
        return $this->hasMany(MediaVariantModel::class, 'media_type_id');
    }

}
