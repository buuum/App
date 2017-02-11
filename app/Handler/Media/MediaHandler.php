<?php

namespace App\Handler\Media;

use App\Facades\Factory\Media\MediaVariantFactory;
use App\Handler\AbstractHandler;
use App\Model\Media\MediaModel;

class MediaHandler extends AbstractHandler
{

    public function __construct(MediaModel $media)
    {
        $this->model = $media;
    }

    public function create($data)
    {
        $this->model->url = $data['url'];
        $this->model->save();
    }

    public function edit($data)
    {
        $this->model->url = $data['url'];
        $this->model->update();
    }

    public function addVariants($from)
    {
        // add variants //
        if ($from == 'image_post') {
            MediaVariantFactory::get()->buildFromImagePost($this);
        }

    }

}
