<?php

namespace App\Factory\Blog;

use App\Factory\AbstractFactory;
use App\Handler\Blog\CategoryHandler;
use App\HandlerCollection\Blog\CategoryHandlerCollection;
use App\Model\Blog\CategoryModel;

class CategoryFactory extends AbstractFactory
{
    protected $modelclass = CategoryModel::class;
    protected $handlerclass = CategoryHandler::class;
    protected $handlercollectionclass = CategoryHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection(CategoryModel::all());
    }

    public function getEdit($id)
    {
        if (!$category = CategoryModel::with(['categoryparent'])->where('id', $id)->first()) {
            return false;
        }

        return $this->getHandler($category);
    }

    public function build($data)
    {
        $item = $this->getHandler(new CategoryModel());
        $item->create($data);
    }

}