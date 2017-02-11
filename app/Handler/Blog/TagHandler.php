<?php

namespace App\Handler\Blog;

use App\Handler\AbstractHandler;
use App\Model\Blog\TagModel;

class TagHandler extends AbstractHandler
{

    public function __construct(TagModel $tag)
    {
        $this->model = $tag;
    }

    public function create($data)
    {
        $this->model->build($data);
        $this->model->save();
    }

    public function edit($data)
    {
        $this->model->field = $data['field'];
        $this->model->update();
    }

}
