<?php

namespace App\Model\Blog;

use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{

    use ModelAppendTrait;

    protected $table = 'blog_post';
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(CategoryModel::class, 'blog_post_has_blog_category', 'blog_post_id',
            'blog_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(TagModel::class, 'blog_post_has_blog_tag', 'blog_post_id', 'blog_tag_id');
    }

    public function images()
    {
        return $this->hasMany(ImagePostModel::class, 'blog_post_id');
    }

    public function setPublishdateAttribute($value)
    {
        $date = \DateTime::createFromFormat('d/m/Y H:i:s', $value);
        $this->attributes['publish_date'] = $date->format('Y-m-d H:i:s');
    }
}
