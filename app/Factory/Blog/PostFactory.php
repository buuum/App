<?php

namespace App\Factory\Blog;

use App\Facades\Factory\Blog\ImagePostFactory;
use App\Facades\Factory\Blog\TagFactory;
use App\Factory\AbstractFactory;
use App\Handler\Blog\PostHandler;
use App\HandlerCollection\Blog\PostHandlerCollection;
use App\Model\Blog\PostModel;

class PostFactory extends AbstractFactory
{
    protected $modelclass = PostModel::class;
    protected $handlerclass = PostHandler::class;
    protected $handlercollectionclass = PostHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection(PostModel::all());
    }

    public function getEdit($id)
    {
        if (!$post = PostModel::with(['categories', 'tags', 'images'])->where('id', $id)->first()) {
            return false;
        }
        return $this->getHandler($post);
    }

    public function build($data)
    {
        $handler = $this->getHandler(new PostModel());
        $handler->create($data);

    }

}