<?php

namespace App\Factory\Media;

use App\Factory\AbstractFactory;
use App\Handler\Media\MediaTypeHandler;
use App\HandlerCollection\Media\MediaTypeHandlerCollection;
use App\Model\Media\MediaTypeModel;

class MediaTypeFactory extends AbstractFactory
{
    protected $modelclass = MediaTypeModel::class;
    protected $handlerclass = MediaTypeHandler::class;
    protected $handlercollectionclass = MediaTypeHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection($this->model->all());
    }

    public function getEdit($id)
    {
        return $this->getHandler($this->model->find($id));
    }

    public function build($data)
    {
        $handler = $this->getHandler(new MediaTypeModel());
        $handler->create($data);
    }

}