<?php

namespace App\Controller\Adm\Media\MediaType;

use App\Controller\Adm\Controller;
use App\Facades\Handler\MediaTypeHandler;
use App\ViewsBuilder\Adm\Pages\MediaTypePage;

class DeleteController extends Controller
{

    public function get($mediatype)
    {
        $pagina = new MediaTypePage($this->prepareData([
            'mediatype' => $mediatype
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($mediatype)
    {
        $mediatype->delete();
        return [
            'error' => false,
            'id'    => $mediatype->id
        ];
    }

}
