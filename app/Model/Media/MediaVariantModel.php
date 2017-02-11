<?php

namespace App\Model\Media;

use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class MediaVariantModel extends Model
{

    use ModelAppendTrait;

    protected $table = 'media_variant';
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(MediaTypeModel::class, 'media_type_id');
    }

    public function media()
    {
        return $this->belongsTo(MediaModel::class, 'media_id');
    }

}
