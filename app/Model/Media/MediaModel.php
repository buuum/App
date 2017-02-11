<?php

namespace App\Model\Media;

use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class MediaModel extends Model
{

    use ModelAppendTrait;

    protected $table = 'media';
    protected $with = ['variants'];
    protected $guarded = [];

    public function variants()
    {
        return $this->hasMany(MediaVariantModel::class, 'media_id');
    }

}
