<?php

namespace App\Factory\Media;

use App\Factory\AbstractFactory;
use App\Handler\Media\MediaHandler;
use App\HandlerCollection\Media\MediaHandlerCollection;
use App\Model\Media\MediaModel;

class MediaFactory extends AbstractFactory
{
    protected $modelclass = MediaModel::class;
    protected $handlerclass = MediaHandler::class;
    protected $handlercollectionclass = MediaHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection(MediaModel::all());
    }

    public function getEdit($id)
    {
        return $this->getHandler($this->model->find($id));
    }

    public function build($data)
    {
        $item = $this->getHandler(new MediaModel());
        $item->create($data);
        return $item;
    }

    public function buildFromImagePost($data)
    {
        $media = $this->build($data);
        $media->addVariants('image_post');
        return $media;
    }

    //public function buildBulk($data)
    //{
    //    $items = [];
    //    foreach ($data as $dat) {
    //        $items[] = $this->build($dat);
    //    }
    //    return $items;
    //}

}