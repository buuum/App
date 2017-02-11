<?php

namespace App\Handler\Media;

use App\Handler\AbstractHandler;
use App\Model\Media\MediaTypeModel;
use App\Model\Media\MediaVariantModel;
use Buuum\S3;
use Intervention\Image\ImageManagerStatic;

class MediaVariantHandler extends AbstractHandler
{

    public function __construct(MediaVariantModel $media)
    {
        $this->model = $media;
    }

    public function create($data)
    {
        $this->model->field = $data['field'];
        $this->model->save();
    }

    public function createMin($media)
    {
        $extension = pathinfo($media->url, PATHINFO_EXTENSION);
        $tmp_file = __DIR__ . '/' . microtime(true) . '.' . $extension;
        ImageManagerStatic::make($media->url)->crop(300, 300)->save($tmp_file);
        $response = S3::putObjectString(file_get_contents($tmp_file), 'poker/min_' . microtime(true) . '.' . $extension);
        unlink($tmp_file);

        $this->model->url = $response['url']['default'];
        $this->model->type()->associate(MediaTypeModel::where('type','min_300')->first());
        $this->model->media()->associate($media->id);
        $this->model->save();
    }

    public function createFacebook($media)
    {
        $extension = pathinfo($media->url, PATHINFO_EXTENSION);
        $tmp_file = __DIR__ . '/' . microtime(true) . '.' . $extension;
        ImageManagerStatic::make($media->url)->fit(800, 600)->save($tmp_file);
        $response = S3::putObjectString(file_get_contents($tmp_file), 'poker/fit_' . microtime(true) . '.' . $extension);
        unlink($tmp_file);

        $this->model->url = $response['url']['default'];
        $this->model->type()->associate(MediaTypeModel::where('type','facebook')->first());
        $this->model->media()->associate($media->id);
        $this->model->save();
    }

    public function edit($data)
    {
        $this->model->field = $data['field'];
        $this->model->update();
    }

}
