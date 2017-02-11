<?php

namespace App\Handler\Blog;

use App\Handler\AbstractHandler;
use App\Model\Blog\CategoryModel;

class CategoryHandler extends AbstractHandler
{
    public function __construct(CategoryModel $category)
    {
        $this->model = $category;
    }

    public function create($data)
    {
        $this->model->name = $data['name'];
        $this->model->url = slugify($data['name']);

        if (!empty($data['categoryparent']['id'])) {
            $this->model->categoryparent()->associate($data['categoryparent']['id']);
        } elseif ($this->model->categoryparent) {
            $this->model->categoryparent()->dissociate();
        }

        $this->model->save();
    }

    public function edit($data)
    {
        $this->model->name = $data['name'];
        $this->model->url = $data['url'];

        if (!empty($data['categoryparent']['id'])) {
            $this->model->categoryparent()->associate($data['categoryparent']['id']);
        } elseif ($this->model->categoryparent) {
            $this->model->categoryparent()->dissociate();
        }

        $this->model->update();
    }

}
