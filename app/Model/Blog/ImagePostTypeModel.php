<?php

namespace App\Model\Blog;

use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class ImagePostTypeModel extends Model
{

    use ModelAppendTrait;

    protected $table = 'blog_image_type';
    protected $guarded = [];

}
