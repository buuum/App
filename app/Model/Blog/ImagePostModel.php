<?php

namespace App\Model\Blog;

use App\Model\Media\MediaModel;
use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class ImagePostModel extends Model
{

    use ModelAppendTrait;

    protected $table = 'blog_image';
    protected $with = ['media', 'type'];
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(PostModel::class, 'blog_post_id');
    }

    public function media()
    {
        return $this->belongsTo(MediaModel::class, 'media_id');
    }

    public function type()
    {
        return $this->belongsTo(ImagePostTypeModel::class, 'blog_image_type_id');
    }

}
