<?php

namespace App\Controller\Adm\Blog\ImagePostType;

use App\Controller\Adm\Controller;
use App\Facades\Handler\ImagePostTypeHandler;
use App\ViewsBuilder\Adm\Pages\ImagePostTypePage;

class DeleteController extends Controller
{

    public function get($imageposttype)
    {
        $pagina = new ImagePostTypePage($this->prepareData([
            'imageposttype' => $imageposttype
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($imageposttype)
    {
        $imageposttype->delete();
        return [
            'error' => false,
            'id'    => $imageposttype->id
        ];
    }

}
