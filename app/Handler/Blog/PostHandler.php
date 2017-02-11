<?php

namespace App\Handler\Blog;

use App\Facades\Factory\Blog\ImagePostFactory;
use App\Facades\Factory\Blog\TagFactory;
use App\Handler\AbstractHandler;
use App\Handler\BaseHandler;
use App\Model\Blog\PostModel;

class PostHandler extends AbstractHandler
{
    public function __construct(PostModel $post)
    {
        $this->model = $post;
    }

    public function addCategories($categories)
    {
        $ids = [];
        foreach ($categories as $category) {
            $ids[] = $category['id'];
        }
        $this->model->categories()->sync($ids);
    }

    public function addTags($tags)
    {
        $tags = TagFactory::get()->buildOrGetFromName($tags);
        $this->model->tags()->sync($tags);
    }

    public function addImages($images)
    {
        ImagePostFactory::get()->buildBulk($images, $this);
    }

    public function create($data)
    {
        $this->model->title = $data['title'];
        $this->model->url = slugify($data['title']);
        $this->model->text = $data['text'];
        $this->model->publish_date = $data['publish_date'];
        $this->model->save();

        if (!empty($data['categories'])) {
            $this->addCategories($data['categories']);
        }
        if (!empty($data['tags'])) {
            $this->addTags($data['tags']);
        }
        if (!empty($data['images'])) {
            $this->addImages($data['images']);
        }

        return $this;

    }

    public function edit($data)
    {
        $this->model->title = $data['title'];
        $this->model->url = $data['url'];
        $this->model->text = $data['text'];
        $this->model->publish_date = $data['publish_date'];
        $this->model->save();

        if (!empty($data['categories'])) {
            $this->addCategories($data['categories']);
        } else {
            $this->model->categories()->detach();
        }
        if (!empty($data['tags'])) {
            $this->addTags($data['tags']);
        } else {
            $this->model->tags()->detach();
        }

        $this->addImages($data['images']);

    }

}
