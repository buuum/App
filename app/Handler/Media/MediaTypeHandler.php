<?php

namespace App\Handler\Media;

use App\Handler\AbstractHandler;
use App\Model\Media\MediaTypeModel;

class MediaTypeHandler extends AbstractHandler
{
    public function __construct(MediaTypeModel $media)
    {
        $this->model = $media;
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
