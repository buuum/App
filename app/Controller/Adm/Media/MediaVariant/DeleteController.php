<?php

namespace App\Controller\Adm\Media\MediaVariant;

use App\Controller\Adm\Controller;
use App\Facades\Handler\MediaVariantHandler;
use App\ViewsBuilder\Adm\Pages\MediaVariantPage;

class DeleteController extends Controller
{

    public function get($mediavariant)
    {
        $pagina = new MediaVariantPage($this->prepareData([
            'mediavariant' => $mediavariant
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($mediavariant)
    {
        $mediavariant->delete();
        return [
            'error' => false,
            'id'    => $mediavariant->id
        ];
    }

}
