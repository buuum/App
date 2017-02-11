<?php

namespace App\Model\Blog;

use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{

    use ModelAppendTrait;

    protected $table = 'blog_category';
    protected $guarded = [];

    public function subcategories()
    {
        return $this->hasMany(CategoryModel::class, 'blog_category_id');
    }

    public function categoryparent()
    {
        return $this->belongsTo(CategoryModel::class, 'blog_category_id');
    }

    public function posts()
    {
        return $this->belongsToMany(PostModel::class, 'blog_post_has_blog_category', 'blog_category_id',
            'blog_post_id');
    }

}
