<?php

namespace App\Factory\Blog;

use App\Facades\Factory\Media\MediaFactory;
use App\Factory\AbstractFactory;
use App\Handler\Blog\ImagePostHandler;
use App\HandlerCollection\Blog\ImagePostHandlerCollection;
use App\Model\Blog\ImagePostModel;

class ImagePostFactory extends AbstractFactory
{

    protected $modelclass = ImagePostModel::class;
    protected $handlerclass = ImagePostHandler::class;
    protected $handlercollectionclass = ImagePostHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection(ImagePostModel::all());
    }

    public function getEdit($id)
    {
        return $this->getHandler($this->model->find($id));
    }

    public function build($data)
    {
        if (!empty($data['id'])) {
            $item = $this->getEdit($data['id']);
            $item->edit($data);
        } else {
            $item = $this->getHandler(new ImagePostModel());
            $item->create($data);
        }
        return $item;
    }

    public function buildBulk($data, $post)
    {
        $ids = $post->getRelatedIds('images');
        $returnids = [];
        foreach ($data as $datum) {
            $datum['post']['id'] = $post->id;
            if (!empty($datum['id']) && !in_array($datum['id'], $ids)) {
                $datum['id'] = 0;
            }
            $returnids[] = $this->build($datum)->id;
        }
        $this->model->destroy(array_diff($ids, $returnids));
    }

}