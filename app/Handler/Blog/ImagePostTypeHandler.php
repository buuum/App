<?php

namespace App\Handler\Blog;

use App\Handler\AbstractHandler;
use App\Model\Blog\ImagePostTypeModel;

class ImagePostTypeHandler extends AbstractHandler
{
    public function __construct(ImagePostTypeModel $type)
    {
        $this->model = $type;
    }

    public function create($data)
    {
        $this->model->type = $data['type'];
        $this->model->description = $data['description'];
        $this->model->save();
    }

    public function edit($data)
    {
        $this->model->type = $data['type'];
        $this->model->description = $data['description'];
        $this->model->update();
    }

}
