<?php

namespace App\Handler\Blog;

use App\Facades\Factory\Media\MediaFactory;
use App\Handler\AbstractHandler;
use App\Model\Blog\ImagePostModel;

class ImagePostHandler extends AbstractHandler
{
    public function __construct(ImagePostModel $image)
    {
        $this->model = $image;
    }

    public function create($data)
    {
        if ($this->model->media) {
            $media = MediaFactory::get()->find($this->model->media->id);
            if ($data['media']['url'] != $media->url) {
                $media->delete();
                $media = MediaFactory::get()->buildFromImagePost($data['media']);
            }
        } else {
            $media = MediaFactory::get()->buildFromImagePost($data['media']);
        }
        $this->addPost($data['post']['id']);
        $this->addMedia($media->id);
        $this->addType($data['type']['id']);
        $this->model->save();
    }

    public function edit($data)
    {
        if ($this->model->media) {
            $media = MediaFactory::get()->find($this->model->media->id);
            if ($data['media']['url'] != $media->url) {
                $antmedia = $media;
                $media = MediaFactory::get()->buildFromImagePost($data['media']);
                $this->addMedia($media->id);
                $this->model->save();
                $antmedia->delete();
            }
        } else {
            $media = MediaFactory::get()->buildFromImagePost($data['media']);
            $this->addMedia($media->id);
        }
        $this->addPost($data['post']['id']);
        $this->addType($data['type']['id']);
        $this->model->save();
    }

    public function addPost($postid)
    {
        $this->model->post()->associate($postid);
    }

    public function addMedia($mediaid)
    {
        $this->model->media()->associate($mediaid);
    }

    public function addType($typeid)
    {
        $this->model->type()->associate($typeid);
    }

}
