<?php

namespace App\Factory\Blog;

use App\Factory\AbstractFactory;
use App\Handler\Blog\ImagePostTypeHandler;
use App\HandlerCollection\Blog\ImagePostTypeHandlerCollection;
use App\Model\Blog\ImagePostTypeModel;

class ImagePostTypeFactory extends AbstractFactory
{

    protected $modelclass = ImagePostTypeModel::class;
    protected $handlerclass = ImagePostTypeHandler::class;
    protected $handlercollectionclass = ImagePostTypeHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection(ImagePostTypeModel::all());
    }

    public function getEdit($id)
    {
        return $this->getHandler($this->model->find($id));
    }

    public function build($data)
    {
        $item = $this->getHandler(new ImagePostTypeModel());
        $item->create($data);
    }

}