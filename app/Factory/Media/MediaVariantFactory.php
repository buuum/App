<?php

namespace App\Factory\Media;

use App\Factory\AbstractFactory;
use App\Handler\Media\MediaVariantHandler;
use App\HandlerCollection\Media\MediaVariantHandlerCollection;
use App\Model\Media\MediaVariantModel;

class MediaVariantFactory extends AbstractFactory
{
    protected $modelclass = MediaVariantModel::class;
    protected $handlerclass = MediaVariantHandler::class;
    protected $handlercollectionclass = MediaVariantHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection(MediaVariantModel::all());
    }

    public function getEdit($id)
    {
        return $this->getHandler($this->model->find($id));
    }

    public function build($data)
    {
        $handler = $this->getHandler(new MediaVariantModel());
        $handler->create($data);
    }

    public function buildFromImagePost($media)
    {
        $handler = $this->getHandler(new MediaVariantModel());
        $handler->createMin($media);

        $handler = $this->getHandler(new MediaVariantModel());
        $handler->createFacebook($media);
    }

}