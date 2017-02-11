<?php

namespace App\Factory\Blog;

use App\Factory\AbstractFactory;
use App\Handler\Blog\TagHandler;
use App\HandlerCollection\Blog\TagHandlerCollection;
use App\Model\Blog\TagModel;

class TagFactory extends AbstractFactory
{
    protected $modelclass = TagModel::class;
    protected $handlerclass = TagHandler::class;
    protected $handlercollectionclass = TagHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection(TagModel::all());
    }

    public function getEdit($id)
    {
        return $this->getHandler($this->model->find($id));
    }

    public function build($data)
    {
        $item = $this->getHandler(new TagModel());
        $item->create($data);
    }

    public function buildOrGetFromName($tags)
    {
        $list = [];
        foreach ($tags as $tag) {
            $tag = trim($tag['name']);
            $tag = TagModel::firstOrCreate([
                'name' => $tag,
                'url'  => slugify($tag)
            ]);
            $list[] = $tag->id;
        }
        return $list;
    }
}