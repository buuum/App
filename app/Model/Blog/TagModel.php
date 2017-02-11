<?php

namespace App\Model\Blog;

use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{

    use ModelAppendTrait;

    protected $table = 'blog_tag';
    protected $guarded = [];

}
