<?php

namespace App\Controller\Adm\Media\Media;

use App\Controller\Adm\Controller;
use App\Facades\Handler\MediaHandler;
use App\ViewsBuilder\Adm\Pages\MediaPage;

class DeleteController extends Controller
{

    public function get($media)
    {
        $pagina = new MediaPage($this->prepareData([
            'media' => $media
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($media)
    {
        MediaHandler::get()->remove($media);
        return [
            'error' => false,
            'id'    => $media->id
        ];
    }

}
